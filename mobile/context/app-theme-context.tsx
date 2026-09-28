/**
 * @file Thème clair/sombre : préférence persistée (SecureStore + mémoire), palette NativeWind/CSS vars.
 * @see https://www.nativewind.dev/docs/core-concepts/dark-mode
 */
import {
  createContext,
  useCallback,
  useContext,
  useEffect,
  useMemo,
  useState,
  type ReactNode,
} from "react"
import { useColorScheme } from "nativewind"
import { THEME, THEME_LIGHT, type AppThemePalette } from "@/constants/theme-colors"
import {
  readThemePreference,
  writeThemePreference,
} from "@/lib/theme-preference-storage"

interface AppThemeContextValue {
  isDark: boolean
  setIsDark: (value: boolean) => void
  theme: AppThemePalette
}

const AppThemeContext = createContext<AppThemeContextValue | null>(null)

export function AppThemeProvider({ children }: { children: ReactNode }) {
  const { setColorScheme } = useColorScheme()
  const [isDark, setIsDarkState] = useState(true)
  const [hydrated, setHydrated] = useState(false)

  useEffect(() => {
    let cancelled = false
    void (async () => {
      try {
        const stored = await readThemePreference()
        if (cancelled) return
        if (stored === "light") setIsDarkState(false)
        else if (stored === "dark") setIsDarkState(true)
      } catch {
        /* évite Uncaught (in promise) si aucun stockage n’est utilisable */
      } finally {
        if (!cancelled) setHydrated(true)
      }
    })()
    return () => {
      cancelled = true
    }
  }, [])

  useEffect(() => {
    if (!hydrated) return
    setColorScheme(isDark ? "dark" : "light")
  }, [hydrated, isDark, setColorScheme])

  const setIsDark = useCallback((next: boolean) => {
    setIsDarkState(next)
    const value = next ? "dark" : "light"
    void writeThemePreference(value).catch(() => {
      /* déjà géré dans writeThemePreference ; filet de sécurité */
    })
  }, [])

  const theme = useMemo(
    () => (isDark ? THEME : THEME_LIGHT),
    [isDark]
  )

  const value = useMemo<AppThemeContextValue>(
    () => ({ isDark, setIsDark, theme }),
    [isDark, setIsDark, theme]
  )

  return (
    <AppThemeContext.Provider value={value}>{children}</AppThemeContext.Provider>
  )
}

export function useAppTheme(): AppThemeContextValue {
  const ctx = useContext(AppThemeContext)
  if (!ctx) {
    throw new Error("useAppTheme doit être utilisé dans AppThemeProvider")
  }
  return ctx
}
