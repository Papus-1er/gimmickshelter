---
name: design
description: >
  Système de design complet de Gimmick Shelter. Utiliser pour tout travail
  visuel : ajouter un composant, modifier des couleurs, choisir une typo,
  créer un nouveau template, adapter le responsive. Contient les tokens,
  conventions CSS et patterns visuels du thème.
allowed-tools: Read, Grep, Glob, Edit, Write
---

# Design System — Gimmick Shelter

## Identité visuelle
Webzine rock indépendant. Style **coloré / psychédélique** sur fond sombre.
Contraste fort, typographie agressive pour les titres, lecture confortable
pour les articles longs.

---

## 1. Palette de couleurs

| Token CSS    | Valeur      | Nom         | Usage principal                        |
|-------------|-------------|-------------|----------------------------------------|
| `--color1`  | `#E81F1F`   | Rouge GS    | Accents, CTA secondaires, liens actifs |
| `--color2`  | `#000B29`   | Bleu GS     | Fond principal, boutons primaires, navbar |
| `--color3`  | `#FFFFFF`   | Blanc       | Texte principal, liens, icônes         |
| `--color4`  | `#000000`   | Noir        | Fond alternatif, texte sur blanc       |
| `--color5`  | `#6D6D64`   | Khaki Web   | Texte secondaire, auteurs, métadonnées |

### Classes utilitaires disponibles
```css
/* Couleur de texte */
.c-1  → color: #E81F1F
.c-2  → color: #000B29
.c-3  → color: #FFFFFF
.c-4  → color: #000000
.c-5  → color: #6D6D64

/* Couleur de fond */
.bgc-1 → background-color: #E81F1F
.bgc-2 → background-color: #000B29
.bgc-3 → background-color: #FFFFFF
.bgc-4 → background-color: #000000
.bgc-5 → background-color: #6D6D64
```

### Règle d'usage des couleurs
- **Fond de page** → `--color2` (bleu nuit) ou `--color4` (noir)
- **Texte courant** → `--color3` (blanc) sur fond sombre
- **Accent / mise en avant** → `--color1` (rouge) avec parcimonie
- **Texte désactivé / méta** → `--color5` (khaki)
- **Ne jamais** mettre `--color1` en fond sur `--color2` (contraste insuffisant)

---

## 2. Typographie

### Polices
| Rôle        | Police                  | Fallback      |
|-------------|-------------------------|---------------|
| Titres      | **Anton** (Google Font) | `sans-serif`  |
| Corps/UI    | **Roboto** (Google Font)| `sans-serif`  |

### Hiérarchie typographique
```css
/* Titres → Anton (impact, condensé, rock) */
h1, h2, h3, h4, h5, h6 {
  font-family: 'Anton', sans-serif;
  font-weight: 400; /* Anton n'a qu'une graisse */
}

/* Corps de texte → Roboto */
body, p, li {
  font-family: 'Roboto', sans-serif;
  font-size: 1.15rem;
  line-height: 1.6;
  letter-spacing: 0.05rem;
}

p { text-align: justify; }
```

### Classes de titre article (responsive)
```css
.single-title    → Anton, 2em, font-weight 400
.single-subtitle → Roboto, 24-28px, font-weight 600
.single-author   → Roboto, 18-22px, color: --color5
```

### Tailles responsive des titres article
| Breakpoint | `.single-subtitle` | `.single-author` |
|------------|--------------------|------------------|
| Mobile (< 768px) | 24px | 18px |
| MD (≥ 768px) | 24px | 18px |
| LG (≥ 992px) | 28px | 20px |
| XL (≥ 1200px) | 28px | 22px |

---

## 3. Composants

### Cards articles
Deux variantes principales :

**`.card`** — card Bootstrap standard (fond blanc, bordure)
```css
/* Hauteur image fixe pour homogénéité de la grille */
.card-img-top-card-news { height: 350px; object-fit: cover; }
.card-title    → 1.25rem, font-weight 400, letter-spacing .025rem
.card-subtitle → Roboto, .875rem, font-weight 400
```

**`.gs-card`** — card overlay (image plein format + texte superposé)
```css
.gs-card          → flex, overflow: hidden, position: relative
.gs-card-img      → 100% width/height, object-fit: cover
                    transition: transform 0.3s ease (zoom au hover)
.gs-card:hover .gs-card-img → transform: scale(1.1)
.gs-card-img-overlay → gradient noir bas→transparent haut
.gs-card-title    → blanc 80% opacité, 2rem
.gs-overlay-text  → padding 1rem, border-radius 5px
.card-label       → badge absolu top-right, fond noir 70%, blanc
```

**Effet hover Anachronique** (section homepage)
```css
.anachronique:hover .image-anachronique → opacity: 0.3
.anachronique:hover .position-text      → opacity: 1
/* Transition 0.5s ease sur les deux */
```

### Boutons
```css
/* Bouton primaire GS */
.btn-gs-primary {
  color: #fff;
  background-color: var(--color2);  /* Bleu GS */
  border-color: var(--color2);
}
.btn-gs-primary:hover → fond bleu GS conservé, texte blanc
```

### Navigation
```css
/* Hamburger mobile → icône blanche */
.navbar-light .navbar-toggler       → border: --color3
.navbar-light .navbar-toggler-icon  → SVG stroke blanc
```

### Header `.gs-header`

Header global du site, composé d'un bandeau rouge (logo + tagline desktop) et
d'une barre noire sticky qui contient la navigation. Documentation détaillée
des classes : `docs/technique/css.md`. Comportement JS : `docs/technique/fonctions.md`.

**Sous-éléments**

| Bloc | Classes principales |
|---|---|
| Bandeau logo | `.gs-header__logo-band`, `.gs-header__logo-link`, `.gs-header__logo-img`, `.gs-header__tagline` |
| Barre nav sticky | `.gs-header__nav-bar` |
| Nav desktop (≥ LG) | `.gs-nav-desktop`, `.gs-nav-desktop__inner`, `.gs-nav-desktop__list`, `.gs-search-icon-btn` |
| Nav mobile (< LG) | `.gs-nav-mobile`, `.gs-nav-mobile__inner`, `.gs-hamburger`, `.gs-search-icon-btn-mobile` |
| Search overlays | `.gs-search-overlay`, `.gs-search-overlay-mobile` (+ `__icon`, `__form`, `__input`, `__close`) |
| Menu overlay mobile | `.gs-mobile-overlay`, `.gs-mobile-overlay__header`, `.gs-mobile-overlay__nav`, `.gs-mobile-overlay__list`, `.gs-mobile-overlay__footer`, `.gs-close-btn` |
| Réseaux sociaux | `.gs-social-links` |

**États**

| État | Marqueur |
|---|---|
| `sticky` | barre nav fixée en haut au-delà du seuil de scroll |
| `scrolled` | classe `is-scrolled` → bascule sur `--gs-nav-bg-scrolled` + `--gs-nav-border-scrolled` |
| `search-open` | `aria-hidden="false"` sur l'overlay + `aria-expanded="true"` sur le bouton loupe ; le contenu de la nav (desktop ou mobile) se masque |
| `mobile-menu-open` | `aria-hidden="false"` sur `#gs-mobile-overlay`, `<body>` scroll-locké, focus trap actif |

**Variables CSS dédiées** (à utiliser plutôt que des hex en dur)

| Variable | Valeur | Rôle |
|---|---|---|
| `--gs-nav-bg` | `var(--color4)` | Fond barre nav repos |
| `--gs-nav-bg-scrolled` | `var(--color2)` | Fond barre nav après scroll |
| `--gs-nav-border-scrolled` | `var(--color1)` | Bordure d'accent en mode scrollé |
| `--gs-nav-height` | `52px` | Hauteur de la barre nav |
| `--gs-placeholder` | `#949489` | Placeholder des inputs de recherche |
| `--gs-divider-soft` | `rgba(255,255,255,0.05)` | Filet discret (overlay) |
| `--gs-divider-medium` | `rgba(255,255,255,0.08)` | Filet plus marqué (overlay) |

**Accessibilité**

- L'overlay menu mobile est un `role="dialog" aria-modal="true"` avec focus
  trap et fermeture par Escape.
- Le logo n'a pas de `alt` textuel : le lien parent porte un `aria-label`
  explicite et un `<h1 class="sr-only">` accompagne l'image.
- Toutes les transitions sont neutralisées sous `prefers-reduced-motion`.

### Related (cards de recommandation)

Section de rebond éditorial affichée en pied de single (ex. « D'autres
playlists » dans `single-playlists.php`). Documentation détaillée des classes :
`docs/technique/css.md` ; intégration template : `docs/technique/templates.md`.

**Sous-éléments**

| Classe | Rôle |
|---|---|
| `.gs-related` | Wrapper de la section. |
| `.gs-related__head` | Ligne titre + CTA (titre à gauche, lien archive à droite). |
| `.gs-related__title` | `<h2>` de section ; le mot accent en `<em>` passe en `var(--color1)`. |
| `.gs-related__all` | Lien CTA vers l'archive du CPT. |
| `.gs-related__list` | `<ul role="list">` des cards (3 items). |

Chaque `<li>` rend une `.gs-card` cliquable (réutilisation des classes
`.gs-card`, `.gs-card-img`, `.gs-card-img-overlay`, `.gs-card-title`,
`.gs-card-sub` déjà décrites plus haut). Image carrée, overlay sombre bas →
transparent haut, sous-titre tronqué à 2 lignes.

**Variables CSS dédiées**

| Variable | Valeur | Rôle |
|---|---|---|
| `--gs-overlay-card` | `rgba(0, 0, 0, 0.85)` | Couleur d'arrivée du gradient d'overlay des cards image |

> Règle DS : pour tout overlay sombre de card image, utiliser
> `--gs-overlay-card` plutôt qu'un `rgba(0,0,0,…)` en dur.

**États**

| État | Marqueur |
|---|---|
| `focus-visible` | outline / bordure rouge GS (`var(--color1)`) sur cards et CTA |
| Hover CTA | seule la bordure passe en rouge GS (texte inchangé pour respecter AA à 0.9rem) |
| `reduced-motion` | transitions neutralisées sous `prefers-reduced-motion` |

**Accessibilité**

- Card entière en `<a>` avec `aria-label` descriptif (« Playlist : titre — sous-titre »).
- `<ul role="list">` pour conserver la sémantique de liste même quand le CSS retire les puces.
- Un seul tab-stop par card.

### Pagination
```css
.page-item.gs-active .page-link {
  background-color: var(--color2);
  border-color: var(--color2);
  color: #fff;
}
```

### Liens
```css
a          → color: --color3 (blanc), no underline
a:hover    → color: --color3, no underline
.gs-link   → color: --color2 (bleu), underline  /* liens dans contenu */
```

### Barre de progression lecture
```css
#progress-bar {
  position: fixed; top: 0; left: 0;
  height: 4px;
  background: #000B29;  /* Bleu GS */
  z-index: 999;
}
```

### Bouton retour en haut
```css
#back-to-top {
  position: fixed; bottom: 32px; right: 32px;
  width/height: 50px;
  background: --color3 (blanc);
  color: --color4 (noir);
  border: 1px solid --color4;
  font-size: 32px;
  z-index: 99;
}
```

### Icônes SVG
```css
.svg-icon         → 2rem × 2rem
.svg-icon path    → fill: #FFFFFF
.svg-icon circle  → stroke: #4691f6
```

---

## 4. Breakpoints responsive

```css
/* Mobile first */
@media (max-width: 768px)  { /* SM — mobile   */ }
@media (min-width: 768px)  { /* MD — tablette */ }
@media (min-width: 992px)  { /* LG — desktop  */ }
@media (min-width: 1200px) { /* XL — large    */ }
```

### Comportement `.border-right` / `.border-left`
- Mobile + MD : supprimés (`border: 0`)
- LG + XL : `0.5px solid #dee2e6`

### `.sticky` sidebar
- Mobile/MD : désactivé
- LG+ : `position: sticky; top: 2rem`

---

## 5. Accessibilité

```css
/* Élément visuellement masqué mais lisible par les screen readers */
.sr-only {
  position: absolute;
  height: 1px; width: 1px;
  overflow: hidden;
  clip: rect(1px,1px,1px,1px);
}
```
Toujours utiliser `.sr-only` pour les labels cachés, pas `display:none`.

---

## 6. Règles à respecter

- **Ne jamais** utiliser `!important` sauf pour les utilitaires `.c-*` et `.bgc-*` (déjà en place)
- **Ne jamais** écrire de styles inline dans les templates PHP
- **Toujours** utiliser les variables CSS (`var(--color1)` etc.) plutôt que les hex en dur
- **Toujours** tester le rendu sur mobile avant de committer un nouveau composant
- Les nouvelles couleurs doivent être ajoutées dans `:root` avec un nom sémantique
- Tout nouveau composant suit la convention BEM : `.bloc__element--modificateur`

---

## 7. Ajouter un nouveau composant — checklist

1. Nommer en BEM (ex: `.review-card`, `.review-card__note`, `.review-card--featured`)
2. Utiliser les variables `--color*` existantes
3. Polices : Anton pour les titres, Roboto pour le reste
4. Ajouter les breakpoints si le composant change de layout
5. Documenter dans ce fichier si le composant est réutilisable
