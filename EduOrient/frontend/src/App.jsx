/** Routes React : pages publiques, tableau de bord protégé par authentification et par rôle. */
import { useEffect, lazy, Suspense } from 'react';
import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import { AuthProvider } from './context/AuthContext';
import { NotificationProvider } from './context/NotificationContext';
import { getPreferences, applyTheme } from './utils/preferences';
import ProtectedRoute from './components/ProtectedRoute';
import RoleProtectedRoute from './components/RoleProtectedRoute';
import PublicLayout from './components/PublicLayout';
import ScrollToTop from './components/ScrollToTop';
import ErrorBoundary from './components/ErrorBoundary';
import { PageLoader } from './components/common';
import './index.css';

// Chargement à la demande des pages (réduit le volume initial).
const LandingPage = lazy(() => import('./pages/LandingPage'));
const Login = lazy(() => import('./pages/Login'));
const ForgotPassword = lazy(() => import('./pages/ForgotPassword'));
const ResetPassword = lazy(() => import('./pages/ResetPassword'));
const Register = lazy(() => import('./pages/Register'));
const VerifyEmail = lazy(() => import('./pages/VerifyEmail'));
const FAQ = lazy(() => import('./pages/FAQ'));
const About = lazy(() => import('./pages/About'));
const Support = lazy(() => import('./pages/Support'));
const Terms = lazy(() => import('./pages/Terms'));
const Privacy = lazy(() => import('./pages/Privacy'));
const PortfolioView = lazy(() => import('./pages/PortfolioView'));
const DashboardOrRedirect = lazy(() => import('./components/DashboardOrRedirect'));
const Projects = lazy(() => import('./pages/Projects'));
const Skills = lazy(() => import('./pages/Skills'));
const Recommendations = lazy(() => import('./pages/Recommendations'));
const PortfolioInDashboard = lazy(() => import('./pages/PortfolioInDashboard'));
const PortfolioRedirect = lazy(() => import('./pages/PortfolioRedirect'));
const RecruiterSearch = lazy(() => import('./pages/RecruiterSearch'));
const RecruiterAddOffer = lazy(() => import('./pages/RecruiterAddOffer'));
const RecruiterMyOffers = lazy(() => import('./pages/RecruiterMyOffers'));
const Messagerie = lazy(() => import('./pages/Messagerie'));
const AdminDashboard = lazy(() => import('./pages/AdminDashboard'));
const AdminUsers = lazy(() => import('./pages/AdminUsers'));
const AdminSkills = lazy(() => import('./pages/AdminSkills'));
const Settings = lazy(() => import('./pages/Settings'));
const Unauthorized = lazy(() => import('./pages/Unauthorized'));

function App() {
  // Appliquer le thème (clair/sombre) au chargement et quand l'utilisateur change les préférences système.
  useEffect(() => {
    const prefs = getPreferences();
    applyTheme(prefs.general?.theme ?? 'system');
    const media = window.matchMedia('(prefers-color-scheme: dark)');
    const listener = () => {
      const prefs = getPreferences();
      if (prefs.general?.theme === 'system') applyTheme('system');
    };
    media.addEventListener('change', listener);
    return () => media.removeEventListener('change', listener);
  }, []);

  return (
    <ErrorBoundary>
      <AuthProvider>
        <NotificationProvider>
        <BrowserRouter>
            <ScrollToTop />
            <Suspense fallback={<PageLoader />}>
              <Routes>
                <Route element={<PublicLayout />}>
                  <Route index element={<LandingPage />} />
                  <Route path="login" element={<Login />} />
                  <Route path="forgot-password" element={<ForgotPassword />} />
                  <Route path="reset-password" element={<ResetPassword />} />
                  <Route path="register" element={<Register />} />
                  <Route
                    path="verify-email"
                    element={
                      <ProtectedRoute>
                        <VerifyEmail />
                      </ProtectedRoute>
                    }
                  />
                  <Route path="faq" element={<FAQ />} />
                  <Route path="a-propos" element={<About />} />
                  <Route path="support" element={<Support />} />
                  <Route path="terms" element={<Terms />} />
                  <Route path="privacy" element={<Privacy />} />
                  <Route path="portfolio/:id" element={<PortfolioView />} />
                </Route>
                <Route
                  path="/dashboard"
                  element={
                    <ProtectedRoute>
                      <DashboardOrRedirect />
                    </ProtectedRoute>
                  }
                />
                <Route
                  path="/dashboard/projets"
                  element={
                    <ProtectedRoute>
                      <RoleProtectedRoute allowedRoles={['candidat']}>
                        <Projects />
                      </RoleProtectedRoute>
                    </ProtectedRoute>
                  }
                />
                <Route
                  path="/dashboard/competences"
                  element={
                    <ProtectedRoute>
                      <RoleProtectedRoute allowedRoles={['candidat']}>
                        <Skills />
                      </RoleProtectedRoute>
                    </ProtectedRoute>
                  }
                />
                <Route
                  path="/dashboard/recommandations"
                  element={
                    <ProtectedRoute>
                      <RoleProtectedRoute allowedRoles={['candidat']}>
                        <Recommendations />
                      </RoleProtectedRoute>
                    </ProtectedRoute>
                  }
                />
                <Route
                  path="/dashboard/orientation"
                  element={
                    <ProtectedRoute>
                      <RoleProtectedRoute allowedRoles={['candidat']}>
                        <Recommendations />
                      </RoleProtectedRoute>
                    </ProtectedRoute>
                  }
                />
                <Route
                  path="/dashboard/portfolio/:id"
                  element={
                    <ProtectedRoute>
                      <RoleProtectedRoute allowedRoles={['candidat']}>
                        <PortfolioInDashboard />
                      </RoleProtectedRoute>
                    </ProtectedRoute>
                  }
                />
                <Route
                  path="/dashboard/portfolio"
                  element={
                    <ProtectedRoute>
                      <RoleProtectedRoute allowedRoles={['candidat']}>
                        <PortfolioRedirect />
                      </RoleProtectedRoute>
                    </ProtectedRoute>
                  }
                />
                <Route
                  path="/dashboard/search"
                  element={
                    <ProtectedRoute>
                      <RoleProtectedRoute allowedRoles={['recruteur', 'admin']}>
                        <RecruiterSearch />
                      </RoleProtectedRoute>
                    </ProtectedRoute>
                  }
                />
                <Route
                  path="/recruteur/ajouter-offre"
                  element={
                    <ProtectedRoute>
                      <RoleProtectedRoute allowedRoles={['recruteur']}>
                        <RecruiterAddOffer />
                      </RoleProtectedRoute>
                    </ProtectedRoute>
                  }
                />
                <Route
                  path="/recruteur/mes-offres"
                  element={
                    <ProtectedRoute>
                      <RoleProtectedRoute allowedRoles={['recruteur']}>
                        <RecruiterMyOffers />
                      </RoleProtectedRoute>
                    </ProtectedRoute>
                  }
                />
                <Route
                  path="/dashboard/messagerie"
                  element={
                    <ProtectedRoute>
                      <RoleProtectedRoute allowedRoles={['candidat', 'recruteur']}>
                        <Messagerie />
                      </RoleProtectedRoute>
                    </ProtectedRoute>
                  }
                />
                <Route
                  path="/dashboard/admin"
                  element={
                    <ProtectedRoute>
                      <RoleProtectedRoute allowedRoles={['admin']}>
                        <AdminDashboard />
                      </RoleProtectedRoute>
                    </ProtectedRoute>
                  }
                />
                <Route
                  path="/dashboard/admin/users"
                  element={
                    <ProtectedRoute>
                      <RoleProtectedRoute allowedRoles={['admin']}>
                        <AdminUsers />
                      </RoleProtectedRoute>
                    </ProtectedRoute>
                  }
                />
                <Route
                  path="/dashboard/admin/projects"
                  element={<Navigate to="/dashboard/admin/users" replace />}
                />
                <Route
                  path="/dashboard/admin/skills"
                  element={
                    <ProtectedRoute>
                      <RoleProtectedRoute allowedRoles={['admin']}>
                        <AdminSkills />
                      </RoleProtectedRoute>
                    </ProtectedRoute>
                  }
                />
                <Route
                  path="/dashboard/admin/offres"
                  element={<Navigate to="/dashboard/admin/users" replace />}
                />
                <Route
                  path="/unauthorized"
                  element={
                    <ProtectedRoute>
                      <Unauthorized />
                    </ProtectedRoute>
                  }
                />
                <Route
                  path="/dashboard/parametres"
                  element={
                    <ProtectedRoute>
                      <Settings />
                    </ProtectedRoute>
                  }
                />
                <Route path="*" element={<Navigate to="/" replace />} />
              </Routes>
            </Suspense>
          </BrowserRouter>
        </NotificationProvider>
      </AuthProvider>
    </ErrorBoundary>
  );
}

export default App;


