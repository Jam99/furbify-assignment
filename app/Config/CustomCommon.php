<?php

/**
 * This config will be loaded with the view_common_data_helper.
 * Only add necessary properties here to keep it optimized.
 */

namespace Config;

use CodeIgniter\Config\BaseConfig;

class CustomCommon extends BaseConfig {

    /**
     * App version
     */
    public $version = "1.0";


    /**
     * Robots Noindex (true = noindex is set in header; false = indexing is enabled for search engines)
     */
    public $robots_noindex = true;

}