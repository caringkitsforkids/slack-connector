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
 * Defines a class which acts as an Interface between WordPress and the Slack API.
 *
 * @link     	https://github.com/caringkitsforkids/slack-connector/blob/main/includes/class-Slack.php
 * @since    	1.0.0
 *
 * @package  	caringkitsforkids/slack_connector
 * @subpackage	caringkitsforkids/slack_connector/includes
 * @author  	hannjosh <64873478+hannjosh@users.noreply.github.com>
 */
class Slack 
{

	/**
	 * Access token (Authentication token) bearing required scopes.
	 *
	 * Access tokens are the keys to the Slack platform. An Access Token ties together the scopes
	 * and permissions an app has obtained, allowing it to read, write, and interact.
	 *
	 * Read more about Access tokens (Authentication tokens) in Slack at: https://api.slack.com/authentication/token-types.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var  	string   	$_access_token  Access token (Authentication token) bearing required scopes.
	 */
	private string $_access_token;

	/**
	 * Copies the access token (Authentication token) bearing required scopes set at initialization into a private variable.
	 * 
	 * Additionally includes a custom Exception (SlackException), which is thrown when the Slack API returns an error.
	 * 
	 * @param 	string		$access_token	Access token (Authentication token) bearing required scopes
	 *
	 * @since	1.0.0
	 */
	function __construct( string $access_token ) 
	{
		// Copy the access token defined at initialization into a private variable.
		$this->_access_token = $access_token;

		// Include the custom Exception (SlackException), which is thrown when the Slack API returns an error.
		require_once 'Exception/class-SlackException.php';

	}

	/**
	 * Sends a message to a channel in Slack.
	 *
	 * @param 	string        	$channel	Channel, private group, or IM channel to send a message to. Can be an encoded ID, or the channel's name. E.g. (#announcements) 
	 * @param 	string       	$blocks   	A JSON-based array of structured blocks.
	 *
	 * @throws 	SlackException	Thrown if the Slack API reports an error.
	 */
	public function post_message( string $channel, string $blocks ) 
	{

		$response = wp_remote_post( 
			'https://slack.com/api/chat.postMessage', 
			array(
				'headers' => array(
					'Content-Type' => 'application/x-www-form-urlencoded',
					'Authorization' => 'Bearer ' . $this->_access_token
				),
				'body' => array(
					'channel' => $channel,
					'blocks' => $blocks
				)
			) 
		);

		$body = json_decode( wp_remote_retrieve_body( $response ) );

		if( isset( $body->error ) ) {
			throw new SlackException( $body->error );
		}

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
	 * @throws 	SlackException	Thrown if the Slack API reports an error.
	 */
	public function files_upload( string $channels, string $message, string $filename, string $filetype, $file ) 
	{

		$response = wp_remote_post( 
			'https://slack.com/api/files.upload', 
			array(
				'headers' => array(
					'Content-Type' => 'application/x-www-form-urlencoded',
					'Authorization' => 'Bearer ' . $this->_access_token
				),
				'body' => array(
					'channels' => $channels,
					'initial_comment' => $initial_comment,
					'filename' => $file_name . '.' . $file_type,
					'filetype' => $file_type,
					'content' => $file
				)
			) 
		);

		$body = json_decode( wp_remote_retrieve_body( $response ) );

		if( isset( $body->error ) ) {
			throw new SlackException( $body->error );
		}

	}

}
