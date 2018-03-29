<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Contacts_model extends CI_Model
{

    public function getAll($user_id)
    {

        $this->load->model("tags_model");
        $result = [];
        $query  = $this->db->query("SELECT * from contacts WHERE user_id = " . $user_id);

        $datas  = $query->result();
        // $result;
        foreach ($datas as $data) {
            $contact['id']          = $data->id;
            $contact['first_name']  = $data->first_name;
            $contact['last_name']   = $data->last_name;
            $contact['email']       = $data->email;
            $contact['middle_name'] = $data->middle_name;
            $contact['timezone']    = $data->timezone;
            $contact['website']     = $data->website;
            $contact['maplink']     = $data->maplink;
            $contact['person_type'] = $data->person_type;
            $contact['job_title']   = $data->job_title;
            $contact['tags']        = $this->tags_model->getContactTags($data->tags);
            $contact['tags_string'] = $data->tags;

            $companies            = $this->getAllCompaniesByContact($data->id);
            $contact['companies'] = $companies;

            $addresses            = $this->getAllAddresses($data->id);
            $contact['addresses'] = $addresses;

            $phones            = $this->getAllPhones($data->id);
            $contact['phones'] = $phones;

            $contact['sales_to_date'] = $this->sales_to_date($data->xero_id);

            $contact['xero_id'] = $data->xero_id;
            $result[] = $contact;
        }
        return $result;
    }

    public function sales_to_date($id)
    {
        $amount = 0;
        $query  = $this->db->query("SELECT * from invoices WHERE xero_contact_id = '" . $id . "'");
        foreach ($query->result() as $single) {

            if ($single->type == 'ACCREC') {
                $amount = $amount + $single->total;
            }

        }
        return $amount;
    }

    public function getContact($id)
    {
        //print_r($id); exit;
        $this->load->model("tags_model");
        $result = '';
        $query  = $this->db->query("SELECT * from contacts WHERE id = " . $id);
        $data   = $query->result()[0];

        $contact['id']          = $data->id;
        $contact['first_name']  = $data->first_name;
        $contact['last_name']   = $data->last_name;
        $contact['email']       = $data->email;
        $contact['middle_name'] = $data->middle_name;
        $contact['timezone']    = $data->timezone;
        $contact['website']     = $data->website;
        $contact['maplink']     = $data->maplink;
        $contact['person_type'] = $data->person_type;
        $contact['job_title']   = $data->job_title;
        $contact['tags']        = $this->tags_model->getContactTags($data->tags);
        $contact['tags_string'] = $data->tags;

        $companies            = $this->getAllCompaniesByContact($data->id);
        $contact['companies'] = $companies;

        $addresses            = $this->getAllAddresses($data->id);
        $contact['addresses'] = $addresses;

        $phones            = $this->getAllPhones($data->id);
        $contact['phones'] = $phones;

        $contact['sales_to_date'] = $this->sales_to_date($data->xero_id);

        $contact['xero_id'] = $data->xero_id;

        $result = $contact;

        return $result;
    }

    public function getContactByXero($Xeroid)
    {
        $query = $this->db->query("SELECT * from contacts WHERE xero_id = '" . $Xeroid . "'");
        return $query->result();
    }

    public function addContact($data, $user_id)
    {
        $this->load->model('API_model');

        //To get the most recent ID
        $last_row = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('contacts')->row();

    

        if (array_key_exists("custom", $data)) {

            $data['custom_fields'] = serialize($data['custom']);

            unset($data['custom']);
        }

        $contact = array(
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'reg_no'     => $data['reg_no'],
            'email'      => $data['email'],
            'xero_id'    => $data['xero_id'],
            'website'    => $data['website']);

           //Increment last ID plus 1
        $contact['id']      = $last_row->id + 1;
        $contact['user_id'] = $user_id;

        $this->db->insert('contacts', $contact);

        $last_row = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('companies')->row();

    

        $company = array(
            'company_name' => $data['company'],
            'website'      => $data['website'],
            'xero_id'      => $data['xero_id']);

         //Increment last ID plus 1
        $company['id']      = $last_row->id + 1;
        $company['user_id'] = $user_id;

        $this->db->insert('companies', $company);

        $last_row = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('addresses')->row();

    

        $address = array(
            'contact_id'    => $contact['id'],
            'company_id'    => $company['id'],
            'address_line1' => $data['address_line1'],
            'address_line2' => $data['address_line2'],
            'address_line3' => $data['address_line3'],
            'address_line4' => $data['address_line4'],
            'city'          => $data['city'],
            'postal_code'   => $data['postal_code']);

        $address['id']      = $last_row->id + 1;

        $company_contact = array( 'contacts_id'    => $contact['id'],
            'companies_id'    => $company['id']);

         $this->db->insert('contacts_companies', $company_contact);



        $this->db->insert('addresses', $address);

        return $contact['id'];

    }

    public function editContact($id, $data)
    {

        //To get the most recent ID
        $query = $this->db->query("UPDATE contacts
       SET
             first_name = '" . $data['first_name'] . "',
       last_name = '" . $data['last_name'] . "',
       email = '" . $data['email'] . "',
             middle_name = '" . $data['middle_name'] . "',
             timezone = '" . $data['timezone'] . "',
             website = '" . $data['website'] . "',
             maplink = '" . $data['maplink'] . "',
             person_type = '" . $data['person_type'] . "',
             job_title = '" . $data['job_title'] . "',
             tags = '" . $data['tags'] . "',
            custom_fields = '" . serialize($data['custom']) . "'
       WHERE id = " . $id);

        $cid = $id;

        //////////////////////////
        //Addresses verification//
        //////////////////////////
        if (array_key_exists("addresses", $data)) {
            $addresses = $data['addresses'];
        } else {
            $addresses = array();
        }

        $count = 0;
        $keys  = array_keys($addresses); // grab each key of each address, should be the id
        $query = $this->db->query("SELECT id FROM addresses
             WHERE contact_id = " . $id);
        $oldAddresses_temp = $query->result();
        $oldAddresses      = array();
        foreach ($oldAddresses_temp as $oldAddress) {
            $oldAddresses[] = $oldAddress->id;
        }

        foreach ($addresses as $address) {
            $address['id'] = $keys[$count];
            if (!preg_match("#^newAdd#", $address['id'])) {
                if ($this->isAddressDefine($id, $address['id'])) {
                    $this->editAddress($address['id'], $address);
                    unset($oldAddresses[array_search((string) $address['id'], $oldAddresses)]);
                } else {
                    unset($address['id']);
                    $this->addAddress($id, $address);
                }
            } else {
                unset($address['id']);
                $this->addAddress($id, $address);
            }
            $count++;
        }
        if ($oldAddresses != null) {
            foreach ($oldAddresses as $address) {
                $this->deleteAddress($address->id);
            }
        }

        ///////////////////////
        //Phones verification//
        ///////////////////////
        if (array_key_exists("phones", $data)) {
            $phones = $data['phones'];
        } else {
            $phones = array();
        }

        $count = 0;
        $keys  = array_keys($phones); // grab each key of each phone, should be the id
        $query = $this->db->query("SELECT id FROM phones
             WHERE contact_id = " . $id);
        $oldPhones = $query->result();

        foreach ($phones as $phone) {
            $phone['id'] = $keys[$count];
            if (!preg_match("#^newPhone#", $phone['id'])) {
                if ($this->isPhoneDefine($id, $phone['id'])) {
                    $this->editPhone($phone['id'], $phone);
                    unset($oldPhones[array_search((string) $phone['id'], $oldPhones)]);
                } else {
                    unset($phone['id']);
                    $this->addPhone($id, $phone);
                }
            } else {
                unset($phone['id']);
                $this->addPhone($id, $phone);
            }
            $count++;
        }
        if ($oldPhones != null) {
            foreach ($oldPhones as $phone) {
                $this->deletePhone($phone->id);
            }
        }

        ////////////////////////////
        // Companies Verification //
        ////////////////////////////
        if (array_key_exists("companies_id", $data)) {
            $companies_id = $data['companies_id'];
        } else {
            $companies_id = array();
        }

        $query = $this->db->query("SELECT companies_id FROM contacts_companies
         WHERE contacts_id = " . $id);
        $queryRes        = $query->result();
        $oldcompanies_id = array();
        foreach ($queryRes as $oldCompany) {
            $oldcompanies_id[] = $oldCompany->companies_id;
        }

        $newCompanies    = array_diff($companies_id, $oldcompanies_id);
        $deleteCompanies = array_diff($oldcompanies_id, $companies_id);
        if (!empty($newCompanies)) {
            $this->addCompaniesToContact($id, $newCompanies);
        }
        if (!empty($deleteCompanies)) {
            foreach ($deleteCompanies as $deleteCompany) {
                $this->deleteCompanyFromContact($id, $deleteCompany);
            }
        }

    }

    public function deleteContact($id)
    {

        //To get the most recent ID

        $this->deleteAdressesByContact($id);
        $this->deletePhonesByContact($id);
        $this->deleteCompaniesByContact($id);
        $this->deleteOpportunityByContact($id);

        $this->db->query("DELETE FROM contacts
      WHERE id = " . $id);

        //delete contact_id from opportunities

        //delete contact_id from address

    }

    ///////////////
    // Addresses //
    ///////////////

    public function isAddressDefine($contactId, $id)
    {
        $query = $this->db->query("SELECT * FROM addresses
                WHERE contact_id = " . $contactId . " AND id = " . (string) $id);

        return $query->result();
    }

    public function getAllAddresses($contactId)
    {
        $query = $this->db->query("SELECT * FROM addresses
                WHERE contact_id = " . $contactId);


        return $query->result();
    }

    public function getAddress($id)
    {
        $query = $this->db->query("SELECT * FROM addresses
            WHERE id = " . $id);

        return $query->result();
    }

    public function addAddresses($contactId, $datas)
    {
        $flag;
        foreach ($datas as $data) {
            $flag = $this->addAddress($contactId, $data);
            if (!$flag) {break;}
        }
        return $flag;
    }

    public function addAddress($contactId, $data)
    {
        $last_row           = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('addresses')->row();
        $data['id']         = $last_row->id + 1;
        $data['contact_id'] = $contactId;

        if ($this->db->insert('addresses', $data)) {
            $res = true;
        } else { $res = false;}
        return $res;
    }

    public function editAddress($id, $datas)
    {
        $query = $this->db->query("UPDATE addresses
            SET
            address_type = '" . $datas['address_type'] . "',
            address_line1 = '" . $datas['address_line1'] . "',
            address_line2 = '" . $datas['address_line2'] . "',
            address_line3 = '" . $datas['address_line3'] . "',
            address_line4 = '" . $datas['address_line4'] . "',
            city = '" . $datas['city'] . "',
            county = '" . $datas['county'] . "',
            postal_code = '" . $datas['postal_code'] . "',
            country = '" . $datas['country'] . "'
            WHERE id = " . $id);
    }

    public function deleteAddress($id)
    {
        $query = $this->db->query("DELETE FROM addresses
            WHERE id =" . $id);
    }

    public function deleteAdressesByContact($contactId)
    {
        $query = $this->db->query("DELETE FROM addresses
            WHERE contact_id =" . $contactId);
    }

    ////////////
    // Phones //
    ////////////

    public function isPhoneDefine($contactId, $id)
    {
        $query = $this->db->query("SELECT * FROM phones
                WHERE contact_id = " . $contactId . " AND id = " . (string) $id);

        return $query->result();
    }

    public function getAllPhones($contactId)
    {
        $query = $this->db->query("SELECT * FROM phones
                WHERE contact_id = " . $contactId);

        return $query->result();
    }

    public function getPhone($id)
    {
        $query = $this->db->query("SELECT * FROM phones
            WHERE id = " . $id);

        return $query->result()[0];
    }

    public function addPhones($contactId, $datas)
    {
        $flag;
        foreach ($datas as $data) {
            $flag = $this->addPhone($contactId, $data);
            if (!$flag) {break;}
        }
        return $flag;
    }

    public function addPhone($contactId, $data)
    {
        $last_row           = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('phones')->row();
        $data['id']         = $last_row->id + 1;
        $data['contact_id'] = $contactId;
        if ($this->db->insert('phones', $data)) {
            $res = true;
        } else { $res = false;}
        return $res;
    }

    public function editPhone($id, $datas)
    {
        $query = $this->db->query("UPDATE phones
            SET
            phone_type = '" . $datas['phone_type'] . "',
            phone_number = '" . $datas['phone_number'] . "',
            phone_area_code = '" . $datas['phone_area_code'] . "',
            phone_country_code = '" . $datas['phone_country_code'] . "'
            WHERE id = " . $id);
    }

    public function deletePhone($id)
    {
        $query = $this->db->query("DELETE FROM phones
            WHERE id =" . $id);
    }

    public function deletePhonesByContact($contactId)
    {
        $query = $this->db->query("DELETE FROM phones
            WHERE contact_id =" . $contactId);
    }

    ///////////////
    // Companies //
    ///////////////

    public function getAllCompaniesByContact($contact_id)
    {
        $query = $this->db->query("SELECT companies_id from contacts_companies
                WHERE contacts_id = " . $contact_id);
        $companies_id = $query->result();

        $companies = null;

        foreach ($companies_id as $company_id) {
            $query = $this->db->query('SELECT * FROM companies
                    WHERE id = ' . $company_id->companies_id);
            $companies[] = $query->result();
        }

        return $companies;
    }

    public function getAllAvailableCompanies($id = null)
    {
        $endQuery = "";
        if ($id != null) {
            $query = $this->db->query("SELECT companies_id FROM contacts_companies
                    WHERE contacts_id = " . $id);
            $companies_id = $query->result();
            foreach ($companies_id as $company_id) {
                $endQuery = $endQuery . " AND id != " . $company_id->companies_id;
            }
        }
        $query = $this->db->query("SELECT id , company_name FROM companies
                WHERE id != ''" . $endQuery);
        return $query->result();
    }

    public function addCompaniesToContact($id, $datas)
    {
        $flag;
        foreach ($datas as $data) {
            $flag = $this->addCompanyToContact($id, $data);
            if (!$flag) {break;}
        }
        return $flag;
    }

    public function addCompanyToContact($id, $data)
    {
        $toInsert["contacts_id"]  = $id;
        $toInsert["companies_id"] = $data;
        if ($this->db->insert('contacts_companies', $toInsert)) {
            $res = true;
        } else { $res = false;}
        return $res;
    }

    public function deleteCompaniesByContact($id)
    {
        return $this->db->query("DELETE FROM contacts_companies
                WHERE contacts_id = " . $id);
    }

    public function deleteCompanyFromContact($id, $companyId)
    {
        return $this->db->query("DELETE FROM contacts_companies
                WHERE contacts_id = " . $id . " AND companies_id = " . $companyId);
    }

    //delete contact_id by address

    public function deleteOpportunityByContact($id)
    {
        //contacts_id is an array so loop through it to find $d

        $opport = $this->db->query("SELECT * FROM opportunities WHERE billing_contact = " . $id . "");
        $opport = $opport->result_array();
        foreach ($opport as $opport_single) {


            $prop = $this->db->query("SELECT * FROM proposals WHERE opportunity_id = " . $opport_single['id']);
            $prop = $prop->result_array();

            foreach ($prop as $prop_single) {

                $this->db->query("DELETE FROM proposals_has_products WHERE proposal_id = " . $prop_single['id']);

                $inv = $this->db->query("SELECT * FROM invoices WHERE proposal_id = " . $prop_single['id']);
                $inv = $inv->result_array();

                foreach ($inv as $inv_single) {

                    $this->db->query("DELETE FROM invoices_lines WHERE invoice_id = " . $inv_single['id']);

                }

                $this->db->query("DELETE FROM invoices WHERE proposal_id = " . $prop_single['id']);

            }

            $this->db->query("DELETE FROM proposals WHERE opportunity_id = " . $opport_single['id']);

        }

        $this->db->query("DELETE FROM opportunities WHERE billing_contact = " . $id);

    }

    public function getOpportunities($contact_id){
        $serialized_id = serialize($contact_id);
        $result = $this->db->query("SELECT * FROM opportunities WHERE contacts_id LIKE '%$serialized_id%' ");
        $data = $result->result_array();
        return $data;
    }



}
