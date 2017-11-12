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
</script>