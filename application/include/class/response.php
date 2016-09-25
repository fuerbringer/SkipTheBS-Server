<?php

/**
 * Generates response
 * @author Severin Fürbringer
 */
class Response {
	private $response_json = array();
	private $section_types;	// TODO: Getter, Setter
	private $video_code;	// TODO: Getter, Setter

	/**
	 * @param $vc The video code (on YT its after watch?v=)
	 * @param $st Section Types. (Example: 'advertisement,intro')
	 */
	public function __construct($vc, $st) {
		$this->video_code = isset($vc) ? $vc : $_GET[VIDEO_CODE];
		$this->section_types = isset($st) ? $st : $_GET[REQUEST_SECTION_TYPES];
	}

	/**
	 * If user hasn't defined any particular section_types to filter: return all of them
	 */
	private function fetchSectionTypes() {
		$section_types = array();
		if($this->section_types != '') {
			// Section types were passed by GET, use them
			$section_types = explode(',', $this->section_types);
		} else {
			// No section types defined in GET, fetch manually (theres probably a better way to do this, BUT...)
			$section_types = array();
			// Fetch all the section_types
			if($res = Db::getInst()->query("SELECT name FROM section_type")) {
				while($r = $res->fetch_object()) $section_types[] = $r->name;
			}
		}
		return $section_types;
	}

	/**
	 *
	 * Fetches start&stop times aswell as their section types
	 */
	private function fetchSectionData() {
		$sections = array();
		$section_types = $this->fetchSectionTypes();

		// Outer loop for the section type
		foreach($section_types as $type) {
			// Don't bother sending empty sections:
			if($type != '') {
				$sections[$type] = array();

				// Inner loop for start&stop times
				$sql = "SELECT start, stop FROM section
					INNER JOIN section_type ON section.section_type_id=section_type.id
					INNER JOIN video ON section.video_id=video.id
					WHERE video.code=?
					AND section_type.name=?";
				
				// Querying using data from _GET -> prepared statement!
				if($st = Db::getInst()->prepare($sql)) {
					$st->bind_param("ss", $this->video_code, $type);
					$st->execute();
					$st->bind_result($start, $stop);
					while($st->fetch()) {
						$sections[$type][] = array('start' => $start, 'stop' => $stop);
					}
					$st->close();
				}
			}
		}
		return $sections;
	}

	/**
	 * Returns ready-to-use JSON response for the extension
	 */
	public function getSections() {
		// Fetch data
		if(($video_code = $_GET[VIDEO_CODE]) != '') {
			// Video code passed, continue
			$this->response_json = array(
				$video_code => $this->fetchSectionData()
			);
		}
		return json_encode($this->response_json);
	}

	/**
	 * Returns all section types
	 */
	public function getSectionTypes() {
		$stypes = array();
		$stypes['section_types'] = array();

		$sql = "SELECT name FROM section_type";
		if($st = Db::getInst()->prepare($sql)) {
			$st->execute();
			$st->bind_result($name);
			while($st->fetch()) {
				$stypes['section_types'][] = $name;
			}
			$st->close();
		}
		return json_encode($stypes);
	}
}
?>
