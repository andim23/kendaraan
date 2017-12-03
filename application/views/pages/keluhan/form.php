<?php
	$x = $this->input->get('x');
	$no = 'KY/K/' . date('Ymdhhis');
	
	$no_keluhan = isset($dkeluhan[0]->no_keluhan)?$dkeluhan[0]->no_keluhan:$no;
	$pengguna = isset($dkeluhan[0]->pengguna)?$dkeluhan[0]->pengguna:"";
	$pemohon = isset($dkeluhan[0]->pemohon)?$dkeluhan[0]->pemohon:"";
	$keluhan = isset($dkeluhan[0]->keluhan)?$dkeluhan[0]->keluhan:"";
?>

<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>T_keluhan/simpan_json" id="form">
            <input type="hidden" name="id_keluhan" id="id_keluhan" value="<?= $this->uri->segment(4) ?>" />
            <input type="hidden" name="id_kendaraan" id="id_kendaraan" value="<?= $this->uri->segment(3) ?>" />
            
            <div class="form-group">
				<?php  
                    foreach($dkendaraan as $row){
                ?>
                <div class="row">
                    <div class="col-md-10 col-md-offset-2">
                      <div class="col-md-4">
                            <a href="<?= base_url() ?>upload/kendaraan/<?= $row->gambar ?>" target="_blank">
                            <div 
                                class="thumbnail" 
                                style="background:url('<?= base_url() ?>upload/kendaraan/<?= $row->gambar ?>');  
                                background-size:contain; background-repeat:no-repeat; width:100%; height:200px;
                                background-position:center;
                                "
                            ></div>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                              <tr>
                                <td width="200"><strong>Jenis Kendaraan</strong></td>
                                <td><?= $row->jenis ?></td>
                              </tr>
                              <tr>
                                <td><strong>Nama Kendaraan</strong></td>
                                <td><?= $row->nama_kendaraan ?></td>
                              </tr>
                              <tr>
                                <td><strong>Plat No</strong></td>
                                <td><?= $row->platno ?></td>
                              </tr>
                              <tr>
                                <td><strong>No STNK</strong></td>
                                <td><?= $row->no_stnk ?></td>
                              </tr>
                              <tr>
                                <td><strong>Masa Berlaku STNK</strong></td>
                                <td><?= TglOnlyIndo($row->masa_berlaku_stnk) ?></td>
                              </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">No Keluhan <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= $no_keluhan ?>" name="no_keluhan" id="no_keluhan" readonly="readonly" />
                    <span class="help-block">No ini dibuat secara otomatis oleh sistem</span>
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Pengguna <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= $pengguna ?>" name="pengguna" id="pengguna" />
                    <span class="help-block">Contoh: Operasional BRAP Komisi Yudisial RI</span>
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Pemohon <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= $pemohon ?>" name="pemohon" id="pemohon" />
                    <span class="help-block">Contoh: Jaya</span>
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Keluhan <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <textarea name="ckeditor" id="keluhan" class="form-control ckeditor"><?= $keluhan ?></textarea>
                </div>
            </div>
            
            <div class="form-action">
            	<div class="row">
                	<div class="col-md-6"><a href="<?= base_url() ?>t_keluhan/daftar/<?= $this->uri->segment(3) ?>?x=<?= $x ?>" class="btn btn-block default">Kembali</a></div>
                    <div class="col-md-6"><button type="submit" class="btn btn-block blue" id="<?= base_url() ?>t_keluhan/daftar/<?= $this->uri->segment(3) ?>?x=<?= $x ?>">Simpan</button></div>
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
		
		var keluhan = CKEDITOR.instances['keluhan'].getData()
 		data = data + "&keluhan=" + encodeURIComponent(keluhan);
		
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
                    var url = "<?= base_url() ?>t_keluhan/daftar/<?= $this->uri->segment(3) ?>?x=<?= $x ?>";
					location.href = url;
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