<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Forms_model extends CI_Model
{

  function getSingle($id) {
      $result = '';
        $query = $this->db->query("SELECT * from forms WHERE form_id = ".$id);
        $result = $query->result();

        return $result;
    }

   function getAll($account_id) {
      $result = '';
        $query = $this->db->query("SELECT * from forms WHERE account_id = ".$account_id);
        $result = $query->result();

        return $result;
    }

    function getAccountForm($form_id) {
      $result = '';
        $query = $this->db->query("SELECT * from forms WHERE form_id = ".$form_id);
        $result = $query->result();

        return $result;
    }

    function getUserAccount($account_id) {
      $result = '';
        $query = $this->db->query("SELECT user_id from user_accounts WHERE account_id = ".$account_id);
        $result = $query->result();

        return $result;
    }

     function formAddContact($data) {

        $last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('contacts')->row();

        $data['id'] = $last_row->id+1;


     $this->db->insert('contacts',$data);

        return $data['id'];
    }

    function deleteForm($id) {

       $query = $this->db->query("DELETE FROM forms
       WHERE form_id = ".$id);

        return $data['id'];
    }

    function formAddContactAddress($data) {

        $last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('addresses')->row();

        $data['id'] = $last_row->id+1;


     $this->db->insert('addresses',$data);

        return $data['id'];
    }

        function formAddContactPhone($data) {

        $last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('phones')->row();

        $data['id'] = $last_row->id+1;


     $this->db->insert('phones',$data);

        return $data['id'];
    }

    function updateForm($data,$form_id) {



     $query = $this->db->query("UPDATE forms
       SET
       name = '".$data['name']."',
       type = '".$data['type']."',
       fields = '".$data['fields']."' WHERE form_id = ".$form_id);


    }

		

    function addForm($data, $account_id) {


       //To get the most recent ID
       $last_row=$this->db->select('form_id')->order_by('form_id',"desc")->limit(1)->get('forms')->row();

       //Increment last ID plus 1
       if (!empty($last_row)) {
       $data['form_id'] = $last_row->form_id+1;
       } else {
       $data['form_id'] = 1;
       }
       $data['account_id'] = $account_id;

       $this->db->insert('forms',$data);

      
    }
}
