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
    <!-- ══════════════════════════════════════════════
         RELATED — style gs-related / gs-card
         Réutilise les classes déjà définies dans style.css
         ══════════════════════════════════════════════ -->
    <section class="gs-related"
             aria-label="<?php esc_attr_e( 'Autres reviews', 'gimmickshelter' ); ?>">
        <div class="gs-related__inner">

            <header class="gs-related__head">
                <h2 class="gs-related__title">
                    <?php esc_html_e( 'D\'autres ', 'gimmickshelter' ); ?>
                    <em><?php esc_html_e( 'Reviews', 'gimmickshelter' ); ?></em>
                </h2>
                <a href="<?= esc_url( get_post_type_archive_link( 'anachroniques' ) ) ?>"
                   class="gs-related__all">
                    <?php esc_html_e( 'Voir toutes les reviews →', 'gimmickshelter' ); ?>
                </a>
            </header>

            <ul class="gs-related__list" role="list">
                <?php
                $related = new WP_Query( [
                    'post__not_in'   => [ get_the_ID() ],
                    'post_type'      => 'anachroniques',
                    'posts_per_page' => 3,
                    'orderby'        => 'rand',
                ] );
                while ( $related->have_posts() ) : $related->the_post();
                    $rel_thumb = get_the_post_thumbnail_url( get_the_ID(), 'card-square' );
                    $rel_label = get_field( 'labels' );
                    $rel_alt   = esc_attr( get_the_title() . ( $rel_label ? ' — ' . $rel_label : '' ) );
                ?>
                <li>
                    <a href="<?php the_permalink(); ?>"
                       class="gs-card"
                       aria-label="<?= $rel_alt ?>">
                        <?php if ( $rel_thumb ) : ?>
                        <img class="gs-card-img"
                             src="<?= esc_url( $rel_thumb ) ?>"
                             alt="<?= $rel_alt ?>"
                             loading="lazy">
                        <?php endif; ?>
                        <div class="gs-card-img-overlay" aria-hidden="true">
                            <div>
                                <?php if ( $rel_label ) : ?>
                                <p class="gs-card-sub"><?= esc_html( $rel_label ) ?></p>
                                <?php endif; ?>
                                <h3 class="gs-card-title"><?php the_title(); ?></h3>
                            </div>
                        </div>
                    </a>
                </li>
                <?php endwhile; wp_reset_postdata(); ?>
            </ul>

        </div>
    </section>
        <?php endwhile;
        endif; ?>
        <button id="back-to-top"
                onclick="topFunction()"
                style="display:none;"
                aria-label="<?php esc_attr_e( 'Retour en haut de page', 'gimmickshelter' ); ?>">
            <i class="fas fa-chevron-up" aria-hidden="true"></i>
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