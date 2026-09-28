import { useState, useRef, useEffect, memo } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import HeaderOptions from './HeaderOptions';
import { HamburgerButton } from './MobileDrawer';

function roleLabel(name) {
  return name === 'admin' ? 'Administrateur' : name === 'candidat' ? 'Candidat' : name === 'recruteur' ? 'Recruteur' : name ?? '';
}

function Navbar({ onMenuClick }) {
  const { user, logout } = useAuth();
  const navigate = useNavigate();
  const location = useLocation();
  const [open, setOpen] = useState(false);
  const dropdownRef = useRef(null);
  const isAdminDashboard = location.pathname.startsWith('/dashboard/admin');

  useEffect(() => {
    function handleClickOutside(e) {
      if (dropdownRef.current && !dropdownRef.current.contains(e.target)) setOpen(false);
    }
    document.addEventListener('click', handleClickOutside);
    return () => document.removeEventListener('click', handleClickOutside);
  }, []);

  const handleLogout = () => {
    logout();
    setOpen(false);
    navigate('/login', { replace: true });
  };

  return (
    <header
        className="sticky top-0 z-50 flex h-14 items-center justify-between border-b px-4 md:px-6 bg-card"
        style={{
          backgroundColor: 'var(--navbar-bg)',
          borderColor: 'var(--border)',
          ...(isAdminDashboard ? { boxShadow: '0px 4px 24px rgba(112,144,176,0.06)' } : {}),
        }}
      >
      <div className="flex items-center gap-2 md:gap-4">
        {onMenuClick && <HamburgerButton onClick={onMenuClick} />}
        <h1 className="text-base md:text-lg font-semibold" style={{ color: 'var(--text)' }}>ProLink</h1>
      </div>

      <div className="flex items-center gap-2 md:gap-3">
        <HeaderOptions />
        <div className="relative" ref={dropdownRef}>
        <button
          type="button"
          onClick={() => setOpen((o) => !o)}
          className="flex items-center gap-3 rounded-xl border px-3 py-2 transition"
          style={{ borderColor: 'var(--border)', backgroundColor: 'var(--card-bg)' }}
        >
          <div className="h-8 w-8 rounded-full flex items-center justify-center text-sm font-medium text-white" style={{ backgroundColor: 'var(--primary)' }}>
            {user?.name?.charAt(0) ?? '?'}
          </div>
          <div className="hidden text-left sm:block">
            <p className="text-sm font-medium" style={{ color: 'var(--text)' }}>{user?.name}</p>
            <p className="text-xs" style={{ color: 'var(--muted)' }}>{roleLabel(user?.role?.name)}</p>
          </div>
          <ChevronDownIcon className={`h-4 w-4 transition ${open ? 'rotate-180' : ''}`} style={{ color: 'var(--muted)' }} />
        </button>

        {open && (
          <div className="absolute right-0 mt-2 w-56 rounded-[30px] border py-1 shadow-[0px_18px_40px_rgba(112,144,176,0.12)]" style={{ borderColor: 'var(--border)', backgroundColor: 'var(--card-bg)' }}>
            <div className="border-b px-4 py-3" style={{ borderColor: 'var(--border)' }}>
              <p className="text-sm font-medium" style={{ color: 'var(--text)' }}>{user?.name}</p>
              <p className="truncate text-xs" style={{ color: 'var(--muted)' }}>{user?.email}</p>
            </div>
            <button
              type="button"
              onClick={handleLogout}
              className="flex w-full items-center gap-2 px-4 py-2.5 text-sm transition"
              style={{ color: 'var(--text)' }}
            >
              <LogoutIcon className="h-4 w-4" />
              Déconnexion
            </button>
          </div>
        )}
        </div>
      </div>
    </header>
  );
}

export default memo(Navbar);

function ChevronDownIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
    </svg>
  );
}

function LogoutIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
    </svg>
  );
}


