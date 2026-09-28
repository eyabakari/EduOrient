import { useState, useEffect } from 'react';
import { createPortal } from 'react-dom';
import { Link, useLocation } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import HeaderOptions from './HeaderOptions';

// Style du tiroir menu — utilise les variables CSS du thème (clair/sombre)
const DRAWER_FONT = '"Plus Jakarta Sans", system-ui, sans-serif';

function MenuIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
    </svg>
  );
}

function HomeIcon({ size = 20, color = 'currentColor' }) {
  return (
    <svg width={size} height={size} viewBox="0 0 24 24" fill="none" stroke={color} strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
      <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
      <polyline points="9 22 9 12 15 12 15 22" />
    </svg>
  );
}

function InfoIcon({ size = 20, color = 'currentColor' }) {
  return (
    <svg width={size} height={size} viewBox="0 0 24 24" fill="none" stroke={color} strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
      <circle cx="12" cy="12" r="10" />
      <line x1="12" y1="16" x2="12" y2="12" />
      <line x1="12" y1="8" x2="12.01" y2="8" />
    </svg>
  );
}

function UserIcon({ size = 20, color = 'currentColor' }) {
  return (
    <svg width={size} height={size} viewBox="0 0 24 24" fill="none" stroke={color} strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
      <circle cx="12" cy="7" r="4" />
    </svg>
  );
}

function CloseIcon({ size = 24, color = 'currentColor' }) {
  return (
    <svg width={size} height={size} viewBox="0 0 24 24" fill="none" stroke={color} strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
      <line x1="18" y1="6" x2="6" y2="18" />
      <line x1="6" y1="6" x2="18" y2="18" />
    </svg>
  );
}

export default function PublicNavbar() {
  const { user, loading } = useAuth();
  const location = useLocation();
  const isLoggedIn = !!user;
  const [menuOpen, setMenuOpen] = useState(false);
  const [mounted, setMounted] = useState(false);

  useEffect(() => {
    setMounted(true);
  }, []);

  const closeMenu = () => setMenuOpen(false);

  const linkBase = {
    display: 'flex',
    alignItems: 'center',
    gap: 14,
    padding: '14px 18px',
    borderRadius: 14,
    fontSize: 16,
    fontWeight: 600,
    textDecoration: 'none',
    transition: 'background-color 0.2s, color 0.2s',
  };

  const drawerContent = mounted && menuOpen && createPortal(
    <div className="fixed inset-0 z-[10000] md:hidden" style={{ pointerEvents: 'auto', fontFamily: DRAWER_FONT }}>
      <div
        role="presentation"
        onClick={closeMenu}
        style={{
          position: 'fixed',
          inset: 0,
          zIndex: 10000,
          backgroundColor: 'rgba(0, 0, 0, 0.45)',
          backdropFilter: 'blur(2px)',
        }}
        aria-hidden
      />
      <aside
        role="dialog"
        aria-modal="true"
        aria-label="Menu de navigation"
        style={{
          position: 'fixed',
          top: 0,
          right: 0,
          zIndex: 10001,
          width: 'min(300px, 88vw)',
          maxWidth: '88vw',
          height: '100%',
          backgroundColor: 'var(--card-bg)',
          color: 'var(--text)',
          boxShadow: 'var(--shadow)',
          borderLeft: '1px solid var(--border)',
          display: 'flex',
          flexDirection: 'column',
          overflow: 'hidden',
        }}
      >
        {/* En-tête */}
        <div
          style={{
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'space-between',
            minHeight: 64,
            padding: '0 20px',
            background: 'var(--block-bg)',
            borderBottom: '1px solid var(--border)',
            flexShrink: 0,
          }}
        >
          <span style={{ fontSize: '1.25rem', fontWeight: 800, color: 'var(--text)', letterSpacing: '-0.02em' }}>
            ProLink
          </span>
          <button
            type="button"
            onClick={closeMenu}
            aria-label="Fermer le menu"
            style={{
              width: 40,
              height: 40,
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              borderRadius: 12,
              border: 'none',
              background: 'var(--border)',
              color: 'var(--text)',
              cursor: 'pointer',
            }}
          >
            <CloseIcon size={20} color="var(--text)" />
          </button>
        </div>

        {/* Contenu scrollable */}
        <nav
          style={{
            flex: 1,
            overflowY: 'auto',
            overflowX: 'hidden',
            padding: '20px 16px 24px',
            display: 'flex',
            flexDirection: 'column',
            gap: 6,
            minHeight: 280,
            backgroundColor: 'var(--card-bg)',
          }}
        >
          <span style={{ fontSize: 11, fontWeight: 700, color: 'var(--muted)', textTransform: 'uppercase', letterSpacing: '0.08em', padding: '0 4px 8px' }}>
            Navigation
          </span>
          <Link
            to="/"
            onClick={closeMenu}
            style={{
              ...linkBase,
              color: location.pathname === '/' ? 'var(--primary)' : 'var(--text)',
              backgroundColor: location.pathname === '/' ? 'var(--drawer-link-active-bg)' : 'transparent',
            }}
          >
            <HomeIcon size={22} color={location.pathname === '/' ? 'var(--primary)' : 'var(--muted)'} />
            Accueil
          </Link>
          <Link
            to="/a-propos"
            onClick={closeMenu}
            style={{
              ...linkBase,
              color: location.pathname === '/a-propos' ? 'var(--primary)' : 'var(--text)',
              backgroundColor: location.pathname === '/a-propos' ? 'var(--drawer-link-active-bg)' : 'transparent',
            }}
          >
            <InfoIcon size={22} color={location.pathname === '/a-propos' ? 'var(--primary)' : 'var(--muted)'} />
            À propos
          </Link>

          <div style={{ height: 1, backgroundColor: 'var(--border)', margin: '16px 0 8px' }} />

          <span style={{ fontSize: 11, fontWeight: 700, color: 'var(--muted)', textTransform: 'uppercase', letterSpacing: '0.08em', padding: '0 4px 8px' }}>
            Apparence
          </span>
          <div style={{ padding: '4px 4px 12px' }}>
            <HeaderOptions />
          </div>

          {!loading && (
            <>
              <span style={{ fontSize: 11, fontWeight: 700, color: 'var(--muted)', textTransform: 'uppercase', letterSpacing: '0.08em', padding: '0 4px 8px', marginTop: 4 }}>
                Compte
              </span>
              {isLoggedIn ? (
                <Link
                  to="/dashboard"
                  onClick={closeMenu}
                  style={{
                    ...linkBase,
                    marginTop: 2,
                    color: '#ffffff',
                    backgroundColor: 'var(--primary)',
                    boxShadow: 'var(--shadow)',
                    justifyContent: 'center',
                    gap: 10,
                  }}
                >
                  <UserIcon size={20} color="#ffffff" />
                  Tableau de bord
                </Link>
              ) : (
                <>
                  <Link
                    to="/login"
                    onClick={closeMenu}
                    style={{
                      ...linkBase,
                      marginTop: 2,
                      color: 'var(--text)',
                      border: '2px solid var(--border)',
                      backgroundColor: 'transparent',
                      justifyContent: 'center',
                      gap: 10,
                    }}
                  >
                    <UserIcon size={20} color="var(--muted)" />
                    Connexion
                  </Link>
                  <Link
                    to="/register"
                    onClick={closeMenu}
                    style={{
                      ...linkBase,
                      marginTop: 8,
                      color: '#ffffff',
                      backgroundColor: 'var(--primary)',
                      boxShadow: 'var(--shadow)',
                      justifyContent: 'center',
                      gap: 10,
                    }}
                  >
                    Inscription
                  </Link>
                </>
              )}
            </>
          )}
        </nav>
      </aside>
    </div>,
    document.body
  );

  return (
    <>
      <header className="sticky top-0 z-50 border-b border-theme bg-card backdrop-blur-md">
        <div className="mx-auto flex h-14 max-w-6xl items-center justify-between gap-2 px-4 sm:px-6 lg:px-8 min-w-0">
          <Link to="/" className="text-base sm:text-lg lg:text-xl font-bold tracking-tight text-body transition hover:text-[var(--primary)] shrink-0">
            ProLink
          </Link>

          {/* Desktop nav */}
          <nav className="hidden md:flex items-center gap-2 lg:gap-4 shrink min-w-0">
            <Link to="/" className={`rounded-xl px-3 py-2 lg:px-4 lg:py-2.5 text-sm lg:text-base font-medium transition-colors whitespace-nowrap ${location.pathname === '/' ? 'text-[var(--primary)]' : 'text-muted hover:text-[var(--primary)] hover:bg-block'}`}>
              Accueil
            </Link>
            <Link to="/a-propos" className={`rounded-xl px-3 py-2 lg:px-4 lg:py-2.5 text-sm lg:text-base font-medium transition-colors whitespace-nowrap ${location.pathname === '/a-propos' ? 'text-[var(--primary)]' : 'text-muted hover:text-[var(--primary)] hover:bg-block'}`}>
              À propos
            </Link>
            <HeaderOptions />
            {!loading && (
              <>
                {isLoggedIn ? (
                  <Link to="/dashboard" className="rounded-xl bg-primary px-4 py-2 lg:px-5 lg:py-2.5 text-sm lg:text-base font-medium text-white transition hover:opacity-90 ml-2 shrink-0">
                    Tableau de bord
                  </Link>
                ) : (
                  <>
                    <Link to="/login" className="rounded-xl border border-theme bg-transparent px-4 py-2 lg:px-5 lg:py-2.5 text-sm lg:text-base font-medium text-body transition hover:bg-block hover:border-[var(--primary)]/30 ml-2 shrink-0">
                      Connexion
                    </Link>
                    <Link to="/register" className="rounded-xl bg-primary px-4 py-2 lg:px-5 lg:py-2.5 text-sm lg:text-base font-medium text-white transition hover:opacity-90 shrink-0">
                      Inscription
                    </Link>
                  </>
                )}
              </>
            )}
          </nav>

          {/* Mobile: bouton hamburger */}
          <button
            type="button"
            onClick={() => setMenuOpen(true)}
            className="md:hidden p-2 rounded-xl border transition shrink-0"
            style={{ borderColor: 'var(--border)', backgroundColor: 'var(--card-bg)', color: 'var(--text)' }}
            aria-label="Ouvrir le menu"
          >
            <MenuIcon className="h-6 w-6" />
          </button>
        </div>
      </header>
      {drawerContent}
    </>
  );
}


