import { useState, useEffect, useMemo } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { motion } from 'framer-motion';
import { useAuth } from '../context/AuthContext';
import api from '../api/axios';
import { TUNISIA_GOVERNORATES } from '../constants/tunisiaGovernorates';

/**
 * Page d’inscription : choix du rôle (étudiant / recruteur), champs profil, envoi multipart si photo.
 * Backend : GET /api/skills/public-catalog (recruteur), POST /api/register (AuthController).
 */
const ROLE_CANDIDAT = '2';
const ROLE_RECRUTEUR = '3';

/**
 * Construit un FormData pour l’inscription avec fichier (photo) et tableaux (skill_ids).
 * Entrées : objet form (champs du state React).
 * Sortie : instance FormData prête pour api.post avec en-tête multipart.
 */
function buildFormData(form) {
  const fd = new FormData();
  fd.append('role_id', form.role_id);
  fd.append('name', form.name);
  fd.append('email', form.email);
  fd.append('password', form.password);
  fd.append('password_confirmation', form.password_confirmation);
  if (form.photo instanceof File) fd.append('photo', form.photo);
  if (form.bio !== undefined) fd.append('bio', form.bio);
  if (form.niveau_etude !== undefined) fd.append('niveau_etude', form.niveau_etude);
  if (form.specialite !== undefined) fd.append('specialite', form.specialite);
  if (form.linkedin !== undefined) fd.append('linkedin', form.linkedin);
  if (form.entreprise !== undefined) fd.append('entreprise', form.entreprise);
  if (form.poste !== undefined) fd.append('poste', form.poste);
  if (form.ville !== undefined) fd.append('ville', form.ville);
  if (form.gouvernorat !== undefined) fd.append('gouvernorat', form.gouvernorat);
  if (form.company_description !== undefined) fd.append('company_description', form.company_description);
  if (Array.isArray(form.skill_ids)) {
    form.skill_ids.forEach((id) => fd.append('skill_ids[]', String(id)));
  }
  return fd;
}

const inputClass = 'w-full rounded-xl border border-theme bg-block px-4 py-3 text-body placeholder-[var(--muted)] focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--primary)]/25 focus:outline-none transition-all duration-200';
const labelClass = 'block text-sm font-medium text-body mb-2';
const selectClass = 'w-full rounded-xl border border-theme bg-block px-4 py-3 text-body focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--primary)]/25 focus:outline-none transition-all duration-200 [&>option]:bg-[var(--card-bg)] [&>option]:text-body';

/**
 * Formulaire multi-étapes visuel : état local, chargement du catalogue compétences pour recruteurs.
 * Entrées : aucune prop ; useAuth().register, useNavigate.
 * Sortie : JSX ; après succès navigation vers /verify-email.
 */
export default function Register() {
  const [form, setForm] = useState({
    role_id: '',
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    bio: '',
    specialite: '',
    linkedin: '',
    niveau_etude: '',
    entreprise: '',
    poste: '',
    ville: '',
    gouvernorat: '',
    company_description: '',
    skill_ids: [],
    photo: null,
  });
  const [skillsCatalog, setSkillsCatalog] = useState([]);
  const [skillsLoading, setSkillsLoading] = useState(false);
  const [errors, setErrors] = useState({});
  const [submitting, setSubmitting] = useState(false);
  const { register } = useAuth();
  const navigate = useNavigate();

  const isCandidatRole = form.role_id === ROLE_CANDIDAT;
  const isRecruteur = form.role_id === ROLE_RECRUTEUR;

  const skillsByCategory = useMemo(() => {
    const map = new Map();
    skillsCatalog
      .filter((s) => ((s.category || s.categorie) || '').toLowerCase() !== 'soft skills')
      .forEach((s) => {
        const cat = s.category || s.categorie || 'Autre';
        if (!map.has(cat)) map.set(cat, []);
        map.get(cat).push(s);
      });
    return map;
  }, [skillsCatalog]);

  useEffect(() => {
    if (!isRecruteur) return;
    let cancelled = false;
    setSkillsLoading(true);
    api
      .get('/skills/public-catalog')
      .then((res) => {
        if (!cancelled) setSkillsCatalog(Array.isArray(res.data?.data) ? res.data.data : []);
      })
      .catch(() => {
        if (!cancelled) setSkillsCatalog([]);
      })
      .finally(() => {
        if (!cancelled) setSkillsLoading(false);
      });
    return () => { cancelled = true; };
  }, [isRecruteur]);

  /**
   * Ajoute ou retire un id de compétence dans form.skill_ids (recruteur).
   * Entrées : id (nombre, id Skill).
   * Sortie : aucune ; met à jour le state form et efface l’erreur skill_ids.
   */
  const toggleSkillId = (id) => {
    setForm((prev) => {
      const n = Number(id);
      const has = prev.skill_ids.includes(n);
      return {
        ...prev,
        skill_ids: has ? prev.skill_ids.filter((x) => x !== n) : [...prev.skill_ids, n],
      };
    });
    setErrors((prev) => ({ ...prev, skill_ids: null }));
  };

  /**
   * Met à jour un champ du formulaire (inputs contrôlés) ; réinitialise certains champs au changement de rôle.
   * Entrées : événement change (e.target.name, e.target.value).
   * Sortie : aucune ; met à jour form et peut effacer une erreur de champ.
   */
  const handleChange = (e) => {
    const { name, value } = e.target;
    setForm((prev) => {
      if (name === 'role_id' && value === ROLE_RECRUTEUR) {
        return {
          ...prev,
          role_id: value,
          bio: '',
          specialite: '',
          linkedin: '',
          niveau_etude: '',
        };
      }
      if (name === 'role_id' && value !== ROLE_RECRUTEUR) {
        return {
          ...prev,
          role_id: value,
          skill_ids: [],
          ville: '',
          gouvernorat: '',
          company_description: '',
          entreprise: '',
          poste: '',
        };
      }
      return { ...prev, [name]: value };
    });
    if (errors[name]) setErrors((prev) => ({ ...prev, [name]: null }));
  };

  /**
   * Enregistre le fichier photo choisi dans form.photo.
   * Entrées : événement change sur input file.
   * Sortie : aucune ; met à jour form.photo.
   */
  const handlePhotoChange = (e) => {
    const file = e.target.files?.[0];
    setForm((prev) => ({ ...prev, photo: file || null }));
    if (errors.photo) setErrors((prev) => ({ ...prev, photo: null }));
  };

  /**
   * Valide côté client (recruteur), puis appelle register() avec JSON ou FormData selon la présence d’une photo.
   * Entrées : submit du formulaire ; lit tout l’objet form.
   * Sortie : Promise ; erreurs API → state errors.
   */
  const handleSubmit = async (e) => {
    e.preventDefault();
    setErrors({});
    if (isRecruteur) {
      const next = {};
      if (!form.skill_ids?.length) {
        next.skill_ids = ['Sélectionnez au moins une technologie ou compétence.'];
      }
      if ((form.company_description || '').trim().length < 20) {
        next.company_description = ['La description doit contenir au moins 20 caractères.'];
      }
      if (Object.keys(next).length) {
        setErrors(next);
        return;
      }
    }
    setSubmitting(true);
    try {
      const payload = form.photo instanceof File
        ? buildFormData(form)
        : (() => {
            const rest = { ...form };
            delete rest.photo;
            return rest;
          })();
      await register(payload);
      navigate('/verify-email', { replace: true });
    } catch (err) {
      if (err.response?.status === 422 && err.response?.data?.errors) {
        setErrors(err.response.data.errors);
      } else if (err.response?.data?.message) {
        setErrors({ email: [err.response.data.message] });
      } else {
        setErrors({ email: ['Une erreur est survenue. Veuillez réessayer.'] });
      }
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <div className="min-h-screen flex flex-col relative overflow-hidden bg-page">
      <div className="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%239D7BFF\' fill-opacity=\'0.03\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-80" aria-hidden />
      <div className="relative z-10 flex flex-1 items-center justify-center p-4 py-10">
        <motion.div
          initial={{ opacity: 0, y: 16 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.35, ease: [0.25, 0.46, 0.45, 0.94] }}
          className="w-full max-w-lg"
        >
          <div className="rounded-2xl bg-card backdrop-blur-sm shadow-theme p-8 border border-theme">
            <div className="text-center mb-8">
              <div className="inline-flex items-center justify-center gap-2 mb-3">
                <span className="h-1.5 w-10 rounded-full bg-gradient-to-r from-[var(--primary)] to-[#B794F6]" />
                <span className="text-xl font-bold text-[var(--primary)] tracking-tight">ProLink</span>
                <span className="h-1.5 w-10 rounded-full bg-gradient-to-r from-[#B794F6] to-[var(--primary)]" />
              </div>
              <h1 className="text-2xl font-bold text-body tracking-tight">Créer un compte</h1>
              <p className="text-muted mt-1 text-sm">Rejoignez la plateforme en quelques étapes</p>
            </div>

            <form onSubmit={handleSubmit} className="space-y-6">
              {Object.keys(errors).length > 0 && (
                <div
                  className="rounded-xl border border-red-300/80 bg-red-500/10 px-4 py-3 text-sm text-red-800 dark:text-red-200"
                  role="alert"
                >
                  <p className="font-semibold mb-2">La validation a échoué :</p>
                  <ul className="list-disc space-y-1 pl-5">
                    {Object.entries(errors).flatMap(([key, msgs]) =>
                      Array.isArray(msgs) ? msgs.map((m) => <li key={`${key}-${m}`}>{m}</li>) : []
                    )}
                  </ul>
                </div>
              )}
              <div>
                <h2 className="text-sm font-semibold text-body flex items-center gap-2 mb-4">
                  <span className="text-[var(--primary)]">◆</span> Informations du compte
                </h2>
                <div className="space-y-4">
                  <div>
                    <label htmlFor="name" className={labelClass}>Nom *</label>
                    <input
                      id="name"
                      name="name"
                      type="text"
                      value={form.name}
                      onChange={handleChange}
                      required
                      className={inputClass}
                      placeholder="Votre nom"
                    />
                    {errors.name && <p className="mt-1.5 text-sm text-red-500">{errors.name[0]}</p>}
                  </div>
                  <div>
                    <label htmlFor="email" className={labelClass}>Adresse e-mail *</label>
                    <input
                      id="email"
                      name="email"
                      type="email"
                      value={form.email}
                      onChange={handleChange}
                      required
                      className={inputClass}
                      placeholder="prenom.nom@email.com"
                    />
                    {errors.email && <p className="mt-1.5 text-sm text-red-500">{errors.email[0]}</p>}
                  </div>
                  <div className="grid gap-4 sm:grid-cols-2">
                    <div>
                      <label htmlFor="password" className={labelClass}>Mot de passe *</label>
                      <input
                        id="password"
                        name="password"
                        type="password"
                        value={form.password}
                        onChange={handleChange}
                        required
                        minLength={8}
                        className={inputClass}
                        placeholder="Min. 8 caractères"
                      />
                      {errors.password && (
                        <ul className="mt-1.5 list-disc space-y-0.5 pl-5 text-sm text-red-500">
                          {(Array.isArray(errors.password) ? errors.password : [errors.password]).map((m) => (
                            <li key={m}>{m}</li>
                          ))}
                        </ul>
                      )}
                    </div>
                    <div>
                      <label htmlFor="password_confirmation" className={labelClass}>Confirmation *</label>
                      <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        value={form.password_confirmation}
                        onChange={handleChange}
                        required
                        minLength={8}
                        className={inputClass}
                        placeholder="••••••••"
                      />
                      {errors.password_confirmation && (
                        <p className="mt-1.5 text-sm text-red-500">{errors.password_confirmation[0]}</p>
                      )}
                    </div>
                  </div>
                  <div>
                    <label htmlFor="role_id" className={labelClass}>Rôle *</label>
                    <select
                      id="role_id"
                      name="role_id"
                      value={form.role_id}
                      onChange={handleChange}
                      required
                      className={selectClass}
                    >
                      <option value="">Choisir un rôle</option>
                      <option value={ROLE_CANDIDAT}>Candidat</option>
                      <option value={ROLE_RECRUTEUR}>Recruteur</option>
                    </select>
                    {errors.role_id && <p className="mt-1.5 text-sm text-red-500">{errors.role_id[0]}</p>}
                  </div>
                </div>
              </div>

              {/* Photo (candidat) */}
              {isCandidatRole && (
                <div>
                  <label className={labelClass}>Photo de profil</label>
                  <label className="cursor-pointer inline-flex items-center gap-2 rounded-xl border border-theme bg-block px-4 py-2.5 text-sm font-medium text-body hover:border-[var(--primary)]/30 transition-all duration-200 w-full justify-center">
                    <span className="text-[var(--primary)]">{form.photo ? form.photo.name : 'Choisir une image'}</span>
                    <input
                      type="file"
                      accept="image/*"
                      onChange={handlePhotoChange}
                      className="sr-only"
                    />
                  </label>
                  {errors.photo && <p className="mt-1.5 text-sm text-red-500">{errors.photo[0]}</p>}
                </div>
              )}

              {/* Champs Candidat */}
              {isCandidatRole && (
                <div>
                  <h2 className="text-sm font-semibold text-body flex items-center gap-2 mb-4">
                    <span className="text-cyan-500">◆</span> Profil candidat
                  </h2>
                  <div className="space-y-4">
                    <div>
                      <label htmlFor="bio" className={labelClass}>Bio *</label>
                      <textarea
                        id="bio"
                        name="bio"
                        value={form.bio}
                        onChange={handleChange}
                        required
                        rows={3}
                        className={`${inputClass} resize-none`}
                        placeholder="Présentation courte"
                      />
                      {errors.bio && <p className="mt-1.5 text-sm text-red-500">{errors.bio[0]}</p>}
                    </div>
                    <div className="grid gap-4 sm:grid-cols-2">
                      <div>
                        <label htmlFor="specialite" className={labelClass}>Spécialité *</label>
                        <input
                          id="specialite"
                          name="specialite"
                          type="text"
                          value={form.specialite}
                          onChange={handleChange}
                          required
                          className={inputClass}
                          placeholder="Ex. Génie Logiciel"
                        />
                        {errors.specialite && <p className="mt-1.5 text-sm text-red-500">{errors.specialite[0]}</p>}
                      </div>
                      <div>
                        <label htmlFor="niveau_etude" className={labelClass}>Niveau d&apos;études</label>
                        <input
                          id="niveau_etude"
                          name="niveau_etude"
                          type="text"
                          value={form.niveau_etude}
                          onChange={handleChange}
                          className={inputClass}
                          placeholder="Ex. Master, Licence"
                        />
                      </div>
                    </div>
                    <div>
                      <label htmlFor="linkedin" className={labelClass}>LinkedIn</label>
                      <input
                        id="linkedin"
                        name="linkedin"
                        type="url"
                        value={form.linkedin}
                        onChange={handleChange}
                        className={inputClass}
                        placeholder="https://linkedin.com/in/..."
                      />
                      {errors.linkedin && <p className="mt-1.5 text-sm text-red-500">{errors.linkedin[0]}</p>}
                    </div>
                  </div>
                </div>
              )}

              {/* Champs Recruteur */}
              {isRecruteur && (
                <div>
                  <h2 className="text-sm font-semibold text-body flex items-center gap-2 mb-4">
                    <span className="text-violet-500">◆</span> Profil recruteur & entreprise
                  </h2>
                  <div className="space-y-4">
                    <div>
                      <label htmlFor="entreprise" className={labelClass}>Nom de l&apos;entreprise *</label>
                      <input
                        id="entreprise"
                        name="entreprise"
                        type="text"
                        value={form.entreprise}
                        onChange={handleChange}
                        required
                        className={inputClass}
                        placeholder="Ex. Vermeg"
                      />
                      {errors.entreprise && <p className="mt-1.5 text-sm text-red-500">{errors.entreprise[0]}</p>}
                    </div>
                    <div className="grid gap-4 sm:grid-cols-2">
                      <div>
                        <label htmlFor="ville" className={labelClass}>Ville *</label>
                        <input
                          id="ville"
                          name="ville"
                          type="text"
                          value={form.ville}
                          onChange={handleChange}
                          required
                          className={inputClass}
                          placeholder="Ex. Les Berges du Lac"
                        />
                        {errors.ville && <p className="mt-1.5 text-sm text-red-500">{errors.ville[0]}</p>}
                      </div>
                      <div>
                        <label htmlFor="gouvernorat" className={labelClass}>Gouvernorat *</label>
                        <select
                          id="gouvernorat"
                          name="gouvernorat"
                          value={form.gouvernorat}
                          onChange={handleChange}
                          required
                          className={selectClass}
                        >
                          <option value="">Sélectionner</option>
                          {TUNISIA_GOVERNORATES.map((g) => (
                            <option key={g} value={g}>{g}</option>
                          ))}
                        </select>
                        {errors.gouvernorat && <p className="mt-1.5 text-sm text-red-500">{errors.gouvernorat[0]}</p>}
                      </div>
                    </div>
                    <div>
                      <label htmlFor="company_description" className={labelClass}>Description de l&apos;activité *</label>
                      <textarea
                        id="company_description"
                        name="company_description"
                        value={form.company_description}
                        onChange={handleChange}
                        required
                        minLength={20}
                        rows={4}
                        className={`${inputClass} resize-none`}
                        placeholder="Présentez l&apos;activité de la société (min. 20 caractères)."
                      />
                      <p className="mt-1 text-xs text-muted">{(form.company_description || '').trim().length} / 20 caractères minimum</p>
                      {errors.company_description && <p className="mt-1.5 text-sm text-red-500">{errors.company_description[0]}</p>}
                    </div>
                    <div>
                      <label htmlFor="poste" className={labelClass}>Votre poste *</label>
                      <input
                        id="poste"
                        name="poste"
                        type="text"
                        value={form.poste}
                        onChange={handleChange}
                        required
                        className={inputClass}
                        placeholder="Ex. Responsable recrutement"
                      />
                      {errors.poste && <p className="mt-1.5 text-sm text-red-500">{errors.poste[0]}</p>}
                    </div>
                    <div>
                      <p className={labelClass}>Technologies / compétences utilisées *</p>
                      <p className="mb-2 text-xs text-muted">Sélectionnez les langages et frameworks employés par votre entreprise (au moins un).</p>
                      {skillsLoading && <p className="text-sm text-muted">Chargement du catalogue…</p>}
                      {!skillsLoading && skillsCatalog.length === 0 && (
                        <p className="text-sm text-amber-700">Impossible de charger le catalogue. Réessayez plus tard.</p>
                      )}
                      {!skillsLoading && skillsByCategory.size > 0 && (
                        <div className="max-h-52 overflow-y-auto rounded-xl border border-theme bg-block p-3 space-y-4">
                          {[...skillsByCategory.entries()].map(([cat, list]) => (
                            <div key={cat}>
                              <p className="text-xs font-semibold uppercase tracking-wide text-muted mb-2">{cat}</p>
                              <ul className="flex flex-wrap gap-2">
                                {list.map((s) => {
                                  const checked = form.skill_ids.includes(Number(s.id));
                                  return (
                                    <li key={s.id}>
                                      <label className={`inline-flex cursor-pointer items-center gap-2 rounded-lg border px-3 py-2 text-sm transition ${checked ? 'border-violet-400 bg-violet-50 text-violet-900' : 'border-theme bg-card'}`}>
                                        <input
                                          type="checkbox"
                                          className="rounded border-theme text-violet-600 focus:ring-violet-500"
                                          checked={checked}
                                          onChange={() => toggleSkillId(s.id)}
                                        />
                                        {s.nom}
                                      </label>
                                    </li>
                                  );
                                })}
                              </ul>
                            </div>
                          ))}
                        </div>
                      )}
                      {(errors.skill_ids ||
                        Object.keys(errors).some((k) => k.startsWith('skill_ids.'))) && (
                        <p className="mt-1.5 text-sm text-red-500">
                          {errors.skill_ids?.[0] ||
                            Object.entries(errors)
                              .filter(([k]) => k.startsWith('skill_ids.'))
                              .flatMap(([, v]) => (Array.isArray(v) ? v : []))[0] ||
                            'Une ou plusieurs compétences sélectionnées ne sont pas valides.'}
                        </p>
                      )}
                    </div>
                  </div>
                </div>
              )}

              <button
                type="submit"
                disabled={submitting}
                className="w-full rounded-xl bg-primary text-white font-semibold py-3.5 px-4 shadow-theme transition-all duration-200 disabled:opacity-60 disabled:cursor-not-allowed focus:ring-2 focus:ring-[var(--primary)]/50 focus:ring-offset-2 focus:outline-none"
              >
                {submitting ? 'Inscription…' : "S'inscrire"}
              </button>
            </form>

            <p className="mt-6 text-center text-sm text-muted">
              Déjà un compte ?{' '}
              <Link to="/login" className="text-[var(--primary)] hover:opacity-90 font-semibold transition-colors">
                Se connecter
              </Link>
            </p>
          </div>
        </motion.div>
      </div>
    </div>
  );
}


