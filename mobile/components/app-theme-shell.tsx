/**
 * @file Enveloppe SafeArea + injection variables CSS NativeWind selon thème actif.
 * @see https://www.nativewind.dev/docs/api/nativewind-vars
 */
import { vars } from "nativewind"
import { View } from "react-native"
import { SafeAreaView } from "react-native-safe-area-context"
import { useAppTheme } from "@/context/app-theme-context"
import { buildAppCssVars } from "@/lib/app-theme-css-vars"

interface AppThemeShellProps {
  children: React.ReactNode
}

/** Fond + variables CSS NativeWind (texte, bordures, cartes) selon le thème actif. */
export function AppThemeShell({ children }: AppThemeShellProps) {
  const { isDark, theme } = useAppTheme()
  const cssVars = vars(buildAppCssVars(theme, isDark))

  return (
    <View className="flex-1" style={[{ backgroundColor: theme.background }, cssVars]}>
      <SafeAreaView
        className="flex-1"
        style={[{ backgroundColor: theme.background }, cssVars]}
        edges={["top", "left", "right"]}
      >
        {children}
      </SafeAreaView>
    </View>
  )
}
