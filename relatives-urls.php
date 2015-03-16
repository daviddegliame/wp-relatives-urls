<?php
/*
Plugin Name: Wp relatives urls
Description: plein de petites urls relatives pour tous les jours
Author: David Degliame
Author URI: http://degliame.fr/
Version: 21 02 2013
*/

// chargement direct interdit
defined('ABSPATH') || exit('Cheatin\'uh?');	

//
// je cherche à rendre tout les liens relatif , img, css, links, 
//
// @TODO  il manque une gestion pour les wp installé dans un dossier.
//

add_action( 'template_redirect', 'rw_relative_urls' );

function rw_relative_urls() 
{
    // Don't do anything if:
    // - In feed
    // - In sitemap by WordPress SEO plugin
    if ( is_feed() || get_query_var( 'sitemap' ) ) return;

    $filters = array(
        'post_link',
        'post_type_link',
        'page_link',
        'attachment_link',
        'bloginfo',
        'template_directory_uri',
        'stylesheet_directory_uri',
        'wp_get_attachment_image',
        'post_thumbnail_html',
        'get_shortlink',
        'post_type_archive_link',
        'get_pagenum_link',
        'get_comments_pagenum_link',
        'term_link',
        'search_link',
        'day_link',
        'month_link',
        'year_link',
        'script_loader_src',
        'style_loader_src',
    );
    foreach ( $filters as $filter )
    {
        add_filter( $filter, 'wp_make_link_relative', PHP_INT_MAX );
    }   
}

add_filter('stylesheet_directory_uri','relative_stylesheet_directory_uri', 10, 2);
function relative_stylesheet_directory_uri($stylesheet_dir_uri, $stylesheet) 
{
    return wp_make_link_relative($stylesheet_dir_uri);
}
 
