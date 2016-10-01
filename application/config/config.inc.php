<?php

/**
 * MySQL Database information and credidentials
 */
define('DB_HOST', 'localhost'); // Server on which the database is being hosted
define('DB_NAME', 'skipthebs'); // Database name
define('DB_USER', 'root'); // Database username
define('DB_PASS', ''); // Database password

/**
 * Document root
 * Depending on your webserver directory structure this probably needs to be changed
 */
define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/git/SkipTheBS-Server');

/**
 * Strip tags from _GET
 */
define('STRIP_GET_TAGS', TRUE);

/**
 * GET defines
 */
define('VIDEO_CODE',				'video_code');

// for requesting data
define('IS_REQUEST',				'request_sections');
define('REQUEST_VIDEO_PLATFORM',	'video_platform');
define('REQUEST_SECTION_TYPES',		'section_types');

define('IS_REQUEST_SECTION_TYPES',	'request_sectypes');

// for submitting data
define('IS_SUBMIT',					'submit');
define('SUBMIT_START_TIME',			'start_time');
define('SUBMIT_STOP_TIME',			'stop_time');
define('SUBMIT_SECTION_TYPE',		'section_type');

define('SUBMIT_PLATFORM',			'platform');

define('DEFAULT_SECTION_TYPE', 'advertisement');
define('DEFAULT_PLATFORM', 'YouTube');

?>
