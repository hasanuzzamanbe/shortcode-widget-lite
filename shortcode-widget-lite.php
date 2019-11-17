<?php

/*
Plugin Name: Shortcode Widget Lite
Plugin URI:  https://hasanuzzaman.com/shortcodewidget
Description: Show data from any shortcode in your widget.
Version: 1.0.0
Author: Hasanuzzaman
Author URI: https://hasanuzzaman.com
License: A "Slug" license name e.g. GPL2
Text Domain: shortcodewidgetlite
*/


/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Copyright 2019 Xaman LLC. All rights reserved.
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!defined('SHORTCODELITE_VERSION')) {
    define('SHORTCODELITE', true);
    define('SHORTCODELITE_VERSION', '1.0.0');
    define('SHORTCODELITE_MAIN_FILE', __FILE__);
    define('SHORTCODELITE_URL', plugin_dir_url(__FILE__));
    define('SHORTCODELITE_DIR', plugin_dir_path(__FILE__));

    class ShortcodeAttr
    {
        public function boot()
        {
            add_action('widgets_init', function ()
            {
                require_once(SHORTCODELITE_DIR . 'includes/ShortcodeAttrWidget.php');
                register_widget('ShortcodeAttr\includes\ShortcodeAttrWidget');
            });
        }

    }

    add_action('plugins_loaded', function () {
        (new ShortcodeAttr())->boot();
    });

} else {
    add_action('admin_init', function () {
        deactivate_plugins(plugin_basename(__FILE__));
    });
}
