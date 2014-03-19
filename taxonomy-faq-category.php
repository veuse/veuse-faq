<?php

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

			<?php

			$current_tax =  $wp_query->tax_query->queries[0]['taxonomy'];
			$queried_term = get_query_var($current_tax);
			$term_data = get_term_by( 'slug', $queried_term, $current_tax );

			echo do_shortcode('[faq categories="' . $term_data->slug . '"]');

			?>


		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>