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

namespace caringkitsforkids\slack_connector;

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link      	https://github.com/caringkitsforkids/slack-connector/blob/main/includes/class-slack-connector.php
 * @since   	1.0.0
 *
 * @package 	caringkitsforkids/slack_connector
 * @subpackage	caringkitsforkids/slack_connector/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define hooks, that can be called to send messages
 * and create/upload files to Slack.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since   	1.0.0
 * @package   	caringkitsforkids/slack_connector
 * @subpackage	caringkitsforkids/slack_connector/includes
 * @author   	hannjosh <64873478+hannjosh@users.noreply.github.com>
 */
class Slack_Connector 
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected Loader $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected string $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected string $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the public-facing
	 * side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() 
	{

		if ( defined( 'CARINGKITSFORKIDS_SLACK_CONNECTOR_VERSION' ) ) {
			$this->version = CARINGKITSFORKIDS_SLACK_CONNECTOR_VERSION;

		} else {
			$this->version = '1.0.0';
			
		}

		$this->plugin_name = 'caringkitsforkids-slack-connector';
		
		$this->load_dependencies();
		
		$this->define_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Loader. Orchestrates the hooks of the plugin.
	 * - Public. Defines the actions that occur when hooks are called.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() 
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-loader.php';

		/**
		 * The class responsible for defining the actions that occur when hooks are called.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-public.php';
		
		$this->loader = new Loader();

	}

	/**
	 * Register all of the hooks related to the functionality of
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_hooks() 
	{

		$plugin = new Slack_Connector_Public( $this->get_plugin_name(), $this->get_version() );

		// Registers a hook that can be called to send a message to a channel in Slack.
		$this->loader->add_action( 'caringkitsforkids_slack_connector_chat.postMessage', $plugin, 'post_message', 10, 2 );
		
		// Registers a hook that can be called to upload or create a file in Slack.
		$this->loader->add_action( 'caringkitsforkids_slack_connector_files.upload', $plugin, 'files_upload', 10, 5 );
		
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function run() 
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it
	 *  within the context of WordPress.
	 *
	 * @since	1.0.0
	 * @access	public
	 * @return	string	The name of the plugin.
	 */
	public function get_plugin_name() 
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates
	 * the hooks with the plugin.
	 *
	 * @since	1.0.0
	 * @access	public
	 * @return	Loader	Orchestrates the hooks of the plugin.
	 */
	public function get_loader() 
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since	1.0.0
	 * @access	public
	 * @return	string	The version number of the plugin.
	 */
	public function get_version() 
	{
		return $this->version;
	}

}
