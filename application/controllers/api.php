<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MY_Controller {

	public function bet()
	{

		foreach($_POST['tiles'] as $tile) {
			echo $tile . ', ';
		}

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */