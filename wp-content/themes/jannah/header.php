<?php
/**
 * The template for displaying the header
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body id="tie-body" <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div class="background-overlay">

	<div id="tie-container" class="site tie-container">

		<?php do_action( 'TieLabs/before_wrapper' ); ?>

		<div id="tie-wrapper">
			<?php

				TIELABS_HELPER::get_template_part( 'templates/header/load' );

				// Custom Search Bar
				?>
				<div class="custom-search-container">
					<div class="search-box">
						<form role="search" method="get" action="<?php echo home_url(); ?>">
							<input type="text" class="search-input" name="s" placeholder="Start Looking For Something!" value="<?php echo get_search_query(); ?>">
							<button type="submit" class="search-btn">
								<i class="fas fa-search"></i>
							</button>
						</form>
					</div>
				</div>
				<?php

				do_action( 'TieLabs/before_main_content' );