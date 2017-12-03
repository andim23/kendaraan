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
                            Informasi Keluhan
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <?php include('table_hdr.php'); ?>
                        </div>
                    </div>
                </div>
                <!-- End: life time stats -->
                
                <!-- Begin: life time stats -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            Buat SPK
                        </div>
                        <div class="actions">
                            <a href="<?= base_url() ?>t_spk/export_pdf/<?= $this->uri->segment(3); ?>" target="_blank" class="btn"><i class="fa fa-file-pdf-o"></i> Cetak PDF</a>
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
    var grid = new Datatable();

    grid.init({
        src: $("#datatable"),
        onSuccess: function (grid) {
            // execute some code after table records loaded
        },
        onError: function (grid) {
            // execute some code on network or other general error  
        },
        loadingMessage: 'Loading...',
        dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options 
            "lengthMenu": [
                [10, 20, -1],
                [10, 20, "All"] // change per page values here
            ],
            "pageLength": 10, // default record count per page
            "ajax": {
                "url": "<?= base_url() ?>T_spk/admin_ajax_list", // ajax source,
            },
            "aaSorting": [],
            "columnDefs": [{
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<a href='#' class='detail'><i class='fa fa-lg fa-search'></i></a> &nbsp;&nbsp; <a href='#' class='delete'><i class='fa fa-lg fa-trash-o'></i></a>"
                }],
            "fnDrawCallback": function (oSettings) {
                var no = oSettings._iDisplayStart;
                for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++)
                {
                    $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr).html(i + 1);
                }
            },
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                // <set you align column here>
                $('td:eq(0)', nRow).attr("align", "right");
                $('td:eq(2)', nRow).attr("align", "center");
            },
        }
    });


    $("#add-new").click(function (e) {
        e.preventDefault();
        // load modal when success get JSON
        var modal = $('#modal_form').modal('show');

        // clear error mark
        $.clearErrorMark();
        // reset form
        $.clearInput();
    });

    $('#datatable tbody').on('click', '.detail', function (e) {

        e.preventDefault();

        var table = grid.getDataTable();
        var data = table.row($(this).parents('tr')).data();
        var id = data[0];

        $.ajax({
            cache: false,
            type: "get",
            url: "<?= base_url() ?>T_spk/get_data_by_id_json",
            data: "id=" + id,
            success: function (response) {
                // load modal when success get JSON
                var modal = $('#modal_form').modal('show');

                // clear error mark
                $.clearErrorMark();
                // reset form
                $.clearInput();

                // get data
                // if your form containing textarea then
                // you can customize this code
                var data = JSON.parse(response);
                $.each(data[0], function (key, value) {
                    var element = $("#" + key);
                    if ($("#" + key).length > 0)
                    {
                        if (element.is(":input"))
                            element.val(value);
                        else
                            element.text(value);
                    }
                });
            }
        });
    });

    $('#datatable tbody').on('click', '.delete', function (e) {

        e.preventDefault();

        var table = grid.getDataTable();
        var data = table.row($(this).parents('tr')).data();
        var id = data[0];
        if (confirm('Anda yakin menghapus data ini ?')) {
            $.ajax({
                cache: false,
                type: "get",
                url: "<?= base_url() ?>T_spk/hapus_json",
                data: "id=" + id,
                success: function (response) {
                    var data = JSON.parse(response);
                    var status = data.status;
                    var message = data.message;

                    if (status == '1') {
                        grid.getDataTable().ajax.reload();
                    } else {
                        alert('Gagal menghapus Data');
                    }
                }
            });
        }
    });
	
	
</script>