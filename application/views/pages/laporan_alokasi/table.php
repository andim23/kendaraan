<form action="<?= $_SERVER['PHP_SELF'] ?>">
	<input type="hidden" name="x" value="<?= $this->input->get('x') ?>" />
    <input type="hidden" name="y" value="<?= $this->input->get('y') ?>" />
    <div class="row margin-bottom-20">
        <div class="col-md-2">
            <label class="control-label">Tahun</label>
        </div>
        <div class="col-md-2">
            <select class="form-control" name="tahun_anggaran" id="tahun_anggaran">
                <option value="">Pilih Tahun</option>
				<?php foreach($tahun as $rt){ ?>
                <option value="<?= $rt->tahun_anggaran ?>"><?= $rt->tahun_anggaran ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn green">Tampilkan</button>
        </div>
    </div>
</form>

<table class="table table-striped table-bordered table-hover" id="datatable" width="100%">
    <thead>
        <tr role="row" class="heading">
            <th width="50">No</th>
            <th>Jenis</th>
            <th>Merk</th>
            <th>Kendaraan</th>
            <th>Plat No</th>
            <th>Pemakaian (IDR)</th>
            <th width="20%">Alokasi / Sisa (IDR)</th>
        </tr>
    </thead>
    <tbody>
    	<?php
			$no = 0; 
			foreach( $res as $row ){ 
				$no++;
				$jumlah = isset($row->alokasi[0]->jumlah)?number_format($row->alokasi[0]->jumlah):0;
				$selisih = isset($row->alokasi[0]->selisih)?number_format($row->alokasi[0]->selisih):0;
				$persentase = isset($row->alokasi[0]->persentase)?number_format($row->alokasi[0]->persentase):0;
				$total = isset($row->alokasi[0]->total)?number_format($row->alokasi[0]->total):0;
				
				$xlass = 'progress-bar-success';
				if( $persentase > 70 ){
					$xlass = 'progress-bar-danger';
				}
		?>
    	<tr>
            <td align="right"><?= $no ?></td>
            <td><?= $row->jenis ?></td>
            <td><?= $row->merk ?></td>
            <td><?= $row->nama_kendaraan ?></td>
            <td><?= $row->platno ?></td>
            <td align="right"><?= $total ?></td>
            <td align="right">
				<?= $jumlah ?> / <?= $selisih ?>
                <div class="progress progress-striped" role="progressbar" id="gambar_progress" 
                    aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="height:10px;"
                >
                  <div class="progress-bar <?= $xlass ?>" style="width:<?= $persentase ?>%;"></div>
                </div>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php if( empty($res) ){ ?>
<div class="alert alert-danger">Data tidak ditemukan</div>
<?php } ?>

<script>
	$(document).ready(function(e) {
        $("#tahun_anggaran").select2();
		$("#datatable").dataTable();
    });
</script>