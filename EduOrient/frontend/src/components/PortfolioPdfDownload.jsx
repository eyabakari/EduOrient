import { useState } from 'react';
import api from '../api/axios';

/**
 * Bouton « Télécharger le PDF » : utilise la nouvelle route backend de génération PDF.
 * Entrées : studentId, pdfFileName.
 * Sortie : JSX (bouton de téléchargement natif via blob).
 */
export default function PortfolioPdfDownload({ studentId, pdfFileName }) {
  const [loading, setLoading] = useState(false);

  const apiBase = String(api.defaults.baseURL || '').replace(/\/$/, '');
  const downloadUrl = `${apiBase}/portfolio/${studentId}/download-pdf`;

  const handleDownload = async () => {
    if (!studentId) return;
    setLoading(true);

    try {
      const response = await api.get(downloadUrl, {
        responseType: 'blob',
        headers: {
          Accept: 'application/pdf',
        },
      });

      const blob = new Blob([response.data], { type: response.headers['content-type'] || 'application/pdf' });
      const url = window.URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', pdfFileName || `Portfolio_${studentId}.pdf`);
      document.body.appendChild(link);
      link.click();
      link.remove();
      window.URL.revokeObjectURL(url);
    } catch (error) {
      console.error('Erreur lors du téléchargement du PDF :', error);
      // Laisser l'erreur se propager ou afficher un message ici si nécessaire.
    } finally {
      setLoading(false);
    }
  };

  return (
    <button
      type="button"
      onClick={handleDownload}
      disabled={loading}
      className="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-5 py-3 text-sm font-semibold text-white shadow-theme transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[var(--primary)]/50 focus:ring-offset-2 mb-6 disabled:cursor-not-allowed disabled:opacity-60"
    >
      {loading ? (
        <>
          <svg className="h-4 w-4 shrink-0 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden>
            <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
            <path
              className="opacity-75"
              fill="currentColor"
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
            />
          </svg>
          Téléchargement en cours…
        </>
      ) : (
        <>
          <svg className="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path
              strokeLinecap="round"
              strokeLinejoin="round"
              strokeWidth={2}
              d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0118 19H7z"
            />
          </svg>
          Télécharger le portfolio (PDF)
        </>
      )}
    </button>
  );
}


