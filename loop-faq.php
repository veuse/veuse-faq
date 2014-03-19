<div class="veuse-faq-list">
<?php
global $post;
foreach( $faq_query as $post ) :setup_postdata($post); ?>
		<dl class="veuse-faq-toggle">
		  	<dt class="veuse-faq-toggle-title"><?php the_title();?></dt>
		    <dd class="veuse-faq-toggle-content" style="display:none;">
		      <?php if (!empty($post->post_content))
					the_content($post->ID); ?>
		    </dd>
		</dl>
<?php endforeach; ?>
</div>
