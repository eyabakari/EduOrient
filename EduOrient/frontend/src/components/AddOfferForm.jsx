import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import api from '../api/axios';
import { useNotification } from '../context/NotificationContext';

/**
 * Formulaire recruteur : publier une offre (stage / emploi) avec compétences requises.
 * POST /api/offers — champs title, description, type, skill_ids (aligné OfferController Laravel).
 *
 * Après succès (2xx) : si `onSuccess` est fourni, il reçoit l’offre créée (ex. `refresh()` pour recharger une liste sur la même page).
 * Sinon `navigate('/recruteur/mes-offres', { replace: true })` — la page « Mes offres » remonte `OfferList`, dont le `useEffect([])` refait un GET /api/offres (données à jour, y compris la nouvelle offre).
 */
export default function AddOfferForm({ onSuccess }) {
  const navigate = useNavigate();
  const { notifySuccess } = useNotification();
  const [title, setTitle] = useState('');
  const [description, setDescription] = useState('');
  const [type, setType] = useState('stage');
  const [skillIds, setSkillIds] = useState([]);
  const [skills, setSkills] = useState([]);
  const [loadingSkills, setLoadingSkills] = useState(true);
  const [submitting, setSubmitting] = useState(false);
  const [error, setError] = useState(null);

  useEffect(() => {
    let cancelled = false;
    (async () => {
      try {
        const { data } = await api.get('/all-skills');
        const list = Array.isArray(data?.data) ? data.data : data;
        if (!cancelled) setSkills(list || []);
      } catch {
        if (!cancelled) setError('Impossible de charger les compétences.');
      } finally {
        if (!cancelled) setLoadingSkills(false);
      }
    })();
    return () => {
      cancelled = true;
    };
  }, []);

  function toggleSkill(id) {
    setSkillIds((prev) =>
      prev.includes(id) ? prev.filter((x) => x !== id) : [...prev, id]
    );
  }

  async function handleSubmit(e) {
    e.preventDefault();
    setError(null);
    if (!title.trim()) {
      setError('Le titre est obligatoire.');
      return;
    }
    if (skillIds.length === 0) {
      setError('Sélectionnez au moins une compétence.');
      return;
    }
    setSubmitting(true);
    try {
      const { data } = await api.post('/offers', {
        title: title.trim(),
        description: description.trim() || null,
        type,
        skill_ids: skillIds,
      });
      const offer = data?.data;
      setTitle('');
      setDescription('');
      setType('stage');
      setSkillIds([]);
      notifySuccess('Offre publiée avec succès.');
      if (typeof onSuccess === 'function') {
        onSuccess(offer);
      } else {
        navigate('/recruteur/mes-offres', { replace: true });
      }
    } catch (err) {
      const msg =
        err.response?.data?.message ||
        (err.response?.data?.errors &&
          Object.values(err.response.data.errors).flat().join(' ')) ||
        'Publication impossible.';
      setError(msg);
    } finally {
      setSubmitting(false);
    }
  }

  const fieldClass =
    'w-full rounded-xl border border-theme bg-card px-3 py-2.5 text-sm text-body placeholder:text-muted shadow-sm focus:border-[var(--primary)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]/25 transition';

  return (
    <form
      onSubmit={handleSubmit}
      className="mx-auto max-w-2xl space-y-6 rounded-2xl border border-theme bg-card p-6 shadow-theme"
    >
      <h2 className="text-lg font-semibold text-body">Détails de l&apos;annonce</h2>

      {error && (
        <div
          className="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-800 dark:border-red-900/60 dark:bg-red-950/40 dark:text-red-200"
          role="alert"
        >
          {error}
        </div>
      )}

      <div>
        <label htmlFor="offer-title" className="mb-1 block text-sm font-medium text-muted">
          Titre
        </label>
        <input
          id="offer-title"
          type="text"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
          className={fieldClass}
          placeholder="Ex. Stage développement web"
          autoComplete="off"
        />
      </div>

      <div>
        <label htmlFor="offer-description" className="mb-1 block text-sm font-medium text-muted">
          Description
        </label>
        <textarea
          id="offer-description"
          value={description}
          onChange={(e) => setDescription(e.target.value)}
          rows={5}
          className={fieldClass}
          placeholder="Missions, durée, profil recherché…"
        />
      </div>

      <div>
        <label htmlFor="offer-type" className="mb-1 block text-sm font-medium text-muted">
          Type
        </label>
        <select id="offer-type" value={type} onChange={(e) => setType(e.target.value)} className={fieldClass}>
          <option value="stage">Stage</option>
          <option value="emploi">Emploi</option>
        </select>
      </div>

      <div>
        <span className="mb-2 block text-sm font-medium text-muted">Compétences requises</span>
        {loadingSkills ? (
          <p className="text-sm text-muted">Chargement du catalogue…</p>
        ) : (
          <div className="max-h-56 overflow-y-auto rounded-xl border border-theme bg-block/50 p-3">
            <div className="flex flex-wrap gap-2">
              {skills.map((s) => {
                const id = s.id;
                const label = s.nom || s.name || `#${id}`;
                const active = skillIds.includes(id);
                return (
                  <button
                    key={id}
                    type="button"
                    onClick={() => toggleSkill(id)}
                    className={`rounded-full border px-3 py-1 text-sm font-medium transition ${
                      active
                        ? 'border-transparent bg-primary text-white shadow-sm'
                        : 'border-transparent bg-card text-body ring-1 ring-[var(--border)] hover:ring-[var(--primary)]/30'
                    }`}
                  >
                    {label}
                  </button>
                );
              })}
            </div>
          </div>
        )}
        <p className="mt-1 text-xs text-muted">
          {skillIds.length} compétence{skillIds.length !== 1 ? 's' : ''} sélectionnée
          {skillIds.length !== 1 ? 's' : ''}
        </p>
      </div>

      <div className="flex justify-end">
        <button
          type="submit"
          disabled={submitting || loadingSkills}
          className="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-theme transition disabled:cursor-not-allowed disabled:opacity-60"
        >
          <PlusCircleIcon className="h-5 w-5 shrink-0" aria-hidden />
          {submitting ? 'Publication…' : 'Publier'}
        </button>
      </div>
    </form>
  );
}

function PlusCircleIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden>
      <path
        strokeLinecap="round"
        strokeLinejoin="round"
        strokeWidth={2}
        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
      />
    </svg>
  );
}


