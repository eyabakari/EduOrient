import { useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';

const FAQ_ITEMS = [
  { id: 1, q: "Comment créer et gérer mon portfolio ?", a: "Une fois inscrit en tant qu'étudiant, accédez à « Créer Portfolio » ou « Projets » depuis votre tableau de bord. Vous pouvez ajouter des projets, gérer vos compétences et personnaliser votre profil. Votre portfolio public est accessible via « Mon Portfolio »." },
  { id: 2, q: "Comment fonctionne le matching avec les recruteurs ?", a: "Les recruteurs utilisent la recherche par compétences et spécialité. Le système calcule un score de correspondance (Match %). Plus votre profil correspond à la recherche, plus vous apparaissez en tête des résultats." },
  { id: 3, q: "À quoi servent les recommandations d'orientation ?", a: "La section « Orientation Pro » analyse votre profil et le compare à des parcours métiers du marché tunisien. Vous obtenez des recommandations avec un score, des compétences à acquérir et des conseils carrière." },
  { id: 4, q: "Comment un recruteur peut-il me contacter ?", a: "Les recruteurs peuvent vous écrire via la messagerie intégrée (matching ou recherche), ou utiliser les liens e-mail et LinkedIn renseignés sur votre profil ou votre portfolio public. Pensez à tenir ces informations à jour dans vos paramètres." },
  { id: 5, q: "Puis-je modifier ou supprimer un projet après publication ?", a: "Oui. Depuis la page « Projets » de votre tableau de bord, vous pouvez modifier ou supprimer chaque projet. Seul le propriétaire du projet peut effectuer ces actions." },
  { id: 6, q: "Comment sont calculées les compétences « à acquérir » ?", a: "Le moteur compare vos compétences déclarées et celles de vos projets aux compétences requises pour chaque parcours. Les compétences manquantes sont listées comme « à acquérir »." },
];

export default function FAQ() {
  const [openId, setOpenId] = useState(null);

  return (
    <div className="mx-auto max-w-3xl px-4 py-12 sm:px-6">
      <motion.div
        initial={{ opacity: 0, y: 12 }}
        animate={{ opacity: 1, y: 0 }}
        className="rounded-2xl bg-card border border-theme p-8 shadow-theme"
      >
        <h1 className="text-2xl font-bold text-body">Foire aux questions</h1>
        <p className="mt-2 text-muted">
          Réponses aux questions fréquentes sur le portfolio et le matching.
        </p>
        <div className="mt-8 space-y-3">
          {FAQ_ITEMS.map((item) => (
            <div key={item.id} className="rounded-xl border border-theme bg-block overflow-hidden">
              <button
                type="button"
                onClick={() => setOpenId(openId === item.id ? null : item.id)}
                className="w-full flex items-center justify-between px-4 py-4 text-left text-sm font-medium text-body transition-colors"
              >
                <span>{item.q}</span>
                <span className="shrink-0 ml-2 text-muted">{openId === item.id ? '−' : '+'}</span>
              </button>
              <AnimatePresence>
                {openId === item.id && (
                  <motion.div
                    initial={{ height: 0, opacity: 0 }}
                    animate={{ height: 'auto', opacity: 1 }}
                    exit={{ height: 0, opacity: 0 }}
                    transition={{ duration: 0.2 }}
                    className="overflow-hidden"
                  >
                    <p className="px-4 pb-4 text-sm text-muted leading-relaxed">{item.a}</p>
                  </motion.div>
                )}
              </AnimatePresence>
            </div>
          ))}
        </div>
      </motion.div>
    </div>
  );
}


