<?php
	$x = $this->input->get('x');
	$id_spk = isset($dspk[0]->id_spk)?$dspk[0]->id_spk:"";
	$no_spk = isset($dspk[0]->no_spk)?$dspk[0]->no_spk:"";
	$tanggal = isset($dspk[0]->tanggal)?ddmmyyyy($dspk[0]->tanggal):"";
	$kepada = isset($dspk[0]->kepada)?$dspk[0]->kepada:"";
	$alamat = isset($dspk[0]->alamat)?$dspk[0]->alamat:"";
	$perawatan = isset($dspk[0]->perawatan)?$dspk[0]->perawatan:"";
	$m_nama = isset($dspk[0]->m_nama)?$dspk[0]->m_nama:M_NAMA;
	$m_jabatan = isset($dspk[0]->m_jabatan)?$dspk[0]->m_jabatan:M_JABATAN;
	$m_nip = isset($dspk[0]->m_nip)?$dspk[0]->m_nip:M_NIP;
	$m_hp = isset($dspk[0]->m_hp)?$dspk[0]->m_hp:M_HP;
	$tembusan = isset($dspk[0]->tembusan)?$dspk[0]->tembusan:M_TEMBUSAN;
?>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>T_spk/simpan_json" id="form">
            <input type="hidden" name="id_spk" id="id_spk" value="<?= $id_spk ?>" />
            <input type="hidden" name="id_keluhan" id="id_keluhan" value="<?= $dkeluhan[0]->id_keluhan; ?>" />
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">No SPK <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="no_spk" id="no_spk" value="<?= $no_spk ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Tanggal <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <div class="input-group input-large date date-picker" data-date-format="dd-mm-yyyy">
                        <input type="text" class="form-control"  name="tanggal" id="tanggal" value="<?= $tanggal; ?>">
                        <span class="input-group-btn">
                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Kepada Yth. <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= $kepada ?>" name="kepada" id="kepada">
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Alamat <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= $alamat ?>" name="alamat" id="alamat">
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Perawatan / Perbaikan / Penggantian suku cadang <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <textarea name="ckeditor" id="perawatan" class="form-control ckeditor"><?= $perawatan ?></textarea>
                </div>
            </div>
            <div class="form-group">
            	<label class="col-md-2 control-label"><strong>Mengetahui</strong></label>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Nama <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= $m_nama ?>" name="m_nama" id="m_nama">
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Jabatan <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= $m_jabatan ?>" name="m_jabatan" id="m_jabatan">
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">HP</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= $m_hp ?>" name="m_hp" id="m_hp">
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">NIP <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= $m_nip ?>" name="m_nip" id="m_nip">
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Tembusan</label>
                <div class="col-md-10">
                    <textarea name="ckeditor2" id="tembusan" class="form-control ckeditor"><?= $tembusan ?></textarea>
                </div>
            </div>
            <div class="form-action">
            	<div class="row">
                	<div class="col-md-6"><a href="<?= base_url() ?>t_spk?x=<?= $x ?>" class="btn btn-block default">Kembali</a></div>
                    <div class="col-md-6"><button type="submit" class="btn btn-block blue" id="save-btn">Simpan</button></div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
	$("#form").submit(function (e) {
        // prevent default action
        e.preventDefault();
        $("#save-btn").text('Menyimpan data ....').attr("disabled", "disabled");
        var url = $(this).attr("action");
        var data = $("#form").serialize();
		var perawatan = CKEDITOR.instances['perawatan'].getData();
		var tembusan = CKEDITOR.instances['tembusan'].getData();
		data = data + "&tembusan=" + encodeURIComponent(tembusan);
 		data = data + "&perawatan=" + encodeURIComponent(perawatan);
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
                    if(confirm('Data tersimpan. Anda ingin mendownload SPK dalam bentuk pdf ?')){
						var url = "<?= base_url() ?>t_spk/export_pdf/<?= $this->uri->segment(3) ?>";
						window.open(url);
					}
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