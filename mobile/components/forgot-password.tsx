/**
 * @file Mot de passe oublié (placeholder si l’API ne expose pas encore l’endpoint).
 */
import { useState } from "react"
import axios from "axios"
import { Mail } from "lucide-react-native"
import { View, Text, ScrollView, Platform } from "react-native"
import { GlassCard } from "./glass-card"
import { AuthTextField } from "./auth-text-field"
import { AuthBrandMark } from "./auth-brand-mark"
import { AuthBackButton } from "./auth-back-button"
import { GradientButton } from "./gradient-button"
import { useAppTheme } from "@/context/app-theme-context"
import { useLocale } from "@/context/locale-context"
import { api } from "@/lib/api"

interface ForgotPasswordProps {
  onBack: () => void
  onRequestSuccess: (email: string) => void
}

export function ForgotPassword({ onBack, onRequestSuccess }: ForgotPasswordProps) {
  const { theme: THEME } = useAppTheme()
  const { t } = useLocale()
  const [email, setEmail] = useState("")
  const [isLoading, setIsLoading] = useState(false)
  const [error, setError] = useState("")

  const handleSubmit = async () => {
    setError("")
    if (!email.trim()) {
      setError("L'adresse e-mail est obligatoire.")
      return
    }

    setIsLoading(true)
    try {
      await api.post("/password/email", { email: email.trim() })
      onRequestSuccess(email.trim())
    } catch (err) {
      if (axios.isAxiosError(err)) {
        const data = err.response?.data as { message?: string; errors?: Record<string, string[]> } | undefined
        if (data?.errors?.email?.[0]) {
          setError(data.errors.email[0])
        } else if (typeof data?.message === "string") {
          setError(data.message)
        } else {
          setError("Impossible d'envoyer le code de réinitialisation.")
        }
      } else {
        setError("Impossible d'envoyer le code de réinitialisation.")
      }
    } finally {
      setIsLoading(false)
    }
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
          <Text className="mb-2 text-center text-3xl font-bold tracking-tight text-foreground">
            {t("forgot_title")}
          </Text>
          <Text className="max-w-[320px] text-center text-base leading-relaxed text-muted-foreground">
            {t("forgot_subtitle")}
          </Text>
        </View>

        <GlassCard variant="strong" plain>
          <View collapsable={false}>
            <AuthTextField
              label={t("auth_email")}
              containerClassName="mb-6"
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
            {error ? <Text className="mb-4 text-sm font-semibold text-destructive">{error}</Text> : null}
            <GradientButton
              onPress={() => void handleSubmit()}
              disabled={isLoading}
              loading={isLoading}
            >
              {t("forgot_submit")}
            </GradientButton>
          </View>
        </GlassCard>
      </ScrollView>
    </View>
  )
}
