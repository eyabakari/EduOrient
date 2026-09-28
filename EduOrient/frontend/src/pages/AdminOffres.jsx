import { useState, useEffect } from 'react';
import { Navigate } from 'react-router-dom';
import { motion, AnimatePresence } from 'framer-motion';
import DashboardLayout from '../components/DashboardLayout';
import { useAuth } from '../context/AuthContext';
import { useNotification } from '../context/NotificationContext';
import api from '../api/axios';

const ADMIN_ROLE = 'admin';

function formatDate(str) {
  if (!str) return '—';
  try {
    return new Date(str).toLocaleDateString('fr-FR', {
      day: '2-digit',
      month: 'short',
      year: 'numeric',
    });
  } catch {
    return '—';
  }
}

function typeLabel(type) {
  if (type === 'stage') return 'Stage';
  if (type === 'emploi') return 'Emploi';
  return type || '—';
}

export default function AdminOffres() {
  const { user } = useAuth();
  const { notifySuccess, notifyError } = useNotification();
  const [offres, setOffres] = useState([]);
  const [meta, setMeta] = useState({ current_page: 1, last_page: 1, per_page: 15, total: 0 });
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [confirmDelete, setConfirmDelete] = useState(null);
  const [deletingId, setDeletingId] = useState(null);
  const [togglingId, setTogglingId] = useState(null);

  const isAdmin = user?.role?.name === ADMIN_ROLE;

  const fetchOffres = (page = 1) => {
    setLoading(true);
    setError(null);
    api
      .get('/admin/offres', { params: { page, per_page: 15 } })
      .then((res) => {
        setOffres(res.data?.data ?? []);
        setMeta(res.data?.meta ?? { current_page: 1, last_page: 1, per_page: 15, total: 0 });
      })
      .catch((err) => {
        setOffres([]);
        setError(
          err.response?.status === 403
            ? 'Accès refusé. Réservé aux administrateurs.'
            : err.response?.data?.message || 'Erreur lors du chargement.'
        );
      })
      .finally(() => setLoading(false));
  };

  useEffect(() => {
    if (!isAdmin) return;
    fetchOffres(1);
  }, [isAdmin]);

  const handlePageChange = (page) => {
    if (page >= 1 && page <= meta.last_page) fetchOffres(page);
  };

  const handleToggleActive = (offre) => {
    const next = !offre.is_active;
    setTogglingId(offre.id);
    api
      .patch(`/admin/offres/${offre.id}`, { is_active: next })
      .then((res) => {
        const updated = res.data?.data;
        setOffres((prev) =>
          prev.map((o) => (o.id === offre.id ? { ...o, ...updated, is_active: updated?.is_active ?? next } : o))
        );
        notifySuccess(next ? 'Offre activée.' : 'Offre désactivée.');
      })
      .catch((err) => {
        notifyError(err.response?.data?.message || 'Erreur lors de la mise à jour.');
      })
      .finally(() => setTogglingId(null));
  };

  const handleConfirmDelete = () => {
    if (!confirmDelete) return;
    setDeletingId(confirmDelete.id);
    api
      .delete(`/admin/offres/${confirmDelete.id}`)
      .then(() => {
        notifySuccess('Offre supprimée.');
        setConfirmDelete(null);
        fetchOffres(meta.current_page);
      })
      .catch((err) => {
        notifyError(err.response?.data?.message || 'Erreur lors de la suppression.');
      })
      .finally(() => setDeletingId(null));
  };

  if (!isAdmin) {
    return <Navigate to="/dashboard" replace />;
  }

  return (
    <DashboardLayout>
      <div className="mx-auto max-w-6xl">
        <motion.header initial={{ opacity: 0, y: 8 }} animate={{ opacity: 1, y: 0 }} className="mb-8">
          <div className="flex items-center gap-3 mb-2">
            <span className="h-1 w-12 rounded-full bg-[var(--primary)]" />
            <h1 className="text-2xl md:text-3xl font-bold text-body tracking-tight">Gestion des offres</h1>
          </div>
          <p className="text-muted text-sm md:text-base ml-14">
            Consulter, activer ou désactiver et supprimer les offres publiées par les recruteurs.
          </p>
        </motion.header>

        {error && (
          <div className="mb-6 rounded-2xl border border-amber-200 bg-amber-50 p-4 text-amber-800 dark:border-amber-900/50 dark:bg-amber-950/40 dark:text-amber-100">
            {error}
          </div>
        )}

        <div className="overflow-hidden rounded-2xl border border-theme bg-card shadow-theme">
          {loading ? (
            <div className="p-12 text-center text-muted">Chargement…</div>
          ) : offres.length === 0 ? (
            <div className="p-12 text-center text-muted">Aucune offre.</div>
          ) : (
            <div className="overflow-x-auto">
              <table className="w-full min-w-[880px]">
                <thead>
                  <tr className="border-b border-theme bg-block">
                    <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted">Offre</th>
                    <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted">Type</th>
                    <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted">Recruteur</th>
                    <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted">Statut</th>
                    <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted">Compétences</th>
                    <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted">Date</th>
                    <th className="px-5 py-4 text-right text-xs font-semibold uppercase tracking-wider text-muted">Actions</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-[var(--border)]">
                  {offres.map((offre) => (
                    <tr key={offre.id} className="transition hover:bg-block">
                      <td className="px-5 py-4">
                        <p className="font-medium text-body line-clamp-1">{offre.titre || '—'}</p>
                        <p className="text-xs text-muted line-clamp-2 mt-0.5">{offre.description || '—'}</p>
                        {offre.lieu && <p className="text-xs text-muted mt-1">{offre.lieu}</p>}
                      </td>
                      <td className="px-5 py-4 text-sm text-muted">{typeLabel(offre.type)}</td>
                      <td className="px-5 py-4 text-sm text-muted">
                        <span className="font-medium text-body">{offre.recruteur?.entreprise ?? '—'}</span>
                        {offre.recruteur?.user?.name && (
                          <span className="block text-xs text-muted">{offre.recruteur.user.name}</span>
                        )}
                        {offre.recruteur?.user?.email && (
                          <span className="block text-xs text-muted">{offre.recruteur.user.email}</span>
                        )}
                      </td>
                      <td className="px-5 py-4">
                        <span
                          className={`inline-flex rounded-lg border px-2.5 py-1 text-xs font-medium ${
                            offre.is_active
                              ? 'border-emerald-200 bg-emerald-50 text-emerald-800'
                              : 'border-theme bg-block text-muted'
                          }`}
                        >
                          {offre.is_active ? 'Active' : 'Inactive'}
                        </span>
                      </td>
                      <td className="px-5 py-4">
                        <div className="flex flex-wrap gap-1.5">
                          {(offre.skills || []).slice(0, 4).map((s) => (
                            <span key={s.id} className="rounded-lg border border-theme bg-block px-2 py-0.5 text-xs text-muted">
                              {s.nom}
                            </span>
                          ))}
                          {(offre.skills?.length ?? 0) > 4 && (
                            <span className="text-xs text-muted">+{offre.skills.length - 4}</span>
                          )}
                        </div>
                      </td>
                      <td className="px-5 py-4 text-sm text-muted">{formatDate(offre.created_at)}</td>
                      <td className="px-5 py-4 text-right">
                        <div className="flex flex-wrap justify-end gap-2">
                          <button
                            type="button"
                            onClick={() => handleToggleActive(offre)}
                            disabled={togglingId !== null || deletingId !== null}
                            className="rounded-xl border border-theme bg-card px-3 py-2 text-sm font-medium text-body hover:bg-block disabled:opacity-50 transition"
                          >
                            {togglingId === offre.id ? '…' : offre.is_active ? 'Désactiver' : 'Activer'}
                          </button>
                          <button
                            type="button"
                            onClick={() => setConfirmDelete(offre)}
                            disabled={deletingId !== null || togglingId !== null}
                            className="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-100 disabled:opacity-50 transition dark:border-red-900/55 dark:bg-red-950/45 dark:text-red-300 dark:hover:bg-red-900/55"
                          >
                            Supprimer
                          </button>
                        </div>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          )}

          {meta.last_page > 1 && (
            <div className="flex items-center justify-between border-t border-theme px-5 py-4 bg-block">
              <p className="text-sm text-muted">
                Page {meta.current_page} / {meta.last_page} ({meta.total} offres)
              </p>
              <div className="flex gap-2">
                <button
                  type="button"
                  onClick={() => handlePageChange(meta.current_page - 1)}
                  disabled={meta.current_page <= 1}
                  className="rounded-xl border border-theme bg-card px-4 py-2 text-sm font-medium text-body disabled:opacity-50 transition"
                >
                  Précédent
                </button>
                <button
                  type="button"
                  onClick={() => handlePageChange(meta.current_page + 1)}
                  disabled={meta.current_page >= meta.last_page}
                  className="rounded-xl border border-theme bg-card px-4 py-2 text-sm font-medium text-body disabled:opacity-50 transition"
                >
                  Suivant
                </button>
              </div>
            </div>
          )}
        </div>
      </div>

      <AnimatePresence>
        {confirmDelete && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-50 flex items-center justify-center p-4"
          >
            <div className="absolute inset-0 bg-black/60 backdrop-blur-sm" onClick={() => !deletingId && setConfirmDelete(null)} aria-hidden />
            <motion.div
              initial={{ opacity: 0, scale: 0.95 }}
              animate={{ opacity: 1, scale: 1 }}
              exit={{ opacity: 0, scale: 0.95 }}
              className="relative w-full max-w-md rounded-2xl border border-theme bg-card p-6 shadow-theme"
            >
              <h3 className="text-lg font-semibold text-body">Confirmer la suppression</h3>
              <p className="mt-2 text-sm text-muted">
                Supprimer l’offre <strong className="text-body">« {confirmDelete.titre} »</strong> ? Cette action est irréversible.
              </p>
              <div className="mt-6 flex justify-end gap-3">
                <button
                  type="button"
                  onClick={() => setConfirmDelete(null)}
                  disabled={deletingId !== null}
                  className="rounded-xl border border-theme bg-block px-4 py-2.5 text-sm font-medium text-body disabled:opacity-50 transition"
                >
                  Annuler
                </button>
                <button
                  type="button"
                  onClick={handleConfirmDelete}
                  disabled={deletingId !== null}
                  className="rounded-xl bg-red-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-600 disabled:opacity-70 transition"
                >
                  {deletingId !== null ? 'Suppression…' : 'Supprimer'}
                </button>
              </div>
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>
    </DashboardLayout>
  );
}


