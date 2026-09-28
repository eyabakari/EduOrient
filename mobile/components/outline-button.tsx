/**
 * @file Bouton secondaire bordure (actions auth / formulaires).
 */
import {
  ActivityIndicator,
  Text,
  TouchableOpacity,
  type TouchableOpacityProps,
} from "react-native"
import { useAppTheme } from "@/context/app-theme-context"
import { cn } from "@/lib/utils"

type Props = TouchableOpacityProps & {
  children: React.ReactNode
  loading?: boolean
  /** Si string, style titre secondaire */
  textClassName?: string
}

/** Bouton secondaire borduré (ex. Google) — fond carte, texte clair. */
export function OutlineButton({
  children,
  loading,
  disabled,
  className,
  textClassName,
  ...props
}: Props) {
  const { theme: THEME } = useAppTheme()
  return (
    <TouchableOpacity
      disabled={disabled || loading}
      className={cn(
        "min-h-[52px] w-full flex-row items-center justify-center gap-2 rounded-2xl border px-5 py-3.5",
        className
      )}
      style={{
        borderColor: THEME.border,
        backgroundColor: `rgba(${THEME.cardRgb}, 0.92)`,
      }}
      activeOpacity={0.85}
      {...props}
    >
      {loading ? (
        <ActivityIndicator color={THEME.foreground} size="small" />
      ) : typeof children === "string" ? (
        <Text
          className={cn("text-center text-base font-semibold text-foreground", textClassName)}
        >
          {children}
        </Text>
      ) : (
        children
      )}
    </TouchableOpacity>
  )
}
