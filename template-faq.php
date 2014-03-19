<?php /* Template name: Faq */

__('Faq', 'ceon' ); /* Dummy call for template name translation. Stylesheet needs Template Name: ceon in theme definition. */

	get_header();

	global $options;


	/* ============================================================  */

	/*
		POST HEADER

		Insert post header above content if set in
		child theme config.php

	*/


		if( CEON_CONTENT_HEADER == 'outside'): // Defined in child theme config.php

				if(function_exists('veuse_locate_part')) :

				include_once(veuse_locate_part( $file = 'content-header', $dir = 'template-parts'));

				else:

				get_template_part('content', 'header');

				endif;

		endif;




/* ============================================================  */ ?>
<div id="content" <?php post_class();?>>

	<div class="row">



		<?php do_action('ceon_content_alpha');


		/* ============================================================  */

		/*
			PAGEBUILDER MODULES

			Loop through the post's selected modules,
			and inserts them on the post.

			The function is located in
			wp-content/plugins/veuse-pagebuilder/veuse-pagebuilder.php

		*/

			if(function_exists('veuse_insert_modules'))

			do_action('veuse_insert_modules'); // Insert selected modules

			else

			get_template_part('content','single'); // Insert the content if pagebuilder is not installed

		/* ============================================================  */


		?>

		<div class="small-12 columns">


		<?php

		/* Get term slugs into string */
		$faqterms = get_terms( 'faq-category');
		$terms = '';
		foreach($faqterms as $term){
			$terms.= $term->slug.',';
		}
		$terms = rtrim($terms, ",");


		echo do_shortcode('[faq categories="' . $terms . '" template="page"]');

?>

		</div>

		<?php do_action('ceon_content_omega').get_sidebar();?>

	</div>
</div>
<?php get_footer();?>