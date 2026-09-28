import { NavLink } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import { useMessagingUnread } from '../context/MessagingUnreadContext';

const RECRUITER_ROLES = ['recruteur', 'admin'];

const studentNavItems = [
  { to: '/dashboard', label: 'Tableau de bord', end: true },
  { to: '/dashboard/projets', label: 'Projets' },
  { to: '/dashboard/competences', label: 'Compétences' },
  { to: '/dashboard/recommandations', label: 'Entreprises & matching' },
  { to: '/dashboard/messagerie', label: 'Messagerie' },
  { to: '/dashboard/portfolio', label: 'Mon portfolio' },
  { to: '/dashboard/parametres', label: 'Paramètres' },
];

const recruiterNavItems = [
  { to: '/dashboard/search', label: 'Recherche étudiants', end: true },
  { to: '/recruteur/mes-offres', label: 'Mes offres' },
  { to: '/recruteur/ajouter-offre', label: 'Publier une offre' },
  { to: '/dashboard/messagerie', label: 'Messagerie' },
  { to: '/dashboard/parametres', label: 'Paramètres' },
];

const adminNavItems = [
  { to: '/dashboard/admin', label: 'Statistiques', end: true },
  { to: '/dashboard/admin/users', label: 'Utilisateurs' },
  { to: '/dashboard/admin/skills', label: 'Dictionnaire Skills' },
  { to: '/dashboard/parametres', label: 'Paramètres' },
];

function MenuIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
    </svg>
  );
}

function CloseIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
    </svg>
  );
}

export default function MobileDrawer({ isOpen, onClose }) {
  const { user } = useAuth();
  const { unreadTotal } = useMessagingUnread();
  const roleName = user?.role?.name;
  const isRecruiterOrAdmin = roleName && RECRUITER_ROLES.includes(roleName);
  const navItems =
    roleName === 'admin' ? adminNavItems : isRecruiterOrAdmin ? recruiterNavItems : studentNavItems;

  if (!isOpen) return null;

  return (
    <>
      <div
        className="fixed inset-0 z-40 bg-black/50 md:hidden"
        onClick={onClose}
        aria-hidden
      />
      <aside
        className="fixed left-0 top-0 z-50 h-full w-64 max-w-[85vw] flex flex-col shadow-xl md:hidden transition-transform duration-200 ease-out"
        style={{ backgroundColor: 'var(--sidebar-bg)' }}
      >
        <div className="flex h-14 items-center justify-between border-b px-4" style={{ borderColor: 'var(--border)' }}>
          <span className="text-lg font-bold" style={{ color: 'var(--text)' }}>ProLink</span>
          <button
            type="button"
            onClick={onClose}
            className="p-2 rounded-lg hover:bg-[var(--border)]/30 transition"
            style={{ color: 'var(--text)' }}
            aria-label="Fermer le menu"
          >
            <CloseIcon className="h-5 w-5" />
          </button>
        </div>
        <nav className="flex-1 overflow-y-auto py-4 px-3 space-y-1">
          {navItems.map(({ to, label, end }) => (
            <NavLink
              key={to}
              to={to}
              end={!!end}
              onClick={onClose}
              className={({ isActive }) =>
                `flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition ${
                  isActive ? 'bg-[var(--sidebar-active)]' : 'hover:bg-[var(--border)]/20'
                }`
              }
              style={({ isActive }) => ({
                color: isActive ? 'var(--primary)' : 'var(--muted)',
              })}
            >
              <span className="flex flex-1 items-center justify-between gap-2">
                <span>{label}</span>
                {to === '/dashboard/messagerie' && unreadTotal > 0 ? (
                  <span className="shrink-0 rounded-full bg-violet-600 px-2 py-0.5 text-[10px] font-bold leading-none text-white">
                    {unreadTotal > 99 ? '99+' : unreadTotal}
                  </span>
                ) : null}
              </span>
            </NavLink>
          ))}
        </nav>
      </aside>
    </>
  );
}

export function HamburgerButton({ onClick }) {
  return (
    <button
      type="button"
      onClick={onClick}
      className="md:hidden p-2 rounded-xl border transition"
      style={{ borderColor: 'var(--border)', backgroundColor: 'var(--card-bg)', color: 'var(--text)' }}
      aria-label="Ouvrir le menu"
    >
      <MenuIcon className="h-6 w-6" />
    </button>
  );
}


