import { memo } from 'react';
import { NavLink } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import { useMessagingUnread } from '../context/MessagingUnreadContext';

const RECRUITER_ROLES = ['recruteur', 'admin'];

const studentNavItems = [
  { to: '/dashboard', icon: HomeIcon, label: 'Tableau de bord', end: true },
  { to: '/dashboard/projets', icon: FolderIcon, label: 'Projets' },
  { to: '/dashboard/competences', icon: SparklesIcon, label: 'Compétences' },
  { to: '/dashboard/recommandations', icon: ChartIcon, label: 'Entreprises & matching' },
  { to: '/dashboard/messagerie', icon: ChatIcon, label: 'Messagerie' },
  { to: '/dashboard/portfolio', icon: PortfolioIcon, label: 'Mon portfolio' },
  { to: '/dashboard/parametres', icon: SettingsIcon, label: 'Paramètres' },
];

const recruiterNavItems = [
  { to: '/dashboard/search', icon: SearchIcon, label: 'Recherche étudiants', end: true },
  { to: '/recruteur/mes-offres', icon: ListBulletIcon, label: 'Mes offres' },
  { to: '/recruteur/ajouter-offre', icon: PlusCircleIcon, label: 'Publier une offre' },
  { to: '/dashboard/messagerie', icon: ChatIcon, label: 'Messagerie' },
  { to: '/dashboard/parametres', icon: SettingsIcon, label: 'Paramètres' },
];

const adminNavItems = [
  { to: '/dashboard/admin', icon: StatsIcon, label: 'Statistiques', end: true },
  { to: '/dashboard/admin/users', icon: UsersIcon, label: 'Utilisateurs' },
  { to: '/dashboard/admin/skills', icon: SparklesIcon, label: 'Dictionnaire Skills' },
  { to: '/dashboard/parametres', icon: SettingsIcon, label: 'Paramètres' },
];

function Sidebar() {
  const { user } = useAuth();
  const { unreadTotal } = useMessagingUnread();
  const roleName = user?.role?.name;
  const isRecruiterOrAdmin = roleName && RECRUITER_ROLES.includes(roleName);
  const navItems =
    roleName === 'admin'
      ? adminNavItems
      : isRecruiterOrAdmin
        ? recruiterNavItems
        : studentNavItems;

  return (
    <aside className="hidden md:flex fixed left-0 top-0 z-50 h-screen w-16 flex-col" style={{ backgroundColor: 'var(--sidebar-bg)' }}>
      <div className="flex h-14 items-center justify-center border-b" style={{ borderColor: 'var(--border)' }}>
        <span className="text-lg font-bold" style={{ color: 'var(--text)' }}>P</span>
      </div>
      <nav className="flex-1 flex flex-col items-stretch gap-0.5 py-4 px-0">
        {navItems.map(({ to, icon: Icon, label, end }) => (
          <NavLink
            key={to}
            to={to}
            end={!!end}
            className={({ isActive }) =>
              `flex h-11 w-full items-center justify-center rounded-r-xl transition-colors ${
                isActive ? 'border-l-[3px]' : ''
              }`
            }
            style={({ isActive }) => ({
              backgroundColor: isActive ? 'var(--sidebar-active)' : 'transparent',
              color: isActive ? 'var(--primary)' : 'var(--muted)',
              borderLeftColor: isActive ? 'var(--primary)' : 'transparent',
            })}
            title={label}
          >
            <span className="relative inline-flex items-center justify-center">
              <Icon className="h-5 w-5" />
              {to === '/dashboard/messagerie' && unreadTotal > 0 ? (
                <span
                  className="absolute -right-0.5 -top-0.5 h-2.5 w-2.5 rounded-full bg-violet-600 ring-2 ring-[var(--sidebar-bg)]"
                  aria-label={`${unreadTotal} message${unreadTotal > 1 ? 's' : ''} non lu${unreadTotal > 1 ? 's' : ''}`}
                />
              ) : null}
            </span>
          </NavLink>
        ))}
      </nav>
    </aside>
  );
}

export default memo(Sidebar);

function HomeIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
    </svg>
  );
}

function FolderIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
    </svg>
  );
}

function SparklesIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
    </svg>
  );
}

function ChartIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
    </svg>
  );
}

function PortfolioIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
    </svg>
  );
}

function SearchIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>
  );
}

/** Heroicons outline : plus-circle */
function PlusCircleIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden>
      <path
        strokeLinecap="round"
        strokeLinejoin="round"
        strokeWidth={2}
        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
      />
    </svg>
  );
}

function ListBulletIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden>
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h10" />
    </svg>
  );
}

function ChatIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
    </svg>
  );
}

function StatsIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
    </svg>
  );
}

function SettingsIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 2.31.826 1.37 1.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 2.31-1.37 1.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-2.31-.826-1.37-1.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-2.31 1.37-1.37.94 1.543 2.31 1.543 2.31 0M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
  );
}

function UsersIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
    </svg>
  );
}


