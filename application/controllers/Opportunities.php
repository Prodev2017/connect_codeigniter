<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opportunities extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
		$this->load->library(array('form_validation'));
    $this->load->helper(array('url','language'));
    //Check if user is logged in
    if (!$this->ion_auth->logged_in()) {
        // redirect them to the login page
        redirect('login', 'refresh');
    }

    $this->load->model('opportunities_model');
    $this->load->model('contacts_model');
    $this->load->model('companies_model');
    $this->load->model('stages_model');

    $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		//load user language
		$this->lang->load('user');
                $this->lang->load('opportunities');
  }

  public function index() {
    
    $this->data['user'] = $this->ion_auth->user()->row();


    //Pass information in $this->data;

    $user_id = $this->ion_auth->user()->row()->id;

    //Run the getAll() from the Opportunities model
      $this->data['opportunities_all']= $this->opportunities_model->getAll($user_id);
      $numberedIndex = 0;
      foreach($this->data['opportunities_all'] as $index)
      {
              if(!is_null($index->outcome_id))
              {
                      $stageID = $this->stages_model->getStageFromOutcome($index->outcome_id);
                      $this->data['opportunities_all'][$numberedIndex]->stage_id = $stageID->stage_id;
                      $stageString = $this->stages_model->getStageNameFromID($stageID->stage_id);
                      $this->data['opportunities_all'][$numberedIndex]->stage_string = $stageString->name;
                      $outcomeString = $this->stages_model->getOutcomeNameFromID($index->outcome_id);
                      $this->data['opportunities_all'][$numberedIndex]->outcome_string = $outcomeString->name;
              }
              else {
                      $stageID = '';
                      $this->data['opportunities_all'][$numberedIndex]->stage_id = $stageID;
                      $stageString = '';
                      $this->data['opportunities_all'][$numberedIndex]->stage_string = $stageString;
                      $outcomeString = '';
                      $this->data['opportunities_all'][$numberedIndex]->outcome_string = $outcomeString;
              }

              if(!is_null($index->billing_contact))
              {
                      $contactObj = $this->contacts_model->getContact($index->billing_contact);
                      $this->data['opportunities_all'][$numberedIndex]->billing_contact_string = $contactObj['first_name'] . ' ' . $contactObj['last_name'];
              }
              else{
                      $this->data['opportunities_all'][$numberedIndex]->billing_contact_string = '';
              }

              if(!is_null($index->companies_id))
              {
                    $this->data['opportunities_all'][$numberedIndex]->company_string = $this->companies_model->getCompany(unserialize($index->companies_id)[0])->company_name;
              }
              else {
                      $this->data['opportunities_all'][$numberedIndex]->company_string = '';
              }

              $numberedIndex = $numberedIndex + 1;
      }




      $this->_render_page('opportunities/all', $this->data);
  }

  public function add()
  {
    $this->data = '';

    $this->data['user'] = $this->ion_auth->user()->row();
    $this->data['available_companies'] = $this->opportunities_model->getAllAvailableCompanies();
    $this->data['available_contacts'] = $this->opportunities_model->getAllAvailableContacts();
    $this->_render_page('opportunities/add', $this->data);
  }

  public function add_opportunity()
  {
    
    $user_id = $this->ion_auth->user()->row()->id;
    if(isset($_POST['contacts_id'])){
      $_POST['contacts_id'] = serialize($_POST['contacts_id']);
    }

    // check if we have to include company also or not
    if(isset($_POST['include_company'])){
        if(isset($_POST['companies_id'])){
            $_POST['companies_id'] = serialize($_POST['companies_id']);
        }
        unset($_POST['include_company']);
    }
    else{
        if(isset($_POST['companies_id'])){
            unset($_POST['companies_id']);
        }
    }

    

    $this->opportunities_model->addOpportunity($_POST, $user_id);
    // if this was sent from contacts page then send it there
    if(isset($_POST['page'])){
      redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }
    else{
      redirect('opportunities', 'refresh');
    }
    
  }

  public function add_contact_to_opportunity()
  {

  }

  public function edit($id)
  {
    $this->data = '';

    $this->data['user'] = $this->ion_auth->user()->row();
    $this->data['opportunity'] = $this->opportunities_model->getOpportunity($id);
    $this->data['available_companies'] = $this->opportunities_model->getAllAvailableCompanies($id);
    $this->data['available_contacts'] = $this->opportunities_model->getAllAvailableContacts($id);
    $this->data['contacts'] = $this->opportunities_model->getContacts($id);
    $this->data['companies'] = $this->opportunities_model->getCompanies($id);
    $this->data['proposal'] = $this->opportunities_model->getLastProposal($id);

    //$products = $this->getAllProducts($this->data['proposal']->id);
    //foreach($products as $product){
      //$this->data['products'][$product->id]['product'] = $product;
     // $this->data['products'][$product->id]['quantity'] = $this->proposals_model->getQuantity($this->data['proposal']->id, $product->id);
    //}

    $this->_render_page('opportunities/edit', $this->data);
  }

  public function edit_opportunity($id)
  {
    $this->opportunities_model->editOpportunity($id, $_POST);

    redirect('opportunities', 'refresh');
  }

  public function view()
  {

  }

  //connections related 
  public function create_note($opportunity_id)
    {

        $this->data = [];

        $this->data['opportunity'] = $this->opportunities_model->getOpportunity($opportunity_id);

        //get opportunity contacts
        $opportunity_contacts = $this->opportunities_model->getContacts($opportunity_id);

        //get full details of the first contact
        $contact_id=0;
        if(count($opportunity_contacts)>0){
          $contact_id = $opportunity_contacts[0]->id;
          //remove the first contact from the list so that it doesn't appear in other contacts list
          unset($opportunity_contacts[0]);
        }

        $contact_single = $this->contacts_model->getContact($contact_id);

        $contact = array(
            'id'            => $contact_single['id'],
            'name'          => $contact_single['first_name'] . ' ' . $contact_single['last_name'],
            'first_name'    => $contact_single['first_name'],
            'last_name'     => $contact_single['last_name'],
            'email'         => $contact_single['email'],
            'web'           => $contact_single['website'],
            'sales_to_date' => $contact_single['sales_to_date'],
        );

        if (!empty($contact_single['addresses'][0]->address_line1)) {

            $address = '';
            if (!empty($contact_single['addresses'][0]->address_line1)) {
                $address = $address . $contact_single['addresses'][0]->address_line1 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line2)) {
                $address = $address . $contact_single['addresses'][0]->address_line2 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line3)) {
                $address = $address . $contact_single['addresses'][0]->address_line3 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->city)) {
                $address = $address . $contact_single['addresses'][0]->city . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line4)) {
                $address = $address . $contact_single['addresses'][0]->address_line4 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->postal_code)) {
                $address = $address . $contact_single['addresses'][0]->postal_code . '';
            }

            $contact['address'] = $address;
        }

        if (!empty($contact_single['companies'][0][0]->company_name)) {
            $contact['company'] = $contact_single['companies'][0][0]->company_name;
        }

        if (!empty($contact_single['phones'][0]->phone_area_code)) {
            if (!empty($contact_single['phones'][0]->phone_number)) {
                $contact['phone'] = $contact_single['phones'][0]->phone_area_code . ' ' . $contact_single['phones'][0]->phone_number;
            }
        }

        // get opportunity detaisl including stage name and color

        //Gravatar
        //$default = base_url().'assets/img/profile-tim-cook@2x.png';
        $default = 'https://www.tremark.co.uk/wp-content/uploads/2016/02/placeholder-male.png';

        $size            = 200;
        $grav_url        = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($contact_single['email']))) . "?d=" . urlencode($default) . "&s=" . $size;
        $contact['grav'] = $grav_url;
        $this->data['contactid']=$contact_id;
        $this->data['opportunity_id'] = $opportunity_id;
        $this->data['contact_single'] = $contact;
        $this->data['other_contacts'] = $opportunity_contacts;
        $this->data['sub_navigation'] = true;
        $this->_render_page('opportunities/create-note', $this->data);

    }

    public function add_task($opportunity_id)
    {
        $this->data = [];
        $this->data['opportunity'] = $this->opportunities_model->getOpportunity($opportunity_id);

        //get opportunity contacts
        $opportunity_contacts = $this->opportunities_model->getContacts($opportunity_id);

        //get full details of the first contact
        if(count($opportunity_contacts)>0){
          $contact_id = $opportunity_contacts[0]->id;
          //remove the first contact from the list so that it doesn't appear in other contacts list
          unset($opportunity_contacts[0]);
        }

        $contact_single = $this->contacts_model->getContact($contact_id);

        $contact = array(
            'id'            => $contact_single['id'],
            'name'          => $contact_single['first_name'] . ' ' . $contact_single['last_name'],
            'first_name'    => $contact_single['first_name'],
            'last_name'     => $contact_single['last_name'],
            'email'         => $contact_single['email'],
            'web'           => $contact_single['website'],
            'sales_to_date' => $contact_single['sales_to_date'],
        );

        if (!empty($contact_single['addresses'][0]->address_line1)) {

            $address = '';
            if (!empty($contact_single['addresses'][0]->address_line1)) {
                $address = $address . $contact_single['addresses'][0]->address_line1 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line2)) {
                $address = $address . $contact_single['addresses'][0]->address_line2 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line3)) {
                $address = $address . $contact_single['addresses'][0]->address_line3 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->city)) {
                $address = $address . $contact_single['addresses'][0]->city . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line4)) {
                $address = $address . $contact_single['addresses'][0]->address_line4 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->postal_code)) {
                $address = $address . $contact_single['addresses'][0]->postal_code . '';
            }

            $contact['address'] = $address;
        }

        if (!empty($contact_single['companies'][0][0]->company_name)) {
            $contact['company'] = $contact_single['companies'][0][0]->company_name;
        }

        if (!empty($contact_single['phones'][0]->phone_area_code)) {
            if (!empty($contact_single['phones'][0]->phone_number)) {
                $contact['phone'] = $contact_single['phones'][0]->phone_area_code . ' ' . $contact_single['phones'][0]->phone_number;
            }
        }

        //Gravatar
        //$default = base_url().'assets/img/profile-tim-cook@2x.png';
        $default = 'https://www.tremark.co.uk/wp-content/uploads/2016/02/placeholder-male.png';

        $size            = 200;
        $grav_url        = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($contact_single['email']))) . "?d=" . urlencode($default) . "&s=" . $size;
        $contact['grav'] = $grav_url;
        $this->data['contactid']=$contact_id;
        $this->data['opportunity_id'] = $opportunity_id;
        $this->data['contact_single'] = $contact;
        $this->data['other_contacts'] = $opportunity_contacts;
        $this->data['sub_navigation'] = true;
        $this->_render_page('opportunities/add-task', $this->data);

    }

    public function book_meeting($opportunity_id)
    {
        $this->data = [];
        $this->data['opportunity'] = $this->opportunities_model->getOpportunity($opportunity_id);

        //get opportunity contacts
        $opportunity_contacts = $this->opportunities_model->getContacts($opportunity_id);

        //get full details of the first contact
        if(count($opportunity_contacts)>0){
          $contact_id = $opportunity_contacts[0]->id;
          //remove the first contact from the list so that it doesn't appear in other contacts list
          unset($opportunity_contacts[0]);
        }

        $contact_single = $this->contacts_model->getContact($contact_id);

        $contact = array(
            'id'            => $contact_single['id'],
            'name'          => $contact_single['first_name'] . ' ' . $contact_single['last_name'],
            'first_name'    => $contact_single['first_name'],
            'last_name'     => $contact_single['last_name'],
            'email'         => $contact_single['email'],
            'web'           => $contact_single['website'],
            'sales_to_date' => $contact_single['sales_to_date'],
        );

        if (!empty($contact_single['addresses'][0]->address_line1)) {

            $address = '';
            if (!empty($contact_single['addresses'][0]->address_line1)) {
                $address = $address . $contact_single['addresses'][0]->address_line1 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line2)) {
                $address = $address . $contact_single['addresses'][0]->address_line2 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line3)) {
                $address = $address . $contact_single['addresses'][0]->address_line3 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->city)) {
                $address = $address . $contact_single['addresses'][0]->city . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line4)) {
                $address = $address . $contact_single['addresses'][0]->address_line4 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->postal_code)) {
                $address = $address . $contact_single['addresses'][0]->postal_code . '';
            }

            $contact['address'] = $address;
        }

        if (!empty($contact_single['companies'][0][0]->company_name)) {
            $contact['company'] = $contact_single['companies'][0][0]->company_name;
        }

        if (!empty($contact_single['phones'][0]->phone_area_code)) {
            if (!empty($contact_single['phones'][0]->phone_number)) {
                $contact['phone'] = $contact_single['phones'][0]->phone_area_code . ' ' . $contact_single['phones'][0]->phone_number;
            }
        }

        //Gravatar
        //$default = base_url().'assets/img/profile-tim-cook@2x.png';
        $default = 'https://www.tremark.co.uk/wp-content/uploads/2016/02/placeholder-male.png';

        $size            = 200;
        $grav_url        = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($contact_single['email']))) . "?d=" . urlencode($default) . "&s=" . $size;
        $contact['grav'] = $grav_url;
        $this->data['contactid']=$contact_id;
        $this->data['opportunity_id'] = $opportunity_id;
        $this->data['contact_single'] = $contact;
        $this->data['other_contacts'] = $opportunity_contacts;
        $this->data['sub_navigation'] = true;
        $this->_render_page('opportunities/book-meeting', $this->data);

    }

    public function make_call($opportunity_id)
    {
        $this->data = [];
        $this->data['opportunity'] = $this->opportunities_model->getOpportunity($opportunity_id);

        //get opportunity contacts
        $opportunity_contacts = $this->opportunities_model->getContacts($opportunity_id);

        //get full details of the first contact
        if(count($opportunity_contacts)>0){
          $contact_id = $opportunity_contacts[0]->id;
          //remove the first contact from the list so that it doesn't appear in other contacts list
          unset($opportunity_contacts[0]);
        }

        $contact_single = $this->contacts_model->getContact($contact_id);

        $contact = array(
            'id'            => $contact_single['id'],
            'name'          => $contact_single['first_name'] . ' ' . $contact_single['last_name'],
            'first_name'    => $contact_single['first_name'],
            'last_name'     => $contact_single['last_name'],
            'email'         => $contact_single['email'],
            'web'           => $contact_single['website'],
            'sales_to_date' => $contact_single['sales_to_date'],
        );

        if (!empty($contact_single['addresses'][0]->address_line1)) {

            $address = '';
            if (!empty($contact_single['addresses'][0]->address_line1)) {
                $address = $address . $contact_single['addresses'][0]->address_line1 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line2)) {
                $address = $address . $contact_single['addresses'][0]->address_line2 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line3)) {
                $address = $address . $contact_single['addresses'][0]->address_line3 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->city)) {
                $address = $address . $contact_single['addresses'][0]->city . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line4)) {
                $address = $address . $contact_single['addresses'][0]->address_line4 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->postal_code)) {
                $address = $address . $contact_single['addresses'][0]->postal_code . '';
            }

            $contact['address'] = $address;
        }

        if (!empty($contact_single['companies'][0][0]->company_name)) {
            $contact['company'] = $contact_single['companies'][0][0]->company_name;
        }

        if (!empty($contact_single['phones'][0]->phone_area_code)) {
            if (!empty($contact_single['phones'][0]->phone_number)) {
                $contact['phone'] = $contact_single['phones'][0]->phone_area_code . ' ' . $contact_single['phones'][0]->phone_number;
            }
        }

        //Gravatar
        //$default = base_url().'assets/img/profile-tim-cook@2x.png';
        $default = 'https://www.tremark.co.uk/wp-content/uploads/2016/02/placeholder-male.png';

        $size            = 200;
        $grav_url        = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($contact_single['email']))) . "?d=" . urlencode($default) . "&s=" . $size;
        $contact['grav'] = $grav_url;
        $this->data['contactid']=$contact_id;
        $this->data['opportunity_id'] = $opportunity_id;
        $this->data['contact_single'] = $contact;
        $this->data['other_contacts'] = $opportunity_contacts;
        $this->data['sub_navigation'] = true;
        $this->_render_page('opportunities/make-call', $this->data);

    }

    public function send_email($opportunity_id)
    {
        $this->data = [];
        $this->data['opportunity'] = $this->opportunities_model->getOpportunity($opportunity_id);

        //get opportunity contacts
        $opportunity_contacts = $this->opportunities_model->getContacts($opportunity_id);

        //get full details of the first contact
        if(count($opportunity_contacts)>0){
          $contact_id = $opportunity_contacts[0]->id;
          //remove the first contact from the list so that it doesn't appear in other contacts list
          unset($opportunity_contacts[0]);
        }

        $contact_single = $this->contacts_model->getContact($contact_id);

        $contact = array(
            'id'            => $contact_single['id'],
            'name'          => $contact_single['first_name'] . ' ' . $contact_single['last_name'],
            'first_name'    => $contact_single['first_name'],
            'last_name'     => $contact_single['last_name'],
            'email'         => $contact_single['email'],
            'web'           => $contact_single['website'],
            'sales_to_date' => $contact_single['sales_to_date'],
        );

        if (!empty($contact_single['addresses'][0]->address_line1)) {

            $address = '';
            if (!empty($contact_single['addresses'][0]->address_line1)) {
                $address = $address . $contact_single['addresses'][0]->address_line1 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line2)) {
                $address = $address . $contact_single['addresses'][0]->address_line2 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line3)) {
                $address = $address . $contact_single['addresses'][0]->address_line3 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->city)) {
                $address = $address . $contact_single['addresses'][0]->city . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line4)) {
                $address = $address . $contact_single['addresses'][0]->address_line4 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->postal_code)) {
                $address = $address . $contact_single['addresses'][0]->postal_code . '';
            }

            $contact['address'] = $address;
        }

        if (!empty($contact_single['companies'][0][0]->company_name)) {
            $contact['company'] = $contact_single['companies'][0][0]->company_name;
        }

        if (!empty($contact_single['phones'][0]->phone_area_code)) {
            if (!empty($contact_single['phones'][0]->phone_number)) {
                $contact['phone'] = $contact_single['phones'][0]->phone_area_code . ' ' . $contact_single['phones'][0]->phone_number;
            }
        }

        //Gravatar
        //$default = base_url().'assets/img/profile-tim-cook@2x.png';
        $default = 'https://www.tremark.co.uk/wp-content/uploads/2016/02/placeholder-male.png';

        $size            = 200;
        $grav_url        = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($contact_single['email']))) . "?d=" . urlencode($default) . "&s=" . $size;
        $contact['grav'] = $grav_url;
        $this->data['contactid']=$contact_id;
        $this->data['opportunity_id'] = $opportunity_id;
        $this->data['contact_single'] = $contact;
        $this->data['other_contacts'] = $opportunity_contacts;
        $this->data['sub_navigation'] = true;
        $this->_render_page('opportunities/send-email', $this->data);

    }

    public function send_quote($opportunity_id)
    {
        $this->data = [];
        $this->data['opportunity'] = $this->opportunities_model->getOpportunity($opportunity_id);

        //get opportunity contacts
        $opportunity_contacts = $this->opportunities_model->getContacts($opportunity_id);

        //get full details of the first contact
        if(count($opportunity_contacts)>0){
          $contact_id = $opportunity_contacts[0]->id;
          //remove the first contact from the list so that it doesn't appear in other contacts list
          unset($opportunity_contacts[0]);
        }

        $contact_single = $this->contacts_model->getContact($contact_id);

        $contact = array(
            'id'            => $contact_single['id'],
            'name'          => $contact_single['first_name'] . ' ' . $contact_single['last_name'],
            'first_name'    => $contact_single['first_name'],
            'last_name'     => $contact_single['last_name'],
            'email'         => $contact_single['email'],
            'web'           => $contact_single['website'],
            'sales_to_date' => $contact_single['sales_to_date'],
        );

        if (!empty($contact_single['addresses'][0]->address_line1)) {

            $address = '';
            if (!empty($contact_single['addresses'][0]->address_line1)) {
                $address = $address . $contact_single['addresses'][0]->address_line1 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line2)) {
                $address = $address . $contact_single['addresses'][0]->address_line2 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line3)) {
                $address = $address . $contact_single['addresses'][0]->address_line3 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->city)) {
                $address = $address . $contact_single['addresses'][0]->city . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line4)) {
                $address = $address . $contact_single['addresses'][0]->address_line4 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->postal_code)) {
                $address = $address . $contact_single['addresses'][0]->postal_code . '';
            }

            $contact['address'] = $address;
        }

        if (!empty($contact_single['companies'][0][0]->company_name)) {
            $contact['company'] = $contact_single['companies'][0][0]->company_name;
        }

        if (!empty($contact_single['phones'][0]->phone_area_code)) {
            if (!empty($contact_single['phones'][0]->phone_number)) {
                $contact['phone'] = $contact_single['phones'][0]->phone_area_code . ' ' . $contact_single['phones'][0]->phone_number;
            }
        }

        //Gravatar
        //$default = base_url().'assets/img/profile-tim-cook@2x.png';
        $default = 'https://www.tremark.co.uk/wp-content/uploads/2016/02/placeholder-male.png';

        $size            = 200;
        $grav_url        = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($contact_single['email']))) . "?d=" . urlencode($default) . "&s=" . $size;
        $contact['grav'] = $grav_url;
        $this->data['contactid']=$contact_id;
        $this->data['opportunity_id'] = $opportunity_id;
        $this->data['contact_single'] = $contact;
        $this->data['other_contacts'] = $opportunity_contacts;
        $this->data['sub_navigation'] = true;
        $this->_render_page('opportunities/send-quote', $this->data);

    }

    public function manage_tags($opportunity_id)
    {
        $this->data = [];
        $this->data['opportunity'] = $this->opportunities_model->getOpportunity($opportunity_id);

        //get opportunity contacts
        $opportunity_contacts = $this->opportunities_model->getContacts($opportunity_id);

        //get full details of the first contact
        if(count($opportunity_contacts)>0){
          $contact_id = $opportunity_contacts[0]->id;
          //remove the first contact from the list so that it doesn't appear in other contacts list
          unset($opportunity_contacts[0]);
        }

        $contact_single = $this->contacts_model->getContact($contact_id);

        $contact = array(
            'id'            => $contact_single['id'],
            'name'          => $contact_single['first_name'] . ' ' . $contact_single['last_name'],
            'first_name'    => $contact_single['first_name'],
            'last_name'     => $contact_single['last_name'],
            'email'         => $contact_single['email'],
            'web'           => $contact_single['website'],
            'sales_to_date' => $contact_single['sales_to_date'],
        );

        if (!empty($contact_single['addresses'][0]->address_line1)) {

            $address = '';
            if (!empty($contact_single['addresses'][0]->address_line1)) {
                $address = $address . $contact_single['addresses'][0]->address_line1 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line2)) {
                $address = $address . $contact_single['addresses'][0]->address_line2 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line3)) {
                $address = $address . $contact_single['addresses'][0]->address_line3 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->city)) {
                $address = $address . $contact_single['addresses'][0]->city . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line4)) {
                $address = $address . $contact_single['addresses'][0]->address_line4 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->postal_code)) {
                $address = $address . $contact_single['addresses'][0]->postal_code . '';
            }

            $contact['address'] = $address;
        }

        if (!empty($contact_single['companies'][0][0]->company_name)) {
            $contact['company'] = $contact_single['companies'][0][0]->company_name;
        }

        if (!empty($contact_single['phones'][0]->phone_area_code)) {
            if (!empty($contact_single['phones'][0]->phone_number)) {
                $contact['phone'] = $contact_single['phones'][0]->phone_area_code . ' ' . $contact_single['phones'][0]->phone_number;
            }
        }

        //Gravatar
        //$default = base_url().'assets/img/profile-tim-cook@2x.png';
        $default = 'https://www.tremark.co.uk/wp-content/uploads/2016/02/placeholder-male.png';

        $size            = 200;
        $grav_url        = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($contact_single['email']))) . "?d=" . urlencode($default) . "&s=" . $size;
        $contact['grav'] = $grav_url;
        $this->data['contactid']=$contact_id;
        $this->data['opportunity_id'] = $opportunity_id;
        $this->data['contact_single'] = $contact;
        $this->data['other_contacts'] = $opportunity_contacts;
        $this->data['sub_navigation'] = true;
        $this->_render_page('opportunities/manage-tags', $this->data);

    }

    public function set_deadline($opportunity_id)
    {
        $this->data = [];
        $this->data['opportunity'] = $this->opportunities_model->getOpportunity($opportunity_id);

        //get opportunity contacts
        $opportunity_contacts = $this->opportunities_model->getContacts($opportunity_id);

        //get full details of the first contact
        if(count($opportunity_contacts)>0){
          $contact_id = $opportunity_contacts[0]->id;
          //remove the first contact from the list so that it doesn't appear in other contacts list
          unset($opportunity_contacts[0]);
        }

        $contact_single = $this->contacts_model->getContact($contact_id);

        $contact = array(
            'id'            => $contact_single['id'],
            'name'          => $contact_single['first_name'] . ' ' . $contact_single['last_name'],
            'first_name'    => $contact_single['first_name'],
            'last_name'     => $contact_single['last_name'],
            'email'         => $contact_single['email'],
            'web'           => $contact_single['website'],
            'sales_to_date' => $contact_single['sales_to_date'],
        );

        if (!empty($contact_single['addresses'][0]->address_line1)) {

            $address = '';
            if (!empty($contact_single['addresses'][0]->address_line1)) {
                $address = $address . $contact_single['addresses'][0]->address_line1 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line2)) {
                $address = $address . $contact_single['addresses'][0]->address_line2 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line3)) {
                $address = $address . $contact_single['addresses'][0]->address_line3 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->city)) {
                $address = $address . $contact_single['addresses'][0]->city . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->address_line4)) {
                $address = $address . $contact_single['addresses'][0]->address_line4 . '<br>';
            }
            if (!empty($contact_single['addresses'][0]->postal_code)) {
                $address = $address . $contact_single['addresses'][0]->postal_code . '';
            }

            $contact['address'] = $address;
        }

        if (!empty($contact_single['companies'][0][0]->company_name)) {
            $contact['company'] = $contact_single['companies'][0][0]->company_name;
        }

        if (!empty($contact_single['phones'][0]->phone_area_code)) {
            if (!empty($contact_single['phones'][0]->phone_number)) {
                $contact['phone'] = $contact_single['phones'][0]->phone_area_code . ' ' . $contact_single['phones'][0]->phone_number;
            }
        }

        //Gravatar
        //$default = base_url().'assets/img/profile-tim-cook@2x.png';
        $default = 'https://www.tremark.co.uk/wp-content/uploads/2016/02/placeholder-male.png';

        $size            = 200;
        $grav_url        = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($contact_single['email']))) . "?d=" . urlencode($default) . "&s=" . $size;
        $contact['grav'] = $grav_url;
        $this->data['contactid']=$contact_id;
        $this->data['opportunity_id'] = $opportunity_id;
        $this->data['contact_single'] = $contact;
        $this->data['other_contacts'] = $opportunity_contacts;
        $this->data['sub_navigation'] = true;
        $this->_render_page('opportunities/set-deadline', $this->data);

    }

  public function _render_page($view, $data=null, $returnhtml=false)
  {
    $this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
  }
}
