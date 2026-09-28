import { Navigate, useLocation } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import { needsEmailVerification } from '../utils/emailVerification';

/**
 * Composant "garde" pour les routes qui nécessitent d'être connecté (tout /dashboard/*).
 *
 * - Si loading : on affiche un écran de chargement (le temps de lire token/user depuis localStorage ou /me).
 * - Si pas authentifié (pas de token) : redirection vers /login. "state={{ from: location }}" permet de
 *   rediriger l'utilisateur vers la page qu'il voulait après connexion (optionnel).
 * - Si authentifié : on affiche les "children" (ex. Dashboard, Projects, etc.).
 *
 * Utilisation dans App.jsx : <Route path="/dashboard" element={<ProtectedRoute><DashboardOrRedirect /></ProtectedRoute>} />
 */
export default function ProtectedRoute({ children }) {
  const { isAuthenticated, loading, user } = useAuth();
  const location = useLocation();

  if (loading) {
    return (
      <div className="min-h-screen flex items-center justify-center bg-slate-900">
        <div className="text-white/80">Chargement...</div>
      </div>
    );
  }

  if (!isAuthenticated) {
    return <Navigate to="/login" state={{ from: location }} replace />;
  }

  const onVerifyPage = location.pathname === '/verify-email';
  if (needsEmailVerification(user) && !onVerifyPage) {
    return <Navigate to="/verify-email" replace state={{ from: location }} />;
  }
  if (user && !needsEmailVerification(user) && onVerifyPage) {
    return <Navigate to="/dashboard" replace />;
  }

  return children;
}


