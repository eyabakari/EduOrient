/**
 * @file Préférence thème clair/sombre : web (localStorage), natif SecureStore + mémoire.
 */
import * as SecureStore from "expo-secure-store"
import { Platform } from "react-native"

/**
 * Clé unique (alphanum + `_` — requis pour expo-secure-store, qui refuse `@` et `/`).
 */
export const THEME_PREFERENCE_KEY = "eduorient_app_theme"

const memoryFallback = new Map<string, string>()

function normalizeTheme(raw: string | null): "dark" | "light" | null {
  if (raw === "dark" || raw === "light") return raw
  return null
}

function readWebLocalStorage(key: string): string | null {
  if (typeof globalThis === "undefined") return null
  try {
    const ls = (globalThis as { localStorage?: Storage }).localStorage
    if (!ls) return null
    return ls.getItem(key)
  } catch {
    return null
  }
}

function writeWebLocalStorage(key: string, value: string): void {
  try {
    const ls = (globalThis as { localStorage?: Storage }).localStorage
    if (!ls) return
    ls.setItem(key, value)
  } catch {
    /* quota / mode privé */
  }
}

export async function readThemePreference(): Promise<"dark" | "light" | null> {
  const key = THEME_PREFERENCE_KEY

  if (Platform.OS === "web") {
    const v = normalizeTheme(readWebLocalStorage(key))
    if (v) return v
    return normalizeTheme(memoryFallback.get(key) ?? null)
  }

  try {
    const v = normalizeTheme(await SecureStore.getItemAsync(key))
    if (v) return v
  } catch {
    /* */
  }

  return normalizeTheme(memoryFallback.get(key) ?? null)
}

export async function writeThemePreference(
  value: "dark" | "light"
): Promise<void> {
  const key = THEME_PREFERENCE_KEY
  memoryFallback.set(key, value)

  if (Platform.OS === "web") {
    writeWebLocalStorage(key, value)
    return
  }

  try {
    await SecureStore.setItemAsync(key, value)
  } catch {
    /* on garde au moins memory */
  }
}
