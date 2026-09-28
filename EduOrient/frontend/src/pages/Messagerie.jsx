import { useCallback, useEffect, useLayoutEffect, useMemo, useRef, useState } from 'react';
import { useSearchParams } from 'react-router-dom';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import DashboardLayout from '../components/DashboardLayout';
import api, { getStorageUrl } from '../api/axios';
import { useAuth } from '../context/AuthContext';
import { useMessagingUnread } from '../context/MessagingUnreadContext';

/**
 * Messagerie étudiant / recruteur : conversations, messages et option WebSocket (Echo/Reverb).
 * Backend : ConversationController — GET/POST /api/conversations, messages, read, unread-total.
 */

/**
 * Indique si le temps réel Echo/Reverb est activé (variables Vite).
 * Entrées : aucune ; lit import.meta.env.
 * Sortie : booléen.
 */
function isLiveEchoEnabled() {
  const key = import.meta.env.VITE_REVERB_APP_KEY;
  if (!key) return false;
  const v = String(import.meta.env.VITE_REVERB_ENABLED ?? '').toLowerCase();
  if (v === 'false' || v === '0') return false;
  return true;
}

const LIVE_ECHO_ENABLED = isLiveEchoEnabled();
const REVERB_KEY_PRESENT = Boolean(import.meta.env.VITE_REVERB_APP_KEY);

/**
 * Formate une date ISO pour l’affichage sous chaque bulle de message.
 * Entrées : iso (string date).
 * Sortie : string localisée ou chaîne vide si invalide.
 */
function formatTime(iso) {
  if (!iso) return '';
  try {
    const d = new Date(iso);
    return d.toLocaleString(undefined, {
      day: 'numeric',
      month: 'short',
      hour: '2-digit',
      minute: '2-digit',
    });
  } catch {
    return '';
  }
}

/**
 * Interface messagerie complète : chargement conversations, fusion messages / optimistic UI, Echo optionnel.
 * Entrées : aucune prop ; query params ?recruteur= ou ?etudiant= pour ouvrir/créer une conversation.
 * Sortie : JSX.
 */
export default function Messagerie() {
  const { user } = useAuth();
  const { refreshUnread } = useMessagingUnread();
  const [searchParams, setSearchParams] = useSearchParams();
  const [conversations, setConversations] = useState([]);
  const [selectedId, setSelectedId] = useState(null);
  const [messages, setMessages] = useState([]);
  const [listLoading, setListLoading] = useState(true);
  const [messagesLoading, setMessagesLoading] = useState(false);
  const [sendError, setSendError] = useState(null);
  const [draft, setDraft] = useState('');
  const [sending, setSending] = useState(false);
  const messagesScrollRef = useRef(null);

  const myUserId = user?.id;

  /**
   * Charge toutes les conversations de l’utilisateur connecté (résumé + dernier message + non lus).
   * Entrées : aucune ; token Bearer via api.
   * Sortie : Promise ; met conversations et retourne le tableau brut (utile après création).
   */
  const loadConversations = useCallback(async () => {
    setListLoading(true);
    try {
      const res = await api.get('/conversations');
      const rows = Array.isArray(res.data?.data) ? res.data.data : [];
      setConversations(rows);
      return rows;
    } catch {
      setConversations([]);
      return [];
    } finally {
      setListLoading(false);
    }
  }, []);

  useEffect(() => {
    loadConversations();
  }, [loadConversations]);

  useEffect(() => {
    const rec = searchParams.get('recruteur');
    const etu = searchParams.get('candidat');
    if (!rec && !etu) return;

    const payload = rec ? { recruteur_id: Number(rec) } : { etudiant_id: Number(etu) };
    if (rec && !Number.isFinite(payload.recruteur_id)) return;
    if (etu && !Number.isFinite(payload.candidat_id)) return;

    (async () => {
      try {
        const res = await api.post('/conversations', payload);
        const conv = res.data?.data;
        if (conv?.id) {
          setSelectedId(conv.id);
          await loadConversations();
        }
      } catch {
        /* ignore */
      } finally {
        setSearchParams({}, { replace: true });
      }
    })();
  }, [searchParams, setSearchParams, loadConversations]);

  /**
   * Charge l’historique des messages d’une conversation et fusionne avec les messages « en attente d’envoi ».
   * Entrées : conversationId (nombre ou null).
   * Sortie : Promise ; met à jour le state messages.
   */
  const loadMessages = useCallback(async (conversationId) => {
    if (!conversationId) {
      setMessages([]);
      return;
    }
    setMessagesLoading(true);
    try {
      const res = await api.get(`/conversations/${conversationId}/messages`);
      const incoming = Array.isArray(res.data?.data) ? res.data.data : [];
      setMessages((prev) => {
        const pending = prev.filter((m) => m._pending === true);
        if (pending.length === 0) return incoming;
        const merged = [...incoming];
        for (const p of pending) {
          const already = incoming.some(
            (s) => s.sender_id === p.sender_id && s.content === p.content,
          );
          if (!already) merged.push(p);
        }
        merged.sort((a, b) => {
          const ca = String(a.created_at ?? '');
          const cb = String(b.created_at ?? '');
          if (ca !== cb) return ca.localeCompare(cb);
          return Number(a.id) - Number(b.id);
        });
        return merged;
      });
    } catch {
      setMessages([]);
    } finally {
      setMessagesLoading(false);
    }
  }, []);

  useEffect(() => {
    if (!selectedId) {
      setMessages([]);
      return;
    }
    loadMessages(selectedId);
  }, [selectedId, loadMessages]);

  useEffect(() => {
    if (!selectedId) return undefined;
    const id = selectedId;
    api
      .post(`/conversations/${id}/read`)
      .then(() => {
        setConversations((prev) => prev.map((c) => (c.id === id ? { ...c, unread_count: 0 } : c)));
        refreshUnread();
      })
      .catch(() => {});
    return undefined;
  }, [selectedId, refreshUnread]);

  // Polling HTTP désactivé : les mises à jour en temps réel passent par Echo/Reverb lorsque activé.

  useEffect(() => {
    if (!selectedId || !LIVE_ECHO_ENABLED) return undefined;

    const conversationId = selectedId;
    let cancelled = false;
    const echoRef = { current: null };

    try {
      Pusher.logToConsole = false;
      window.Pusher = Pusher;

      const token = localStorage.getItem('token');
      if (!token || cancelled) return undefined;

      const apiOrigin = import.meta.env.VITE_API_ORIGIN || 'http://127.0.0.1:8000';
      const host = String(import.meta.env.VITE_REVERB_HOST || '127.0.0.1').replace(/^"|"$/g, '');
      const port = Number(import.meta.env.VITE_REVERB_PORT || 8080);
      const scheme = String(import.meta.env.VITE_REVERB_SCHEME || 'http').replace(/^"|"$/g, '');

      const echo = new Echo({
        broadcaster: 'reverb',
        key: import.meta.env.VITE_REVERB_APP_KEY,
        wsHost: host,
        wsPort: port,
        wssPort: port,
        forceTLS: scheme === 'https',
        enabledTransports: scheme === 'https' ? ['wss'] : ['ws'],
        disableStats: true,
        authEndpoint: `${apiOrigin.replace(/\/$/, '')}/broadcasting/auth`,
        auth: {
          headers: {
            Authorization: `Bearer ${token}`,
            Accept: 'application/json',
          },
        },
      });

      if (cancelled) {
        try {
          echo.disconnect();
        } catch {
          /* ignore */
        }
        return undefined;
      }

      echoRef.current = echo;

      echo.private(`conversation.${conversationId}`).listen('.message.sent', (payload) => {
        const msg = payload?.message;
        if (!msg?.id) return;
        setMessages((prev) => {
          if (prev.some((m) => m.id === msg.id)) return prev;
          const withoutMatchingPending = prev.filter(
            (m) =>
              !(
                m._pending &&
                m.sender_id === msg.sender_id &&
                m.content === msg.content
              ),
          );
          if (withoutMatchingPending.some((m) => m.id === msg.id)) return prev;
          return [...withoutMatchingPending, msg];
        });
        refreshUnread();
        if (myUserId != null && msg.sender_id !== myUserId) {
          api
            .post(`/conversations/${conversationId}/read`)
            .then(() => {
              setConversations((prev) =>
                prev.map((c) => (c.id === conversationId ? { ...c, unread_count: 0 } : c)),
              );
              refreshUnread();
            })
            .catch(() => {});
        }
      });
    } catch {
      /* Reverb / config : pas de temps réel pour cette conversation */
    }

    return () => {
      cancelled = true;
      const e = echoRef.current;
      echoRef.current = null;
      if (e) {
        try {
          e.leave(`conversation.${conversationId}`);
          e.disconnect();
        } catch {
          /* ignore */
        }
      }
    };
  }, [selectedId, refreshUnread, myUserId]);

  const messagesLen = messages.length;
  const lastMessageId = messagesLen ? messages[messagesLen - 1]?.id : 0;
  const selectedKey = selectedId ?? 0;
  const loadingFlag = messagesLoading ? 1 : 0;

  useLayoutEffect(() => {
    const el = messagesScrollRef.current;
    if (!el) return;
    requestAnimationFrame(() => {
      el.scrollTop = el.scrollHeight;
    });
  }, [messagesLen, lastMessageId, selectedKey, loadingFlag]);

  const selected = useMemo(
    () => conversations.find((c) => c.id === selectedId) ?? null,
    [conversations, selectedId],
  );

  /**
   * Envoie un message texte (affichage optimiste puis POST /api/conversations/{id}/messages).
   * Entrées : submit ; state draft, selectedId, user, myUserId.
   * Sortie : Promise ; met à jour messages, conversations et le compteur global non lus.
   */
  const handleSend = async (e) => {
    e.preventDefault();
    const text = draft.trim();
    if (!selectedId || !text || sending) return;
    setSendError(null);
    setDraft('');

    const tempId = -Date.now();
    const nowIso = new Date().toISOString();
    const optimistic = {
      id: tempId,
      conversation_id: selectedId,
      sender_id: myUserId,
      content: text,
      is_read: true,
      created_at: nowIso,
      sender: user ? { id: user.id, name: user.name ?? '' } : { id: myUserId, name: '' },
      _pending: true,
    };

    setMessages((prev) => [...prev, optimistic]);
    setSending(true);

    try {
      const res = await api.post(`/conversations/${selectedId}/messages`, { content: text });
      const row = res.data?.data;
      if (row?.id) {
        setMessages((prev) => {
          const withoutTemp = prev.filter((m) => m.id !== tempId);
          if (withoutTemp.some((m) => m.id === row.id)) return withoutTemp;
          return [...withoutTemp, row];
        });
      } else {
        setMessages((prev) => prev.filter((m) => m.id !== tempId));
        await loadMessages(selectedId);
      }
      await loadConversations();
      await refreshUnread();
    } catch (err) {
      setMessages((prev) => prev.filter((m) => m.id !== tempId));
      setDraft(text);
      const msg = err.response?.data?.message || err.message || 'Envoi impossible.';
      setSendError(msg);
    } finally {
      setSending(false);
    }
  };

  return (
    <DashboardLayout>
      <div className="mx-auto flex max-w-6xl flex-col gap-4">
        <div>
          <h1 className="text-2xl font-bold text-body">Messagerie</h1>
          <p className="mt-1 text-sm text-muted">
            Échanges privés entre votre compte et vos contacts (étudiants ou recruteurs). Seuls les participants d&apos;une conversation peuvent la consulter. Les nouveaux messages reçus sont mis en évidence jusqu&apos;à lecture.
          </p>
          {REVERB_KEY_PRESENT && !LIVE_ECHO_ENABLED && (
            <p className="mt-2 rounded-lg border border-amber-200/60 bg-amber-500/10 px-3 py-2 text-xs text-amber-900 dark:border-amber-900/40 dark:bg-amber-950/30 dark:text-amber-100/90">
              Temps réel (WebSocket) désactivé : définissez <code className="rounded bg-black/5 px-1 dark:bg-white/10">VITE_REVERB_ENABLED=true</code> dans le{' '}
              <code className="rounded bg-black/5 px-1 dark:bg-white/10">backend/.env</code> et lancez{' '}
              <code className="rounded bg-black/5 px-1 dark:bg-white/10">php artisan reverb:start</code> pour recevoir les nouveaux messages sans recharger la page. Sans cela, changez de conversation ou rechargez pour voir les derniers messages.
            </p>
          )}
        </div>

        <div
          className="flex min-h-[420px] flex-1 overflow-hidden rounded-2xl border border-theme bg-card shadow-theme md:min-h-[560px]"
          style={{ maxHeight: 'min(72vh, 720px)' }}
        >
          <aside className="flex w-full flex-shrink-0 flex-col border-b border-theme md:w-80 md:border-b-0 md:border-r">
            <div className="border-b border-theme px-4 py-3">
              <h2 className="text-xs font-semibold uppercase tracking-wide text-muted">Conversations</h2>
            </div>
            <div className="min-h-0 flex-1 overflow-y-auto">
              {listLoading ? (
                <p className="p-4 text-sm text-muted">Chargement…</p>
              ) : conversations.length === 0 ? (
                <p className="p-4 text-sm text-muted leading-relaxed">
                  Aucune conversation pour l&apos;instant. Utilisez « Contacter » depuis le matching ou la recherche pour en ouvrir une.
                </p>
              ) : (
                <ul className="divide-y divide-[var(--border)]">
                  {conversations.map((c) => {
                    const active = c.id === selectedId;
                    const name = c.other_user?.name || 'Contact';
                    const photo = c.other_user?.photo_url;
                    const unread = Math.max(0, Number(c.unread_count) || 0);
                    return (
                      <li key={c.id}>
                        <button
                          type="button"
                          onClick={() => setSelectedId(c.id)}
                          className={`flex w-full items-start gap-3 px-4 py-3 text-left transition ${
                            active ? 'bg-[var(--primary)]/10' : 'hover:bg-block'
                          }`}
                        >
                          <div className="flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-full border border-theme bg-block text-sm font-bold text-[var(--primary)]">
                            {photo ? (
                              <img src={getStorageUrl(photo)} alt="" className="h-full w-full object-cover" loading="lazy" />
                            ) : (
                              name.slice(0, 2).toUpperCase()
                            )}
                          </div>
                          <div className="flex min-w-0 flex-1 items-start gap-2">
                            <div className="min-w-0 flex-1">
                              <p className={`truncate text-sm font-semibold ${active ? 'text-[var(--primary)]' : 'text-body'}`}>
                                {name}
                              </p>
                              {c.entreprise && (
                                <p className="truncate text-xs text-muted">{c.entreprise}</p>
                              )}
                              {c.last_message?.content && (
                                <p
                                  className={`mt-1 truncate text-xs ${
                                    unread > 0 ? 'font-semibold text-body' : 'text-muted'
                                  }`}
                                >
                                  {c.last_message.content}
                                </p>
                              )}
                            </div>
                            {unread > 0 ? (
                              <span className="mt-0.5 shrink-0 min-w-[1.35rem] rounded-full bg-violet-600 px-1.5 py-0.5 text-center text-[10px] font-bold leading-none text-white">
                                {unread > 99 ? '99+' : unread}
                              </span>
                            ) : null}
                          </div>
                        </button>
                      </li>
                    );
                  })}
                </ul>
              )}
            </div>
          </aside>

          <section className="flex min-w-0 flex-1 flex-col bg-page">
            {!selectedId ? (
              <div className="flex flex-1 flex-col items-center justify-center gap-3 p-8 text-center">
                <p className="text-body font-medium">Sélectionnez une conversation</p>
                <p className="max-w-xs text-sm text-muted">Choisissez un contact à gauche pour afficher les messages.</p>
              </div>
            ) : (
              <>
                <header className="border-b border-theme bg-card px-4 py-3 md:px-6">
                  <p className="font-semibold text-body">{selected?.other_user?.name || 'Contact'}</p>
                  {selected?.entreprise && (
                    <p className="text-xs text-muted">{selected.entreprise}</p>
                  )}
                </header>
                <div
                  ref={messagesScrollRef}
                  className="min-h-0 flex-1 overflow-y-auto px-4 py-4 md:px-6"
                >
                  {messagesLoading && messages.length === 0 ? (
                    <p className="text-sm text-muted">Chargement des messages…</p>
                  ) : (
                    <ul className="flex flex-col gap-3">
                      {messages.map((m) => {
                        const mine = m.sender_id === myUserId;
                        const pending = Boolean(m._pending);
                        return (
                          <li
                            key={m.id}
                            className={`flex ${mine ? 'justify-end' : 'justify-start'}`}
                          >
                            <div
                              className={`max-w-[85%] rounded-2xl px-4 py-2.5 text-sm shadow-sm ${
                                mine
                                  ? 'rounded-br-md bg-[var(--primary)] text-white'
                                  : 'rounded-bl-md border border-theme bg-card text-body'
                              } ${pending ? 'opacity-70' : ''}`}
                            >
                              {!mine && m.sender?.name && (
                                <p className="mb-1 text-xs font-medium text-muted">{m.sender.name}</p>
                              )}
                              <div className="flex items-end gap-2">
                                <p className="min-w-0 flex-1 whitespace-pre-wrap break-words leading-relaxed">
                                  {m.content}
                                </p>
                                {pending && mine ? (
                                  <span
                                    className="inline-flex h-4 w-4 shrink-0 animate-spin rounded-full border-2 border-white/40 border-t-white"
                                    aria-label="Envoi en cours"
                                  />
                                ) : null}
                              </div>
                              <p
                                className={`mt-1.5 text-[10px] ${mine ? 'text-white/80' : 'text-muted'}`}
                              >
                                {pending ? 'Envoi…' : formatTime(m.created_at)}
                              </p>
                            </div>
                          </li>
                        );
                      })}
                    </ul>
                  )}
                </div>
                <form onSubmit={handleSend} className="border-t border-theme bg-card p-3 md:p-4">
                  {sendError && (
                    <p className="mb-2 text-xs text-red-600">{sendError}</p>
                  )}
                  <div className="flex gap-2">
                    <textarea
                      value={draft}
                      onChange={(e) => setDraft(e.target.value)}
                      rows={2}
                      placeholder="Écrire un message…"
                      className="min-h-[44px] flex-1 resize-none rounded-xl border border-theme bg-block px-3 py-2 text-sm text-body placeholder:text-muted focus:border-[var(--primary)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]/20"
                    />
                    <button
                      type="submit"
                      disabled={sending || !draft.trim()}
                      className="shrink-0 self-end rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white shadow-theme disabled:opacity-50"
                    >
                      {sending ? '…' : 'Envoyer'}
                    </button>
                  </div>
                </form>
              </>
            )}
          </section>
        </div>
      </div>
    </DashboardLayout>
  );
}


