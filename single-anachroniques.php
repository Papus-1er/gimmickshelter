<?php

/**
 * The template for displaying single anachroniques (chroniques d'albums)
 *
 * @package    Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since      Gimmick Shelter 1.0
 */

get_header(); ?>
<main role="main" id="main-content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

    /* ── Champs ACF ─────────────────────────────────────── */
    $gs_artiste  = get_field( 'artiste' );
    $gs_labels   = get_field( 'labels' );
    $gs_genre    = get_field( 'genre' );
    $gs_annee    = get_field( 'annee_sortie' );
    $gs_accroche = get_field( 'accroche' );
    $gs_hero_bg  = get_field( 'image_hero' )
                    ?: get_the_post_thumbnail_url( get_the_ID(), 'lrg_size' );

?>

<section class="an-hero" aria-label="<?php esc_attr_e( 'En-tête de la chronique', 'gimmickshelter' ); ?>">

    <?php if ( $gs_hero_bg ) : ?>
    <div class="an-hero__bg" aria-hidden="true">
        <img src="<?php echo esc_url( $gs_hero_bg ); ?>" alt="">
    </div>
    <?php endif; ?>

    <div class="an-hero__overlay" aria-hidden="true"></div>
    <div class="an-hero__grain"   aria-hidden="true"></div>
    <div class="an-hero__divider" aria-hidden="true"></div>

    <div class="an-hero__inner">
        <div class="an-hero__layout">

            <!-- Pochette — card-square, nette en avant-plan -->
            <div class="an-hero__cover-wrap">
                <?php the_post_thumbnail(
                    'card-square',
                    [
                        'class'   => 'an-hero__cover',
                        'alt'     => esc_attr(
                            get_the_title() . ( $gs_labels ? ' — ' . $gs_labels : '' )
                        ),
                        'loading' => 'eager',
                        'width'   => 260,
                        'height'  => 260,
                        'sizes'   => '(max-width: 640px) 150px, (max-width: 900px) 200px, 260px',
                    ]
                ); ?>
            </div>

            <!-- Info -->
            <div class="an-hero__info">

                <?php if ( $gs_artiste ) : ?>
                <p class="an-hero__artist"><?php echo esc_html( $gs_artiste ); ?></p>
                <?php endif; ?>

                <h1 class="an-hero__title"><?php the_title(); ?></h1>

                <?php if ( $gs_accroche ) : ?>
                <p class="an-hero__accroche"><?php echo esc_html( $gs_accroche ); ?></p>
                <?php endif; ?>

                <div class="an-hero__meta" role="list">
                    <?php if ( $gs_labels ) : ?>
                    <span class="an-hero__pill" role="listitem"><?php echo esc_html( $gs_labels ); ?></span>
                    <?php endif; ?>
                    <?php if ( $gs_genre ) :
                        foreach ( array_filter( array_map( 'trim', explode( '·', $gs_genre ) ) ) as $gs_pill ) : ?>
                        <span class="an-hero__pill--ghost" role="listitem"><?php echo esc_html( $gs_pill ); ?></span>
                    <?php endforeach; endif; ?>
                    <?php if ( $gs_annee ) : ?>
                    <span class="an-hero__pill--ghost" role="listitem"><?php echo esc_html( $gs_annee ); ?></span>
                    <?php endif; ?>
                </div>

                <p class="an-hero__byline">
                    <?php
                    printf(
                        'Par %s &nbsp;·&nbsp; <time datetime="%s">%s</time>',
                        esc_html( get_the_author() ),
                        esc_attr( get_the_date( 'c' ) ),
                        esc_html( get_the_date( 'd M Y' ) )
                    );
                    ?>
                </p>

            </div>
        </div>
    </div>
</section>

<div class="gs-content-zone">
    <div class="container">
        <div class="row">

            <!-- Article -->
            <div class="col-sm-12 col-lg-8">
                <div class="gs-review-body">
                    <?php the_content(); ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-sm-12 col-lg-4">
                <aside class="gs-sidebar sticky" aria-label="<?php esc_attr_e( 'Informations sur l\'album', 'gimmickshelter' ); ?>">
                    <?php echo wp_kses_post( get_field( 'album_spotify' ) ); ?>
                    <?php get_template_part( 'parts/fiche-album' ); ?>
                </aside>
            </div>

        </div>
    </div>
</div><!-- .gs-content-zone -->

<div class="container">

    <!--
    == PARTAGE — à faire en temps 2 ==
    <div class="row">
        <div class="col-12 mt-3">
            <div class="gs-share">
                <span class="gs-share__label">Partager</span>
                <div class="gs-share__buttons">
                    <a class="gs-share__btn" href="#">Facebook</a>
                    <a class="gs-share__btn" href="#">X / Twitter</a>
                    <a class="gs-share__btn" href="#">WhatsApp</a>
                    <a class="gs-share__btn" href="#">Email</a>
                </div>
            </div>
        </div>
    </div>
    -->

    <!-- Related -->
    <section class="gs-related" aria-labelledby="gs-related-title">
        <header class="gs-related__head">
            <h2 id="gs-related-title" class="gs-related__title">D'autres <em>Reviews</em></h2>
            <a class="gs-related__all" href="<?php echo esc_url( get_post_type_archive_link( 'anachroniques' ) ); ?>">
                Voir toutes les reviews <span aria-hidden="true">&rarr;</span>
            </a>
        </header>
        <?php
        $gs_related_query = new WP_Query( [
            'post__not_in'        => [ get_the_ID() ],
            'post_type'           => 'anachroniques',
            'posts_per_page'      => 3,
            'orderby'             => 'rand',
            'no_found_rows'       => true,
            'ignore_sticky_posts' => true,
        ] );
        if ( $gs_related_query->have_posts() ) : ?>
            <ul class="gs-related__list" role="list">
                <?php while ( $gs_related_query->have_posts() ) : $gs_related_query->the_post();
                    get_template_part( 'parts/card-related-anachronique' );
                endwhile; ?>
            </ul>
        <?php endif;
        wp_reset_postdata(); ?>
    </section>

</div><!-- .container (related) -->

<?php endwhile; endif; ?>

<?php get_template_part( 'parts/progress-bar' ); ?>
</main>
<?php get_footer(); ?>
