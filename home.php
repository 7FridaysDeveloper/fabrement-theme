<?php
/**
 * Front page while it lists the latest posts: a welcome page.
 * The posts page of a site with its own homepage keeps the plain list.
 *
 * @package Fabrement_Theme
 */

defined( 'ABSPATH' ) || exit;

if ( ! fabrement_theme_is_welcome() ) {
	get_template_part( 'index' );
	return;
}

$fabrement_site_url = 'https://fabrement.com/';
$fabrement_is_admin = current_user_can( 'manage_options' );
// The plugin's MCP Connection screen, Agents tab; fabrement.com while the plugin is off.
$fabrement_connect = class_exists( '\Fabrement\Modules\Mcp\OAuth\Config' )
	? \Fabrement\Modules\Mcp\OAuth\Config::settings_url()
	: $fabrement_site_url;
$fabrement_version = (string) wp_get_theme()->get( 'Version' );
$fabrement_image   = static function ( string $file ) use ( $fabrement_version ): string {
	return add_query_arg( 'ver', $fabrement_version, get_theme_file_uri( 'assets/images/' . $file ) );
};
$fabrement_arrow   = '<svg width="28" height="28" viewBox="0 0 28 28" fill="none" aria-hidden="true"><path d="M2.33 15.17H22.85L16.68 21.34C16.56 21.45 16.47 21.58 16.41 21.72C16.35 21.86 16.32 22.02 16.32 22.17C16.32 22.33 16.35 22.48 16.41 22.62C16.46 22.77 16.55 22.9 16.66 23.01C16.77 23.12 16.9 23.2 17.04 23.26C17.19 23.32 17.34 23.35 17.5 23.35C17.65 23.35 17.8 23.31 17.95 23.25C18.09 23.19 18.22 23.1 18.32 22.99L26.49 14.82C26.71 14.61 26.83 14.31 26.83 14C26.83 13.69 26.71 13.39 26.49 13.18L18.32 5.01C18.1 4.8 17.81 4.68 17.5 4.68C17.2 4.68 16.91 4.81 16.69 5.02C16.47 5.24 16.35 5.53 16.35 5.84C16.35 6.14 16.46 6.44 16.68 6.66L22.85 12.83H2.33C2.02 12.83 1.73 12.96 1.51 13.18C1.29 13.39 1.17 13.69 1.17 14C1.17 14.31 1.29 14.61 1.51 14.82C1.73 15.04 2.02 15.17 2.33 15.17Z" fill="#595F6D"/></svg>';

get_header();
?>
<main id="main" class="fw">
	<img class="fw-deco fw-deco--top" src="<?php echo esc_url( $fabrement_image( 'deco-top.svg' ) ); ?>" width="672" height="703" alt="" aria-hidden="true" />
	<img class="fw-deco fw-deco--bottom" src="<?php echo esc_url( $fabrement_image( 'deco-bottom.svg' ) ); ?>" width="495" height="371" alt="" aria-hidden="true" />

	<div class="fw-box">
		<img class="fw-logo" src="<?php echo esc_url( $fabrement_image( 'logo.svg' ) ); ?>" width="246" height="66" alt="Fabrement" />

		<?php if ( $fabrement_is_admin ) : ?>
			<h1 class="fw-title"><?php esc_html_e( 'Welcome to your New Site', 'fabrement-theme' ); ?></h1>
			<p class="fw-lead"><?php esc_html_e( 'Tell your AI agent what you need — it will build the pages, blocks and menus right here.', 'fabrement-theme' ); ?></p>
		<?php else : ?>
			<h1 class="fw-title"><?php bloginfo( 'name' ); ?></h1>
			<p class="fw-lead"><?php esc_html_e( 'Something new is on its way. Come back soon.', 'fabrement-theme' ); ?></p>
		<?php endif; ?>

		<div class="fw-actions<?php echo $fabrement_is_admin ? '' : ' fw-actions--single'; ?>">
			<?php if ( $fabrement_is_admin ) : ?>
				<a class="fw-btn fw-btn--primary" href="<?php echo esc_url( $fabrement_connect ); ?>">
					<svg viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20H10.83V14.08C12.74 13.7 14.17 12.02 14.17 10V7.5H12.5V5C12.5 4.54 12.13 4.17 11.67 4.17C11.21 4.17 10.83 4.54 10.83 5V7.5H9.17V5C9.17 4.54 8.79 4.17 8.33 4.17C7.87 4.17 7.5 4.54 7.5 5V7.5H5.83V10C5.83 12.02 7.26 13.7 9.17 14.08V18.29C4.96 17.87 1.67 14.32 1.67 10C1.67 5.4 5.4 1.67 10 1.67C14.6 1.67 18.33 5.4 18.33 10C18.33 13.47 16.21 16.45 13.19 17.7L13.82 19.22C17.44 17.72 20 14.17 20 10C20 4.48 15.52 0 10 0Z" fill="#fff" fill-opacity=".6"/></svg>
					<?php esc_html_e( 'Connect MCP', 'fabrement-theme' ); ?>
				</a>
			<?php endif; ?>
			<a class="fw-btn fw-btn--outline" href="<?php echo esc_url( $fabrement_site_url ); ?>" target="_blank" rel="noopener">
				<svg viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M14.98 6.62C15.14 7.74 15.22 8.87 15.22 10C15.22 11.13 15.14 12.26 14.98 13.38H19.41C20.2 11.2 20.2 8.8 19.41 6.62H14.98ZM10 0C9.02 0 8.03 1 7.26 2.75C6.91 3.55 6.63 4.46 6.42 5.44H13.58C13.37 4.46 13.09 3.55 12.74 2.75C11.97 1 10.98 0 10 0ZM6.2 6.62C5.87 8.86 5.87 11.14 6.2 13.38H13.8C13.97 12.26 14.05 11.13 14.05 10C14.05 8.87 13.97 7.74 13.8 6.62H6.2ZM0.59 6.62C-0.2 8.8 -0.2 11.2 0.59 13.38H5.02C4.71 11.14 4.71 8.86 5.02 6.62H0.59ZM10 20C10.98 20 11.97 19 12.74 17.25C13.09 16.45 13.37 15.54 13.58 14.56H6.42C6.63 15.54 6.91 16.45 7.26 17.25C8.03 19 9.02 20 10 20ZM18.91 14.56H14.78C14.55 15.72 14.22 16.79 13.81 17.72C13.48 18.48 13.11 19.12 12.7 19.63C14.03 19.27 15.27 18.62 16.34 17.75C17.41 16.87 18.28 15.79 18.91 14.56ZM7.31 19.63C6.9 19.12 6.52 18.48 6.19 17.72C5.78 16.79 5.46 15.72 5.22 14.56H1.09C1.72 15.79 2.6 16.88 3.66 17.75C4.73 18.62 5.97 19.27 7.31 19.63ZM1.09 5.44H5.22C5.45 4.28 5.78 3.21 6.19 2.28C6.52 1.52 6.89 0.88 7.3 0.37C5.97 0.74 4.73 1.38 3.66 2.25C2.6 3.13 1.72 4.21 1.09 5.44ZM12.7 0.37C13.11 0.88 13.48 1.52 13.81 2.28C14.22 3.21 14.55 4.29 14.78 5.44H18.91C18.28 4.21 17.41 3.13 16.34 2.25C15.27 1.38 14.03 0.73 12.7 0.37Z" fill="#2CC486"/></svg>
				<?php esc_html_e( 'Visit fabrement.com', 'fabrement-theme' ); ?>
			</a>
		</div>

		<?php if ( $fabrement_is_admin ) : ?>
			<ol class="fw-steps">
				<li class="fw-steps__item"><span class="fw-steps__num">1</span><span class="fw-steps__label"><?php esc_html_e( 'Connect', 'fabrement-theme' ); ?></span></li>
				<li class="fw-steps__arrow" aria-hidden="true"><?php echo $fabrement_arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static markup. ?></li>
				<li class="fw-steps__item"><span class="fw-steps__num">2</span><span class="fw-steps__label"><?php esc_html_e( 'Describe', 'fabrement-theme' ); ?></span></li>
				<li class="fw-steps__arrow" aria-hidden="true"><?php echo $fabrement_arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static markup. ?></li>
				<li class="fw-steps__item"><span class="fw-steps__num">3</span><span class="fw-steps__label"><?php esc_html_e( 'Publish', 'fabrement-theme' ); ?></span></li>
			</ol>

			<p class="fw-note">
				<?php
				printf(
					/* translators: %s: link to Settings → Reading. */
					esc_html__( 'Only you see the steps. This page goes away once a homepage is set in %s.', 'fabrement-theme' ),
					'<a href="' . esc_url( admin_url( 'options-reading.php' ) ) . '">' . esc_html__( 'Settings → Reading', 'fabrement-theme' ) . '</a>'
				);
				?>
			</p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
