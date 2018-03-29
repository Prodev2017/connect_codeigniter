<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class API_model extends CI_Model
{
    //Load Xero API

    public function __construct()
    {
        parent::__construct();

        error_reporting(0);
        ini_set('display_errors', 0);

        include_once dirname(__FILE__) . "/../../api/xero/src/XeroPHP/loader.php";
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->xero_API = new stdClass();

        $this->xero_API->cabundle = '-----BEGIN CERTIFICATE-----
MIICWzCCAcSgAwIBAgIJANzMGkf8obuxMA0GCSqGSIb3DQEBCwUAMEUxCzAJBgNV
BAYTAkFVMRMwEQYDVQQIDApTb21lLVN0YXRlMSEwHwYDVQQKDBhJbnRlcm5ldCBX
aWRnaXRzIFB0eSBMdGQwHhcNMTcwNzEzMTcxNDIxWhcNMjIwNzEyMTcxNDIxWjBF
MQswCQYDVQQGEwJBVTETMBEGA1UECAwKU29tZS1TdGF0ZTEhMB8GA1UECgwYSW50
ZXJuZXQgV2lkZ2l0cyBQdHkgTHRkMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKB
gQDmzbvZaQO1MOojojSeL99JULgpHOLEB/kwKaQ5p4BJ9yRpF99sypRGLJgUOY/H
FSjpoaiudJ5KGW+oAp2x9vLEegFQsonZLQDQgTrizZsfQXWMYXe7D37TmJr37NzP
CsfqXZHV1vMxm12cfEGfhIXD3ighCo38dF93aGMTtRba6QIDAQABo1MwUTAdBgNV
HQ4EFgQUW7e96BevsDEG4segYtb+oXAYm3QwHwYDVR0jBBgwFoAUW7e96BevsDEG
4segYtb+oXAYm3QwDwYDVR0TAQH/BAUwAwEB/zANBgkqhkiG9w0BAQsFAAOBgQB6
sdsT7s6NbqaouIl2F5yT9QNedu6nDNBgzw1Yu6mPXr/k2Lf86UhZpxj+tMi8Xa64
7XvNtAfHIKPV6hM5gn/swN5PtVqMtLPwlZQnnstW/FdjX+mr/JtQC90e1k+8WNPH
kIrd2qWYV40zPc+/aKzbSUTGnymQmKJeIv2ttRfZaw==
-----END CERTIFICATE-----';
        $this->xero_API->private = '-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQDmzbvZaQO1MOojojSeL99JULgpHOLEB/kwKaQ5p4BJ9yRpF99s
ypRGLJgUOY/HFSjpoaiudJ5KGW+oAp2x9vLEegFQsonZLQDQgTrizZsfQXWMYXe7
D37TmJr37NzPCsfqXZHV1vMxm12cfEGfhIXD3ighCo38dF93aGMTtRba6QIDAQAB
AoGAWF4EwiTW6pSj0KjWBIrHrsZc/EC3Ad8bpTkMS5a6I5egNSySupCFXKjOQVAY
oFyVoX3nm4PC5xP+EBGQVwb5w03flJFhd4ogQzdL3s9ryI+HpcFexMRraTGJmBtC
t2ATiVkTNtu64LpXL5bqKVqLYgSM8JYhml6WsuFYTEL8eVECQQD0vuPkighuANT3
Z5wq6MU00BJXGU0adIdqI9afwOWLtkultw6eJrN62VpK3tyNtV0rRELSWBQCuRp+
I4iG/ownAkEA8Wq4X+oYXxlP0K4y+PEy9enHfLZvOwb5vGoN3fSA9DRAxIpsooTy
yjRqNLbeLVQWtlQqQfuLeisPvkN8X5b6bwJBAMIlu3pL1SwOFOK9mjCfvfCLLkFR
nMxjrBgSnerUhkMyNQgcEsh6Qt4tFWdXKvZu7J2p5KgfnqAaXl25qlAMFPkCQAGF
d6X7Fq46vZsGDgItmvGbyIsLp0XK9HXwgSfd65YeYi4a5TZc+h62F9k/McU9W2tI
un9x814QuWesizMbA3cCQBRXmCJyL57l64hU1oIh+/zJktytjvhyZcHUG07KRuse
bhMQD7gBBfscaPvIh1Z/Jb1ZMyWMwDle0/L4+ZYUWZY=
-----END RSA PRIVATE KEY-----';

        $this->load->model('contacts_model');

        $this->load->model('invoices_model');

    }

    public function xero_add_contact($data, $user_id)
    {
    	
        $this->load->model('contacts_model');

        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result();
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id[0]->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);


        $contact = new \XeroPHP\Models\Accounting\Contact($xero);
        $contact->setName($data['first_name'] . ' ' . $data['last_name'])
            ->setLastName($data['last_name'])
            ->setFirstName($data['first_name'])
            ->setEmailAddress($data['email']);


  
                $xeroAddress = new \XeroPHP\Models\Accounting\Address($xero);

                $xeroAddress->setAddressType('POBOX');
                $xeroAddress->setAddressLine1($data['address_line1']);
                $xeroAddress->setAddressLine2($data['address_line2']);
                $xeroAddress->setAddressLine3($data['address_line3']);
                $xeroAddress->setAddressLine4($data['address_line4']);
                $xeroAddress->setCity($data['city']);
                $xeroAddress->setPostalCode($data['postal_code']);

                $add_address = $contact->addAddress($xeroAddress);

       

        $contact_add = $contact->save();

        $cid = $contact->ContactID;

        return $cid;

    }

    public function addCompanyXero($data, $user_id)
    {
        $this->load->model('companies_model');

        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result();
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id[0]->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $contactXero = new \XeroPHP\Models\Accounting\Contact($xero);

        $contactXero->setName($data['company_name']);
        $contactXero->setWebsite($data['website']);

        $addresses = $data['locations'];
        $phones    = $data['locations'];

        if (!empty($addresses)) {
            foreach ($addresses as $address) {

                $xeroAddress = new \XeroPHP\Models\Accounting\Address($xero);

                $xeroAddress->setAddressType($address['address']['address_type']);
                $xeroAddress->setAddressLine1($address['address']['address_line1']);
                $xeroAddress->setAddressLine2($address['address']['address_line2']);
                $xeroAddress->setAddressLine3($address['address']['address_line3']);
                $xeroAddress->setAddressLine4($address['address']['address_line4']);
                $xeroAddress->setCity($address['address']['city']);
                $xeroAddress->setPostalCode($address['address']['postal_code']);
                $xeroAddress->setRegion($address['address']['county']);
                $xeroAddress->setCountry($address['address']['country']);

                $add_address = $contactXero->addAddress($xeroAddress);

            }
        }

        if (!empty($phones)) {
            foreach ($phones as $phone) {
                $xeroPhone = new \XeroPHP\Models\Accounting\Phone($xero);

                $xeroPhone->setPhoneType($phone['phone']['phone_type']);
                $xeroPhone->setPhoneNumber($phone['phone']['phone_number']);
                $xeroPhone->setPhoneAreaCode($phone['phone']['phone_area_code']);
                $xeroPhone->setPhoneCountryCode($phone['phone']['phone_country_code']);

                $contactXero->addPhone($xeroPhone);

            }
        }
        $contactXero->save();

        $cid = $contactXero->ContactID;

        return $cid;

    }

    public function xero_import($contacts, $products, $invoices, $payments, $user_id, $account_id)
    {

        ignore_user_abort(true);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');

        foreach ($contacts as $contact) {
            $company = '';
            $c       = '';

            if (!empty($contact['company'])) {

                $last_row           = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('companies')->row();
                $company            = $contact['company'];
                $company['id']      = $last_row->id + 1;
                $company['user_id'] = $user_id;
                $this->db->insert('companies', $company);

            }

            if (!empty($contact['contact'])) {

                $last_row     = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('contacts')->row();
                $c            = $contact['contact'];
                $c['id']      = $last_row->id + 1;
                $c['user_id'] = $user_id;
                $this->db->insert('contacts', $c);

            }

            if ((!empty($company['id'])) && (!empty($c['id']))) {
                $match = array('companies_id' => $company['id'], 'contacts_id' => $c['id']);
                $this->db->insert('contacts_companies', $match);
            }

            if (!empty($contact['address'])) {

                foreach ($contact['address'] as $address) {
                    $last_row = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('addresses')->row();
                    $a        = '';
                    $a        = $address;
                    $a['id']  = $last_row->id + 1;
                    if (!empty($c['id'])) {
                        $a['contact_id'] = $c['id'];
                    }
                    if (!empty($company['id'])) {
                        $a['company_id'] = $company['id'];
                    }

                    $this->db->insert('addresses', $a);

                }

            }

            if (!empty($contact['phone'])) {

                foreach ($contact['phone'] as $phone) {
                    $last_row = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('phones')->row();
                    $p        = '';
                    $p        = $phone;
                    $p['id']  = $last_row->id + 1;
                    if (!empty($c['id'])) {
                        $p['contact_id'] = $c['id'];
                    }
                    if (!empty($company['id'])) {
                        $p['company_id'] = $company['id'];
                    }

                    $this->db->insert('phones', $p);

                }

            }

        }

        foreach ($products as $product) {

            $last_row         = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('products')->row();
            $pr               = '';
            $pr               = $product;
            $pr['id']         = $last_row->id + 1;
            $pr['account_id'] = $account_id;
            $this->db->insert('products', $pr);

        }

        foreach ($invoices as $invoice) {

            if (!empty($invoice['invoice'])) {

                $in = '';

                if (!empty($invoice['invoice']['date'])) {
                    $invoice['invoice']['date'] = $invoice['invoice']['date']->format('Y-m-d-H-i-s');
                }
                if (!empty($invoice['invoice']['due_date'])) {
                    $invoice['invoice']['due_date'] = $invoice['invoice']['due_date']->format('Y-m-d-H-i-s');
                }
                if (!empty($invoice['invoice']['fully_paid_on_date'])) {
                    $invoice['invoice']['fully_paid_on_date'] = $invoice['invoice']['fully_paid_on_date']->format('Y-m-d-H-i-s');
                }
                if (!empty($invoice['invoice']['expected_payment_date'])) {
                    $invoice['invoice']['expected_payment_date'] = $invoice['invoice']['expected_payment_date']->format('Y-m-d-H-i-s');
                }

                $last_row = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('invoices')->row();

                $in               = $invoice['invoice'];
                $in['id']         = $last_row->id + 1;
                $in['account_id'] = $account_id;

                $this->db->insert('invoices', $in);

                if (!empty($invoice['lineitem'])) {

                    foreach ($invoice['lineitem'] as $line_item) {

                        $li               = '';
                        $last_row         = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('invoices_lines')->row();
                        $li               = $line_item;
                        $li['id']         = $last_row->id + 1;
                        $li['invoice_id'] = $in['id'];

                        if (empty($li['price_unit'])) {
                            $li['price_unit'] = 0;
                        }

                        $this->db->insert('invoices_lines', $li);

                    }

                }

            }

        }

        foreach ($payments as $payment) {
            foreach ($payment as $payment_single_u) {
                foreach ($payment_single_u as $payment_single) {

                    $pp = '';

                    $last_row = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('payments')->row();

                    if (!empty($payment_single['date'])) {
                        $payment_single['date'] = $payment_single['date']->format('Y-m-d-H-i-s');
                    }

                    $query  = $this->db->query("SELECT * from invoices WHERE xero_id = '" . $payment_single['invoice_xero'] . "'");
                    $result = $query->result();
                    unset($payment_single['invoice_xero']);
                    $pp               = $payment_single;
                    $pp['id']         = $last_row->id + 1;
                    $pp['invoice_id'] = $result[0]->id;
                    $result           = '';

                    $this->db->insert('payments', $pp);

                }

            }
        }

    }

    public function getAPI_all($account_id)
    {
        $query  = $this->db->query("SELECT * from accounts WHERE account_id = " . $account_id);
        $result = $query->result();

        return $result;
    }

    public function store_xero($account_id, $keys)
    {

        $query = $this->db->query("UPDATE accounts
        SET xero = '" . $keys . "' WHERE account_id = '" . $account_id . "'");

    }

    public function store_gocardless($account_id, $keys)
    {

        $query = $this->db->query("UPDATE accounts
        SET gocardless = '" . $keys . "' WHERE account_id = '" . $account_id . "'");

    }

    public function store_stripe($account_id, $keys)
    {

        $query = $this->db->query("UPDATE accounts
        SET stripe = '" . $keys . "' WHERE account_id = '" . $account_id . "'");

    }

    public function store_twilio($account_id, $keys)
    {
        $qquery = $this->db->query("UPDATE accounts
				SET twilio ='" . $keys . "' WHERE account_id ='" . $account_id . "'");
    }

    public function complete_setup($account_id)
    {

        $query = $this->db->query("UPDATE accounts
        SET setup = '1' WHERE account_id = '" . $account_id . "'");

    }

    //////////
    // XERO //
    //////////

    public function auth_xero($key, $secret)
    {

        $config = [
            'oauth' => [
                'callback'        => 'http://localhost/',
                'consumer_key'    => $key,
                'consumer_secret' => $secret,
                'rsa_private_key' => $this->xero_API->private,
            ],
            'curl'  => [
                CURLOPT_CAINFO => $this->xero_API->cabundle,
            ],
        ];
        $auth = new \XeroPHP\Application\PrivateApplication($config);

        return $auth;

    }

    public function get_contact_xero()
    {
        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result();
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id[0]->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $temp_contacts = $xero->load('Accounting\\Contact')->execute();
        $temp_invoices = $xero->load('Accounting\\Invoice')->where('Type', \XeroPHP\Models\Accounting\Invoice::INVOICE_TYPE_ACCREC)->execute();
        $invoices      = array();
        $contacts      = array();
        foreach ($temp_contacts as $temp_contact) {
            $contact   = array();
            $contact[] = $temp_contact;
            foreach ($temp_invoices as $invoice) {
                if ($invoice['Contact']['ContactID'] == $temp_contact['ContactID']) {
                    $contact['Invoices'][] = $invoice;
                }
            }
            if (!empty($contact['Invoices'])) {
                $contacts[] = $contact;
            }
        }
        foreach ($contacts as $contact) {
            var_dump($contact);
        }
    }

    public function getXeroContactById()
    {
        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result();
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id[0]->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $contact[] = $xero->loadByGUID('Accounting\\Contact', 'af0091a9-82ef-4cac-9fd6-22c095ac6a58');
        $invoices  = $xero->load('Accounting\\Invoice')->where('Type', \XeroPHP\Models\Accounting\Invoice::INVOICE_TYPE_ACCREC)->execute();

        foreach ($invoices as $invoice) {
            if ($invoice['Contact']['ContactID'] == $contact[0]['ContactID']) {
                $contact['Invoices'][] = $invoice;
            }
        }
        var_dump($contact);
        var_dump($contact[0]['Phones'][0]);

        var_dump($contact['Invoices'][0]['Payments'][0]);
    }

    public function getPhoneFormatFromXero($datas)
    {
        $phones = array();
        foreach ($datas as $data) {
            $phone['phone_type']         = $data->PhoneType;
            $phone['phone_number']       = $data->PhoneCountryCode;
            $phone['phone_area_code']    = $data->PhoneAreaCode;
            $phone['phone_country_code'] = $data->PhoneNumber;

            $phones[] = $phone;
        }
        return $phones;
    }

    public function getAddressFormatFromXero($datas)
    {
        $addresses = array();
        foreach ($datas as $data) {
            $address['address_type']  = $data->AddressType;
            $address['address_line1'] = $data->AddressLine1;
            $address['address_line2'] = $data->AddressLine2;
            $address['address_line3'] = $data->AddressLine3;
            $address['address_line4'] = $data->AddressLine4;
            $address['city']          = $data->City;
            $address['postal_code']   = $data->PostalCode;
            $address['county']        = $data->Region;
            $address['country']       = $data->Country;

            $addresses[] = $address;
        }
        return $addresses;
    }

    public function getContactFormatFromXero($datas)
    {
        $contact = array();

        $addresses            = $this->getAddressFormatFromXero($datas['Addresses']);
        $contact['addresses'] = $addresses;
        $phones               = $this->getPhoneFormatFromXero($datas['Phones']);
        $contact['phones']    = $phones;

        $contact['xero_id']    = $datas->ContactID;
        $contact['first_name'] = $datas->FirstName;
        $contact['last_name']  = $datas->LastName;
        $contact['email']      = $datas->EmailAddress;
        $contact['website']    = $datas->Website;

        return $contact;
    }

    public function getCompanyFormatFromXero($datas)
    {
        $company = array();
        if (empty($datas->FirstName)) {
            $addresses = $this->getAddressFormatFromXero($datas['Addresses']);
            $phones    = $this->getPhoneFormatFromXero($datas['Phones']);
            $count     = 0;
            $locations = array();
            if (sizeOf($addresses) > sizeOf($phones)) {
                foreach ($phones as $phone) {
                    $locations[$count]['phone']   = $phone;
                    $locations[$count]['address'] = $addresses[$count];
                    unset($addresses[$count]);
                    $count++;
                }
                foreach ($addresses as $address) {
                    $locations[$count]['address'] = $address;
                    $locations[$count]['phone']   = array();
                    $count++;
                }
            } else {
                foreach ($addresses as $address) {
                    $locations[$count]['address'] = $address;
                    $locations[$count]['phone']   = $phones[$count];
                    unset($phones[$count]);
                    $count++;
                }
                foreach ($phones as $phone) {
                    $locations[$count]['phone']   = $phone;
                    $locations[$count]['address'] = array();
                    $count++;
                }
            }
            $company['locations'] = $locations;
        }
        $company['xero_id']      = $datas->ContactID;
        $company['company_name'] = $datas->Name;
        $company['website']      = $datas->Website;

        return $company;
    }

    public function updateXeroInvoices()
    {

        set_time_limit(0);
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');

        $account_id = $this->ion_auth->account_id_find($this->ion_auth->get_user_id());

        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result();
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id[0]->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $invoices = $xero->load('Accounting\\Invoice')->execute();

        $count = 0;
        foreach ($invoices as $invoice) {
            $count++;

            $ind_invoice = '';

            $checkinvoice = $this->db->query("SELECT * FROM invoices WHERE xero_id = '" . $invoice['InvoiceID'] . "'")->result();

            if (empty($checkinvoice)) {

                $ind_invoice = $xero->loadByGUID('Accounting\\Invoice', $invoice['InvoiceID']);

                $upload_invoices[$count]['invoice'] = array(
                    'xero_id'               => $invoice['InvoiceID'],
                    'xero_contact_id'       => $invoice['Contact']['ContactID'],
                    'date'                  => $invoice['Date'],
                    'due_date'              => $invoice['DueDate'],
                    'status'                => $invoice['Status'],
                    'subtotal'              => $invoice['SubTotal'],
                    'total_tax'             => $invoice['TotalTax'],
                    'total'                 => $invoice['Total'],
                    'total_discount'        => $invoice['TotalDiscount'],
                    'expected_payment_date' => $invoice['ExpectedPaymentDate'],
                    'amount_paid'           => $invoice['AmountPaid'],
                    'fully_paid_on_date'    => $invoice['FullyPaidOnDate'],
                );

                foreach ($ind_invoice['LineItems'] as $line_item) {

                    $upload_invoices[$count]['lineitem'][] = array(
                        'xero_id'           => $line_item['LineItemID'],
                        'code'              => $line_item['ItemCode'],
                        'name'              => '',
                        'sales_description' => $line_item['Description'],
                        'price_unit'        => $line_item['UnitAmount'],
                        'account_code'      => $line_item['AccountCode'],
                        'quantity'          => $line_item['Quantity'],
                    );

                }

            }
        }

        foreach ($upload_invoices as $invoice) {

            if (!empty($invoice['invoice'])) {

                $in = '';

                if (!empty($invoice['invoice']['date'])) {
                    $invoice['invoice']['date'] = $invoice['invoice']['date']->format('Y-m-d-H-i-s');
                }
                if (!empty($invoice['invoice']['due_date'])) {
                    $invoice['invoice']['due_date'] = $invoice['invoice']['due_date']->format('Y-m-d-H-i-s');
                }
                if (!empty($invoice['invoice']['fully_paid_on_date'])) {
                    $invoice['invoice']['fully_paid_on_date'] = $invoice['invoice']['fully_paid_on_date']->format('Y-m-d-H-i-s');
                }
                if (!empty($invoice['invoice']['expected_payment_date'])) {
                    $invoice['invoice']['expected_payment_date'] = $invoice['invoice']['expected_payment_date']->format('Y-m-d-H-i-s');
                }

                $last_row = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('invoices')->row();

                $in               = $invoice['invoice'];
                $in['id']         = $last_row->id + 1;
                $in['account_id'] = $account_id[0]->account_id;

                $this->db->insert('invoices', $in);

                if (!empty($invoice['lineitem'])) {

                    foreach ($invoice['lineitem'] as $line_item) {

                        $li               = '';
                        $last_row         = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('invoices_lines')->row();
                        $li               = $line_item;
                        $li['id']         = $last_row->id + 1;
                        $li['invoice_id'] = $in['id'];

                        if ($li['quantity'] == '') {
                            $li['quantity'] = 1;
                        }

                        if (empty($li['price_unit'])) {
                            $li['price_unit'] = 0;
                        }

                        $this->db->insert('invoices_lines', $li);

                    }

                }

            }

        }

    }

    public function checkXeroProduct($id)
    {

        $this->load->model('products_model');

        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result();
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id[0]->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $pro = $this->products_model->getProduct($id);

        $xero_pro = $xero->loadByGUID('Accounting\\Item', $pro->xero_id);

        $query = $this->db->query("UPDATE products SET
        code = '" . $xero_pro->Code . "',
         name = '" . $xero_pro->Name . "',
          sales_description = '" . $xero_pro->Name . "',
            isSold = '" . $xero_pro->IsSold . "',
              price_unit = '" . $xero_pro->SalesDetails->UnitPrice . "',
                account_code = '" . $xero_pro->SalesDetails->AccountCode . "'
         WHERE id = '" . $id . "'");

    }

    public function saveContactXero($id)
    {
        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result();
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id[0]->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $contact      = array();
        $xero_contact = $xero->loadByGUID('Accounting\\Contact', $id);

        if (empty($xero_contact->FirstName)) {
            $company = $this->getCompanyFormatFromXero($xero_contact);
            $this->load->model('companies_model');
            if ($this->companies_model->addCompany($company, $user->id)) {
                $company = true;
            } else { $company = false;}
        } else { $company = true;}

        if (!empty($xero_contact->FirstName)) {
            $contact = $this->getContactFormatFromXero($xero_contact);
            $this->load->model('contacts_model');
            $contact = $this->contacts_model->addContact($contact, $user->id);
        } else { $contact = true;}

        if ($company && $contact && ($contact != false)) {
        } else {throw Exception;}

        redirect('Contacts', 'refresh');
    }

    public function checkXeroInvoice($id)
    {

        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result();
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id[0]->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $invoice = $this->invoices_model->getInvoice($id);

        $ind_invoice = $xero->loadByGUID('Accounting\\Invoice', $invoice->xero_id);
        $invoice     = $ind_invoice;

        $upload_invoices['invoice'] = array(
            'xero_id'               => $invoice['InvoiceID'],
            'xero_contact_id'       => $invoice['Contact']['ContactID'],
            'date'                  => $invoice['Date'],
            'due_date'              => $invoice['DueDate'],
            'status'                => $invoice['Status'],
            'subtotal'              => $invoice['SubTotal'],
            'total_tax'             => $invoice['TotalTax'],
            'total'                 => $invoice['Total'],
            'total_discount'        => $invoice['TotalDiscount'],
            'expected_payment_date' => $invoice['ExpectedPaymentDate'],
            'amount_paid'           => $invoice['AmountPaid'],
            'fully_paid_on_date'    => $invoice['FullyPaidOnDate'],
        );

        foreach ($ind_invoice['LineItems'] as $line_item) {

            $upload_invoices['lineitem'][] = array(
                'xero_id'           => $line_item['LineItemID'],
                'code'              => $line_item['ItemCode'],
                'name'              => '',
                'sales_description' => $line_item['Description'],
                'price_unit'        => $line_item['UnitAmount'],
                'account_code'      => $line_item['AccountCode'],
                'quantity'          => $line_item['Quantity'],
            );

        }

        if (!empty($invoice['Date'])) {
            $invoice['Date'] = $invoice['Date']->format('Y-m-d-H-i-s');
        }
        if (!empty($invoice['DueDate'])) {
            $invoice['DueDate'] = $invoice['DueDate']->format('Y-m-d-H-i-s');
        }
        if (!empty($invoice['FullyPaidOnDate'])) {
            $invoice['FullyPaidOnDate'] = $invoice['FullyPaidOnDate']->format('Y-m-d-H-i-s');
        }
        if (!empty($invoice['ExpectedPaymentDate'])) {
            $invoice['ExpectedPaymentDate'] = $invoice['ExpectedPaymentDate']->format('Y-m-d-H-i-s');
        }

        $query = $this->db->query("UPDATE invoices SET
        xero_id = '" . $invoice['InvoiceID'] . "',
      xero_contact_id  = '" . $invoice['Contact']['ContactID'] . "',
      date  = '" . $invoice['Date'] . "',
      due_date = '" . $invoice['DueDate'] . "',
      status = '" . $invoice['Status'] . "',
      subtotal  = '" . $invoice['SubTotal'] . "',
      total_tax  = '" . $invoice['TotalTax'] . "',
      total  = '" . $invoice['Total'] . "',
      total_discount  = '" . $invoice['TotalDiscount'] . "',
      expected_payment_date  = '" . $invoice['ExpectedPaymentDate'] . "',
      amount_paid  = '" . $invoice['AmountPaid'] . "',
      fully_paid_on_date  = '" . $invoice['FullyPaidOnDate'] . "'
       WHERE id = '" . $id . "'");

    }

    public function checkXeroContact($contact_id)
    {

        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result();
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id[0]->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $contact = $this->contacts_model->getContact($contact_id);

        $contact_single = $xero->loadByGUID('Accounting\\Contact', $contact->xero_id);

        $count = 0;

        $count++;

        //Firstname and Name not empty (Contact and Company)
        if ((!empty($contact_single->FirstName)) && (!empty($contact_single->Name))) {
            $upload[$count]['contact'] = array(
                'first_name' => $contact_single['FirstName'],
                'last_name'  => $contact_single['LastName'],
                'email'      => $contact_single['EmailAddress'],
                'xero_id'    => $contact_single['ContactId'],
            );

        }

        //Firstname not empty (Contact)
        if ((!empty($contact_single->FirstName)) && (empty($contact_single->Name))) {
            $upload[$count]['contact'] = array(
                'first_name' => $contact_single['FirstName'],
                'last_name'  => $contact_single['LastName'],
                'email'      => $contact_single['EmailAddress'],
                'xero_id'    => $contact_single['ContactId'],
            );
        }

        if ((!empty($upload[$count]['company'])) || (!empty($upload[$count]['contact']))) {

            //Addresses
            if (!empty($contact_single->Addresses[0])) {
                foreach ($contact_single->Addresses as $address) {
                    if (!empty($address['AddressLine1'])) {
                        $upload[$count]['address'][] = array(
                            'address_type'  => $address['AddressType'],
                            'address_line1' => $address['AddressLine1'],
                            'address_line2' => $address['AddressLine2'],
                            'city'          => $address['City'],
                            'county'        => $address['Region'],
                            'postal_code'   => $address['PostalCode'],
                            'country'       => $address['Country'],
                        );
                    }
                }
            }

            //Phones
            if (!empty($contact_single->Phones[0])) {
                foreach ($contact_single->Phones as $phones) {

                    if (!empty($phones['PhoneNumber'])) {
                        $upload[$count]['phone'][] = array(
                            'phone_type'      => $phones['PhoneType'],
                            'phone_number'    => $phones['PhoneNumber'],
                            'phone_area_code' => $phones['PhoneAreaCode'],
                        );
                    }
                }
            }

        }

        $query = $this->db->query("UPDATE contacts SET
        first_name = '" . $upload[1]['contact']['first_name'] . "',
        last_name = '" . $upload[1]['contact']['last_name'] . "',
        email = '" . $upload[1]['contact']['email'] . "' WHERE id = '" . $contact_id . "'");

        foreach ($upload[1]['address'] as $address_search) {

            $query = $this->db->query("UPDATE addresses SET
        address_line1 = '" . $address_search['address_line1'] . "',
         address_line2 = '" . $address_search['address_line2'] . "',
          address_line3 = '" . $address_search['address_line3'] . "',
           address_line4 = '" . $address_search['address_line4 '] . "',
            city = '" . $address_search['city'] . "',
             postal_code = '" . $address_search['postal_code'] . "',
              country = '" . $address_search['country'] . "',
               county = '" . $address_search['county'] . "'

         WHERE address_type = '" . $address_search['address_type'] . "' AND contact_id = '" . $contact_id . "'");

        }

        foreach ($upload[1]['phone'] as $phones_search) {

            $query = $this->db->query("UPDATE phones SET
        phone_number = '" . $phones_search['phone_number'] . "',
         phone_area_code = '" . $phones_search['phone_area_code'] . "',
          phone_country_code = '" . $phones_search['phone_country_code'] . "'
         WHERE phone_type = '" . $phones_search['phone_type'] . "' AND contact_id = '" . $contact_id . "'");

        }

    }

    public function checkXeroCompany($contact_id)
    {

        $this->load->model('contacts_model');

        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result();
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id[0]->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $contact = $this->companies_model->getCompany($contact_id);

        $contact_single = $xero->loadByGUID('Accounting\\Contact', $contact->xero_id);

        $count = 0;

        $count++;

        //Firstname and Name not empty (Contact and Company)
        if ((!empty($contact_single->FirstName)) && (!empty($contact_single->Name))) {
            $upload[$count]['company'] = array(
                'company_name' => $contact_single['Name'],
                'xero_id'      => $contact_single['ContactId'],
            );

        }

        if ((empty($contact_single->FirstName)) && (!empty($contact_single->Name))) {
            $upload[$count]['company'] = array(
                'company_name' => $contact_single['Name'],
                'xero_id'      => $contact_single['ContactId'],
            );
        }

        if ((!empty($upload[$count]['company'])) || (!empty($upload[$count]['contact']))) {

            //Addresses
            if (!empty($contact_single->Addresses[0])) {
                foreach ($contact_single->Addresses as $address) {
                    if (!empty($address['AddressLine1'])) {
                        $upload[$count]['address'][] = array(
                            'address_type'  => $address['AddressType'],
                            'address_line1' => $address['AddressLine1'],
                            'address_line2' => $address['AddressLine2'],
                            'city'          => $address['City'],
                            'county'        => $address['Region'],
                            'postal_code'   => $address['PostalCode'],
                            'country'       => $address['Country'],
                        );
                    }
                }
            }

            //Phones
            if (!empty($contact_single->Phones[0]['PhoneNumber'])) {
                foreach ($contact_single->Phones as $phones) {
                    if (!empty($phones['PhoneNumber'])) {
                        $upload[$count]['phone'][] = array(
                            'phone_type'      => $phones['PhoneType'],
                            'phone_number'    => $phones['PhoneNumber'],
                            'phone_area_code' => $phones['PhoneAreaCode'],
                        );
                    }
                }
            }

        }

        //print_R($upload);

        $companies = $this->db->query("SELECT * FROM companies WHERE id = '" . $contact_id . "' OR parent_company_id = '" . $contact_id . "'");
        $companies = $companies->result_array();

        foreach ($companies as $companies_single) {

            $c_address = $this->db->query("SELECT * FROM addresses WHERE company_id = '" . $companies_single['id'] . "'");
            $c_address = $c_address->result_array();

            foreach ($upload[1]['address'] as $check_address) {

                if ($check_address['address_type'] == $c_address[0]['address_type']) {
                    $query = $this->db->query("UPDATE addresses SET
        address_line1 = '" . $check_address['address_line1'] . "',
         address_line2 = '" . $check_address['address_line2'] . "',
          address_line3 = '" . $check_address['address_line3'] . "',
           address_line4 = '" . $check_address['address_line4 '] . "',
            city = '" . $check_address['city'] . "',
             postal_code = '" . $check_address['postal_code'] . "',
              country = '" . $check_address['country'] . "',
               county = '" . $check_address['county'] . "'

         WHERE  id = '" . $c_address[0]['id'] . "'");

                }

            }

            $c_phone = $this->db->query("SELECT * FROM phones WHERE company_id = '" . $companies_single['id'] . "'");
            $c_phone = $c_phone->result_array();

            foreach ($upload[1]['phone'] as $check_phone) {

                if ($check_phone['phone_type'] == $c_phone[0]['phone_type']) {
                    $query = $this->db->query("UPDATE phones SET phone_number = '" . $check_phone['phone_number'] . "',
         phone_area_code = '" . $check_phone['phone_area_code'] . "',
          phone_country_code = '" . $check_phone['phone_country_code'] . "'
         WHERE id = '" . $c_phone[0]['id'] . "'");

                }

            }

        }

    }

    // Assuming the contact is already in the Xero's database, if not, use the createContactXero function.
    public function updateContactXero($contact_id)
    {
        $this->load->model('contacts_model');

        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result();
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id[0]->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $contact = $this->contacts_model->getContact($contact_id);
        if (!empty($contact->xero_id)) {
            $contactXero = $xero->loadByGUID('Accounting\\Contact', $contact->xero_id);
        } else {
            $contactXero = new \XeroPHP\Models\Accounting\Contact($xero);
        }

        $contactXero->setName($contact->first_name . " " . $contact->last_name . "");
        $contactXero->setFirstName($contact->first_name);
        $contactXero->setLastName($contact->last_name);
        $contactXero->setEmailAddress($contact->email);
        $contactXero->setWebsite($contact->website);

        $addresses = $this->contacts_model->getAllAddresses($contact->id);
        $phones    = $this->contacts_model->getAllPhones($contact->id);

        if (!empty($addresses)) {
            foreach ($addresses as $address) {
                $xeroAddress = new \XeroPHP\Models\Accounting\Address($xero);

                $xeroAddress->setAddressType('POBOX');
                $xeroAddress->setAddressLine1($address->address_line1);
                $xeroAddress->setAddressLine2($address->address_line2);
                $xeroAddress->setAddressLine3($address->address_line3);
                $xeroAddress->setAddressLine4($address->address_line4);
                $xeroAddress->setCity($address->city);
                $xeroAddress->setPostalCode($address->postal_code);
                $xeroAddress->setRegion($address->county);
                $xeroAddress->setCountry($address->country);

                $contactXero->addAddress($xeroAddress);
            }
        }

        if (!empty($phones)) {
            foreach ($phones as $phone) {
                $xeroPhone = new \XeroPHP\Models\Accounting\Phone($xero);

                $xeroPhone->setPhoneType('MOBILE');
                $xeroPhone->setPhoneNumber($phone->phone_number);
                $xeroPhone->setPhoneAreaCode($phone->phone_area_code);
                $xeroPhone->setPhoneCountryCode($phone->phone_country_code);

                $contactXero->addPhone($xeroPhone);
            }
        }

        /*$contactToAdd = new \XeroPHP\Models\Accounting\Contact\ContactPerson($xero);
        $contactToAdd->setFirstName($contact->first_name);
        $contactToAdd->setLastName($contact->last_name);
        $contactToAdd->setEmailAddress($contact->email);
        $contactXero->addContactPerson($contactToAdd);*/

        //echo '<pre>';
        //print_R($contactXero);

        $contactXero->save();
    }

    public function updateCompanyXero($company_id)
    {
        $this->load->model('companies_model');

        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result();
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id[0]->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $company = $this->companies_model->getCompany($company_id);

        if (!empty($company->xero_id)) {
            $contactXero = $xero->loadByGUID('Accounting\\Contact', $company->xero_id);
        } else {
            $contactXero = new \XeroPHP\Models\Accounting\Contact($xero);
        }

        $contactXero->setName($company->company_name);
        $contactXero->setWebsite($company->website);

        $locations = $this->companies_model->getAllLocations($company->id);
        if (!empty($locations)) {
            foreach ($locations as $location) {
                $address     = $location['address'];
                $xeroAddress = new \XeroPHP\Models\Accounting\Address($xero);

                $xeroAddress->setAddressType($address->address_type);
                $xeroAddress->setAddressLine1($address->address_line1);
                $xeroAddress->setAddressLine2($address->address_line2);
                $xeroAddress->setAddressLine3($address->address_line3);
                $xeroAddress->setAddressLine4($address->address_line4);
                $xeroAddress->setCity($address->city);
                $xeroAddress->setPostalCode($address->postal_code);
                $xeroAddress->setRegion($address->county);
                $xeroAddress->setCountry($address->country);

                $contactXero->addAddress($xeroAddress);

                $phone     = $location['phone'];
                $xeroPhone = new \XeroPHP\Models\Accounting\Phone($xero);

                $xeroPhone->setPhoneType($phone->phone_type);
                $xeroPhone->setPhoneNumber($phone->phone_number);
                $xeroPhone->setPhoneAreaCode($phone->phone_area_code);
                $xeroPhone->setPhoneCountryCode($phone->phone_country_code);

                $contactXero->addPhone($xeroPhone);
            }
        }

        $contactXero->save();
    }

    public function getProductFormatFromXero($productXero, $account_id)
    {
        $product = array();

        $product['account_id']        = $account_id;
        $product['xero_id']           = $productXero->ItemID;
        $product['name']              = $productXero->Name;
        $product['sales_description'] = $productXero->Description;
        $product['isSold']            = $productXero->IsSold;
        $product['code']              = $productXero->Code;
        if (isset($productXero['SalesDetails']->UnitPrice)) {
            $product['price_unit'] = $productXero['SalesDetails']->UnitPrice;
        }
        if (isset($productXero['SalesDetails']->AccountCode)) {
            $product['account_code'] = $productXero['SalesDetails']->AccountCode;
        }
        return $product;
    }

    public function saveProductXero($id)
    {
        $this->load->model('products_model');

        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result()[0];
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $productXero = $xero->loadByGUID('Accounting\\Item', $id);
        var_dump($productXero);

        $product = $this->getProductFormatFromXero($productXero, $account_id->account_id);

        $product = $this->products_model->addProduct($product, $user->id);

        $this->updateProductXero($product->id);
        return $product;
    }

    public function updateProductXero($product_id)
    {
        $this->load->model('products_model');

        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result();
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id[0]->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $product = $this->products_model->getProduct($product_id);

        if ($product->xero_id != null) {
            $productXero = $xero->loadByGUID('Accounting\\Item', $product->xero_id);
        } else {
            $productXero = new \XeroPHP\Models\Accounting\Item($xero);
        }

        $productXero->setIsTrackedAsInventory(false);
        $productXero->setInventoryAssetAccountCode(new stdClass());

        $productXero->setCode($product->code);
        $productXero->setName($product->name);
        $productXero->setDescription($product->sales_description);
        $productXero->setIsSold($product->isSold);

        $salesDetailsXero = new \XeroPHP\Models\Accounting\Item\Sale($xero);
        $salesDetailsXero->setUnitPrice((float) $product->price_unit);
        $salesDetailsXero->setAccountCode($product->account_code);
        $productXero->addSalesDetail($salesDetailsXero);

        $productXero->save()->getElements();
        if ($product->xero_id == null) {
            $datas     = $this->getProductFormatFromXero($productXero, $account->account_id);
            $proposals = $this->products_model->getAllProposals($product->id);
            if (empty($proposals)) {
                $proposals = array();
            }
            foreach ($proposals as $proposal) {
                $datas['proposals'][] = $proposal->id;
            }
            $this->products_model->editProduct($product->id, $datas);
        }
    }

    public function getInvoiceFormatFromXero($datas, $proposalId)
    {
        $invoice = array();

        $invoice['proposal_id']           = $proposalId;
        $invoice['xero_id']               = $datas->InvoiceId;
        $invoice['date']                  = $datas->Date->format("Y/m/d");
        $invoice['due_date']              = $datas->DueDate->format("Y/m/d");
        $invoice['status']                = $datas->Status;
        $invoice['subtotal']              = $datas->SubTotal;
        $invoice['total_tax']             = $datas->TotalTax;
        $invoice['total']                 = $datas->Total;
        $invoice['total_discount']        = $datas->TotalDiscount;
        $invoice['expected_payment_date'] = $datas->ExpectedPaymentDate;
        $invoice['amount_paid']           = $datas->AmountPaid;
        $invoice['fully_paid_on_date']    = $datas->FullyPaidOnDate;

        return $invoice;
    }

    public function getInvoiceLineFormatFromXero($lineItem)
    {
        $invoiceLine                      = array();
        $invoiceLine['code']              = $lineItem['ItemCode'];
        $invoiceLine['sales_description'] = $lineItem['Description'];
        $invoiceLine['price_unit']        = $lineItem['UnitAmount'];
        $invoiceLine['quantity']          = $lineItem['Quantity'];
        $invoiceLine['account_code']      = $lineItem['AccountCode'];
        $invoiceLine['isSold']            = true;
        $invoiceLine['xero_id']           = $lineItem['LineItemID'];

        return $invoiceLine;
    }

    public function saveInvoiceXero($id, $proposalId = 0)
    {
        $this->load->model('invoices_model');

        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result()[0];
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $invoiceXero = $xero->loadByGUID('Accounting\\Invoice', $id);

        $invoice = $this->getInvoiceFormatFromXero($invoiceXero, $proposalId);

        $invoice = $this->invoices_model->addInvoice($invoice);

        $lineItems = $invoiceXero->getLineItems();

        $flag = true;
        if ($invoiceXero['Payments'] != null) {
            foreach ($invoiceXero['Payments'] as $payment) {
                if (!$this->savePaymentXero($payment->PaymentId, $invoice->id)) {
                    $flag = false;
                    break;
                }
            }
        }
        if ($flag) {
            $flag = true;
            if ($lineItems) {
                foreach ($lineItems as $lineItem) {
                    $invoiceLine               = $this->getInvoiceLineFormatFromXero($lineItem);
                    $invoiceLine['invoice_id'] = $invoice->id;
                    if (!$this->invoices_model->addInvoiceLine($invoice->id, $invoiceLine)) {
                        $flag = false;
                        break;
                    }
                }
            }
            if ($flag) {
                return $invoice;
            } else {return $flag;}
        } else {return false;}
    }

    public function updateInvoiceXero($invoice_id)
    {
        $this->load->model('invoices_model');
        $this->load->model('proposals_model');
        $this->load->model('opportunities_model');
        $this->load->model('products_model');

        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result();
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id[0]->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $invoice         = $this->invoices_model->getInvoice($invoice_id);
        $proposal        = $this->proposals_model->getProposal($invoice->proposal_id);
        $products        = $this->invoices_model->getAllInvoicesLines($invoice->id);
        $billing_contact = $xero->loadByGUID('Accounting\\Contact', $this->opportunities_model->getBillingContact($proposal->opportunity_id)->xero_id);

        if ($invoice->xero_id) {
            $invoiceXero = $xero->loadByGUID('Accounting\\Invoice', $invoice->xero_id);
            $invoiceXero->setInvoiceID($invoice->xero_id);
        } else {
            $invoiceXero = new \XeroPHP\Models\Accounting\Invoice($xero);
        }

        $invoiceXero->setType('ACCREC');
        $invoiceXero->setInvoiceNumber($invoice->id);
        $invoiceXero->setDate(date_create_from_format('Y-m-d', $invoice->date));
        $invoiceXero->setDueDate(date_create_from_format('Y-m-d', $invoice->due_date));
        $invoiceXero->setStatus($invoice->status);
        $invoiceXero->setExpectedPaymentDate($invoice->expected_payment_date);
        $invoiceXero->setContact($billing_contact);
        foreach ($products as $product) {
            var_dump($product);
            /*if(!empty($product->xero_id)){
            var_dump($product->xero_id);
            //$lineItem = new \XeroPHP\Models\Accounting\Invoice\LineItem($xero);
            $lineItem = $xero->loadByGUID('Accounting\\Invoice\\LineItem', $product->xero_id);
            $lineItem->setLineItemID($product->xero_id);
            }else{$lineItem = new \XeroPHP\Models\Accounting\Invoice\LineItem($xero);}
            $lineItem->setItemCode($product->code);
            $query = $this->db->query("SELECT quantity FROM proposals_has_products
            WHERE proposal_id = ".$proposal->id." AND product_id = ".$this->products_model->getProductByCode($product->code)->id);
            $lineItem->setQuantity($query->result()[0]->quantity);
            $lineItem->setDescription($product->sales_description);
            $lineItem->setLineAmount($product->price_unit * $query->result()[0]->quantity);

            $invoiceXero->addLineItem($lineItem);*/

            if (!empty($product->xero_id)) {
                var_dump($product->xero_id);

                foreach ($invoiceXero->LineItems as $key => $single_line_item) {
                    if ($single_line_item->LineItemID == $product->xero_id) {
                        var_dump("test");

                        $query = $this->db->query("SELECT quantity FROM proposals_has_products
												WHERE proposal_id = " . $proposal->id . " AND product_id = " . $this->products_model->getProductByCode($product->code)->id);

                        $invoiceXero->LineItems[$key]->Description = $product->sales_description;
                        $invoiceXero->LineItems[$key]->Quantity    = $query->result()[0]->quantity;
                        $invoiceXero->LineItems[$key]->LineAmount  = $product->price_unit * $query->result()[0]->quantity;
                        $invoiceXero->LineItems[$key]->ItemCode    = $product->code;
                    }
                }

                //$lineItem = $xero->loadByGUID('Accounting\\Invoice\\LineItem', $product->xero_id);
                //$lineItem->setDescription('Test');
            } else {
                $lineItem = new \XeroPHP\Models\Accounting\Invoice\LineItem($xero);
                //$lineItem = new \XeroPHP\Models\Accounting\Invoice\LineItem($xero);
                $lineItem->setItemCode($product->code);
                $query = $this->db->query("SELECT quantity FROM proposals_has_products
					WHERE proposal_id = " . $proposal->id . " AND product_id = " . $this->products_model->getProductByCode($product->code)->id);
                $lineItem->setQuantity($query->result()[0]->quantity);
                $lineItem->setDescription($product->sales_description);
                $lineItem->setLineAmount($product->price_unit * $query->result()[0]->quantity);

                $invoiceXero->addLineItem($lineItem);
            }
        }

        var_dump($invoiceXero->LineItems);
        $lineItems_temp = $invoiceXero->save($xero)->getElements()[0]['LineItems'];
        $lineItems      = array();

        if (!$invoice->xero_id) {
            foreach ($lineItems_temp as $lineItem) {
                $lineItems[] = $this->getInvoiceLineFormatFromXero($lineItem);
            }
            $datas                   = $this->getInvoiceFormatFromXero($invoiceXero, $proposal->id);
            $datas['invoices_lines'] = $lineItems;
            var_dump($datas);
            $this->invoices_model->editInvoice($invoice->id, $datas);
        }
    }

    public function getPaymentFormatFromXero($datas, $invoiceId)
    {
        $payment = array();

        $payment['invoice_id']  = $invoiceId;
        $payment['xero_id']     = $datas->PaymentId;
        $payment['amount']      = $datas->Amount;
        $payment['description'] = $datas->Reference;
        $payment['date']        = $datas->Date;

        return $payment;
    }

    public function savePaymentXero($id, $invoiceId)
    {
        $this->load->model('payments_model');

        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result()[0];
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $paymentXero = $xero->loadByGUID('Accounting\\Payment', $id);

        $payment = $this->getPaymentFormatFromXero($paymentXero, $invoiceId);

        return $payment = $this->payments_model->addPayment($payment);
    }

    public function updatePaymentXero($payment_id)
    {
        $this->load->model('payments_model');
        $this->load->model('invoices_model');

        $user       = $this->ion_auth->user()->row();
        $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = " . $user->id)->result();
        $account    = $this->db->query("SELECT * FROM accounts WHERE account_id = " . $account_id[0]->account_id)->result()[0];

        $xero = $this->auth_xero(unserialize($account->xero)['consumerkey'], unserialize($account->xero)['consumersecret']);

        $payment = $this->payments_model->getPayment($payment_id);

        if ($payment->xero_id != null) {
            $paymentXero = $xero->loadByGUID('Accounting\\Payment', $payment->xero_id);
        } else {
            $paymentXero = new \XeroPHP\Models\Accounting\Payment($xero);
        }

        $invoice = $xero->loadByGUID('Accounting\\Invoice', $this->invoices_model->getInvoice($payment->invoice_id)->xero_id);
        $paymentXero->setInvoice($invoice);
        $paymentXero->setDate($payment->date);
        $paymentXero->setAmount($payment->amount);
        $paymentXero->setReference($payment->description);

        $invoiceXero->save();

        if (!empty($payment->xero_id)) {
            $payment = $this->getPaymentFormatFromXero($invoiceXero);
            $payment = $this->payments_model->editPayment($payment);
        }
    }

}
