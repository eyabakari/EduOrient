import { useState, useEffect } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { motion } from 'framer-motion';
import api from '../api/axios';
import { useAuth } from '../context/AuthContext';
import { needsEmailVerification } from '../utils/emailVerification';

const inputClass =
  'w-full rounded-xl border border-theme bg-block px-4 py-3 text-center text-2xl font-mono tracking-[0.35em] text-body placeholder-[var(--muted)] focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--primary)]/25 focus:outline-none transition-all duration-200';

export default function VerifyEmail() {
  const { user, updateUser, logout } = useAuth();
  const navigate = useNavigate();
  const [code, setCode] = useState('');
  const [errors, setErrors] = useState({});
  const [message, setMessage] = useState(null);
  const [submitting, setSubmitting] = useState(false);
  const [resending, setResending] = useState(false);

  useEffect(() => {
    if (!user) return;
    if (!needsEmailVerification(user)) {
      navigate('/dashboard', { replace: true });
    }
  }, [user, navigate]);

  const handleVerify = async (e) => {
    e.preventDefault();
    setErrors({});
    setMessage(null);
    setSubmitting(true);
    try {
      const { data } = await api.post('/auth/verify-email', { code: code.replace(/\D/g, '') });
      if (data?.user) updateUser(data.user);
      navigate('/dashboard', { replace: true });
    } catch (err) {
      if (err.response?.status === 422 && err.response?.data?.errors) {
        setErrors(err.response.data.errors);
      } else {
        setErrors({ code: [err.response?.data?.message || 'Vérification impossible.'] });
      }
    } finally {
      setSubmitting(false);
    }
  };

  const handleResend = async () => {
    setErrors({});
    setMessage(null);
    setResending(true);
    try {
      const { data } = await api.post('/auth/resend-verification');
      setMessage(data?.message || 'Code renvoyé.');
    } catch (err) {
      const msg = err.response?.data?.message || 'Impossible de renvoyer le code.';
      setErrors({ code: [msg] });
    } finally {
      setResending(false);
    }
  };

  const email = user?.email ?? '';

  return (
    <div className="min-h-screen flex flex-col relative overflow-hidden bg-page">
      <div
        className="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%239D7BFF\' fill-opacity=\'0.03\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"
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
              <h1 className="text-2xl font-bold text-body tracking-tight">Vérifier votre e-mail</h1>
              <p className="text-muted mt-2 text-sm leading-relaxed">
                Un code à 6 chiffres a été envoyé à{' '}
                <span className="font-medium text-body">{email || '…'}</span>. Saisissez-le ci-dessous pour activer
                votre compte.
              </p>
            </div>

            <form onSubmit={handleVerify} className="space-y-5">
              <div>
                <label htmlFor="code" className="block text-sm font-medium text-body mb-2 text-center">
                  Code à 6 chiffres
                </label>
                <input
                  id="code"
                  name="code"
                  type="text"
                  inputMode="numeric"
                  autoComplete="one-time-code"
                  maxLength={6}
                  value={code}
                  onChange={(e) => setCode(e.target.value.replace(/\D/g, '').slice(0, 6))}
                  className={inputClass}
                  placeholder="••••••"
                />
                {errors.code && <p className="mt-2 text-center text-sm text-red-500">{errors.code[0]}</p>}
              </div>
              {message && !errors.code && <p className="text-center text-sm text-emerald-600 dark:text-emerald-400">{message}</p>}
              <button
                type="submit"
                disabled={submitting || code.length !== 6}
                className="w-full rounded-xl bg-primary py-3 text-sm font-semibold text-white shadow-theme transition disabled:opacity-60"
              >
                {submitting ? 'Vérification…' : 'Vérifier'}
              </button>
            </form>

            <div className="mt-6 flex flex-col items-center gap-3 border-t border-theme pt-6">
              <button
                type="button"
                onClick={handleResend}
                disabled={resending}
                className="text-sm font-medium text-[var(--primary)] hover:underline disabled:opacity-50"
              >
                {resending ? 'Envoi en cours…' : 'Renvoyer le code'}
              </button>
              <button
                type="button"
                onClick={() => {
                  logout();
                  navigate('/login', { replace: true });
                }}
                className="text-xs text-muted hover:text-body"
              >
                Se déconnecter et utiliser un autre compte
              </button>
              <Link to="/" className="text-xs text-muted hover:text-body">
                Retour à l’accueil
              </Link>
            </div>
          </div>
        </motion.div>
      </div>
    </div>
  );
}


