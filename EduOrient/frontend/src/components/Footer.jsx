import { Link } from 'react-router-dom';
import { useState } from 'react';
import api from '../api/axios';
import { useAuth } from '../context/AuthContext';
import { useNotification } from '../context/NotificationContext';

const CREATOR_EMAIL = 'mailto:elbaccarieya@gmail.com';

const SERVICES_LINKS = [
  { label: 'Créer Portfolio', path: '/dashboard/portfolio' },
  { label: 'Orientation Pro', path: '/dashboard/orientation' },
  { label: 'Espace Recruteur', path: '/dashboard/search' },
];

const RESOURCES_LINKS = [
  { label: 'À propos', to: '/a-propos' },
  { label: 'Support', to: '/support' },
  { label: 'FAQ', to: '/faq' },
  { label: "Conditions d'utilisation", to: '/terms' },
  { label: 'Politique de confidentialité', to: '/privacy' },
];

const SOCIAL = [
  {
    name: 'LinkedIn',
    href: 'https://linkedin.com/in/votre-profil',
    icon: LinkedInIcon,
  },
  {
    name: 'GitHub',
    href: 'https://github.com/eyabakari',
    icon: GitHubIcon,
  },
];

function LinkedInIcon({ className }) {
  return (
    <svg className={className} fill="currentColor" viewBox="0 0 24 24" aria-hidden>
      <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
    </svg>
  );
}

function GitHubIcon({ className }) {
  return (
    <svg className={className} fill="currentColor" viewBox="0 0 24 24" aria-hidden>
      <path fillRule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clipRule="evenodd" />
    </svg>
  );
}

function FacebookIcon({ className }) {
  return (
    <svg className={className} fill="currentColor" viewBox="0 0 24 24" aria-hidden>
      <path d="M22 12.07C22 6.51 17.52 2 12 2S2 6.51 2 12.07C2 17.1 5.66 21.24 10.44 22v-6.99H7.9v-2.94h2.54V9.82c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.24.2 2.24.2v2.48h-1.26c-1.24 0-1.63.77-1.63 1.56v1.87h2.78l-.44 2.94h-2.34V22C18.34 21.24 22 17.1 22 12.07z" />
    </svg>
  );
}

const linkClass = 'text-sm text-muted transition-colors duration-200 hover:text-[var(--primary)]';
const linkClassBold = 'text-xl font-bold tracking-tight text-body transition-colors duration-200 hover:text-[var(--primary)]';

function collectValidationErrors(data) {
  if (!data?.errors || typeof data.errors !== 'object') {
    return [];
  }
  return Object.values(data.errors).flat();
}

export default function Footer() {
  const { user } = useAuth();
  const { notifySuccess } = useNotification();
  const isLoggedIn = !!user;
  const [contactEmail, setContactEmail] = useState('');
  const [contactMessage, setContactMessage] = useState('');
  const [submitting, setSubmitting] = useState(false);
  const [contactError, setContactError] = useState('');
  const [contactSuccess, setContactSuccess] = useState(false);

  const handleServicesPath = (path) => (isLoggedIn ? path : '/login');

  const handleContactSubmit = async (e) => {
    e.preventDefault();
    setContactError('');
    setContactSuccess(false);
    setSubmitting(true);
    try {
      const { data } = await api.post('/contact', {
        email: contactEmail.trim(),
        message: contactMessage.trim(),
      });
      setContactEmail('');
      setContactMessage('');
      setContactSuccess(true);
      notifySuccess(
        typeof data?.message === 'string' && data.message.trim()
          ? data.message.trim()
          : 'Message envoyé avec succès. Merci !',
      );
      setTimeout(() => {
        setContactSuccess(false);
      }, 4000);
    } catch (err) {
      const status = err.response?.status;
      const body = err.response?.data;
      if (status === 422 && body) {
        const lines = collectValidationErrors(body);
        setContactError(lines.length ? lines.join(' ') : 'Veuillez vérifier les champs du formulaire.');
      } else if (status === 429) {
        setContactError('Trop de tentatives. Réessayez dans une minute.');
      } else {
        setContactError("L'envoi a échoué. Vérifiez votre connexion ou réessayez plus tard.");
      }
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <footer className="border-t border-theme bg-card">
      <div className="mx-auto max-w-6xl px-4 py-10 sm:px-6">
        <div className="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4">
          <div className="space-y-3">
            <Link to="/" className={linkClassBold}>
              ProLink
            </Link>
            <p className="text-sm text-muted">
              Plateforme d&apos;orientation et de recrutement qui relie les talents académiques aux opportunités professionnelles.
            </p>
            <div className="mt-3 flex items-center gap-3">
              {SOCIAL.map(({ name, href, icon: Icon }) => (
                <a
                  key={name}
                  href={href}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="text-muted transition-colors duration-200 hover:text-[var(--primary)]"
                  aria-label={name}
                >
                  <Icon className="h-5 w-5" />
                </a>
              ))}
            </div>
          </div>

          <div>
            <h3 className="text-sm font-semibold uppercase tracking-wider text-body">
              Services
            </h3>
            <ul className="mt-4 space-y-3">
              {SERVICES_LINKS.map(({ label, path }) => (
                <li key={path}>
                  <Link to={handleServicesPath(path)} className={linkClass}>
                    {label}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          <div>
            <h3 className="text-sm font-semibold uppercase tracking-wider text-body">
              Ressources
            </h3>
            <ul className="mt-4 space-y-3">
              {RESOURCES_LINKS.map((item) => (
                <li key={item.to}>
                  <Link to={item.to} className={linkClass}>
                    {item.label}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          <div>
            <h3 className="text-sm font-semibold uppercase tracking-wider text-body">
              Contact
            </h3>
            <p className="mt-3 text-sm text-muted">
              Email : <a href={CREATOR_EMAIL} className="underline hover:text-[var(--primary)]">elbaccarieya@gmail.com</a>
            </p>
            <p className="mt-1 text-sm text-muted">
              Adresse : Sidi Bouzid, Tunisie
            </p>
            <form onSubmit={handleContactSubmit} className="mt-4 space-y-3">
              {contactError ? (
                <p className="rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-800 dark:border-red-900/50 dark:bg-red-950/40 dark:text-red-200">
                  {contactError}
                </p>
              ) : null}
              {contactSuccess ? (
                <p className="rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs text-emerald-800 dark:border-emerald-900/50 dark:bg-emerald-950/40 dark:text-emerald-200">
                  Message envoyé. Merci, nous vous répondrons bientôt.
                </p>
              ) : null}
              <input
                type="email"
                name="contact-email"
                autoComplete="email"
                required
                value={contactEmail}
                onChange={(ev) => setContactEmail(ev.target.value)}
                disabled={submitting}
                placeholder="Votre adresse e-mail"
                className="w-full rounded-xl border border-theme bg-block px-3 py-2 text-sm text-body placeholder-[var(--muted)] focus:border-[var(--primary)]/50 focus:outline-none focus:ring-1 focus:ring-[var(--primary)]/30 disabled:opacity-60"
              />
              <textarea
                name="contact-message"
                required
                minLength={10}
                rows={3}
                value={contactMessage}
                onChange={(ev) => setContactMessage(ev.target.value)}
                disabled={submitting}
                placeholder="Votre message (objet et détail de la demande)"
                className="w-full rounded-xl border border-theme bg-block px-3 py-2 text-sm text-body placeholder-[var(--muted)] focus:border-[var(--primary)]/50 focus:outline-none focus:ring-1 focus:ring-[var(--primary)]/30 resize-none disabled:opacity-60"
              />
              <button
                type="submit"
                disabled={submitting}
                className="rounded-xl bg-primary px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:opacity-90 disabled:cursor-not-allowed disabled:opacity-60"
              >
                {submitting ? 'Envoi…' : 'Envoyer'}
              </button>
            </form>
          </div>
        </div>

        <div className="mt-10 border-t border-theme pt-6 text-center text-sm text-muted">
          © 2026 ProLink. Tous droits réservés.
        </div>
      </div>

    </footer>
  );
}


