import { useMemo } from "react"
import {
  Alert,
  Image,
  Linking,
  RefreshControl,
  ScrollView,
  StyleSheet,
  Text,
  TouchableOpacity,
  View,
} from "react-native"
import {
  Download,
  ExternalLink,
  FileText,
  GitBranch,
} from "lucide-react-native"
import { useAppTheme } from "@/context/app-theme-context"
import { useAuth } from "@/context/auth-context"
import { useLocale } from "@/context/locale-context"
import {
  type ApiProject,
  useStudentDataContext,
} from "@/context/student-data-context"
import { useBottomTabBarHeight } from "@/hooks/use-bottom-tab-bar-height"
import { API_BASE_URL, API_ORIGIN } from "@/constants/api-config"

const BACKEND_BASE = API_BASE_URL.replace(/\/$/, "")
const STORAGE_BASE = `${API_ORIGIN.replace(/\/$/, "")}/storage`
const SCROLL_EXTRA_BELOW_TAB_BAR = 32

const SKILL_BADGE_COLORS = [
  { backgroundColor: "transparent", color: "#155E75", borderColor: "#A5F3FC" },
  { backgroundColor: "transparent", color: "#0C4A6E", borderColor: "#7DD3FC" },
  { backgroundColor: "transparent", color: "#7C3AED", borderColor: "#C4B5FD" },
  { backgroundColor: "transparent", color: "#047857", borderColor: "#A7F3D0" },
  { backgroundColor: "transparent", color: "#B45309", borderColor: "#FCD34D" },
  { backgroundColor: "transparent", color: "#BE123C", borderColor: "#FECDD3" },
]

function fileNameFromPath(path?: string | null) {
  if (!path) return undefined
  return path.replace(/^\/+/, "").split("/").pop()
}

function buildPortfolioUrl(studentId?: string | number) {
  if (!studentId) return undefined
  return `${BACKEND_BASE}/portfolio/${studentId}/download-pdf`
}

function buildProfilePhotoUrl(photo?: string | null) {
  if (!photo) return undefined
  if (photo.startsWith("http://") || photo.startsWith("https://")) return photo
  const fileName = fileNameFromPath(photo)
  return fileName ? `${STORAGE_BASE}/profile-photos/${fileName}` : undefined
}

function buildProjectImageUrl(path?: string | null) {
  if (!path) return undefined
  if (path.startsWith("http://") || path.startsWith("https://")) return path
  const normalized = path.replace(/^\/+/, "")
  if (normalized.startsWith("project-images/")) return `${STORAGE_BASE}/${normalized}`
  const fileName = fileNameFromPath(normalized)
  return fileName ? `${STORAGE_BASE}/project-images/${fileName}` : undefined
}

function buildProjectScreenshotUrl(path?: string | null) {
  if (!path) return undefined
  if (path.startsWith("http://") || path.startsWith("https://")) return path
  const fileName = fileNameFromPath(path)
  return fileName ? `${STORAGE_BASE}/projects/${fileName}` : undefined
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

function getProjectLetter(title?: string | null) {
  return (title?.trim()?.[0] || "P").toUpperCase()
}

function getSkillLabel(skill: { name?: string | null; nom?: string | null }) {
  return (skill.nom || skill.name || "").trim()
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

function ProjectHero({ project }: { project: ApiProject }) {
  const heroUrl =
    buildProjectImageUrl(project.image) ||
    buildProjectScreenshotUrl(project.projectImages?.[0]?.image_path)

  if (heroUrl) {
    return (
      <Image
        source={{ uri: heroUrl }}
        style={styles.projectHeroImage}
        resizeMode="cover"
      />
    )
  }

  return (
    <View style={styles.projectPlaceholder}>
      <Text style={styles.projectPlaceholderText}>
        {getProjectLetter(project.titre)}
      </Text>
    </View>
  )
}

export function Portfolio() {
  const { t } = useLocale()
  const { theme: THEME } = useAppTheme()
  const tabBarHeight = useBottomTabBarHeight()
  const { user } = useAuth()
  const { projects, userSkills, refreshing, refetch } = useStudentDataContext()
  // Nettoyage : suppression de toutes les références à 'etudiant'
  const studentId = user?.candidat?.id;
  const portfolioUrl = buildPortfolioUrl(studentId);
  const profilePhoto = buildProfilePhotoUrl((user as any)?.photo ?? (user as any)?.photo_url);
  const displayName = user?.name || "Candidat";

  const specialty =
    [user?.candidat?.specialite, user?.candidat?.niveau_etude]
      .filter(Boolean)
      .join(" · ") || "Développement Web et Multimédia";

  const aboutText =
    user?.candidat?.bio ||
    "Candidat en développement Web, passionné par les interfaces modernes et la création de projets impactants.";

  const technicalSkills = useMemo(
    () =>
      userSkills
        .map((skill) => ({
          id: skill.id,
          label: getSkillLabel(skill),
        }))
        .filter((skill) => skill.label.length > 0),
    [userSkills]
  )

  return (
    <ScrollView
      contentContainerStyle={{
        paddingBottom: tabBarHeight + SCROLL_EXTRA_BELOW_TAB_BAR,
        paddingHorizontal: 18,
        paddingTop: 24,
      }}
      refreshControl={
        <RefreshControl
          refreshing={refreshing}
          onRefresh={() => void refetch()}
          tintColor={THEME.accent}
        />
      }
      showsVerticalScrollIndicator={false}
    >
      <TouchableOpacity
        activeOpacity={0.88}
        onPress={() => openExternalLink(portfolioUrl)}
        style={[styles.pdfButton, { backgroundColor: THEME.primary }]}
      >
        <FileText size={18} color="#FFFFFF" />
        <Text style={styles.pdfButtonText}>Télécharger le portfolio (PDF)</Text>
        <Download size={17} color="#FFFFFF" />
      </TouchableOpacity>

      <View style={styles.topStack}>
        <View
          style={[
            styles.profileCard,
            { backgroundColor: THEME.card, borderColor: THEME.border },
          ]}
        >
          <View
            style={[
              styles.profilePhoto,
              { backgroundColor: THEME.mutedSurface, borderColor: THEME.border },
            ]}
          >
            {profilePhoto ? (
              <Image
                source={{ uri: profilePhoto }}
                style={styles.profilePhotoImage}
                resizeMode="cover"
              />
            ) : (
              <Text style={[styles.profileInitials, { color: THEME.foreground }]}>
                {getInitials(displayName)}
              </Text>
            )}
          </View>
          <View style={styles.profileText}>
            <Text style={[styles.profileName, { color: THEME.foreground }]}>
              {displayName}
            </Text>
            <Text style={[styles.profileSpecialty, { color: THEME.muted }]}>
              {specialty}
            </Text>
            <Text style={[styles.profileDescription, { color: THEME.muted }]}>
              {aboutText}
            </Text>
          </View>
        </View>

        <View
          style={[
            styles.skillsCard,
            { backgroundColor: THEME.card, borderColor: THEME.border },
          ]}
        >
          <View style={styles.sectionTitleRow}>
            <Text style={styles.blueDiamond}>◆</Text>
            <Text style={[styles.sectionTitle, { color: THEME.foreground }]}>
              Compétences techniques
            </Text>
          </View>

          {technicalSkills.length > 0 ? (
            <View style={styles.badgeWrap}>
              {technicalSkills.map((skill, index) => {
                const color = SKILL_BADGE_COLORS[index % SKILL_BADGE_COLORS.length]
                return (
                  <View
                    key={`${skill.id}-${skill.label}`}
                    style={[
                      styles.skillBadge,
                      {
                        backgroundColor: color.backgroundColor,
                        borderColor: color.borderColor,
                      },
                    ]}
                  >
                    <Text style={[styles.skillBadgeText, { color: color.color }]}>
                      {skill.label}
                    </Text>
                  </View>
                )
              })}
            </View>
          ) : (
            <Text style={[styles.emptyText, { color: THEME.muted }]}>
              Aucune compétence technique renseignée.
            </Text>
          )}
        </View>
      </View>

      <View
        style={[
          styles.projectsSection,
          { backgroundColor: THEME.mutedSurface, borderColor: THEME.border },
        ]}
      >
        <View style={styles.projectsTitleRow}>
          <Text style={styles.purpleDiamond}>◆</Text>
          <Text style={[styles.projectsTitle, { color: THEME.foreground }]}>
            Projets
          </Text>
        </View>

        {projects.length === 0 ? (
          <Text style={[styles.emptyText, { color: THEME.muted }]}>
            Aucun projet pour le moment.
          </Text>
        ) : (
          <View style={styles.projectList}>
            {projects.map((project) => (
              <View
                key={project.id}
                style={[
                  styles.projectCard,
                  { backgroundColor: THEME.card, borderColor: THEME.border },
                ]}
              >
                <ProjectHero project={project} />

                <View style={styles.projectContent}>
                  <Text style={[styles.projectTitle, { color: THEME.foreground }]}>
                    {project.titre || t("projects_no_title")}
                  </Text>

                  {project.description ? (
                    <Text style={[styles.projectDescription, { color: THEME.muted }]}>
                      {project.description}
                    </Text>
                  ) : null}

                  {project.projectImages?.length ? (
                    <ScrollView
                      horizontal
                      showsHorizontalScrollIndicator={false}
                      contentContainerStyle={styles.screenshotRow}
                    >
                      {project.projectImages.map((image) => {
                        const url = buildProjectScreenshotUrl(image.image_path)
                        if (!url) return null
                        return (
                          <Image
                            key={image.id}
                            source={{ uri: url }}
                            style={[
                              styles.screenshotThumb,
                              { borderColor: THEME.border },
                            ]}
                            resizeMode="cover"
                          />
                        )
                      })}
                    </ScrollView>
                  ) : null}

                  {project.skills?.length ? (
                    <View style={styles.projectSkillWrap}>
                      {project.skills.map((skill, index) => {
                        const label = getSkillLabel(skill)
                        if (!label) return null
                        const color =
                          SKILL_BADGE_COLORS[index % SKILL_BADGE_COLORS.length]
                        return (
                          <View
                            key={`${skill.id ?? label}-${label}`}
                            style={[
                              styles.projectSkillBadge,
                              { borderColor: color.borderColor },
                            ]}
                          >
                            <Text
                              style={[
                                styles.projectSkillBadgeText,
                                { color: color.color },
                              ]}
                            >
                              {label}
                            </Text>
                          </View>
                        )
                      })}
                    </View>
                  ) : null}

                  <View style={[styles.actionRow, { borderTopColor: THEME.border }]}>
                    <TouchableOpacity
                      activeOpacity={0.86}
                      onPress={() => openExternalLink(project.lien_github)}
                      style={[
                        styles.actionButton,
                        { backgroundColor: THEME.mutedSurface, borderColor: THEME.border },
                      ]}
                    >
                      <GitBranch size={16} color={THEME.foreground} />
                      <Text style={[styles.actionButtonText, { color: THEME.foreground }]}>
                        Voir sur GitHub
                      </Text>
                    </TouchableOpacity>
                    <TouchableOpacity
                      activeOpacity={0.86}
                      onPress={() => openExternalLink(project.lien_demo)}
                      style={[
                        styles.actionButton,
                        styles.demoButton,
                        { borderColor: THEME.primary },
                      ]}
                    >
                      <ExternalLink size={16} color={THEME.primary} />
                      <Text style={[styles.demoButtonText, { color: THEME.primary }]}>
                        Démo
                      </Text>
                    </TouchableOpacity>
                  </View>
                </View>
              </View>
            ))}
          </View>
        )}
      </View>
    </ScrollView>
  )
}

const styles = StyleSheet.create({
  pdfButton: {
    alignSelf: "flex-start",
    borderRadius: 12,
    flexDirection: "row",
    alignItems: "center",
    gap: 9,
    paddingHorizontal: 16,
    paddingVertical: 13,
    marginBottom: 18,
    shadowColor: "#000000",
    shadowOffset: { width: 0, height: 8 },
    shadowOpacity: 0.16,
    shadowRadius: 16,
    elevation: 5,
  },
  pdfButtonText: {
    color: "#FFFFFF",
    fontSize: 13,
    fontWeight: "700",
  },
  topStack: {
    gap: 16,
    marginBottom: 18,
  },
  profileCard: {
    borderRadius: 16,
    borderWidth: 1,
    flexDirection: "row",
    gap: 16,
    padding: 18,
    shadowColor: "#000000",
    shadowOffset: { width: 0, height: 10 },
    shadowOpacity: 0.12,
    shadowRadius: 18,
    elevation: 4,
  },
  profilePhoto: {
    width: 112,
    height: 112,
    borderRadius: 16,
    borderWidth: 1,
    overflow: "hidden",
    alignItems: "center",
    justifyContent: "center",
  },
  profilePhotoImage: {
    width: "100%",
    height: "100%",
    borderRadius: 16,
  },
  profileInitials: {
    fontSize: 30,
    fontWeight: "800",
  },
  profileText: {
    flex: 1,
    justifyContent: "center",
    minWidth: 0,
  },
  profileName: {
    fontSize: 25,
    lineHeight: 31,
    fontWeight: "800",
  },
  profileSpecialty: {
    marginTop: 5,
    fontSize: 16,
    lineHeight: 22,
    fontWeight: "600",
  },
  profileDescription: {
    marginTop: 12,
    fontSize: 14,
    lineHeight: 21,
  },
  skillsCard: {
    borderRadius: 16,
    borderWidth: 1,
    padding: 18,
    shadowColor: "#000000",
    shadowOffset: { width: 0, height: 10 },
    shadowOpacity: 0.12,
    shadowRadius: 18,
    elevation: 4,
  },
  sectionTitleRow: {
    flexDirection: "row",
    alignItems: "center",
    gap: 8,
    marginBottom: 14,
  },
  blueDiamond: {
    color: "#06B6D4",
    fontSize: 17,
    fontWeight: "900",
  },
  sectionTitle: {
    fontSize: 18,
    fontWeight: "800",
  },
  badgeWrap: {
    flexDirection: "row",
    flexWrap: "wrap",
    gap: 8,
  },
  skillBadge: {
    borderRadius: 8,
    borderWidth: 1,
    paddingHorizontal: 12,
    paddingVertical: 7,
  },
  skillBadgeText: {
    fontSize: 13,
    fontWeight: "700",
  },
  projectsSection: {
    borderRadius: 16,
    borderWidth: 1,
    padding: 16,
  },
  projectsTitleRow: {
    flexDirection: "row",
    alignItems: "center",
    gap: 8,
    marginBottom: 16,
  },
  purpleDiamond: {
    color: "#A78BFA",
    fontSize: 18,
    fontWeight: "900",
  },
  projectsTitle: {
    fontSize: 20,
    fontWeight: "800",
  },
  projectList: {
    gap: 16,
  },
  projectCard: {
    borderRadius: 12,
    borderWidth: 1,
    overflow: "hidden",
    shadowColor: "#000000",
    shadowOffset: { width: 0, height: 8 },
    shadowOpacity: 0.12,
    shadowRadius: 18,
    elevation: 4,
  },
  projectHeroImage: {
    width: "100%",
    aspectRatio: 1,
  },
  projectPlaceholder: {
    width: "100%",
    aspectRatio: 1,
    alignItems: "center",
    justifyContent: "center",
    backgroundColor: "rgba(79,70,229,0.18)",
  },
  projectPlaceholderText: {
    color: "rgba(255,255,255,0.55)",
    fontSize: 44,
    fontWeight: "900",
  },
  projectContent: {
    padding: 16,
  },
  projectTitle: {
    fontSize: 17,
    fontWeight: "800",
  },
  projectDescription: {
    marginTop: 9,
    fontSize: 14,
    lineHeight: 22,
  },
  screenshotRow: {
    flexDirection: "row",
    gap: 8,
    paddingTop: 12,
    paddingBottom: 2,
  },
  screenshotThumb: {
    width: 110,
    height: 74,
    borderRadius: 8,
    borderWidth: 1,
  },
  projectSkillWrap: {
    flexDirection: "row",
    flexWrap: "wrap",
    gap: 7,
    marginTop: 12,
  },
  projectSkillBadge: {
    borderRadius: 7,
    borderWidth: 1,
    paddingHorizontal: 9,
    paddingVertical: 5,
  },
  projectSkillBadgeText: {
    fontSize: 11,
    fontWeight: "700",
  },
  actionRow: {
    flexDirection: "row",
    gap: 8,
    borderTopWidth: StyleSheet.hairlineWidth,
    marginTop: 16,
    paddingTop: 14,
  },
  actionButton: {
    flex: 1,
    minHeight: 42,
    borderRadius: 9,
    borderWidth: 1,
    flexDirection: "row",
    alignItems: "center",
    justifyContent: "center",
    gap: 7,
    paddingHorizontal: 8,
  },
  actionButtonText: {
    fontSize: 12,
    fontWeight: "800",
  },
  demoButton: {
    backgroundColor: "rgba(59,130,246,0.08)",
    borderWidth: 2,
  },
  demoButtonText: {
    fontSize: 12,
    fontWeight: "800",
  },
  emptyText: {
    fontSize: 14,
    lineHeight: 21,
  },
})
