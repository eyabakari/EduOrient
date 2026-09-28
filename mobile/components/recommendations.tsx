/**
 * @file Matching & opportunités mobile, aligné sur la page Web Recommendations.
 */
import { useMemo, useState } from "react"
import {
  ActivityIndicator,
  RefreshControl,
  ScrollView,
  Text,
  TextInput,
  TouchableOpacity,
  View,
} from "react-native"
import { BriefcaseBusiness, Building2, Search, Sparkles } from "lucide-react-native"
import { GlassCard } from "./glass-card"
import { ProgressGradientBar } from "./progress-gradient-bar"
import { useAppTheme } from "@/context/app-theme-context"
import { useBottomTabBarHeight } from "@/hooks/use-bottom-tab-bar-height"
import ContactButton from "./contact-button"
import { useStudentDataContext, type ApiOfferRecommendation, type ApiRecommendation } from "@/context/student-data-context"

const SCROLL_EXTRA_BELOW_TAB_BAR = 24
const VIEW_FILTERS = [
  { id: "all", label: "Voir tout" },
  { id: "companies", label: "Entreprises uniquement" },
  { id: "offers", label: "Offres uniquement" },
] as const
type ResultFilter = (typeof VIEW_FILTERS)[number]["id"]

function scorePercent(value: unknown): number {
  const numeric = Number(value)
  if (!Number.isFinite(numeric)) return 0
  return Math.min(100, Math.max(0, numeric <= 1 ? numeric * 100 : numeric))
}

function normalizeSearchValue(value?: string | null) {
  return String(value ?? "")
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .toLowerCase()
}

function offerMatchesSearch(item: ApiOfferRecommendation, query: string) {
  const normalizedQuery = normalizeSearchValue(query.trim())
  if (!normalizedQuery) return true

  const searchable = [
    item.type,
    item.entreprise,
    ...(item.matching_skills ?? []),
    ...(item.required_skills ?? []),
  ]
    .filter(Boolean)
    .join(" ")

  return normalizeSearchValue(searchable).includes(normalizedQuery)
}

function companyMatchesSearch(item: ApiRecommendation, query: string) {
  const normalizedQuery = normalizeSearchValue(query.trim())
  if (!normalizedQuery) return true

  const searchable = [
    item.entreprise,
    item.name,
    ...(item.matching_skills ?? []),
    ...(item.stack_tags ?? []),
  ]
    .filter(Boolean)
    .join(" ")

  return normalizeSearchValue(searchable).includes(normalizedQuery)
}

function SkillBadge({
  label,
  tone = "default",
}: {
  label: string
  tone?: "match" | "default"
}) {
  const match = tone === "match"
  return (
    <View
      className="rounded-lg border px-2.5 py-1.5"
      style={{
        borderColor: match ? "#A7F3D0" : "rgba(148, 163, 184, 0.28)",
        backgroundColor: match ? "#ECFDF5" : "rgba(148, 163, 184, 0.10)",
      }}
    >
      <Text
        className="text-xs font-medium"
        style={{ color: match ? "#047857" : "#94A3B8" }}
      >
        {label}
      </Text>
    </View>
  )
}

function SectionHeader({ title, subtitle }: { title: string; subtitle: string }) {
  return (
    <View className="mb-4">
      <Text className="text-xl font-bold text-foreground">{title}</Text>
      <Text className="mt-1 text-sm leading-5 text-muted-foreground">{subtitle}</Text>
    </View>
  )
}

function AiJustification({ text }: { text?: string }) {
  if (!text) return null
  return (
    <View className="mt-4 rounded-xl border border-violet-400/25 bg-violet-400/10 px-3 py-3">
      <View className="mb-1 flex-row items-center gap-2">
        <Sparkles size={14} color="#9D7BFF" />
        <Text className="text-xs font-bold uppercase tracking-[0.12em]" style={{ color: "#9D7BFF" }}>
          Justification AI
        </Text>
      </View>
      <Text className="text-sm leading-5 text-foreground">{text}</Text>
    </View>
  )
}

function CompanyCard({ item }: { item: ApiRecommendation }) {
  const score = scorePercent(item.score)
  const matchCount = item.match_count ?? item.matching_skills?.length ?? 0
  const stackCount = item.stack_tags?.length ?? 0
  const location = [item.ville, item.gouvernorat].filter(Boolean).join(" · ")
  const recruiter = [item.recruteur?.nom, item.recruteur?.poste].filter(Boolean).join(" · ")

  return (
    <GlassCard plain contentClassName="p-5" style={{ backgroundColor: "transparent" }}>
      <View className="flex-row items-start gap-3">
        <View className="rounded-xl bg-primary/10 p-2.5">
          <Building2 size={22} color="#9D7BFF" />
        </View>
        <View className="min-w-0 flex-1">
          <Text className="text-lg font-semibold text-foreground" numberOfLines={2}>
            {item.entreprise || item.name || "Entreprise"}
          </Text>
          {location ? <Text className="mt-1 text-sm text-muted-foreground">{location}</Text> : null}
          {recruiter ? <Text className="mt-1 text-xs text-muted-foreground">{recruiter}</Text> : null}
        </View>
      </View>

      {item.description ? (
        <Text className="mt-3 text-sm leading-5 text-muted-foreground" numberOfLines={4}>
          {item.description}
        </Text>
      ) : null}

      <View className="mt-4">
        <View className="mb-1.5 flex-row justify-between">
          <Text className="flex-1 pr-2 text-sm text-muted-foreground">
            Pertinence : {matchCount} compétence{matchCount > 1 ? "s" : ""} en commun
            {stackCount ? ` sur ${stackCount} tags entreprise / offres` : ""}
          </Text>
          <Text className="text-sm font-semibold text-foreground">{Math.round(score)} %</Text>
        </View>
        <ProgressGradientBar progress={score} height={9} variant="brand" />
      </View>

      {item.matching_skills?.length ? (
        <View className="mt-4">
          <Text className="mb-2 text-sm font-medium text-foreground">Vos compétences qui matchent</Text>
          <View className="flex-row flex-wrap gap-2">
            {item.matching_skills.map((skill) => (
              <SkillBadge key={skill} label={skill} tone="match" />
            ))}
          </View>
        </View>
      ) : null}

      {item.stack_tags?.length ? (
        <View className="mt-4">
          <Text className="mb-2 text-sm font-medium text-foreground">Périmètre techno (entreprise & offres)</Text>
          <View className="flex-row flex-wrap gap-2">
            {item.stack_tags.map((skill) => (
              <SkillBadge key={skill} label={skill} />
            ))}
          </View>
        </View>
      ) : null}

      <AiJustification text={item.justification} />
      <View className="mt-4">
        <ContactButton email={item.recruteur?.email ?? null} receiverId={(item.recruteur as any)?.id ?? item.recruteur_id ?? null} label="Contacter" />
      </View>
    </GlassCard>
  )
}

function OfferCard({ item }: { item: ApiOfferRecommendation }) {
  const score = scorePercent(item.score)
  const matchCount = item.match_count ?? item.matching_skills?.length ?? 0
  const requiredCount = item.required_skills?.length ?? 0
  const recruiter = [item.recruteur?.nom, item.recruteur?.poste].filter(Boolean).join(" · ")

  return (
    <GlassCard plain contentClassName="p-5" style={{ backgroundColor: "transparent" }}>
      <View className="flex-row items-start gap-3">
        <View className="rounded-xl bg-primary/10 p-2.5">
          <BriefcaseBusiness size={22} color="#9D7BFF" />
        </View>
        <View className="min-w-0 flex-1">
          <View className="flex-row items-start gap-2">
            <Text className="min-w-0 flex-1 text-lg font-semibold text-foreground" numberOfLines={2}>
              {item.titre || "Offre"}
            </Text>
            {item.type ? (
              <Text className="rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-medium capitalize text-primary">
                {item.type === "emploi" ? "Emploi" : "Stage"}
              </Text>
            ) : null}
          </View>
          {item.entreprise ? <Text className="mt-1 text-sm font-medium text-muted-foreground">{item.entreprise}</Text> : null}
          {recruiter ? <Text className="mt-1 text-xs text-muted-foreground">{recruiter}</Text> : null}
          {item.lieu ? <Text className="mt-1 text-xs text-muted-foreground">{item.lieu}</Text> : null}
        </View>
      </View>

      {item.description ? (
        <Text className="mt-3 text-sm leading-5 text-muted-foreground" numberOfLines={3}>
          {item.description}
        </Text>
      ) : null}

      <View className="mt-4">
        <View className="mb-1.5 flex-row justify-between">
          <Text className="flex-1 pr-2 text-sm text-muted-foreground">
            Adéquation annonce : {matchCount} / {requiredCount} compétence{requiredCount > 1 ? "s" : ""} requise{requiredCount > 1 ? "s" : ""}
          </Text>
          <Text className="text-sm font-semibold text-foreground">{Math.round(score)} %</Text>
        </View>
        <ProgressGradientBar progress={score} height={9} variant="brand" />
      </View>

      {item.matching_skills?.length ? (
        <View className="mt-4">
          <Text className="mb-2 text-sm font-medium text-foreground">
            Compétences de l{"'"}offre que vous couvrez
          </Text>
          <View className="flex-row flex-wrap gap-2">
            {item.matching_skills.map((skill) => (
              <SkillBadge key={skill} label={skill} tone="match" />
            ))}
          </View>
        </View>
      ) : null}

      <AiJustification text={item.justification} />
      <View className="mt-4">
        <ContactButton email={item.recruteur?.email ?? null} receiverId={(item.recruteur as any)?.id ?? item.recruteur_id ?? null} label="Contacter" />
      </View>
    </GlassCard>
  )
}

export function Recommendations() {
  const { theme: THEME } = useAppTheme()
  const tabBarHeight = useBottomTabBarHeight()
  const [searchQuery, setSearchQuery] = useState("")
  const [resultFilter, setResultFilter] = useState<ResultFilter>("all")
  const {
    recommendations,
    offerRecommendations,
    loading,
    refreshing,
    refetch,
  } = useStudentDataContext()

  const filteredRecommendations = useMemo(
    () => recommendations.filter((item) => companyMatchesSearch(item, searchQuery)),
    [recommendations, searchQuery]
  )

  const filteredOfferRecommendations = useMemo(
    () => offerRecommendations.filter((item) => offerMatchesSearch(item, searchQuery)),
    [offerRecommendations, searchQuery]
  )

  const showCompanies = resultFilter === "all" || resultFilter === "companies"
  const showOffers = resultFilter === "all" || resultFilter === "offers"
  const hasActiveSearch = searchQuery.trim().length > 0

  const clearFilters = () => {
    setSearchQuery("")
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
        <Text className="text-2xl font-bold text-foreground">Matching & opportunités</Text>
        <Text className="mt-2 text-sm leading-5 text-muted-foreground">
          Entreprises et annonces classées selon l’adéquation entre vos compétences, vos projets et les technologies déclarées.
        </Text>
      </View>

      <View className="mb-6">
        <View className="mb-3 flex-row rounded-xl border border-border/60 bg-card/70 p-1">
          {VIEW_FILTERS.map((filter) => {
            const active = resultFilter === filter.id
            return (
              <TouchableOpacity
                key={filter.id}
                activeOpacity={0.85}
                onPress={() => setResultFilter(filter.id)}
                className="flex-1 items-center justify-center px-2 py-2.5"
                style={{
                  borderRadius: 10,
                  backgroundColor: active ? "rgba(157, 123, 255, 0.20)" : "transparent",
                }}
              >
                <Text
                  className="text-center text-[11px] font-bold"
                  numberOfLines={1}
                  adjustsFontSizeToFit
                  style={{ color: active ? THEME.primary : THEME.muted }}
                >
                  {filter.label}
                </Text>
              </TouchableOpacity>
            )
          })}
        </View>

        <View
          className="flex-row items-center gap-3 border px-4"
          style={{
            minHeight: 50,
            borderRadius: 10,
            borderColor: "rgba(148, 163, 184, 0.22)",
            backgroundColor: `rgba(${THEME.cardRgb}, 0.72)`,
          }}
        >
          <Search size={18} color={THEME.muted} />
          <TextInput
            value={searchQuery}
            onChangeText={setSearchQuery}
            placeholder="Rechercher une compétence, entreprise ou type d'offre..."
            placeholderTextColor="rgba(163, 174, 208, 0.72)"
            className="min-w-0 flex-1 text-sm text-foreground"
            autoCapitalize="none"
            autoCorrect={false}
            returnKeyType="search"
          />
        </View>

        {/*
          {CITY_FILTERS.map((label) => {
            const active = selectedCity === label
            return (
              <TouchableOpacity
                key={label}
                activeOpacity={0.85}
                onPress={() => setSelectedCity(active ? null : label)}
                className="border px-3 py-2"
                style={{
                  borderRadius: 999,
                  borderColor: active ? "#06B6D4" : "rgba(148, 163, 184, 0.24)",
                  backgroundColor: active
                    ? "rgba(6, 182, 212, 0.16)"
                    : "rgba(148, 163, 184, 0.10)",
                }}
              >
                <Text
                  className="text-xs font-semibold"
                  style={{ color: active ? "#67E8F9" : THEME.muted }}
                >
                  {label}
                </Text>
              </TouchableOpacity>
            )
          })}

          {SCORE_FILTERS.map((filter) => {
            const active = selectedScore === filter.value
            return (
              <TouchableOpacity
                key={filter.label}
                activeOpacity={0.85}
                onPress={() => setSelectedScore(active ? null : filter.value)}
                className="border px-3 py-2"
                style={{
                  borderRadius: 999,
                  borderColor: active ? "#34D399" : "rgba(148, 163, 184, 0.24)",
                  backgroundColor: active
                    ? "rgba(52, 211, 153, 0.16)"
                    : "rgba(148, 163, 184, 0.10)",
                }}
              >
                <Text
                  className="text-xs font-semibold"
                  style={{ color: active ? "#6EE7B7" : THEME.muted }}
                >
                  Score {filter.label}
                </Text>
              </TouchableOpacity>
            )
          })}
        </ScrollView>

        {hasActiveFilters ? (
          <TouchableOpacity
            activeOpacity={0.85}
            onPress={clearFilters}
            className="mt-3 self-start rounded-full border border-border/60 px-3 py-2"
          >
            <Text className="text-xs font-semibold text-muted-foreground">
              Réinitialiser les filtres
            </Text>
          </TouchableOpacity>
        ) : null}
      </View>

        */}

        {hasActiveSearch ? (
          <TouchableOpacity
            activeOpacity={0.85}
            onPress={clearFilters}
            className="mt-3 self-start rounded-full border border-border/60 px-3 py-2"
          >
            <Text className="text-xs font-semibold text-muted-foreground">
              Réinitialiser la recherche
            </Text>
          </TouchableOpacity>
        ) : null}
      </View>

      {loading ? (
        <GlassCard plain contentClassName="items-center gap-3 py-8">
          <ActivityIndicator color={THEME.primary} />
          <Text className="text-sm text-muted-foreground">Chargement de vos recommandations...</Text>
        </GlassCard>
      ) : (
        <View className="gap-8">
          {showCompanies ? (
          <View>
            <SectionHeader
              title="Sociétés recommandées"
              subtitle="Entreprises classées selon l’adéquation entre vos compétences (profil et projets) et les technologies déclarées par les recruteurs ainsi que leurs offres actives."
            />
            {recommendations.length === 0 ? (
              <GlassCard plain contentClassName="px-4 py-7">
                <Text className="text-center text-sm leading-5 text-muted-foreground">
                  Aucune entreprise ne correspond encore à vos compétences. Enrichissez votre profil et vos projets pour voir des suggestions ciblées.
                </Text>
              </GlassCard>
            ) : filteredRecommendations.length === 0 ? (
              <GlassCard plain contentClassName="px-4 py-7">
                <Text className="text-center text-sm leading-5 text-muted-foreground">
                  Aucune entreprise ne correspond à cette recherche.
                </Text>
              </GlassCard>
            ) : (
              <View className="gap-4">
                {filteredRecommendations.map((item, index) => (
                  <CompanyCard key={item.recruteur_id ?? `${item.name}-${index}`} item={item} />
                ))}
              </View>
            )}
          </View>
          ) : null}

          {showOffers ? (
          <View>
            <SectionHeader
              title="Offres disponibles"
              subtitle="Annonces actives dont au moins une compétence requise (offre) est présente dans votre profil ou vos projets. Le score reflète la part des compétences de l’offre que vous couvrez."
            />
            {offerRecommendations.length === 0 ? (
              <GlassCard plain contentClassName="px-4 py-7">
                <Text className="text-center text-sm leading-5 text-muted-foreground">
                  Aucune offre ne correspond pour l’instant aux compétences de votre portfolio. Ajoutez des technologies sur vos projets ou dans votre profil pour débloquer des annonces pertinentes.
                </Text>
              </GlassCard>
            ) : filteredOfferRecommendations.length === 0 ? (
              <GlassCard plain contentClassName="px-4 py-7">
                <Text className="text-center text-sm leading-5 text-muted-foreground">
                  Aucune offre ne correspond à cette recherche. Essayez un autre poste, une autre ville ou un score plus bas.
                </Text>
              </GlassCard>
            ) : (
              <View className="gap-4">
                {filteredOfferRecommendations.map((item, index) => (
                  <OfferCard key={item.id ?? `${item.titre}-${index}`} item={item} />
                ))}
              </View>
            )}
          </View>
          ) : null}
        </View>
      )}
    </ScrollView>
  )
}
