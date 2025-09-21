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

				// Custom Search Bar - Only on Home Page
				if (is_home() || is_front_page()) : ?>
				<div class="search-container" style="text-align: center; padding: 30px 0; width: 100%;">
					<div class="search-box" style="background: #fe676d; height: 80px; border-radius: 50px; padding: 15px; width: 800px; max-width: 90%; margin: 0 auto; display: inline-flex; align-items: center; position: relative; box-shadow: 0 8px 16px rgba(254, 103, 109, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.2), inset 0 -1px 0 rgba(0, 0, 0, 0.1); border: 1px solid rgba(255, 255, 255, 0.1);">
						<form role="search" method="get" action="<?php echo home_url(); ?>" style="display: flex; align-items: center; width: 100%; margin: 0;">
							<input type="text" class="search-input" name="s" placeholder="Search posts, categories, tags..." value="<?php echo get_search_query(); ?>" style="outline: none; border: none; background: rgba(255, 255, 255, 0.1); width: 500px; padding: 0 20px; color: #ffffff !important; font-size: 18px; transition: .3s; line-height: 80px; height: 80px; border-radius: 40px;">
							<button type="submit" class="search-btn" style="color: #fff; width: 60px; height: 60px; border-radius: 50px; background: #fe676d; display: flex; justify-content: center; align-items: center; text-decoration: none; transition: .3s; border: none; cursor: pointer; margin-left: auto; box-shadow: 0 4px 8px rgba(254, 103, 109, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.2); font-size: 18px;">
								<i class="fas fa-search"></i>
							</button>
						</form>
					</div>
				</div>
				<?php endif; ?>

				<style>
				.search-container .search-input::placeholder {
					color: #fff !important;
					opacity: 0.9;
				}
				.search-container .search-input:focus {
					background: rgba(255, 255, 255, 0.2) !important;
					width: 550px !important;
					padding: 0 25px !important;
				}
				.search-container .search-box:hover .search-input {
					background: rgba(255, 255, 255, 0.15) !important;
					width: 520px !important;
					padding: 0 22px !important;
				}
				.search-container .search-box:hover {
					box-shadow: 0 12px 24px rgba(254, 103, 109, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.3), inset 0 -1px 0 rgba(0, 0, 0, 0.1) !important;
					transform: translateY(-2px) !important;
				}
				.search-container .search-box:hover .search-btn,
				.search-container .search-input:focus + .search-btn {
					background: #fff !important;
					color: #fe676d !important;
					box-shadow: 0 6px 12px rgba(255, 255, 255, 0.3), inset 0 1px 0 rgba(254, 103, 109, 0.1) !important;
				}

				/* Responsive Design */
				@media (max-width: 768px) {
					.search-container .search-box {
						width: 90% !important;
						max-width: 500px !important;
						height: 60px !important;
						padding: 12px !important;
					}
					.search-container .search-input {
						width: 300px !important;
						background: rgba(255, 255, 255, 0.1) !important;
						font-size: 16px !important;
						height: 60px !important;
						line-height: 60px !important;
						padding: 0 15px !important;
						border-radius: 30px !important;
					}
					.search-container .search-btn {
						width: 50px !important;
						height: 50px !important;
						font-size: 16px !important;
					}
					.search-container .search-input:focus,
					.search-container .search-box:hover .search-input {
						width: 320px !important;
						background: rgba(255, 255, 255, 0.2) !important;
						padding: 0 18px !important;
					}
				}

				@media (max-width: 480px) {
					.search-container {
						padding: 20px 10px !important;
					}
					.search-container .search-box {
						width: 95% !important;
						max-width: 350px !important;
						height: 50px !important;
						padding: 10px !important;
					}
					.search-container .search-input {
						width: 220px !important;
						background: rgba(255, 255, 255, 0.1) !important;
						font-size: 14px !important;
						height: 50px !important;
						line-height: 50px !important;
						padding: 0 12px !important;
						border-radius: 25px !important;
					}
					.search-container .search-btn {
						width: 40px !important;
						height: 40px !important;
						font-size: 14px !important;
					}
					.search-container .search-input:focus,
					.search-container .search-box:hover .search-input {
						width: 240px !important;
						background: rgba(255, 255, 255, 0.2) !important;
						padding: 0 15px !important;
					}
				}
				</style>
				<?php

				do_action( 'TieLabs/before_main_content' );