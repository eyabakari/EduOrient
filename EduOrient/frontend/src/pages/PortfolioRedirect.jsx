import { Navigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

/**
 * Redirige l'étudiant connecté vers son portfolio public.
 * Si l'utilisateur n'est pas étudiant, affiche un message.
 */
export default function PortfolioRedirect() {
  const { user } = useAuth();
  const etudiantId = user?.candidat?.id;

  if (etudiantId != null) {
    return <Navigate to={`/dashboard/portfolio/${etudiantId}`} replace />;
  }

  return (
    <div className="min-h-screen bg-[#F5F6FA] flex items-center justify-center p-6">
      <div className="rounded-2xl border border-white/20 bg-white/10 p-8 backdrop-blur-md text-center max-w-md">
        <p className="text-white/80">Cette page est réservée aux étudiants. Connectez-vous avec un compte étudiant pour accéder à votre portfolio.</p>
      </div>
    </div>
  );
}


