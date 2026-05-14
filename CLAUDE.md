# Gimmick Shelter — CLAUDE.md

## Projet

Site WordPress du webzine musical **Gimmick Shelter**, thème custom développé par Adrien Masseron.

## Stack technique

- **CMS** : WordPress 5.x
- **Thème** : Custom (ce répertoire)
- **CSS Framework** : Bootstrap 4 (css/ + js/)
- **Champs personnalisés** : Advanced Custom Fields (ACF) — groupes stockés dans `acf-json/`
- **Formulaires** : Ninja Forms
- **Slider** : Smart Slider 3
- **SEO** : Yoast SEO

## Architecture du thème

```
gimmickshelter/
├── acf-json/          # Groupes ACF synchronisés (ne pas éditer manuellement)
├── css/               # Bootstrap + styles compilés
├── js/                # Bootstrap bundle + main.js + infinite-scroll.js
├── parts/             # Partials : card-news, card-playlists, card-anachronique, card-ymal
├── template/          # Templates secondaires (content-search)
├── walker/            # CommentWalker.php
├── functions.php      # Enregistrement assets, supports, CPT, hooks
├── style.css          # Styles principaux + header thème WordPress
├── header.php / footer.php / sidebar.php
├── front-page.php     # Page d'accueil
├── home.php           # Blog
├── single-post.php    # Article standard
├── single-anachroniques.php
├── single-playlists.php
├── single-dates.php
├── archive-anachroniques.php
├── archive-playlists.php
├── archive-dates.php
├── page-a-propos-de-nous.php
├── page-calendrier.php
└── 404.php / search.php / category.php / taxonomy.php
```

## Custom Post Types

| CPT | Single | Archive | Description |
|-----|--------|---------|-------------|
| `playlists` | `single-playlists.php` | `archive-playlists.php` | Playlists musicales |
| `anachroniques` | `single-anachroniques.php` | `archive-anachroniques.php` | Chroniques d'albums |
| `dates` | `single-dates.php` | `archive-dates.php` | Agenda / concerts |

## Champs ACF

| Groupe | Post type | Champs clés |
|--------|-----------|-------------|
| Articles personnalisation | `post` | `subtitle_post`, `image_masthead` |
| Anachroniques personnalisation | `anachroniques` | `labels`, `note_generale` |
| Playlists personnalisation | `playlists` | `sous-titre-playlist` |

## Tailles d'images personnalisées

| Nom | Dimensions | Crop |
|-----|-----------|------|
| `card-landscape` | 350×215 | oui |
| `card-square` | 500×500 | oui |
| `sml_size` | 300px largeur | non |
| `mid_size` | 600px largeur | non |
| `lrg_size` | 1200px largeur | non |
| `sup_size` | 2400px largeur | non |

## Menus WordPress enregistrés

- `header` — En-tête du menu
- `footer` — Pied de page
- `social-network` — Liens réseaux sociaux

## Workflows agents

### Frontend — modification de l'UI
```
/designer → /redacteur → /seo → /accessibilite → /developer → /review → /documentation
```

### Backend — modification des données
```
/backend → /seo → /accessibilite → /developer → /review → /documentation
```

### Complet — nouvelle rubrique ou page entière
```
/backend (spec) → /designer (maquette) → /redacteur → /seo → /accessibilite → /developer → /review → /documentation
```

Chaque agent attend une validation explicite avant de passer la main au suivant.

## Conventions de code

- PHP natif WordPress (pas de framework PHP)
- Pas de build tool / Webpack — les assets sont déjà compilés dans `css/` et `js/`
- **Préfixe des fonctions** : `gs_` (PHP et JS) — court, cohérent dans tout le projet
- Nommage BEM pour les classes CSS custom : `.bloc__element--modifier`
- Les partials de cards sont dans `parts/`, inclus via `get_template_part()`
- ACF : toujours utiliser `get_field()` / `the_field()`, jamais `get_post_meta()` directement
- Variables CSS du DS (`var(--color1..5)`) toujours préférées aux hex en dur — y compris dans les `rgba()` (créer une variable de divider/overlay si besoin)

## Dossiers de travail des agents

| Dossier | Agent producteur | Contenu |
|---------|-----------------|---------|
| `backend-specs/` | `/backend` | Specs techniques validées (CPT, ACF, hooks) |
| `design-proposals/` | `/designer` | Maquettes HTML, SVG, propositions DS |
| `docs/` | `/documentation` | Documentation technique et guides |

## Environnement local

- Serveur : WampServer (`wamp64`)
- Chemin absolu thème : `/Users/adrien/Desktop/TRANSFERT/wamp64/www/wp-content/themes/gimmickshelter/`
- Config WordPress : `wp-config.php` à la racine de `www/`
