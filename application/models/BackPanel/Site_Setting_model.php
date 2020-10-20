<?php
header('Cache-Control: max-age=86400');
defined('BASEPATH') OR exit('No direct script access allowed');
class Site_Setting_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }    
    public function getSingleData()
	{
		$data=array();		
		$exe=$this->db->get('tbl_site_setting');
		$data=$exe->result_array();
		if($exe->num_rows()>0)
		{
			return $data[0];
		}
		else
		{
			return $data;
		}
	}

	public function site_setting_update($image,$fimage)
	{

		$fetch_data=$this->db->get('tbl_site_setting');
		$data=$fetch_data->result_array();
		$id = $data[0]['ts_id'];
		
		$name = $this->input->post('name');
		$address = $this->input->post('address');
		$email = $this->input->post('email');
		$email1 = $this->input->post('email1');
		$mobile = $this->input->post('mobile');		
		$phone = $this->input->post('phone');		
		$title = $this->input->post('title');		
		$description = $this->input->post('description');			
		$facebook = $this->input->post('facebook');
		$utube = $this->input->post('utube');
		$twitter = $this->input->post('twitter');
		$instagram = $this->input->post('instagram'); 
		$jd = $this->input->post('jd'); 
		
		if($image==''){
			
            $image=$this->input->post('image1');
        }
		
		if($fimage==''){
			
            $fimage=$this->input->post('fimage1');
        }
		
		$update_data=array('ts_name'=>$name,
							'ts_address'=>$address,
							'ts_email'=>$email,
							'ts_email1'=>$email1,
							'ts_mobile'=>$mobile,							
							'ts_phone'=>$phone,							
							'ts_image'=>$image,
							'ts_fimage'=>$fimage,
							'ts_title'=>$title,
							'ts_description'=>$description,
							'ts_facebook'=>$facebook,
							'ts_utube'=>$utube,
							'ts_twitter'=>$twitter,
							'ts_instagram'=>$instagram,				
							'ts_jd'=>$jd
							);
	
			$this->db->where("ts_id",$id);	
			$exe=$this->db->update('tbl_site_setting',$update_data);
			
			if($exe){
				$exe="1";
			}else{
				$exe="0";
			}
		
		return $exe;
	}
	
}
?>