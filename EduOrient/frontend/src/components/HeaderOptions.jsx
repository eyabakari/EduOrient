import { useState, useRef, useEffect } from 'react';
import { createPortal } from 'react-dom';
import { getPreferences, savePreferences, applyTheme } from '../utils/preferences';

const THEMES = [
  { id: 'light', label: 'Clair', icon: SunIcon },
  { id: 'dark', label: 'Sombre', icon: MoonIcon },
  { id: 'system', label: 'Système', icon: SystemIcon },
];

export default function HeaderOptions() {
  const [themeOpen, setThemeOpen] = useState(false);
  const themeRef = useRef(null);
  const [dropdownPosition, setDropdownPosition] = useState({ top: 0, left: 0 });

  const prefs = getPreferences();
  const currentTheme = prefs.general?.theme ?? 'system';

  useEffect(() => {
    function handleClick(e) {
      if (themeRef.current && !themeRef.current.contains(e.target)) setThemeOpen(false);
    }
    document.addEventListener('click', handleClick);
    return () => document.removeEventListener('click', handleClick);
  }, []);

  // Positionner le dropdown (pour le portail) quand il s'ouvre — au-dessus du menu mobile
  useEffect(() => {
    if (!themeOpen || !themeRef.current) return;
    const rect = themeRef.current.getBoundingClientRect();
    const width = 160;
    let left = rect.left;
    if (left + width > window.innerWidth - 8) left = window.innerWidth - width - 8;
    if (left < 8) left = 8;
    setDropdownPosition({
      top: rect.bottom + 8,
      left,
    });
  }, [themeOpen]);

  const handleThemeChange = (themeId) => {
    const prefs = getPreferences();
    savePreferences({
      ...prefs,
      general: { ...prefs.general, theme: themeId },
    });
    applyTheme(themeId);
    setThemeOpen(false);
  };

  const CurrentThemeIcon = THEMES.find((x) => x.id === currentTheme)?.icon ?? SystemIcon;

  const dropdownContent = themeOpen && (
    <div
      role="listbox"
      aria-label="Choisir le thème"
      className="rounded-xl border py-1 shadow-lg"
      style={{
        position: 'fixed',
        top: dropdownPosition.top,
        left: dropdownPosition.left,
        zIndex: 10002,
        minWidth: 160,
        borderColor: 'var(--border)',
        backgroundColor: 'var(--card-bg)',
      }}
    >
      {THEMES.map(({ id, label, icon: Icon }) => (
        <button
          key={id}
          type="button"
          onClick={() => handleThemeChange(id)}
          className={`flex w-full items-center gap-2 px-3 py-2.5 text-sm transition ${
            currentTheme === id ? 'opacity-100 font-medium' : 'opacity-80 hover:opacity-100'
          }`}
          style={{ color: 'var(--text)' }}
        >
          <Icon className="h-4 w-4 shrink-0" />
          {label}
        </button>
      ))}
    </div>
  );

  return (
    <div className="flex items-center gap-2">
      <div className="relative" ref={themeRef}>
        <button
          type="button"
          onClick={() => setThemeOpen((o) => !o)}
          className="flex h-8 w-8 sm:h-9 sm:w-9 items-center justify-center rounded-xl border transition hover:opacity-90 shrink-0"
          style={{ borderColor: 'var(--border)', backgroundColor: 'var(--card-bg)', color: 'var(--text)' }}
          title="Thème"
          aria-label="Thème"
          aria-expanded={themeOpen}
        >
          <CurrentThemeIcon className="h-4 w-4" />
        </button>
        {/* Dropdown en portail pour qu'il soit visible au-dessus du menu mobile (z-index 10002 > drawer 10001) */}
        {dropdownContent && createPortal(dropdownContent, document.body)}
      </div>
    </div>
  );
}

function SunIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
    </svg>
  );
}

function MoonIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
    </svg>
  );
}

function SystemIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
    </svg>
  );
}


