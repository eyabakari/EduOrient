/**
 * @file Rangée de champ auth : fond, bordure, focus ring cohérents.
 */
import { View, type ViewProps, Platform } from "react-native"
import { getReadable } from "@/constants/readable"
import { useAppTheme } from "@/context/app-theme-context"
import { cn } from "@/lib/utils"

type Props = ViewProps & {
  children: React.ReactNode
  className?: string
  /** Bordure / halo accent au focus (TextInput interne gère onFocus/onBlur). */
  focused?: boolean
}

export function AuthInputRow({
  children,
  className,
  style,
  focused = false,
  ...props
}: Props) {
  const { theme: THEME, isDark } = useAppTheme()
  const READABLE = getReadable(THEME, isDark)

  return (
    <View
      collapsable={false}
      className={cn(
        "min-h-[56px] flex-row items-center gap-3 rounded-2xl border px-4 py-2",
        className
      )}
      style={[
        {
          backgroundColor: READABLE.inputSurface,
          borderColor: focused ? THEME.accent : READABLE.inputBorder,
          borderWidth: 1,
          ...(Platform.OS === "ios" && focused
            ? {
                shadowColor: THEME.accent,
                shadowOffset: { width: 0, height: 0 },
                shadowOpacity: 0.35,
                shadowRadius: 8,
              }
            : {}),
          ...(Platform.OS === "android" && focused
            ? { elevation: 3 }
            : { elevation: 0 }),
        },
        style,
      ]}
      {...props}
    >
      {children}
    </View>
  )
}
