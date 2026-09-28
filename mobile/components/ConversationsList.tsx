import { useEffect, useState, useCallback } from "react"
import {
  View,
  Text,
  FlatList,
  TouchableOpacity,
  Image,
  ActivityIndicator,
  RefreshControl,
} from "react-native"
import { api } from "@/lib/api"
import { useAuth } from "@/context/auth-context"
import { useAppTheme } from "@/context/app-theme-context"
import { useBottomTabBarHeight } from "@/hooks/use-bottom-tab-bar-height"

type ConversationSummary = {
  id: number
  other_user: { id: number; name: string; photo_url?: string | null } | null
  last_message?: { content?: string | null }
  unread_count?: number
}

export default function ConversationsList({ onOpenConversation }: { onOpenConversation: (id: number) => void }) {
  const { theme: THEME } = useAppTheme()
  const { user } = useAuth()
  const tabBarHeight = useBottomTabBarHeight()
  const [loading, setLoading] = useState(true)
  const [refreshing, setRefreshing] = useState(false)
  const [conversations, setConversations] = useState<ConversationSummary[]>([])
  const [error, setError] = useState<string | null>(null)

  const fetchConversations = useCallback(async () => {
    setError(null)
    try {
      const res = await api.get("/conversations")
      setConversations(res.data?.data ?? [])
    } catch (e: any) {
      console.error("Erreur conversations:", e)
      setError((e?.response?.data?.message as string) || "Impossible de charger les conversations.")
    } finally {
      setLoading(false)
      setRefreshing(false)
    }
  }, [])

  useEffect(() => {
    void fetchConversations()
  }, [fetchConversations])

  const onRefresh = useCallback(() => {
    setRefreshing(true)
    void fetchConversations()
  }, [fetchConversations])

  if (loading) {
    return (
      <View className="flex-1 items-center justify-center" style={{ backgroundColor: THEME.background }}>
        <ActivityIndicator size="large" color={THEME.primary} />
      </View>
    )
  }

  return (
    <View style={{ flex: 1, backgroundColor: THEME.background }}>
      {/* Header */}
      <View
        style={{
          paddingHorizontal: 16,
          paddingVertical: 16,
          borderBottomWidth: 1,
          borderBottomColor: THEME.border,
          backgroundColor: THEME.card,
        }}
      >
        <Text style={{ fontSize: 28, fontWeight: "800", color: THEME.foreground }}>Messagerie</Text>
        <Text style={{ fontSize: 13, marginTop: 4, color: THEME.muted }}>Gérez vos discussions</Text>
      </View>

      <FlatList
        data={conversations}
        keyExtractor={(i) => String(i.id)}
        refreshControl={<RefreshControl refreshing={refreshing} onRefresh={onRefresh} tintColor={THEME.primary} />}
        contentContainerStyle={{ paddingHorizontal: 12, paddingVertical: 12, paddingBottom: 20 + tabBarHeight }}
        renderItem={({ item }) => (
          <TouchableOpacity
            onPress={() => onOpenConversation(item.id)}
            activeOpacity={0.7}
            style={{
              flexDirection: "row",
              padding: 16,
              marginVertical: 6,
              alignItems: "center",
              borderRadius: 16,
              backgroundColor: THEME.card,
              borderWidth: 1,
              borderColor: THEME.border,
              shadowColor: "#000",
              shadowOpacity: 0.04,
              shadowRadius: 4,
              shadowOffset: { width: 0, height: 1 },
              elevation: 1,
            }}
          >
            {/* Avatar */}
            <View style={{ width: 56, height: 56, borderRadius: 28, overflow: "hidden", marginRight: 12, backgroundColor: THEME.mutedSurface }}>
              {item.other_user?.photo_url ? (
                <Image source={{ uri: item.other_user.photo_url }} style={{ width: "100%", height: "100%" }} />
              ) : (
                <View
                  style={{
                    alignItems: "center",
                    justifyContent: "center",
                    flex: 1,
                    backgroundColor: "#7C3AED",
                  }}
                >
                  <Text style={{ color: "white", fontWeight: "700", fontSize: 18 }}>
                    {(item.other_user?.name || "?").slice(0, 1).toUpperCase()}
                  </Text>
                </View>
              )}
            </View>

            {/* Content */}
            <View style={{ flex: 1 }}>
              <Text style={{ color: THEME.foreground, fontWeight: "700", fontSize: 16 }}>
                {item.other_user?.name ?? "Contact"}
              </Text>
              <Text
                numberOfLines={1}
                style={{
                  color: THEME.muted,
                  marginTop: 4,
                  fontSize: 13,
                  fontWeight: "400",
                }}
              >
                {item.last_message?.content ?? "Aucun message"}
              </Text>
            </View>

            {/* Unread Badge */}
            {item.unread_count ? (
              <View
                style={{
                  minWidth: 28,
                  height: 28,
                  borderRadius: 14,
                  backgroundColor: "#7C3AED",
                  alignItems: "center",
                  justifyContent: "center",
                  paddingHorizontal: 8,
                  marginLeft: 12,
                  shadowColor: "#7C3AED",
                  shadowOpacity: 0.3,
                  shadowRadius: 4,
                  shadowOffset: { width: 0, height: 2 },
                  elevation: 3,
                }}
              >
                <Text style={{ color: "white", fontWeight: "700", fontSize: 12 }}>
                  {item.unread_count > 99 ? "99+" : item.unread_count}
                </Text>
              </View>
            ) : null}
          </TouchableOpacity>
        )}
        ListEmptyComponent={() => (
          <View style={{ flex: 1, alignItems: "center", justifyContent: "center", paddingVertical: 60 }}>
            <Text style={{ color: THEME.muted, fontSize: 16, textAlign: "center", marginBottom: 8 }}>
              Aucune conversation
            </Text>
            <Text style={{ color: THEME.muted, fontSize: 13, textAlign: "center", marginHorizontal: 24 }}>
              Commencez une nouvelle discussion en contactant des recruteurs
            </Text>
          </View>
        )}
      />

      {error && (
        <View style={{ paddingHorizontal: 16, paddingVertical: 12, backgroundColor: "#FEE2E2", borderTopWidth: 1, borderTopColor: "#FECACA" }}>
          <Text style={{ color: "#991B1B", fontSize: 13 }}>{error}</Text>
        </View>
      )}
    </View>
  )
}
