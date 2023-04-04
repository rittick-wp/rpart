<?php get_header(); ?>
<div class="container">
<?php
				while ( have_posts() ) {
					the_post();
					the_title(
			sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h2>');

					the_content();

				
				}
				?>
			</div>
<?php get_footer(); ?>