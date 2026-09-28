/**
 * @file iOS/Android : demande permission notifications (import profond pour éviter le barrel Metro).
 * @see https://docs.expo.dev/versions/latest/sdk/notifications/
 */
import {
  getPermissionsAsync,
  requestPermissionsAsync,
} from "expo-notifications/build/NotificationPermissions"

/**
 * Demande la permission système (iOS / Android).
 */
export async function ensureNotificationPermission(): Promise<boolean> {
  try {
    const { status: existing } = await getPermissionsAsync()
    if (existing === "granted") return true
    const { status } = await requestPermissionsAsync()
    return status === "granted"
  } catch {
    return false
  }
}
