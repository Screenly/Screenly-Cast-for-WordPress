<?php
/**
 * The header for our theme.
 *
 * @package ScreenlyCast
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<h1 class="site-title">
		<?php bloginfo('name'); ?>
	</h1>
</header>

<div id="page" class="site">
	<div id="content" class="site-content">
