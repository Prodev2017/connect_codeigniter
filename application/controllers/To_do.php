<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class To_do extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->library(array('form_validation'));
        
        //Check if user is logged in
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('login', 'refresh');
        }

		$this->load->model('contacts_model');
        $this->load->model('account_model');
		
        //Account data
        $this->user_id = $this->ion_auth->user()->row()->id;
        $account       = $this->account_model->getAccount($this->user_id);
        $this->account = $account[0];
	
	}

	public function index()
	{

		$this->data = [];

        //Pull contacts from model

        $contacts_list = [];

        $this->data['contacts_all_data'] = $this->contacts_model->getAll($this->user_id);

        foreach ($this->data['contacts_all_data'] as $key => $contact_single) {

        //Run search filter
        if (!empty($filter['first_name'])) {
            if (strpos(strtolower($contact_single['first_name']), $filter['first_name']) !== false) {} else {continue;}
        }
        if (!empty($filter['last_name'])) {
            if (strpos(strtolower($contact_single['last_name']), $filter['last_name']) !== false) {} else {
                continue;}
        }
        if (!empty($filter['email_address'])) {
            if (strpos(strtolower($contact_single['email']), $filter['email_address']) !== false) {} else {
                continue;}
        }
        if (!empty($filter['company'])) {
            if (!empty($contact_single['companies'][0][0]->company_name)) {
                if (strpos(strtolower($contact_single['companies'][0][0]->company_name), $filter['company']) !== false) {} else {continue;}
            }
        }

        if (!empty($filter['with_has_all_tags'])) {
            $does_not_have_tag = 0;
            $with_tags         = explode(",", $filter['with_tags']);

            if (!empty($contact_single['tags_string'])) {
                foreach ($with_tags as $with_tags_single) {
                    if (strpos($contact_single['tags_string'], trim($with_tags_single)) !== false) {} else { $does_not_have_tag = 1;}
                }
            } else {continue;}

            if ($does_not_have_tag == 1) {continue;}
        }

        if (!empty($filter['with_has_any_tags'])) {
            $found_tag = 0;
            $with_tags = explode(",", $filter['with_tags']);

            if (!empty($contact_single['tags_string'])) {
                foreach ($with_tags as $with_tags_single) {
                    if (strpos($contact_single['tags_string'], trim($with_tags_single)) !== false) {$found_tag = 1;} else {}
                }
            } else {continue;}

            if ($found_tag == 0) {continue;}
        }

        if (!empty($filter['without_has_all_tags'])) {
            $does_not_have_tag = 0;
            $without_tags      = explode(",", $filter['without_tags']);

            if (!empty($contact_single['tags_string'])) {
                foreach ($without_tags as $without_tags_single) {
                    if (strpos($contact_single['tags_string'], trim($without_tags_single)) !== false) {$does_not_have_tag = 1;} else {}
                }
            }

            if ($does_not_have_tag == 1) {continue;}
        }

        if (!empty($filter['without_has_any_tags'])) {
            $found_tag    = 0;
            $without_tags = explode(",", $filter['without_tags']);

            if (!empty($contact_single['tags_string'])) {
                foreach ($without_tags as $without_tags_single) {
                    if (strpos($contact_single['tags_string'], trim($without_tags_single)) !== false) {$found_tag = 1;} else {}
                }
            }

            if ($found_tag == 1) {continue;}
        }

        if (!empty($filter['keyword'])) {
            $keyword_found = 0;
            if (strpos(strtolower($contact_single['first_name']), $filter['keyword']) !== false) {$keyword_found = 1;}
            if (strpos(strtolower($contact_single['last_name']), $filter['keyword']) !== false) {$keyword_found = 1;}
            if (!empty($contact_single['web'])) {
                if (strpos(strtolower($contact_single['web']), $filter['keyword']) !== false) {$keyword_found = 1;}
            }
            if (strpos(strtolower($contact_single['email']), $filter['keyword']) !== false) {$keyword_found = 1;}

            if ($keyword_found == 0) {continue;}
        }

        if (!empty($filter['has_bought'])) {
            $product_has_brought = $this->invoices_model->product_has_bought($contact_single['xero_id'], $filter['product']);
            if ($product_has_brought == 0) {continue;}
        }

        if (!empty($filter['has_not_bought'])) {
            $product_has_brought = $this->invoices_model->product_has_bought($contact_single['xero_id'], $filter['product']);
            if ($product_has_brought == 1) {continue;}
        }

        $contacts_list[$key] = array(
            'id'            => $contact_single['id'],
            'job_title'     => $contact_single['job_title'],
            'name'          => strtoupper($contact_single['first_name'] . ' ' . $contact_single['last_name']),
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

            $contacts_list[$key]['address'] = $address;
        }

        if (!empty($contact_single['companies'][0][0]->company_name)) {
            $contacts_list[$key]['company'] = $contact_single['companies'][0][0]->company_name;
        }

        if (!empty($contact_single['phones'][0]->phone_area_code)) {
            if (!empty($contact_single['phones'][0]->phone_number)) {
                $contacts_list[$key]['phone'] = $contact_single['phones'][0]->phone_area_code . ' ' . $contact_single['phones'][0]->phone_number;
            }
        }

        //Gravatar
        //$default = base_url().'assets/img/profile-tim-cook@2x.png';
        $default = 'https://www.tremark.co.uk/wp-content/uploads/2016/02/placeholder-male.png';


        $size                        = 200;
        $grav_url                    = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($contact_single['email']))) . "?d=" . urlencode($default) . "&s=" . $size;
        $contacts_list[$key]['grav'] = $grav_url;

        }
        $this->data['contacts'] = $contacts_list;
		$this->_render_page('to_do/index', $this->data);

	}


	public function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}
}
