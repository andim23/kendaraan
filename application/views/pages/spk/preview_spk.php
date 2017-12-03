<?php
	// Remove the default header and footer
	class PDF2 extends TCPDF { 
		public function Header() { 
		// No Header 
		} 
		public function Footer() { 
		// No Footer 
		} 
	} 

	$pdf = new PDF2('L', 'mm', 'A4', true, 'UTF-8', false);
	$pdf->SetTitle('SPK');
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$pdf->SetAuthor('Author');
	$pdf->SetDisplayMode('real', 'default');
	$pdf->SetFont('times', '', 12);
	$pdf->AddPage('P');
$html = 
<<<EOD

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">
    	<img src="upload/spk/logo spk.jpg" height="75" />
    </td>
  </tr>
</table>

EOD;

	foreach($dspk as $row){
$html .='
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
			  <tr>
				<td align="center" valign="middle" style="text-decoration:underline;"><h3>Surat Perintah Kerja</h3></td>
			  </tr>
			  <tr>
				<td align="center" valign="middle">'. $row->no_spk .'</td>
			  </tr>
			</table>';
$html .='
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right">Jakarta, '. TglOnlyIndo($row->tanggal) .'</td>
  </tr>
</table>
';
$html .='
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td><strong>Kepada Yth.</strong></td>
  </tr>
  <tr>
    <td><strong>'. $row->kepada .'</strong></td>
  </tr>
  <tr>
    <td><strong>'. $row->alamat .'</strong></td>
  </tr>
</table>
<br><br>
';
$html .='
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td>Dengan Hormat,</td>
  </tr>
  <tr>
    <td>Bersama ini kami mohon kiranya kendaraan dinas operasional Komisi Yudisial RI yang tersebut dibawah ini:
    </td>
  </tr>
</table>
';
$html .='
<table width="100%" border="0" cellspacing="0" cellpadding="3">
';
  foreach($dkendaraan as $r){
$html .='
  <tr>
    <td width="5%">&nbsp;</td>
	<td width="19%">Nomor Polisi</td>
    <td width="2%" align="center">:</td>
    <td width="69%">'. $r->platno .'</td>
  </tr>
  <tr>
    <td width="5%">&nbsp;</td>
	<td width="19%">Merek</td>
    <td width="2%" align="center">:</td>
    <td width="69%">'. $r->merk .' '. $r->nama_kendaraan .'</td>
  </tr>
';
  }
  foreach($dkeluhan as $r2){
$html .='	  
  <tr>
    <td width="5%">&nbsp;</td>
	<td width="19%">Pengguna</td>
    <td width="2%" align="center">:</td>
    <td width="69%">'.$r2->pengguna.'</td>
  </tr>
';
  }
$html .='
</table>

';
$html .='
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td>Untuk dapat dilaksanakan perawatan/perbaikan/penggantian suku cadang, sebagai berikut :
    </td>
  </tr>
  <tr>
    <td>
    	'. $row->perawatan .'
    </td>
  </tr>
  <tr>
    <td>Pelaksanaan pekerjaan sesuai dengan surat perintah kerja diatas,  apabila ada perubahan mohon dapat menghubungi kami terlebih dahulu,
		melalui HP '.  $row->m_hp  .' atas nama '.  $row->m_nama .'. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.
    </td>
  </tr>
  <tr>
    <td>
    	
    </td>
  </tr>
</table>

';
$html .='
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="center" width="40%">Mengetahui,</td>
    <td width="20%">&nbsp;</td>
    <td align="center" width="40%">Pemohon</td>
  </tr>
  <tr>
    <td align="center" width="40%">'. $row->m_jabatan .'</td>
    <td width="20%">&nbsp;</td>
    <td align="center" width="40%">&nbsp;</td>
  </tr>
  <tr>
    <td width="40%" height="40" align="center">&nbsp;</td>
    <td width="20%">&nbsp;</td>
    <td align="center" width="40%">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" width="40%">'. $row->m_nama .'</td>
    <td width="20%">&nbsp;</td>
    <td align="center" width="40%"> 
';
		foreach($dkeluhan as $r2){ 
$html .=' (  '. $r2->pemohon .'  ) ';
        } 
$html .='
    </td>
  </tr>
  <tr>
    <td align="center" width="40%">NIP '. $row->m_nip .'</td>
    <td width="20%">&nbsp;</td>
    <td align="center" width="40%">&nbsp;</td>
  </tr>
</table>

<p></p>

';

$html .='
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td>Tembusan :</td>
  </tr>
  <tr>
    <td>
    	'. $row->tembusan .'
    </td>
  </tr>
</table>
<style> .per{ background:none !important; } </style>
';
}

	$pdf->writeHTML($html, true, false, true, false, '');
	$pdf->Output('Rekapitulasi Perawatan Kendaraan.pdf', 'I');
?>


