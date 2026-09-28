import { useCallback, useMemo, useState } from "react"
import {
  Alert,
  Image,
  Platform,
  Pressable,
  RefreshControl,
  ScrollView,
  Text,
  ToastAndroid,
  TouchableOpacity,
  View,
  Modal,
  Linking,
} from "react-native"
import {
  ArrowRight,
  Briefcase,
  Code2,
  Link2,
  PlusCircle,
  TextCursorInput,
  Upload,
  X,
  Trash2,
  Edit3,
} from "lucide-react-native"
import * as ImagePicker from "expo-image-picker"
import { AuthTextField } from "./auth-text-field"
import { GlassCard } from "./glass-card"
import { GradientButton } from "./gradient-button"
import { useAppTheme } from "@/context/app-theme-context"
import { useLocale } from "@/context/locale-context"
import { useBottomTabBarHeight } from "@/hooks/use-bottom-tab-bar-height"
import { api } from "@/lib/api"
import { getStoredToken } from "@/lib/storage"
import { useStudentDataContext, type ApiProject } from "@/context/student-data-context"
import { API_ORIGIN } from "@/constants/api-config"

const SCROLL_EXTRA_BELOW_TAB_BAR = 24
const LARAVEL_STORAGE_BASE = `${API_ORIGIN.replace(/\/$/, "")}/storage`

const getLaravelStorageUrl = (
  relativePath?: string | null,
  type?: "profile" | "projectLogo" | "projectScreenshot"
) => {
  if (!relativePath) return undefined
  if (relativePath.startsWith("http://") || relativePath.startsWith("https://")) {
    return relativePath
  }

  const normalized = relativePath.replace(/^\/+/, "")
  const fileName = normalized.split("/").pop() || normalized

  if (type === "profile") {
    return `${LARAVEL_STORAGE_BASE}/profile-photos/${fileName}`
  }
  if (type === "projectLogo") {
    return `${LARAVEL_STORAGE_BASE}/project-images/${fileName}`
  }
  if (type === "projectScreenshot") {
    return `${LARAVEL_STORAGE_BASE}/projects/${fileName}`
  }

  if (
    normalized.startsWith("profile-photos/") ||
    normalized.startsWith("project-images/") ||
    normalized.startsWith("projects/")
  ) {
    return `${LARAVEL_STORAGE_BASE}/${normalized}`
  }

  return `${LARAVEL_STORAGE_BASE}/${normalized}`
}

const normalizeTechnologyTag = (value: string) => value.trim().replace(/\s+/g, " ")

const getFileType = (uri: string, assetType?: string | null) => {
  const extension = uri.split(".").pop()?.toLowerCase() || "jpg"
  switch (extension) {
    case "png":
      return "image/png"
    case "gif":
      return "image/gif"
    case "webp":
      return "image/webp"
    case "heic":
      return "image/heic"
    default:
      return assetType === "image" ? "image/jpeg" : `image/${extension}`
  }
}

const buildFileFromAsset = (asset: ImagePicker.ImagePickerAsset) => {
  const uri = asset.uri
  const fileName = asset.fileName || uri.split("/").pop() || `upload-${Date.now()}.jpg`
  const type = getFileType(uri, asset.type ?? null)
  return { uri, name: fileName, type } as unknown as {
    uri: string
    name: string
    type: string
  }
}

async function buildFileFromAssetAsync(asset: ImagePicker.ImagePickerAsset) {
  const uri = asset.uri
  const fileName = asset.fileName || uri.split("/").pop() || `upload-${Date.now()}.jpg`
  const type = getFileType(uri, asset.type ?? null)

  try {
    // Common case: file:// or content:// URIs work when appended as `{ uri, name, type }`.
    if (uri.startsWith("file://") || uri.startsWith("content://") || uri.startsWith("http://") || uri.startsWith("https://")) {
      return { uri, name: fileName, type }
    }

    // iOS `ph://` or other schemes: fetch and return a Blob
    const resp = await fetch(uri)
    const blob = await resp.blob()
    return { blob, name: fileName, type }
  } catch (e) {
    // Fallback to the plain object — the platform may still accept it.
    return { uri, name: fileName, type }
  }
}

const getProjectCoverUrl = (project: {
  image?: string | null
  projectImages?: { image_path: string }[]
}) => {
  const screenshotUrl = project.projectImages?.[0]?.image_path
  if (screenshotUrl) return getLaravelStorageUrl(screenshotUrl, "projectScreenshot")
  return getLaravelStorageUrl(project.image ?? undefined, "projectLogo")
}

export function Projects() {
  const { theme: THEME } = useAppTheme()
  const { t } = useLocale()
  const tabBarHeight = useBottomTabBarHeight()
  const { projects, allSkills, refreshing, refetch, createProject, updateProject, removeProject } = useStudentDataContext()

  const [showForm, setShowForm] = useState(false)
  const [titre, setTitre] = useState("")
  const [description, setDescription] = useState("")
  const [technologyInput, setTechnologyInput] = useState("")
  const [technologyTags, setTechnologyTags] = useState<string[]>([])
  const [githubLink, setGithubLink] = useState("")
  const [demoLink, setDemoLink] = useState("")
  const [logoAsset, setLogoAsset] = useState<ImagePicker.ImagePickerAsset | null>(null)
  const [galleryAssets, setGalleryAssets] = useState<ImagePicker.ImagePickerAsset[]>([])
  const [saving, setSaving] = useState(false)
  const [errorMessage, setErrorMessage] = useState<string | null>(null)
  const [selectedProject, setSelectedProject] = useState<any | null>(null)
  const [detailsVisible, setDetailsVisible] = useState(false)
  const [editModalVisible, setEditModalVisible] = useState(false)
  const [editingProject, setEditingProject] = useState<ApiProject | null>(null)
  const [editTitre, setEditTitre] = useState("")
  const [editDescription, setEditDescription] = useState("")
  const [editTechnologyTags, setEditTechnologyTags] = useState<string[]>([])
  const [editGithubLink, setEditGithubLink] = useState("")
  const [editDemoLink, setEditDemoLink] = useState("")
  const [editLogoAsset, setEditLogoAsset] = useState<ImagePicker.ImagePickerAsset | null>(null)
  const [editGalleryAssets, setEditGalleryAssets] = useState<ImagePicker.ImagePickerAsset[]>([])
  const [editSaving, setEditSaving] = useState(false)
  const [editErrorMessage, setEditErrorMessage] = useState<string | null>(null)

  const projectCountLabel = useMemo(() => {
    const count = projects.length
    return count === 1
      ? `${count} ${t("projects_item")}`
      : `${count} ${t("projects_items")}`
  }, [projects.length, t])

  const technologySet = useMemo(
    () => new Set(technologyTags.map((tag) => tag.toLowerCase())),
    [technologyTags]
  )

  const technologySuggestions = useMemo(() => {
    if (allSkills.length > 0) {
      return Array.from(
        new Set(
          allSkills
            .map((skill) => skill.name ?? skill.nom ?? "")
            .map((text) => normalizeTechnologyTag(text))
            .filter((text) => text.length > 0)
        )
      )
    }
    return [
      "React Native",
      "Laravel",
      "TypeScript",
      "Expo",
      "Tailwind CSS",
      "Node.js",
      "API REST",
      "Docker",
      "React",
      "Vue.js",
    ]
  }, [allSkills])

  const addTechnologyTags = useCallback(() => {
    const rawTags = technologyInput
      .split(/[,;]+/)
      .map(normalizeTechnologyTag)
      .filter((tag) => tag.length > 0)

    if (rawTags.length === 0) {
      setTechnologyInput("")
      return
    }

    const nextTags = [...technologyTags]
    for (const tag of rawTags) {
      if (!technologySet.has(tag.toLowerCase())) {
        nextTags.push(tag)
      }
    }

    setTechnologyTags(nextTags.slice(0, 20))
    setTechnologyInput("")
  }, [technologyInput, technologySet, technologyTags])

  const toggleTechnologyTag = useCallback((tag: string) => {
    const normalized = normalizeTechnologyTag(tag)
    setTechnologyTags((previous) => {
      if (previous.some((existing) => existing.toLowerCase() === normalized.toLowerCase())) {
        return previous.filter((existing) => existing.toLowerCase() !== normalized.toLowerCase())
      }
      return [...previous, normalized].slice(0, 20)
    })
  }, [])

  const removeTechnologyTag = useCallback((tagToRemove: string) => {
    setTechnologyTags((previous) =>
      previous.filter((tag) => tag.toLowerCase() !== tagToRemove.toLowerCase())
    )
  }, [])

  const toggleEditTechnologyTag = useCallback((tag: string) => {
    const normalized = normalizeTechnologyTag(tag)
    setEditTechnologyTags((previous) => {
      if (previous.some((existing) => existing.toLowerCase() === normalized.toLowerCase())) {
        return previous.filter((existing) => existing.toLowerCase() !== normalized.toLowerCase())
      }
      return [...previous, normalized].slice(0, 20)
    })
  }, [])

  const removeEditTechnologyTag = useCallback((tagToRemove: string) => {
    setEditTechnologyTags((previous) =>
      previous.filter((tag) => tag.toLowerCase() !== tagToRemove.toLowerCase())
    )
  }, [])

  const pickLogo = useCallback(async () => {
    const permission = await ImagePicker.requestMediaLibraryPermissionsAsync()
    if (!permission.granted) {
      Alert.alert("Autorisation requise", "Autorisez l'accès aux images pour sélectionner le logo.")
      return
    }

    const result = await ImagePicker.launchImageLibraryAsync({
      allowsEditing: true,
      quality: 0.1,
      aspect: [1, 1],
    })

    if (result.canceled) return
    const asset = Array.isArray(result.assets) ? result.assets[0] : (result as any)
    if (asset?.uri) {
      setLogoAsset(asset)
      setErrorMessage(null)
    }
  }, [])

  const pickGalleryImages = useCallback(async () => {
    const permission = await ImagePicker.requestMediaLibraryPermissionsAsync()
    if (!permission.granted) {
      Alert.alert("Autorisation requise", "Autorisez l'accès aux images pour sélectionner des captures.")
      return
    }

    const result = await ImagePicker.launchImageLibraryAsync({
      allowsEditing: true,
      quality: 0.1,
      aspect: [4, 3],
    })

    if (result.canceled) return
    const assets = result.assets ?? []

    setGalleryAssets((previous) => {
      const merged = [...previous]
      for (const asset of assets) {
        if (!asset?.uri) continue
        if (merged.some((existing) => existing.uri === asset.uri)) continue
        merged.push(asset)
      }
      return merged.slice(0, 12)
    })
    setErrorMessage(null)
  }, [])

  const removeGalleryAsset = useCallback((uri: string) => {
    setGalleryAssets((previous) => previous.filter((asset) => asset.uri !== uri))
  }, [])

  const pickEditLogo = useCallback(async () => {
    const permission = await ImagePicker.requestMediaLibraryPermissionsAsync()
    if (!permission.granted) {
      Alert.alert("Autorisation requise", "Autorisez l'accès aux images pour sélectionner le logo.")
      return
    }

    const result = await ImagePicker.launchImageLibraryAsync({
      allowsEditing: true,
      quality: 0.1,
      aspect: [1, 1],
    })

    if (result.canceled) return
    const asset = Array.isArray(result.assets) ? result.assets[0] : (result as any)
    if (asset?.uri) {
      setEditLogoAsset(asset)
      setEditErrorMessage(null)
    }
  }, [])

  const pickEditGalleryImages = useCallback(async () => {
    const permission = await ImagePicker.requestMediaLibraryPermissionsAsync()
    if (!permission.granted) {
      Alert.alert("Autorisation requise", "Autorisez l'accès aux images pour sélectionner des captures.")
      return
    }

    const result = await ImagePicker.launchImageLibraryAsync({
      allowsEditing: true,
      quality: 0.1,
      aspect: [4, 3],
    })

    if (result.canceled) return
    const assets = result.assets ?? []

    setEditGalleryAssets((previous) => {
      const merged = [...previous]
      for (const asset of assets) {
        if (!asset?.uri) continue
        if (merged.some((existing) => existing.uri === asset.uri)) continue
        merged.push(asset)
      }
      return merged.slice(0, 12)
    })
    setEditErrorMessage(null)
  }, [])

  const removeEditGalleryAsset = useCallback((uri: string) => {
    setEditGalleryAssets((previous) => previous.filter((asset) => asset.uri !== uri))
  }, [])

  const normalizeExtension = (name: string) => {
    const parts = name.split(".")
    if (parts.length <= 1) return name
    const ext = parts.pop()!.toLowerCase()
    const base = parts.join(".")
    const normalizedExt = ext === "jpg" ? "jpeg" : ext
    return `${base}.${normalizedExt}`
  }

  const handleSubmit = useCallback(async () => {
    if (!titre.trim()) {
      setErrorMessage(t("projects_err_title"))
      return
    }

    setSaving(true)
    setErrorMessage(null)

    try {
      const hasFiles = Boolean(logoAsset?.uri) || galleryAssets.length > 0

      if (!hasFiles) {
        const payload = {
          titre: titre.trim(),
          description: description.trim() || "",
          lien_github: githubLink.trim() || "",
          lien_demo: demoLink.trim() || "",
          skill_names: technologyTags.map((t) => t.trim()).filter(Boolean),
        }
        await createProject(payload as any)
      } else {
        const formData = new FormData()
        formData.append("titre", titre.trim())
        formData.append("description", description.trim() || "")
        formData.append("lien_github", githubLink.trim() || "")
        formData.append("lien_demo", demoLink.trim() || "")

        technologyTags.forEach((tag) => {
          formData.append("skill_names[]", tag)
        })

        if (logoAsset?.uri) {
          const fileObj = await buildFileFromAssetAsync(logoAsset)
          if (fileObj && "blob" in fileObj && fileObj.blob) {
            formData.append("image", fileObj.blob as any, fileObj.name)
          } else {
            formData.append("image", fileObj as any)
          }
        }

        for (const asset of galleryAssets) {
          const fileObj = await buildFileFromAssetAsync(asset)
          if (fileObj && "blob" in fileObj && fileObj.blob) {
            formData.append("images[]", fileObj.blob as any, fileObj.name)
          } else {
            formData.append("images[]", fileObj as any)
          }
        }

        const token = await getStoredToken()
        if (!token) {
          throw new Error("Missing authentication token")
        }

        const response = await fetch(`${API_ORIGIN.replace(/\/$/, "")}/api/projects`, {
          method: "POST",
          headers: {
            Authorization: `Bearer ${token}`,
            Accept: "application/json",
          },
          body: formData,
        })

        if (!response.ok) {
          const errorBody = await response.text()
          console.error("Multipart upload error body:", errorBody)
          throw new Error(`Upload failed: ${response.status}`)
        }

        const responseData = await response.json()
        const project = (responseData?.data as ApiProject | undefined) ?? (responseData as ApiProject)
        if (!project || typeof project.id !== "number") {
          throw new Error("Invalid project response")
        }

        await refetch()
      }

      Alert.alert(t("projects_added_title"), t("projects_added_body"))
      setTitre("")
      setDescription("")
      setTechnologyInput("")
      setTechnologyTags([])
      setGithubLink("")
      setDemoLink("")
      setLogoAsset(null)
      setGalleryAssets([])
      setShowForm(false)
    } catch (err: any) {
      console.error("Projects handleSubmit failed", err)
      setErrorMessage(err?.message ?? t("projects_err_create"))
    } finally {
      setSaving(false)
    }
  }, [createProject, demoLink, description, galleryAssets, githubLink, refetch, technologyTags, titre, t])

  const showSuccessToast = useCallback((message: string) => {
    if (Platform.OS === "android") {
      ToastAndroid.show(message, ToastAndroid.SHORT)
      return
    }
    Alert.alert(message)
  }, [])

  const resetEditForm = useCallback((project: ApiProject | null) => {
    if (!project) {
      setEditingProject(null)
      setEditTitre("")
      setEditDescription("")
      setEditTechnologyTags([])
      setEditGithubLink("")
      setEditDemoLink("")
      setEditLogoAsset(null)
      setEditGalleryAssets([])
      setEditErrorMessage(null)
      return
    }

    const defaultTags = Array.from(
      new Set(
        (project.skills ?? [])
          .map((skill: any) => normalizeTechnologyTag(skill.name ?? skill.nom ?? ""))
          .filter((tag) => tag.length > 0)
      )
    )

    setEditingProject(project)
    setEditTitre(project.titre ?? "")
    setEditDescription(project.description ?? "")
    setEditTechnologyTags(defaultTags)
    setEditGithubLink(project.lien_github ?? "")
    setEditDemoLink(project.lien_demo ?? "")
    setEditLogoAsset(null)
    setEditGalleryAssets([])
    setEditErrorMessage(null)
  }, [])

  const handleOpenEdit = useCallback((project: ApiProject) => {
    resetEditForm(project)
    setEditModalVisible(true)
  }, [resetEditForm])

  const handleCloseEdit = useCallback(() => {
    setEditModalVisible(false)
    resetEditForm(null)
  }, [resetEditForm])

  const handleUpdateProject = useCallback(async () => {
    if (!editingProject) return
    if (!editTitre.trim()) {
      setEditErrorMessage(t("projects_err_title"))
      return
    }

    setEditSaving(true)
    setEditErrorMessage(null)

    try {
      const url = `/api/projets/${editingProject.id}`
      let response
      const payload = {
        titre: editTitre.trim(),
        description: editDescription.trim() || "",
        lien_github: editGithubLink.trim() || "",
        lien_demo: editDemoLink.trim() || "",
        skill_names: editTechnologyTags.map((tag) => tag.trim()).filter(Boolean),
      }

      const hasFiles = Boolean(editLogoAsset?.uri) || editGalleryAssets.length > 0
      if (hasFiles) {
        const formData = new FormData()
        Object.entries(payload).forEach(([key, value]) => {
          if (Array.isArray(value)) {
            value.forEach((item) => formData.append(`${key}[]`, item))
          } else if (value !== undefined) {
            formData.append(key, String(value))
          }
        })

        if (editLogoAsset?.uri) {
          const fileObj: any = await buildFileFromAssetAsync(editLogoAsset)
          if (fileObj && fileObj.blob) {
            formData.append("image", fileObj.blob, fileObj.name)
          } else {
            formData.append("image", fileObj as any)
          }
        }
        for (const asset of editGalleryAssets) {
          const fileObj: any = await buildFileFromAssetAsync(asset)
          if (fileObj && fileObj.blob) {
            formData.append("images[]", fileObj.blob, fileObj.name)
          } else {
            formData.append("images[]", fileObj as any)
          }
        }

        response = await api.put(url, formData)
      } else {
        response = await api.put(url, payload)
      }

      const updatedProject =
        (response.data?.data as ApiProject | undefined) ??
        (response.data as ApiProject)

      if (!updatedProject || typeof updatedProject.id !== "number") {
        throw new Error("Invalid update response")
      }

      updateProject(updatedProject)
      if (selectedProject?.id === updatedProject.id) {
        setSelectedProject(updatedProject)
      }
      handleCloseEdit()
      showSuccessToast("Projet mis à jour")
    } catch (err: any) {
      const srv = err?.response?.data
      const msg = srv?.message ?? (srv?.errors ? Object.values(srv.errors).flat().join(' ') : null) ?? err?.message
      setEditErrorMessage(msg ?? "Impossible de mettre à jour ce projet pour le moment.")
    } finally {
      setEditSaving(false)
    }
  }, [editDescription, editDemoLink, editGithubLink, editLogoAsset, editGalleryAssets, editTechnologyTags, editTitre, editingProject, handleCloseEdit, selectedProject, showSuccessToast, t, updateProject])

  const handleDeleteProject = useCallback(
    (project: ApiProject) => {
      Alert.alert(
        "Supprimer le projet",
        "Voulez-vous vraiment supprimer ce projet ?",
        [
          { text: "Annuler", style: "cancel" },
          {
            text: "Supprimer",
            style: "destructive",
            onPress: async () => {
              try {
                const response = await api.delete(`/api/projets/${project.id}`)
                if (response.status === 200) {
                  removeProject(project.id)
                  if (selectedProject?.id === project.id) {
                    setSelectedProject(null)
                    setDetailsVisible(false)
                  }
                  showSuccessToast("Projet supprimé")
                } else {
                  throw new Error("Delete failed")
                }
              } catch {
                Alert.alert("Erreur", "Impossible de supprimer ce projet pour le moment.")
              }
            },
          },
        ],
        { cancelable: true }
      )
    },
    [removeProject, selectedProject, showSuccessToast]
  )

  return (
    <ScrollView
      className="flex-1 px-4 pt-6"
      contentContainerStyle={{ paddingBottom: tabBarHeight + SCROLL_EXTRA_BELOW_TAB_BAR }}
      refreshControl={
        <RefreshControl
          refreshing={refreshing}
          onRefresh={() => void refetch()}
          tintColor={THEME.accent}
        />
      }
    >
      <View className="mb-6 flex-row items-center justify-between gap-3">
        <View className="flex-1">
          <Text className="text-3xl font-bold tracking-tight text-foreground">
            {t("projects_title")}
          </Text>
          <Text className="mt-1 text-sm text-muted-foreground">{projectCountLabel}</Text>
        </View>
        <TouchableOpacity
          onPress={() => setShowForm((prev) => !prev)}
          className="rounded-3xl bg-primary/10 px-4 py-3"
          activeOpacity={0.85}
        >
          <View className="flex-row items-center gap-2">
            <PlusCircle size={18} color={THEME.primary} />
            <Text className="font-semibold text-primary">{t("projects_add")}</Text>
          </View>
        </TouchableOpacity>
      </View>

      {showForm ? (
        <GlassCard className="mb-6" contentClassName="gap-4 p-4">
          <Text className="text-sm font-semibold text-foreground">{t("projects_form_title")}</Text>

          <AuthTextField
            label={t("projects_field_title")}
            value={titre}
            onChangeText={setTitre}
            placeholder={t("projects_field_title_ph")}
            leftIcon={<TextCursorInput size={18} color={THEME.muted} />}
          />

          <AuthTextField
            label={t("projects_field_description")}
            value={description}
            onChangeText={setDescription}
            placeholder={t("projects_field_description_ph")}
            multiline
            numberOfLines={6}
            leftIcon={<Briefcase size={18} color={THEME.muted} />}
          />

          <AuthTextField
            label={t("projects_field_technologies")}
            value={technologyInput}
            onChangeText={setTechnologyInput}
            placeholder={t("projects_field_technologies_ph")}
            leftIcon={<Code2 size={18} color={THEME.muted} />}
            autoCapitalize="words"
          />

          <View className="flex-row flex-wrap gap-2">
            {technologyTags.map((tag) => (
              <Pressable
                key={tag}
                onPress={() => removeTechnologyTag(tag)}
                className="flex-row items-center rounded-full border border-border bg-surface px-3 py-2"
                android_ripple={{ color: "rgba(148,163,184,.12)" }}
              >
                <Text className="mr-2 text-sm text-foreground">{tag}</Text>
                <X size={14} color="rgb(148,163,184)" />
              </Pressable>
            ))}
          </View>

          <View className="flex-row flex-wrap gap-2">
            {technologySuggestions.slice(0, 8).map((tag) => (
              <Pressable
                key={tag}
                onPress={() => toggleTechnologyTag(tag)}
                className={`rounded-full px-3 py-2 ${technologySet.has(tag.toLowerCase()) ? "bg-primary/15 border border-primary" : "bg-surface border border-border"}`}
                android_ripple={{ color: "rgba(59,130,246,.12)" }}
              >
                <Text className={`${technologySet.has(tag.toLowerCase()) ? "text-primary" : "text-muted-foreground"} text-sm`}>{tag}</Text>
              </Pressable>
            ))}
          </View>

          <AuthTextField
            label={t("projects_field_github")}
            value={githubLink}
            onChangeText={setGithubLink}
            placeholder={t("projects_field_github_ph")}
            leftIcon={<Link2 size={18} color={THEME.muted} />}
            autoCapitalize="none"
            keyboardType="url"
          />

          <AuthTextField
            label={t("projects_field_demo")}
            value={demoLink}
            onChangeText={setDemoLink}
            placeholder={t("projects_field_demo_ph")}
            leftIcon={<Link2 size={18} color={THEME.muted} />}
            autoCapitalize="none"
            keyboardType="url"
          />

          <TouchableOpacity
            activeOpacity={0.85}
            onPress={pickLogo}
            className="rounded-2xl border border-border bg-surface px-4 py-3"
          >
            <View className="flex-row items-center gap-2">
              <Upload size={18} color={THEME.muted} />
              <Text className="font-medium text-foreground">{t("projects_field_logo")}</Text>
            </View>
            <Text className="mt-1 text-sm text-muted-foreground">{t("projects_field_logo_hint")}</Text>
          </TouchableOpacity>
          {logoAsset?.uri ? (
            <Image
              source={{ uri: logoAsset.uri }}
              style={{ width: "100%", height: 140, borderRadius: 10, marginTop: 10 }}
              resizeMode="cover"
            />
          ) : null}

          <TouchableOpacity
            activeOpacity={0.85}
            onPress={pickGalleryImages}
            className="rounded-2xl border border-border bg-surface px-4 py-3"
          >
            <View className="flex-row items-center gap-2">
              <Upload size={18} color={THEME.muted} />
              <Text className="font-medium text-foreground">{t("projects_field_screenshots")}</Text>
            </View>
            <Text className="mt-1 text-sm text-muted-foreground">{t("projects_field_screenshots_hint")}</Text>
          </TouchableOpacity>
          {galleryAssets.length > 0 ? (
            <View className="mt-3 flex-row flex-wrap gap-3">
              {galleryAssets.map((asset) => (
                <View
                  key={asset.uri}
                  className="relative w-[110px] overflow-hidden rounded-2xl border border-border bg-slate-950/5"
                >
                  <Image source={{ uri: asset.uri }} style={{ width: 110, height: 110 }} resizeMode="cover" />
                  <Pressable
                    onPress={() => removeGalleryAsset(asset.uri)}
                    className="absolute right-2 top-2 rounded-full bg-black/60 p-1"
                  >
                    <X size={14} color="#fff" />
                  </Pressable>
                </View>
              ))}
            </View>
          ) : null}

          {errorMessage ? (
            <Text className="text-sm text-rose-300">{errorMessage}</Text>
          ) : null}

          <GradientButton onPress={handleSubmit} loading={saving} disabled={saving}>
            {t("projects_submit")}
          </GradientButton>
        </GlassCard>
      ) : null}

      <View className="space-y-4">
        {projects.length === 0 ? (
          <GlassCard contentClassName="px-4 py-7">
            <Text className="text-center text-sm leading-6 text-muted-foreground">
              {t("projects_empty")}
            </Text>
          </GlassCard>
        ) : (
          projects.map((project) => {
              const coverUrl = getProjectCoverUrl(project)
              const openDetails = () => {
                setSelectedProject(project)
                setDetailsVisible(true)
              }

              return (
                <TouchableOpacity key={project.id} activeOpacity={0.9} onPress={openDetails}>
                  <GlassCard
                    plain
                    className="overflow-hidden"
                    style={{ marginVertical: 12, borderRadius: 12 }}
                    contentClassName="p-4"
                  >
                    {coverUrl ? (
                      <Image
                        source={{ uri: coverUrl }}
                        style={{ width: "100%", height: 160, borderRadius: 12 }}
                        resizeMode="cover"
                      />
                    ) : null}
                    <View className="mt-4 flex-row items-start justify-between gap-3">
                      <View className="min-w-0 flex-1">
                        <Text className="text-lg font-semibold text-foreground">{project.titre}</Text>
                        {project.description ? (
                          <Text className="mt-2 text-sm leading-6 text-muted-foreground" numberOfLines={3}>
                            {project.description}
                          </Text>
                        ) : null}
                        {project.skills?.length ? (
                          <View className="mt-3 flex-row flex-wrap gap-2">
                            {project.skills.map((skill) => {
                              const label = normalizeTechnologyTag(skill.name ?? skill.nom ?? "")
                              if (!label) return null
                              return (
                                <View key={label} className="rounded-full border border-border bg-surface px-3 py-1">
                                  <Text className="text-xs text-muted-foreground">{label}</Text>
                                </View>
                              )
                            })}
                          </View>
                        ) : null}
                      </View>
                      <ArrowRight size={20} color={THEME.muted} />
                    </View>
                    <View className="mt-4 flex-row items-center justify-end gap-3">
                      <TouchableOpacity
                        onPress={() => handleOpenEdit(project)}
                        activeOpacity={0.85}
                        className="rounded-2xl border border-border bg-surface px-3 py-2"
                      >
                        <View className="flex-row items-center gap-2">
                          <Edit3 size={16} color={THEME.foreground} />
                          <Text className="text-sm text-foreground">Modifier</Text>
                        </View>
                      </TouchableOpacity>
                      <TouchableOpacity
                        onPress={() => handleDeleteProject(project)}
                        activeOpacity={0.85}
                        className="rounded-2xl border border-border bg-surface px-3 py-2"
                      >
                        <View className="flex-row items-center gap-2">
                          <Trash2 size={16} color="#EF4444" />
                          <Text className="text-sm text-rose-400">Supprimer</Text>
                        </View>
                      </TouchableOpacity>
                    </View>
                    {project.lien_github ? (
                      <Text className="mt-3 text-sm text-primary">{project.lien_github}</Text>
                    ) : null}
                    {project.lien_demo ? (
                      <Text className="mt-1 text-sm text-primary">{project.lien_demo}</Text>
                    ) : null}
                    {project.created_at ? (
                      <Text className="mt-2 text-xs text-muted-foreground">
                        {new Date(project.created_at).toLocaleDateString()}
                      </Text>
                    ) : null}
                  </GlassCard>
                </TouchableOpacity>
              )
            })
        )}
      </View>
      {selectedProject ? (
        <Modal
          visible={detailsVisible}
          animationType="slide"
          transparent={true}
          onRequestClose={() => setDetailsVisible(false)}
        >
          <View style={{ flex: 1, backgroundColor: "rgba(0,0,0,0.5)", padding: 18, justifyContent: "center" }}>
            <GlassCard style={{ maxHeight: "92%" }} contentClassName="p-4">
              <View className="flex-row items-center justify-between">
                <Text className="text-xl font-bold text-foreground">{selectedProject.titre}</Text>
                <TouchableOpacity onPress={() => setDetailsVisible(false)} activeOpacity={0.8}>
                  <X size={20} color={THEME.muted} />
                </TouchableOpacity>
              </View>

              <ScrollView style={{ marginTop: 10 }}>
                {selectedProject.description ? (
                  <Text className="text-sm text-muted-foreground">{selectedProject.description}</Text>
                ) : null}

                {selectedProject.skills?.length ? (
                  <View style={{ flexDirection: "row", flexWrap: "wrap", marginTop: 12 }}>
                    {selectedProject.skills.map((s: any) => {
                      const label = normalizeTechnologyTag(s.name ?? s.nom ?? "")
                      if (!label) return null
                      return (
                        <View key={label} style={{ borderRadius: 20, paddingHorizontal: 12, paddingVertical: 6, borderWidth: 1, borderColor: "rgba(255,255,255,0.06)", marginRight: 8, marginBottom: 8 }}>
                          <Text className="text-xs text-muted-foreground">{label}</Text>
                        </View>
                      )
                    })}
                  </View>
                ) : null}

                <View style={{ marginTop: 12 }}>
                  {selectedProject.lien_github ? (
                    <TouchableOpacity onPress={() => void Linking.openURL(selectedProject.lien_github)}>
                      <Text className="text-sm text-primary">{selectedProject.lien_github}</Text>
                    </TouchableOpacity>
                  ) : null}
                  {selectedProject.lien_demo ? (
                    <TouchableOpacity onPress={() => void Linking.openURL(selectedProject.lien_demo)}>
                      <Text className="mt-2 text-sm text-primary">{selectedProject.lien_demo}</Text>
                    </TouchableOpacity>
                  ) : null}
                </View>

                {selectedProject.projectImages?.length ? (
                  <ScrollView horizontal showsHorizontalScrollIndicator={false} style={{ marginTop: 14 }}>
                    {selectedProject.projectImages.map((img: any, idx: number) => {
                      const url = getLaravelStorageUrl(img.image_path, "projectScreenshot")
                      return (
                        <Image
                          key={idx}
                          source={{ uri: url }}
                          style={{ width: 300, height: 180, borderRadius: 10, marginRight: 12 }}
                          resizeMode="cover"
                        />
                      )
                    })}
                  </ScrollView>
                ) : null}
              </ScrollView>
            </GlassCard>
          </View>
        </Modal>
      ) : null}
      {editModalVisible ? (
        <Modal
          visible={editModalVisible}
          animationType="slide"
          transparent={true}
          onRequestClose={handleCloseEdit}
        >
          <View style={{ flex: 1, backgroundColor: "rgba(0,0,0,0.5)", padding: 18, justifyContent: "center" }}>
            <GlassCard style={{ maxHeight: "92%" }} contentClassName="p-4">
              <View className="flex-row items-center justify-between">
                <Text className="text-xl font-bold text-foreground">Modifier le projet</Text>
                <TouchableOpacity onPress={handleCloseEdit} activeOpacity={0.8}>
                  <X size={20} color={THEME.muted} />
                </TouchableOpacity>
              </View>

              <ScrollView style={{ marginTop: 10 }}>
                <Text className="text-sm font-semibold text-foreground mb-2">Détails du projet</Text>
                <AuthTextField
                  label={t("projects_field_title")}
                  value={editTitre}
                  onChangeText={setEditTitre}
                  placeholder={t("projects_field_title_ph")}
                  leftIcon={<TextCursorInput size={18} color={THEME.muted} />}
                />

                <AuthTextField
                  label={t("projects_field_description")}
                  value={editDescription}
                  onChangeText={setEditDescription}
                  placeholder={t("projects_field_description_ph")}
                  multiline
                  numberOfLines={6}
                  leftIcon={<Briefcase size={18} color={THEME.muted} />}
                />

                <View className="gap-3">
                  <Text className="text-sm font-semibold text-foreground">Technologies</Text>
                  <View className="flex-row flex-wrap gap-2">
                    {technologySuggestions.map((tag) => (
                      <Pressable
                        key={tag}
                        onPress={() => toggleEditTechnologyTag(tag)}
                        className={`rounded-full px-3 py-2 ${editTechnologyTags.some((existing) => existing.toLowerCase() === tag.toLowerCase()) ? "bg-primary/15 border border-primary" : "bg-surface border border-border"}`}
                        android_ripple={{ color: "rgba(59,130,246,.12)" }}
                      >
                        <Text className={`${editTechnologyTags.some((existing) => existing.toLowerCase() === tag.toLowerCase()) ? "text-primary" : "text-muted-foreground"} text-sm`}>{tag}</Text>
                      </Pressable>
                    ))}
                  </View>

                  <View className="flex-row flex-wrap gap-2">
                    {editTechnologyTags.map((tag) => (
                      <Pressable
                        key={tag}
                        onPress={() => removeEditTechnologyTag(tag)}
                        className="flex-row items-center rounded-full border border-border bg-surface px-3 py-2"
                        android_ripple={{ color: "rgba(148,163,184,.12)" }}
                      >
                        <Text className="mr-2 text-sm text-foreground">{tag}</Text>
                        <X size={14} color="rgb(148,163,184)" />
                      </Pressable>
                    ))}
                  </View>

                </View>

                <View className="gap-3">
                  <Text className="text-sm font-semibold text-foreground">Liens</Text>
                  <AuthTextField
                    label={t("projects_field_github")}
                    value={editGithubLink}
                    onChangeText={setEditGithubLink}
                    placeholder={t("projects_field_github_ph")}
                    leftIcon={<Link2 size={18} color={THEME.muted} />}
                    autoCapitalize="none"
                    keyboardType="url"
                  />

                  <AuthTextField
                    label={t("projects_field_demo")}
                    value={editDemoLink}
                    onChangeText={setEditDemoLink}
                    placeholder={t("projects_field_demo_ph")}
                    leftIcon={<Link2 size={18} color={THEME.muted} />}
                    autoCapitalize="none"
                    keyboardType="url"
                  />
                </View>

                <View className="gap-3">
                  <Text className="text-sm font-semibold text-foreground">Médias</Text>
                  <TouchableOpacity
                    activeOpacity={0.85}
                    onPress={pickEditLogo}
                    className="rounded-2xl border border-border bg-surface px-4 py-3"
                  >
                  <View className="flex-row items-center gap-2">
                    <Upload size={18} color={THEME.muted} />
                    <Text className="font-medium text-foreground">{t("projects_field_logo")}</Text>
                  </View>
                  <Text className="mt-1 text-sm text-muted-foreground">{t("projects_field_logo_hint")}</Text>
                </TouchableOpacity>
                {editLogoAsset?.uri ? (
                  <Image
                    source={{ uri: editLogoAsset.uri }}
                    style={{ width: "100%", height: 140, borderRadius: 10, marginTop: 10 }}
                    resizeMode="cover"
                  />
                ) : null}

                <TouchableOpacity
                  activeOpacity={0.85}
                  onPress={pickEditGalleryImages}
                  className="rounded-2xl border border-border bg-surface px-4 py-3"
                >
                  <View className="flex-row items-center gap-2">
                    <Upload size={18} color={THEME.muted} />
                    <Text className="font-medium text-foreground">{t("projects_field_screenshots")}</Text>
                  </View>
                  <Text className="mt-1 text-sm text-muted-foreground">{t("projects_field_screenshots_hint")}</Text>
                </TouchableOpacity>
              </View>
                {editGalleryAssets.length > 0 ? (
                  <View className="mt-3 flex-row flex-wrap gap-3">
                    {editGalleryAssets.map((asset) => (
                      <View
                        key={asset.uri}
                        className="relative w-[110px] overflow-hidden rounded-2xl border border-border bg-slate-950/5"
                      >
                        <Image source={{ uri: asset.uri }} style={{ width: 110, height: 110 }} resizeMode="cover" />
                        <Pressable
                          onPress={() => removeEditGalleryAsset(asset.uri)}
                          className="absolute right-2 top-2 rounded-full bg-black/60 p-1"
                        >
                          <X size={14} color="#fff" />
                        </Pressable>
                      </View>
                    ))}
                  </View>
                ) : null}

                {editErrorMessage ? (
                  <Text className="text-sm text-rose-300">{editErrorMessage}</Text>
                ) : null}

                <GradientButton
                  className="my-4"
                  onPress={handleUpdateProject}
                  loading={editSaving}
                  disabled={editSaving}
                >
                  Enregistrer les modifications
                </GradientButton>
              </ScrollView>
            </GlassCard>
          </View>
        </Modal>
      ) : null}
    </ScrollView>
  )
}
