/**
 * @file Gestion des compétences mobile, alignée sur la page Web Skills.
 */
import { useEffect, useMemo, useState } from "react"
import { RefreshControl, ScrollView, Text, TouchableOpacity, View } from "react-native"
import { Check, ChevronDown, X } from "lucide-react-native"
import { GlassCard } from "./glass-card"
import { useAppTheme } from "@/context/app-theme-context"
import { useBottomTabBarHeight } from "@/hooks/use-bottom-tab-bar-height"
import { useStudentDataContext } from "@/context/student-data-context"
import type { ApiUserSkillRow } from "@/lib/map-skills"
import { api } from "@/lib/api"

const LEVEL_OPTIONS = [
  { value: "beginner", label: "Débutant" },
  { value: "intermediate", label: "Intermédiaire" },
  { value: "advanced", label: "Avancé" },
  { value: "expert", label: "Expert" },
]

const SCROLL_EXTRA_BELOW_TAB_BAR = 24

function skillName(skill: ApiUserSkillRow): string {
  return skill.name || skill.nom || `Compétence #${skill.id}`
}

function sortCategoryKeys(keys: string[]): string[] {
  return [...keys].sort((a, b) => String(a).localeCompare(String(b), 'fr', { sensitivity: 'base' }))
}

function SelectedBadge({
  label,
  busy,
  dimmed,
  onPress,
}: {
  label: string
  busy: boolean
  dimmed: boolean
  onPress: () => void
}) {
  return (
    <TouchableOpacity
      onPress={onPress}
      disabled={busy || dimmed}
      activeOpacity={0.85}
      className="flex-row items-center gap-1 rounded-full border px-2.5 py-1"
      style={{
        borderColor: "#38BDF8",
        backgroundColor: "#E0F2FE",
        opacity: busy || dimmed ? 0.55 : 1,
      }}
    >
      <Check size={12} color="#0369A1" />
      <Text className="text-xs font-medium" style={{ color: "#075985" }}>
        {label}
      </Text>
      <X size={12} color="#0369A1" />
    </TouchableOpacity>
  )
}

function CatalogBadge({
  label,
  selected,
  busy,
  dimmed,
  onPress,
}: {
  label: string
  selected: boolean
  busy: boolean
  dimmed: boolean
  onPress: () => void
}) {
  return (
    <TouchableOpacity
      onPress={onPress}
      disabled={busy || dimmed}
      activeOpacity={0.85}
      className="flex-row items-center gap-1 rounded-full border px-2.5 py-1"
      style={{
        borderColor: selected ? "#38BDF8" : "#CBD5E1",
        backgroundColor: selected ? "#E0F2FE" : "#F8FAFC",
        opacity: busy || dimmed ? 0.55 : 1,
      }}
    >
      {selected ? <Check size={12} color="#0369A1" /> : null}
      <Text className="text-xs font-medium" style={{ color: selected ? "#075985" : "#334155" }}>
        {label}
      </Text>
    </TouchableOpacity>
  )
}

export function Skills() {
  const { theme: THEME } = useAppTheme()
  const tabBarHeight = useBottomTabBarHeight()
  const { userSkills, allSkills, refreshing, refetch } = useStudentDataContext()
  const [togglingId, setTogglingId] = useState<number | null>(null)
  const [openCategory, setOpenCategory] = useState<string | null>(null)
  const [error, setError] = useState<string | null>(null)

  const userSkillIds = useMemo(
    () => new Set(userSkills.map((skill) => skill.id)),
    [userSkills]
  )

  const selectedSkillsSorted = useMemo(
    () =>
      [...userSkills].sort((a, b) =>
        skillName(a).localeCompare(skillName(b), "fr", { sensitivity: "base" })
      ),
    [userSkills]
  )

  const { sortedCategories, skillsByCategory } = useMemo(() => {
    const map = new Map<string, ApiUserSkillRow[]>()
    for (const skill of allSkills) {
      const category = skill.category ?? skill.categorie ?? ''
      if (!map.has(category)) map.set(category, [])
      map.get(category)?.push(skill)
    }
    for (const list of map.values()) {
      list.sort((a, b) => skillName(a).localeCompare(skillName(b), 'fr', { sensitivity: 'base' }))
    }
    const keys = sortCategoryKeys([...map.keys()])
    return { sortedCategories: keys, skillsByCategory: map }
  }, [allSkills])

  useEffect(() => {
    if (sortedCategories.length === 0) return
    setOpenCategory((current) =>
      current && sortedCategories.includes(current) ? current : sortedCategories[0]
    )
  }, [sortedCategories])

  const toggleSkill = async (skill: ApiUserSkillRow) => {
    const selected = userSkillIds.has(skill.id)
    setTogglingId(skill.id)
    setError(null)
    try {
      if (selected) {
        await api.delete(`/user-skills/${skill.id}`)
      } else {
        await api.post("/user-skills", { skill_id: skill.id, level: "beginner" })
      }
      await refetch()
    } catch (e: any) {
      setError(e?.response?.data?.message || "Erreur lors de la mise à jour des compétences.")
    } finally {
      setTogglingId(null)
    }
  }


  return (
    <ScrollView
      className="flex-1 px-4 pt-6"
      contentContainerStyle={{ paddingBottom: tabBarHeight + SCROLL_EXTRA_BELOW_TAB_BAR }}
      refreshControl={
        <RefreshControl
          refreshing={refreshing}
          onRefresh={() => void refetch()}
          tintColor={THEME.primary}
        />
      }
    >
      <View className="mb-6">
        <Text className="text-2xl font-bold tracking-tight text-foreground">Gestion des compétences</Text>
        <Text className="mt-2 text-sm leading-5 text-muted-foreground">
          Une catégorie à la fois : ouvrez un panneau, choisissez vos compétences. Les sélections apparaissent en haut de page.
        </Text>
      </View>

      {error ? (
        <GlassCard className="mb-4" plain contentClassName="px-4 py-3">
          <Text className="text-sm text-amber-700">{error}</Text>
        </GlassCard>
      ) : null}

      <GlassCard className="mb-6" plain contentClassName="p-4">
        <View className="mb-3 flex-row items-start justify-between gap-3">
          <View className="min-w-0 flex-1">
            <Text className="text-lg font-semibold text-foreground">Mes compétences sélectionnées</Text>
            <Text className="mt-0.5 text-sm text-muted-foreground">
              Aperçu rapide de votre profil. Touchez un badge pour le retirer.
            </Text>
          </View>
          <Text className="rounded-full border border-border bg-surface px-2.5 py-0.5 text-xs font-medium text-muted-foreground">
            {selectedSkillsSorted.length}
          </Text>
        </View>

        {selectedSkillsSorted.length === 0 ? (
          <Text className="rounded-xl border border-dashed border-border bg-surface px-4 py-6 text-center text-sm text-muted-foreground">
            Aucune compétence sélectionnée. Ouvrez une catégorie ci-dessous pour en ajouter.
          </Text>
        ) : (
          <View className="flex-row flex-wrap gap-2">
            {selectedSkillsSorted.map((skill) => {
              const busy = togglingId === skill.id
              return (
                <SelectedBadge
                  key={skill.id}
                  label={skillName(skill)}
                  busy={busy}
                  dimmed={togglingId !== null && !busy}
                  onPress={() => void toggleSkill(skill)}
                />
              )
            })}
          </View>
        )}
      </GlassCard>

      <GlassCard plain contentClassName="p-4">
        <Text className="text-lg font-semibold text-foreground">Catalogue par catégorie</Text>
        <Text className="mt-1 text-sm text-muted-foreground">
          Les badges sélectionnés utilisent le même état visuel que le site Web.
        </Text>

        {allSkills.length === 0 ? (
          <Text className="mt-4 rounded-xl border border-amber-300 bg-amber-50 px-4 py-3 text-sm text-amber-900">
            Aucune compétence dans le catalogue. Lancez le seeder backend SkillSeeder.
          </Text>
        ) : (
          <View className="mt-5 gap-2">
            {sortedCategories.map((category, index) => {
              const list = skillsByCategory.get(category) ?? []
              const isOpen = openCategory === category
              return (
                <View key={category} className="overflow-hidden rounded-xl border border-border bg-surface">
                  <TouchableOpacity
                    onPress={() => setOpenCategory((prev) => (prev === category ? null : category))}
                    activeOpacity={0.85}
                    className="flex-row items-center justify-between gap-3 px-4 py-3.5"
                  >
                    <Text className="min-w-0 flex-1 text-sm font-semibold text-foreground">
                      {category}
                    </Text>
                    <View className="flex-row items-center gap-2">
                      <Text className="rounded-full border border-border bg-card px-2 py-0.5 text-xs text-muted-foreground">
                        {list.length}
                      </Text>
                      <ChevronDown
                        size={18}
                        color={THEME.muted}
                        style={{ transform: [{ rotate: isOpen ? "180deg" : "0deg" }] }}
                      />
                    </View>
                  </TouchableOpacity>
                  {isOpen ? (
                    <View className="border-t border-border bg-card px-4 py-4">
                      <View className="flex-row flex-wrap gap-2">
                        {list.map((skill) => {
                          const selected = userSkillIds.has(skill.id)
                          const busy = togglingId === skill.id
                          return (
                            <CatalogBadge
                              key={`${category}-${index}-${skill.id}`}
                              label={skillName(skill)}
                              selected={selected}
                              busy={busy}
                              dimmed={togglingId !== null && !busy}
                              onPress={() => void toggleSkill(skill)}
                            />
                          )
                        })}
                      </View>
                    </View>
                  ) : null}
                </View>
              )
            })}
          </View>
        )}
      </GlassCard>
    </ScrollView>
  )
}
