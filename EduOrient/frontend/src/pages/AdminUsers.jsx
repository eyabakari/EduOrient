/* eslint-disable react-hooks/set-state-in-effect */
import { useEffect, useState } from 'react';
import { Navigate } from 'react-router-dom';
import DashboardLayout from '../components/DashboardLayout';
import UserAuditDrawer from '../components/admin/UserAuditDrawer';
import { useAuth } from '../context/AuthContext';
import { useNotification } from '../context/NotificationContext';
import api, { getStorageUrl } from '../api/axios';

const ADMIN_ROLE = 'admin';
const ROLE_LABELS = { admin: 'Admin', etudiant: 'candidat', recruteur: 'Recruteur' };

function formatDate(str) {
  if (!str) return '-';
  try {
    return new Date(str).toLocaleDateString('fr-FR', {
      day: '2-digit',
      month: 'short',
      year: 'numeric',
    });
  } catch {
    return '-';
  }
}

function contentLabel(u) {
  if (u.role?.name === 'candidat') return 'Projets';
  if (u.role?.name === 'recruteur') return 'Offres';
  return '-';
}

export default function AdminUsers() {
  const { user } = useAuth();
  const { notifySuccess, notifyError } = useNotification();
  const [users, setUsers] = useState([]);
  const [meta, setMeta] = useState({ current_page: 1, last_page: 1, per_page: 15, total: 0 });
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [selectedUser, setSelectedUser] = useState(null);

  const isAdmin = user?.role?.name === ADMIN_ROLE;

  const fetchUsers = (page = 1) => {
    setLoading(true);
    setError(null);
    api
      .get('/admin/users', { params: { page, per_page: 15 } })
      .then((res) => {
        setUsers(res.data?.data ?? []);
        setMeta(res.data?.meta ?? { current_page: 1, last_page: 1, per_page: 15, total: 0 });
      })
      .catch((err) => {
        setUsers([]);
        setError(
          err.response?.status === 403
            ? 'Acces refuse. Reserve aux administrateurs.'
            : err.response?.data?.message || 'Erreur lors du chargement.'
        );
      })
      .finally(() => setLoading(false));
  };

  useEffect(() => {
    if (!isAdmin) return;
    fetchUsers(1);
  }, [isAdmin]);

  const handlePageChange = (page) => {
    if (page >= 1 && page <= meta.last_page) fetchUsers(page);
  };

  const handleUserDeleted = () => {
    notifySuccess('Utilisateur supprime.');
    setSelectedUser(null);
    fetchUsers(meta.current_page);
  };

  if (!isAdmin) {
    return <Navigate to="/dashboard" replace />;
  }

  return (
    <DashboardLayout>
      <div className="mx-auto max-w-6xl">
        <header className="mb-8">
          <div className="mb-2 flex items-center gap-3">
            <span className="h-1 w-12 rounded-full bg-[var(--primary)]" />
            <h1 className="text-2xl font-bold tracking-tight text-body md:text-3xl">Gestion des utilisateurs</h1>
          </div>
          <p className="ml-14 text-sm text-muted md:text-base">
            Examiner les comptes et leurs contenus rattaches depuis une seule vue.
          </p>
        </header>

        {error && (
          <div className="mb-6 rounded-2xl border border-amber-200 bg-amber-50 p-4 text-amber-800 dark:border-amber-900/50 dark:bg-amber-950/40 dark:text-amber-100">
            {error}
          </div>
        )}

        <div className="overflow-hidden rounded-2xl border border-theme bg-card shadow-theme">
          {loading ? (
            <div className="p-12 text-center text-muted">Chargement...</div>
          ) : users.length === 0 ? (
            <div className="p-12 text-center text-muted">Aucun utilisateur.</div>
          ) : (
            <div className="overflow-x-auto">
              <table className="w-full min-w-[760px]">
                <thead>
                  <tr className="border-b border-theme bg-block">
                    <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted">Photo</th>
                    <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted">Nom</th>
                    <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted">E-mail</th>
                    <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted">Role</th>
                    <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted">Contenu</th>
                    <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted">Date d'inscription</th>
                    <th className="px-5 py-4 text-right text-xs font-semibold uppercase tracking-wider text-muted">Audit</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-[var(--border)]">
                  {users.map((u) => (
                    <tr
                      key={u.id}
                      onClick={() => setSelectedUser(u)}
                      tabIndex={0}
                      onKeyDown={(event) => {
                        if (event.key === 'Enter' || event.key === ' ') {
                          event.preventDefault();
                          setSelectedUser(u);
                        }
                      }}
                      className="cursor-pointer transition hover:bg-block focus:bg-block focus:outline-none"
                      aria-label={`Examiner ${u.name || u.email || 'utilisateur'}`}
                    >
                      <td className="px-5 py-4">
                        <div className="flex h-10 w-10 items-center justify-center overflow-hidden rounded-full border border-theme bg-block">
                          {u.photo_url ? (
                            <img src={getStorageUrl(u.photo_url)} alt="" className="h-full w-full object-cover" loading="lazy" />
                          ) : (
                            <span className="text-sm font-semibold text-[var(--primary)]">
                              {(u.name || '?').charAt(0).toUpperCase()}
                            </span>
                          )}
                        </div>
                      </td>
                      <td className="px-5 py-4 text-sm font-medium text-body">{u.name || '-'}</td>
                      <td className="px-5 py-4 text-sm text-muted">{u.email || '-'}</td>
                      <td className="px-5 py-4">
                        <span className="inline-flex rounded-lg border border-theme bg-block px-2.5 py-1 text-xs font-medium text-muted">
                          {ROLE_LABELS[u.role?.name] ?? u.role?.name ?? '-'}
                        </span>
                      </td>
                      <td className="px-5 py-4 text-sm text-muted">{contentLabel(u)}</td>
                      <td className="px-5 py-4 text-sm text-muted">{formatDate(u.created_at)}</td>
                      <td className="px-5 py-4 text-right">
                        <button
                          type="button"
                          onClick={(event) => {
                            event.stopPropagation();
                            setSelectedUser(u);
                          }}
                          className="rounded-xl border border-theme bg-card px-4 py-2 text-sm font-medium text-body transition hover:bg-block"
                        >
                          Examiner
                        </button>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          )}

          {meta.last_page > 1 && (
            <div className="flex items-center justify-between border-t border-theme bg-block px-5 py-4">
              <p className="text-sm text-muted">
                Page {meta.current_page} / {meta.last_page} ({meta.total} utilisateurs)
              </p>
              <div className="flex gap-2">
                <button
                  type="button"
                  onClick={() => handlePageChange(meta.current_page - 1)}
                  disabled={meta.current_page <= 1}
                  className="rounded-xl border border-theme bg-card px-4 py-2 text-sm font-medium text-body transition disabled:opacity-50"
                >
                  Precedent
                </button>
                <button
                  type="button"
                  onClick={() => handlePageChange(meta.current_page + 1)}
                  disabled={meta.current_page >= meta.last_page}
                  className="rounded-xl border border-theme bg-card px-4 py-2 text-sm font-medium text-body transition disabled:opacity-50"
                >
                  Suivant
                </button>
              </div>
            </div>
          )}
        </div>
      </div>

      <UserAuditDrawer
        user={selectedUser}
        currentUserId={user?.id}
        isOpen={Boolean(selectedUser)}
        onClose={() => setSelectedUser(null)}
        onDeleted={handleUserDeleted}
        onDeleteError={notifyError}
      />
    </DashboardLayout>
  );
}


