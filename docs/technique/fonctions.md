# Fonctions JS / PHP — Gimmick Shelter

Toutes les fonctions custom (PHP et JS) sont préfixées `gs_`. Ce fichier
documente les fonctions non triviales — pas celles dont la signature suffit.

---

## JS — `js/main.js`

Module qui pilote le comportement du header (scroll, menu mobile, recherche).
Les fonctions ne sont pas exportées ; elles vivent dans le scope du fichier et
sont câblées sur des IDs documentés dans `docs/technique/templates.md`.

### Scroll

| Fonction | Rôle |
|---|---|
| `gs_handleScroll()` | Listener `scroll` sur `window`. Au-delà du seuil, ajoute la classe `is-scrolled` au header / nav-bar pour basculer sur les variables `--gs-nav-bg-scrolled` et `--gs-nav-border-scrolled`. |

### Menu mobile

| Fonction | Rôle |
|---|---|
| `gs_openMobileMenu()` | Ouvre `#gs-mobile-overlay` : bascule `aria-hidden`, met `aria-expanded="true"` sur le hamburger, verrouille le scroll du `<body>`, donne le focus au premier élément focusable et active le focus trap. |
| `gs_closeMobileMenu()` | Symétrique : ferme l'overlay, libère le scroll, restaure `aria-expanded="false"`, redonne le focus au bouton hamburger. |
| `gs_trapFocus(event)` | Listener `keydown` filtrant `Tab` / `Shift+Tab` à l'intérieur de l'overlay tant qu'il est ouvert. Évite que le focus ne sorte du dialog. |

### Recherche

Deux paires d'ouverture/fermeture, une par viewport. Elles partagent la même
logique : toggle d'`aria-hidden` sur l'overlay, d'`aria-expanded` sur le
bouton, focus auto sur l'input à l'ouverture, restauration du focus sur le
bouton à la fermeture.

| Fonction | Rôle |
|---|---|
| `gs_openSearchDesktop()` | Ouvre `#gs-search-overlay-desktop` et masque visuellement `.gs-nav-desktop__inner`. |
| `gs_closeSearchDesktop()` | Ferme l'overlay desktop et restaure la nav. |
| `gs_openSearchMobile()` | Ouvre `#gs-search-overlay-mobile` (par-dessus la barre nav). |
| `gs_closeSearchMobile()` | Ferme l'overlay mobile. |

### Gestionnaire global Escape

Un listener `keydown` global sur `document` écoute la touche **Escape** et
ferme dans l'ordre, si ouvert : la search desktop, la search mobile, l'overlay
menu mobile. Empêche le double-traitement quand plusieurs surfaces sont
empilées.

### Reduced motion

Le module détecte `window.matchMedia('(prefers-reduced-motion: reduce)')` et
court-circuite les éventuelles animations JS (les transitions CSS sont
également désactivées via media query).

---

## PHP

Pas de nouvelle fonction PHP introduite par cette livraison. Les fonctions
existantes restent dans `functions.php` avec le préfixe `gs_`.
