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
 * Custom Exception thrown when an error is returned by the Slack API.
 *
 * @link        https://github.com/caringkitsforkids/slack-connector/blob/main/includes/Exception/class-SlackException.php
 * @since       1.0.0
 *
 * @package     caringkitsforkids/slack_connector
 * @subpackage  caringkitsforkids/slack_connector/includes/Exception
 */
class SlackException extends \RuntimeException
{
}