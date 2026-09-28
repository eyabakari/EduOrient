/**
 * @file Préférence « notifications activées » côté app (indépendante du premier rendu API).
 */
import * as SecureStore from "expo-secure-store"
import { Platform } from "react-native"

export const NOTIFICATION_PREFERENCE_KEY = "eduorient_app_notifications_enabled"

const memoryFallback = new Map<string, string>()

function parseEnabled(raw: string | null): boolean | null {
  if (raw === null || raw === undefined) return null
  if (raw === "1" || raw === "true") return true
  if (raw === "0" || raw === "false") return false
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

/** Préférence locale (comme le thème) ; `null` = pas encore choisi. */
export async function readNotificationPreference(): Promise<boolean | null> {
  const key = NOTIFICATION_PREFERENCE_KEY

  if (Platform.OS === "web") {
    const v = parseEnabled(readWebLocalStorage(key))
    if (v !== null) return v
    return parseEnabled(memoryFallback.get(key) ?? null)
  }

  try {
    const v = parseEnabled(await SecureStore.getItemAsync(key))
    if (v !== null) return v
  } catch {
    /* */
  }

  return parseEnabled(memoryFallback.get(key) ?? null)
}

export async function writeNotificationPreference(enabled: boolean): Promise<void> {
  const key = NOTIFICATION_PREFERENCE_KEY
  const value = enabled ? "1" : "0"
  memoryFallback.set(key, value)

  if (Platform.OS === "web") {
    writeWebLocalStorage(key, value)
    return
  }

  try {
    await SecureStore.setItemAsync(key, value)
  } catch {
    /* */
  }
}
