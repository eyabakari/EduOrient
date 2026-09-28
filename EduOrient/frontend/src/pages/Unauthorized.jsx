import { Link } from 'react-router-dom';

/**
 * Shown when a user tries to access a route they are not allowed to (e.g. student opening /dashboard/admin).
 */
export default function Unauthorized() {
  return (
    <div className="min-h-screen bg-page flex flex-col items-center justify-center p-4">
      <div className="rounded-2xl bg-card border border-theme p-8 max-w-md w-full text-center shadow-theme">
        <div className="text-6xl mb-4" aria-hidden>🚫</div>
        <h1 className="text-2xl font-bold text-body mb-2">Accès non autorisé</h1>
        <p className="text-muted mb-6">
          Vous n&apos;avez pas les droits pour accéder à cette page.
        </p>
        <Link
          to="/dashboard"
          className="inline-block rounded-xl bg-primary px-6 py-3 text-white font-medium hover:opacity-90 transition"
        >
          Retour au tableau de bord
        </Link>
      </div>
    </div>
  );
}


