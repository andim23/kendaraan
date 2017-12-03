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
                            <?= $htitle ?>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <?php include('keluhan_table.php'); ?>
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
                "url": "<?= base_url() ?>T_spk/keluhan_ajax_list", // ajax source,
            },
            "aaSorting": [],
            "columnDefs": 
			[
				{
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<a href='#' class='detail'><i class='fa fa-lg fa-external-link'></i></a>"
                }
			],
            "fnDrawCallback": function (oSettings) {
                var no = oSettings._iDisplayStart;
                for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++)
                {
                    $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr).html(i + 1);
                }
            },
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).attr("align", "right");
                $('td:eq(1),td:eq(5), td:eq(6)', nRow).attr("align", "center");
            },
        }
    });


    $('#datatable tbody').on('click', '.detail', function (e) {

        e.preventDefault();

        var table = grid.getDataTable();
        var data = table.row($(this).parents('tr')).data();
        var id = data[0];

        var url = "<?= base_url() ?>T_spk/daftar/" + id + "?x=<?= $x ?>";
		location.href = url;
    });
	
	$("#xstatus_keluhan").change(function(e) {
        var xstatus_keluhan = $(this).val();
		grid.clearAjaxParams();
        grid.setAjaxParam("xstatus_keluhan", xstatus_keluhan);
		grid.getDataTable().ajax.reload();
    });
	
	$(document).ready(function(e) {
        var xstatus_keluhan = "<?= $this->input->get('xstatus_keluhan'); ?>";
		$("#xstatus_keluhan").val(xstatus_keluhan);
		grid.clearAjaxParams();
        grid.setAjaxParam("xstatus_keluhan", xstatus_keluhan);
		grid.getDataTable().ajax.reload();
    });
</script>