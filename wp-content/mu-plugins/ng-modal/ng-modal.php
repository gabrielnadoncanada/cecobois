<?php
/**
 * Plugin Name:       Ng Modal
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ng-modal
 *
 * @package           create-block
 */


function create_block_ng_modal_block_init() {
	register_block_type( __DIR__ . '/build');
}
add_action( 'init', 'create_block_ng_modal_block_init' );

add_action('enqueue_block_assets', function(){
	if(!is_admin()){
		wp_enqueue_script('ng-modal', plugin_dir_url(__FILE__) . '/inc/modal.js', array(), '1.0.0', true);
	}
});
