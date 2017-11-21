<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>Ms_kendaraan/simpan_json" id="form">
            <input type="hidden" name="id_kendaraan" id="id_kendaraan" />
            <input type="hidden" name="id_foto_kendaraan" id="id_foto_kendaraan" />
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Jenis <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <select class="form-control" name="id_jenis"  id="id_jenis">
                    	<option value="">Pilih Jenis</option>
                        <?php foreach($djenis as $rj){ ?>
                        <option value="<?= $rj->id_jenis ?>"><?= $rj->jenis ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Merk <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <select class="form-control" name="id_merk"  id="id_merk">
                    	<option value="">Pilih Merk</option>
                        <?php foreach($dmerk as $rm){ ?>
                        <option value="<?= $rm->id_merk ?>"><?= $rm->merk ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Nama <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" name="nama_kendaraan" id="nama_kendaraan" class="form-control" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Plat No <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" name="platno" id="platno" class="form-control" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Warna</label>
                <div class="col-md-10">
                    <input type="text" name="warna" id="warna" class="form-control" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Bahan Bakar</label>
                <div class="col-md-10">
                    <input type="text" name="bahan_bakar" id="bahan_bakar" class="form-control" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">No Mesin</label>
                <div class="col-md-10">
                    <input type="text" name="no_mesin" id="no_mesin" class="form-control" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">No Rangka</label>
                <div class="col-md-10">
                    <input type="text" name="no_rangka" id="no_rangka" class="form-control" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">No STNK</label>
                <div class="col-md-10">
                    <input type="text" name="no_stnk" id="no_stnk" class="form-control" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Gambar</label>
                <div class="col-md-10">
                	<div class="gambar_upload_content" id="gambar_upload_content">
                        <button id="btn_gambar" name="btn_gambar" type="button" class="btn green btn-block">Unggah Gambar</button>
                        <div class="progress progress-striped" role="progressbar" id="gambar_progress" 
                            aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="height:10px;"
                        >
                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                        </div>
                        <span class="help-block">Tipe Gambar jpg, jpeg, png</span>
                    </div>
                    
                    <div id="gambar_content" style="width:210px;">
                        
                    </div>
                    
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Masa Berlaku STNK</label>
                <div class="col-md-10">
                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
                        <input type="text" class="form-control"  name="masa_berlaku_stnk" id="masa_berlaku_stnk">
                        <span class="input-group-btn">
                        	<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            
             <div class="form-group">
                <label class="col-md-2 control-label">Catatan</label>
                <div class="col-md-10">
                    <textarea name="catatan" id="catatan" class="form-control wysihtml5">
                    </textarea>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="<?php echo base_url() ?>theme/assets/global/plugins/dropzone/dropzone.js"></script>
<script>
	$("#id_jenis").select2();
	$("#id_merk").select2();

	$('.wysihtml5').wysihtml5({
		"stylesheets": ["<?php echo base_url() ?>theme/assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
	});
	
	$('.date-picker').datepicker({
		rtl: Metronic.isRTL(),
		orientation: "left",
		autoclose: true
	});
	
	// upload file
	var myDropzone = new Dropzone("#btn_gambar", { 
		url: "<?= base_url() ?>Upload/do_upload_k",
		maxFiles:5,
		acceptedFiles:".jpg, .png, .jpeg",
		dictDefaultMessage:"Upload Berkas (jpg, jpeg, png)"
	});
		
	myDropzone.on("totaluploadprogress", function(progress) {
		$("#gambar_progress .progress-bar").css({"width":progress+"%"});
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
			
			$("#gambar_content").empty();
			var tmp = '<img src="<?= base_url() ?>upload/kendaraan/'+file_name+'" width="200">';
				tmp += '<center><a href="#" class="delete-gambar"><i class="fa fa-trash-o"></i> hapus </a></center>';
				tmp += '<input type="hidden" name="gambar" id="gambar" value="'+file_name+'" />';
			
			$("#gambar_upload_content").hide();
			$("#gambar_content").append(tmp);
		}
		this.removeFile(file);
		
		$(".delete-gambar").click(function(e) {
            var url = "<?= base_url() ?>Upload/delete_filek_json";
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
                        $("#gambar_content").empty();
						$("#gambar_upload_content").show();
                    } else {
                        alert(message);
                    }
                }
            });
        });
	});
</script>