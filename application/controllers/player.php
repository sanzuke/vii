
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Player extends CI_Controller {

	public function index()
	{
		$this->load->view('view_player');
	}

}