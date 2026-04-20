<?php
/**
 * Template for one news card used in Categories
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */?>
<li class="list-group-item">
Hello card news
    <a href="<?php the_permalink() ?>">
        <div class="card">
            <div class="row no-gutters">
                <div class="col-10">
                    <?php the_post_thumbnail('card-landscape', 
                        [
                            'class' => 'card-img d-none d-md-block w-100', 
                            'alt' => ''
                        ]
                        ) 
                    ?>
                    <!--<img src="http://placehold.it/500x500/FFFFF/000000" class="card-img d-none d-md-block w-100" alt="Article 1"> 
                    <img src="http://placehold.it/150x200/FFFFF/000000" class="card-img d-block d-md-none w-100" alt="Article 1">-->
                </div>
                <div class="col-12">
                    <div class="card-body">
                        <h5 class="card-title"><?php the_title() ?></h5>
                        <ul>
                        <?php 
                        the_terms(get_the_ID(), 'sport', '<li>', '</li><li>','</li>');
                        ?>
                        </ul>
                        <p class="card-text"><?php the_excerpt() ?></p>
                        <p class="card-text"><small class="text-muted"><?php the_time() ?> - <?php the_author() ?></small></p>
                    </div>
                    <?php the_category() ?>
                </div>
            </div>
        </div>                                     
    </a>
</li>