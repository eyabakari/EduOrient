import { useState, useEffect } from 'react';
import { Link, useNavigate, useLocation } from 'react-router-dom';
import { motion } from 'framer-motion';
import { useAuth } from '../context/AuthContext';
import { needsEmailVerification } from '../utils/emailVerification';

/**
 * Page de connexion : formulaire email / mot de passe, lien mot de passe oublié, redirection après succès.
 * Backend : POST /api/login (AuthController) ; token Sanctum stocké via AuthContext.
 */
const inputClass = 'w-full rounded-xl border border-theme bg-block px-4 py-3 text-body placeholder-[var(--muted)] focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--primary)]/25 focus:outline-none transition-all duration-200';
const labelClass = 'block text-sm font-medium text-body mb-2';

/**
 * Affiche le formulaire de login et gère la soumission.
 * Entrées : aucune prop ; état local (email, password), useAuth().login, react-router (navigate, location).
 * Sortie : JSX ; effets de bord : navigation vers /verify-email ou /dashboard, message si reset MDP réussi.
 */
export default function Login() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [errors, setErrors] = useState({});
  const [submitting, setSubmitting] = useState(false);
  const { login } = useAuth();
  const navigate = useNavigate();
  const location = useLocation();
  const [resetNotice, setResetNotice] = useState(false);

  /**
   * Si l’utilisateur arrive depuis la page reset avec state.passwordReset, affiche un bandeau et nettoie l’URL.
   * Entrées : location.state, location.pathname, navigate.
   * Sortie : aucune valeur ; met à jour resetNotice et remplace l’historique sans state.
   */
  useEffect(() => {
    if (location.state?.passwordReset) {
      setResetNotice(true);
      navigate(location.pathname, { replace: true, state: {} });
    }
  }, [location.pathname, location.state, navigate]);

  /**
   * Envoie les identifiants à l’API, puis redirige selon la vérification e-mail.
   * Entrées : événement submit du formulaire ; lit email, password depuis le state.
   * Sortie : Promise ; en cas d’erreur 422 remplit errors pour affichage inline.
   */
  const handleSubmit = async (e) => {
    e.preventDefault();
    setErrors({});
    setSubmitting(true);
    try {
      const data = await login({ email, password });
      if (needsEmailVerification(data?.user)) {
        navigate('/verify-email', { replace: true });
      } else {
        navigate('/dashboard', { replace: true });
      }
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
      <div className="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%239D7BFF\' fill-opacity=\'0.03\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-80" aria-hidden />
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
              <h1 className="text-2xl font-bold text-body tracking-tight">Connexion</h1>
              <p className="text-muted mt-1 text-sm">Accédez à votre espace personnel</p>
            </div>

            <form onSubmit={handleSubmit} className="space-y-5">
              {resetNotice && (
                <p className="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                  Votre mot de passe a été réinitialisé. Vous pouvez vous connecter avec le nouveau mot de passe.
                </p>
              )}
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
                />
                {errors.email && (
                  <p className="mt-1.5 text-sm text-red-500">{errors.email[0]}</p>
                )}
              </div>

              <div>
                <label htmlFor="password" className={labelClass}>
                  Mot de passe
                </label>
                <input
                  id="password"
                  type="password"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  autoComplete="current-password"
                  className={inputClass}
                  placeholder="••••••••"
                />
                {errors.password && (
                  <p className="mt-1.5 text-sm text-red-500">{errors.password[0]}</p>
                )}
              </div>

              <div className="text-right -mt-1">
                <Link
                  to="/forgot-password"
                  className="text-sm font-medium text-[var(--primary)] hover:opacity-90 transition-colors"
                >
                  Mot de passe oublié ?
                </Link>
              </div>

              <button
                type="submit"
                disabled={submitting}
                className="w-full rounded-xl bg-primary text-white font-semibold py-3.5 px-4 shadow-theme transition-all duration-200 disabled:opacity-60 disabled:cursor-not-allowed focus:ring-2 focus:ring-[var(--primary)]/50 focus:ring-offset-2 focus:outline-none"
              >
                {submitting ? 'Connexion…' : 'Se connecter'}
              </button>
            </form>

            <p className="mt-6 text-center text-sm text-muted">
              Pas encore de compte ?{' '}
              <Link to="/register" className="text-[var(--primary)] hover:opacity-90 font-semibold transition-colors">
                S&apos;inscrire
              </Link>
            </p>
          </div>
        </motion.div>
      </div>
    </div>
  );
}


