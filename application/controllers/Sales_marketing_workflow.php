<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_marketing_workflow extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));

		//Check if user is logged in
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('login', 'refresh');
		}
		$this->load->model(array('workflows_model','opportunities_model'));
	
	}

	public function index()
	{

		$this->data = '';
		$user_id = $this->ion_auth->user()->row()->id;
		// get the default workflow
		$workflow = $this->workflows_model->getDefaultWorkflow($user_id);
		$stages = $this->workflows_model->getStages($workflow->workflow_id);

		//now get all the opportunities in these stages
		$stage_data = array();
		$i=0;
		foreach($stages as $stage){
			$stage_data[$i] = (array) $stage;
			$stage_data[$i]['opportunities'] = $this->opportunities_model->getOpenOpportunities($stage->stage_id);
			$i++;
		}


		$this->data['workflow'] = $workflow;
		$this->data['stages'] 	= $stage_data;
		$this->data['home']		= true;
		$this->_render_page('sales_marketing_workflow/index', $this->data);

	}	


	public function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}
}
