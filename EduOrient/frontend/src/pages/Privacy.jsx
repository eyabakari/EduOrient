import { motion } from 'framer-motion';

export default function Privacy() {
  return (
    <div className="mx-auto max-w-3xl px-4 py-12 sm:px-6">
      <motion.div
        initial={{ opacity: 0, y: 12 }}
        animate={{ opacity: 1, y: 0 }}
        className="rounded-2xl bg-card border border-theme p-8 shadow-theme"
      >
        <h1 className="text-2xl font-bold text-body">Politique de confidentialité</h1>
        <p className="mt-2 text-sm text-muted">Dernière mise à jour : 2026</p>

        <div className="mt-8 space-y-6 text-sm text-body leading-relaxed">
          <section>
            <h2 className="text-lg font-semibold text-body mb-2">1. Responsable du traitement</h2>
            <p>
              La plateforme ProLink est responsable du traitement des données personnelles collectées dans le cadre du service. 
              Protection des données personnelles : nous nous engageons à traiter vos données conformément au cadre juridique applicable 
              et à garantir la confidentialité et la sécurité des informations que vous nous confiez.
            </p>
          </section>

          <section>
            <h2 className="text-lg font-semibold text-body mb-2">2. Données collectées</h2>
            <p>
              Nous collectons les données nécessaires à l&apos;inscription et au fonctionnement du service : identité (nom, prénom), 
              adresse e-mail, mot de passe (stocké de manière sécurisée), et selon le profil : parcours académique, compétences, 
              projets, photo de profil, coordonnées LinkedIn ou entreprise. Les données sont fournies volontairement lors de l&apos;inscription 
              et de la mise à jour du profil ou du portfolio.
            </p>
          </section>

          <section>
            <h2 className="text-lg font-semibold text-body mb-2">3. Finalités du traitement</h2>
            <p>
              Les données sont utilisées pour : la gestion de votre compte et l&apos;authentification ; l&apos;affichage de votre portfolio 
              et de votre profil aux recruteurs (selon vos paramètres) ; la fourniture des recommandations d&apos;orientation ; 
              la recherche de candidats par les recruteurs ; la messagerie entre étudiants et recruteurs lorsque vous l&apos;utilisez ;
              l&apos;amélioration du service et la communication relative à ProLink, 
              dans le respect de vos choix.
            </p>
          </section>

          <section>
            <h2 className="text-lg font-semibold text-body mb-2">4. Conservation et sécurité</h2>
            <p>
              Les données sont conservées pendant la durée d&apos;utilisation du compte et, le cas échéant, pendant la période légale 
              applicable aux obligations comptables ou juridiques. Nous mettons en œuvre des mesures techniques et organisationnelles 
              appropriées (accès sécurisé, sauvegardes) pour protéger vos données contre l&apos;accès non autorisé, la perte ou l&apos;altération.
            </p>
          </section>

          <section>
            <h2 className="text-lg font-semibold text-body mb-2">5. Vos droits</h2>
            <p>
              Vous disposez d&apos;un droit d&apos;accès, de rectification, de suppression et, le cas échéant, de limitation ou d&apos;opposition 
              au traitement de vos données. Vous pouvez exercer ces droits en nous contactant à l&apos;adresse indiquée sur la page Support. 
              Vous avez également le droit d&apos;introduire une réclamation auprès de l&apos;autorité de contrôle compétente.
            </p>
          </section>

          <section>
            <h2 className="text-lg font-semibold text-body mb-2">6. Cookies et tiers</h2>
            <p>
              Le site peut utiliser des cookies ou technologies similaires pour le bon fonctionnement de la session et de l&apos;authentification. 
              Les données ne sont pas vendues à des tiers. Elles peuvent être partagées avec des prestataires techniques dans le cadre strict 
              de l&apos;exploitation du service, sous contrat de confidentialité.
            </p>
          </section>
        </div>
      </motion.div>
    </div>
  );
}


