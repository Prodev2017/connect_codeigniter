<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Invoices_model extends CI_Model
{
  function getAll($user_id){
    $this->load->model('opportunities_model');
    $this->load->model('proposals_model');

    $invoices = array();

        $query = $this->db->query("SELECT * FROM invoices WHERE account_id = ".$user_id);
        $invoices_temp = $query->result();


        foreach($invoices_temp as $invoice_temp){
          $invoices[] = $invoice_temp;
       
    }
    return $invoices;
  }

  function getInvoice($id){
    $query = $this->db->query("SELECT * FROM invoices WHERE id = ".$id);
    return $query->result()[0];
  }

  function addInvoice($data){
    $this->load->model('proposals_model');
    $this->load->model('API_model');
    //To get the most recent ID
    $last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('invoices')->row();

    //Increment last ID plus 1
    if (!empty($last_row)) {
      $data['id'] = $last_row->id+1;
    } else {
      $data['id'] = 1;
    }
    $data['date'] = date("Y/m/d");


    if($this->db->insert('invoices', $data)){
      $invoice = true;
    }else{$invoice=false;}
    $invoices_lines = $this->proposals_model->getAllProducts($data['proposal_id']);
    $invoices_lines = $this->addInvoicesLines($data['id'], $invoices_lines);

    if(empty($data['xero_id'])){
      $this->API_model->updateInvoiceXero($data['id']);
    }

    if($invoice && $invoices_lines && ($invoices_lines != false)){
      return $this->getInvoice($data['id']);
    }else{return false;}
  }

  function editInvoice($id, $data)
  {
    $total = $data['subtotal'] + $data['total_tax'];
    $query = "UPDATE invoices
    SET
    due_date = '".$data['due_date']."',
    status = '".$data['status']."',
    subtotal = '".$data['subtotal']."',
    total_tax = '".$data['total_tax']."',
    total = '".$total."',
    total_discount = '".$data['total_discount']."',
    expected_payment_date = '".$data['expected_payment_date']."',
    amount_paid = '".$data['amount_paid']."',";

    if(array_key_exists("xero_id", $data)){
      $query = $query."xero_id = '".$data['xero_id']."',";
    }

    if(array_key_exists("invoices_lines", $data)){
      $invoicesLines = $data['invoices_lines'];
      unset($data['invoices_lines']);
      foreach($invoicesLines as $invoiceLine){
        $this->editInvoiceLine($this->getInvoiceLineByCode($invoiceLine['code'])->id, $invoiceLine);
      }
    }

    $query = $this->db->query($query."fully_paid_on_date = '".$data['fully_paid_on_date']."'
    WHERE id = ".$id);
  }

  function deleteInvoice($id){
    $this->deleteInvoicesLinesByInvoice($id);
    return $this->db->query("DELETE FROM invoices
    WHERE id = ".$id);
  }

  ///////////////////
  // invoice_lines //
  ///////////////////

    function getInvoiceLine($id){
      $query = $this->db->query("SELECT * FROM invoices_lines
      WHERE id = $id");
      return $query->result()[0];
    }

    function getInvoicesByXero($id){
      $query = $this->db->query("SELECT * FROM invoices
      WHERE xero_contact_id = '$id'");
      return $query->result();
    }

    function getAllInvoicesLines($invoice_id){
      $query = $this->db->query("SELECT * FROM invoices_lines
      WHERE invoice_id = ".$invoice_id);
      return $query->result();
    }

    function getInvoiceLineByCode($code){
      $query = $this->db->query("SELECT * FROM invoices_lines WHERE code = '".$code."'");
      return $query->result()[0];
    }

    function addInvoicesLines($invoice_id, $datas){
      foreach($datas as $data){
        $flag = true;
        $data_temp = array();

  			$data_temp['invoice_id'] = $invoice_id;
        if(isset($data->account_code)){
          $data_temp['account_code'] = $data->account_code;
        }
  			$data_temp['name'] = $data->name;
  			$data_temp['sales_description'] = $data->sales_description;
  			$data_temp['isSold'] = $data->isSold;
  			$data_temp['price_unit'] = $data->price_unit;
        $data_temp['code'] = $data->code;
        $data_temp['quantity'] = $this->db->query("SELECT quantity FROM proposals_has_products
          WHERE product_id = ".$data->id." AND proposal_id = ".$this->getInvoice($invoice_id)->proposal_id)->result()[0]->quantity;
        if(!$this->addInvoiceLine($invoice_id, $data_temp)){
          $flag = false;
          break;
        }
      }
      return $flag;
    }

    function product_has_bought($xero_contact_id, $keyword){
      $found = 0;

      $query = $this->db->query("SELECT * FROM invoices_lines WHERE sales_description LIKE '%".$keyword."%'");

      foreach ($query->result()as $single) {

        $invoice = $this->db->query("SELECT * FROM invoices WHERE id = '".$single->id."'");

        if ($invoice->result()[0]->xero_contact_id == $xero_contact_id) {
          $found = 1;
        }

    

      }

       
      return $found;

    }

    function addInvoiceLine($invoice_id, $data){
      //To get the most recent ID
      $last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('invoices_lines')->row();

      //Increment last ID plus 1
      if (!empty($last_row)) {
        $data['id'] = $last_row->id+1;
      } else {
        $data['id'] = 1;
      }
      var_dump("test4");

      if($this->db->insert('invoices_lines', $data)){
        $invoice_line = $this->getInvoiceLine($data['id']);
      }else{$invoice_line = false;}

      var_dump("test5");

      if($invoice_line){
        return $invoice_line;
      }else{return false;}
    }

    function editInvoiceLine($id, $data){
      $query = "UPDATE invoices_lines
      SET
      sales_description = '".$data['sales_description']."',
      isSold = '".$data['isSold']."',
      price_unit = '".$data['price_unit']."',";

      if(array_key_exists("xero_id", $data)){
        $query = $query."xero_id = '".$data['xero_id']."',";
      }
      if(array_key_exists("name", $data)){
        $query =$query."name = '".$data['name']."',";
      }

      $query = $this->db->query($query."account_code = '".$data['account_code']."'
      WHERE id = ".$id);
    }

    function deleteInvoiceLine($id){
      return $this->db->query("DELETE FROM invoices_lines
      WHERE id = ".$id);
    }

    function deleteInvoicesLinesByInvoice($invoice_id){
      return $this->db->query("DELETE FROM invoices_lines
      WHERE invoice_id = ".$invoice_id);
    }
}
