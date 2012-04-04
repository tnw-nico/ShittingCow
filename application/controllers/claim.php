<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Claim extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('grid_model');
		$this->view_vars['grid'] = $this->grid_model->get_grid();

		$this->view_vars['popup'] = $this->register_popup();

		$this->layout_vars['content'] = $this->load->view('grid/claim', $this->view_vars, true);
		$this->load->view($this->default_layout, $this->layout_vars);
	}


	private function register_popup() {
		$post_data = array();
		$post_data['company_name'] = "";
		$post_data['company_url'] = "";
		$post_data['errors'] = array();

		if ( isset($_POST['submit_register'] ) ) {
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


		return $this->load->view('payment/register', $post_data, true);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */