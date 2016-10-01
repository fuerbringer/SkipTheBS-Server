<?php
header('Content-type:application/json;charset=utf-8');
include '../application/config/config.inc.php';
include DOC_ROOT . '/application/include/helper.php';
include DOC_ROOT . '/application/include/class/db.php';
include DOC_ROOT . '/application/include/class/response.php';
include DOC_ROOT . '/application/include/class/submit.php';
include DOC_ROOT . '/application/api.php';

/**
 *
 * Example call to request data:
 * skipthebs.php?request&video_code=VdJdHf8BscM
 *
 * Example call to request all section types
 * skipthebs.php?request_sectypes
 *
 * Example call to submit data:
 * skipthebs.php?submit&start_time=00:00:42&stop_time=00:00:52&section_type=advertisement&video_code=VdJdHf8BscM
 *
 */
?>
