/**
 * @file Utilitaire `cn()` : fusion de classes Tailwind (clsx + tailwind-merge).
 * @see https://github.com/shadcn/ui (pattern cn)
 */
import { clsx, type ClassValue } from "clsx"
import { twMerge } from "tailwind-merge"

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs))
}
