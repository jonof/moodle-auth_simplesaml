<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * SAML Assertion Consumer Service endpoint.
 *
 * @package    auth_easysaml
 * @copyright  2015 Jonathon Fowler <jf@jonof.id.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('NO_DEBUG_DISPLAY', true);
require_once '../../config.php';

if ($CFG->version < 2017111300.00) {
    $PAGE->https_required();
}

$helper = new auth_easysaml_helper();
if (!$helper->handle_acs()) {
    throw new moodle_exception('errornotauthenticated', 'auth_easysaml');
}

$redirect = optional_param('RelayState', null, PARAM_LOCALURL);
if (!empty($redirect)) {
    redirect(new moodle_url($redirect));
}

redirect($CFG->wwwroot . '/');
