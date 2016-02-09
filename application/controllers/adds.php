<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adds extends CI_Controller {

	public function add_item_view() {
		$this->load->view("/add_item_view");
	}
	public function add_new_item() {
		if($this->add->add_new_item($this->input->post())){
			redirect('/profile');
		} else {
			redirect('/add_item_view');
		}
	}
}

/* End of file adds.php */
/* Location: ./application/controllers/adds.php */