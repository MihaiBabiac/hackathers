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

	public function get_board_change_at_date($lc_id, $date)
	{
		$query = $this->db->where("lc_id", $lc_id)
						  ->where("board_change_date <= '$date'")
						  ->order_by("board_change_date", "DESC")
						  ->limit(1)
						  ->get("board_change");
		return $query; 
	}

	public function get_board_change($board_change_id)
	{
		$query = $this->db->where("board_change_id", $board_change_id)
							->get("board_change");

		return $query;
	}

	public function get_board($board_change_id)
	{
		$query = $this->db->where("board_change_id", $board_change_id)
						  ->get("position");
		return $query;
	}
    
    public function add_info()
    {
            $this->db->insert('lc',$_POST); //not a genius idea !!!!!
        
    }
    
    public function add_board_info()
    {
        $this->db->insert('position',$_POST); //again not a genius idea !!
    }
    
    
}








