import { useEffect, useRef, useState } from "react"
import type { ReactNode } from "react"
import {
  ActivityIndicator,
  Alert,
  Image,
  Platform,
  ScrollView,
  Text,
  TextInput,
  TouchableOpacity,
  View,
} from "react-native"
import axios from "axios"
import * as ImagePicker from "expo-image-picker"
import {
  Building2,
  Check,
  Eye,
  EyeOff,
  GraduationCap,
  Lock,
  Mail,
  User,
} from "lucide-react-native"
import { GlassCard } from "./glass-card"
import { AuthTextField } from "./auth-text-field"
import { AuthBrandMark } from "./auth-brand-mark"
import { AuthBackButton } from "./auth-back-button"
import { GradientButton } from "./gradient-button"
import { api } from "@/lib/api"
import { useAppTheme } from "@/context/app-theme-context"
import { ETUDIANT_ROLE_ID, RECRUTEUR_ROLE_ID } from "@/constants/api-config"
import { useAuth } from "@/context/auth-context"

type RegisterRole = "candidat" | "recruteur"

interface RegisterProps {
  onRegisterSuccess: () => void
  onBack: () => void
  onSwitchToLogin: () => void
}

const TUNISIA_GOVERNORATES = [
  "Tunis",
  "Ariana",
  "Ben Arous",
  "Bizerte",
  "Gabès",
  "Gafsa",
  "Jendouba",
  "Kairouan",
  "Kasserine",
  "Kébili",
  "Le Kef",
  "Mahdia",
  "Manouba",
  "Medenine",
  "Monastir",
  "Nabeul",
  "Sfax",
  "Sidi Bouzid",
  "Siliana",
  "Sousse",
  "Tataouine",
  "Tozeur",
  "Zaghouan",
]

const NIVEAU_ETUDES_OPTIONS = ["Bac", "Licence", "Master", "Doctorat", "Autre"]

const OTP_LENGTH = 6

function formatRegisterError(err: unknown): string {
  if (axios.isAxiosError(err)) {
    const data = err.response?.data as
      | { message?: string; errors?: Record<string, string[]> }
      | undefined
    if (data?.errors) {
      const first = Object.values(data.errors).flat()[0]
      if (first) return first
    }
    if (typeof data?.message === "string") return data.message
  }
  if (err instanceof Error) return err.message
  return "Inscription impossible. Réessaie plus tard."
}

function RoleCard({
  active,
  title,
  subtitle,
  icon,
  onPress,
}: {
  active: boolean
  title: string
  subtitle: string
  icon: ReactNode
  onPress: () => void
}) {
  const { theme: THEME } = useAppTheme()
  return (
    <TouchableOpacity
      activeOpacity={0.86}
      onPress={onPress}
      className="flex-1 border p-3"
      style={{
        minHeight: 112,
        borderRadius: 14,
        borderColor: active ? THEME.primary : THEME.border,
        backgroundColor: active ? "rgba(157, 123, 255, 0.16)" : THEME.mutedSurface,
      }}
    >
      <View className="mb-3 flex-row items-center justify-between">
        {icon}
        {active ? <Check size={18} color={THEME.primary} /> : null}
      </View>
      <Text className="text-sm font-black text-foreground">{title}</Text>
      <Text className="mt-1 text-xs leading-4 text-muted-foreground">{subtitle}</Text>
    </TouchableOpacity>
  )
}

function ChoiceChips({
  value,
  options,
  onChange,
}: {
  value: string
  options: string[]
  onChange: (value: string) => void
}) {
  const { theme: THEME } = useAppTheme()
  return (
    <View className="flex-row flex-wrap gap-2">
      {options.map((option) => {
        const active = value === option
        return (
          <TouchableOpacity
            key={option}
            activeOpacity={0.84}
            onPress={() => onChange(option)}
            className="border px-3 py-2"
            style={{
              borderRadius: 999,
              borderColor: active ? THEME.primary : THEME.border,
              backgroundColor: active ? "rgba(157, 123, 255, 0.16)" : "rgba(148, 163, 184, 0.10)",
            }}
          >
            <Text className="text-xs font-semibold" style={{ color: active ? THEME.primary : THEME.muted }}>
              {option}
            </Text>
          </TouchableOpacity>
        )
      })}
    </View>
  )
}

export function Register({
  onRegisterSuccess,
  onBack,
  onSwitchToLogin,
}: RegisterProps) {
  const { theme: THEME } = useAppTheme()
  const { register, updateUser, logout } = useAuth()
  const [role, setRole] = useState<RegisterRole>("candidat")
  const [nom, setNom] = useState("")
  const [email, setEmail] = useState("")
  const [password, setPassword] = useState("")
  const [confirmPassword, setConfirmPassword] = useState("")
  const [photo, setPhoto] = useState<{
    uri: string
    type: string
    name: string
  } | null>(null)
  const [bio, setBio] = useState("")
  const [specialite, setSpecialite] = useState("")
  const [niveauEtude, setNiveauEtude] = useState(NIVEAU_ETUDES_OPTIONS[0])
  const [linkedin, setLinkedin] = useState("")
  const [entreprise, setEntreprise] = useState("")
  const [ville, setVille] = useState("")
  const [gouvernorat, setGouvernorat] = useState(TUNISIA_GOVERNORATES[0])
  const [poste, setPoste] = useState("")
  const [companyDescription, setCompanyDescription] = useState("")
  const [selectedTechnologies, setSelectedTechnologies] = useState<string[]>([])
  const [skillCatalog, setSkillCatalog] = useState<Array<{ id: number; label: string }>>([])
  const [skillIdsByName, setSkillIdsByName] = useState<Record<string, number>>({})
  const [skillCatalogLoading, setSkillCatalogLoading] = useState(true)
  const [skillCatalogLoadError, setSkillCatalogLoadError] = useState("")
  const [showPassword, setShowPassword] = useState(false)
  const [step, setStep] = useState<"form" | "otp">("form")
  const [otp, setOtp] = useState(Array(OTP_LENGTH).fill(""))
  const [secondsLeft, setSecondsLeft] = useState(60)
  const [isLoading, setIsLoading] = useState(false)
  const [resending, setResending] = useState(false)
  const [error, setError] = useState("")
  const [message, setMessage] = useState("")
  const otpRefs = useRef<Array<TextInput | null>>([])

  const fullName = nom.trim()
  const otpCode = otp.join("")
  const recruiterTechnologies = skillCatalog.map((skill) => skill.label)

  useEffect(() => {
    if (step !== "otp" || secondsLeft <= 0) return
    const timer = setTimeout(() => setSecondsLeft((value) => Math.max(0, value - 1)), 1000)
    return () => clearTimeout(timer)
  }, [secondsLeft, step])

  useEffect(() => {
    void (async () => {
      try {
        const { data } = await api.get<{ data: Array<{ id: number; name: string; nom?: string }> }>(
          "/skills/public-catalog"
        )
        const catalog = data.data
          .map((skill) => {
            const label = skill.name?.trim() || skill.nom?.trim() || ""
            return label ? { id: skill.id, label: label.replace(/\s+/g, " ") } : null
          })
          .filter((skill): skill is { id: number; label: string } => skill !== null)

        const mapping = catalog.reduce<Record<string, number>>((acc, skill) => {
          acc[skill.label] = skill.id
          return acc
        }, {})

        setSkillCatalog(catalog)
        setSkillIdsByName(mapping)
      } catch {
        setSkillCatalog([])
        setSkillIdsByName({})
        setSkillCatalogLoadError("Impossible de charger le catalogue des technologies.")
      } finally {
        setSkillCatalogLoading(false)
      }
    })()
  }, [])

  const resetRoleFields = (nextRole: RegisterRole) => {
    setRole(nextRole)
    setError("")
    setMessage("")
  }

  const handlePickPhoto = async () => {
    const { status } = await ImagePicker.requestMediaLibraryPermissionsAsync()
    if (status !== "granted") {
      Alert.alert("Permission refusée", "L'accès à la galerie est nécessaire pour sélectionner une photo de profil.")
      return
    }

    const result = await ImagePicker.launchImageLibraryAsync({
      mediaTypes: ImagePicker.MediaTypeOptions.Images,
      allowsEditing: true,
      aspect: [1, 1],
      quality: 0.8,
    })

    if (result.canceled || !result.assets?.[0]) {
      return
    }

    const asset = result.assets[0]
    setPhoto({
      uri: asset.uri,
      type: asset.type === "image" ? asset.uri.split(".").pop()?.includes("jpg") ? "image/jpeg" : "image/png" : "image/jpeg",
      name: asset.fileName ?? `profile-${Date.now()}.jpg`,
    })
  }

  const toggleTechnology = (tech: string) => {
    setSelectedTechnologies((current) =>
      current.includes(tech) ? current.filter((item) => item !== tech) : [...current, tech]
    )
  }

  const getSelectedSkillIds = () =>
    selectedTechnologies
      .map((name) => skillIdsByName[name])
      .filter((id): id is number => typeof id === "number")

  const handleSubmit = async () => {
    setError("")
    setMessage("")

    if (!nom.trim() || !email.trim() || !password) {
      setError("Tous les champs obligatoires doivent être remplis.")
      return
    }
    if (password !== confirmPassword) {
      setError("Les mots de passe ne correspondent pas.")
      return
    }
    if (password.length < 8) {
      setError("Le mot de passe doit contenir au moins 8 caractères.")
      return
    }

    if (role === "candidat") {
      if (!bio.trim() || !specialite.trim() || !niveauEtude.trim()) {
        setError("Tous les champs étudiants doivent être remplis.")
        return
      }
    }

    if (role === "recruteur") {
      if (!entreprise.trim() || !ville.trim() || !gouvernorat.trim() || !poste.trim() || !companyDescription.trim()) {
        setError("Tous les champs recruteur doivent être remplis.")
        return
      }
      if (skillCatalogLoading) {
        setError("Chargement des technologies en cours, réessaie dans un instant.")
        return
      }
      if (skillCatalogLoadError) {
        setError(skillCatalogLoadError)
        return
      }
      if (selectedTechnologies.length === 0) {
        setError("Sélectionnez au moins une technologie ou compétence utilisée.")
        return
      }
      const mapped = getSelectedSkillIds()
      const missingTechnologies = selectedTechnologies.filter((tech) => skillIdsByName[tech] === undefined)
      if (missingTechnologies.length > 0 || mapped.length !== selectedTechnologies.length) {
        setError(
          `Impossible de mapper ces technologies au backend : ${missingTechnologies.length > 0 ? missingTechnologies.join(", ") : "vérifiez votre sélection"}`
        )
        return
      }
    }

    try {
      const basePayload = {
        role_id: role === "candidat" ? ETUDIANT_ROLE_ID : RECRUTEUR_ROLE_ID,
        name: fullName,
        email: email.trim(),
        password,
        password_confirmation: confirmPassword,
      }

      if (role === "candidat" && photo) {
        const formData = new FormData()
        formData.append("role_id", String(ETUDIANT_ROLE_ID))
        formData.append("name", basePayload.name)
        formData.append("email", basePayload.email)
        formData.append("password", basePayload.password)
        formData.append("password_confirmation", String(basePayload.password_confirmation))
        formData.append("bio", bio.trim())
        formData.append("specialite", specialite.trim())
        formData.append("niveau_etude", niveauEtude.trim())
        if (linkedin.trim()) {
          formData.append("linkedin", linkedin.trim())
        }
        formData.append("photo", {
          uri: photo.uri,
          type: photo.type,
          name: photo.name,
        } as any)
        await register(formData)
      } else {
        const registerPayload = {
          ...basePayload,
          bio: role === "candidat" ? bio.trim() : undefined,
          specialite: role === "candidat" ? specialite.trim() : undefined,
          niveau_etude: role === "candidat" ? niveauEtude.trim() : undefined,
          linkedin: role === "candidat" ? linkedin.trim() || undefined : undefined,
          entreprise: role === "recruteur" ? entreprise.trim() : undefined,
          ville: role === "recruteur" ? ville.trim() : undefined,
          gouvernorat: role === "recruteur" ? gouvernorat.trim() : undefined,
          poste: role === "recruteur" ? poste.trim() : undefined,
          company_description: role === "recruteur" ? companyDescription.trim() : undefined,
          skill_ids: role === "recruteur" ? getSelectedSkillIds() : undefined,
        }
        await register(registerPayload)
      }

      setStep("otp")
      setSecondsLeft(60)
      setTimeout(() => otpRefs.current[0]?.focus(), 120)
    } catch (e) {
      setError(formatRegisterError(e))
    } finally {
      setIsLoading(false)
    }
  }

  const handleOtpChange = (value: string, index: number) => {
    const digit = value.replace(/\D/g, "").slice(-1)
    setOtp((current) => {
      const next = [...current]
      next[index] = digit
      return next
    })
    setError("")
    if (digit && index < OTP_LENGTH - 1) {
      otpRefs.current[index + 1]?.focus()
    }
  }

  const handleOtpKeyPress = (key: string, index: number) => {
    if (key === "Backspace" && !otp[index] && index > 0) {
      otpRefs.current[index - 1]?.focus()
    }
  }

  const handleVerifyOtp = async () => {
    if (otpCode.length !== OTP_LENGTH) {
      setError("Saisissez le code OTP complet.")
      return
    }
    setIsLoading(true)
    setError("")
    try {
      const { data } = await api.post("/verify-otp", { code: otpCode })
      if (data?.user) {
        await updateUser(data.user)
      }
      onRegisterSuccess()
    } catch (e) {
      setError(formatRegisterError(e))
    } finally {
      setIsLoading(false)
    }
  }

  const handleResend = async () => {
    if (secondsLeft > 0) return
    setResending(true)
    setError("")
    setMessage("")
    try {
      const { data } = await api.post("/auth/resend-verification")
      setMessage(data?.message || "Code renvoyé.")
      setSecondsLeft(60)
    } catch (e) {
      setError(formatRegisterError(e))
    } finally {
      setResending(false)
    }
  }

  const handleBackFromOtp = async () => {
    await logout()
    setStep("form")
    setOtp(Array(OTP_LENGTH).fill(""))
    setSecondsLeft(60)
  }

  if (step === "otp") {
    return (
      <View className="flex-1">
        <ScrollView
          className="flex-1"
          contentContainerStyle={{ paddingHorizontal: 24, paddingTop: 28, paddingBottom: 120 }}
          keyboardShouldPersistTaps="handled"
          keyboardDismissMode="on-drag"
          automaticallyAdjustKeyboardInsets={Platform.OS === "ios"}
          showsVerticalScrollIndicator={false}
        >
          <AuthBackButton onPress={() => void handleBackFromOtp()} />
          <View className="mb-7 items-center">
            <AuthBrandMark />
            <Text className="text-3xl font-black text-foreground">Vérification OTP</Text>
            <Text className="mt-3 max-w-[310px] text-center text-sm leading-6 text-muted-foreground">
              Un code de vérification a été envoyé à votre adresse email.
            </Text>
            <Text className="mt-1 text-center text-sm font-semibold" style={{ color: THEME.primary }}>
              {email.trim()}
            </Text>
          </View>

          <GlassCard variant="strong" plain>
            <View className="mb-6 flex-row justify-between gap-2">
              {otp.map((digit, index) => (
                <TextInput
                  key={index}
                  ref={(ref) => {
                    otpRefs.current[index] = ref
                  }}
                  value={digit}
                  onChangeText={(value) => handleOtpChange(value, index)}
                  onKeyPress={({ nativeEvent }) => handleOtpKeyPress(nativeEvent.key, index)}
                  keyboardType="numeric"
                  maxLength={1}
                  textContentType="oneTimeCode"
                  className="text-center text-xl font-black text-foreground"
                  style={{
                    width: 46,
                    height: 56,
                    borderRadius: 14,
                    borderWidth: 1,
                    borderColor: digit ? THEME.primary : THEME.border,
                    backgroundColor: THEME.mutedSurface,
                  }}
                  editable={!isLoading}
                />
              ))}
            </View>

            {error ? <Text className="mb-4 text-center text-sm font-semibold text-destructive">{error}</Text> : null}
            {message ? <Text className="mb-4 text-center text-sm font-semibold text-emerald-400">{message}</Text> : null}

            <GradientButton
              onPress={() => void handleVerifyOtp()}
              disabled={isLoading || otpCode.length !== OTP_LENGTH}
              loading={isLoading}
            >
              Valider l{"'"}OTP
            </GradientButton>

            <TouchableOpacity
              activeOpacity={0.75}
              onPress={() => void handleResend()}
              disabled={secondsLeft > 0 || resending}
              className="mt-5 items-center py-2"
            >
              <Text
                className="text-sm font-bold"
                style={{ color: secondsLeft > 0 ? THEME.muted : THEME.primary }}
              >
                {resending
                  ? "Envoi en cours..."
                  : secondsLeft > 0
                  ? `Renvoyer le code dans ${secondsLeft}s`
                  : "Renvoyer le code"}
              </Text>
            </TouchableOpacity>
          </GlassCard>
        </ScrollView>
      </View>
    )
  }

  return (
    <View className="flex-1">
      <ScrollView
        className="flex-1"
        contentContainerStyle={{ paddingHorizontal: 24, paddingTop: 28, paddingBottom: 120 }}
        keyboardShouldPersistTaps="handled"
        keyboardDismissMode="on-drag"
        automaticallyAdjustKeyboardInsets={Platform.OS === "ios"}
        showsVerticalScrollIndicator={false}
      >
        <AuthBackButton onPress={onBack} />

        <View className="mb-6 items-center">
          <AuthBrandMark />
          <Text className="mb-2 text-3xl font-black tracking-normal text-foreground">Créer un compte</Text>
          <Text className="text-center text-base text-muted-foreground">
            Rejoignez ProLink avec le même parcours que sur le web.
          </Text>
        </View>

        <GlassCard variant="strong" plain>
          <Text className="mb-3 text-xs font-bold uppercase tracking-[0.12em] text-muted-foreground">Votre rôle</Text>
          <View className="mb-5 flex-row gap-3">
              <RoleCard
              active={role === "candidat"}
              title="Je suis un Candidat"
              subtitle="Portfolio, compétences et opportunités."
              icon={<GraduationCap size={24} color={role === "candidat" ? THEME.primary : THEME.muted} />}
              onPress={() => resetRoleFields("candidat")}
            />
            <RoleCard
              active={role === "recruteur"}
              title="Je suis un Recruteur"
              subtitle="Talents, offres et sourcing."
              icon={<Building2 size={24} color={role === "recruteur" ? THEME.primary : THEME.muted} />}
              onPress={() => resetRoleFields("recruteur")}
            />
          </View>

          <AuthTextField
            label="Nom"
            containerClassName="mb-4"
            leftIcon={<User size={19} color={THEME.muted} />}
            value={nom}
            onChangeText={setNom}
            placeholder="Nom complet"
            autoCapitalize="words"
            editable={!isLoading}
          />

          <AuthTextField
            label={role === "candidat" ? "Adresse e-mail" : "Adresse e-mail"}
            containerClassName="mb-4"
            leftIcon={<Mail size={20} color={THEME.muted} />}
            value={email}
            onChangeText={setEmail}
            placeholder="prenom.nom@exemple.com"
            keyboardType="email-address"
            autoCapitalize="none"
            autoCorrect={false}
            editable={!isLoading}
          />

          {role === "candidat" ? (
            <>
              <Text className="mb-2 text-xs font-bold uppercase tracking-[0.12em] text-muted-foreground">Photo de profil</Text>
              <TouchableOpacity
                activeOpacity={0.85}
                onPress={() => void handlePickPhoto()}
                className="mb-4 rounded-2xl border border-border px-4 py-3"
                style={{ backgroundColor: THEME.mutedSurface }}
              >
                <Text className="text-sm font-semibold text-foreground">
                  {photo ? "Modifier la photo de profil" : "Choisir une photo de profil"}
                </Text>
                {photo ? (
                  <Text className="mt-2 text-xs text-muted-foreground">{photo.name}</Text>
                ) : null}
              </TouchableOpacity>

              {photo ? (
                <View className="mb-4 items-center">
                  <Image
                    source={{ uri: photo.uri }}
                    style={{ width: 100, height: 100, borderRadius: 100 }}
                  />
                </View>
              ) : null}

              <AuthTextField
                label="Bio"
                containerClassName="mb-4"
                leftIcon={<GraduationCap size={20} color={THEME.muted} />}
                value={bio}
                onChangeText={setBio}
                placeholder="Quelques mots sur ton parcours"
                multiline
                numberOfLines={4}
                editable={!isLoading}
              />

              <AuthTextField
                label="Spécialité"
                containerClassName="mb-4"
                value={specialite}
                onChangeText={setSpecialite}
                placeholder="ex. Informatique de gestion"
                autoCapitalize="words"
                editable={!isLoading}
              />

              <Text className="mb-2 text-xs font-bold uppercase tracking-[0.12em] text-muted-foreground">
                Niveau d{"'"}études
              </Text>
              <View className="mb-4">
                <ChoiceChips value={niveauEtude} options={NIVEAU_ETUDES_OPTIONS} onChange={setNiveauEtude} />
              </View>

              <AuthTextField
                label="Lien LinkedIn"
                containerClassName="mb-4"
                value={linkedin}
                onChangeText={setLinkedin}
                placeholder="https://www.linkedin.com/in/votrenom"
                autoCapitalize="none"
                autoCorrect={false}
                keyboardType="url"
                editable={!isLoading}
              />
            </>
          ) : (
            <>
              <AuthTextField
                label="Nom de l'entreprise"
                containerClassName="mb-4"
                leftIcon={<Building2 size={20} color={THEME.muted} />}
                value={entreprise}
                onChangeText={setEntreprise}
                placeholder="ProLink Labs"
                editable={!isLoading}
              />

              <AuthTextField
                label="Ville"
                containerClassName="mb-4"
                value={ville}
                onChangeText={setVille}
                placeholder="Tunis"
                autoCapitalize="words"
                editable={!isLoading}
              />

              <Text className="mb-2 text-xs font-bold uppercase tracking-[0.12em] text-muted-foreground">Gouvernorat</Text>
              <View className="mb-4">
                <ChoiceChips value={gouvernorat} options={TUNISIA_GOVERNORATES} onChange={setGouvernorat} />
              </View>

              <AuthTextField
                label="Description de l'activité"
                containerClassName="mb-4"
                value={companyDescription}
                onChangeText={setCompanyDescription}
                placeholder="Décris brièvement l'activité de ton entreprise"
                multiline
                numberOfLines={4}
                editable={!isLoading}
              />

              <AuthTextField
                label="Votre poste"
                containerClassName="mb-4"
                value={poste}
                onChangeText={setPoste}
                placeholder="Responsable recrutement"
                autoCapitalize="words"
                editable={!isLoading}
              />

              <Text className="mb-2 text-xs font-bold uppercase tracking-[0.12em] text-muted-foreground">
                Technologies / Compétences utilisées
              </Text>
              <View className="mb-4 flex-row flex-wrap gap-2">
                {recruiterTechnologies.map((tech) => {
                  const active = selectedTechnologies.includes(tech)
                  return (
                    <TouchableOpacity
                      key={tech}
                      activeOpacity={0.86}
                      onPress={() => {
                        if (!skillCatalogLoading && !skillCatalogLoadError) {
                          toggleTechnology(tech)
                        }
                      }}
                      className="border px-3 py-2"
                      style={{
                        borderRadius: 999,
                        borderColor: active ? THEME.primary : THEME.border,
                        backgroundColor: active ? "rgba(157, 123, 255, 0.16)" : "rgba(148, 163, 184, 0.10)",
                        opacity: skillCatalogLoading || !!skillCatalogLoadError ? 0.6 : 1,
                      }}
                      disabled={skillCatalogLoading || !!skillCatalogLoadError}
                    >
                      <Text className="text-xs font-semibold" style={{ color: active ? THEME.primary : THEME.muted }}>
                        {tech}
                      </Text>
                    </TouchableOpacity>
                  )
                })}
              </View>
              {skillCatalogLoading ? (
                <Text className="text-xs text-muted-foreground">Chargement des technologies...</Text>
              ) : null}
              {skillCatalogLoadError ? (
                <Text className="text-xs text-red-500">{skillCatalogLoadError}</Text>
              ) : null}
            </>
          )}

          <AuthTextField
            label="Mot de passe"
            containerClassName="mb-4"
            leftIcon={<Lock size={20} color={THEME.muted} />}
            rightAccessory={
              <TouchableOpacity onPress={() => setShowPassword(!showPassword)} hitSlop={10}>
                {showPassword ? <EyeOff size={20} color={THEME.muted} /> : <Eye size={20} color={THEME.muted} />}
              </TouchableOpacity>
            }
            value={password}
            onChangeText={setPassword}
            placeholder="••••••••"
            secureTextEntry={!showPassword}
            editable={!isLoading}
          />

          <AuthTextField
            label="Confirmation du mot de passe"
            containerClassName="mb-4"
            leftIcon={<Lock size={20} color={THEME.muted} />}
            value={confirmPassword}
            onChangeText={setConfirmPassword}
            placeholder="••••••••"
            secureTextEntry={!showPassword}
            editable={!isLoading}
          />

          {error ? <Text className="mb-4 text-center text-sm font-semibold text-destructive">{error}</Text> : null}

          <View className="mb-5">
            <GradientButton onPress={() => void handleSubmit()} disabled={isLoading} loading={isLoading}>
              {isLoading ? <ActivityIndicator color="#FFFFFF" /> : "S'inscrire"}
            </GradientButton>
          </View>

          <View className="flex-row flex-wrap justify-center gap-1">
            <Text className="text-base text-muted-foreground">Déjà inscrit ?</Text>
            <TouchableOpacity onPress={onSwitchToLogin}>
              <Text className="text-base font-semibold" style={{ color: THEME.primary }}>
                Se connecter
              </Text>
            </TouchableOpacity>
          </View>
        </GlassCard>
      </ScrollView>
    </View>
  )
}
