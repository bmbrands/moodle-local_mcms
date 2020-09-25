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
 * Moodle Mini CMS utility.
 *
 * Provide the ability to manage site pages through blocks.
 *
 * @package   local_mcms
 * @copyright 2020 - CALL Learning - Laurent David <laurent@call-learning>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_mcms;

defined('MOODLE_INTERNAL') || die();

/**
 * Class page
 *
 * @package   local_mcms
 * @copyright 2020 - CALL Learning - Laurent David <laurent@call-learning>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class page extends \core\persistent {
    const TABLE = 'local_mcms_page';

    protected $roles;

    protected static function define_properties() {
        return array(
            'title' => array(
                'type' => PARAM_TEXT,
                'default' => ''
            ),
            'shortname' => array(
                'type' => PARAM_TEXT,
                'default' => ''
            ),
            'idnumber' => array(
                'type' => PARAM_ALPHANUMEXT,
                'default' => ''
            )
        );
    }

    public function get_associated_roles() {
        $roles = page_role::get_records(['pageid' => $this->get('id')]);
        return $roles;
    }

    public function update_associated_roles($rolesid) {
        $this->delete_associated_roles();
        foreach ($rolesid as $rid) {
            $role = new page_role(0, (object) ['pageid' => $this->get('id'), 'roleid' => $rid]);
            $role->create();
        }
    }
    public function delete_associated_roles() {
        $roles = page_role::get_records(['pageid' => $this->get('id')]);
        foreach ($roles as $r) {
            $r->delete();
        }
    }

}
