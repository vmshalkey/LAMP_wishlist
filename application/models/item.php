<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends CI_Model {

	public function get_item_info($item_id) {
		$query = "SELECT item as name FROM items WHERE id = ?";
		$values = $item_id;
		$item = $this->db->query($query, $values)->row_array();
		return $this->db->query($query, $values)->row_array();
	}
	public function get_wishers($item_id) {
		$query = "SELECT users.name FROM users
					JOIN wishes ON users.id = wishes.user_id
					WHERE wishes.item_id = ?";
		$values = $item_id;
		$wishers = $this->db->query($query, $values)->result_array();
		return $this->db->query($query, $values)->result_array();
	}

}

/* End of file item.php */
/* Location: ./application/controllers/item.php */