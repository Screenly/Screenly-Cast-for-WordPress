<?php
/**
 * The header for our theme.
 *
 * @package ScreenlyCast
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );
?>
<!doctype html>
<html>
	<head>
		<!--
			META CONFIG
		-->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!--
			CSS
		-->
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

		<?php
		$logo = get_option( 'screenly_options_logo' );
		if ( ! empty( $logo ) ) {
			echo '<img src="' . esc_url( $logo ) . '" id="brand-logo" width="314" height="98">';
		}
		?>
