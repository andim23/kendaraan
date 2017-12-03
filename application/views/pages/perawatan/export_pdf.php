<?php
	$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
	$pdf->SetTitle('Rekapitulasi Perawatan Kendaraan');
	
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$pdf->SetAuthor('Author');
	$pdf->SetDisplayMode('real', 'default');
	$pdf->SetFont('helvetica', '', 10);
	$pdf->AddPage('P');
	
	$jenis = $dkendaraan[0]->jenis;
	$platno = $dkendaraan[0]->platno;
	$tahun = $detail[0]->tahun;
	
$html = 
<<<EOD
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
	<td align="center"><h2>Rekapitulasi Perawatan Kendaraan</h2></td>
  </tr>
  <tr>
	<td align="center"><h3>{$jenis} {$platno}</h3></td>
  </tr>
  <tr>
	<td align="center"><h3>Tahun {$tahun}</h3></td>
  </tr>
</table>

<br><br><br>


<table width="100%" border="1" cellspacing="0" cellpadding="3" style="border-collapse:collapse;">
<thead>
  <tr>
	<th width="5%" align="center"><strong>NO</strong></th>
	<th width="45%" align="center"><strong>Jenis  Perawatan</strong></th>
	<th width="10%" align="center"><strong>Jumlah</strong></th>
	<th width="40%" align="center"><strong>Keterangan</strong></th>
  </tr>
</thead>
<tbody>
EOD;
$no=0;
foreach($detail[0]->jenis_perawatan as $row){
	$no++;
	$html .= 
	'
		<tr>
			<td width="5%" align="right">'.$no.'</td>
			<td width="45%">'.$row->perawatan.'</td>
			<td align="right"  width="10%">'.number_format($row->jumlah).'</td>
			<td width="40%">'.$row->catatan.'</td>
		</tr>
	';
}

$html .= 
<<<EOD
	</tbody>
</table>
EOD;


	$pdf->writeHTML($html, true, false, true, false, '');
	$pdf->Output('Rekapitulasi Perawatan Kendaraan.pdf', 'I');
?>