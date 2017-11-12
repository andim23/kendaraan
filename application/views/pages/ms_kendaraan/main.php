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
                        <div class="actions">
                            <a href="#" id="add-new" class="btn default yellow-stripe btn-circle">
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

                <!-- Modal -->
                <div class="modal fade bs-modal-lg" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="modal_formModalLabel" data-backdrop="static">
                    <div class="modal-dialog modal-full" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal_formModalLabel">Form Kendaraan</h4>
                            </div>
                            <div class="modal-body scroll">
                                <?php include('form.php'); ?>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-md-3 text-left"><span class="text-danger">*</span> Harus diisi</div>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-primary" id="save-btn">Simpan</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                "url": "<?= base_url() ?>Ms_kendaraan/admin_ajax_list", // ajax source,
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
                $('td:eq(6)', nRow).attr("align", "center");
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
		
		$("#form #catatan").data("wysihtml5").editor.setValue('');
    });

    $('#datatable tbody').on('click', '.detail', function (e) {

        e.preventDefault();

        var table = grid.getDataTable();
        var data = table.row($(this).parents('tr')).data();
        var id = data[0];

        $.ajax({
            cache: false,
            type: "get",
            url: "<?= base_url() ?>Ms_kendaraan/get_data_by_id_json",
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
                var id_kendaraan = data[0].id_kendaraan;
				var id_jenis = data[0].id_jenis;
				var id_merk = data[0].id_merk;
				var nama_kendaraan = data[0].nama_kendaraan;
				var platno = data[0].platno;
				var warna = data[0].warna;
				var bahan_bakar = data[0].bahan_bakar;
				var no_mesin = data[0].no_mesin;
				var no_rangka = data[0].no_rangka;
				var no_stnk = data[0].no_stnk;
				var masa_berlaku_stnk = data[0].masa_berlaku_stnk;
				var catatan = data[0].catatan;
				var id_foto_kendaraan = data[0].id_foto_kendaraan;
				var masa_berlaku_stnk_char = data[0].masa_berlaku_stnk_char;
				
				
				$("#form #id_jenis").select2('val', id_jenis);
				$("#form #id_merk").select2('val', id_merk);
			
				$("#form #id_kendaraan").val(id_kendaraan);
				$("#form #nama_kendaraan").val(nama_kendaraan);
				$("#form #platno").val(platno);
				$("#form #warna").val(warna);
				$("#form #bahan_bakar").val(bahan_bakar);
				$("#form #no_mesin").val(no_mesin);
				$("#form #no_rangka").val(no_rangka);
				$("#form #no_stnk").val(no_stnk);
				$("#form #masa_berlaku_stnk").val(masa_berlaku_stnk_char);
				$("#form #catatan").data("wysihtml5").editor.setValue(catatan);
				$("#form #id_foto_kendaraan").val(id_foto_kendaraan);
				
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
                url: "<?= base_url() ?>Ms_kendaraan/hapus_json",
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

    $("#save-btn").click(function (e) {
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