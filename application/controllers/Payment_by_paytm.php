<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_by_paytm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        @session_start();
        //===================================================
        // Loads Paytm Authorized Files
        //===================================================
        /*header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Expires: 0");*/
        $this->load->library('Stack_web_gateway_paytm_kit');
        //===================================================
    }

    public function index()
    {
    }

    public function payby_paytm()
    {
        if ($this->session->userdata('order_id')) {
            $order_id = $this->session->userdata('order_id');
        } else {
            redirect(base_url('checkout'));
            exit;
        }
        if ($this->session->userdata('order_amount')) {
            $order_amount = $this->session->userdata('order_amount');
            $order_email = $this->session->userdata('order_email');
            $order_phone = $this->session->userdata('order_phone');
        } else {
            redirect(base_url('checkout'));
            exit;
        }
        $customer_data = $this->session->userdata('customer_data');
        if (empty($customer_data)) {
            if ($this->session->userdata('guest_id')) {
                $customer_id = $this->session->userdata('guest_id');
            }
        } else {
            $customer_id = $this->session->userdata('customer_data')[0]['tc_id'];
        }
        /* $order_amount */
        $paytmParams = array();
        $paytmParams['ORDER_ID'] = $order_id;
        $paytmParams['TXN_AMOUNT'] = $order_amount;
        $paytmParams["CUST_ID"] = $customer_id;
        $paytmParams["EMAIL"] = $order_email;
        $paytmParams["MSISDN"] = $order_phone;
        $paytmParams["MID"] = PAYTM_MERCHANT_MID;
        $paytmParams["CHANNEL_ID"] = PAYTM_CHANNEL_ID;
        $paytmParams["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
        $paytmParams["CALLBACK_URL"] = PAYTM_CALLBACK_URL;
        $paytmParams["INDUSTRY_TYPE_ID"] = PAYTM_INDUSTRY_TYPE_ID;
        $paytmChecksum = $this->stack_web_gateway_paytm_kit->getChecksumFromArray($paytmParams, PAYTM_MERCHANT_KEY);
        $paytmParams["CHECKSUMHASH"] = $paytmChecksum;
        $transactionURL = PAYTM_TXN_URL;
        // p($posted);
        // p($paytmParams,1);
        $data = array();
        $data['paytmParams'] = $paytmParams;
        $data['transactionURL'] = $transactionURL;
        $this->load->view('payby_paytm', $data);
    }

    public function paytm_response()
    {
        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";
        $paramList = $_POST;
        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
//		header("Pragma: no-cache");
//		header("Cache-Control: no-cache");
//		header("Expires: 0");
        $data['post_data'] = $_POST;
        $data['isValidChecksum'] = $this->stack_web_gateway_paytm_kit->verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum);
        /*p($data['post_data']);*/
        $this->session->set_userdata("PAYTM_DATA", $data['post_data']);


        if ($data['isValidChecksum'] == "TRUE") {
            if ($data['post_data']["STATUS"] == "TXN_SUCCESS") {
//				$this->send_invoice_email($data['post_data']["ORDERID"]);
                $PaytmOrder = $this->session->userdata("PAYTM_DATA");
                $PostData = $this->session->userdata("OrderPostData");
                $this->PlaceOrder($PaytmOrder, $PostData);

                redirect("payment-success");
            } else {
                redirect("payment-fail");
            }
        } else {
            echo "invalid";
        }

    }

    public function PlaceOrder($PaytmOrder, $PostData)
    {
        $customer_id=$this->session->userdata('cust_id');

        $this->db->select('tbl_color.tclr_title,tbl_product.tp_name,tbl_cart.*');
        $this->db->join('tbl_color', 'tbl_color.tclr_id = tbl_cart.cr_color ','left');
        $this->db->join('tbl_product', 'tbl_product.tp_id = tbl_cart.cr_product_id ','left');
        $this->db->where('cr_cust_id',$customer_id);
        $exe_cart=$this->db->get('tbl_cart');
        $cart_data=$exe_cart->result_array();
        if(!empty($cart_data)){
            if($this->input->post('payment_method')=='cod'){
                $this->db->where('o_invoice_no !=','');
                $this->db->order_by('o_id','desc');
                $this->db->limit('1');
                $exe_inv=$this->db->get('tbl_order');
                $data_inv=$exe_inv->result_array();

                if(!empty($data_inv)){
                    $current_year=date('y');
                    $current_month=date('m');
                    if($current_month>=1 and $current_month<=3){
                        $temp_year=$current_year-1;
                        $final_year=$temp_year."-".$current_year;
                    }else{
                        $temp_year=$current_year+1;
                        $final_year=$current_year."-".$temp_year;
                    }

                    $inv=$data_inv[0]['o_invoice_no'];
                    $exp_inv=explode('/',$inv);
                    $last_year=$exp_inv[0];
                    $last_invoice=$exp_inv[1];
                    if($last_year==$final_year){
                        $no=$last_invoice+'0001';
                        $num_padded = sprintf("%04d", $no);
                        $final_invoice=$final_year."/".$num_padded;
                    }else{
                        $no='0001';
                        $final_invoice=$final_year."/".$no;
                    }
                    $insert_data["o_invoice_no"]=$final_invoice;
                }else{
                    $current_year=date('y');
                    $current_month=date('m');
                    if($current_month>=1 and $current_month<=3){
                        $temp_year=$current_year-1;
                        $final_year=$temp_year."-".$current_year;
                    }else{
                        $temp_year=$current_year+1;
                        $final_year=$current_year."-".$temp_year;
                    }
                    $no='0001';
                    $final_invoice=$final_year."/".$no;
                    $insert_data["o_invoice_no"]=$final_invoice;
                }
            }
            $insert_data["o_cust_id"]=$customer_id;
            $insert_data["o_discount_amount"]=$PostData['discount'];
            $insert_data["o_shipping_charge"]=$PostData['shipping'];
            $insert_data["o_sub_total"]=$PostData['sub_total'];
            $insert_data["o_tax"]=$PostData['tax'];
            $insert_data["o_grand_total"]=$PostData['total'];
            $insert_data["o_date"]=date('Y-m-d');
            $insert_data["o_name"]=$PostData['tca_name'];
            $insert_data["o_phone"]=$PostData['tca_phone'];
            $insert_data["o_email"]=$PostData['tca_email'];
            $insert_data["o_address"]=$PostData['tca_street_address'];
            $insert_data["o_address1"]=$PostData['tca_street_address1'];
            $insert_data["o_company_name"]=$PostData['tca_company_name'];
            $insert_data["o_town"]=$PostData['tca_town'];
            $insert_data["o_state"]=$PostData['tca_state'];
            $insert_data["o_postcode"]=$PostData['tca_postcode'];

            $insert_data["o_type"] = 1;
            $insert_data["o_resp_msg"] = $PaytmOrder['RESPMSG'];
            $insert_data["o_payment_note"] = "Success";
            $insert_data["o_paytm_id"] = $PaytmOrder['TXNID'];
            $insert_data["o_pay_gateway"] = $PaytmOrder['GATEWAYNAME'];
            $insert_data["o_order_id"] = $PaytmOrder['ORDERID'];

            $save_order=$this->db->insert('tbl_order',$insert_data);
            $insert_id = $this->db->insert_id();
            $this->session->set_userdata('order_id', $insert_id);
            $this->session->set_userdata('cust_id', $customer_id);
            $this->session->set_userdata('order_amount', $this->input->post('total'));
            $this->session->set_userdata('order_email', $this->input->post('tca_email'));
            $this->session->set_userdata('order_phone', $this->input->post('tca_phone'));



            if($save_order){
                foreach($cart_data as $cd){
                    if(isset($cd['tsm_size'])){
                        $size=$cd['tsm_size'];
                    }else{
                        $size="Regular";
                    }
                    if(isset($cd['tsm_size'])){
                        $color=$cd['tsm_size'];
                    }else{
                        $color="Regular";
                    }
                    $order_data=array(
                        "oi_order_id"=>$insert_id,
                        "oi_product_id"=>$cd['cr_product_id'],
                        "oi_product_name"=>$cd['tp_name'],
                        "oi_size_category"=>$cd['tp_size_category'],
                        "oi_size"=>$size,
                        "oi_color"=>$color,
                        "oi_qty"=>$cd['cr_qty'],
                        "oi_gst_type"=>$cd['cr_gst_type'],
                        "oi_gst_perce"=>$cd['cr_gst_perce'],
                        "oi_gst_amount"=>$cd['cr_gst_amount'],
                        "oi_mrp"=>$cd['cr_mrp'],
                        "oi_price"=>$cd['cr_price'],
                        "oi_amount"=>$cd['cr_amount']
                    );
                    $save_order_item=$this->db->insert('tbl_order_item',$order_data);
                }
                $response = ["status" => true, "message" => "Your order has been placed successfully."];

                $this->db->where('cr_cust_id',$customer_id);
                $this->db->delete('tbl_cart');

            }else{
                $response = ["status" => false, "message" => "Unable to place your order."];
            }
        }else{
            $response = ["status" => false, "message" => "Your cart is empty, Please add items to your cart."];
        }
    }
}

?>
