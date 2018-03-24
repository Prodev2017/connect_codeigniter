<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
	
	}

	public function page()
	{

	$this->data = '';

    $this->_render_page('example/page', $this->data);

	}

	public function page1()
	{

	$this->data = '';

    $this->_render_page('example/page1', $this->data);

	}




	public function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}
}
