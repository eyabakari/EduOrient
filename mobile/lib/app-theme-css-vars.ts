/**
 * @file Génère les variables CSS (--color-*) injectées dans NativeWind / global.css pour le thème dynamique.
 * @see https://www.nativewind.dev/docs/guides/themes
 */
import type { AppThemePalette } from "@/constants/theme-colors"

function hexToSpaceRgb(hex: string): string {
  const h = hex.replace("#", "")
  const full =
    h.length === 3 ? h.split("").map((c) => c + c).join("") : h
  const n = parseInt(full, 16)
  const r = (n >> 16) & 255
  const g = (n >> 8) & 255
  const b = n & 255
  return `${r} ${g} ${b}`
}

/** Variables consommées par `tailwind.config.js` (NativeWind / rgb(var(--…)/α)). */
export function buildAppCssVars(
  theme: AppThemePalette,
  isDark: boolean
): Record<string, string> {
  const onPrimary = isDark ? "#080F1C" : "#FFFFFF"
  const onAccent = isDark ? "#080F1C" : "#FFFFFF"
  const secondaryFg = isDark ? "#E2E8F0" : "#334155"

  return {
    "--color-background": hexToSpaceRgb(theme.background),
    "--color-foreground": hexToSpaceRgb(theme.foreground),
    "--color-border": hexToSpaceRgb(theme.border),
    "--color-input": hexToSpaceRgb(theme.mutedSurface),
    "--color-muted": hexToSpaceRgb(theme.mutedSurface),
    "--color-muted-foreground": hexToSpaceRgb(theme.muted),
    "--color-card": hexToSpaceRgb(theme.card),
    "--color-card-foreground": hexToSpaceRgb(theme.foreground),
    "--color-primary": hexToSpaceRgb(theme.primary),
    "--color-primary-foreground": hexToSpaceRgb(onPrimary),
    "--color-accent": hexToSpaceRgb(theme.accent),
    "--color-accent-foreground": hexToSpaceRgb(onAccent),
    "--color-destructive": hexToSpaceRgb(theme.danger),
    "--color-destructive-foreground": "255 255 255",
    "--color-secondary": hexToSpaceRgb(theme.cardElevated),
    "--color-secondary-foreground": hexToSpaceRgb(secondaryFg),
    "--color-popover": hexToSpaceRgb(theme.card),
    "--color-popover-foreground": hexToSpaceRgb(theme.foreground),
    "--color-ring": hexToSpaceRgb(theme.primary),
    "--color-surface": hexToSpaceRgb(theme.mutedSurface),
    "--color-sidebar-bg": hexToSpaceRgb(theme.background),
    "--color-sidebar-fg": hexToSpaceRgb(theme.foreground),
    "--color-sidebar-primary": hexToSpaceRgb(theme.primary),
    "--color-sidebar-primary-fg": hexToSpaceRgb(onPrimary),
    "--color-sidebar-accent": hexToSpaceRgb(theme.cardElevated),
    "--color-sidebar-accent-fg": hexToSpaceRgb(secondaryFg),
    "--color-sidebar-border": hexToSpaceRgb(theme.border),
  }
}
