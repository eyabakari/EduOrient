<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>CV - {{ $profileName }}</title>
  <style>
    body { font-family: Arial, Helvetica, sans-serif; color: #222; margin: 32px; line-height: 1.45; }
    .page { width: 100%; }
    .header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 18px; }
    .header-left { max-width: 65%; }
    .header-right { text-align: right; font-size: 12px; color: #555; }
    h1 { margin: 0 0 6px; font-size: 24px; letter-spacing: -0.5px; }
    h2 { margin: 20px 0 8px; font-size: 16px; text-transform: uppercase; letter-spacing: 0.8px; }
    p { margin: 0 0 10px; }
    .subtitle { margin: 0; color: #555; font-size: 13px; }
    hr { border: none; border-bottom: 1px solid #ddd; margin: 8px 0 20px; }
    .section { margin-bottom: 18px; }
    .item { margin-bottom: 12px; }
    .item-title { font-weight: 700; font-size: 13px; margin-bottom: 3px; }
    .item-meta { color: #555; font-size: 11px; margin-bottom: 6px; }
    .small-text { color: #555; font-size: 12px; }
    .chip-list { display: flex; flex-wrap: wrap; gap: 6px; }
    .chip { display: inline-block; padding: 6px 10px; background: #f5f5f5; border-radius: 999px; font-size: 11px; color: #333; }
    .details-row { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 8px; }
    .details-cell { flex: 1 1 30%; min-width: 120px; }
    .contact-item { margin-bottom: 4px; }
    .muted { color: #555; }
  </style>
</head>
<body>
  <div class="page">
    <div class="header">
      <div class="header-left">
        <h1>{{ $profileName }}</h1>
        <p class="subtitle">{{ $profileTitle }}</p>
      </div>
      <div class="header-right">
        <div class="contact-item">Email : {{ $profileEmail ?: 'Non renseigné' }}</div>
        <div class="contact-item">Téléphone : {{ $profilePhone ?: 'Non renseigné' }}</div>
      </div>
    </div>

    <hr />

    <div class="section">
      <h2>Résumé professionnel</h2>
      <p>{{ $summary }}</p>
    </div>

    <div class="section">
      <h2>Diplômes et formations</h2>
      @if(count($education) > 0)
        @foreach($education as $item)
          <div class="item">
            <div class="item-title">{{ $item['programme'] }}</div>
            <div class="item-meta">{{ $item['institution'] }} · {{ $item['dates'] }}</div>
          </div>
        @endforeach
      @else
        <p class="small-text">Aucune formation renseignée.</p>
      @endif
    </div>

    <div class="section">
      <h2>Expériences</h2>
      @if(count($experiences) > 0)
        @foreach($experiences as $experience)
          <div class="item">
            <div class="item-title">{{ $experience['role'] }}</div>
            <div class="item-meta">{{ $experience['company'] }} · {{ $experience['dates'] }}</div>
            <p>{{ $experience['description'] }}</p>
          </div>
        @endforeach
      @else
        <p class="small-text">Aucune expérience professionnelle renseignée.</p>
      @endif
    </div>

    <div class="section">
      <h2>Réalisations / Projets</h2>
      @if(count($projects) > 0)
        @foreach($projects as $project)
          <div class="item">
            <div class="item-title">{{ $project['titre'] }}</div>
            <div class="item-meta">{{ $project['date_debut'] ?: 'Date inconnue' }} – {{ $project['date_fin'] ?: 'Présent' }}</div>
            <p>{{ $project['description'] ?: 'Description non renseignée.' }}</p>
            <div class="small-text muted">
              @if($project['lien_github']) GitHub : {{ $project['lien_github'] }} @endif
              @if($project['lien_demo']) · Démo : {{ $project['lien_demo'] }} @endif
            </div>
            @if(count($project['skills']) > 0)
              <div class="chip-list">
                @foreach($project['skills'] as $skill)
                  <span class="chip">{{ $skill }}</span>
                @endforeach
              </div>
            @endif
          </div>
        @endforeach
      @else
        <p class="small-text">Aucun projet publié.</p>
      @endif
    </div>

    <div class="section">
      <h2>Compétences</h2>
      @if(count($technicalSkills) > 0)
        <div class="item">
          <div class="item-title">Compétences techniques</div>
          <div class="chip-list">
            @foreach($technicalSkills as $skill)
              <span class="chip">{{ $skill['name'] }}</span>
            @endforeach
          </div>
        </div>
      @else
        <p class="small-text">Aucune compétence technique enregistrée.</p>
      @endif

      @if(count($softSkills) > 0)
        <div class="item">
          <div class="item-title">Soft skills</div>
          <div class="chip-list">
            @foreach($softSkills as $skill)
              <span class="chip">{{ $skill['name'] }}</span>
            @endforeach
          </div>
        </div>
      @endif
    </div>

    <div class="section">
      <h2>Langues</h2>
      @if(count($languages) > 0)
        <div class="chip-list">
          @foreach($languages as $language)
            <span class="chip">{{ $language['nom'] }}{{ $language['niveau'] ? ' – ' . $language['niveau'] : '' }}</span>
          @endforeach
        </div>
      @else
        <p class="small-text">Aucune langue renseignée.</p>
      @endif
    </div>
  </div>
</body>
</html>
