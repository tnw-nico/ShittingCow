<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MY_Controller {

	public function bet()
	{

		foreach($_POST['tiles'] as $tile) {
			echo $tile . ', ';
		}

	}


	function vote()
	{
		$votes = ($this->input->post('votes'));
		$save_votes = array();
		$this->load->library('session');


		if (count($votes) == 0 OR $votes === FALSE) {
			print_json(false);
		}

		$search = array();
		foreach($votes as $v) {
			if ($v != 'undefined') {
				$search[] = $v;
			}
		}
		$this->db->from('tiles')->where_in('id', $search);
		$tiles = $this->db->get()->result();
		foreach ($tiles as $tile) {
			if ($tile->companyId != 0 ) {
				$save_votes[] = $tile->id;
			}
		}

		$this->session->set_userdata('votes', $save_votes);
		if (count($save_votes) == 0) {
			print_json(false);
		} else {
			$this->load->model('vote_model');
			$post = $this->vote_model->create_post($save_votes);
			print_json(true, array('votes' => $save_votes, "post" => $post));
		}
	}

	function facebook($id) {

		$parts = explode("_", $id);

		$data = false;
		$data = (@file_get_contents('https://graph.facebook.com/'. $parts[0]));

		if ($data === false) {
			// error in getting the page
			$data = new stdClass();
			$data->id = $parts[0];
			$data->post_id = $id;
			$data->message = 'Could not connect with FB';
		} else {
			$data = json_decode($data);
		}

		$this->load->model('user_model');
		$this->load->library('session');
		$votes = $this->session->userdata('votes');

		$result = $this->user_model->save_social_user('facebook', $parts[0], $data);

		if ($result != false) {
			$this->load->model('vote_model');
			$this->session->set_userdata('user_id', $result);

			if ($this->vote_model->save_votes($votes, $result) === TRUE) {
				print_json(true);
			}
		}
		print_json(false);			// what to do when it went wrong
	}

	function email() {
		$email = ($this->input->post('email'));
		$user_id = $this->session->userdata('user_id');
		if (empty($user_id)) {
			print_json(false);
		}
		$this->load->model('user_model');
		$this->db->limit(1)->from('users')->where('id', $this->session->userdata('user_id'));
		$user = $this->db->get()->result();

		if (count($user) != 1) {
			print_json(false);
		}
		$data = array('email' => $email);
		$this->db->where("id", $user_id);
		$d = $this->db->update('users', $data);
		print_json($d);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */