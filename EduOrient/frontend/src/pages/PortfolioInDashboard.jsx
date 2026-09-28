import { Navigate, useParams } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import DashboardLayout from '../components/DashboardLayout';
import PortfolioView from './PortfolioView';

const RECRUITER_ROLES = ['recruteur', 'admin'];

/**
 * Vue portfolio dans le tableau de bord (Sidebar + Navbar).
 * Accessible aux recruteurs/admins pour tout portfolio, et aux étudiants pour leur propre portfolio.
 */
export default function PortfolioInDashboard() {
  const { user } = useAuth();
  const { id } = useParams();
  const isRecruiterOrAdmin = user?.role?.name && RECRUITER_ROLES.includes(user.role.name);
  const isOwnPortfolio = user?.candidat?.id != null && String(user.candidat.id) === String(id);
  const canAccess = isRecruiterOrAdmin || isOwnPortfolio;

  if (user && !canAccess) {
    return <Navigate to="/dashboard" replace />;
  }

  return (
    <DashboardLayout>
      <PortfolioView embedded />
    </DashboardLayout>
  );
}


