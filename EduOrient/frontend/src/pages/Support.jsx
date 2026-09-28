import { useState } from 'react';
import { motion } from 'framer-motion';

const CREATOR_EMAIL = 'mailto:elbaccarieya@gmail.com';
const ADDRESS = 'Sidi Bouzid, Tunisie';

export default function Support() {
  const [submitted, setSubmitted] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();
    setSubmitted(true);
  };

  return (
    <div className="mx-auto max-w-3xl px-4 py-12 sm:px-6">
      <motion.div
        initial={{ opacity: 0, y: 12 }}
        animate={{ opacity: 1, y: 0 }}
        className="rounded-2xl bg-card border border-theme p-8 shadow-theme"
      >
        <h1 className="text-2xl font-bold text-body">Support</h1>
        <p className="mt-2 text-muted">
          Une question ou un problème ? Utilisez le formulaire ci-dessous ou contactez-nous directement.
        </p>

        <div className="mt-8 rounded-xl border border-theme bg-block p-6">
          <h2 className="text-lg font-semibold text-body">Coordonnées officielles</h2>
          <p className="mt-2 text-sm text-muted">
            <strong>Email :</strong>{' '}
            <a href={CREATOR_EMAIL} className="text-[var(--primary)] hover:opacity-90 underline">
              elbaccarieya@gmail.com
            </a>
          </p>
          <p className="mt-1 text-sm text-muted">
            <strong>Adresse :</strong> {ADDRESS}
          </p>
        </div>

        <form onSubmit={handleSubmit} className="mt-8 space-y-4">
          <div>
            <label htmlFor="support-name" className="block text-sm font-medium text-body mb-1">
              Votre nom
            </label>
            <input
              id="support-name"
              type="text"
              required
              placeholder="Votre nom"
              className="w-full rounded-xl border border-theme bg-block px-4 py-3 text-body placeholder-[var(--muted)] focus:border-[var(--primary)]/50 focus:outline-none focus:ring-1 focus:ring-[var(--primary)]/30"
            />
          </div>
          <div>
            <label htmlFor="support-email" className="block text-sm font-medium text-body mb-1">
              Email
            </label>
            <input
              id="support-email"
              type="email"
              required
              placeholder="votre@email.com"
              className="w-full rounded-xl border border-theme bg-block px-4 py-3 text-body placeholder-[var(--muted)] focus:border-[var(--primary)]/50 focus:outline-none focus:ring-1 focus:ring-[var(--primary)]/30"
            />
          </div>
          <div>
            <label htmlFor="support-subject" className="block text-sm font-medium text-body mb-1">
              Sujet
            </label>
            <input
              id="support-subject"
              type="text"
              required
              placeholder="Objet de votre message"
              className="w-full rounded-xl border border-theme bg-block px-4 py-3 text-body placeholder-[var(--muted)] focus:border-[var(--primary)]/50 focus:outline-none focus:ring-1 focus:ring-[var(--primary)]/30"
            />
          </div>
          <div>
            <label htmlFor="support-message" className="block text-sm font-medium text-body mb-1">
              Message
            </label>
            <textarea
              id="support-message"
              required
              rows={5}
              placeholder="Décrivez votre demande..."
              className="w-full rounded-xl border border-theme bg-block px-4 py-3 text-body placeholder-[var(--muted)] focus:border-[var(--primary)]/50 focus:outline-none focus:ring-1 focus:ring-[var(--primary)]/30 resize-none"
            />
          </div>
          <button
            type="submit"
            className="rounded-xl bg-primary px-5 py-2.5 text-sm font-medium text-white transition-colors"
          >
            Envoyer
          </button>
        </form>

        {submitted && (
          <p className="mt-4 text-sm text-emerald-300">
            Message envoyé. Nous vous répondrons dans les plus brefs délais.
          </p>
        )}
      </motion.div>
    </div>
  );
}


