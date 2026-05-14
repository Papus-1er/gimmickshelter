<?php

/**
 * The template for displaying all single posts
 * 
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */

get_header() ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <main role="main">
                        <div class="container mt-5 mb-5">
                                <div class="row mb-4">
                                        <div class="col-12">
                                                <h1 class="single-title d-flex justify-content-center"><?php the_title() ?></h1>
                                                <h2 class="single-subtitle d-flex justify-content-center"><?= get_field('sous-titre-playlist') ?></h2>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="col-lg-8">
                                                <!--<a href="<?php bloginfo('url'); ?>/playlists/" id="go-back"><i class="fa-solid fa-arrow-left" aria-label="Retour en arrière"></i></a>-->
                                                <!--<p class="single-author"><?php the_author() ?></p>-->
                                                <div><?php the_content() ?></div>
                                        </div>
                                        <div class="col-lg-4">
                                                <div class="row sticky">
                                                        <div class="col-12">
                                                                <div><?= get_field('spotify') ?></div>
                                                                <div class="mt-2 mb-2">
                                                                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style d-flex justify-content-center"">
                                                                        <a class=" a2a_button_facebook m-1"></a>
                                                                                <a class="a2a_button_twitter m-1"></a>
                                                                                <a class="a2a_button_whatsapp m-1"></a>
                                                                                <a class="a2a_button_email m-1"></a>
                                                                                <a class="a2a_button_sms m-1"></a>
                                                                        </div>
                                                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <section class="gs-related" aria-labelledby="gs-related-title">
                                        <header class="gs-related__head">
                                                <h2 id="gs-related-title" class="gs-related__title">D'autres <em>playlists</em></h2>
                                                <a class="gs-related__all" href="<?php echo esc_url( get_post_type_archive_link( 'playlists' ) ); ?>">
                                                        Voir toutes les playlists <span aria-hidden="true">&rarr;</span>
                                                </a>
                                        </header>
                                        <?php
                                        $gs_related_query = new WP_Query([
                                                'post__not_in'        => [ get_the_ID() ],
                                                'post_type'           => 'playlists',
                                                'posts_per_page'      => 3,
                                                'orderby'             => 'rand',
                                                'no_found_rows'       => true,
                                                'ignore_sticky_posts' => true,
                                        ]);
                                        if ( $gs_related_query->have_posts() ) : ?>
                                                <ul class="gs-related__list" role="list">
                                                        <?php while ( $gs_related_query->have_posts() ) : $gs_related_query->the_post();
                                                                get_template_part( 'parts/card-related-playlist' );
                                                        endwhile; ?>
                                                </ul>
                                        <?php endif;
                                        wp_reset_postdata(); ?>
                                </section>
                <?php endwhile;
endif; ?>
                        </div>
    <?php get_template_part( 'parts/progress-bar' ); ?>
                </main>
                <?php get_footer() ?>