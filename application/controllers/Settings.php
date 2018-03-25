<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		//Check if user is logged in
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('login', 'refresh');
		}
		$this->load->model(array('account_model','tags_model','API_model','workflows_model'));

		$this->custom_fields = new \stdClass();
		$this->custom_fields->types = array('Text', 'Date', 'Dropdown', 'Phone number', 'URL', 'Yes/No');
	
	}

	public function _remap($method,$query=array()){
		if($method=='index'){
			$this->index();
		}
		else{
			$method = str_replace("-","_", $method);
			if(method_exists($this, $method)){
				return call_user_func_array(array($this,$method), $query);
			}
			else{
				show_404();
			}
		}
	}

	public function index()
	{
		$this->_render_page('settings/index', $this->data);
	}	

	public function initial_settings(){
		$this->data = array();
		$this->_render_page('settings/initial-settings', $this->data);
	}

	public function my_business(){
		$this->data = array();
		$this->_render_page('settings/my-business', $this->data);
	}

	public function users(){
		$this->data = array();
		$this->data['users'] = $this->ion_auth->users()->result();
		//ISSUE TRYING TO ACCESS USER ID THROUGH $id when it is $user->id
		//$this->account_model->editUsersSettings($user->id, $_POST);

		foreach ($this->data['users'] as $k => $user)
		{
			$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}
		$this->_render_page('settings/users', $this->data);
	}

	public function workflows($id=NULL){
		$this->data = array();
		$user_id = $this->ion_auth->user()->row()->id;

		if($id!=NULL){
			$this->data['workflow'] = $this->workflows_model->getWorkflow($id,$user_id);
			$this->data['stages']= $this->workflows_model->getStages($id);	
			$this->_render_page('settings/workflow-stages', $this->data);
		}
		else{
			$this->data['workflows']= $this->workflows_model->getAll($user_id);
			$this->_render_page('settings/workflows', $this->data);
		}

		
		
	}

	public function add_workflow(){
		//called via ajax
		$user_id = $this->ion_auth->user()->row()->id;
		$return = $this->workflows_model->addWorkflow($_POST,$user_id);
		echo json_encode($return);
	}

	public function update_workflow(){
		//called via ajax
		$user_id = $this->ion_auth->user()->row()->id;
		$return = $this->workflows_model->updateWorkflow($_POST,$user_id);
		echo json_encode($return);
	}
	public function delete_workflow($id){
		//called via ajax
		$user_id = $this->ion_auth->user()->row()->id;
		$return = $this->workflows_model->deleteWorkflow($id,$user_id);
		echo json_encode($return);
	}

	public function stages(){
		$this->data = array();
		$this->_render_page('settings/stages', $this->data);
	}

	public function add_stage(){
		//called via ajax
		$user_id = $this->ion_auth->user()->row()->id;
		$data = $this->input->post();
		$return = $this->workflows_model->addStage($data,$user_id);
		echo json_encode($return);
	}

	public function update_stage(){
		//called via ajax
		$user_id = $this->ion_auth->user()->row()->id;
		$data = $this->input->post();
		$return = $this->workflows_model->updateStage($data,$user_id);
		echo json_encode($return);
	}
	public function delete_stage($id){
		//called via ajax
		$user_id = $this->ion_auth->user()->row()->id;
		$return = $this->workflows_model->deleteStage($id,$user_id);
		echo json_encode($return);
	}

	public function outcomes(){
		$this->data = array();
		$this->_render_page('settings/outcomes', $this->data);
	}

	public function automations(){
		$this->data = array();
		$this->_render_page('settings/automations', $this->data);
	}

	public function opportunities(){
		$this->data = array();
		$this->_render_page('settings/opportunities', $this->data);
	}

	public function templates(){
		$this->data = array();
		$this->_render_page('settings/templates', $this->data);
	}

	public function custom_fields(){
		$this->data = array();
		$user = $this->ion_auth->user()->row();
		$account = $this->account_model->getAccount($user->id);
		$this->data['user'] = $user;
		$this->data['account'] = $account[0];
		$front_fields = array();
		$this->data['headers'] = $this->account_model->getHeaders($account[0]->account_id);
		$fields = $this->account_model->getFields($account[0]->account_id);
		foreach ($fields as $field) {
			$front_fields[$field->header_id][$field->field_id] = $field;
		}
		$this->data['fields'] = $front_fields;
		$this->data['field_types'] = $this->custom_fields->types;
		$this->_render_page('settings/custom-fields', $this->data);
	}

	public function tags(){
		$this->data = array();
		$this->data['tags'] = $this->tags_model->getAllTags();
		$this->data['tag_category'] = $this->tags_model->getTagsCategory();
		$this->data['tag_sub_category'] = $this->tags_model->getTagsSubCategory();
		$this->data['tag_parent_sub'] = $this->tags_model->getSubCatParentCat();
		$this->_render_page('settings/tags', $this->data);
	}

	public function connected_apps(){
		$this->data = array();
		$this->_render_page('settings/connected-apps', $this->data);
	}

	public function import(){
		$this->data = array();
		$this->_render_page('settings/import', $this->data);
	}

	public function reports(){
		$this->data = array();
		$this->_render_page('settings/reports', $this->data);
	}

	


	public function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}
}
