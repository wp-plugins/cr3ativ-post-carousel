<?php
/**
 * Plugin Name: Cr3ativ RecentPosts Plugin
 * Plugin URI: https://wordpress.org/plugins/cr3ativ-post-carousel/
 * Description: Custom written plugin to have your posts in a carousel based on categories from WordPress.
 * Author: Cr3ativ
 * Author URI: http://cr3ativ.com/
 * Version: 1.0.7
 */

/* Place custom code below this line. */

/* Variables */
$ja_cr3ativ_recentposts_main_file = dirname(__FILE__).'/cr3ativ-recentposts.php';
$ja_cr3ativ_recentposts_directory = plugin_dir_url($ja_cr3ativ_recentposts_main_file);
$ja_creativ_recentposts_path = dirname(__FILE__);

/* Add css and scripts file */
function creativ_recentposts_add_scripts() {
	global $ja_cr3ativ_recentposts_directory, $ja_creativ_recentposts_path;
		wp_enqueue_style('creativ_recentposts_styles', $ja_cr3ativ_recentposts_directory.'css/owl.css');
		wp_enqueue_script('jquery');
		wp_register_script('creativ_recentposts_js', $ja_cr3ativ_recentposts_directory.'js/owl.carousel.js', 'jquery');
		wp_register_script('creativ_recentposts_script_js', $ja_cr3ativ_recentposts_directory.'js/owl.script.js', 'jquery');
		wp_enqueue_script('creativ_recentposts_js');
        wp_enqueue_script('creativ_recentposts_script_js');
}
		
add_action('wp_enqueue_scripts', 'creativ_recentposts_add_scripts');

////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////         Limit Excerpt Length         ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Text Domain     /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
load_plugin_textdomain ('cr3atrecentposts');


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////       Shortcode Loop      ///////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

function get_excerpt_by_id($post_id){
$the_post = get_post($post_id); //Gets post ID
$the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
$excerpt_length = 35; //Sets excerpt length by word count
$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
$words = explode(' ', $the_excerpt, $excerpt_length + 1);
if(count($words) > $excerpt_length) :
array_pop($words);
array_push($words, '…');
$the_excerpt = implode(' ', $words);
endif;
$the_excerpt = '<p>' . $the_excerpt . '</p>';
return $the_excerpt;
}

// Taxonomy category shortcode
function recentposts_cat_func($atts, $content) {
    extract(shortcode_atts(array(
            'columns'    => '4',
            'number'    => '4',
            'image'    => 'yes',
            'category'      => ''
            ), $atts));

    global $post;
    if( $category != ('') ) {      
		$args = array(
		'post_type' => 'post',
        'showposts' => $number,
        'category_name' => $category
		); 
   } else {
		$args = array(
		'post_type' => 'post',
        'showposts' => $number
		);
   }
   
    query_posts($args);
    
    $output = '';
    $temp_title = '';
    $temp_link = '';
    $temp_excerpt = '';
    $temp_image = '';
    
    if( $columns == '1' ) {
        $output = '<div class="1-column">';
    ;} elseif ( $columns == '2' ) {
        $output = '<div class="2-column">';  
    ;} elseif ( $columns == '3' ) {    
        $output = '<div class="3-column">';     
    ;} else {    
        $output = '<div class="4-column">';  
    }

    if (have_posts($args)) : while (have_posts()) : the_post();
        $temp_title = get_the_title($post->ID);
        $temp_link = get_permalink($post->ID);
        $temp_excerpt = get_excerpt_by_id($post_id);
        $temp_image = get_the_post_thumbnail($post->ID, 'full');
     if( $image == 'yes' ) {
        $output .= '<div><a href="'.$temp_link.'">'.$temp_image.'</a><h2 class="recentposts_carousel"><a href="'.$temp_link.'">'.$temp_title.'</a></h2><p>'.$temp_excerpt.'</p></div>';
     ;} else {    
        $output .= '<div><h2 class="recentposts_carousel"><a href="'.$temp_link.'">'.$temp_title.'</a></h2><p>'.$temp_excerpt.'</p></div>';  
    }

    endwhile; 
   
      $output .= '</div>';
      
   endif;
   
   wp_reset_query();
   return $output;
}
add_shortcode('recentposts-carousel', 'recentposts_cat_func');


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////             Carousel widget                 /////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////


include_once( 'cr3ativ-recentposts-carousel-widget.php' );

?>