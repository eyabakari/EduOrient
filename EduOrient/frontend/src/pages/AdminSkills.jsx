import { useState, useEffect } from 'react';
import { Navigate } from 'react-router-dom';
import { motion, AnimatePresence } from 'framer-motion';
import DashboardLayout from '../components/DashboardLayout';
import { useAuth } from '../context/AuthContext';
import { useNotification } from '../context/NotificationContext';
import api from '../api/axios';

const ADMIN_ROLE = 'admin';

export default function AdminSkills() {
  const { user } = useAuth();
  const { notifySuccess, notifyError } = useNotification();
  const [skills, setSkills] = useState([]);
  const [categories, setCategories] = useState([]);
  const [meta, setMeta] = useState({ current_page: 1, last_page: 1, per_page: 20, total: 0 });
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [editSkill, setEditSkill] = useState(null);
  const [editNom, setEditNom] = useState('');
  const [editCategorie, setEditCategorie] = useState('');
  const [savingId, setSavingId] = useState(null);
  const [confirmDelete, setConfirmDelete] = useState(null);
  const [deletingId, setDeletingId] = useState(null);
  const [addOpen, setAddOpen] = useState(false);
  const [newNom, setNewNom] = useState('');
  const [newCategorie, setNewCategorie] = useState('');
  const [addingId, setAddingId] = useState(null);

  const isAdmin = user?.role?.name === ADMIN_ROLE;

  const fetchSkills = (page = 1) => {
    setLoading(true);
    setError(null);
    api
      .get('/admin/skills', { params: { page, per_page: 20 } })
      .then((res) => {
        const loadedSkills = res.data?.data ?? [];
        setSkills(loadedSkills);
        setMeta(res.data?.meta ?? { current_page: 1, last_page: 1, per_page: 20, total: 0 });
      })
      .catch((err) => {
        setSkills([]);
        setError(
          err.response?.status === 403
            ? 'Accès refusé. Réservé aux administrateurs.'
            : err.response?.data?.message || 'Erreur lors du chargement.'
        );
      })
      .finally(() => setLoading(false));
  };

  const fetchCategories = () => {
    api.get('/admin/skills/categories')
      .then((res) => {
        const list = res.data?.data ?? [];
        setCategories(list);
      })
      .catch(() => {
        setCategories([]);
      });
  };

  useEffect(() => {
    if (!isAdmin) return;
    fetchSkills(1);
    fetchCategories();
  }, [isAdmin]);

  useEffect(() => {
    if (!newCategorie && categories.length > 0) {
      setNewCategorie(categories[0]);
    }
    if (!editCategorie && categories.length > 0) {
      setEditCategorie(categories[0]);
    }
  }, [categories]);

  const handlePageChange = (page) => {
    if (page >= 1 && page <= meta.last_page) fetchSkills(page);
  };

  const openEdit = (skill) => {
    setEditSkill(skill);
    setEditNom(skill.nom ?? '');
    const cat = skill.category || skill.categorie || '';
    setEditCategorie(cat);
  };

  const handleSaveEdit = (e) => {
    e?.preventDefault();
    if (!editSkill || !editNom.trim()) return;
    setSavingId(editSkill.id);
    api
      .put(`/admin/skills/${editSkill.id}`, { nom: editNom.trim(), categorie: editCategorie })
      .then(() => {
        notifySuccess('Compétence mise à jour.');
        setEditSkill(null);
        setEditNom('');
        setEditCategorie(categories[0] ?? '');
        fetchSkills(meta.current_page);
        fetchCategories();
      })
      .catch((err) => {
        notifyError(err.response?.data?.message || err.response?.data?.errors?.nom?.[0] || 'Erreur.');
      })
      .finally(() => setSavingId(null));
  };

  const handleAddSkill = (e) => {
    e?.preventDefault();
    if (!newNom.trim()) return;
    setAddingId(true);
    api
      .post('/admin/skills', { nom: newNom.trim(), categorie: newCategorie })
      .then(() => {
        notifySuccess('Compétence ajoutée.');
        setAddOpen(false);
        setNewNom('');
        setNewCategorie(categories[0] ?? '');
        fetchSkills(1);
        fetchCategories();
      })
      .catch((err) => {
        const msg = err.response?.data?.message || err.response?.data?.errors?.nom?.[0] || 'Erreur lors de l\'ajout.';
        notifyError(msg);
      })
      .finally(() => setAddingId(null));
  };

  const handleConfirmDelete = () => {
    if (!confirmDelete) return;
    setDeletingId(confirmDelete.id);
    api
      .delete(`/admin/skills/${confirmDelete.id}`)
      .then(() => {
        notifySuccess('Compétence supprimée.');
        setConfirmDelete(null);
        fetchSkills(meta.current_page);
        fetchCategories();
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
          <div className="mx-auto max-w-5xl">
            <motion.header
              initial={{ opacity: 0, y: 8 }}
              animate={{ opacity: 1, y: 0 }}
              className="mb-8"
            >
              <div className="flex items-center gap-3 mb-2">
                <span className="h-1 w-12 rounded-full bg-[var(--primary)]" />
                <h1 className="text-2xl md:text-3xl font-bold text-body tracking-tight">Dictionnaire des compétences</h1>
              </div>
              <p className="text-muted text-sm md:text-base ml-14">Gérer les compétences disponibles pour les étudiants et les projets.</p>
            </motion.header>

            <div className="mb-6 flex flex-wrap items-center gap-3">
              <button
                type="button"
                onClick={() => setAddOpen(true)}
                className="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-medium text-white hover:opacity-90 transition"
              >
                <span>+ Ajouter une compétence</span>
              </button>
            </div>

            {error && (
              <div className="mb-6 rounded-2xl border border-amber-200 bg-amber-50 p-4 text-amber-800 dark:border-amber-900/50 dark:bg-amber-950/40 dark:text-amber-100">
                {error}
              </div>
            )}

            <div className="overflow-hidden rounded-2xl border border-theme bg-card shadow-theme">
              {loading ? (
                <div className="p-12 text-center text-muted">Chargement…</div>
              ) : skills.length === 0 ? (
                <div className="p-12 text-center text-muted">Aucune compétence.</div>
              ) : (
                <div className="overflow-x-auto">
                  <table className="w-full min-w-[520px]">
                    <thead>
                      <tr className="border-b border-theme bg-block">
                        <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted" style={{ minWidth: '220px' }}>Nom</th>
                        <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted">Catégorie</th>
                        <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted">Étudiants</th>
                        <th className="px-5 py-4 text-left text-xs font-semibold uppercase tracking-wider text-muted">Projets</th>
                        <th className="px-5 py-4 text-right text-xs font-semibold uppercase tracking-wider text-muted">Actions</th>
                      </tr>
                    </thead>
                    <tbody className="divide-y divide-[var(--border)]">
                      {skills.map((s) => (
                        <tr key={s.id} className="transition hover:bg-block">
                          <td className="px-5 py-4 font-medium text-body break-words" style={{ minWidth: '220px', wordBreak: 'break-word' }} title={s.nom ?? ''}>{s.nom ?? '—'}</td>
                          <td className="px-5 py-4 text-sm text-muted">{s.category || s.categorie || '—'}</td>
                          <td className="px-5 py-4 text-sm text-muted">{s.candidats_count ?? 0}</td>
                          <td className="px-5 py-4 text-sm text-muted">{s.projects_count ?? 0}</td>
                          <td className="px-5 py-4 text-right">
                            <div className="flex justify-end gap-2">
                              <button
                                type="button"
                                onClick={() => openEdit(s)}
                                disabled={savingId !== null}
                                className="rounded-xl border border-theme bg-card px-4 py-2 text-sm font-medium text-body disabled:opacity-50 transition"
                              >
                                Modifier
                              </button>
                              <button
                                type="button"
                                onClick={() => setConfirmDelete(s)}
                                disabled={deletingId !== null}
                                className="rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-100 disabled:opacity-50 transition dark:border-red-900/55 dark:bg-red-950/45 dark:text-red-300 dark:hover:bg-red-900/55"
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
                    Page {meta.current_page} / {meta.last_page} ({meta.total} compétences)
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
        {addOpen && (
          <motion.div key="add-skill-modal" initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }} className="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div className="absolute inset-0 bg-black/60 backdrop-blur-sm" onClick={() => !addingId && setAddOpen(false)} aria-hidden />
            <motion.div initial={{ opacity: 0, scale: 0.95 }} animate={{ opacity: 1, scale: 1 }} exit={{ opacity: 0, scale: 0.95 }} className="relative w-full max-w-md rounded-2xl border border-theme bg-card p-6 shadow-theme">
              <h3 className="text-lg font-semibold text-body">Ajouter une compétence</h3>
              <form onSubmit={handleAddSkill} className="mt-4 space-y-4">
                <div>
                  <label className="block text-sm font-medium text-body mb-2">Nom</label>
                  <input
                    type="text"
                    value={newNom}
                    onChange={(e) => setNewNom(e.target.value)}
                    required
                    className="w-full rounded-xl border border-theme bg-block px-4 py-2.5 text-body placeholder-[var(--muted)] focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--primary)]/25 focus:outline-none"
                    placeholder="Ex. React, Communication..."
                  />
                </div>
                <div>
                  <label className="block text-sm font-medium text-body mb-2">Catégorie</label>
                  <select
                    value={newCategorie}
                    onChange={(e) => setNewCategorie(e.target.value)}
                    className="w-full rounded-xl border border-theme bg-block px-4 py-2.5 text-body focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--primary)]/25 focus:outline-none"
                  >
                    {categories.length === 0 ? (
                      <option value="">Sélectionner une catégorie</option>
                    ) : (
                      categories.map((c) => (
                        <option key={c} value={c}>{c}</option>
                      ))
                    )}
                  </select>
                </div>
                <div className="mt-6 flex justify-end gap-3">
                  <button type="button" onClick={() => setAddOpen(false)} disabled={addingId !== null} className="rounded-xl border border-theme bg-block px-4 py-2.5 text-sm font-medium text-body disabled:opacity-50 transition">
                    Annuler
                  </button>
                  <button type="submit" disabled={!newNom.trim() || addingId !== null} className="rounded-xl bg-primary px-4 py-2.5 text-sm font-medium text-white disabled:opacity-70 transition">
                    {addingId !== null ? 'Ajout…' : 'Ajouter'}
                  </button>
                </div>
              </form>
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>

      <AnimatePresence>
        {editSkill && (
          <motion.div initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }} className="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div className="absolute inset-0 bg-black/60 backdrop-blur-sm" onClick={() => !savingId && setEditSkill(null)} aria-hidden />
            <motion.div initial={{ opacity: 0, scale: 0.95 }} animate={{ opacity: 1, scale: 1 }} exit={{ opacity: 0, scale: 0.95 }} className="relative w-full max-w-md rounded-2xl border border-theme bg-card p-6 shadow-theme">
              <h3 className="text-lg font-semibold text-body">Modifier la compétence</h3>
              <form onSubmit={handleSaveEdit} className="mt-4 space-y-4">
                <div>
                  <label className="block text-sm font-medium text-body mb-2">Nom</label>
                  <input
                    type="text"
                    value={editNom}
                    onChange={(e) => setEditNom(e.target.value)}
                    required
                    className="w-full rounded-xl border border-theme bg-block px-4 py-2.5 text-body placeholder-[var(--muted)] focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--primary)]/25 focus:outline-none"
                    placeholder="Ex. React"
                  />
                </div>
                <div>
                  <label className="block text-sm font-medium text-body mb-2">Catégorie</label>
                  <select
                    value={editCategorie}
                    onChange={(e) => setEditCategorie(e.target.value)}
                    className="w-full rounded-xl border border-theme bg-block px-4 py-2.5 text-body focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--primary)]/25 focus:outline-none"
                  >
                    {categories.length === 0 ? (
                      <option value="">Sélectionner une catégorie</option>
                    ) : (
                      categories.map((c) => (
                        <option key={c} value={c}>{c}</option>
                      ))
                    )}
                  </select>
                </div>
                <div className="mt-6 flex justify-end gap-3">
                  <button type="button" onClick={() => setEditSkill(null)} disabled={savingId !== null} className="rounded-xl border border-theme bg-block px-4 py-2.5 text-sm font-medium text-body disabled:opacity-50 transition">
                  Annuler
                </button>
                  <button type="submit" disabled={!editNom.trim() || savingId !== null} className="rounded-xl bg-primary px-4 py-2.5 text-sm font-medium text-white disabled:opacity-70 transition">
                    {savingId !== null ? 'Enregistrement…' : 'Enregistrer'}
                  </button>
                </div>
              </form>
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>

      <AnimatePresence>
        {confirmDelete && (
          <motion.div initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }} className="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div className="absolute inset-0 bg-black/60 backdrop-blur-sm" onClick={() => !deletingId && setConfirmDelete(null)} aria-hidden />
            <motion.div initial={{ opacity: 0, scale: 0.95 }} animate={{ opacity: 1, scale: 1 }} exit={{ opacity: 0, scale: 0.95 }} className="relative w-full max-w-md rounded-2xl border border-theme bg-card p-6 shadow-theme">
              <h3 className="text-lg font-semibold text-body">Confirmer la suppression</h3>
              <p className="mt-2 text-sm text-muted">
                Supprimer la compétence <strong className="text-body">« {confirmDelete.nom} »</strong> ? Elle sera retirée de tous les projets et profils. Cette action est irréversible.
              </p>
              <div className="mt-6 flex justify-end gap-3">
                <button type="button" onClick={() => setConfirmDelete(null)} disabled={deletingId !== null} className="rounded-xl border border-theme bg-block px-4 py-2.5 text-sm font-medium text-body disabled:opacity-50 transition">
                  Annuler
                </button>
                <button type="button" onClick={handleConfirmDelete} disabled={deletingId !== null} className="rounded-xl bg-red-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-600 disabled:opacity-70 transition">
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



