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
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-P3HZNRJD');</script>
    <!-- End Google Tag Manager -->
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/favicon/manifest.json">
    <meta name="theme-color" content="#ffffff">
    <meta name="robots" content="index, follow" />
    <meta name="author" content="Gimmick Shelter"/>
    <meta name="country" content="FR"/>
    <meta name="language" content="fr"/>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <?php wp_head(); ?>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P3HZNRJD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<header>
    <div class="container-fluid bgc-1">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-4 text-center gs-logo">
                <a href="<?php bloginfo('url'); ?>" aria-label="Gimmick Shelter Logo">
                    <img id="logo" class="img-fluid" src="<?php bloginfo('template_directory'); ?>/img/identity/gimmick-shelter-logo-blanc.svg">
                </a>
            </div>
        </div>
    </div>
    <div class="navigation-wrapper d-none d-lg-block">
        <div class="container-fluid bgc-1">
            <div class="row sticky">
                <div class="col-12">        
                    <nav class="navbar navbar-expand-lg navbar-light" aria-label="main navigation">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <?php wp_nav_menu(
                            [
                                'theme_location' => 'header', 
                                'container' => false,
                                'menu_class' => 'navbar-nav mx-auto mt-2 mt-lg-0'
                            ]) 
                        ?>
                        <!--<?= get_search_form(); ?>-->
                    </div>   
                </nav>     
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile navigation -->
    <div class="d-block d-lg-none">
        <div class="container-fluid bgc-1">
            <div class="row sticky">
                <div class="col-12">        
                    <nav class="navbar navbar-expand-lg navbar-light" aria-label="main navigation">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <?php wp_nav_menu(
                            [
                                'theme_location' => 'header', 
                                'container' => false,
                                'menu_class' => 'navbar-nav mx-auto mt-2 mt-lg-0'
                            ]) 
                        ?>
                        <!--<?= get_search_form(); ?>-->
                    </div>   
                </nav>     
                </div>
            </div>
        </div>
    </div>
</header>


