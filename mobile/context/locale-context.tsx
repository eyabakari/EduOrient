/**
 * @file Internationalisation runtime : locale fr|en|ar, fonction t(), persistance locale.
 * Les chaînes sont définies dans locales/translations.ts (pas i18next ici).
 */
import { createContext, useContext, type ReactNode } from "react"
import type { TranslationKey } from "../locales/translations"
import { translate } from "../locales/translations"

interface LocaleContextValue {
  t: (key: TranslationKey, vars?: Record<string, string | number>) => string
}

const LocaleContext = createContext<LocaleContextValue | null>(null)

export function AppLocaleProvider({ children }: { children: ReactNode }) {
  const t = (key: TranslationKey, vars?: Record<string, string | number>) =>
    translate("fr", key, vars)

  return <LocaleContext.Provider value={{ t }}>{children}</LocaleContext.Provider>
}

export function useLocale(): LocaleContextValue {
  const ctx = useContext(LocaleContext)
  if (!ctx) {
    throw new Error("useLocale doit être utilisé dans AppLocaleProvider")
  }
  return ctx
}
