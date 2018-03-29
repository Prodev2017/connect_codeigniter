<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Opportunities_model extends CI_Model
{
  public function getAll($user_id)
  {
    $result = '';
        $query = $this->db->query("SELECT * from opportunities WHERE user_id = ".$user_id);
        $result = $query->result();

        return $result;
  }

  public function getAllProposalsByOpportunity($id){
    $query = $this->db->query("SELECT * FROM proposals WHERE opportunity_id = ".$id);
    return $query->result();
  }

  public function getOpportunity($id)
  {
    $result = '';
        $query = $this->db->query("SELECT o.*,ws.stage_name,ws.colour from opportunities o LEFT JOIN workflow_stages ws ON o.stage_id=ws.stage_id WHERE o.id = ".$id);
				$result = $query->result()[0];

        return $result;
  }

   public function getByContact($id)
  {
    $result = '';
        $query = $this->db->query("SELECT * from opportunities WHERE contacts_id LIKE '%".$id."%'");
        $result = $query->result();

        return $result;
  }

  public function getContacts($id){
    $result = array();
    $opportunity = $this->getOpportunity($id);
    if(!empty($opportunity->contacts_id)){
      $contacts_id = unserialize($opportunity->contacts_id);
      foreach($contacts_id as $contact_id){
        $query = $this->db->query("SELECT * FROM contacts WHERE id = ".$contact_id);
        $result[] = $query->result()[0];
      }
    }
    else{
      $result = null;
    }
    return $result;
  }

  public function getCompanies($id){
    $result = array();
    $opportunity = $this->getOpportunity($id);
    if(!empty($opportunity->companies_id)){
      $companies_id = unserialize($opportunity->companies_id);
      foreach($companies_id as $company_id){
        $query = $this->db->query("SELECT * FROM companies WHERE id = ".$company_id);
        $result[] = $query->result()[0];
      }
    }
    else{
      $result = null;
    }
    return $result;
  }

  public function getAllAvailableContacts($id = null)
  {
    $endQuery = "";
    if($id != null){
      $opportunity = $this->getOpportunity($id);
      if(!empty($opportunity->contacts_id)){
        $contacts_id = unserialize($opportunity->contacts_id);
        foreach($contacts_id as $contact_id){
          $endQuery = $endQuery." AND id != ".$contact_id;
        }
      }
    }
    $query = $this->db->query("SELECT id , first_name , last_name , email FROM contacts
      WHERE id != ''".$endQuery);
    return $query->result();
  }

  public function getAllAvailableCompanies($id = null)
  {
    $endQuery = "";
    if($id != null){
      $opportunity = $this->getOpportunity($id);
      if(!empty($opportunity->companies_id)){
        $companies_id = unserialize($opportunity->companies_id);
        foreach($companies_id as $company_id){
          $endQuery = $endQuery." AND id != ".$company_id;
        }
      }
    }
    $query = $this->db->query("SELECT id , company_name FROM companies
      WHERE id != ''".$endQuery);
    return $query->result();
  }

  public function getBillingContact($opportunity_id){
    $result = '';
    $this->load->model('contacts_model');

    $query = $this->db->query("SELECT billing_contact from opportunities WHERE id = ".$opportunity_id);
		$result = $query->result()[0];
    var_dump($result);
    return $this->contacts_model->getContact($result->billing_contact);
  }

  public function getLastProposal($opportunity_id){
   // return $this->db->query("SELECT * FROM proposals WHERE opportunity_id = ".$opportunity_id." ORDER BY date DESC")->result()[0];
  }

  public function addOpportunity($data, $user_id)
  {
    //Assuming companies_id, contacts_id and date_stages are already serialized

    $this->load->model('proposals_model');

    //To get the most recent ID
    $last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('opportunities')->row();

    //Increment last ID plus 1
    if (!empty($last_row)) {
      $data['id'] = $last_row->id+1;
    } else {
      $data['id'] = 1;
    }
    $data['user_id'] = $user_id;

    if(isset($data['crm-contactsforopportunity1_length'])){
      unset($data['crm-contactsforopportunity1_length']);
    }
    if(isset($data['crm-contactsforopportunity2_length'])){
      unset($data['crm-contactsforopportunity2_length']);
    }
    if(isset($data['crm-companiesforopportunity1_length'])){
      unset($data['crm-companiesforopportunity1_length']);
    }
    if(isset($data['crm-companiesforopportunity2_length'])){
      unset($data['crm-companiesforopportunity2_length']);
    }
    if(isset($data['page'])){
      unset($data['page']);
    }

    if(isset($data['products'])){
      // assuming products =  [productId]
      //                      [quantity]
      $dataProposal['date'] = getdate();
      $dataProposal['content'] = "Sample Proposal";
      $dataProposal['products'] = $data['products_id'];
      unset($data['products']);
    }else{$dataProposal;}

    if($this->db->insert('opportunities',$data)){
      $opportunity = $this->getOpportunity($data['id']);
    }else{$opportunity = false;}

    if(!empty($dataProposal)){
      $proposal = $this->proposals_model->addProposal($dataProposal, $data['id']);
    }else{$proposal = false;}

    if($opportunity){
      return $opportunity;
    }else{return false;}
  }

  public function addContacttoOpportunity($contact_id, $id)
  {
    $opportunity = $this->getOpportunity($id);
    $contacts_id = unserialize($opportunity->contacts_id);
    $contacts_id[] = $contact_id;
    $contacts_id = serialize($contacts_id);
    $this->db->query("UPDATE opportunities SET contacts_id = ".$contacts_id."
    WHERE id = ".$opportunity->id);

    return $query->result();
  }

  public function addCompanytoOpportunity($company_id, $id)
  {
    $opportunity = $this->getOpportunity($id);
    $companies_id = unserialize($opportunity->companies_id);
    $companies_id[] = $company_id;
    $companies_id = serialize($companies_id);
    $this->db->query("UPDATE opportunities SET companies_id = ".$companies_id."
    WHERE id = ".$opportunity->id);

    return $query->result();
  }

    // $datas['name'] required
  public function editOpportunity($id, $datas)
  {
    $query = "UPDATE opportunities
    SET";
    if(isset($datas['contacts_id'])){
      $query = $query." contacts_id = '".serialize($datas['contacts_id'])."',";
    }
    if(isset($datas['companies_id'])){
      $query = $query." companies_id = '".serialize($datas['companies_id'])."',";
    }
    if(isset($datas['billing_contact'])){
      $query = $query."billing_contact = '".$datas['billing_contact']."',";
    }
    if(isset($datas['outcome_id'])){
      $query = $query." outcome_id = '".$datas['outcome_id']."',";
    }
    if(isset($datas['outcome_dates'])){
      $query = $query." outcome_dates = '".serialize($datas['outcome_dates'])."',";
    }
    $query = $this->db->query($query."name = '".$datas['name']."' WHERE id = ".$id);
    return true;
  }

  // this will return opportunities based on stage_id. Need to return open opportunities only but not clear which are open at the
  // moment so returning all
  public function getOpenOpportunities($stage_id){  
    $data = $this->db->query("SELECT * FROM opportunities WHERE stage_id=?",$stage_id);
    $return_data = array();
    $i=0;
    foreach($data->result_array() as $row){
        $return_data[$i] = $row;
        // if this has company then get company id and company name too
        $companies_id = $row['companies_id'];
        if($companies_id!=NULL){
          $companies_id = unserialize($companies_id);
          foreach($companies_id as $company_id){
            $query = $this->db->query("SELECT * FROM companies WHERE id = ".$company_id);
            $company_result = $query->row_array();
          }          
          $return_data[$i]['company'] = $company_result;
        }
        else{
          $return_data[$i]['company'] = NULL;
        }
        
        $i++;
    }
    return $return_data;
  }
}
