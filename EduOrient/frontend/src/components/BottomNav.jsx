import { NavLink } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import { useMessagingUnread } from '../context/MessagingUnreadContext';

const RECRUITER_ROLES = ['recruteur', 'admin'];

const studentNavItems = [
  { to: '/dashboard', label: 'Accueil', end: true },
  { to: '/dashboard/projets', label: 'Projets' },
  { to: '/dashboard/competences', label: 'Compétences' },
  { to: '/dashboard/messagerie', label: 'Messages' },
  { to: '/dashboard/parametres', label: 'Paramètres' },
];

const recruiterNavItems = [
  { to: '/dashboard/search', label: 'Recherche', end: true },
  { to: '/recruteur/mes-offres', label: 'Mes offres' },
  { to: '/recruteur/ajouter-offre', label: 'Publier' },
  { to: '/dashboard/messagerie', label: 'Messages' },
  { to: '/dashboard/parametres', label: 'Paramètres' },
];

const adminNavItems = [
  { to: '/dashboard/admin', label: 'Stats', end: true },
  { to: '/dashboard/admin/users', label: 'Utilisateurs' },
  { to: '/dashboard/parametres', label: 'Paramètres' },
];

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
function UsersIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
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
function SettingsIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 2.31.826 1.37 1.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 2.31-1.37 1.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-2.31-.826-1.37-1.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-2.31 1.37-1.37.94 1.543 2.31 1.543 2.31 0M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
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

function ChatIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
    </svg>
  );
}

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

const iconByLabel = {
  Accueil: HomeIcon,
  Projets: FolderIcon,
  Compétences: SparklesIcon,
  Messages: ChatIcon,
  Paramètres: SettingsIcon,
  Recherche: SearchIcon,
  Stats: ChartIcon,
  Utilisateurs: UsersIcon,
  'Mes offres': ListBulletIcon,
  Publier: PlusCircleIcon,
};

export default function BottomNav() {
  const { user } = useAuth();
  const { unreadTotal } = useMessagingUnread();
  const roleName = user?.role?.name;
  const isRecruiterOrAdmin = roleName && RECRUITER_ROLES.includes(roleName);
  const navItems =
    roleName === 'admin' ? adminNavItems : isRecruiterOrAdmin ? recruiterNavItems : studentNavItems;

  return (
    <nav
      className="fixed bottom-0 left-0 right-0 z-30 flex items-center justify-around border-t py-2 safe-area-pb md:hidden"
      style={{ backgroundColor: 'var(--card-bg)', borderColor: 'var(--border)' }}
    >
      {navItems.map(({ to, label, end }) => {
        const Icon = iconByLabel[label] || HomeIcon;
        return (
          <NavLink
            key={to}
            to={to}
            end={!!end}
            className={({ isActive }) =>
              `flex flex-col items-center gap-0.5 px-3 py-1 rounded-xl min-w-[64px] transition ${
                isActive ? 'opacity-100' : 'opacity-70'
              }`
            }
            style={({ isActive }) => ({ color: isActive ? 'var(--primary)' : 'var(--muted)' })}
          >
            <span className="relative inline-flex">
              <Icon className="h-5 w-5" />
              {to === '/dashboard/messagerie' && unreadTotal > 0 ? (
                <span
                  className="absolute -right-1 -top-0.5 h-2.5 w-2.5 rounded-full bg-violet-600 ring-2 ring-[var(--card-bg)]"
                  aria-label={`${unreadTotal} non lu${unreadTotal > 1 ? 's' : ''}`}
                />
              ) : null}
            </span>
            <span className="text-xs font-medium truncate max-w-full">{label}</span>
          </NavLink>
        );
      })}
    </nav>
  );
}


