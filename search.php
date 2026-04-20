<?php

/**
 * The template for displaying search results pages
 *
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */

get_header() ?>
<main role="main">
	<div class="container min-vh-100 p-2">
		<div class="page-header">
			<?php if (have_posts()) : ?>
				<h1 class="page-title mt-4 mb-4 d-flex justify-content-center">
					<?php
					printf(__('Votre recherche:%s', 'gimmickshelter'), '<span>' . get_search_query() . '</span>');
					?>
				</h1>
			<?php else : ?>
				<h1 class="page-title mt-4 mb-4 d-flex justify-content-center"><?php _e('Aucun Résultat', 'gimmickshelter'); ?></h1>
			<?php endif; ?>
		</div>
		<div id="primary" class="row">
			<?php if (have_posts()) :
				while (have_posts()) : the_post(); ?>
					<div class="col-sm-12 col-md-6 col-lg-4 mb-3">
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
                                        <h2 class="card-title c-3 mb-2 d-flex justify-content-center"><?php the_title() ?></h2>
                                        <h3 class="card-subtitle c-3 mt-2 mb-2 d-flex justify-content-center"><?php echo wp_kses_post(get_field('subtitle_post')); ?></h3>
                                    </div>
                                </div>
                                <div class="card-label">
                                    <?php
                                    $tags = get_the_tags();
                                    if ($tags) {
                                        $tag_names = array();
                                        foreach ($tags as $tag) {
                                            $tag_names[] = esc_html($tag->name);
                                        }
                                        echo implode(', ', $tag_names);
                                    }
                                    ?>
                                </div>
							</a>
						</div>
					</div>
				<?php endwhile; ?>
		</div>
		<div class="row justify-content-center">
			<?php echo gimmickshelter_pagination(); ?>
		</div>
	<?php else : ?>
			<div class="col">
				<p class="p-2">Désolé mais aucun résultat ne correspond a votre recherche, vérifiez l’orthographe des termes utilisés et effectuez une nouvelle recherche.</p>
				<p class="p-2">Si aucun résultat ne correspond a vos critères de recherches nous vous conseillons de consulter nos catégories :</p>
				<ul>
					<li class="mb-2">
						<a class="c-4" href="https://www.gimmickshelter.fr/news/"><u>Télégram</u></a>
					</li>
					<li class="mb-2">
						<a class="c-4" href="https://www.gimmickshelter.fr/anachroniques/"><u>Review</u></a>
					</li>
					<li class="mb-2">
						<a class="c-4" href="https://www.gimmickshelter.fr/playlists/"><u>Playlists</u></a>
					</li>
					<li class="mb-2">
						<a class="c-4" href="https://www.gimmickshelter.fr/dates/"><u>Agenda</u></a>
					</li>
				</ul>
			</div>
	<?php endif; ?>
	</div>
</main>
<?php
get_footer();
