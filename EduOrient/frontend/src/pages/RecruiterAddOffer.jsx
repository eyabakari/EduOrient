import DashboardLayout from '../components/DashboardLayout';
import AddOfferForm from '../components/AddOfferForm.jsx';

/** Page recruteur : formulaire de publication d’offre (stage / emploi). */
export default function RecruiterAddOffer() {
  return (
    <DashboardLayout>
      <div className="mx-auto max-w-3xl space-y-6 pb-8">
        <header className="space-y-1">
          <h1 className="text-2xl font-bold tracking-tight text-body">Publier une offre</h1>
          <p className="text-sm text-muted leading-relaxed">
            Décrivez le poste, choisissez le type et les compétences requises. L&apos;annonce sera visible pour le matching avec les étudiants.
          </p>
        </header>
        {/* Redirection post-publication gérée dans AddOfferForm (useNavigate) */}
        <AddOfferForm />
      </div>
    </DashboardLayout>
  );
}


