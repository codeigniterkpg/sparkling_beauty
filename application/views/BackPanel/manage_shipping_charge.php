<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sparkling Beauty | Shipping Charge</title>
    <?php include("header.php"); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
                                                <h5 class="m-b-10">Shipping Charge</h5>
                                            </div>
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item"><a
                                                            href="<?php echo base_url('BackPanel'); ?>"><i
                                                                class="feather icon-home"></i></a></li>
                                                <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Shipping
                                                        Charge</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Column Rendering table start -->
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Manage Shipping Charge</h5>
                                            <button style="float:right" id="add-shipping-charge" class="btn btn-primary">
                                                Add New
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive dt-responsive">
                                                <table id="datatable" class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                    <tr>
                                                        <th>State</th>
                                                        <th>Shipping Charge <code>in <i
                                                                        class="fa fa-rupee-sign"></i></code></th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($List as $lt) { ?>
                                                        <tr>
                                                            <td><?php echo $lt['state']; ?></td>
                                                            <td>
                                                                <?php echo $lt['shipping_charge']; ?>
                                                            </td>
                                                            <td><a class="text-success btn-link"
                                                                   href="javascript:void(0);"
                                                                   onclick="show_modal(<?php echo $lt['id']; ?>,
                                                                           '<?php echo $lt['state']; ?>','<?php echo $lt['shipping_charge']; ?>'
                                                                           )">
                                                                    <i class="fa fa-edit icon-white"></i>
                                                                </a></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>State</th>
                                                        <th>Shipping Charge <code>in <i
                                                                        class="fa fa-rupee-sign"></i></code></th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column Rendering table end -->
                            </div>
                            <div class="modal fade" id="myModal" role="dialog"
                                 aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Shipping Charge</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="cg_form" data-parsley-validate novalidate>
                                            <div class="modal-body">
                                                <fieldset class="form-group">
                                                    <div id="message"></div>
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <label for="state">State <span class="text-danger">*</span></label>
                                                    <select id="state" name="state" class="form-control">
                                                        <?php if (isset($states) && !empty($states)): ?>
                                                            <?php foreach ($states as $state): ?>
                                                                <option value="<?= $state->state ?>"><?= $state->state ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <label for="shipping_charge">Shipping Charge <span
                                                                class="text-danger">*</span></label>
                                                    <input required type="text" class="form-control"
                                                           id="shipping_charge" name="shipping_charge">
                                                </fieldset>
                                                <input type="hidden" class="form-control" id="sc_id" name="sc_id">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" id="submit_btn" class="btn btn-primary">Save
                                                </button>
                                            </div>
                                        </form>
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="<?php echo base_url(''); ?>assets/js/pages/form-advance-custom.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#datatable').DataTable({
                ordering: false
            });
            table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        $("#cg_form").submit(function (e) {
            e.preventDefault();
            let $form = $(this);
            let $submitButton = $form.find("[type='submit']");
            let $message = $form.find("#message");
            let $submitText = $submitButton.html();
            $.ajax({
                url: "<?php echo base_url('BackPanel/ShippingCharge/Save');?>",
                type: "post",
                data: $("#cg_form").serialize(),
                dataType:"JSON",
                beforeSend:function () {
                    showload();
                    $submitButton.prop("disabled", true);
                    $submitButton.html("<i class='fa fa-spinner fa-spin'></i>");
                },
                success: function (Response) {
                    hideload();
                    $submitButton.prop("disabled", false);
                    $submitButton.html($submitText);
                    $message.html(Response.Message);
                    $(".error").remove();
                    if (Response.IsSuccess === true) {
                        setTimeout(function() {
                            window.location.reload();
                        },1500);
                    } else {
                        if (typeof Response.Errors != 'undefined') {
                            $.each(Response.Errors, function (Ele, Error) {
                                $Element=$("#"+Ele);
                                $Element.closest(".form-group").append("<label class='error text-danger'>"+Error+"</label>");
                                console.log($Element);
                            });
                        }
                    }
                }
            });
        });
        function validation() {
            var isformValid = true;
            /*Chacking validations Start here*/
            if ($("#title").val() == "") {
                isformValid = false;
                $("#title").closest('.form-control').addClass('parsley-error');
                $('#title').focus();
            }
            /*Chacking validations End here*/
            return isformValid;
        }

        function show_modal(Id, State, ShippingCharge) {
            let $model = $("#myModal");
            $("#exampleModalLabel").html('Update Shipping Charge');
            $("#submit_btn").html('Update');
            $("#sc_id").val(Id);
            $("#state").val(State).trigger("change");
            $("#shipping_charge").val(ShippingCharge);
            $model.modal("show");
        }

        $(document).on("click", "#add-shipping-charge", function() {
            let $model = $("#myModal");
            $("#exampleModalLabel").html('Add Shipping Charge');
            $("#submit_btn").html('Add');
            $("#sc_id").val(0);
            $("#state").val("").trigger("change");
            $("#shipping_charge").val("");
            $model.modal("show");
        });
        $("#state").select2({
            dropdownParent: $("#myModal")
        });
    </script>
    </body>
</html>