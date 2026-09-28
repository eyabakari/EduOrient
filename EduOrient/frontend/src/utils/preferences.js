const STORAGE_KEY = 'prolink_preferences';
const LEGACY_STORAGE_KEY = 'eduorient_preferences';

const DEFAULT_PREFS = {
  general: {
    langue: 'fr',
    theme: 'system',
    fuseauHoraire: 'Europe/Paris',
    formatDate: 'DD/MM/YYYY',
  },
  career: { portfolioVisible: true, jobAlerts: [] },
  notifications: { email: true, jobAlerts: true },
  preferencesRecruiter: { alertesCandidats: true, resumeQuotidien: false },
  preferencesAdmin: { alertesModeration: true, lignesParPage: 10 },
  system: { maintenanceMode: false },
  // Admin
  adminUsers: { inscriptionsLibres: true, roleParDefaut: 'candidat' },
  adminSecurity: { politiqueMotDePasse: 'standard', dureeSession: 120 },
  adminAffichage: { couleurPrincipale: '#4318FF', langueDefaut: 'fr' },
  adminSauvegarde: { frequenceSauvegarde: 'daily' },
  adminStatistiques: { affichageDonneesGlobales: true },
  // Étudiant
  studentProfil: { visibilitePublicPrive: true },
  studentPortfolio: {},
  studentProjets: { visibiliteProjets: 'recruteur' },
  studentCompetences: { afficherSoftSkills: true },
  // Recruteur
  recruiterRecherche: { filtreCompetences: true, filtreDomaine: true, filtreNiveau: true },
  recruiterVisibilite: { profilVisibleCandidats: true },
  recruiterCommunication: { messagerieInterne: true },
  recruiterNotifications: { alerteCandidatCorrespond: true },
  recruiterAcces: { dureeValiditeCompte: 365 },
};

export function getPreferences() {
  try {
    let raw = localStorage.getItem(STORAGE_KEY);
    if (!raw) {
      raw = localStorage.getItem(LEGACY_STORAGE_KEY);
      if (raw) {
        try {
          localStorage.setItem(STORAGE_KEY, raw);
          localStorage.removeItem(LEGACY_STORAGE_KEY);
        } catch {
          /* ignore quota / private mode */
        }
      }
    }
    if (!raw) return { ...JSON.parse(JSON.stringify(DEFAULT_PREFS)) };
    const parsed = JSON.parse(raw);
    return {
      general: { ...DEFAULT_PREFS.general, ...parsed.general },
      career: { ...DEFAULT_PREFS.career, ...parsed.career },
      notifications: { ...DEFAULT_PREFS.notifications, ...parsed.notifications },
      preferencesRecruiter: { ...DEFAULT_PREFS.preferencesRecruiter, ...parsed.preferencesRecruiter },
      preferencesAdmin: { ...DEFAULT_PREFS.preferencesAdmin, ...parsed.preferencesAdmin },
      system: { ...DEFAULT_PREFS.system, ...parsed.system },
      adminUsers: { ...DEFAULT_PREFS.adminUsers, ...parsed.adminUsers },
      adminSecurity: { ...DEFAULT_PREFS.adminSecurity, ...parsed.adminSecurity },
      adminAffichage: { ...DEFAULT_PREFS.adminAffichage, ...parsed.adminAffichage },
      adminSauvegarde: { ...DEFAULT_PREFS.adminSauvegarde, ...parsed.adminSauvegarde },
      adminStatistiques: { ...DEFAULT_PREFS.adminStatistiques, ...parsed.adminStatistiques },
      studentProfil: { ...DEFAULT_PREFS.studentProfil, ...parsed.studentProfil },
      studentPortfolio: { ...DEFAULT_PREFS.studentPortfolio, ...parsed.studentPortfolio },
      studentProjets: { ...DEFAULT_PREFS.studentProjets, ...parsed.studentProjets },
      studentCompetences: { ...DEFAULT_PREFS.studentCompetences, ...parsed.studentCompetences },
      recruiterRecherche: { ...DEFAULT_PREFS.recruiterRecherche, ...parsed.recruiterRecherche },
      recruiterVisibilite: { ...DEFAULT_PREFS.recruiterVisibilite, ...parsed.recruiterVisibilite },
      recruiterCommunication: { ...DEFAULT_PREFS.recruiterCommunication, ...parsed.recruiterCommunication },
      recruiterNotifications: { ...DEFAULT_PREFS.recruiterNotifications, ...parsed.recruiterNotifications },
      recruiterAcces: { ...DEFAULT_PREFS.recruiterAcces, ...parsed.recruiterAcces },
    };
  } catch {
    return { ...JSON.parse(JSON.stringify(DEFAULT_PREFS)) };
  }
}

export function savePreferences(prefs) {
  try {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(prefs));
    return true;
  } catch {
    return false;
  }
}

export function applyTheme(theme) {
  const root = document.documentElement;
  const isDark =
    theme === 'dark' ||
    (theme === 'system' && typeof window !== 'undefined' && window.matchMedia('(prefers-color-scheme: dark)').matches);
  if (isDark) {
    root.classList.add('dark');
    root.style.colorScheme = 'dark';
  } else {
    root.classList.remove('dark');
    root.style.colorScheme = 'light';
  }
}

export function getEffectiveTheme() {
  const prefs = getPreferences();
  const theme = prefs.general?.theme ?? 'system';
  if (theme !== 'system') return theme;
  return typeof window !== 'undefined' && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
}

