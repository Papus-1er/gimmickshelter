# CSS — composants custom

Documentation des composants CSS hors Bootstrap / hors design-system de base.
Le DS principal (palette, typo, breakpoints) est documenté dans
`.claude/skills/design/SKILL.md`. Ce fichier liste les composants concrets
ajoutés à `style.css`.

---

## Variables CSS du header

Définies dans `:root` de `style.css` :

| Variable | Valeur par défaut | Usage |
|---|---|---|
| `--gs-nav-bg` | `var(--color4)` (noir) | Fond de la barre nav au repos |
| `--gs-nav-bg-scrolled` | `var(--color2)` (bleu GS) | Fond de la barre nav après scroll |
| `--gs-nav-border-scrolled` | `var(--color1)` (rouge GS) | Bordure d'accent en mode scrollé |
| `--gs-nav-height` | `52px` | Hauteur de la barre nav (sert au calcul du sticky et des overlays) |
| `--gs-placeholder` | `#949489` | Couleur du placeholder dans les inputs de recherche |
| `--gs-divider-soft` | `rgba(255, 255, 255, 0.05)` | Filets discrets (séparateurs en overlay) |
| `--gs-divider-medium` | `rgba(255, 255, 255, 0.08)` | Filets un peu plus marqués |

> Règle DS : ne jamais utiliser un `rgba(255,255,255,...)` en dur — passer par
> ces variables ou en créer une nouvelle si besoin.

---

## Variables CSS des cards image

Définies dans `:root` de `style.css` :

| Variable | Valeur par défaut | Usage |
|---|---|---|
| `--gs-overlay-card` | `rgba(0, 0, 0, 0.85)` | Couleur d'arrivée du gradient d'overlay des cards image (bas → transparent haut) |

> Règle DS : pour tout overlay sombre sur une card image, utiliser
> `--gs-overlay-card` plutôt qu'un `rgba(0,0,0,…)` en dur.

---

## Composant : Header `.gs-header`

### Sous-éléments

| Classe | Rôle |
|---|---|
| `.gs-header` | Wrapper global du header (bandeau + barre nav). |
| `.gs-header__logo-band` | Bandeau rouge contenant logo et tagline. |
| `.gs-header__logo-link` | Lien autour du logo, porte le nom accessible. |
| `.gs-header__logo-img` | Image SVG du logo. |
| `.gs-header__tagline` | Tagline desktop (masquée en mobile). |
| `.gs-header__nav-bar` | Barre noire sticky qui contient la nav. |

### Nav desktop

| Classe | Rôle |
|---|---|
| `.gs-nav-desktop` | Conteneur de la nav desktop (≥ LG). |
| `.gs-nav-desktop__inner` | Bloc liens + loupe ; se masque quand la search desktop est ouverte. |
| `.gs-nav-desktop__list` | `<ul>` du menu WordPress `header`. |
| `.gs-nav-desktop__search` | Wrapper du bouton loupe. |
| `.gs-search-icon-btn` | Bouton loupe (desktop). |

### Nav mobile

| Classe | Rôle |
|---|---|
| `.gs-nav-mobile` | Conteneur de la nav mobile (< LG). |
| `.gs-nav-mobile__inner` | Bloc loupe + hamburger ; se masque quand la search mobile est ouverte. |
| `.gs-search-icon-btn-mobile` | Bouton loupe (mobile). |
| `.gs-hamburger` | Bouton hamburger qui ouvre l'overlay mobile. |

### Search overlays

| Classe | Rôle |
|---|---|
| `.gs-search-overlay` | Overlay de recherche desktop (par-dessus la nav). |
| `.gs-search-overlay__icon` | Icône loupe décorative. |
| `.gs-search-overlay__form` | `<form>` GET vers `home_url('/')`. |
| `.gs-search-overlay__input` | Input `name="s"`. |
| `.gs-search-overlay__close` | Bouton fermeture (croix). |
| `.gs-search-overlay-mobile` (+ sous-éléments `__icon`, `__form`, `__input`, `__close`) | Variante mobile, recouvre la barre nav. |

### Overlay menu mobile

| Classe | Rôle |
|---|---|
| `.gs-mobile-overlay` | Dialog plein écran (`role="dialog" aria-modal="true"`). |
| `.gs-mobile-overlay__header` | Zone supérieure avec bouton fermeture. |
| `.gs-close-btn` | Bouton fermeture du menu mobile. |
| `.gs-mobile-overlay__nav` | Conteneur sémantique du menu. |
| `.gs-mobile-overlay__list` | Liste des liens (menu WP `header`). |
| `.gs-mobile-overlay__footer` | Pied avec liens sociaux. |
| `.gs-social-links` | Liste des liens sociaux (menu WP `social-network`). |

### États

Les états sont pilotés par JS (cf. `docs/technique/fonctions.md`) via classes
ou attributs ARIA :

| État | Marqueur |
|---|---|
| Scrolled | classe `is-scrolled` sur le header / la nav-bar |
| Search ouverte | `aria-hidden="false"` sur l'overlay + `aria-expanded="true"` sur le bouton |
| Menu mobile ouvert | `aria-hidden="false"` sur `#gs-mobile-overlay` ; le `<body>` reçoit un scroll-lock |

### Reduced motion

Toutes les transitions du header sont neutralisées sous
`@media (prefers-reduced-motion: reduce)`.

---

## Composant : Related `.gs-related` (cards de recommandation)

Section de rebond éditorial affichée en pied de single (utilisée par
`single-playlists.php`). Voir `docs/technique/templates.md` pour l'intégration.

### Sous-éléments

| Classe | Rôle |
|---|---|
| `.gs-related` | Wrapper de la section (header + liste). |
| `.gs-related__head` | Ligne d'en-tête : titre `<h2>` à gauche, CTA à droite. |
| `.gs-related__title` | `<h2>` de section ; le mot accent en `<em>` passe en rouge GS. |
| `.gs-related__all` | Lien CTA vers l'archive du CPT (« Voir toutes les playlists → »). |
| `.gs-related__list` | `<ul role="list">` de 3 `<li>` ; supprime puces et marges, met en grille. |

### Cards

La section réutilise les classes `.gs-card`, `.gs-card-img`,
`.gs-card-img-overlay`, `.gs-card-title`, `.gs-card-sub` (déjà documentées dans
le SKILL design). Spécifique à cette section :

- Card entière en `<a>` avec `aria-label` descriptif.
- Image **carrée** (`object-fit: cover`).
- Overlay : gradient `from var(--gs-overlay-card) to transparent` (bas → haut).
- `.gs-card-sub` tronqué à 2 lignes (`-webkit-line-clamp: 2`).

### États

| État | Marqueur |
|---|---|
| Focus visible (card ou CTA) | `:focus-visible` → outline / bordure rouge GS (`var(--color1)`) |
| Hover CTA | seule la **bordure** passe en rouge GS — la couleur du texte ne change pas, pour préserver le contraste AA à 0.9rem |
| Reduced motion | `@media (prefers-reduced-motion: reduce)` neutralise les transitions de la section (zoom de l'image, transitions du CTA) |

---

## Composant : Skip link `.skip-link`

Lien d'évitement injecté par `header.php` juste après `wp_body_open()`. Premier
élément focusable de toutes les pages. Commun à l'ensemble du site.

| Comportement | Détail |
|---|---|
| Au repos | `position: absolute; top: -100%` — invisible à l'écran |
| Au focus clavier | `top: 0` — apparaît en haut à gauche, fond rouge GS, texte blanc |
| Cible | `href="#main-content"` — l'élément portant cet ID doit exister dans le template |

> Chaque template single doit poser `id="main-content"` sur son élément de
> contenu principal (`<article>` ou `<main>`).

---

## Composant : Single Anachroniques `an-*`

Ensemble de classes préfixées `an-` pour le template `single-anachroniques.php`.
**Scope** : `.single-anachroniques` (body class WP automatique pour ce CPT) —
aucun risque de collision avec les autres templates.

### Variables locales

Aucune variable CSS propre — le composant consomme les variables globales du DS :
`--color1` (rouge), `--color2` (bleu nuit), `--color3` (blanc), `--color5`
(khaki), `--gs-overlay-card`. Un token local `#0c0c10` (surface sombre du hero)
est la seule valeur en dur acceptable ici (pas de variable globale équivalente).

### Sous-éléments — Hero

| Classe | Rôle |
|---|---|
| `.an-hero` | Section hero plein-largeur, `min-height: min(72vh, 560px)`, fond `#0c0c10` |
| `.an-hero__bg` | Div `position: absolute; inset: 0` contenant l'img de fond |
| `.an-hero__bg img` | Image floutée `blur(8px) saturate(.75) brightness(.8)`, `scale(1.05)` pour éviter les bords blancs |
| `.an-hero__overlay` | Gradient directionnel `160deg` bleu nuit → surface sombre |
| `.an-hero__inner` | Conteneur centré `max-width: 1200px`, animation `an-fade-up` à l'entrée |
| `.an-hero__back` | Lien retour archive, `::before '←'`, hover blanc |
| `.an-hero__artist` | Champ `labels`, capitales Roboto, rouge GS |
| `.an-hero__title` | `clamp(3rem, 7vw, 6rem)`, Anton, blanc |
| `.an-hero__meta` | Ligne de métadonnées flex-wrap, couleur `rgba(255,255,255,.62)` |
| `.an-hero__pill` | Badge plein rouge GS (type de contenu) |
| `.an-hero__pill--ghost` | Badge contour blanc semi-transparent (genres) |

### Sous-éléments — Corps

| Classe | Rôle |
|---|---|
| `.an-body` | Wrapper fond blanc `var(--color3)`, `max-width: 1200px`, centré |
| `.an-body__grid` | CSS Grid `1fr 320px`, gap `4rem` |
| `.an-article__content` | Conteneur du `the_content()` : `font-size: 1.06rem`, `line-height: 1.8` |
| `.an-article__content p` | `max-width: 68ch`, espacement `1.5em` bas |
| `.an-article__content > p:first-of-type::first-letter` | Drop-cap Anton rouge, `font-size: 4.2rem` |
| `.an-article__content a` | Liens inline en bleu nuit `var(--color2)`, soulignés ; hover rouge `var(--color1)` |
| `.an-share` | Flex row, barre de partage AddToAny, bordure haute |
| `.an-share__label` | Étiquette Anton uppercase khaki |
| `.an-back-link` | Lien retour inférieur, `::before '←'`, khaki → rouge hover |

### Sous-éléments — Aside

| Classe | Rôle |
|---|---|
| `.an-aside` | Flex column, gap `1.5rem` ; sticky `top: 74px` au-dessus de 992px |
| `.an-aside__cover` | Conteneur carré `aspect-ratio: 1`, `box-shadow` douce |
| `.an-aside__spotify` | Wrapper iframe, fond gris clair `#f5f5f5`, bordure légère |
| `.an-aside__sheet` | Fiche technique, fond `var(--color2)`, `border-left: 3px solid var(--color1)` |
| `.an-aside__sheet h4` | Label "Fiche", Anton, rouge GS, uppercase |
| `.an-aside__row` | Ligne clé/valeur, séparateur bas `rgba(255,255,255,.07)` |
| `.an-aside__key` | Étiquette de champ, 0.58rem, uppercase, khaki |
| `.an-aside__val` | Valeur de champ, 0.85rem, blanc, bold |

### Overrides Related

La section related réutilise `.gs-related` / `.gs-card` (voir section dédiée).
Deux overrides scoped `.single-anachroniques` :

| Règle | Pourquoi |
|---|---|
| `.single-anachroniques .gs-related { padding, border-top }` | Harmonise l'espacement avec le corps blanc |
| `.single-anachroniques .gs-related .gs-card-img-overlay { justify-content: flex-start; text-align: left }` | Aligne le texte à gauche (le composant `.gs-related` global centre pour les playlists) |

### Responsive

| Breakpoint | Comportement |
|---|---|
| ≤ 1024px (tablette) | Grid `1fr 280px`, gap réduit à `2.5rem` |
| ≤ 768px (mobile) | Grid `1fr` (colonne unique), aside `position: static`, pochette centrée `max-width: 280px`, related en colonne unique, cards `aspect-ratio: 4/3` |
| ≤ 480px (petit mobile) | Titre hero `2.4rem`, meta en colonne, paddings réduits |

### Animation

`@keyframes an-fade-up` : fadeUp sur `.an-hero__inner` à l'affichage (`.6s`, délai `.1s`).
Neutralisée sous `@media (prefers-reduced-motion: reduce)`.

---

## Conventions

- BEM strict : `.bloc__element--modificateur`.
- Pas de hex en dur dans les `rgba` — utiliser ou créer une variable
  (`--gs-divider-*`, `--gs-placeholder`…).
- Hauteur du header pilotée par `--gs-nav-height` ; ne pas la coder en dur
  ailleurs (offset sticky, calcul d'overlay…).
