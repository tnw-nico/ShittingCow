<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bet extends MY_Controller {

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

		$this->layout_vars['content'] = $this->load->view('grid/bet', $this->view_vars, true);
		$this->load->view($this->default_layout, $this->layout_vars);
	}

	public function twitter() {
				$this->load->library('session');
				echo "<pre>";
		print_r($this->session);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */