import { createContext, useCallback, useContext, useEffect, useMemo, useState } from 'react';
import api from '../api/axios';
import { useAuth } from './AuthContext';

/**
 * Compteur global de messages non lus (badge navbar) : polling GET /api/conversations/unread-total.
 */

const MessagingUnreadContext = createContext(null);

const POLL_MS = 45000;

/**
 * Indique si le rôle courant peut utiliser la messagerie (étudiant ou recruteur).
 * Entrées : roleName (string).
 * Sortie : booléen.
 */
function canUseMessaging(roleName) {
  return roleName === 'candidat' || roleName === 'recruteur';
}

/**
 * Fournit unreadTotal et refreshUnread aux écrans dashboard (badge, messagerie).
 * Entrées : children ; lit useAuth.
 * Sortie : JSX (Provider).
 */
export function MessagingUnreadProvider({ children }) {
  const { user, loading: authLoading } = useAuth();
  const [unreadTotal, setUnreadTotal] = useState(0);

  /**
   * Interroge l’API pour le nombre total de messages non lus de l’utilisateur.
   * Entrées : aucune ; utilise user?.role depuis la closure.
   * Sortie : Promise ; met à jour unreadTotal (0 si rôle non concerné ou erreur).
   */
  const refreshUnread = useCallback(async () => {
    if (!canUseMessaging(user?.role?.name)) {
      setUnreadTotal(0);
      return;
    }
    try {
      const res = await api.get('/conversations/unread-total');
      const n = Number(res.data?.unread_total);
      setUnreadTotal(Number.isFinite(n) ? n : 0);
    } catch {
      setUnreadTotal(0);
    }
  }, [user?.role?.name]);

  useEffect(() => {
    if (authLoading || !user) return undefined;
    if (!canUseMessaging(user?.role?.name)) {
      setUnreadTotal(0);
      return undefined;
    }
    refreshUnread();
    const t = window.setInterval(refreshUnread, POLL_MS);
    const onFocus = () => {
      refreshUnread();
    };
    window.addEventListener('focus', onFocus);
    return () => {
      window.clearInterval(t);
      window.removeEventListener('focus', onFocus);
    };
  }, [authLoading, user, refreshUnread]);

  const value = useMemo(
    () => ({
      unreadTotal,
      refreshUnread,
    }),
    [unreadTotal, refreshUnread],
  );

  return (
    <MessagingUnreadContext.Provider value={value}>
      {children}
    </MessagingUnreadContext.Provider>
  );
}

/**
 * Hook consommateur du contexte messagerie ; retourne des valeurs sûres si hors Provider.
 * Entrées : aucune.
 * Sortie : { unreadTotal, refreshUnread }.
 */
export function useMessagingUnread() {
  const ctx = useContext(MessagingUnreadContext);
  if (!ctx) {
    return { unreadTotal: 0, refreshUnread: async () => {} };
  }
  return ctx;
}


