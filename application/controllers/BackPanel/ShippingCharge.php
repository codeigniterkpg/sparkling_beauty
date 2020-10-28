<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ShippingCharge extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $admin_data = $this->session->userdata('admin_data');
        if (empty($admin_data)) {
            redirect(base_url('BackPanel/Login'));
        }
    }


    public function index()
    {
        $exe = $this->db->get('tbl_shipping_charges');
        $data['List'] = $exe->result_array();
        $data['states'] = $this->db->get('tbl_state')->result();
        $this->load->view('BackPanel/manage_shipping_charge', $data);
    }

    public function Save()
    {
        $res = ["IsSuccess" => FALSE, "Message" => ""];
        $id = $this->input->post('sc_id');
        $state = $this->input->post('state');
        $shipping_charge = $this->input->post('shipping_charge');

        $this->load->library("form_validation");
        $this->form_validation->set_rules("state","State","required", array("required" => "State is required!."));
        $this->form_validation->set_rules("shipping_charge","Shipping Charge","required|numeric|greater_than[-1]", array("required" => "Shipping charge is required!.", "numeric    " => "Shipping Charge must be number only.","greater_than" => "Shipping Charge must be grater then or equal to 0"));

        if ($this->form_validation->run() == TRUE) {
            $this->db->where("state", $state);
            if ($id > 0) {
                $this->db->where("id<>", $id);
            }
            $check = $this->db->get("tbl_shipping_charges")->row();
            if (!empty($check)) {
                $res["Message"] = message_warning("Shipping Charge already set for this state please update it.");
            } else {
                $data = array(
                    "state" => $state,
                    "shipping_charge" => $shipping_charge
                );
                if ($id > 0) {
                    $this->db->where("id", $id);
                    $this->db->update("tbl_shipping_charges",$data);
                    $res["Message"] = message_success("Shipping charges updated.");
                } else {
                    $this->db->insert("tbl_shipping_charges",$data);
                    $res["Message"] = message_success("Shipping charges added.");
                }
                $res["IsSuccess"] = TRUE;
            }
        } else {
            $res["Errors"] = $this->form_validation->error_array();
        }
        echo json_encode($res);
    }


}
