import { useState, useEffect } from 'react';
import { Link, useNavigate, useLocation } from 'react-router-dom';
import { motion } from 'framer-motion';
import api from '../api/axios';

/**
 * Saisie du code OTP + nouveau mot de passe après « mot de passe oublié ».
 * Backend : POST /api/password/reset (ForgotPasswordController::reset).
 */
const inputClass =
  'w-full rounded-xl border border-theme bg-block px-4 py-3 text-body placeholder-[var(--muted)] focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--primary)]/25 focus:outline-none transition-all duration-200';
const labelClass = 'block text-sm font-medium text-body mb-2';

/**
 * Lit l’e-mail depuis location.state ; affiche le formulaire de reset ou un message si e-mail manquant.
 * Entrées : location.state (email, justSent), navigate.
 * Sortie : JSX.
 */
export default function ResetPassword() {
  const navigate = useNavigate();
  const location = useLocation();
  const [email, setEmail] = useState(() => location.state?.email ?? '');
  const [sentBanner, setSentBanner] = useState(() => Boolean(location.state?.justSent));
  const [code, setCode] = useState('');
  const [newPassword, setNewPassword] = useState('');
  const [newPasswordConfirmation, setNewPasswordConfirmation] = useState('');
  const [errors, setErrors] = useState({});
  const [submitting, setSubmitting] = useState(false);

  /**
   * Synchronise email / bandeau « code envoyé » quand le state de navigation change.
   * Entrées : location.state.
   * Sortie : aucune ; met à jour le state local.
   */
  useEffect(() => {
    if (location.state?.email) {
      setEmail(location.state.email);
    }
    if (location.state?.justSent) {
      setSentBanner(true);
    }
  }, [location.state]);

  /**
   * Vérifie le code et définit le nouveau mot de passe via l’API, puis renvoie vers la connexion.
   * Entrées : submit ; state email, code, newPassword, newPasswordConfirmation.
   * Sortie : Promise ; navigate('/login') si succès.
   */
  const handleSubmit = async (e) => {
    e.preventDefault();
    setErrors({});
    setSubmitting(true);
    try {
      await api.post('/password/reset', {
        email: email.trim(),
        code: code.replace(/\D/g, ''),
        new_password: newPassword,
        new_password_confirmation: newPasswordConfirmation,
      });
      navigate('/login', { replace: true, state: { passwordReset: true } });
    } catch (err) {
      if (err.response?.status === 422 && err.response?.data?.errors) {
        setErrors(err.response.data.errors);
      } else if (err.response?.data?.message) {
        setErrors({ general: [err.response.data.message] });
      } else {
        setErrors({ general: ['Une erreur est survenue. Veuillez réessayer.'] });
      }
    } finally {
      setSubmitting(false);
    }
  };

  if (!email) {
    return (
      <div className="min-h-screen flex flex-col items-center justify-center bg-page p-4">
        <div className="max-w-md rounded-2xl border border-theme bg-card p-8 shadow-theme text-center">
          <p className="text-body font-medium">Indiquez d’abord votre e-mail sur la page précédente.</p>
          <Link
            to="/forgot-password"
            className="mt-4 inline-block text-[var(--primary)] font-semibold hover:opacity-90"
          >
            Mot de passe oublié
          </Link>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen flex flex-col relative overflow-hidden bg-page">
      <div
        className="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%239D7BFF\' fill-opacity=\'0.03\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-80"
        aria-hidden
      />
      <div className="relative z-10 flex flex-1 items-center justify-center p-4 py-12">
        <motion.div
          initial={{ opacity: 0, y: 16 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.35, ease: [0.25, 0.46, 0.45, 0.94] }}
          className="w-full max-w-md"
        >
          <div className="rounded-2xl bg-card backdrop-blur-sm shadow-theme p-6 md:p-8 border border-theme">
            <div className="text-center mb-8">
              <div className="inline-flex items-center justify-center gap-2 mb-3">
                <span className="h-1.5 w-10 rounded-full bg-gradient-to-r from-[var(--primary)] to-[#B794F6]" />
                <span className="text-xl font-bold text-[var(--primary)] tracking-tight">ProLink</span>
                <span className="h-1.5 w-10 rounded-full bg-gradient-to-r from-[#B794F6] to-[var(--primary)]" />
              </div>
              <h1 className="text-2xl font-bold text-body tracking-tight">Nouveau mot de passe</h1>
              <p className="text-muted mt-1 text-sm">
                Saisissez le code reçu par e-mail pour <span className="font-medium text-body">{email}</span>, puis votre nouveau mot de passe.
              </p>
            </div>

            <form onSubmit={handleSubmit} className="space-y-5">
              {sentBanner && (
                <p className="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                  Un code de réinitialisation a été envoyé à votre adresse e-mail. Il est valable 15 minutes.
                </p>
              )}
              {errors.general && <p className="text-sm text-red-500">{errors.general[0]}</p>}

              <div>
                <label htmlFor="code" className={labelClass}>
                  Code à 6 chiffres
                </label>
                <input
                  id="code"
                  type="text"
                  inputMode="numeric"
                  autoComplete="one-time-code"
                  maxLength={12}
                  value={code}
                  onChange={(e) => setCode(e.target.value)}
                  className={inputClass}
                  placeholder="000000"
                />
                {errors.code && <p className="mt-1.5 text-sm text-red-500">{errors.code[0]}</p>}
              </div>

              <div>
                <label htmlFor="new_password" className={labelClass}>
                  Nouveau mot de passe
                </label>
                <input
                  id="new_password"
                  type="password"
                  value={newPassword}
                  onChange={(e) => setNewPassword(e.target.value)}
                  autoComplete="new-password"
                  className={inputClass}
                  placeholder="••••••••"
                />
                {errors.new_password && <p className="mt-1.5 text-sm text-red-500">{errors.new_password[0]}</p>}
              </div>

              <div>
                <label htmlFor="new_password_confirmation" className={labelClass}>
                  Confirmer le mot de passe
                </label>
                <input
                  id="new_password_confirmation"
                  type="password"
                  value={newPasswordConfirmation}
                  onChange={(e) => setNewPasswordConfirmation(e.target.value)}
                  autoComplete="new-password"
                  className={inputClass}
                  placeholder="••••••••"
                />
              </div>

              {errors.email && <p className="text-sm text-red-500">{errors.email[0]}</p>}

              <button
                type="submit"
                disabled={submitting}
                className="w-full rounded-xl bg-primary text-white font-semibold py-3.5 px-4 shadow-theme transition-all duration-200 disabled:opacity-60 disabled:cursor-not-allowed focus:ring-2 focus:ring-[var(--primary)]/50 focus:ring-offset-2 focus:outline-none"
              >
                {submitting ? 'Enregistrement…' : 'Réinitialiser le mot de passe'}
              </button>
            </form>

            <p className="mt-6 text-center text-sm text-muted">
              <Link to="/forgot-password" state={{ email }} className="text-[var(--primary)] hover:opacity-90 font-semibold transition-colors">
                Renvoyer un code
              </Link>
              {' · '}
              <Link to="/login" className="text-[var(--primary)] hover:opacity-90 font-semibold transition-colors">
                Connexion
              </Link>
            </p>
          </div>
        </motion.div>
      </div>
    </div>
  );
}


