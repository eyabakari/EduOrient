/**
 * @file Mini bus d’événements : l’interceptor Axios (401) appelle triggerUnauthorized ;
 * AuthProvider enregistre le handler pour vider la session et renvoyer vers Welcome.
 */

type Handler = () => void

let unauthorizedHandler: Handler | null = null

export function setUnauthorizedHandler(fn: Handler | null) {
  unauthorizedHandler = fn
}

export function triggerUnauthorized() {
  unauthorizedHandler?.()
}
