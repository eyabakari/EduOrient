/**
 * @file Boutons principaux (LinearGradient) + variante surface secondaire.
 */
import {
  ActivityIndicator,
  Text,
  TouchableOpacity,
  type TouchableOpacityProps,
  View,
  Platform,
  type StyleProp,
  type ViewStyle,
} from "react-native"
import { LinearGradient } from "expo-linear-gradient"
import { cn } from "@/lib/utils"
import { useAppTheme } from "@/context/app-theme-context"

function ctaShadowFor(theme: { gradientEnd: string }) {
  return Platform.OS === "ios"
    ? {
        shadowColor: theme.gradientEnd,
        shadowOffset: { width: 0, height: 6 },
        shadowOpacity: 0.35,
        shadowRadius: 14,
      }
    : { elevation: 8 }
}

type Props = TouchableOpacityProps & {
  children: React.ReactNode
  loading?: boolean
  className?: string
  textClassName?: string
  size?: "default" | "compact"
}

export function GradientButton({
  children,
  loading,
  disabled,
  className,
  textClassName,
  size = "default",
  ...props
}: Props) {
  const { theme: THEME } = useAppTheme()
  const compact = size === "compact"
  return (
    <TouchableOpacity
      activeOpacity={0.92}
      disabled={disabled || loading}
      className={cn("w-full overflow-hidden rounded-[28px]", className)}
      style={ctaShadowFor(THEME)}
      {...props}
    >
      <LinearGradient
        colors={[THEME.gradientStart, THEME.gradientEnd]}
        start={{ x: 0, y: 0.5 }}
        end={{ x: 1, y: 0.5 }}
        style={{
          paddingVertical: compact ? 12 : 16,
          paddingHorizontal: compact ? 20 : 24,
          alignItems: "center",
          justifyContent: "center",
          minHeight: compact ? 46 : 54,
        }}
      >
        {loading ? (
          <ActivityIndicator color="#FFFFFF" />
        ) : typeof children === "string" ? (
          <Text
            className={cn(
              "text-center font-semibold text-white",
              compact ? "text-base" : "text-lg",
              textClassName
            )}
          >
            {children}
          </Text>
        ) : (
          <View className="flex-row items-center justify-center gap-2">{children}</View>
        )}
      </LinearGradient>
    </TouchableOpacity>
  )
}

type SurfaceProps = TouchableOpacityProps & {
  children: React.ReactNode
  loading?: boolean
  contentStyle?: StyleProp<ViewStyle>
  /** Faux dans les lignes horizontales (cartes Skills) pour ne pas forcer 100 % de largeur. */
  fullWidth?: boolean
}

/** CTA dégradé avec contenu libre (icônes + texte). */
export function GradientSurfaceButton({
  children,
  loading,
  disabled,
  className,
  contentStyle,
  fullWidth = true,
  ...props
}: SurfaceProps) {
  const { theme: THEME } = useAppTheme()
  return (
    <TouchableOpacity
      activeOpacity={0.92}
      disabled={disabled || loading}
      className={cn(
        "overflow-hidden rounded-[28px]",
        fullWidth ? "w-full" : "self-start shrink-0",
        className
      )}
      style={ctaShadowFor(THEME)}
      {...props}
    >
      <LinearGradient
        colors={[THEME.gradientStart, THEME.gradientEnd]}
        start={{ x: 0, y: 0.5 }}
        end={{ x: 1, y: 0.5 }}
        style={[
          {
            flexDirection: "row",
            alignItems: "center",
            justifyContent: "center",
            gap: 10,
            paddingVertical: 16,
            paddingHorizontal: 22,
            minHeight: 54,
          },
          contentStyle,
        ]}
      >
        {loading ? (
          <ActivityIndicator color="#FFFFFF" />
        ) : (
          children
        )}
      </LinearGradient>
    </TouchableOpacity>
  )
}
