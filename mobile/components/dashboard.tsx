/**
 * @file Tableau de bord connecté : bienvenue, XP, top skills, recommandations.
 */
import { useMemo } from "react"
import {
  Zap,
  Trophy,
  Flame,
  Code,
} from "lucide-react-native"
import {
  ScrollView,
  View,
  Text,
  TouchableOpacity,
  RefreshControl,
  ActivityIndicator,
} from "react-native"
import { GlassCard } from "./glass-card"
import type { BottomTabId } from "./bottom-nav"
import { useAppTheme } from "@/context/app-theme-context"
import { useLocale } from "@/context/locale-context"
import { useAuth } from "@/context/auth-context"
import { useStudentDataContext } from "@/context/student-data-context"
import { useBottomTabBarHeight } from "@/hooks/use-bottom-tab-bar-height"

interface DashboardProps {
  onNavigate: (tab: BottomTabId) => void
}

const SCROLL_EXTRA_BELOW_TAB_BAR = 20

const BENTO_STAT_LABEL_STYLE = {
  fontSize: 14,
  lineHeight: 20,
  letterSpacing: 0.25,
} as const

export function Dashboard({ onNavigate }: DashboardProps) {
  const { theme: THEME } = useAppTheme()
  const { t } = useLocale()
  const tabBarHeight = useBottomTabBarHeight()
  const { user } = useAuth()
  const { projects, userSkills, loading, refreshing, error, refetch } = useStudentDataContext()

  const etu = user?.candidat || user?.etudiant
  const displayName =
    user?.name?.split(/\s+/)[0] ?? user?.name ?? ""
  const cursusLabel =
    etu?.specialite?.trim() ||
    etu?.niveau_etude?.trim() ||
    ""
  const streakDays = etu?.streak_days != null ? Number(etu.streak_days) : null

  const projectsCount = projects.length
  const declaredCount = userSkills.length
  const topSkills = useMemo(() => userSkills, [userSkills])
  const recentProjects = useMemo(() => projects.slice(0, 4), [projects])

  return (
    <ScrollView
      className="flex-1"
      contentContainerStyle={{
        paddingBottom: tabBarHeight + SCROLL_EXTRA_BELOW_TAB_BAR + 30,
        paddingTop: 24,
        paddingHorizontal: 18,
      }}
      refreshControl={
        <RefreshControl
          refreshing={refreshing}
          onRefresh={() => void refetch()}
          tintColor={THEME.accent}
        />
      }
    >
      {error ? (
        <GlassCard className="mb-4" contentClassName="py-3 px-3">
          <Text className="text-center text-sm text-amber-200">
            {error === "student_data_load" ? t("student_data_load") : error}
          </Text>
          <TouchableOpacity
            onPress={() => void refetch()}
            className="mt-2 items-center"
            activeOpacity={0.85}
          >
            <Text className="text-sm font-semibold" style={{ color: THEME.accent }}>
              {t("dashboard_retry")}
            </Text>
          </TouchableOpacity>
        </GlassCard>
      ) : null}

      <View className="mb-6 flex-row items-center justify-between">
        <View className="min-w-0 flex-1 pr-2">
          <Text className="text-sm font-medium text-muted-foreground">{t("dashboard_welcome")}</Text>
          <Text className="text-3xl font-bold tracking-tight text-foreground" numberOfLines={1}>
            {displayName || "—"}
          </Text>
          {cursusLabel ? (
            <Text className="mt-1 text-sm text-muted-foreground" numberOfLines={1}>
              {cursusLabel}
            </Text>
          ) : null}
        </View>
        {streakDays != null && Number.isFinite(streakDays) ? (
          <GlassCard contentClassName="flex-row items-center gap-2 p-3">
            <Flame size={20} color="#FB923C" />
            <Text className="font-bold text-foreground">{streakDays}</Text>
          </GlassCard>
        ) : null}
      </View>

      <View className="gap-4">
        <View className="flex-row flex-wrap gap-3">
          <GlassCard className="flex-1 min-w-[45%]" contentClassName="px-4 py-5">
            <View className="flex-row items-center gap-3">
              <View
                className="rounded-2xl p-3"
                style={{ backgroundColor: "rgba(59, 130, 246, 0.12)" }}
              >
                <Zap size={20} color={THEME.primary} />
              </View>
              <View className="min-w-0 flex-1">
                <Text
                  className="font-medium text-muted-foreground"
                  style={BENTO_STAT_LABEL_STYLE}
                >
                  {t("dashboard_skills_declared")}
                </Text>
                <Text className="mt-2 text-2xl font-semibold text-foreground">
                  {declaredCount}
                </Text>
              </View>
            </View>
          </GlassCard>

          <GlassCard className="flex-1 min-w-[45%]" contentClassName="px-4 py-5">
            <View className="flex-row items-center gap-3">
              <View
                className="rounded-2xl p-3"
                style={{ backgroundColor: "rgba(16, 185, 129, 0.12)" }}
              >
                <Trophy size={20} color="#10B981" />
              </View>
              <View className="min-w-0 flex-1">
                <Text
                  className="font-medium text-muted-foreground"
                  style={BENTO_STAT_LABEL_STYLE}
                >
                  {t("dashboard_projects")}
                </Text>
                <Text className="mt-2 text-2xl font-semibold text-foreground">
                  {projectsCount}
                </Text>
              </View>
            </View>
          </GlassCard>
        </View>

        <GlassCard>
          <View className="mb-2 flex-row items-center gap-2">
            <Code size={16} color="#FACC15" />
            <View className="min-w-0 flex-1">
              <Text className="text-sm font-semibold text-foreground">Mes compétences</Text>
              <Text className="mt-1 text-xs text-muted-foreground" style={{ color: "#9ca3af" }}>
                Retrouve l{"'"}ensemble des technologies que tu maîtrises.
              </Text>
            </View>
          </View>
          {topSkills.length > 0 ? (
            <View
              style={{
                flexDirection: "row",
                flexWrap: "wrap",
                paddingVertical: 10,
                marginHorizontal: -5,
              }}
            >
              {topSkills.map((skill) => (
                <View
                  key={skill.id}
                  style={{
                    backgroundColor: "rgba(255, 255, 255, 0.05)",
                    borderWidth: 1,
                    borderColor: "rgba(255, 255, 255, 0.1)",
                    borderRadius: 20,
                    paddingHorizontal: 16,
                    paddingVertical: 10,
                    alignItems: "center",
                    justifyContent: "center",
                    margin: 5,
                    alignSelf: "flex-start",
                  }}
                >
                  <Text
                    className="text-center text-[13px] font-semibold text-foreground"
                    numberOfLines={1}
                  >
                    {skill.nom || skill.name || t("dashboard_unknown_skill")}
                  </Text>
                </View>
              ))}
            </View>
          ) : (
            <Text className="text-sm text-muted-foreground">
              {t("dashboard_no_skills")}
            </Text>
          )}
        </GlassCard>

        <View className="gap-4">
          <View className="mb-3 flex-row flex-wrap items-center justify-between gap-3">
            <View className="flex-1 min-w-0">
              <Text className="text-lg font-bold text-foreground">{t("dashboard_recent_projects")}</Text>
              <Text className="mt-1 text-sm text-muted-foreground">
                {t("dashboard_recent_projects_hint")}
              </Text>
            </View>
            <TouchableOpacity
              onPress={() => onNavigate("projects")}
              className="rounded-full border border-border/70 px-5"
              activeOpacity={0.85}
              style={{ paddingVertical: 12, marginBottom: 20, maxWidth: 168 }}
            >
              <Text className="text-xs font-semibold text-foreground text-center">
                {t("dashboard_view_projects")}
              </Text>
            </TouchableOpacity>
          </View>

          {loading ? (
            <GlassCard variant="neon" neonColor="violet">
              <View className="flex-row items-center gap-3">
                <ActivityIndicator size="small" color={THEME.accent} />
                <Text className="text-sm font-medium text-muted-foreground">
                  {t("dashboard_loading_projects")}
                </Text>
              </View>
            </GlassCard>
          ) : recentProjects.length > 0 ? (
            <View>
              {recentProjects.map((project) => (
                <GlassCard
                  key={project.id}
                  className=""
                  style={{ marginHorizontal: 16, marginVertical: 10 }}
                  contentClassName="p-4"
                >
                  <Text className="text-base font-semibold text-foreground">{project.titre}</Text>
                  {project.description ? (
                    <Text className="mt-2 text-sm leading-6 text-muted-foreground">
                      {project.description}
                    </Text>
                  ) : null}
                </GlassCard>
              ))}
            </View>
          ) : (
            <GlassCard contentClassName="px-4 py-7">
              <Text className="text-center text-sm leading-5 text-muted-foreground">
                {t("dashboard_projects_empty")}
              </Text>
            </GlassCard>
          )}
        </View>
      </View>
    </ScrollView>
  )
}
