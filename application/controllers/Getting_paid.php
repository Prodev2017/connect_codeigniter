<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Getting_paid extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		//Check if user is logged in
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('login', 'refresh');
        }
	
	}

	public function index()
	{

		$this->data = '';

		$this->_render_page('getting_paid/index', $this->data);

	}	


	public function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}
}
