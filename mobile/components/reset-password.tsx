import { useCallback, useState } from "react"
import { Alert, ScrollView, Text, TouchableOpacity, View } from "react-native"
import { ArrowLeft, Eye, EyeOff, Lock, Mail } from "lucide-react-native"
import { AuthTextField } from "./auth-text-field"
import { GlassCard } from "./glass-card"
import { GradientButton } from "./gradient-button"
import { useAppTheme } from "@/context/app-theme-context"
import { api } from "@/lib/api"

interface ResetPasswordProps {
  email: string
  onBack: () => void
  onResetSuccess: () => void
}

export function ResetPassword({ email, onBack, onResetSuccess }: ResetPasswordProps) {
  const { theme: THEME } = useAppTheme()
  const [code, setCode] = useState("")
  const [newPassword, setNewPassword] = useState("")
  const [confirmPassword, setConfirmPassword] = useState("")
  const [showPassword, setShowPassword] = useState(false)
  const [showConfirm, setShowConfirm] = useState(false)
  const [isLoading, setIsLoading] = useState(false)
  const [error, setError] = useState("")

  const handleSubmit = useCallback(async () => {
    setError("")

    if (code.trim().length !== 6 || !/^[0-9]{6}$/.test(code.trim())) {
      setError("Le code à 6 chiffres est obligatoire.")
      return
    }

    if (!newPassword) {
      setError("Le nouveau mot de passe est obligatoire.")
      return
    }

    if (newPassword !== confirmPassword) {
      setError("La confirmation du mot de passe ne correspond pas.")
      return
    }

    if (newPassword.length < 8) {
      setError("Le mot de passe doit contenir au moins 8 caractères.")
      return
    }

    setIsLoading(true)
    try {
      await api.post("/password/reset", {
        email: email.trim(),
        code: code.trim(),
        new_password: newPassword,
        new_password_confirmation: confirmPassword,
      })
      Alert.alert("Mot de passe réinitialisé", "Votre mot de passe a été réinitialisé avec succès.")
      onResetSuccess()
    } catch (err: any) {
      const message = err.response?.data?.message || err.response?.data?.errors?.code?.[0] || err.response?.data?.errors?.new_password?.[0] || "Impossible de réinitialiser le mot de passe."
      setError(message)
    } finally {
      setIsLoading(false)
    }
  }, [code, confirmPassword, email, newPassword, onResetSuccess])

  return (
    <ScrollView
      className="flex-1 px-4 pt-6"
      contentContainerStyle={{ paddingBottom: 120 }}
      keyboardShouldPersistTaps="handled"
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
        <Text className="text-3xl font-bold tracking-tight text-foreground">Nouveau mot de passe</Text>
      </View>

      <GlassCard className="mb-6" contentClassName="gap-4 p-4">
        <AuthTextField
          label="Adresse e-mail"
          value={email}
          leftIcon={<Mail size={18} color={THEME.muted} />}
          editable={false}
        />

        <AuthTextField
          label="Code à 6 chiffres"
          value={code}
          onChangeText={setCode}
          placeholder="123456"
          keyboardType="numeric"
          maxLength={6}
          leftIcon={<Lock size={18} color={THEME.muted} />}
          editable={!isLoading}
        />

        <AuthTextField
          label="Nouveau mot de passe"
          value={newPassword}
          onChangeText={setNewPassword}
          placeholder="••••••••"
          secureTextEntry={!showPassword}
          leftIcon={<Lock size={18} color={THEME.muted} />}
          rightAccessory={
            <TouchableOpacity onPress={() => setShowPassword(!showPassword)} className="p-1">
              {showPassword ? <EyeOff size={18} color={THEME.muted} /> : <Eye size={18} color={THEME.muted} />}
            </TouchableOpacity>
          }
          editable={!isLoading}
        />

        <AuthTextField
          label="Confirmer le mot de passe"
          value={confirmPassword}
          onChangeText={setConfirmPassword}
          placeholder="••••••••"
          secureTextEntry={!showConfirm}
          leftIcon={<Lock size={18} color={THEME.muted} />}
          rightAccessory={
            <TouchableOpacity onPress={() => setShowConfirm(!showConfirm)} className="p-1">
              {showConfirm ? <EyeOff size={18} color={THEME.muted} /> : <Eye size={18} color={THEME.muted} />}
            </TouchableOpacity>
          }
          editable={!isLoading}
        />

        {error ? <Text className="text-sm text-destructive">{error}</Text> : null}

        <GradientButton onPress={handleSubmit} loading={isLoading} disabled={isLoading}>
          Valider le nouveau mot de passe
        </GradientButton>
      </GlassCard>
    </ScrollView>
  )
}
