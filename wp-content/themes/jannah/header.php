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

				// Custom Search Bar - Your Original Design (Fixed)
				?>
				<div style="text-align: center; padding: 30px 0; width: 100%; background: #f5f5f5;">
					<div style="background: #cd595a; height: 40px; border-radius: 50px; padding: 10px; width: 800px; margin: 0 auto; display: inline-flex; align-items: center;">
						<form role="search" method="get" action="<?php echo home_url(); ?>" style="display: flex; align-items: center; width: 100%; margin: 0;">
							<input type="text" name="s" placeholder="Start Looking For Something!" value="<?php echo get_search_query(); ?>" style="outline: none; border: none; background: none; width: 480px; padding: 0 6px; color: #fff; font-size: 16px; transition: .3s; line-height: 40px; height: 40px;">
							<button type="submit" style="color: #fff; width: 40px; height: 40px; border-radius: 50px; background: #cd595a; display: flex; justify-content: center; align-items: center; text-decoration: none; transition: .3s; border: none; cursor: pointer; margin-left: auto;">
								🔍
							</button>
						</form>
					</div>
				</div>
				<script>
				document.addEventListener('DOMContentLoaded', function() {
					var searchBox = document.querySelector('div[style*="cd595a"][style*="800px"]');
					var searchInput = searchBox.querySelector('input');
					var searchBtn = searchBox.querySelector('button');

					searchBox.addEventListener('mouseenter', function() {
						searchInput.style.width = '600px';
						searchBtn.style.background = '#fff';
						searchBtn.style.color = '#cd595a';
					});

					searchBox.addEventListener('mouseleave', function() {
						searchInput.style.width = '480px';
						searchBtn.style.background = '#cd595a';
						searchBtn.style.color = '#fff';
					});

					searchInput.addEventListener('focus', function() {
						searchInput.style.width = '600px';
						searchBtn.style.background = '#fff';
						searchBtn.style.color = '#cd595a';
					});
				});
				</script>
				<?php

				do_action( 'TieLabs/before_main_content' );