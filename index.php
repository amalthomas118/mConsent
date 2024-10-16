<?php

get_header();

if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) :
		the_post();
		?>
        <div class="main_wrapper">
			<?php the_content(); ?>
        </div>
	<?php
	endwhile;

endif;

get_footer();
