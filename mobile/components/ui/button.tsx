/**
 * @file Bouton générique style shadcn (variantes Tailwind) — usage ponctuel si besoin.
 */
import * as React from 'react'
import { TouchableOpacity } from 'react-native'
import { cn } from '@/lib/utils'

interface ButtonProps {
  variant?: 'default' | 'destructive' | 'outline' | 'secondary' | 'ghost' | 'link'
  size?: 'default' | 'sm' | 'lg' | 'icon' | 'icon-sm' | 'icon-lg'
  className?: string
  children: React.ReactNode
  onPress?: () => void
  disabled?: boolean
}

const buttonVariants = {
  default: 'bg-primary text-primary-foreground',
  destructive: 'bg-destructive text-white',
  outline: 'border bg-background',
  secondary: 'bg-secondary text-secondary-foreground',
  ghost: 'hover:bg-accent',
  link: 'text-primary underline',
}

const buttonSizes = {
  default: 'h-9 px-4 py-2',
  sm: 'h-8 px-3',
  lg: 'h-10 px-6',
  icon: 'w-9 h-9',
  'icon-sm': 'w-8 h-8',
  'icon-lg': 'w-10 h-10',
}

export function Button({
  variant = 'default',
  size = 'default',
  className,
  children,
  onPress,
  disabled,
}: ButtonProps) {
  return (
    <TouchableOpacity
      onPress={onPress}
      disabled={disabled}
      className={cn(
        'inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium transition-all disabled:opacity-50',
        buttonVariants[variant],
        buttonSizes[size],
        className
      )}
    >
      {children}
    </TouchableOpacity>
  )
}