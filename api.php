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
 * This file contains api call method.
 *
 * @copyright   2021  miniOrange
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL v3 or later, see license.txt
 * @package     local_mo_api
 */


require(__DIR__ . '/../../config.php');
require_once('lib.php');

$config = get_config('local/mo_api');
$input = file_get_contents("php://input");
$jsonarray = array();

if (!empty($input)) {
    $jsonarray = json_decode($input, true);
    if (isset($jsonarray['api_key']) and isset($jsonarray['username']) and isset($jsonarray['password'])) {
        $apikey = $jsonarray['api_key'];
        if ($apikey == $config->apikey) {
            $username = $jsonarray['username'];
            $password = $jsonarray['password'];
            $value = authenticate_user_login($username, $password);
            if (!empty($value)) {
                echo '{ "status":"SUCCESS", "message" : "Successfully logged in."';
                local_mo_api_attribute_getter($value);
            } else {
                echo '{ "error":"Invalid credentials. Please try again." }';
            }
        } else {
            echo '{ "error":"Invalid API key."}';
        }
    } else {
        echo '{ "error":"Invalid request."}';
    }
}
