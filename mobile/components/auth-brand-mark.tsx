/**
 * @file Logo / marque sur les écrans d’authentification.
 */
import { View } from "react-native"
import { LinearGradient } from "expo-linear-gradient"
import { Sparkles } from "lucide-react-native"
import { useAppTheme } from "@/context/app-theme-context"

/** Logo carré maquette auth (dégradé discret + picto cyan). */
export function AuthBrandMark() {
  const { theme: THEME } = useAppTheme()
  return (
    <LinearGradient
      colors={["rgba(167, 139, 250, 0.45)", "rgba(34, 211, 238, 0.3)"]}
      start={{ x: 0, y: 0 }}
      end={{ x: 1, y: 1 }}
      style={{
        borderRadius: 18,
        padding: 2,
        marginBottom: 16,
        alignSelf: "center",
      }}
    >
      <View
        style={{
          borderRadius: 16,
          backgroundColor: THEME.card,
          paddingVertical: 14,
          paddingHorizontal: 16,
          alignItems: "center",
          justifyContent: "center",
        }}
      >
        <Sparkles size={32} color={THEME.accent} />
      </View>
    </LinearGradient>
  )
}
