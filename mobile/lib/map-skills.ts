/**
 * @file Normalisation des lignes user_skills Laravel (pivot_level) vers niveaux UI (beginner/intermediate/advanced).
 */
import type { SkillLevel, SkillsProgressMap } from "@/types/skill"

export interface ApiUserSkillRow {
  id: number
  name?: string
  nom?: string
  category?: string | null
  categorie?: string | null
  pivot_level?: string
}

function pivotToLevel(raw: string | undefined): SkillLevel {
  const v = (raw ?? "beginner").toLowerCase()
  if (v === "expert" || v === "advanced") return "advanced"
  if (v === "intermediate") return "intermediate"
  return "beginner"
}

export function mapUserSkillsToProgress(
  skills: ApiUserSkillRow[]
): SkillsProgressMap {
  const record: SkillsProgressMap = {}
  for (const s of skills) {
    const currentLevel = pivotToLevel(s.pivot_level)
    const xpEarned =
      currentLevel === "advanced"
        ? 100
        : currentLevel === "intermediate"
          ? 50
          : 20
    record[String(s.id)] = {
      id: String(s.id),
      currentLevel,
      completedLevels: [],
      xpEarned,
    }
  }
  return record
}
