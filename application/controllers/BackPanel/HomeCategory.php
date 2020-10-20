<?php header('Cache-Control: max-age=86400');
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeCategory extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$admin_data=$this->session->userdata('admin_data');
		if(empty($admin_data))
		{
			redirect(base_url('BackPanel/Login'));
		}	
		$this->load->model('BackPanel/Category_model');
	}
	
	public function index()
	{ 
		$this->db->join("tbl_category","tbl_category.cat_id=tbl_home_category.thc_cat_id");
		$exe=$this->db->get('tbl_home_category');
		$data['List']=$exe->result_array();
		$this->load->view('BackPanel/manage_home_category',$data);
	}
	public function AddHomeCategory()
	{
		$data['Category']=$this->category_menu_add();
		$this->load->view('BackPanel/add_home_category',$data);
	}
	
	public function Add_HomeCategory()
	{
		if (!empty($_FILES['image']['name'])) 
			{
				
				
				$img_res=$this->upload('image','uploads/home_category/',$_FILES['image']['name']);
				
				if(isset($img_res['error']) && !empty($img_res['error']))
				{
					echo $img_res['error'];	
					exit;
					
				}
				else
				{
					$images=$img_res;
				}
			}
			else
			{
				$images='';
			}
			if($images!='')
			{
				@unlink('uploads/home_category/'.$this->input->post('image1'));
			}
			if($images==''){
				$images=$this->input->post('image1');
			}
			$seq=$this->input->post('seq');
			$category=$this->input->post('category');
			$id=$this->input->post('id');
			$insert_data=array("thc_cat_id"=>$category,"thc_image"=>$images,"thc_seq"=>$seq);
			if($id>0){
				$this->db->where('thc_id !=',$id);
				$this->db->where('thc_seq',$seq);
				$e1=$this->db->get('tbl_home_category');
				if(sizeof($e1->result_array())>0){
					echo "4";
				}else{
					$this->db->where('thc_id',$id);
					$exe=$this->db->update('tbl_home_category',$insert_data);
					if($exe){
						echo "2";
					}else{
						echo "0";
					}
				}
			}else{
				$e=$this->db->get('tbl_home_category');
				if(sizeof($e->result_array())<4){
					$this->db->where('thc_seq',$seq);
					$e1=$this->db->get('tbl_home_category');
					if(sizeof($e1->result_array())>0){
						echo "4";
					}else{
						$exe=$this->db->insert('tbl_home_category',$insert_data);
						if($exe){
							echo "1";
						}else{
							echo "0";
						}
					}
				}else{
					echo "3";
				}
			}
	}
	public function upload($temp,$dir,$dfm)
	{
		$this->load->helper('date');
		$config['upload_path'] =$dir;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';	
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
	// for add/edit b news view
	public function Edit_HomeCategory($id=0)
	{
		$data=array();
		if($id>0)
		{
			$data['Category']=$this->category_menu_add();
			$data['Detail']=$this->getSingleData($id);
		}
		$this->load->view('BackPanel/add_home_category',$data);
	}
	public function getSingleData($id){
		$this->db->where('thc_id',$id);
		$exe=$this->db->get('tbl_home_category');
		if(sizeof($exe->result_array())>0){
			return $exe->result_array()[0];
		}else{
			return array();
		}
	}
	public function DeleteHomeCategory()
	{
		
	    $id=$this->input->get_post('id');
			$this->db->where('thc_id',$id);
			$exe=$this->db->delete('tbl_home_category');
			if($exe)
			{
				echo "1";
			}
			else
			{
				echo "0";
			} 
		
		
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
			$this->db->where('cat_id=',$this->uri->segment('5'));
			$query1 = $this->db->get('tbl_category');
			$dat=$query1->result_array();
            
            foreach ($menu['parents'][$parent] as $itemId) { 
				if($this->uri->segment('5')){
					
					if($dat[0]['cat_id']==$menu['items'][$itemId]->cat_id){ $sel='selected="select"';}else{ $sel=''; }
					
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
}
