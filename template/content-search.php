<?php
/**
 * Template for search result page
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */?>

<li class="list-group-item">
        <a href="<?php the_permalink() ?>">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-4">
                        <?php the_post_thumbnail('card-homepage', 
                            [
                                'class' => 'card-img d-none d-md-block w-100', 
                                'alt' => ''
                            ]
                            ) 
                        ?>
                        <!--<img src="http://placehold.it/500x500/FFFFF/000000" class="card-img d-none d-md-block w-100" alt="Article 1"> 
                        <img src="http://placehold.it/150x200/FFFFF/000000" class="card-img d-block d-md-none w-100" alt="Article 1">-->
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php the_title(); ?></h5>
                            <p class="card-text"><?php the_excerpt(); ?></p>
                            <p class="card-text"><small class="text-muted"><?php the_time(); ?> - <?php the_author(); ?></small></p>
                        </div>
                    </div>
                </div>
            </div>                                     
        </a>
    </li>