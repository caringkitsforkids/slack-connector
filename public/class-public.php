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
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/caringkitsforkids/slack-connector/blob/production/public/class-public.php
 * @since      1.0.0
 *
 * @package    caringkitsforkids/slack_connector
 * @subpackage caringkitsforkids/slack_connector/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    caringkitsforkids/slack_connector
 * @subpackage caringkitsforkids/slack_connector/public
 * @author     hannjosh <64873478+hannjosh@users.noreply.github.com>
 */
class Slack_Connector_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	
	/**
	 * The Slack class which acts as an Interface between WordPress and the Slack API.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      Slack    $_Slack    .
	 */
	private Slack $_Slack;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name  	The name of the plugin.
	 * @param    string    $version      	The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-Slack.php';
		
		$this->_Slack = new Slack( CARINGKITSFORKIDS_SLACK_CONNECTOR_TOKEN );

	}
	
	/**
	 * Sends a message to a channel in Slack.
	 *
	 * @param 	string        	$channel	Channel, private group, or IM channel to send a message to. Can be an encoded ID, or the channel's name. E.g. (#announcements) 
	 * @param 	string       	$blocks   	A JSON-based array of structured blocks.
	 *
	 * @throws 	SlackException	Thrown if the Slack API returns an error.
	 */
	public function post_message( string $channel, string $blocks ) {
		$this->_Slack->post_message( $channel, $blocks );	
	}

	/**
	 * Uploads or creates a file.
	 *
	 * @param 	string        	$channels         	Comma-separated list of channel names or IDs where the file will be shared.      
	 * @param 	string        	$initial_comment	The message text introducing the file in specified channels.
	 * @param 	string        	$filename       	Filename of file. E.g. "foobar"
	 * @param 	string  		$filetype          	A file type identifier. E.g. "pdf"
	 * @param 	string        	$file           	File contents via multipart/form-data.
	 *
	 * @throws 	SlackException	Thrown if the Slack API returns an error.
	 */
	public function files_upload(  string $channels, string $message, string $file_name, string $file_type, $file ) {
		$this->_Slack->files_upload( $channels, $message, $file_name, $file_type, $file );
	}

}
