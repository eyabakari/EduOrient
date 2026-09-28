/**
 * @file Réexport pratique du hook `useStudentDataContext` (données dashboard / skills après login).
 * @see context/student-data-context.tsx
 */
export type {
  ApiProject,
  ApiRecommendation,
  ApiOfferRecommendation,
  ApiMissingSkill,
} from "@/context/student-data-context"
export { useStudentDataContext as useStudentData } from "@/context/student-data-context"
