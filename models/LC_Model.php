<?php
class LC_Model extends CI_Model { //name of file with capital beginning

	/*public function __construct()
	{
		$this->load->database(); //unnecessary because we autoload this. to change see autoload.php
	}
	*/
	
	public function get_lcs()
	{
		$query = $this->db->order_by("lc_internal_name", "ASC")->get('lc'); //get ALL data from test_table
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
    
    public function add_lc()
    {
        $this->db->insert('lc',$_POST); //not a genius idea !!!!!
        
    }

    public function edit_lc($lc_id, $data)
    {
    	$this->db->where("lc_id", $lc_id)->update('lc',$data);
    }
    
    public function add_board_info()
    {
        $this->db->insert('position',$_POST); //again not a genius idea !!
    }

    public function get_board_changes($lc_id)
    {
    	$query = $this->db->where("lc_id", $lc_id)
						  ->order_by("board_change_date DESC")
						  ->get("board_change");
		return $query; 
    }

    public function get_lc($lc_id)
    {
    	$query = $this->db->where("lc_id", $lc_id)
						  ->get("lc");
		return $query;
    }

    public function get_current_board_change_json($lc_id)
	{
		$current_board_change = array();

		$temp = $this->get_board_change_at_date($lc_id, date("y-m-d"));

		if($temp->num_rows() != 0)
		{
			$current_board_change["board_change"] = $temp->result()[0];
		
			$current_board_change["board"] = $this->get_board($current_board_change["board_change"]->board_change_id)->result();
		}

		return json_encode($current_board_change, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	}

    public function shred_lc($lc_id)
    {
    	$board_changes = $this->get_board_changes($lc_id)->result();

    	foreach ($board_changes as $board_change) {
    		$this->db->where("board_change_id", $board_change->board_change_id)->delete("position");
    	}

    	$this->db->where("lc_id", $lc_id)->delete("board_change");
    	$this->db->where("lc_id", $lc_id)->delete("lc");
    }
    
    
}








