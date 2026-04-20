<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */

?>
<footer>
                <!-- BREADCRUMB of Homepage -->
                <div class="container-fluid bgc-2 d-none d-md-blok d-lg-block">
        <nav aria-label="fil d'ariane">
            <div id="breadcrumb" class="breadcrumb">
            <?php
                if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb( '<div class="container-fluid"><div id="breadcrumbs">','</div></div>' );
                    }
            ?> 
            </div>
        </nav>
    </div>
    <div class="container-fluid bgc-1">
    
        <div class="row">
            <div class="col-lg-2">
                <div class="gs-logo d-none d-lg-block">
                    <a class="" href="<?php bloginfo('url'); ?>" aria-label="Gimmick Shelter Logo">
                        <img id="logo" src="<?php bloginfo('template_directory'); ?>/img/identity/gimmick-shelter-logo-blanc.svg">
                        <span class="sr-only">Gimmick Shelter site officiel</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-8 justify-horizontal-center">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <nav aria-label="<?php esc_attr_e('Footer Menu', 'gimmickshelter'); ?>" class="justify-horizontal-center mt-2">
                        <?php wp_nav_menu(
                            [
                                'theme_location' => 'footer',
                                'container' => false,
                                'menu_class' => 'gs-list'
                            ]
                        )
                        ?>
                                                    <div class="ml-md-3"> 
                            <ul class="gs-social-network d-flex">
                        <li class="m-3">
                            <a href="https://www.facebook.com/Gimmick-Shelter-111613287097036" aria-label="Suivez-nous sur Facebook" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="m-3">
                            <a href="https://www.instagram.com/gimmick_shelter/" aria-label="Suivez-nous sur Instagram" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li class="m-3">
                            <a href="https://open.spotify.com/user/1113597649?si=1df3fb54c5264e3b" aria-label="Suivez-nous sur Spotify" target="_blank">
                                <i class="fab fa-spotify"></i>
                            </a>
                        </li>
                    </ul>
                            </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <hr class="d-sm-block d-md-block d-lg-none d-xl-none">
                <div class="gs-logo d-sm-block d-md-block d-lg-none d-xl-none">
                    <a class="" href="<?php bloginfo('url'); ?>" aria-label="Gimmick Shelter Logo">
                        <img id="logo" src="<?php bloginfo('template_directory'); ?>/img/identity/gimmick-shelter-logo-blanc.svg">
                        <span class="sr-only">Gimmick Shelter site officiel</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/main.js" id="main-js"></script>
<script src="https://kit.fontawesome.com/57ecc208be.js" crossorigin="anonymous"></script>
</body>

</html>