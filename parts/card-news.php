<?php

/**
 * Template for one news card used in Categories
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */ ?>
<div class="col-sm-12 col-md-6 col-lg-4">
    <a href="<?php the_permalink() ?>">
    <div class="card-group">
        <div class="card">
            <?php the_post_thumbnail(
                'card-square',
                [
                    'class' => 'card-img-top',
                    'alt' => ''
                ]
            )
            ?>
            <div class="card-body">
                <h5 class="card-title"><?php the_title() ?></h5>
                <div class="card-text"><?php the_excerpt() ?></div>
                <div class="card-text"><small class="text-muted"><?php the_time() ?> - <?php the_author() ?></small></div>
                <div class="card-text"><?php the_category() ?></div>
            </div>
        </div>
        <!--<img src="http://placehold.it/500x500/FFFFF/000000" class="card-img d-none d-md-block w-100" alt="Article 1"> 
        <img src="http://placehold.it/150x200/FFFFF/000000" class="card-img d-block d-md-none w-100" alt="Article 1">-->
    </a>
</div>
</div>