<?php  
	foreach($dkendaraan as $row){
?>
<div class="col-md-12">
  <div class="col-md-3">
    	<div class="thumbnail" style="background:url('<?= base_url() ?>upload/kendaraan/<?= $row->gambar ?>');  background-size:contain; background-repeat:no-repeat; width:100%; height:200px;">
    		
        </div>
    </div>
    <div class="col-md-9">
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
<?php } ?>