# Skill : WordPress

## Déclenchement

Utiliser ce skill pour toute tâche liée au core WordPress du thème Gimmick Shelter : template hierarchy, hooks, enqueue d'assets, CPT, taxonomies, WP_Query, menus, shortcodes, widgets.

## Contexte projet

- Thème custom pur PHP WordPress, pas de page builder
- CPT actifs : `playlists`, `anachroniques`, `dates`
- Menus : `header`, `footer`, `social-network`
- `functions.php` centralise tous les hooks et enregistrements

## Conventions à respecter

- Préfixer toutes les fonctions par `gimmickshelter_` pour éviter les conflits
- Utiliser `wp_enqueue_scripts` pour les assets (jamais de `<link>` ou `<script>` en dur dans les templates)
- Toujours utiliser `get_template_part()` pour inclure les partials de `parts/`
- Utiliser `get_template_directory_uri()` pour les URLs d'assets, jamais de chemin en dur
- WP_Query : toujours appeler `wp_reset_postdata()` après une boucle secondaire

## Template hierarchy Gimmick Shelter

```
front-page.php      → Page d'accueil
home.php            → Liste des articles (blog)
single-post.php     → Article standard
single-{cpt}.php    → CPT singles
archive-{cpt}.php   → CPT archives
page-{slug}.php     → Pages avec template dédié
category.php        → Archives de catégorie
taxonomy.php        → Archives de taxonomie
search.php          → Résultats de recherche
404.php             → Page non trouvée
```

## Fichiers clés

- `functions.php` — hooks, supports, enqueue, CPT
- `header.php` / `footer.php` — structure globale
- `parts/` — cards réutilisables
- `walker/CommentWalker.php` — rendu des commentaires
