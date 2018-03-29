<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Proposals_model extends CI_Model
{

  function getAll($user_id){
    $this->load->model('opportunities_model');
    $opportunities = $this->opportunities_model->getAll($user_id);
    $proposals = array();
    foreach($opportunities as $opportunity){
      $proposals_temp = $this->opportunities_model->getAllProposalsByOpportunity($opportunity->id);
      foreach($proposals_temp as $proposal_temp){
        $proposals[] = $proposal_temp;
      }
    }
    return $proposals;
  }

  function getProposal($id){
    $query = $this->db->query("SELECT * FROM proposals WHERE id = ".$id);
    return $query->result()[0];
  }


     function getSingle($id) {
      $result = '';
        $query = $this->db->query("SELECT * from proposals WHERE id = ".$id);
        $result = $query->result();

        return $result;
    }

    function updateHTML($id,$preview,$html, $page, $footer, $xero_id) {

      $c_query = $this->db->query("SELECT * FROM proposals WHERE id = ".$id);
      $result = $c_query->result()[0];

      

     
      $html_preview = unserialize(base64_decode($result->preview));
      $html_template = unserialize(base64_decode($result->html_template));

      $footer0 = unserialize($result->footer);

      $footer0[$page] = $footer;


      $html_preview[$page] = '';
      $html_preview[$page] = str_replace('<div class="page">','',$preview);
      $html_template[$page] = '';
      $html_template[$page] = $html;

      

      if (empty($xero_id)) { 


      $query = $this->db->query("UPDATE proposals
       SET
       footer = '".serialize($footer0)."',
       preview = '".base64_encode(serialize($html_preview))."',
       html_template = '".base64_encode(serialize($html_template))."'
       WHERE id = ".$id);

    } else {

  $query = $this->db->query("UPDATE proposals
       SET
       footer = '".serialize($footer0)."',
       preview = '".base64_encode(serialize($html_preview))."',
       xero_id ='".$xero_id."',
       html_template = '".base64_encode(serialize($html_template))."'
       WHERE id = ".$id);

    }




    }

    function addProductsToProposal($products, $id) {


      $query = $this->db->query("UPDATE proposals
       SET
       product_table = '".serialize($products)."'
       WHERE id = ".$id);

    
    }

    function deletePage($id, $page) {

      $c_query = $this->db->query("SELECT * FROM proposals WHERE id = ".$id);
      $result = $c_query->result()[0];

      
      $html_preview2 = unserialize(base64_decode($result->preview));
      $html_template2 = unserialize(base64_decode($result->html_template));

      unset($html_preview2[$page]);
      unset($html_template2[$page]);

      $number = 1;
      foreach ($html_preview2 as $key => $html_preview_single) {
      $html_preview[$number] = $html_preview_single;
      $number++;
      }

      $number = 1;
      foreach ($html_template2 as $key => $html_template_single) {
      $html_template[$number] = $html_template_single;
      $number++;
      }

      ;

      $page_correct = $result->pages-1;

      $query = $this->db->query("UPDATE proposals
       SET
       pages = '".$page_correct."',
       preview = '".base64_encode(serialize($html_preview))."',
       html_template = '".base64_encode(serialize($html_template))."'
       WHERE id = ".$id);


    }

  function getAllOpportunities() {

  $query = $this->db->query("SELECT * FROM opportunities");

  foreach ($query->result_array() as $oppor) {


    foreach ( (unserialize($oppor['contacts_id'])) as $contacts) {

      $c_query = $this->db->query("SELECT * FROM contacts WHERE id = ".$contacts);
      $c_query->result_array();

      $opp[$oppor['id']] = $c_query->result_array()[0]['first_name'].' '.$c_query->result_array()[0]['last_name'];

    }

  }

  return $opp;

  }

  function addPage($id, $number){
    if ($number == 1) {$number = 2;}
   $query = $this->db->query("UPDATE proposals
    SET
    pages = '".$number."'
    WHERE id = ".$id);
  }

  function addProposal($data, $user){
    //To get the most recent ID
    $last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('proposals')->row();

    //Increment last ID plus 1
    if (!empty($last_row)) {
      $data['id'] = $last_row->id+1;
    } else {
      $data['id'] = 1;
    }
    $data['user'] = $user;
  

    if(array_key_exists("crm-productsforproposal1_length", $data)){
      unset($data['crm-productsforproposal1_length']);
    }
    if(array_key_exists("crm-productsforproposal2_length", $data)){
      unset($data['crm-productsforproposal2_length']);
    }
    if(array_key_exists("products", $data)){
      $products = $data['products'];
      unset($data['products']);
      
    }else{$products;}

    if($this->db->insert('proposals', $data)){
      $proposal = true;
    }else{$proposal=false;}

    if(! empty($products)){
      $products = $this->addProducts($data['id'], $products);
    }else{$products = true;}

    if($proposal && $products && ($products != false)){
     // return $this->getProposal($data['id']);
    }else{}
    
    return $data['id'];


  }

  function editProposal($id, $datas){
    $query = $this->db->query("UPDATE proposals
    SET
    name = '".$datas['name']."',
    opportunity_id = '".$datas['opportunity_id']."'
    WHERE id = ".$id);
  }

  function deleteProposal($id){
    $this->deleteProductsByCompany($id);
    return $this->db->query("DELETE FROM proposals
    WHERE id = ".$id);
  }

    //////////////
    // Products //
    //////////////

    function getAllProducts($id){
      $query = $this->db->query("SELECT product_id FROM proposals_has_products WHERE proposal_id = ".$id);
      $products_id = $query->result();

      $products = null;

      foreach($products_id as $product_id){
        $query = $this->db->query('SELECT * FROM products WHERE id = '.$product_id->product_id);
        $products[] = $query->result()[0];
      }

      return $products;
    }

    function getAllAvailableProducts($id = null){
      $endQuery = "";
      if($id != null){
        $query = $this->db->query("SELECT product_id FROM proposals_has_products
          WHERE proposal_id = ".$id);
        $products_id = $query->result();
        foreach($products_id as $product_id){
          $endQuery = $endQuery." AND id != ".$product_id->product_id;
        }
      }
      $query = $this->db->query("SELECT * FROM products
        WHERE id != ''".$endQuery);
      return $query->result();
    }

    function getQuantity($id, $productId){
      $query = $this->db->query("SELECT quantity FROM proposals_has_products
      WHERE product_id = ".$productId." AND proposal_id = ".$id);
      $query->result()[0]->quantity;
    }

    function addProducts($id, $datas){
      $flag;
      foreach($datas as $data){
        $flag = $this->addProduct($id, $data);
        if(!$flag){break;}
      }
      return $flag;
    }

    function addProduct($id, $data){
      $toInsert["proposal_id"] = $id;
      $toInsert["product_id"] = $data->product_id;
      $toInsert["quantity"] = $data->quantity;
      if($this->db->insert('proposals_has_products', $toInsert)){
        return true;
      }else{return false;}
    }

    function editQuantity($proposal_id, $product_id, $quantity){
      $query = $this->db->query("UPDATE proposals_has_products
      SET
      quantity = ".$quantity."
      WHERE proposal_id = ".$proposal_id." AND product_id = ".$product_id);
    }

    function deleteProductsByProposal($id){
      return $this->db->query("DELETE FROM proposals_has_products
      WHERE proposal_id = ".$id);
    }

    function deleteProductFromProposal($proposalId, $productId){
      return $this->db->query("DELETE FROM proposals_has_products
      WHERE proposal_id = ".$proposalId." AND product_id = ".$productId);
    }

    //////////////
    // Invoices //
    //////////////

    function getAllInvoices($proposal_id){
      $query = $this->db->query("SELECT * FROM invoices
        WHERE proposal_id =".$proposal_id);
      return $query->result();
    }
}
