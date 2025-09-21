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

				// Custom Search Bar with Inline Styles
				?>
				<div style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 40px 20px; display: flex; justify-content: center; align-items: center; width: 100%; border: 2px solid red; min-height: 100px; margin: 0 auto; clear: both; text-align: center; box-sizing: border-box;">
					<div style="position: relative; background: linear-gradient(45deg, #cd595a, #e67e22); height: 60px; border-radius: 50px; padding: 10px; display: flex; align-items: center; box-shadow: 0 8px 25px rgba(205, 89, 90, 0.3); max-width: 1000px; width: 90%; min-width: 600px; margin: 0 auto; box-sizing: border-box;">
						<form role="search" method="get" action="<?php echo home_url(); ?>" style="display: flex; align-items: center; width: 100%; margin: 0;">
							<input type="text" name="s" placeholder="Start Looking For Something!" value="<?php echo get_search_query(); ?>" style="outline: none; border: none; background: none; width: 700px; padding: 0 30px; color: #fff; font-size: 20px; line-height: 60px; height: 60px; font-weight: 500; letter-spacing: 0.5px; flex: 1; box-sizing: border-box;">
							<button type="submit" style="color: #fff; width: 60px; height: 60px; border-radius: 50px; background: linear-gradient(45deg, #e67e22, #f39c12); display: flex; justify-content: center; align-items: center; border: none; cursor: pointer; margin-left: auto; font-size: 20px; position: relative; overflow: hidden; box-sizing: border-box;">
								🔍
							</button>
						</form>
					</div>
				</div>
				<?php

				do_action( 'TieLabs/before_main_content' );