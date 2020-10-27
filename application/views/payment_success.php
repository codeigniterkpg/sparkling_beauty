<?php include("header.php"); ?>
<!-- Page Content Wraper -->
<div class="page-content-wraper">
    <!-- Bread Crumb -->
    <section class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="breadcrumb-link">
                        <a href="<?php echo base_url(); ?>">Home</a>
                        <span>Payment Success</span>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Bread Crumb -->
    <!-- Page Content -->
    <section class="content-page">
        <div class="container">
            <div class="row">
                <?php

                $pay_stt = '';
                if (isset($pay) && !empty($pay)) {
                    $post_data = $pay;
                    if ($post_data["STATUS"] == "TXN_SUCCESS") {
                        echo $pay_stt = "<center><h3><i class='fa fa-check'></i> Payment success</h3></center>" . "<br/>";
                        $this->db->where('o_invoice_no !=', '');
                        $this->db->order_by('o_id', 'desc');
                        $this->db->limit('1');
                        $exe_inv = $this->db->get('tbl_order');
                        $data_inv = $exe_inv->result_array();
                        if (!empty($data_inv)) {
                            $current_year = date('y');
                            $current_month = date('m');
                            if ($current_month >= 1 and $current_month <= 3) {
                                $temp_year = $current_year - 1;
                                $final_year = $temp_year . "-" . $current_year;
                            } else {
                                $temp_year = $current_year + 1;
                                $final_year = $current_year . "-" . $temp_year;
                            }
                            $inv = $data_inv[0]['o_invoice_no'];
                            $exp_inv = explode('/', $inv);
                            $last_year = $exp_inv[0];
                            $last_invoice = $exp_inv[1];
                            if ($last_year == $final_year) {
                                $no = $last_invoice + '0001';
                                $num_padded = sprintf("%04d", $no);
                                $final_invoice = $final_year . "/" . $num_padded;
                            } else {
                                $no = '0001';
                                $final_invoice = $final_year . "/" . $no;
                            }
                            $up_data = array("o_payment_status" => 1, "o_invoice_no" => $final_invoice);
                            $this->db->where('o_id', $post_data["ORDERID"]);
                            $exe = $this->db->update('tbl_order', $up_data);
                        } else {
                            $current_year = date('y');
                            $current_month = date('m');
                            if ($current_month >= 1 and $current_month <= 3) {
                                $temp_year = $current_year - 1;
                                $final_year = $temp_year . "-" . $current_year;
                            } else {
                                $temp_year = $current_year + 1;
                                $final_year = $current_year . "-" . $temp_year;
                            }
                            $no = '0001';
                            $final_invoice = $final_year . "/" . $no;
                            $up_data = array("o_payment_status" => 1, "o_invoice_no" => $final_invoice);
                            $this->db->where('o_id', $post_data["ORDERID"]);
                            $exe = $this->db->update('tbl_order', $up_data);
                        }

                        echo "<table class='table-bordered table'>";
                        if (isset($post_data) && count($post_data) > 0) {
                            foreach ($post_data as $paramName => $paramValue) {
                                if (!in_array($paramName, array('CHECKSUMHASH','BANKTXNID','STATUS', 'MID', 'RESPMSG')))
                                echo "<tr><td><b>" . $paramName . "</b> </td><td> " . $paramValue . "</td></tr>";
                            }
                        }
                        echo "</table>";

                    }

                }

                /*$this->db->where('o_id', $post_data["ORDERID"]);
                $exe1 = $this->db->update('tbl_order', $up_data1);*/
                /* echo $this->db->last_query();  */
//                $this->session->unset_userdata('order_id', '');
                $this->session->unset_userdata('order_amount', '');
                $this->session->unset_userdata('order_email', '');
                $this->session->unset_userdata('order_phone', '');
                ?>
            </div>
            <div class="row">
                <div class="cart-btn-group">
                    <a href="<?php echo base_url('my-orders'); ?>" class="submit btn btn-md btn-color">View Order
                        History</a>
                    <!--<input type="submit" name="update" class="btn-nixx number-font" value="Update Cart">-->
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Content -->

</div>
<!-- End Page Content Wraper -->
<?php include("footer.php"); ?>
