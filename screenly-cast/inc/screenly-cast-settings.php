<?php
/**
 * Settings page functionality for Screenly Cast.
 *
 * @package ScreenlyCast
 */

declare(strict_types=1);

namespace ScreenlyCast;

/**
 * Initialize settings.
 */
function srly_settings_init(): void {
	// Register settings section.
	add_settings_section(
		'screenly_cast_general',
		esc_html__( 'General Settings', 'screenly-cast' ),
		null,
		'screenly-cast-settings'
	);

	// Register settings field.
	add_settings_field(
		'screenly_cast_logo',
		esc_html__( 'Logo', 'screenly-cast' ),
		'srly_logo_field',
		'screenly-cast-settings',
		'screenly_cast_general'
	);

	// Register setting.
	register_setting(
		'screenly_cast_settings',
		'screenly_cast_logo',
		array(
			'type'              => 'string',
			'description'       => esc_html__( 'Logo URL', 'screenly-cast' ),
			'sanitize_callback' => 'esc_url_raw',
		)
	);
}
add_action( 'admin_init', 'srly_settings_init' );

/**
 * Render the settings section input.
 */
function srly_section_input(): void {
	printf(
		'<p>%s</p>',
		esc_html__( 'Configure your Screenly Cast settings.', 'screenly-cast' )
	);
}

/**
 * Render the logo field.
 */
function srly_logo_field(): void {
	$value = get_option( 'screenly_cast_logo', '' );
	$var   = esc_attr( $value );
	$path  = esc_url( $value );
	printf(
		'<input type="text" id="screenly_cast_logo" name="screenly_cast_logo" value="%s" class="regular-text" />',
		esc_attr( $value )
	);
	esc_html_e( 'Enter the URL of your logo.', 'screenly-cast' );
}

/**
 * Add the options page.
 */
function srly_options_page(): void {
	// Add the options page to the Settings menu.
	add_options_page(
		esc_html__( 'Screenly Cast Settings', 'screenly-cast' ),
		esc_html__( 'Screenly Cast', 'screenly-cast' ),
		'manage_options',
		'screenly-cast-settings',
		'srly_options_page_html'
	);
}
add_action( 'admin_menu', 'srly_options_page' );

/**
 * Render the options page HTML.
 */
function srly_options_page_html(): void {
	// Check user capabilities.
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// Check nonce.
	if ( isset( $_POST['_wpnonce'] ) && ! wp_verify_nonce( sanitize_key( $_POST['_wpnonce'] ), 'screenly_cast_settings-options' ) ) {
		wp_die( esc_html__( 'Invalid nonce.', 'screenly-cast' ) );
	}

	// Show success message if settings were updated.
	if ( isset( $_GET['settings-updated'] ) ) {
		add_settings_error(
			'screenly_cast_messages',
			'screenly_cast_message',
			esc_html__( 'Settings Saved', 'screenly-cast' ),
			'updated'
		);
	}

	// Show error messages.
	settings_errors( 'screenly_cast_messages' );

	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			settings_fields( 'screenly-cast-settings' );
			do_settings_sections( 'screenly-cast-settings' );
			submit_button( esc_html__( 'Save Changes', 'screenly-cast' ) );
			?>
		</form>
	</div>
	<?php
}
?>
