import { useCallback, useEffect, useRef, useState } from 'react';
import { useNavigate } from 'react-router-dom';

const CONTACT_SUBJECT = 'Opportunité via ProLink';

function ChevronDownIcon({ className, open }) {
  return (
    <svg
      className={`${className ?? ''} transition-transform duration-200 ${open ? '-rotate-180' : ''}`}
      fill="none"
      stroke="currentColor"
      viewBox="0 0 24 24"
      aria-hidden
    >
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
    </svg>
  );
}

function MessageDirectIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden>
      <path
        strokeLinecap="round"
        strokeLinejoin="round"
        strokeWidth={2}
        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
      />
    </svg>
  );
}

function EnvelopeIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden>
      <path
        strokeLinecap="round"
        strokeLinejoin="round"
        strokeWidth={2}
        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
      />
    </svg>
  );
}

/**
 * Bouton « Contacter [nom] » avec menu : messagerie interne (query etudiant) ou mailto.
 * Style aligné ProLink (primary, bordures theme).
 */
export default function ContactStudentDropdown({ studentName, etudiantId, email }) {
  const navigate = useNavigate();
  const [open, setOpen] = useState(false);
  const rootRef = useRef(null);

  const displayName = (studentName && String(studentName).trim()) || 'l’étudiant';
  const mailHref =
    email && String(email).trim()
      ? `mailto:${String(email).trim()}?subject=${encodeURIComponent(CONTACT_SUBJECT)}`
      : null;

  const goMessagerie = useCallback(() => {
    if (etudiantId == null || etudiantId === '') return;
    setOpen(false);
    navigate(`/dashboard/messagerie?etudiant=${encodeURIComponent(String(etudiantId))}`);
  }, [navigate, etudiantId]);

  useEffect(() => {
    if (!open) return undefined;
    const onDoc = (e) => {
      if (rootRef.current && !rootRef.current.contains(e.target)) setOpen(false);
    };
    const onKey = (e) => {
      if (e.key === 'Escape') setOpen(false);
    };
    document.addEventListener('mousedown', onDoc);
    document.addEventListener('keydown', onKey);
    return () => {
      document.removeEventListener('mousedown', onDoc);
      document.removeEventListener('keydown', onKey);
    };
  }, [open]);

  if (etudiantId == null || etudiantId === '') return null;

  return (
    <div ref={rootRef} className="relative inline-block w-full sm:w-auto">
      <button
        type="button"
        aria-haspopup="menu"
        aria-expanded={open}
        onClick={() => setOpen((v) => !v)}
        className="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-primary px-5 py-3 text-sm font-semibold text-white shadow-theme transition hover:opacity-95 sm:w-auto"
      >
        Contacter {displayName}
        <ChevronDownIcon className="h-4 w-4 shrink-0 opacity-90" open={open} />
      </button>

      {open ? (
        <div
          role="menu"
          className="absolute right-0 z-50 mt-2 min-w-[260px] max-w-[min(100vw-2rem,320px)] rounded-2xl border border-theme bg-card py-1.5 shadow-theme"
        >
          <button
            type="button"
            role="menuitem"
            onClick={goMessagerie}
            className="flex w-full items-center gap-3 px-4 py-3 text-left text-sm font-medium text-body transition hover:bg-[var(--primary)]/10"
          >
            <MessageDirectIcon className="h-5 w-5 shrink-0 text-[var(--primary)]" />
            <span>Envoyer un message direct</span>
          </button>
          {mailHref ? (
            <a
              role="menuitem"
              href={mailHref}
              onClick={() => setOpen(false)}
              className="flex w-full items-center gap-3 px-4 py-3 text-left text-sm font-medium text-body transition hover:bg-[var(--primary)]/10"
            >
              <EnvelopeIcon className="h-5 w-5 shrink-0 text-[var(--primary)]" />
              <span>Envoyer un e-mail</span>
            </a>
          ) : (
            <p className="px-4 py-2.5 text-xs text-muted">E-mail non disponible pour ce profil.</p>
          )}
        </div>
      ) : null}
    </div>
  );
}


