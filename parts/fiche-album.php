<?php

/**
 * Partial — Fiche album (sidebar de single-anachroniques)
 *
 * Champs ACF : best_tracks (texte, séparé par virgules), ou_les_ecouter (URL)
 *
 * @package    Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since      Gimmick Shelter 1.0
 */

$gs_best_tracks = get_field( 'best_tracks' );
$gs_ou_ecouter  = get_field( 'ou_les_ecouter' );

if ( ! $gs_best_tracks && ! $gs_ou_ecouter ) return;

?>
<div class="gs-fiche">
    <div class="gs-fiche__body">

        <?php if ( $gs_best_tracks ) :
            $gs_tracks = array_filter( array_map( 'trim', explode( ',', $gs_best_tracks ) ) );
            if ( $gs_tracks ) : ?>
        <div class="gs-fiche__row">
            <span class="gs-fiche__key" id="gs-fiche-tracks-label">Best tracks</span>
            <ol class="gs-fiche__tracks" aria-labelledby="gs-fiche-tracks-label">
                <?php foreach ( $gs_tracks as $gs_track ) : ?>
                <li><?php echo esc_html( $gs_track ); ?></li>
                <?php endforeach; ?>
            </ol>
        </div>
        <?php if ( $gs_ou_ecouter ) : ?>
        <div class="gs-fiche__sep" aria-hidden="true"></div>
        <?php endif; ?>
        <?php endif; endif; ?>

        <?php if ( $gs_ou_ecouter ) : ?>
        <div class="gs-fiche__row">
            <a class="gs-fiche__listen"
               href="<?php echo esc_url( $gs_ou_ecouter ); ?>"
               target="_blank"
               rel="noopener noreferrer"
               aria-label="<?php echo esc_attr( sprintf( 'Écouter %s sur la plateforme de streaming', get_the_title() ) ); ?>">
                <svg aria-hidden="true" focusable="false" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/>
                </svg>
                Bandcamp
            </a>
        </div>
        <?php endif; ?>

    </div>
</div>
