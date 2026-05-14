<?php
/**
 * Template part : barre de progression de lecture + bouton retour en haut
 * Inclus en bas de chaque template single (anachroniques, playlists, post, dates).
 *
 * @package    Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since      Gimmick Shelter 1.0
 */
?>
<div id="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>

<button id="back-to-top"
        type="button"
        aria-label="<?php esc_attr_e( 'Retour en haut de page', 'gimmickshelter' ); ?>">
    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
        <polyline points="18 15 12 9 6 15"/>
    </svg>
</button>

<script>
(function () {
    var bar = document.getElementById('progress-bar');
    window.addEventListener('scroll', function () {
        var scrollTop  = window.scrollY;
        var docHeight  = document.documentElement.scrollHeight - window.innerHeight;
        var scrolled   = docHeight > 0 ? Math.round((scrollTop / docHeight) * 100) : 0;
        bar.style.width        = scrolled + '%';
        bar.setAttribute('aria-valuenow', scrolled);
    }, { passive: true });
}());
</script>
