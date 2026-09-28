import { Outlet } from 'react-router-dom';
import PublicNavbar from './PublicNavbar';
import Footer from './Footer';

/** Pages publiques : en-tête, contenu, pied de page. */
export default function PublicLayout() {
  return (
    <div className="flex min-h-screen flex-col bg-page">
      <PublicNavbar />
      <main className="flex-1">
        <Outlet />
      </main>
      <Footer />
    </div>
  );
}


