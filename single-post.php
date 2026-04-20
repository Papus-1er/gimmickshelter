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
        <div class="container mt-5 mb-5">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <div class="row">
                                        <div class="col-12 d-flex justify-content-center">
                                                <h1 class="single-title"><?php the_title() ?></h1>
                                        </div>
                                        <div class="col-12">
                                                <!--<a href="<?php bloginfo('url'); ?>/telegram/" id="go-back"><i class="fa-solid fa-arrow-left" aria-label="Retour en arrière"></i></a>-->
                                                <h2 class="single-subtitle"><?= get_field('subtitle_post') ?></h2>
                                                <!--<p class="single-author"><?php the_date() ?> - <?php the_author() ?></p>-->
                                                <?php the_content('content-text') ?>
                                        </div>
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
                                        <h3 class="single-title">Suivez notre télégram</h3>
                                </div>
                                <div class="row">
                                        <?php
                                        $query = new WP_Query([
                                                'post__not_in' => [get_the_ID()],
                                                'post_type'    => 'post',
                                                'posts_per_page' => 3,
                                                'orderby' => 'rand',
                                        ]);
                                        while ($query->have_posts()) : $query->the_post();
                                        ?>
                                                <div class="col-md-6 col-lg-4 mb-2">
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
                                                                                        <h5 class="card-title c-3 mb-2"><?php the_title() ?></h5>
                                                                                        <h5 class="card-subtitle c-3 mt-2 mb-2"><?= get_field('sous-titre-playlist') ?></h5>
                                                                                </div>
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