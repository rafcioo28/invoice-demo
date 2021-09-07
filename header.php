<?php
/**
 * Header file.
 *
 * @package WordPress
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<header>
			<img class="logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.jpg" width="46" height="46" alt="logo">
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'top-menu',
					'container_class' => 'top-menu',
				)
			);
			$curr_user = wp_get_current_user();
			if ( 0 !== $curr_user->ID ) :
				?>
				<div class="user-name">
					<?php
					echo esc_html( $curr_user->display_name );
					?>
				</div>
				<?php
			endif;
			?>
		</header>
