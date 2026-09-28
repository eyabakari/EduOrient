import { useState, useEffect, useMemo } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { User, Lock, Settings as SettingsIcon } from 'lucide-react';
import DashboardLayout from '../components/DashboardLayout';
import { useAuth } from '../context/AuthContext';
import { useNotification } from '../context/NotificationContext';
import api, { getStorageUrl } from '../api/axios';
import { getPreferences, savePreferences as persistPreferences, applyTheme } from '../utils/preferences';
import { TUNISIA_GOVERNORATES } from '../constants/tunisiaGovernorates';

const PAGE_BG = 'var(--page-bg)';
const CARD_BG = 'var(--card-bg)';
const CARD_SHADOW = '0px 18px 40px rgba(112,144,176,0.12)';
const PRIMARY = 'var(--primary)';
const BORDER = 'var(--border)';
const TEXT = 'var(--text)';
const MUTED = 'var(--muted)';

const SETTINGS_TABS = [
  { id: 'profile', label: 'Profil', icon: User },
  { id: 'security', label: 'Sécurité', icon: Lock },
  { id: 'preferences', label: 'Préférences', icon: SettingsIcon },
];

const inputClass = 'w-full rounded-xl border-2 px-4 py-3 bg-[var(--card-bg)] text-[var(--text)] placeholder-[var(--muted)] focus:outline-none focus:border-[#9D7BFF] focus:ring-2 focus:ring-[#9D7BFF]/25 transition-all duration-200';
function Input({ error, touched, ...props }) {
  const borderColor = error ? '#ef4444' : touched ? '#22c55e' : BORDER;
  return <input {...props} className={inputClass} style={{ borderColor }} />;
}

function Switch({ checked, onChange, disabled }) {
  return (
    <button
      type="button"
      role="switch"
      aria-checked={checked}
      disabled={disabled}
      onClick={() => onChange(!checked)}
      className="relative inline-flex h-7 w-12 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#9D7BFF]/40 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
      style={{ backgroundColor: checked ? '#9D7BFF' : 'var(--switch-off)' }}
    >
      <span
        className="pointer-events-none inline-block h-6 w-6 transform rounded-full bg-white shadow ring-0 transition duration-200"
        style={{ transform: checked ? 'translateX(1.25rem)' : 'translateX(0.125rem)', marginTop: '1px' }}
      />
    </button>
  );
}

function SettingsSkeleton() {
  return (
    <div className="animate-pulse space-y-6">
      <div className="h-8 w-48 rounded-lg" style={{ backgroundColor: BORDER }} />
      <div className="rounded-2xl p-6 border border-[#E9EDF7] shadow-[0px_18px_40px_rgba(112,144,176,0.12)]" style={{ backgroundColor: CARD_BG }}>
        <div className="flex items-center gap-4">
          <div className="h-20 w-20 rounded-full" style={{ backgroundColor: BORDER }} />
          <div className="flex-1 space-y-2">
            <div className="h-4 w-3/4 rounded" style={{ backgroundColor: BORDER }} />
            <div className="h-4 w-1/2 rounded" style={{ backgroundColor: BORDER }} />
          </div>
        </div>
        <div className="mt-6 space-y-4">
          <div className="h-12 w-full rounded-xl" style={{ backgroundColor: BORDER }} />
          <div className="h-12 w-full rounded-xl" style={{ backgroundColor: BORDER }} />
          <div className="h-12 w-32 rounded-xl" style={{ backgroundColor: BORDER }} />
        </div>
      </div>
      <div className="rounded-2xl p-6 border border-[#E9EDF7] shadow-[0px_18px_40px_rgba(112,144,176,0.12)]" style={{ backgroundColor: CARD_BG }}>
        <div className="h-4 w-40 rounded" style={{ backgroundColor: BORDER }} />
        <div className="mt-4 space-y-3">
          <div className="h-10 w-full rounded-lg" style={{ backgroundColor: BORDER }} />
          <div className="h-10 w-full rounded-lg" style={{ backgroundColor: BORDER }} />
        </div>
      </div>
    </div>
  );
}

export default function Settings() {
  const { user, refreshMe, loading: authLoading } = useAuth();
  const { notifySuccess, notifyError } = useNotification();
  const roleName = user?.role?.name ?? 'candidat';
  const isAdminRole = roleName === 'admin';
  const tabs = useMemo(
    () => (isAdminRole ? SETTINGS_TABS.filter((t) => t.id !== 'preferences') : SETTINGS_TABS),
    [isAdminRole]
  );

  const [activeTab, setActiveTab] = useState('profile');
  const [form, setForm] = useState({
    prenom: '',
    nom: '',
    bio: '',
    niveau_etude: '',
    specialite: '',
    linkedin: '',
    entreprise: '',
    poste: '',
    siteWeb: '',
    ville: '',
    gouvernorat: '',
    company_description: '',
    photo: null,
  });
  const [recruiterSkillIds, setRecruiterSkillIds] = useState([]);
  const [allSkills, setAllSkills] = useState([]);
  const [passwordForm, setPasswordForm] = useState({ current: '', new: '', confirm: '' });
  const [career, setCareer] = useState({ portfolioVisible: true, jobAlerts: [] });
  const [preferencesRecruiter, setPreferencesRecruiter] = useState({ alertesCandidats: true, resumeQuotidien: false });
  const [notifications, setNotifications] = useState({ email: true, jobAlerts: true });
  const [generalPrefs, setGeneralPrefs] = useState({
    langue: 'fr',
    theme: 'system',
    fuseauHoraire: 'Europe/Paris',
    formatDate: 'DD/MM/YYYY',
  });
  // Étudiant
  const [studentProfil, setStudentProfil] = useState({ visibilitePublicPrive: true });
  const [studentPortfolio, setStudentPortfolio] = useState({});
  const [studentProjets, setStudentProjets] = useState({ visibiliteProjets: 'recruteur' });
  const [studentCompetences, setStudentCompetences] = useState({ afficherSoftSkills: true });
  // Recruteur
  const [recruiterRecherche, setRecruiterRecherche] = useState({ filtreCompetences: true, filtreDomaine: true, filtreNiveau: true });
  const [recruiterVisibilite, setRecruiterVisibilite] = useState({ profilVisibleCandidats: true });
  const [recruiterCommunication, setRecruiterCommunication] = useState({ messagerieInterne: true });
  const [recruiterNotifications, setRecruiterNotifications] = useState({ alerteCandidatCorrespond: true });
  const [recruiterAcces, setRecruiterAcces] = useState({ dureeValiditeCompte: 365 });
  const [errors, setErrors] = useState({});
  const [submitting, setSubmitting] = useState(false);
  const [touched, setTouched] = useState({});

  useEffect(() => {
    if (!user) return;
    const fullName = user.name ?? '';
    const parts = fullName.trim().split(/\s+/);
    const prenom = parts[0] ?? '';
    const nom = parts.slice(1).join(' ') ?? '';
    setForm((prev) => ({
      ...prev,
      prenom,
      nom,
      bio: user.candidat?.bio ?? '',
      niveau_etude: user.candidat?.niveau_etude ?? '',
      specialite: user.candidat?.specialite ?? '',
      linkedin: user.candidat?.linkedin ?? '',
      entreprise: user.company?.name ?? user.recruteur?.entreprise ?? '',
      poste: user.recruteur?.poste ?? '',
      siteWeb: user.recruteur?.site_web ?? '',
      ville: user.company?.ville ?? '',
      gouvernorat: user.company?.gouvernorat ?? '',
      company_description: user.company?.description ?? '',
    }));
    if (user.recruteur?.skills) {
      setRecruiterSkillIds(user.recruteur.skills.map((s) => Number(s.id)));
    } else {
      setRecruiterSkillIds([]);
    }
    const pub = user.candidat?.portfolio_public ?? undefined;
    if (pub !== undefined) {
      setCareer((prev) => ({ ...prev, portfolioVisible: !!pub }));
      setStudentProfil((prev) => ({ ...prev, visibilitePublicPrive: !!pub }));
    }
  }, [user]);

  useEffect(() => {
    if (!user || user.role?.name !== 'recruteur') return;
    api
      .get('/all-skills')
      .then((res) => setAllSkills(Array.isArray(res.data?.data) ? res.data.data : []))
      .catch(() => setAllSkills([]));
  }, [user]);

  useEffect(() => {
    if (isAdminRole && activeTab === 'preferences') setActiveTab('profile');
  }, [isAdminRole, activeTab]);

  useEffect(() => {
    const prefs = getPreferences();
    setGeneralPrefs((prev) => ({ ...prev, ...prefs.general }));
    setCareer((prev) => ({ ...prev, ...prefs.career }));
    setNotifications((prev) => ({ ...prev, ...prefs.notifications }));
    setPreferencesRecruiter((prev) => ({ ...prev, ...prefs.preferencesRecruiter }));
    if (prefs.studentProfil) setStudentProfil((prev) => ({ ...prev, ...prefs.studentProfil }));
    if (prefs.studentPortfolio) setStudentPortfolio((prev) => ({ ...prev, ...prefs.studentPortfolio }));
    if (prefs.studentProjets) setStudentProjets((prev) => ({ ...prev, ...prefs.studentProjets }));
    if (prefs.studentCompetences) setStudentCompetences((prev) => ({ ...prev, ...prefs.studentCompetences }));
    if (prefs.recruiterRecherche) setRecruiterRecherche((prev) => ({ ...prev, ...prefs.recruiterRecherche }));
    if (prefs.recruiterVisibilite) setRecruiterVisibilite((prev) => ({ ...prev, ...prefs.recruiterVisibilite }));
    if (prefs.recruiterCommunication) setRecruiterCommunication((prev) => ({ ...prev, ...prefs.recruiterCommunication }));
    if (prefs.recruiterNotifications) setRecruiterNotifications((prev) => ({ ...prev, ...prefs.recruiterNotifications }));
    if (prefs.recruiterAcces) setRecruiterAcces((prev) => ({ ...prev, ...prefs.recruiterAcces }));
  }, []);

  useEffect(() => {
    if (!user) return;
    api.get('/profile/settings')
      .then((res) => {
        const prefs = res.data?.preferences ?? {};
        if (Object.keys(prefs).length === 0) return;
        if (prefs.general) setGeneralPrefs((prev) => ({ ...prev, ...prefs.general }));
        if (prefs.career) setCareer((prev) => ({ ...prev, ...prefs.career }));
        if (prefs.notifications) setNotifications((prev) => ({ ...prev, ...prefs.notifications }));
        if (prefs.studentProfil) setStudentProfil((prev) => ({ ...prev, ...prefs.studentProfil }));
        if (prefs.studentPortfolio) setStudentPortfolio((prev) => ({ ...prev, ...prefs.studentPortfolio }));
        if (prefs.studentProjets) setStudentProjets((prev) => ({ ...prev, ...prefs.studentProjets }));
        if (prefs.studentCompetences) setStudentCompetences((prev) => ({ ...prev, ...prefs.studentCompetences }));
        if (prefs.recruiterRecherche) setRecruiterRecherche((prev) => ({ ...prev, ...prefs.recruiterRecherche }));
        if (prefs.recruiterVisibilite) setRecruiterVisibilite((prev) => ({ ...prev, ...prefs.recruiterVisibilite }));
        if (prefs.recruiterCommunication) setRecruiterCommunication((prev) => ({ ...prev, ...prefs.recruiterCommunication }));
        if (prefs.recruiterNotifications) setRecruiterNotifications((prev) => ({ ...prev, ...prefs.recruiterNotifications }));
        if (prefs.recruiterAcces) setRecruiterAcces((prev) => ({ ...prev, ...prefs.recruiterAcces }));
        if (prefs.preferencesRecruiter) setPreferencesRecruiter((prev) => ({ ...prev, ...prefs.preferencesRecruiter }));
        if (prefs.form?.siteWeb !== undefined) setForm((prev) => ({ ...prev, siteWeb: prefs.form.siteWeb }));
      })
      .catch(() => {});
  }, [user]);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setForm((prev) => ({ ...prev, [name]: value }));
    setTouched((prev) => ({ ...prev, [name]: true }));
    if (errors[name]) setErrors((prev) => ({ ...prev, [name]: null }));
  };

  const handlePhotoChange = (e) => {
    setForm((prev) => ({ ...prev, photo: e.target.files?.[0] || null }));
    if (errors.photo) setErrors((prev) => ({ ...prev, photo: null }));
  };

  const saveProfile = async (e) => {
    e?.preventDefault();
    setErrors({});
    setSubmitting(true);
    try {
      const hasPhoto = form.photo instanceof File;
      const payload = hasPhoto
        ? (() => {
            const fd = new FormData();
            fd.append('_method', 'PUT');
            fd.append('name', [form.prenom, form.nom].filter(Boolean).join(' ').trim() || '');
            fd.append('photo', form.photo);
            if (user?.candidat) {
              fd.append('bio', form.bio ?? '');
              fd.append('niveau_etude', form.niveau_etude ?? '');
              fd.append('specialite', form.specialite ?? '');
              fd.append('linkedin', form.linkedin ?? '');
            }
            if (user?.recruteur) {
              fd.append('entreprise', form.entreprise ?? '');
              fd.append('poste', form.poste ?? '');
              fd.append('site_web', form.siteWeb ?? '');
              fd.append('ville', form.ville ?? '');
              fd.append('gouvernorat', form.gouvernorat ?? '');
              fd.append('company_description', form.company_description ?? '');
              recruiterSkillIds.forEach((id) => fd.append('skill_ids[]', String(id)));
            }
            if (user?.candidat) fd.append('portfolio_public', career.portfolioVisible ? '1' : '0');
            return fd;
          })()
        : {
            name: [form.prenom, form.nom].filter(Boolean).join(' ').trim() || '',
            ...(user?.candidat && { bio: form.bio, niveau_etude: form.niveau_etude, specialite: form.specialite, linkedin: form.linkedin, portfolio_public: career.portfolioVisible }),
            ...(user?.recruteur && {
              entreprise: form.entreprise,
              poste: form.poste,
              site_web: form.siteWeb,
              ville: form.ville,
              gouvernorat: form.gouvernorat,
              company_description: form.company_description,
              skill_ids: recruiterSkillIds,
            }),
          };
      await (hasPhoto ? api.post('/profile', payload) : api.put('/profile', payload));
      await refreshMe();
      setForm((prev) => (prev.photo instanceof File ? { ...prev, photo: null } : prev));
      notifySuccess('Profil enregistré.');
    } catch (err) {
      if (err.response?.status === 422 && err.response?.data?.errors) setErrors(err.response.data.errors);
      else notifyError(err.response?.data?.message || 'Erreur.');
    } finally {
      setSubmitting(false);
    }
  };

  const savePassword = async (e) => {
    e?.preventDefault();
    if (passwordForm.new !== passwordForm.confirm) {
      notifyError('Les mots de passe ne correspondent pas.');
      return;
    }
    if (!passwordForm.current || !passwordForm.new) {
      notifyError('Veuillez remplir tous les champs.');
      return;
    }
    setSubmitting(true);
    try {
      await api.put('/profile/password', {
        current_password: passwordForm.current,
        password: passwordForm.new,
        password_confirmation: passwordForm.confirm,
      });
      notifySuccess('Mot de passe modifié avec succès.');
      setPasswordForm({ current: '', new: '', confirm: '' });
    } catch (err) {
      const msg = err.response?.data?.message || err.response?.data?.errors?.current_password?.[0] || 'Erreur lors du changement de mot de passe.';
      notifyError(msg);
    } finally {
      setSubmitting(false);
    }
  };

  const savePreferences = async () => {
    const prefs = {
      general: generalPrefs,
      career,
      notifications,
      preferencesRecruiter,
      studentProfil,
      studentPortfolio,
      studentProjets,
      studentCompetences,
      recruiterRecherche,
      recruiterVisibilite,
      recruiterCommunication,
      recruiterNotifications,
      recruiterAcces,
    };
    setSubmitting(true);
    try {
      await api.put('/profile/settings', { preferences: prefs });
      persistPreferences(prefs);
      applyTheme(generalPrefs.theme);
      notifySuccess('Préférences enregistrées avec succès.');
    } catch (err) {
      notifyError(err.response?.data?.message || 'Erreur lors de l\'enregistrement.');
    } finally {
      setSubmitting(false);
    }
  };

  const photoPreview = form.photo instanceof File ? URL.createObjectURL(form.photo) : getStorageUrl(user?.photo_url);
  const displayName = [form.prenom, form.nom].filter(Boolean).join(' ') || user?.name || '';
  const initial = (displayName || '?').charAt(0).toUpperCase();
  const isStudent = roleName === 'candidat';
  const isRecruiter = roleName === 'recruteur';

  if (authLoading || !user) {
    return (
      <DashboardLayout>
        <div className="mx-auto max-w-4xl">
          <SettingsSkeleton />
        </div>
      </DashboardLayout>
    );
  }

  return (
    <DashboardLayout>
          <div className="mx-auto max-w-5xl">
            <motion.header initial={{ opacity: 0, y: 8 }} animate={{ opacity: 1, y: 0 }} className="mb-8">
              <div className="flex items-center gap-3 mb-2">
                <span className="h-1 w-12 rounded-full bg-[#9D7BFF]" />
                <h1 className="text-2xl md:text-3xl font-bold tracking-tight" style={{ color: TEXT }}>Paramètres</h1>
              </div>
              <p className="text-sm md:text-base ml-14" style={{ color: MUTED }}>
                {isAdminRole ? 'Profil et sécurité.' : 'Profil, sécurité et préférences selon votre rôle.'}
              </p>
            </motion.header>
            <div className="flex flex-col md:flex-row gap-6 md:gap-8">
            {/* Left: sidebar navigation */}
            <nav className="w-full md:w-56 shrink-0 space-y-0.5" role="tablist" aria-label="Paramètres">
              {tabs.map((tab) => {
                const Icon = tab.icon;
                const isActive = activeTab === tab.id;
                return (
                  <div
                    key={tab.id}
                    role="tab"
                    aria-selected={isActive}
                    tabIndex={isActive ? 0 : -1}
                    onClick={() => setActiveTab(tab.id)}
                    onKeyDown={(e) => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); setActiveTab(tab.id); } }}
                    className={`flex w-full cursor-pointer items-center gap-3 rounded-xl px-4 py-3 text-left text-sm font-medium transition-all duration-200 ${
                      isActive ? 'bg-gradient-to-br from-[#EDE7F6] to-[#E8E0F5] shadow-md shadow-[#9D7BFF]/15 text-[#4C1D95]' : 'hover:bg-[#F5F6FA]'
                    }`}
                    style={!isActive ? { color: 'var(--muted)' } : undefined}
                  >
                    <Icon className="h-5 w-5 shrink-0" style={{ color: isActive ? '#9D7BFF' : undefined }} aria-hidden />
                    {tab.label}
                  </div>
                );
              })}
            </nav>

            {/* Right: content */}
            <div className="min-w-0 flex-1">
              <AnimatePresence mode="wait">
                {activeTab === 'profile' && (
                  <motion.div
                    key="profile"
                    initial={{ opacity: 0, x: 8 }}
                    animate={{ opacity: 1, x: 0 }}
                    exit={{ opacity: 0, x: -8 }}
                    transition={{ duration: 0.2 }}
                    className="flex-1 min-w-0 rounded-2xl border border-[#E9EDF7] p-6 md:p-8 shadow-[0px_18px_40px_rgba(112,144,176,0.12)]"
                    style={{ backgroundColor: CARD_BG }}
                  >
                    <h2 className="text-xl font-bold" style={{ color: TEXT }}>Profil</h2>
                    <p className="mt-1 text-sm" style={{ color: MUTED }}>Identité et informations personnelles.</p>
                    <form onSubmit={saveProfile} className="mt-8 space-y-6">
                      {isStudent && (
                        <>
                          <div className="flex flex-col sm:flex-row sm:items-start gap-6">
                            <div className="relative h-28 w-28 shrink-0 overflow-hidden rounded-full border-2" style={{ borderColor: BORDER, backgroundColor: 'var(--block-bg)' }}>
                              {photoPreview ? (
                                <img src={photoPreview} alt="" className="h-full w-full object-cover" loading="lazy" />
                              ) : (
                                <span className="flex h-full w-full items-center justify-center text-3xl font-bold" style={{ color: `${PRIMARY}99` }}>{initial}</span>
                              )}
                            </div>
                            <div className="flex flex-wrap gap-2 items-center sm:items-start">
                              <label className="rounded-xl px-4 py-2.5 text-sm font-semibold text-white cursor-pointer bg-gradient-to-r from-[#9D7BFF] to-[#8B6FE8] hover:from-[#8B6FE8] hover:to-[#7C5FD9] transition-all duration-200 shadow-md shadow-[#9D7BFF]/25">
                                Téléverser une photo
                                <input type="file" accept="image/*" onChange={handlePhotoChange} className="sr-only" />
                              </label>
                              <button type="button" onClick={() => setForm((p) => ({ ...p, photo: null }))} className="rounded-xl border-2 px-4 py-2.5 text-sm font-semibold transition-colors" style={{ borderColor: BORDER, color: TEXT, backgroundColor: 'var(--block-bg)' }}>Supprimer</button>
                            </div>
                          </div>
                          {errors?.photo?.[0] && <p className="text-sm text-red-500">{errors.photo[0]}</p>}
                        </>
                      )}
                      <div className="grid gap-4 sm:grid-cols-2">
                        <div>
                          <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Prénom</label>
                          <Input name="prenom" value={form.prenom} onChange={handleChange} placeholder="Prénom" error={errors.name} touched={touched.prenom} />
                        </div>
                        <div>
                          <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Nom</label>
                          <Input name="nom" value={form.nom} onChange={handleChange} placeholder="Nom de famille" error={errors.nom} touched={touched.nom} />
                        </div>
                      </div>
                      <div>
                        <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Email</label>
                        <input type="email" value={user?.email ?? ''} readOnly className={`${inputClass} cursor-not-allowed`} style={{ borderColor: BORDER, color: MUTED, backgroundColor: 'var(--block-bg)' }} />
                      </div>
                      {isRecruiter && (
                        <div className="space-y-4 border-t pt-6" style={{ borderColor: BORDER }}>
                          <h3 className="text-sm font-semibold" style={{ color: TEXT }}>Entreprise</h3>
                          <div>
                            <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Nom de l&apos;entreprise</label>
                            <Input name="entreprise" value={form.entreprise} onChange={handleChange} placeholder="Nom légal ou marque" />
                            {errors?.entreprise?.[0] && <p className="mt-1.5 text-sm text-red-500">{errors.entreprise[0]}</p>}
                          </div>
                          <div className="grid gap-4 sm:grid-cols-2">
                            <div>
                              <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Ville</label>
                              <Input name="ville" value={form.ville} onChange={handleChange} placeholder="Ville" />
                              {errors?.ville?.[0] && <p className="mt-1.5 text-sm text-red-500">{errors.ville[0]}</p>}
                            </div>
                            <div>
                              <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Gouvernorat</label>
                              <select name="gouvernorat" value={form.gouvernorat} onChange={handleChange} className={inputClass} style={{ borderColor: BORDER }}>
                                <option value="">—</option>
                                {TUNISIA_GOVERNORATES.map((g) => (
                                  <option key={g} value={g}>{g}</option>
                                ))}
                              </select>
                              {errors?.gouvernorat?.[0] && <p className="mt-1.5 text-sm text-red-500">{errors.gouvernorat[0]}</p>}
                            </div>
                          </div>
                          <div>
                            <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Description de l&apos;activité</label>
                            <textarea name="company_description" value={form.company_description} onChange={handleChange} rows={4} className={`${inputClass} resize-none`} style={{ borderColor: errors.company_description ? '#ef4444' : BORDER }} placeholder="Présentation de la société (min. 20 caractères si renseignée)" />
                            {errors?.company_description?.[0] && <p className="mt-1.5 text-sm text-red-500">{errors.company_description[0]}</p>}
                          </div>
                          <div>
                            <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Votre poste</label>
                            <Input name="poste" value={form.poste} onChange={handleChange} placeholder="Fonction" />
                            {errors?.poste?.[0] && <p className="mt-1.5 text-sm text-red-500">{errors.poste[0]}</p>}
                          </div>
                          <div>
                            <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Site web</label>
                            <input name="siteWeb" type="url" value={form.siteWeb} onChange={handleChange} placeholder="https://..." className={inputClass} style={{ borderColor: BORDER }} />
                          </div>
                          <div>
                            <p className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Technologies / stack</p>
                            <div className="max-h-44 overflow-y-auto rounded-xl border p-3 space-y-2" style={{ borderColor: BORDER, backgroundColor: 'var(--block-bg)' }}>
                              {allSkills.length === 0 ? (
                                <p className="text-sm" style={{ color: MUTED }}>Chargement des compétences…</p>
                              ) : (
                                <div className="flex flex-wrap gap-2">
                                  {allSkills.map((s) => {
                                    const id = Number(s.id);
                                    const checked = recruiterSkillIds.includes(id);
                                    return (
                                      <label key={s.id} className={`inline-flex cursor-pointer items-center gap-2 rounded-lg border px-2.5 py-1.5 text-xs ${checked ? 'border-violet-400 bg-violet-50' : ''}`} style={{ borderColor: checked ? undefined : BORDER }}>
                                        <input type="checkbox" className="rounded" checked={checked} onChange={() => setRecruiterSkillIds((prev) => (prev.includes(id) ? prev.filter((x) => x !== id) : [...prev, id]))} />
                                        {s.nom}
                                      </label>
                                    );
                                  })}
                                </div>
                              )}
                            </div>
                            {errors?.skill_ids?.[0] && <p className="mt-1.5 text-sm text-red-500">{errors.skill_ids[0]}</p>}
                          </div>
                        </div>
                      )}
                      {isStudent && (
                        <div>
                          <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Bio</label>
                          <textarea name="bio" value={form.bio} onChange={handleChange} rows={3} placeholder="Présentation courte" className={`${inputClass} resize-none`} style={{ borderColor: errors.bio ? '#ef4444' : BORDER }} />
                          {errors?.bio?.[0] && <p className="mt-1.5 text-sm text-red-500">{errors.bio[0]}</p>}
                        </div>
                      )}
                      <button type="submit" disabled={submitting} className="rounded-xl px-6 py-3 text-sm font-semibold text-white disabled:opacity-60 bg-gradient-to-r from-[#9D7BFF] to-[#8B6FE8] shadow-lg shadow-[#9D7BFF]/30 hover:from-[#8B6FE8] hover:to-[#7C5FD9] transition-all duration-200">
                        {submitting ? 'Enregistrement…' : 'Enregistrer les modifications'}
                      </button>
                    </form>
                  </motion.div>
                )}

                {activeTab === 'security' && (
                  <motion.div
                    key="security"
                    initial={{ opacity: 0, x: 8 }}
                    animate={{ opacity: 1, x: 0 }}
                    exit={{ opacity: 0, x: -8 }}
                    transition={{ duration: 0.2 }}
                    className="flex-1 min-w-0 rounded-2xl border border-[#E9EDF7] p-6 md:p-8 shadow-[0px_18px_40px_rgba(112,144,176,0.12)]"
                    style={{ backgroundColor: CARD_BG }}
                  >
                    <h2 className="text-xl font-bold" style={{ color: TEXT }}>Sécurité</h2>
                    <p className="mt-1 text-sm" style={{ color: MUTED }}>Accès et authentification.</p>
                    <form onSubmit={savePassword} className="mt-8 space-y-6 max-w-md">
                      <div>
                        <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Mot de passe actuel</label>
                        <input type="password" value={passwordForm.current} onChange={(e) => setPasswordForm((p) => ({ ...p, current: e.target.value }))} placeholder="••••••••" className={inputClass} style={{ borderColor: BORDER }} />
                      </div>
                      <div>
                        <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Nouveau mot de passe</label>
                        <input type="password" value={passwordForm.new} onChange={(e) => setPasswordForm((p) => ({ ...p, new: e.target.value }))} placeholder="••••••••" className={inputClass} style={{ borderColor: BORDER }} />
                      </div>
                      <div>
                        <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Confirmer le mot de passe</label>
                        <input type="password" value={passwordForm.confirm} onChange={(e) => setPasswordForm((p) => ({ ...p, confirm: e.target.value }))} placeholder="••••••••" className={inputClass} style={{ borderColor: BORDER }} />
                      </div>
                      <button type="submit" disabled={submitting} className="rounded-xl px-6 py-3 text-sm font-semibold text-white disabled:opacity-60 bg-gradient-to-r from-[#9D7BFF] to-[#8B6FE8] shadow-lg shadow-[#9D7BFF]/30 hover:from-[#8B6FE8] hover:to-[#7C5FD9] transition-all duration-200">
                        {submitting ? 'Enregistrement…' : 'Enregistrer'}
                      </button>
                    </form>
                  </motion.div>
                )}

                {activeTab === 'preferences' && (
                  <motion.div
                    key="preferences"
                    initial={{ opacity: 0, x: 8 }}
                    animate={{ opacity: 1, x: 0 }}
                    exit={{ opacity: 0, x: -8 }}
                    transition={{ duration: 0.2 }}
                    className="flex-1 min-w-0 rounded-2xl border border-[#E9EDF7] p-6 md:p-8 shadow-[0px_18px_40px_rgba(112,144,176,0.12)]"
                    style={{ backgroundColor: CARD_BG }}
                  >
                    <h2 className="text-xl font-bold" style={{ color: TEXT }}>Paramètres</h2>
                    <p className="mt-1 text-sm" style={{ color: MUTED }}>Options selon votre rôle : {isRecruiter ? 'Recruteur' : 'Étudiant'}.</p>
                    <div className="mt-8 space-y-8">
                      {/* ========== ÉTUDIANT ========== */}
                      {isStudent && (
                        <>
                          <div className="space-y-4">
                            <h3 className="text-sm font-semibold border-l-4 pl-3" style={{ color: TEXT, borderColor: '#9D7BFF' }}>Paramètres de profil</h3>
                            <div className="flex items-center justify-between rounded-xl border px-4 py-4" style={{ borderColor: BORDER, backgroundColor: 'var(--block-bg)' }}>
                              <div>
                                <p className="font-medium" style={{ color: TEXT }}>Profil public</p>
                                <p className="text-sm" style={{ color: MUTED }}>Rendre mon profil visible (public) ou privé</p>
                              </div>
                              <Switch checked={studentProfil.visibilitePublicPrive} onChange={(v) => { setStudentProfil((p) => ({ ...p, visibilitePublicPrive: v })); setCareer((c) => ({ ...c, portfolioVisible: v })); }} />
                            </div>
                            <p className="text-sm" style={{ color: MUTED }}>Mise à jour des infos personnelles dans l&apos;onglet Profil.</p>
                          </div>
                          <div className="space-y-4">
                            <h3 className="text-sm font-semibold border-l-4 pl-3" style={{ color: TEXT, borderColor: '#9D7BFF' }}>Paramètres de portfolio</h3>
                            <div className="flex items-center justify-between rounded-xl border px-4 py-4" style={{ borderColor: BORDER, backgroundColor: 'var(--block-bg)' }}>
                              <div>
                                <p className="font-medium" style={{ color: TEXT }}>Portfolio visible publiquement</p>
                                <p className="text-sm" style={{ color: MUTED }}>Les recruteurs peuvent voir mon portfolio</p>
                              </div>
                              <Switch checked={career.portfolioVisible} onChange={(v) => { setCareer((c) => ({ ...c, portfolioVisible: v })); setStudentProfil((p) => ({ ...p, visibilitePublicPrive: v })); }} />
                            </div>
                          </div>
                          <div className="space-y-4">
                            <h3 className="text-sm font-semibold border-l-4 pl-3" style={{ color: TEXT, borderColor: '#9D7BFF' }}>Paramètres de projets</h3>
                            <div>
                              <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Visibilité des projets</label>
                              <select value={studentProjets.visibiliteProjets} onChange={(e) => setStudentProjets((p) => ({ ...p, visibiliteProjets: e.target.value }))} className={inputClass} style={{ borderColor: BORDER }}>
                                <option value="admin">Admin uniquement</option>
                                <option value="recruteur">Recruteurs et admin</option>
                              </select>
                              <p className="mt-1 text-xs" style={{ color: MUTED }}>Qui peut voir vos projets : admin, ou recruteurs et admin.</p>
                            </div>
                          </div>
                        </>
                      )}

                      {/* ========== RECRUTEUR ========== */}
                      {isRecruiter && (
                        <>
                          <div className="space-y-4">
                            <div>
                              <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Nom de l&apos;entreprise</label>
                              <Input name="entreprise" value={form.entreprise} onChange={handleChange} placeholder="Nom de l&apos;entreprise" />
                            </div>
                            <div>
                              <label className="mb-2 block text-sm font-medium" style={{ color: TEXT }}>Site Web</label>
                              <input name="siteWeb" value={form.siteWeb} onChange={handleChange} placeholder="https://..." className={inputClass} style={{ borderColor: BORDER }} />
                            </div>
                          </div>
                        </>
                      )}
                    </div>
                    <button type="button" onClick={() => { savePreferences(); }} disabled={submitting} className="mt-6 rounded-xl px-6 py-3 text-sm font-semibold text-white disabled:opacity-60 bg-gradient-to-r from-[#9D7BFF] to-[#8B6FE8] shadow-lg shadow-[#9D7BFF]/30 hover:from-[#8B6FE8] hover:to-[#7C5FD9] transition-all duration-200">
                      {submitting ? 'Enregistrement…' : 'Enregistrer'}
                    </button>
                  </motion.div>
                )}
              </AnimatePresence>
            </div>
            </div>
          </div>
    </DashboardLayout>
  );
}

