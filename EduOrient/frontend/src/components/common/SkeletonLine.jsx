import { memo } from 'react';

function SkeletonLine({ className = '' }) {
  return (
    <div
      className={`animate-pulse rounded bg-[var(--muted)]/20 ${className}`.trim()}
      aria-hidden
    />
  );
}

export default memo(SkeletonLine);


