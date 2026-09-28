/**
 * @file TextInput stylé selon le thème (couleurs lisibles).
 */
import { forwardRef } from "react"
import {
  Platform,
  TextInput,
  type TextInputProps,
  type StyleProp,
  type TextStyle,
} from "react-native"
import { getReadable } from "@/constants/readable"
import { useAppTheme } from "@/context/app-theme-context"

type Props = Omit<TextInputProps, "style"> & {
  style?: StyleProp<TextStyle>
}

/** Sans className NativeWind sur la vue native (souvent lié aux bugs de focus Android). */
export const ThemedTextInput = forwardRef<TextInput, Props>(function ThemedTextInput(
  { style, placeholderTextColor, multiline, ...props },
  ref
) {
  const { theme: THEME, isDark } = useAppTheme()
  const READABLE = getReadable(THEME, isDark)

  const androidAlign =
    Platform.OS === "android"
      ? { includeFontPadding: false, textAlignVertical: multiline ? ("top" as const) : ("center" as const) }
      : {}

  return (
    <TextInput
      ref={ref}
      placeholderTextColor={placeholderTextColor ?? READABLE.placeholder}
      selectionColor={THEME.primary}
      cursorColor={READABLE.foreground}
      underlineColorAndroid="transparent"
      multiline={multiline}
      style={[
        {
          flex: 1,
          minWidth: 0,
          paddingVertical: 8,
          fontSize: 16,
          lineHeight: 22,
          color: READABLE.foreground,
          ...androidAlign,
        },
        style,
      ]}
      {...props}
    />
  )
})
