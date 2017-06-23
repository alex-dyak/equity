<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

//Disable internal Wp-Cron function
define('DISABLE_WP_CRON', true);
/**
 * Do not edit this file. Edit the config files found in the config/ dir instead.
 * This file is required in the root directory so WordPress can find it.
 * WP is hardcoded to look in its own directory or one directory up for wp-config.php.
 */
require_once('vendor/autoload.php');
require_once('config/application.php');
require_once(ABSPATH . 'wp-settings.php');


