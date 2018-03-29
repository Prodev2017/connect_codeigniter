<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Products_model extends CI_Model
{

  function getAll($user_id){
    $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = ".$user_id)->result();
    $query = $this->db->query("SELECT * FROM products WHERE account_id = ".$account_id[0]->account_id);
    return $query->result();
  }

  function getProduct($id){
    $query = $this->db->query("SELECT * FROM products WHERE id = ".$id);
    return $query->result()[0];
  }

  function getProductByCode($code){
    $query = $this->db->query("SELECT * FROM products WHERE code = '".$code."'");
    return $query->result()[0];
  }

  function addProduct($data, $user_id){
    $account_id = $this->db->query("SELECT account_id FROM user_accounts WHERE user_id = ".$user_id)->result()[0]->account_id;

    //To get the most recent ID
    $last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('products')->row();

    //Increment last ID plus 1
    if (!empty($last_row)) {
      $data['id'] = $last_row->id+1;
    } else {
      $data['id'] = 1;
    }
    $data['account_id'] = $account_id;

    if(array_key_exists('proposals_id', $data)){
      $proposals = $data['proposals_id'];
      unset($data['proposals_id']);
    }else{$proposals;}

    if($this->db->insert('products', $data)){
      $product = true;
    }else{$product = false;}

    if(!array_key_exists('xero_id', $data)){
      $this->load->model('API_model');
      $this->API_model->updateProductXero($data['id']);
    }

    if(!empty($proposals)){
      $proposals = addProposals($data['id'], $proposals);
    }else{$proposals = true;}

    if($product && $proposals && ($proposals != false)){
      return $this->getProduct($data['id']);
    }else{return false;}
  }

  function editProduct($id, $data){
    $query = "UPDATE products
    SET
    name = '".addslashes($data['name'])."',
    sales_description = '".addslashes($data['sales_description'])."',
    isSold = '".$data['isSold']."',";


    if(array_key_exists("xero_id", $data)){
      $query = $query."xero_id = '".$data['xero_id']."',";
    }
$this->load->model('API_model');
     $this->API_model->updateProductXero($id);

    $query = $this->db->query($query."price_unit = '".$data['price_unit']."'
    WHERE id = ".$id);

    if(array_key_exists("proposals_id", $data)){
      $proposals_id = $data["proposals_id"];
      unset($data['proposals_id']);
    }else{$proposals_id = array();}

    $query = $this->db->query("SELECT proposal_id FROM proposals_has_products
    WHERE product_id = ".$id);
    $queryRes = $query->result();
    $oldProposals_id = array();
    foreach($queryRes as $oldProposal){
      $oldProposals_id[] = $oldProposal->proposal_id;
    }

    $newProposals = array_diff($proposals_id, $oldProposals_id);
    $deleteProposals = array_diff($oldProposals_id, $proposals_id);
    if(!empty($newProposals)){
      $this->addProposals($id, $newProposals);
    }
    if(!empty($deleteProposals)){
      foreach($deleteProposals as $deleteProposal){
        $this->deleteProposalFromProduct($id, $deleteProposal);
      }
    }
  }

  function deleteProduct($id){
    $this->deleteProposalsByCompany($id);
    return $this->db->query("DELETE FROM products
    WHERE id = ".$id);
  }

    ///////////////
    // Proposals //
    ///////////////

    function getAllProposals($id){
      $query = $this->db->query("SELECT proposal_id FROM proposals_has_products WHERE product_id = ".$id);
      $proposals_id = $query->result();

      $proposals = null;

      foreach($proposals_id as $proposal_id){
        $query = $this->db->query('SELECT * FROM proposals WHERE id = '.$proposal_id->proposal_id);
        $proposals[] = $query->result()[0];
      }

      return $proposals;
    }

    function getAllAvailableProposals($id = null){
      $endQuery = "";
      if($id != null){
        $query = $this->db->query("SELECT proposal_id FROM proposals_has_products
          WHERE product_id = ".$id);
        $proposals_id = $query->result();
        foreach($proposals_id as $proposal_id){
          $endQuery = $endQuery." AND id != ".$proposal_id->proposal_id;
        }
      }
      $query = $this->db->query("SELECT id FROM proposals
        WHERE id != ''".$endQuery);
      return $query->result();
    }

    function getQuantity($product_id, $proposal_id){
      $query = $this->db->query("SELECT quantity
      WHERE proposal_id = ".$proposal_id." AND product_id = ".$product_id);
      return $query->result()[0]->quantity;
    }

    function addProposals($id, $datas){
      $flag;
      foreach($datas as $data){
        $flag = $this->addProposal($id, $data);
        if(!$flag){break;}
      }
      return $flag;
    }

    function addProposal($id, $data){
      $toInsert["product_id"] = $id;
      $toInsert["proposal_id"] = $data;
      if($this->db->insert('proposals_has_products', $toInsert)){
        return true;
      }else{return false;}
    }

    function editQuantity($product_id, $proposal_id, $quantity){
      $query = $this->db->query("UPDATE proposals_has_products
      SET quantity = ".$quantity."
      WHERE product_id = ".$product_id." AND proposal_id = ".$proposal_id);
    }

    function deleteProposalsByProduct($id){
      return $this->db->query("DELETE FROM proposals_has_products
      WHERE product_id = ".$id);
    }

    function deleteProposalFromProduct($productId, $proposalId){
      return $this->db->query("DELETE FROM proposals_has_products
      WHERE product_id = ".$productId." AND proposal_id = ".$proposalId);
    }
}
