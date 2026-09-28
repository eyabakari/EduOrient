<?php

return [
    'knowledge_base_path' => env('KNOWLEDGE_BASE_PATH', null), // null = base_path('../knowledge_base.md')

    'path_required_skills' => [
        'Génie Logiciel (GL)' => ['Laravel', 'Spring Boot', 'Docker', 'AWS'],
        'Réseaux et Télécoms (RT)' => ['Docker', 'AWS'],
        'Intelligence Artificielle (IIA/IA)' => ['Python (Django)', 'AWS'],
        'Business Intelligence (BI)' => ['Python (Django)', 'AWS'],
        'Cyber-sécurité' => ['Docker', 'AWS'],
        'IA/Data Science (Mastères Spécialisés)' => ['Python (Django)', 'AWS'],
    ],
];
