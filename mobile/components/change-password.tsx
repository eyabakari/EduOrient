/**
 * @file Changement de mot de passe (PUT /profile/password).
 */
import { useCallback, useState } from "react"
import { Alert, ScrollView, Text, TouchableOpacity, View } from "react-native"
import { ArrowLeft, Eye, EyeOff, Lock } from "lucide-react-native"
import { AuthTextField } from "./auth-text-field"
import { GlassCard } from "./glass-card"
import { GradientButton } from "./gradient-button"
import { useAppTheme } from "@/context/app-theme-context"
import { useLocale } from "@/context/locale-context"
import { useBottomTabBarHeight } from "@/hooks/use-bottom-tab-bar-height"
import { api } from "@/lib/api"

interface ChangePasswordProps {
  onBack: () => void
}

export function ChangePassword({ onBack }: ChangePasswordProps) {
  const { t } = useLocale()
  const { theme: THEME } = useAppTheme()
  const tabBarHeight = useBottomTabBarHeight()
  const [currentPassword, setCurrentPassword] = useState("")
  const [newPassword, setNewPassword] = useState("")
  const [confirmPassword, setConfirmPassword] = useState("")
  const [showCurrent, setShowCurrent] = useState(false)
  const [showNew, setShowNew] = useState(false)
  const [showConfirm, setShowConfirm] = useState(false)
  const [saving, setSaving] = useState(false)
  const [errorMessage, setErrorMessage] = useState<string | null>(null)

  const handleSubmit = useCallback(async () => {
    if (newPassword !== confirmPassword) {
      setErrorMessage(t("change_password_mismatch"))
      return
    }

    if (newPassword.length < 8) {
      setErrorMessage(t("change_password_min"))
      return
    }

    setSaving(true)
    setErrorMessage(null)

    try {
      await api.put("/profile/password", {
        current_password: currentPassword,
        password: newPassword,
        password_confirmation: confirmPassword,
      })
      Alert.alert(
        t("change_password_success_title"),
        t("change_password_success_body")
      )
      onBack()
    } catch (error: any) {
      const message =
        error.response?.data?.message || t("change_password_err_generic")
      setErrorMessage(message)
    } finally {
      setSaving(false)
    }
  }, [confirmPassword, currentPassword, newPassword, onBack, t])

  return (
    <ScrollView
      className="flex-1 px-4 pt-6"
      contentContainerStyle={{ paddingBottom: tabBarHeight + 24 }}
    >
      <View className="mb-6 flex-row items-center gap-3">
        <TouchableOpacity
          onPress={onBack}
          className="rounded-2xl border border-border/60 p-2.5"
          style={{ backgroundColor: THEME.mutedSurface }}
          activeOpacity={0.85}
        >
          <ArrowLeft size={22} color={THEME.foreground} />
        </TouchableOpacity>
        <Text className="text-3xl font-bold tracking-tight text-foreground">
          {t("change_password_title")}
        </Text>
      </View>

      <GlassCard className="mb-6" contentClassName="gap-4 p-4">
        <AuthTextField
          label={t("change_password_current")}
          value={currentPassword}
          onChangeText={setCurrentPassword}
          placeholder={t("change_password_current_ph")}
          secureTextEntry={!showCurrent}
          leftIcon={<Lock size={18} color={THEME.muted} />}
          rightAccessory={
            <TouchableOpacity
              onPress={() => setShowCurrent(!showCurrent)}
              className="p-1"
            >
              {showCurrent ? (
                <EyeOff size={18} color={THEME.muted} />
              ) : (
                <Eye size={18} color={THEME.muted} />
              )}
            </TouchableOpacity>
          }
        />

        <AuthTextField
          label={t("change_password_new")}
          value={newPassword}
          onChangeText={setNewPassword}
          placeholder={t("change_password_new_ph")}
          secureTextEntry={!showNew}
          leftIcon={<Lock size={18} color={THEME.muted} />}
          rightAccessory={
            <TouchableOpacity
              onPress={() => setShowNew(!showNew)}
              className="p-1"
            >
              {showNew ? (
                <EyeOff size={18} color={THEME.muted} />
              ) : (
                <Eye size={18} color={THEME.muted} />
              )}
            </TouchableOpacity>
          }
        />

        <AuthTextField
          label={t("change_password_confirm")}
          value={confirmPassword}
          onChangeText={setConfirmPassword}
          placeholder={t("change_password_confirm_ph")}
          secureTextEntry={!showConfirm}
          leftIcon={<Lock size={18} color={THEME.muted} />}
          rightAccessory={
            <TouchableOpacity
              onPress={() => setShowConfirm(!showConfirm)}
              className="p-1"
            >
              {showConfirm ? (
                <EyeOff size={18} color={THEME.muted} />
              ) : (
                <Eye size={18} color={THEME.muted} />
              )}
            </TouchableOpacity>
          }
        />

        {errorMessage ? (
          <Text className="text-sm text-rose-300">{errorMessage}</Text>
        ) : null}

        <GradientButton onPress={handleSubmit} loading={saving} disabled={saving}>
          {t("change_password_submit")}
        </GradientButton>
      </GlassCard>
    </ScrollView>
  )
}
