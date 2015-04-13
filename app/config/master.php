<?php
date_default_timezone_set('America/New_York');

$json_dir = './data/';
$module_dir = './modules';

// listings per page
define("LISTINGS_PER_PAGE", "10");
//db vars
define("DB_HOST", "localhost");
define("DB_PORT", "3306");
define("DB_USER", "classifieds");
define("DB_PASS", "ClassDB13!");
define("DB_NAME", "classifieds");
//feed tables
define("TBL_LISTING", "listing");
define("TBL_PLACEMENT", "placements");
define("TBL_POSITION", "positions");
//logging
define("LOGGING_LEVEL", 7);
define("LOGGING_DIR", APP_PATH."logs/");
//version
define("DCD_VERSION", "20.0");


