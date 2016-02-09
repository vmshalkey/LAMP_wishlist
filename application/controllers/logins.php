<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logins extends CI_Controller {

	public function index() {
		$this->load->view('/login_reg');
	}
	public function login_user() {
		if($this->login->login_user($this->input->post())){
			redirect('/profile');
		} else {
			redirect('/');
		}
	}
	public function register_user() {
		$this->login->register_user($this->input->post());
		redirect('/');
	}

	public function show() {
		$user = $this->login->get_user_info();
		$your_items = $this->login->get_my_wishlist();
		$created_items = $this->login->get_created_wishlist();
		$others_items = $this->login->get_others_wishlists();
		$this->load->view("/profile", array("user" => $user, "your_items"=> $your_items, "created_items"=> $created_items, "others_items"=>$others_items));
	}
	public function remove_from_wishlist() {
		$this->login->remove_from_wishlist($this->input->post());
		redirect('/profile');
	}
	public function delete_item() {
		$this->login->delete_item($this->input->post());
		redirect('/profile');
	}
	public function add_to_wishlist() {
		$this->login->add_to_wishlist($this->input->post());
		redirect('/profile');
	}
	public function logout_user() {
		$this->session->sess_destroy();
		redirect('/');
	}
}

/* End of file logins.php */
/* Location: ./application/controllers/logins.php */