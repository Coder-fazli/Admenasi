<?php
/**
 * The main template file
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

get_header(); ?>

	<!-- TEST ERROR BANNER - REMOVE AFTER TESTING -->
	<div style="background: red; color: white; text-align: center; padding: 20px; font-size: 24px; font-weight: bold; border: 5px solid yellow;">
		🚨 JANNAH THEME TEST - DEPLOYMENT WORKING! 🚨<br>
		Changes are being deployed to Jannah theme successfully!
	</div>

	<div <?php tie_content_column_attr(); ?>>

		<?php if ( have_posts() ) :

			// Get the layout template part
			TIELABS_HELPER::get_template_part( 'templates/archives', '', array(
				'layout'          => tie_get_option( 'blog_display', 'excerpt' ),
				'excerpt'         => tie_get_option( 'blog_excerpt' ),
				'excerpt_length'  => tie_get_option( 'blog_excerpt_length' ),
				'read_more'       => tie_get_option( 'blog_read_more' ),
				'read_more_text'  => tie_get_option( 'blog_read_more_text' ),
			));

			do_action( 'TieLabs/before_frontpage_pagination' );

			// Page navigation
			TIELABS_PAGINATION::show( array( 'type' => tie_get_option( 'blog_pagination' ) ) );

			do_action( 'TieLabs/after_frontpage_pagination' );

		// If no content, include the "No posts found" template
		else :
			TIELABS_HELPER::get_template_part( 'templates/not-found' );

		endif;

		?>

	</div><!-- .main-content /-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
