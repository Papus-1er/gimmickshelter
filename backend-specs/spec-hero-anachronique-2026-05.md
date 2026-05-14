# Specs — Hero single-anachroniques v3

Maquette de référence : `design-proposals/proposal-hero-anachronique-2026-05.html`
Date : 2026-05-13

---

## 1. Nouveaux champs ACF

Groupe : **Anachroniques personnalisation** (`group_60749d813b67e.json`)
Fichier déjà mis à jour — synchroniser via ACF > Groupes de champs > Synchroniser.

| Champ | Clé ACF | Type | Requis | Notes |
|---|---|---|---|---|
| `image_hero` | `field_6837f1a2b3c4d` | image | non | return_format: url · min 1200px large · fallback thumbnail WP |
| `annee_sortie` | `field_6837f1a2b3c4e` | text | non | maxlength: 4 · placeholder "ex. 2013" |
| `accroche` | `field_6837f1a2b3c4f` | textarea | non | maxlength: 200 · rows: 3 · desktop only |

---

## 2. Patterns PHP — affichage conditionnel

### image_hero — fallback sur thumbnail WP

```php
// Fond du hero : champ ACF ou thumbnail si vide
$gs_hero_bg = get_field( 'image_hero' )
    ?: get_the_post_thumbnail_url( get_the_ID(), 'lrg_size' );
```

```html
<!-- Dans le template -->
<?php if ( $gs_hero_bg ) : ?>
<div class="an-hero__bg" aria-hidden="true">
    <img src="<?php echo esc_url( $gs_hero_bg ); ?>" alt="">
</div>
<?php endif; ?>
```

### annee_sortie — conditionnel strict, pas de bloc vide

```php
$gs_annee = get_field( 'annee_sortie' );
```

```html
<?php if ( $gs_annee ) : ?>
    <span class="an-hero__pill--ghost"><?php echo esc_html( $gs_annee ); ?></span>
<?php endif; ?>
```

> Ne jamais afficher `<span class="an-hero__pill--ghost"></span>` vide.
> Le bloc pills `.an-hero__meta` reste affiché même si `annee_sortie` est vide
> (les pills genre sont toujours présentes).

### accroche — conditionnel strict, pas de bloc vide

```php
$gs_accroche = get_field( 'accroche' );
```

```html
<?php if ( $gs_accroche ) : ?>
    <p class="an-hero__accroche">
        <?php echo esc_html( $gs_accroche ); ?>
    </p>
<?php endif; ?>
```

> `esc_html()` — pas de `wp_kses_post()`, l'accroche est du texte brut sans HTML.

### genre — pills explosées sur '·' (existant, rappel)

```php
$gs_genre = get_field( 'genre' );
if ( $gs_genre ) {
    $gs_pills = array_map( 'trim', explode( '·', $gs_genre ) );
    foreach ( $gs_pills as $gs_pill ) {
        if ( $gs_pill ) {
            echo '<span class="an-hero__pill--ghost">' . esc_html( $gs_pill ) . '</span>';
        }
    }
}
```

---

## 3. Specs SEO

### Balises méta

| Balise | Valeur | Source |
|---|---|---|
| `<title>` | `{Titre album} — {Artiste} · Gimmick Shelter` | `the_title()` + `get_field('labels')` |
| `meta description` | Accroche si renseignée, sinon excerpt WP | `get_field('accroche')` ?: `get_the_excerpt()` |
| `og:title` | Identique `<title>` | — |
| `og:description` | Identique meta description | — |
| `og:image` | Pochette album (`card-square`) | `get_the_post_thumbnail_url('card-square')` |
| `og:type` | `article` | statique |

> `image_hero` n'est PAS utilisée pour l'og:image — la pochette est plus identifiable en partage social.

### JSON-LD — Review + MusicAlbum

Champs à intégrer dans le JSON-LD existant :

```php
[
  '@context'     => 'https://schema.org',
  '@type'        => 'Review',
  'itemReviewed' => [
    '@type'       => 'MusicAlbum',
    'name'        => get_the_title(),
    'byArtist'    => [ '@type' => 'MusicGroup', 'name' => get_field('labels') ],
    'genre'       => get_field('genre') ?: null,
    // Nouveau :
    'datePublished' => get_field('annee_sortie') ?: null,
  ],
  'author'        => [ '@type' => 'Person', 'name' => get_the_author() ],
  'publisher'     => [ '@type' => 'Organization', 'name' => 'Gimmick Shelter' ],
  'datePublished' => get_the_date('c'),
  'description'   => get_field('accroche')
                      ?: wp_strip_all_tags( get_the_excerpt() ),
]
```

> `annee_sortie` alimente `MusicAlbum.datePublished` (année de l'album, pas de l'article).
> `accroche` alimente `Review.description` en priorité sur l'excerpt.
> Les deux sont conditionnels — `null` exclut la propriété du JSON-LD.

### H1

Un seul `<h1>` par page : le titre de l'album dans `.an-hero__title`.
L'artiste (`.an-hero__artist`) est un `<p>`, pas un heading.

---

## 4. Specs accessibilité

### Structure sémantique du hero

```html
<section class="an-hero" aria-label="En-tête de la chronique">

  <!-- Image de fond : décorative → aria-hidden + alt vide -->
  <div class="an-hero__bg" aria-hidden="true">
    <img src="..." alt="">
  </div>

  <!-- Overlay + grain : aria-hidden -->
  <div class="an-hero__overlay" aria-hidden="true"></div>
  <div class="an-hero__grain"   aria-hidden="true"></div>

  <div class="an-hero__inner">
    <div class="an-hero__layout">

      <!-- Pochette : alt descriptif -->
      <img class="an-hero__cover"
           src="..."
           alt="Pochette {titre} — {artiste}">

      <div class="an-hero__info">

        <!-- Artiste : <p>, pas de heading -->
        <p class="an-hero__artist">{artiste}</p>

        <!-- H1 unique de la page -->
        <h1 class="an-hero__title">{titre}</h1>

        <!-- Accroche : conditionnel -->
        <?php if ( $gs_accroche ) : ?>
        <p class="an-hero__accroche"><?= esc_html( $gs_accroche ) ?></p>
        <?php endif; ?>

        <!-- Pills : rôle list implicite via flex, pas besoin de <ul> si < 4 items -->
        <div class="an-hero__meta" role="list">
          <span class="an-hero__pill" role="listitem">Chronique</span>
          <!-- pills genre -->
          <?php if ( $gs_annee ) : ?>
          <span class="an-hero__pill--ghost" role="listitem"><?= esc_html( $gs_annee ) ?></span>
          <?php endif; ?>
        </div>

        <!-- Byline -->
        <p class="an-hero__byline">
          Par <?php the_author(); ?> &nbsp;·&nbsp;
          <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('d M Y'); ?></time>
        </p>

      </div>
    </div>
  </div>
</section>
```

### Points de vigilance

| Point | Règle |
|---|---|
| Image de fond (`image_hero`) | `aria-hidden="true"` + `alt=""` — toujours décorative |
| Pochette (`card-square`) | `alt="Pochette {titre} — {artiste}"` — informatif |
| H1 | Un seul par page, dans `.an-hero__title` |
| `<time>` | Attribut `datetime` en ISO 8601 (`get_the_date('c')`) |
| Contraste | Texte blanc sur fond sombre + overlay : ratio ≥ 4.5:1 — vérifié par le gradient |
| Animation | `prefers-reduced-motion` neutralise `an-cover-in` et `an-info-in` |
| Skip link | `#main-content` doit pointer vers `<article>` dans le corps de page (hors hero) |
| `annee_sortie` vide | Aucun `<span>` vide rendu — pas de nœud texte orphelin |
| `accroche` vide | Aucun `<p>` vide rendu |

### Contraste des pills

- `.an-hero__pill` (fond rouge `#E81F1F`, texte blanc) : ratio **4.56:1** ✅ AA
- `.an-hero__pill--ghost` (texte `rgba(255,255,255,.75)` sur fond sombre) : ratio ≥ **5:1** ✅ AA
- `.an-hero__byline` (`rgba(255,255,255,.38)`) : usage informatif secondaire — acceptable en Large Text

---

## 5. Checklist avant développement

- [ ] Synchroniser le groupe ACF (`/wp-admin/edit.php?post_type=acf-field-group`) après pull du JSON
- [ ] Vérifier que `image_hero` s'affiche dans le back-office anachroniques
- [ ] Renseigner les 3 nouveaux champs sur au moins une chronique test
- [ ] Fallback `image_hero` → thumbnail testé sur une chronique sans `image_hero`
- [ ] Vérifier qu'`annee_sortie` vide n'affiche aucun `<span>` résiduel
- [ ] Vérifier qu'`accroche` vide n'affiche aucun `<p>` résiduel
- [ ] JSON-LD valide via [schema.org validator](https://validator.schema.org/)
- [ ] `<h1>` unique confirmé via DevTools
- [ ] Animation neutralisée avec `prefers-reduced-motion: reduce` dans les DevTools
