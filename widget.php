<?php

class VeuseFaqWidget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'veuse_faq_widget', // Base ID
			__('FAQ (Veuse)','veuse-faq'), // Name
			array( 'description' => __( 'Add a faq-section to your page', 'veuse-uikit' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$category = $instance['category'];
		
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			?>
			
			<?php
			
			echo do_shortcode('[veuse_faq categories="'.$category.'"]');
			
		
		echo $after_widget;
	}


	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
				
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
		
		return $instance;
	}

	 
	public function form( $instance ) {
	
		global $widget, $wp_widget_factory, $wp_query;
		
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];	else $title = __( '', 'text_domain' );		
		isset($instance['category']) ? $category = $instance['category'] : $category = 'white';
		
				
		
		
		
		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Text:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
			
		<p>
			<label category="min-width:100px;" for="<?php echo $this->get_field_id('category');?>"><?php _e('Style:','veuse-pagelist');?></label>
			<select name="<?php echo $this->get_field_name('category');?>">
			
				<?php
				$terms = get_terms( 'faq-category', array('hide_empty' => 1 ));
        
		        if( $terms ){
		                              
		            foreach( $terms as $term ){
		            	?>
		            	<option value="<?php echo $term->slug;?>" <?php selected( $category, $term->slug, true); ?>><?php echo $term->name;?></option>
		            	
		            	<?php
		            }            
		        }
		        ?>
		   	</select>
		</p>
		
		<p>
	

		

		<?php

	}

} 

add_action('widgets_init',create_function('','return register_widget("VeuseFaqWidget");'));
 
?>