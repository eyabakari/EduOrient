import React, { useState } from "react"
import { ActivityIndicator, Alert, Linking, Modal, Pressable, Text, TouchableOpacity, View } from "react-native"
import { Mail, MessageSquare } from "lucide-react-native"
import { api } from "@/lib/api"
import { useAppTheme } from "@/context/app-theme-context"
import { useAppNavigation } from "@/context/app-navigation-context"
import { useAuth } from "@/context/auth-context"

type ReceiverType = "student" | "recruiter"

type Props = {
  email?: string | null
  receiverId?: number | null
  receiverType?: ReceiverType
  label?: string
}

export function ContactButton({ email, receiverId, receiverType, label = "Contacter" }: Props) {
  const { theme: THEME } = useAppTheme()
  const nav = useAppNavigation()
  const [show, setShow] = useState(false)
  const [loading, setLoading] = useState(false)

  const openEmail = async () => {
    setShow(false)
    if (!email) {
      Alert.alert("Adresse email manquante", "Impossible d'ouvrir le client mail : adresse introuvable.")
      return
    }
    try {
      const subject = encodeURIComponent("Contact via ProLink")
      const url = `mailto:${email}?subject=${subject}`
      await Linking.openURL(url)
    } catch (err) {
      Alert.alert("Erreur", "Impossible d'ouvrir le client mail sur cet appareil.")
    }
  }

  const { user } = useAuth()

  const openConversation = async () => {
    if (!receiverId) {
      Alert.alert("Impossible", "Identifiant du destinataire manquant.")
      return
    }

    const currentRole = String(user?.role?.name ?? "").trim().toLowerCase()
    const payloadKey = receiverType
      ? receiverType === "student"
        ? "candidat_id"
        : "recruteur_id"
      : currentRole === "recruteur"
      ? "candidat_id"
      : "recruteur_id"

    setLoading(true)
    try {
      const resp = await api.post("/conversations", { [payloadKey]: receiverId })
      const data = resp.data || {}
      const id = (data && (data.data?.id ?? data.id ?? data.data?.conversation?.id)) as number | undefined
      if (typeof id === "number") {
        setShow(false)
        nav.openConversation(id)
        return
      }
      // Try common nested shapes
      const fallbackId = (data.data && (data.data.id ?? (data.data as any).conversation?.id)) as number | undefined
      if (typeof fallbackId === "number") {
        setShow(false)
        nav.openConversation(fallbackId)
        return
      }
      Alert.alert("Erreur", "Conversation créée mais identifiant introuvable dans la réponse")
    } catch (e: any) {
      console.error("openConversation error", e)
      Alert.alert("Erreur réseau", e?.message ?? "Impossible de créer ou récupérer la conversation.")
    } finally {
      setLoading(false)
    }
  }

  return (
    <>
      <TouchableOpacity
        activeOpacity={0.88}
        onPress={() => setShow(true)}
        className="flex-row items-center gap-2 rounded-lg px-3 py-2"
        style={{ backgroundColor: THEME.primary }}
      >
        <Mail size={16} color="#fff" />
        <Text style={{ color: "#fff", fontWeight: "700" }}>{label}</Text>
      </TouchableOpacity>

      <Modal visible={show} transparent animationType="slide" onRequestClose={() => setShow(false)}>
        <View className="flex-1 justify-end" style={{ backgroundColor: "rgba(0,0,0,0.48)" }}>
          <View style={{ borderTopLeftRadius: 18, borderTopRightRadius: 18, padding: 16, backgroundColor: THEME.background, borderColor: THEME.border, borderWidth: 1 }}>
            <Text className="mb-3 text-base font-bold" style={{ color: THEME.foreground }}>Contacter</Text>

            <Pressable onPress={openEmail} style={{ paddingVertical: 14, flexDirection: "row", alignItems: "center" }}>
              <Mail size={18} color={THEME.foreground} />
              <Text style={{ marginLeft: 12, color: THEME.foreground, fontWeight: "600" }}>Par Email</Text>
            </Pressable>

            <Pressable onPress={openConversation} style={{ paddingVertical: 14, flexDirection: "row", alignItems: "center" }}>
              <MessageSquare size={18} color={THEME.foreground} />
              <Text style={{ marginLeft: 12, color: THEME.foreground, fontWeight: "600" }}>Via Messagerie ProLink</Text>
              {loading ? <ActivityIndicator style={{ marginLeft: 12 }} color={THEME.primary} /> : null}
            </Pressable>

            <View className="mt-3">
              <Pressable onPress={() => setShow(false)} style={{ paddingVertical: 12, alignItems: "center" }}>
                <Text style={{ color: THEME.muted }}>Annuler</Text>
              </Pressable>
            </View>
          </View>
        </View>
      </Modal>
    </>
  )
}

export default ContactButton
