<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hackathers extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('LC_Model');

		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('hackathers/hackathers/login', 'refresh');
		}
		else
		{
			redirect('Hackathers/Hackathers/listing', 'refresh');
			//$this->listing();
		}
		
	}

	public function listing()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('hackathers/hackathers/login', 'refresh');
		}
		$data["LC"] = $this->LC_Model->get_lcs()->result();

		$current_boards = array();
		$current_board_changes = array();
		$has_board = array();

		foreach ($data["LC"] as $row) {
			$id = $row->lc_id;

			$current_board_change = $this->LC_Model->get_board_change_at_date($id, date("y-m-d"));
			if($current_board_change->num_rows() == 0)
			{
				$has_board[$id] = 0;
				continue;
			}
			
			$has_board[$id] = 1;
			
			$current_board_change = $current_board_change->result()[0];

			$current_board_changes[$id] = $current_board_change;
			$current_board = $this->LC_Model->get_board($current_board_change->board_change_id);
			$current_boards[$id] = $current_board->result();
		}

		$data["current_boards"] = $current_boards;
		$data["current_board_changes"] = $current_board_changes;
		$data["has_board"] = $has_board;
		
		/*foreach ($data["LC"] as $key => $value) {
			$data["LC"][$key]->current_board =
				 $this->LC_Model->get_board_at_date($data["LC"]["lc_id"], date("Y-M-D"));
		}*/

		

		$this->load->view('LC_list', $data);
	}

	public function history($lc_id = -1)
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('hackathers/hackathers/login', 'refresh');
		}
		$LC = $this->LC_Model->get_lc($lc_id);

		if($LC->num_rows() == 0)
		{
			show_error('LC not found', 404); 
			return;
		}
		$LC = $LC->result()[0];

		$board_changes = $this->LC_Model->get_board_changes($lc_id)->result();
		$boards = array();

		foreach($board_changes as $board_change)
		{
			$boards[$board_change->board_change_id] = 
							$this->LC_Model->get_board($board_change->board_change_id)->result();
		}

		$data["board_changes"] = $board_changes;
		$data["boards"] = $boards;
		$data["LC"] = $LC;
		$this->load->view('history', $data);
	}
	public function add_bc()
	{
		$date_raw = date_parse_from_format("Y-m-d", $_POST["board_change_date"]);
		$is_date = checkdate($date_raw["month"], $date_raw["day"], $date_raw["year"]);

		if($is_date && $date_raw["error_count"] == 0)
		{
			$this->LC_Model->add_bc($_POST["lc_id"], $_POST["board_change_date"]);
		}
		else
		{
			show_error('Bad date', 400); 
		}
	}
	public function add_lc()
	{
		$this->LC_Model->add_lc();
	}

	public function add_pos()
	{
		$keys = ["position_title",
				 "position_name",
				 "position_mail",
				 "position_phone",
				 "board_change_id"];
		
		$data = array();
		foreach($keys as $key)
		{
			$data[$key] = $_POST[$key];
		}

		$this->LC_Model->add_pos($data);
	}

	public function edit_lc()
	{
		$keys = ["lc_internal_name",
				 "lc_reg_name",
				 "lc_connection",
				 "lc_address",
				 "lc_post_code",
				 "lc_city",
				 "lc_email",
				 "lc_site"];
		
		$data = array();
		foreach($keys as $key)
		{
			$data[$key] = $_POST[$key];
		}

		$lc_id = $_POST["lc_id"];

		$this->LC_Model->edit_lc($lc_id, $data);
	}

	public function shred_lc($lc_id = -1)
	{
		$LC = $this->LC_Model->get_lc($lc_id);

		if($LC->num_rows() == 0)
		{
			show_error('LC not found', 404); 
			return;
		}

		$this->LC_Model->shred_lc($lc_id);
	}

	public function lcs_json()
	{
		$lcs = $this->LC_Model->get_lcs()->result();
		
		$this->output
		        ->set_status_header(200)
		        ->set_content_type('application/json', 'utf-8')
		        ->set_output(json_encode($lcs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		        ->_display();
		exit;
	}

	public function board_change_json($lc_id)
	{
		if(array_key_exists("date", $_POST))
			$date = $_POST["date"];
		else
			$date = date("y-m-d");

		$board = $this->LC_Model->get_board_at_date($lc_id, $date);

		$this->output
		        ->set_status_header(200)
		        ->set_content_type('application/json', 'utf-8')
		        ->set_output(json_encode($board, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		        ->_display();
		exit;
	}



	// log the user in
	public function login()
	{
		$this->data['title'] = "Login";

		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('Hackathers/', 'refresh');
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('Hackathers/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
			);

			$this->load->view('login', $this->data);
		}
	}


	// log the user out
	function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('Hackathers/Hackathers/login', 'refresh');
	}


	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}