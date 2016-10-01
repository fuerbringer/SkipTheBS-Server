<?php

// Strip tags
if(STRIP_GET_TAGS) {
	foreach($_GET as &$param) {
		$param = strip_tags($param);
	}
}
if(isset($_GET[IS_REQUEST])) {
	// Client is beginning a request for a video and its sections
	$response = new Response($_GET[VIDEO_CODE], $_GET[REQUEST_SECTION_TYPES]);
	$json = $response->getSections();
	echo $json;

} else if(isset($_GET[IS_REQUEST_SECTION_TYPES])) {
	$response = new Response();
	$json = $response->getSectionTypes();
	echo $json;

} else if(isset($_GET[IS_SUBMIT])) {
	// Client is submitting data
	$submit = new Submit(
		$_GET[SUBMIT_START_TIME],
		$_GET[SUBMIT_STOP_TIME],
		$_GET[VIDEO_CODE],
		$_GET[SUBMIT_SECTION_TYPE]
	);
	$status = $submit->submitData();
	echo $status;
}

?>
