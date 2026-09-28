/**
 * @file Variante web : pas d’API Notifications du navigateur ici ; le toggle reste logique métier + API.
 * @see notification-permission.native.ts pour iOS/Android (expo-notifications).
 */
export async function ensureNotificationPermission(): Promise<boolean> {
  return true
}
