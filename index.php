<?php
/**
 * Main loop file.
 *
 * @package WordPress
 */

get_header();
?>
<main>
	<?php
	while ( have_posts() ) :
		the_post();
	endwhile;
	?>
</main>
<?php
get_footer();
?>
