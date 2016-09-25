<?php

/**
 * Validates time, also looks if its intval is positive
 */
function isValidTime($time) {
	$split = explode(':', $time);
	$is_positive = (
		intval($split[0]) >= 0 &&
		intval($split[1]) >= 0 &&
		intval($split[2]) >= 0
	);

	return (
		preg_match("/(([0-1]{1}[0-9]{1})|([2]{1}[0-4]{1})):([0-5]{1}[0-9]{1})$/", $time) && $is_positive);
}
?>
