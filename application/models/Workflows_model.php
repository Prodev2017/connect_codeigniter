<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Workflows_model extends CI_Model
{
    public function __construct()
	{
        parent::__construct();
    }

    public function getAll($user_id)
    {
        $query  = $this->db->query("SELECT * from workflows WHERE user_id = ? ORDER BY workflow_order ASC",$user_id);
        $result = $query->result();

        return $result;
    }

    public function addWorkflow($data,$user_id){
        $workflow_name 	= $data['workflow_name'];
        
        // make sure this name is not already used by this user
        $check = $this->db->query("SELECT workflow_id FROM workflows WHERE workflow_name=? AND user_id=?",array($workflow_name,$user_id));
        if($check->num_rows()>0){
            return array('success'=>false,'message'=>'There is already a workflow with this name.');
        }
        $data['user_id'] = $user_id;

        $this->db->insert('workflows',$data);
        return array('success'=>true,'message'=>'Successfully added the new workflow');
    }
    public function updateWorkflow($data,$user_id){
        $workflow_name 	= $data['workflow_name'];
        $workflow_id 	= $data['workflow_id'];
        
        // make sure this name is not already used by this user
        $check = $this->db->query("SELECT workflow_id FROM workflows WHERE workflow_name=? AND user_id=? AND workflow_id !=?",array($workflow_name,$user_id,$workflow_id));
        if($check->num_rows()>0){
            return array('success'=>false,'message'=>'There is already a workflow with this name.');
        }

        $this->db->where('workflow_id',$workflow_id);
        $this->db->update('workflows',$data);
        return array('success'=>true,'message'=>'Successfully updated the workflow');
    }

    public function getWorkflow($workflow_id,$user_id){
        // make sure this user can access this workflow
        $data = $this->db->query("SELECT * FROM workflows WHERE workflow_id=? AND user_id=?",array($workflow_id,$user_id));
        if($data->num_rows()==0){
            return false;
        }

        return $data->row();
    }

    public function deleteWorkflow($id,$user_id){
        $result = $this->db->query("DELETE FROM workflows WHERE workflow_id=? AND user_id=?",array($id,$user_id));
        // need to delete related items too
        if(!$result){
            return array('success'=>false,'message'=>'Could not delete the workflow. Please try again later.');
        }
        return array('success'=>true,'message'=>'Successfully deleted the workflow.');
    }

    // get all the stage related to a workflow
    public function getStages($workflow_id){
        $query  = $this->db->query("SELECT * from workflow_stages WHERE  workflow_id=? ORDER BY stage_order ASC",array($workflow_id));
        return $query->result();
    }

    public function addStage($data,$user_id){
        $stage_name 	= $data['stage_name'];
        $workflow_id 	= $data['workflow_id'];

        //first make sure this workflow belongs to this user
        $check = $this->db->query("SELECT workflow_id FROM workflows WHERE workflow_id=? AND user_id=?",array($workflow_id,$user_id));
        if($check->num_rows()==0){
            return array('success'=>false,'message'=>'This stage could not be added at the moment. Please try again later.');
        }
        
        // make sure this name is not already used by this user
        $check = $this->db->query("SELECT stage_id FROM workflow_stages WHERE stage_name=? AND workflow_id=?",array($stage_name,$workflow_id));
        if($check->num_rows()>0){
            return array('success'=>false,'message'=>'There is already a stage with this name in this workflow.');
        }

        $this->db->insert('workflow_stages',$data);
        return array('success'=>true,'message'=>'Successfully added the new stage');
    }
    public function getStage($id,$user_id){
        // make sure this user can access this stage
        $data = $this->db->query("SELECT ws.* FROM workflow_stages ws INNER JOIN workflows w ON ws.workflow_id=w.workflow_id WHERE ws.stage_id=? AND w.user_id=?",array($id,$user_id));
        if($data->num_rows()==0){
            return false;
        }
        return $data->row();       
    }

    public function updateStage($data,$user_id){
        $stage_id 	    = $data['stage_id'];
        $stage_name 	= $data['stage_name'];
        

        //make sure we are updating this user's stage
        $check = $this->db->query("SELECT ws.workflow_id FROM workflow_stages ws INNER JOIN workflows w ON ws.workflow_id=w.workflow_id WHERE ws.stage_id=? AND w.user_id=?",array($stage_id,$user_id));
        if($check->num_rows()==0){
            return array('success'=>false,'message'=>'This stage could not be updated at the moment. Please try again later.');
        }
        $row = $check->row();
        $workflow_id = $row->workflow_id;
        
        // make sure this name is not already used by this user
        $check = $this->db->query("SELECT stage_id FROM workflow_stages WHERE stage_name=? AND stage_id !=? AND workflow_id=?",array($stage_name,$stage_id,$workflow_id));
        if($check->num_rows()>0){
            return array('success'=>false,'message'=>'There is already a stage with this name in this workflow.');
        }

        $this->db->where('stage_id',$stage_id);
        $this->db->update('workflow_stages',$data);
        return array('success'=>true,'message'=>'Successfully updated the stage');
    }

    public function deleteStage($stage_id,$user_id){
        //make sure we are updating this user's stage
        $check = $this->db->query("SELECT ws.workflow_id FROM workflow_stages ws INNER JOIN workflows w ON ws.workflow_id=w.workflow_id WHERE ws.stage_id=? AND w.user_id=?",array($stage_id,$user_id));
        if($check->num_rows()==0){
            return array('success'=>false,'message'=>'Could not delete the stage. Please try again later.');
        }

        $result = $this->db->query("DELETE FROM workflow_stages WHERE stage_id=?",array($stage_id));
        // need to delete related items too
        if(!$result){
            return array('success'=>false,'message'=>'Could not delete the stage. Please try again later.');
        }
        return array('success'=>true,'message'=>'Successfully deleted the stage.');
    }
    public function getDefaultWorkflow($user_id){
        $data = $this->db->query("SELECT * FROM workflows WHERE user_id=? ",$user_id);
        return $data->row();
    }
}