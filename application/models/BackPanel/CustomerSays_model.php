<?php
header('Cache-Control: max-age=86400');
defined('BASEPATH') OR exit('No direct script access allowed');
class CustomerSays_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function save_slider_data()
    {
    	$id=$this->input->post('id');
    	$name=$this->input->post('name');
    	$tcs_desc=$this->input->post('desc');
		
		
	

		$update_data=array('tcs_name'=>$name,
							'tcs_desc'=>$tcs_desc
							);
		if($id>0)
		{
			$this->db->where("tcs_id=",$id);	
			$exe=$this->db->update('tbl_customer_say',$update_data);
			
			if($exe){
				$exe="2";
			}else{
				$exe="0";
			}
		}else{
			$exe=$this->db->insert('tbl_customer_say',$update_data);

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
		$this->db->from('tbl_customer_say');
        $query = $this->db->get();
     	 return $data=$query->result_array();
    }

    public function getSingleData($id=0)
	{

		$data=array();
		if($this->input->post('id')==true)

		$id=$this->input->post('id');
		$this->db->where("tcs_id",$id);
		$exe=$this->db->get('tbl_customer_say');
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
		
		
		$this->db->where('tcs_id',$id);
		return $exe=$this->db->delete('tbl_customer_say');	   
	}
} 

?>