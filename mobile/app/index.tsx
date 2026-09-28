/**
 * @file Point d’entrée UI principal : enchaîne Welcome → auth → MainApp (onglets + réglages).
 * La zone « main » isole useStudentData pour ne pas rerender les écrans de connexion à chaque chargement API.
 * @see https://react.dev/reference/react/useState
 */
import { useState, useCallback, useEffect, useMemo } from "react"
import { View, ActivityIndicator } from "react-native"
import { Welcome } from "@/components/welcome"
import { Login } from "@/components/login"
import { Register } from "@/components/register"
import { ForgotPassword } from "@/components/forgot-password"
import { ResetPassword } from "@/components/reset-password"
import { Dashboard } from "@/components/dashboard"
import { RecruiterHome } from "@/components/recruiter-home"
import { RecruiterAddOffer, RecruiterOffers } from "@/components/recruiter-offers"
import { Projects } from "@/components/projects"
import { Portfolio } from "@/components/portfolio"
import { Recommendations } from "@/components/recommendations"
import { SkillsScreen } from "@/components/SkillsScreen"
import { Settings } from "@/components/settings"
import { EditProfile } from "@/components/edit-profile"
import { ChangePassword } from "@/components/change-password"
import { HelpFaq } from "@/components/help-faq"
import { BottomNav, type BottomTabId } from "@/components/bottom-nav"
import { ConversationsList, ChatScreen } from "@/components"
import { AppNavigationProvider } from "@/context/app-navigation-context"
import { AppThemeShell } from "@/components/app-theme-shell"
import { useAppTheme } from "@/context/app-theme-context"
import { useAuth } from "@/context/auth-context"
import { useStudentData } from "@/hooks/use-student-data"

type Screen =
  | "welcome"
  | "login"
  | "register"
  | "forgot-password"
  | "reset-password"
  | "main"

type MainTab = BottomTabId | "settings" | "profile-edit" | "change-password" | "help-faq"

/**
 * Zone connectée seule : souscrit à useStudentData. Ainsi Login / Register ne sont
 * pas re-rendus à chaque tick du chargement API (curseur clavier stable).
 */
function MainApp({ onExitMain }: { onExitMain: () => void }) {
  const { theme: THEME } = useAppTheme()
  const { logout, user } = useAuth()
  const { initialLoadDone, loading: dataLoading } = useStudentData()
  const [currentTab, setCurrentTab] = useState<MainTab>("dashboard")
  const [activeConversationId, setActiveConversationId] = useState<number | null>(null)

  const handleNavigate = useCallback((tab: BottomTabId) => {
    setCurrentTab(tab)
    // fermer une conversation ouverte lors du changement d'onglet
    if (tab !== "messages") setActiveConversationId(null)
  }, [])

  const handleProfileEdit = useCallback(() => {
    setCurrentTab("profile-edit")
  }, [])

  const handleChangePassword = useCallback(() => {
    setCurrentTab("change-password")
  }, [])

  const handleHelpFaq = useCallback(() => {
    setCurrentTab("help-faq")
  }, [])

  const mainDataBlocking = !initialLoadDone && dataLoading
  const roleName = String(user?.role?.name ?? "").toLowerCase()
  const isRecruiterSpace = roleName === "recruteur"

  useEffect(() => {
    if (isRecruiterSpace && ["projects", "portfolio", "matching", "skills"].includes(currentTab)) {
      setCurrentTab("dashboard")
    }
    if (!isRecruiterSpace && (currentTab === "recruiter-offers" || currentTab === "recruiter-add-offer")) {
      setCurrentTab("dashboard")
    }
  }, [currentTab, isRecruiterSpace])

  const isChatOpen = activeConversationId !== null

  const renderMainTab = () => {
    switch (currentTab) {
      case "messages":
        return <ConversationsList onOpenConversation={(id: number) => setActiveConversationId(id)} />

      case "dashboard":
        if (isRecruiterSpace) return <RecruiterHome />
        return <Dashboard onNavigate={handleNavigate} />
      case "recruiter-offers":
        if (isRecruiterSpace) return <RecruiterOffers />
        return <Dashboard onNavigate={handleNavigate} />
      case "recruiter-add-offer":
        if (isRecruiterSpace) return <RecruiterAddOffer />
        return <Dashboard onNavigate={handleNavigate} />
      case "projects":
        if (isRecruiterSpace) return <RecruiterHome />
        return <Projects />
      case "portfolio":
        if (isRecruiterSpace) return <RecruiterHome />
        return <Portfolio />
      case "matching":
        if (isRecruiterSpace) return <RecruiterHome />
        return <Recommendations />
      case "skills":
        if (isRecruiterSpace) return <RecruiterHome />
        return <SkillsScreen />
      case "settings":
        return (
          <Settings
            onBack={() => setCurrentTab("dashboard")}
            onLogout={async () => {
              await logout()
              onExitMain()
            }}
            onEditProfile={handleProfileEdit}
            onChangePassword={handleChangePassword}
            onHelpFaq={handleHelpFaq}
          />
        )
      case "profile-edit":
        return <EditProfile onBack={() => setCurrentTab("settings")} />
      case "change-password":
        return <ChangePassword onBack={() => setCurrentTab("settings")} />
      case "help-faq":
        return <HelpFaq onBack={() => setCurrentTab("settings")} />
      default:
        return <Dashboard onNavigate={handleNavigate} />
    }
  }

  if (mainDataBlocking) {
    return (
      <View className="flex-1 items-center justify-center">
        <ActivityIndicator size="large" color={THEME.accent} />
      </View>
    )
  }

  const navContextValue = {
    goToTab: (tab: BottomTabId) => {
      setCurrentTab(tab)
      if (tab !== "messages") setActiveConversationId(null)
    },
    openConversation: (conversationId: number) => {
      setCurrentTab("messages")
      setActiveConversationId(conversationId)
    },
  }

  return (
    <AppNavigationProvider value={navContextValue}>
      <View className="flex-1">
        {isChatOpen ? (
          <ChatScreen conversationId={activeConversationId!} onBack={() => setActiveConversationId(null)} />
        ) : (
          <>
            <View className="flex-1">{renderMainTab()}</View>
            <BottomNav
              activeTab={
                currentTab === "settings" ||
                currentTab === "profile-edit" ||
                currentTab === "change-password" ||
                currentTab === "help-faq"
                  ? "settings"
                  : currentTab
              }
              onTabChange={handleNavigate}
              mode={isRecruiterSpace ? "recruiter" : "student"}
            />
          </>
        )}
      </View>
    </AppNavigationProvider>
  )
}

export default function Index() {
  const { theme: THEME } = useAppTheme()
  const { loading: authLoading, isAuthenticated, logout } = useAuth()

  const [currentScreen, setCurrentScreen] = useState<Screen>("welcome")
  const [resetEmail, setResetEmail] = useState("")

  const isLoading = authLoading

  const screenToShow = useMemo((): Screen | "_loading" => {
    if (isLoading) return "_loading"
    if (isAuthenticated) return "main"
    if (currentScreen === "main") return "login"
    return currentScreen
  }, [isLoading, isAuthenticated, currentScreen])

  const handleGetStarted = useCallback(() => {
    setCurrentScreen("login")
  }, [])

  const handleAuthSuccess = useCallback(() => {
    setCurrentScreen("main")
  }, [])

  const handleBack = useCallback(() => {
    if (currentScreen === "login" || currentScreen === "register") {
      setCurrentScreen("welcome")
    } else if (currentScreen === "forgot-password" || currentScreen === "reset-password") {
      setCurrentScreen("login")
      setResetEmail("")
    } else if (currentScreen === "main") {
      void logout()
      setCurrentScreen("welcome")
    }
  }, [currentScreen, logout])

  const handleExitMain = useCallback(() => {
    setCurrentScreen("welcome")
  }, [])

  const goForgotPassword = useCallback(() => {
    setCurrentScreen("forgot-password")
  }, [])

  const handleForgotPasswordSuccess = useCallback((email: string) => {
    setResetEmail(email)
    setCurrentScreen("reset-password")
  }, [])

  const goRegister = useCallback(() => {
    setCurrentScreen("register")
  }, [])

  const goLogin = useCallback(() => {
    setCurrentScreen("login")
  }, [])

  const renderScreen = () => {
    if (screenToShow === "_loading") {
      return (
        <View className="flex-1 items-center justify-center">
          <ActivityIndicator size="large" color={THEME.accent} />
        </View>
      )
    }

    switch (screenToShow) {
      case "welcome":
        return <Welcome onGetStarted={handleGetStarted} />
      case "login":
        return (
          <Login
            onBack={handleBack}
            onLoginSuccess={handleAuthSuccess}
            onForgotPassword={goForgotPassword}
            onSignUp={goRegister}
          />
        )
      case "register":
        return (
          <Register
            onBack={handleBack}
            onRegisterSuccess={handleAuthSuccess}
            onSwitchToLogin={goLogin}
          />
        )
      case "forgot-password":
        return <ForgotPassword onBack={handleBack} onRequestSuccess={handleForgotPasswordSuccess} />
      case "reset-password":
        return (
          <ResetPassword
            email={resetEmail}
            onBack={handleBack}
            onResetSuccess={() => setCurrentScreen("login")}
          />
        )
      case "main":
        return <MainApp onExitMain={handleExitMain} />
      default:
        return <Welcome onGetStarted={handleGetStarted} />
    }
  }

  return (
    <AppThemeShell>
      <View className="flex-1">
        {renderScreen()}
      </View>
    </AppThemeShell>
  )
}
