# Templates — Gimmick Shelter

Documentation des templates et partials notables. Ce fichier ne re-décrit pas la
hiérarchie standard WordPress — uniquement les templates qui méritent une
explication (structure, points d'entrée JS/CSS, dépendances).

---

## `header.php`

Template global du `<head>` et de l'en-tête de site. Inclut le JSON-LD du site,
le header visuel (logo + nav) et l'overlay mobile plein écran.

### Structure HTML

```
<header.gs-header id="gs-header">
├── .gs-header__logo-band#gs-logo-band      ← bandeau rouge avec logo + tagline
│   ├── a.gs-header__logo-link              ← lien vers home (h1.sr-only + img)
│   └── p.gs-header__tagline                ← visible desktop uniquement
└── .gs-header__nav-bar#gs-nav-bar          ← barre noire sticky
    ├── nav.gs-nav-desktop                  ← visible ≥ LG
    │   ├── .gs-nav-desktop__inner#gs-nav-desktop-inner
    │   │   ├── ul.gs-nav-desktop__list     ← menu WP `header`
    │   │   └── .gs-nav-desktop__search > button#gs-search-icon-btn
    │   └── .gs-search-overlay#gs-search-overlay-desktop  ← recouvre la nav
    └── .gs-nav-mobile#gs-nav-mobile        ← visible < LG
        ├── .gs-nav-mobile__inner > [loupe + hamburger]
        └── .gs-search-overlay-mobile#gs-search-overlay-mobile

<div.gs-mobile-overlay#gs-mobile-overlay role="dialog" aria-modal="true">
├── .gs-mobile-overlay__header > button#gs-close-btn
├── nav.gs-mobile-overlay__nav > ul.gs-mobile-overlay__list   ← menu WP `header`
└── .gs-mobile-overlay__footer > ul.gs-social-links            ← menu WP `social-network`
```

### Menus WordPress consommés

| Emplacement | Rendu | Profondeur |
|---|---|---|
| `header` | Nav desktop **et** liste de l'overlay mobile (deux rendus) | 1 |
| `social-network` | Footer de l'overlay mobile | 1 |

### Données structurées

Sur la front-page uniquement, un JSON-LD `WebSite` avec `SearchAction`
(`SiteLinksSearchBox`) est injecté avant `wp_head()`. La cible utilise
`?s={search_term_string}`.

### Points d'entrée JS

Le header est piloté par `js/main.js`. Les IDs servent de hooks d'attachement :

| ID | Rôle |
|---|---|
| `gs-header` | racine, reçoit la classe `is-scrolled` |
| `gs-nav-bar` | barre noire sticky |
| `gs-search-icon-btn` / `gs-search-overlay-desktop` / `gs-search-overlay-input` / `gs-search-overlay-close` | recherche desktop |
| `gs-search-icon-btn-mobile` / `gs-search-overlay-mobile` / `gs-search-overlay-mobile-input` / `gs-search-overlay-mobile-close` | recherche mobile |
| `gs-hamburger-btn` / `gs-mobile-overlay` / `gs-close-btn` | menu overlay mobile |

### États visuels

| État | Marqueur | Déclencheur |
|---|---|---|
| Sticky scrolled | `.gs-header.is-scrolled` (ou équivalent sur `#gs-nav-bar`) | scroll au-delà du seuil — `gs_handleScroll` |
| Search desktop ouverte | `aria-expanded="true"` sur le bouton + `aria-hidden="false"` sur l'overlay | `gs_openSearchDesktop` |
| Search mobile ouverte | idem côté mobile | `gs_openSearchMobile` |
| Menu mobile ouvert | `aria-hidden="false"` sur `#gs-mobile-overlay` + body scroll-lock | `gs_openMobileMenu` |

### Accessibilité

- Le `<h1>` du nom du site est en `.sr-only` dans le bandeau logo (n'apparaît
  qu'aux lecteurs d'écran).
- L'image logo a `alt=""` car le lien parent porte déjà un `aria-label`
  explicite — évite la duplication du nom accessible.
- L'overlay mobile est un `role="dialog" aria-modal="true"` avec focus trap
  (`gs_trapFocus`) et fermeture par Escape.
- Les animations respectent `prefers-reduced-motion` (cf. `style.css`).

### Dépendances CSS / JS

- CSS : section "Header GS" de `style.css` + variables `--gs-nav-*`,
  `--gs-placeholder`, `--gs-divider-*`. Voir `docs/technique/css.md`.
- JS : `js/main.js` (fonctions `gs_*` documentées dans
  `docs/technique/fonctions.md`).
- Icônes : Font Awesome 5.6.3 (chargé en CDN dans le `<head>`).

---

## `single-anachroniques.php`

Template du single du CPT `anachroniques` (chroniques d'albums). Redesigné en
mai 2026 — maquette validée : `design-proposals/proposal-single-review-v2-2026-05.html`.

### Structure HTML

```
<main role="main" id="site-main">
├── #progress-bar [role="progressbar"]
│
├── (boucle WP — 1 post)
│   ├── <script type="application/ld+json">  ← JSON-LD Review + MusicAlbum
│   │
│   ├── section.an-hero                      ← hero fond album flouté
│   │   ├── .an-hero__bg > img               ← thumbnail lrg_size, décoratif (alt="")
│   │   ├── .an-hero__overlay                ← gradient sombre
│   │   └── .an-hero__inner
│   │       ├── a.an-hero__back              ← lien archive anachroniques
│   │       ├── .an-hero__artist             ← get_field('labels')
│   │       ├── h1.an-hero__title            ← the_title()
│   │       └── .an-hero__meta
│   │           ├── span.an-hero__pill       ← "Chronique"
│   │           ├── span.an-hero__pill--ghost × N ← genres explosés sur '·'
│   │           └── span                     ← get_the_date('d M Y')
│   │
│   └── .an-body
│       └── .an-body__grid (1fr 320px)
│           ├── article#main-content         ← cible du skip link
│           │   ├── .an-article__content     ← the_content() + drop-cap CSS
│           │   ├── .an-share                ← AddToAny a2a_kit
│           │   └── a.an-back-link           ← lien archive anachroniques
│           │
│           └── aside.an-aside (sticky ≥ 992px)
│               ├── .an-aside__cover         ← the_post_thumbnail('card-square')
│               ├── .an-aside__spotify       ← get_field('album_spotify') via wp_kses_post()
│               └── .an-aside__sheet         ← fiche fond var(--color2)
│                   ├── h4 "Fiche"
│                   ├── .an-aside__row  genre        ← get_field('genre')
│                   ├── .an-aside__row  best_tracks  ← get_field('best_tracks')
│                   └── .an-aside__row  ou_les_ecouter ← get_field('ou_les_ecouter')
│
├── section.gs-related                       ← related (réutilise composant playlist)
│   └── .gs-related__inner
│       ├── header.gs-related__head
│       │   ├── h2.gs-related__title         ← « D'autres <em>chroniques</em> »
│       │   └── a.gs-related__all            ← archive CPT anachroniques
│       └── ul.gs-related__list role="list"
│           └── li × 3
│               └── a.gs-card [aria-label]
│                   ├── img.gs-card-img      ← thumbnail card-square
│                   └── .gs-card-img-overlay
│                       ├── p.gs-card-sub    ← get_field('labels')
│                       └── h3.gs-card-title ← the_title()
│
├── button#back-to-top
└── <script> progress bar JS
```

### Champs ACF utilisés

| Champ | Emplacement | Rendu | Conditionnel |
|---|---|---|---|
| `labels` | Hero + related | artiste / label info | oui |
| `genre` | Hero pills + fiche | explosé sur `·` dans le hero, brut dans la fiche | oui |
| `best_tracks` | Fiche sidebar | texte brut | oui |
| `ou_les_ecouter` | Fiche sidebar | texte brut | oui |
| `album_spotify` | Sidebar | `wp_kses_post()` — iframe Spotify | oui |

> Tous les blocs ACF sont protégés par `if ( $champ )` — aucun élément vide
> n'est rendu si le champ n'est pas renseigné.

### Tailles d'images utilisées

| Contexte | Taille | Pourquoi |
|---|---|---|
| Hero background | `lrg_size` (1200px, sans crop) | Image pleine largeur, pas de contrainte de ratio |
| Sidebar pochette | `card-square` (500×500, crop) | Conteneur carré `aspect-ratio: 1` |
| Related cards | `card-square` (500×500, crop) | Cards carrées dans `.gs-card` |

### JSON-LD

Injecté dans le `<body>` via `echo` dans la boucle WP, avant la section hero.
Structure : `Review` > `itemReviewed : MusicAlbum` > `byArtist : MusicGroup`.
La note (`note_generale`) n'est pas incluse dans le JSON-LD (retirée de l'affichage
par choix éditorial).

```php
[
  '@type'        => 'Review',
  'itemReviewed' => [ '@type' => 'MusicAlbum', 'name' => ..., 'byArtist' => [...] ],
  'author'       => [ '@type' => 'Person', 'name' => get_the_author() ],
  'publisher'    => [ '@type' => 'Organization', 'name' => 'Gimmick Shelter' ],
  'datePublished'=> get_the_date('c'),
  'description'  => wp_strip_all_tags( get_the_excerpt() ),
]
```

### Requête related

- CPT `anachroniques`, 3 posts, `orderby => rand`.
- `post__not_in => [get_the_ID()]` — exclut le post courant.
- `wp_reset_postdata()` appelé après la boucle.
- `get_the_ID()` utilisé après `endwhile; endif;` : valide sur un single (le
  global `$post` conserve le dernier post de la boucle principale).

### Progress bar

Scoped rouge via `.single-anachroniques #progress-bar { background: var(--color1) }`.
Le JS (IIFE en bas de template) écoute `scroll` en `{ passive: true }` et
met à jour `style.width` + `aria-valuenow`.

### Accessibilité

- Skip link global (`header.php`) pointe vers `#main-content` sur `<article>`.
- `aria-hidden="true"` sur l'image de fond et l'overlay du hero (décoratifs).
- `alt=""` sur l'image de fond hero ; `alt` dynamique sur la pochette sidebar
  et les cards related (`titre — labels`).
- `aria-label` sur toutes les sections, l'aside, et les cards related.
- `focus-visible` rouge GS sur toutes les interactions (cf. style.css section
  « SINGLE ANACHRONIQUES »).
- Animations neutralisées sous `prefers-reduced-motion`.

### Dépendances CSS

Section « SINGLE ANACHRONIQUES » de `style.css`. Préfixe `an-`, scopé
`.single-anachroniques`. Voir `docs/technique/css.md`.

---

## `single-playlists.php`

Template du single du CPT `playlists`. Documentation limitée ici à la **section
related** ajoutée en bas de page (le reste suit la structure standard d'un single
WordPress).

### Section `.gs-related` — « D'autres playlists »

Affichée en pied du single, sous le contenu principal, avant le footer. Sert de
rebond éditorial vers d'autres playlists publiées.

```
<section class="gs-related">
├── .gs-related__head
│   ├── h2.gs-related__title         ← « D'autres <em>playlists</em> »
│   └── a.gs-related__all             ← « Voir toutes les playlists → »
└── ul.gs-related__list role="list"
    └── li × 3 → parts/card-related-playlist.php
        └── a.gs-card[aria-label="Playlist : <titre> — <sous-titre>"]
            ├── img.gs-card-img        ← pochette (alt = titre)
            ├── .gs-card-img-overlay   ← gradient sombre bas → transparent
            └── .gs-overlay-text
                ├── h3.gs-card-title
                └── p.gs-card-sub      ← sous-titre, tronqué à 2 lignes
```

### Données et requête

- WP_Query sur le CPT `playlists`.
- `posts_per_page = 3`.
- `post__not_in = [ get_the_ID() ]` — exclut la playlist courante.
- `no_found_rows = true` et `ignore_sticky_posts = true` — pas de pagination
  ni de tri sticky utile ici, gain de perf.
- Ordre : par défaut (`date DESC`).
- Sous-titre : champ ACF `sous-titre-playlist` (cf. `CLAUDE.md`).
- Lien CTA : `get_post_type_archive_link( 'playlists' )`.

### Partial `parts/card-related-playlist.php`

Inclus via `get_template_part( 'parts/card-related-playlist' )` à l'intérieur
de la boucle. Rend une `<li>` complète avec une `.gs-card` cliquable
(`<a>` qui englobe l'image, l'overlay et le bloc texte). L'`aria-label`
de l'ancre porte le nom accessible complet ; les enfants n'ont pas besoin
d'être individuellement focusables.

### Accessibilité

- Liste sémantique `<ul role="list">` (le `role="list"` force le rendu
  sémantique même quand le CSS retire les puces).
- Card entière en `<a>` : un seul tab-stop par card.
- `:focus-visible` rouge GS sur les cards et le CTA.
- Transitions neutralisées sous `prefers-reduced-motion`.
- Contraste AA respecté sur le CTA à 0.9rem en restreignant le hover à la
  bordure (le texte ne change pas de couleur).

### Dépendances CSS

Section "Related Playlists" de `style.css` (vers ligne 1370+). Variable
nouvelle : `--gs-overlay-card`. Voir `docs/technique/css.md`.

---

## `front-page.php`

Hérite du header standard. Le seul comportement spécifique côté template
global est l'injection du JSON-LD `WebSite` dans `header.php` lorsque
`is_front_page()` est vrai.
