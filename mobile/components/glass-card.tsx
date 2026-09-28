/**
 * @file Carte « verre » (blur natif ou fallback web) pour sections d’UI.
 */
import { BlurView } from "expo-blur"
import { View, StyleSheet, Platform, type StyleProp, type ViewStyle } from "react-native"
import { cn } from "@/lib/utils"
import { useAppTheme } from "@/context/app-theme-context"

interface GlassCardProps {
  children: React.ReactNode
  className?: string
  variant?: "default" | "strong" | "neon"
  neonColor?: "cyan" | "violet"
  style?: StyleProp<ViewStyle>
  /** Padding du contenu (défaut `p-4`). */
  contentClassName?: string
  /**
   * Sans BlurView (recommandé sur les formulaires avec clavier) : évite des bugs
   * de hit-testing / focus sur Android avec expo-blur + TextInput.
   */
  plain?: boolean
}

export function GlassCard({
  children,
  className,
  variant = "default",
  neonColor,
  style,
  contentClassName,
  plain = false,
}: GlassCardProps) {
  const { theme: THEME, isDark } = useAppTheme()
  const intensity = variant === "strong" ? 55 : variant === "neon" ? 40 : 28

  const overlayOpacity = variant === "strong" ? 0.96 : variant === "neon" ? 0.94 : 0.92

  const neonGlow =
    variant === "neon" && neonColor === "cyan"
      ? {
          shadowColor: THEME.accent,
          shadowOffset: { width: 0, height: 0 },
          shadowOpacity: 0.38,
          shadowRadius: 12,
          elevation: Platform.OS === "android" ? 8 : 0,
        }
      : variant === "neon" && neonColor === "violet"
        ? {
            shadowColor: THEME.primary,
            shadowOffset: { width: 0, height: 0 },
            shadowOpacity: 0.35,
            shadowRadius: 10,
            elevation: Platform.OS === "android" ? 6 : 0,
          }
        : {}

  return (
    <View
      className={cn(
        "overflow-hidden rounded-2xl border",
        variant === "neon" && neonColor === "cyan" && "border-cyan-400/50",
        variant === "neon" && neonColor === "violet" && "border-violet-400/50",
        variant !== "neon" && "border-border/60",
        className
      )}
      style={[neonGlow, style]}
    >
      {!plain ? (
        <BlurView
          pointerEvents="none"
          intensity={intensity}
          tint={isDark ? "dark" : "light"}
          style={StyleSheet.absoluteFill}
        />
      ) : null}
      <View
        className={cn("p-4", contentClassName)}
        style={{
          backgroundColor: `rgba(${THEME.cardRgb}, ${overlayOpacity})`,
        }}
      >
        {children}
      </View>
    </View>
  )
}
