/**
 * @file Configure l’affichage des notifications reçues pendant que l’app est au premier plan.
 * @see https://docs.expo.dev/versions/latest/sdk/notifications/#handle-incoming-notifications
 */
import { setNotificationHandler } from "expo-notifications/build/NotificationsHandler"

try {
  setNotificationHandler({
    handleNotification: async () => ({
      shouldShowAlert: true,
      shouldPlaySound: false,
      shouldSetBadge: false,
      shouldShowBanner: true,
      shouldShowList: true,
    }),
  })
} catch {
  /* module natif indisponible */
}
