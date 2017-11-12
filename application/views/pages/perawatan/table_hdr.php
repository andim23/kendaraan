<table class="table table-bordered">
    <thead>
        <tr role="row" class="bg-info">
            <th>Jenis Kendaraan</th>
            <th>Nama Kendaraan</th>
            <th>Plat No</th>
        </tr>
    </thead>
    <tbody>
    <?php  
		foreach($dkendaraan as $row){
	?>
    	<tr>
            <td><?= $row->jenis ?></td>
            <td><?= $row->nama_kendaraan ?></td>
            <td><?= $row->platno ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>