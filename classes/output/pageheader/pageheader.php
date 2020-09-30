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

namespace local_mcms\output\pageheader;

use local_mcms\page;
defined('MOODLE_INTERNAL') || die();

/**
 * Page header
 *
 * @package   local_mcms
 * @copyright 2020 - CALL Learning - Laurent David <laurent@call-learning>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class pageheader implements \renderable {
    public $pagecontext = null;
    public $currentstyle = 'default';

    public function __construct(page $page) {
        if ($page->get('style')) {
            $this->currentstyle = $page->get('style');
        }
        $this->pagecontext = new \stdClass();
        $this->pagecontext = $page->to_record();
        $this->pagecontext->imagesurl = [];
        foreach (\local_mcms\page_utils::get_page_images_urls($page->get('id')) as $url) {
            $this->pagecontext->imagesurl[] = $url->out();
        }
    }
}