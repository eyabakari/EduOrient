import {
  Document,
  Page,
  Text,
  View,
  StyleSheet,
  Image,
  Link,
  Svg,
  Path,
} from '@react-pdf/renderer';

/**
 * Modèle PDF du portfolio (@react-pdf/renderer) : deux colonnes, compétences, projets, pied de page marque.
 * Données : props passées par PortfolioPdfDownload (aucun appel API dans ce fichier).
 */

/** Couleurs type CV pro (LinkedIn / Canva) */
const COLORS = {
  accent: '#2563eb',
  accentDark: '#1d4ed8',
  sidebarBg: '#f8fafc',
  sidebarBorder: '#e2e8f0',
  text: '#1e293b',
  textMuted: '#64748b',
  textLight: '#94a3b8',
  badgeBg: '#f1f5f9',
  badgeBorder: '#e2e8f0',
  pageBg: '#ffffff',
};

const styles = StyleSheet.create({
  page: {
    flexDirection: 'column',
    backgroundColor: COLORS.pageBg,
    fontFamily: 'Helvetica',
    fontSize: 10,
    color: COLORS.text,
    paddingBottom: 44,
    paddingTop: 0,
    paddingHorizontal: 0,
  },
  topAccent: {
    width: '100%',
    height: 6,
    backgroundColor: COLORS.accent,
  },
  bodyRow: {
    flexDirection: 'row',
    flexGrow: 1,
  },
  sidebar: {
    width: 168,
    backgroundColor: COLORS.sidebarBg,
    borderRightWidth: 1,
    borderRightColor: COLORS.sidebarBorder,
    paddingTop: 22,
    paddingBottom: 16,
    paddingHorizontal: 14,
  },
  main: {
    flex: 1,
    paddingTop: 22,
    paddingBottom: 16,
    paddingHorizontal: 22,
    minWidth: 0,
  },
  avatar: {
    width: 72,
    height: 72,
    borderRadius: 8,
    marginBottom: 12,
    objectFit: 'cover',
    alignSelf: 'center',
  },
  sidebarName: {
    fontSize: 14,
    fontWeight: 'bold',
    color: COLORS.text,
    textAlign: 'center',
    marginBottom: 4,
  },
  sidebarRole: {
    fontSize: 9,
    color: COLORS.textMuted,
    textAlign: 'center',
    lineHeight: 1.35,
    marginBottom: 14,
  },
  sidebarSectionLabel: {
    fontSize: 8,
    fontWeight: 'bold',
    color: COLORS.accent,
    textTransform: 'uppercase',
    letterSpacing: 0.8,
    marginBottom: 8,
    marginTop: 4,
  },
  contactRow: {
    flexDirection: 'row',
    alignItems: 'center',
    marginBottom: 8,
  },
  iconWrap: {
    width: 14,
    marginRight: 6,
    alignItems: 'center',
    justifyContent: 'center',
  },
  contactText: {
    fontSize: 8,
    color: COLORS.text,
    flex: 1,
    lineHeight: 1.35,
  },
  contactLink: {
    textDecoration: 'none',
  },
  badge: {
    paddingVertical: 4,
    paddingHorizontal: 8,
    backgroundColor: COLORS.badgeBg,
    borderWidth: 1,
    borderColor: COLORS.badgeBorder,
    borderRadius: 4,
    fontSize: 7.5,
    color: COLORS.text,
    marginRight: 5,
    marginBottom: 5,
  },
  badgesRow: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    marginTop: 2,
  },
  mainHeadline: {
    fontSize: 20,
    fontWeight: 'bold',
    color: COLORS.text,
    marginBottom: 4,
  },
  mainSub: {
    fontSize: 11,
    color: COLORS.accent,
    fontWeight: 'bold',
    marginBottom: 14,
  },
  sectionTitleMain: {
    fontSize: 11,
    fontWeight: 'bold',
    color: COLORS.text,
    marginBottom: 8,
    marginTop: 4,
    paddingBottom: 4,
    borderBottomWidth: 1,
    borderBottomColor: COLORS.sidebarBorder,
  },
  bio: {
    fontSize: 9.5,
    color: COLORS.textMuted,
    lineHeight: 1.55,
    marginBottom: 16,
  },
  projectBlock: {
    marginBottom: 14,
    paddingBottom: 12,
    borderBottomWidth: 1,
    borderBottomColor: COLORS.sidebarBorder,
  },
  projectBlockLast: {
    borderBottomWidth: 0,
    marginBottom: 0,
    paddingBottom: 0,
  },
  projectImage: {
    width: '100%',
    maxHeight: 120,
    objectFit: 'cover',
    borderRadius: 6,
    marginBottom: 8,
  },
  projectTitle: {
    fontSize: 12,
    fontWeight: 'bold',
    color: COLORS.accent,
    marginBottom: 5,
  },
  projectDesc: {
    fontSize: 9,
    color: COLORS.textMuted,
    lineHeight: 1.45,
    marginBottom: 6,
  },
  projectSkillBadge: {
    paddingVertical: 3,
    paddingHorizontal: 7,
    backgroundColor: COLORS.badgeBg,
    borderWidth: 1,
    borderColor: COLORS.badgeBorder,
    borderRadius: 4,
    fontSize: 7,
    color: COLORS.text,
    marginRight: 8,
    marginBottom: 6,
  },
  linkRow: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    alignItems: 'center',
    marginTop: 4,
  },
  projectLinkInner: {
    flexDirection: 'row',
    alignItems: 'center',
    marginRight: 14,
    marginBottom: 4,
  },
  linkText: {
    fontSize: 8.5,
    color: COLORS.accent,
    textDecoration: 'underline',
  },
  emptyNote: {
    fontSize: 9,
    color: COLORS.textLight,
    fontStyle: 'italic',
  },
  footer: {
    position: 'absolute',
    bottom: 14,
    left: 0,
    right: 0,
    textAlign: 'center',
    fontSize: 7.5,
    color: COLORS.textLight,
  },
});

const ICON_STROKE = '#64748b';
const ICON_SIZE = 11;

/** Petites icônes vectorielles inline pour le PDF (pas de polices d’icônes externes). */

function IconMail() {
  return (
    <Svg width={ICON_SIZE} height={ICON_SIZE} viewBox="0 0 24 24">
      <Path
        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
        stroke={ICON_STROKE}
        strokeWidth={1.5}
        fill="none"
        strokeLinecap="round"
        strokeLinejoin="round"
      />
      <Path
        d="M22 6l-10 7L2 6"
        stroke={ICON_STROKE}
        strokeWidth={1.5}
        fill="none"
        strokeLinecap="round"
        strokeLinejoin="round"
      />
    </Svg>
  );
}

function IconPhone() {
  return (
    <Svg width={ICON_SIZE} height={ICON_SIZE} viewBox="0 0 24 24">
      <Path
        d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"
        stroke={ICON_STROKE}
        strokeWidth={1.5}
        fill="none"
        strokeLinecap="round"
        strokeLinejoin="round"
      />
    </Svg>
  );
}

function IconLinkedIn() {
  return (
    <Svg width={ICON_SIZE} height={ICON_SIZE} viewBox="0 0 24 24">
      <Path
        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.064 2.064 0 112.064-2.065 2.064 2.064 0 01-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"
        fill={ICON_STROKE}
      />
    </Svg>
  );
}

function IconGithub() {
  return (
    <Svg width={ICON_SIZE} height={ICON_SIZE} viewBox="0 0 24 24">
      <Path
        d="M12 2C6.48 2 2 6.58 2 12.26c0 4.5 2.87 8.32 6.84 9.67.5.1.68-.22.68-.48 0-.24-.01-.87-.01-1.71-2.78.62-3.37-1.37-3.37-1.37-.45-1.18-1.11-1.5-1.11-1.5-.91-.63.07-.62.07-.62 1 .07 1.53 1.05 1.53 1.05.89 1.56 2.34 1.11 2.91.85.09-.66.35-1.11.63-1.37-2.22-.26-4.56-1.14-4.56-5.07 0-1.12.39-2.03 1.03-2.75-.1-.26-.45-1.3.1-2.71 0 0 .84-.27 2.75 1.02A9.43 9.43 0 0112 6.84c.85.004 1.71.12 2.51.35 1.91-1.29 2.75-1.02 2.75-1.02.55 1.41.2 2.45.1 2.71.64.72 1.03 1.63 1.03 2.75 0 3.95-2.35 4.8-4.59 5.06.36.32.68.94.68 1.9 0 1.37-.01 2.47-.01 2.81 0 .27.18.59.69.49A10.03 10.03 0 0022 12.26C22 6.58 17.52 2 12 2z"
        fill={ICON_STROKE}
      />
    </Svg>
  );
}

function IconExternal() {
  return (
    <Svg width={ICON_SIZE} height={ICON_SIZE} viewBox="0 0 24 24">
      <Path
        d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"
        stroke={ICON_STROKE}
        strokeWidth={1.5}
        fill="none"
        strokeLinecap="round"
        strokeLinejoin="round"
      />
    </Svg>
  );
}

/**
 * Ligne contact dans le PDF : texte + icône, lien cliquable optionnel.
 * Entrées : icon (node), children (texte), href (URL optionnelle).
 * Sortie : JSX React-PDF.
 */
function ContactLine({ icon, children, href }) {
  const inner = (
    <View style={styles.contactRow}>
      <View style={styles.iconWrap}>{icon}</View>
      <Text style={styles.contactText}>{children}</Text>
    </View>
  );
  if (href) {
    return (
      <Link src={href} style={styles.contactLink}>
        {inner}
      </Link>
    );
  }
  return inner;
}

/**
 * Document PDF complet : une ou plusieurs pages, sidebar + zone principale, pied de page « Généré par ProLink ».
 * Entrées : profile, technicalSkills, projects, userImage (data URL), projectImagesBase64 (map id → data URL).
 * Sortie : élément <Document> React-PDF (consommé par PDFDownloadLink ou viewer).
 */
function MyDocument({
  profile = {},
  technicalSkills = [],
  projects = [],
  userImage = null,
  projectImagesBase64 = {},
}) {
  const name = profile?.name ?? 'Étudiant';
  const role = [profile?.specialite, profile?.niveau_etude].filter(Boolean).join(' · ') || 'Étudiant';
  const bio = profile?.bio ?? '';
  const email = profile?.email ?? '';
  const phone = profile?.phone ?? profile?.telephone ?? '';
  const linkedinUrl = profile?.linkedin ?? '';

  return (
    <Document>
      <Page size="A4" style={styles.page} wrap>
        <View style={styles.topAccent} />

        <View style={styles.bodyRow}>
          {/* ——— Sidebar ——— */}
          <View style={styles.sidebar}>
            {userImage ? <Image src={userImage} style={styles.avatar} /> : null}
            <Text style={styles.sidebarName}>{name}</Text>
            <Text style={styles.sidebarRole}>{role}</Text>

            <Text style={styles.sidebarSectionLabel}>Contact</Text>
            {email ? (
              <ContactLine icon={<IconMail />} href={`mailto:${email}`}>
                {email}
              </ContactLine>
            ) : null}
            {phone ? <ContactLine icon={<IconPhone />}>{phone}</ContactLine> : null}
            {linkedinUrl ? (
              <ContactLine icon={<IconLinkedIn />} href={linkedinUrl}>
                LinkedIn
              </ContactLine>
            ) : null}
            {!email && !phone && !linkedinUrl ? (
              <Text style={[styles.contactText, { marginBottom: 8 }]}>—</Text>
            ) : null}

            <Text style={[styles.sidebarSectionLabel, { marginTop: 14 }]}>Compétences</Text>
            {technicalSkills.length === 0 ? (
              <Text style={styles.emptyNote}>Aucune compétence technique</Text>
            ) : (
              <View style={styles.badgesRow}>
                {technicalSkills.map((skill) => (
                  <Text key={skill.id} style={styles.badge}>
                    {skill.nom}
                  </Text>
                ))}
              </View>
            )}
          </View>

          {/* ——— Colonne principale ——— */}
          <View style={styles.main}>
            <Text style={styles.mainHeadline}>{name}</Text>
            <Text style={styles.mainSub}>{role}</Text>

            {bio ? (
              <>
                <Text style={styles.sectionTitleMain}>À propos</Text>
                <Text style={styles.bio}>{bio}</Text>
              </>
            ) : null}

            <Text style={styles.sectionTitleMain}>Projets</Text>
            {!projects?.length ? (
              <Text style={styles.emptyNote}>Aucun projet pour le moment.</Text>
            ) : (
              projects.map((project, index) => (
                <View
                  key={project.id}
                  style={
                    index < projects.length - 1
                      ? styles.projectBlock
                      : [styles.projectBlock, styles.projectBlockLast]
                  }
                >
                  {projectImagesBase64[project.id] ? (
                    <Image src={projectImagesBase64[project.id]} style={styles.projectImage} />
                  ) : null}
                  <Text style={styles.projectTitle}>{project.titre || 'Sans titre'}</Text>
                  {project.description ? (
                    <Text style={styles.projectDesc}>
                      {project.description.length > 320
                        ? `${project.description.slice(0, 320)}…`
                        : project.description}
                    </Text>
                  ) : null}
                  {project.skills?.length > 0 ? (
                    <View style={styles.badgesRow}>
                      {project.skills.map((s) => (
                        <Text key={s.id} style={styles.projectSkillBadge}>
                          {s.nom}
                        </Text>
                      ))}
                    </View>
                  ) : null}
                  <View style={styles.linkRow}>
                    {project.lien_github ? (
                      <Link src={project.lien_github} style={styles.contactLink}>
                        <View style={styles.projectLinkInner}>
                          <View style={styles.iconWrap}>
                            <IconGithub />
                          </View>
                          <Text style={styles.linkText}>GitHub</Text>
                        </View>
                      </Link>
                    ) : null}
                    {project.lien_demo ? (
                      <Link src={project.lien_demo} style={styles.contactLink}>
                        <View style={styles.projectLinkInner}>
                          <View style={styles.iconWrap}>
                            <IconExternal />
                          </View>
                          <Text style={styles.linkText}>Démo</Text>
                        </View>
                      </Link>
                    ) : null}
                  </View>
                </View>
              ))
            )}
          </View>
        </View>

        <Text style={styles.footer} fixed>
          Généré par ProLink
        </Text>
      </Page>
    </Document>
  );
}

export default MyDocument;


