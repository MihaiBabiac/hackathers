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
			show_error('LC not found'); 
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