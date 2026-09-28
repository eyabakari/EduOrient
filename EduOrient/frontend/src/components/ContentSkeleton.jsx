/**
 * Squelettes de chargement (pulse) pour affichage immédiat pendant les requêtes API.
 */

export function SkeletonPulse({ className = '' }) {
  return <div className={`animate-pulse rounded-lg bg-[var(--border)]/80 ${className}`} aria-hidden />;
}

export function PortfolioPageSkeleton({ embedded = false } = {}) {
  const outer = embedded ? 'py-8' : 'min-h-screen bg-page';
  return (
    <div className={outer}>
      <div className="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        <SkeletonPulse className="mb-6 h-11 w-56 rounded-xl" />
        <div
          className="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4 lg:gap-6"
          style={{ gridAutoRows: 'minmax(140px, auto)' }}
        >
          <div className="rounded-2xl border border-theme bg-card p-6 shadow-theme md:col-span-2 lg:col-span-2 lg:row-span-2">
            <div className="flex flex-col gap-4 sm:flex-row sm:items-center">
              <SkeletonPulse className="h-28 w-28 shrink-0 rounded-2xl" />
              <div className="flex-1 space-y-3">
                <SkeletonPulse className="h-8 w-48" />
                <SkeletonPulse className="h-4 w-full max-w-md" />
                <SkeletonPulse className="h-4 w-full max-w-sm" />
                <SkeletonPulse className="h-4 w-2/3 max-w-sm" />
              </div>
            </div>
          </div>
          {[1, 2, 3, 4, 5].map((i) => (
            <div key={i} className="rounded-2xl border border-theme bg-card p-4 shadow-theme">
              <SkeletonPulse className="mb-3 h-5 w-3/4" />
              <SkeletonPulse className="h-24 w-full rounded-xl" />
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}

export function ProjectsGridSkeleton() {
  return (
    <ul className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
      {[1, 2, 3, 4, 5, 6].map((i) => (
        <li key={i} className="overflow-hidden rounded-2xl border border-theme bg-block shadow-theme">
          <SkeletonPulse className="h-40 w-full rounded-none" />
          <div className="space-y-2 p-4">
            <SkeletonPulse className="h-5 w-2/3" />
            <SkeletonPulse className="h-3 w-full" />
            <SkeletonPulse className="h-3 w-5/6" />
          </div>
        </li>
      ))}
    </ul>
  );
}

export function SkillsPageSkeleton() {
  return (
    <div className="mx-auto max-w-3xl space-y-6 px-3 sm:max-w-4xl sm:px-4 lg:max-w-5xl">
      <div className="flex flex-col gap-4 sm:flex-row sm:flex-wrap sm:items-center sm:justify-between">
        <SkeletonPulse className="h-8 w-52 sm:h-9" />
        <SkeletonPulse className="h-10 w-44 rounded-xl" />
      </div>
      <section className="rounded-2xl border border-theme bg-card p-5 shadow-sm sm:p-6">
        <SkeletonPulse className="mb-2 h-5 w-64" />
        <SkeletonPulse className="mb-4 h-3 w-full max-w-md" />
        <div className="flex flex-wrap gap-2">
          {[1, 2, 3, 4, 5].map((j) => (
            <SkeletonPulse key={j} className="h-7 w-20 rounded-full" />
          ))}
        </div>
      </section>
      <section className="rounded-2xl border border-theme bg-card p-5 shadow-sm sm:p-6">
        <SkeletonPulse className="mb-2 h-5 w-48" />
        <SkeletonPulse className="mb-4 h-3 w-full max-w-lg" />
        <div className="space-y-2">
          {[1, 2, 3, 4].map((i) => (
            <SkeletonPulse key={i} className="h-12 w-full rounded-xl" />
          ))}
        </div>
      </section>
      <section className="rounded-2xl border border-theme bg-card p-5 shadow-sm sm:p-6">
        <SkeletonPulse className="mb-4 h-5 w-28" />
        <div className="flex flex-col gap-3 sm:flex-row sm:flex-wrap">
          <SkeletonPulse className="h-11 min-h-[44px] flex-1 rounded-xl" />
          <SkeletonPulse className="h-11 min-h-[44px] w-full rounded-xl sm:w-40" />
          <SkeletonPulse className="h-11 min-h-[44px] w-24 rounded-xl" />
        </div>
      </section>
    </div>
  );
}


