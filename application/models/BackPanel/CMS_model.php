<?php
header('Cache-Control: max-age=86400');
defined('BASEPATH') OR exit('No direct script access allowed');
class CMS_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_cms()
    {
		$this->db->order_by('cms_id','desc');
        $q = $this->db->get('tbl_cms');
        return $q->result_array();
    }
    
	public function save_cms_data($image){
		$curr=date('Y-m-d H:i:s');
		$id=$this->input->post('id');
		$name=$this->input->post('title');
		$url_key=$this->input->post('url_key');
		$description=$this->input->post('description');
		if($image==''){
            $image=$this->input->post('image1');
        }
		$update_data=array('cms_title'=>$name,  
							'cms_description'=>$description,
							'cms_url'=>$url_key,
							'cms_image'=>$image,
							);
		if($id>0)
		{
			$this->db->where("cms_id !=",$id);
			$this->db->where("cms_url",$url_key);
			$exe=$this->db->get('tbl_cms');
			$num=$exe->num_rows();
		
			if($exe->num_rows()>0){
				$exe="3";
			}
			else
			{
			$this->db->where("cms_id=",$id);	
			$exe=$this->db->update('tbl_cms',$update_data);
			if($exe){
				$exe="2";
			}else{
				$exe="0";
			}
			}
		}else{
			
			$this->db->where("cms_url",$url_key);
			$exe=$this->db->get('tbl_cms');
			$num=$exe->num_rows();
		
			if($exe->num_rows()>0){
				$exe="3";
			}
			else
			{
				$exe=$this->db->insert('tbl_cms',$update_data);
				if($exe){
					$exe="1";
				}else{
					$exe="0";
				}
			}
		}
		return $exe;
	}
	
	// get single category data
	public function getSingleData($id=0)
	{
		$data=array();
		if($this->input->post('id')==true)
		$id=$this->input->post('id');
		$this->db->where("cms_id",$id);
		$exe=$this->db->get('tbl_cms');
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
	
	public function Delete_cms($id)
	{
		$this->db->where('cms_id',$id);

		$exe=$this->db->get('tbl_cms');

		$data=$exe->result_array();

		if($exe->num_rows()>0) 

		{

			@unlink('uploads/cms/'.$data[0]['cms_image']);

		}
		$this->db->where('cms_id',$id);
		return $exe=$this->db->delete('tbl_cms');	   
	}
	
	public function Edit_order($id,$dorder)
	{
		$update_data=array('cat_dis_order'=>$dorder,
							);
							
		$this->db->where("cms_id",$id);	
		$exe=$this->db->update('tbl_cms',$update_data);
		if($exe){
			$exe="2";				
		}else{
			$exe="0";
		}
		return $exe;		  
	}
}