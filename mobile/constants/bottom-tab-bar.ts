/**
 * @file Mesures de la barre de navigation custom (non fournie par React Navigation ici).
 * Hauteur de la barre du bas custom (`components/bottom-nav.tsx`).
 * Pas de `app/(tabs)/_layout.tsx` ni `tabBarAbsolute` : la barre est rendue en overlay dans `app/index.tsx`.
 */
export const BOTTOM_TAB_BAR_TOP_PADDING = 8
export const BOTTOM_TAB_BAR_ROW_MIN_HEIGHT = 60

/**
 * Hauteur totale de la zone occupée par la TabBar (padding haut + rangée icônes/labels + marge home indicator).
 */
export function getBottomTabBarHeight(safeAreaBottom: number): number {
  const bottom = Math.max(safeAreaBottom, 12)
  return BOTTOM_TAB_BAR_TOP_PADDING + BOTTOM_TAB_BAR_ROW_MIN_HEIGHT + bottom
}

