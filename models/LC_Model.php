<?php
class LC_Model extends CI_Model { //name of file with capital beginning

	/*public function __construct()
	{
		$this->load->database(); //unnecessary because we autoload this. to change see autoload.php
	}
	*/
	
	public function get_lcs()
	{
		$query = $this->db->get('lc'); //get ALL data from test_table
		return $query; //return the data
	}

	public function get_board_change_id_at_date($lc_id, $date)
	{
		$query = $this->db->select("board_change_id")
						  ->where("lc_id", $lc_id)
						  ->where("board_change_date <= $date")
						  ->order_by("board_change_date", "DESC")
						  ->limit(1)
						  ->get("board_change");
		return $query; 
	}

	public function get_board_at_date($lc_id, $date)
	{
		$id = get_board_change_id_at_date($lc_id, $date)->result()[0]["board_change_id"];

		$query = $this->db->where("board_change_id", id)
						  ->get("position");
		return $query; 
	}


}



