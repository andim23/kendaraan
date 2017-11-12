<?php
	$x = $this->input->get('x');
?>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <?php $this->load->view('pages/include/breadcrumb') ?>
        <!-- END PAGE HEADER-->

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">                              
                <!-- Begin: life time stats -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            Form Perawatan
                        </div>
                        
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <?php include('form.php'); ?>
                        </div>
                    </div>
                </div>
                <!-- End: life time stats -->
            </div>
        </div>
    </div>
</div>

<script>
	$(document).ready(function(e) {
        $(".status").select2();
    });
	

    $("#save-btn").click(function (e) {
        alert('Under Cons')
		return false;
		$("#form").submit();
    });

    $("#form").submit(function (e) {
        // prevent default action
        e.preventDefault();
        $("#save-btn").text('Menyimpan data ....').attr("disabled", "disabled");
        var url = $(this).attr("action");
        var data = $("#form").serialize();
        $.ajax({
            cache: false,
            type: "post",
            url: url,
            data: data,
            success: function (response) {
                $("#save-btn").text("Simpan").removeAttr("disabled");
                var data = JSON.parse(response);
                var status = data.status;
                var message = data.message;
                if (status == '1') {
                    $('#modal_form').modal('hide')
                    grid.getDataTable().ajax.reload();
                } else {
                    $.each(data.message, function (key, value) {
                        var element = $('#form #' + key);
                        console.log(element)
                        element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger')
                                .remove();

                        element.after(value);
                    });
                    $("#save-btn").text('Simpan').removeAttr("disabled");
                }
            },
            beforeSend: function () {
                $("#save-btn").val('Menyimpan data ....').attr("disabled", "disabled");
            },
            error: function () {
                $("#save-btn").text('Simpan').removeAttr("disabled");
            }
        });

    });
</script>