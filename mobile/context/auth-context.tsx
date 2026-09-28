/**
 * @file Contexte d’authentification : JWT (SecureStore), login/register/updateUser, déconnexion sur 401.
 * @see https://docs.expo.dev/versions/latest/sdk/secure-store/
 * @see https://react.dev/reference/react/createContext
 */
import {
  createContext,
  useCallback,
  useContext,
  useEffect,
  useMemo,
  useState,
  type ReactNode,
} from "react"
import axios from "axios"
import { api, setApiAuthToken } from "@/lib/api"
import { API_ORIGIN } from "@/constants/api-config"
import {
  clearStoredAuth,
  getStoredToken,
  setStoredToken,
  setStoredUserJson,
} from "@/lib/storage"
import { setUnauthorizedHandler } from "@/lib/auth-events"
import type { ApiUser } from "@/types/user"

type LoginPayload = { email: string; password: string }

export type RegisterPayload = {
  role_id: number
  name: string
  email: string
  password: string
  password_confirmation: string
  bio?: string
  specialite?: string
  niveau_etude?: string
  linkedin?: string
  entreprise?: string
  poste?: string
  ville?: string
  gouvernorat?: string
  company_description?: string
  skill_ids?: number[]
}

type RegisterRequestData = RegisterPayload | FormData

interface AuthContextValue {
  user: ApiUser | null
  token: string | null
  loading: boolean
  isAuthenticated: boolean
  login: (credentials: LoginPayload) => Promise<unknown>
  register: (data: RegisterRequestData) => Promise<unknown>
  logout: () => Promise<void>
  updateUser: (userData: ApiUser) => Promise<void>
  refreshUser: () => Promise<void>
}

const AuthContext = createContext<AuthContextValue | null>(null)
const MOBILE_ALLOWED_ROLES = new Set(["candidat", "recruteur"])

function getUserRoleName(userData: ApiUser | null | undefined): string {
  return String(userData?.role?.name ?? "").trim().toLowerCase()
}

function assertMobileAllowedUser(userData: ApiUser | null | undefined) {
  const roleName = getUserRoleName(userData)
  if (!MOBILE_ALLOWED_ROLES.has(roleName)) {
    throw new Error(
      "Acces mobile refuse. L'application mobile est reservee aux candidats et aux recruteurs. Les administrateurs doivent utiliser le tableau de bord Web."
    )
  }
}

function isEmailVerified(userData: ApiUser | null | undefined): boolean {
  return !!userData?.email_verified_at
}

export function AuthProvider({ children }: { children: ReactNode }) {
  const [user, setUser] = useState<ApiUser | null>(null)
  const [token, setToken] = useState<string | null>(null)
  const [loading, setLoading] = useState(true)

  const logout = useCallback(async () => {
    setApiAuthToken(null)
    setUser(null)
    setToken(null)
    await clearStoredAuth()
  }, [])

  useEffect(() => {
    setUnauthorizedHandler(() => {
      setApiAuthToken(null)
      setUser(null)
      setToken(null)
      void clearStoredAuth()
    })
    return () => setUnauthorizedHandler(null)
  }, [])

  useEffect(() => {
    let cancelled = false
    let timeoutId: ReturnType<typeof setTimeout> | null = null

    ;(async () => {
      try {
        const storedToken = await getStoredToken()
        if (!storedToken) {
          if (!cancelled) setLoading(false)
          return
        }
        if (cancelled) return
        setApiAuthToken(storedToken)
        setToken(storedToken)

        // Promesse avec timeout pour l'appel /me
        try {
          const verifyTokenPromise = api.get<{ user: ApiUser }>('/me')
          const timeoutPromise = new Promise<never>((_, reject) => {
            timeoutId = setTimeout(() => {
              reject(new Error('Vérification du token expirée (timeout 5s)'))
            }, 5000)
          })

          const { data } = await Promise.race([verifyTokenPromise, timeoutPromise])
          if (timeoutId) clearTimeout(timeoutId)

          if (cancelled) return
          if (data?.user) {
            try {
              assertMobileAllowedUser(data.user)
            } catch (roleError) {
              console.error("Erreur : rôle utilisateur non autorisé sur mobile", roleError)
              await clearStoredAuth()
              setApiAuthToken(null)
              setUser(null)
              setToken(null)
              return
            }
            setUser(data.user)
            await setStoredUserJson(JSON.stringify(data.user))
          } else {
            console.warn("Réponse /me invalide : user manquant")
            await clearStoredAuth()
            setApiAuthToken(null)
            setUser(null)
            setToken(null)
          }
        } catch (e) {
          if (timeoutId) clearTimeout(timeoutId)
          
          const errorMsg = e instanceof Error ? e.message : "Erreur inconnue"
          console.error("Erreur lors de la vérification du token:", errorMsg)

          if (axios.isAxiosError(e)) {
            if (e.response?.status === 401) {
              console.log("Token invalide (401)")
              await clearStoredAuth()
              if (!cancelled) {
                setUser(null)
                setToken(null)
                setApiAuthToken(null)
              }
            } else if (e.code === "ECONNABORTED") {
              console.error("Connexion au serveur échouée : timeout ou serveur inaccessible")
            } else {
              console.error("Erreur réseau :", e.message)
            }
          } else if (e instanceof Error && e.message.includes("timeout")) {
            console.error("Timeout lors de la vérification du token. Serveur inaccessible à", API_ORIGIN)
          }

          if (axios.isAxiosError(e) && e.response?.status !== 401) {
            // Erreur réseau / timeout : conservez le token en storage.
            if (!cancelled) {
              setUser(null)
            }
          }
        }
      } catch (e) {
        const errorMsg = e instanceof Error ? e.message : "Erreur système inconnue"
        console.error("Erreur système lors de l'initialisation auth:", errorMsg)
      } finally {
        if (timeoutId) clearTimeout(timeoutId)
        if (!cancelled) setLoading(false)
      }
    })()

    return () => {
      cancelled = true
      if (timeoutId) clearTimeout(timeoutId)
    }
  }, [])

  const login = useCallback(async (credentials: LoginPayload) => {
    const { data } = await api.post<{
      user: ApiUser
      token: string
    }>("/login", credentials)
    const { user: userData, token: newToken } = data
    if (!newToken) {
      throw new Error("Token manquant dans la réponse de connexion.")
    }
    assertMobileAllowedUser(userData)
    setApiAuthToken(newToken)
    await setStoredToken(newToken)
    await setStoredUserJson(JSON.stringify(userData))
    setUser(userData)
    setToken(newToken)
    return data
  }, [])

  const register = useCallback(async (payload: RegisterRequestData) => {
    const { data } = await api.post<{
      user: ApiUser
      token: string
    }>("/register", payload)
    const { user: userData, token: newToken } = data
    if (!newToken) {
      throw new Error("Token manquant dans la réponse d'inscription.")
    }
    assertMobileAllowedUser(userData)
    setApiAuthToken(newToken)
    await setStoredToken(newToken)
    await setStoredUserJson(JSON.stringify(userData))
    setUser(userData)
    setToken(newToken)
    return data
  }, [])

  const updateUser = useCallback(async (userData: ApiUser) => {
    assertMobileAllowedUser(userData)
    setUser(userData)
    await setStoredUserJson(JSON.stringify(userData))
  }, [])

  const refreshUser = useCallback(async () => {
    const { data } = await api.get<{ user: ApiUser }>("/me")
    if (data?.user) {
      try {
        assertMobileAllowedUser(data.user)
      } catch (e) {
        await logout()
        throw e
      }
      setUser(data.user)
      await setStoredUserJson(JSON.stringify(data.user))
    }
  }, [logout])

  const value = useMemo<AuthContextValue>(
    () => ({
      user,
      token,
      loading,
      isAuthenticated: !!token && !!user && isEmailVerified(user),
      login,
      register,
      logout,
      updateUser,
      refreshUser,
    }),
    [user, token, loading, login, register, logout, updateUser, refreshUser]
  )

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>
}

export function useAuth(): AuthContextValue {
  const ctx = useContext(AuthContext)
  if (!ctx) {
    throw new Error("useAuth doit être utilisé dans AuthProvider")
  }
  return ctx
}
