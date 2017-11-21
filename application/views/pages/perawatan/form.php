<?php
	$r = $dkendaraan[0];
?>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>T_perawatan/simpan_json" id="form">
            <input type="hidden" name="id_perawatan" id="id_perawatan" />
            <input type="hidden" name="id_kendaraan" id="id_kendaraan" value="<?= $this->uri->segment(3) ?>" />
            
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
                    <input name="biro" type="text" class="form-control" id="biro" value="<?= isset($detail[0]->biro)?$detail[0]->biro:""; ?>">
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
                	<input type="text" name="jumlah[]" id="jumlah-<?= $rj->id_jenis_perawatan ?>" class="form-control checks-<?= $rj->id_jenis_perawatan ?>" disabled="disabled" />
                </div>
                <div class="col-md-2">
                	<input type="text" name="harga[]" id="harga-<?= $rj->id_jenis_perawatan ?>" class="form-control checks-<?= $rj->id_jenis_perawatan ?>" disabled="disabled" />
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
                	<input type="text" name="jumlah[]" id="jumlah-<?= $rl->id_jenis_perawatan ?>" class="form-control checks-<?= $rl->id_jenis_perawatan ?>" disabled="disabled" />
                </div>
                <div class="col-md-2">
                	<input type="text" name="harga[]" id="harga-<?= $rl->id_jenis_perawatan ?>" class="form-control checks-<?= $rl->id_jenis_perawatan ?>" disabled="disabled" />
                </div>
                <div class="col-md-6">
                	<textarea class="form-control checks-<?= $rl->id_jenis_perawatan ?>" id="catatan-<?= $rl->id_jenis_perawatan ?>" name="catatan[]" disabled="disabled"></textarea>
                </div>
                <div class="col-md-12">
                	<hr />
                </div>
            </div>
            <?php } ?>
            
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