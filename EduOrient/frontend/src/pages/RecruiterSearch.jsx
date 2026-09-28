import { useState, useEffect, useMemo } from 'react';
import { Navigate } from 'react-router-dom';
import { motion } from 'framer-motion';
import DashboardLayout from '../components/DashboardLayout';
import ContactStudentDropdown from '../components/ContactStudentDropdown';
import { useAuth } from '../context/AuthContext';
import api, { getStorageUrl } from '../api/axios';
import {
  ProjectPlaceholder,
  getProjectSkillBadgeClass,
  projectHeroImageUrl,
} from '../components/portfolioProjectCardShared';

/**
 * Recherche / matching recruteur : étudiants suggérés, filtre client, panneau portfolio.
 * Backend : SearchController::suggestedStudents, PortfolioController::show.
 */

const ALLOWED_ROLES = ['recruteur', 'admin'];

const SKILL_COLORS = [
  'bg-cyan-100 text-cyan-800 border-cyan-200',
  'bg-sky-100 text-sky-800 border-sky-200',
  'bg-violet-100 text-violet-800 border-violet-200',
  'bg-emerald-100 text-emerald-800 border-emerald-200',
  'bg-amber-100 text-amber-800 border-amber-200',
  'bg-rose-100 text-rose-800 border-rose-200',
];

/**
 * Couleur de badge compétence (rotation sur une palette).
 * Entrées : index (entier).
 * Sortie : chaîne de classes Tailwind.
 */
function getSkillColor(index) {
  return SKILL_COLORS[index % SKILL_COLORS.length];
}

/**
 * Initiales à partir du nom (2 lettres max) pour avatar texte.
 * Entrées : name (string).
 * Sortie : string (majuscules) ou « ? ».
 */
function getInitials(name) {
  if (!name || !name.trim()) return '?';
  return name.trim().split(/\s+/).map((s) => s[0]).slice(0, 2).join('').toUpperCase();
}

const container = {
  hidden: { opacity: 0 },
  show: {
    opacity: 1,
    transition: { staggerChildren: 0.04, delayChildren: 0.06 },
  },
};

const item = {
  hidden: { opacity: 0, y: 12 },
  show: { opacity: 1, y: 0, transition: { type: 'spring', stiffness: 300, damping: 24 } },
};

/**
 * Filtre côté client : chaque mot saisi doit matcher au moins une compétence du profil (noms en minuscules).
 * Entrées : student (objet API), rawQuery (string saisie utilisateur).
 * Sortie : booléen (true si filtre vide ou toutes les conditions remplies).
 */
function suggestedStudentMatchesSkillQuery(student, rawQuery) {
  const t = rawQuery.trim();
  if (!t) return true;
  const terms = t
    .toLowerCase()
    .split(/[\s,]+/)
    .map((x) => x.trim())
    .filter(Boolean);
  let names = (student.skill_names || []).map((n) => String(n).toLowerCase());
  if (names.length === 0) {
    const top = (student.top_3_skills || []).map((s) => String(s.nom || '').toLowerCase());
    const match = (student.matching_skills || []).map((x) => String(x).toLowerCase());
    names = [...top, ...match];
  }
  const uniq = [...new Set(names)];
  return terms.every((term) => uniq.some((nom) => nom === term || nom.includes(term) || term.includes(nom)));
}

/**
 * Indicateur de chargement animé pour l’écran d’attente auth.
 * Entrées : aucune.
 * Sortie : JSX.
 */
function LoadingSpinner() {
  return (
    <motion.div
      initial={{ opacity: 0 }}
      animate={{ opacity: 1 }}
      exit={{ opacity: 0 }}
      className="flex flex-col items-center justify-center gap-5 py-20"
    >
      <motion.div
        animate={{ rotate: 360 }}
        transition={{ duration: 0.8, repeat: Infinity, ease: 'linear' }}
        className="h-11 w-11 rounded-full border-2 border-[var(--border)] border-t-[var(--primary)]"
      />
      <p className="text-sm text-muted font-medium">Chargement des candidats…</p>
    </motion.div>
  );
}

/**
 * Icône loupe SVG (champ filtre).
 * Entrées : className (string optionnelle).
 * Sortie : JSX.
 */
function SearchIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>
  );
}

/* ----- Compact candidate card for left sidebar ----- */
/**
 * Carte cliquable d’un étudiant suggéré dans la colonne gauche.
 * Entrées : student (données API), isSelected, onSelect (callback id|null), matchBadge (string optionnel).
 * Sortie : JSX.
 */
function CandidateCard({ student, isSelected, onSelect, matchBadge }) {
  const id = student.id;
  const name = student.user?.name ?? student.name ?? 'Étudiant';
  const photoUrl = student.user?.photo_url ?? student.photo_url;
  const roleOrSource = student.specialite ? student.specialite : 'ProLink';

  return (
    <motion.article
      variants={item}
      whileHover={{ scale: 1.01 }}
      whileTap={{ scale: 0.99 }}
      className={`group relative flex items-center gap-4 rounded-2xl p-4 transition-all duration-300 cursor-pointer overflow-hidden ${
        isSelected
          ? 'bg-[var(--primary)]/10 shadow-theme ring-2 ring-[var(--primary)]/60'
          : 'bg-card hover:shadow-theme shadow-sm border border-theme'
      }`}
      onClick={() => onSelect(isSelected ? null : id)}
    >
      {isSelected && (
        <div className="absolute left-0 top-0 bottom-0 w-1 bg-[var(--primary)] rounded-l-2xl" />
      )}
      <div className="flex min-w-0 flex-1 items-center gap-4">
        <div className={`h-12 w-12 shrink-0 overflow-hidden rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 ${
          isSelected ? 'ring-2 ring-white ring-offset-2 ring-offset-[var(--card-bg)] shadow-md' : 'ring-1 ring-[var(--border)]'
        } ${photoUrl ? 'bg-block' : 'bg-[var(--primary)]/20 text-[var(--primary)]'}`}>
          {photoUrl ? (
            <img src={getStorageUrl(photoUrl)} alt="" className="h-full w-full object-cover" loading="lazy" />
          ) : (
            getInitials(name)
          )}
        </div>
        <div className="min-w-0 flex-1">
          <div className="flex flex-wrap items-center gap-x-2 gap-y-1">
            <p className={`truncate font-semibold text-[15px] ${isSelected ? 'text-[var(--primary)]' : 'text-body'}`}>{name}</p>
            {matchBadge ? (
              <span className="shrink-0 rounded-md border border-emerald-200 bg-emerald-50 px-1.5 py-0.5 text-[10px] font-bold uppercase tracking-wide text-emerald-800">
                {matchBadge}
              </span>
            ) : null}
          </div>
          <p className="truncate text-xs mt-0.5 text-muted">{roleOrSource}</p>
        </div>
      </div>
    </motion.article>
  );
}

/* ----- Portfolio panel for main content (data from API) ----- */
/**
 * Affiche le portfolio détaillé (profil, compétences, projets) pour l’étudiant sélectionné.
 * Entrées : data (réponse GET /portfolio/:id), etudiantId, loading.
 * Sortie : JSX ou null.
 */
function ProjectGalleryStrip({ project }) {
  const gallery = project?.gallery;
  const items = Array.isArray(gallery) ? gallery.filter((x) => x?.url) : [];
  if (items.length === 0) return null;
  return (
    <div className="mt-3 shrink-0 grid grid-cols-2 gap-4 md:grid-cols-3">
      {items.map((img) => (
        <img
          key={img.id}
          src={getStorageUrl(img.url)}
          alt=""
          className="aspect-video w-full rounded-lg border border-theme object-cover"
          loading="lazy"
        />
      ))}
    </div>
  );
}

function GitHubIcon({ className }) {
  return (
    <svg className={className} fill="currentColor" viewBox="0 0 24 24">
      <path
        fillRule="evenodd"
        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.527 1.028 1.527 1.028.892 1.522 2.336 1.087 2.902.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
        clipRule="evenodd"
      />
    </svg>
  );
}

function ExternalIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
    </svg>
  );
}

function PortfolioPanel({ data, etudiantId, loading }) {
  const [projectHeroLoadErrors, setProjectHeroLoadErrors] = useState({});

  useEffect(() => {
    setProjectHeroLoadErrors({});
  }, [data?.projects, etudiantId]);

  if (loading) {
    return (
      <div className="flex h-full items-center justify-center p-8">
        <motion.div
          animate={{ opacity: [0.6, 1, 0.6] }}
          transition={{ duration: 1.2, repeat: Infinity }}
          className="rounded-2xl bg-card border border-theme px-8 py-6 shadow-theme"
        >
          <p className="text-muted font-medium">Chargement du portfolio…</p>
        </motion.div>
      </div>
    );
  }
  if (!data) return null;

  const { profile, skills, projects } = data;
  const technicalSkills = skills?.technical ?? [];

  return (
    <motion.div
      initial={{ opacity: 0 }}
      animate={{ opacity: 1 }}
      transition={{ duration: 0.25 }}
      className="h-full overflow-y-auto"
    >
      <div className="mx-auto max-w-4xl space-y-5 p-5 md:p-8">
        {/* Profile header + Contacter */}
        <section className="rounded-2xl border border-theme bg-card p-6 shadow-theme">
          <div className="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
            <div className="flex items-center gap-5">
              <div className="h-20 w-20 shrink-0 overflow-hidden rounded-2xl border-2 border-theme bg-block text-2xl font-bold text-[var(--primary)] flex items-center justify-center shadow-inner">
                {profile?.photo_url ? (
                  <img src={getStorageUrl(profile.photo_url)} alt="" className="h-full w-full object-cover" loading="lazy" />
                ) : (
                  getInitials(profile?.name)
                )}
              </div>
              <div className="min-w-0">
                <h1 className="text-xl font-bold text-body sm:text-2xl">{profile?.name ?? 'Étudiant'}</h1>
                {(profile?.specialite || profile?.niveau_etude) && (
                  <p className="mt-1 text-muted text-sm">
                    {[profile?.specialite, profile?.niveau_etude].filter(Boolean).join(' · ')}
                  </p>
                )}
                {profile?.bio && (
                  <p className="mt-2 text-muted text-sm leading-relaxed line-clamp-2">{profile.bio}</p>
                )}
              </div>
            </div>
            <div className="flex w-full shrink-0 flex-col gap-2 sm:w-auto sm:items-center">
              <ContactStudentDropdown
                studentName={profile?.name ?? 'Étudiant'}
                etudiantId={etudiantId}
                email={profile?.email}
              />
            </div>
          </div>
        </section>

        {/* Technical skills */}
        <section className="rounded-2xl border border-theme bg-card p-5 shadow-theme">
          <h2 className="text-base font-semibold text-body flex items-center gap-2">
            <span className="text-cyan-500">◆</span> Compétences techniques
          </h2>
          {technicalSkills.length === 0 ? (
            <p className="mt-3 text-sm text-muted">Aucune compétence technique renseignée.</p>
          ) : (
            <ul className="mt-3 flex flex-wrap gap-2">
              {technicalSkills.map((skill, i) => (
                <li
                  key={skill.id}
                  className={`rounded-xl border px-3 py-1.5 text-sm font-medium ${getSkillColor(i)}`}
                >
                  {skill.nom}
                </li>
              ))}
            </ul>
          )}
        </section>

        {/* Projects */}
        <section className="rounded-2xl border border-theme bg-card p-6 shadow-theme">
          <h2 className="text-lg font-semibold text-body mb-4 flex items-center gap-2">
            <span className="text-violet-500">◆</span> Projets
          </h2>
          {!projects?.length ? (
            <p className="text-muted text-sm">Aucun projet pour le moment.</p>
          ) : (
            <ul className="grid items-stretch gap-4 sm:grid-cols-2 lg:grid-cols-3">
              {projects.map((project) => {
                const heroUrl = projectHeroImageUrl(project);
                const showHeroImg = Boolean(heroUrl) && !projectHeroLoadErrors[project.id];
                return (
                  <li
                    key={project.id}
                    className="flex h-full min-h-0 flex-col overflow-hidden rounded-2xl border border-theme bg-block shadow-theme transition hover:border-[var(--primary)]/30"
                  >
                    <div className="h-40 w-full shrink-0 overflow-hidden">
                      {showHeroImg ? (
                        <img
                          src={getStorageUrl(heroUrl)}
                          alt=""
                          className="h-full w-full object-cover"
                          loading="lazy"
                          onError={() =>
                            setProjectHeroLoadErrors((prev) => ({ ...prev, [project.id]: true }))
                          }
                        />
                      ) : (
                        <ProjectPlaceholder title={project.titre} />
                      )}
                    </div>
                    <div className="flex min-h-0 flex-1 flex-col p-4">
                      <h3 className="shrink-0 font-semibold text-body">{project.titre || 'Sans titre'}</h3>
                      {project.description && (
                        <p className="mt-2 shrink-0 text-sm leading-relaxed text-muted whitespace-pre-line line-clamp-5">
                          {project.description}
                        </p>
                      )}
                      <ProjectGalleryStrip project={project} />
                      {project.skills?.length > 0 && (
                        <div className="mt-3 flex shrink-0 flex-wrap gap-1.5">
                          {project.skills.map((s, i) => (
                            <span key={s.id} className={getProjectSkillBadgeClass(i)}>
                              {s.nom}
                            </span>
                          ))}
                        </div>
                      )}
                      <div className="mt-auto flex min-h-[2.75rem] flex-wrap items-center gap-2 border-t border-transparent pt-4">
                        {project.lien_github && (
                          <a
                            href={project.lien_github}
                            target="_blank"
                            rel="noopener noreferrer"
                            className="inline-flex items-center gap-1.5 rounded-lg border border-theme bg-card px-3 py-1.5 text-sm font-medium text-body transition hover:border-[var(--primary)]/40 hover:bg-[var(--primary)]/5"
                          >
                            <GitHubIcon className="h-4 w-4" />
                            Voir sur GitHub
                          </a>
                        )}
                        {project.lien_demo && (
                          <a
                            href={project.lien_demo}
                            target="_blank"
                            rel="noopener noreferrer"
                            className="inline-flex items-center gap-1.5 rounded-lg border-2 border-[var(--primary)] bg-[var(--primary)]/10 px-3 py-1.5 text-sm font-medium text-[var(--primary)] transition hover:opacity-90"
                          >
                            <ExternalIcon className="h-4 w-4" />
                            Démo
                          </a>
                        )}
                      </div>
                    </div>
                  </li>
                );
              })}
            </ul>
          )}
        </section>
      </div>
    </motion.div>
  );
}

/**
 * Page recruteur : charge les suggestions, filtre localement, charge le portfolio au clic.
 * Entrées : aucune prop ; useAuth pour rôle ; api pour /search/suggested-students et /portfolio/:id.
 * Sortie : JSX ou redirection Navigate.
 */
export default function RecruiterSearch() {
  const { user, loading: authLoading } = useAuth();
  const [searchQuery, setSearchQuery] = useState('');
  const [selectedId, setSelectedId] = useState(null);
  const [portfolioData, setPortfolioData] = useState(null);
  const [portfolioLoading, setPortfolioLoading] = useState(false);
  const [suggestedStudents, setSuggestedStudents] = useState([]);
  const [suggestedLoading, setSuggestedLoading] = useState(false);

  const canAccess = useMemo(
    () => user?.role?.name && ALLOWED_ROLES.includes(String(user.role.name).toLowerCase()),
    [user?.role?.name]
  );

  useEffect(() => {
    if (authLoading || !canAccess) return;
    let cancelled = false;
    setSuggestedLoading(true);
    api
      .get(`/search/students?q=${searchQuery}`)
      .then((res) => {
        if (!cancelled) setSuggestedStudents(Array.isArray(res.data?.data) ? res.data.data : []);
      })
      .catch(() => {
        if (!cancelled) setSuggestedStudents([]);
      })
      .finally(() => {
        if (!cancelled) setSuggestedLoading(false);
      });
    return () => { cancelled = true; };
  }, [authLoading, canAccess, searchQuery]);

  const filteredSuggestedStudents = useMemo(
    () => suggestedStudents,
    [suggestedStudents]
  );

  // Fetch portfolio when a candidate is selected
  useEffect(() => {
    if (!selectedId) {
      setPortfolioData(null);
      return;
    }
    let cancelled = false;
    setPortfolioLoading(true);
    api
      .get(`/portfolio/${selectedId}`)
      .then((res) => {
        if (!cancelled) setPortfolioData(res.data?.data ?? null);
      })
      .catch(() => {
        if (!cancelled) setPortfolioData(null);
      })
      .finally(() => {
        if (!cancelled) setPortfolioLoading(false);
      });
    return () => { cancelled = true; };
  }, [selectedId]);

  if (!authLoading && !user) {
    return <Navigate to="/login" replace />;
  }

  if (user && !canAccess) {
    return <Navigate to="/dashboard" replace />;
  }

  if (authLoading) {
    return (
      <div className="min-h-screen bg-page flex items-center justify-center">
        <LoadingSpinner />
      </div>
    );
  }

  return (
    <DashboardLayout>
        {/* h-[calc(100vh-theme(spacing.16))] bech na77iw toul el Header (64px) */}
        <div className="flex flex-col md:flex-row flex-1 h-[calc(100vh-10px)] overflow-hidden -m-4 md:-m-6 bg-page">
          
          {/* Sidebar: Fixé w fih overflow-y-auto bech t-skrolli ken el lista */}
          <aside className="w-full md:w-[320px] lg:w-[420px] shrink-0 flex flex-col bg-card border-r border-theme shadow-sm overflow-hidden">
            
            {/* Header mta3 el sidebar (Filter) - yab9a dima mil fou9 (shrink-0) */}
            <div className="p-4 border-b border-theme shrink-0 bg-card">
              <h2 className="text-sm font-semibold uppercase tracking-wider text-muted mb-2 px-1">Filtrer les candidats</h2>
              <div className="relative">
                <span className="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-[#9CA3AF]">
                  <SearchIcon className="h-5 w-5" />
                </span>
                <input
                  type="text"
                  value={searchQuery}
                  onChange={(e) => setSearchQuery(e.target.value)}
                  placeholder="Rechercher un nom ou compétence..."
                  className="w-full rounded-2xl border border-theme bg-block py-3 pl-11 pr-4 text-sm text-body focus:ring-2 focus:ring-[var(--primary)]/25 outline-none transition-all"
                />
              </div>
            </div>

            {/* El Lista: Hedhi hiya eli t-skrolli wa7edha (flex-1 overflow-y-auto) */}
            <div className="flex-1 overflow-y-auto p-4 space-y-3 bg-[var(--block-bg)]/20 custom-scrollbar">
              {!suggestedLoading && filteredSuggestedStudents.length > 0 ? (
                <motion.div variants={container} initial="hidden" animate="show" className="flex flex-col gap-2">
                  {filteredSuggestedStudents.map((student) => (
                    <CandidateCard
                      key={`student-${student.id}`}
                      student={student}
                      isSelected={selectedId === student.id}
                      onSelect={setSelectedId}
                      matchBadge={student.match_count != null ? `${student.match_count} tags` : null}
                    />
                  ))}
                </motion.div>
              ) : (
                <div className="py-10 text-center text-xs text-muted">
                   {suggestedLoading ? "Chargement..." : "Aucun résultat trouvé"}
                </div>
              )}
            </div>
          </aside>
          {/* Main Content: El Portfolio yab9a dima fijas w y-skrolli dakhliyan */}
          <main className="flex-1 min-w-0 flex flex-col bg-page overflow-hidden relative scrollbar-hide ">
            {selectedId ? (
              <div className="flex-1 overflow-y-auto scrollbar-hide ">
                <PortfolioPanel
                  data={portfolioData}
                  etudiantId={selectedId}
                  loading={portfolioLoading}
                />
              </div>
              
            ) : (
              <div className="flex h-full flex-col items-center justify-center gap-6 p-12 text-center">
                <div className="mx-auto flex h-24 w-24 items-center justify-center rounded-3xl bg-[var(--primary)]/10">
                  <span className="text-4xl">👤</span>
                </div>
                <div className="max-w-sm">
                  <p className="text-body text-xl font-semibold">Sélectionnez un candidat</p>
                  <p className="text-muted text-sm">Cliquez sur un profil à gauche pour voir les détails.</p>
                </div>
              </div>
            )}
          </main>
        </div>
    </DashboardLayout>
 );
}


