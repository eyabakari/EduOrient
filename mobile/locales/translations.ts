/**
 * French-only translations module for EduOrient Skill-Up.
 * Contains all UI text strings used throughout the mobile application.
 */
export type AppLocale = "fr"

const fr = {
  /* ========== Navigation ========== */
  nav_home: "Accueil",
  nav_projects: "Projets",
  nav_portfolio: "Portfolio",
  nav_settings: "Paramètres",
  nav_skills: "Compétences",
  nav_matching: "Mises en relation",
  nav_roadmap: "Parcours",
  nav_quiz: "Quiz",
  nav_profile: "Profil",
  home: "Tableau de bord",
  offres: "Offres",
  ajouter_offre: "Ajouter une offre",
  messages: "Messagerie",
  parametres: "Paramètres",
  portfolio: "Portfolio",
  autres: "Autres",
  matching: "Mises en relation",
  projets: "Projets",
  competences: "Compétences",

  /* ========== Authentication ========== */
  auth_email: "Adresse email",
  auth_password: "Mot de passe",
  auth_placeholder_email: "votre.email@exemple.com",

  login_title: "Connexion",
  login_subtitle: "Accédez à votre espace EduOrient",
  login_forgot: "Mot de passe oublié ?",
  login_submit: "Se connecter",
  login_no_account: "Pas encore de compte ?",
  login_signup: "S'inscrire",
  login_google_alert_title: "Google",
  login_google_alert_body: "La connexion Google n'est pas disponible. Utilisez votre email et mot de passe.",

  forgot_title: "Réinitialiser votre mot de passe",
  forgot_subtitle: "Entrez votre email pour recevoir un lien de réinitialisation.",
  forgot_submit: "Envoyer le lien",

  change_password_title: "Modifier le mot de passe",
  change_password_current: "Mot de passe actuel",
  change_password_current_ph: "Entrez votre mot de passe",
  change_password_new: "Nouveau mot de passe",
  change_password_new_ph: "Au moins 8 caractères",
  change_password_confirm: "Confirmer le nouveau mot de passe",
  change_password_confirm_ph: "Répétez votre mot de passe",
  change_password_submit: "Modifier le mot de passe",
  change_password_mismatch: "Les mots de passe ne correspondent pas.",
  change_password_min: "Le mot de passe doit contenir au moins 8 caractères.",
  change_password_success_title: "Mot de passe modifié",
  change_password_success_body: "Votre mot de passe a été modifié avec succès.",
  change_password_err_generic: "Impossible de modifier le mot de passe.",

  /* ========== Dashboard & Skills ========== */
  dashboard_welcome: "Bienvenue sur votre tableau de bord",
  dashboard_retry: "Réessayer",
  dashboard_skills_declared: "Compétences déclarées",
  dashboard_projects: "Projets publiés",
  dashboard_unknown_skill: "Compétence",
  dashboard_no_skills: "Aucune compétence déclarée.",
  dashboard_recent_projects: "Projets récents",
  dashboard_recent_projects_hint: "Consultez vos derniers projets pour enrichir votre portfolio.",
  dashboard_view_projects: "Voir tous les projets",
  dashboard_loading_projects: "Chargement des projets...",
  dashboard_projects_empty: "Aucun projet pour le moment.",
  student_data_load: "Impossible de charger vos données.",

  skills_level_beginner: "Débutant",
  skills_level_intermediate: "Intermédiaire",
  skills_level_advanced: "Avancé",

  /* ========== Profile ========== */
  profile_title: "Profil",
  profile_stat_mastered: "Maîtrisées",
  profile_stat_streak: "Jours consécutifs",
  profile_stat_projects: "Projets",
  profile_stat_xp: "Expérience",
  profile_achievements: "Réalisations",
  profile_api_data: "Synchronisation en cours",
  profile_member_since: "Membre depuis {{date}}",
  profile_no_skills: "Aucune compétence sélectionnée. Ajoutez-en depuis le site web puis tirez pour rafraîchir.",
  profile_level_badge: "Niveau {{n}}",

  achievement_skill_title: "Maître des compétences",
  achievement_skill_desc: "Maîtrisez 5 compétences ou plus",
  achievement_streak_title: "Progression régulière",
  achievement_streak_desc: "Vous avez 7 jours consécutifs d'activité",
  achievement_portfolio_title: "Portfolio complet",
  achievement_portfolio_desc: "Publiez au moins 3 projets",
  achievement_expert_title: "Expert",
  achievement_expert_desc: "Atteignez le niveau expert en une compétence",

  /* ========== Projects ========== */
  projects_title: "Projets",
  projects_add: "Ajouter un projet",
  projects_form_title: "Nouveau projet",
  projects_field_title: "Titre du projet",
  projects_field_title_ph: "Nom de votre projet",
  projects_field_description: "Description",
  projects_field_description_ph: "Décrivez votre projet en quelques lignes",
  projects_field_technologies: "Technologies utilisées",
  projects_field_technologies_ph: "Sélectionnez les technologies",
  projects_field_github: "Lien GitHub",
  projects_field_github_ph: "https://github.com/...",
  projects_field_demo: "Lien de démo",
  projects_field_demo_ph: "https://...",
  projects_field_logo: "Logo du projet",
  projects_field_logo_hint: "Téléversez le logo du projet",
  projects_field_screenshots: "Captures d'écran",
  projects_field_screenshots_hint: "Téléversez une ou plusieurs captures d'écran",
  projects_submit: "Enregistrer le projet",
  projects_added_title: "Projet créé",
  projects_added_body: "Votre projet a été enregistré et est visible dans votre portfolio.",
  projects_err_title: "Le titre est obligatoire.",
  projects_err_create: "Impossible d'ajouter le projet. Réessayez.",
  projects_empty: "Aucun projet pour le moment. Ajoutez votre premier projet.",
  projects_item: "projet",
  projects_items: "projets",
  projects_no_title: "Sans titre",

  /* ========== Recruiter Home ========== */
  recruiter_all_students: "Tous les étudiants",
  recruiter_students_list: "Liste des profils d'étudiants disponibles",
  recruiter_search_placeholder: "Rechercher par nom ou compétence (React, Laravel...)",
  recruiter_student_profiles: "Profils d'étudiants",
  recruiter_result_count_one: "résultat",
  recruiter_result_count_many: "résultats",
  recruiter_loading_students: "Chargement des étudiants...",
  recruiter_no_students: "Aucun étudiant ne correspond à votre recherche.",
  recruiter_view_portfolio: "Consulter le portfolio",
  recruiter_portfolio_title: "Portfolio étudiant",
  recruiter_portfolio_loading: "Chargement du portfolio...",
  recruiter_portfolio_private: "Portfolio privé",
  recruiter_portfolio_close: "Fermer",
  recruiter_student_skills_none: "Aucune compétence technique renseignée.",
  recruiter_student_projects_none: "Aucun projet pour le moment.",
  recruiter_project_no_title: "Sans titre",

  /* ========== Skills & Dashboard ========== */
  my_skills: "Mes compétences",
  skills_selected: "sélectionnées",
  learning_progress: "Progression du parcours",
  learning_progress_percent: "{{percent}}%",
  skill_unknown: "Compétence",
  help_intro: "Foire aux questions sur EduOrient Skill-Up et l'application mobile.",
  help_q1: "Comment ajouter une compétence ?",
  help_a1: "Les compétences sont synchronisées avec votre profil sur le site web.",
  help_q2: "Comment modifier mon profil ?",
  help_a2: "Accédez à Paramètres > Modifier le profil pour mettre à jour vos informations.",
  help_q3: "Comment télécharger mon portfolio ?",
  help_a3: "Ouvrez le site web et téléchargez votre portfolio en PDF depuis votre profil.",
  help_q4: "Comment contacter le support ?",
  help_a4: "Visitez le site web pour contacter l'équipe de support.",
  help_q5: "L'application est-elle gratuite ?",
  help_a5: "Oui, EduOrient Skill-Up est totalement gratuit pour les étudiants et recruteurs.",

  /* ========== Common messages ========== */
  welcome_subtitle: "Maîtrisez les compétences qui comptent pour votre carrière",
  welcome_cta: "Commencer",
  welcome_footer: "Rejoignez des milliers d'étudiants en progression",
}

export type TranslationKey = keyof typeof fr

export function translate(_locale: AppLocale, key: TranslationKey, vars?: Record<string, string | number>) {
  const raw = (fr as any)[key] as string | undefined
  if (!raw) return String(key)
  if (!vars) return raw
  return raw.replace(/{{\s*(\w+)\s*}}/g, (_m, name) => String(vars[name] ?? ""))
}

export function localeToBcp47(_locale: AppLocale) {
  return "fr-FR"
}

export { fr as frBundle }
