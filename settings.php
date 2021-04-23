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
 * Add page to admin menu.
 *
 * @copyright   2021  miniOrange
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL v3 or later, see license.txt
 * @package     local_mo_api
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {

    global $CFG;
    $config = get_config('local/mo_api');

    if (empty($config->apikey)) {
            $id = uniqid();
            $apikey = md5($id);
            set_config('apikey', $apikey, 'local/mo_api');
    }
        $settings = new admin_settingpage( 'local_mo_api', 'Login using Moodle Users' );
        $ADMIN->add( 'localplugins', $settings );
        $settings->add(
            new admin_setting_heading(
                'local_mo_api/pluginname', '',
                new lang_string('mo_api_configure_api_setting', 'local_mo_api')
            )
        );

        // API Credentials.

        $settings->add(
            new admin_setting_heading(
                'local_mo_api/api_credentials',
                new lang_string('mo_api_credentials', 'local_mo_api'), ''
            )
        );

        $settings->add(
            new admin_setting_description(
                'local_mo_api/User_Authentication_API_URL',
                new lang_string('mo_api_User_Authentication_API_URL', 'local_mo_api'),
                $CFG->wwwroot."/local/mo_api/api.php"
            )
        );

        $settings->add(
            new admin_setting_description(
                'local_mo_api/API_key',
                new lang_string('mo_api_apikey', 'local_mo_api'), $config->apikey
            )
        );

        $settings->add(
            new admin_setting_description(
                'local_mo_api/Authn_parameter',
                new lang_string('mo_api_authn_para', 'local_mo_api'),
                '{ "api_key": "'.$config->apikey.'" , "username" : "##username##","password" : "##password##" }'
            )
        );


        // Attributes.

        $settings->add(
            new admin_setting_heading(
                'local_mo_api/user_attributes',
                new lang_string('mo_api_attributes', 'local_mo_api'), new lang_string('mo_api_attributes_desc', 'local_mo_api')
            )
        );

        $settings->add(
            new admin_setting_configtext(
                'local_mo_api/username',
                get_string('mo_api_username', 'local_mo_api'),
                get_string('mo_api_username_desc', 'local_mo_api'), 'username', PARAM_RAW_TRIMMED
            )
        );

        $settings->add(
            new admin_setting_configtext(
                'local_mo_api/fname',
                get_string('mo_api_fname', 'local_mo_api'),
                get_string('mo_api_fname_desc', 'local_mo_api'), 'firstname', PARAM_RAW_TRIMMED
            )
        );

        $settings->add(
            new admin_setting_configtext(
                'local_mo_api/lname',
                get_string('mo_api_lname', 'local_mo_api'),
                get_string('mo_api_lname_desc', 'local_mo_api'), 'lastname', PARAM_RAW_TRIMMED
            )
        );

        $settings->add(
            new admin_setting_configtext(
                'local_mo_api/email',
                get_string('mo_api_email', 'local_mo_api'),
                get_string('mo_api_email_desc', 'local_mo_api'), 'email', PARAM_RAW_TRIMMED
            )
        );

        $settings->add(
            new admin_setting_configtext(
                'local_mo_api/fullname',
                get_string('mo_api_fullname', 'local_mo_api'),
                get_string('mo_api_fullname_desc', 'local_mo_api'), 'fullname', PARAM_RAW_TRIMMED
            )
        );
}