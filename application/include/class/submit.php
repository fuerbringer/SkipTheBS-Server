<?php

/**
 *
 * @author Severin Fürbringer
 */
class Submit {
	private $response_json = array();
	private $start;
	private $stop;
	private $video_code;
	private $platform;
	private $section_type;

	public function __construct($a, $b, $vc, $st, $pf) {
		$this->start = $a;
		$this->stop = $b;
		$this->video_code = $vc;
		$this->section_type = $st;
		$this->platform = isset($pf) ? $pdf : DEFAULT_PLATFORM;
	}

	private function insertVideo($platform_id) {
		$sql = "INSERT IGNORE INTO video (code, platform_id) VALUES (?, ?)";
		if($st = Db::getInst()->prepare($sql)) {
			$st->bind_param('si', $this->video_code, $platform_id);
			$st->execute();
			return $st->affected_rows;
		}
		return 0;
	}

	private function insertSection() {
		$stid = 0;
		$rows = 0;
		$vc = '';

		//  Get the section ID
		$sql = "SELECT id FROM section_type WHERE name=? LIMIT 1";
		if($st = Db::getInst()->prepare($sql)) {
			$st->bind_param("s", $this->section_type);
			$st->execute();
			$st->bind_result($id);
			if($st->fetch()) {
				$stid = $id;
			}
			$st->close();
		}

		// Main section insert query
		$sql = "INSERT INTO section (video_id, start, stop, section_type_id) VALUES (?,?,?,?)";
		if($st = Db::getInst()->prepare($sql)) {
			if(Db::getInst()->insert_id) {
				// Inserted new video earlier
				$st->bind_param("issi",
					Db::getInst()->insert_id,
					$this->start,
					$this->stop,
					$stid
				);

				$st->execute();
				$rows += Db::getInst()->affected_rows;
			} else {
				// Video already exists, get its ID
				$sql = "SELECT id FROM video WHERE code=?";
				if($st1 = Db::getInst()->prepare($sql)) {
					$st1->bind_param("s", $this->video_code);
					$st1->execute();
					$st1->bind_result($v);
					if($st1->fetch()) {
						$vc = $v;
					}
					$st1->close();
				}

				$st->bind_param("issi",
					$vc,
					$this->start,
					$this->stop,
					$stid
				);
				// Insert new section
				$st->execute();
				$rows += Db::getInst()->affected_rows;
			}
			$st->close();
		}
		return $rows;
	}

	/**
	 * Verifies and submits clients section
	 */
	public function submitData() {
		$status['errors'] = array();
		$status['new_videos'] = 0;
		$status['insert'] = '';

		// Check if times are valid
		if(!isValidTime($this->start)) $status['errors'][] = 'Start time is invalid';
		if(!isValidTime($this->stop)) $status['errors'][] = 'End time is invalid';
		if(!strlen($this->video_code)) $status['errors'][] = 'Empty video code';

		if(count($status['errors']) < 1) {
			if($this->platform == DEFAULT_PLATFORM) {
				$status['new_videos'] += $this->insertVideo(1); // Insert the video if it doesn't already exist
				$status['insert'] = $this->insertSection();
			} else {
				// TODO: Make inserting video from platforms other than youtube possible
			}
		}


		return json_encode($status);
	}
}
?>
