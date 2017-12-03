<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>T_alokasi_anggaran/simpan_json" id="form">
            <input type="hidden" name="id_alokasi" id="id_alokasi" />
            <div class="form-group">
                <label for="kategori" class="col-md-3 control-label">Kendaraan <span class="required" aria-required="true">*</span></label>
                <div class="col-md-9">
                    <select name="id_kendaraan" id="id_kendaraan" class="form-control">
                    	<option value="">Pilih Kendaraan</option>
                        <?php foreach($dkendaraan as $row){ ?>
                        <option value="<?= $row->id_kendaraan ?>"><?= $row->platno ?> - <?= $row->nama_kendaraan ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-3 control-label">Tahun Anggaran <span class="required" aria-required="true">*</span></label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="" name="tahun_anggaran" id="tahun_anggaran">
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-md-3 control-label">Alokasi <span class="required" aria-required="true">*</span></label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="" name="jumlah" id="jumlah">
                </div>
            </div>
        </form>
    </div>
</div>