/**
 * @file Persistance du jeton Sanctum (expo-secure-store). Le JSON utilisateur n’est plus stocké (limite taille).
 * @see https://docs.expo.dev/versions/latest/sdk/secure-store/
 */
import * as SecureStore from "expo-secure-store"

/** Clés valides pour SecureStore : alphanumériques, `.`, `-`, `_` (pas de `@`). */
const TOKEN_KEY = "eduorient.auth.token"

export async function getStoredToken(): Promise<string | null> {
  try {
    return await SecureStore.getItemAsync(TOKEN_KEY)
  } catch {
    return null
  }
}

export async function setStoredToken(token: string): Promise<void> {
  await SecureStore.setItemAsync(TOKEN_KEY, token)
}

/**
 * Conservé pour l’API existante. Le profil n’est plus persisté localement (limite ~2048 octets
 * de SecureStore + pas d’AsyncStorage fiable sur certains builds Android).
 */
export async function getStoredUserJson(): Promise<string | null> {
  return null
}

export async function setStoredUserJson(_json: string): Promise<void> {
  /* no-op */
}

export async function clearStoredAuth(): Promise<void> {
  try {
    await SecureStore.deleteItemAsync(TOKEN_KEY)
  } catch {
    /* */
  }
}
