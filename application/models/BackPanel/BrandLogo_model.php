<?php
header('Cache-Control: max-age=86400');
defined('BASEPATH') OR exit('No direct script access allowed');
class BrandLogo_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function save_slider_data($image)
    {
    	$id=$this->input->post('id');
		
		if($image=='')
		{
			$image=$this->input->post('image1');
		}else{
			if($id>0){
				$image1=$this->input->post('image1');
				$path = FCPATH . "/uploads/brand_logo/".$image1 ;
				if($image1!=''){
					if(file_exists($path)) {
						unlink($path);
					}
				}
			}
		}
	

		$update_data=array('tbl_image'=>$image
							);
		if($id>0)
		{
			$this->db->where("tbl_id=",$id);	
			$exe=$this->db->update('tbl_brand_logo',$update_data);
			
			if($exe){
				$exe="2";
			}else{
				$exe="0";
			}
		}else{
			$exe=$this->db->insert('tbl_brand_logo',$update_data);

			if($exe){
				$exe="1";
			}else{
				$exe="0";
			}
		}
		return $exe;
    }

    public function slider_list()
    {

		$this->db->select('*');
		$this->db->from('tbl_brand_logo');
        $query = $this->db->get();
     	 return $data=$query->result_array();
    }

    public function getSingleData($id=0)
	{

		$data=array();
		if($this->input->post('id')==true)

		$id=$this->input->post('id');
		$this->db->where("tbl_id",$id);
		$exe=$this->db->get('tbl_brand_logo');
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

	public function Delete_slider($id)
	{
		
		$this->db->where('tbl_id',$id);
		$exe=$this->db->get('tbl_brand_logo');
		$data=$exe->result_array();
		$image=$data[0]['tbl_image'];
		$path = FCPATH . "/uploads/brand_logo/".$image ;
		if($image!=''){
			if(file_exists($path)) {
				unlink($path);
			}
		}
		$this->db->where('tbl_id',$id);
		return $exe=$this->db->delete('tbl_brand_logo');	   
	}
} 

?>