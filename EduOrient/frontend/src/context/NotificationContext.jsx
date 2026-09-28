import { createContext, useCallback, useContext, useEffect, useRef, useState } from 'react';
import { AnimatePresence, motion } from 'framer-motion';

const NotificationContext = createContext(null);

function makeToastId() {
  if (typeof crypto !== 'undefined' && typeof crypto.randomUUID === 'function') {
    return crypto.randomUUID();
  }
  return `toast-${Date.now()}-${Math.random().toString(36).slice(2, 9)}`;
}

/**
 * Fournit des toasts globaux (coin bas-droit) pour succès, erreur ou info.
 * Utilisation : `const { notifySuccess, notifyError } = useNotification()` depuis n’importe quelle page.
 */
export function NotificationProvider({ children }) {
  const [toasts, setToasts] = useState([]);
  const timersRef = useRef(new Map());

  const dismiss = useCallback((id) => {
    setToasts((prev) => prev.filter((t) => t.id !== id));
    const t = timersRef.current.get(id);
    if (t) {
      clearTimeout(t);
      timersRef.current.delete(id);
    }
  }, []);

  const notify = useCallback(
    (message, options = {}) => {
      const { variant = 'success', duration = 4500 } = options;
      const id = makeToastId();
      setToasts((prev) => [{ id, message, variant }, ...prev]);
      if (duration > 0) {
        const timer = setTimeout(() => dismiss(id), duration);
        timersRef.current.set(id, timer);
      }
      return id;
    },
    [dismiss],
  );

  const notifySuccess = useCallback((message, duration) => notify(message, { variant: 'success', duration }), [notify]);
  const notifyError = useCallback((message, duration) => notify(message, { variant: 'error', duration }), [notify]);
  const notifyInfo = useCallback((message, duration) => notify(message, { variant: 'info', duration }), [notify]);

  useEffect(() => {
    const map = timersRef.current;
    return () => {
      map.forEach((t) => clearTimeout(t));
      map.clear();
    };
  }, []);

  const value = { notify, notifySuccess, notifyError, notifyInfo, dismiss };

  return (
    <NotificationContext.Provider value={value}>
      {children}
      <ToastViewport toasts={toasts} onDismiss={dismiss} />
    </NotificationContext.Provider>
  );
}

function ToastViewport({ toasts, onDismiss }) {
  return (
    <div
      className="pointer-events-none fixed inset-x-0 bottom-0 z-[200] flex flex-col-reverse items-stretch gap-2 p-4 sm:inset-x-auto sm:bottom-6 sm:right-6 sm:left-auto sm:max-w-md sm:items-end"
      aria-live="polite"
      aria-relevant="additions text"
    >
      <AnimatePresence initial={false}>
        {toasts.map((t) => (
          <motion.div
            key={t.id}
            layout
            initial={{ opacity: 0, y: 12, scale: 0.98 }}
            animate={{ opacity: 1, y: 0, scale: 1 }}
            exit={{ opacity: 0, x: 16, scale: 0.98 }}
            transition={{ type: 'spring', stiffness: 420, damping: 32 }}
            className={`pointer-events-auto flex w-full max-w-full items-start gap-3 rounded-2xl border px-4 py-3.5 shadow-lg backdrop-blur-md sm:max-w-md ${
              t.variant === 'error'
                ? 'border-red-200 bg-red-50/95 text-red-900 dark:border-red-900/60 dark:bg-red-950/90 dark:text-red-100'
                : t.variant === 'info'
                  ? 'border-theme bg-card/95 text-body shadow-theme'
                  : 'border-emerald-200 bg-emerald-50/95 text-emerald-900 dark:border-emerald-900/50 dark:bg-emerald-950/90 dark:text-emerald-100'
            }`}
            role="status"
          >
            <span className="min-w-0 flex-1 text-sm font-medium leading-snug">{t.message}</span>
            <button
              type="button"
              onClick={() => onDismiss(t.id)}
              className="shrink-0 rounded-lg px-1.5 py-0.5 text-xs underline opacity-80 hover:opacity-100"
            >
              Fermer
            </button>
          </motion.div>
        ))}
      </AnimatePresence>
    </div>
  );
}

export function useNotification() {
  const ctx = useContext(NotificationContext);
  if (!ctx) {
    throw new Error('useNotification doit être utilisé à l’intérieur de NotificationProvider.');
  }
  return ctx;
}


