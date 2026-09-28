import { useEffect, useState, useCallback } from 'react';
import api from '../api/axios';
import { useNotification } from '../context/NotificationContext';

/**
 * Liste des offres du recruteur (GET /api/offers), avec modification (PUT) et suppression (DELETE).
 * Les retours utilisateur (succès / erreur) passent par le système global de notifications.
 */
export default function OfferList() {
  const { notifySuccess, notifyError } = useNotification();
  const [offers, setOffers] = useState([]);
  const [allSkills, setAllSkills] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [editingId, setEditingId] = useState(null);
  const [draft, setDraft] = useState(null);
  const [savingId, setSavingId] = useState(null);
  const [deletingId, setDeletingId] = useState(null);

  const loadData = useCallback(async () => {
    setLoading(true);
    setError(null);
    try {
      const [offRes, skillRes] = await Promise.all([api.get('/offers'), api.get('/all-skills')]);
      const list = Array.isArray(offRes.data?.data) ? offRes.data.data : [];
      const skills = Array.isArray(skillRes.data?.data) ? skillRes.data.data : [];
      setOffers(list);
      setAllSkills(skills);
    } catch (err) {
      setError(err.response?.data?.message || 'Impossible de charger vos offres.');
      setOffers([]);
      setAllSkills([]);
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    loadData();
  }, [loadData]);

  function startEdit(offre) {
    setEditingId(offre.id);
    setDraft({
      titre: offre.titre ?? '',
      description: offre.description ?? '',
      type: offre.type === 'emploi' ? 'emploi' : 'stage',
      skill_ids: Array.isArray(offre.skills) ? offre.skills.map((s) => s.id) : [],
    });
  }

  function cancelEdit() {
    setEditingId(null);
    setDraft(null);
  }

  async function saveEdit(offreId) {
    if (!draft || !draft.titre.trim()) return;
    if (!draft.skill_ids.length) {
      notifyError('Sélectionnez au moins une compétence.');
      return;
    }
    setSavingId(offreId);
    try {
      const { data } = await api.put(`/offers/${offreId}`, {
        titre: draft.titre.trim(),
        description: draft.description.trim() || null,
        type: draft.type,
        skill_ids: draft.skill_ids,
      });
      const updated = data?.data;
      if (updated) {
        setOffers((prev) => prev.map((o) => (o.id === offreId ? { ...o, ...updated, skills: updated.skills ?? o.skills } : o)));
      }
      notifySuccess('Offre mise à jour.');
      cancelEdit();
    } catch (err) {
      const msg =
        err.response?.data?.message ||
        (err.response?.data?.errors && Object.values(err.response.data.errors).flat().join(' ')) ||
        'Enregistrement impossible.';
      notifyError(msg);
    } finally {
      setSavingId(null);
    }
  }

  async function removeOffer(offre) {
    if (!window.confirm(`Supprimer l’offre « ${offre.titre} » ? Cette action est définitive.`)) return;
    setDeletingId(offre.id);
    try {
      await api.delete(`/offers/${offre.id}`);
      setOffers((prev) => prev.filter((o) => o.id !== offre.id));
      if (editingId === offre.id) cancelEdit();
      notifySuccess('Offre supprimée.');
    } catch (err) {
      const msg = err.response?.data?.message || 'Suppression impossible.';
      notifyError(msg);
    } finally {
      setDeletingId(null);
    }
  }

  function toggleSkillInDraft(skillId) {
    setDraft((d) => {
      if (!d) return d;
      const has = d.skill_ids.includes(skillId);
      return {
        ...d,
        skill_ids: has ? d.skill_ids.filter((id) => id !== skillId) : [...d.skill_ids, skillId],
      };
    });
  }

  if (loading) {
    return (
      <p className="rounded-2xl border border-theme bg-card px-4 py-8 text-center text-sm text-muted shadow-theme">
        Chargement de vos offres…
      </p>
    );
  }

  if (error) {
    return (
      <div
        className="rounded-2xl border border-red-200 bg-red-50 px-4 py-4 text-sm text-red-800 dark:border-red-900/50 dark:bg-red-950/30 dark:text-red-200"
        role="alert"
      >
        {error}
      </div>
    );
  }

  if (offers.length === 0) {
    return (
      <div className="rounded-2xl border border-theme bg-card p-8 text-center shadow-theme">
        <p className="text-body font-medium">Aucune offre publiée pour le moment</p>
        <p className="mt-2 text-sm text-muted leading-relaxed">
          Créez une première annonce pour la voir apparaître ici.
        </p>
      </div>
    );
  }

  const fieldClass =
    'w-full rounded-xl border border-theme bg-card px-3 py-2 text-sm text-body placeholder:text-muted focus:border-[var(--primary)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]/25';

  return (
    <div className="space-y-3">
      <ul className="space-y-3">
      {offers.map((offre) => {
        const isEditing = editingId === offre.id;
        return (
          <li
            key={offre.id}
            className="rounded-2xl border border-theme bg-card p-4 shadow-theme transition hover:border-[var(--primary)]/25"
          >
            {!isEditing ? (
              <>
                <div className="flex flex-wrap items-start justify-between gap-2">
                  <h2 className="text-base font-semibold text-body">{offre.titre}</h2>
                  <div className="flex flex-wrap items-center gap-2">
                    <span className="shrink-0 rounded-full bg-[var(--primary)]/10 px-2.5 py-0.5 text-xs font-medium capitalize text-[var(--primary)]">
                      {offre.type === 'emploi' ? 'Emploi' : 'Stage'}
                    </span>
                    <button
                      type="button"
                      onClick={() => startEdit(offre)}
                      className="rounded-lg border border-theme bg-card px-2.5 py-1 text-xs font-medium text-body transition hover:bg-block"
                    >
                      Modifier
                    </button>
                    <button
                      type="button"
                      onClick={() => removeOffer(offre)}
                      disabled={deletingId === offre.id}
                      className="rounded-lg border border-red-200 bg-red-50 px-2.5 py-1 text-xs font-medium text-red-800 transition hover:bg-red-100 disabled:opacity-50 dark:border-red-900/50 dark:bg-red-950/40 dark:text-red-200"
                    >
                      {deletingId === offre.id ? 'Suppression…' : 'Supprimer'}
                    </button>
                  </div>
                </div>
                {offre.description ? (
                  <p className="mt-2 line-clamp-2 text-sm text-muted">{offre.description}</p>
                ) : null}
                {Array.isArray(offre.skills) && offre.skills.length > 0 ? (
                  <div className="mt-3 flex flex-wrap gap-1.5">
                    {offre.skills.map((s) => (
                      <span
                        key={s.id}
                        className="rounded-full bg-block px-2 py-0.5 text-xs font-medium text-body ring-1 ring-[var(--border)]"
                      >
                        {s.nom}
                      </span>
                    ))}
                  </div>
                ) : null}
                <p className="mt-2 text-xs text-muted">
                  {offre.is_active === false ? 'Inactive' : 'Active'}
                  {offre.lieu ? ` · ${offre.lieu}` : ''}
                </p>
              </>
            ) : (
              <div className="space-y-3 border-t border-theme pt-3 first:border-t-0 first:pt-0">
                <p className="text-xs font-medium uppercase tracking-wide text-muted">Modifier l&apos;offre</p>
                <div>
                  <label className="mb-1 block text-xs font-medium text-muted">Titre</label>
                  <input
                    type="text"
                    value={draft.titre}
                    onChange={(e) => setDraft((d) => ({ ...d, titre: e.target.value }))}
                    className={fieldClass}
                  />
                </div>
                <div>
                  <label className="mb-1 block text-xs font-medium text-muted">Description</label>
                  <textarea
                    value={draft.description}
                    onChange={(e) => setDraft((d) => ({ ...d, description: e.target.value }))}
                    rows={3}
                    className={fieldClass}
                  />
                </div>
                <div>
                  <label className="mb-1 block text-xs font-medium text-muted">Type</label>
                  <select
                    value={draft.type}
                    onChange={(e) => setDraft((d) => ({ ...d, type: e.target.value }))}
                    className={fieldClass}
                  >
                    <option value="stage">Stage</option>
                    <option value="emploi">Emploi</option>
                  </select>
                </div>
                <div>
                  <span className="mb-1 block text-xs font-medium text-muted">Compétences</span>
                  <div className="max-h-40 overflow-y-auto rounded-xl border border-theme bg-block/50 p-2">
                    <div className="flex flex-wrap gap-1.5">
                      {allSkills.map((s) => {
                        const active = draft.skill_ids.includes(s.id);
                        return (
                          <button
                            key={s.id}
                            type="button"
                            onClick={() => toggleSkillInDraft(s.id)}
                            className={`rounded-full px-2.5 py-0.5 text-xs font-medium transition ${
                              active
                                ? 'bg-primary text-white'
                                : 'bg-card text-body ring-1 ring-[var(--border)]'
                            }`}
                          >
                            {s.nom}
                          </button>
                        );
                      })}
                    </div>
                  </div>
                </div>
                <div className="flex flex-wrap justify-end gap-2 pt-1">
                  <button
                    type="button"
                    onClick={cancelEdit}
                    disabled={savingId === offre.id}
                    className="rounded-xl border border-theme bg-card px-3 py-2 text-sm font-medium text-muted transition hover:bg-block disabled:opacity-50"
                  >
                    Annuler
                  </button>
                  <button
                    type="button"
                    onClick={() => saveEdit(offre.id)}
                    disabled={savingId === offre.id}
                    className="rounded-xl bg-primary px-3 py-2 text-sm font-semibold text-white transition disabled:opacity-50"
                  >
                    {savingId === offre.id ? 'Enregistrement…' : 'Enregistrer'}
                  </button>
                </div>
              </div>
            )}
          </li>
        );
      })}
      </ul>
    </div>
  );
}


