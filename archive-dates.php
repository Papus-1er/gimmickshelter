<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */

get_header() ?>
<?php if (have_posts()) : ?>
    <main role="main">
        <?php
            echo do_shortcode('[smartslider3 slider="4"]');
        ?>
        <div class="container min-vh-100">
            <div class="mt-4 mb-4 d-flex justify-content-center">
                <h1 class="single-title">Agenda</h1>
            </div>
            <div class="row mt-2">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                        <div class="gs-card h-100 gs-overlay-card position-relative">
                            <a class="c-4" href="<?php the_permalink() ?>">
                                <?php the_post_thumbnail(
                                    'card-square',
                                    [
                                        'class' => 'gs-card-img img-fluid',
                                        'alt' => '',
                                        'loading' => 'lazy'
                                    ]
                                )
                                ?>
                                <div class="gs-card-img-overlay d-flex align-items-end justify-content-center text-left">
                                    <div class="gs-overlay-text p-3">
                                        <h2 class="card-title c-3 mb-2"><?php the_title() ?></h5>
                                        <h3 class="card-subtitle c-3 mt-2 mb-2"><?= get_field('sous-titre-playlist') ?></h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endwhile ?>
            </div>
                <div class="row justify-content-center">
                    <?php echo gimmickshelter_pagination(); ?>
                </div>
            <?php else : ?>
                <h1 class="single-title">Pas de Playlists de disponible</h1>
            <?php endif; ?>
        </div>
    </main>
    <?php get_footer() ?>