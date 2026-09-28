import { useState, useEffect, useCallback } from 'react';
import { Link } from 'react-router-dom';
import { motion, AnimatePresence } from 'framer-motion';
import DashboardLayout from '../components/DashboardLayout';
import { ProjectsGridSkeleton } from '../components/ContentSkeleton';
import { useAuth } from '../context/AuthContext';
import { useNotification } from '../context/NotificationContext';
import api, { getStorageUrl } from '../api/axios';
import { ProjectPlaceholder, getProjectSkillBadgeClass } from '../components/portfolioProjectCardShared';

/**
 * Gestion des projets du portfolio étudiant : liste, création, édition, suppression, médias.
 * Backend : ProjectController — GET/POST /api/projects, GET/PUT/DELETE /api/projects/{id} ; GET /api/all-skills.
 */

const inputBase = 'w-full rounded-xl border border-theme bg-block px-4 py-2.5 text-body placeholder-[var(--muted)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]/30 focus:border-[var(--primary)]/50 transition';
const inputError = 'border-red-400/60 focus:ring-red-400/30';

/**
 * Page tableau de bord « Projets » : charge projets + compétences, modale CRUD, suppression confirmée.
 * Entrées : aucune prop ; useAuth().user (candidat.id pour lien portfolio).
 * Sortie : JSX sous DashboardLayout.
 */
const normalizeProjectListResponse = (payload) => {
  if (Array.isArray(payload)) return payload;
  return payload?.data ?? [];
};

export default function Projects() {
  const { user } = useAuth();
  const { notifySuccess, notifyError } = useNotification();
  const [projects, setProjects] = useState([]);
  const [skills, setSkills] = useState([]);
  const [loading, setLoading] = useState(true);
  const [modalOpen, setModalOpen] = useState(false);
  /** `null` = création, sinon id du projet en cours d’édition. */
  const [editingId, setEditingId] = useState(null);
  const [submitting, setSubmitting] = useState(false);
  const [form, setForm] = useState({
    titre: '',
    description: '',
    lien_github: '',
    lien_demo: '',
    date_debut: '',
    date_fin: '',
    skill_ids: [],
    skill_names: [],
  });
  const [imageFile, setImageFile] = useState(null);
  const [imagePreview, setImagePreview] = useState(null);
  const [galleryFiles, setGalleryFiles] = useState([]);
  const [galleryPreviews, setGalleryPreviews] = useState([]);
  /** Galerie déjà enregistrée (édition) — inchangée si aucun nouveau fichier. */
  const [existingGallery, setExistingGallery] = useState([]);
  const [errors, setErrors] = useState({});
  const [imageLoadErrors, setImageLoadErrors] = useState({});
  const [galleryInputKey, setGalleryInputKey] = useState(0);
  /** Projet en attente de confirmation de suppression (modal). */
  const [deleteTarget, setDeleteTarget] = useState(null);
  const [deleteSubmitting, setDeleteSubmitting] = useState(false);

  /**
   * Recharge uniquement la liste des projets depuis l’API (sans skills).
   * Entrées : aucune ; utilise le client api configuré (token).
   * Sortie : aucune ; met à jour le state projects.
   */
  const fetchProjects = () => {
    api.get('/projects')
      .then((res) => {
        console.log('GET /projects response:', res.data);
        setProjects(normalizeProjectListResponse(res.data));
      })
      .catch(() => setProjects([]));
  };

  useEffect(() => {
    setLoading(true);
    Promise.all([
      api.get('/projects')
        .then((r) => {
          console.log('GET /projects response:', r.data);
          return normalizeProjectListResponse(r.data);
        })
        .catch(() => []),
      api.get('/all-skills').then((r) => r.data?.data ?? []).catch(() => []),
    ]).then(([proj, sk]) => {
      setProjects(proj);
      setSkills(sk);
    }).finally(() => setLoading(false));
  }, []);

  /** En édition, recharger le projet depuis l’API pour avoir `gallery` à jour (miniatures). */
  useEffect(() => {
    if (!modalOpen || editingId == null) return undefined;
    let cancelled = false;
    api
      .get(`/projects/${editingId}`)
      .then((res) => {
        const p = res.data?.data;
        if (cancelled || !p) return;
        setExistingGallery(Array.isArray(p.gallery) ? p.gallery : []);
      })
      .catch(() => {});
    return () => {
      cancelled = true;
    };
  }, [modalOpen, editingId]);

  /**
   * Met à jour un champ texte du formulaire projet (champs contrôlés).
   * Entrées : événement change (name, value).
   * Sortie : aucune ; met à jour form et peut effacer une erreur de validation.
   */
  const handleChange = (e) => {
    const { name, value } = e.target;
    setForm((prev) => ({ ...prev, [name]: value }));
    if (errors[name]) setErrors((prev) => ({ ...prev, [name]: null }));
  };

  const revokeGalleryPreviews = useCallback((previews) => {
    (previews || []).forEach((p) => {
      if (p?.url && String(p.url).startsWith('blob:')) URL.revokeObjectURL(p.url);
    });
  }, []);

  /**
   * Gère l’image principale du projet : fichier + aperçu blob URL.
   * Entrées : événement change sur input file.
   * Sortie : aucune ; met imageFile / imagePreview.
   */
  const handleImageChange = (e) => {
    const file = e.target.files?.[0];
    if (file) {
      setImageFile(file);
      setImagePreview(URL.createObjectURL(file));
    } else {
      setImageFile(null);
      if (imagePreview) URL.revokeObjectURL(imagePreview);
      setImagePreview(null);
    }
  };

  /**
   * Remplace la sélection de fichiers galerie et régénère les aperçus blob.
   * Entrées : événement change (multi-fichiers).
   * Sortie : aucune ; met galleryFiles / galleryPreviews.
   */
  const handleGalleryChange = (e) => {
    const files = Array.from(e.target.files || []).filter((f) => f instanceof File);
    revokeGalleryPreviews(galleryPreviews);
    setGalleryFiles(files);
    setGalleryPreviews(files.map((file) => ({ url: URL.createObjectURL(file) })));
    if (errors.images) setErrors((prev) => ({ ...prev, images: null }));
  };

  /**
   * Vide la sélection galerie locale et révoque les URLs blob pour libérer la mémoire.
   * Entrées : aucune.
   * Sortie : aucune.
   */
  const clearGallerySelection = () => {
    revokeGalleryPreviews(galleryPreviews);
    setGalleryFiles([]);
    setGalleryPreviews([]);
    setGalleryInputKey((k) => k + 1);
  };

  /**
   * Ajoute ou retire une compétence du dictionnaire (id) dans form.skill_ids.
   * Entrées : skillId (nombre).
   * Sortie : aucune.
   */
  const handleSkillToggle = (skillId) => {
    setForm((prev) => ({
      ...prev,
      skill_ids: prev.skill_ids.includes(skillId)
        ? prev.skill_ids.filter((id) => id !== skillId)
        : [...prev.skill_ids, skillId],
    }));
  };

  const [freeSkillInput, setFreeSkillInput] = useState('');
  /**
   * Ajoute une compétence libre (texte) à skill_names si non vide et non dupliquée.
   * Entrées : événement optionnel (submit) ; lit freeSkillInput.
   * Sortie : aucune.
   */
  const addFreeSkill = (e) => {
    e?.preventDefault();
    const name = (typeof freeSkillInput === 'string' ? freeSkillInput : '').trim();
    if (!name) return;
    setForm((prev) => ({
      ...prev,
      skill_names: prev.skill_names.includes(name) ? prev.skill_names : [...prev.skill_names, name],
    }));
    setFreeSkillInput('');
  };
  /**
   * Retire une compétence libre de la liste skill_names.
   * Entrées : name (string).
   * Sortie : aucune.
   */
  const removeFreeSkill = (name) => {
    setForm((prev) => ({ ...prev, skill_names: prev.skill_names.filter((n) => n !== name) }));
  };

  /**
   * Ferme la modale de confirmation de suppression si aucune requête en cours.
   * Entrées : aucune.
   * Sortie : aucune.
   */
  const closeDeleteConfirm = () => {
    if (!deleteSubmitting) setDeleteTarget(null);
  };

  /**
   * Supprime le projet deleteTarget.id via DELETE /api/projects/{id} puis met à jour la liste locale.
   * Entrées : aucune ; lit deleteTarget depuis le state.
   * Sortie : aucune ; toast ou erreur.
   */
  const confirmDeleteProject = () => {
    if (!deleteTarget) return;
    const id = deleteTarget.id;
    setDeleteSubmitting(true);
    api
      .delete(`/projects/${id}`)
      .then(() => {
        setProjects((prev) => prev.filter((p) => p.id !== id));
        setImageLoadErrors((prev) => {
          const next = { ...prev };
          delete next[id];
          return next;
        });
        if (editingId === id) {
          setModalOpen(false);
          resetForm();
        }
        notifySuccess('Projet supprimé avec succès.');
        setDeleteTarget(null);
      })
      .catch((err) => {
        notifyError(err.response?.data?.message || 'Impossible de supprimer ce projet.');
      })
      .finally(() => setDeleteSubmitting(false));
  };

  /**
   * Réinitialise tout le state du formulaire modale (création / édition).
   * Entrées : aucune.
   * Sortie : aucune.
   */
  const resetForm = () => {
    setForm({ titre: '', description: '', lien_github: '', lien_demo: '', date_debut: '', date_fin: '', skill_ids: [], skill_names: [] });
    setFreeSkillInput('');
    setImageFile(null);
    if (imagePreview && String(imagePreview).startsWith('blob:')) URL.revokeObjectURL(imagePreview);
    setImagePreview(null);
    revokeGalleryPreviews(galleryPreviews);
    setGalleryFiles([]);
    setGalleryPreviews([]);
    setExistingGallery([]);
    setGalleryInputKey((k) => k + 1);
    setErrors({});
    setEditingId(null);
  };

  /**
   * Construit le FormData pour créer ou mettre à jour un projet (champs + image + skill_ids/names).
   * Entrées : lit form et imageFile depuis le state.
   * Sortie : FormData (les images galerie sont ajoutées dans handleSubmit).
   */
  const buildFormData = () => {
    const fd = new FormData();
    fd.append('titre', form.titre);
    fd.append('description', form.description || '');
    fd.append('lien_github', form.lien_github || '');
    fd.append('lien_demo', form.lien_demo || '');
    fd.append('date_debut', form.date_debut || '');
    fd.append('date_fin', form.date_fin || '');
    (form.skill_ids || []).forEach((id) => fd.append('skill_ids[]', id));
    (form.skill_names || []).filter(Boolean).forEach((name) => fd.append('skill_names[]', name));
    if (imageFile instanceof File) fd.append('image', imageFile);
    return fd;
  };

  /**
   * Normalise une date API (ISO) en yyyy-mm-dd pour les champs <input type="date">.
   * Entrées : value (string ou autre).
   * Sortie : string (10 caractères max) ou chaîne vide.
   */
  const toInputDate = (value) => {
    if (value == null || value === '') return '';
    const s = typeof value === 'string' ? value : String(value);
    return s.length >= 10 ? s.slice(0, 10) : '';
  };

  /**
   * Crée (POST /api/projects) ou met à jour (POST /api/projects/{id}) le projet avec multipart.
   * Entrées : submit ; form, galleryFiles, editingId.
   * Sortie : aucune ; recharge la liste et ferme la modale si succès.
   */
  const handleSubmit = (e) => {
    e.preventDefault();
    setErrors({});
    setSubmitting(true);
    const isEdit = editingId != null;
    const fd = buildFormData();
    for (let i = 0; i < galleryFiles.length; i += 1) {
      const file = galleryFiles[i];
      if (file instanceof File) {
        fd.append('images[]', file);
      }
    }
    // POST sur update : multipart + fichiers fiables (équivalent Route::match put|post côté Laravel).
    const send = isEdit ? api.post(`/projects/${editingId}`, fd) : api.post('/projects', fd);
    send
      .then(() => {
        notifySuccess(isEdit ? 'Projet modifié avec succès.' : 'Projet ajouté avec succès.');
        setModalOpen(false);
        resetForm();
        fetchProjects();
      })
      .catch((err) => {
        if (err.response?.status === 422 && err.response?.data?.errors) {
          setErrors(err.response.data.errors);
        }
        notifyError(err.response?.data?.message || 'Une erreur est survenue.');
      })
      .finally(() => setSubmitting(false));
  };

  /**
   * Ouvre la modale en mode création après reset du formulaire.
   * Entrées : aucune.
   * Sortie : aucune.
   */
  const openCreateModal = () => {
    resetForm();
    setModalOpen(true);
  };

  /**
   * Ouvre la modale en mode édition et préremplit les champs à partir d’un objet projet (liste API).
   * Entrées : proj (objet projet).
   * Sortie : aucune.
   */
  const openEditModal = (proj) => {
    setErrors({});
    setImageFile(null);
    revokeGalleryPreviews(galleryPreviews);
    setGalleryFiles([]);
    setGalleryPreviews([]);
    setExistingGallery(Array.isArray(proj.gallery) ? proj.gallery : []);
    if (imagePreview && String(imagePreview).startsWith('blob:')) URL.revokeObjectURL(imagePreview);
    setImagePreview(proj.image_url ? getStorageUrl(proj.image_url) : null);
    setEditingId(proj.id);
    setForm({
      titre: proj.titre || '',
      description: proj.description || '',
      lien_github: proj.lien_github || '',
      lien_demo: proj.lien_demo || '',
      date_debut: toInputDate(proj.date_debut),
      date_fin: toInputDate(proj.date_fin),
      skill_ids: Array.isArray(proj.skills) ? proj.skills.map((s) => s.id) : [],
      skill_names: [],
    });
    setFreeSkillInput('');
    setModalOpen(true);
  };

  /**
   * Ferme la modale et réinitialise le formulaire si aucune soumission en cours.
   * Entrées : aucune.
   * Sortie : aucune.
   */
  const closeModal = () => {
    if (!submitting) {
      setModalOpen(false);
      resetForm();
    }
  };

  /**
   * Indique si le backend a renvoyé une erreur de validation pour un champ donné.
   * Entrées : field (nom du champ).
   * Sortie : booléen.
   */
  const hasError = (field) => !!errors[field];

  return (
    <DashboardLayout>
          <div className="max-w-5xl mx-auto">
            <div className="flex flex-wrap items-center justify-between gap-4 mb-6">
              <h1 className="text-2xl font-bold text-body">Gestion des projets</h1>
              <div className="flex items-center gap-3">
                {user?.candidat?.id != null && (
                  <Link
                    to={`/dashboard/portfolio/${user.candidat.id}`}
                    className="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm text-white transition"
                  >
                    Voir mon portfolio
                    <svg className="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                  </Link>
                )}
                <button
                  type="button"
                  onClick={openCreateModal}
                  className="rounded-xl bg-primary px-4 py-2.5 text-sm font-medium text-white shadow-theme transition"
                >
                  Ajouter un projet
                </button>
              </div>
            </div>

            {/* Liste des projets — Bento Grid */}
            {loading ? (
              <ProjectsGridSkeleton />
            ) : projects.length === 0 ? (
              <motion.div
                initial={{ opacity: 0, y: 10 }}
                animate={{ opacity: 1, y: 0 }}
                className="rounded-2xl bg-card border border-theme p-12 text-center text-muted shadow-theme"
              >
                Aucun projet pour le moment. Utilisez le bouton « Ajouter un projet » pour créer votre premier projet de portfolio.
              </motion.div>
            ) : (
              <motion.ul
                initial="hidden"
                animate="show"
                variants={{ show: { transition: { staggerChildren: 0.05 } } }}
                className="grid grid-cols-1 items-stretch gap-4 sm:grid-cols-2 lg:grid-cols-3"
              >
                {projects.map((proj) => (
                  <motion.li
                    key={proj.id}
                    variants={{ hidden: { opacity: 0, y: 12 }, show: { opacity: 1, y: 0 } }}
                    className="flex h-full min-h-0 flex-col overflow-hidden rounded-2xl border border-theme bg-block shadow-theme transition hover:border-[var(--primary)]/30"
                  >
                    <div className="h-40 w-full shrink-0 overflow-hidden">
                      {proj.image_url && !imageLoadErrors[proj.id] ? (
                        <img
                          src={getStorageUrl(proj.image_url)}
                          alt=""
                          loading="lazy"
                          className="h-full w-full object-cover"
                          onError={() => setImageLoadErrors((prev) => ({ ...prev, [proj.id]: true }))}
                        />
                      ) : (
                        <ProjectPlaceholder title={proj.titre} />
                      )}
                    </div>
                    <div className="flex min-h-0 flex-1 flex-col p-4">
                      <h3 className="shrink-0 font-semibold text-body">{proj.titre || 'Sans titre'}</h3>
                      {proj.description && (
                        <p className="mt-2 shrink-0 text-sm leading-relaxed text-muted whitespace-pre-line line-clamp-5">
                          {proj.description}
                        </p>
                      )}
                      {Array.isArray(proj.gallery) && proj.gallery.length > 0 && (
                        <div className="mt-3 shrink-0 grid grid-cols-2 gap-4 md:grid-cols-3">
                          {proj.gallery.map((img) => (
                            <img
                              key={img.id}
                              src={getStorageUrl(img.url)}
                              alt=""
                              className="aspect-video w-full rounded-lg border border-theme object-cover"
                              loading="lazy"
                            />
                          ))}
                        </div>
                      )}
                      {Array.isArray(proj.skills) && proj.skills.length > 0 && (
                        <div className="mt-3 flex shrink-0 flex-wrap gap-1.5">
                          {proj.skills.map((s, i) => (
                            <span key={s.id} className={getProjectSkillBadgeClass(i)}>
                              {s.nom}
                            </span>
                          ))}
                        </div>
                      )}
                      <div className="mt-auto flex min-h-[2.75rem] flex-wrap items-center gap-2 border-t border-transparent pt-4">
                        <button
                          type="button"
                          onClick={() => openEditModal(proj)}
                          className="inline-flex items-center gap-1.5 rounded-lg border border-theme bg-card px-3 py-1.5 text-sm font-medium text-body transition hover:border-[var(--primary)]/40 hover:bg-[var(--primary)]/5"
                        >
                          <PencilIcon className="h-4 w-4" />
                          Modifier
                        </button>
                        <button
                          type="button"
                          onClick={() => setDeleteTarget(proj)}
                          className="inline-flex items-center gap-1.5 rounded-lg border border-red-300/50 bg-red-500/5 px-3 py-1.5 text-sm font-medium text-red-600 transition hover:bg-red-500/10 dark:border-red-900/50 dark:text-red-400"
                          aria-label="Supprimer le projet"
                        >
                          <TrashIcon className="h-4 w-4" />
                          Supprimer
                        </button>
                        {proj.lien_github && (
                          <a
                            href={proj.lien_github}
                            target="_blank"
                            rel="noopener noreferrer"
                            className="inline-flex items-center gap-1.5 rounded-lg border border-theme bg-block px-3 py-1.5 text-sm text-body transition"
                          >
                            <GitHubIcon className="h-4 w-4" />
                            Voir sur GitHub
                          </a>
                        )}
                        {proj.lien_demo && (
                          <a
                            href={proj.lien_demo}
                            target="_blank"
                            rel="noopener noreferrer"
                            className="inline-flex items-center gap-1.5 rounded-lg border-2 border-[var(--primary)] bg-[var(--primary)]/10 px-3 py-1.5 text-sm font-medium text-[var(--primary)] hover:opacity-90 transition"
                          >
                            <ExternalIcon className="h-4 w-4" />
                            Démo
                          </a>
                        )}
                      </div>
                    </div>
                  </motion.li>
                ))}
              </motion.ul>
            )}
          </div>

      {/* Modal — confirmation suppression */}
      <AnimatePresence>
        {deleteTarget && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-[45] flex items-center justify-center p-4"
          >
            <div
              className="absolute inset-0 bg-black/60 backdrop-blur-sm"
              onClick={closeDeleteConfirm}
              aria-hidden
            />
            <motion.div
              initial={{ opacity: 0, scale: 0.96, y: 8 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.96 }}
              role="dialog"
              aria-modal="true"
              aria-labelledby="delete-project-title"
              className="relative w-full max-w-md rounded-2xl border border-theme bg-card p-6 shadow-theme"
            >
              <h2 id="delete-project-title" className="text-lg font-semibold text-body">
                Supprimer le projet
              </h2>
              <p className="mt-3 text-sm text-muted leading-relaxed">
                Êtes-vous sûr de vouloir supprimer ce projet ?
                {deleteTarget?.titre ? (
                  <>
                    {' '}
                    <span className="font-medium text-body">« {deleteTarget.titre} »</span> sera retiré de votre portfolio
                    (fichiers inclus).
                  </>
                ) : (
                  ' Cette action est irréversible.'
                )}
              </p>
              <div className="mt-6 flex flex-wrap justify-end gap-3">
                <button
                  type="button"
                  onClick={closeDeleteConfirm}
                  disabled={deleteSubmitting}
                  className="rounded-xl border border-theme bg-block px-4 py-2.5 text-sm font-medium text-body disabled:opacity-50"
                >
                  Annuler
                </button>
                <button
                  type="button"
                  onClick={confirmDeleteProject}
                  disabled={deleteSubmitting}
                  className="inline-flex min-w-[120px] items-center justify-center gap-2 rounded-xl bg-red-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-700 disabled:opacity-60"
                >
                  {deleteSubmitting ? (
                    <>
                      <span className="h-4 w-4 shrink-0 animate-spin rounded-full border-2 border-white border-t-transparent" aria-hidden />
                      Suppression…
                    </>
                  ) : (
                    <>
                      <TrashIcon className="h-4 w-4" />
                      Supprimer
                    </>
                  )}
                </button>
              </div>
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>

      {/* Modal — Ajouter un projet */}
      <AnimatePresence>
        {modalOpen && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-40 flex items-center justify-center p-4"
          >
            <div
              className="absolute inset-0 bg-black/60 backdrop-blur-sm"
              onClick={closeModal}
              aria-hidden
            />
            <motion.div
              initial={{ opacity: 0, scale: 0.96, y: 10 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.96 }}
              transition={{ type: 'spring', duration: 0.3 }}
              className="relative flex max-h-[90vh] w-full max-w-xl flex-col rounded-2xl border border-theme bg-card shadow-theme"
            >
              <div className="shrink-0 border-b border-theme px-6 py-4">
                <h2 className="text-xl font-semibold text-body">{editingId != null ? 'Modifier le projet' : 'Ajouter un projet'}</h2>
                <p className="mt-0.5 text-sm text-muted">
                  {editingId != null ? 'Mettez à jour les informations de votre projet.' : 'Renseignez les informations de votre projet.'}
                </p>
              </div>

              <form onSubmit={handleSubmit} className="flex min-h-0 flex-1 flex-col overflow-hidden">
                <div className="flex-1 overflow-y-auto px-6 py-5 space-y-6">
                  {/* Section 1 — Informations de base */}
                  <section>
                    <h3 className="mb-3 flex items-center gap-2 text-sm font-medium uppercase tracking-wider text-muted">
                      <span className="h-px w-4 bg-[var(--primary)]/50" />
                      Informations de base
                    </h3>
                    <div className="space-y-3">
                      <div>
                        <label htmlFor="titre" className="block text-sm font-medium text-body mb-1">
                          Titre <span className="text-red-400">*</span>
                        </label>
                        <input
                          id="titre"
                          name="titre"
                          value={form.titre}
                          onChange={handleChange}
                          required
                          placeholder="Titre du projet"
                          className={`${inputBase} ${hasError('titre') ? inputError : ''}`}
                        />
                        {errors.titre && <p className="mt-1 text-sm text-red-400">{errors.titre[0]}</p>}
                      </div>
                      <div>
                        <label htmlFor="description" className="block text-sm font-medium text-body mb-1">
                          Description
                        </label>
                        <textarea
                          id="description"
                          name="description"
                          value={form.description}
                          onChange={handleChange}
                          rows={2}
                          placeholder="Courte description du projet"
                          className={`${inputBase} resize-none ${hasError('description') ? inputError : ''}`}
                        />
                        {errors.description && <p className="mt-1 text-sm text-red-400">{errors.description[0]}</p>}
                      </div>
                      <div className="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <div>
                          <label htmlFor="lien_github" className="block text-sm font-medium text-body mb-1">
                            Lien GitHub
                          </label>
                          <input
                            id="lien_github"
                            name="lien_github"
                            type="url"
                            value={form.lien_github}
                            onChange={handleChange}
                            placeholder="https://github.com/..."
                            className={`${inputBase} ${hasError('lien_github') ? inputError : ''}`}
                          />
                          {errors.lien_github && <p className="mt-1 text-sm text-red-400">{errors.lien_github[0]}</p>}
                        </div>
                        <div>
                          <label htmlFor="lien_demo" className="block text-sm font-medium text-body mb-1">
                            Lien démo
                          </label>
                          <input
                            id="lien_demo"
                            name="lien_demo"
                            type="url"
                            value={form.lien_demo}
                            onChange={handleChange}
                            placeholder="https://..."
                            className={`${inputBase} ${hasError('lien_demo') ? inputError : ''}`}
                          />
                          {errors.lien_demo && <p className="mt-1 text-sm text-red-400">{errors.lien_demo[0]}</p>}
                        </div>
                      </div>
                      <div className="grid grid-cols-2 gap-3">
                        <div>
                          <label htmlFor="date_debut" className="block text-sm font-medium text-body mb-1">Date de début</label>
                          <input
                            id="date_debut"
                            name="date_debut"
                            type="date"
                            value={form.date_debut}
                            onChange={handleChange}
                            className={`${inputBase} ${hasError('date_debut') ? inputError : ''}`}
                          />
                          {errors.date_debut && <p className="mt-1 text-sm text-red-400">{errors.date_debut[0]}</p>}
                        </div>
                        <div>
                          <label htmlFor="date_fin" className="block text-sm font-medium text-body mb-1">Date de fin</label>
                          <input
                            id="date_fin"
                            name="date_fin"
                            type="date"
                            value={form.date_fin}
                            onChange={handleChange}
                            className={`${inputBase} ${hasError('date_fin') ? inputError : ''}`}
                          />
                          {errors.date_fin && <p className="mt-1 text-sm text-red-400">{errors.date_fin[0]}</p>}
                        </div>
                      </div>
                    </div>
                  </section>

                  {/* Section 2 — Média & compétences */}
                  <section>
                    <h3 className="mb-3 flex items-center gap-2 text-sm font-medium uppercase tracking-wider text-muted">
                      <span className="h-px w-4 bg-[var(--primary)]/50" />
                      Média & compétences
                    </h3>
                    <div className="space-y-4">
                      <div>
                        <label className="block text-sm font-medium text-body mb-2">
                          Image du projet (logo / couverture)
                        </label>
                        <div className="flex items-start gap-4">
                          <div className="flex h-24 w-24 shrink-0 overflow-hidden rounded-xl border border-theme bg-block">
                            {imagePreview ? (
                              <img src={imagePreview} alt="Aperçu" className="h-full w-full object-cover" loading="lazy" />
                            ) : (
                              <div className="flex h-full w-full items-center justify-center text-muted">
                                <svg className="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14" />
                                </svg>
                              </div>
                            )}
                          </div>
                          <div className="min-w-0 flex-1">
                            <input
                              type="file"
                              accept="image/*"
                              onChange={handleImageChange}
                              className="w-full rounded-xl border border-theme bg-block px-3 py-2 text-sm text-body file:mr-2 file:rounded-lg file:border-0 file:bg-[var(--primary)] file:px-3 file:py-1.5 file:text-white file:text-sm"
                            />
                            <p className="mt-1 text-xs text-muted">Optionnel. Une image principale pour la carte et le portfolio.</p>
                          </div>
                        </div>
                      </div>
                      <div>
                        <label className="block text-sm font-medium text-body mb-2">
                          Galerie (captures d&apos;écran)
                        </label>
                        <input
                          key={galleryInputKey}
                          type="file"
                          accept="image/*"
                          multiple
                          onChange={handleGalleryChange}
                          className="w-full rounded-xl border border-theme bg-block px-3 py-2 text-sm text-body file:mr-2 file:rounded-lg file:border-0 file:bg-[var(--primary)] file:px-3 file:py-1.5 file:text-white file:text-sm"
                        />
                        <p className="mt-1 text-xs text-muted">
                          Plusieurs fichiers possibles. En modification, l&apos;envoi de nouvelles images remplace toute la galerie existante.
                        </p>
                        {errors.images && <p className="mt-1 text-sm text-red-400">{errors.images[0]}</p>}
                        {(galleryPreviews.length > 0 || (editingId != null && existingGallery.length > 0)) && (
                          <div className="mt-3">
                            <div className="mb-2 flex flex-wrap items-center justify-between gap-2">
                              <span className="text-xs font-medium uppercase tracking-wide text-muted">Aperçu</span>
                              {galleryPreviews.length > 0 && (
                                <button
                                  type="button"
                                  onClick={clearGallerySelection}
                                  className="text-xs text-red-400/90 hover:underline"
                                >
                                  Retirer la sélection locale
                                </button>
                              )}
                            </div>
                            <div className="grid grid-cols-2 gap-4 md:grid-cols-3">
                              {editingId != null && galleryPreviews.length === 0 && existingGallery.map((g) => (
                                <div key={g.id} className="relative aspect-video overflow-hidden rounded-lg border border-theme bg-block">
                                  <img src={getStorageUrl(g.url)} alt="" className="h-full w-full object-cover" loading="lazy" />
                                  <span className="absolute bottom-0 left-0 right-0 bg-black/50 px-1 py-0.5 text-center text-[10px] text-white/90">En ligne</span>
                                </div>
                              ))}
                              {galleryPreviews.map((p, i) => (
                                <div key={`${p.url}-${i}`} className="aspect-video overflow-hidden rounded-lg border border-theme bg-block">
                                  <img src={p.url} alt="" className="h-full w-full object-cover" loading="lazy" />
                                </div>
                              ))}
                            </div>
                          </div>
                        )}
                      </div>
                      <div>
                        <label className="block text-sm font-medium text-body mb-2">
                          Compétences associées
                        </label>
                        <p className="mb-2 text-xs text-muted">
                          Choisir dans la liste ou saisir un nom libre ci-dessous.
                        </p>
                        <div className="flex flex-wrap gap-2 mb-3">
                          {skills.map((skill) => (
                            <button
                              key={skill.id}
                              type="button"
                              onClick={() => handleSkillToggle(skill.id)}
                              className={`rounded-lg border px-3 py-1.5 text-sm transition ${
                                form.skill_ids.includes(skill.id)
                                  ? 'border-[var(--primary)]/50 bg-[var(--primary)]/10 text-body'
                                  : 'border-theme bg-block text-muted'
                              }`}
                            >
                              {skill.nom}
                            </button>
                          ))}
                        </div>
                        <div className="flex flex-wrap gap-2 mb-3">
                          {(form.skill_names || []).map((name) => (
                            <span
                              key={name}
                              className="inline-flex items-center gap-1 rounded-lg border border-[var(--primary)]/30 bg-[var(--primary)]/10 px-2.5 py-1 text-sm font-medium text-body"
                            >
                              {name}
                              <button
                                type="button"
                                onClick={() => removeFreeSkill(name)}
                                className="rounded p-0.5 hover:bg-[var(--primary)]/20"
                                title="Retirer"
                              >
                                <svg className="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                                </svg>
                              </button>
                            </span>
                          ))}
                        </div>
                        <div className="flex gap-2">
                          <input
                            type="text"
                            value={freeSkillInput}
                            onChange={(e) => setFreeSkillInput(e.target.value)}
                            onKeyDown={(e) => {
                              if (e.key === 'Enter') {
                                e.preventDefault();
                                addFreeSkill();
                              }
                            }}
                            placeholder="Saisir une compétence (libre)..."
                            className="flex-1 rounded-xl border border-theme bg-block px-3 py-2 text-sm text-body placeholder-[var(--muted)] focus:border-[var(--primary)]/50 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]/30"
                          />
                          <button
                            type="button"
                            onClick={() => addFreeSkill()}
                            disabled={!freeSkillInput.trim()}
                            className="rounded-xl border border-theme bg-block px-3 py-2 text-sm text-body disabled:opacity-50"
                          >
                            Ajouter
                          </button>
                        </div>
                        {errors.skill_ids && <p className="mt-1 text-sm text-red-400">{errors.skill_ids[0]}</p>}
                        {errors.skill_names && <p className="mt-1 text-sm text-red-400">{errors.skill_names[0]}</p>}
                      </div>
                    </div>
                  </section>
                </div>

                <div className="shrink-0 flex justify-end gap-3 border-t border-theme px-6 py-4 bg-block rounded-b-2xl">
                  <button
                    type="button"
                    onClick={closeModal}
                    disabled={submitting}
                    className="rounded-xl border border-theme bg-block px-4 py-2.5 text-sm font-medium text-body disabled:opacity-50"
                  >
                    Annuler
                  </button>
                  <button
                    type="submit"
                    disabled={submitting}
                    className="flex min-w-[120px] items-center justify-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-medium text-white disabled:opacity-70"
                  >
                    {submitting ? (
                      <>
                        <span className="h-4 w-4 shrink-0 animate-spin rounded-full border-2 border-white border-t-transparent" aria-hidden />
                        Enregistrement…
                      </>
                    ) : editingId != null ? (
                      'Mettre à jour'
                    ) : (
                      'Enregistrer'
                    )}
                  </button>
                </div>
              </form>
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>
    </DashboardLayout>
  );
}

function PencilIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden>
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
    </svg>
  );
}

function TrashIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden>
      <path
        strokeLinecap="round"
        strokeLinejoin="round"
        strokeWidth={2}
        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
      />
    </svg>
  );
}

function GitHubIcon({ className }) {
  return (
    <svg className={className} fill="currentColor" viewBox="0 0 24 24">
      <path fillRule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.527 1.028 1.527 1.028.892 1.522 2.336 1.087 2.902.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clipRule="evenodd" />
    </svg>
  );
}

function ExternalIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
    </svg>
  );
}


