<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add extends CI_Model {

	public function add_new_item($post) {
		// add items to db
		// VALIDATION
		$this->form_validation->set_rules("item", "Item/Product", "trim|required|is_unique[items.item]|min_length[3]");
		// END VALIDATION RULES
		if($this->form_validation->run() === FALSE) {
		     $this->session->set_flashdata("errors", validation_errors());
		     return FALSE;
		} else {
			$query = "INSERT INTO items (item, added_by, created_at, updated_at)
					VALUES (?, ?, now(), now())";
			$values = array($post['item'], $post['added_by']);
			$this->db->query($query, $values);

			$query2 = "INSERT INTO wishes (user_id, item_id, created_at, updated_at)
						VALUES (?, last_insert_id(), now(), now())";
			$values2 = array($post['added_by']);
			$this->db->query($query2, $values2);
			return TRUE;
		}
	}
}

/* End of file add.php */
/* Location: ./application/controllers/add.php */