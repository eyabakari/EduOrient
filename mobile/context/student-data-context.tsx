/**
 * @file Données « connecté » : dashboard, user_skills, recommandations, projets — exposées via React Context.
 * mapUserSkillsToProgress agrège les réponses Laravel pour Skills / Dashboard / Profil.
 * @see https://axios-http.com/docs/intro
 */
import axios from "axios"
import {
  createContext,
  useCallback,
  useContext,
  useEffect,
  useMemo,
  useState,
  type ReactNode,
} from "react"
import { api } from "@/lib/api"
import {
  mapUserSkillsToProgress,
  type ApiUserSkillRow,
} from "@/lib/map-skills"
import type { SkillsProgressMap } from "@/types/skill"
import { useAuth } from "@/context/auth-context"

export interface ApiProject {
  id: number
  titre: string
  description?: string | null
  lien_github?: string | null
  lien_demo?: string | null
  image?: string | null
  projectImages?: {
    id: number
    project_id: number
    image_path: string
  }[]
  skills?: {
    id?: number
    name?: string | null
    nom?: string | null
    categorie?: string | null
    category?: string | null
  }[]
  created_at?: string | null
}

export interface ApiRecommendation {
  name: string
  entreprise?: string
  ville?: string
  gouvernorat?: string
  description?: string
  score?: number
  match_count?: number
  matching_skills?: string[]
  stack_tags?: string[]
  justification?: string
  metier_final?: string
  recruteur_id?: number
  recruteur?: {
    nom?: string | null
    poste?: string | null
    email?: string | null
  } | null
}

export interface ApiOfferRecommendation {
  id?: number
  titre: string
  type?: string | null
  lieu?: string | null
  entreprise?: string | null
  description?: string | null
  score?: number
  match_count?: number
  matching_skills?: string[]
  required_skills?: string[]
  justification?: string
  recruteur_id?: number
  recruteur?: {
    nom?: string | null
    poste?: string | null
    email?: string | null
  } | null
}

/** Recommandations dynamiques de compétences (GET /recommendations/missing-skills). */
export interface ApiSkillRecommendations {
  to_discover: ApiMissingSkill[]
  to_upgrade: ApiUpgradeSkill[]
}

/** Compétences manquantes à découvrir. */
export interface ApiMissingSkill {
  id: number
  name: string
  domain?: string | null
  categorie?: string | null
}

/** Compétences possédées mais à améliorer. */
export interface ApiUpgradeSkill {
  id: number
  name: string
  domain?: string | null
  categorie?: string | null
  current_level: string
}

function extractData<T>(raw: unknown, fallback: T): T {
  if (Array.isArray(raw)) {
    return raw as unknown as T
  }
  if (raw && typeof raw === "object" && "data" in raw) {
    const d = (raw as { data?: T }).data
    if (d !== undefined && d !== null) return d
  }
  return fallback
}

function readText(value: unknown): string | undefined {
  if (typeof value === "string") {
    const trimmed = value.trim()
    return trimmed || undefined
  }
  return undefined
}

function readNumber(value: unknown): number | undefined {
  const numeric = typeof value === "number" ? value : Number(value)
  return Number.isFinite(numeric) ? numeric : undefined
}

function readStringArray(value: unknown): string[] {
  if (!Array.isArray(value)) return []
  return value
    .map((item) => readText(item))
    .filter((item): item is string => Boolean(item))
}

function readEntreprise(value: unknown): string | undefined {
  if (typeof value === "string") return readText(value)
  if (value && typeof value === "object") {
    const row = value as Record<string, unknown>
    return (
      readText(row.nom) ||
      readText(row.name) ||
      readText(row.raison_sociale) ||
      readText(row.entreprise)
    )
  }
  return undefined
}

function readRecruiter(value: unknown): ApiRecommendation["recruteur"] {
  if (!value || typeof value !== "object") return null
  const row = value as Record<string, unknown>
  return {
    nom: readText(row.nom) ?? null,
    poste: readText(row.poste) ?? null,
    email:
      readText(row.email) ??
      readText(
        row.user && typeof row.user === "object"
          ? (row.user as Record<string, unknown>).email
          : undefined
      ) ??
      null,
  }
}

function normalizeRecommendations(raw: unknown): ApiRecommendation[] {
  const rows = extractData<unknown[]>(raw, [])
  if (!Array.isArray(rows)) return []

  return rows
    .map((item): ApiRecommendation | null => {
      if (!item || typeof item !== "object") return null
      const row = item as Record<string, unknown>
      const entreprise = readEntreprise(row.entreprise) || readText(row.company)
      const justification = readText(row.justification)
      const name = entreprise || readText(row.name) || readText(row.title)

      if (!name) return null

      return {
        name,
        entreprise,
        ville: readText(row.ville),
        gouvernorat: readText(row.gouvernorat),
        description: readText(row.description),
        match_count: readNumber(row.match_count),
        matching_skills: readStringArray(row.matching_skills),
        stack_tags: readStringArray(row.stack_tags),
        justification,
        metier_final: readText(row.metier_final) || readText(row.job_title),
        recruteur_id: readNumber(row.recruteur_id),
        recruteur: readRecruiter(row.recruteur),
        score: readNumber(row.score),
      }
    })
    .filter((item): item is ApiRecommendation => item !== null)
}

function normalizeOfferRecommendations(raw: unknown): ApiOfferRecommendation[] {
  const rows = extractData<unknown[]>(raw, [])
  if (!Array.isArray(rows)) return []

  return rows
    .map((item): ApiOfferRecommendation | null => {
      if (!item || typeof item !== "object") return null
      const row = item as Record<string, unknown>
      const titre = readText(row.titre) || readText(row.title)
      if (!titre) return null

      return {
        id: readNumber(row.id),
        titre,
        type: readText(row.type) ?? null,
        lieu: readText(row.lieu) ?? null,
        entreprise: readEntreprise(row.entreprise) ?? null,
        description: readText(row.description) ?? null,
        score: readNumber(row.score),
        match_count: readNumber(row.match_count),
        matching_skills: readStringArray(row.matching_skills),
        required_skills: readStringArray(row.required_skills),
        justification: readText(row.justification),
        recruteur_id: readNumber(row.recruteur_id),
        recruteur: readRecruiter(row.recruteur),
      }
    })
    .filter((item): item is ApiOfferRecommendation => item !== null)
}

interface StudentDataContextValue {
  projects: ApiProject[]
  userSkills: ApiUserSkillRow[]
  allSkills: ApiUserSkillRow[]
  recommendations: ApiRecommendation[]
  offerRecommendations: ApiOfferRecommendation[]
  skillRecommendations: ApiSkillRecommendations
  loading: boolean
  refreshing: boolean
  initialLoadDone: boolean
  error: string | null
  refetch: () => Promise<void>
  createProject: (payload:
    | {
        titre: string
        description?: string | null
        technologies?: string | null
        lien?: string | null
      }
    | FormData
  ) => Promise<ApiProject>
  updateProject: (project: ApiProject) => void
  removeProject: (projectId: number) => void
  skillsProgressRecord: SkillsProgressMap
  catalogTotal: number
  masteredCount: number
}

const StudentDataContext = createContext<StudentDataContextValue | null>(null)

export function StudentDataProvider({ children }: { children: ReactNode }) {
  const { isAuthenticated, loading: authLoading } = useAuth()

  const [projects, setProjects] = useState<ApiProject[]>([])
  const [userSkills, setUserSkills] = useState<ApiUserSkillRow[]>([])
  const [allSkills, setAllSkills] = useState<ApiUserSkillRow[]>([])
  const [recommendations, setRecommendations] = useState<ApiRecommendation[]>(
    []
  )
  const [offerRecommendations, setOfferRecommendations] = useState<ApiOfferRecommendation[]>([])
  const [skillRecommendations, setSkillRecommendations] = useState<ApiSkillRecommendations>({
    to_discover: [],
    to_upgrade: [],
  })
  const [loading, setLoading] = useState(false)
  const [refreshing, setRefreshing] = useState(false)
  const [initialLoadDone, setInitialLoadDone] = useState(false)
  const [error, setError] = useState<string | null>(null)

  const enabled = isAuthenticated && !authLoading

  const fetchDashboard = useCallback(
    async (mode: "initial" | "refresh", signal: { cancelled: boolean }) => {
      const isRefresh = mode === "refresh"
      if (isRefresh) setRefreshing(true)
      else setLoading(true)
      setError(null)
      try {
        const [resP, resUs, resAll, resRec, resOffers, resMiss] = await Promise.all([
          api.get("/projects"),
          api.get("/user-skills"),
          api.get("/all-skills"),
          api.get("/recommendations"),
          api.get("/recommendations/offres"),
          api.get("/recommendations/missing-skills").catch(() => ({ data: {} })),
        ])
        if (signal.cancelled) return
        setProjects(extractData<ApiProject[]>(resP.data, []))
        setUserSkills(extractData<ApiUserSkillRow[]>(resUs.data, []))
        setAllSkills(extractData<ApiUserSkillRow[]>(resAll.data, []))
        setRecommendations(normalizeRecommendations(resRec.data))
        setOfferRecommendations(normalizeOfferRecommendations(resOffers.data))
        setSkillRecommendations(
          extractData<ApiSkillRecommendations>(resMiss.data, { to_discover: [], to_upgrade: [] })
        )
      } catch (e: unknown) {
        if (signal.cancelled) return
        if (axios.isAxiosError(e) && e.response?.status === 401) {
          return
        }
        setError("student_data_load")
      } finally {
        if (signal.cancelled) return
        if (isRefresh) setRefreshing(false)
        else setLoading(false)
        setInitialLoadDone(true)
      }
    },
    []
  )

  useEffect(() => {
    if (!enabled) {
      setProjects([])
      setUserSkills([])
      setAllSkills([])
      setRecommendations([])
      setOfferRecommendations([])
      setSkillRecommendations({ to_discover: [], to_upgrade: [] })
      setLoading(false)
      setRefreshing(false)
      setInitialLoadDone(false)
      setError(null)
      return
    }

    const signal = { cancelled: false }
    setInitialLoadDone(false)
    void fetchDashboard("initial", signal)

    return () => {
      signal.cancelled = true
    }
  }, [enabled, fetchDashboard])

  const refetch = useCallback(async () => {
    if (!isAuthenticated) return
    const signal = { cancelled: false }
    await fetchDashboard("refresh", signal)
  }, [isAuthenticated, fetchDashboard])

  const createProject = useCallback(
    async (payload:
      | {
          titre: string
          description?: string | null
          technologies?: string | null
          lien?: string | null
          image?: FormData
        }
      | FormData
    ) => {
      let response
      try {
        response = await api.post("/projects", payload)
      } catch (err: any) {
        console.error("createProject failed", err)
        const srv = err?.response?.data
        if (srv) {
          const msg = srv.message ?? (srv.errors ? Object.values(srv.errors).flat().join(' ') : null)
          throw new Error(msg || 'Server error')
        }
        throw err
      }

      const project =
        extractData<ApiProject | null>(response.data, null) ??
        (response.data as ApiProject)

      if (!project || typeof project !== "object" || typeof project.id !== "number") {
        throw new Error("Invalid project response")
      }

      setProjects((prev) => [project, ...prev])
      return project
    },
    []
  )

  const updateProject = useCallback((updatedProject: ApiProject) => {
    setProjects((prev) =>
      prev.map((project) =>
        project.id === updatedProject.id ? updatedProject : project
      )
    )
  }, [])

  const removeProject = useCallback((projectId: number) => {
    setProjects((prev) => prev.filter((project) => project.id !== projectId))
  }, [])

  const skillsProgressRecord: SkillsProgressMap =
    mapUserSkillsToProgress(userSkills)

  const catalogTotal = Math.max(allSkills.length, 1)
  const masteredCount = userSkills.filter((s) => {
    const level = (s.pivot_level ?? "").toLowerCase()
    return level === "expert" || level === "advanced"
  }).length

  const value = useMemo<StudentDataContextValue>(
    () => ({
      projects,
      userSkills,
      allSkills,
      recommendations,
      offerRecommendations,
      skillRecommendations,
      loading,
      refreshing,
      initialLoadDone,
      error,
      refetch,
      createProject,
      updateProject,
      removeProject,
      skillsProgressRecord,
      catalogTotal,
      masteredCount,
    }),
    [
      projects,
      userSkills,
      allSkills,
      recommendations,
      offerRecommendations,
      skillRecommendations,
      loading,
      refreshing,
      initialLoadDone,
      error,
      refetch,
      createProject,
      updateProject,
      removeProject,
      skillsProgressRecord,
      catalogTotal,
      masteredCount,
    ]
  )

  return (
    <StudentDataContext.Provider value={value}>
      {children}
    </StudentDataContext.Provider>
  )
}

export function useStudentDataContext(): StudentDataContextValue {
  const ctx = useContext(StudentDataContext)
  if (!ctx) {
    throw new Error(
      "useStudentDataContext doit être utilisé dans StudentDataProvider"
    )
  }
  return ctx
}
