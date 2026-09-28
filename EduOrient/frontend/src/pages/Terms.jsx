import { motion } from 'framer-motion';

export default function Terms() {
  return (
    <div className="mx-auto max-w-3xl px-4 py-12 sm:px-6">
      <motion.div
        initial={{ opacity: 0, y: 12 }}
        animate={{ opacity: 1, y: 0 }}
        className="rounded-2xl bg-card border border-theme p-8 shadow-theme"
      >
        <h1 className="text-2xl font-bold text-body">Conditions d&apos;utilisation</h1>
        <p className="mt-2 text-sm text-muted">Dernière mise à jour : 2026</p>

        <div className="mt-8 space-y-6 text-sm text-body leading-relaxed">
          <section>
            <h2 className="text-lg font-semibold text-body mb-2">1. Objet</h2>
            <p>
              L&apos;utilisation du site ProLink est régie par les présentes conditions générales d&apos;utilisation (CGU). 
              En accédant à la plateforme, vous acceptez ces dispositions. ProLink est une plateforme d&apos;orientation et de recrutement 
              destinée à mettre en relation les talents académiques et les recruteurs.
            </p>
          </section>

          <section>
            <h2 className="text-lg font-semibold text-body mb-2">2. Accès et inscription</h2>
            <p>
              L&apos;accès à certaines fonctionnalités est conditionné par une inscription. Vous vous engagez à fournir des informations exactes 
              et à maintenir la confidentialité de votre compte. ProLink se réserve le droit de suspendre ou supprimer tout compte en cas de manquement.
            </p>
          </section>

          <section>
            <h2 className="text-lg font-semibold text-body mb-2">3. Usage acceptable</h2>
            <p>
              Vous vous engagez à utiliser le site de manière licite. Sont interdits : contenus illicites ou diffamatoires ; usurpation d&apos;identité ; 
              extraction automatisée de données sans autorisation ; toute utilisation nuisible au service.
            </p>
          </section>

          <section>
            <h2 className="text-lg font-semibold text-body mb-2">4. Propriété intellectuelle</h2>
            <p>
              Les éléments du site sont protégés par le droit de la propriété intellectuelle. Les contenus que vous publiez restent votre propriété ; 
              vous accordez à ProLink une licence d&apos;utilisation nécessaire à l&apos;affichage et au fonctionnement de la plateforme.
            </p>
          </section>

          <section>
            <h2 className="text-lg font-semibold text-body mb-2">5. Limitation de responsabilité</h2>
            <p>
              ProLink est fourni « en l&apos;état ». ProLink ne peut être tenu responsable des dommages indirects ou des décisions prises 
              sur la base des contenus affichés. La mise en relation avec des recruteurs ou candidats relève de la responsabilité des utilisateurs.
            </p>
          </section>

          <section>
            <h2 className="text-lg font-semibold text-body mb-2">6. Modifications et droit applicable</h2>
            <p>
              Les présentes conditions peuvent être modifiées à tout moment. En cas de litige, le droit tunisien est applicable.
            </p>
          </section>
        </div>
      </motion.div>
    </div>
  );
}


