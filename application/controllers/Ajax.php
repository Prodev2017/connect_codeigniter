<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model(array('workflows_model'));
    }

    public function modal(){

        $m = $this->input->get('m',TRUE);
        $data = array();
        if($m == 'workflow-edit'){
            $id = $this->input->get('id');
            $user_id = $this->ion_auth->user()->row()->id;
            $data['entity'] = $this->workflows_model->getWorkflow($id,$user_id);
        }
        elseif($m == 'stage-edit'){
            $id = $this->input->get('id');
            $user_id = $this->ion_auth->user()->row()->id;
            $data['entity'] = $this->workflows_model->getStage($id,$user_id);
        }
        
        $this->load->view("_ajax/modals/".$m,$data);
    }

}