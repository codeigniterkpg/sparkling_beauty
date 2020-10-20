<?php  
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function login()
	{
		$customer_data=$this->session->userdata('customer_data');
        if(!empty($customer_data)){
			$this->db->where('tc_id',$customer_data[0]['tc_id']);
			$exe=$this->db->get('tbl_customer');
			$data['Profile']=$exe->result_array();
			
			$this->db->where('tca_customer_id',$customer_data[0]['tc_id']);
			$exe=$this->db->get('tbl_customer_address');
			$data['Address']=$exe->result_array();
			
			$this->db->where('o_cust_id',$customer_data[0]['tc_id']);
			$this->db->order_by('o_id','desc');
			$exe=$this->db->get('tbl_order');
			$data['Orders']=$exe->result_array();
			$this->load->view('my-account',$data);
		}else{
			$this->load->view('login');
		}
	}
	public function register()
	{
		$this->load->view('register');
	}
	public function CheckEmail()
    {
		$customer_data=$this->session->userdata('customer_data');
		if(!empty($customer_data)){
			$this->db->where('tc_id !=', $customer_data[0]['tc_id']);
		}
        $this->db->select('tc_id');

        $this->db->where('tc_email', $this->input->post("email"));
        $exe = $this->db->get('tbl_customer');

        if ($exe->num_rows() > 0) {
            $data = ["status" => false, "message" => "A user with this email address already exists, please change email address."];
        } else {
            $data = ["status" => true, "message" => "success."];
        }
        echo json_encode($data);
    }	public function MyOrders(){		$customer_data=$this->session->userdata('customer_data');        if(!empty($customer_data)){			$this->db->where('o_cust_id',$customer_data[0]['tc_id']);			$this->db->order_by('o_id','desc');			$this->db->limit('30','0');			$exe=$this->db->get('tbl_order');			$data['Orders']=$exe->result_array();			$this->load->view('my-orders',$data);		}else{			$this->load->view('my-account');		}	}
	public function logout()
	{
		$this->session->unset_userdata('customer_data','');
		$this->session->unset_userdata('previous_url','');
		redirect(base_url('my-account'));
	}
	public function SaveCustomer()
    {
        $insert_data = array("tc_name" => $this->input->post('uname'),
            "tc_email" => $this->input->post('email'),
            "tc_mobile" => $this->input->post('mobile'),
            "tc_password" => $this->input->post('password'));

        $exe = $this->db->insert('tbl_customer', $insert_data);
        if ($exe) {
            
            $data = ["status" => true, "message" => "Thank you for registering with us."];
        } else {
            $data = ["status" => false, "message" => "An unexpected error was occurred while registeing your details."];
        }
        echo json_encode($data);
    }
	public function UpdateCustomer()
    {
		
        $insert_data = array("tc_name" => $this->input->post('uname'),
            "tc_email" => $this->input->post('email'),
            "tc_mobile" => $this->input->post('mobile'),
            "tc_whats_app_number" => $this->input->post('whats_app_number'),
            );
		$customer_data=$this->session->userdata('customer_data');
		if(!empty($customer_data)){
			$this->db->where('tc_id', $customer_data[0]['tc_id']);
		}
        $exe = $this->db->update('tbl_customer', $insert_data);
        if ($exe) {
            
            $data = ["status" => true, "message" => "Your profile has been updated."];
        } else {
            $data = ["status" => false, "message" => "An unexpected error was occurred while updating your details."];
        }
        echo json_encode($data);
    }
	public function UpdateCustomerAddress()
    {
		$customer_data=$this->session->userdata('customer_data');
        $insert_data = array("tca_name" => $this->input->post('tca_name'),
            "tca_customer_id" => $customer_data[0]['tc_id'],
            "tca_company_name" => $this->input->post('tca_company_name'),
            "tca_street_address" => $this->input->post('tca_street_address'),
            "tca_street_address1" => $this->input->post('tca_street_address1'),
            "tca_landmark" => $this->input->post('tca_landmark'),
            "tca_town" => $this->input->post('tca_town'),
            "tca_state" => $this->input->post('tca_state'),
            "tca_postcode" => $this->input->post('tca_postcode'),
            "tca_phone" => $this->input->post('tca_phone'),
            "tca_email" => $this->input->post('tca_email'));
		
		if($this->input->post('add_id')>0){
			$this->db->where('tca_id',$this->input->post('add_id'));
			$exe = $this->db->update('tbl_customer_address', $insert_data);
		}else{
			$exe = $this->db->insert('tbl_customer_address', $insert_data);
		}
		if ($exe) {
			
			$data = ["status" => true, "message" => "Your address has been updated."];
		} else {
			$data = ["status" => false, "message" => "An unexpected error was occurred while updating your address."];
		}
        echo json_encode($data);
    }
	public function Profile(){
		$data["CountryLists"] = $this->CountryLists();
		$data["StateLists"] = $this->StateListsEdit($this->session->userdata('dealer_data')[0]['d_country']);
		$data["CityLists"] = $this->CityListsEdit($this->session->userdata('dealer_data')[0]['d_state']);
		$this->load->view('profile',$data);
	}
	public function check_login()
	{
		$this->db->where('tc_password', $this->input->post('password'));
		$where = '(tc_email="' . $this->input->post('email') . '" or tc_name = "' . $this->input->post('email') . '")';
        $this->db->where($where);
		$exe=$this->db->get_where('tbl_customer');
		
		$admin_data=$exe->result_array();
		if(!empty($admin_data)){
			if($admin_data[0]['tc_status']==1){
																			
				if($this->session->userdata('guest_id')){	
					$this->db->where('cr_cust_id',$admin_data[0]['tc_id']);					
					$exe1=$this->db->delete('tbl_cart');	
					$customer_id=$this->session->userdata('guest_id');							
					$update_data=array("cr_cust_id"=>$admin_data[0]['tc_id']);							
					$this->db->where('cr_cust_id',$customer_id);							
					$exe2=$this->db->update('tbl_cart',$update_data);						
				}										
				$this->session->set_userdata('customer_data', $admin_data);
				$response = ["status" => true, "message" => "Login Successfully."];
			}else{
				$response = ["status" => false, "message" => "Your account not active yet."];
			}
		}else{
			$response = ["status" => false, "message" => "Please check your login credentials."];
		} 
		
		echo json_encode($response);
	}
	public function ForgotPassword(){
		$this->load->view('forgot-pass');
	}
	public function CheckEmailPass()
    {
		
        $this->db->select('tc_id');
        $this->db->where('tc_email', $this->input->post("email"));
        $exe = $this->db->get('tbl_customer');

        if ($exe->num_rows() > 0) {
			$token=md5($this->input->post("email").$exe->result_array()[0]['tc_id']);
			$this->db->where('tc_id', $exe->result_array()[0]['tc_id']);
			$this->db->update('tbl_customer',array("tc_token"=>$token));
			$link=base_url('create-password/').$token;
			/*------------Send Email--------------*/
            $this->load->library('email');
			$config = Array(
				'protocol' => 'smtp', 
				'smtp_host' => 'mail.sparklingbeauty.in', 
				'smtp_port' => 587, 
				'smtp_user' => 'no-reply@sparklingbeauty.in', 
				'smtp_pass' => 'G;7ed(]rPF8S', 
				'mailtype' => 'html', 
				'charset' => 'iso-8859-1', 
				'newline' => '\r\n', 
				'wordwrap' => TRUE,);
            
            
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from($config['smtp_user'], "Sparkling Beauty");
            $this->email->to($this->input->post("email"));
            $this->email->subject('Sparkling - Forgot Password');
            $this->email->message("Hello,<br>We send you create new password link, please click below link.<br><br><a href='".$link."'>Create New Password</a><br><br>Sparkling Beauty");
            if ($this->email->send()) {
                echo "";
            } else {
                //show_error($this->email->print_debugger());
            }            /*------------Send Email--------------*/
            $data = ["status" => true, "message" => "Please check your email inbox/spam for create new password link."];
        } else {
            $data = ["status" => false, "message" => "Email address not register,please try again!!"];
        }
        echo json_encode($data);
    }
	public function ForgotPasswordCheck($token){
		$this->db->select('tc_id');
        $this->db->where('tc_token', $token);
        $exe = $this->db->get('tbl_customer');
		if ($exe->num_rows() > 0) {
			$data['id']=$exe->result_array()[0]['tc_id'];
			$this->load->view('forgot-pass-change',$data);
		}else{
			redirect(base_url('lost-password'));
		}
	}
	public function ForgotPassUpdate(){
		$up_array=array("tc_password"=>$this->input->post('pwd'));
		$this->db->where('tc_id', $this->input->post('id'));
        $exe = $this->db->update('tbl_customer',$up_array);
		if($exe){
			$data = ["status" => true, "message" => "Your password has been changed."];
        } else {
            $data = ["status" => false, "message" => "Unable to change your password,please try again!!"];
        }
        echo json_encode($data);
	}
	public function ChangePassword(){
		$this->load->view('change-password');
	}
	public function ChangePassUpdate(){
		$customer_data=$this->session->userdata('customer_data');
		$this->db->select('tc_id');
        $this->db->where('tc_id', $customer_data[0]['tc_id']);
        $this->db->where('tc_password', $this->input->post('oldpwd'));
        $exe = $this->db->get('tbl_customer');
		if ($exe->num_rows() > 0) {
			$up_array=array("tc_password"=>$this->input->post('pwd'));
			$this->db->where('tc_id', $customer_data[0]['tc_id']);
			$exe = $this->db->update('tbl_customer',$up_array);
			if($exe){
				$data = ["status" => true, "message" => "Your password has been changed."];
			} else {
				$data = ["status" => false, "message" => "Unable to change your password,please try again!!"];
			}
		}else{
			$data = ["status" => false, "message" => "Old password not matched with our record!!"];
		}
		echo json_encode($data);
	}
}
?>