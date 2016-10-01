<?php

/**
 * Validates time, also looks if its intval is positive
 */
function isValidTime($time) {
	return (floatval($time) >= 0);
}
?>
