import { useState, useEffect, cloneElement, memo } from 'react';
import { Navigate } from 'react-router-dom';
import { Users, Briefcase, FolderOpen, Award } from 'lucide-react';
import {
  LineChart,
  Line,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  ResponsiveContainer,
  PieChart,
  Pie,
  Cell,
} from 'recharts';
import DashboardLayout from '../components/DashboardLayout';
import { useAuth } from '../context/AuthContext';
import api from '../api/axios';

const ADMIN_ROLE = 'admin';

const PALETTE = {
  bg: 'var(--page-bg)',
  card: 'var(--card-bg)',
  text: 'var(--text)',
  textMuted: 'var(--muted)',
  primary: 'var(--primary)',
  lavande: 'var(--sidebar-active)',
  accent: '#FFCC80',
  accentSoft: '#FFB74D',
  blue: '#64B5F6',
  blueSoft: '#BBDEFB',
  success: '#81C784',
  successSoft: '#C8E6C9',
  mauve: '#D1C4E9',
  mauveSoft: '#F3E5F5',
  border: 'var(--border)',
  shadow: 'var(--shadow)',
};

const CHART_COLORS = [PALETTE.primary, PALETTE.accent, PALETTE.blue, PALETTE.success, PALETTE.mauve];

const StatCard = memo(({ title, value, icon, bg, color, shadow }) => (
  <div style={{ backgroundColor: PALETTE.card, padding: '25px', borderRadius: '25px', display: 'flex', alignItems: 'center', gap: '20px', boxShadow: shadow }}>
    <div style={{ backgroundColor: bg, color: color, padding: '15px', borderRadius: '50%', display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
      {cloneElement(icon, { size: 24 })}
    </div>
    <div>
      <p style={{ color: PALETTE.textMuted, fontSize: '14px', margin: 0 }}>{title}</p>
      <h2 style={{ color: PALETTE.text, fontSize: '24px', fontWeight: 'bold', margin: 0 }}>{value}</h2>
    </div>
  </div>
));

const AdminDashboard = () => {
  const { user } = useAuth();
  const isAdmin = user?.role?.name === ADMIN_ROLE;

  const [stats, setStats] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    if (!isAdmin) return;
    api
      .get('/admin/stats')
      .then((res) => setStats(res.data?.data ?? null))
      .catch(() => setError('Impossible de charger les statistiques.'))
      .finally(() => setLoading(false));
  }, [isAdmin]);

  if (user && !isAdmin) {
    return <Navigate to="/dashboard" replace />;
  }

  const lineData = stats?.inscrits_par_jour ?? [];
  const pieData = stats?.top_5_skills ?? [];
  const lastUsers = stats?.dernieres_inscriptions ?? [];

  return (
    <DashboardLayout>
        <div className="max-w-6xl lg:max-w-[90rem] mx-auto">
          <h1 style={{ color: PALETTE.text, fontSize: '28px', fontWeight: 'bold', marginBottom: '30px' }}>Admin Dashboard</h1>

          {error && (
            <div style={{ marginBottom: '20px', padding: '12px 16px', backgroundColor: '#FEE2E2', color: '#B91C1C', borderRadius: '12px' }}>
              {error}
            </div>
          )}

          {loading ? (
            <p style={{ color: PALETTE.textMuted }}>Chargement des statistiques…</p>
          ) : stats && (
            <>
              <div className="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-5 mb-8 lg:mb-10">
                <StatCard title="Candidats" value={stats.candidats ?? 0} icon={<Users />} bg={PALETTE.mauveSoft} color={PALETTE.primary} shadow={PALETTE.shadow} />
                <StatCard title="Recruteurs" value={stats.recruteurs ?? 0} icon={<Briefcase />} bg={PALETTE.blueSoft} color={PALETTE.blue} shadow={PALETTE.shadow} />
                <StatCard title="Projets" value={stats.projets ?? 0} icon={<FolderOpen />} bg="#FFF3E0" color={PALETTE.accent} shadow={PALETTE.shadow} />
                <StatCard title="Compétences" value={stats.competences ?? 0} icon={<Award />} bg={PALETTE.successSoft} color={PALETTE.success} shadow={PALETTE.shadow} />
              </div>

              <div className="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 mb-8 lg:mb-10">
                <div className="lg:col-span-2" style={{ backgroundColor: PALETTE.card, padding: '30px', borderRadius: '30px', boxShadow: PALETTE.shadow }}>
                  <h3 style={{ color: PALETTE.text, fontWeight: 'bold', marginBottom: '20px' }}>Inscrits par semaine (7 derniers jours)</h3>
                  <div style={{ height: '300px' }}>
                    <ResponsiveContainer width="100%" height="100%">
                      <LineChart data={lineData} margin={{ top: 5, right: 20, left: 0, bottom: 5 }}>
                        <CartesianGrid strokeDasharray="3 3" vertical={false} stroke={PALETTE.border} />
                        <XAxis dataKey="jour" axisLine={false} tickLine={false} tick={{ fill: PALETTE.textMuted, fontSize: 12 }} />
                        <YAxis axisLine={false} tickLine={false} tick={{ fill: PALETTE.textMuted, fontSize: 12 }} allowDecimals={false} />
                        <Tooltip cursor={{ stroke: PALETTE.primary, strokeWidth: 1 }} formatter={(val) => [val, 'Inscrits']} labelFormatter={(label, payload) => payload[0]?.payload?.date ?? label} />
                        <Line type="monotone" dataKey="inscrits" stroke={PALETTE.primary} strokeWidth={2} dot={{ fill: PALETTE.primary, r: 4 }} activeDot={{ r: 6 }} />
                      </LineChart>
                    </ResponsiveContainer>
                  </div>
                </div>

                <div style={{ backgroundColor: PALETTE.card, padding: '30px', borderRadius: '30px', boxShadow: PALETTE.shadow, textAlign: 'center' }}>
                  <h3 style={{ color: PALETTE.text, fontWeight: 'bold', marginBottom: '20px' }}>Top 5 compétences</h3>
                  <div style={{ height: '220px' }}>
                    {pieData.length > 0 ? (
                      <ResponsiveContainer width="100%" height="100%">
                        <PieChart>
                          <Pie
                            data={pieData}
                            innerRadius={55}
                            outerRadius={75}
                            paddingAngle={2}
                            dataKey="value"
                            nameKey="name"
                          >
                            {pieData.map((_, i) => (
                              <Cell key={i} fill={CHART_COLORS[i % CHART_COLORS.length]} />
                            ))}
                          </Pie>
                          <Tooltip formatter={(val, name, props) => [`${val} (${props.payload.percent}%)`, name]} />
                        </PieChart>
                      </ResponsiveContainer>
                    ) : (
                      <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', height: '100%', color: PALETTE.textMuted }}>
                        Aucune donnée
                      </div>
                    )}
                  </div>
                  {pieData.length > 0 && (
                    <ul className="mt-3 text-left list-none pl-0 space-y-1.5" style={{ fontSize: '13px', color: PALETTE.text }}>
                      {pieData.map((d, i) => (
                        <li key={i} className="flex items-center gap-2 flex-wrap">
                          <span className="inline-block w-2.5 h-2.5 rounded-full shrink-0" style={{ backgroundColor: CHART_COLORS[i % CHART_COLORS.length] }} />
                          <span className="break-words min-w-0 flex-1">{d.name}</span>
                          <span className="text-muted shrink-0">{d.value}</span>
                        </li>
                      ))}
                    </ul>
                  )}
                </div>
              </div>

              <div style={{ backgroundColor: PALETTE.card, padding: '30px', borderRadius: '30px', boxShadow: PALETTE.shadow }}>
                <h3 style={{ color: PALETTE.text, fontWeight: 'bold', marginBottom: '20px' }}>Derniers utilisateurs inscrits</h3>
                <div style={{ overflowX: 'auto' }}>
                  <table style={{ width: '100%', borderCollapse: 'collapse' }}>
                    <thead>
                      <tr style={{ borderBottom: `2px solid ${PALETTE.bg}` }}>
                        <th style={{ textAlign: 'left', padding: '12px 16px', color: PALETTE.textMuted, fontSize: '12px', fontWeight: '600', textTransform: 'uppercase' }}>Nom</th>
                        <th style={{ textAlign: 'left', padding: '12px 16px', color: PALETTE.textMuted, fontSize: '12px', fontWeight: '600', textTransform: 'uppercase' }}>Rôle</th>
                        <th style={{ textAlign: 'left', padding: '12px 16px', color: PALETTE.textMuted, fontSize: '12px', fontWeight: '600', textTransform: 'uppercase' }}>Date</th>
                        <th style={{ textAlign: 'left', padding: '12px 16px', color: PALETTE.textMuted, fontSize: '12px', fontWeight: '600', textTransform: 'uppercase' }}>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      {lastUsers.length === 0 ? (
                        <tr>
                          <td colSpan={4} style={{ padding: '24px', textAlign: 'center', color: PALETTE.textMuted }}>
                            Aucun utilisateur
                          </td>
                        </tr>
                      ) : (
                        lastUsers.map((u, i) => (
                          <tr key={i} style={{ borderBottom: `1px solid ${PALETTE.bg}` }}>
                            <td style={{ padding: '14px 16px', color: PALETTE.text, fontWeight: '500' }}>{u.nom}</td>
                            <td style={{ padding: '14px 16px', color: PALETTE.textMuted }}>{u.role}</td>
                            <td style={{ padding: '14px 16px', color: PALETTE.textMuted }}>{u.date}</td>
                            <td style={{ padding: '14px 16px' }}>
                              <span style={{ backgroundColor: PALETTE.successSoft, color: PALETTE.success, padding: '4px 10px', borderRadius: '20px', fontSize: '12px', fontWeight: '500' }}>
                                {u.status}
                              </span>
                            </td>
                          </tr>
                        ))
                      )}
                    </tbody>
                  </table>
                </div>
              </div>
            </>
          )}
        </div>
    </DashboardLayout>
  );
};

export default AdminDashboard;


