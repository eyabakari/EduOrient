/**
 * @file Connexion email / mot de passe (Sanctum).
 */
import { useState } from "react"
import { Mail, Lock, Eye, EyeOff } from "lucide-react-native"
import {
  View,
  Text,
  TouchableOpacity,
  ScrollView,
  Alert,
  Platform,
} from "react-native"
import axios from "axios"
import { GlassCard } from "./glass-card"
import { AuthTextField } from "./auth-text-field"
import { AuthBrandMark } from "./auth-brand-mark"
import { AuthBackButton } from "./auth-back-button"
import { GradientButton } from "./gradient-button"
import { OutlineButton } from "./outline-button"
import { useAppTheme } from "@/context/app-theme-context"
import { useLocale } from "@/context/locale-context"
import { useAuth } from "@/context/auth-context"

interface LoginProps {
  onLoginSuccess: () => void
  onBack: () => void
  onForgotPassword: () => void
  onSignUp: () => void
}

function formatLoginError(err: unknown): string {
  if (axios.isAxiosError(err)) {
    const data = err.response?.data as
      | { message?: string; errors?: Record<string, string[]> }
      | undefined
    if (data?.errors) {
      const first = Object.values(data.errors).flat()[0]
      if (first) return first
    }
    if (typeof data?.message === "string") return data.message
    if (err.message) return err.message
  }
  if (err instanceof Error) return err.message
  return "Connexion impossible. Vérifie ta connexion et réessaie."
}

export function Login({
  onLoginSuccess,
  onBack,
  onForgotPassword,
  onSignUp,
}: LoginProps) {
  const { theme: THEME } = useAppTheme()
  const { t } = useLocale()
  const { login } = useAuth()
  const [email, setEmail] = useState("")
  const [password, setPassword] = useState("")
  const [showPassword, setShowPassword] = useState(false)
  const [isLoading, setIsLoading] = useState(false)
  const [formError, setFormError] = useState("")

  const handleSubmit = async () => {
    setFormError("")
    const trimmedEmail = email.trim()
    if (!trimmedEmail || !password) {
      setFormError("Email et mot de passe obligatoires.")
      return
    }

    setIsLoading(true)
    try {
      await login({ email: trimmedEmail, password })
      onLoginSuccess()
    } catch (e) {
      setFormError(formatLoginError(e))
    } finally {
      setIsLoading(false)
    }
  }

  const handleGoogleLogin = () => {
    Alert.alert(t("login_google_alert_title"), t("login_google_alert_body"))
  }

  return (
    <View className="flex-1" style={{ flex: 1 }}>
      <ScrollView
        className="flex-1"
        style={{ flex: 1 }}
        contentContainerStyle={{
          paddingHorizontal: 24,
          paddingTop: 28,
          paddingBottom: 120,
        }}
        keyboardShouldPersistTaps="handled"
        keyboardDismissMode="on-drag"
        removeClippedSubviews={false}
        automaticallyAdjustKeyboardInsets={Platform.OS === "ios"}
        showsVerticalScrollIndicator={false}
      >
      <AuthBackButton onPress={onBack} />

      <View className="mb-8 items-center">
        <AuthBrandMark />
        <Text className="mb-2 text-3xl font-bold tracking-tight text-foreground">
          {t("login_title")}
        </Text>
        <Text className="max-w-[300px] text-center text-base leading-relaxed text-muted-foreground">
          {t("login_subtitle")}
        </Text>
      </View>

        <GlassCard variant="strong" plain>
        <AuthTextField
          label={t("auth_email")}
          containerClassName="mb-5"
          leftIcon={<Mail size={20} color={THEME.muted} />}
          value={email}
          onChangeText={(text) => setEmail(text)}
          placeholder={t("auth_placeholder_email")}
          keyboardType="email-address"
          autoCapitalize="none"
          autoCorrect={false}
          autoComplete="email"
          textContentType="emailAddress"
          returnKeyType="done"
          editable={!isLoading}
        />

        <AuthTextField
          label={t("auth_password")}
          containerClassName="mb-4"
          leftIcon={<Lock size={20} color={THEME.muted} />}
          rightAccessory={
            <TouchableOpacity
              onPress={() => setShowPassword(!showPassword)}
              hitSlop={{ top: 10, bottom: 10, left: 10, right: 10 }}
            >
              {showPassword ? (
                <EyeOff size={20} color={THEME.muted} />
              ) : (
                <Eye size={20} color={THEME.muted} />
              )}
            </TouchableOpacity>
          }
          value={password}
          onChangeText={(text) => setPassword(text)}
          placeholder="••••••••"
          secureTextEntry={!showPassword}
          autoComplete="password"
          textContentType="password"
          returnKeyType="done"
          editable={!isLoading}
        />

        <View className="mb-6 items-end">
          <TouchableOpacity
            onPress={onForgotPassword}
            hitSlop={{ top: 8, bottom: 8 }}
          >
            <Text className="text-sm font-medium" style={{ color: THEME.primary }}>
              {t("login_forgot")}
            </Text>
          </TouchableOpacity>
        </View>

        {formError ? (
          <Text className="mb-4 text-center text-sm font-medium text-destructive">
            {formError}
          </Text>
        ) : null}

        <View className="mb-6">
          <GradientButton
            onPress={() => void handleSubmit()}
            disabled={isLoading}
            loading={isLoading}
          >
            {t("login_submit")}
          </GradientButton>
        </View>
      </GlassCard>

      <View className="mt-8 items-center">
        <View className="flex-row flex-wrap justify-center gap-1">
          <Text className="text-base text-muted-foreground">{t("login_no_account")}</Text>
          <TouchableOpacity onPress={onSignUp} hitSlop={{ top: 6, bottom: 6 }}>
            <Text className="text-base font-semibold" style={{ color: THEME.primary }}>
              {t("login_signup")}
            </Text>
          </TouchableOpacity>
        </View>
      </View>
      </ScrollView>
    </View>
  )
}
