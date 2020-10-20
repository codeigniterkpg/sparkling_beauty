<!DOCTYPE html>
<html lang="en">
<head>

    <title>Sparkling Beauty | Add Product</title>
    <?php include("header.php"); ?>

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ breadcrumb ] start -->
                            <div class="page-header">
                                <div class="page-block">
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <div class="page-header-title">
                                                <h5 class="m-b-10">Product</h5>
                                            </div>
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item"><a
                                                            href="<?php echo base_url('BackPanel'); ?>"><i
                                                                class="feather icon-home"></i></a></li>
                                                <li class="breadcrumb-item"><a href="javascript:void(0);">Add
                                                        Product</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- [ form-element ] start -->
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Product</h5>
                                        </div>
                                        <div class="card-body">
                                            <form id="myForm" enctype="multipart/form-data" method="POST"
                                                  onSubmit="return form_submit();" data-parsley-validate novalidate>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleSelect1">Select Category</label>
                                                            <select class="form-control" name="category" id="category"
                                                                    data-placeholder="Choose a Category" tabindex="1">
                                                                <option value=''>Select Category</option>
                                                                <?php echo isset($Category) ? $Category : ''; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Product Name</label>
                                                            <input type="text" id="name"
                                                                   oninput="write_urlkey(this.value)" required
                                                                   name="name"
                                                                   value="<?php if (isset($Product_Detail['tp_id'])) {
                                                                       echo $Product_Detail['tp_name'];
                                                                   } else {
                                                                   } ?>" class="form-control">
                                                            <input type="hidden" id="id" name="id"
                                                                   value="<?php if (isset($Product_Detail['tp_id'])) {
                                                                       echo $Product_Detail['tp_id'];
                                                                   } else {
                                                                   } ?>"/>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">SKU</label>
                                                            <input type="text" id="sku" required name="sku"
                                                                   value="<?php if (isset($Product_Detail['tp_id'])) {
                                                                       echo $Product_Detail['tp_sku'];
                                                                   } else {
                                                                   } ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputname">URL Keyword</label>
                                                            <input type="text" id="url_key" required name="url_key"
                                                                   value="<?php if (isset($Product_Detail['tp_id'])) {
                                                                       echo $Product_Detail['tp_slug'];
                                                                   } else {
                                                                   } ?>" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputname">Short Description</label>
                                                            <textarea class="form-control" name="desc"
                                                                      id="desc"><?php if (isset($Product_Detail['tp_id'])) {
                                                                    echo $Product_Detail['tp_desc'];
                                                                } else {
                                                                } ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputname">Long Description</label>
                                                            <textarea class="form-control" name="ldesc"
                                                                      id="ldesc"><?php if (isset($Product_Detail['tp_id'])) {
                                                                    echo $Product_Detail['tp_long_desc'];
                                                                } else {
                                                                } ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputname">Important Notice Box</label>
                                                            <textarea class="form-control" name="ImportantNoticeBox"
                                                                      id="ImportantNoticeBox"><?php if (isset($Product_Detail['tp_id'])) {
                                                                    echo $Product_Detail['tp_ImportantNoticeBox'];
                                                                } else {
                                                                } ?></textarea>
                                                        </div>
                                                    </div>

                                                    <!--<div class="col-md-6">
													<div class="form-group">
														<label for="exampleInputname">GST Type</label>
														<select class="form-control" name="gst_type" id="gst_type">
															<option <?php /*if(isset($Product_Detail['tp_id'])){ if($Product_Detail['tp_gst_type']==1){ echo "selected";}}*/ ?> value="1">Excluding</option>
															<option <?php /*if(isset($Product_Detail['tp_id'])){ if($Product_Detail['tp_gst_type']==2){ echo "selected";}}*/ ?> value="2">Including</option>
														</select>
													</div>
												</div>-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputname">GST in (%)</label>
                                                            <input type="text" id="gst_perce" required name="gst_perce"
                                                                   value="<?php if (isset($Product_Detail['tp_id'])) {
                                                                       echo $Product_Detail['tp_gst_perce'];
                                                                   } else {
                                                                   } ?>" class="prices form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <!--<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Fabric</label>
                                                            <input type="text" id="fabric" name="fabric"
                                                                   value="<?php /*if (isset($Product_Detail['tp_id'])) {
                                                                       echo $Product_Detail['tp_fabric'];
                                                                   } else {
                                                                   } */?>" class="form-control">
                                                        </div>
                                                    </div>-->
                                                    <!--<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputname">Select Attraction</label>
                                                            <select class="form-control" name="attraction"
                                                                    id="attraction">
                                                                <option value="0">Select Attraction</option>
                                                                <option <?php /*if (isset($Product_Detail['tp_id'])) {
                                                                    if ($Product_Detail['tp_attraction'] == 1) {
                                                                        echo "selected";
                                                                    }
                                                                } */?> value="1">New Fashion Style
                                                                </option>
                                                                <option <?php /*if (isset($Product_Detail['tp_id'])) {
                                                                    if ($Product_Detail['tp_attraction'] == 2) {
                                                                        echo "selected";
                                                                    }
                                                                } */?> value="2">Premium Seller
                                                                </option>
                                                                <option <?php /*if (isset($Product_Detail['tp_id'])) {
                                                                    if ($Product_Detail['tp_attraction'] == 3) {
                                                                        echo "selected";
                                                                    }
                                                                } */?> value="3">Tradition
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>-->
                                                    <!--<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputname">Shipping Type</label>
                                                            <select class="form-control" required name="shipping_type"
                                                                    id="shipping_type">
                                                                <option <?php /*if (isset($Product_Detail['tp_id'])) {
                                                                    if ($Product_Detail['tp_shipping_type'] == 0) {
                                                                        echo "selected";
                                                                    }
                                                                } */?> value="0">Free
                                                                </option>
                                                                <option <?php /*if (isset($Product_Detail['tp_id'])) {
                                                                    if ($Product_Detail['tp_shipping_type'] == 1) {
                                                                        echo "selected";
                                                                    }
                                                                } */?> value="1">Paid
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputname">Shipping Charge</label>
                                                            <input type="text" id="shipping_charge" required
                                                                   name="shipping_charge"
                                                                   value="<?php if (isset($Product_Detail['tp_id'])) {
                                                                       echo $Product_Detail['tp_shipping_amount'];
                                                                   } else {
                                                                   } ?>" class="prices form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Product Image</label>
                                                            <input name="image[]" id="image" type="file"
                                                                   class="form-control" multiple/>
                                                        </div>

                                                        <?php if (isset($Product_Detail['tp_id'])) { ?>
                                                            <div class="col-md-4">
                                                                <table>
                                                                    <?php
                                                                    if (sizeof($ProductImages) > 0) {
                                                                        $cnt = 0;
                                                                        foreach ($ProductImages as $pi) {
                                                                            if ($cnt % 3 == 0) {
                                                                                ?>
                                                                                <tr>
                                                                            <?php } ?>
                                                                            <td>
                                                                                <img style="width:100px;margin-right:5px;"
                                                                                     class="img-responsive"
                                                                                     src="<?php echo base_url('uploads/product/') . $pi['tpi_image']; ?>"
                                                                                     alt=""> <br/>
                                                                                <center><a href="javascript:void(0);"
                                                                                           onclick="removeimg('<?php echo $pi['tpi_id']; ?>',this)"
                                                                                           title="Delete"><p
                                                                                                style="margin-bottom:5px;color:red;">
                                                                                            <i class="fa fa-times-circle"
                                                                                               aria-hidden="true"></i>
                                                                                        </p></a></center>
                                                                            </td>
                                                                            <?php $cnt++;
                                                                            if ($cnt % 3 == 0) { ?>
                                                                                </tr>
                                                                            <?php }
                                                                        }
                                                                    } ?>
                                                                </table>
                                                            </div>
                                                        <?php } ?>
                                                    </div>


                                                    <div class="col-md-12 m-t-30">
                                                        <h5>Pricing Color wise</h5>
                                                        <hr>
                                                        <span id="size_div">
														<?php if (isset($Product_Detail['tp_id'])) {
                                                            echo $ProductSizes['size_data'];
                                                        } ?>
													</span>
                                                    </div>
                                                    <input type="hidden" id="cnt" name="cnt"
                                                           value="<?php if (isset($Product_Detail['tp_id'])) {
                                                               echo $ProductSizes['size_cnt'];
                                                           } else {
                                                               echo "0";
                                                           } ?>"/>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <?php include("footer.php"); ?>
    <script src="<?php echo base_url('assets/js/jquery.form.js'); ?>"></script>
    <script>
        function write_urlkey(urlkey) {
            $("#url_key").val(urlkey);
        }

        number_valid();

        function number_valid() {
            $(".prices").keypress(function (e) {
                if (e.which != 8 && e.which != 46 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });
        }

        function getSizeList() {
            var size_id = $("#size_category").val();
            if (size_id > 0) {
                $("#size_div").empty();
                $("#cnt").val("0");
                showload();
                var cnt = $("#cnt").val();
                var final_cnt = parseInt(cnt) + 1;
                $("#cnt").val(final_cnt);
                $.ajax({
                    url: "<?php echo base_url('BackPanel/Product/getCategorySizeList');?>",
                    type: "post",
                    data: {size_id: size_id, cnt: final_cnt},
                    success: function (d) {
                        hideload();
                        $("#size_div").prepend(d);
                        number_valid();
                        $("#price_div").hide();
                    }
                });
            } else {
                $("#size_div").empty();
                $("#cnt").val("0");
            }
        }

        /* ------------ Add New Elements Start------------------ */
        let UriSegment = "<?php echo $this->uri->segment(3)?>";
        if (UriSegment === 'AddProduct' || UriSegment === 'edit') {
            add_new_div();
        }
        function add_new_div() {

            var cnt = $("#cnt").val();
            var final_cnt = parseInt(cnt) + 1;
            $("#cnt").val(final_cnt);
            $.ajax({
                url: "<?php echo base_url('BackPanel/Product/getCategorySizeList');?>",
                type: "post",
                data: {cnt: final_cnt},
                beforeSend: function () {
                    showload();
                },
                success: function (d) {
                    hideload();
                    $("#size_div").prepend(d);
                    number_valid();
                }
            });
        }

        function remove_div(id) {
            var elem = document.getElementById('add' + id);
            elem.parentNode.removeChild(elem);
            var cnt = $("#cnt").val();
            var final_cnt = parseInt(cnt) - 1;
            $("#cnt").val(final_cnt);

            return false;
        }

        /* ------------ Add New Elements End ---------------------*/

        function form_submit() {
            return false;
        }

        function showRequest() {
        }

        function showResponse(data) {
            hideload();
            if (data.status == 1) {

                custom_notify('Product Added Successfully', "success");
                location.reload();
            } else if (data.status == 2) {
                custom_notify('Product Updated Successfully', "success");
                window.location.href = "<?php echo base_url('BackPanel/Product');?>";
            } else if (data.status == 3) {

                custom_notify('Product URL Keyword Already Exists', "info");
            } else if (data.status == 0) {

                custom_notify('An error has been occurred while performing this action', "danger");
            }

        }

        $(document).ready(function () {
            var options = {
                url: '<?php echo base_url('BackPanel/Product/SaveProduct');?>',
                beforeSubmit: showRequest,
                dataType: "json",
                success: showResponse

            };
            $('#myForm').submit(function () {
                showload();

                var isFormValid = validation();
                if (isFormValid) {
                    $(this).ajaxSubmit(options);
                } else {
                    hideload();
                    isFormValid = true;
                    custom_notify('Some Important Fields Are Empty!!!', "warning");
                    //$.notify("Some Important Fields Are Empty!!!","error",{ position:"top-center" });
                }
                return false;
            });
        });

        function validation() {
            var isformValid = true;
            /*Chacking validations Start here*/
            if ($("#category").val() == "") {
                isformValid = false;
                $("#category").closest('.form-group').addClass('has-error');
                $('#category').focus();
            }
            if ($("#name").val() == "") {
                isformValid = false;
                $("#name").closest('.form-group').addClass('has-error');
                $('#name').focus();
            }
            if ($("#sku").val() == "") {
                isformValid = false;
                $("#sku").closest('.form-group').addClass('has-error');
                $('#sku').focus();
            }
            if ($("#desc").val() == "") {
                isformValid = false;
                $("#desc").closest('.form-group').addClass('has-error');
                $('#desc').focus();
            }

            if ($("#size_category").val() == "") {
                isformValid = false;
                $("#size_category").closest('.form-group').addClass('has-error');
                $('#size_category').focus();
            }
            /*Chacking validations End here*/
            return isformValid;
        }


        // initialize the validator function

        function removeimg(id, t) {
            var info = 'id=' + id;

            if (confirm("Are you sure you want to delete this?")) {
                showload();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('BackPanel/Product/RemoveProductImage');?>",
                    data: info,
                    success: function () {
                        hideload();
                        custom_notify('Image Remove Successfully.', "success");

                        $(t).closest("td").remove();


                    }
                });

            }
        }

        /*--::__Getting GST percentage by category == START__::--*/
        $(document).on("change","#category", function() {
            let $this = $(this);
            let val = $this.val();
            let gst_perce = $("#gst_perce");
            if (val !== "") {
                $.ajax({
                   url : "<?php echo base_url('BackPanel/Product/getGSTPercentageByCategory');?>",
                   type : "POST",
                   data : { category_id : val},
                   dataType : "JSON",
                    success:function(Response) {
                        gst_perce.val(Response.cat_GSTPercentage);
                    }
                });
            } else {
                gst_perce.val("0");
            }
        });
        /*--::__Getting GST percentage by category == STOP__::--*/

    </script>
    </body>

</html>