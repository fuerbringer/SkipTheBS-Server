<?php
/**
 *
 * Singleton class to acces the database
 *
 * @author Severin Fürbringer
 */
class Db {
	private static $inst = null;
	private function __construct() {}
	private function __clone() {}

	/**
	 *
	 * @return mysqli MySQL Database connection instance
	 */
	private static function establishConnection() {
		return new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	}

	/**
	 *
	 * @return mysqli MySQL Database connection instance
	 */
	public static function getInst() {
		if(!isset(self::$inst)) {
			self::$inst = self::establishConnection();
			if(self::$inst->connect_error) {
				die("Couldn't establish connection to. 
					Remote Adress: " . DB_HOST . " 
					Database name: " . DB_NAME);
			}
		}
		return self::$inst;
	}
}
?>
