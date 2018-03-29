<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Stages_model extends CI_Model
{

    public function getAll($user_id)
    {
        $result = '';
        $query  = $this->db->query("SELECT * from stages WHERE user_id = " . $user_id);
        $result = $query->result();

        return $result;
    }

    public function getStage($id)
    {
        $result = '';
        $query  = $this->db->query("SELECT * from stages WHERE stage_id = " . $id);
        $result = $query->result()[0];

        return $result;
    }

    public function getStageFromOutcome($id) {
            $result = '';
            $query  = $this->db->query("SELECT stage_id from stage_outcomes WHERE outcome_id = " . $id);
            $result = $query->result()[0];

            return $result;
    }

    public function getStageNameFromID($id) {
            $result = '';
            $query  = $this->db->query("SELECT name from stages WHERE stage_id = " . $id);
            $result = $query->result()[0];

            return $result;
    }

    public function getOutcomeNameFromID($id) {
            $result = '';
            $query  = $this->db->query("SELECT name from stage_outcomes WHERE outcome_id = " . $id);
            $result = $query->result()[0];

            return $result;
    }

    public function getOutcomes($id)
    {
        $result = '';
        $query  = $this->db->query("SELECT * from stage_outcomes WHERE stage_id = " . $id);
        $result = $query->result();

        return $result;
    }

      public function getOutcome($id)
    {
        $result = '';
        $query  = $this->db->query("SELECT * from stage_outcomes WHERE outcome_id = " . $id);
        $result = $query->result();

        return $result;
    }

    public function getOpportunities($id)
    {
        $result = '';
        $query  = $this->db->query("SELECT * from opportunities WHERE outcome_id = " . $id);
        $result = $query->result();

        return $result;
    }

    public function getWorkflowbyOutcome($id)
    {
        $result = '';
        $query  = $this->db->query("SELECT * from stage_outcomes WHERE outcome_id = " . $id);
        $result = $query->result();

        $query  = $this->db->query("SELECT * from stages WHERE stage_id = " . $result[0]->stage_id);
        $result = $query->result();


        return $result;
    }

    public function getAllAvailableOpportunities($id = null)
    {
        $query = $this->db->query("SELECT * FROM opportunities
	      WHERE outcome_id IS NULL");
        return $query->result();
    }

    public function addStage($data, $user_id)
    {

        $outcomes = $data['outcomes'];
        unset($data['outcomes']);
        $colour = $data['colour'];
        unset($data['colour']);

        if (isset($data['step'])) {
            $steps = $data['step'];
            unset($data['step']);
        } else { $steps = false;}

        //To get the most recent ID
        $last_row = $this->db->select('stage_id')->order_by('stage_id', "desc")->limit(1)->get('stages')->row();

        //Increment last ID plus 1
        if (!empty($last_row)) {
            $data['stage_id'] = $last_row->stage_id + 1;
        } else {
            $data['stage_id'] = 1;
        }
        $data['user_id'] = $user_id;

        $this->db->insert('stages', $data);

        $colorIndex    = 0;
        $outcome_cycle = 0;
        foreach ($outcomes as $outcomes_single) {
            $outcome_cycle++;
            if (empty($outcomes_single)) {
                $colorIndex = $colorIndex + 1;
                continue;
            }
            $outcome_last_row = $this->db->select('outcome_id')->order_by('outcome_id', "desc")->limit(1)->get('stage_outcomes')->row();
            $outcome_last_row = $outcome_last_row->outcome_id + 1;
            $this->db->insert('stage_outcomes', array('outcome_id' => $outcome_last_row, 'stage_id' => $data['stage_id'], 'name' => $outcomes_single, 'colour' => $colour[$colorIndex]));
            $colorIndex = $colorIndex + 1;

            if ($steps and isset($steps[$outcome_cycle])) {
                foreach ($steps[$outcome_cycle] as $single_step) {

                    $step_save = array();

                    $last_row = $this->db->select('step_id')->order_by('step_id', "desc")->limit(1)->get('steps')->row();

                    //Increment last ID plus 1
                    if (!empty($last_row)) {
                        $step_save['step_id'] = $last_row->step_id + 1;
                    } else {
                        $step_save['step_id'] = 1;
                    }

                    $step_save['stage_id']   = $data['stage_id'];
                    $step_save['outcome_id'] = $outcome_last_row;
                    $step_save['type']       = $single_step[1];
                    $stored_step_information = '';
                    if ($single_step[1] == 'email') {
                        $stored_step_information = array('name' => $single_step[2], 'subject' => $single_step[3], 'html' => $single_step[4]);
                    }

                    if ($single_step[1] == 'delay') {
                        $stored_step_information = array('period' => $single_step[2], 'timeframe' => $single_step[3]);
                    }

                    $step_save['data'] = serialize($stored_step_information);

                    $this->db->insert('steps', $step_save);

                }
            }

        }
    }


    function checkSteps($outcome_id) {

    	 $query = $this->db->query("SELECT * FROM steps
	      WHERE outcome_id = ".$outcome_id."");
         return $query->result();


    }

     function getStep($id) {

         $query = $this->db->query("SELECT * FROM steps
          WHERE step_id = ".$id."");
         return $query->result();


    }

    function getStepsFromOutcomeID($outcome_id) {
            $query = $this->db->query("SELECT * from steps WHERE outcome_id = ".$outcome_id."");
            return $query->result();
    }

    function createAutomation($step_id, $outcome_id, $opportunity_id) {

    	 $query = $this->db->query("SELECT * FROM automations
	      WHERE step_id = ".$step_id." AND outcome_id = ".$outcome_id." AND opportunity_id = ".$opportunity_id."" );


         if (empty($query->result())) {

         	 //To get the most recent ID
       $last_row=$this->db->select('automation_id')->order_by('automation_id',"desc")->limit(1)->get('automations')->row();

       //Increment last ID plus 1
       if (!empty($last_row)) {
       $data['automation_id'] = $last_row->automation_id+1;
       } else {
       $data['automation_id'] = 1;
       }

       $data['opportunity_id'] = $opportunity_id;
       $data['outcome_id'] = $outcome_id;
       $data['step_id'] = $step_id;

       $data['date_due'] = date("Y-m-d H:i:s");

       $this->db->insert('automations',$data);

         } else { return 'Ongoing';}


    }


    		function editStage($datas, $user_id){
    			var_dump($datas);
          // update database
    		}

                function createOutcomeForStage($name,$colour,$stage_id) {
                        $outcome_last_row = $this->db->select('outcome_id')->order_by('outcome_id', "desc")->limit(1)->get('stage_outcomes')->row();
                        $outcome_last_row = $outcome_last_row->outcome_id + 1;
                        $this->db->insert('stage_outcomes', array('outcome_id' => $outcome_last_row, 'stage_id' => $stage_id, 'name' => $name, 'colour' => $colour));

                }

                function editStageName($name, $stage_id, $user_id) {
                        $query = $this->db->query("UPDATE stages SET name = '". $name ."' WHERE stage_id = '".$stage_id."' AND user_id = '". $user_id ."'");
                        //$query->result();
                }

                function editOutcome($name, $colour, $outcome_id) {
                        $query = $this->db->query("UPDATE stage_outcomes SET name = '".$name."', colour = '".$colour."' WHERE outcome_id = '".$outcome_id."'");
                }

                function deleteOutcome($outcome_id, $user_id) {
                        //remove opportunities from an outcome and a stage
                        $query = $this->db->query("UPDATE opportunities SET outcome_id = NULL WHERE outcome_id = '". $outcome_id ."' AND user_id = '". $user_id ."'");
                        //delete automations
                        $query = $this->db->query("DELETE FROM steps WHERE outcome_id = '". $outcome_id ."'");
                        //delete outcome
                        $query = $this->db->query("DELETE FROM stage_outcomes WHERE outcome_id = '". $outcome_id ."'");
                }

                function deleteStep($step_id) {
                        $query = $this->db->query('DELETE FROM steps WHERE step_id = "'. $step_id .'" ');
                }

    		function deleteStage($id){

    			$query= $this->db->query("SELECT outcome_id FROM stage_outcomes
    			WHERE stage_id= ".$id);
    			var_dump($query->result());

    			$this->db->query("DELETE FROM opportunities
    			WHERE outcome_id=".$query);


    			$this->db->query("DELETE FROM steps
    			WHERE stage_id=".$id);

    			$this->db->query("DELETE FROM stage_outcomes
    			WHERE stage_id=".$id);

    			$this->db->query("DELETE FROM stages
    			WHERE stage_id= ".$id);




    			//if there's an opportunity associated with the workflow delete only the outcome_id from the opportunities table where outcome_id =
    			//get outcome_id from stage_outcomes where stage_id = ".$id
    			//then get opportunities where outcome_id = var ^
    			//then delete only the outcome_id row from the opportunities table

    		}



                function addStep($stage_id,$outcome_id,$type,$data) {
                        $last_step_id = $this->db->query("SELECT step_id FROM steps ORDER BY step_id DESC LIMIT 1")->result()[0]->step_id;
                        $new_step_id = $last_step_id + 1;

                        $this->db->query("INSERT INTO steps (step_id, stage_id, outcome_id, type, data) VALUES ('".$new_step_id ."','". $stage_id."','". $outcome_id."','". $type."','". $data."')");

                }

                function editStep($step_id, $type, $data) {
                        $this->db->query('UPDATE steps SET type="'. $type .'", data=\''. $data .'\' WHERE step_id = '. $step_id .' ');
                }

}
