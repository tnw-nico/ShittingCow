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
		$last_key = end(array_keys($votes));
		foreach ($votes as $key => $tile) {
			if (count($votes) == 1)
			{
				$votes_text = $tile->name;
				break;
			}
    		if ($key == $last_key) {
	       		$votes_text = $votes_text . ' and ' . ((isset($tile->twitter) && $tile->twitter != '')? $tile->twitter : $tile->name);
    		} else {
    			if (count($votes == 2)){
	    			$votes_text = $votes_text  . ' ' . ((isset($tile->twitter) && $tile->twitter != '')? $tile->twitter : $tile->name );
        		} else {
	    			$votes_text = $votes_text  . ' ' . ((isset($tile->twitter) && $tile->twitter != '')? $tile->twitter : $tile->name ). ',';
		       	}
    		}
		}

		return $votes_text;
	}


	public function create_post($votes)
	{
		shuffle($votes);
		$votes_text = "";
		$this->db->from('tiles')->join('companies', 'companies.id = tiles.companyId')->where_in('tiles.id', $votes);
		$votes = $this->db->get();
		$votes = ($votes->result());
		$last_key = end(array_keys($votes));
		foreach ($votes as $key => $tile) {
			if (count($votes) == 1)
			{
				$votes_text = $tile->name;
				break;
			}
    		if ($key == $last_key) {
	       		$votes_text = $votes_text . ' and ' . $tile->name;
    		} else {
    			if (count($votes) == 2){
	    			$votes_text = $votes_text  . ' ' . $tile->name;
        		} else {
	    			$votes_text = $votes_text  . ' ' . $tile->name . ',';
		       	}
    		}
		}
		return $votes_text;
	}


}