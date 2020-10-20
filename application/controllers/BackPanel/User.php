<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$admin_data=$this->session->userdata('admin_data');
		if(empty($admin_data))
		{
			redirect(base_url('Login'));
		}	
	}
	public function index()
	{
		$this->load->view('view_user');
	}
	public function get_items()
	{
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));
	  $this->db->join('tbl_designation', 'tbl_designation.tds_id = tbl_users.u_designation_id', 'left');	
		$this->db->where('u_designation_id !=','1');
		$this->db->order_by('u_id','desc');
		$query=$this->db->get('tbl_users');
      
      $data = [];
      foreach($query->result_array() as $ul) {
		  if($ul['u_status']==1){ $check="checked";}else{ $check="";}
           $data[] = array(
				'<a href="'.base_url('uploads/user_profile/').$ul['u_image'].'" data-toggle="lightbox" data-title="'.$ul['u_name'].' ('.$ul['tds_title'].')" ><img style="width:75px;height:75px" class="img-fluid rounded-circle" src="'.base_url('uploads/user_profile/').$ul['u_image'].'"></img>',
                $ul['u_name'],
                $ul['tds_title'],
                $ul['u_email'],
                $ul['u_mobile'],
                '<div class="switch switch-success d-inline m-r-10">
					<input type="checkbox" id="switch-s-'.$ul['u_id'].'" '.$check.' onchange="change_status('.$ul['u_id'].','.$ul['u_status'].')">
					<label for="switch-s-'.$ul['u_id'].'" class="cr"></label>
				</div>',
				'<a href="'.base_url('User/EditUser/').md5($ul['u_id']).'" type="button" class="btn btn-glow-primary btn-primary" title="" data-toggle="tooltip">Edit</a>',
           );
      }
      $result = array(
               "draw" => $draw,
                 "recordsTotal" => $query->num_rows(),
                 "recordsFiltered" => $query->num_rows(),
                 "data" => $data
            );
      echo json_encode($result);
      exit();
   }
	public function CreateUser()
	{
		$data['DepartmentList']=$this->DepartmentList();
		$data['DesignationList']=$this->DesignationList();
		$this->load->view('create_user',$data);
	}
	public function CheckEmail()
	{
		$this->db->select('u_id');
		if($this->input->post("user_id")>0){
		$this->db->where('u_id !=',$this->input->post("user_id"));
		}
		$this->db->where('u_email',$this->input->post("email"));
		$exe=$this->db->get('tbl_users');
		
		if($exe->num_rows()>0){
			$data = ["status"=>false,"message"=> "A user with this email address already exists, please change email address."];
		}else{
			$data = ["status"=>true,"message"=> "success."];
		}
		echo json_encode($data);
	}
	public function CheckMobile()
	{
		$this->db->select('u_id');
		if($this->input->post("user_id")>0){
		$this->db->where('u_id !=',$this->input->post("user_id"));
		}
		$this->db->where('u_mobile',$this->input->post("mobile"));
		$exe=$this->db->get('tbl_users');
		
		if($exe->num_rows()>0){
			$data = ["status"=>false,"message"=> "A user with this mobile number already exists, please change mobile number."];
		}else{
			$data = ["status"=>true,"message"=> "success."];
		}
		echo json_encode($data);
	}
	public function AddUser()
	{
		$id=$this->input->post('user_id');
		$data = ["status"=>false,"message"=> "An unexpected error occurred."];
		if (!empty($_FILES['image_file']['name'])) 
			{
				$img_res=$this->upload('image_file','uploads/user_profile/',rand(000000,999999));
				if(isset($img_res['error']) && !empty($img_res['error']))
				{
					/* print_r($img_res['error']) */
					$data = ["status"=>false,"message"=>'An error has occurred while uploading image, please try again.'];
					echo json_encode($data);
					exit;
				}
				else
				{
					$image_file=$img_res;
				}
			}
			else
			{
				$image_file='';
			}
		/*-------------------Get Designation Dashboard Start---------------*/
		$this->db->select('tds_dashboard');
		$this->db->where('tds_id',$this->input->post('designation_select'));
		$exed=$this->db->get('tbl_designation');
		$data=$exed->result_array();
		if(!empty($data)){
			$dashboard_menu=$data[0]['tds_dashboard'];
		}else{
			$dashboard_menu='';
		}
		/*-------------------Get Designation Dashboard End---------------*/
		
		$insert_data=array(
							'u_name'=>$this->input->post('name'),
							'u_email'=>$this->input->post('email'),
							'u_mobile'=>$this->input->post('phone'),
							'u_mobile_alt'=>$this->input->post('phone_alt'),
							'u_department_id'=>$this->input->post('department_select'),
							'u_designation_id'=>$this->input->post('designation_select'),
							'u_address'=>$this->input->post('address_text'),
							'u_dashboard'=>$dashboard_menu
							);	
		if($id>0){
			if($image_file!=''){
				$insert_data['u_image']=$image_file;
			}
			$insert_data['u_modified_date']=date('Y-m-d H:i:s');
			$this->db->where('u_id',$id);
			$exe=$this->db->update('tbl_users',$insert_data);
			if($exe){
				$data = ["status"=>true,"message"=> "User account has been updated successfully."];
			}else{
				$data = ["status"=>false,"message"=> "An error has occurred while updating user account."];
			}
		}else{
			if($image_file!=''){
				$insert_data['u_image']=$image_file;
			}
			$insert_data['u_password']=md5($this->input->post('password'));
			$insert_data['u_created_date']=date('Y-m-d H:i:s');
			$exe=$this->db->insert('tbl_users',$insert_data);
			if($exe){
				$data = ["status"=>true,"message"=> "User account has been created successfully."];
			}else{
				$data = ["status"=>false,"message"=> "An error has occurred while creating user account."];
			}
		}
		
		echo json_encode($data);
	}
	public function upload($temp,$dir,$dfm)
	{
		
		$this->load->helper('date');
		$config['upload_path'] =$dir;
		$config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|PNG|JPEG';	
		$config['file_name'] = $dfm;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload($temp))
		{
			 $error = array('error' => $this->upload->display_errors());
			 return $error;
		}
		else
		{
				$upload_data = $this->upload->data();
				return $upload_data['file_name'];
		
		}
	}
	public function DepartmentList()
	{
		$exe=$this->db->get('tbl_department');
		return $data=$exe->result_array();
	}
	public function DesignationList()
	{
		$this->db->where('tds_id !=','1');
		$exe=$this->db->get('tbl_designation');
		return $data=$exe->result_array();
	}
	public function Lists()
	{
		$exe=$this->db->get('tbl_user');
		$category_data=$exe->result_array();
		foreach($category_data as $rowc){
			
			
			$var[] =array("u_id"=>$rowc['u_id'],
							"u_first_name"=>$rowc['u_first_name'],
							"u_last_name"=>$rowc['u_last_name'],
							"u_phone"=>$rowc['u_phone'],
							"u_email"=>$rowc['u_email'],
							"u_status"=>$rowc['u_status']
							);
		}
		$outp =array("status"=>"ok","users"=>$var);
		print_r(json_encode($outp));
	}
	public function EditUser($id=0)
	{
		$this->db->where('md5(u_id)',$id);
		$exe=$this->db->get('tbl_users USE INDEX(u_id)');
		$user_data=$exe->result_array();
		if(!empty($user_data)){
			$data['DepartmentList']=$this->DepartmentList();
			$data['DesignationList']=$this->DesignationList();
			$data['UserData']=$exe->result_array()[0];
			$this->load->view('create_user',$data);
		}else{
			redirect(base_url('User'));
		}
	}
	public function SingleData($id=0)
	{
		
		$this->db->where('c_id',$id);
		$exe=$this->db->get('tbl_category');
		$category_data=$exe->result_array();
		echo json_encode($category_data);
	}
	
	public function DeleteUser($id=0)
	{
		$this->db->where('u_id',$id);
		$exe=$this->db->delete('tbl_user');	
		if($exe){
			$response=array("status"=>1,"message"=>"User delete sucessfully..");
			print json_encode($response);
		}else{
			$response=array("status"=>0,"message"=>"An unexpected error occured!!");
			print json_encode($response);
		}
	}
	public function changeStatus()
	{
		
		if($this->input->post('id')>0){
			$update_data=array('u_status'=>$this->input->post('status'));
			$this->db->where("u_id",$this->input->post('id'));	
			$exe=$this->db->update('tbl_users',$update_data);
			if($exe){
				$response=array("status"=>true,"message"=>"User status changed sucessfully..");
				print json_encode($response);
			}else{
				$response=array("status"=>false,"message"=>"An error has occurred while changing user status.");
				print json_encode($response);
			}			
		}else{
			$response=array("status"=>false,"message"=>"An error has occurred while changing user status.");
			print json_encode($response);
		}
	}
}