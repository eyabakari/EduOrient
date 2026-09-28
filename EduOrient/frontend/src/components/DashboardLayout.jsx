import { useState } from 'react';
import Sidebar from './Sidebar';
import Navbar from './Navbar';
import MobileDrawer, { HamburgerButton } from './MobileDrawer';
import BottomNav from './BottomNav';
import { MessagingUnreadProvider } from '../context/MessagingUnreadContext';

/** Mise en page commune du tableau de bord (navigation, contenu). */
export default function DashboardLayout({ children }) {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

  return (
    <MessagingUnreadProvider>
      <div
        className="relative z-20 flex min-h-screen w-full flex-col overflow-x-hidden isolate bg-white"
        style={{
          minHeight: '100vh',
          backgroundColor: 'var(--card-bg)',
        }}
      >
        <Sidebar />
        <MobileDrawer isOpen={mobileMenuOpen} onClose={() => setMobileMenuOpen(false)} />
        <div className="pl-0 md:pl-16 pb-20 md:pb-0 min-h-screen flex flex-col flex-1">
          <Navbar onMenuClick={() => setMobileMenuOpen(true)} />
          <main className="relative z-0 flex-1 p-4 pt-20 md:pt-6 md:p-6">
            {children}
          </main>
        </div>
        <BottomNav />
      </div>
    </MessagingUnreadProvider>
  );
}


