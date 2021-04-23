<?php
// This file is part of miniOrange moodle plugin
//
// This plugin is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Useful functions for the plugin.
 *
 * @copyright   2021  miniOrange
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL v3 or later, see license.txt
 * @package     local_mo_api
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Get Attributes.
 *
 * @param string $value
 */
function local_mo_api_attribute_getter($value) {
    $config = get_config('local_mo_api');

    if (!empty($config->username)) {
        echo ',"'.$config->username.'":"'.$value->username.'"';
    }
    if (!empty($config->fname)) {
        echo ',"'.$config->fname.'":"'.$value->firstname.'"';
    }
    if (!empty($config->lname)) {
        echo ',"'.$config->lname.'":"'.$value->lastname.'"';
    }
    if (!empty($config->email)) {
        echo ',"'.$config->email.'":"'.$value->email.'"';
    }
    if (!empty($config->fullname)) {
        echo ',"'.$config->fullname.'":"'.$value->firstname.' '.$value->lastname.'"';
    }
    echo '}';
}
