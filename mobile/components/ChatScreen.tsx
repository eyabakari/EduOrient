import { useEffect, useState, useRef, useCallback } from "react"
import {
  View,
  Text,
  FlatList,
  TextInput,
  TouchableOpacity,
  ActivityIndicator,
  Image,
} from "react-native"
import { useSafeAreaInsets } from "react-native-safe-area-context"
import { ChevronLeft, Send, Smile } from "lucide-react-native"
import { api } from "@/lib/api"
import { useAuth } from "@/context/auth-context"
import { useAppTheme } from "@/context/app-theme-context"

type Message = {
  id: number
  sender_id: number
  content: string
  created_at: string
  sender?: { id: number; name: string }
}

type ConversationData = {
  id: number
  other_user?: { id: number; name: string; photo_url?: string | null } | null
}

export default function ChatScreen({ conversationId, onBack }: { conversationId: number; onBack?: () => void }) {
  const { theme: THEME } = useAppTheme()
  const { user } = useAuth()
  const insets = useSafeAreaInsets()
  const bottomPadding = Math.max(insets.bottom, 12)
  const [messages, setMessages] = useState<Message[]>([])
  const [conversationData, setConversationData] = useState<ConversationData | null>(null)
  const [loading, setLoading] = useState(true)
  const [sending, setSending] = useState(false)
  const [text, setText] = useState("")
  const listRef = useRef<FlatList>(null)
  const pollingRef = useRef<number | null>(null)

  const fetchMessages = useCallback(async () => {
    try {
      const res = await api.get(`/conversations/${conversationId}/messages`)
      const data = res.data?.data ?? []
      setMessages(data)
      
      // Try to fetch conversation data to get other_user
      if (!conversationData) {
        try {
          const convRes = await api.get(`/conversations/${conversationId}`)
          const convData = convRes.data?.data ?? null
          if (convData) setConversationData(convData)
        } catch {
          // Ignore, we'll show a generic header
        }
      }
    } catch (e) {
      console.error("Erreur fetch messages", e)
    } finally {
      setLoading(false)
    }
  }, [conversationId, conversationData])

  useEffect(() => {
    setLoading(true)
    void fetchMessages()

    const id = setInterval(() => {
      void fetchMessages()
    }, 3000)
    pollingRef.current = Number(id)

    return () => {
      if (pollingRef.current) clearInterval(pollingRef.current)
    }
  }, [fetchMessages])

  const sendMessage = async () => {
    if (!text.trim()) return
    setSending(true)
    try {
      const res = await api.post(`/conversations/${conversationId}/messages`, { content: text.trim() })
      const created: Message = res.data?.data
      setMessages((m) => [...m, created])
      setText("")
      setTimeout(() => listRef.current?.scrollToEnd({ animated: true }), 100)
    } catch (e) {
      console.error("Erreur send message", e)
    } finally {
      setSending(false)
    }
  }

  const renderItem = ({ item }: { item: Message }) => {
    const isMine = item.sender_id === user?.id
    return (
      <View style={{ flexDirection: "row", justifyContent: isMine ? "flex-end" : "flex-start", paddingHorizontal: 16, marginVertical: 4 }}>
        <View
          style={{
            maxWidth: "78%",
            backgroundColor: isMine ? "#7C3AED" : "#F3F4F6",
            padding: 12,
            borderTopLeftRadius: 18,
            borderTopRightRadius: 18,
            borderBottomLeftRadius: isMine ? 18 : 0,
            borderBottomRightRadius: isMine ? 0 : 18,
            shadowColor: "#000",
            shadowOpacity: 0.08,
            shadowRadius: 4,
            shadowOffset: { width: 0, height: 2 },
            elevation: 2,
          }}
        >
          <Text style={{ color: isMine ? "white" : "#1F2937", fontSize: 15, lineHeight: 20 }}>{item.content}</Text>
          <Text style={{ color: isMine ? "rgba(255,255,255,0.7)" : "#9CA3AF", fontSize: 11, marginTop: 6, textAlign: "right" }}>
            {new Date(item.created_at).toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" })}
          </Text>
        </View>
      </View>
    )
  }

  const otherUser = conversationData?.other_user

  return (
    <View style={{ flex: 1, backgroundColor: THEME.background }}>
      {/* Header */}
      <View
        style={{
          flexDirection: "row",
          alignItems: "center",
          paddingHorizontal: 16,
          paddingVertical: 12,
          borderBottomWidth: 1,
          borderBottomColor: THEME.border,
          backgroundColor: THEME.card,
        }}
      >
        <TouchableOpacity onPress={onBack} style={{ width: 40, height: 40, alignItems: "center", justifyContent: "center" }}>
          <ChevronLeft size={24} color={THEME.foreground} />
        </TouchableOpacity>

        <View style={{ flex: 1, flexDirection: "row", alignItems: "center", justifyContent: "center", marginLeft: -40 }}>
          {otherUser?.photo_url ? (
            <Image source={{ uri: otherUser.photo_url }} style={{ width: 40, height: 40, borderRadius: 20, marginRight: 12 }} />
          ) : (
            <View
              style={{
                width: 40,
                height: 40,
                borderRadius: 20,
                backgroundColor: "#7C3AED",
                alignItems: "center",
                justifyContent: "center",
                marginRight: 12,
              }}
            >
              <Text style={{ color: "white", fontWeight: "700", fontSize: 16 }}>
                {(otherUser?.name || "?").slice(0, 1).toUpperCase()}
              </Text>
            </View>
          )}
          <Text style={{ color: THEME.foreground, fontWeight: "700", fontSize: 16 }}>
            {otherUser?.name ?? "Discussion"}
          </Text>
        </View>
      </View>

      {/* Messages */}
      <View style={{ flex: 1 }}>
        {loading ? (
          <View style={{ flex: 1, alignItems: "center", justifyContent: "center" }}>
            <ActivityIndicator size="large" color={THEME.primary} />
          </View>
        ) : messages.length === 0 ? (
          <View style={{ flex: 1, alignItems: "center", justifyContent: "center", paddingHorizontal: 20 }}>
            <Text style={{ color: THEME.muted, textAlign: "center", fontSize: 16 }}>Aucun message. Lancez la conversation!</Text>
          </View>
        ) : (
          <FlatList
            ref={listRef}
            data={messages}
            keyExtractor={(i) => String(i.id)}
            renderItem={renderItem}
            contentContainerStyle={{ paddingVertical: 12, paddingBottom: 20 + bottomPadding }}
            keyboardShouldPersistTaps="handled"
          />
        )}
      </View>

      {/* Input Container */}
      <View
        style={{
          paddingHorizontal: 16,
          paddingVertical: 12,
          paddingBottom: bottomPadding,
          backgroundColor: THEME.background,
        }}
      >
        <View
          style={{
            flexDirection: "row",
            alignItems: "flex-end",
            borderRadius: 24,
            backgroundColor: "#F3F4F6",
            paddingHorizontal: 16,
            paddingVertical: 8,
            borderWidth: 1,
            borderColor: "#E5E7EB",
          }}
        >
          <Smile size={20} color="#9CA3AF" style={{ marginRight: 8 }} />
          <TextInput
            value={text}
            onChangeText={setText}
            placeholder="Écrire un message..."
            placeholderTextColor="#9CA3AF"
            style={{
              flex: 1,
              maxHeight: 100,
              paddingVertical: 8,
              paddingHorizontal: 0,
              color: THEME.foreground,
              fontSize: 15,
            }}
            multiline
          />
          <TouchableOpacity
            onPress={sendMessage}
            disabled={sending || text.trim().length === 0}
            style={{
              width: 36,
              height: 36,
              borderRadius: 18,
              backgroundColor: sending || text.trim().length === 0 ? "#D1D5DB" : "#7C3AED",
              alignItems: "center",
              justifyContent: "center",
              marginLeft: 8,
            }}
          >
            {sending ? (
              <ActivityIndicator size="small" color="white" />
            ) : (
              <Send size={18} color="white" />
            )}
          </TouchableOpacity>
        </View>
      </View>
    </View>
  )
}
