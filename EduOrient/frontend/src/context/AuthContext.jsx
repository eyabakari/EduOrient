import { createContext, useContext, useState, useEffect } from 'react';
import api from '../api/axios';

/**
 * État global d’authentification : user + token Sanctum (localStorage + header Axios).
 * API : POST /login, POST /register, GET /me (AuthController).
 */
const AuthContext = createContext(null);

/**
 * Enveloppe l’application pour fournir user, token et les actions login/register/logout.
 * Entrées : children (composants React).
 * Sortie : JSX Provider.
 */
export function AuthProvider({ children }) {
  const [user, setUser] = useState(null);
  const [token, setToken] = useState(null);
  const [loading, setLoading] = useState(true);

  /**
   * Au chargement : restaure la session depuis localStorage puis valide le token via GET /api/me.
   * Entrées : aucune ; lit localStorage.token.
   * Sortie : aucune ; remplit user/token ou les efface si token invalide.
   */
  useEffect(() => {
    const storedToken = localStorage.getItem('token');
    if (!storedToken) {
      setLoading(false);
      return;
    }
    setToken(storedToken);
    api
      .get('/me')
      .then((res) => {
        const fullUser = res.data?.user;
        if (fullUser) {
          setUser(fullUser);
          localStorage.setItem('user', JSON.stringify(fullUser));
        }
      })
      .catch(() => {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        setUser(null);
        setToken(null);
      })
      .finally(() => setLoading(false));
  }, []);

  /**
   * Connexion : envoie email/mot de passe, enregistre user + token (state + localStorage).
   * Entrées : credentials { email, password }.
   * Sortie : Promise résolue avec la réponse API (user, token).
   */
  const login = async (credentials) => {
    const { data } = await api.post('/login', credentials);
    const { user: userData, token: newToken } = data;
    setUser(userData);
    setToken(newToken);
    localStorage.setItem('token', newToken);
    localStorage.setItem('user', JSON.stringify(userData));
    return data;
  };

  /**
   * Inscription : envoie le corps du formulaire (JSON ou FormData), stocke user + token comme login.
   * Entrées : data (objet ou FormData).
   * Sortie : Promise avec la réponse API.
   */
  const register = async (data) => {
    const { data: response } = await api.post('/register', data);
    const { user: userData, token: newToken } = response;
    setUser(userData);
    setToken(newToken);
    localStorage.setItem('token', newToken);
    localStorage.setItem('user', JSON.stringify(userData));
    return response;
  };

  /**
   * Déconnexion locale : supprime token et user du state et du stockage navigateur.
   * Entrées : aucune.
   * Sortie : aucune.
   */
  const logout = () => {
    setUser(null);
    setToken(null);
    localStorage.removeItem('token');
    localStorage.removeItem('user');
  };

  /**
   * Remplace l’objet utilisateur en mémoire (ex. après vérif e-mail ou mise à jour profil).
   * Entrées : userData (objet ou null).
   * Sortie : aucune.
   */
  const updateUser = (userData) => {
    setUser(userData);
    if (userData) localStorage.setItem('user', JSON.stringify(userData));
  };

  /**
   * Recharge l’utilisateur complet depuis GET /api/me (rôle, relations).
   * Entrées : aucune.
   * Sortie : Promise<user|null>.
   */
  const refreshMe = async () => {
    const { data } = await api.get('/me');
    const fullUser = data?.user;
    if (fullUser) {
      setUser(fullUser);
      localStorage.setItem('user', JSON.stringify(fullUser));
    }
    return fullUser;
  };

  const value = {
    user,
    token,
    loading,
    login,
    register,
    logout,
    updateUser,
    refreshMe,
    isAuthenticated: !!token,
  };

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}

/**
 * Accès au contexte d’auth ; lève une erreur si utilisé hors AuthProvider.
 * Entrées : aucune.
 * Sortie : objet { user, token, loading, login, register, logout, updateUser, refreshMe, isAuthenticated }.
 */
export function useAuth() {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error('useAuth must be used within an AuthProvider');
  }
  return context;
}


