<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {

	public function item_view($item_id) {
		$item = $this->item->get_item_info($item_id);
		$wishers = $this->item->get_wishers($item_id);
		$this->load->view("/item_view", array("item" => $item, "wishers" => $wishers));
	}
}

/* End of file items.php */
/* Location: ./application/controllers/items.php */