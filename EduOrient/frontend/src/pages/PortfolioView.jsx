import { useState, useEffect, lazy, Suspense } from 'react';
import { useParams, Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import api, { getStorageUrl } from '../api/axios';
import { useAuth } from '../context/AuthContext';
import { PortfolioPageSkeleton } from '../components/ContentSkeleton';
import ContactStudentDropdown from '../components/ContactStudentDropdown';
import {
  ProjectPlaceholder,
  getProjectSkillBadgeClass,
  projectHeroImageUrl,
} from '../components/portfolioProjectCardShared';

/**
 * Affichage du portfolio étudiant (public / propriétaire / recruteur) + téléchargement PDF (lazy).
 * Backend : GET /api/portfolio/{id} (PortfolioController).
 */

const PortfolioPdfDownload = lazy(() => import('../components/PortfolioPdfDownload.jsx'));

const RECRUITER_ROLES = ['recruteur', 'admin'];

/**
 * Télécharge une image (URL absolue ou relative) et la convertit en data URL pour @react-pdf/renderer.
 * Entrées : url (string HTTP vers le stockage).
 * Sortie : Promise<string|null> (data URL ou null en cas d’erreur).
 */
const getBase64Image = async (url) => {
  try {
    const response = await fetch(url);
    const blob = await response.blob();
    return new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.onloadend = () => resolve(reader.result);
      reader.onerror = reject;
      reader.readAsDataURL(blob);
    });
  } catch {
    return null;
  }
};

const SKILL_COLORS = [
  { backgroundColor: '#cffafe', color: '#155e75', borderColor: '#a5f3fc' },
  { backgroundColor: '#e0f2fe', color: '#0c4a6e', borderColor: '#7dd3fc' },
  { backgroundColor: '#ede9fe', color: '#5b21b6', borderColor: '#c4b5fd' },
  { backgroundColor: '#d1fae5', color: '#065f46', borderColor: '#a7f3d0' },
  { backgroundColor: '#fef3c7', color: '#92400e', borderColor: '#fcd34d' },
  { backgroundColor: '#ffe4e6', color: '#9f1239', borderColor: '#fecdd3' },
];

/**
 * Couleur de badge pour une compétence (objet style inline).
 * Entrées : index (entier).
 * Sortie : objet { backgroundColor, color, borderColor }.
 */
function getSkillColor(index) {
  return SKILL_COLORS[index % SKILL_COLORS.length];
}

/**
 * Initiales pour avatar texte (2 caractères max).
 * Entrées : name (string).
 * Sortie : string.
 */
function getInitials(name) {
  if (!name || !name.trim()) return '?';
  return name
    .trim()
    .split(/\s+/)
    .map((s) => s[0])
    .slice(0, 2)
    .join('')
    .toUpperCase();
}

const container = {
  hidden: { opacity: 0 },
  show: {
    opacity: 1,
    transition: { staggerChildren: 0.08, delayChildren: 0.1 },
  },
};

const item = {
  hidden: { opacity: 0, y: 20 },
  show: { opacity: 1, y: 0 },
};

/**
 * Grille galerie (même grille que la gestion des projets) — rien si la galerie est vide.
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

/**
 * Page (ou sous-composant embarqué) portfolio : charge les données, prépare les images en base64 pour le PDF.
 * Entrées : embedded (bool, mode intégration sans chrome public si besoin).
 * Sortie : JSX ; utilise useParams().id comme etudiant_id.
 */
export default function PortfolioView({ embedded = false } = {}) {
  const { id } = useParams();
  const { user } = useAuth();
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [photoBase64, setPhotoBase64] = useState(null);
  const [projectImagesBase64, setProjectImagesBase64] = useState({});
  /** Couverture projet : repli placeholder si l’image ne charge pas. */
  const [projectHeroLoadErrors, setProjectHeroLoadErrors] = useState({});
  const isRecruiterOrAdmin = user?.role?.name && RECRUITER_ROLES.includes(user.role.name);

  useEffect(() => {
    if (!id) {
      setLoading(false);
      setError('Identifiant manquant.');
      return;
    }
    let cancelled = false;
    setLoading(true);
    setError(null);

    api
      .get(`/portfolio/${id}`)
      .then((res) => {
        if (cancelled) return;
        setData(res.data?.data ?? null);
      })
      .catch((err) => {
        if (!cancelled) {
          setData(null);
          setError(err.response?.status === 404 ? 'Portfolio introuvable.' : err.response?.data?.message || 'Impossible de charger le portfolio.');
        }
      })
      .finally(() => {
        if (!cancelled) setLoading(false);
      });
    return () => { cancelled = true; };
  }, [id]);

  useEffect(() => {
    setProjectHeroLoadErrors({});
  }, [id, data?.projects]);

  // Convert profile + project images to base64 so PDF <Image /> can render them
  useEffect(() => {
    if (!data || typeof window === 'undefined') {
      setPhotoBase64(null);
      setProjectImagesBase64({});
      return;
    }
    let cancelled = false;

    const toFullUrl = (url) => {
      if (!url) return null;
      const u = getStorageUrl(url);
      return u.startsWith('http') ? u : `${window.location.origin}${u}`;
    };

    // Profile photo
    const profileUrl = toFullUrl(data?.profile?.photo_url);
    if (profileUrl) {
      getBase64Image(profileUrl).then((dataUrl) => {
        if (!cancelled && dataUrl) setPhotoBase64(dataUrl);
        else if (!cancelled) setPhotoBase64(null);
      });
    } else {
      setPhotoBase64(null);
    }

    // Project images
    const projects = data?.projects ?? [];
    if (projects.length === 0) {
      setProjectImagesBase64({});
      return () => { cancelled = true; };
    }
    const next = {};
    Promise.all(
      projects.map(async (p) => {
        const hero = p?.image_url || (Array.isArray(p?.gallery) && p.gallery[0]?.url ? p.gallery[0].url : null);
        const url = toFullUrl(hero);
        if (!url) return { id: p.id, dataUrl: null };
        const dataUrl = await getBase64Image(url);
        return { id: p.id, dataUrl };
      })
    ).then((results) => {
      if (cancelled) return;
      results.forEach(({ id, dataUrl }) => {
        if (dataUrl) next[id] = dataUrl;
      });
      setProjectImagesBase64(next);
    });

    return () => { cancelled = true; };
  }, [data]);

  if (loading) {
    return <PortfolioPageSkeleton embedded={embedded} />;
  }

  if (error || !data) {
    const wrapperClass = embedded ? 'flex justify-center p-6' : 'min-h-screen bg-page flex items-center justify-center p-6';
    return (
      <div className={wrapperClass}>
        <motion.div
          initial={{ opacity: 0, y: 10 }}
          animate={{ opacity: 1, y: 0 }}
          className="rounded-2xl bg-card border border-theme p-8 shadow-theme text-center max-w-md"
        >
          <p className="text-amber-800 mb-4">{error || 'Portfolio introuvable.'}</p>
          <Link
            to={embedded ? '/dashboard/search' : '/'}
            className="inline-block rounded-xl bg-primary px-4 py-2 text-sm font-medium text-white transition"
          >
            {embedded ? '← Retour à la recherche' : 'Retour à l\'accueil'}
          </Link>
        </motion.div>
      </div>
    );
  }

  const { profile, skills, projects: rawProjects } = data;
  const technicalSkills = skills?.technical ?? [];
  const projects = rawProjects ?? [];

  const pdfFileName = `Portfolio_${(profile?.name ?? 'ProLink').replace(/\s+/g, '_')}.pdf`;

  return (
    <div className={embedded ? '' : 'min-h-screen bg-page'}>
      <div className="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        <Suspense
          fallback={
            <div
              className="mb-6 inline-flex h-12 w-72 max-w-full animate-pulse rounded-xl bg-[var(--muted)]/15"
              aria-busy
              aria-label="Chargement du module PDF…"
            />
          }
        >
          <PortfolioPdfDownload
            studentId={id}
            profile={profile}
            technicalSkills={technicalSkills}
            projects={projects}
            userImage={photoBase64}
            projectImagesBase64={projectImagesBase64}
            pdfFileName={pdfFileName}
          />
        </Suspense>
        <motion.div
          id="portfolio-to-download"
          variants={container}
          initial="hidden"
          animate="show"
          className="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4 lg:gap-6"
          style={{ gridAutoRows: 'minmax(140px, auto)' }}
        >
          {/* Section 1: Profile Header — Bento large */}
          <motion.section
            variants={item}
            className="rounded-2xl border border-theme bg-card p-6 shadow-theme md:col-span-2 lg:col-span-2 lg:row-span-2 flex flex-col justify-center"
          >
            <div className="flex flex-col items-center text-center sm:flex-row sm:items-center sm:text-left gap-6">
              <div className="flex h-28 w-28 shrink-0 items-center justify-center rounded-2xl border-2 border-theme bg-block shadow-lg overflow-hidden text-3xl font-bold text-body">
                {profile?.photo_url ? (
                  <img src={getStorageUrl(profile.photo_url)} alt="" className="h-full w-full object-cover" loading="lazy" />
                ) : (
                  getInitials(profile?.name)
                )}
              </div>
              <div className="flex-1">
                <h1 className="text-2xl font-bold sm:text-3xl text-body">{profile?.name ?? 'Étudiant'}</h1>
                {(profile?.specialite || profile?.niveau_etude) && (
                  <p className="mt-1 text-lg text-muted">
                    {[profile?.specialite, profile?.niveau_etude].filter(Boolean).join(' · ')}
                  </p>
                )}
                {profile?.bio && (
                  <p className="mt-4 text-sm leading-relaxed max-w-xl text-muted">{profile.bio}</p>
                )}
                {profile?.linkedin && (
                  <a
                    href={profile.linkedin}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="mt-3 inline-flex items-center gap-2 text-sm text-[var(--primary)] hover:opacity-90"
                  >
                    LinkedIn
                    <svg className="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                  </a>
                )}
                {isRecruiterOrAdmin && id && (
                  <div className="mt-4 flex w-full justify-center sm:justify-start">
                    <ContactStudentDropdown
                      studentName={profile?.name}
                      etudiantId={id}
                      email={profile?.email}
                    />
                  </div>
                )}
              </div>
            </div>
          </motion.section>

          {/* Section 2: Skills — Technical */}
          <motion.section
            variants={item}
            className="rounded-2xl border border-theme bg-card p-5 shadow-theme lg:col-span-2"
          >
            <h2 className="text-lg font-semibold flex items-center gap-2 text-body">
              <span style={{ color: '#06b6d4' }}>◆</span> Compétences techniques
            </h2>
            {technicalSkills.length === 0 ? (
              <p className="mt-3 text-sm text-muted">Aucune compétence technique renseignée.</p>
            ) : (
              <ul className="mt-3 flex flex-wrap gap-2">
                {technicalSkills.map((skill, i) => (
                  <li
                    key={skill.id}
                    className="rounded-lg border px-3 py-1.5 text-sm font-medium"
                    style={getSkillColor(i)}
                  >
                    {skill.nom}
                  </li>
                ))}
              </ul>
            )}
          </motion.section>

          {/* Section 3: Projects Gallery — full width then grid of cards */}
          <motion.section
            variants={item}
            className="rounded-2xl border border-theme bg-block p-6 shadow-theme backdrop-blur-md md:col-span-2 lg:col-span-4"
          >
            <h2 className="text-xl font-semibold mb-4 flex items-center gap-2 text-body">
              <span style={{ color: '#a78bfa' }}>◆</span> Projets
            </h2>
            {!projects?.length ? (
              <p className="text-sm text-muted">Aucun projet pour le moment.</p>
            ) : (
              <ul className="grid items-stretch gap-4 sm:grid-cols-2 lg:grid-cols-3">
                {projects.map((project) => {
                  const heroUrl = projectHeroImageUrl(project);
                  const showHeroImg = Boolean(heroUrl) && !projectHeroLoadErrors[project.id];
                  return (
                  <motion.li
                    key={project.id}
                    variants={item}
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
                        <p className="mt-2 shrink-0 text-sm leading-relaxed whitespace-pre-line text-muted line-clamp-5">
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
                  </motion.li>
                  );
                })}
              </ul>
            )}
          </motion.section>
        </motion.div>

        <motion.div variants={item} className="mt-8 text-center">

        </motion.div>
      </div>
    </div>
  );
}

/** Icône GitHub pour les liens projet. Entrées : className. Sortie : JSX SVG. */
function GitHubIcon({ className }) {
  return (
    <svg className={className} fill="currentColor" viewBox="0 0 24 24">
      <path fillRule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.527 1.028 1.527 1.028.892 1.522 2.336 1.087 2.902.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clipRule="evenodd" />
    </svg>
  );
}

/** Icône lien externe (démo). Entrées : className. Sortie : JSX SVG. */
function ExternalIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
    </svg>
  );
}


