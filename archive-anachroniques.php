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
<main role="main">
    <?php
        echo do_shortcode('[smartslider3 slider="3"]');
    ?>
    <div class="container min-vh-100">
        <div class="mt-4 mb-4 d-flex justify-content-center">
            <h1 class="single-title">Review</h1>
        </div>
        <div class="row mt-3 mb-3">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-2">
                        <div class="card h-100 ">
                            <a class="c-4" href="<?php the_permalink() ?>">
                                <?php the_post_thumbnail(
                                    'card-square',
                                    [
                                        'class' => 'card-img-top-card-news',
                                        'alt' => ''
                                    ]
                                )
                                ?>
                                <div class="card-body mt-2 mb-2">
                                    <h5 class="card-title"><?php the_title() ?></h5>
                                    <h5 class="card-subtitle mt-2"><?= get_field('labels') ?></h5>
                                    <p class="mt-2"><?= get_field('genre') ?></p>


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
        <h1 class="single-title">Pas de reviews de disponible</h1>
    <?php endif; ?>
    </div>
</main>
<?php get_footer() ?>