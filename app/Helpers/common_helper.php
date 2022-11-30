<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

if (! function_exists("get_settings")) {
    function get_settings($key = "") {
        $db      = \Config\Database::connect();
        $result = $db->table("settings")->where("key", $key)->get()->getRow()->value;

        return $result;
    }
}

// ------------------------------------------------------------------------
/* End of file common_helper.php */
/* Location: ./system/helpers/common.php */
