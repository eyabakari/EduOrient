import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import { useAuth } from '../context/AuthContext';
import heroPc from '../assets/hero-pc.png';

/**
 * Page d’accueil publique (marketing) : héros, catégories fictives, grille « services ».
 * Données : aucune API ; lecture du contexte Auth (utilisateur connecté ou non) pour adapter les liens.
 */

/**
 * Fabrique la configuration d’animation Framer Motion (mouvement vertical en boucle).
 * Entrées : duration (secondes pour un cycle haut/bas).
 * Sortie : objet { y, transition } consommé par <motion.div animate={...}>.
 */
const floatAnim = (duration) => ({
  y: [0, -20, 0],
  transition: { duration, repeat: Infinity, ease: 'easeInOut' },
});

/**
 * Bloc héros : titre, texte, bouton (inscription ou dashboard) et visuel animé.
 * Entrées : aucune prop ; lit useAuth() (user, loading).
 * Sortie : JSX (section plein écran).
 */
function Hero() {
  const { user, loading } = useAuth();
  const isLoggedIn = !!user;

  return (
    <section className="relative z-0 w-full min-h-screen flex items-center overflow-hidden bg-page pt-6 sm:pt-10 pb-8">
      <div className="absolute top-[-10%] left-[-10%] z-0 w-[600px] h-[600px] bg-purple-400/10 blur-[100px] rounded-full" />
      <div className="absolute bottom-[-20%] right-[-10%] z-0 w-[400px] h-[400px] bg-indigo-400/10 blur-[80px] rounded-full" />

      {/* Floating emojis: z-[1] so they never appear above dashboard (z-20) when navigating */}
      <motion.div animate={floatAnim(4)} className="absolute top-[15%] right-[35%] z-[1] text-3xl sm:text-5xl opacity-60 hidden sm:block" aria-hidden>🎓</motion.div>
      <motion.div animate={floatAnim(6)} className="absolute bottom-[20%] right-[40%] z-[1] text-2xl sm:text-4xl opacity-50 hidden sm:block" aria-hidden>🌍</motion.div>
      <motion.div animate={floatAnim(5)} className="absolute top-[40%] right-[10%] z-[1] text-2xl sm:text-4xl opacity-50 hidden sm:block" aria-hidden>📖</motion.div>
      <motion.div animate={floatAnim(3.5)} className="absolute bottom-[15%] right-[15%] z-[1] text-2xl sm:text-4xl opacity-60 hidden sm:block" aria-hidden>🚀</motion.div>

      <div className="relative z-[1] w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6 md:gap-10 lg:gap-12 items-center min-w-0">
        <motion.div
          initial={{ opacity: 0, x: -50 }}
          animate={{ opacity: 1, x: 0 }}
          transition={{ duration: 0.8 }}
          className="flex flex-col space-y-4 sm:space-y-6 md:space-y-8 flex-1 min-w-0 w-full md:max-w-xl lg:max-w-2xl"
        >
          <h1 className="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl 2xl:text-7xl font-black text-body leading-tight break-words">
            ProLink : <br />
            <span className="bg-gradient-to-r from-purple-500 to-indigo-500 bg-clip-text text-transparent">
            L&apos;avenir commence ici.
            </span>
          </h1>

          <p className="text-muted text-sm sm:text-base md:text-lg lg:text-xl max-w-md leading-relaxed border-l-4 border-[var(--primary)] pl-3 sm:pl-4">
            Construisez un portfolio professionnel, mettez en avant vos compétences et accédez à des recommandations adaptées à votre profil et au marché de l&apos;emploi.
          </p>

          <div className="pt-2 sm:pt-4">
            {!loading && (
              <Link
                to={isLoggedIn ? '/dashboard' : '/register'}
                className="inline-block px-8 py-3 sm:px-12 sm:py-4 text-sm sm:text-base lg:text-lg bg-primary text-white font-bold rounded-full transition-all shadow-theme hover:scale-105"
              >
                {isLoggedIn ? 'Tableau de bord' : 'Commencer'}
              </Link>
            )}
          </div>
        </motion.div>

        <div className="relative flex justify-center items-center min-h-[220px] sm:min-h-[280px] md:min-h-[380px] lg:min-h-0 w-full max-w-[240px] sm:max-w-xs md:max-w-[380px] lg:max-w-[420px] xl:max-w-[480px] mx-auto shrink-0 overflow-hidden">
          <motion.div
            animate={{ rotate: 360 }}
            transition={{ duration: 20, repeat: Infinity, ease: 'linear' }}
            className="absolute w-[110%] h-[110%] max-w-[500px] max-h-[500px] lg:max-w-[550px] lg:max-h-[550px] border-2 border-dashed border-[var(--primary)]/30 rounded-full pointer-events-none"
            aria-hidden
          />

          <motion.div
            initial={{ opacity: 0, scale: 0.8 }}
            animate={{ opacity: 1, scale: 1 }}
            transition={{ duration: 1 }}
            className="relative w-full max-w-full aspect-square rounded-full border-[6px] sm:border-[8px] md:border-[10px] lg:border-[12px] border-theme overflow-hidden shadow-theme"
          >
            <img
              src={heroPc}
              alt="L'avenir commence ici."
              className="w-full h-full object-cover scale-110 hover:scale-125 transition-transform duration-1000"
              loading="lazy"
            />
          </motion.div>

        </div>
      </div>
    </section>
  );
}

const CATEGORY_TITLES = ['Design UI/UX', 'Développement Web', 'Data & Analytics', 'Cybersécurité'];
const CATEGORY_STYLE = [
  { icon: '🎨', accent: 'border-l-pink-400 bg-pink-50' },
  { icon: '💻', accent: 'border-l-blue-400 bg-blue-50' },
  { icon: '📊', accent: 'border-l-amber-400 bg-amber-50' },
  { icon: '🔒', accent: 'border-l-violet-400 bg-violet-50' },
];

/**
 * Grille statique de domaines métiers (illustration UI, pas de données serveur).
 * Entrées : aucune.
 * Sortie : JSX (section avec cartes animées au scroll).
 */
function CategoriesSection() {
  return (
    <section className="mx-auto max-w-6xl px-4 py-16 sm:px-6">
      <h2 className="text-2xl font-bold text-body sm:text-3xl mb-8">
        Parcourir les catégories
      </h2>
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {CATEGORY_TITLES.map((title, i) => {
          const cat = { ...CATEGORY_STYLE[i], title };
          return (
          <motion.div
            key={title}
            initial={{ opacity: 0, y: 12 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ delay: i * 0.06 }}
            className={`flex flex-col justify-center items-center gap-3 rounded-xl border border-theme border-l-4 ${cat.accent} p-6 bg-card hover:shadow-theme transition-all`}
          >
            <span className="text-4xl sm:text-5xl" aria-hidden>
              {cat.icon}
            </span>
            <span className="text-sm sm:text-base font-semibold text-body text-center">
              {cat.title}
            </span>
          </motion.div>
          );
        })}
      </div>
    </section>
  );
}

// --- Bento Grid Feature Section ---
const BENTO_CARD = {
  base: 'rounded-3xl border border-theme bg-card p-6 transition-all duration-300 hover:shadow-theme',
};

/**
 * Barre de progression animée (pourcentage fictif dans la démo visuelle).
 * Entrées : label (libellé), value (0–100).
 * Sortie : JSX (libellé + barre).
 */
function SkillBar({ label, value }) {
  return (
    <div className="space-y-1">
      <div className="flex justify-between text-xs text-muted font-medium">
        <span>{label}</span>
        <span>{value}%</span>
      </div>
      <div className="h-2 rounded-full bg-[var(--border)] overflow-hidden">
        <motion.div
          initial={{ width: 0 }}
          whileInView={{ width: `${value}%` }}
          viewport={{ once: true }}
          transition={{ duration: 0.8, delay: 0.2 }}
          className="h-full rounded-full bg-gradient-to-r from-[var(--primary)] to-indigo-500"
        />
      </div>
    </div>
  );
}

/**
 * Section « Nos services » : cartes avec liens vers portfolio, recommandations ou recherche selon le rôle.
 * Entrées : aucune prop ; lit useAuth() (user, role).
 * Sortie : JSX (grille bento).
 */
function BentoFeatureSection() {
  const { user } = useAuth();
  const isLoggedIn = !!user;
  const roleName = user?.role?.name;
  const opportunitesLink =
    !isLoggedIn
      ? '/login'
      : roleName === 'recruteur' || roleName === 'admin'
        ? '/dashboard/search'
        : '/dashboard/recommandations';

  return (
    <section className="mx-auto max-w-6xl px-4 py-16 sm:px-6">
      <motion.h2
        initial={{ opacity: 0, y: 12 }}
        whileInView={{ opacity: 1, y: 0 }}
        viewport={{ once: true }}
        className="text-2xl font-bold text-body sm:text-3xl mb-8"
      >
        Nos services
      </motion.h2>

      <div className="grid grid-cols-1 md:grid-cols-3 gap-4 auto-rows-fr">
        <motion.div
          initial={{ opacity: 0, y: 24 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.5 }}
          className={`md:col-span-2 md:row-span-1 ${BENTO_CARD.base}`}
        >
          <h3 className="text-xl font-bold text-body">Portfolio</h3>
          <p className="mt-2 text-sm text-muted leading-relaxed">
            Un profil professionnel structuré à partir de vos projets et compétences. Mise en avant automatique de vos points forts et recommandations pour un portfolio percutant auprès des recruteurs.
          </p>
          <Link
            to={isLoggedIn ? '/dashboard/portfolio' : '/login'}
            className="mt-4 inline-block text-sm font-semibold text-[var(--primary)] hover:opacity-90"
          >
            Créer mon portfolio →
          </Link>
        </motion.div>

        <motion.div
          initial={{ opacity: 0, y: 24 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.5, delay: 0.1 }}
          className={BENTO_CARD.base}
        >
          <h3 className="text-lg font-bold text-body">Orientation Smart</h3>
          <p className="mt-2 text-sm text-muted">
            Matching carrière piloté par l&apos;IA : parcours et métiers recommandés selon votre profil et le marché tunisien.
          </p>
          <Link
            to={isLoggedIn ? '/dashboard/orientation' : '/login'}
            className="mt-3 inline-block text-sm font-semibold text-[var(--primary)] hover:opacity-90"
          >
            Voir les recommandations →
          </Link>
        </motion.div>

        <motion.div
          initial={{ opacity: 0, y: 24 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.5, delay: 0.3 }}
          className={`md:col-span-2 ${BENTO_CARD.base}`}
        >
          <h3 className="text-lg font-bold text-body">Analyse de Compétences</h3>
          <p className="mt-1 text-sm text-muted mb-4">
            Visualisation de votre niveau par domaine pour identifier les forces et les axes à renforcer.
          </p>
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <SkillBar label="Développement" value={78} />
            <SkillBar label="Design / UX" value={62} />
            <SkillBar label="Data" value={55} />
            <SkillBar label="Soft skills" value={85} />
          </div>
        </motion.div>

        <motion.div
          initial={{ opacity: 0, y: 24 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.5, delay: 0.2 }}
          className={BENTO_CARD.base}
        >
          <h3 className="text-lg font-bold text-body">Entreprises &amp; opportunités</h3>
          <p className="mt-2 text-sm text-muted">
            Mettez en avant vos compétences auprès des recruteurs ou explorez les entreprises dont le périmètre technique correspond à votre profil.
          </p>
          <Link
            to={opportunitesLink}
            className="mt-3 inline-block text-sm font-semibold text-[var(--primary)] hover:opacity-90"
          >
            Découvrir les opportunités →
          </Link>
        </motion.div>
      </div>
    </section>
  );
}

/**
 * Assemble les trois sections de la page d’accueil.
 * Entrées : aucune ; lit useAuth() pour cohérence globale (ici surtout informatif).
 * Sortie : JSX (page complète).
 */
export default function LandingPage() {
  const { user, loading } = useAuth();
  const isLoggedIn = !!user;

  return (
    <div className="min-h-screen">
      <Hero />
      <CategoriesSection />
      <BentoFeatureSection />

    </div>
  );
}


