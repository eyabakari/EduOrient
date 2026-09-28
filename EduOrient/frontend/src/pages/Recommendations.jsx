import { useState, useEffect, memo } from 'react';
import { useNavigate } from 'react-router-dom';
import { motion } from 'framer-motion';
import DashboardLayout from '../components/DashboardLayout';
import api from '../api/axios';

const MotionArticle = motion.article;
const MotionDiv = motion.div;

function SkeletonCard() {
  return (
    <div className="rounded-2xl border border-theme bg-card p-6 shadow-theme">
      <div className="animate-pulse space-y-4">
        <div className="h-6 w-2/3 rounded bg-[var(--muted)]/20" />
        <div className="h-4 w-full rounded bg-[var(--muted)]/20" />
        <div className="h-3 w-1/2 rounded bg-[var(--muted)]/20" />
        <div className="h-20 rounded bg-[var(--muted)]/20" />
      </div>
    </div>
  );
}

function ProgressBar({ value, label, className = '' }) {
  const pct = Math.min(100, Math.max(0, Number(value)));
  return (
    <div className={className}>
      <div className="flex justify-between text-sm">
        <span className="text-muted">{label}</span>
        <span className="font-medium text-body">{pct} %</span>
      </div>
      <div className="mt-1.5 h-2.5 w-full overflow-hidden rounded-full bg-[var(--border)]">
        <MotionDiv
          className="h-full rounded-full bg-indigo-400"
          initial={{ width: 0 }}
          animate={{ width: `${pct}%` }}
          transition={{ duration: 0.6, ease: 'easeOut' }}
        />
      </div>
    </div>
  );
}

function AiJustification({ text }) {
  if (!text) return null;
  return (
    <div className="mt-4 rounded-2xl border border-violet-200 bg-violet-50 p-4 text-sm text-body">
      <div className="mb-2 flex items-center gap-2 text-xs uppercase tracking-[0.18em] text-violet-700">
        <span>✨</span>
        Justification AI
      </div>
      <p className="whitespace-pre-line leading-relaxed text-sm text-muted">{text}</p>
    </div>
  )
}

const CompanyMatchCard = memo(function CompanyMatchCard({ data, index }) {
  const navigate = useNavigate();
  const {
    entreprise,
    ville,
    gouvernorat,
    description,
    score,
    match_count: matchCount,
    matching_skills: matchingSkills = [],
    stack_tags: stackTags = [],
    justification,
    recruteur,
    recruteur_id: recruteurId,
  } = data;

  const stackCount = Array.isArray(stackTags) ? stackTags.length : 0;
  const [showContactOptions, setShowContactOptions] = useState(false);
  const handleContact = () => {
    if (!recruteurId) return;
    navigate(`/dashboard/messagerie?recruteur=${recruteurId}`);
  };

  return (
    <MotionArticle
      className="rounded-2xl border border-theme bg-card p-6 shadow-theme"
      initial={{ opacity: 0, y: 16 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ delay: index * 0.08 }}
    >
      <div>
        <h3 className="text-lg font-semibold text-body">{entreprise || 'Entreprise'}</h3>
        {(ville || gouvernorat) && (
          <p className="mt-1 text-sm text-muted">
            {[ville, gouvernorat].filter(Boolean).join(' · ')}
          </p>
        )}
        {(recruteur?.nom || recruteur?.poste) && (
          <p className="mt-1 text-xs text-muted">
            {[recruteur?.nom, recruteur?.poste].filter(Boolean).join(' · ')}
          </p>
        )}
      </div>
      {description && (
        <p className="mt-3 line-clamp-4 whitespace-pre-line text-sm leading-relaxed text-muted">{description}</p>
      )}
      <div className="mt-4">
        <ProgressBar
          value={score}
          label={`Pertinence : ${matchCount} compétence${matchCount > 1 ? 's' : ''} en commun${stackCount ? ` sur ${stackCount} tags entreprise / offres` : ''}`}
        />
      </div>
      {matchingSkills.length > 0 && (
        <div className="mt-4">
          <h4 className="text-sm font-medium text-body">Vos compétences qui matchent</h4>
          <ul className="mt-2 flex flex-wrap gap-2">
            {matchingSkills.map((skill, i) => (
              <li
                key={i}
                className="rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-700"
              >
                {skill}
              </li>
            ))}
          </ul>
        </div>
      )}
      {stackTags.length > 0 && (
        <div className="mt-4">
          <h4 className="text-sm font-medium text-body">Périmètre techno (entreprise & offres)</h4>
          <ul className="mt-2 flex flex-wrap gap-2">
            {stackTags.map((skill, i) => (
              <li
                key={i}
                className="rounded-lg border border-theme bg-block px-3 py-1.5 text-xs text-muted"
              >
                {skill}
              </li>
            ))}
          </ul>
        </div>
      )}
      <AiJustification text={justification} />
      <div className="mt-5">
        {!showContactOptions ? (
          /* 1. El bouton el principal */
          <button
            type="button"
            onClick={() => setShowContactOptions(true)}
            className="w-full rounded-xl bg-primary py-3 text-sm font-semibold text-white shadow-theme transition hover:opacity-95"
          >
            Contacter le recruteur
          </button>
        ) : (
          /* 2. El menu mta3 el choix (ki l-etudiant ycliqui) */
          <MotionDiv 
            initial={{ opacity: 0, scale: 0.95 }} 
            animate={{ opacity: 1, scale: 1 }}
            className="flex flex-col gap-2 p-2 rounded-xl bg-[var(--border)]/10 border border-theme"
          >
            <p className="text-[10px] text-center uppercase font-bold text-muted mb-1">
              Choisissez un moyen de contact
            </p>
            
            <div className="flex gap-2">
              {/* Option Messagerie */}
              <button
                onClick={handleContact}
                className="flex-1 flex flex-col items-center gap-1 rounded-lg bg-white p-3 text-xs font-bold text-primary shadow-sm hover:bg-blue-50 transition"
              >
                <span className="text-xl">💬</span>
                Messagerie
              </button>

              {/* Option Email */}
              <a
                href={`mailto:${recruteur?.email || 'contact@entreprise.tn'}?subject=Candidature ProLink : ${entreprise}`}
                className="flex-1 flex flex-col items-center gap-1 rounded-lg bg-white p-3 text-xs font-bold text-body shadow-sm hover:bg-gray-50 transition"
              >
                <span className="text-xl">📧</span>
                E-mail
              </a>
            </div>

            {/* Bouton bech yarja3 (Annuler) */}
            <button 
              onClick={() => setShowContactOptions(false)}
              className="text-[10px] text-muted hover:underline mt-1"
            >
              Retour
            </button>
          </MotionDiv>
        )}
      </div>
    </MotionArticle>
  );
});

const OfferMatchCard = memo(function OfferMatchCard({ data, index }) {
  const navigate = useNavigate();
  const {
    id,
    titre,
    type,
    lieu,
    entreprise,
    description,
    score,
    match_count: matchCount,
    matching_skills: matchingSkills = [],
    required_skills: requiredSkills = [],
    justification,
    recruteur,
    recruteur_id: recruteurId,
  } = data;

  const requiredCount = Array.isArray(requiredSkills) ? requiredSkills.length : 0;
  const [showContactOptions, setShowContactOptions] = useState(false);
  const handleContact = () => {
    if (!recruteurId) return;
    navigate(`/dashboard/messagerie?recruteur=${recruteurId}`);
  };

  return (
    <MotionArticle
      className="rounded-2xl border border-theme bg-card p-6 shadow-theme"
      initial={{ opacity: 0, y: 16 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ delay: index * 0.06 }}
    >
      <div className="flex flex-wrap items-start justify-between gap-2">
        <h3 className="text-lg font-semibold text-body">{titre || 'Offre'}</h3>
        <span className="shrink-0 rounded-full bg-[var(--primary)]/10 px-2.5 py-0.5 text-xs font-medium capitalize text-[var(--primary)]">
          {type === 'emploi' ? 'Emploi' : 'Stage'}
        </span>
      </div>
      {entreprise && <p className="mt-1 text-sm font-medium text-muted">{entreprise}</p>}
      {(recruteur?.nom || recruteur?.poste) && (
        <p className="mt-0.5 text-xs text-muted">
          {[recruteur?.nom, recruteur?.poste].filter(Boolean).join(' · ')}
        </p>
      )}
      {lieu && <p className="mt-1 text-xs text-muted">{lieu}</p>}
      {description && (
        <p className="mt-3 line-clamp-3 text-sm leading-relaxed text-muted">{description}</p>
      )}
      <div className="mt-4">
        <ProgressBar
          value={score}
          label={`Adéquation annonce : ${matchCount} / ${requiredCount} compétence${requiredCount > 1 ? 's' : ''} requise${requiredCount > 1 ? 's' : ''}`}
        />
      </div>
      {matchingSkills.length > 0 && (
        <div className="mt-4">
          <h4 className="text-sm font-medium text-body">Compétences de l&apos;offre que vous couvrez</h4>
          <ul className="mt-2 flex flex-wrap gap-2">
            {matchingSkills.map((skill, i) => (
              <li
                key={`${id}-m-${i}`}
                className="rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-700"
              >
                {skill}
              </li>
            ))}
          </ul>
        </div>
      )}
      <AiJustification text={justification} />
      <div className="mt-5">
        {!showContactOptions ? (
          /* 1. El bouton el principal */
          <button
            type="button"
            onClick={() => setShowContactOptions(true)}
            className="w-full rounded-xl bg-primary py-3 text-sm font-semibold text-white shadow-theme transition hover:opacity-95"
          >
            Contacter le recruteur
          </button>
        ) : (
          /* 2. El menu mta3 el choix (ki l-etudiant ycliqui) */
          <MotionDiv 
            initial={{ opacity: 0, scale: 0.95 }} 
            animate={{ opacity: 1, scale: 1 }}
            className="flex flex-col gap-2 p-2 rounded-xl bg-[var(--border)]/10 border border-theme"
          >
            <p className="text-[10px] text-center uppercase font-bold text-muted mb-1">
              Choisissez un moyen de contact
            </p>
            
            <div className="flex gap-2">
              {/* Option Messagerie */}
              <button
                onClick={handleContact}
                className="flex-1 flex flex-col items-center gap-1 rounded-lg bg-white p-3 text-xs font-bold text-primary shadow-sm hover:bg-blue-50 transition"
              >
                <span className="text-xl">💬</span>
                Messagerie
              </button>

              {/* Option Email */}
              <a
                href={`mailto:${recruteur?.email || 'contact@entreprise.tn'}?subject=Candidature ProLink : ${entreprise}`}
                className="flex-1 flex flex-col items-center gap-1 rounded-lg bg-white p-3 text-xs font-bold text-body shadow-sm hover:bg-gray-50 transition"
              >
                <span className="text-xl">📧</span>
                E-mail
              </a>
            </div>

            {/* Bouton bech yarja3 (Annuler) */}
            <button 
              onClick={() => setShowContactOptions(false)}
              className="text-[10px] text-muted hover:underline mt-1"
            >
              Retour
            </button>
          </MotionDiv>
        )}
      </div>
    </MotionArticle>
  );
});

function SectionTitle({ id, title, subtitle }) {
  return (
    <div className="mb-6">
      <h2 id={id} className="text-xl font-bold text-body">
        {title}
      </h2>
      {subtitle ? <p className="mt-1 max-w-3xl text-sm text-muted">{subtitle}</p> : null}
    </div>
  );
}

let recommendationsInitialLoadPromise = null;

function loadRecommendationsOnce() {
  if (!recommendationsInitialLoadPromise) {
    recommendationsInitialLoadPromise = Promise.allSettled([
      api.get('/recommendations'),
      api.get('/recommendations/offres'),
    ]);
  }

  return recommendationsInitialLoadPromise;
}

export default function Recommendations() {
  const [companies, setCompanies] = useState([]);
  const [offers, setOffers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [errorCompanies, setErrorCompanies] = useState(null);
  const [errorOffers, setErrorOffers] = useState(null);
// --- EL STATES JDOD ---
  const [searchQuery, setSearchQuery] = useState('');
  const [filterType, setFilterType] = useState('all'); // 'all', 'entreprise', 'offre'

  useEffect(() => {
    let cancelled = false;

    (async () => {
      const results = await loadRecommendationsOnce();

      if (cancelled) return;

      const [recRes, offRes] = results;

      if (recRes.status === 'fulfilled') {
        setCompanies(recRes.value.data?.data ?? []);
      } else {
        const err = recRes.reason;
        const status = err.response?.status;
        const msg = err.response?.data?.message || err.message;
        setCompanies([]);
        setErrorCompanies(
          status === 403
            ? 'Sociétés : accès réservé aux étudiants.'
            : status === 401
              ? 'Session expirée. Veuillez vous reconnecter.'
              : msg || 'Impossible de charger les sociétés recommandées.'
        );
      }

      if (offRes.status === 'fulfilled') {
        setOffers(offRes.value.data?.data ?? []);
      } else {
        const err = offRes.reason;
        const status = err.response?.status;
        const msg = err.response?.data?.message || err.message;
        setOffers([]);
        setErrorOffers(
          status === 403
            ? 'Offres : accès réservé aux étudiants.'
            : status === 401
              ? 'Session expirée. Veuillez vous reconnecter.'
              : msg || 'Impossible de charger les offres disponibles.'
        );
      }

      setLoading(false);
    })();

    return () => {
      cancelled = true;
    };
  }, []);
  // Filtrage mta3 el Entreprises
  const filteredCompanies = companies.filter(c => {
    const matchesSearch = c.entreprise?.toLowerCase().includes(searchQuery.toLowerCase());
    return filterType === 'all' || filterType === 'entreprise' ? matchesSearch : false;
  });

  // Filtrage mta3 el Offres
  const filteredOffers = offers.filter(o => {
    const matchesSearch = o.titre?.toLowerCase().includes(searchQuery.toLowerCase()) || 
                          o.entreprise?.toLowerCase().includes(searchQuery.toLowerCase());
    return filterType === 'all' || filterType === 'offre' ? matchesSearch : false;
  });
  return (
    <DashboardLayout>
      <MotionDiv initial={{ opacity: 0 }} animate={{ opacity: 1 }} className="mb-8 max-w-6xl mx-auto">
        <h1 className="text-2xl font-bold text-body">Matching & opportunités</h1>
        {/* --- BARRE DE RECHERCHE --- */}
        <div className="mt-6 flex flex-col md:flex-row gap-4">
          <div className="relative flex-1">
            <input
              type="text"
              placeholder="Rechercher par entreprise ou titre d'offre..."
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              className="w-full rounded-2xl border border-theme bg-card px-10 py-3 text-sm focus:ring-2 focus:ring-primary outline-none transition"
            />
            <span className="absolute left-4 top-3.5 text-muted">🔍</span>
          </div>

          <select
            value={filterType}
            onChange={(e) => setFilterType(e.target.value)}
            className="rounded-2xl border border-theme bg-card px-4 py-3 text-sm outline-none cursor-pointer"
          >
            <option value="all">Tout voir</option>
            <option value="entreprise">Entreprises uniquement</option>
            <option value="offre">Offres uniquement</option>
          </select>
        </div>

      </MotionDiv>

      {loading ? (
        <div className="max-w-6xl mx-auto">
          <p className="mb-4 text-sm text-muted">Chargement de vos recommandations…</p>
          <div className="grid gap-6 sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
            <SkeletonCard />
            <SkeletonCard />
            <SkeletonCard />
          </div>
        </div>
      ) : (
        <>
          {/* 1. Sociétés recommandées (matching par profil / périmètre techno recruteur) */}
          <section className="mb-14 max-w-6xl mx-auto" aria-labelledby="section-societes">
            <SectionTitle
              id="section-societes"
              title="Sociétés recommandées"
              subtitle="Entreprises classées selon l’adéquation entre vos compétences (profil et projets) et les technologies déclarées par les recruteurs ainsi que leurs offres actives."
            />
            {errorCompanies && (
              <div className="mb-4 rounded-xl border border-amber-400/50 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                {errorCompanies}
              </div>
            )}
            {filteredCompanies.length === 0 && !errorCompanies ? (
              <div className="rounded-2xl border border-theme bg-card p-8 text-center shadow-theme">
                <p className="text-muted">
                  Aucune entreprise ne correspond encore à vos compétences. Enrichissez votre profil et vos projets pour
                  voir des suggestions ciblées.
                </p>
              </div>
            ) : (
              <div className="grid gap-6 sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                {filteredCompanies.map((item, index) => (
                  <CompanyMatchCard key={item.recruteur_id ?? `c-${index}`} data={item} index={index} />
                ))}
              </div>
            )}
          </section>

          {/* 2. Offres disponibles (matching par annonce / offre_skill) */}
          <section className="max-w-6xl mx-auto border-t border-theme pt-12" aria-labelledby="section-offres">
            <SectionTitle
              id="section-offres"
              title="Offres disponibles"
              subtitle="Annonces actives dont au moins une compétence requise (offre) est présente dans votre profil ou vos projets. Le score reflète la part des compétences de l’offre que vous couvrez."
            />
            {errorOffers && (
              <div className="mb-4 rounded-xl border border-amber-400/50 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                {errorOffers}
              </div>
            )}
            {filteredOffers.length === 0 && !errorOffers ? (
              <div className="rounded-2xl border border-theme bg-card p-8 text-center shadow-theme">
                <p className="text-muted">
                  Aucune offre ne correspond pour l’instant aux compétences de votre portfolio. Ajoutez des technologies
                  sur vos projets ou dans votre profil pour débloquer des annonces pertinentes.
                </p>
              </div>
            ) : (
              <div className="grid gap-6 sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
                {filteredOffers.map((item, index) => (
                  <OfferMatchCard key={item.id ?? `o-${index}`} data={item} index={index} />
                ))}
              </div>
            )}
          </section>
        </>
      )}
    </DashboardLayout>
  );
}


