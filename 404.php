<?php

/**
 * The template for displaying 404 pages (not found)
 * 
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */

get_header() ?>
<main role="main">
  <div class="container min-vh-100">
    <div class="row mt-3">
      <div class="col">
        <h1 class="single-title mt-2 mb-3">Oups, nous avons pas trouvé la page</h1>
        <div><iframe width="100%" height="500" src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>
        <p class="mt-3">Si aucun résultat ne correspond a vos critères de recherches nous vous conseillons de consulter nos catégories :</p>
        <ul>
          <li>
            <u><a class="c-4" href="https://www.gimmickshelter.fr/telegram/">Telegram</a></u>
          </li>
          <li>
            <u><a class="c-4" href="https://www.gimmickshelter.fr/anachroniques/">Review</a></u>
          </li>
          <li>
            <u><a class="c-4" href="https://www.gimmickshelter.fr/playlists/">Playlist</a></u>
          </li>
          <li>
            <u><a class="c-4" href="https://www.gimmickshelter.fr/dates/">Agenda</a></u>
          </li>
        </ul>
        <h2 class="single-title mt-2 mb-3">Besoin d'aide ?</h2>
        <div class="mt-3 mb-3">
          <button class="btn btn-gs-primary btn-lg">
            <a class="c-3" href="https://www.gimmickshelter.fr/nous-contacter/">Nous contacter</a>
          </button>
        </div>
      </div>
    </div>
  </div>
</main>
<?php get_footer() ?>