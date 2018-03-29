<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Account_model extends CI_Model
{

   function getAccountUser($id) {
      

        $query = $this->db->query("SELECT * from accounts WHERE account_id = ".$id);
        return $query->result();
    }


    function getAccount($id) {
        $query = $this->db->query("SELECT * from user_accounts WHERE user_id = ".$id);
        $user_accounts = $query->result();

        $query = $this->db->query("SELECT * from accounts WHERE account_id = ".$user_accounts[0]->account_id);
				return $query->result();
    }

    function getLinkedIn($id) {
      $query = $this->db->query("SELECT * from user_accounts WHERE user_id = ".$id);
      $user_accounts = $query->result();

      $query = $this->db->query("SELECT linkedin from accounts WHERE account_id = ".$user_accounts[0]->account_id);
      return $query->result();
    }

    function getFacebook($id) {
      $query = $this->db->query("SELECT * from user_accounts WHERE user_id = ".$id);
      $user_accounts = $query->result();

      $query = $this->db->query("SELECT facebook from accounts WHERE account_id = ".$user_accounts[0]->account_id);
      return $query->result();
    }

    function getTwitter($id) {
      $query = $this->db->query("SELECT * from user_accounts WHERE user_id = ".$id);
      $user_accounts = $query->result();

      $query = $this->db->query("SELECT twitter from accounts WHERE account_id = ".$user_accounts[0]->account_id);
      return $query->result();
    }

    function getInstagram($id) {
      $query = $this->db->query("SELECT * from user_accounts WHERE user_id = ".$id);
      $user_accounts = $query->result();

      $query = $this->db->query("SELECT instagram from accounts WHERE account_id = ".$user_accounts[0]->account_id);
      return $query->result();
    }

    function getYoutube($id) {
      $query = $this->db->query("SELECT * from user_accounts WHERE user_id = ".$id);
      $user_accounts = $query->result();

      $query = $this->db->query("SELECT youtube from accounts WHERE account_id = ".$user_accounts[0]->account_id);
      return $query->result();
    }

    function getTags($id) {
      $this->load->model("tags_model");
      $contact['tags'] = $this->tags_model->getContactTags($data->tags);
    }




    function getHeaders($id) {
        $query = $this->db->query("SELECT * from customfields_headers WHERE account_id = ".$id);
				return $query->result();
    }

    function getFields($id) {
        $query = $this->db->query("SELECT * from customfields WHERE account_id = ".$id);
				return $query->result();
    }

    function addHeader($data,$account_id) {

    $last_row=$this->db->select('header_id')->order_by('header_id',"desc")->limit(1)->get('customfields_headers')->row();

    //Increment last ID plus 1
    $data['header_id'] = $last_row->header_id+1;
    $data['account_id'] = $account_id;

    $this->db->insert('customfields_headers',$data);
    //var_dump($data);

    }

    function addField($data,$account_id) {

    $last_row=$this->db->select('field_id')->order_by('field_id',"desc")->limit(1)->get('customfields')->row();

    //Increment last ID plus 1
    $data['field_id'] = $last_row->field_id+1;
    $data['account_id'] = $account_id;

    $this->db->insert('customfields',$data);

    //var_dump($data);
    // insert into the database

    }

    function editField($data,$field_id) {



     $query = $this->db->query("UPDATE customfields
       SET
			 header_id = '".$data['header_id']."',
       location = '".$data['location']."',
       field_name = '".$data['field_name']."' WHERE field_id = ".$field_id);


    }

    function editHeader($data,$field_id) {



     $query = $this->db->query("UPDATE customfields_headers
       SET
		location = '".$data['location']."',
       header_name = '".$data['header_name']."' WHERE header_id = ".$field_id);


    }

    function deleteField($id) {

    $query = $this->db->query("DELETE FROM customfields
       WHERE field_id = ".$id);





    }

    function deleteHeader($id) {

    $query = $this->db->query("DELETE FROM customfields
       WHERE header_id = ".$id);

    $query = $this->db->query("DELETE FROM customfields_headers
       WHERE header_id = ".$id);



    }

    function editBusinessSettings($id, $data){

      //ISSUE WAS HERE AS used "where id = $id" when the column should be $account_id
      $query = $this->db->query("UPDATE accounts
      SET
      linkedin = '".$data['linkedin']."',
      facebook = '".$data['facebook']."',
      twitter = '".$data['twitter']."',
      instagram = '".$data['instagram']."',

      header = '".$data['header']."',
      footer = '".$data['footer']."',

      youtube = '".$data['youtube']."'
      WHERE account_id = ".$id);

      $query = $this->db->query("UPDATE users
      SET
      company = '".$data['company']."' WHERE id = ".$id );

    }

    function editUsersSettings($id, $data){

    }

    function editWorkflowsSettings($id, $data){

    }
    function editStagesSettings($id, $data){

    }
    function editOutcomesSettings($id, $data){

    }
    function editAutomationsSettings($id, $data){

    }
    function editOpportunitiesSettings($id, $data){

    }
    function editTemplatesSettings($id, $data){

    }
    function editCustomFieldsSettings($id, $data){

    }
    function editTagsSettings($id, $data){

      $query = $this->db->query("SELECT * FROM tag_categories WHERE user_id =" .$id);


      $last_row=$this->db->select('tag_id')->order_by('tag_id',"desc")->limit(1)->get('tags')->row();

      //var_dump($last_row);

      $this->db->query("UPDATE tag_categories SET tag_category_colour = '" .$data['tag_category_colour'] . "' WHERE tag_category_id = " . $data['tag_category_id'] . " AND user_id =" . $id);

    }

    // Function for creating a new tag
    function addTags($id, $data){

      // Get the last tag_id and +1 to get new tag_id
       $last_row=$this->db->select('tag_id')->order_by('tag_id',"desc")->limit(1)->get('tags')->row();
       $data['tag_id'] = $last_row->tag_id+1;

       $data['user_id'] = $id;
       $this->db->insert('tags',$data);

    }

    // Function for changing the name of a tag
    function editTags($id, $data){
       $query = $this->db->query("UPDATE tags
       SET tag_name = '".$data['tag_name'] ."', tag_parent_id= '".$data['tag_sub_category'] ."' WHERE tag_id= ".$data['tag_id'] . " AND user_id= " .$id);

       $query = $this->db->query("UPDATE tags
       SET description = '".$data['description'] ."' WHERE tag_id= ".$data['tag_id'] . " AND user_id= ". $id);

    }

    // Function for deleting a tag
    function deleteTags($id, $data){
      // When a tag is deleted, it should be removed from the tags table in the database
      // if this tag is associated with a contact this link should be deleted too
      // Contact table has tag_id value - an arry - need to delete just 1 element from this array in table
    }

    function editConnectedAppsSettings($id, $data){

    }
    function editImportSettings($id, $data){

    }
    function editReportSettings($id, $data){

    }



}
