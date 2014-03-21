<?php
/*
Plugin Name: Veuse FAQ
Plugin URI: http://veuse.com/veuse-faq
Description: For creating a faq-base on your website.
Version: 1.0
Author: Veuse
Author URI: http://veuse.com
License: GPL3
Text Domain: veuse-faq
Domain Path: /languages
*/



class VeuseFaq {

	private $pluginURI  = '';
	private $pluginPATH = '';
	
	function __construct(){
		
		$this->pluginURI  = plugin_dir_url(__FILE__) ;
		$this->pluginPATH = plugin_dir_path(__FILE__) ;
		
		add_action('init', array(&$this,'enqueue_scripts'));
		add_action('init', array(&$this,'register_faq'));
		add_action('plugins_loaded', array(&$this,'load_textdomain'));
		
		add_shortcode('veuse_faq', array(&$this,'veuse_faq_shortcode'));
							
	}
	
	
	/* Localization
	============================================= */	
	function load_textdomain() {
	    load_plugin_textdomain('veuse-faq', false, dirname(plugin_basename(__FILE__)) . '/languages');
	}
	
	
	/* Enqueue scripts
	============================================= */
	
	function enqueue_scripts() {
	
			/* CSS */
			wp_register_style( 'veuse-faq',  $this->pluginURI . 'assets/css/veuse-faq.css', array(), '', 'screen' );
			wp_enqueue_style ( 'veuse-faq' );
	
			/* JS */
	
			wp_enqueue_script('veuse-faq-toggle', $this->pluginURI . 'assets/js/veuse-faq.js', array('jquery'), '', true);
	
	}
	
	
	/* Register post-type
	============================================= */	
	function register_faq() {
	
		$labels = array(
	        'name' => __( 'FAQ', 'veuse-faq' ), // Tip: _x('') is used for localization
	        'singular_name' => __( 'FAQ', 'veuse-faq' ),
	        'add_new' => __( 'Add New FAQ', 'veuse-faq' ),
	        'add_new_item' => __( 'Add New FAQ','veuse-faq' ),
	        'edit_item' => __( 'Edit FAQ', 'veuse-faq' ),
	        'all_items' => __( 'All FAQ','veuse-faq' ),
	        'new_item' => __( 'New FAQ','veuse-faq' ),
	        'view_item' => __( 'View FAQ','veuse-faq' ),
	        'search_items' => __( 'Search FAQ','veuse-faq' ),
	        'not_found' =>  __( 'No FAQ','veuse-faq' ),
	        'not_found_in_trash' => __( 'No FAQ found in Trash','veuse-faq' ),
	        'parent_item_colon' => ''
	    );

		register_post_type('faq',
					array(
					'labels' => $labels,
					'public' => true,
					'show_ui' => true,
					'_builtin' => false, // It's a custom post type, not built in
					'_edit_link' => 'post.php?post=%d',
					'capability_type' => 'post',
					'hierarchical' => false,
					'rewrite' => array("slug" => "questions"), // Permalinks
					'query_var' => "faq", // This goes to the WP_Query schema
					'supports' => array('title','author','editor' /*,'custom-fields'*/),
					'menu_icon' => 'dashicons-editor-help',
					'menu_position' => 30,
					'publicly_queryable' => true,
					'exclude_from_search' => false,
					'show_in_nav_menus' => false
			)
		);

		$faqlabels = array(
	        'name' => __( 'FAQ Categories', 'veuse-faq' ), // Tip: _x('') is used for localization
	        'singular_label' => __( 'FAQ Category', 'veuse-faq' ),
	        'add_new' => __( 'Add New FAQ Category', 'veuse-faq' ),
	        'add_new_item' => __( 'Add New FAQ Category','veuse-faq' ),
	        'edit_item' => __( 'Edit FAQ Category', 'veuse-faq' ),
	        'all_items' => __( 'All FAQ Categories','veuse-faq' ),
	        'new_item' => __( 'New FAQ Category','veuse-faq' ),
	        'view_item' => __( 'View FAQ Category','veuse-faq' ),
	        'search_items' => __( 'Search FAQ Categories','veuse-faq' ),
	        'not_found' =>  __( 'No FAQ Categories found','veuse-faq' ),
	        'parent_item_colon' => ''
	    );


    	register_taxonomy("faq-category",
			array("faq"),
			array("hierarchical" => true,
					"labels" => $faqlabels,
					"rewrite" => true,
					'show_admin_column' => true,
					"show_ui" => true,
					'show_in_nav_menus' => false
					)
		);
	
	}
	
	

	
	/* Shortcode
	============================================= */
	function veuse_faq_shortcode( $atts, $content = null ) {

		 extract(shortcode_atts(array(
			'categories' 	=> '',
			'template'		=> 'page'
		), $atts));

		//$faqterms = get_terms( 'faq-category');
		$content = '';
		$categories = explode(',', $categories);

		foreach ($categories as $term):

			if ($template == 'page'){


				$args = array(
			    'post_type' => 'faq',
			    'post_status' => 'publish',
			    'orderby'	=> 	'menu_order',
			    'posts_per_page' => -1,
			    'order' => 'ASC',
			    'tax_query' => 
			    	array(
				    	array(
				            'taxonomy' => 'faq-category',
				            'field' => 'slug',
				            'terms' => $term
				        )
				   )
				);

				$faq_query = get_posts( $args );
			}

			else{
				$args = array(
			    'post_type' => 'faq',
			    'post_status' => 'publish',
			    'orderby'	=> 	'menu_order',
			    'posts_per_page' => -1,
			    'order' => 'ASC',
			    'tax_query' => array(
						        array(
						            'taxonomy' => 'faq-category',
						            'field' => 'slug',
						            'terms' => $term
						            )
						         )
						      );


				$faq_query = get_posts( $args );
			}

		$termname = get_term_by( 'slug', $term, 'faq-category');


		//$content .= '<div class="toggle-container">';
		//$content .= '<h4>' . $termname->name . '</h4>';

		ob_start();
		include($this->veuse_faq_locate_part('loop-faq','template-parts'));
		$content.= ob_get_contents();
		ob_end_clean();

		//$content.= '</div>';

		wp_reset_query();
		endforeach;
		

		return $content;


	}
	
	
	
	/* Find template part
	
	Makes it possible to override the loop with
	a custom theme loop-slider.php
	
	============================================ */
	
	function veuse_faq_locate_part($file) {
	
		     if ( file_exists( get_stylesheet_directory().'/'. $file .'.php')){
		     	$filepath = get_stylesheet_directory().'/'. $file .'.php';
		     }
		     elseif ( file_exists(get_template_directory().'/'. $file .'.php')){
		     	$filepath = get_template_directory().'/'. $file .'.php';
		     }
		     else {
		        $filepath = $this->pluginPATH . $file.'.php';
		       }
		     return $filepath;
	}


	
	
}

$veuse_faq = new VeuseFaq;


require_once('widget.php');
require_once('documentation/documentation.php');

		

?>