import { Navigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import Dashboard from '../pages/Dashboard';

/** Redirection depuis /dashboard selon le rôle (admin, recruteur, étudiant). */
export default function DashboardOrRedirect() {
  const { user } = useAuth();
  const roleName = user?.role?.name;

  if (roleName === 'admin') {
    return <Navigate to="/dashboard/admin" replace />;
  }
  if (roleName === 'recruteur') {
    return <Navigate to="/dashboard/search" replace />;
  }

  return <Dashboard />;
}


