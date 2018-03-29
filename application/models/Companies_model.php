<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Companies_model extends CI_Model
{

  function getAll($user_id){
    $query = $this->db->query("SELECT * FROM companies WHERE user_id = ".$user_id." AND parent_company_id IS NULL");
    return $query->result();
  }

  function getCompany($id){
    $query = $this->db->query("SELECT * FROM companies WHERE id = ".$id);
    return $query->result()[0];
  }

   function getCompaniesByXero($Xeroid){
    $query = $this->db->query("SELECT * FROM companies WHERE xero_id = '".$Xeroid."'");
    return $query->result();
  }

  function addCompany($data, $user_id){
    $this->load->model('API_model');
    //To get the most recent ID
    $last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('companies')->row();

    //Increment last ID plus 1
    if (!empty($last_row)) {
      $data['id'] = $last_row->id+1;
    } else {
      $data['id'] = 1;
    }
    $data['user_id'] = $user_id;

     $data['xero_id'] = $this->API_model->addCompanyXero($data, $user_id);

    if(array_key_exists("contacts_id", $data)){
      $contacts = $data['contacts_id'];
      unset($data['contacts_id']);
    }else{$contacts;}
    if(array_key_exists("locations", $data)){
      $locations = $data['locations'];
      unset($data['locations']);
    }else{$locations;}
    unset($data['crm-contactsforcompany1_length']);
    unset($data['crm-contactsforcompany2_length']);

    if($this->db->insert('companies', $data)){
      $company = true;
    }else{$company=false;}

    if(!empty($locations)){
      $locations = $this->addLocations($data['id'], $locations);
    }else{$locations = true;}
    if(!empty($contacts)){
      $contacts = $this->addContactsToCompany($data['id'], $contacts);
    }else{$contacts = true;}

    
    if($company && $locations && $contacts && ($contacts != false)){
      return $this->getCompany($data['id']);
    }else{return false;}
  }

  function editCompany($id, $data){
    $query = $this->db->query("UPDATE companies
    SET
    company_name = '".$data['company_name']."',
    website = '".$data['website']."',
    company_number = '".$data['company_number']."'
    WHERE id = ".$id);
    if(array_key_exists("contacts_id",$data)){
      $contacts_id = $data['contacts_id'];
    }
    else{
      $contacts_id = array();
    }

    $query = $this->db->query("SELECT contacts_id FROM contacts_companies
    WHERE companies_id = ".$id);
    $queryRes = $query->result();
    $oldContacts_id;
    foreach($queryRes as $oldContact){
      $oldContacts_id[] = $oldContact->contacts_id;
    }

    $newContacts = array_diff($contacts_id, $oldContacts_id);
    $deleteContacts = array_diff($oldContacts_id, $contacts_id);
    if(!empty($newContacts)){
      $this->addContactsToCompany($id, $newContacts);
    }
    if(!empty($deleteContacts)){
      foreach($deleteContacts as $deleteContact){
        $this->deleteContactFromCompany($id, $deleteContact);
      }
    }

    if(array_key_exists("locations", $data)){
      $locations = $data['locations'];
    }
    else{
      $locations = array();
    }
    $oldLocations_temp = $this->getAllLocationsIds($id);
    $oldLocations = array();
    foreach($oldLocations_temp as $oldLocation_temp){
      $oldLocations[] = $oldLocation_temp->id;
    }
    $newLocations = array();

    foreach($locations as $location){
      $newLocations[] = $location['locationId'];
    }
    $toSaveLocations = array_diff($newLocations, $oldLocations);
    $toDeleteLocations = array_diff($oldLocations, $newLocations);
    foreach($locations as $location){
      if(in_array($location['locationId'], $toSaveLocations)){
        $toSaveLocation = $location;
        unset($location['locationId']);
        $this->addLocation($id, $toSaveLocation);
      }
      elseif (in_array($location['locationId'], $toDeleteLocations)){
        $this->deleteLocation($location['locationId']);
      }
      else{
        $toEditLocation = $location;
        unset($location['locationId']);
        $this->editLocation($location);
      }
    }

  }

  function deleteCompany($id){
    $this->deleteContactsByCompany($id);
    $locations = $this->getAllLocationsIds($id);
    foreach($locations as $location){
      $this->deleteLocation($location);
    }
    return $this->db->query("DELETE FROM companies
    WHERE id = ".$id);
  }



    ////////////////////////
    // Company's contacts //
    ////////////////////////

    function getAllContactsByCompany($id){
      $query = $this->db->query("SELECT contacts_id FROM contacts_companies WHERE companies_id = ".$id);
      $contacts_id = $query->result();

      $contacts = null;

      foreach($contacts_id as $contact_id){
        $query = $this->db->query('SELECT * FROM contacts WHERE id = '.$contact_id->contacts_id);
        $contacts[] = $query->result()[0];
      }

      return $contacts;
    }

    function getAllAvailableContacts($id = null){
      $endQuery = "";
      if($id != null){
        $query = $this->db->query("SELECT contacts_id FROM contacts_companies
          WHERE companies_id = ".$id);
        $contacts_id = $query->result();
        foreach($contacts_id as $contact_id){
          $endQuery = $endQuery." AND id != ".$contact_id->contacts_id;
        }
      }
      $query = $this->db->query("SELECT id , first_name , last_name , email FROM contacts
        WHERE id != ''".$endQuery);
      return $query->result();
    }

    function addContactsToCompany($id, $datas){
      $flag;
      foreach($datas as $data){
        $flag = $this->addContactToCompany($id, $data);
        if(!$flag){break;}
      }
      return $flag;
    }

    function addContactToCompany($id, $data){
      $toInsert["companies_id"] = $id;
      $toInsert["contacts_id"] = $data;
      if($this->db->insert('contacts_companies', $toInsert)){
        return true;
      }else{return false;}
    }

    function isContactForCompanyDefine($company_id, $contact_id){
      $query = $this->db->query("SELECT * FROM contacts_companies
        WHERE companies_id = ".$company_id." AND contacts_id = ".$contact_id);
      return $query->result();
    }

    function deleteContactsByCompany($id){
      return $this->db->query("DELETE FROM contacts_companies
        WHERE companies_id = ".$id);
    }

    function deleteContactFromCompany($companyId, $contactId){
      return $this->db->query("DELETE FROM contacts_companies
        WHERE companies_id = ".$companyId." AND contacts_id = ".$contactId);
    }

    /////////////////////////
    // Company's locations //
    /////////////////////////

    function getAllLocations($id){
      $parentCompany = $this->getCompany($id);
      $query = $this->db->query("SELECT * FROM companies
        WHERE parent_company_id = ".$parentCompany->id." AND company_name = \"".$parentCompany->company_name."\"");
      $locations_temp = $query->result();
      $locations = array();
      foreach($locations_temp as $location){
        $address = $this->getAddress($location->id);
        $phone = $this->getPhone($location->id);

        $locations[$location->id]["location"] = $location;
        $locations[$location->id]["address"] = $address;
        $locations[$location->id]["phone"] = $phone;
      }
      return $locations;
    }

    function getAllLocationsIds($id){
      $parentCompany = $this->getCompany($id);
      $query = $this->db->query("SELECT id FROM companies
        WHERE parent_company_id = ".$parentCompany->id." AND company_name = \"".$parentCompany->company_name."\"");
      return $query->result();
    }

    function addLocations($id, $datas){
      foreach($datas as $data){
        if(! empty($data)){
          $flag = $this->addLocation($id, $data);
          if(!$flag){break;}
        }
      }
      return $flag;
    }

    function addLocation($id, $data){

      $phoneData = $data["phone"];
      unset($data["phone"]);
      $addressData = $data["address"];
      unset($data["address"]);
      if(array_key_exists('locationId', $data)){
        unset($data['locationId']);
      }

      $parentCompany = $this->getCompany($id);

      $user_id = $this->ion_auth->user()->row()->id;
      //To get the most recent ID
      $last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('companies')->row();

      //Increment last ID plus 1
      if (!empty($last_row)) {
        $data['id'] = $last_row->id+1;
      } else {
        $data['id'] = 1;
      }
      $data['user_id'] = $user_id;
      $data['parent_company_id'] = $id;
      $data['company_name'] = $parentCompany->company_name;
      if($this->db->insert('companies',$data)){
        $location = true;
      }else{$location=false;}

      $address = $this->addAddress($data['id'], $addressData);
      $phone = $this->addPhone($data['id'], $phoneData);

      if($location && $address && $phone && ($phone!=false)){
        return true;
      }else{return false;}
    }

    function editLocations($datas){
      foreach($datas as $data){
        editLocation($data);
      }
    }

    function editLocation($datas){
      //assuming $datas looks like:
      //  ['address'] ['id']
      //              ['address_type']
      //              ['address_line1']
      //              ['address_line2']
      //              ['address_line3']
      //              ['address_line4']
      //              ['city']
      //              ['county']
      //              ['postal_code']
      //              ['country']
      //
      //  ['phone']   ['id']
      //              ['phone_type']
      //              ['phone_number']
      //              ['phone_area_code']
      //              ['phone_country_code']

      $addressData = $datas['address'];
      $addressId = $addressData['id'];
      unset($addressData['id']);

      $phoneData = $datas['phone'];
      $phoneId = $phoneData['id'];
      unset($phoneData['id']);

      $this->editAddress($addressId, $addressData);
      $this->editPhone($phoneId, $phoneData);
    }

    function deleteLocation($id){
      $address = $this->deleteAddress($id);
      $phone = $this->deletePhone($id);

      $query = $this->db->query("DELETE FROM companies
        WHERE id = ".$id->id);
      return $address && $phone && $query && ($query != false);
    }

      /* address */

      function getAddress($locationId){
        $query = $this->db->query("SELECT * FROM addresses
          WHERE company_id = ".$locationId);
        return $query->result()[0];
      }

      function addAddress($locationId, $data){
  			$last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('addresses')->row();
        //Increment last ID plus 1
        if (!empty($last_row)) {
          $data['id'] = $last_row->id+1;
        } else {
          $data['id'] = 1;
        }
  			$data['company_id'] = $locationId;

  			if($this->db->insert('addresses', $data)){
          return true;
        }else{return false;}
  		}

      function editAddress($id, $datas){
        $query = $this->db->query("UPDATE addresses
  			SET
  			address_type = '".$datas['address_type']."',
  			address_line1 = '".$datas['address_line1']."',
  			address_line2 = '".$datas['address_line2']."',
        address_line3 = '".$datas['address_line3']."',
        address_line4 = '".$datas['address_line4']."',
  			city = '".$datas['city']."',
  			county = '".$datas['county']."',
  			postal_code = '".$datas['postal_code']."',
  			country = '".$datas['country']."'
  			WHERE id = ".$id);
      }

      function deleteAddress($locationId){
        return $this->db->query("DELETE FROM addresses
          WHERE company_id = ".$locationId->id);
      }

      /* phone */

      function getPhone($locationId){
        $query = $this->db->query("SELECT * FROM phones
          WHERE company_id = ".$locationId);
        return $query->result()[0];
      }

      function addPhone($locationId, $data){
  			$last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('phones')->row();
        //Increment last ID plus 1
        if (!empty($last_row)) {
          $data['id'] = $last_row->id+1;
        } else {
          $data['id'] = 1;
        }
  			$data['company_id'] = $locationId;

  			if($this->db->insert('phones', $data)){
          return true;
        }else{return false;}
  		}

      function editPhone($id, $datas){
        $query = $this->db->query("UPDATE phones
  			SET
  			phone_type = '".$datas['phone_type']."',
  			phone_number = '".$datas['phone_number']."',
        phone_area_code = '".$datas['phone_area_code']."',
        phone_country_code = '".$datas['phone_country_code']."'
  			WHERE id = ".$id);
      }

      function deletePhone($locationId){
        return $this->db->query("DELETE FROM phones
          WHERE company_id = ".$locationId->id);
      }

    ////////////////////////
    // Company's branches //
    ////////////////////////

    function getAllBranches($id){
      $parentCompany = $this->getCompany($id);
      $query = $this->db->query("SELECT * FROM companies
        WHERE parent_company_id = ".$parentCompany->id." AND company_name != \"".$parentCompany->company_name."\"");
      $branches_temp = $query->result();
      $branches = array();
      foreach($branches_temp as $branch){
        $branches[$branch->id]['branch'] = $branch;
        $branches[$branch->id]['locations'] = $this->getAllLocations($branch->id);
      }
      return $branches;
    }
}
