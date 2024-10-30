<?php
/*
Plugin Name: Kevin's Plugin
Plugin URI:
Description: Insert whatever you want into the header or footer
Version: 2.0.0
Author: Kevin McCabe
Author URI:
License: GPL2
*/
?>
<?php
/*  Copyright 2020  Kevin McCabe  (email : kevin.mccabe@locallighthouse.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
function kmc_footer($var){
	echo get_option('kmc_footer_data');	
}
function kmc_header($var){
	echo get_option('kmc_header_data');
	
}
function kmc_activate(){
	
}
function kmc_admin_menu(){
	add_options_page('Plugin Admin Options', 'Kevins Plugin Settings', 'manage_options',
'kmc_plugin', 'plugin_admin_options_page');
}
function plugin_admin_options_page() {
	if(isset($_POST['action']) && $_POST['action']=='update'){
		$post_header=$_POST['kmc_header_data'];
		$post_footer=$_POST['kmc_footer_data'];
		if(1){
			$post_header = stripslashes_deep($post_header);
			$post_footer = stripslashes_deep($post_footer);
		}
		update_option("kmc_header_data", $post_header);
		update_option("kmc_footer_data", $post_footer);
		
		}
?>
<div class="wrap">
<?php screen_icon(); ?>
<h2>Kevin's Plugin Options Page</h2>
<p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<?php wp_nonce_field('update-options'); ?>
<b>Header:</b> <br />
<textarea cols="50" rows="6" name="kmc_header_data" id="kmc_header_data"><?php echo get_option('kmc_header_data'); ?></textarea><br />
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="kmc_header_data" />
<b>Footer:</b> <br />
<textarea cols="50" rows="6" name="kmc_footer_data" id="kmc_footer_data"><?php echo get_option('kmc_footer_data'); ?></textarea><br />

<input type="submit" value="Save Changes" />
</form>
</p>
</div>
<?php
}

add_action ('wp_footer', 'kmc_footer');
add_action('wp_head', 'kmc_header');
register_activation_hook(__FILE__,'kmc_activate');
add_action('admin_menu', 'kmc_admin_menu');
