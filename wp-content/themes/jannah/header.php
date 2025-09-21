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

				// Custom Search Bar - Your Original Design (Fixed Text & Icon)
				?>
				<div style="text-align: center; padding: 30px 0; width: 100%;">
					<div class="search-box" style="background: #cd595a; height: 40px; border-radius: 50px; padding: 10px; width: 800px; margin: 0 auto; display: inline-flex; align-items: center; position: relative;">
						<form role="search" method="get" action="<?php echo home_url(); ?>" style="display: flex; align-items: center; width: 100%; margin: 0;">
							<input type="text" class="search-input" name="s" placeholder="Start Looking For Something!" value="<?php echo get_search_query(); ?>" style="outline: none; border: none; background: none; width: 240px; padding: 0 6px; color: #ffffff !important; font-size: 16px; transition: .3s; line-height: 40px; height: 40px;">
							<button type="submit" class="search-btn" style="color: #fff; width: 40px; height: 40px; border-radius: 50px; background: #cd595a; display: flex; justify-content: center; align-items: center; text-decoration: none; transition: .3s; border: none; cursor: pointer; margin-left: auto;">
								<i class="fas fa-search"></i>
							</button>
						</form>
					</div>
				</div>

				<style>
				.search-input::placeholder {
					color: #dbc5b0 !important;
				}
				.search-input:focus,
				.search-input:not(:placeholder-shown) {
					width: 240px !important;
					padding: 0 6px !important;
				}
				.search-box:hover .search-input {
					width: 240px !important;
					padding: 0 6px !important;
				}
				.search-box:hover .search-btn,
				.search-input:focus + .search-btn,
				.search-input:not(:placeholder-shown) + .search-btn {
					background: #fff !important;
					color: #cd595a !important;
				}
				</style>
				<?php

				do_action( 'TieLabs/before_main_content' );