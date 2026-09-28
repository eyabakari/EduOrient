import { useCallback, useEffect, useMemo, useState } from "react"
import {
  ActivityIndicator,
  Alert,
  Modal,
  RefreshControl,
  ScrollView,
  Text,
  TextInput,
  TouchableOpacity,
  View,
} from "react-native"
import { BriefcaseBusiness, Check, MapPin, PlusCircle } from "lucide-react-native"
import { GlassCard } from "./glass-card"
import { api } from "@/lib/api"
import { useAppTheme } from "@/context/app-theme-context"
import { useLocale } from "@/context/locale-context"
import { useBottomTabBarHeight } from "@/hooks/use-bottom-tab-bar-height"

const SCROLL_EXTRA_BELOW_TAB_BAR = 28

type SkillOption = {
  id: number
  nom?: string | null
  name?: string | null
}

type OfferRow = {
  id: number
  titre?: string | null
  title?: string | null
  description?: string | null
  type?: string | null
  lieu?: string | null
  is_active?: boolean | number | null
  skills?: SkillOption[]
}

function unwrapData<T>(raw: unknown, fallback: T): T {
  if (raw && typeof raw === "object" && "data" in raw) {
    const value = (raw as { data?: T }).data
    return value ?? fallback
  }
  return fallback
}

function getSkillLabel(skill: SkillOption) {
  return (skill.nom || skill.name || "").trim()
}

function SkillChip({
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
      className="flex-row items-center gap-1.5 border px-3 py-2"
      style={{
        borderRadius: 999,
        borderColor: active ? THEME.primary : "rgba(148, 163, 184, 0.24)",
        backgroundColor: active ? "rgba(157, 123, 255, 0.18)" : "rgba(148, 163, 184, 0.10)",
      }}
    >
      {active ? <Check size={13} color={THEME.primary} /> : null}
      <Text className="text-xs font-semibold" style={{ color: active ? THEME.primary : THEME.muted }}>
        {label}
      </Text>
    </TouchableOpacity>
  )
}

function OfferCard({ offer, onEdit, onDelete }: { offer: OfferRow; onEdit?: (offer: OfferRow) => void; onDelete?: (offer: OfferRow) => void }) {
  const { t } = useLocale()
  const { theme: THEME } = useAppTheme()
  const title = offer.titre || offer.title || t("projects_no_title")
  const active = offer.is_active === undefined || offer.is_active === null || offer.is_active === true || offer.is_active === 1

  return (
    <GlassCard plain contentClassName="p-4" style={{ backgroundColor: "transparent" }}>
      <View className="flex-row items-start justify-between gap-3">
        <View className="min-w-0 flex-1">
          <Text className="text-lg font-black text-foreground" numberOfLines={2}>
            {title}
          </Text>
          <View className="mt-2 flex-row flex-wrap items-center gap-2">
            {offer.type ? (
              <View className="rounded-full border px-2.5 py-1" style={{ borderColor: THEME.border }}>
                <Text className="text-xs font-bold uppercase text-muted-foreground">{offer.type}</Text>
              </View>
            ) : null}
            <View
              className="rounded-full border px-2.5 py-1"
              style={{
                borderColor: active ? "rgba(52, 211, 153, 0.5)" : "rgba(248, 113, 113, 0.5)",
                backgroundColor: active ? "rgba(52, 211, 153, 0.10)" : "rgba(248, 113, 113, 0.10)",
              }}
            >
              <Text className="text-xs font-bold" style={{ color: active ? "#059669" : "#DC2626" }}>
                {active ? "Active" : "Inactive"}
              </Text>
            </View>
          </View>
        </View>
        <BriefcaseBusiness size={24} color={THEME.primary} />
      </View>

      {offer.lieu ? (
        <View className="mt-3 flex-row items-center gap-2">
          <MapPin size={15} color={THEME.muted} />
          <Text className="text-sm text-muted-foreground">{offer.lieu}</Text>
        </View>
      ) : null}

      {offer.description ? (
        <Text className="mt-3 text-sm leading-5 text-muted-foreground" numberOfLines={4}>
          {offer.description}
        </Text>
      ) : null}

      {offer.skills?.length ? (
        <View className="mt-4 flex-row flex-wrap gap-2">
          {offer.skills.map((skill) => {
            const label = getSkillLabel(skill)
            if (!label) return null
            return (
              <View key={`${offer.id}-${skill.id}`} className="rounded-lg border px-2.5 py-1.5" style={{ borderColor: THEME.border }}>
                <Text className="text-xs font-semibold text-muted-foreground">{label}</Text>
              </View>
            )
          })}
        </View>
      ) : null}

      <View className="mt-4 flex-row gap-3">
        <TouchableOpacity
          activeOpacity={0.86}
          onPress={() => onEdit?.(offer)}
          className="flex-1 items-center rounded-xl border px-3 py-3"
          style={{ borderColor: THEME.primary, backgroundColor: "rgba(157, 123, 255, 0.10)" }}
        >
          <Text className="text-sm font-bold" style={{ color: THEME.primary }}>
            Modifier
          </Text>
        </TouchableOpacity>
        <TouchableOpacity
          activeOpacity={0.86}
          onPress={() => onDelete?.(offer)}
          className="flex-1 items-center rounded-xl border px-3 py-3"
          style={{ borderColor: "rgba(220, 38, 38, 0.24)", backgroundColor: "rgba(248, 113, 113, 0.10)" }}
        >
          <Text className="text-sm font-bold" style={{ color: "#DC2626" }}>
            Supprimer
          </Text>
        </TouchableOpacity>
      </View>
    </GlassCard>
  )
}

export function RecruiterOffers() {
  const { theme: THEME } = useAppTheme()
  const tabBarHeight = useBottomTabBarHeight()
  const [offers, setOffers] = useState<OfferRow[]>([])
  const [loading, setLoading] = useState(true)
  const [refreshing, setRefreshing] = useState(false)
  const [skills, setSkills] = useState<SkillOption[]>([])
  const [loadingSkills, setLoadingSkills] = useState(true)
  const [editModalVisible, setEditModalVisible] = useState(false)
  const [editOffer, setEditOffer] = useState<OfferRow | null>(null)
  const [editTitle, setEditTitle] = useState("")
  const [editDescription, setEditDescription] = useState("")
  const [editType, setEditType] = useState<"stage" | "emploi">("stage")
  const [editLocation, setEditLocation] = useState("")
  const [editSelectedSkillIds, setEditSelectedSkillIds] = useState<number[]>([])
  const [submittingEdit, setSubmittingEdit] = useState(false)

  const fetchOffers = useCallback(async (mode: "initial" | "refresh" = "initial") => {
    if (mode === "refresh") setRefreshing(true)
    else setLoading(true)
    try {
      const response = await api.get("/offres")
      setOffers(unwrapData<OfferRow[]>(response.data, []))
    } catch {
      setOffers([])
    } finally {
      if (mode === "refresh") setRefreshing(false)
      else setLoading(false)
    }
  }, [])

  useEffect(() => {
    void fetchOffers()
  }, [fetchOffers])

  useEffect(() => {
    let mounted = true
    async function fetchSkills() {
      setLoadingSkills(true)
      try {
        const response = await api.get("/all-skills")
        const rows = unwrapData<SkillOption[]>(response.data, [])
        if (mounted) {
          setSkills(rows.filter((skill) => skill.id && getSkillLabel(skill)))
        }
      } catch {
        if (mounted) {
          setSkills([])
        }
      } finally {
        if (mounted) {
          setLoadingSkills(false)
        }
      }
    }
    void fetchSkills()
    return () => {
      mounted = false
    }
  }, [])

  const openEditOffer = useCallback((offer: OfferRow) => {
    setEditOffer(offer)
    setEditTitle(offer.titre || offer.title || "")
    setEditDescription(offer.description || "")
    setEditType(offer.type === "emploi" ? "emploi" : "stage")
    setEditLocation(offer.lieu || "")
    setEditSelectedSkillIds((offer.skills ?? []).map((skill) => skill.id).filter(Boolean) as number[])
    setEditModalVisible(true)
  }, [])

  const closeEditModal = useCallback(() => {
    setEditModalVisible(false)
    setEditOffer(null)
    setEditTitle("")
    setEditDescription("")
    setEditType("stage")
    setEditLocation("")
    setEditSelectedSkillIds([])
  }, [])

  const toggleEditSkill = useCallback((skillId: number) => {
    setEditSelectedSkillIds((current) =>
      current.includes(skillId) ? current.filter((id) => id !== skillId) : [...current, skillId]
    )
  }, [])

  const submitEditOffer = useCallback(async () => {
    if (!editOffer) return
    if (!editTitle.trim() || editSelectedSkillIds.length === 0) {
      Alert.alert("Offre incomplete", "Ajoutez un titre et au moins une competence.")
      return
    }

    setSubmittingEdit(true)
    try {
      const response = await api.put(`/offres/${editOffer.id}`, {
        titre: editTitle.trim(),
        description: editDescription.trim() || null,
        type: editType,
        lieu: editLocation.trim() || null,
        skill_ids: editSelectedSkillIds,
      })
      const updatedOffer = unwrapData<OfferRow>(response.data, editOffer)
      setOffers((current) => current.map((offer) => (offer.id === updatedOffer.id ? updatedOffer : offer)))
      closeEditModal()
      Alert.alert("Offre modifiée", "Les modifications ont été enregistrées.")
    } catch {
      Alert.alert("Erreur", "Impossible de modifier cette offre pour le moment.")
    } finally {
      setSubmittingEdit(false)
    }
  }, [editDescription, editLocation, editOffer, editSelectedSkillIds, editTitle, editType, closeEditModal])

  const deleteOffer = useCallback(async (offer: OfferRow) => {
    try {
      await api.delete(`/offres/${offer.id}`)
      setOffers((current) => current.filter((item) => item.id !== offer.id))
      Alert.alert("Offre supprimee", "L'offre a ete supprimee avec succes.")
    } catch {
      Alert.alert("Erreur", "Impossible de supprimer cette offre pour le moment.")
    }
  }, [])

  const confirmDeleteOffer = useCallback((offer: OfferRow) => {
    Alert.alert(
      "Supprimer l'offre",
      "Voulez-vous vraiment supprimer cette offre ? Cette action est definitive.",
      [
        { text: "Annuler", style: "cancel" },
        { text: "Supprimer", style: "destructive", onPress: () => void deleteOffer(offer) },
      ]
    )
  }, [deleteOffer])

  return (
    <>
      <Modal visible={editModalVisible} transparent animationType="slide" onRequestClose={closeEditModal}>
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
            <ScrollView contentContainerStyle={{ padding: 18, paddingBottom: 34 }}>
              <View className="mb-5 flex-row items-center justify-between">
                <Text className="text-lg font-black text-foreground">Modifier l{"'"}offre</Text>
                <TouchableOpacity onPress={closeEditModal} className="rounded-full bg-card p-2" activeOpacity={0.85}>
                  <Text className="text-base font-bold text-foreground">✕</Text>
                </TouchableOpacity>
              </View>

              <GlassCard plain contentClassName="gap-4 p-4" style={{ backgroundColor: "transparent" }}>
                <View>
                  <Text className="mb-2 text-xs font-bold uppercase tracking-[0.14em] text-muted-foreground">Titre</Text>
                  <TextInput
                    value={editTitle}
                    onChangeText={setEditTitle}
                    placeholder="Titre de l'offre"
                    placeholderTextColor="rgba(163, 174, 208, 0.72)"
                    className="border px-4 py-3 text-sm text-foreground"
                    style={{ borderRadius: 12, borderColor: THEME.border, backgroundColor: THEME.mutedSurface }}
                  />
                </View>

                <View>
                  <Text className="mb-2 text-xs font-bold uppercase tracking-[0.14em] text-muted-foreground">Type</Text>
                  <View className="flex-row gap-2">
                    {(["stage", "emploi"] as const).map((value) => (
                      <TouchableOpacity
                        key={value}
                        activeOpacity={0.86}
                        onPress={() => setEditType(value)}
                        className="flex-1 items-center border px-4 py-3"
                        style={{
                          borderRadius: 12,
                          borderColor: editType === value ? THEME.primary : THEME.border,
                          backgroundColor: editType === value ? "rgba(157, 123, 255, 0.18)" : THEME.mutedSurface,
                        }}
                      >
                        <Text className="text-sm font-bold" style={{ color: editType === value ? THEME.primary : THEME.foreground }}>
                          {value === "stage" ? "Stage" : "Emploi"}
                        </Text>
                      </TouchableOpacity>
                    ))}
                  </View>
                </View>

                <View>
                  <Text className="mb-2 text-xs font-bold uppercase tracking-[0.14em] text-muted-foreground">Lieu</Text>
                  <TextInput
                    value={editLocation}
                    onChangeText={setEditLocation}
                    placeholder="Lieu de l'offre"
                    placeholderTextColor="rgba(163, 174, 208, 0.72)"
                    className="border px-4 py-3 text-sm text-foreground"
                    style={{ borderRadius: 12, borderColor: THEME.border, backgroundColor: THEME.mutedSurface }}
                  />
                </View>

                <View>
                  <Text className="mb-2 text-xs font-bold uppercase tracking-[0.14em] text-muted-foreground">Description</Text>
                  <TextInput
                    value={editDescription}
                    onChangeText={setEditDescription}
                    placeholder="Description de l'offre"
                    placeholderTextColor="rgba(163, 174, 208, 0.72)"
                    className="border px-4 py-3 text-sm text-foreground"
                    style={{ minHeight: 118, borderRadius: 12, borderColor: THEME.border, backgroundColor: THEME.mutedSurface, textAlignVertical: "top" }}
                    multiline
                  />
                </View>

                <View>
                  <Text className="mb-2 text-xs font-bold uppercase tracking-[0.14em] text-muted-foreground">Competences</Text>
                  {loadingSkills ? (
                    <View className="items-center gap-2 py-5">
                      <ActivityIndicator color={THEME.primary} />
                      <Text className="text-sm text-muted-foreground">Chargement des competences...</Text>
                    </View>
                  ) : (
                    <View className="flex-row flex-wrap gap-2">
                      {skills.map((skill) => {
                        const label = getSkillLabel(skill)
                        return (
                          <SkillChip
                            key={`edit-skill-${skill.id}`}
                            label={label}
                            active={editSelectedSkillIds.includes(skill.id)}
                            onPress={() => toggleEditSkill(skill.id)}
                          />
                        )
                      })}
                    </View>
                  )}
                </View>

                <TouchableOpacity
                  activeOpacity={0.88}
                  onPress={submitEditOffer}
                  disabled={submittingEdit}
                  className="mt-2 flex-row items-center justify-center gap-2 rounded-xl px-4 py-3"
                  style={{ backgroundColor: submittingEdit ? "rgba(148, 163, 184, 0.28)" : THEME.primary }}
                >
                  {submittingEdit ? <ActivityIndicator color="#FFFFFF" /> : <Text className="text-sm font-black text-white">Enregistrer</Text>}
                </TouchableOpacity>
              </GlassCard>
            </ScrollView>
          </View>
        </View>
      </Modal>
      <ScrollView
        className="flex-1 px-4 pt-6"
        contentContainerStyle={{ paddingBottom: tabBarHeight + SCROLL_EXTRA_BELOW_TAB_BAR }}
        refreshControl={
          <RefreshControl refreshing={refreshing} onRefresh={() => void fetchOffers("refresh")} tintColor={THEME.primary} />
        }
        showsVerticalScrollIndicator={false}
      >
      <View className="mb-6">
        <Text className="text-2xl font-black text-foreground">Offres publiees</Text>
        <Text className="mt-2 text-sm leading-5 text-muted-foreground" style={{ opacity: 0.78 }}>
          Retrouvez toutes les offres ajoutees par votre espace recruteur.
        </Text>
      </View>

      <View className="mb-4 flex-row items-center justify-between">
        <Text className="text-lg font-bold text-foreground">Toutes les offres</Text>
        <Text className="text-sm font-semibold text-muted-foreground">{offers.length} offre{offers.length > 1 ? "s" : ""}</Text>
      </View>

      {loading ? (
        <GlassCard plain contentClassName="items-center gap-3 py-8">
          <ActivityIndicator color={THEME.primary} />
          <Text className="text-sm text-muted-foreground">Chargement des offres...</Text>
        </GlassCard>
      ) : offers.length === 0 ? (
        <GlassCard plain contentClassName="items-center gap-3 px-4 py-8">
          <BriefcaseBusiness size={28} color={THEME.muted} />
          <Text className="text-center text-sm leading-5 text-muted-foreground">Aucune offre publiee pour le moment.</Text>
        </GlassCard>
      ) : (
        <View className="gap-4">
          {offers.map((offer) => (
            <OfferCard
              key={`offer-${offer.id}`}
              offer={offer}
              onEdit={openEditOffer}
              onDelete={confirmDeleteOffer}
            />
          ))}
        </View>
      )}
    </ScrollView>
    </>
  )
}

export function RecruiterAddOffer() {
  const { theme: THEME } = useAppTheme()
  const tabBarHeight = useBottomTabBarHeight()
  const [title, setTitle] = useState("")
  const [description, setDescription] = useState("")
  const [type, setType] = useState<"stage" | "emploi">("stage")
  const [location, setLocation] = useState("")
  const [skills, setSkills] = useState<SkillOption[]>([])
  const [selectedSkillIds, setSelectedSkillIds] = useState<number[]>([])
  const [loadingSkills, setLoadingSkills] = useState(true)
  const [submitting, setSubmitting] = useState(false)

  const canSubmit = useMemo(
    () => title.trim().length > 0 && selectedSkillIds.length > 0 && !submitting,
    [selectedSkillIds.length, submitting, title]
  )

  useEffect(() => {
    let mounted = true
    async function fetchSkills() {
      setLoadingSkills(true)
      try {
        const response = await api.get("/all-skills")
        const rows = unwrapData<SkillOption[]>(response.data, [])
        if (mounted) setSkills(rows.filter((skill) => skill.id && getSkillLabel(skill)))
      } catch {
        if (mounted) setSkills([])
      } finally {
        if (mounted) setLoadingSkills(false)
      }
    }
    void fetchSkills()
    return () => {
      mounted = false
    }
  }, [])

  const toggleSkill = (skillId: number) => {
    setSelectedSkillIds((current) =>
      current.includes(skillId)
        ? current.filter((id) => id !== skillId)
        : [...current, skillId]
    )
  }

  const resetForm = () => {
    setTitle("")
    setDescription("")
    setType("stage")
    setLocation("")
    setSelectedSkillIds([])
  }

  const submitOffer = async () => {
    if (!canSubmit) {
      Alert.alert("Offre incomplete", "Ajoutez un titre et au moins une competence.")
      return
    }

    setSubmitting(true)
    try {
      await api.post("/offres", {
        titre: title.trim(),
        description: description.trim() || null,
        type,
        lieu: location.trim() || null,
        is_active: true,
        skill_ids: selectedSkillIds,
      })
      resetForm()
      Alert.alert("Offre ajoutee", "Votre offre a ete publiee avec succes.")
    } catch {
      Alert.alert("Erreur", "Impossible d'ajouter cette offre pour le moment.")
    } finally {
      setSubmitting(false)
    }
  }

  return (
    <ScrollView
      className="flex-1 px-4 pt-6"
      contentContainerStyle={{ paddingBottom: tabBarHeight + SCROLL_EXTRA_BELOW_TAB_BAR }}
      keyboardShouldPersistTaps="handled"
      showsVerticalScrollIndicator={false}
    >
      <View className="mb-6">
        <Text className="text-2xl font-black text-foreground">Ajouter une offre</Text>
        <Text className="mt-2 text-sm leading-5 text-muted-foreground" style={{ opacity: 0.78 }}>
          Publiez une offre de stage ou emploi pour les candidats.
        </Text>
      </View>

      <GlassCard plain contentClassName="gap-4 p-4" style={{ backgroundColor: "transparent" }}>
        <View>
          <Text className="mb-2 text-xs font-bold uppercase tracking-[0.14em] text-muted-foreground">Titre</Text>
          <TextInput
            value={title}
            onChangeText={setTitle}
            placeholder="Developpeur React Native stagiaire"
            placeholderTextColor="rgba(163, 174, 208, 0.72)"
            className="border px-4 py-3 text-sm text-foreground"
            style={{ borderRadius: 12, borderColor: THEME.border, backgroundColor: THEME.mutedSurface }}
          />
        </View>

        <View>
          <Text className="mb-2 text-xs font-bold uppercase tracking-[0.14em] text-muted-foreground">Type</Text>
          <View className="flex-row gap-2">
            {(["stage", "emploi"] as const).map((value) => (
              <TouchableOpacity
                key={value}
                activeOpacity={0.86}
                onPress={() => setType(value)}
                className="flex-1 items-center border px-4 py-3"
                style={{
                  borderRadius: 12,
                  borderColor: type === value ? THEME.primary : THEME.border,
                  backgroundColor: type === value ? "rgba(157, 123, 255, 0.18)" : THEME.mutedSurface,
                }}
              >
                <Text className="text-sm font-bold" style={{ color: type === value ? THEME.primary : THEME.foreground }}>
                  {value === "stage" ? "Stage" : "Emploi"}
                </Text>
              </TouchableOpacity>
            ))}
          </View>
        </View>

        <View>
          <Text className="mb-2 text-xs font-bold uppercase tracking-[0.14em] text-muted-foreground">Lieu</Text>
          <TextInput
            value={location}
            onChangeText={setLocation}
            placeholder="Tunis, Sfax, Remote..."
            placeholderTextColor="rgba(163, 174, 208, 0.72)"
            className="border px-4 py-3 text-sm text-foreground"
            style={{ borderRadius: 12, borderColor: THEME.border, backgroundColor: THEME.mutedSurface }}
          />
        </View>

        <View>
          <Text className="mb-2 text-xs font-bold uppercase tracking-[0.14em] text-muted-foreground">Description</Text>
          <TextInput
            value={description}
            onChangeText={setDescription}
            placeholder="Mission, profil recherche, technologies..."
            placeholderTextColor="rgba(163, 174, 208, 0.72)"
            className="border px-4 py-3 text-sm text-foreground"
            style={{ minHeight: 118, borderRadius: 12, borderColor: THEME.border, backgroundColor: THEME.mutedSurface, textAlignVertical: "top" }}
            multiline
          />
        </View>

        <View>
          <Text className="mb-2 text-xs font-bold uppercase tracking-[0.14em] text-muted-foreground">Competences</Text>
          {loadingSkills ? (
            <View className="items-center gap-2 py-5">
              <ActivityIndicator color={THEME.primary} />
              <Text className="text-sm text-muted-foreground">Chargement des competences...</Text>
            </View>
          ) : (
            <View className="flex-row flex-wrap gap-2">
              {skills.map((skill) => {
                const label = getSkillLabel(skill)
                return (
                  <SkillChip
                    key={`skill-${skill.id}`}
                    label={label}
                    active={selectedSkillIds.includes(skill.id)}
                    onPress={() => toggleSkill(skill.id)}
                  />
                )
              })}
            </View>
          )}
        </View>

        <TouchableOpacity
          activeOpacity={0.88}
          onPress={submitOffer}
          disabled={!canSubmit}
          className="mt-2 flex-row items-center justify-center gap-2 px-4 py-3"
          style={{
            borderRadius: 12,
            backgroundColor: canSubmit ? THEME.primary : "rgba(148, 163, 184, 0.28)",
          }}
        >
          {submitting ? <ActivityIndicator color="#FFFFFF" /> : <PlusCircle size={18} color="#FFFFFF" />}
          <Text className="text-sm font-black text-white">{submitting ? "Publication..." : "Publier l'offre"}</Text>
        </TouchableOpacity>
      </GlassCard>
    </ScrollView>
  )
}
