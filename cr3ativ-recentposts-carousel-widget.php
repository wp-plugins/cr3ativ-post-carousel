<?php 

class cr3ativ_recentposts_carousel extends WP_Widget {

	// constructor
	function cr3ativ_recentposts_carousel() {
        parent::__construct(false, $name = __('RecentPosts Carousel Loop', 'cr3atrecentposts') );
    }

	// widget form creation
	function form($instance) { 
// Check values
 if( $instance) { 
     $title = esc_attr($instance['title']);
     $showposts = esc_attr($instance['showposts']);
     $numbertodisplay = esc_attr($instance['numbertodisplay']); 
     $sortby = esc_attr($instance['sortby']); 
     $recentposts_carousel_category = esc_attr($instance['recentposts_carousel_category']);
     $thumbnail = esc_attr($instance['thumbnail']);
} else { 
     $title = ''; 
     $showposts = ''; 
     $numbertodisplay = ''; 
     $sortby = '';
     $recentposts_carousel_category = '';
     $thumbnail = '';
} 
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'cr3atrecentposts'); ?></label>
<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" style="float:right; width:56%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id('numbertodisplay'); ?>"><?php _e('# of Columns', 'cr3atrecentposts'); ?></label>
<select id="<?php echo $this->get_field_id('numbertodisplay'); ?>" name="<?php echo $this->get_field_name('numbertodisplay'); ?>"  style="float:right; width:56%;">
    <option selected="selected" value="none"><?php _e( 'Select One', 'cr3atrecentposts' ); ?></option>
    <option <?php if ( $numbertodisplay == '1' ) { echo ' selected="selected"'; } ?> value="1"><?php _e('One Column', 'cr3atrecentposts'); ?></option>
    <option <?php if ( $numbertodisplay == '2' ) { echo ' selected="selected"'; } ?> value="2"><?php _e('Two Column', 'cr3atrecentposts'); ?></option>
    <option <?php if ( $numbertodisplay == '3' ) { echo ' selected="selected"'; } ?> value="3"><?php _e('Three Column', 'cr3atrecentposts'); ?></option>
    <option <?php if ( $numbertodisplay == '4' ) { echo ' selected="selected"'; } ?> value="4"><?php _e('Four Column', 'cr3atrecentposts'); ?></option>
</select>
</p>
<p>
<label for="<?php echo $this->get_field_id('sortby'); ?>"><?php _e('Sort by ASC?', 'cr3atrecentposts'); ?></label>
<input id="<?php echo $this->get_field_id('sortby'); ?>" name="<?php echo $this->get_field_name('sortby'); ?>" type="checkbox" value="1" <?php checked( '1', $sortby ); ?> style="float:right; margin-right:6px;" />
</p>
<p>
<label for="<?php echo $this->get_field_id('showposts'); ?>"><?php _e('# of Posts', 'cr3atrecentposts'); ?></label>
<input id="<?php echo $this->get_field_id('showposts'); ?>" name="<?php echo $this->get_field_name('showposts'); ?>" type="text" value="<?php echo $showposts; ?>" style="float:right; width:56%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id('recentposts_carousel_category'); ?>"><?php _e('Carousel category', 'cr3atrecentposts'); ?></label>
<select id="<?php echo $this->get_field_id('recentposts_carousel_category'); ?>" name="<?php echo $this->get_field_name('recentposts_carousel_category'); ?>"  style="float:right; width:56%;" >
    <option selected="selected" value="none"><?php _e( 'Select One', 'cr3atrecentposts' ); ?></option>
    <option <?php if ( $recentposts_carousel_category == 'all' ) { echo ' selected="selected"'; } ?> value="all"><?php _e( 'All', 'cr3atrecentposts' ); ?></option>
    <?php $categories = get_categories(); ?> 
    <?php foreach ( $categories as $category ) { ?>
    <option<?php if ( $recentposts_carousel_category == $category->cat_name ) { echo ' selected="selected"'; } ?> value="<?php echo $category->cat_name; ?>"><?php echo $category->cat_name; ?></option>
    <?php } ?>
</select>
</p>
<p>
<label for="<?php echo $this->get_field_id('thumbnail'); ?>"><?php _e('Show thumbnail?', 'cr3atstaff'); ?></label>
<input id="<?php echo $this->get_field_id('thumbnail'); ?>" name="<?php echo $this->get_field_name('thumbnail'); ?>" type="checkbox" value="1" <?php checked( '1', $thumbnail ); ?> style="float:right; margin-right:6px;" />
</p>
            
<?php }
	// widget update
	function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['showposts'] = strip_tags($new_instance['showposts']);
      $instance['numbertodisplay'] = $new_instance['numbertodisplay'];
      $instance['sortby'] = strip_tags($new_instance['sortby']);
      $instance['recentposts_carousel_category'] = $new_instance['recentposts_carousel_category'];
      $instance['thumbnail'] = strip_tags($new_instance['thumbnail']);
     return $instance;
}

	// widget display
	function widget($args, $instance) {
   extract( $args );
   // these are the widget options
   $title = apply_filters('widget_title', $instance['title']);
   $showposts = $instance['showposts'];
   $numbertodisplay = $instance['numbertodisplay'];
   $recentposts_carousel_category = $instance['recentposts_carousel_category'];
   $thumbnail = $instance['thumbnail'];
   $sortby = $instance['sortby'];
   echo $before_widget;
   if( $sortby == '1' ) {
   $sortby = 'ASC';
   } else {
   $sortby = 'DESC';
   }
   if( $recentposts_carousel_category != ('all') ) {      
		global $post;  
		$carousel = array(
		'post_type' => 'post',
		'order' => $sortby,
        'showposts' => $showposts,
        'category_name' => $recentposts_carousel_category
		); 
   } else {
       global $post;  
		$carousel = array(
		'post_type' => 'post',
		'order' => $sortby,
        'showposts' => $showposts
        );
   }
   
   // Check if title is set
   if ( $title ) {
      echo $before_title . $title . $after_title;
   }	
   
   // Display the widget
?> 
<?php if( $numbertodisplay == '1' ) { ?>
<div class="1-column">
<?php ;} elseif ( $numbertodisplay == '2' ) { ?>
<div class="2-column">    
<?php ;} elseif ( $numbertodisplay == '3' ) { ?>    
<div class="3-column">       
<?php ;} else { ?>    
<div class="4-column">   
<?php ;} ?>   

    <?php query_posts($carousel); if (have_posts()) : while (have_posts()) : the_post(); ?>
        
<div>
    <?php if( $thumbnail == '1' ) { ?>

<a href="<?php the_permalink (); ?>"><?php the_post_thumbnail('full');?></a>

<h2 class="recentposts_carousel"><a href="<?php the_permalink (); ?>"><?php the_title (); ?></a></h2><br /><?php the_excerpt (); ?>
    
    <?php ;} else { ?>   
    
<h2 class="recentposts_carousel"><a href="<?php the_permalink (); ?>"><?php the_title (); ?></a></h2><br /><?php the_excerpt (); ?>
    
    <?php ;} ?>

</div>

<?php endwhile; ?>
    
<?php else: ?> 
<p><?php _e( 'There are no posts to display. Try using the search.', 'cr3atrecentposts' ); ?></p> 

<?php endif; ?><?php wp_reset_query(); ?>
    
</div>
  
<?php     
   
   echo $after_widget;
}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("cr3ativ_recentposts_carousel");'));


?>