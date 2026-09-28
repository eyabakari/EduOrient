/**
 * @file FAQ statique (clés i18n) accessible depuis Paramètres.
 */
import { useMemo } from "react"
import { ScrollView, Text, TouchableOpacity, View } from "react-native"
import { ArrowLeft } from "lucide-react-native"
import { GlassCard } from "./glass-card"
import { useAppTheme } from "@/context/app-theme-context"
import { useLocale } from "@/context/locale-context"
import { useBottomTabBarHeight } from "@/hooks/use-bottom-tab-bar-height"
import type { TranslationKey } from "../locales/translations"

interface HelpFaqProps {
  onBack: () => void
}

const FAQ_PAIRS: { q: TranslationKey; a: TranslationKey }[] = [
  { q: "help_q1", a: "help_a1" },
  { q: "help_q2", a: "help_a2" },
  { q: "help_q3", a: "help_a3" },
  { q: "help_q4", a: "help_a4" },
  { q: "help_q5", a: "help_a5" },
]

export function HelpFaq({ onBack }: HelpFaqProps) {
  const { t } = useLocale()
  const { theme: THEME } = useAppTheme()
  const tabBarHeight = useBottomTabBarHeight()

  const items = useMemo(
    () =>
      FAQ_PAIRS.map(({ q, a }) => ({
        question: t(q),
        answer: t(a),
      })),
    [t]
  )

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
        <Text className="flex-1 text-3xl font-bold tracking-tight text-foreground">
          {t("settings_help")}
        </Text>
      </View>

      <Text className="mb-5 text-sm leading-relaxed text-muted-foreground">
        {t("help_intro")}
      </Text>

      <View className="gap-4">
        {items.map((item, index) => (
          <GlassCard key={index} contentClassName="gap-2 p-4">
            <Text className="text-base font-semibold text-foreground">{item.question}</Text>
            <Text className="text-sm leading-relaxed text-muted-foreground">{item.answer}</Text>
          </GlassCard>
        ))}
      </View>
    </ScrollView>
  )
}
