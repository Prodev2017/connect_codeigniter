<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Emails_model extends CI_Model
{


     function getSingle($id) {
        $result = '';
        $query = $this->db->query("SELECT * from email_templates WHERE id = ".$id);
        $result = $query->result();

        return $result;
    }

    public function getEmailDetails($id){
        $query = $this->db->query("SELECT * from email_templates WHERE id = ".$id);
        if($query->num_rows()>0){
          return $query->row_array();
        }
        return false;
    }
 
     function getAll($account_id) {
      $result = '';
        $query = $this->db->query("SELECT * from email_templates WHERE account_id = ".$account_id);
        $result = $query->result();

        return $result;
    }

     function getAllBroadcasts($account_id) {
      $result = '';
        $query = $this->db->query("SELECT * from broadcasts WHERE account_id = ".$account_id);
        $result = $query->result();

        return $result;
    }
		

    function addEmail($data, $account_id) {


       //To get the most recent ID
       $last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('email_templates')->row();

       //Increment last ID plus 1
       if (!empty($last_row)) {
       $data['id'] = $last_row->id+1;
       } else {
       $data['id'] = 1;
       }
       $data['account_id'] = $account_id;

       $this->db->insert('email_templates',$data);

       return $data['id'];

      
    }

    function updateHTML($id,$preview,$html) {



     $query = $this->db->query("UPDATE email_templates
       SET
       preview = '".base64_encode($preview)."',
       html_template = '".base64_encode($html)."'
       WHERE id = ".$id);


    }

    function editEmail($data,$template_id) {



     $query = $this->db->query("UPDATE email_templates
       SET
       name = '".$data['name']."',
       subject = '".$data['subject']."'
       WHERE id = ".$template_id);


    }

    function deleteTemplate($id) {

       $query = $this->db->query("DELETE FROM email_templates
       WHERE id = ".$id);

        return '';
    }

    function storeBroadcast($data) {


       //To get the most recent ID
       $last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('broadcasts')->row();

       //Increment last ID plus 1
       if (!empty($last_row)) {
       $data['id'] = $last_row->id+1;
       } else {
       $data['id'] = 1;
       }

       $this->db->insert('broadcasts',$data);

      
    }


}
