<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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

		$this->data = [];
		$user = $this->ion_auth->user()->row();
		$firstname = $this->ion_auth->user()->row()->first_name;
		$lastname = $this->ion_auth->user()->row()->last_name;
		$email = $this->ion_auth->user()->row()->email;
    $default = 'https://www.tremark.co.uk/wp-content/uploads/2016/02/placeholder-male.png';
    $size = 200;


    $grav_url  = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
		$this->_render_page('dashboard/index', $this->data);

	}	
	
	public function default_index()
	{

		$this->data = '';

		$this->_render_page('dashboard/index', $this->data);

	}

	public function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}
}
