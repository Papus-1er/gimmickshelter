# Changelog — Gimmick Shelter

<!-- Généré et maintenu par l'agent /documentation après chaque review approuvée -->

## 2026-05-12 — Refonte de `single-anachroniques.php` + skip link global

**Type** : feat + fix

**Ce qui a changé**

### Template `single-anachroniques.php`
- Réécriture complète du template. L'ancienne structure Bootstrap `.container` / `.row` / `.col-*` est remplacée par une mise en page CSS Grid personnalisée.
- Hero plein-largeur avec fond album flouté (blur 8px), overlay gradient, titre Anton XXL, pills de genre. La pochette est retirée du hero — elle n'apparaît qu'en sidebar.
- Corps blanc (`var(--color3)`) en grid 2 colonnes (`1fr 320px`) : article à gauche, aside sticky à droite.
- Drop-cap rouge (Anton 4.2rem) sur le premier paragraphe de l'article.
- Aside : pochette carrée (`card-square`) + iframe Spotify (champ `album_spotify`) + fiche technique sur fond bleu nuit (`var(--color2)`) avec bordure gauche rouge.
- Champs ACF utilisés : `labels`, `genre`, `best_tracks`, `ou_les_ecouter`, `album_spotify`. Tous conditionnels — aucun affichage si champ vide.
- Section related redesignée : remplace les `.card` Bootstrap blanches par le composant `.gs-card` / `.gs-related` (identique à `single-playlists.php`). Titre « D'autres chroniques », CTA archive, 3 cards aléatoires.
- JSON-LD `Review` + `MusicAlbum` injecté directement dans la boucle WP.
- Progress bar réinitialisée en rouge (`var(--color1)`) via `.single-anachroniques #progress-bar`.
- Responsive complet : tablette (≤ 1024px), mobile (≤ 768px), très petit écran (≤ 480px). Aside en `position: static` sous 992px.

### Header — skip link
- Ajout d'un lien skip link `<a class="skip-link" href="#main-content">` injecté juste après `wp_body_open()` dans `header.php`.
- Masqué hors focus (CSS `top: -100%`), visible uniquement à la navigation clavier.
- Styles définis dans `style.css` (section "Skip Link"). Commun à toutes les pages.

### Bugs corrigés
- `note_generale` (note /10) n'était pas affiché — retiré volontairement du nouveau design par choix éditorial.
- `prochain_concert` n'était pas affiché — retiré volontairement du nouveau design.
- Section related utilisait `.card` Bootstrap (fond blanc sur fond sombre) — remplacée par `.gs-card` cohérente avec le design system.

**Fichiers modifiés**
- `single-anachroniques.php` — réécriture complète.
- `style.css` — sections « Skip Link » et « Single Anachroniques » ajoutées en fin de fichier.
- `header.php` — 1 ligne : skip link après `wp_body_open()`.

**Impact utilisateur**
- Visiteur : page de chronique redesignée, hero immersif, article sur fond blanc, fiche bleue, related cohérente.
- Visiteur clavier : premier tab sur la page atteint le skip link, puis le contenu principal.
- Éditeur : aucun changement de back-office. Les champs ACF existants (`labels`, `genre`, `best_tracks`, `ou_les_ecouter`, `album_spotify`) sont utilisés tels quels.

**À retenir**
- Le scope `.single-anachroniques` (body class WP automatique) isole tout le CSS du template — aucun risque de régression sur les autres pages.
- La taille `card-square` (500×500, crop) est à utiliser pour tout affichage de pochette dans un conteneur carré.
- Pour tout nouveau single CPT, réutiliser `.gs-related` / `.gs-card` pour la section related.

---

## 2026-05-10 — Section « D'autres playlists » sur le single playlist

**Type** : feat

**Ce qui a changé**
- Nouvelle section `.gs-related` en bas de `single-playlists.php` : remplace l'ancienne section "Consultez nos autres playlists".
- Header de section : `<h2>D'autres <em>playlists</em></h2>` (le mot "playlists" passe en rouge GS via `<em>`) + CTA `Voir toutes les playlists →` pointant vers l'archive du CPT `playlists`.
- Liste sémantique `<ul role="list"><li>` avec 3 cards `.gs-card` (image carrée + overlay sombre bas → transparent haut).
- Card entière en `<a>` avec `aria-label` descriptif (`Playlist : titre — sous-titre`), `alt` sur la pochette, `<h3>` titre + sous-titre tronqué à 2 lignes.
- WP_Query optimisée : `no_found_rows`, `ignore_sticky_posts`, exclusion du post courant.
- Nouveau partial `parts/card-related-playlist.php`.
- Nouvelle variable CSS `--gs-overlay-card: rgba(0, 0, 0, 0.85)` pour l'overlay des cards image.
- Nouveaux composants CSS : `.gs-related`, `.gs-related__head`, `.gs-related__title`, `.gs-related__all`, `.gs-related__list` (réutilise les `.gs-card*` existants).
- `:focus-visible` rouge GS sur cards et CTA, transitions neutralisées sous `prefers-reduced-motion`.
- Hover du CTA : seule la bordure passe en rouge (pour respecter le contraste AA à 0.9rem).

**Fichiers modifiés**
- `single-playlists.php` — ancienne section "related" remplacée par la nouvelle section `.gs-related`.
- `style.css` — nouvelle section "Related Playlists" (vers ligne 1370+) + déclaration de `--gs-overlay-card` dans `:root`.
- `parts/card-related-playlist.php` — créé.

**Impact utilisateur**
- Visiteur : en bas de chaque playlist, trois autres playlists du CPT proposées avec image, titre, sous-titre et lien vers l'archive complète.
- Éditeur : aucun changement de back-office. Les cards utilisent automatiquement les 3 dernières playlists publiées (hors playlist courante).

**À retenir**
- Pour tout nouvel overlay sombre sur une card image, utiliser `--gs-overlay-card` plutôt qu'un `rgba(0,0,0,…)` en dur.
- La règle DS « pas de hex / `rgba` en dur, créer une variable » s'applique aussi aux overlays de cards, pas seulement aux dividers du header.

---

## 2026-05-10 — Réseaux sociaux en dur dans `header.php`

**Type** : refactor

**Ce qui a changé**
- Remplacement de l'appel `wp_nav_menu( 'social-network' )` dans l'overlay mobile par une liste PHP en dur (`$gs_social_links`) avec icônes Font Awesome.
- Liens : Instagram, Twitter, Facebook, Spotify — chacun avec `target="_blank"`, `rel="noopener noreferrer"`, `aria-label` et `<span class="sr-only">` pour l'accessibilité.

**Pourquoi**
- L'emplacement de menu `social-network` était mal configuré côté WP (pointait vers les liens "À propos / Contact").
- `wp_nav_menu()` n'a aucun mécanisme natif pour transformer une URL en icône Font Awesome.
- Solution la plus simple : tableau PHP éditable directement dans le template.

**Fichiers modifiés**
- `header.php` — bloc `.gs-mobile-overlay__footer`.

**Impact utilisateur**
- Visiteur mobile : icônes Instagram, Twitter, Facebook, Spotify visibles en pied de l'overlay menu.
- Éditeur : pour changer une URL, modifier le tableau `$gs_social_links` en haut du bloc dans `header.php` (commentaire en place dans le code). Ne plus utiliser l'emplacement de menu `social-network` (peut être retiré de WP Admin).

**À retenir**
- Quand l'objectif est purement visuel (icônes uniformes sur des URLs fixes), un tableau PHP en dur est plus simple et plus robuste qu'un menu WP qui demande des libellés HTML et la capacité `unfiltered_html`.

---

## 2026-05-10 — Hotfix : menu mobile sans style

**Type** : fix

**Ce qui a changé**
- Correction du `wp_nav_menu` de l'overlay mobile dans `header.php` : `items_wrap` passe de `'%3$s'` à `'<ul id="%1$s" class="%2$s" role="list">%3$s</ul>'`.
- Sans `<ul>` wrapper, les `<li>` étaient orphelins et tous les sélecteurs CSS `.gs-mobile-overlay__list li` / `.gs-mobile-overlay__list a` étaient sans cible → menu mobile rendu avec le style navigateur par défaut.

**Fichiers modifiés**
- `header.php` — une ligne (`items_wrap` du menu mobile).

**Impact utilisateur**
- Visiteur mobile : le menu plein écran récupère son style (Anton 2rem, animation cascade des liens, hover rouge, état actif).

**À retenir**
- Avec WordPress, ne jamais utiliser `'items_wrap' => '%3$s'` quand le CSS cible des sélecteurs descendants d'un `<ul>` parent.

---

## 2026-05-09 — Nouveau header complet

**Type** : feat

**Ce qui a changé**
- Réécriture complète de `header.php` : bandeau rouge avec logo et tagline desktop ("Prédicateur rock et indépendant depuis 2021"), barre de navigation noire sticky.
- Recherche fonctionnelle (auparavant commentée) avec deux overlays distincts : desktop (par-dessus la nav) et mobile (par-dessus la barre noire).
- Menu mobile plein écran avec liens de navigation et bloc réseaux sociaux en pied.
- Focus trap sur le menu mobile + prise en compte de `prefers-reduced-motion`.
- Ajout d'un JSON-LD `WebSite` + `SiteLinksSearchBox` injecté en front-page.
- Corrections SEO / a11y dans le header historique : suppression du double `wp_head`, retrait des commentaires conditionnels IE, `alt` du logo géré côté `aria-label` du lien, libellés `aria-label` traduits en français.
- Section "Header GS" ajoutée à `style.css` (~660 lignes) et trois nouvelles variables CSS de placeholder/divider.
- Nouvelles fonctions JS `gs_*` dans `main.js` pour gérer scroll, menu mobile et recherche.
- Préfixe des fonctions PHP/JS clarifié à `gs_` dans `CLAUDE.md`.

**Fichiers modifiés**
- `header.php` — réécriture complète.
- `style.css` — section "Header GS" + variables `--gs-placeholder`, `--gs-divider-soft`, `--gs-divider-medium`, `--gs-nav-*`.
- `js/main.js` — gestion du header (scroll, menu mobile, recherche, focus trap, Escape).
- `CLAUDE.md` — préfixe des fonctions clarifié à `gs_`.

**Impact utilisateur**
- Visiteur : nouveau header avec recherche accessible depuis toutes les pages (desktop et mobile).
- Éditeur : aucun changement de back-office. Le menu `header` et le menu `social-network` continuent d'alimenter les liens (le menu `header` est rendu deux fois, en desktop et dans l'overlay mobile).
