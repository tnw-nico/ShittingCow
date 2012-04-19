<?php

class Grid_Model extends CI_Model {

	public function get_grid() {
		$grid = $this->db->get('tiles');
		$grid_array = array();

		$companies = $this->db->get('companies');
		$company_array = array();
		foreach ($companies->result_array() as $company)
		{
			$company_array[$company['id']] = $company;
		}

		foreach ($grid->result_array() as $tile) {
			if ($tile['companyId'] > 0 && isset($company_array[ $tile['companyId'] ]) ) {
				$tile['company'] = $company_array[ $tile['companyId'] ];
			}
			$grid_array[$tile['y']][$tile['x']] = $tile;
		}
		return $grid_array;
	}

	public function claim_land($land_id, $company_id) {

	}

	public function build_grid() {
		$y = 1;
		$x = 1;
		for ($i = 1; $i <= 48; $i++) {

			echo $x .'-'. $y .'|';

			$query = "INSERT INTO tiles (id, x, y) VALUES ('". $i ."', '". $x ."', '". $y ."');";
			$this->db->query($query);

			if ($i % 8 == 0) {
				$y++;
				$x = 0;
				echo '<br />';
			}

			$x++;
		}
	}

}