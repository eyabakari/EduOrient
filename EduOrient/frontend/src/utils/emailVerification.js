/**
 * Indique si l’utilisateur doit encore confirmer son e-mail (OTP).
 * Si la clé est absente (anciennes sessions), on ne bloque pas.
 */
export function needsEmailVerification(user) {
  if (!user || typeof user !== 'object') return false;
  if (!Object.prototype.hasOwnProperty.call(user, 'email_verified_at')) return false;
  return user.email_verified_at === null || user.email_verified_at === '';
}
