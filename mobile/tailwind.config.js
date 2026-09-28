/**
 * Config Tailwind + NativeWind v4 : chemins `content`, couleurs sémantiques via rgb(var(--token)).
 * @see https://www.nativewind.dev/docs/getting-started/installation
 * @type {import('tailwindcss').Config}
 */
module.exports = {
  darkMode: "class",
  corePlugins: {
    preflight: false,
  },
  content: [
    "./app/**/*.{js,jsx,ts,tsx}",
    "./components/**/*.{js,jsx,ts,tsx}",
    "./constants/**/*.{js,jsx,ts,tsx}",
    "./hooks/**/*.{js,jsx,ts,tsx}",
    "./lib/**/*.{js,jsx,ts,tsx}",
  ],
  presets: [require("nativewind/preset")],
  theme: {
    extend: {
      colors: {
        border: "rgb(var(--color-border) / <alpha-value>)",
        "border-light": "rgb(226 232 240 / <alpha-value>)",
        input: "rgb(var(--color-input) / <alpha-value>)",
        "input-light": "rgb(248 250 252 / <alpha-value>)",
        ring: "rgb(var(--color-ring) / <alpha-value>)",
        background: "rgb(var(--color-background) / <alpha-value>)",
        "bg-light": "rgb(248 250 252 / <alpha-value>)",
        foreground: "rgb(var(--color-foreground) / <alpha-value>)",
        "fg-light": "rgb(15 23 42 / <alpha-value>)",
        surface: "rgb(var(--color-surface) / <alpha-value>)",
        primary: {
          DEFAULT: "rgb(var(--color-primary) / <alpha-value>)",
          foreground: "rgb(var(--color-primary-foreground) / <alpha-value>)",
        },
        secondary: {
          DEFAULT: "rgb(var(--color-secondary) / <alpha-value>)",
          foreground: "rgb(var(--color-secondary-foreground) / <alpha-value>)",
        },
        destructive: {
          DEFAULT: "rgb(var(--color-destructive) / <alpha-value>)",
          foreground: "rgb(var(--color-destructive-foreground) / <alpha-value>)",
        },
        muted: {
          DEFAULT: "rgb(var(--color-muted) / <alpha-value>)",
          foreground: "rgb(var(--color-muted-foreground) / <alpha-value>)",
        },
        accent: {
          DEFAULT: "rgb(var(--color-accent) / <alpha-value>)",
          foreground: "rgb(var(--color-accent-foreground) / <alpha-value>)",
        },
        popover: {
          DEFAULT: "rgb(var(--color-popover) / <alpha-value>)",
          foreground: "rgb(var(--color-popover-foreground) / <alpha-value>)",
        },
        card: {
          DEFAULT: "rgb(var(--color-card) / <alpha-value>)",
          foreground: "rgb(var(--color-card-foreground) / <alpha-value>)",
          light: "rgb(var(--color-card) / <alpha-value>)",
          "light-foreground": "rgb(var(--color-card-foreground) / <alpha-value>)",
          "light-border": "rgb(var(--color-border) / <alpha-value>)",
        },
        chart: {
          "1": "#A78BFA",
          "2": "#22D3EE",
          "3": "#C084FC",
          "4": "#2DD4BF",
          "5": "#818CF8",
        },
        sidebar: {
          DEFAULT: "rgb(var(--color-sidebar-bg) / <alpha-value>)",
          foreground: "rgb(var(--color-sidebar-fg) / <alpha-value>)",
          primary: "rgb(var(--color-sidebar-primary) / <alpha-value>)",
          "primary-foreground":
            "rgb(var(--color-sidebar-primary-fg) / <alpha-value>)",
          accent: "rgb(var(--color-sidebar-accent) / <alpha-value>)",
          "accent-foreground":
            "rgb(var(--color-sidebar-accent-fg) / <alpha-value>)",
          border: "rgb(var(--color-sidebar-border) / <alpha-value>)",
          ring: "rgb(var(--color-ring) / <alpha-value>)",
        },
        success: {
          DEFAULT: "#34D399",
          foreground: "#022C22",
        },
        neon: {
          cyan: "#22D3EE",
          violet: "#A78BFA",
          blue: "#60A5FA",
        },
      },
      borderRadius: {
        lg: "16px",
        md: "12px",
        sm: "8px",
      },
      animation: {
        "pulse-glow": "pulse-glow 2s ease-in-out infinite",
        "progress-spin": "progress-spin 2s linear infinite",
      },
      keyframes: {
        "pulse-glow": {
          "0%, 100%": {
            boxShadow:
              "0 0 12px rgba(34, 211, 238, 0.28), 0 0 22px rgba(167, 139, 250, 0.15)",
          },
          "50%": {
            boxShadow:
              "0 0 16px rgba(34, 211, 238, 0.38), 0 0 28px rgba(167, 139, 250, 0.2)",
          },
        },
        "progress-spin": {
          from: { transform: "rotate(0deg)" },
          to: { transform: "rotate(360deg)" },
        },
      },
      backgroundImage: {
        "gradient-radial":
          "radial-gradient(ellipse at top, rgba(34, 211, 238, 0.08) 0%, transparent 55%), radial-gradient(ellipse at bottom, rgba(8, 15, 28, 0.9) 0%, #080F1C 100%)",
      },
    },
  },
  plugins: [],
}
