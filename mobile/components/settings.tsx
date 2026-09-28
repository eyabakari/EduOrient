/**
 * @file Paramètres : compte, préférences (notif, thème, langue), aide, déconnexion — sync partielle API Laravel.
 */
import { useCallback, useEffect, useMemo, useState } from "react"
import { Alert } from "react-native"
import { ArrowLeft, User, Bell, Moon, Shield, HelpCircle, LogOut, ChevronRight, Check } from "lucide-react-native"
import { useAuth } from "@/context/auth-context"
import { ScrollView, View, Text, TouchableOpacity, Switch, TextInput, ActivityIndicator, Modal } from "react-native"
import { GlassCard } from "./glass-card"
import { useAppTheme } from "@/context/app-theme-context"
import { useBottomTabBarHeight } from "@/hooks/use-bottom-tab-bar-height"
import { api } from "@/lib/api"
import { ensureNotificationPermission } from "@/lib/notification-permission"
import {
  readNotificationPreference,
  writeNotificationPreference,
} from "@/lib/notification-preference-storage"

interface SettingsProps {
  onBack: () => void
  onLogout: () => void
  onEditProfile: () => void
  onChangePassword: () => void
  onHelpFaq: () => void
}

const SCROLL_EXTRA_BELOW_TAB_BAR = 24

export function Settings({
  onBack,
  onLogout,
  onEditProfile,
  onChangePassword,
  onHelpFaq,
}: SettingsProps) {
  const tabBarHeight = useBottomTabBarHeight()
  const { isDark, setIsDark, theme: THEME } = useAppTheme()
  const { user, updateUser } = useAuth()
  const etu = user?.candidat 
  const roleName = String(user?.role?.name ?? "").trim().toLowerCase()
  const isRecruiter = roleName === "recruteur"
  const isStudent = roleName === "candidat" || Boolean(etu)
  const showStudentLayout = isStudent && !isRecruiter
  const [notifications, setNotifications] = useState(true)
  const [profileVisible, setProfileVisible] = useState(Boolean(etu?.portfolio_public))
  const [errorMessage, setErrorMessage] = useState<string | null>(null)

  const loadSettings = useCallback(async () => {
    setErrorMessage(null)

    try {
      await api.get("/profile/settings")
    } catch {
      setErrorMessage("Impossible de charger les paramètres pour le moment.")
    }
  }, [])

  useEffect(() => {
    void loadSettings()
  }, [loadSettings])

  useEffect(() => {
    void (async () => {
      try {
        const stored = await readNotificationPreference()
        if (stored !== null) setNotifications(stored)
      } catch {
        /* */
      }
    })()
  }, [])

  useEffect(() => {
    setProfileVisible(Boolean(etu?.portfolio_public))
  }, [etu?.portfolio_public])

  const savePreferences = useCallback(
    async (nextNotifications: boolean, nextDarkMode: boolean) => {
      setErrorMessage(null)

      await api.put("/profile/settings", {
        preferences: {
          general: {
            theme: nextDarkMode ? "dark" : "light",
            langue: "fr",
          },
          notifications: {
            enabled: nextNotifications,
          },
        },
      })
    },
    []
  )

  const handleToggleNotifications = useCallback(async () => {
    const previous = notifications
    const next = !previous

    if (next) {
      const ok = await ensureNotificationPermission()
      if (!ok) {
        Alert.alert("Autorisation requise", "Autorisez l'accès aux notifications pour activer cette option.")
        return
      }
    }

    setNotifications(next)
    try {
      await writeNotificationPreference(next)
      await savePreferences(next, isDark)
    } catch {
      setNotifications(previous)
      setErrorMessage("Impossible d'enregistrer le choix des notifications.")
    }
  }, [isDark, notifications, savePreferences])

  const handleToggleDarkMode = useCallback(async () => {
    const next = !isDark
    const previous = isDark
    setIsDark(next)

    try {
      await savePreferences(notifications, next)
    } catch {
      setIsDark(previous)
      setErrorMessage("Impossible d'enregistrer le thème.")
    }
  }, [isDark, notifications, savePreferences, setIsDark])

  const handleToggleProfileVisibility = useCallback(async () => {
    if (!user) return
    const next = !profileVisible
    setProfileVisible(next)
    try {
      await api.put("/profile", {
        portfolio_public: next,
      })
      updateUser({
        ...user,
        candidat: user.candidat
          ? {
              ...user.candidat,
              portfolio_public: next,
            }
          : user.candidat ,
      })
    } catch {
      setProfileVisible(!next)
      setErrorMessage("Impossible de modifier la visibilité du profil.")
    }
  }, [profileVisible, updateUser, user])

  // --- Recruiter settings: profile modal & security ---
  const [editModalVisible, setEditModalVisible] = useState(false)

  // Profile fields
  const [firstName, setFirstName] = useState((user as any)?.prenom || "")
  const [lastName, setLastName] = useState((user as any)?.nom || "")
  const [emailField, setEmailField] = useState(user?.email || "")

  const [companyName, setCompanyName] = useState((user as any)?.recruteur?.entreprise || (user as any)?.company?.name || "")
  const [companyCity, setCompanyCity] = useState((user as any)?.company?.ville || "")
  const [companyGov, setCompanyGov] = useState((user as any)?.company?.gouvernorat || "")
  const [companyDesc, setCompanyDesc] = useState((user as any)?.company?.description || "")
  const [companyRole, setCompanyRole] = useState((user as any)?.recruteur?.poste || "")
  const [companyWebsite, setCompanyWebsite] = useState((user as any)?.recruteur?.site_web || "")

  // skills multi-select
  type SkillOption = { id: number; nom?: string | null; name?: string | null }
  const [skillsOptions, setSkillsOptions] = useState<SkillOption[]>([])
  const [loadingSkills, setLoadingSkills] = useState(true)
  const [selectedSkillIds, setSelectedSkillIds] = useState<number[]>(((user as any)?.recruteur?.skills as Array<{ id: number }> )?.map((skill) => skill.id) ?? [])

  // simple Skill chip (local)
  function SkillChipLocal({ label, active, onPress }: { label: string; active: boolean; onPress: () => void }) {
    return (
      <TouchableOpacity
        activeOpacity={0.86}
        onPress={onPress}
        className="flex-row items-center gap-1.5 border px-3 py-2"
        style={{ borderRadius: 999, borderColor: active ? THEME.primary : "rgba(148, 163, 184, 0.24)", backgroundColor: active ? "rgba(157, 123, 255, 0.18)" : "rgba(148, 163, 184, 0.10)" }}
      >
        <Text className="text-xs font-semibold" style={{ color: active ? THEME.primary : THEME.muted }}>
          {label}
        </Text>
      </TouchableOpacity>
    )
  }

  useEffect(() => {
    let mounted = true
    async function loadSkills() {
      setLoadingSkills(true)
      try {
        const res = await api.get("/all-skills")
        const rows = (res?.data?.data ?? []) as SkillOption[]
        if (mounted) setSkillsOptions(rows.filter((s) => (s.nom || s.name)))
      } catch {
        if (mounted) setSkillsOptions([])
      } finally {
        if (mounted) setLoadingSkills(false)
      }
    }
    void loadSkills()
    return () => {
      mounted = false
    }
  }, [])

  const toggleSelectSkill = useCallback((id: number) => {
    setSelectedSkillIds((cur) => (cur.includes(id) ? cur.filter((x) => x !== id) : [...cur, id]))
  }, [])

  const [savingProfile, setSavingProfile] = useState(false)
  const saveProfile = useCallback(async () => {
    setSavingProfile(true)
    try {
      const fullName = [firstName, lastName].filter(Boolean).join(" ").trim()
      const payload: Record<string, unknown> = {
        name: fullName || undefined,
        entreprise: companyName || undefined,
        poste: companyRole || undefined,
        site_web: companyWebsite || undefined,
        ville: companyCity || undefined,
        gouvernorat: companyGov || undefined,
        company_description: companyDesc || undefined,
        skill_ids: selectedSkillIds,
      }

      const { data } = await api.put<{ user: unknown }>("/profile", payload)
      if (data?.user) {
        await updateUser(data.user as any)
      }
      Alert.alert("OK", "Profil mis à jour")
    } catch (e) {
      Alert.alert("Erreur", "Impossible d'enregistrer le profil pour le moment.")
    } finally {
      setSavingProfile(false)
    }
  }, [companyCity, companyDesc, companyGov, companyName, companyRole, companyWebsite, firstName, lastName, selectedSkillIds, updateUser])

  // Security
  const [currentPassword, setCurrentPassword] = useState("")
  const [newPassword, setNewPassword] = useState("")
  const [confirmPassword, setConfirmPassword] = useState("")
  const [savingPassword, setSavingPassword] = useState(false)

  const savePassword = useCallback(async () => {
    if (!currentPassword || !newPassword || newPassword !== confirmPassword) {
      Alert.alert("Erreur", "Vérifiez les champs de mot de passe")
      return
    }
    setSavingPassword(true)
    try {
      await api.put("/password/update", {
        current_password: currentPassword,
        password: newPassword,
        password_confirmation: confirmPassword,
      })
      Alert.alert("OK", "Mot de passe mis à jour")
      setCurrentPassword("")
      setNewPassword("")
      setConfirmPassword("")
    } catch (e) {
      Alert.alert("Erreur", "Impossible de mettre à jour le mot de passe")
    } finally {
      setSavingPassword(false)
    }
  }, [currentPassword, newPassword, confirmPassword])

  const [showGovModal, setShowGovModal] = useState(false)

  // Sync form values when authenticated user changes
  useEffect(() => {
    const u = user as any
    if (!u) return
    const fullName = u.prenom ?? u.first_name ?? u.name ?? ""
    const [first, ...rest] = String(fullName).trim().split(" ")

    setFirstName(u.prenom ?? u.first_name ?? first ?? "")
    setLastName(u.nom ?? u.last_name ?? rest.join(" ") ?? "")
    setEmailField(u.email ?? "")
    setCompanyName(u.recruteur?.entreprise ?? u.company?.name ?? "")
    setCompanyCity(u.company?.ville ?? "")
    setCompanyGov(u.company?.gouvernorat ?? "")
    setCompanyDesc(u.company?.description ?? "")
    setCompanyRole(u.recruteur?.poste ?? "")
    setCompanyWebsite(u.recruteur?.site_web ?? "")
    setSelectedSkillIds((u.recruteur?.skills ?? []).map((skill: any) => skill.id) ?? [])
  }, [user])

  // Reset form when modal opens (force re-sync)
  useEffect(() => {
    if (editModalVisible) {
      const u = user as any
      if (u) {
        const fullName = u.prenom ?? u.first_name ?? u.name ?? ""
        const [first, ...rest] = String(fullName).trim().split(" ")
        setFirstName(u.prenom ?? u.first_name ?? first ?? "")
        setLastName(u.nom ?? u.last_name ?? rest.join(" ") ?? "")
        setEmailField(u.email ?? "")
        setCompanyName(u.recruteur?.entreprise ?? u.company?.name ?? "")
        setCompanyCity(u.company?.ville ?? "")
        setCompanyGov(u.company?.gouvernorat ?? "")
        setCompanyDesc(u.company?.description ?? "")
        setCompanyRole(u.recruteur?.poste ?? "")
        setCompanyWebsite(u.recruteur?.site_web ?? "")
        setSelectedSkillIds((u.recruteur?.skills ?? []).map((skill: any) => skill.id) ?? [])
      }
    }
  }, [editModalVisible, user])

  const settingsGroups = useMemo(() => {
    const groups: Array<any> = [
      {
        title: "Compte",
        items: [
          {
            icon: User,
            label: "Modifier le profil",
            action: onEditProfile,
            type: "link" as const,
          },
          {
            icon: Shield,
            label: "Sécurité",
            action: onChangePassword,
            type: "link" as const,
          },
        ],
      },
    ]

    if (isStudent) {
      groups.push({
        title: "Confidentialité",
        items: [
          {
            icon: Shield,
            label: "Visibilité du profil",
            action: handleToggleProfileVisibility,
            type: "toggle" as const,
            value: profileVisible,
          },
        ],
      })
    }

    // Preferences: hide notifications toggle for recruiter role
    const prefItems: Array<any> = []
    if (!isRecruiter) {
      prefItems.push({
        icon: Bell,
        label: "Notifications",
        action: handleToggleNotifications,
        type: "toggle" as const,
        value: notifications,
      })
    }
    prefItems.push({
      icon: Moon,
      label: "Mode Sombre",
      action: handleToggleDarkMode,
      type: "toggle" as const,
      value: isDark,
    })

    groups.push({
      title: "Préférences",
      items: prefItems,
    },
      {
        title: "Assistance",
        items: [
          {
            icon: HelpCircle,
            label: "Aide & FAQ",
            action: onHelpFaq,
            type: "link" as const,
          },
        ],
      }
    )

    return groups
  }, [
    notifications,
    isDark,
    onEditProfile,
    onChangePassword,
    onHelpFaq,
    handleToggleNotifications,
    handleToggleDarkMode,
    isStudent,
    profileVisible,
    handleToggleProfileVisibility,
  ])

  return (
    <ScrollView
      className="flex-1 px-4 pt-6"
      contentContainerStyle={{
        paddingBottom: tabBarHeight + SCROLL_EXTRA_BELOW_TAB_BAR,
      }}
    >
      <View className="mb-6 flex-row items-center gap-3">
        <TouchableOpacity
          onPress={onBack}
          className="rounded-2xl border border-border/60 p-2.5"
          style={{ backgroundColor: THEME.mutedSurface }}
          activeOpacity={0.85}
        >
          <ArrowLeft size={22} color={THEME.foreground} />
        </TouchableOpacity>
        <Text className="text-3xl font-bold tracking-tight text-foreground">
          Paramètres
        </Text>
      </View>

      <View className="gap-6">
        {errorMessage ? (
          <GlassCard>
            <Text className="text-sm text-rose-300">{errorMessage}</Text>
          </GlassCard>
        ) : null}

        {showStudentLayout ? (
          <>
            <GlassCard>
              <TouchableOpacity
                onPress={onEditProfile}
                activeOpacity={0.85}
                className="flex-row items-center justify-between px-4 py-4"
              >
                <View className="flex-row items-center gap-3">
                  <View className="rounded-lg p-3" style={{ backgroundColor: `${THEME.card}99` }}>
                    <User size={20} color={THEME.foreground} />
                  </View>
                  <Text className="text-base font-semibold text-foreground">Modifier le profil</Text>
                </View>
                <ChevronRight size={20} color={THEME.muted} />
              </TouchableOpacity>
            </GlassCard>

            <GlassCard>
              <Text className="mb-3 text-sm font-bold">Sécurité</Text>
              <View className="gap-3">
                <Text className="text-xs text-muted-foreground">Mot de passe actuel</Text>
                <TextInput
                  value={currentPassword}
                  onChangeText={setCurrentPassword}
                  secureTextEntry
                  placeholder="Mot de passe actuel"
                  className="border px-3 py-2"
                  placeholderTextColor={THEME.muted}
                  style={{
                    borderRadius: 8,
                    borderColor: THEME.border,
                    backgroundColor: isDark ? "rgba(148, 163, 184, 0.12)" : THEME.mutedSurface,
                    color: THEME.foreground,
                  }}
                />

                <Text className="text-xs text-muted-foreground">Nouveau mot de passe</Text>
                <TextInput
                  value={newPassword}
                  onChangeText={setNewPassword}
                  secureTextEntry
                  placeholder="Nouveau mot de passe"
                  className="border px-3 py-2"
                  placeholderTextColor={THEME.muted}
                  style={{
                    borderRadius: 8,
                    borderColor: THEME.border,
                    backgroundColor: isDark ? "rgba(148, 163, 184, 0.12)" : THEME.mutedSurface,
                    color: THEME.foreground,
                  }}
                />

                <Text className="text-xs text-muted-foreground">Confirmer le mot de passe</Text>
                <TextInput
                  value={confirmPassword}
                  onChangeText={setConfirmPassword}
                  secureTextEntry
                  placeholder="Confirmer le mot de passe"
                  className="border px-3 py-2"
                  placeholderTextColor={THEME.muted}
                  style={{
                    borderRadius: 8,
                    borderColor: THEME.border,
                    backgroundColor: isDark ? "rgba(148, 163, 184, 0.12)" : THEME.mutedSurface,
                    color: THEME.foreground,
                  }}
                />

                <TouchableOpacity
                  activeOpacity={0.9}
                  onPress={savePassword}
                  className="mt-2 items-center rounded-xl px-4 py-3"
                  style={{ backgroundColor: THEME.primary }}
                >
                  {savingPassword ? (
                    <ActivityIndicator color="#fff" />
                  ) : (
                    <Text className="text-sm font-black text-white">Enregistrer</Text>
                  )}
                </TouchableOpacity>
              </View>
            </GlassCard>

            <GlassCard>
              <Text className="mb-3 text-sm font-bold">Confidentialité</Text>
              <View className="flex-row items-center justify-between px-4 py-3.5">
                <View className="flex-row items-center gap-3">
                  <View className="rounded-lg p-2" style={{ backgroundColor: `${THEME.card}99` }}>
                    <Shield size={20} color={THEME.foreground} />
                  </View>
                  <View>
                    <Text className="text-foreground">Visibilité du profil</Text>
                    <Text className="text-xs text-muted-foreground">
                      {profileVisible ? "Profil public" : "Profil privé"}
                    </Text>
                  </View>
                </View>
                <Switch
                  value={profileVisible}
                  onValueChange={handleToggleProfileVisibility}
                  trackColor={{ false: THEME.border, true: THEME.accent }}
                  thumbColor={profileVisible ? "#FFFFFF" : "#94A3B8"}
                  ios_backgroundColor={THEME.border}
                />
              </View>
            </GlassCard>

            <GlassCard>
              <Text className="mb-3 text-sm font-bold">Préférences</Text>
              <View className="gap-0">
                    <View className="flex-row items-center justify-between px-4 py-3.5">
                  <View className="flex-row items-center gap-3">
                    <View className="rounded-lg p-2" style={{ backgroundColor: `${THEME.card}99` }}>
                      <Moon size={20} color={THEME.foreground} />
                    </View>
                    <Text className="text-foreground">Mode Sombre</Text>
                  </View>
                  <Switch
                    value={isDark}
                    onValueChange={handleToggleDarkMode}
                    trackColor={{ false: THEME.border, true: THEME.accent }}
                    thumbColor={isDark ? "#FFFFFF" : "#94A3B8"}
                    ios_backgroundColor={THEME.border}
                  />
                </View>
              </View>
            </GlassCard>

            <GlassCard>
              <TouchableOpacity
                onPress={onHelpFaq}
                activeOpacity={0.75}
                className="flex-row items-center justify-between px-4 py-3.5"
              >
                <View className="flex-row items-center gap-3">
                  <View className="rounded-lg p-2" style={{ backgroundColor: `${THEME.card}99` }}>
                    <HelpCircle size={20} color={THEME.foreground} />
                  </View>
                  <Text className="text-foreground">Aide & FAQ</Text>
                </View>
                <ChevronRight size={20} color={THEME.muted} />
              </TouchableOpacity>
            </GlassCard>
          </>
        ) : (
          settingsGroups.map((group, groupIndex) => (
            <View key={groupIndex}>
              <Text className="mb-2 px-1 text-xs font-bold uppercase tracking-[0.14em] text-muted-foreground">
                {group.title}
              </Text>
              <GlassCard contentClassName="overflow-hidden p-0">
                {group.items.map((item: any, itemIndex: number) => {
                  const Icon = item.icon
                  return (
                    <TouchableOpacity
                      key={itemIndex}
                      onPress={item.action}
                      activeOpacity={0.75}
                      className={`flex-row items-center gap-3 border-b px-4 py-3.5 ${
                        itemIndex === group.items.length - 1 ? "border-b-0" : ""
                      }`}
                      style={{ borderBottomColor: "rgba(30, 41, 59, 0.9)" }}
                    >
                      <View
                        className="rounded-lg p-2"
                        style={{ backgroundColor: `${THEME.card}99` }}
                      >
                        <Icon size={20} color={THEME.foreground} />
                      </View>
                      <Text className="flex-1 text-foreground">{item.label}</Text>

                      {item.type === "toggle" && (
                        <Switch
                          value={item.value}
                          onValueChange={item.action}
                          trackColor={{
                            false: THEME.border,
                            true: THEME.accent,
                          }}
                          thumbColor={item.value ? "#FFFFFF" : "#94A3B8"}
                          ios_backgroundColor={THEME.border}
                        />
                      )}

                      {item.type === "select" && (
                        <View className="flex-row items-center gap-1">
                          <Text className="text-sm text-muted-foreground">{item.value}</Text>
                          <ChevronRight size={18} color={THEME.muted} />
                        </View>
                      )}

                      {item.type === "link" ? (
                        <ChevronRight size={20} color={THEME.muted} />
                      ) : null}
                    </TouchableOpacity>
                  )
                })}
              </GlassCard>
            </View>
          ))
        )}


        {showGovModal && (
          <GlassCard>
            <Text className="text-sm font-semibold text-foreground mb-3">Gouvernorat</Text>
            {[
              "Tunis",
              "Ariana",
              "Ben Arous",
              "Manouba",
              "Nabeul",
              "Zaghouan",
              "Bizerte",
              "Beja",
              "Jendouba",
              "Le Kef",
              "Siliana",
              "Sousse",
              "Monastir",
              "Mahdia",
              "Sfax",
              "Kairouan",
              "Kasserine",
              "Sidi Bouzid",
              "Gafsa",
              "Gabes",
              "Mednine",
              "Tataouine",
              "Kebili",
              "Tozeur",
            ].map((g, idx) => (
              <TouchableOpacity key={idx} onPress={() => { setCompanyGov(g); setShowGovModal(false) }} className="flex-row items-center justify-between py-3 px-2 border-b" style={{ borderBottomColor: THEME.border }}>
                <Text className={companyGov === g ? "font-semibold text-foreground" : "text-muted-foreground"}>{g}</Text>
                {companyGov === g ? <Check size={20} color={THEME.accent} /> : null}
              </TouchableOpacity>
            ))}
          </GlassCard>
        )}

        <TouchableOpacity
          onPress={() => void onLogout()}
          className="flex-row items-center justify-center gap-3 rounded-2xl border px-6 py-4"
          style={{
            borderColor: "rgba(248, 113, 113, 0.35)",
            backgroundColor: THEME.dangerMuted,
          }}
        >
          <View
            className="rounded-full p-2"
            style={{ backgroundColor: "rgba(248, 113, 113, 0.2)" }}
          >
            <LogOut size={20} color={THEME.danger} />
          </View>
          <Text className="font-semibold" style={{ color: THEME.danger }}>
            Déconnexion
          </Text>
        </TouchableOpacity>

        <View className="items-center py-4">
          <Text className="text-xs text-muted-foreground">ProLink v1.0.0</Text>
        </View>
      </View>
    </ScrollView>
  )
}
