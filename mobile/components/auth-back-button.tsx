/**
 * @file Bouton retour standardisé (auth).
 */
import { TouchableOpacity } from "react-native"
import { ArrowLeft } from "lucide-react-native"
import { useAppTheme } from "@/context/app-theme-context"

type Props = {
  onPress: () => void
  className?: string
}

export function AuthBackButton({ onPress }: Props) {
  const { theme: THEME } = useAppTheme()
  return (
    <TouchableOpacity
      onPress={onPress}
      hitSlop={{ top: 12, bottom: 12, left: 12, right: 12 }}
      className="mb-6 self-start rounded-2xl border border-border/60 p-2.5"
      style={{ backgroundColor: THEME.mutedSurface }}
      activeOpacity={0.8}
    >
      <ArrowLeft size={22} color={THEME.foreground} />
    </TouchableOpacity>
  )
}
