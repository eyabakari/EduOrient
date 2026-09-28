import { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { motion } from 'framer-motion';
import api from '../api/axios';

/**
 * Demande de code OTP par e-mail pour réinitialiser le mot de passe.
 * Backend : POST /api/password/email (ForgotPasswordController::sendOtp).
 */
const inputClass =
  'w-full rounded-xl border border-theme bg-block px-4 py-3 text-body placeholder-[var(--muted)] focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--primary)]/25 focus:outline-none transition-all duration-200';
const labelClass = 'block text-sm font-medium text-body mb-2';

/**
 * Affiche le champ e-mail et redirige vers /reset-password avec l’e-mail en state.
 * Entrées : aucune prop ; state email, navigate.
 * Sortie : JSX.
 */
export default function ForgotPassword() {
  const [email, setEmail] = useState('');
  const [errors, setErrors] = useState({});
  const [submitting, setSubmitting] = useState(false);
  const navigate = useNavigate();

  /**
   * Envoie l’e-mail à l’API pour déclencher l’envoi du code OTP.
   * Entrées : submit ; state email.
   * Sortie : Promise ; navigation ou errors affichés.
   */
  const handleSubmit = async (e) => {
    e.preventDefault();
    setErrors({});
    setSubmitting(true);
    try {
      await api.post('/password/email', { email });
      navigate('/reset-password', { replace: true, state: { email: email.trim(), justSent: true } });
    } catch (err) {
      if (err.response?.status === 422 && err.response?.data?.errors) {
        setErrors(err.response.data.errors);
      } else if (err.response?.data?.message) {
        setErrors({ email: [err.response.data.message] });
      } else {
        setErrors({ email: ['Une erreur est survenue. Veuillez réessayer.'] });
      }
    } finally {
      setSubmitting(false);
    }
  };

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
              <h1 className="text-2xl font-bold text-body tracking-tight">Mot de passe oublié</h1>
              <p className="text-muted mt-1 text-sm">
                Saisissez votre adresse e-mail : nous vous enverrons un code à 6 chiffres (valable 15 minutes).
              </p>
            </div>

            <form onSubmit={handleSubmit} className="space-y-5">
              <div>
                <label htmlFor="email" className={labelClass}>
                  Adresse e-mail
                </label>
                <input
                  id="email"
                  type="email"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  autoComplete="email"
                  className={inputClass}
                  placeholder="prenom.nom@email.com"
                  required
                />
                {errors.email && <p className="mt-1.5 text-sm text-red-500">{errors.email[0]}</p>}
              </div>

              <button
                type="submit"
                disabled={submitting}
                className="w-full rounded-xl bg-primary text-white font-semibold py-3.5 px-4 shadow-theme transition-all duration-200 disabled:opacity-60 disabled:cursor-not-allowed focus:ring-2 focus:ring-[var(--primary)]/50 focus:ring-offset-2 focus:outline-none"
              >
                {submitting ? 'Envoi…' : 'Envoyer le code'}
              </button>
            </form>

            <p className="mt-6 text-center text-sm text-muted">
              <Link to="/login" className="text-[var(--primary)] hover:opacity-90 font-semibold transition-colors">
                Retour à la connexion
              </Link>
            </p>
          </div>
        </motion.div>
      </div>
    </div>
  );
}


