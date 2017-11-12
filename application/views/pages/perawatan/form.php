<?php
	$r = $dkendaraan[0];
?>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>T_perawatan/simpan_json" id="form">
            <input type="hidden" name="id_perawatan" id="id_perawatan" />
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Jenis Kendaraan</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= $r->jenis ?>" readonly="readonly">
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Nama Kendaraan</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= $r->nama_kendaraan ?>" readonly="readonly">
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Plat No</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="<?= $r->platno ?>" readonly="readonly">
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Biro <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="" name="biro" id="biro">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Tanggal Perawatan  <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
                        <input type="text" class="form-control"  name="tanggal" id="tanggal">
                        <span class="input-group-btn">
                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Kilometer <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="" name="kilometer" id="kilometer">
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Pengemudi <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="" name="pengemudi" id="pengemudi">
                </div>
            </div>
            
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label">Pemakai <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="" name="pemakai" id="pemakai">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Berlaku Sampai  <span class="required" aria-required="true">*</span></label>
                <div class="col-md-10">
                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
                        <input type="text" class="form-control"  name="masa_berlaku" id="masa_berlaku">
                        <span class="input-group-btn">
                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
           		<h3>Jenis Perawatan</h3>
            </div>
            
            <?php foreach($djenisp as $rj){ ?>
            <div class="form-group">
                <label for="kategori" class="col-md-2 control-label"><?= $rj->perawatan ?></label>
                <div class="col-md-2">
                    <select class="form-control status" name="status[]">
                    	<option value="N">Tidak</option>
                    	<option value="Y">Ya</option>
                    </select>
                </div>
                <div class="col-md-8">
                	<textarea class="form-control"></textarea>
                </div>
            </div>
            <?php } ?>
            
            <div class="form-action">
            	<div class="col-md-6">
                	<button type="submit" class="btn btn-block blue" id="save-btn">Simpan</button>
                </div>
                <div class="col-md-6">
                	<a href="<?= base_url() ?>t_perawatan/daftar_perawatan/<?= $this->uri->segment(3) ?>?x=<?= $x ?>" class="btn btn-block default">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>