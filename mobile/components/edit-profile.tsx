/**
 * @file Formulaire de mise à jour du profil étudiant avec chargement des données réelles
 * depuis useAuth().user et upload de photo de profil.
 */
import { useCallback, useEffect, useState } from "react"
import { Alert, Image, Platform, ScrollView, Text, TouchableOpacity, View } from "react-native"
import * as ImagePicker from "expo-image-picker"
import { ArrowLeft, BriefcaseBusiness, Camera, Info, MapPin, User as UserIcon } from "lucide-react-native"
import { AuthTextField } from "./auth-text-field"
import { GlassCard } from "./glass-card"
import { GradientButton } from "./gradient-button"
import { useAppTheme } from "@/context/app-theme-context"
import { useLocale } from "@/context/locale-context"
import { useBottomTabBarHeight } from "@/hooks/use-bottom-tab-bar-height"
import { useAuth } from "@/context/auth-context"
import { api, getStorageUrl } from "@/lib/api"

interface EditProfileProps {
  onBack: () => void
}

type PhotoAsset = {
  uri: string
  type: string
  name: string
}

export function EditProfile({ onBack }: EditProfileProps) {
  const { t } = useLocale()
  const { theme: THEME } = useAppTheme()
  const tabBarHeight = useBottomTabBarHeight()
  const { user, updateUser } = useAuth()

  type ExtendedApiUser = {
    prenom?: string | null
    nom?: string | null
    first_name?: string | null
    last_name?: string | null
    bio?: string | null
    photo?: string | null
    photo_url?: string | null
    student?: { bio?: string | null } | null
    recruteur?: {
      entreprise?: string | null
      poste?: string | null
      site_web?: string | null
    }
    company?: {
      name?: string | null
      ville?: string | null
      gouvernorat?: string | null
      description?: string | null
    }
    entreprise?: string | null
    poste?: string | null
    site_web?: string | null
    ville?: string | null
    gouvernorat?: string | null
    company_description?: string | null
    companyDescription?: string | null
  }

  const userData = user as (ExtendedApiUser & typeof user) | null

  // Helper: extract first and last name from many possible API shapes.
  const extractNames = (u: ExtendedApiUser | null | undefined) => {
    if (!u) return { first: "", last: "" }

    const prenom = (u as any)?.prenom
    const nom = (u as any)?.nom
    if (prenom || nom) return { first: prenom || "", last: nom || "" }

    const first_name = (u as any)?.first_name
    const last_name = (u as any)?.last_name
    if (first_name || last_name) return { first: first_name || "", last: last_name || "" }

    const given = (u as any)?.given_name
    const family = (u as any)?.family_name
    if (given || family) return { first: given || "", last: family || "" }

    // If API returns a single `name` field, try to split it
    const fullname = (u as any)?.name || (u as any)?.display_name || (u as any)?.full_name
    if (typeof fullname === "string" && fullname.trim().length > 0) {
      const parts = fullname.trim().split(/\s+/)
      if (parts.length === 1) return { first: parts[0], last: "" }
      const first = parts.slice(0, -1).join(" ")
      const last = parts.slice(-1).join(" ")
      return { first, last }
    }

    // Last resort: try `student` or `candidat` nested object
    const etuPrenom = (u as any)?.candidat?.prenom || (u as any)?.student?.prenom || (u as any)?.etudiant?.prenom
    const etuNom = (u as any)?.candidat?.nom || (u as any)?.student?.nom || (u as any)?.etudiant?.nom
    if (etuPrenom || etuNom) return { first: etuPrenom || "", last: etuNom || "" }

    return { first: "", last: "" }
  }

  const initialNames = extractNames(userData)

  // Initialise from `user` if available, otherwise empty — keeps values populated when component mounts before user is ready.
  const roleName = String(user?.role?.name ?? "").toLowerCase()
  const isRecruiter = roleName === "recruteur"

  const [firstName, setFirstName] = useState(() => initialNames.first)
  const [lastName, setLastName] = useState(() => initialNames.last)
  const [email, setEmail] = useState(() => (userData?.email as string) || "")
  const [bio, setBio] = useState(() => userData?.candidat?.bio ?? userData?.student?.bio ?? userData?.bio ?? "")

  const [companyName, setCompanyName] = useState(() =>
    userData?.recruteur?.entreprise || userData?.company?.name || userData?.entreprise || ""
  )
  const [companyRole, setCompanyRole] = useState(() =>
    userData?.recruteur?.poste || userData?.poste || ""
  )
  const [companyWebsite, setCompanyWebsite] = useState(() =>
    userData?.recruteur?.site_web || userData?.site_web || ""
  )
  const [companyCity, setCompanyCity] = useState(() =>
    userData?.company?.ville || userData?.ville || ""
  )
  const [companyGov, setCompanyGov] = useState(() =>
    userData?.company?.gouvernorat || userData?.gouvernorat || ""
  )
  const [companyDesc, setCompanyDesc] = useState(() =>
    userData?.company?.description || userData?.company_description || userData?.companyDescription || ""
  )

  const [photoAsset, setPhotoAsset] = useState<PhotoAsset | null>(null)
  const [photoPreviewUri, setPhotoPreviewUri] = useState<string | null>(() => {
    const existingPhoto = (user as any)?.photo ?? (user as any)?.photo_url
    if (typeof existingPhoto === "string" && existingPhoto.length > 0) {
      return getStorageUrl(existingPhoto) ?? existingPhoto
    }
    return null
  })
  const [saving, setSaving] = useState(false)
  const [errorMessage, setErrorMessage] = useState<string | null>(null)

  useEffect(() => {
    if (!userData) return

    const names = extractNames(userData)
    if (!firstName && names.first) setFirstName(names.first)
    if (!lastName && names.last) setLastName(names.last)
    if (!email && userData?.email) setEmail(userData.email)
    const incomingBio = userData?.candidat?.bio ?? userData?.student?.bio ?? userData?.bio ?? ""
    if (!bio && incomingBio) setBio(incomingBio)

    const incomingCompanyName = userData?.recruteur?.entreprise || userData?.company?.name || userData?.entreprise || ""
    if (!companyName && incomingCompanyName) setCompanyName(incomingCompanyName)
    const incomingCompanyRole = userData?.recruteur?.poste || userData?.poste || ""
    if (!companyRole && incomingCompanyRole) setCompanyRole(incomingCompanyRole)
    const incomingCompanyWebsite = userData?.recruteur?.site_web || userData?.site_web || ""
    if (!companyWebsite && incomingCompanyWebsite) setCompanyWebsite(incomingCompanyWebsite)
    const incomingCompanyCity = userData?.company?.ville || userData?.ville || ""
    if (!companyCity && incomingCompanyCity) setCompanyCity(incomingCompanyCity)
    const incomingCompanyGov = userData?.company?.gouvernorat || userData?.gouvernorat || ""
    if (!companyGov && incomingCompanyGov) setCompanyGov(incomingCompanyGov)
    const incomingCompanyDesc = userData?.company?.description || userData?.company_description || userData?.companyDescription || ""
    if (!companyDesc && incomingCompanyDesc) setCompanyDesc(incomingCompanyDesc)

    if (!photoAsset) {
      const existingPhoto = userData?.photo ?? userData?.photo_url
      if (typeof existingPhoto === "string" && existingPhoto.length > 0) {
        setPhotoPreviewUri(getStorageUrl(existingPhoto) ?? existingPhoto)
      }
    }
  }, [userData, photoAsset])

  // In some usages the `user` object may be mutated in-place or updated
  // outside React's usual replace-with-new-object pattern. Add a couple
  // of defensive syncs to ensure inputs are populated when the form is
  // opened or when `user` updates unpredictably.
  useEffect(() => {
    if (!userData) return
    const syncFromUserLater = () => {
      const names = extractNames(userData)
      if (names.first && names.first !== firstName) setFirstName(names.first)
      if (names.last && names.last !== lastName) setLastName(names.last)
      if (userData?.email && userData.email !== email) setEmail(userData.email)
      const incomingBio = userData?.candidat?.bio ?? userData?.student?.bio ?? userData?.bio ?? ""
      if (incomingBio && incomingBio !== bio) setBio(incomingBio)

      const incomingCompanyName = userData?.recruteur?.entreprise || userData?.company?.name || userData?.entreprise || ""
      if (incomingCompanyName !== companyName) setCompanyName(incomingCompanyName)
      const incomingCompanyRole = userData?.recruteur?.poste || userData?.poste || ""
      if (incomingCompanyRole !== companyRole) setCompanyRole(incomingCompanyRole)
      const incomingCompanyWebsite = userData?.recruteur?.site_web || userData?.site_web || ""
      if (incomingCompanyWebsite !== companyWebsite) setCompanyWebsite(incomingCompanyWebsite)
      const incomingCompanyCity = userData?.company?.ville || userData?.ville || ""
      if (incomingCompanyCity !== companyCity) setCompanyCity(incomingCompanyCity)
      const incomingCompanyGov = userData?.company?.gouvernorat || userData?.gouvernorat || ""
      if (incomingCompanyGov !== companyGov) setCompanyGov(incomingCompanyGov)
      const incomingCompanyDesc = userData?.company?.description || userData?.company_description || userData?.companyDescription || ""
      if (incomingCompanyDesc !== companyDesc) setCompanyDesc(incomingCompanyDesc)
    }

    // Run after current tick and slightly later to catch async mutations.
    const t1 = setTimeout(syncFromUserLater, 0)
    const t2 = setTimeout(syncFromUserLater, 200)
    return () => {
      clearTimeout(t1)
      clearTimeout(t2)
    }
  }, [userData])

  const handlePickPhoto = useCallback(async () => {
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
    const fileType = asset.type === "image" ? `image/${asset.uri.split(".").pop()?.toLowerCase() ?? "jpeg"}` : "image/jpeg"
    const fileName = asset.fileName ?? `profile-${Date.now()}.jpg`

    setPhotoAsset({
      uri: asset.uri,
      type: fileType,
      name: fileName,
    })
    setPhotoPreviewUri(asset.uri)
  }, [])

  const buildPayload = useCallback(() => {
    const first = firstName.trim()
    const last = lastName.trim()
    const fullName = [first, last].filter(Boolean).join(" ")

    const basePayload: Record<string, unknown> = {
      prenom: first || undefined,
      nom: last || undefined,
      email: email.trim() || undefined,
      name: fullName || undefined,
    }

    if (isRecruiter) {
      return {
        ...basePayload,
        entreprise: companyName.trim() || undefined,
        poste: companyRole.trim() || undefined,
        site_web: companyWebsite.trim() || undefined,
        ville: companyCity.trim() || undefined,
        gouvernorat: companyGov.trim() || undefined,
        company_description: companyDesc.trim() || undefined,
      }
    }

    return {
      ...basePayload,
      bio: bio.trim() || null,
    }
  }, [bio, email, firstName, lastName, companyName, companyRole, companyWebsite, companyCity, companyGov, companyDesc, isRecruiter])

  const handleSubmit = useCallback(async () => {
    setSaving(true)
    setErrorMessage(null)

    try {
      const payload = buildPayload()
      let response

      if (photoAsset) {
        const formData = new FormData()
        Object.entries(payload).forEach(([key, value]) => {
          if (value !== undefined) {
            formData.append(key, String(value))
          }
        })
        formData.append("photo", {
          uri: Platform.OS === "android" ? photoAsset.uri : photoAsset.uri.replace("file://", ""),
          type: photoAsset.type,
          name: photoAsset.name,
        } as any)
        response = await api.put<{ user: unknown }>("/user/update", formData)
      } else {
        response = await api.put<{ user: unknown }>("/user/update", payload)
      }

      if (response.data?.user) {
        await updateUser(response.data.user as any)
      }
      onBack()
    } catch (error) {
      setErrorMessage("Impossible d'enregistrer les modifications pour le moment.")
    } finally {
      setSaving(false)
    }
  }, [buildPayload, onBack, photoAsset, updateUser])

  return (
    <ScrollView
      className="flex-1 px-4 pt-6"
      contentContainerStyle={{ paddingBottom: tabBarHeight + 24 }}
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
        <Text className="text-3xl font-bold tracking-tight text-foreground">Modifier le profil</Text>
      </View>

      <GlassCard className="mb-6" contentClassName="gap-4 p-4">
        {!isRecruiter ? (
          <View className="items-center">
            {photoPreviewUri ? (
              <Image
                source={{ uri: photoPreviewUri }}
                className="mb-4 h-24 w-24 rounded-full"
                resizeMode="cover"
              />
            ) : (
              <View
                className="mb-4 h-24 w-24 items-center justify-center rounded-full border border-border/60 bg-surface"
                style={{ overflow: "hidden" }}
              >
                <Camera size={28} color={THEME.muted} />
              </View>
            )}
            <TouchableOpacity
              onPress={handlePickPhoto}
              activeOpacity={0.85}
              className="rounded-2xl border border-border/70 px-5 py-3"
              style={{ backgroundColor: THEME.background }}
            >
              <Text className="text-sm font-semibold text-foreground">Téléverser une photo</Text>
            </TouchableOpacity>
          </View>
        ) : null}

        <AuthTextField
          label="Prénom"
          value={firstName}
          onChangeText={setFirstName}
          placeholder="Prénom"
          leftIcon={<UserIcon size={18} color={THEME.muted} />}
        />
        <AuthTextField
          label="Nom"
          value={lastName}
          onChangeText={setLastName}
          placeholder="Nom"
          leftIcon={<UserIcon size={18} color={THEME.muted} />}
        />
        <AuthTextField
          label="Email"
          value={email}
          onChangeText={setEmail}
          placeholder="Email"
          keyboardType="email-address"
          autoCapitalize="none"
          leftIcon={<UserIcon size={18} color={THEME.muted} />}
        />
        {isRecruiter ? (
          <>
            <AuthTextField
              label="Entreprise"
              value={companyName}
              onChangeText={setCompanyName}
              placeholder="Nom de l'entreprise"
              leftIcon={<BriefcaseBusiness size={18} color={THEME.muted} />}
            />
            <AuthTextField
              label="Poste"
              value={companyRole}
              onChangeText={setCompanyRole}
              placeholder="Votre poste"
              leftIcon={<UserIcon size={18} color={THEME.muted} />}
            />
            <AuthTextField
              label="Ville"
              value={companyCity}
              onChangeText={setCompanyCity}
              placeholder="Ville"
              leftIcon={<MapPin size={18} color={THEME.muted} />}
            />
            <AuthTextField
              label="Gouvernorat"
              value={companyGov}
              onChangeText={setCompanyGov}
              placeholder="Gouvernorat"
              leftIcon={<MapPin size={18} color={THEME.muted} />}
            />
            <AuthTextField
              label="Site web"
              value={companyWebsite}
              onChangeText={setCompanyWebsite}
              placeholder="https://"
              keyboardType="url"
              autoCapitalize="none"
              leftIcon={<UserIcon size={18} color={THEME.muted} />}
            />
            <AuthTextField
              label="Description de l'entreprise"
              value={companyDesc}
              onChangeText={setCompanyDesc}
              placeholder="Décrivez votre entreprise"
              multiline
              numberOfLines={4}
              leftIcon={<Info size={18} color={THEME.muted} />}
            />
          </>
        ) : (
          <AuthTextField
            label="Bio"
            value={bio}
            onChangeText={setBio}
            placeholder="Votre bio"
            multiline
            numberOfLines={5}
            leftIcon={<Info size={18} color={THEME.muted} />}
          />
        )}

        {errorMessage ? <Text className="text-sm text-rose-300">{errorMessage}</Text> : null}

        <GradientButton onPress={handleSubmit} loading={saving} disabled={saving}>
          Enregistrer les modifications
        </GradientButton>
      </GlassCard>
    </ScrollView>
  )
}
