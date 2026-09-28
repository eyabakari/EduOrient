import { Navigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

/**
 * Protects routes by role: only allows access if user.role.name is in allowedRoles.
 * Use after ProtectedRoute (user must be authenticated first).
 * If role is not allowed, redirects to /unauthorized or to /dashboard (user's own dashboard).
 */
export default function RoleProtectedRoute({ children, allowedRoles = [] }) {
  const { user, loading } = useAuth();
  const roleName = user?.role?.name;

  if (loading) {
    return (
      <div className="min-h-screen flex items-center justify-center bg-page">
        <div className="text-muted">Chargement...</div>
      </div>
    );
  }

  const isAllowed = Array.isArray(allowedRoles) && allowedRoles.length > 0 && roleName && allowedRoles.includes(roleName);

  if (!isAllowed) {
    return <Navigate to="/unauthorized" replace />;
  }

  return children;
}


