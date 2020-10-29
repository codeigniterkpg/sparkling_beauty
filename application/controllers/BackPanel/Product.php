<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $admin_data = $this->session->userdata('admin_data');
        if (empty($admin_data)) {
            redirect(base_url('BackPanel/Login'));
        }
        $this->load->model('BackPanel/Category_model');
    }

    public function AddProduct()
    {
        $data['Category'] = $this->category_menu_add();
        $data['SizeCategory'] = $this->SizeCategoryList();
        $this->load->view('BackPanel/add_product', $data);
    }

    function edit($id = null)
    {
        if ($id != null) {
            $sql = "SELECT * FROM tbl_product WHERE md5(tp_id)='" . $id . "'";
            $res = $this->db->query($sql);
            if ($res->num_rows() > 0) {
                $data['Product_Detail'] = $res->result_array()[0];
                $data['Category'] = $this->category_menu_add();
                $data['ProductImages'] = $this->getProImages($id);
                $data['ProductSizes'] = $this->getCategorySizeListEdit($id);
                $data['SizeCategory'] = $this->SizeCategoryList();
                $this->load->view("BackPanel/add_product", $data);
            }
        }
    }

    public function getProImages($id)
    {
        $this->db->where('md5(tpi_product_id)', $id);
        $exe = $this->db->get('tbl_product_image');
        return $exe->result_array();
    }

    public function SizeCategoryList()
    {
        $this->db->where('tsc_status', 1);
        $exe = $this->db->get('tbl_size_category');
        return $exe->result_array();
    }

    public function getCategorySizeList()
    {

        $cnt = $this->input->post('cnt');
        $exec = $this->db->get('tbl_color');
        $data_color = $exec->result_array();
        $html = '<div class="row" id="add' . $cnt . '">';

        $html .= '<div class="form-group col-md-2">
						<label for="exampleInputname">Color</label>
						<select class="form-control" name="color[]" id="color">
							<option value="0">Select Color</option>';
        foreach ($data_color as $dtc) {
            $html .= '<option value="' . $dtc['tclr_id'] . '">' . $dtc['tclr_title'] . '</option>';
        }
        $html .= '</select></div>';


        $html .= '<div class="form-group col-md-2">
						<label for="exampleInputname">Weight <span class="text-danger">(In Kg)</span></label>
						<input class="form-control" name="weight[]" id="weight" value="1">
					</div>';

        $html .= '<div class="form-group col-md-2">
						<label>Quantity</label>
						<input class="form-control" name="quantity[]" id="quantity" value="1">
					</div>';
        $html .= '
					<div class="form-group col-md-2">
						<label for="exampleInputname">Price</label>
						<input name="price[]" id="price[]" type="text" placeholder="Price" class="form-control prices"/>
					</div>
					<div class="form-group col-md-2">
						<label>Promotion Price</label>
						<input name="promotion_price[]" id="promotion_price[]" type="text" placeholder="Promotion Price" class="form-control"/>
					</div>
					<div class="form-group col-md-1 " style="display: none;">
						<label for="exampleInputname"></label><br>';
        if ($cnt == 1) {
            $html .= '<input type="button" class="btn btn-success" onclick="add_new_div()" value="+"/>';
        } else {
            $html .= '<input type="button" class="btn btn-danger" onclick="remove_div(' . $cnt . ')" value="-"/>';
        }
        $html .= '</div>
				</div>';
        echo $html;
    }

    public function getCategorySizeListEdit($id)
    {
        $exec = $this->db->get('tbl_color');
        $data_color = $exec->result_array();

        $this->db->where('md5(tpd_product_id)', $id);
        $exed = $this->db->get('tbl_product_data');
        $data = $exed->result_array();
        $html = '';
        $cnt = 1;
        $len = count($data);
        foreach ($data as $dts) {
            $html .= '<div class="row" id="add' . $cnt . '">';
            $html .= '<div class="form-group col-md-2">
						<label for="exampleInputname">Color</label>
						<select class="form-control" name="color[]" id="color">
							<option value="0">Select Color</option>';
            foreach ($data_color as $dtc) {
                $sel2 = '';
                if ($dtc["tclr_id"] == $dts['tpd_color_id']) {
                    $sel2 = "selected";
                }
                $html .= '<option ' . $sel2 . ' value="' . $dtc['tclr_id'] . '">' . $dtc['tclr_title'] . '</option>';
            }
            $html .= '</select></div>';



					$html .= '<div class="form-group col-md-2">
						<label for="exampleInputname">Weight <span class="text-danger">(In Kg)</span></label>
						<input class="form-control" name="weight[]" id="weight" value="' . $dts['tpd_weight'] . '">
					</div>';

            $html .= '<div class="form-group col-md-2">
						<label>Quantity</label>
						<input class="form-control" name="quantity[]" id="quantity" value="' . $dts['tpd_qty'] . '">
					</div>';


            $html .= '
					<div class="form-group col-md-2">
						<label for="exampleInputname">Price</label>
						<input name="price[]" id="price[]" type="text" placeholder="Price" value="' . $dts['tpd_price'] . '" class="form-control prices"/>
					</div>
					<div class="form-group col-md-2">
						<label>Promotion Price</label>
						<input name="promotion_price[]" id="promotion_price" type="text" placeholder="Promotion Price" class="form-control" value="' . $dts['promotion_price'] . '"/>
					</div>
					<div class="form-group col-md-1" style="display: none;">
						<label for="exampleInputname"></label><br>';
            if ($cnt == $len) {
                $html .= '<input type="button" class="btn btn-success" onclick="add_new_div()" value="+"/>';
            } else {
                $html .= '<input type="button" class="btn btn-danger" onclick="remove_div(' . $cnt . ')" value="-"/>';
            }

            $html .= '</div>
				</div>';
            $cnt++;
        }
        $response['size_data'] = $html;
        $response['size_cnt'] = sizeof($data);
        return $response;
    }

    public function index()
    {
        $this->load->view('BackPanel/manage_product');
    }

    function table()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $aaData = array();

        $resultSet = $this->_t_query(FALSE);
        $total_records = $this->_t_query(TRUE);


        $feild = array();
        if ($resultSet) {
            foreach ($resultSet as $item => $row) {
                if ($row['tp_status'] == '1') {
                    $status = "Active";
                    $chk = "<span style='color:green' id='span_" . $row['tp_id'] . "'>" . $status . "</span> <input id='chk_" . $row['tp_id'] . "' type='checkbox' checked='checked' onclick='changeStatus(" . $row['tp_id'] . ")' value='0'>";
                } else {
                    $status = "DeActive";
                    $chk = "<span style='color:red' id='span_" . $row['tp_id'] . "'>" . $status . "</span> <input id='chk_" . $row['tp_id'] . "' type='checkbox' onclick='changeStatus(" . $row['tp_id'] . ")' value='1'>";
                }


                $feild['DT_RowId'] = 'tr_' . $row['tp_id'];
                $feild['DT_RowClass'] = 'sp5';
                $feild['no'] = "<label class='label label-success'>" . ($item + 1) . "</label> ";
                $feild['name'] = $row['tp_name'];
                $feild['category'] = $row['cat_name'];
                $feild['sku'] = $row['tp_sku'];
                $feild['status'] = $chk;
                $feild['action'] = '<a href="' . base_url("BackPanel/Product/edit/" . md5($row['tp_id']) . "/" . $row['tp_category_id']) . '" class="btn btn-primary btn-sm text-white" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>';

                $aaData[] = $feild;
            }
        }

        $finalJsonArray['sEcho'] = $_POST['sEcho'] ? $_POST['sEcho'] : 1;
        $finalJsonArray['iTotalRecords'] = $total_records;
        $finalJsonArray['iTotalDisplayRecords'] = $total_records;
        $finalJsonArray['aaData'] = $aaData;
        echo json_encode($finalJsonArray);
    }

    function _t_query($bool = FALSE)
    {

        $start = isset($_POST['iDisplayStart']) ? $_POST['iDisplayStart'] : 0;
        $limit = isset($_POST['iDisplayLength']) ? $_POST['iDisplayLength'] : 5;

        /*Query start*/
        $this->db->select("*");
        $this->db->join("tbl_category", "tbl_category.cat_id=tbl_product.tp_category_id");
        if (isset($_POST["sSearch"]) && !empty($_POST["sSearch"])) {
            $search = $_POST["sSearch"];
            $this->db->like('tp_name', $search);
            $this->db->or_like('tp_sku', $search);
            $this->db->or_like('cat_name', $search);
        }

        $this->db->from("tbl_product");

        if (isset($_POST['iSortingCols']) && isset($_POST['sSortDir_0'])) {
            $fields = ["tp_id", "tp_name"];
            $this->db->order_by($fields[$_POST['iSortingCols']], $_POST['sSortDir_0']);
        }
        $this->db->order_by("tp_id", "DESC");

        if ($bool == TRUE) {
            $query = $this->db->get();
            return $query->num_rows();
        } else {
            $this->db->limit($limit, $start);
            $query = $this->db->get();
            return $query->result_array();
        }
    }


    public function CategoryList()
    {

        $this->db->where('cat_status', 1);
        $exe = $this->db->get('tbl_category');
        return $data = $exe->result_array();

    }

    public function ChangeStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $this->db->where('tp_id', $id);
        $data['tp_status'] = $status;
        $exe = $this->db->update('tbl_product', $data);
        if ($exe) {
            $response = array("status" => 1);
        } else {
            $response = array("status" => 0);
        }

        print json_encode($response);

    }

    public function SaveProduct()
    {

        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $name = $this->input->post('name');
        $shipping_type = true ? 1 : $this->input->post('shipping_type');
        $shipping_charge = $this->input->post('shipping_charge');
        $sku = $this->input->post('sku');
        $url_key = url_title($this->input->post('url_key'), 'dash', true);
        $fabric = true ? '' : $this->input->post('fabric');
        $desc = $this->input->post('desc');
        $ldesc = $this->input->post('ldesc');
        $ImportantNoticeBox = $this->input->post('ImportantNoticeBox');
        $gst_type = $this->input->post('gst_type');
        $gst_perce = $this->input->post('gst_perce');
        $attraction = $this->input->post('attraction');
        $gst_type = (is_null($gst_type) || empty($gst_type) ) ? 1 : 2;


        $update_data = array('tp_category_id' => $category,
            'tp_sku' => $sku,
            'tp_shipping_type' => $shipping_type,
            'tp_shipping_amount' => $shipping_charge,
            'tp_fabric' => $fabric,
            'tp_name' => $name,
            'tp_desc' => $desc,
            'tp_long_desc' => $ldesc,
            'tp_ImportantNoticeBox' => !empty($ImportantNoticeBox) ? $ImportantNoticeBox : '',
            'tp_gst_type' => !empty($gst_type) ? $gst_type : '',
            'tp_gst_perce' => $gst_perce,
            'tp_attraction' => true ? null : $attraction,
            'tp_slug' => $url_key
        );
        if ($id > 0) {
            $this->db->where("tp_slug", $url_key);
            $this->db->where("tp_id !=", $id);
            $exe1 = $this->db->get('tbl_product');
            $num = $exe1->num_rows();

            if ($exe1->num_rows() > 0) {
                $response = array("status" => 3, "message" => "Product URL Keyword already exists..");
                print json_encode($response);
            } else {
                $this->db->where("tp_id", $id);
                $exe = $this->db->update('tbl_product', $update_data);

                if ($exe) {
                    if (!empty($_FILES['image'])) {
                        /*---------Upload Image start------------*/
                        if (!empty($_FILES['image'])) {
                            $path       = FCPATH . "uploads/product/";
                            $type       = "*";
                            $file_name  = "image";

                            $images = multiUploadFile($path, $type, $file_name);

                            if (is_array($images) && !empty($images)) {
                                $i_array = array();
                                foreach ($images as $imgName) {
                                    $i_array[] = array(
                                        'tpi_product_id' => $id,
                                        'tpi_image' => $imgName
                                    );
                                }
                                $this->db->insert_batch('tbl_product_image', $i_array);
                            }
                        }
                        /*---------Upload Image end------------*/
                    }
                    $this->db->where('tpd_product_id', $id);
                    $this->db->delete('tbl_product_data');
                    $promotion_price = $this->input->post('promotion_price');
                    $weight = $this->input->post('weight');
                    $quantity = $this->input->post('quantity');
                    $color = $this->input->post('color');
                    $price = $this->input->post('price');
                    $size_array = array();
                    if(!empty($weight)) {
                        for ($i = 0; $i < count($weight); $i++) {
                            $size_array[$i]['tpd_product_id'] = $id;
                            $size_array[$i]['tpd_weight'] = $weight[$i];
                            $size_array[$i]['tpd_qty'] = $quantity[$i];
                            $size_array[$i]['tpd_color_id'] = $color[$i];
                            $size_array[$i]['tpd_price'] = $price[$i];
                            $size_array[$i]['tpd_gst_type'] = $gst_type;
                            $size_array[$i]['tpd_gst_perce'] = $gst_perce;
                            $size_array[$i]['promotion_price'] = $promotion_price[$i];
                            $size_array[$i]['tpd_gst_amount'] = round(intval($price[$i]) * $gst_perce / 100);
                        }
                        if (!empty($size_array)) {
                            $this->db->insert_batch('tbl_product_data', $size_array);
                        }
                    }


                    $response = array("status" => 2, "message" => "Product update successfully..");
                    print json_encode($response);
                } else {
                    $response = array("status" => 0, "message" => "An unexpected error occur!!");
                    print json_encode($response);
                }
            }
        } else {
            $this->db->where("tp_slug", $url_key);
            $exe1 = $this->db->get('tbl_product');
            $num = $exe1->num_rows();

            if ($exe1->num_rows() > 0) {
                $response = array("status" => 3, "message" => "Product URL Keyword already exists..");
                print json_encode($response);
            } else {
                $update_data['tp_status'] = 1;
                $exe = $this->db->insert('tbl_product', $update_data);
                $insert_product_id = $this->db->insert_id();
                if ($exe) {
                    /*---------Upload Image start------------*/
                    if (!empty($_FILES['image'])) {
                        $path       = FCPATH . "uploads/product/";
                        $type       = "*";
                        $file_name  = "image";

                        $images = multiUploadFile($path, $type, $file_name);
                        if (is_array($images) && !empty($images)) {
                            $i_array = array();
                            foreach ($images as $imgName) {
                                $i_array[] = array(
                                    'tpi_product_id' => $insert_product_id,
                                    'tpi_image' => $imgName
                                );
                            }
                            $this->db->insert_batch('tbl_product_image', $i_array);
                        }
                    }
                    /*---------Upload Image end------------*/
                    $promotion_price = $this->input->post('promotion_price');
                    $weight = $this->input->post('weight');
                    $quantity = $this->input->post('quantity');
                    $color = $this->input->post('color');
                    $price = $this->input->post('price');
                    if (sizeof($weight) > 0) {
                        $size_array = array();
                        for ($i = 0; $i < sizeof($weight); $i++) {
                            $size_array[$i]['tpd_product_id'] = $insert_product_id;
                            $size_array[$i]['promotion_price'] = $promotion_price[$i];
                            $size_array[$i]['tpd_weight'] = $weight[$i];
                            $size_array[$i]['tpd_qty'] = $quantity[$i];
                            $size_array[$i]['tpd_color_id'] = $color[$i];
                            $size_array[$i]['tpd_price'] = $price[$i];
                        }
                        $this->db->insert_batch('tbl_product_data', $size_array);
                    }
                    $response = array("status" => 1, "message" => "Product Added sucessfully..");
                    print json_encode($response);
                } else {
                    $response = array("status" => 0, "message" => "An unexpected error occured!!");
                    print json_encode($response);
                }
            }
        }
    }

    public function upload($temp, $dir, $dfm)
    {
        $this->load->helper('date');
        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|PNG|JPEG';
        $config['file_name'] = $dfm;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($temp)) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $upload_data = $this->upload->data();
            return $upload_data['file_name'];
        }
    }

    private function upload_files($title, $files, $ids)
    {

        $images = array();

        foreach ($files['name'] as $index => $image_name) {
            $_FILES['product_image']['name']      = $files['name'][$index];
            $_FILES['product_image']['type']      = $files['type'][$index];
            $_FILES['product_image']['tmp_name']  = $files['tmp_name'][$index];
            $_FILES['product_image']['error']     = $files['error'][$index];
            $_FILES['product_image']['size']      = $files['size'][$index];

            $config['upload_path']      = './uploads/product/';
            $config['allowed_types']    = 'gif|jpg|png';
            $config['max_size']         = '2048';
            $config['max_width']        = '1024';
            $config['max_height']       = '768';
            $this->load->library('upload', $config);
            $ext_array                  = explode(".",$image_name);
            $fileName                   = time() . '_product_image.' . end($ext_array);
            $config['file_name']        = $fileName;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                echo $this->upload->display_errors();
                echo $fileName;
            } else {
                $images[] = $fileName;
                echo $fileName;
                $update_data2 = array(
                    'tpi_product_id' => $ids,
                    'tpi_image' => $this->upload->data()['file_name']
                );
                $this->db->insert('tbl_product_image', $update_data2);
            }
        }
        return $images;
    }

    public function category_menu_add()
    {
        $this->db->where('cat_status', '1');
        $query = $this->db->get('tbl_category');

        $cat = array(
            'items' => array(),
            'parents' => array()
        );
        foreach ($query->result() as $cats) {
            $cat['items'][$cats->cat_id] = $cats;
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
            $pusher = "&nbsp;-&nbsp;";
            $showPusher = str_repeat($pusher, $a);
            $this->db->where('cat_id=', $this->uri->segment('5'));
            $query1 = $this->db->get('tbl_category');
            $dat = $query1->result_array();
            foreach ($menu['parents'][$parent] as $itemId) {
                if ($this->uri->segment('5')) {
                    if ($dat[0]['cat_id'] == $menu['items'][$itemId]->cat_id) {
                        $sel = 'selected="select"';
                    } else {
                        $sel = '';
                    }
                    $a++;
                    $html .= "<option " . $sel . " value=" . $menu['items'][$itemId]->cat_id . ">" . $showPusher . $menu['items'][$itemId]->cat_name . "</option>";
                    $html .= $this->build_category_menu_add($itemId, $menu);
                    $a--;
                } else {
                    $a++;
                    $html .= "<option value=" . $menu['items'][$itemId]->cat_id . ">" . $showPusher . $menu['items'][$itemId]->cat_name . "</option>";
                    $html .= $this->build_category_menu_add($itemId, $menu);
                    $a--;
                }

            }
        }
        return $html;
    }

    public function RemoveProductImage()
    {
        $id = $this->input->post('id');
        $this->db->where('tpi_id', $id);
        $exe = $this->db->get('tbl_product_image');
        $data = $exe->result_array();
        $image = $data[0]['tpi_image'];
        if ($image != '') {

            $path = FCPATH . "/uploads/product/" . $image;
            if ($image != '') {
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $id = $this->input->post('id');
        $this->db->where('tpi_id', $id);
        return $exe = $this->db->delete('tbl_product_image');
    }

    /*
     * USE : using this function we are getting GST percentage by the category id
     * METHOD : POST
     * RETURN : JSON
     * */
    public function getGSTPercentageByCategory()
    {
        $category_id = $this->input->post("category_id");
        $CategoryObject = $this->db->select("cat_GSTPercentage")->where("cat_id", $category_id)->get("tbl_category")->row();
        if (empty($CategoryObject)) {
            $CategoryObject = new stdClass();
            $CategoryObject->cat_GSTPercentage = 0;
        }
        echo json_encode($CategoryObject);
    }
}