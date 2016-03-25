<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hackathers extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('LC_Model');
	}

	public function index()
	{
		$data["LC"] = $this->LC_Model->get_lcs()->result();

		$current_boards = array();
		$current_board_changes = array();

		foreach ($data["LC"] as $row) {
			$id = $row->lc_id;

			$current_board_change = $this->LC_Model->get_board_change_at_date($id, date("y-m-d"))->result()[0];
			
			$current_board_changes[$id] = $current_board_change;
			//print_r($current_board_change);
			$current_board = $this->LC_Model->get_board($current_board_change->board_change_id);
			$current_boards[$id] = $current_board->result();
		}

		$data["current_boards"] = $current_boards;
		$data["current_board_changes"] = $current_board_changes;
		/*foreach ($data["LC"] as $key => $value) {
			$data["LC"][$key]->current_board =
				 $this->LC_Model->get_board_at_date($data["LC"]["lc_id"], date("Y-M-D"));
		}*/

		

		$this->load->view('LC_list', $data);
	}
}