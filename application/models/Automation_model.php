<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Automation_model extends CI_Model
{

    public function getAllWaiting($user_id)
    {
        $result = '';
        $query  = $this->db->query("SELECT * from automations WHERE date_complete = '0000-00-00 00:00:00' AND date_due <= '".date("Y-m-d H:i:s")."'");
        $result = $query->result();

        return $result;
    }

      function getStepDetails($step_id) {

         $query = $this->db->query("SELECT * FROM steps
          WHERE step_id = ".$step_id."");
         return $query->result();


    }

     function getAutomationDetails($opportunity_id) {

         $query = $this->db->query("SELECT * FROM automations
          WHERE opportunity_id = ".$opportunity_id."");
         return $query->result();


    }

    function StepComplete($automation_id) {
    $query = $this->db->query("UPDATE automations
       SET
       date_complete = '".date("Y-m-d H:i:s")."'
       WHERE automation_id = '".$automation_id."'");
     }



}
