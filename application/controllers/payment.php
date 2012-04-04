<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends MY_Controller {

	public function register()
	{

		$post_data = array();
		$post_data['company_name'] = "";
		$post_data['company_url'] = "";
		$post_data['errors'] = array();

		if ( !isset($_POST['submit_register'] ) ) {
			$this->load->view('payment/register');
		} else {
			debug($_POST);
			$filename = $this->input->post('company_name');


			$website_url = $this->input->post('company_url');
			$website_url = str_ireplace('http://', '', $website_url);
			$website_url = str_ireplace('https://', '', $website_url);
			$website_url = 'http://'. $website_url;

			if(!filter_var($website_url, FILTER_VALIDATE_URL)){
				$post_data['errors'][] = "Invalid website adress";
			}



			if ( $this->upload_logo($filename) && empty($post_data['errors']) ) {
				redirect('payment/finalize');
				exit;
			} else {
				$post_data['company_name'] = $this->input->post('company_name');
				$post_data['company_url'] = $this->input->post('company_url');
			}

		}


		$this->load->view('payment/register', $post_data);
	}

	public function finalize() {

		$this->load->view('payment/finalize');

	}


	private function upload_logo($filename) {
		$file_input_name = "company_logo";

		$upload_config = array();
		$upload_config['upload_path'] = './img/companies/logo/';
		$upload_config['file_name'] = $filename;
		$upload_config['allowed_types'] = 'gif|jpg|png';
		$upload_config['max_size']	= '10000';
		$upload_config['max_width']  = '1024';
		$upload_config['max_height']  = '768';
		$upload_config['overwrite'] = true;

		$this->load->library('upload', $upload_config);

		if ( ! $this->upload->do_upload($file_input_name))
		{
			return false;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			return true;
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
