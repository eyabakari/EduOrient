/**
 * @file Barre d’onglets custom (pas de Tabs de React Navigation) + labels i18n.
 * @see https://docs.expo.dev/versions/latest/sdk/blur-view/
 */
import { useMemo } from "react"
import { View, Text, TouchableOpacity, Platform, Modal, TouchableWithoutFeedback, Pressable } from "react-native"
import { BlurView } from "expo-blur"
import {
  BriefcaseBusiness,
  FileText,
  Home,
  List,
  PlusCircle,
  Settings,
  Sparkles,
  User,
  Folder,
  MessageSquare,
} from "lucide-react-native"
import { useEffect, useState } from "react"
import { api } from "@/lib/api"
import { useSafeAreaInsets } from "react-native-safe-area-context"
import {
  BOTTOM_TAB_BAR_TOP_PADDING,
  getBottomTabBarHeight,
} from "@/constants/bottom-tab-bar"
import { cn } from "@/lib/utils"
import { useAppTheme } from "@/context/app-theme-context"
import { useLocale } from "@/context/locale-context"

export type BottomTabId =
  | "dashboard"
  | "projects"
  | "portfolio"
  | "matching"
  | "skills"
  | "messages"
  | "recruiter-offers"
  | "recruiter-add-offer"
  | "settings"
  | "more"

interface BottomNavProps {
  activeTab: BottomTabId
  onTabChange: (tab: BottomTabId) => void
  mode?: "student" | "recruiter"
}

export function BottomNav({ activeTab, onTabChange, mode = "student" }: BottomNavProps) {
  const { theme: THEME, isDark } = useAppTheme()
  const { t } = useLocale()
  const [unreadTotal, setUnreadTotal] = useState<number>(0)

  useEffect(() => {
    let mounted = true
    const fetchUnread = async () => {
      try {
        const res = await api.get('/conversations')
        if (!mounted) return
        const sum = (res.data?.data || []).reduce((acc: number, c: any) => acc + (Number(c.unread_count) || 0), 0)
        setUnreadTotal(sum)
      } catch (e) {
        // ignore
      }
    }

    void fetchUnread()
    const id = setInterval(() => void fetchUnread(), 8000)
    return () => {
      mounted = false
      clearInterval(id)
    }
  }, [])

  // Primary tabs: limit to 4 items for mobile ergonomics
  const [showMoreModal, setShowMoreModal] = useState(false)

  const navItems = useMemo(
    (): { id: BottomTabId; icon: typeof Home; label: string }[] => {
          if (mode === "recruiter") {
        return [
          { id: "dashboard", icon: Home, label: t("home") },
          { id: "recruiter-offers", icon: BriefcaseBusiness, label: t("offres") },
          { id: "recruiter-add-offer", icon: PlusCircle, label: t("ajouter_offre") },
          { id: "messages", icon: MessageSquare, label: t("messages") },
          { id: "settings", icon: Settings, label: t("parametres") },
        ]
      }
      return [
        { id: "dashboard", icon: Home, label: t("home") },
        { id: "portfolio", icon: FileText, label: t("portfolio") },
        { id: "messages", icon: MessageSquare, label: t("messages") },
        { id: "more", icon: PlusCircle, label: t("autres") },
      ]
    },
    [mode, t]
  )
  const insets = useSafeAreaInsets()
  const bottomPad = Math.max(insets.bottom, 12)

  const bar = (
    <View
      className="flex-row items-stretch justify-around border-t px-1"
      style={{
        paddingTop: BOTTOM_TAB_BAR_TOP_PADDING,
        paddingBottom: bottomPad,
        minHeight: getBottomTabBarHeight(insets.bottom),
        borderTopColor: THEME.border,
        backgroundColor: `rgba(${THEME.backgroundRgb}, 0.94)`,
      }}
    >
      {navItems.map((item) => {
        const Icon = item.icon
        const isActive = activeTab === item.id
        return (
          <TouchableOpacity
            key={item.id}
            onPress={() => {
              if (item.id === 'more') {
                setShowMoreModal(true)
                return
              }
              onTabChange(item.id)
            }}
            className="min-w-[56px] flex-1 items-center gap-1 rounded-xl py-2"
            activeOpacity={0.75}
          >
            <View
              className={cn(
                "items-center justify-center rounded-xl px-2.5 py-2",
                isActive && "border border-cyan-400/35 bg-cyan-400/15"
              )}
              style={
                isActive
                  ? {
                      shadowColor: THEME.accent,
                      shadowOffset: { width: 0, height: 0 },
                      shadowOpacity: 0.55,
                      shadowRadius: 12,
                      elevation: Platform.OS === "android" ? 6 : 0,
                    }
                  : undefined
              }
            >
              <View style={{ position: 'relative' }}>
                <Icon size={22} color={isActive ? THEME.accent : THEME.muted} />
                {item.id === 'messages' && unreadTotal > 0 ? (
                  <View
                    style={{
                      position: 'absolute',
                      top: -6,
                      right: -8,
                      minWidth: 18,
                      height: 18,
                      borderRadius: 9,
                      backgroundColor: '#ef4444',
                      alignItems: 'center',
                      justifyContent: 'center',
                      paddingHorizontal: 4,
                    }}
                  >
                    <Text style={{ color: 'white', fontSize: 11, fontWeight: '700' }}>
                      {unreadTotal > 99 ? '99+' : String(unreadTotal)}
                    </Text>
                  </View>
                ) : null}
              </View>
            </View>
            <Text
              className="text-xs font-medium"
              style={{ color: isActive ? THEME.accent : THEME.muted }}
            >
              {item.label}
            </Text>
          </TouchableOpacity>
        )
      })}
    </View>
  )

  // More modal content (bottom action sheet)
  const MoreModal = (
    <Modal visible={showMoreModal} animationType="slide" transparent onRequestClose={() => setShowMoreModal(false)}>
      <TouchableWithoutFeedback onPress={() => setShowMoreModal(false)}>
        <View style={{ flex: 1, backgroundColor: 'rgba(0,0,0,0.4)' }} />
      </TouchableWithoutFeedback>
      <View style={{ backgroundColor: THEME.card, padding: 12, borderTopLeftRadius: 12, borderTopRightRadius: 12 }}>
        <View style={{ height: 6 }} />
        {mode !== 'recruiter' ? (
          <>
            <Pressable onPress={() => { setShowMoreModal(false); onTabChange('matching') }} style={{ paddingVertical: 12, flexDirection: 'row', alignItems: 'center' }}>
              <Sparkles size={18} color={THEME.foreground} />
              <Text style={{ marginLeft: 12, color: THEME.foreground, fontWeight: '600' }}>{t("matching")}</Text>
            </Pressable>
            <Pressable onPress={() => { setShowMoreModal(false); onTabChange('projects') }} style={{ paddingVertical: 12, flexDirection: 'row', alignItems: 'center' }}>
              <Folder size={18} color={THEME.foreground} />
              <Text style={{ marginLeft: 12, color: THEME.foreground, fontWeight: '600' }}>{t("projets")}</Text>
            </Pressable>
            <Pressable onPress={() => { setShowMoreModal(false); onTabChange('skills') }} style={{ paddingVertical: 12, flexDirection: 'row', alignItems: 'center' }}>
              <List size={18} color={THEME.foreground} />
              <Text style={{ marginLeft: 12, color: THEME.foreground, fontWeight: '600' }}>{t("competences")}</Text>
            </Pressable>
          </>
        ) : null}
        <Pressable onPress={() => { setShowMoreModal(false); onTabChange('settings') }} style={{ paddingVertical: 12, flexDirection: 'row', alignItems: 'center' }}>
          <User size={18} color={THEME.foreground} />
          <Text style={{ marginLeft: 12, color: THEME.foreground, fontWeight: '600' }}>Paramètres</Text>
        </Pressable>
        <View style={{ height: Math.max(insets.bottom, 12) }} />
      </View>
    </Modal>
  )

  if (Platform.OS === "web") {
    return (
      <View
        className="absolute bottom-0 left-0 right-0 z-50 border-t"
        style={{
          borderTopColor: THEME.border,
          backgroundColor: `rgba(${THEME.backgroundRgb}, 0.97)`,
        }}
      >
        {bar}
        {MoreModal}
      </View>
    )
  }

  return (
    <BlurView
      intensity={48}
      tint={isDark ? "dark" : "light"}
      className="absolute bottom-0 left-0 right-0 z-50 overflow-hidden border-t border-border/80"
    >
      {bar}
      {MoreModal}
    </BlurView>
  )
}
