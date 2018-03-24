<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Connection extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));

        //Load the contacts model
        $this->load->model('contacts_model');
        $this->load->model('account_model');
        $this->load->model('invoices_model');

        //Check if user is logged in
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('login', 'refresh');
        }

        //Account data
        $this->user_id = $this->ion_auth->user()->row()->id;
        $account       = $this->account_model->getAccount($this->user_id);
        $this->account = $account[0];

    }

    public function index($contact_id)
    {

        $this->data = [];
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
        $this->data['contact_single'] = $contact;
        $this->data['sub_navigation'] = true;
        $this->_render_page('connection/create-note', $this->data);

    }

    public function create_note($contact_id)
    {

        $this->data = [];

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
        $this->data['contact_single'] = $contact;
        $this->data['sub_navigation'] = true;
        $this->_render_page('connection/create-note', $this->data);

    }

    public function add_task($contact_id)
    {

                $this->data = [];

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
        $this->data['contact_single'] = $contact;
        $this->data['sub_navigation'] = true;
        $this->_render_page('connection/add-task', $this->data);

    }

    public function book_meeting($contact_id)
    {

                $this->data = [];

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
        $this->data['contact_single'] = $contact;
        $this->data['sub_navigation'] = true;
        $this->_render_page('connection/book-meeting', $this->data);

    }

    public function make_call($contact_id)
    {

                $this->data = [];

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
        $this->data['contact_single'] = $contact;
        $this->data['sub_navigation'] = true;
        $this->_render_page('connection/make-call', $this->data);

    }

    public function send_email($contact_id)
    {

                $this->data = [];

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
        $this->data['contact_single'] = $contact;
        $this->data['sub_navigation'] = true;
        $this->_render_page('connection/send-email', $this->data);

    }

    public function send_quote($contact_id)
    {

                $this->data = [];

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
        $this->data['contact_single'] = $contact;
        $this->data['sub_navigation'] = true;
        $this->_render_page('connection/send-quote', $this->data);

    }

    public function manage_tags($contact_id)
    {

                $this->data = [];

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
        $this->data['contact_single'] = $contact;
        $this->data['sub_navigation'] = true;
        $this->_render_page('connection/manage-tags', $this->data);

    }

    public function set_deadline($contact_id)
    {

                $this->data = [];

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
        $this->data['contact_single'] = $contact;
        $this->data['sub_navigation'] = true;
        $this->_render_page('connection/set-deadline', $this->data);

    }

    public function _render_page($view, $data = null, $returnhtml = false) //I think this makes more sense

    {

        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $returnhtml);

        if ($returnhtml) {
            return $view_html;
        }
//This will return html on 3rd argument being true
    }
}
