<?php
/**
 * Header of Gimmick Shelter
 * This is the template that displays all of the <head> section and everything up
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <!-- Consent Mode v2 — doit précéder GTM -->
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('consent', 'default', {
      'analytics_storage':  'denied',
      'ad_storage':         'denied',
      'ad_user_data':       'denied',
      'ad_personalization': 'denied',
      'wait_for_update':    500
    });
  </script>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-P3HZNRJD');</script>
  <!-- End Google Tag Manager -->

  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/favicon/manifest.json">
  <meta name="theme-color" content="#ffffff">

  <meta name="robots" content="index, follow" />
  <meta name="author" content="Gimmick Shelter" />
  <meta name="country" content="FR" />
  <meta name="language" content="fr" />

  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  <?php if ( is_front_page() ) : ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "<?php echo esc_js( get_bloginfo( 'name' ) ); ?>",
    "url": "<?php echo esc_url( home_url( '/' ) ); ?>",
    "potentialAction": {
      "@type": "SearchAction",
      "target": {
        "@type": "EntryPoint",
        "urlTemplate": "<?php echo esc_url( home_url( '/' ) ); ?>?s={search_term_string}"
      },
      "query-input": "required name=search_term_string"
    }
  }
  </script>
  <?php endif; ?>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P3HZNRJD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Modale de consentement -->
<div class="gs-consent" id="gs-consent" role="dialog" aria-modal="true" aria-labelledby="gs-consent__title" aria-hidden="true">
  <div class="gs-consent__box">
    <p class="gs-consent__title" id="gs-consent__title">Vos données, votre choix</p>
    <p class="gs-consent__text">
      Gimmick Shelter utilise des cookies de mesure d'audience pour mieux comprendre comment vous utilisez le site.
      Aucune donnée n'est collectée sans votre accord.
    </p>
    <div class="gs-consent__actions">
      <button class="gs-consent__btn gs-consent__btn--accept" id="gs-consent-accept">Accepter</button>
      <button class="gs-consent__btn gs-consent__btn--refuse" id="gs-consent-refuse">Refuser</button>
    </div>
  </div>
</div>
<!-- Fin modale consentement -->

<?php wp_body_open(); ?>
<a class="skip-link" href="#main-content"><?php esc_html_e( 'Aller au contenu', 'gimmickshelter' ); ?></a>

<header class="gs-header" id="gs-header">

  <!-- Bandeau logo (rouge) -->
  <div class="gs-header__logo-band" id="gs-logo-band">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
       class="gs-header__logo-link"
       aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> — Accueil">
      <h1 class="sr-only"><?php bloginfo( 'name' ); ?></h1>
      <img
        class="gs-header__logo-img"
        src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/identity/gimmick-shelter-logo-blanc.svg"
        alt=""
        width="480"
        height="60"
      >
    </a>
    <p class="gs-header__tagline">Prédicateur rock et indépendant depuis 2021</p>
  </div>

</header><!-- / .gs-header -->

<!-- Barre de navigation noire (sticky — hors <header> pour rester collée au scroll) -->
<div class="gs-header__nav-bar" id="gs-nav-bar">

    <!-- Navigation Desktop -->
    <nav class="gs-nav-desktop" aria-label="Navigation principale">

      <!-- Contenu nav (liens + loupe) — se masque à l'ouverture de la recherche -->
      <div class="gs-nav-desktop__inner" id="gs-nav-desktop-inner">
        <?php
        wp_nav_menu( [
          'theme_location' => 'header',
          'container'      => false,
          'menu_class'     => 'gs-nav-desktop__list',
          'items_wrap'     => '<ul id="%1$s" class="%2$s" role="list">%3$s</ul>',
          'depth'          => 1,
        ] );
        ?>

        <div class="gs-nav-desktop__search">
          <button class="gs-search-icon-btn"
                  id="gs-search-icon-btn"
                  aria-label="Ouvrir la recherche"
                  aria-expanded="false"
                  aria-controls="gs-search-overlay-desktop">
            <i class="fas fa-search" aria-hidden="true"></i>
          </button>
        </div>
      </div>

      <!-- Search overlay pleine largeur (par-dessus la nav desktop) -->
      <div class="gs-search-overlay"
           id="gs-search-overlay-desktop"
           role="search"
           aria-label="Recherche"
           aria-hidden="true">
        <i class="fas fa-search gs-search-overlay__icon" aria-hidden="true"></i>
        <form role="search" method="get" class="gs-search-overlay__form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
          <input class="gs-search-overlay__input"
                 id="gs-search-overlay-input"
                 type="search"
                 name="s"
                 placeholder="<?php esc_attr_e( 'Rechercher sur Gimmick Shelter...', 'gimmickshelter' ); ?>"
                 aria-label="<?php esc_attr_e( 'Recherche', 'gimmickshelter' ); ?>"
                 value="<?php echo esc_attr( get_search_query() ); ?>">
        </form>
        <button class="gs-search-overlay__close"
                id="gs-search-overlay-close"
                aria-label="<?php esc_attr_e( 'Fermer la recherche', 'gimmickshelter' ); ?>">
          <i class="fas fa-times" aria-hidden="true"></i>
        </button>
      </div>

    </nav>

    <!-- Navigation Mobile : loupe + hamburger -->
    <div class="gs-nav-mobile" id="gs-nav-mobile">

      <!-- Boutons au repos -->
      <div class="gs-nav-mobile__inner" id="gs-nav-mobile-inner">
        <button class="gs-search-icon-btn-mobile"
                id="gs-search-icon-btn-mobile"
                aria-label="<?php esc_attr_e( 'Ouvrir la recherche', 'gimmickshelter' ); ?>"
                aria-expanded="false"
                aria-controls="gs-search-overlay-mobile">
          <i class="fas fa-search" aria-hidden="true"></i>
        </button>
        <button class="gs-hamburger"
                id="gs-hamburger-btn"
                aria-label="<?php esc_attr_e( 'Ouvrir le menu', 'gimmickshelter' ); ?>"
                aria-expanded="false"
                aria-controls="gs-mobile-overlay">
          <i class="fas fa-bars" aria-hidden="true"></i>
        </button>
      </div>

      <!-- Search overlay mobile -->
      <div class="gs-search-overlay-mobile"
           id="gs-search-overlay-mobile"
           role="search"
           aria-label="<?php esc_attr_e( 'Recherche', 'gimmickshelter' ); ?>"
           aria-hidden="true">
        <i class="fas fa-search gs-search-overlay-mobile__icon" aria-hidden="true"></i>
        <form role="search" method="get" class="gs-search-overlay-mobile__form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
          <input class="gs-search-overlay-mobile__input"
                 id="gs-search-overlay-mobile-input"
                 type="search"
                 name="s"
                 placeholder="<?php esc_attr_e( 'Rechercher sur Gimmick Shelter...', 'gimmickshelter' ); ?>"
                 aria-label="<?php esc_attr_e( 'Recherche', 'gimmickshelter' ); ?>"
                 value="<?php echo esc_attr( get_search_query() ); ?>">
        </form>
        <button class="gs-search-overlay-mobile__close"
                id="gs-search-overlay-mobile-close"
                aria-label="<?php esc_attr_e( 'Fermer la recherche', 'gimmickshelter' ); ?>">
          <i class="fas fa-times" aria-hidden="true"></i>
        </button>
      </div>

    </div><!-- / .gs-nav-mobile -->

</div><!-- / .gs-header__nav-bar -->

<div class="gs-mobile-overlay"
     id="gs-mobile-overlay"
     role="dialog"
     aria-modal="true"
     aria-label="<?php esc_attr_e( 'Menu de navigation', 'gimmickshelter' ); ?>"
     aria-hidden="true">

  <!-- En-tête overlay : bouton fermeture -->
  <div class="gs-mobile-overlay__header">
    <button class="gs-close-btn"
            id="gs-close-btn"
            aria-label="<?php esc_attr_e( 'Fermer le menu', 'gimmickshelter' ); ?>">
      <i class="fas fa-times" aria-hidden="true"></i>
    </button>
  </div>

  <!-- Liens de navigation -->
  <nav class="gs-mobile-overlay__nav" aria-label="<?php esc_attr_e( 'Menu mobile', 'gimmickshelter' ); ?>">
    <?php
    wp_nav_menu( [
      'theme_location' => 'header',
      'container'      => false,
      'menu_class'     => 'gs-mobile-overlay__list',
      'items_wrap'     => '<ul id="%1$s" class="%2$s" role="list">%3$s</ul>',
      'depth'          => 1,
    ] );
    ?>
  </nav>

  <!-- Pied overlay : réseaux sociaux -->
  <div class="gs-mobile-overlay__footer">
    <?php
    // Liste des réseaux sociaux affichés dans l'overlay mobile.
    // Modifier les URLs ci-dessous quand un compte change.
    $gs_social_links = [
      [
        'url'   => 'https://www.instagram.com/gimmick_shelter/',
        'icon'  => 'fab fa-instagram',
        'label' => __( 'Instagram', 'gimmickshelter' ),
      ],
      [
        'url'   => 'https://www.facebook.com/Gimmick-Shelter-111613287097036',
        'icon'  => 'fab fa-facebook-f',
        'label' => __( 'Facebook', 'gimmickshelter' ),
      ],
      [
        'url'   => 'https://open.spotify.com/user/1113597649?si=1df3fb54c5264e3b',
        'icon'  => 'fab fa-spotify',
        'label' => __( 'Spotify', 'gimmickshelter' ),
      ],
    ];
    ?>
    <ul class="gs-social-links" role="list" aria-label="<?php esc_attr_e( 'Réseaux sociaux', 'gimmickshelter' ); ?>">
      <?php foreach ( $gs_social_links as $gs_social ) : ?>
        <li>
          <a href="<?php echo esc_url( $gs_social['url'] ); ?>"
             target="_blank"
             rel="noopener noreferrer"
             aria-label="<?php echo esc_attr( $gs_social['label'] ); ?>">
            <i class="<?php echo esc_attr( $gs_social['icon'] ); ?>" aria-hidden="true"></i>
            <span class="sr-only"><?php echo esc_html( $gs_social['label'] ); ?></span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

</div><!-- / .gs-mobile-overlay -->
