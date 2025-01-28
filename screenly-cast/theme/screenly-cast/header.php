<?php
/**
 * The header for our theme.
 *
 * @package ScreenlyCast
 */
defined('ABSPATH') or die("No script kiddies please!");
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
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500" rel="stylesheet">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class()?>>

        <?php
        $logo = get_option('screenly_options_logo');
        if (!empty($logo)) {
            echo '<img src="'.$logo.'" id="brand-logo" width="314" height="98">';
        }
        ?>
