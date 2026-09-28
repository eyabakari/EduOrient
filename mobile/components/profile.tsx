/**
 * @file Profil utilisateur : stats, succès, lien vers paramètres.
 */
import {
  User,
  Trophy,
  Flame,
  Target,
  Calendar,
  Settings,
  ChevronRight,
  Star,
  Zap,
} from "lucide-react-native"
import { useMemo } from "react"
import {
  ScrollView,
  View,
  Text,
  TouchableOpacity,
  Platform,
  RefreshControl,
} from "react-native"
import { LinearGradient } from "expo-linear-gradient"
import { GlassCard } from "./glass-card"
import { CircularProgress } from "./circular-progress"
import { ProgressGradientBar } from "./progress-gradient-bar"
import { useAppTheme } from "@/context/app-theme-context"
import { useAuth } from "@/context/auth-context"
import { useStudentDataContext } from "@/context/student-data-context"
import { useBottomTabBarHeight } from "@/hooks/use-bottom-tab-bar-height"
import { useLocale } from "@/context/locale-context"
import type { AppLocale } from "../locales/translations"
import { localeToBcp47 } from "../locales/translations"

interface ProfileProps {
  onOpenSettings?: () => void
}

function formatMemberSince(iso: string | null | undefined, locale: AppLocale): string | null {
  if (!iso) return null
  try {
    return new Date(iso).toLocaleDateString(localeToBcp47(locale), {
      month: "long",
      year: "numeric",
    })
  } catch {
    return null
  }
}

const SCROLL_EXTRA_BELOW_TAB_BAR = 24

const SKILL_BADGE_COLORS = [
  { bg: "#CFFAFE", fg: "#0E7490", border: "#A5F3FC" },
  { bg: "#FEE2E2", fg: "#B91C1C", border: "#FECACA" },
  { bg: "#E0F2FE", fg: "#0369A1", border: "#BAE6FD" },
  { bg: "#DBEAFE", fg: "#1D4ED8", border: "#BFDBFE" },
  { bg: "#FEF3C7", fg: "#B45309", border: "#FDE68A" },
  { bg: "#D1FAE5", fg: "#047857", border: "#A7F3D0" },
  { bg: "#EDE9FE", fg: "#6D28D9", border: "#DDD6FE" },
  { bg: "#FFE4E6", fg: "#BE123C", border: "#FECDD3" },
]

function getSkillBadgeColor(index: number) {
  return SKILL_BADGE_COLORS[index % SKILL_BADGE_COLORS.length]
}

export function Profile({ onOpenSettings }: ProfileProps) {
  const { theme: THEME } = useAppTheme()
  const { t } = useLocale()
  const tabBarHeight = useBottomTabBarHeight()
  const { user } = useAuth()
  const {
    projects,
    userSkills,
    allSkills,
    catalogTotal,
    masteredCount,
    refreshing,
    refetch,
  } = useStudentDataContext()

  const etu = user?.candidat || user?.etudiant
  const mastered =
    etu?.skills_mastered != null ? Number(etu.skills_mastered) : masteredCount
  const projectsCount =
    etu?.projects_count != null ? Number(etu.projects_count) : projects.length

  const streakDays =
    etu?.streak_days != null ? Number(etu.streak_days) : null

  const totalXp =
    etu?.xp_total != null
      ? Number(etu.xp_total)
      : userSkills.length * 120 + projects.length * 200
  const studentLevel =
    etu?.level != null
      ? Number(etu.level)
      : Math.min(20, Math.max(1, 1 + Math.floor(totalXp / 500)))

  const parcoursPct = Math.min(
    100,
    Math.max(0, etu?.parcours_progress != null
      ? Number(etu.parcours_progress)
      : Math.round((mastered / catalogTotal) * 100))
  )

  const memberLabel = formatMemberSince(user?.created_at, "fr")

  const stats = useMemo(
    () => [
      {
        icon: Trophy,
        label: t("profile_stat_mastered"),
        value: String(mastered),
        iconColor: "#FACC15",
      },
      ...(streakDays != null && Number.isFinite(streakDays)
        ? [
            {
              icon: Flame,
              label: t("profile_stat_streak"),
              value: String(streakDays),
              iconColor: "#FB923C",
            },
          ]
        : []),
      {
        icon: Target,
        label: t("profile_stat_projects"),
        value: String(projectsCount),
        iconColor: THEME.accent,
      },
      {
        icon: Zap,
        label: t("profile_stat_xp"),
        value: String(totalXp),
        iconColor: THEME.primary,
      },
    ],
    [t, mastered, streakDays, projectsCount, totalXp, THEME.accent, THEME.primary]
  )

  const achievements = useMemo(
    () => [
      {
        icon: Star,
        title: t("achievement_skill_title"),
        description: t("achievement_skill_desc"),
        earned: userSkills.length >= 1,
      },
      {
        icon: Flame,
        title: t("achievement_streak_title"),
        description: t("achievement_streak_desc"),
        earned: streakDays != null && streakDays >= 7,
      },
      {
        icon: Trophy,
        title: t("achievement_portfolio_title"),
        description: t("achievement_portfolio_desc"),
        earned: projectsCount >= 3,
      },
      {
        icon: Target,
        title: t("achievement_expert_title"),
        description: t("achievement_expert_desc"),
        earned: mastered >= 3,
      },
    ],
    [t, userSkills.length, streakDays, projectsCount, mastered]
  )

  return (
    <ScrollView
      className="flex-1 px-4 pt-6"
      contentContainerStyle={{
        paddingBottom: tabBarHeight + SCROLL_EXTRA_BELOW_TAB_BAR,
      }}
      refreshControl={
        <RefreshControl
          refreshing={refreshing}
          onRefresh={() => void refetch()}
          tintColor={THEME.accent}
        />
      }
    >
      <View className="mb-6 flex-row items-center justify-between">
        <Text className="text-3xl font-bold tracking-tight text-foreground">
          {t("profile_title")}
        </Text>
        <TouchableOpacity
          onPress={onOpenSettings}
          className="rounded-2xl border border-border/60 p-2.5"
          style={{ backgroundColor: THEME.mutedSurface }}
          activeOpacity={0.85}
        >
          <Settings size={22} color={THEME.muted} />
        </TouchableOpacity>
      </View>

      <GlassCard
        className="mb-6"
        variant="strong"
        contentClassName="items-center px-5 pb-6 pt-5"
      >
        <View
          className="mb-5"
          style={{ width: 108, alignSelf: "center", position: "relative" }}
        >
          <View
            style={
              Platform.OS === "ios"
                ? {
                    shadowColor: THEME.accent,
                    shadowOffset: { width: 0, height: 0 },
                    shadowOpacity: 0.55,
                    shadowRadius: 16,
                  }
                : { elevation: 8 }
            }
          >
            <LinearGradient
              colors={[THEME.gradientStart, THEME.gradientEnd]}
              start={{ x: 0, y: 0 }}
              end={{ x: 1, y: 1 }}
              style={{
                width: 108,
                height: 108,
                borderRadius: 54,
                padding: 3,
              }}
            >
              <View
                style={{
                  flex: 1,
                  borderRadius: 51,
                  backgroundColor: THEME.card,
                  alignItems: "center",
                  justifyContent: "center",
                }}
              >
                <User size={44} color={THEME.foreground} />
              </View>
            </LinearGradient>
          </View>
          <View
            style={{
              position: "absolute",
              right: -4,
              bottom: -2,
              borderRadius: 999,
              paddingHorizontal: 10,
              paddingVertical: 4,
              backgroundColor: THEME.primary,
              borderWidth: 2,
              borderColor: THEME.card,
              ...(Platform.OS === "ios"
                ? {
                    shadowColor: THEME.primary,
                    shadowOpacity: 0.45,
                    shadowRadius: 10,
                  }
                : { elevation: 4 }),
            }}
          >
            <Text className="text-xs font-bold" style={{ color: "#FFFFFF" }}>
              {t("profile_level_badge", { n: studentLevel })}
            </Text>
          </View>
        </View>
        <Text className="text-center text-xl font-bold text-foreground">
          {(user?.name ?? "").trim() || "—"}
        </Text>
        <Text className="mt-1 text-center text-sm text-muted-foreground">
          {(user?.email ?? "").trim() || "—"}
        </Text>
        {memberLabel ? (
          <View className="mt-3 flex-row items-center justify-center gap-2">
            <Calendar size={14} color={THEME.muted} />
            <Text className="text-center text-xs text-muted-foreground">
              {t("profile_member_since", { date: memberLabel })}
            </Text>
          </View>
        ) : null}
      </GlassCard>

      <View className="mb-6 flex-row flex-wrap gap-3">
        {stats.map((stat, index) => {
          const Icon = stat.icon
          return (
            <GlassCard
              key={`${stat.label}-${index}`}
              className="min-w-[47%] flex-1"
              contentClassName="items-center py-4"
            >
              <Icon size={24} color={stat.iconColor} style={{ marginBottom: 8 }} />
              <Text className="text-2xl font-bold text-foreground">{stat.value}</Text>
              <Text className="text-xs font-medium text-muted-foreground">{stat.label}</Text>
            </GlassCard>
          )
        })}
      </View>

      <GlassCard className="mb-6" variant="neon" neonColor="cyan">
        <Text className="mb-4 text-sm font-semibold tracking-wide text-foreground">
          Parcours
        </Text>
        <View className="mb-4 gap-2">
          <View className="flex-row flex-wrap gap-2">
            {etu?.niveau_etude ? (
              <Text className="rounded-full border border-border/70 bg-surface px-3 py-1 text-xs font-medium text-muted-foreground">
                {etu.niveau_etude}
              </Text>
            ) : null}
            {etu?.specialite ? (
              <Text className="rounded-full border border-border/70 bg-surface px-3 py-1 text-xs font-medium text-muted-foreground">
                {etu.specialite}
              </Text>
            ) : null}
          </View>
          <View>
            <View className="mb-1 flex-row justify-between">
              <Text className="text-xs text-muted-foreground">{t("learning_progress")}</Text>
              <Text className="text-xs font-semibold text-foreground">{parcoursPct}%</Text>
            </View>
            <ProgressGradientBar progress={parcoursPct} height={8} variant="brand" />
          </View>
        </View>
        <View className="items-center justify-center">
          <CircularProgress
            embedded
            progress={parcoursPct}
            size={100}
            strokeWidth={8}
            label={`${mastered} / ${catalogTotal}`}
          />
        </View>
      </GlassCard>

      <GlassCard className="mb-6">
        <View className="mb-3 flex-row items-center justify-between">
          <View>
            <Text className="text-base font-semibold text-foreground">{t("my_skills")}</Text>
            <Text className="mt-0.5 text-xs text-muted-foreground">
              {t("profile_stat_mastered")} / {allSkills.length}
            </Text>
          </View>
          <Text className="rounded-full border border-border/70 bg-surface px-2.5 py-0.5 text-xs font-medium text-muted-foreground">
            {userSkills.length}/{allSkills.length}
          </Text>
        </View>
        {userSkills.length === 0 ? (
          <Text className="rounded-xl border border-dashed border-border/70 bg-surface px-4 py-6 text-center text-sm text-muted-foreground">
            {t("profile_no_skills")}
          </Text>
        ) : (
          <View className="flex-row flex-wrap gap-2">
            {userSkills.map((skill, index) => {
              const colors = getSkillBadgeColor(index)
              return (
                <Text
                  key={skill.id}
                  className="rounded-lg border px-3 py-1.5 text-sm font-medium"
                  style={{
                    backgroundColor: colors.bg,
                    borderColor: colors.border,
                    color: colors.fg,
                  }}
                >
                  {skill.nom || t("skill_unknown")}
                </Text>
              )
            })}
          </View>
        )}
      </GlassCard>

      <GlassCard>
        <View className="mb-4 flex-row items-center justify-between">
          <Text className="text-base font-semibold text-foreground">{t("profile_achievements")}</Text>
          <TouchableOpacity className="flex-row items-center gap-0.5" activeOpacity={0.8}>
            <Text className="text-xs font-semibold" style={{ color: THEME.accent }}>
              {t("profile_api_data")}
            </Text>
            <ChevronRight size={16} color={THEME.accent} />
          </TouchableOpacity>
        </View>
        <View className="gap-3">
          {achievements.map((achievement, index) => {
            const Icon = achievement.icon
            return (
              <View
                key={index}
                className="flex-row items-center gap-3 rounded-2xl p-3"
                style={{
                  backgroundColor: achievement.earned
                    ? "rgba(34, 211, 238, 0.08)"
                    : "rgba(20, 29, 48, 0.5)",
                  opacity: achievement.earned ? 1 : 0.55,
                }}
              >
                <View
                  className="rounded-xl p-2"
                  style={{
                    backgroundColor: achievement.earned
                      ? "rgba(34, 211, 238, 0.2)"
                      : "rgba(148, 163, 184, 0.12)",
                  }}
                >
                  <Icon
                    size={20}
                    color={achievement.earned ? THEME.accent : THEME.muted}
                  />
                </View>
                <View style={{ flex: 1, minWidth: 0 }}>
                  <Text
                    className="text-sm font-semibold"
                    style={{
                      color: achievement.earned ? THEME.foreground : THEME.muted,
                    }}
                  >
                    {achievement.title}
                  </Text>
                  <Text className="text-xs leading-4 text-muted-foreground">
                    {achievement.description}
                  </Text>
                </View>
                {achievement.earned ? (
                  <View
                    className="h-2 w-2 rounded-full"
                    style={{ backgroundColor: THEME.accent }}
                  />
                ) : null}
              </View>
            )
          })}
        </View>
      </GlassCard>
    </ScrollView>
  )
}
