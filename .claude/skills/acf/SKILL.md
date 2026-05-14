# Skill : Advanced Custom Fields (ACF)

## Déclenchement

Utiliser pour tout ce qui concerne les champs ACF : lecture/affichage de champs, création de nouveaux groupes, modification des groupes existants, synchronisation JSON.

## Groupes ACF actifs

| Fichier JSON | Groupe | Post type | Champs |
|---|---|---|---|
| `group_60733c8c2a3d1.json` | Articles personnalisation | `post` | `subtitle_post`, `image_masthead` |
| `group_60749d813b67e.json` | Anachroniques personnalisation | `anachroniques` | `labels`, `note_generale` (sur 5) |
| `group_6074a29c11e53.json` | Playlists personnalisation | `playlists` | `sous-titre-playlist` |

## Règles d'usage

- Toujours utiliser `get_field('nom_du_champ')` ou `the_field('nom_du_champ')` dans les templates
- Ne jamais utiliser `get_post_meta()` à la place d'ACF pour les champs enregistrés dans les groupes
- Pour les champs d'image ACF : utiliser le format `array` et extraire `$image['url']`, `$image['alt']`
- Les fichiers `acf-json/*.json` sont la source de vérité — synchronisés automatiquement par ACF à la sauvegarde

## Exemple d'affichage de champ

```php
// Champ texte simple
$subtitle = get_field('subtitle_post');
if ($subtitle) {
    echo '<p class="subtitle">' . esc_html($subtitle) . '</p>';
}

// Champ note (anachroniques)
$note = get_field('note_generale');
echo '<span class="note">' . intval($note) . '/5</span>';
```

## Ajouter un nouveau groupe ACF

1. Créer le groupe via l'interface WordPress ACF
2. ACF génère automatiquement le JSON dans `acf-json/`
3. Ne jamais modifier les fichiers JSON manuellement sauf pour des corrections légères
4. Après modification en base, forcer la synchronisation depuis ACF > Groupes de champs

## Fichiers concernés

- `acf-json/` — groupes synchronisés
- `single-anachroniques.php` — utilise `labels`, `note_generale`
- `single-playlists.php` — utilise `sous-titre-playlist`
- `single-post.php` — utilise `subtitle_post`, `image_masthead`
