<?php  
	foreach($dkendaraan as $row){
?>
<div class="col-md-12">
  <div class="col-md-3">
    	<a href="<?= base_url() ?>upload/kendaraan/<?= $row->gambar ?>" target="_blank">
        <div 
        	class="thumbnail" 
            style="background:url('<?= base_url() ?>upload/kendaraan/<?= $row->gambar ?>');  
            background-size:contain; background-repeat:no-repeat; width:100%; height:200px; background-position:center;"
        ></div>
        </a>
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
          
          <?php  
            foreach($dkeluhan as $r){
          ?>
          <tr>
            <td><strong>Keluhan</strong></td>
            <td><?= $r->keluhan ?></td>
          </tr>
          <tr>
            <td><strong>Status</strong></td>
            <td>
            	<?= $r->status_keluhan ?>         	
            </td>
          </tr>
          <?php } ?>
        </table>
    </div>
</div>
<?php } ?>
