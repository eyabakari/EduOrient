import { useEffect } from 'react';
import { useLocation } from 'react-router-dom';

/**
 * Scroll en haut de la page à chaque changement de route.
 * À placer à l'intérieur de <BrowserRouter>.
 */
export default function ScrollToTop() {
  const { pathname } = useLocation();

  useEffect(() => {
    window.scrollTo(0, 0);
  }, [pathname]);

  return null;
}


