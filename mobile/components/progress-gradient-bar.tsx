/**
 * @file Barre de progression horizontale en dégradé (parcours, niveaux).
 */
import { View } from "react-native"
import { LinearGradient } from "expo-linear-gradient"
import { useAppTheme } from "@/context/app-theme-context"

type Variant = "brand" | "accent"

type Props = {
  progress: number
  height?: number
  variant?: Variant
}

/**
 * Barre de progression avec vrai dégradé (Expo) — `bg-gradient-to-r` est peu fiable sur RN.
 */
export function ProgressGradientBar({
  progress,
  height = 8,
  variant = "brand",
}: Props) {
  const { theme: THEME } = useAppTheme()
  const pct = Math.min(100, Math.max(0, progress))
  const colors: [string, string] =
    variant === "brand"
      ? [THEME.gradientStart, THEME.gradientEnd]
      : [THEME.accent, THEME.primary]

  return (
    <View
      style={{
        height,
        borderRadius: height / 2,
        backgroundColor: `rgba(${THEME.backgroundRgb}, 0.55)`,
        overflow: "hidden",
      }}
    >
      {pct > 0 ? (
        <LinearGradient
          colors={colors}
          start={{ x: 0, y: 0.5 }}
          end={{ x: 1, y: 0.5 }}
          style={{
            width: `${pct}%`,
            height: "100%",
            borderRadius: height / 2,
          }}
        />
      ) : null}
    </View>
  )
}
