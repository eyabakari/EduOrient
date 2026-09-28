import { Component } from 'react';

export class ErrorBoundary extends Component {
  state = { hasError: false, error: null };

  static getDerivedStateFromError(error) {
    return { hasError: true, error };
  }

  componentDidCatch(error, errorInfo) {
    if (typeof this.props.onError === 'function') {
      this.props.onError(error, errorInfo);
    }
  }

  render() {
    if (this.state.hasError) {
      if (this.props.fallback) return this.props.fallback;
      return (
        <div className="flex min-h-screen flex-col items-center justify-center bg-page px-4">
          <div className="max-w-md rounded-2xl border border-theme bg-card p-8 shadow-theme text-center">
            <h1 className="text-xl font-bold text-body">Une erreur est survenue</h1>
            <p className="mt-2 text-sm text-muted">
              L&apos;application a rencontré un problème. Rechargez la page ou revenez à l&apos;accueil.
            </p>
            <div className="mt-6 flex flex-col gap-2 sm:flex-row sm:justify-center">
              <button
                type="button"
                onClick={() => window.location.reload()}
                className="rounded-xl bg-primary px-4 py-2.5 text-sm font-medium text-white"
              >
                Recharger
              </button>
              <a
                href="/"
                className="rounded-xl border border-theme bg-block px-4 py-2.5 text-sm font-medium text-body"
              >
                Accueil
              </a>
            </div>
          </div>
        </div>
      );
    }
    return this.props.children;
  }
}

export default ErrorBoundary;


