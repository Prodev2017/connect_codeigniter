<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Payments_model extends CI_Model
{
  function getAll($user_id, $account_id)
  {
    $this->load->model('invoices_model');
    $invoices = $this->invoices_model->getAll($account_id);
    $payments = array();
    foreach($invoices as $invoice){
      $payments_temp = $this->getAllPaymentsByInvoice($invoice->id);
      foreach($payments_temp as $payment_temp){
        $payments[] = $payment_temp;
      }
    }

    return $payments;
  }

  function getAllPaymentsByInvoice($invoice_id)
  {
    $query = $this->db->query("SELECT * FROM payments
      WHERE invoice_id =".$invoice_id);
    return $query->result();
  }

  function getPayment($id)
  {
    $query = $this->db->query("SELECT * FROM payments
      WHERE id =".$id);
    return $query->result()[0];
  }

  function addPayment($data)
  {
    //To get the most recent ID
    $last_row=$this->db->select('id')->order_by('id',"desc")->limit(1)->get('invoices')->row();

    //Increment last ID plus 1
    if (!empty($last_row)) {
      $data['id'] = $last_row->id+1;
    } else {
      $data['id'] = 1;
    }
    $data['date'] = getDate();

    if($this->db->insert('payments', $data)){
      $payment = true;
    }else{$payment = false;}

    if(!array_key_exists('xero_id', $data)){
      $this->load->model('API_model');
      $this->API_model->updatePaymentXero($data['id']);
    }

    if($invoice){
      return $this->getInvoice($data['id']);
    }else{return false;}
  }

  function editPayment($id, $data)
  {
    $query = $this->db->query("UPDATE payments
    SET
    amount = '".$data['amount']."',
    description = '".$data['description']."'
    WHERE id = ".$id);
  }

  function deletePayment($id)
  {
    return $this->db->query("DELETE FROM payments
    WHERE id = ".$id);
  }
}
