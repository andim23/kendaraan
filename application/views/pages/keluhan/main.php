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
                            Informasi Kendaraan
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
                            <?= $htitle ?>
                        </div>
                        <div class="actions">
                            <a href="<?= base_url() ?>t_keluhan/form/<?= $this->uri->segment(3) ?>?x=<?= $x ?>" class="btn default yellow-stripe btn-circle">
                                <i class="fa fa-plus"></i><span class="hidden-480"> Tambah</span>
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <?php include('table.php'); ?>
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
                "url": "<?= base_url() ?>T_keluhan/ajax_list/<?= $this->uri->segment(3) ?>", // ajax source,
            },
            "aaSorting": [],
            "fnDrawCallback": function (oSettings) {
                var no = oSettings._iDisplayStart;
                for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++)
                {
                    $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr).html(i + 1);
                }
            },
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				var id = aData[0];
                var url = "<?= base_url() ?>t_keluhan/form/<?= $this->uri->segment(3) ?>/"+id+"?x=<?= $x ?>"; 
				var act = "<a href='"+url+"'><i class='fa fa-lg fa-search'></i></a> &nbsp;&nbsp; <a href='#' class='delete'><i class='fa fa-lg fa-trash-o'></i></a>";
				// <set you align column here>
                $('td:eq(0)', nRow).attr("align", "right");
                $('td:eq(1), td:eq(5)', nRow).attr("align", "center");
				$('td:eq(6)', nRow).html(act);
            },
        }
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
                url: "<?= base_url() ?>T_keluhan/hapus_json",
                data: "id=" + id,
                success: function (response) {
                    var data = JSON.parse(response);
                    var status = data.status;
                    var message = data.message;

                    if (status == '1') {
                        grid.getDataTable().ajax.reload();
                        //grid.clearAjaxParams();
                    } else {
                        alert('Gagal menghapus Data');
                    }
                }
            });
        }
    });
	
	$("#xstatus_keluhan").change(function(e) {
        var xstatus_keluhan = $(this).val();
		grid.clearAjaxParams();
        grid.setAjaxParam("xstatus_keluhan", xstatus_keluhan);
		grid.getDataTable().ajax.reload();
    });
</script>