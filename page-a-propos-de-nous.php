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
    <div class="container min-vh-100 mt-5 mb-5">
        <div class="mt-3 mb-3">
            <h1 class="single-title"><?php the_title() ?></h1>
        </div>
        <?php the_content() ?>
        <h2 class="single-title">Notre équipe</h2>
        <div class="row mt-3 mb-3">
            <div class="col-md-6 col-lg-4 mb-2">
                <div class="card">
                    <img class="card-img-top-card-news" loading="lazy" src="<?= get_field('about_us_photo_1') ?>" alt="Florent Froideval">
                    <div class="card-body mt-2 mb-2">
                        <h3 class="card-title">Florent Froideval</h3>
                        <h4 class="card-subtitle mt-2 mb-2">Fondateur et rédacteur en chef</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-2">
                <div class="card">
                    <img class="card-img-top-card-news" loading="lazy" src="<?= get_field('about_us_photo_2') ?>" alt="Adrien Masseron">
                    <div class="card-body mt-2 mb-2">
                        <h3 class="card-title">Adrien Masseron</h3>
                        <h5 class="card-subtitle mt-2 mb-2">Co-fondateur et webmaster</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer() ?>