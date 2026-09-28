/**
 * @file Couleurs de texte / placeholder adaptées au thème actif pour champs formulaires.
 */
import type { AppThemePalette } from "./theme-colors"

/**
 * Lisibilité garantie sur TextInput + surfaces (hex, pas oklch).
 * Dépend du thème actif (clair / sombre).
 */
export function getReadable(theme: AppThemePalette, isDark: boolean) {
  return {
    foreground: theme.foreground,
    muted: theme.muted,
    /** Lisible sur fond input */
    placeholder: isDark ? "#8B95AB" : "#64748B",
    iconMuted: theme.muted,
    inputSurface: isDark ? "#141D30" : "#FFFFFF",
    inputBorder: theme.border,
  } as const
}

