/**
 * @file Padding bas des ScrollView pour compenser la BottomNav en position absolute.
 * @see https://github.com/th3rdwave/react-native-safe-area-context
 */
import { useSafeAreaInsets } from "react-native-safe-area-context"
import { getBottomTabBarHeight } from "@/constants/bottom-tab-bar"

/**
 * Équivalent à `useBottomTabBarHeight` de `@react-navigation/bottom-tabs` pour cette app :
 * le package exige un `BottomTabNavigator` ; ici la barre est `BottomNav` (absolute).
 *
 * Utiliser en `contentContainerStyle.paddingBottom` des `ScrollView` pour que le dernier bloc
 * (ex. Bento) reste entièrement visible au scroll.
 */
export function useBottomTabBarHeight(): number {
  const insets = useSafeAreaInsets()
  return getBottomTabBarHeight(insets.bottom)
}
