/**
 * @file Persistance de la langue UI (fr | en | ar), même stratégie que le thème.
 */
import * as SecureStore from "expo-secure-store"
import { Platform } from "react-native"
import type { AppLocale } from "../locales/translations"

export const LOCALE_PREFERENCE_KEY = "eduorient_app_locale"

const memoryFallback = new Map<string, string>()

function normalizeLocale(raw: string | null): AppLocale | null {
  if (raw === "fr") return raw
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
    /* */
  }
}

export async function readLocalePreference(): Promise<AppLocale | null> {
  const key = LOCALE_PREFERENCE_KEY

  if (Platform.OS === "web") {
    const v = normalizeLocale(readWebLocalStorage(key))
    if (v) return v
    return normalizeLocale(memoryFallback.get(key) ?? null)
  }

  try {
    const v = normalizeLocale(await SecureStore.getItemAsync(key))
    if (v) return v
  } catch {
    /* */
  }

  return normalizeLocale(memoryFallback.get(key) ?? null)
}

export async function writeLocalePreference(locale: AppLocale): Promise<void> {
  const key = LOCALE_PREFERENCE_KEY
  memoryFallback.set(key, locale)

  if (Platform.OS === "web") {
    writeWebLocalStorage(key, locale)
    return
  }

  try {
    await SecureStore.setItemAsync(key, locale)
  } catch {
    /* */
  }
}
