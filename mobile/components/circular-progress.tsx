/**
 * @file Anneau de progression animé (SVG / layout) pour scores ou pourcentages.
 */
import React, { useEffect, useState } from "react"
import { View, Text, Platform } from "react-native"
import { useAppTheme } from "@/context/app-theme-context"

interface CircularProgressProps {
  progress: number
  size?: number
  strokeWidth?: number
  label?: string
  sublabel?: string
  /** Si vrai, pas de pastille sombre au centre — s’intègre au GlassCard parent. */
  embedded?: boolean
}

export function CircularProgress({
  progress,
  size = 160,
  strokeWidth = 12,
  label,
  sublabel,
  embedded = false,
}: CircularProgressProps) {
  const { theme: THEME } = useAppTheme()
  const [animatedProgress, setAnimatedProgress] = useState(0)

  useEffect(() => {
    const timer = setTimeout(() => {
      setAnimatedProgress(progress)
    }, 100)
    return () => clearTimeout(timer)
  }, [progress])

  const displayProgress = Math.round(animatedProgress)
  const compact = size < 120
  const pctFont = compact ? Math.max(16, Math.round(size * 0.26)) : 32
  const labelFont = compact ? 10 : 12
  const subFont = compact ? 9 : 11

  const ringGlow =
    Platform.OS === "ios"
      ? {
          shadowColor: THEME.accent,
          shadowOffset: { width: 0, height: 0 },
          shadowOpacity: embedded ? 0.45 : 0.35,
          shadowRadius: embedded ? 10 : 14,
        }
      : { elevation: embedded ? 4 : 0 }

  return (
    <View style={{ alignItems: "center", justifyContent: "center" }}>
      <View
        style={{
          width: size,
          height: size,
          borderRadius: size / 2,
          borderWidth: strokeWidth,
          borderColor: THEME.accent,
          alignItems: "center",
          justifyContent: "center",
          backgroundColor: embedded ? "transparent" : `rgba(${THEME.cardRgb}, 0.35)`,
          ...ringGlow,
        }}
      >
        <View style={{ alignItems: "center", justifyContent: "center", paddingHorizontal: 4 }}>
          <Text
            style={{
              fontSize: pctFont,
              fontWeight: "700",
              color: THEME.accent,
            }}
          >
            {displayProgress}%
          </Text>
          {label ? (
            <Text
              style={{
                fontSize: labelFont,
                color: THEME.muted,
                marginTop: compact ? 2 : 4,
                fontWeight: "500",
                textAlign: "center",
              }}
            >
              {label}
            </Text>
          ) : null}
          {sublabel ? (
            <Text
              style={{
                fontSize: subFont,
                color: THEME.muted,
                opacity: 0.85,
                marginTop: 2,
                textAlign: "center",
              }}
            >
              {sublabel}
            </Text>
          ) : null}
        </View>
      </View>
    </View>
  )
}
