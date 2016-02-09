<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Model {

	public function login_user($post) {
		// find user in db
		// VALIDATION
		$this->form_validation->set_rules("username", "Username", "trim|required");
		$this->form_validation->set_rules("password", "Password", "trim|required");
		// END VALIDATION RULES
		if($this->form_validation->run() === FALSE) {
		     $this->session->set_flashdata("errors", validation_errors());
		     return FALSE;
		} else {
			$query = "SELECT * FROM users WHERE username = ? AND password = ?";
			$values = array($post['username'], $post['password']);
			$user = $this->db->query($query, $values)->row_array();
			if(empty($user)) {
				$this->session->set_flashdata("errors", "The username or password you entered is invalid.");
				return FALSE;
			} else {
				$this->session->set_userdata('id', $user['id']);
				return TRUE;
			}
		}
	}
	public function register_user($post) {
		// add user to db
		// VALIDATION
		$this->form_validation->set_rules("name", "Name", "trim|required|alpha|min_length[3]");
		$this->form_validation->set_rules("username", "Username", "trim|required|is_unique[users.username]|min_length[3]");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
		$this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required|matches[password]");
		$this->form_validation->set_rules("date_hired", "Date Hired", "trim|required");
		// END VALIDATION RULES
		if($this->form_validation->run() === FALSE) {
		     $this->session->set_flashdata("errors", validation_errors());
		} else {
			$query = "INSERT INTO users (name, username, password, date_hired, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())";
			$values = array($post['name'], $post['username'], $post['password'], $post['date_hired']);
			$this->db->query($query, $values);
		}
	}
	public function get_user_info() {
		$query = "SELECT name FROM users WHERE id = ?";
		$values = $this->session->userdata('id');
		$user = $this->db->query($query, $values)->row_array();
		return $this->db->query($query, $values)->row_array();
	}
	public function get_my_wishlist() {
		$query = "SELECT items.id, items.item, users.name as added_by, wishes.created_at, wishes.user_id as wisher_id, wishes.id as wish_id
					FROM items
					JOIN users ON items.added_by = users.id
					JOIN wishes ON items.id = wishes.item_id
					WHERE wishes.user_id = ? AND items.added_by<> ?
					ORDER BY wishes.created_at DESC";
		$values = array($this->session->userdata('id'), $this->session->userdata('id'));
		$your_items = $this->db->query($query, $values)->result_array();
		return $this->db->query($query, $values)->result_array();
	}
	public function get_created_wishlist() {
		$query = "SELECT items.id as item_id, items.item, users.name as added_by, wishes.created_at, wishes.user_id as wisher_id, wishes.id as wish_id
					FROM items
					JOIN users ON items.added_by = users.id
					JOIN wishes ON items.id = wishes.item_id
					WHERE wishes.user_id = ? AND items.added_by = ?
					ORDER BY wishes.created_at DESC";
		$values = array($this->session->userdata('id'), $this->session->userdata('id'));
		$created_items = $this->db->query($query, $values)->result_array();
		return $this->db->query($query, $values)->result_array();
	}
	public function get_others_wishlists() {
		$query = "SELECT items.id, items.item, users.name as added_by, items.created_at
					FROM items
					JOIN users ON items.added_by = users.id
					WHERE items.added_by <> ?
					AND items.id
					NOT IN (SELECT item_id FROM wishes WHERE wishes.user_id = ?)
					ORDER BY items.id";
		$values = array($this->session->userdata('id'), $this->session->userdata('id'));
		$others_items = $this->db->query($query, $values)->result_array();
		return $this->db->query($query, $values)->result_array();
	}
	public function remove_from_wishlist($post) {
		$query = "DELETE FROM wishes WHERE id = ?";
		$values = $post['wish_id'];
		$this->db->query($query, $values);
	}
	public function delete_item($post) {
		$query = "DELETE FROM wishes WHERE id = ?";
		$values = $post['wish_id'];
		$this->db->query($query, $values);

		$query2 = "DELETE FROM items WHERE id = ?";
		$values2 = $post['item_id'];
		$this->db->query($query2, $values2);
	}
	public function add_to_wishlist($post) {
		$query = "INSERT INTO wishes (user_id, item_id, created_at, updated_at)
					VALUES (?, ?, now(), now())";
		$values = array($this->session->userdata('id'), $post['item_id']);
		$this->db->query($query, $values);
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */