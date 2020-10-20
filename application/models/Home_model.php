<?php
header('Cache-Control: max-age=86400');
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_model extends CI_Model
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
	public function getMenu($main_id,$main_url){
		$this->db->where('cat_status', '1');
		$this->db->where('cat_subcat_id', $main_id);
        $q = $this->db->get('tbl_category');
		$data=$q->result_array();
		foreach($data as $dt){
			echo '<li class="nav-dropdown-grid">
					<h6><a href="'.base_url('product-category/').$main_url.'/'.$dt['cat_url_keyword'].'">'.$dt["cat_name"].'</a></h6>';
					$this->getSubMenu($dt['cat_id'],$main_url,$dt['cat_url_keyword']);
				echo '</li>';
		}
	}
	public function getSubMenu($id,$main_url,$sub_url){
		$this->db->where('cat_status', '1');
		$this->db->where('cat_subcat_id', $id);
        $q = $this->db->get('tbl_category');
		$data=$q->result_array();
		if(sizeof($data)>0){
			echo '<ul>';
				foreach($data as $dt){
					echo '<li><a href="'.base_url('product-category/').$main_url.'/'.$sub_url.'/'.$dt['cat_url_keyword'].'">'.$dt['cat_name'].'</a></li>';
					
				}
			echo '</ul>';
		}
	}
	/* <ul class="nav-dropdown js-nav-dropdown">
		<li class="container">
			<ul class="row">
				<li class="nav-dropdown-grid">
					<h6>New In</h6>
					<ul>
						<li><a href="#">New In Clothing</a></li>
						<li><a href="#">New In Shoes<span class="new-label">New</span></a></li>
						<li><a href="#">New In Bags</a></li>
						<li><a href="#">New In Watches</a></li>
						<li><a href="#">New In Accesories</a></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul> */
}