<?php
/**
 * Gimmick Shelter functions and definitions
 * @package Gimmick Shelter
 * @subpackage Gimmick Shelter
 * @since Gimmick Shelter 1.0
 */

/** CORE */ 

require_once('walker/CommentWalker.php');

// Add several some features to the Gimmick Shelter Theme
function gimmickshelter_supports()
{
    // Add the possibility to change the title tag
    add_theme_support( 'title-tag' );
    // add menu options
    add_theme_support('menus');
    register_nav_menus(
        array(
            'header' =>__('En Tête du menu'),
            'footer'=>__('Pied de page'),
            'social-network' =>__('Liens des réseaux sociaux')
        )     
    );

    // add thumbnails for article
    add_theme_support('post-thumbnails');
    // add image format
    add_image_size('card-landscape', 350, 215, true);
    add_image_size('card-square', 500, 500, true);
    add_image_size('sml_size', 300);
    add_image_size('mid_size', 600);
    add_image_size('lrg_size', 1200);
    add_image_size('sup_size', 2400);
    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}

// Add CSS Stylesheets and JS script to the website
function gimmickshelter_register_assets() 
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css',[]);
    wp_register_style('style', get_template_directory_uri() . '/style.css',['bootstrap']);
    wp_register_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', ['popper', 'jquery'], '4.4.1', true);
    wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', [], '1.12.9', true);
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', [], '3.7.1', true);
    wp_enqueue_style( 'style' );
    wp_enqueue_script('bootstrap');
}

/** HEADER PART */ 

// Add CSS class for <li> elements of header navigation menu
function gimmickshelter_menu_class($classes) 
{
    $classes[] = 'nav-item';
    return $classes;
}
// Add CSS class for <a> elements of header navigation menu
function gimmickshelter_menu_link_class($attrs) 
{
    $attrs['class'] = 'nav-link c-3';
    return $attrs;
}

/** COMPONENT PART */ 


// Pagination list
function gimmickshelter_pagination() {
    
        $pages = paginate_links(
            [
                'type' => 'array',
                'prev_text' => '<span aria-hidden="true">&laquo;</span>',
                'next_text' => '<span aria-hidden="true">&raquo;</span>',
            ]);
        if ($pages === null) {
            return;
        } 
        echo '<nav aria-label="Pagination" class="mt-4">';
        echo '<ul class="pagination justify-content-center">';
        foreach($pages as $page) {
            $active = strpos($page, 'current') !== false;
            $class = 'page-item';
            if ($active) {
                $class .= ' gs-active';
            }
            echo '<li class="'.$class.'">';
            echo str_replace('page-numbers', 'page-link', $page);
            echo '</li>';
        }
        echo '</ul>';
        echo '</nav>';
}

function gimmickshelter_init() {


    register_taxonomy ('playlists-categories', 'playlists', [
        'labels' => [
            'name'          => 'Catégorie',
            'singular_name' => 'catégorie',
            'plural_name'   => 'catégories',
            'search_items'  => 'Rechercher des catégorie',
            'all_items'     => 'Toutes les catégories',
            'edit_item'     => 'Editer une catégorie',
            'update_item'   => 'Mettre à jour une catégorie',
            'add_new_item'  => 'Ajouter une nouvelle catégorie',
            'new_item_name' => 'Ajouter une nouvelle catégorie',
            'menu_name'     => 'Categories',
        ],
        'show_in_rest'      => true,
        'hierarchical'      => true,
        'show_admin_column' => true,
    ]);
    // taxonony for Anachroniques (Categories)
    register_taxonomy ('anachroniques-categories', 'anachroniques', [
        'labels' => [
            'name'          => 'Catégorie',
            'singular_name' => 'catégorie',
            'plural_name'   => 'catégories',
            'search_items'  => 'Rechercher des catégorie',
            'all_items'     => 'Toutes les catégories',
            'edit_item'     => 'Editer une catégorie',
            'update_item'   => 'Mettre à jour une catégorie',
            'add_new_item'  => 'Ajouter une nouvelle catégorie',
            'new_item_name' => 'Ajouter une nouvelle catégorie',
            'menu_name'     => 'Categories',
        ],
        'show_in_rest'      => true,
        'hierarchical'      => true,
        'show_admin_column' => true,
    ]);
    // taxonony for Dates (Categories)
    register_taxonomy ('dates-categories', 'dates', [
        'labels' => [
            'name'          => 'Catégorie',
            'singular_name' => 'catégorie',
            'plural_name'   => 'catégories',
            'search_items'  => 'Rechercher des catégorie',
            'all_items'     => 'Toutes les catégories',
            'edit_item'     => 'Editer une catégorie',
            'update_item'   => 'Mettre à jour une catégorie',
            'add_new_item'  => 'Ajouter une nouvelle catégorie',
            'new_item_name' => 'Ajouter une nouvelle catégorie',
            'menu_name'     => 'Categories',
        ],
        'show_in_rest'      => true,
        'hierarchical'      => true,
        'show_admin_column' => true,
    ]);
    // Anachroniques post type (WP config)
    register_post_type ('anachroniques', [
        'labels' => [
            'name'          => 'Anachronique',
            'singular_name' => 'anachronique',
            'all_items'     => 'Toutes les reviews', 
        ],
        'public'            => true, 
        'menu_position'     => 6,
        'menu_icon'         => 'data:image/svg+xml;base64,' . base64_encode('<svg width="20" height="20" data-prefix="fas" data-icon="album-collection" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-album-collection fa-w-16 fa-3x"><path fill="currentColor" d="M496 104a24 24 0 0 0-24-24H40a24 24 0 0 0-24 24v24h480zm-16-80a24 24 0 0 0-24-24H56a24 24 0 0 0-24 24v24h448zm0 144H32A32 32 0 0 0 .13 194.9l26.19 288A32 32 0 0 0 58.18 512h395.64a32 32 0 0 0 31.86-29.1l26.19-288A32 32 0 0 0 480 160zm-224 312.89c-94.26 0-174.39-54.53-179.21-125.15C71.71 273.1 151.82 209.4 256 209.4s184.29 63.7 179.21 138.34c-4.82 70.63-84.95 125.15-179.21 125.15z" class=""></path></svg>'),        'supports'          => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'show_in_rest'      => true,
        'has_archive'       => true,
        'taxonomies' => ['post_tag'],
    ]);
    // Playlists post type (WP config)
    register_post_type ('playlists', [
        'labels' => [
            'name'          => 'Playlist',
            'singular_name' => 'playlist',
            'all_items'     => 'Toutes les playlists', 
        ],
        'public'            => true, 
        'menu_position'     => 7,
        'menu_icon'         => 'data:image/svg+xml;base64,' . base64_encode('<svg width="20" height="20" data-prefix="fas" data-icon="cassette-tape" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-cassette-tape fa-w-16 fa-2x"><path fill="currentColor" d="M464 63H48a48 48 0 0 0-48 48v288a48 48 0 0 0 48 48h416a48 48 0 0 0 48-48V111a48 48 0 0 0-48-48zm-32-80a24 24 0 0 0-24-24H56a24 24 0 0 0-24 24v24h448zm0 144H32A32 32 0 0 0 .13 194.9l26.19 288A32 32 0 0 0 58.18 512h395.64a32 32 0 0 0 31.86-29.1l26.19-288A32 32 0 0 0 480 160zm-224 312.89c-94.26 0-174.39-54.53-179.21-125.15C71.71 273.1 151.82 209.4 256 209.4s184.29 63.7 179.21 138.34c-4.82 70.63-84.95 125.15-179.21 125.15zM128 255a32 32 0 1 1 32-32 32 32 0 0 1-32 32zm182.78 0H201.22a78.91 78.91 0 0 0 0-64h109.56a78.91 78.91 0 0 0 0 64zm73.22 0a32 32 0 1 1 32-32 32 32 0 0 1-32 32zM147.78 383l-32 64h280.44l-32-64z" class=""></path></svg>'),
        'supports'          => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'show_in_rest'      => true,
        'has_archive'       => true,
        'taxonomies' => ['post_tag'],
    ]);
    // Agenda post type (WP config)
    register_post_type ('dates', [
        'labels' => [
            'name'          => 'Agenda',
            'singular_name' => 'date',
            'all_items'     => 'Toutes les dates', 
        ],
        'public'            => true, 
        'menu_position'     => 8,
        'menu_icon'         => 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16"><path d="M6.445 11.688V6.354h-.633A13 13 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/></svg>'), 
        'supports'          => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'show_in_rest'      => true,
        'has_archive'       => true,
        'taxonomies' => ['post_tag'],
    ]);
}

/** ACTIONS */ 

// CORE
add_action('init', 'gimmickshelter_init');
add_action('after_setup_theme', 'gimmickshelter_supports');
add_action('wp_enqueue_scripts', 'gimmickshelter_register_assets');
// HEADER
add_filter('nav_menu_css_class', 'gimmickshelter_menu_class');
add_filter('nav_menu_link_attributes', 'gimmickshelter_menu_link_class');
// FILES REQUIRED
require_once('metaboxes/sponso.php');
SponsoMetabox::register();

// Sidebar registration - A TERMINER
function gimmickshelter_register_widget() {
    register_sidebars([
        'id' => 'anachronique',
        'name' => 'Sidebar Anachronique',
    ]);
}

add_action('widgets_init', 'gimmickshelter_register_widget');

// Comments 
add_filter('comment_form_default_fields', function ($fields) {
    $fields['email'] = '<div class="form-group"><label for="email">Votre email*</label><input class="form-control" name="email" placeholder="prénom.nom@example.com" id="email" required></div>';
    $fields['author'] = '<div class="form-group"><label for="name">Votre nom*</label><input class="form-control" name="name" id="name" required></div>'; 
    $fields['url'] = '';
    return $fields;
});

// Enable REST return to guest user
add_filter( 'rest_authentication_errors', function( $result ) {
    // If a previous authentication check was applied,
    // pass that result along without modification.
    if ( true === $result || is_wp_error( $result ) ) {
        return $result;
    }
 
    // No authentication has been performed yet.
    // Return an error if user is not logged in.
    if ( ! is_user_logged_in() ) {
        return new WP_Error(
            'rest_not_logged_in',
            __( 'You are not currently logged in.' ),
            array( 'status' => 401 )
        );
    }
 
    // Our custom authentication check should have no effect
    // on logged-in requests
    return $result;
});

function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_filter('wpseo_schema_breadcrumb', 'custom_wpseo_schema_breadcrumb');

function custom_wpseo_schema_breadcrumb($data) {
    // Vérifiez chaque élément dans le BreadcrumbList
    foreach ($data['itemListElement'] as &$item) {
        // Si c'est le dernier élément, on ajoute l'URL de la page courante
        if ($item['position'] == count($data['itemListElement'])) {
            $item['item'] = get_permalink();
        } elseif (!isset($item['item']) || empty($item['item'])) {
            // Ajoutez une URL par défaut si manquante
            $item['item'] = home_url('/');
        }
    }
    return $data;
}