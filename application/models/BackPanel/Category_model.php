<?php
header('Cache-Control: max-age=86400');
defined('BASEPATH') OR exit('No direct script access allowed');
class Category_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getCategory()
    {
        $this->db->where('cat_status', '1');
        $q = $this->db->get('tbl_category');
        return $q->result_array();
    }
    public function category_menu()
    {
		/* $this->db->where('cat_status', '1'); */
        $query = $this->db->get('tbl_category');
       
        $cat   = array(
            'items' => array(),
            'parents' => array()
        );
        foreach ($query->result() as $cats) {
            $cat['items'][$cats->cat_id]            = $cats;
            $cat['parents'][$cats->cat_subcat_id][] = $cats->cat_id;
        }
        if ($cat) {
            $result = $this->build_category_menu(0, $cat);
            return $result;
        } else {
            return FALSE;
        }
    }
    function build_category_menu($parent, $menu)
    {
        $html = "";
        if (isset($menu['parents'][$parent])) {
            static $a = 0;
            $pusher     = "&nbsp;-&nbsp;";
            $showPusher = str_repeat($pusher, $a);
            foreach ($menu['parents'][$parent] as $itemId) {
				if($menu['items'][$itemId]->cat_status==1){ $checked='checked';}else{ $checked='';}
                $html .= "<tr>";
                $a++;
                $html .= "<td>" . $showPusher . $menu['items'][$itemId]->cat_name . "</td>
				<td ><div class='switch switch-success d-inline m-r-10'>
					<input type='checkbox' id='switch-s-1".$menu['items'][$itemId]->cat_id."' value='".$menu['items'][$itemId]->cat_status."' onchange='change_status(".$menu['items'][$itemId]->cat_id.",this.value,this)' ".$checked.">
					<label for='switch-s-1".$menu['items'][$itemId]->cat_id."' class='cr'></label>
				</div><a class='btn btn-success' href='" .base_url("BackPanel/Category/Edit_category/"). $menu['items'][$itemId]->cat_id . "'><i class='fa fa-edit icon-white'></i></a>
				<a class='btn btn-danger' href='#' onclick='delete_data(" . $menu['items'][$itemId]->cat_id . ",this)'><i class='fa fa-trash icon-white'></i></a></td>";
                $html .= $this->build_category_menu($itemId, $menu);
                $html .= "</tr>";
                $a--;
            }
        }
        return $html;
    }
	/*-----------when Add Category start---------------*/
	public function category_menu_add()
    {
		$this->db->where('cat_status', '1');
        $query = $this->db->get('tbl_category');
       
        $cat   = array(
            'items' => array(),
            'parents' => array()
        );
        foreach ($query->result() as $cats) {
            $cat['items'][$cats->cat_id]            = $cats;
            $cat['parents'][$cats->cat_subcat_id][] = $cats->cat_id;
        }
        if ($cat) {
            $result = $this->build_category_menu_add(0, $cat);
            return $result;
        } else {
            return FALSE;
        }
    }
    function build_category_menu_add($parent, $menu)
    {
        $html = "";
        if (isset($menu['parents'][$parent])) {
            static $a = 0;
            $pusher     = "&nbsp;-&nbsp;";
            $showPusher = str_repeat($pusher, $a);
			$this->db->where('cat_id=',$this->uri->segment('4'));
			$query1 = $this->db->get('tbl_category');
			$dat=$query1->result_array();
            
            foreach ($menu['parents'][$parent] as $itemId) { 
				if($this->uri->segment('4')){
					
					if($dat[0]['cat_subcat_id']==$menu['items'][$itemId]->cat_id){ $sel='selected="select"';}else{ $sel=''; }
					
					$a++;
					$html .= "<option ".$sel." value=".$menu['items'][$itemId]->cat_id.">" . $showPusher . $menu['items'][$itemId]->cat_name . "</option>";
					$html .= $this->build_category_menu_add($itemId, $menu);
					$a--;
				}else{
                $a++;
                $html .= "<option value=".$menu['items'][$itemId]->cat_id.">" . $showPusher . $menu['items'][$itemId]->cat_name . "</option>";
                $html .= $this->build_category_menu_add($itemId, $menu);
                $a--;
				}

            }
        }
        return $html;
    }
	/*-----------when Add Category end---------------*/
	public function save_category_data($images){
		$curr=date('Y-m-d H:i:s');
		$id=$this->input->post('id');
		$name=$this->input->post('cname');
		$par_id=$this->input->post('category');
		$image1=$this->input->post('image1');

		$HSNCode        = $this->input->post('HSNCode');
		$GSTPercentage  = $this->input->post('GSTPercentage');

		$url_key=url_title($this->input->post('url_key'), 'dash', true);
		if($images==''){
			$images=$image1;
		}
		
		$update_data=array('cat_name'=>$name,
							'cat_icon'=>$images,
							'cat_url_keyword' => $url_key,
							'cat_subcat_id' => $par_id,
							'cat_HSNCode' => !empty($HSNCode) ? $HSNCode : '',
							'cat_GSTPercentage' => !empty($GSTPercentage) ? $GSTPercentage : '',
							'cat_status'=>'1'
							);
		if($id>0)
		{
			$this->db->where("cat_url_keyword",$url_key);
			$this->db->where("cat_id !=",$id);
			$exe1=$this->db->get('tbl_category');
			$num=$exe1->num_rows();
			if($exe1->num_rows()>0){
				$exe="3";
			}
			else
			{
				$this->db->where("cat_id",$id);	
				$exe=$this->db->update('tbl_category',$update_data);
				if($exe){
					$exe="2";
				}else{
					$exe="0";
				}
			}
		}else{
		
			$this->db->where("cat_url_keyword",$url_key);
			$exe1=$this->db->get('tbl_category');
			$num=$exe1->num_rows();
		
			if($exe1->num_rows()>0){
				$exe="3";
			}
			else
			{
				$exe=$this->db->insert('tbl_category',$update_data);
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
		$this->db->where("cat_id",$id);
		$exe=$this->db->get('tbl_category');
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
	public function getdata($id){
		$this->db->where("cat_subcat_id",$id);
		$exe=$this->db->get('tbl_category');
		$data=$exe->result_array();
		return $data;
	}
	public function getdataproduct($id){
		$this->db->where("tp_category_id",$id);
		$exe=$this->db->get('tbl_product');
		$data=$exe->result_array();
		return $data;
	}
	public function Delete_category($id)
	{
		$this->db->where('cat_id',$id);
		return $exe=$this->db->delete('tbl_category');	   
	}
}