# Skill : Theme CSS

## Déclenchement

Utiliser pour tout travail sur les styles du thème : modifier `style.css`, travailler avec Bootstrap, ajouter des composants visuels, corriger des problèmes de mise en page.

## Architecture CSS

```
style.css           → Styles principaux du thème (éditables)
css/bootstrap.css   → Bootstrap 4 source (ne pas modifier)
css/bootstrap.min.css → Bootstrap 4 minifié (utilisé en prod)
```

## Table des matières de style.css

1. Normalize
2. Accessibility
3. Alignments
4. Clearings
5. Typography
6. Forms
7. Formatting
8. Lists
9. Tables
10. Links
11. Featured Image Hover
12. Navigation
13. Layout

## Règles de style

- Bootstrap 4 est la base : utiliser les classes utilitaires Bootstrap en priorité
- Les styles custom vont dans `style.css` à la section appropriée
- Nommage des classes custom : BEM (`bloc__element--modifier`)
- Ne jamais modifier les fichiers dans `css/` (Bootstrap) — ils seraient écrasés lors d'une mise à jour
- Pas de build tool : éditer directement `style.css`
- Responsive : mobile-first avec les breakpoints Bootstrap (`sm`, `md`, `lg`, `xl`)

## Breakpoints Bootstrap 4

| Nom | Largeur |
|-----|---------|
| xs | < 576px |
| sm | ≥ 576px |
| md | ≥ 768px |
| lg | ≥ 992px |
| xl | ≥ 1200px |

## Enqueue dans WordPress

Les styles sont chargés via `gimmickshelter_register_assets()` dans `functions.php` :
- Bootstrap enregistré avec le handle `bootstrap`
- Style du thème chargé avec `wp_enqueue_style('gimmickshelter-style', get_stylesheet_uri())`
