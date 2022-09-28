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
 * Fired during plugin deactivation
 *
 * @link    	https://github.com/caringkitsforkids/slack-connector/blob/main/includes/class-deactivator.php
 * @since    	1.0.0
 *
 * @package   	caringkitsforkids/slack_connector
 * @subpackage	caringkitsforkids/slack_connector/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since    	1.0.0
 * @package   	caringkitsforkids/slack_connector
 * @subpackage	caringkitsforkids/slack_connector/includes
 * @author    	hannjosh <64873478+hannjosh@users.noreply.github.com>
 */
class Deactivator 
{

	/**
	 * The process ran when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() 
	{
		// Silence is golden.
	}

}
