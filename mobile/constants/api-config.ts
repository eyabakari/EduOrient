/**
 * @file Origine de l’API Laravel et constantes partagées (rôle étudiant).
 * EXPO_PUBLIC_* : variables d’environnement Expo (app.config / .env).
 * @see https://docs.expo.dev/guides/environment-variables/
 */
import { API_BASE_URL, API_ORIGIN } from "@/src/config/api"

export { API_BASE_URL, API_ORIGIN }

/** Aligné sur le web (Register.jsx ROLE_candidat = '2'). */
export const CANDIDAT_ROLE_ID = Number(
  process.env?.EXPO_PUBLIC_CANDIDAT_ROLE_ID ?? 2
)

// Backwards-compat alias: some components still import ETUDIANT_ROLE_ID
export const ETUDIANT_ROLE_ID = CANDIDAT_ROLE_ID

export const RECRUTEUR_ROLE_ID = Number(
  process.env?.EXPO_PUBLIC_RECRUTEUR_ROLE_ID ?? 3
)

export default {
  API_BASE_URL,
  API_ORIGIN,
  CANDIDAT_ROLE_ID,
  ETUDIANT_ROLE_ID,
  RECRUTEUR_ROLE_ID,
}

