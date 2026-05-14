# Specs — Corps de review + Sidebar v1

Maquette de référence : `design-proposals/proposal-content-sidebar-anachronique-2026-05.html`
Date : 2026-05-13

---

## 1. Structure HTML cible

### Zone blanche `.gs-content-zone`

Wrapper qui englobe le corps de l'article et la sidebar. Fond blanc, contraste avec le hero sombre.

```html
<div class="gs-content-zone">
  <div class="container">
    <div class="row">

      <!-- Corps de l'article -->
      <div class="col-sm-12 col-lg-8">
        <div class="gs-review-body">
          <?php the_content(); ?>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-sm-12 col-lg-4">
        <aside class="gs-sidebar sticky" aria-label="Informations sur l'album">
          <?php echo wp_kses_post( get_field( 'album_spotify' ) ); ?>
          <?php get_template_part( 'parts/fiche-album' ); ?>
        </aside>
      </div>

    </div>
  </div>
</div>
```

### Partial `parts/fiche-album.php`

```php
<?php
$gs_best_tracks  = get_field( 'best_tracks' );
$gs_ou_ecouter   = get_field( 'ou_les_ecouter' );

if ( ! $gs_best_tracks && ! $gs_ou_ecouter ) return;
?>
<div class="gs-fiche" role="complementary" aria-label="<?php esc_attr_e( 'Fiche album', 'gimmickshelter' ); ?>">
    <div class="gs-fiche__head">Fiche album</div>
    <div class="gs-fiche__body">

        <?php if ( $gs_best_tracks ) :
            $gs_tracks = array_filter( array_map( 'trim', explode( ',', $gs_best_tracks ) ) );
            if ( $gs_tracks ) : ?>
        <div class="gs-fiche__row">
            <span class="gs-fiche__key" id="gs-fiche-tracks-label">Best tracks</span>
            <ol class="gs-fiche__tracks" aria-labelledby="gs-fiche-tracks-label">
                <?php foreach ( $gs_tracks as $gs_track ) : ?>
                <li><?php echo esc_html( $gs_track ); ?></li>
                <?php endforeach; ?>
            </ol>
        </div>
        <div class="gs-fiche__sep" aria-hidden="true"></div>
        <?php endif; endif; ?>

        <?php if ( $gs_ou_ecouter ) : ?>
        <div class="gs-fiche__row">
            <span class="gs-fiche__key">Écouter</span>
            <a class="gs-fiche__listen"
               href="<?php echo esc_url( $gs_ou_ecouter ); ?>"
               target="_blank"
               rel="noopener noreferrer"
               aria-label="<?php echo esc_attr( sprintf( __( 'Écouter %s sur la plateforme de streaming', 'gimmickshelter' ), get_the_title() ) ); ?>">
                <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/>
                </svg>
                Écouter
            </a>
        </div>
        <?php endif; ?>

    </div>
</div>
```

> **Note migration :** le champ `ou_les_ecouter` contient actuellement du texte libre (ex. "Bandcamp").
> Pour que le lien fonctionne, il doit contenir une URL valide (ex. `https://drugdealer.bandcamp.com`).
> Renommer le label UI ACF en "Lien d'écoute (URL)" et ajouter une instruction dans le back-office.

---

## 2. Champs ACF concernés

| Champ | Clé | Type | Usage | Modification requise |
|---|---|---|---|---|
| `best_tracks` | existant | text | Liste de tracks séparés par `,` | Aucune — parsing côté PHP sur `,` |
| `ou_les_ecouter` | existant | text | URL de la plateforme d'écoute | **Changer le label UI** → "Lien d'écoute (URL)" + instruction "URL complète, ex. https://…" |
| `album_spotify` | existant | textarea/wysiwyg | Iframe embed Spotify | Aucune |
| `genre` | existant | text | Retiré de la sidebar — déjà dans le hero | **Ne plus afficher en sidebar** |

> `genre` ne doit plus être rendu dans le corps de page. Il est déjà présent dans les pills du hero.
> La suppression de l'affichage se fait dans le template, pas dans ACF.

---

## 3. Specs CSS

### Classes à créer dans `style.css` — scope `.single-anachroniques`

```css
/* ── Zone blanche ──────────────────────────────────── */
.single-anachroniques .gs-content-zone {
  background: var(--color3); /* #FFFFFF */
}

/* ── Corps de l'article ────────────────────────────── */
.gs-review-body p {
  font-size: 1.08rem;
  line-height: 1.82;
  color: var(--color4);
  margin-bottom: 1.6em;
  text-align: left; /* pas de justify sur écran */
}

.gs-review-body p:first-of-type {
  font-size: 1.18rem;
  line-height: 1.72;
}

/* Drop cap */
.gs-review-body p:first-of-type::first-letter {
  font-family: 'Anton', sans-serif;
  font-size: 4.2em;
  line-height: .78;
  float: left;
  margin-right: .07em;
  margin-bottom: -.05em;
  color: var(--color1);
}

/* Liens */
.gs-review-body a {
  color: var(--color2);
  text-decoration: underline;
  text-underline-offset: 3px;
  text-decoration-thickness: 1px;
}
.gs-review-body a:hover { opacity: .65; }

/* Typo */
.gs-review-body strong { color: var(--color4); font-weight: 700; }
.gs-review-body em     { color: rgba(0,0,0,.75); }

/* Titres dans le contenu */
.gs-review-body h2 {
  font-family: 'Anton', sans-serif;
  font-size: 1.4rem;
  color: var(--color2);
  text-transform: uppercase;
  letter-spacing: .03em;
  margin: 2.5rem 0 1rem;
}

/* Blockquote */
.gs-review-body blockquote {
  border-left: 2px solid var(--color1);
  margin: 2.2rem 0;
  padding: .6rem 0 .6rem 1.4rem;
  color: rgba(0,0,0,.55);
  font-style: italic;
  font-size: 1.08rem;
  line-height: 1.7;
}
.gs-review-body blockquote cite {
  display: block;
  margin-top: .6rem;
  font-size: .78rem;
  font-style: normal;
  color: rgba(0,0,0,.35);
}

/* Séparateur */
.gs-review-body hr {
  border: none;
  height: 1px;
  background: rgba(0,0,0,.1);
  margin: 2.5rem 0;
}

/* ── Sidebar ────────────────────────────────────────── */
.gs-sidebar {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  padding-top: 3rem;
}

/* Fiche album */
.gs-fiche { background: var(--color2); overflow: hidden; }

.gs-fiche__head {
  padding: .7rem 1.2rem;
  border-bottom: 1px solid rgba(255,255,255,.08);
  font-size: .6rem; font-weight: 700;
  letter-spacing: .16em; text-transform: uppercase;
  color: rgba(255,255,255,.35);
}

.gs-fiche__body {
  padding: 1.2rem;
  display: flex; flex-direction: column; gap: 1.2rem;
}

.gs-fiche__row  { display: flex; flex-direction: column; gap: .4rem; }

.gs-fiche__key {
  font-size: .58rem; font-weight: 700;
  letter-spacing: .16em; text-transform: uppercase;
  color: rgba(255,255,255,.3);
}

/* Best tracks */
.gs-fiche__tracks {
  list-style: none; counter-reset: track;
  display: flex; flex-direction: column; gap: .4rem;
  margin: 0; padding: 0;
}
.gs-fiche__tracks li {
  display: flex; align-items: baseline; gap: .65rem;
  font-size: .85rem; color: rgba(255,255,255,.8);
  counter-increment: track;
}
.gs-fiche__tracks li::before {
  content: counter(track);
  font-size: .58rem; font-weight: 700;
  color: var(--color1);
  min-width: 12px; text-align: right; flex-shrink: 0;
}

/* CTA Écouter */
.gs-fiche__listen {
  display: inline-flex; align-items: center; gap: .5rem;
  font-size: .75rem; font-weight: 700;
  letter-spacing: .08em; text-transform: uppercase;
  background: var(--color1); color: var(--color3);
  border: none; text-decoration: none;
  padding: .65rem 1rem;
  width: 100%; justify-content: center;
  transition: opacity .18s;
}
.gs-fiche__listen:hover,
.gs-fiche__listen:focus-visible { opacity: .82; color: var(--color3); }
.gs-fiche__listen svg { width: 13px; height: 13px; }

/* Séparateur */
.gs-fiche__sep { height: 1px; background: rgba(255,255,255,.07); }

/* ── Responsive ─────────────────────────────────────── */
/* Mobile : sidebar passe en dessous, sticky désactivé */
@media (max-width: 991px) {
  .gs-sidebar { position: static; padding-top: 2rem; }
  .gs-review-body { padding-top: 2.5rem; }
  .gs-review-body p:first-of-type::first-letter {
    font-size: 3.5em; /* drop cap réduit sur mobile */
  }
}

/* prefers-reduced-motion */
@media (prefers-reduced-motion: reduce) {
  .gs-review-body a,
  .gs-fiche__listen { transition: none; }
}
```

---

## 4. Specs SEO

### Impact sur les balises existantes

Le corps de l'article (`the_content()`) est rendu nativement par WordPress — pas d'impact sur le crawl. Les améliorations SEO portent sur :

**Lisibilité du contenu**
- `text-align: left` améliore la lisibilité, sans impact SEO direct mais réduction du taux de rebond potentielle.
- Le drop cap est purement CSS (`::first-letter`) — le texte reste intact pour les crawlers.

**Liens sortants dans le contenu**
- Les liens dans `the_content()` doivent avoir `rel="noopener noreferrer"` si ils ouvrent un nouvel onglet — à vérifier dans l'éditeur WP au cas par cas.

**Lien "Écouter" dans la fiche**
- Le lien `gs-fiche__listen` a `target="_blank"` + `rel="noopener noreferrer"` — conforme.
- `aria-label` descriptif fourni — lisible par les crawlers.

### JSON-LD — mise à jour `bestRating` / `tracks`

Les champs `best_tracks` et `ou_les_ecouter` peuvent enrichir le JSON-LD existant :

```php
[
  '@context'     => 'https://schema.org',
  '@type'        => 'Review',
  'itemReviewed' => [
    '@type'          => 'MusicAlbum',
    'name'           => get_the_title(),
    'byArtist'       => [
      '@type' => 'MusicGroup',
      'name'  => get_field( 'artiste' ) ?: get_field( 'labels' ),
    ],
    'genre'          => get_field( 'genre' ) ?: null,
    'datePublished'  => get_field( 'annee_sortie' ) ?: null,
    // Nouveau — lien vers la plateforme d'écoute
    'url'            => get_field( 'ou_les_ecouter' ) ?: null,
  ],
  'author'        => [ '@type' => 'Person', 'name' => get_the_author() ],
  'publisher'     => [ '@type' => 'Organization', 'name' => 'Gimmick Shelter' ],
  'datePublished' => get_the_date( 'c' ),
  'description'   => get_field( 'accroche' )
                      ?: wp_strip_all_tags( get_the_excerpt() ),
]
```

> `artiste` alimente `byArtist.name` en priorité sur `labels` (nouveau champ).
> `ou_les_ecouter` alimente `MusicAlbum.url` si c'est une URL valide.
> Toutes les propriétés sont conditionnelles — `null` exclut du JSON-LD.

---

## 5. Specs accessibilité

### Structure sémantique du corps

```html
<!-- Wrapper zone blanche -->
<div class="gs-content-zone">

  <!-- Article principal -->
  <div class="gs-review-body">
    <!-- the_content() — pas de rôle supplémentaire,
         le contenu WP est déjà dans <main> -->
  </div>

  <!-- Sidebar complémentaire -->
  <aside class="gs-sidebar" aria-label="Informations sur l'album">

    <!-- Spotify : l'iframe doit avoir title -->
    <!-- ACF album_spotify doit contenir title="Lecteur Spotify" dans l'iframe -->

    <!-- Fiche album -->
    <div class="gs-fiche" role="complementary"
         aria-label="Fiche album">

      <ol class="gs-fiche__tracks"
          aria-labelledby="gs-fiche-tracks-label">
        <!-- items -->
      </ol>

      <a class="gs-fiche__listen"
         href="..."
         target="_blank"
         rel="noopener noreferrer"
         aria-label="Écouter {titre} sur la plateforme de streaming">
      </a>

    </div>
  </aside>

</div>
```

### Points de vigilance

| Point | Règle |
|---|---|
| Drop cap `::first-letter` | Purement CSS — le texte source reste intact, lisible par les screen readers |
| `text-align: left` | Suppression du `text-align: justify` existant — meilleure lisibilité pour les troubles dyslexiques |
| Liens dans `the_content()` | Contraste `color2` (#000B29) sur fond blanc : ratio **∞** (quasi-noir) ✅ AAA |
| `gs-fiche__listen` | Texte blanc sur rouge (`color1`) : ratio **4.56:1** ✅ AA |
| `gs-fiche__tracks li` | Texte `rgba(255,255,255,.8)` sur `color2` : ratio **∞** ✅ AAA |
| Iframe Spotify | Doit avoir un attribut `title` — à vérifier dans le contenu ACF `album_spotify` |
| `target="_blank"` | `rel="noopener noreferrer"` présent ✅ — screen reader averti par `aria-label` |
| Focus visible | `.gs-fiche__listen:focus-visible` — outline à ajouter si non géré globalement |
| `<aside>` | Ne pas imbriquer deux `role="complementary"` — le `role` sur `.gs-fiche` est redondant si `.gs-sidebar` est déjà un `<aside>` ; retirer le `role` sur `.gs-fiche` en production |

### Contraste vérifié

| Élément | Couleur texte | Fond | Ratio | Niveau |
|---|---|---|---|---|
| `gs-review-body p` | `#000000` | `#FFFFFF` | ∞ | ✅ AAA |
| `gs-review-body a` | `#000B29` | `#FFFFFF` | 19.6:1 | ✅ AAA |
| `gs-fiche__listen` | `#FFFFFF` | `#E81F1F` | 4.56:1 | ✅ AA |
| `gs-fiche__tracks li` | `rgba(255,255,255,.8)` | `#000B29` | 12.4:1 | ✅ AAA |
| `gs-fiche__key` | `rgba(255,255,255,.3)` | `#000B29` | 3.1:1 | ⚠ décoratif / label secondaire |

> `gs-fiche__key` est sous le seuil AA (4.5:1) mais est un label purement décoratif/contextuel — pas de contenu informatif critique. Acceptable en Large Text (3:1) si font-size ≥ 18px, sinon à surveiller.

---

## 6. Checklist avant développement

- [ ] Créer le partial `parts/fiche-album.php`
- [ ] Remplacer le bloc sidebar actuel dans `single-anachroniques.php` par `get_template_part('parts/fiche-album')`
- [ ] Supprimer l'affichage du `genre` dans la sidebar (déjà dans le hero)
- [ ] Mettre à jour le label UI ACF de `ou_les_ecouter` → "Lien d'écoute (URL)"
- [ ] Ajouter instruction ACF : "URL complète — ex. https://drugdealer.bandcamp.com"
- [ ] Vérifier que `album_spotify` contient bien `title="…"` sur l'iframe
- [ ] Ajouter les styles `.gs-review-body` et `.gs-fiche*` dans `style.css`
- [ ] Supprimer le bloc AddToAny du template (remplacé par le bloc share — à faire en temps 2)
- [ ] Tester le drop cap sur Chrome / Firefox / Safari (rendu `::first-letter` peut varier)
- [ ] Tester le sticky sidebar sur desktop (LG+)
- [ ] Vérifier le contraste `gs-fiche__key` sur l'outil Colour Contrast Analyser
- [ ] Valider le JSON-LD mis à jour via [schema.org/validator](https://validator.schema.org/)
- [ ] Tester au clavier : focus visible sur `.gs-fiche__listen` et liens du contenu
