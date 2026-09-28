import { Platform } from "react-native"
import Constants from "expo-constants"

const PC_IP = "192.168.1.104"
const PC_PORT = 8000

function getEnvApiOrigin() {
  const candidates = [
    typeof process !== "undefined" && process.env?.EXPO_PUBLIC_API_ORIGIN,
    globalThis?.process?.env?.EXPO_PUBLIC_API_ORIGIN,
    Constants?.expoConfig?.extra?.EXPO_PUBLIC_API_ORIGIN,
    Constants?.manifest?.extra?.EXPO_PUBLIC_API_ORIGIN,
  ]

  return candidates.find((value) => typeof value === "string" && value.trim())?.trim() || null
}

function getExpoHostOrigin() {
  const hostSource =
    Constants.manifest?.debuggerHost ||
    Constants.manifest2?.debuggerHost ||
    Constants.expoConfig?.hostUri ||
    Constants.manifest2?.hostUri ||
    null

  if (!hostSource) return null

  const host = String(hostSource).split(":")[0]
  if (!host || host === "localhost" || host === "127.0.0.1" || host === "0.0.0.0") {
    return null
  }

  return `http://${host}:${PC_PORT}`
}

const ANDROID_FALLBACK_ORIGINS = [
  getExpoHostOrigin(),
  `http://10.0.2.2:${PC_PORT}`,
  `http://10.0.3.2:${PC_PORT}`,
  `http://${PC_IP}:${PC_PORT}`,
].filter(Boolean)
const IOS_FALLBACK_ORIGINS = [
  getExpoHostOrigin(),
  `http://localhost:${PC_PORT}`,
  `http://${PC_IP}:${PC_PORT}`,
].filter(Boolean)
const DEFAULT_FALLBACK_ORIGINS = [
  getExpoHostOrigin(),
  `http://${PC_IP}:${PC_PORT}`,
].filter(Boolean)

function getDefaultApiOrigin() {
  const platformOrigins =
    Platform.OS === "android"
      ? ANDROID_FALLBACK_ORIGINS
      : Platform.OS === "ios"
      ? IOS_FALLBACK_ORIGINS
      : DEFAULT_FALLBACK_ORIGINS

  return platformOrigins[0] ?? `http://${PC_IP}:${PC_PORT}`
}

export const API_ORIGIN = getEnvApiOrigin() || getDefaultApiOrigin()
export const API_BASE_URL = `${API_ORIGIN.replace(/\/$/, "")}/api`

export default {
  API_ORIGIN,
  API_BASE_URL,
}
