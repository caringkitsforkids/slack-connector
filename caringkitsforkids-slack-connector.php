<?php
/**
 *  Connector for Slack
 *  Copyright (C) 2022  hannjosh
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/caringkitsforkids/slack-connector
 * @since             1.0.0
 * @package           caringkitsforkids/slack_connector
 *
 * @wordpress-plugin
 * Plugin Name:       Connector for Slack
 * Plugin URI:        https://github.com/caringkitsforkids/slack-connector
 * Description:       Registers hooks that allow a WordPress website to send messages and upload files to channels in a Slack workspace.
 * Version:           1.0.0
 * Author:            hannjosh
 * Author URI:        https://github.com/hannjosh
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       caringkitsforkids-slack-connector
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'CARINGKITSFORKIDS_SLACK_CONNECTOR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-activator.php
 */
function activate_caringkitsforkids_slack_connector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-activator.php';
	caringkitsforkids\slack_connector\Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-deactivator.php
 */
function deactivate_caringkitsforkids_slack_connector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-deactivator.php';
	caringkitsforkids\slack_connector\Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_caringkitsforkids_slack_connector' );
register_deactivation_hook( __FILE__, 'deactivate_caringkitsforkids_slack_connector' );


/**
 * The core plugin class that is used to define the hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-slack-connector.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_caringkitsforkids_slack_connector() {
	$plugin = new caringkitsforkids\slack_connector\Slack_Connector();
	$plugin->run();

}
	
run_caringkitsforkids_slack_connector();
