/**
 * Éléments partagés entre la gestion des projets (Projects.jsx), le portfolio public
 * (PortfolioView.jsx) et le panneau recruteur (RecruiterSearch.jsx) : placeholder visuel,
 * badges compétences projet, URL d’image principale.
 */

export const PROJECT_SKILL_BADGE_CLASSES = [
  'bg-cyan-100 text-cyan-800 border-cyan-200',
  'bg-sky-100 text-sky-800 border-sky-200',
  'bg-violet-100 text-violet-800 border-violet-200',
  'bg-emerald-100 text-emerald-800 border-emerald-200',
  'bg-amber-100 text-amber-800 border-amber-200',
  'bg-rose-100 text-rose-800 border-rose-200',
];

/**
 * Classes Tailwind pour un badge de compétence projet (même rotation que la gestion).
 */
export function getProjectSkillBadgeClass(index) {
  return `rounded-md border px-2 py-0.5 text-xs font-medium ${PROJECT_SKILL_BADGE_CLASSES[index % PROJECT_SKILL_BADGE_CLASSES.length]}`;
}

/**
 * Image de remplacement : initiale du titre sur dégradé (aligné Gestion des projets).
 */
export function ProjectPlaceholder({ title }) {
  const letter = (title || 'P').charAt(0).toUpperCase();
  return (
    <div
      className="flex h-40 w-full items-center justify-center rounded-t-2xl text-4xl font-bold"
      style={{
        background:
          'linear-gradient(to bottom right, rgba(99,102,241,0.3), rgba(139,92,246,0.2), rgba(51,65,85,0.4))',
        color: 'rgba(255,255,255,0.4)',
      }}
      aria-hidden
    >
      {letter}
    </div>
  );
}

/**
 * URL relative de couverture : image principale ou première entrée de galerie.
 */
export function projectHeroImageUrl(project) {
  if (project?.image_url) return project.image_url;
  const g = project?.gallery;
  if (Array.isArray(g) && g.length > 0 && g[0]?.url) return g[0].url;
  return null;
}


