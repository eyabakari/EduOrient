import { Link } from 'react-router-dom';
import DashboardLayout from '../components/DashboardLayout';
import OfferList from '../components/OfferList';

/** Liste des offres publiées par le recruteur (GET /api/offers via OfferList). */
export default function RecruiterMyOffers() {
  return (
    <DashboardLayout>
      <div className="mx-auto max-w-3xl space-y-6 pb-8">
        <header className="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
          <div className="space-y-1">
            <h1 className="text-2xl font-bold tracking-tight text-body">Mes offres</h1>
            <p className="text-sm text-muted leading-relaxed">
              Retrouvez ici vos annonces publiées et les compétences associées.
            </p>
          </div>
          <Link
            to="/recruteur/ajouter-offre"
            className="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-theme transition hover:opacity-95"
          >
            <PlusCircleIcon className="h-5 w-5 shrink-0" aria-hidden />
            Publier une offre
          </Link>
        </header>

        <OfferList />
      </div>
    </DashboardLayout>
  );
}

function PlusCircleIcon({ className }) {
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden>
      <path
        strokeLinecap="round"
        strokeLinejoin="round"
        strokeWidth={2}
        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
      />
    </svg>
  );
}


