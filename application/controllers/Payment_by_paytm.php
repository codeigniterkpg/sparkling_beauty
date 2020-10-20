<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_by_paytm extends CI_Controller {
    public function __construct() {
        parent::__construct();
        @session_start();

        //===================================================
        // Loads Paytm Authorized Files
        //===================================================
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

        $this->load->library('Stack_web_gateway_paytm_kit');
	//===================================================
    }
    public function index()
    {
    }
    public function payby_paytm()
    {
    	
    		if($this->session->userdata('order_id')){
				$order_id=$this->session->userdata('order_id');
			}else{
				redirect(base_url('checkout'));exit;
			}
    		if($this->session->userdata('order_amount')){
				$order_amount=$this->session->userdata('order_amount');
				$order_email=$this->session->userdata('order_email');
				$order_phone=$this->session->userdata('order_phone');
			}else{
				redirect(base_url('checkout'));exit;
			}
			
			$customer_data=$this->session->userdata('customer_data');
			if(empty($customer_data)){
				if($this->session->userdata('guest_id')){
					$customer_id=$this->session->userdata('guest_id');
				}
			}else{
				$customer_id=$this->session->userdata('customer_data')[0]['tc_id'];
			}
			/* $order_amount */
    		$paytmParams = array();
    		$paytmParams['ORDER_ID'] 		= $order_id;
    		$paytmParams['TXN_AMOUNT'] 		= $order_amount;
    		$paytmParams["CUST_ID"] 		= $customer_id;
    		$paytmParams["EMAIL"] 			= $order_email;
    		$paytmParams["MSISDN"] 			= $order_phone;

		    $paytmParams["MID"] 			= PAYTM_MERCHANT_MID;
		    $paytmParams["CHANNEL_ID"] 		= PAYTM_CHANNEL_ID;
		    $paytmParams["WEBSITE"] 		= PAYTM_MERCHANT_WEBSITE;
		    $paytmParams["CALLBACK_URL"] 	= PAYTM_CALLBACK_URL;
		    $paytmParams["INDUSTRY_TYPE_ID"]= PAYTM_INDUSTRY_TYPE_ID;
    		
		    $paytmChecksum = $this->stack_web_gateway_paytm_kit->getChecksumFromArray($paytmParams, PAYTM_MERCHANT_KEY);
		    $paytmParams["CHECKSUMHASH"] = $paytmChecksum;
		    
		    $transactionURL = PAYTM_TXN_URL;
    		// p($posted);
    		// p($paytmParams,1);

    		$data = array();
    		$data['paytmParams'] 	= $paytmParams;
    		$data['transactionURL'] = $transactionURL;
    		
    		$this->load->view('payby_paytm', $data);
    	
    }

    public function paytm_response(){
    	
		$paytmChecksum 	= "";
		$paramList 		= array();
		$isValidChecksum= "FALSE";

		$paramList = $_POST;
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

		header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");

		$data['post_data']=$_POST;
		$data['isValidChecksum'] = $this->stack_web_gateway_paytm_kit->verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); 
		
		/* if($data['isValidChecksum'] == "TRUE") {
			
			if ($data['post_data']["STATUS"] == "TXN_SUCCESS") {
				$this->send_invoice_email($data['post_data']["ORDERID"]);
			}
		} */
		
		$this->load->view('pay_response', $data);
		
		
    }
	
}
?>
