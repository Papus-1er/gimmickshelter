<?php

/**
 * The template for displaying all single posts
 * 
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */

get_header() ?>
<main role="main">
    <div id="progress-bar"></div>
    <div class="container mt-5 mb-5 min-vh-100">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="row">
                    <div class="col-12">
                        <h1 class="single-title d-flex justify-content-center"><?php the_title() ?></h1>
                        <h2 class="single-subtitle d-flex justify-content-center mb-4"><?= get_field('labels') ?></h2>
                    </div>
                    <div class="col-sm-12 col-lg-8">
                        <!--<a href="<?php bloginfo('url'); ?>/anachroniques/" id="go-back"><i class="fa-solid fa-arrow-left" aria-label="Retour en arrière"></i></a>-->
                        <!--<p class="single-author"><?php the_date() ?> - <?php the_author() ?></p>-->
                        <?php the_content() ?>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <div class="row sticky">
                            <div class="col-sm-12 col-md-6 col-lg-12">
                                <div class="mb-3">
                                    <?php the_post_thumbnail(
                                        'card-fullsize',
                                        [
                                            'class' => 'gs-card-img img-fluid',
                                            'alt' => '',
                                            'loading' => 'lazy'
                                        ]
                                    )
                                    ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <?= get_field('album_spotify') ?>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-12">
                                <ul class="bgc-2 p-4">
                                    <li style="list-style:none;">
                                        <p class="c-3">Genre : <?= get_field('genre') ?></p>
                                    </li>
                                    <li style="list-style:none;">
                                        <p class="c-3">Best tracks : <?= get_field('best_tracks') ?></p>
                                    </li>
                                    <li style="list-style:none;">
                                        <p class="c-3">Où les écouter : <?= get_field('ou_les_ecouter') ?></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="mt-2 mb-2">
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                <a class="a2a_button_facebook m-1"></a>
                                <a class="a2a_button_twitter m-1"></a>
                                <a class="a2a_button_whatsapp m-1"></a>
                                <a class="a2a_button_email m-1"></a>
                                <a class="a2a_button_sms m-1"></a>
                            </div>
                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mb-4 d-flex justify-content-center">
                    <h3 class="single-title">Review au hasard</h3>
                </div>
                <div class="row">
                    <?php
                    $query = new WP_Query([
                        'post__not_in' => [get_the_ID()],
                        'post_type'    => 'anachroniques',
                        'posts_per_page' => 3,
                        'orderby' => 'rand',
                    ]);
                    while ($query->have_posts()) : $query->the_post();
                    ?>
                        <div class="col-md-6 col-lg-4 mb-2">
                            <div class="card h-100">
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
                                        <h5 class="card-subtitle mt-2 mb-2"><?= get_field('labels') ?></h5>
                                        <p><?= get_field('genre') ?></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
        <?php endwhile;
        endif; ?>
        <button id="back-to-top" onclick="topFunction()" style="display:none;">
            <i class="fas fa-chevron-up"></i>
        </button>
    </div>
    <script>
        window.addEventListener("scroll", () => {
      const scrollTop = window.scrollY;
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;
      const scrolled = (scrollTop / docHeight) * 100;
      document.getElementById("progress-bar").style.width = scrolled + "%";
    });
</script>
</main>
<?php get_footer() ?>