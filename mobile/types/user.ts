/**
 * @file Types utilisateur alignés sur les réponses JSON Laravel (User + candidat / recruteur).
 * Sous-ensemble utile au mobile lorsque l’API charge ces relations.
 */
export interface ApiUser {
  id: number
  name: string
  email: string
  email_verified_at?: string | null
  created_at?: string
  role?: {
    id: number
    name: string
  }
  candidat?: {
    id: number
    bio?: string | null
    niveau_etude?: string | null
    specialite?: string | null
    linkedin?: string | null
    portfolio_public?: boolean | null
    /** Si le backend les expose (accessor / append), utilisés en priorité sur les calculs locaux. */
    projects_count?: number | null
    skills_mastered?: number | null
    streak_days?: number | null
    parcours_progress?: number | null
    xp_total?: number | null
    level?: number | null
  } | null
  recruteur?: unknown
}

