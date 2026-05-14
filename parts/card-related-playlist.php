<?php
/**
 * Template part: card for a related playlist (used in single-playlists.php)
 *
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */

$gs_subtitle  = get_field( 'sous-titre-playlist' ) ?: '';
$gs_aria_card = $gs_subtitle
    ? sprintf( 'Playlist : %s — %s', get_the_title(), $gs_subtitle )
    : sprintf( 'Playlist : %s', get_the_title() );
?>
<li>
    <a class="gs-card" href="<?php the_permalink(); ?>"
       aria-label="<?php echo esc_attr( $gs_aria_card ); ?>">
        <?php the_post_thumbnail(
            'card-square',
            [
                'class'   => 'gs-card-img',
                'alt'     => sprintf( 'Playlist %s', get_the_title() ),
                'loading' => 'lazy',
            ]
        ); ?>
        <div class="gs-card-img-overlay">
            <div>
                <h3 class="gs-card-title"><?php the_title(); ?></h3>
                <?php if ( $gs_subtitle ) : ?>
                    <p class="gs-card-sub"><?php echo esc_html( $gs_subtitle ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </a>
</li>
