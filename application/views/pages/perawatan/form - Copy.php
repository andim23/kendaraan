<style>
	.dz-preview{
		display: none;
	}

</style>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>T_perawatan/simpan_json" id="form">
            <input type="hidden" name="id_perawatan" id="id_perawatan" value="<?= isset($detail[0]->id_perawatan)?$detail[0]->id_perawatan:""; ?>" />
            <input type="hidden" name="id_kendaraan" id="id_kendaraan" value="<?= isset($dkendaraan[0]->id_kendaraan)?$dkendaraan[0]->id_kendaraan:""; ?>" />
            <input type="hidden" name="id_spk" id="id_spk" value="<?= $this->uri->segment(3) ?>" />
            
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
			
            <?php foreach($dspk as $rd){ ?>
            <div class="form-group">
            	<div class="col-md-12"><h3>Informasi SPK</h3></div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label"><strong>Tanggal</strong></label>
                <div class="col-md-10">
                	<label class="control-label"><?= TglOnlyIndo($rd->tanggal) ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label"><strong>No SPK</strong></label>
                <div class="col-md-10">
                	<label class="control-label"><?= $rd->no_spk ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label"><strong>Perawatan</strong></label>
                <div class="col-md-10">
                	<?= $rd->perawatan ?>
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label"><strong>Pengguna</strong></label>
                <div class="col-md-10">
                	<label class="control-label"><?= $rd->pengguna ?></label>
                </div>
            </div>
            <?php } ?>
            
            
            <div class="form-group">
            	<div class="col-md-12"><h3>Informasi Perawatan</h3></div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Biro <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input name="biro" type="text" class="form-control" id="biro" value="<?= isset($dspk[0]->pengguna)?$dspk[0]->pengguna:""; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Tanggal Perawatan  <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <div class="input-group input-large date date-picker" data-date-format="dd-mm-yyyy">
                        <input type="text" class="form-control"  name="tanggal" id="tanggal" value="<?= isset($detail[0]->tanggal_char)?$detail[0]->tanggal_char:""; ?>">
                        <span class="input-group-btn">
                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Kilometer <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= isset($detail[0]->kilometer)?$detail[0]->kilometer:""; ?>" name="kilometer" id="kilometer">
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Pengemudi <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= isset($detail[0]->pengemudi)?$detail[0]->pengemudi:""; ?>" name="pengemudi" id="pengemudi">
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Pemakai <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= isset($detail[0]->pemakai)?$detail[0]->pemakai:""; ?>" name="pemakai" id="pemakai">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Berlaku Sampai  <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <div class="input-group input-large date date-picker" data-date-format="dd-mm-yyyy">
                        <input type="text" class="form-control"  name="masa_berlaku" id="masa_berlaku" value="<?= isset($detail[0]->masa_berlaku_char)?$detail[0]->masa_berlaku_char:""; ?>">
                        <span class="input-group-btn">
                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
           		<h3>Jenis Perawatan</h3>
            </div>
            
            <div class="form-group">
           	  <div class="col-md-2" align="right"><label>&nbsp;</label></div>
                <div class="col-md-1">
                    <label><strong>Status</strong></label>
                </div>
                <div class="col-md-1">
                    <label><strong>Jumlah</strong></label>
                </div>
                <div class="col-md-2">
                    <label><strong>Harga</strong></label>
                </div>
                <div class="col-md-6">
                    <label><strong>Keterangan</strong></label>
                </div> 
            </div>
            
            <?php foreach($djenisp as $rj){ ?>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label"><?= $rj->perawatan ?></label>
                <div class="col-md-1" align="center">
                    <label><input type="checkbox" class="checks" name="id_jenis_perawatan[]" id="id_jenis_perawatan-<?= $rj->id_jenis_perawatan ?>" value="<?= $rj->id_jenis_perawatan ?>" /> </label> 
                </div>
                <div class="col-md-1">
                	<input type="text" name="jumlah[]" id="jumlah-<?= $rj->id_jenis_perawatan ?>" class="form-control jumlah checks-<?= $rj->id_jenis_perawatan ?>" disabled="disabled" />
                </div>
                <div class="col-md-2">
                	<input type="text" name="harga[]" id="harga-<?= $rj->id_jenis_perawatan ?>" class="form-control harga checks-<?= $rj->id_jenis_perawatan ?>" disabled="disabled" />
                </div>
                <div class="col-md-6">
                	<textarea class="form-control checks-<?= $rj->id_jenis_perawatan ?>" id="catatan-<?= $rj->id_jenis_perawatan ?>" name="catatan[]" disabled="disabled"></textarea>
                </div>
                <div class="col-md-12">
                	<hr />
                </div>
            </div>
            <?php } ?>
            
            <div class="form-group">
           		<label for="kategori" class="col-md-12"><strong>Perawatan Lain-lain</strong></label>
            </div>
            
            <?php foreach($djenisp_lain as $rl){ ?>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label"><?= $rl->perawatan ?></label>
                <div class="col-md-1" align="center">
                    <label><input type="checkbox" class="checks" name="id_jenis_perawatan[]" id="id_jenis_perawatan-<?= $rl->id_jenis_perawatan ?>" value="<?= $rl->id_jenis_perawatan ?>" /> </label> 
                </div>
                <div class="col-md-1">
                	<input type="text" name="jumlah[]" id="jumlah-<?= $rl->id_jenis_perawatan ?>" class="form-control jumlah checks-<?= $rl->id_jenis_perawatan ?>" disabled="disabled" />
                </div>
                <div class="col-md-2">
                	<input type="text" name="harga[]" id="harga-<?= $rl->id_jenis_perawatan ?>" class="form-control harga checks-<?= $rl->id_jenis_perawatan ?>" disabled="disabled" />
                </div>
                <div class="col-md-6">
                	<textarea class="form-control checks-<?= $rl->id_jenis_perawatan ?>" id="catatan-<?= $rl->id_jenis_perawatan ?>" name="catatan[]" disabled="disabled"></textarea>
                </div>
                <div class="col-md-12">
                	<hr />
                </div>
            </div>
            <?php } ?>
            
            <div class="form-group">
           		<h3>Berkas Pendukung</h3>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Berkas</label>
                <div class="col-md-10">
                	<div class="berkas_upload_content" id="berkas_upload_content">
                        <button id="btn_berkas" name="btn_berkas" type="button" class="btn green btn-block">Unggah Berkas Pendukung</button>
                        <div class="progress progress-striped" role="progressbar" id="berkas_progress" 
                            aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="height:10px;"
                        >
                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                        </div>
                        <span class="help-block">Tipe Berkas jpg, jpeg, png</span>
                    </div>
                    
                    <div id="berkas_content">
                        <?php 
							if(isset($detail[0]->berkas)){
								foreach($detail[0]->berkas as $rb){
						?>
                        	<div class="col-md-3">
                            	<a href="<?= base_url() ?>upload/berkas_perawatan/<?= $rb->filename ?>" target="_blank">
                                	<img src="<?= base_url() ?>upload/berkas_perawatan/<?= $rb->filename ?>" width="200" />
                                </a>
                                <center><a href="#" class="delete-gambar-server" filename="<?= $rb->filename ?>" recid="<?= $rb->recid ?>"><i class="fa fa-trash-o"></i> hapus </a></center>
                            </div>
                       	<?php	
								}
							}
						?>
                    </div>
                    
                </div>
            </div>
            
            <div class="form-action">
            	<div class="row">
                    
                    <div class="col-md-6">
                        <a href="<?= base_url() ?>t_perawatan/daftar_perawatan/<?= $this->uri->segment(3) ?>?x=<?= $x ?>" class="btn btn-block default">Kembali</a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-block blue" id="save-btn">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
	$jenis_perawatan = isset($detail[0]->jenis_perawatan)?$detail[0]->jenis_perawatan:array();
	foreach($jenis_perawatan as $rjp){
?>
		<script>
			$("#id_jenis_perawatan-<?= $rjp->id_jenis_perawatan ?>").attr("checked", true)
			$("#jumlah-<?= $rjp->id_jenis_perawatan ?>").val("<?= $rjp->jumlah ?>").removeAttr("disabled");
			$("#harga-<?= $rjp->id_jenis_perawatan ?>").val("<?= $rjp->harga ?>").removeAttr("disabled");
			$("#catatan-<?= $rjp->id_jenis_perawatan ?>").val("<?= $rjp->catatan ?>").removeAttr("disabled");
		</script>
<?php		
	}
?>
<script src="<?php echo base_url() ?>theme/assets/global/plugins/dropzone/dropzone.js"></script>
<script type="text/javascript" src="<?= base_url() ?>theme/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script>
	$(document).ready(function(e) {
        $(".harga").inputmask('IDR 999,999,999', {
			numericInput: true,
			rightAlignNumerics: false,
			greedy: false
		});
		
		$(".jumlah").inputmask({
            "mask": "9",
            "repeat": 10,
            "greedy": false
        }); // ~ mask "9" or mask "99" or ... mask "9999999999"
		
		
		
		$("#kilometer").inputmask('999,999,999', {
			numericInput: true,
			rightAlignNumerics: false,
			greedy: false
		});
    });
	
	var myDropzone = new Dropzone("#btn_berkas", { 
		url: "<?= base_url() ?>Upload/do_upload_b",
		maxFiles:5,
		acceptedFiles:".jpg, .png, .jpeg",
		dictDefaultMessage:"Upload Berkas (jpg, jpeg, png)"
	});
		
	myDropzone.on("totaluploadprogress", function(progress) {
		$("#berkas_progress .progress-bar").css({"width":progress+"%"});
	});
			
	myDropzone.on("success", function(file, response) {
		obj = JSON.parse(response);
		var info = obj.info;
		if( info == '0' ){
			alert(obj.message);
		}else{
			var file_name = obj.file_name;
			var file_type = obj.file_type;
			var file_size = obj.file_size;
			
			var tmp = '';
				tmp += '<div class="col-md-3">' 
				tmp += '<img src="<?= base_url() ?>upload/berkas_perawatan/'+file_name+'" width="200">';
				tmp += '<center><a href="#" class="delete-gambar"><i class="fa fa-trash-o"></i> hapus </a></center>';
				tmp += '<input type="hidden" name="berkas_pendukung[]" id="berkas_pendukung[]" value="'+file_name+'" />';
				tmp += '</div>';
				
			$("#berkas_content").append(tmp);
			
		}
		this.removeFile(file);
		
		$(".delete-gambar").click(function(e) {
            var url = "<?= base_url() ?>Upload/delete_fileb_json";
			$(this).parent().remove();
			
			
			$.ajax({
                cache: false,
                type: "get",
                url: url,
                data: "file_name=" + file_name,
                success: function (response) {
                    var data = JSON.parse(response);
                    var status = data.status;
                    var message = data.message;

                    if (status == '1') {
                        
                    } else {
                        alert(message);
                    }
                }
            });
        });
	});
	
	$(".delete-gambar-server").click(function(e) {
		e.preventDefault();
        
		if(confirm('Anda yakin menghapus data ini ?')){
			$(this).parent().parent().remove();
			var id = $(this).attr("recid");
			var filename = $(this).attr("filename");
			var url = "<?= base_url() ?>T_perawatan/hapus_berkas_json";
			$.ajax({
				cache: false,
				type: "get",
				url: url,
				data: "filename=" + filename + "&id=" + id,
				success: function (response) {
					var data = JSON.parse(response);
					var status = data.status;
					var message = data.message;
	
					if (status == '1') {
						
					} else {
						alert(message);
					}
				}
			});
		}
    });
</script>