/**
 * @file Racine Expo Router : providers globaux (auth, thème, langue, données), navigation Stack.
 * Initialise le handler de notifications en foreground sur iOS/Android (fichier séparé .native).
 * @see https://docs.expo.dev/router/introduction/
 * @see https://reactnavigation.org/docs/themes/
 */
import { DarkTheme, DefaultTheme, ThemeProvider } from '@react-navigation/native';
import type { Theme } from '@react-navigation/native';
import { Stack } from 'expo-router';
import { StatusBar } from 'expo-status-bar';
import { useMemo } from 'react';
import { View } from 'react-native';
import { SafeAreaProvider } from 'react-native-safe-area-context';
import 'react-native-reanimated';
import './global.css';
import '@/lib/notification-handler-setup';
import { AppLocaleProvider } from '@/context/locale-context';
import { AppThemeProvider, useAppTheme } from '@/context/app-theme-context';
import { AuthProvider } from '@/context/auth-context';
import { StudentDataProvider } from '@/context/student-data-context';

function NavigationRoot() {
  const { isDark, theme } = useAppTheme();

  const navigationTheme = useMemo<Theme>(() => {
    const base = isDark ? DarkTheme : DefaultTheme;
    return {
      ...base,
      colors: {
        ...base.colors,
        primary: theme.primary,
        background: theme.background,
        card: theme.card,
        text: theme.foreground,
        border: theme.border,
        notification: theme.accent,
      },
    };
  }, [isDark, theme]);

  return (
    <View className="flex-1" style={{ backgroundColor: theme.background }}>
      <ThemeProvider value={navigationTheme}>
        <Stack screenOptions={{ headerShown: false }}>
          <Stack.Screen name="index" />
        </Stack>
        <StatusBar style={isDark ? 'light' : 'dark'} />
      </ThemeProvider>
    </View>
  );
}

export default function RootLayout() {
  return (
    <SafeAreaProvider>
      <AuthProvider>
        <StudentDataProvider>
          <AppThemeProvider>
            <AppLocaleProvider>
              <NavigationRoot />
            </AppLocaleProvider>
          </AppThemeProvider>
        </StudentDataProvider>
      </AuthProvider>
    </SafeAreaProvider>
  );
}
