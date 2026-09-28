import { memo } from 'react';

function PageLoader() {
  return (
    <div className="flex min-h-[50vh] flex-col items-center justify-center gap-4 bg-page" aria-label="Chargement">
      <div className="h-10 w-10 animate-spin rounded-full border-2 border-[var(--primary)] border-t-transparent" />
      <p className="text-sm text-muted">Chargement…</p>
    </div>
  );
}

export default memo(PageLoader);


