import { useState, useEffect, useMemo } from 'react';
import { Link } from 'react-router-dom';
import DashboardLayout from '../components/DashboardLayout';
import { SkillsPageSkeleton } from '../components/ContentSkeleton';
import { useAuth } from '../context/AuthContext';
import { useNotification } from '../context/NotificationContext';
import api from '../api/axios';

function sortCategories(keys) {
  return [...keys].sort((a, b) => String(a).localeCompare(String(b), 'fr', { sensitivity: 'base' }));
}

function CloseIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
    </svg>
  );
}

function CheckIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden>
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2.5} d="M5 13l4 4L19 7" />
    </svg>
  );
}

function ChevronIcon({ open, className = 'h-5 w-5' }) {
  return (
    <svg
      className={`${className} shrink-0 text-muted transition-transform duration-200 ease-out ${open ? 'rotate-180' : ''}`}
      fill="none"
      stroke="currentColor"
      viewBox="0 0 24 24"
      aria-hidden
    >
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
    </svg>
  );
}

/** Badges catalogue : pastels en clair, contrastes renforcés en mode sombre. */
function skillBadgeClasses(selected, busy, dimmed) {
  const base =
    'inline-flex max-w-full items-center gap-1 rounded-full border px-2.5 py-1 text-xs font-medium transition focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-400/50 focus-visible:ring-offset-1 focus-visible:ring-offset-white dark:focus-visible:ring-offset-slate-900 sm:text-[13px]';
  const selectedCls =
    'border-sky-400/90 bg-sky-100/95 text-sky-900 shadow-sm hover:bg-sky-100 hover:border-sky-500/80 dark:border-sky-500/70 dark:bg-sky-950/85 dark:text-sky-100 dark:hover:border-sky-400 dark:hover:bg-sky-900/80';
  const idleCls =
    'border-slate-200/95 bg-slate-50 text-slate-700 hover:border-slate-300 hover:bg-slate-100/90 dark:border-slate-600 dark:bg-slate-700/95 dark:text-slate-100 dark:hover:border-slate-500 dark:hover:bg-slate-600/95';
  return [
    base,
    selected ? selectedCls : idleCls,
    busy ? 'cursor-wait opacity-80' : '',
    dimmed ? 'opacity-40' : '',
  ].join(' ');
}

export default function Skills() {
  const { user } = useAuth();
  const { notifySuccess, notifyError } = useNotification();
  const [userSkills, setUserSkills] = useState([]);
  const [allSkills, setAllSkills] = useState([]);
  const [langues, setLangues] = useState([]);
  const [loading, setLoading] = useState(true);
  const [langueNom, setLangueNom] = useState('');
  const [langueNiveau, setLangueNiveau] = useState('');
  const [togglingId, setTogglingId] = useState(null);
  const [removingLangueId, setRemovingLangueId] = useState(null);
  const [openCategory, setOpenCategory] = useState(null);

  const fetchUserSkills = () => api.get('/user-skills').then((r) => r.data?.data ?? []).catch(() => []);



  useEffect(() => {
    setLoading(true);
    Promise.all([
      fetchUserSkills(),
      api.get('/all-skills').then((r) => r.data?.data ?? []).catch(() => []),
    ])
      .then(([user, all, lang]) => {
        setUserSkills(user);
        setAllSkills(all);
        setLangues(lang);
      })
      .finally(() => setLoading(false));
  }, []);

  const userSkillIds = useMemo(() => new Set(userSkills.map((s) => s.id)), [userSkills]);

  const { sortedCategories, skillsByCategory } = useMemo(() => {
    const map = new Map();
    for (const s of allSkills) {
      const category = s.category ?? s.categorie ?? '';
      if (!map.has(category)) map.set(category, []);
      map.get(category).push(s);
    }
    for (const arr of map.values()) {
      arr.sort((a, b) => String(a.name || a.nom).localeCompare(String(b.name || b.nom), 'fr', { sensitivity: 'base' }));
    }
    return { sortedCategories: sortCategories([...map.keys()]), skillsByCategory: map };
  }, [allSkills]);

  useEffect(() => {
    if (sortedCategories.length === 0) return;
    setOpenCategory((prev) => {
      if (prev && sortedCategories.includes(prev)) return prev;
      return sortedCategories[0];
    });
  }, [sortedCategories]);

  const selectedSkillsSorted = useMemo(() => {
    return [...userSkills].sort((a, b) =>
      String(a.name || a.nom).localeCompare(String(b.name || b.nom), 'fr', { sensitivity: 'base' })
    );
  }, [userSkills]);

  const handleToggleCatalogSkill = (skill) => {
    const selected = userSkillIds.has(skill.id);
    setTogglingId(skill.id);
    if (selected) {
      api
        .delete(`/user-skills/${skill.id}`)
        .then(() => {
          notifySuccess('Compétence retirée.');
          setUserSkills((prev) => prev.filter((s) => s.id !== skill.id));
        })
        .catch(() => notifyError('Erreur lors de la suppression.'))
        .finally(() => setTogglingId(null));
    } else {
      api
        .post('/user-skills', { skill_id: skill.id, level: 'beginner' })
        .then(() => {
          notifySuccess('Compétence ajoutée.');
          return fetchUserSkills();
        })
        .then(setUserSkills)
        .catch((err) => {
          notifyError(err.response?.data?.message || 'Erreur lors de l\'ajout.');
        })
        .finally(() => setTogglingId(null));
    }
  };

  const handleAccordionHeaderClick = (category) => {
    setOpenCategory((prev) => (prev === category ? null : category));
  };

  const handleAddLangue = (e) => {
    e.preventDefault();
    const nom = langueNom.trim();
    if (!nom) return;
    api
      .post('/langues', { nom, niveau: langueNiveau.trim() || undefined })
      .then(() => {
        notifySuccess('Langue ajoutée.');
        setLangueNom('');
        setLangueNiveau('');
        fetchLangues().then(setLangues);
      })
      .catch((err) => {
        notifyError(err.response?.data?.message || 'Erreur lors de l\'ajout.');
      });
  };

  const handleRemoveLangue = (id) => {
    setRemovingLangueId(id);
    api
      .delete(`/langues/${id}`)
      .then(() => {
        notifySuccess('Langue supprimée.');
        setLangues((prev) => prev.filter((l) => l.id !== id));
      })
      .catch(() => notifyError('Erreur lors de la suppression.'))
      .finally(() => setRemovingLangueId(null));
  };

  return (
    <DashboardLayout>
      <div className="mx-auto max-w-3xl px-3 pb-10 sm:max-w-4xl sm:px-4 lg:max-w-5xl">
        {loading ? (
          <SkillsPageSkeleton />
        ) : (
          <>
            <header className="mb-6 flex flex-col gap-4 sm:mb-8 sm:flex-row sm:flex-wrap sm:items-center sm:justify-between">
              <h1 className="text-xl font-bold tracking-tight text-body sm:text-2xl">Gestion des compétences</h1>
              {user?.candidat?.id != null && (
                <Link
                  to={`/dashboard/portfolio/${user.candidat.id}`}
                  className="inline-flex w-fit items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-medium text-white transition hover:opacity-90"
                >
                  Voir mon portfolio
                  <svg className="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth={2}
                      d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                    />
                  </svg>
                </Link>
              )}
            </header>

            {/* Résumé : sélection uniquement */}
            <section className="mb-6 rounded-2xl border border-theme bg-card p-4 shadow-theme sm:p-6">
              <div className="mb-3 flex items-start justify-between gap-3">
                <div>
                  <h2 className="text-base font-semibold text-body sm:text-lg">Mes compétences sélectionnées</h2>
                  <p className="mt-0.5 text-xs text-muted sm:text-sm">
                    Aperçu rapide de votre profil. Cliquez sur un badge pour le retirer.
                  </p>
                </div>
                <span className="shrink-0 rounded-full border border-theme bg-block px-2.5 py-0.5 text-xs font-medium text-muted">
                  {selectedSkillsSorted.length}
                </span>
              </div>
              {selectedSkillsSorted.length === 0 ? (
                <p className="rounded-xl border border-dashed border-theme bg-block px-4 py-6 text-center text-sm text-muted">
                  Aucune compétence sélectionnée. Ouvrez une catégorie ci-dessous pour en ajouter.
                </p>
              ) : (
                <ul className="flex flex-wrap gap-2" aria-label="Compétences sélectionnées">
                  {selectedSkillsSorted.map((skill) => {
                    const label = skill.name || skill.nom;
                    const busy = togglingId === skill.id;
                    return (
                      <li key={skill.id}>
                        <button
                          type="button"
                          onClick={() => handleToggleCatalogSkill(skill)}
                          disabled={togglingId !== null}
                          className={skillBadgeClasses(true, busy, togglingId !== null && !busy)}
                          title="Retirer du profil"
                        >
                          <CheckIcon className="h-3 w-3 shrink-0 text-sky-600 dark:text-sky-400" />
                          <span className="truncate">{label}</span>
                        </button>
                      </li>
                    );
                  })}
                </ul>
              )}
            </section>

            {/* Catalogue par accordéons */}
            <section className="mb-6 rounded-2xl border border-theme bg-card p-4 shadow-theme sm:p-6">
              <h2 className="text-base font-semibold text-body sm:text-lg">Catalogue par catégorie</h2>
              <p className="mt-1 text-xs text-muted sm:text-sm">
                Une catégorie à la fois : ouvrez un panneau, choisissez vos compétences. Les sélections apparaissent en haut
                de page.
              </p>

              {allSkills.length === 0 ? (
                <p className="mt-4 rounded-xl border border-amber-200/80 bg-amber-50/90 px-4 py-3 text-sm text-amber-900 dark:border-amber-900/50 dark:bg-amber-950/40 dark:text-amber-100">
                  Aucune compétence dans le catalogue. Lancez le seeder (ex.{' '}
                  <code className="rounded bg-amber-100/90 px-1.5 py-0.5 font-mono text-xs dark:bg-amber-900/60 dark:text-amber-50">
                    php artisan db:seed --class=SkillSeeder
                  </code>
                  ).
                </p>
              ) : (
                <div className="mt-5 space-y-2">
                  {sortedCategories.map((category, catIndex) => {
                    const list = skillsByCategory.get(category) ?? [];
                    const isOpen = openCategory === category;
                    const panelId = `skills-panel-${catIndex}`;
                    const headerId = `skills-header-${catIndex}`;
                    return (
                      <div
                        key={category}
                        className="overflow-hidden rounded-xl border border-theme bg-block transition-colors"
                      >
                        <button
                          id={headerId}
                          type="button"
                          onClick={() => handleAccordionHeaderClick(category)}
                          className="flex w-full items-center justify-between gap-3 px-4 py-3.5 text-left transition hover:bg-card/80 sm:px-5"
                          aria-expanded={isOpen}
                          aria-controls={panelId}
                        >
                          <span className="min-w-0 flex-1 text-sm font-semibold text-body sm:text-[15px]">{category}</span>
                          <span className="flex shrink-0 items-center gap-2">
                            <span className="rounded-full border border-theme bg-card px-2 py-0.5 text-xs font-medium text-muted">
                              {list.length}
                            </span>
                            <ChevronIcon open={isOpen} />
                          </span>
                        </button>
                        {isOpen && (
                          <div
                            id={panelId}
                            role="region"
                            aria-labelledby={headerId}
                            className="border-t border-theme bg-card px-4 py-4 sm:px-5"
                          >
                            <div className="flex flex-wrap gap-2">
                              {list.length === 0 ? (
                                <p className="text-sm text-muted">Aucune compétence disponible dans cette catégorie.</p>
                              ) : (
                                list.map((skill) => {
                                  const selected = userSkillIds.has(skill.id);
                                  const label = skill.name || skill.nom;
                                  const busy = togglingId === skill.id;
                                  return (
                                    <button
                                      key={skill.id}
                                      type="button"
                                      onClick={() => handleToggleCatalogSkill(skill)}
                                      disabled={togglingId !== null}
                                      aria-pressed={selected}
                                      aria-busy={busy}
                                      className={skillBadgeClasses(selected, busy, togglingId !== null && !busy)}
                                    >
                                      {selected && <CheckIcon className="h-3 w-3 shrink-0 text-sky-600 dark:text-sky-400" />}
                                      <span className="max-w-[220px] truncate sm:max-w-[260px]">{label}</span>
                                    </button>
                                  );
                                })
                              )}
                            </div>
                          </div>
                        )}
                      </div>
                    );
                  })}
                </div>
              )}
            </section>

            
          </>
        )}
      </div>
    </DashboardLayout>
  );
}



