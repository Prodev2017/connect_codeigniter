<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Emails extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper(array('url', 'language'));
        
        //Check if user is logged in
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('login', 'refresh');
        }

        //Load the contacts model
        $this->load->model('contacts_model');
        $this->load->model('companies_model');
        $this->load->model('account_model');

        $this->load->model('tags_model');

        $this->load->model('emails_model');

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        //load contacts language
        $this->lang->load('contacts');
        $this->lang->load('companies');
        // load help button language
        $this->lang->load('help');

        include dirname(__FILE__) . "/../../api/sparkpost/sparkpost-api.php";

    }

    public function index()
    {

        $this->data['user'] = $this->ion_auth->user()->row();

        //Pass information in $this->data;

        $user_id               = $this->ion_auth->user()->row()->id;
        $this->data['user']    = $this->ion_auth->user()->row();
        $user                  = $this->data['user'];
        $account               = $this->account_model->getAccount($user->id);
        $this->data['account'] = $account[0];

       
        $this->data['emails_all'] = $this->emails_model->getAll($account[0]->account_id);

        // show different page based on different view
        $view = $this->input->get('view');
        if($view == 'list'){
            $this->_render_page('emails/all-list-view', $this->data);
        }
        else if($view == 'card'){
            $this->_render_page('emails/all-card-view', $this->data);
        }
        else{
            $this->_render_page('emails/all', $this->data);
        }

    }


    public function broadcasts()
    {

        $this->data['user'] = $this->ion_auth->user()->row();

        //Pass information in $this->data;

        $user_id               = $this->ion_auth->user()->row()->id;
        $this->data['user']    = $this->ion_auth->user()->row();
        $user                  = $this->data['user'];
        $account               = $this->account_model->getAccount($user->id);
        $this->data['account'] = $account[0];

        //Run the getAll() from the Contacts model
        $this->data['templates_all'] = $this->emails_model->getAll($account[0]->account_id);
        foreach ($this->data['templates_all'] as $templates_single) {
        	$templatebyid[$templates_single->id] = $templates_single;
        }
        $this->data['template_by_id'] = $templatebyid;
        $this->data['broadcasts_all'] = $this->emails_model->getAllBroadcasts($account[0]->account_id);

        $this->_render_page('emails/broadcasts', $this->data);

    }

    public function templates()
    {

        redirect('emails', 'refresh');

    }

    public function add_template()
    {
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->_render_page('emails/add_template', $this->data);

    }

    public function edit_template($id)
    {
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->data['email_template'] = $this->emails_model->getSingle($id)[0];

        $this->_render_page('emails/edit_template', $this->data);

    }

    public function edit_html($id, $id2)
    {

        $this->data['user'] = $this->ion_auth->user()->row();

        if($id == 'upload') 
        {

            $todayh = getdate();
            $filename= "upload-file-".$todayh[seconds].$todayh[minutes].$todayh[hours].$todayh[mday]. $todayh[mon].$todayh[year];

            if ( 0 < $_FILES['file']['error'] ) {
                echo 'Error: ' . $_FILES['file']['error'] . '<br>';
            }
            else {
                $ext=explode('.',$_FILES['file']['name'])[1];
                echo  __DIR__ . "/../../".$this->data['user']->id."/uploads/";
                if ( ! is_dir( __DIR__ . "/../../uploads/".$this->data['user']->id."")) {
                mkdir( __DIR__ . "/../../uploads/".$this->data['user']->id."");
                }
                echo move_uploaded_file($_FILES['file']['tmp_name'], __DIR__ . "/../../uploads/".$this->data['user']->id."/" .$filename.'.'.$ext);
            }
            exit;
        }

        if($id == 'load_html'){

            $this->data['email_template'] = $this->emails_model->getSingle($id2)[0];;

            if (!empty($this->data['email_template']->preview)) {
                    $this->data['preview'] = str_replace("\n", "",str_replace("'",'"',base64_decode($this->data['email_template']->preview)));
            } else {
                $this->data['preview'] = '<table class="main" width="100%" cellspacing="0" cellpadding="0" border="0" data-types="background,padding" data-last-type="padding">
                                            <tbody>
                                                <tr>
                                                    <td align="left" class="element-content" style="padding-left:50px;padding-right:50px;padding-top:10px;padding-bottom:10px;background-color:#FFFFFF;">
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td contenteditable="true" align="center" class=" active" style="padding: 20px;">
                                                                        Drag elements from left menu&nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        ';
            }

            echo $this->data['preview'];
            exit;
        }



       if($id == 'elements') 
        {

            include dirname(__FILE__) . "../../../assets/elements/".$id2;

            return;

        }

        if($id == 'get-files.php') 
        {

            //get all files in uploads folder
            $files = array_diff(scandir( __DIR__ . "/../../uploads/".$this->data['user']->id.""), array('.', '..'));

            //creating response
            $response=array();

            $response['code']=0;
            $response['files']=$files;
            $response['directory']= base_url()."uploads/".$this->data['user']->id."/";

            //convert to json
            echo json_encode($response);
            return;
        }

        if($id == 'assets') 
        {

            include dirname(__FILE__) . "../../../assets/".$id2;

            return;

        }

        if($id == 'save_html') 
        {

            $style = '<style>
                            body {
                                margin: 0;
                                padding: 0;
                            }
                            /*
                        body {
                        margin: 0;
                        padding: 0;
                        }

                        body, table, td, p, a, li {
                        -webkit-text-size-adjust: 100%;
                        -ms-text-size-adjust: 100%;
                        }

                        a {
                        word-wrap: break-word;
                        }

                        table td {
                        border-collapse: collapse;
                        }

                        table {
                        border-spacing  : 0;
                        border-collapse  : collapse;
                        mso-table-lspace: 0pt;
                        mso-table-rspace: 0pt;
                        }

                        table, td {
                        mso-table-lspace: 0pt;
                        mso-table-rspace: 0pt;
                        }

                        .ReadMsgBody {
                        width:100%;
                        background-color: #eeeeee;
                        }

                        .ExternalClass {
                        width: 100%;
                        background-color: #eeeeee;
                        }

                        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
                        line-height: 100%;
                        }

                        .ExternalClass * {
                        line-height: 100%;
                        }

                        @media only screen and (max-width: 640px) {

                        table[class="main"],td[class="main"] { width:100% !important; min-width: 200px !important; }

                        table[class="logo-img"] { width:100% !important; float: none; margin-bottom: 15px;}
                        table[class="logo-img"] td { text-align: center !important;}

                        table[class="logo-title"] { width:100% !important; float: none;}
                        table[class="logo-title"] td { text-align: center; height: auto}
                        table[class="logo-title"] h1 { font-size: 24px !important; }
                        table[class="logo-title"] h2 { font-size: 18px !important; }

                        td[class="header-img"] img { width:100% !important; height:auto !important; }

                        td[class="title"] { padding-left: 25px !important; padding-right: 25px !important; }
                        td[class="title"] h1 { font-size: 24px !important; }

                        td.block-text { padding-left: 25px !important; padding-right: 25px !important; }
                        td[class="block-text"] h2 { font-size: 20px !important; line-height: 170% !important; }
                        td[class="block-text"] p { font-size: 16px !important; line-height: 170% !important; }
                        td[class="block-text"] li { font-size: 16px !important; line-height: 170% !important; }

                        td[class="two-columns"] { padding-left: 25px !important; padding-right: 25px !important; }
                        table[class="text-column"] { width:100% !important; float: none; margin-bottom: 15px;}

                        td[class="image-caption"] { padding-left: 25px !important; padding-right: 25px !important; }
                        table[class="image-caption-container"] { width:100% !important;}
                        table[class="image-caption-column"] { width:100% !important; float: none;}
                        td[class="image-caption-content"] img { width:100% !important; height:auto !important; }
                        td[class="image-caption-content"] h2 { font-size: 20px !important; line-height: 170% !important; }
                        td[class="image-caption-content"] p { font-size: 16px !important; line-height: 170% !important; }
                        td[class="image-caption-top-gap"] { height: 15px !important; }
                        td[class="image-caption-bottom-gap"] { height: 5px !important; }

                        td[class="text"] { width:100% !important; }
                        td[class="text"] p { font-size: 16px !important; line-height: 170% !important; }
                        td[class="text"] h2 { font-size: 20px !important; line-height: 170% !important; }
                        td[class="gap"] { display:none; }

                        td[class="header"] { padding: 25px 25px 25px 25px !important; }
                        td[class="header"] h1 { font-size: 24px !important; }
                        td[class="header"] h2 { font-size: 20px !important; }

                        td[class="footer"] { padding-left: 25px !important; padding-right: 25px !important; }
                        td[class="footer"] p { font-size: 13px !important; }
                        table[class="footer-side"] { width: 100% !important; float: none !important; }
                        td[class="footer-side"] { text-align: center !important; }
                        td[class="social-links"] { text-align: center !important; }
                        table[class="footer-social-icons"] { float: none !important; margin: 0px auto !important; }
                        td[class="social-icon-link"] { padding: 0px 5px !important; }

                        td[class="image"] img { width:100% !important; height:auto !important; }
                        td[class="image"] { padding-left: 25px !important; padding-right: 25px !important; }

                        td[class="image-full"] img { width:100% !important; height:auto !important; }
                        td[class="image-full"] { padding-left: 0px !important; padding-right: 0px !important; }

                        td[class="image-group"] img { width:100% !important; height:auto !important; margin: 15px 0px 15px 0px !important; }
                        td[class="image-group"] { padding-left: 25px !important; padding-right: 25px !important; }

                        table[class="image-in-table"] { width:100% !important; float: none; margin-bottom: 15px;}
                        table[class="image-in-table"] td { width:100% !important;}
                        table[class="image-in-table"] img { width:100% !important; height:auto !important; }


                        td[class="image-text"] { padding-left: 25px !important; padding-right: 25px !important; }
                        td[class="image-text"] p { font-size: 16px !important; line-height: 170% !important; }

                        td[class="divider-simple"] { padding-left: 25px !important; padding-right: 25px !important; }

                        td[class="divider-full"] { padding-left: 0px !important; padding-right: 0px !important; }

                        td[class="social"] { padding-left: 25px !important; padding-right: 25px !important; }

                        table[class="preheader"] { display:none; }
                        td[class="preheader-gap"] { display:none; }
                        td[class="preheader-link"] { display:none; }
                        td[class="preheader-text"] { width:100%; }

                        td[class="buttons"] { padding-left: 25px !important; padding-right: 25px !important; }

                        table[class="button"] { width:100% !important; float: none; }

                        td[class="content-buttons"] { padding-left: 25px !important; padding-right: 25px !important; }
                        td[class="buttons-full-width"] { padding-left: 0px !important; padding-right: 0px !important; }
                        td[class="buttons-full-width"] a { width:100% !important; padding-left: 0px !important; padding-right: 0px !important; }
                        td[class="buttons-full-width"] span { width:100% !important; padding-left: 0px !important; padding-right: 0px !important; }

                        table[class="content"] { width:100% !important; float: none !important;}
                        td[class="gallery-image"] { width:100% !important; padding: 0px !important;}

                        table[class="social"] { width: 100%!important; text-align: center!important; }
                        table[class="links"] { width: 100%!important; }
                        table[class="links"] td { text-align: center!important; }
                        table[class="footer-btn"] { text-align: center!important; width: 100%!important; margin-bottom: 10px; }
                        table[class="footer-btn-wrap"] { margin-bottom: 0px; width: 100%!important; }

                        td[class="head-social"]  { width: 100%!important; text-align: center!important; padding-top: 20px; }
                        td[class="head-logo"]  { width: 100%!important; text-align: center!important; }
                        tr[class="header-nav"] { display: none; }

                        }*/
                        </style>';

            $this->emails_model->updateHTML($id2, $_REQUEST['content'], $style.$_REQUEST['content']);

            return;
            exit;
        }


        $this->data['user'] = $this->ion_auth->user()->row();

         $this->data['id'] = $id;

        $this->data['email_template'] = $this->emails_model->getSingle($id)[0];;

        if (!empty($this->data['email_template']->preview)) {
        $this->data['preview'] = str_replace("\n", "",str_replace("'",'"',base64_decode($this->data['email_template']->preview)));
        }

        $this->_render_page('emails/edit_html', $this->data);

    }

    public function add_email_template()
    {

        $this->data['user']    = $this->ion_auth->user()->row();
        $user                  = $this->data['user'];
        $account               = $this->account_model->getAccount($user->id);
        $this->data['account'] = $account[0];

        $store = $_REQUEST;

        $eid = $this->emails_model->addEmail($store, $account[0]->account_id);

        redirect(base_url().'emails/edit_html/'.$eid, 'refresh');

    }

    public function edit_email_template($template_id)
    {

        $this->data['user']    = $this->ion_auth->user()->row();
        $user                  = $this->data['user'];
        $account               = $this->account_model->getAccount($user->id);
        $this->data['account'] = $account[0];

        $store = $_REQUEST;

        $this->emails_model->editEmail($store, $template_id);

        //redirect('emails', 'refresh');
        redirect(base_url().'emails/edit_html/'.$template_id, 'refresh');

    }

    public function delete_template($id)
    {

        $this->emails_model->deleteTemplate($id);

        redirect('emails', 'refresh');
    }

    public function add_broadcast()
    {

        $this->data['available_contacts'] = $this->companies_model->getAllAvailableContacts();
        $this->data['user']               = $this->ion_auth->user()->row();
        $user                             = $this->data['user'];
        $account                          = $this->account_model->getAccount($user->id);
        $this->data['account']            = $account[0];

        $this->data['templates'] = $this->emails_model->getAll($account[0]->account_id);

        $this->_render_page('emails/add_broadcast', $this->data);

    }

    public function send_broadcast()
    {

        $user    = $this->ion_auth->user()->row();
        $account = $this->account_model->getAccount($user->id);

        $mail = new sparkPostApi('https://api.sparkpost.com/api/v1/transmissions', '909143092d10edfb2154bb275e59ce52e02277b7');
        $mail->from(array(
            'email' => $user->first_name . '@connectably.com',
            'name'  => $user->first_name . ' ' . $user->last_name,
        ));

        $template = $this->emails_model->getSingle($_REQUEST['template_id'])[0];

        $mail->subject($template->subject);
        $mail->html(base64_decode($template->html_template));

        $contacts = explode(",", $_REQUEST['contact_ids']);
        foreach ($contacts as $contact) {
            if (empty($contact)) {continue;}
            $details  = $this->contacts_model->getContact($contact);
            $sendto[] = $details->email;

        }

        $mail->setTo($sendto);

        try {
            $mail->send();

        } catch (Exception $e) {

        }

        $mail->close();

        $storebroadcast['account_id']  = $account[0]->account_id;
        $storebroadcast['name']        = $_REQUEST['name'];
        $storebroadcast['contacts']    = $_REQUEST['contact_ids'];
        $storebroadcast['template_id'] = $_REQUEST['template_id'];

        $this->emails_model->storeBroadcast($storebroadcast);

        redirect('emails/broadcasts', 'refresh');
    }

    // get email content 
    public function get_email($id){
        $email = $this->emails_model->getEmailDetails($id);
        echo json_encode(array('success'=>true,'email'=>$email));
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
