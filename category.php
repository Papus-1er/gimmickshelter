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
<div class="ml-3">
    <h1><?= esc_html(get_queried_object()->name) ?></h1>
    <p><?= esc_html(get_queried_object()->description) ?></p>
</div>
<div class="container min-vh-100">
    <?php $categories = get_terms(['taxonomy' => 'category']); ?>
    <ul class="nav nav-pills my-4">
        <?php foreach ($categories as $category) : ?>
            <li class="nav-item">
                <a href="<?= get_term_link($category) ?>" class="nav-link <?= is_tax('category', $category->term_id) ? 'active' : '' ?>"><?= $category->name ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php if (have_posts()) : ?>
        Bonjour a tous : <?php wp_title(); ?> - category aaa
        <div class="row">
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card h-100">
                        <a href="<?php the_permalink() ?>">
                            <?php the_post_thumbnail(
                                'card-square',
                                [
                                    'class' => 'card-img-top-card-news',
                                    'alt' => ''
                                ]
                            )
                            ?>
                            <div class="card-body mt-2">
                                <h5 class="card-title"><?php the_title() ?></h5>
                                <h5 class="card-subtitle mt-2"><?= get_field('subtitle_post') ?></h5>
                                <p class="card-text"><small class="text-muted"><?php the_date() ?> - <?php the_author() ?></small></p>
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
        <h1 class="single-title">Pas d'articles de disponible</h1>
    <?php endif; ?>
</div>
</main>
<?php get_footer() ?>