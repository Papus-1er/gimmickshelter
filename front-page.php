<?php

/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will appear.
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */

get_header() ?>
<main role="main" class="">
    <?php echo do_shortcode('[smartslider3 slider="2"]'); ?>
    <div id="main" class="container min-vh-100 p-3">
        <div class="mt-4 mb-4 d-flex justify-content-center">
            <h2 class="single-title">A la une</h2>
        </div>
        <div class="row mb-3">
            <?php
            $args = array(
                'post_type' => array('post', 'anachroniques', 'dates', 'playlists'),
                'posts_per_page' => 9,
                'orderby' => 'date',
                'orderby' => 'DESC',
                'post__not_in' => get_option('sticky_posts'),
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                        <div class="gs-card h-100 gs-overlay-card position-relative">
                            <a class="c-4" href="<?php the_permalink() ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('full', array('class' => 'gs-card-img img-fluid', 'loading' => 'lazy')); ?>
                                <?php endif; ?>
                                <div class="gs-card-img-overlay d-flex align-items-end justify-content-center text-left">
                                    <div class="gs-overlay-text p-3">
                                        <h5 class="card-title c-3 mb-2"><?php the_title() ?></h5>
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
            <?php endwhile;
                wp_reset_postdata();
            else :
                echo '<p>Aucun article trouvé.</p>';
            endif; ?>
        </div>
    </div>
</main>
<?php get_footer() ?>