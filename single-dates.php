<?php

/**
 * The template for displaying all single posts
 * 
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */

get_header() ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <main role="main">
                <div id="progress-bar"></div>
                <div class="container mt-5 mb-5">
                        <div class="row">
                                <div class="col-12">
                                        <h1 class="single-title d-flex justify-content-center"><?php the_title() ?></h1>
                                        <h2 class="single-subtitle d-flex justify-content-center mb-4"><?= get_field('sous-titre-playlist') ?></h2>
                                </div>
                                <div class="col-12">
                                        <?php the_content() ?>
                                </div>
                                <div class="col-12 mt-3">
                                <div class="mt-2 mb-2">
                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                        <a class="a2a_button_facebook m-1"></a>
                                        <a class="a2a_button_twitter m-1"></a>
                                        <a class="a2a_button_whatsapp m-1"></a>
                                        <a class="a2a_button_email m-1"></a>
                                        <a class="a2a_button_sms m-1"></a>
                                    </div>
                                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                                </div>
                            </div>
                        </div>
                                <?php endwhile;
                                endif; ?>
                <button id="back-to-top" onclick="topFunction()" style="display:none;">
                <i class="fas fa-chevron-up"></i>
                </button>  
        </div>
        <script>
    window.addEventListener("scroll", () => {
      const scrollTop = window.scrollY;
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;
      const scrolled = (scrollTop / docHeight) * 100;
      document.getElementById("progress-bar").style.width = scrolled + "%";
    });
  </script>
        </main>
<?php get_footer() ?>