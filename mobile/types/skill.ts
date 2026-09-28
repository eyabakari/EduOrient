/**
 * @file Types métiers pour la progression des compétences côté UI (niveaux + map par id).
 */
export type SkillLevel =
  | "beginner"
  | "intermediate"
  | "advanced"

export type SkillsProgressMap = Record<
  string,
  {
    id: string
    currentLevel: SkillLevel
    completedLevels: SkillLevel[]
    xpEarned: number
  }
>

