/**
 * @file Champ libellé + icônes pour formulaires login / register / profil.
 */
import { useRef, useState } from "react"
import {
  View,
  Text,
  Pressable,
  TextInput,
  type TextInputProps,
} from "react-native"
import { AuthInputRow } from "./auth-input-row"
import { ThemedTextInput } from "./themed-text-input"
import { cn } from "@/lib/utils"

type Props = TextInputProps & {
  label: string
  leftIcon?: React.ReactNode
  rightAccessory?: React.ReactNode
  containerClassName?: string
}

/**
 * Icône tap → focus sur le champ. Le TextInput n’est pas dans un Pressable
 * (évite les conflits de toucher Android). Le bouton œil reste hors du Pressable icône.
 */
export function AuthTextField({
  label,
  leftIcon,
  rightAccessory,
  containerClassName,
  ...inputProps
}: Props) {
  const [focused, setFocused] = useState(false)
  const inputRef = useRef<TextInput>(null)

  return (
    <View collapsable={false} className={cn("gap-2", containerClassName)}>
      <Text className="text-xs font-semibold uppercase tracking-[0.08em] text-muted-foreground">
        {label}
      </Text>
      <AuthInputRow focused={focused}>
        <View
          style={{
            flex: 1,
            minWidth: 0,
            flexDirection: "row",
            alignItems: "center",
            gap: 12,
          }}
        >
          {leftIcon ? (
            <Pressable
              accessibilityRole="button"
              accessibilityLabel={`${label}, focus le champ`}
              hitSlop={12}
              onPress={() => inputRef.current?.focus()}
              style={({ pressed }) => ({ opacity: pressed ? 0.7 : 1 })}
            >
              {leftIcon}
            </Pressable>
          ) : null}
          <ThemedTextInput
            ref={inputRef}
            {...inputProps}
            onFocus={(e) => {
              setFocused(true)
              inputProps.onFocus?.(e)
            }}
            onBlur={(e) => {
              setFocused(false)
              inputProps.onBlur?.(e)
            }}
          />
        </View>
        {rightAccessory ? (
          <View collapsable={false} style={{ flexShrink: 0 }}>
            {rightAccessory}
          </View>
        ) : null}
      </AuthInputRow>
    </View>
  )
}
