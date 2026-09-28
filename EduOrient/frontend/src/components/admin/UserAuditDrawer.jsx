/* eslint-disable react-hooks/set-state-in-effect */
import { useEffect, useMemo, useState } from 'react';
import { createPortal } from 'react-dom';
import { AnimatePresence, motion } from 'framer-motion';
import { Briefcase, FolderOpen, Loader2, MapPin, Trash2, X } from 'lucide-react';
import api, { getStorageUrl } from '../../api/axios';

const ROLE_LABELS = { admin: 'Admin', etudiant: 'candidat', recruteur: 'Recruteur' };
const MotionAside = motion.aside;
const MotionButton = motion.button;
const MotionDiv = motion.div;

function typeLabel(type) {
  if (type === 'stage') return 'Stage';
  if (type === 'emploi') return 'Emploi';
  return type || '-';
}

function SkillStack({ skills = [] }) {
  if (!skills.length) return <span className="text-sm text-muted">Aucune stack renseignee.</span>;

  return (
    <div className="flex flex-wrap gap-1.5">
      {skills.map((skill) => (
        <span key={skill.id ?? skill.nom} className="rounded-lg border border-theme bg-block px-2 py-1 text-xs text-muted">
          {skill.nom}
        </span>
      ))}
    </div>
  );
}

function AuditItem({ item, type }) {
  const isOffer = type === 'offres';

  return (
    <article className="rounded-xl border border-theme bg-card p-4">
      <div className="flex items-start gap-3">
        <span className="mt-0.5 inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-block text-[var(--primary)]">
          {isOffer ? <Briefcase className="h-4 w-4" /> : <FolderOpen className="h-4 w-4" />}
        </span>
        <div className="min-w-0 flex-1">
          <div className="flex flex-wrap items-center gap-2">
            <h3 className="text-sm font-semibold text-body">{item.titre || 'Sans titre'}</h3>
            {isOffer && (
              <span className="rounded-lg border border-theme bg-block px-2 py-0.5 text-xs font-medium text-muted">
                {typeLabel(item.type)}
              </span>
            )}
          </div>

          {isOffer && item.lieu ? (
            <p className="mt-1 inline-flex items-center gap-1 text-xs text-muted">
              <MapPin className="h-3.5 w-3.5" />
              {item.lieu}
            </p>
          ) : null}

          <p className="mt-3 whitespace-pre-line text-sm leading-6 text-muted">
            {item.description || 'Aucune description.'}
          </p>

          <div className="mt-4">
            <p className="mb-2 text-xs font-semibold uppercase tracking-wider text-muted">Stack technique</p>
            <SkillStack skills={item.skills} />
          </div>
        </div>
      </div>
    </article>
  );
}

function DoubleConfirmModal({ user, deleting, onCancel, onConfirm }) {
  if (!user) return null;

  return (
    <MotionDiv
      initial={{ opacity: 0 }}
      animate={{ opacity: 1 }}
      exit={{ opacity: 0 }}
      className="fixed inset-0 z-[1100] flex items-center justify-center p-4"
    >
      <button
        type="button"
        className="absolute inset-0 bg-black/60 backdrop-blur-sm"
        onClick={() => !deleting && onCancel()}
        aria-label="Fermer la confirmation"
      />
      <MotionDiv
        initial={{ opacity: 0, scale: 0.96, y: 10 }}
        animate={{ opacity: 1, scale: 1, y: 0 }}
        exit={{ opacity: 0, scale: 0.96, y: 10 }}
        className="relative w-full max-w-md rounded-2xl border border-theme bg-card p-6 shadow-theme"
      >
        <h3 className="text-lg font-semibold text-body">Confirmer la suppression</h3>
        <p className="mt-2 text-sm leading-6 text-muted">
          Supprimer le compte <strong className="text-body">{user.name || user.email}</strong> ? Les projets, offres,
          conversations et donnees liees seront supprimes par cascade.
        </p>
        <div className="mt-6 flex justify-end gap-3">
          <button
            type="button"
            onClick={onCancel}
            disabled={deleting}
            className="rounded-xl border border-theme bg-block px-4 py-2.5 text-sm font-medium text-body disabled:opacity-50"
          >
            Annuler
          </button>
          <button
            type="button"
            onClick={onConfirm}
            disabled={deleting}
            className="inline-flex items-center gap-2 rounded-xl bg-red-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-600 disabled:cursor-not-allowed disabled:opacity-60"
          >
            {deleting ? <Loader2 className="h-4 w-4 animate-spin" /> : <Trash2 className="h-4 w-4" />}
            {deleting ? 'Suppression...' : 'Supprimer'}
          </button>
        </div>
      </MotionDiv>
    </MotionDiv>
  );
}

export default function UserAuditDrawer({ user, currentUserId, isOpen, onClose, onDeleted, onDeleteError }) {
  const [audit, setAudit] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);
  const [confirmUser, setConfirmUser] = useState(null);
  const [deleting, setDeleting] = useState(false);

  const displayUser = audit?.user ?? user;
  const roleName = displayUser?.role?.name;
  const isSelf = displayUser?.id === currentUserId;

  const title = useMemo(() => {
    if (audit?.type === 'projects') return 'Projets de l etudiant';
    if (audit?.type === 'offres') return 'Offres du recruteur';
    return 'Audit utilisateur';
  }, [audit?.type]);

  useEffect(() => {
    if (!isOpen || !user?.id) return;

    setLoading(true);
    setError(null);
    setAudit(null);

    api
      .get(`/admin/users/${user.id}/audit`)
      .then((res) => setAudit(res.data?.data ?? null))
      .catch((err) => {
        setError(err.response?.data?.message || 'Impossible de charger les details utilisateur.');
      })
      .finally(() => setLoading(false));
  }, [isOpen, user?.id]);

  const handleDelete = () => {
    if (!displayUser || isSelf) return;

    setDeleting(true);
    api
      .delete(`/admin/users/${displayUser.id}`)
      .then(() => {
        setConfirmUser(null);
        onDeleted?.(displayUser);
      })
      .catch((err) => {
        onDeleteError?.(err.response?.data?.message || 'Erreur lors de la suppression.');
      })
      .finally(() => setDeleting(false));
  };

  const portalTarget = typeof document !== 'undefined' ? document.body : null;
  if (!portalTarget) return null;

  return createPortal(
    <AnimatePresence>
      {isOpen && displayUser && (
        <>
          <MotionButton
            type="button"
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-[1000] bg-black/45 backdrop-blur-sm"
            onClick={() => !deleting && onClose()}
            aria-label="Fermer le panneau d'audit"
          />

          <MotionAside
            initial={{ x: '100%' }}
            animate={{ x: 0 }}
            exit={{ x: '100%' }}
            transition={{ type: 'spring', damping: 28, stiffness: 260 }}
            className="fixed right-0 top-0 z-[1010] flex h-dvh max-h-dvh min-h-0 w-full max-w-2xl flex-col border-l border-theme bg-card shadow-theme"
            aria-label="Panneau audit utilisateur"
          >
            <header className="shrink-0 border-b border-theme p-5">
              <div className="flex items-start justify-between gap-4">
                <div className="flex min-w-0 items-center gap-3">
                  <div className="flex h-12 w-12 shrink-0 items-center justify-center overflow-hidden rounded-full border border-theme bg-block">
                    {displayUser.photo_url ? (
                      <img src={getStorageUrl(displayUser.photo_url)} alt="" className="h-full w-full object-cover" />
                    ) : (
                      <span className="text-base font-semibold text-[var(--primary)]">
                        {(displayUser.name || '?').charAt(0).toUpperCase()}
                      </span>
                    )}
                  </div>
                  <div className="min-w-0">
                    <h2 className="truncate text-lg font-semibold text-body">{displayUser.name || '-'}</h2>
                    <p className="truncate text-sm text-muted">{displayUser.email || '-'}</p>
                    <span className="mt-2 inline-flex rounded-lg border border-theme bg-block px-2.5 py-1 text-xs font-medium text-muted">
                      {ROLE_LABELS[roleName] ?? roleName ?? '-'}
                    </span>
                  </div>
                </div>
                <button
                  type="button"
                  onClick={onClose}
                  disabled={deleting}
                  className="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-theme bg-block text-muted transition hover:text-body disabled:opacity-50"
                  aria-label="Fermer"
                >
                  <X className="h-5 w-5" />
                </button>
              </div>
            </header>

            <div className="min-h-0 flex-1 overflow-y-auto p-5">


              {loading ? (
                <div className="flex items-center justify-center gap-2 rounded-xl border border-theme bg-block p-10 text-muted">
                  <Loader2 className="h-5 w-5 animate-spin" />
                  Chargement des details...
                </div>
              ) : error ? (
                <div className="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-900/50 dark:bg-red-950/40 dark:text-red-200">
                  {error}
                </div>
              ) : (
                <>
                  <h3 className="mb-3 text-sm font-semibold uppercase tracking-wider text-muted">{title}</h3>
                  {audit?.items?.length ? (
                    <div className="space-y-3">
                      {audit.items.map((item) => (
                        <AuditItem key={item.id} item={item} type={audit.type} />
                      ))}
                    </div>
                  ) : (
                    <div className="rounded-xl border border-theme bg-block p-8 text-center text-sm text-muted">
                      Aucun contenu a examiner pour cet utilisateur.
                    </div>
                  )}
                </>
              )}
            </div>

            <footer className="shrink-0 border-t border-theme p-5 pb-[max(1.25rem,env(safe-area-inset-bottom))]">
              <button
                type="button"
                onClick={() => setConfirmUser(displayUser)}
                disabled={isSelf || deleting}
                className="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-red-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-red-600 disabled:cursor-not-allowed disabled:opacity-50"
              >
                <Trash2 className="h-4 w-4" />
                {isSelf ? 'Suppression de votre compte interdite' : 'Supprimer le compte utilisateur'}
              </button>
            </footer>
          </MotionAside>

          <AnimatePresence>
            {confirmUser && (
              <DoubleConfirmModal
                user={confirmUser}
                deleting={deleting}
                onCancel={() => setConfirmUser(null)}
                onConfirm={handleDelete}
              />
            )}
          </AnimatePresence>
        </>
      )}
    </AnimatePresence>
    ,
    portalTarget
  );
}


