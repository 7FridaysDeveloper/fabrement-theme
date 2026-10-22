<?php
/**
 * Fallback for any view the Fabrement plugin does not draw.
 *
 * @package Fabrement_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
			<article <?php post_class(); ?>>
				<?php
				if ( is_singular() ) {
					the_title( '<h1>', '</h1>' );
					the_content();
				} else {
					the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
					the_excerpt();
				}
				?>
			</article>
			<?php
		}
		the_posts_pagination();
	} else {
		echo '<p>' . esc_html__( 'Nothing found.', 'fabrement-theme' ) . '</p>';
	}
	?>
</main>
<?php
get_footer();
