<?php
/**
 * Plugin Name: ACF Feather Icon Field
 * Plugin URI: https://github.com/rhuanbarreto/acf-feather-icon-field
 * Description: Adds a Feather Icon field type to Advanced Custom Fields Pro
 * Version: 1.0.0
 * Author: Rhuan Carlos
 * Author URI: https://rhuan.dev
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: acf-feather-icon
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// Check if ACF Pro is active
add_action('plugins_loaded', function() {
    if (!class_exists('ACF')) {
        add_action('admin_notices', function() {
            ?>
            <div class="notice notice-error">
                <p><?php _e('ACF Feather Icon Field requires Advanced Custom Fields PRO to be installed and activated.', 'acf-feather-icon'); ?></p>
            </div>
            <?php
        });
        return;
    }

    // Include the field type class
    require_once plugin_dir_path(__FILE__) . 'fields/class-acf-field-feather-icon.php';
}); 