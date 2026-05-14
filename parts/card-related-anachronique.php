<?php
/**
 * Template part : card pour une review liée (utilisé dans single-anachroniques.php)
 *
 * @package    Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since      Gimmick Shelter 1.0
 */

$gs_artiste   = get_field( 'artiste' ) ?: '';
$gs_aria_card = $gs_artiste
    ? sprintf( 'Review : %s — %s', get_the_title(), $gs_artiste )
    : sprintf( 'Review : %s', get_the_title() );
?>
<li>
    <a class="gs-card" href="<?php the_permalink(); ?>"
       aria-label="<?php echo esc_attr( $gs_aria_card ); ?>">
        <?php the_post_thumbnail(
            'card-square',
            [
                'class'   => 'gs-card-img',
                'alt'     => '',
                'loading' => 'lazy',
            ]
        ); ?>
        <div class="gs-card-img-overlay">
            <div>
                <?php if ( $gs_artiste ) : ?>
                <p class="gs-card-artist"><?php echo esc_html( $gs_artiste ); ?></p>
                <?php endif; ?>
                <h3 class="gs-card-title"><?php the_title(); ?></h3>
            </div>
        </div>
    </a>
</li>
