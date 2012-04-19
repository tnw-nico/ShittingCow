<?php

class Vote_Model extends CI_Model {

	public function save_votes($votes, $user_id) {

		$this->db->where('userId', $user_id)->from('votes');

		if($this->db->count_all_results() == 0)
		{

			foreach ($votes as $vote) {
				$data = array(
					'tileId' => $vote,
					'userId' => $user_id
				);

				$this->db->insert('votes', $data);

			}
		}
		else
		{
			return false;
		}
		return true;
	}


	public function create_tweet($votes)
	{
		shuffle($votes);
		$votes_text = "";

		$this->db->from('tiles')->join('companies', 'companies.id = tiles.companyId')->where_in('tiles.id', $votes);
		$votes = $this->db->get();
		$votes = ($votes->result());
		$array = array();
		foreach ($votes as $key => $tile) {
			$array[] = (isset($tile->twitter) && $tile->twitter != '')? '@' . $tile->twitter : $tile->name;
		}
		return $this->ImplodeToEnglish($array);
	}


	public function create_post($votes)
	{
		shuffle($votes);
		$votes_text = "";
		$this->db->from('tiles')->join('companies', 'companies.id = tiles.companyId')->where_in('tiles.id', $votes);
		$votes = $this->db->get();
		$votes = ($votes->result());

		$array = array();
		foreach ($votes as $key => $tile) {
			$array[] = $tile->name;
		}

		return $this->ImplodeToEnglish($array);
	}


	function ImplodeToEnglish ($array) {
    // sanity check
    if (!$array || !count ($array))
        return '';

    // get last element
    $last = array_pop ($array);

    // if it was the only element - return it
    if (!count ($array))
        return $last;

    return implode (', ', $array).' and '.$last;
	}


}