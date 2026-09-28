import { memo } from 'react';

const VARIANTS = {
  primary:
    'rounded-xl bg-primary text-white font-semibold shadow-theme transition hover:opacity-90 focus:ring-2 focus:ring-[var(--primary)]/50 focus:ring-offset-2 focus:ring-offset-[var(--card-bg)] focus:outline-none disabled:opacity-60 disabled:cursor-not-allowed',
  secondary:
    'rounded-xl border border-theme bg-block px-4 py-2.5 text-body font-medium transition hover:border-[var(--primary)]/30 disabled:opacity-50 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]/25',
  ghost:
    'rounded-xl px-4 py-2.5 text-body font-medium transition hover:bg-[var(--block-bg)] focus:outline-none',
  danger:
    'rounded-xl border border-red-400/50 bg-red-500/10 text-red-600 dark:text-red-400 font-medium transition hover:bg-red-500/20 focus:outline-none disabled:opacity-50',
};

const SIZES = {
  sm: 'px-3 py-1.5 text-sm',
  md: 'px-4 py-2.5 text-sm',
  lg: 'px-5 py-3 text-base',
};

function Button({
  type = 'button',
  variant = 'primary',
  size = 'md',
  disabled = false,
  loading = false,
  className = '',
  children,
  ...props
}) {
  const base = 'inline-flex items-center justify-center gap-2';
  const variantClass = VARIANTS[variant] ?? VARIANTS.primary;
  const sizeClass = SIZES[size] ?? SIZES.md;

  return (
    <button
      type={type}
      disabled={disabled || loading}
      className={`${base} ${sizeClass} ${variantClass} ${className}`.trim()}
      {...props}
    >
      {loading ? (
        <>
          <span className="h-4 w-4 shrink-0 animate-spin rounded-full border-2 border-current border-t-transparent" aria-hidden />
          <span>{typeof children === 'string' ? children : null}</span>
        </>
      ) : (
        children
      )}
    </button>
  );
}

export default memo(Button);


