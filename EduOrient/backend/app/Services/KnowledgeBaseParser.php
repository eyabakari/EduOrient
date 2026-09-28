<?php

namespace App\Services;

/**
 * Parse knowledge_base.md pour extraire parcours, filières idéales, entreprises et certifications.
 * Ignore les paragraphes d'introduction. Ne garde que les sections ## avec un titre court (parcours métier).
 * Supprime les liens Markdown [texte](url) dans toutes les sorties.
 */
class KnowledgeBaseParser
{
    private string $content = '';

    /** Nombre max de mots pour considérer le titre comme un nom de parcours (pas un paragraphe). */
    private const MAX_TITLE_WORDS = 5;

    public function __construct(?string $path = null)
    {
        $path = $path ?? config('recommendation.knowledge_base_path') ?? base_path('../knowledge_base.md');
        if (is_file($path)) {
            $this->content = (string) file_get_contents($path);
        }
    }

    /**
     * Extrait les parcours professionnels (sections ##) de SOURCE DATA 3.
     * Ignore l'intro et les sections dont le titre fait plus de 5 mots ou sans **Écoles/Programmes**.
     *
     * @return array<int, array{name: string, ideal_degrees: array, companies: array, metier_final: string}>
     */
    public function getCareerPaths(): array
    {
        $paths = [];
        $blocks = $this->extractSourceData3Block();
        if ($blocks === '') {
            return $paths;
        }
        $sections = preg_split('/^##\s+/m', $blocks, -1, PREG_SPLIT_NO_EMPTY);

        foreach ($sections as $section) {
            $lines = explode("\n", trim($section));
            $name = trim($lines[0] ?? '');

            if ($name === '') {
                continue;
            }

            // Ignorer les paragraphes d'intro : titre trop long = pas un nom de parcours
            if ($this->countWords($name) > self::MAX_TITLE_WORDS) {
                continue;
            }
            // Ne garder que les sections qui définissent un vrai parcours (présence des champs structurés)
            if (strpos($section, '**Écoles/Programmes**') === false) {
                continue;
            }

            $ideal_degrees = $this->extractLineAfterLabel($section, 'Écoles/Programmes');
            $companies = $this->extractLineAfterLabel($section, 'Entreprises Cibles');
            $metier = $this->extractLineAfterLabel($section, 'Métier Final');

            $paths[] = [
                'name' => $this->stripMarkdownLinks($name),
                'ideal_degrees' => is_array($ideal_degrees) ? array_map([$this, 'stripMarkdownLinks'], $ideal_degrees) : [],
                'companies' => is_array($companies) ? array_map([$this, 'stripMarkdownLinks'], $companies) : [],
                'metier_final' => is_string($metier) ? $this->stripMarkdownLinks($metier) : '',
            ];
        }

        return $paths;
    }

    /**
     * Extrait les certifications suggérées par domaine (### Cloud, ### Développement, etc.).
     *
     * @return array<string, array<int, string>>
     */
    public function getCertificationsByDomain(): array
    {
        $certs = [];
        $allowedDomains = ['Cloud', 'Développement', 'Réseaux & Cyber', 'Data'];
        $domainSections = preg_split('/^###\s+/m', $this->content, -1, PREG_SPLIT_NO_EMPTY);
        foreach ($domainSections as $block) {
            $firstLine = strtok($block, "\n");
            $domain = trim($firstLine);
            if ($domain === '' || !in_array($domain, $allowedDomains, true)) {
                continue;
            }
            if (preg_match_all('/^\s*-\s+\*\*([^*]+)\*\*\s*:/m', $block, $m)) {
                $list = array_map(function ($s) {
                    return $this->stripMarkdownLinks(trim($s));
                }, $m[1]);
                $list = array_filter($list, fn ($s) => stripos($s, 'Impact') !== 0);
                if ($list !== []) {
                    $certs[$domain] = array_values($list);
                }
            }
        }
        if (empty($certs)) {
            $certs = [
                'Cloud' => ['AWS Certified Cloud Practitioner', 'Microsoft Azure Fundamentals (AZ-900)'],
                'Développement' => ['Oracle Java SE/EE Programmer', 'Professional Scrum Master (PSM I)'],
                'Réseaux & Cyber' => ['Cisco CCNA', 'Certified Ethical Hacker (CEH)'],
                'Data' => ['Microsoft Certified: Data Analyst Associate', 'Google Data Analytics Professional Certificate'],
            ];
        }
        return $certs;
    }

    /**
     * Supprime les liens Markdown [texte](url) en gardant uniquement le texte.
     */
    public function stripMarkdownLinks(string $text): string
    {
        $result = preg_replace('/\[([^\]]+)\]\([^)]+\)/', '$1', $text);
        return trim($result ?? $text);
    }

    private function countWords(string $text): int
    {
        $text = preg_replace('/\s+/', ' ', trim($text));
        return $text === '' ? 0 : count(explode(' ', $text));
    }

    private function extractSourceData3Block(): string
    {
        if (!preg_match('/# SOURCE DATA 3\s+(.*?)(?=# SOURCE DATA 4)/s', $this->content, $m)) {
            return '';
        }
        return $m[1];
    }

    /**
     * Extrait le contenu après "**Label** : " sur la même ligne, supprime les liens MD, puis normalise en liste si besoin.
     *
     * @return array<int, string>|string
     */
    private function extractLineAfterLabel(string $section, string $label)
    {
        $pattern = '/\*\*' . preg_quote($label, '/') . '\*\*\s*:\s*([^\n]+)/';
        if (!preg_match($pattern, $section, $m)) {
            return $label === 'Métier Final' ? '' : [];
        }
        $text = $this->stripMarkdownLinks(trim($m[1]));
        $text = preg_replace('/\.\s*$/', '', $text);

        if ($label === 'Métier Final') {
            return $text;
        }

        $parts = preg_split('/[,;]/', $text);
        return array_values(array_filter(array_map(function ($p) {
            $p = $this->stripMarkdownLinks(trim($p));
            return $p !== '' ? $p : null;
        }, $parts)));
    }
}
