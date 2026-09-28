import { Text, View } from "react-native"
import { LinearGradient } from "expo-linear-gradient"
import { Sparkles, ArrowRight } from "lucide-react-native"
import { GradientButton } from "./gradient-button"
import { useAppTheme } from "@/context/app-theme-context"

interface WelcomeProps {
  onGetStarted: () => void
}

export function Welcome({ onGetStarted }: WelcomeProps) {
  const { theme: THEME, isDark } = useAppTheme()

  const gradientColorsDark = ["rgba(157, 123, 255, 0.42)", "rgba(34, 211, 238, 0.24)"] as const
  const gradientColorsLight = ["rgba(157, 123, 255, 0.25)", "rgba(34, 211, 238, 0.15)"] as const
  const gradientColors = isDark ? gradientColorsDark : gradientColorsLight

  const iconBoxBg = isDark ? "#0B1220" : "#F3F4FA"
  const iconBoxBorder = isDark ? "rgba(255,255,255,0.08)" : "rgba(100,100,200,0.15)"

  return (
    <View
      className="flex-1 items-center justify-between px-7 py-12"
      style={{ backgroundColor: THEME.background }}
    >
      <View />

      <View className="items-center">
        <LinearGradient
          colors={gradientColors}
          start={{ x: 0, y: 0 }}
          end={{ x: 1, y: 1 }}
          style={{
            width: 112,
            height: 112,
            borderRadius: 28,
            padding: 2,
            alignItems: "center",
            justifyContent: "center",
          }}
        >
          <View
            className="items-center justify-center"
            style={{
              width: "100%",
              height: "100%",
              borderRadius: 26,
              backgroundColor: iconBoxBg,
              borderWidth: 1,
              borderColor: iconBoxBorder,
            }}
          >
            <Sparkles size={44} color={THEME.accent} />
          </View>
        </LinearGradient>

        <Text className="mt-7 text-center text-5xl font-black tracking-normal text-foreground">
          ProLink
        </Text>
        <Text className="mt-3 max-w-[280px] text-center text-sm leading-6 text-muted-foreground">
          La passerelle entre talents académiques et opportunités professionnelles.
        </Text>
      </View>

      <View className="w-full gap-4">
        <GradientButton onPress={onGetStarted}>
          <View className="flex-row items-center justify-center gap-3">
            <Text className="text-base font-bold text-white">Continuer</Text>
            <ArrowRight size={18} color="#FFFFFF" />
          </View>
        </GradientButton>
        <Text className="text-center text-xs text-muted-foreground">
          Application mobile réservée aux étudiants et recruteurs.
        </Text>
      </View>
    </View>
  )
}
