import React, { createContext, useContext } from "react"

export type BottomTabId =
  | "dashboard"
  | "messages"
  | "projects"
  | "portfolio"
  | "matching"
  | "skills"
  | "settings"

type NavShape = {
  goToTab: (tab: BottomTabId) => void
  openConversation: (conversationId: number) => void
}

const noop = () => {}

const AppNavigationContext = createContext<NavShape>({ goToTab: noop, openConversation: noop })

export const AppNavigationProvider = AppNavigationContext.Provider

export function useAppNavigation() {
  return useContext(AppNavigationContext)
}

export default AppNavigationContext
