/**
 * @file Client HTTP unique vers l’API Laravel (/api) : en-têtes JSON, Bearer, gestion 401.
 * @see https://axios-http.com/docs/instance
 */
import axios, { AxiosHeaders } from "axios"
import { API_ORIGIN } from "@/constants/api-config"
import { clearStoredAuth, getStoredToken } from "@/lib/storage"
import { triggerUnauthorized } from "@/lib/auth-events"

const PUBLIC_ENDPOINTS = [
  "/api/login",
  "/api/register",
  "/api/forgot-password",
  "/api/password",
  "/api/skills/public-catalog",
]

let redirectingToLogin = false
let runtimeAuthToken: string | null = null

export function setApiAuthToken(token: string | null) {
  runtimeAuthToken = token?.trim() || null
}

function isPublicEndpoint(url: string | undefined): boolean {
  if (!url) return false
  return PUBLIC_ENDPOINTS.some((endpoint) => url.startsWith(endpoint))
}

async function redirectToLogin() {
  if (redirectingToLogin) return
  redirectingToLogin = true
  await clearStoredAuth()
  triggerUnauthorized()
  setTimeout(() => {
    redirectingToLogin = false
  }, 500)
}

async function getRequestToken(): Promise<string | null> {
  return runtimeAuthToken || (await getStoredToken())
}

export const api = axios.create({
  baseURL: API_ORIGIN,
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
  timeout: 25_000,
})

console.log("[API] API_ORIGIN:", API_ORIGIN)

export function getBackendOrigin(): string {
  try {
    const url = new URL(API_ORIGIN)
    url.pathname = url.pathname.replace(/\/api\/?$/, "").replace(/\/$/, "")
    url.search = ""
    url.hash = ""
    return url.toString().replace(/\/$/, "")
  } catch {
    return API_ORIGIN.replace(/\/api\/?$/, "").replace(/\/$/, "")
  }
}

api.interceptors.request.use(
  async (config) => {
    const headers = AxiosHeaders.from(config.headers)

    if (
      typeof config.url === "string" &&
      config.url.startsWith("/") &&
      !config.url.startsWith("/api/")
    ) {
      config.url = `/api${config.url}`
    }

    const publicEndpoint = isPublicEndpoint(config.url)
    const token = await getRequestToken()
    if (!publicEndpoint) {
      console.log("Token utilisé:", token ? `${token.slice(0, 8)}...` : null)
    }
    if (token) {
      headers.set("Authorization", `Bearer ${token}`)
    } else if (!publicEndpoint) {
      await redirectToLogin()
      return Promise.reject(new axios.CanceledError("Missing auth token"))
    }

    const urlBase = config.baseURL?.replace(/\/$/, "") ?? ""
    const fullUrl = `${urlBase}${config.url ?? ""}`
    console.log("[API] Requête:", config.method?.toUpperCase() ?? "GET", fullUrl)

    // Détecter si les données sont FormData (upload d'images)
    const isFormData =
      config.data && typeof (config.data as { append?: unknown }).append === "function"

    if (isFormData) {
      // ⚠️ Pour FormData (multipart/form-data) :
      // 1. Supprimer Content-Type pour laisser Expo/navigateur générer la limite
      // 2. Ajouter transformRequest pour préserver FormData sans transformation Axios
      headers.delete("Content-Type")
      if (!config.transformRequest) {
        config.transformRequest = [(data: any) => data]
      }
      console.log("[API] FormData détecté — laissez Expo gérer les en-têtes multipart")
    } else {
      // Pour JSON standard, définir les en-têtes explicitement
      headers.set("Content-Type", "application/json")
    }

    headers.set("Accept", "application/json")
    config.headers = headers
    return config
  },
  (error) => Promise.reject(error)
)

api.interceptors.response.use(
  (response) => {
    redirectingToLogin = false
    return response
  },
  async (error) => {
    if (axios.isCancel(error)) {
      return Promise.reject(error)
    }

    const publicEndpoint = isPublicEndpoint(error.config?.url)

    if (error.response?.status === 401) {
      if (publicEndpoint) {
        return Promise.reject(error)
      }
      console.log("401 protégé:", error.config?.url)
      await redirectToLogin()
      return Promise.reject(error)
    }

    if (error.response && !publicEndpoint) {
      console.log("Erreur Axios:", error.response)
    }

    return Promise.reject(error)
  }
)

/** URL fichier public Laravel (`/storage/...`). */
export function getStorageUrl(path: string | null | undefined): string | null {
  if (!path || typeof path !== "string") return null
  const backendOrigin = getBackendOrigin()

  if (path.startsWith("http://") || path.startsWith("https://")) {
    try {
      const url = new URL(path)
      const normalizedPath = url.pathname.replace(/^\/storage\/projets\//, "/storage/projects/")
      const isLocalBackend = url.hostname === "localhost" || url.hostname === "127.0.0.1"
      if (isLocalBackend || normalizedPath.startsWith("/storage/")) {
        return `${backendOrigin}${normalizedPath}${url.search}`
      }
      return path
    } catch {
      return path
    }
  }

  const normalizedInput = path.startsWith("/") ? path : `/${path}`
  const normalized = normalizedInput
    .replace(/^\/storage\/projets\//, "/storage/projects/")
    .replace(/^\/(profile-photos|project-images|projects)\//, "/storage/$1/")

  return `${backendOrigin}${normalized}`
}
