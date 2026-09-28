import { memo } from 'react';

function Card({ className = '', padding = true, children, ...props }) {
  const paddingClass = padding ? 'p-5 sm:p-6' : '';
  return (
    <div
      className={`rounded-2xl border border-theme bg-card shadow-theme ${paddingClass} ${className}`.trim()}
      {...props}
    >
      {children}
    </div>
  );
}

export default memo(Card);


