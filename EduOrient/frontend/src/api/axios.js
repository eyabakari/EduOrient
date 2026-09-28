import axios from 'axios';

/** Base API : VITE_API_BASE_URL (ex. http://192.168.1.104:8000/api) ou défaut local. */
const envApiBase =
  typeof import.meta !== 'undefined' ? import.meta.env?.VITE_API_BASE_URL : null;
const apiOrigin =
  (typeof import.meta !== 'undefined' && import.meta.env?.VITE_API_ORIGIN) ||
  'http://192.168.1.104:8000';

const baseURL = envApiBase || `${apiOrigin.replace(/\/$/, '')}/api`;

/** Client HTTP partagé vers l’API ProLink (préfixe /api). */
const api = axios.create({
  baseURL,
  withCredentials: true,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
    'X-Requested-With': 'XMLHttpRequest',
  },
});

/** Ajoute le jeton d’authentification ; adapte les envois FormData (upload). */
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    if (config.data instanceof FormData) {
      delete config.headers['Content-Type'];
    }
    return config;
  },
  (error) => Promise.reject(error)
);

/** Sur 401, déconnexion locale (session ou jeton expiré). */
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      localStorage.removeItem('token');
      localStorage.removeItem('user');
    }
    return Promise.reject(error);
  }
);

/** Normalise les URLs des fichiers stockés (affichage images). */
export function getStorageUrl(url) {
  if (!url || typeof url !== 'string') return url;
  try {
    const base = new URL(api.defaults.baseURL);
    const origin = `${base.protocol}//${base.host}`;
    const u = new URL(url, origin);
    const normalizedPath = u.pathname.replace(/^\/storage\/projets\//, '/storage/projects/');
    const path = normalizedPath + u.search;
    if (path.startsWith('/storage')) {
      // Always return a full URL pointing to the API origin so the browser
      // requests the file from the backend (not from Vite dev server).
      return `${origin}${path}`;
    }
    if (u.hostname === 'localhost' || u.hostname === '127.0.0.1') {
      return `${origin}${u.pathname}${u.search}`;
    }
    return url;
  } catch {
    return url;
  }
}

export default api;
