import { useCallback, useEffect, useMemo, useState } from "react"
import {
  ActivityIndicator,
  Alert,
  Image,
  Linking,
  Modal,
  RefreshControl,
  ScrollView,
  Text,
  TextInput,
  TouchableOpacity,
  View,
} from "react-native"
import {
  ArrowRight,
  BriefcaseBusiness,
  ExternalLink,
  GitBranch,
  Search,
  X,
} from "lucide-react-native"
import { GlassCard } from "./glass-card"
import { api, getBackendOrigin, getStorageUrl } from "@/lib/api"
import { useAppTheme } from "@/context/app-theme-context"
import { useLocale } from "@/context/locale-context"
import { useBottomTabBarHeight } from "@/hooks/use-bottom-tab-bar-height"
import ContactButton from "./contact-button"

const BACKEND_BASE = getBackendOrigin()
const SCROLL_EXTRA_BELOW_TAB_BAR = 28

const SPECIALTY_FILTERS = [
  "Développement Web et Multimédia",
  "Génie Logiciel",
  "Informatique de Gestion",
  "Réseaux et Systèmes",
]

const INSTITUTION_FILTERS = [
  "ISET Sidi Bouzid",
  "ISET Kairouan",
  "ISET Sfax",
  "ISET Gafsa",
]

const BADGE_COLORS = [
  { color: "#155E75", borderColor: "#A5F3FC" },
  { color: "#0C4A6E", borderColor: "#7DD3FC" },
  { color: "#7C3AED", borderColor: "#C4B5FD" },
  { color: "#047857", borderColor: "#A7F3D0" },
  { color: "#B45309", borderColor: "#FCD34D" },
  { color: "#BE123C", borderColor: "#FECDD3" },
]

type StudentRow = {
  id: number
  name?: string | null
  email?: string | null
  photo_url?: string | null
  specialite?: string | null
  institution?: string | null
  etablissement?: string | null
  institute?: string | null
  match_score?: number | null
  match_count?: number | null
  skills_count?: number | null
  projects_count?: number | null
  top_3_skills?: { id?: number; nom?: string | null; name?: string | null }[]
  skills?: { id?: number; nom?: string | null; name?: string | null }[]
  skill_names?: string[]
}

type PortfolioProject = {
  id: number
  titre?: string | null
  description?: string | null
  lien_github?: string | null
  lien_demo?: string | null
  image_url?: string | null
  image?: string | null
  gallery?: { id?: number; url?: string | null; image_path?: string | null }[]
  projectImages?: { id?: number; image_path?: string | null }[]
  skills?: { id?: number; nom?: string | null; name?: string | null }[]
}

type PortfolioData = {
  profile?: {
    id?: number | null
    name?: string | null
    email?: string | null
    photo_url?: string | null
    specialite?: string | null
    niveau_etude?: string | null
    bio?: string | null
    linkedin?: string | null
  }
  skills?: {
    technical?: { id?: number; nom?: string | null; name?: string | null }[]
  }
  projects?: PortfolioProject[]
}

function unwrapData<T>(raw: unknown, fallback: T): T {
  if (raw && typeof raw === "object" && "data" in raw) {
    const value = (raw as { data?: T }).data
    return value ?? fallback
  }
  return fallback
}

function normalize(value?: string | null) {
  return String(value ?? "")
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .toLowerCase()
}

function getInitials(name?: string | null) {
  if (!name?.trim()) return "?"
  return name
    .trim()
    .split(/\s+/)
    .map((part) => part[0])
    .slice(0, 2)
    .join("")
    .toUpperCase()
}

function fileNameFromPath(path?: string | null) {
  if (!path) return undefined
  return path.replace(/^\/+/, "").split("/").pop()
}

function buildProfilePhotoUrl(path?: string | null) {
  if (!path) return undefined
  if (path.startsWith("http://") || path.startsWith("https://")) return getStorageUrl(path) ?? path
  const fileName = fileNameFromPath(path)
  return fileName ? getStorageUrl(`profile-photos/${fileName}`) ?? undefined : undefined
}

function buildProjectImageUrl(path?: string | null) {
  if (!path) return undefined
  if (path.startsWith("http://") || path.startsWith("https://")) return getStorageUrl(path) ?? path
  const normalized = path.replace(/^\/+/, "")
  if (normalized.startsWith("project-images/") || normalized.startsWith("projects/")) {
    return getStorageUrl(normalized) ?? undefined
  }
  const fileName = fileNameFromPath(normalized)
  return fileName ? getStorageUrl(`project-images/${fileName}`) ?? undefined : undefined
}

function buildProjectScreenshotUrl(path?: string | null) {
  if (!path) return undefined
  if (path.startsWith("http://") || path.startsWith("https://")) return getStorageUrl(path) ?? path
  const normalized = path.replace(/^\/+/, "")
  if (normalized.startsWith("projects/")) return getStorageUrl(normalized) ?? undefined
  const fileName = fileNameFromPath(normalized)
  return fileName ? getStorageUrl(`projects/${fileName}`) ?? undefined : undefined
}

function getSkillLabel(skill: { nom?: string | null; name?: string | null } | string) {
  if (typeof skill === "string") return skill.trim()
  return (skill.nom || skill.name || "").trim()
}

function getStudentSkills(student: StudentRow) {
  const fromNames = student.skill_names ?? []
  const fromSkills = student.skills ?? student.top_3_skills ?? []
  return [...fromNames, ...fromSkills.map(getSkillLabel)].filter(Boolean)
}

function getStudentInstitution(student: StudentRow) {
  return student.institution || student.etablissement || student.institute || ""
}

function openExternalLink(url?: string | null) {
  if (!url?.trim()) {
    Alert.alert("Lien non disponible", "Aucun lien n'est disponible pour le moment.")
    return
  }
  void Linking.openURL(url.trim()).catch(() => {
    Alert.alert("Lien non valide", "Impossible d'ouvrir ce lien.")
  })
}

function FilterChip({
  label,
  active,
  onPress,
}: {
  label: string
  active: boolean
  onPress: () => void
}) {
  const { theme: THEME } = useAppTheme()
  return (
    <TouchableOpacity
      activeOpacity={0.86}
      onPress={onPress}
      className="border px-3 py-2"
      style={{
        borderRadius: 999,
        borderColor: active ? THEME.primary : "rgba(148, 163, 184, 0.24)",
        backgroundColor: active ? "rgba(157, 123, 255, 0.18)" : "rgba(148, 163, 184, 0.10)",
      }}
    >
      <Text
        className="text-xs font-semibold"
        style={{ color: active ? THEME.primary : THEME.muted }}
      >
        {label}
      </Text>
    </TouchableOpacity>
  )
}

function SkillBadge({ label, index }: { label: string; index: number }) {
  const color = BADGE_COLORS[index % BADGE_COLORS.length]
  return (
    <View
      className="border px-2.5 py-1.5"
      style={{
        borderRadius: 8,
        borderColor: color.borderColor,
        backgroundColor: "transparent",
      }}
    >
      <Text className="text-xs font-semibold" style={{ color: color.color }}>
        {label}
      </Text>
    </View>
  )
}

function StudentCard({
  student,
  onOpenPortfolio,
  t,
}: {
  student: StudentRow
  onOpenPortfolio: (student: StudentRow) => void
  t: any
}) {
  const { theme: THEME } = useAppTheme()
  const skills = getStudentSkills(student).slice(0, 8)
  const photoUrl = buildProfilePhotoUrl(student.photo_url)
  return (
    <GlassCard plain contentClassName="p-4" style={{ backgroundColor: "transparent" }}>
      <View className="flex-row items-start gap-3">
        <View
          className="items-center justify-center overflow-hidden border"
          style={{
            width: 58,
            height: 58,
            borderRadius: 16,
            borderColor: THEME.border,
            backgroundColor: THEME.mutedSurface,
          }}
        >
          {photoUrl ? (
            <Image source={{ uri: photoUrl }} style={{ width: "100%", height: "100%" }} resizeMode="cover" />
          ) : (
            <Text className="text-lg font-black text-foreground">{getInitials(student.name)}</Text>
          )}
        </View>

        <View className="min-w-0 flex-1">
          <View className="flex-row items-start gap-2">
            <Text className="min-w-0 flex-1 text-lg font-bold text-foreground" numberOfLines={2}>
              {student.name || "Étudiant"}
            </Text>
            <View className="rounded-full border border-emerald-300/50 bg-emerald-400/10 px-2.5 py-1">
              <Text className="text-[11px] font-bold text-emerald-300">
                Disponible
              </Text>
            </View>
          </View>
          {student.specialite ? (
            <Text className="mt-1 text-sm text-muted-foreground" numberOfLines={2}>
              {student.specialite}
            </Text>
          ) : null}
          {getStudentInstitution(student) ? (
            <Text className="mt-1 text-xs text-muted-foreground" numberOfLines={1}>
              {getStudentInstitution(student)}
            </Text>
          ) : null}
        </View>
      </View>

      {skills.length > 0 ? (
        <View className="mt-4 flex-row flex-wrap gap-2">
          {skills.map((skill, index) => (
            <SkillBadge key={`${student.id}-${skill}-${index}`} label={skill} index={index} />
          ))}
        </View>
      ) : (
        <Text className="mt-4 text-sm text-muted-foreground">
          Aucune compétence renseignée.
        </Text>
      )}

      <TouchableOpacity
        activeOpacity={0.88}
        onPress={() => onOpenPortfolio(student)}
        className="mt-5 flex-row items-center justify-center gap-2 rounded-xl px-4 py-3"
        style={{ backgroundColor: THEME.primary }}
      >
        <Text className="text-sm font-bold text-white">{t("recruiter_view_portfolio")}</Text>
        <ArrowRight size={17} color="#FFFFFF" />
      </TouchableOpacity>
    </GlassCard>
  )
}

function ProjectCard({ project, t }: { project: PortfolioProject, t: any }) {
  const { theme: THEME } = useAppTheme()
  const heroUrl =
    buildProjectImageUrl(project.image_url) ||
    buildProjectImageUrl(project.image) ||
    buildProjectScreenshotUrl(project.gallery?.[0]?.url) ||
    buildProjectScreenshotUrl(project.projectImages?.[0]?.image_path)
  const gallery = [
    ...(project.gallery ?? []).map((image) => image.url),
    ...(project.projectImages ?? []).map((image) => image.image_path),
  ].filter(Boolean) as string[]

  return (
    <View className="overflow-hidden border" style={{ borderRadius: 12, borderColor: THEME.border, backgroundColor: THEME.card }}>
      {heroUrl ? (
        <Image source={{ uri: heroUrl }} style={{ width: "100%", height: 160 }} resizeMode="cover" />
      ) : (
        <View className="items-center justify-center" style={{ width: "100%", height: 160, backgroundColor: "rgba(157,123,255,0.14)" }}>
          <Text className="text-4xl font-black text-muted-foreground">
            {(project.titre?.trim()?.[0] || "P").toUpperCase()}
          </Text>
        </View>
      )}

      <View className="p-4">
        <Text className="text-base font-bold text-foreground">{project.titre || t("projects_no_title")}</Text>
        {project.description ? (
          <Text className="mt-2 text-sm leading-5 text-muted-foreground">{project.description}</Text>
        ) : null}

        {gallery.length > 0 ? (
          <ScrollView horizontal showsHorizontalScrollIndicator={false} className="mt-3" contentContainerStyle={{ gap: 8 }}>
            {gallery.map((path, index) => {
              const url = buildProjectScreenshotUrl(path)
              if (!url) return null
              return (
                <Image
                  key={`${project.id}-gallery-${index}`}
                  source={{ uri: url }}
                  style={{ width: 112, height: 74, borderRadius: 8, borderWidth: 1, borderColor: THEME.border }}
                  resizeMode="cover"
                />
              )
            })}
          </ScrollView>
        ) : null}

        {project.skills?.length ? (
          <View className="mt-3 flex-row flex-wrap gap-2">
            {project.skills.map((skill, index) => {
              const label = getSkillLabel(skill)
              if (!label) return null
              return <SkillBadge key={`${project.id}-${label}`} label={label} index={index} />
            })}
          </View>
        ) : null}

        <View className="mt-4 flex-row gap-2">
          {project.lien_github ? (
            <TouchableOpacity
              activeOpacity={0.86}
              onPress={() => openExternalLink(project.lien_github)}
              className="flex-1 flex-row items-center justify-center gap-1.5 rounded-lg border px-2 py-2.5"
              style={{ borderColor: THEME.border, backgroundColor: THEME.mutedSurface }}
            >
              <GitBranch size={15} color={THEME.foreground} />
              <Text className="text-xs font-bold text-foreground">GitHub</Text>
            </TouchableOpacity>
          ) : null}
          {project.lien_demo ? (
            <TouchableOpacity
              activeOpacity={0.86}
              onPress={() => openExternalLink(project.lien_demo)}
              className="flex-1 flex-row items-center justify-center gap-1.5 rounded-lg border px-2 py-2.5"
              style={{ borderColor: THEME.primary, backgroundColor: "rgba(157,123,255,0.12)" }}
            >
              <ExternalLink size={15} color={THEME.primary} />
              <Text className="text-xs font-bold text-primary">Démo</Text>
            </TouchableOpacity>
          ) : null}
        </View>
      </View>
    </View>
  )
}

function PortfolioModal({
  visible,
  loading,
  data,
  error,
  studentId,
  onClose,
  t,
}: {
  visible: boolean
  loading: boolean
  data: PortfolioData | null
  error: string | null
  studentId: number | null
  onClose: () => void
  t: (key: string, vars?: Record<string, any>) => string
}) {
  const { theme: THEME } = useAppTheme()
  const profile = data?.profile
  const technicalSkills = data?.skills?.technical ?? []
  const projects = data?.projects ?? []
  const photoUrl = buildProfilePhotoUrl(profile?.photo_url)
  
  // Use profile.id if available from backend, fallback to studentId from props
  const studentReceiverId = profile?.id ?? studentId
  

  return (
    <Modal visible={visible} transparent animationType="slide" onRequestClose={onClose}>
      <View className="flex-1 justify-end" style={{ backgroundColor: "rgba(0,0,0,0.58)" }}>
        <View
          style={{
            maxHeight: "92%",
            borderTopLeftRadius: 24,
            borderTopRightRadius: 24,
            backgroundColor: THEME.background,
            borderColor: THEME.border,
            borderWidth: 1,
          }}
        >
          <View className="flex-row items-center justify-between border-b border-border px-5 py-4">
            <Text className="text-lg font-black text-foreground">{t("recruiter_portfolio_title")}</Text>
            <TouchableOpacity onPress={onClose} className="rounded-full bg-card p-2" activeOpacity={0.85}>
              <X size={20} color={THEME.foreground} />
            </TouchableOpacity>
          </View>

          {loading ? (
            <View className="items-center gap-3 py-12">
              <ActivityIndicator color={THEME.primary} />
              <Text className="text-sm text-muted-foreground">{t("recruiter_portfolio_loading")}</Text>
            </View>
          ) : error ? (
            <View className="items-center gap-4 py-12 px-4">
              <Text className="text-lg font-bold text-foreground">{t("recruiter_portfolio_private")}</Text>
              <Text className="text-center text-sm leading-6 text-muted-foreground">{error}</Text>
              <TouchableOpacity
                activeOpacity={0.86}
                onPress={onClose}
                className="mt-4 rounded-xl px-5 py-3"
                style={{ backgroundColor: THEME.primary }}
              >
                <Text className="text-sm font-bold text-white">{t("recruiter_portfolio_close")}</Text>
              </TouchableOpacity>
            </View>
          ) : (
            <ScrollView contentContainerStyle={{ padding: 18, paddingBottom: 34 }}>
              <GlassCard plain contentClassName="p-4" style={{ backgroundColor: "transparent" }}>
                <View className="flex-row gap-4">
                  <View className="overflow-hidden border" style={{ width: 76, height: 76, borderRadius: 18, borderColor: THEME.border, backgroundColor: THEME.mutedSurface }}>
                    {photoUrl ? (
                      <Image source={{ uri: photoUrl }} style={{ width: "100%", height: "100%" }} resizeMode="cover" />
                    ) : (
                      <View className="flex-1 items-center justify-center">
                        <Text className="text-xl font-black text-foreground">{getInitials(profile?.name)}</Text>
                      </View>
                    )}
                  </View>
                  <View className="min-w-0 flex-1">
                    <Text className="text-xl font-black text-foreground">{profile?.name || "Étudiant"}</Text>
                    <Text className="mt-1 text-sm text-muted-foreground">
                      {[profile?.specialite, profile?.niveau_etude].filter(Boolean).join(" · ")}
                    </Text>
                    {profile?.bio ? (
                      <Text className="mt-2 text-sm leading-5 text-muted-foreground">{profile.bio}</Text>
                    ) : null}
                    <View className="mt-3">
                      <ContactButton email={profile?.email} receiverId={studentReceiverId} receiverType="student" />
                    </View>
                  </View>
                </View>
              </GlassCard>

              <View className="mt-5">
                <Text className="mb-3 text-base font-bold text-foreground">◆ Compétences techniques</Text>
                <View className="flex-row flex-wrap gap-2">
                  {technicalSkills.length > 0 ? (
                    technicalSkills.map((skill, index) => {
                      const label = getSkillLabel(skill)
                      if (!label) return null
                      return <SkillBadge key={`${skill.id}-${label}`} label={label} index={index} />
                    })
                  ) : (
                    <Text className="text-sm text-muted-foreground">{t("recruiter_student_skills_none")}</Text>
                  )}
                </View>
              </View>

              <View className="mt-6 gap-4">
                <Text className="text-base font-bold text-foreground">◆ Projets</Text>
                {projects.length > 0 ? (
                  projects.map((project) => <ProjectCard key={project.id} project={project} t={t} />)
                ) : (
                  <GlassCard plain contentClassName="px-4 py-7">
                    <Text className="text-center text-sm text-muted-foreground">{t("recruiter_student_projects_none")}</Text>
                  </GlassCard>
                )}
              </View>
            </ScrollView>
          )}
        </View>
      </View>
    </Modal>
  )
}

export function RecruiterHome() {
  const { theme: THEME } = useAppTheme()
  const { t } = useLocale()
  const tabBarHeight = useBottomTabBarHeight()
  const [searchQuery, setSearchQuery] = useState("")
  const [students, setStudents] = useState<StudentRow[]>([])
  const [loading, setLoading] = useState(false)
  const [refreshing, setRefreshing] = useState(false)
  const [portfolioVisible, setPortfolioVisible] = useState(false)
  const [portfolioLoading, setPortfolioLoading] = useState(false)
  const [portfolioData, setPortfolioData] = useState<PortfolioData | null>(null)
  const [portfolioError, setPortfolioError] = useState<string | null>(null)
  const [selectedStudentId, setSelectedStudentId] = useState<number | null>(null)

  const fetchStudents = useCallback(
    async (mode: "initial" | "refresh" = "initial") => {
      if (mode === "refresh") setRefreshing(true)
      else setLoading(true)
      try {
        const params: Record<string, string> = {}
        const q = searchQuery.trim()
        if (q) params.q = q

        const response = await api.get("/search/students", { params })
        const rows = unwrapData<StudentRow[]>(response.data, [])
        setStudents(rows)
      } catch {
        setStudents([])
      } finally {
        if (mode === "refresh") setRefreshing(false)
        else setLoading(false)
      }
    },
    [searchQuery]
  )

  useEffect(() => {
    const timeout = setTimeout(() => {
      void fetchStudents("initial")
    }, 280)
    return () => clearTimeout(timeout)
  }, [fetchStudents])

  const openPortfolio = useCallback(async (student: StudentRow) => {
    setSelectedStudentId(student.id)
    setPortfolioVisible(true)
    setPortfolioLoading(true)
    setPortfolioData(null)
    setPortfolioError(null)
    try {
      const response = await api.get(`/portfolio/${student.id}`)
      setPortfolioData(unwrapData<PortfolioData | null>(response.data, null))
    } catch (error: unknown) {
      const message =
        typeof error === "object" && error !== null && "response" in error
          ? ((error as any).response?.data?.message ?? "Impossible de charger le portfolio.")
          : "Impossible de charger le portfolio."
      setPortfolioError(String(message))
      setPortfolioData(null)
    } finally {
      setPortfolioLoading(false)
    }
  }, [])

  return (
    <>
      <ScrollView
        className="flex-1 px-4 pt-6"
        contentContainerStyle={{ paddingBottom: tabBarHeight + SCROLL_EXTRA_BELOW_TAB_BAR }}
        refreshControl={
          <RefreshControl
            refreshing={refreshing}
            onRefresh={() => void fetchStudents("refresh")}
            tintColor={THEME.primary}
          />
        }
        showsVerticalScrollIndicator={false}
      >
        <View className="mb-6">
          <Text className="text-2xl font-black text-foreground">{t("recruiter_all_students")}</Text>
          <Text className="mt-2 text-sm leading-5 text-muted-foreground" style={{ opacity: 0.78 }}>
            {t("recruiter_students_list")}
          </Text>
        </View>

        <View className="mb-5">
          <View
            className="flex-row items-center gap-3 border px-4"
            style={{
              minHeight: 52,
              borderRadius: 12,
              borderColor: "rgba(148, 163, 184, 0.22)",
              backgroundColor: `rgba(${THEME.cardRgb}, 0.72)`,
            }}
          >
            <Search size={19} color={THEME.muted} />
            <TextInput
              value={searchQuery}
              onChangeText={setSearchQuery}
              placeholder={t("recruiter_search_placeholder")}
              placeholderTextColor="rgba(163, 174, 208, 0.72)"
              className="min-w-0 flex-1 text-sm text-foreground"
              autoCapitalize="none"
              autoCorrect={false}
              returnKeyType="search"
            />
          </View>
        </View>

        <View className="mb-4 flex-row items-center justify-between">
          <Text className="text-lg font-bold text-foreground">{t("recruiter_student_profiles")}</Text>
          <Text className="text-sm font-semibold text-muted-foreground">{students.length} {students.length === 1 ? t("recruiter_result_count_one") : t("recruiter_result_count_many")}</Text>
        </View>

        {loading ? (
          <GlassCard plain contentClassName="items-center gap-3 py-8">
            <ActivityIndicator color={THEME.primary} />
            <Text className="text-sm text-muted-foreground">{t("recruiter_loading_students")}</Text>
          </GlassCard>
        ) : students.length === 0 ? (
          <GlassCard plain contentClassName="px-4 py-8">
            <View className="items-center gap-3">
              <BriefcaseBusiness size={28} color={THEME.muted} />
              <Text className="text-center text-sm leading-5 text-muted-foreground">
                {t("recruiter_no_students")}
              </Text>
            </View>
          </GlassCard>
        ) : (
          <View className="gap-4">
            {students.map((student) => (
              <StudentCard key={`student-${student.id}`} student={student} onOpenPortfolio={openPortfolio} t={t} />
            ))}
          </View>
        )}
      </ScrollView>

      <PortfolioModal
        visible={portfolioVisible}
        loading={portfolioLoading}
        data={portfolioData}
        error={portfolioError}
        studentId={selectedStudentId}
        onClose={() => {
          setPortfolioVisible(false)
          setPortfolioError(null)
          setSelectedStudentId(null)
        }}
        t={t}
      />
    </>
  )
}
