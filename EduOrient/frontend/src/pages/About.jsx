import { motion } from 'framer-motion';
import { Link } from 'react-router-dom';

export default function About() {
  return (
    <div className="mx-auto max-w-3xl px-4 py-12 sm:px-6">
      <motion.article
        initial={{ opacity: 0, y: 12 }}
        animate={{ opacity: 1, y: 0 }}
        transition={{ duration: 0.35 }}
        className="rounded-2xl bg-card border border-theme p-8 shadow-theme"
      >
        <header className="mb-8">
          <div className="flex items-center gap-3 mb-2">
            <span className="h-1 w-12 rounded-full bg-gradient-to-r from-[var(--primary)] to-[var(--primary)]/60" />
            <h1 className="text-2xl md:text-3xl font-bold text-body tracking-tight">À propos de ProLink</h1>
          </div>
          <p className="text-muted text-base ml-14">
            La plateforme qui relie les talents académiques aux opportunités professionnelles.
          </p>
        </header>

        <div className="space-y-6 text-muted leading-relaxed">
          <section>
            <h2 className="text-lg font-semibold text-body flex items-center gap-2 mb-3">
              <span className="text-[var(--primary)]">◆</span> Notre mission
            </h2>
            <p>
              ProLink accompagne les étudiants dans la construction de leur portfolio professionnel et leur orientation
              vers les métiers de demain. Nous mettons en relation les talents avec les recruteurs et proposons des
              recommandations personnalisées basées sur les compétences et le marché tunisien.
            </p>
          </section>

          <section>
            <h2 className="text-lg font-semibold text-body flex items-center gap-2 mb-3">
              <span className="text-cyan-500">◆</span> Pour les étudiants
            </h2>
            <p>
              Créez et gérez votre portfolio en ligne (projets, compétences, spécialité), recevez des recommandations
              d&apos;orientation adaptées à votre profil et rendez-vous visible auprès des recruteurs pour des stages
              et opportunités d&apos;emploi.
            </p>
          </section>

          <section>
            <h2 className="text-lg font-semibold text-body flex items-center gap-2 mb-3">
              <span className="text-violet-500">◆</span> Pour les recruteurs
            </h2>
            <p>
              Recherchez des candidats par compétences et spécialité, consultez les portfolios et contactez directement
              les profils qui correspondent à vos besoins.
            </p>
          </section>

          <section>
            <h2 className="text-lg font-semibold text-body flex items-center gap-2 mb-3">
              <span className="text-emerald-500">◆</span> Contact
            </h2>
            <p>
              Pour toute question ou suggestion, vous pouvez nous contacter via la page{' '}
              <Link to="/support" className="text-[#9D7BFF] font-medium hover:text-[#7C5FD9] transition-colors">
                Support
              </Link>
              {' '}ou consulter la{' '}
              <Link to="/faq" className="text-[#9D7BFF] font-medium hover:text-[#7C5FD9] transition-colors">
                FAQ
              </Link>.
            </p>
          </section>
        </div>

        <div className="mt-8 pt-6 border-t border-[#E9EDF7]">
          <Link
            to="/"
            className="inline-flex items-center gap-2 text-sm font-medium text-[#9D7BFF] hover:text-[#7C5FD9] transition-colors"
          >
            ← Retour à l&apos;accueil
          </Link>
        </div>
      </motion.article>
    </div>
  );
}


