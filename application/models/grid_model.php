<?php

class Grid_Model extends CI_Model {

	public function get_grid() {
		$grid = $this->db->get('tiles');
		$grid_array = array();
		foreach ($grid->result_array() as $tile) {
			$grid_array[$tile['y']][$tile['x']] = $tile;
		}

		return $grid_array;
	}

	public function claim_land($land_id, $company_id) {

	}

	public function build_grid() {
		$y = 1;
		$x = 1;
		for ($i = 1; $i <= 90; $i++) {

			echo $x .'-'. $y .'|';

			$query = "INSERT INTO tiles (id, x, y) VALUES ('". $i ."', '". $x ."', '". $y ."');";
//			$this->db->query($query);

			if ($i % 15 == 0) {
				$y++;
				$x = 0;
				echo '<br />';
			}

			$x++;
		}
	}

}