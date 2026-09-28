import { useState, useEffect, memo } from 'react';
import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import DashboardLayout from '../components/DashboardLayout';
import { useAuth } from '../context/AuthContext';
import api from '../api/axios';

const CARD_CLASS = 'rounded-2xl shadow-sm border border-theme bg-white opacity-100';
const CARD_STYLE = { backgroundColor: 'var(--card-bg)', opacity: 1 };

const SKILL_COLORS = [
  'bg-cyan-100 text-cyan-700 border-cyan-200',
  'bg-red-100 text-red-700 border-red-200',
  'bg-sky-100 text-sky-700 border-sky-200',
  'bg-blue-100 text-blue-700 border-blue-200',
  'bg-amber-100 text-amber-700 border-amber-200',
  'bg-emerald-100 text-emerald-700 border-emerald-200',
  'bg-violet-100 text-violet-700 border-violet-200',
  'bg-rose-100 text-rose-700 border-rose-200',
];

function getSkillColor(index) {
  return SKILL_COLORS[index % SKILL_COLORS.length];
}

const container = {
  hidden: { opacity: 0 },
  show: {
    opacity: 1,
    transition: { staggerChildren: 0.06 },
  },
};

const item = {
  hidden: { opacity: 0, y: 12 },
  show: { opacity: 1, y: 0 },
};

function SkeletonLine({ className = '' }) {
  return (
    <div className={`animate-pulse rounded bg-[var(--border)] ${className}`} style={{ backgroundColor: 'var(--border)' }} />
  );
}

function Dashboard() {
  const { user } = useAuth();
  const [projects, setProjects] = useState([]);
  const [userSkills, setUserSkills] = useState([]);
  const [loading, setLoading] = useState(true);
  const [apiError, setApiError] = useState(null);

  const firstName = user?.name?.split(' ')[0] ?? 'Étudiant';

  useEffect(() => {
    let cancelled = false;
    setApiError(null);
    setLoading(true);
    const normalizeProjectListResponse = (payload) => {
      if (Array.isArray(payload)) return payload;
      return payload?.data ?? [];
    };

    Promise.all([
      api.get('/projects')
        .then((res) => {
          console.log('GET /projects response:', res.data);
          return normalizeProjectListResponse(res.data);
        })
        .catch(() => []),
      api.get('/user-skills').then((res) => res.data?.data ?? []).catch(() => []),
    ])
      .then(([proj, skills]) => {
        if (!cancelled) {
          setProjects(proj);
          setUserSkills(skills);
        }
      })
      .catch((err) => {
        if (!cancelled) {
          const status = err.response?.status;
          const message = err.response?.data?.message || err.message;
          setApiError(status === 401 ? 'Session expirée. Veuillez vous reconnecter.' : message || 'Une erreur est survenue lors du chargement des données.');
          setProjects([]);
          setUserSkills([]);
        }
      })
      .finally(() => {
        if (!cancelled) setLoading(false);
      });
    return () => { cancelled = true; };
  }, []);

  const totalProjects = projects.length;
  const totalSkills = userSkills.length;
  const recentProjects = projects.slice(0, 3);

  return (
    <DashboardLayout>
          {apiError && (
            <motion.div
              initial={{ opacity: 0, y: -8 }}
              animate={{ opacity: 1, y: 0 }}
              className="mb-4 rounded-xl border border-amber-400/50 bg-amber-50 px-4 py-3 text-sm text-amber-800"
            >
              {apiError}
            </motion.div>
          )}
          <motion.div
            variants={container}
            initial="hidden"
            animate="show"
            className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 max-w-6xl mx-auto auto-rows-fr"
            style={{ gridAutoRows: 'minmax(160px, auto)' }}
          >
            {/* Card 1 — Bienvenue : 1 cellule en mobile, 2x2 à partir de sm */}
            <motion.article
              variants={item}
              className={`col-span-1 row-span-1 sm:col-span-2 sm:row-span-2 ${CARD_CLASS} p-4 md:p-6 flex flex-col`}
              style={CARD_STYLE}
            >
              <p className="text-xs font-semibold uppercase tracking-wider text-body">Tableau de bord</p>
              <h2 className="mt-2 text-2xl font-bold text-body">
                Prêt à propulser votre carrière, <span className="bg-gradient-to-r from-purple-500 to-cyan-500 bg-clip-text text-transparent">{firstName}</span> ?
              </h2>
              {user?.candidat?.specialite && (
                <span className="mt-2 inline-flex w-fit items-center rounded-full border border-theme bg-block px-3 py-1 text-xs font-medium text-muted">
                  {user.candidat.specialite}
                </span>
              )}
              <p className="mt-1.5 text-muted">
                Explorez vos recommandations et gérez vos projets en un clin d&apos;œil.
              </p>
              {user?.candidat?.id != null && (
                <p className="mt-4">
                  <Link
                    to={`/dashboard/portfolio/${user.candidat.id}`}
                    className="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-sm font-medium text-white transition"
                  >
                    <span>Voir mon portfolio</span>
                    <svg className="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                  </Link>
                </p>
              )}
            </motion.article>

            {/* Card 2 — Projets : position explicite uniquement à partir de sm */}
            <motion.article
              variants={item}
              className={`${CARD_CLASS} p-5 sm:col-start-3 sm:row-start-1`}
              style={CARD_STYLE}
            >
              <p className="text-sm font-medium text-muted">Projets</p>
              {loading ? (
                <>
                  <SkeletonLine className="mt-2 h-9 w-14" />
                  <SkeletonLine className="mt-1.5 h-3 w-24" />
                </>
              ) : (
                <>
                  <p className="mt-2 text-3xl font-extrabold text-body">{totalProjects}</p>
                  <p className="mt-1 text-xs text-muted">projets enregistrés</p>
                </>
              )}
            </motion.article>

            {/* Card 3 — Compétences (nombre) */}
            <motion.article
              variants={item}
              className={`${CARD_CLASS} p-5 sm:col-start-4 sm:row-start-1`}
              style={CARD_STYLE}
            >
              <p className="text-sm font-medium text-muted">Compétences</p>
              {loading ? (
                <>
                  <SkeletonLine className="mt-2 h-9 w-14" />
                  <SkeletonLine className="mt-1.5 h-3 w-28" />
                </>
              ) : (
                <>
                  <p className="mt-2 text-3xl font-extrabold text-body">{totalSkills}</p>
                  <p className="mt-1 text-xs text-muted">compétences déclarées</p>
                </>
              )}
            </motion.article>

            {/* Card 4 — Projets récents : 1 col en mobile, 2x2 à partir de sm */}
            <motion.article
              variants={item}
              className={`col-span-1 sm:col-span-2 sm:row-span-2 sm:col-start-3 sm:row-start-2 ${CARD_CLASS} p-5 flex flex-col min-h-0`}
              style={CARD_STYLE}
            >
              <div className="flex items-center justify-between">
                <h3 className="text-lg font-bold text-body">Projets récents</h3>
                {!loading && projects.length > 0 && (
                  <Link
                    to="/dashboard/projets"
                    className="text-sm font-medium text-[var(--primary)] hover:opacity-90 transition"
                  >
                    Voir tout
                  </Link>
                )}
              </div>
              {loading ? (
                <ul className="mt-4 space-y-3 flex-1 min-h-0">
                  {[1, 2, 3].map((i) => (
                    <li key={i} className="flex items-start gap-4 rounded-xl border border-theme p-3 min-h-[4.5rem]" style={{ backgroundColor: 'var(--block-bg)' }}>
                      <SkeletonLine className="h-10 w-10 rounded-lg shrink-0" />
                      <div className="min-w-0 flex-1 space-y-2">
                        <SkeletonLine className="h-4 w-3/4" />
                        <SkeletonLine className="h-3 w-1/2" />
                      </div>
                    </li>
                  ))}
                </ul>
              ) : recentProjects.length === 0 ? (
                <div className="mt-4 flex flex-col flex-1">
                  <p className="text-sm text-muted">Aucun projet pour le moment. Commencez à créer !</p>
                  <Link
                    to="/dashboard/projets"
                    className="mt-4 inline-flex items-center gap-2 rounded-xl bg-[var(--primary)]/10 px-4 py-2 text-sm font-medium text-[var(--primary)] hover:opacity-90 transition w-fit"
                  >
                    Ajouter un projet
                  </Link>
                </div>
              ) : (
                <>
                  <ul className="mt-4 space-y-3 flex-1 min-h-0 overflow-y-auto">
                    {recentProjects.map((proj) => (
                      <li
                        key={proj.id}
                        className="flex items-start gap-4 rounded-xl border border-theme p-3 transition hover:border-[var(--primary)]/30"
                        style={{ backgroundColor: 'var(--block-bg)' }}
                      >
                        <span className="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[var(--primary)]/10 text-xl mt-0.5">
                          🖥️
                        </span>
                        <div className="min-w-0 flex-1">
                          <p className="font-medium text-body line-clamp-1">{proj.titre}</p>
                          <p className="mt-1 text-sm text-muted line-clamp-4 leading-relaxed">{proj.description || '—'}</p>
                          {Array.isArray(proj.skills) && proj.skills.length > 0 && (
                            <div className="mt-2 flex flex-wrap gap-1.5">
                              {proj.skills.slice(0, 5).map((s, idx) => (
                                <span
                                  key={s.id}
                                  className={`rounded-lg border px-2 py-0.5 text-xs font-medium ${getSkillColor(idx)}`}
                                >
                                  {s.nom}
                                </span>
                              ))}
                              {proj.skills.length > 5 && (
                                <span className="text-xs text-muted">+{proj.skills.length - 5}</span>
                              )}
                            </div>
                          )}
                        </div>
                      </li>
                    ))}
                  </ul>
                  {projects.length > 3 && (
                    <Link
                      to="/dashboard/projets"
                      className="mt-4 inline-flex items-center gap-1.5 text-sm font-medium text-[var(--primary)] hover:opacity-90 transition shrink-0"
                    >
                      {`Voir les ${projects.length} projets`}
                      <svg className="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
                      </svg>
                    </Link>
                  )}
                </>
              )}
            </motion.article>

            {/* Card 5 — Compétences (liste) : 1 col en mobile, 2 cols à partir de sm */}
            <motion.article
              variants={item}
              className={`col-span-1 sm:col-span-2 sm:col-start-1 sm:row-start-3 ${CARD_CLASS} p-5 flex flex-col`}
              style={CARD_STYLE}
            >
              <div className="flex items-center justify-between">
                <h3 className="text-lg font-bold text-body">Compétences</h3>
                <Link
                  to="/dashboard/competences"
                  className="text-sm font-medium text-[var(--primary)] hover:opacity-90 transition"
                >
                  Gérer
                </Link>
              </div>
              {loading ? (
                <div className="mt-4 flex flex-wrap gap-2">
                  {[1, 2, 3, 4, 5].map((i) => (
                    <SkeletonLine key={i} className="h-8 w-20 rounded-lg" />
                  ))}
                </div>
              ) : userSkills.length === 0 ? (
                <div className="mt-4 flex flex-col gap-3">
                  <p className="text-sm text-muted">Aucune compétence déclarée. Ajoutez-en pour enrichir votre profil.</p>
                  <Link
                    to="/dashboard/competences"
                    className="inline-flex items-center gap-2 rounded-xl bg-[var(--primary)]/10 px-4 py-2 text-sm font-medium text-[var(--primary)] hover:opacity-90 transition w-fit"
                  >
                    Ajouter des compétences
                  </Link>
                </div>
              ) : (
                <div className="mt-4 flex flex-wrap gap-2">
                  {userSkills.map((skill, index) => (
                    <span
                      key={skill.id}
                      className={`rounded-lg border px-3 py-1.5 text-sm font-medium ${getSkillColor(index)}`}
                    >
                      {skill.nom}
                    </span>
                  ))}
                </div>
              )}
            </motion.article>
          </motion.div>
    </DashboardLayout>
  );
}

export default memo(Dashboard);


