<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */

get_header() ?>
<div class="container">

<?php $playlists = get_terms(['taxonomy' => 'category']);?>
<ul class="nav nav-pills my-4">
    <?php foreach($playlists as $playlist): ?>
    <li class="nav-item">
        <a href="<?= get_term_link($playlist) ?>" class="nav-link <?= is_tax('playlist', $playlist->term_id) ? 'active' : '' ?>"><?= $playlist->name?></a>
    </li>
<?php endforeach; ?>
</ul>


<?php if (have_posts()): ?>
    
    Bonjour a tous : <?php wp_title(); ?> - taxonomy 
    <ul>
    <?php while(have_posts()): the_post(); ?>
        <?php get_template_part('parts/card-news', 'post'); ?>
    <?php endwhile ?>    
    </ul>
    <?php echo gimmickshelter_pagination(); ?>
<?php else: ?>
    <h1>Pas d'articles de disponible</h1>
<?php endif; ?>
</div>

<?php get_footer() ?>