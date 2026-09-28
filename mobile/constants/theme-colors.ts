/**
 * @file Palettes couleur sémantiques (sombre + claire) consommées par AppThemeContext et Tailwind vars.
 * Dark mode : fond bleu nuit uni + cartes légèrement plus claires (même famille de teinte).
 * Accents violet / cyan réservés aux CTA, barres de progression et états actifs.
 */
export const THEME = {
  background: "#1A1B23",
  /** Pour `rgba(${THEME.backgroundRgb}, a)` — barre du bas, overlays */
  backgroundRgb: "26, 27, 35" as const,
  /** Overlay des GlassCard — même teinte que `card` */
  cardRgb: "37, 39, 54" as const,
  card: "#252736",
  cardElevated: "#22232E",
  foreground: "#E4E6EF",
  muted: "#A3AED0",
  mutedSurface: "#22232E",
  border: "#323248",
  primary: "#9D7BFF",
  accent: "#9D7BFF",
  success: "#34D399",
  danger: "#F87171",
  dangerMuted: "#7F1D1D",
  gradientStart: "#9D7BFF",
  gradientEnd: "#4318FF",
} as const

/** Mode clair : fond gris très clair, texte slate, mêmes accents (violet / cyan) un peu renforcés. */
export const THEME_LIGHT = {
  background: "#F8F9FD",
  backgroundRgb: "248, 249, 253" as const,
  cardRgb: "255, 255, 255" as const,
  card: "#FFFFFF",
  cardElevated: "#F8F9FD",
  foreground: "#2B3674",
  muted: "#5A6376",
  mutedSurface: "#F8F9FD",
  border: "#E9EDF7",
  primary: "#4318FF",
  accent: "#4318FF",
  success: "#059669",
  danger: "#DC2626",
  dangerMuted: "#FEE2E2",
  gradientStart: "#4318FF",
  gradientEnd: "#9D7BFF",
} as const

export type AppThemePalette = typeof THEME | typeof THEME_LIGHT

