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
echo do_shortcode('[smartslider3 slider="7"]');
?>
    <div class="container min-vh-100 mt-5 mb-5">
        <div class="mt-3 mb-3">
            <h1 class="single-title"><?php the_title() ?></h1>
        </div>
        <?php the_content() ?>
    </div>
</main>
<?php get_footer() ?>