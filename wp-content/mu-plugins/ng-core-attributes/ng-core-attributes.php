<?php
/**
 * Plugin Name:       Ng Core Attributes
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ng-core-attributes
 *
 * @package           create-block
 */

add_action('enqueue_block_editor_assets', function () {
	wp_enqueue_script(
		'extend-block-core-attributes-js',
		esc_url(plugins_url('/build/index.js', __FILE__)),
		array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'),
		'1.0.0',
		true
	);
});

