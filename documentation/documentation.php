<?php


// Set-up Action and Filter Hooks
add_action('admin_init', 'veuse_faq_documentation_init' );
add_action('admin_menu', 'veuse_faq_documentation_add_options_page');


// Init plugin options to white list our options
function veuse_faq_documentation_init(){
	register_setting( 'veuse_faq_documentation_plugin_options', 'veuse_faq_documentation_options', 'veuse_faq_documentation_validate_options' );
}


// Add menu page
function veuse_faq_documentation_add_options_page() {
	//add_submenu_page('Veuse Documentation Page', 'FAQ documentation', 'manage_options', 'faq_documentation', 'veuse_faq_documentation_render_form');
	add_submenu_page( 'edit.php?post_type=faq', __('FAQ documentation page'), __('FAQ documentation'), 'edit_themes', 'theme_options', 'veuse_faq_documentation_render_form');
}



function veuse_faq_documentation_render_form(){

	
	$ct = wp_get_theme();
    $theme_data = $ct;
    $theme_name = 'Veuse FAQ'; 
	
	
	
	?>
	<style>
		#veuse-faq_documentation-wrapper a { text-decoration: none;}
		#veuse-faq_documentation-wrapper p {  }
		#veuse-faq_documentation-wrapper ul { margin-bottom: 30px !important;}
		ul.inline-list { list-style: disc !important; list-style-position: inside;}
		ul.inline-list li { display: inline; margin-right: 10px; list-style: disc;}
		ul.inline-list li:after { content:'-'; margin-left: 10px; }
	</style>
	<div class="wrap">

	
			
		<div id="veuse-documentation-wrapper" style="padding:20px 0; max-width:800px;">	

			<h1>FAQ Documentation</h1>
			<h4>Here you find instructions on how to use the Veuse FAQ plugin. For more in-depth info, please visit http://veuse.com/support.</h4>
			<hr>
			<p>The Veuse FAQ plugin lets you create and display questions and answers on your website. They are very easy and quick to create.</p>
			
			<h3>Create FAQ categories</h3>
			<p>To keep your FAQ organized, you can organize them in categories. To create a category, to go FAQ &raquo; FAQ Categories</p>
			
			<h3>Create FAQ posts</h3>
			<ol>
				<li>Go to FAQ &raquo; Add New FAQ</li>
				<li>Enter the question in the title field</li>
				<li>Enter the answer in the text editor</li>
				<li>Give the post a category</li>
				<li>Publish post</li>
			</ol>
			
			<h3>Display FAQ posts</h3>
			<p>FAQ can be displayed either via a shortcode, or via a widget, if you have the Page Builder plugin by Siteorigin installed</p>
			
			<code>[veuse_faq categories=""]</code>
			<p>For categories, enter the slug of the category you want to show</p>
		<div>
		<br>
		<hr>
		<br>
		<a href="http://veuse.com/support" class="button">Support forum</a>
		</div>
		</div>
		
	</div>
	<?php
}
?>