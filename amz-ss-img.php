<?php
/*

    Plugin Name: Image Manipulation for Amazon SiteStripe
    Plugin URI: https://lachlanallison.com/image-manipulation-for-amazon-sitestripe
    Description: A plugin to manipulate Amazon SiteStripe images and add a CTA button.
    Version: 1.0
    Author: Lachlan Allison
    Author URI: https://lachlanallison.com
    License: GPLv3 or later
    License URI: https://opensource.org/licenses/GPL-3.0

    Image Manipulation for Amazon SiteStripe is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 2 of the License, or
    any later version.
    
    Image Manipulation for Amazon SiteStripe is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU General Public License
    along with Image Manipulation for Amazon SiteStripe. If not, see https://opensource.org/licenses/GPL-3.0.

*/

function imas_register_settings() {
    register_setting( 'imas_options_group', 'imas_btn_color');
    register_setting( 'imas_options_group', 'imas_img_width');  
    add_option( 'imas_btn_color', '#4285f4');
    add_option( 'imas_img_width', '60');
}

function imas_register_options_page() {
    add_options_page('Image Manipulation for Amazon SiteStripe', 'Image Manipulation for Amazon SiteStripe', 'manage_options', 'amz-ss-img', 'imas_options_page');
}

function imas_options_page() {
    ?>
    <div>
    <?php screen_icon();?>
    <h2>Amazon SiteStripe Image Manipulation</h2>
    <form method="post" action="options.php">
    <?php settings_fields( 'imas_options_group' ); ?>
    <p>Here you can change the styling of Amazon SiteStripe images and the added CTA(Call to action button).</p>
    <table>
    <tr valign="top">
    <th scope="row"><label for="imas_img_width">Image Width (between 0-100)</label></th>
    <td><input type="text" id="imas_img_width" name="imas_img_width" value="<?php echo get_option('imas_img_width'); ?>" /></td>
    </tr>
    <tr valign="top">
    <th scope="row"><label for="imas_btn_color">Button Color</label></th>
    <td><input type="text" id="imas_btn_color" name="imas_btn_color" value="<?php echo esc_attr(get_option('imas_btn_color')); ?>" /></td>
    </tr>
    </table>
    <?php submit_button();?>
    </form>
    </div>  
    <?php
}

function imas_load_js_css(){
    wp_enqueue_script( 'amz-ss-img', plugin_dir_url( __FILE__ ) . 'amz-ss-img.js', array( 'jquery' ));
}

function imas_get_val(){
    echo get_option('imas_btn_color') . ',' . get_option('imas_img_width');
    return null;
}

add_action('wp_ajax_imas_get_val', 'imas_get_val');
add_action('wp_ajax_nopriv_imas_get_val', 'imas_get_val');
add_action('admin_init', 'imas_register_settings');
add_action('admin_menu', 'imas_register_options_page');
add_action('wp_enqueue_scripts', 'imas_load_js_css');