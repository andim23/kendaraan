create or replace view t_perawatan_view as
select		x.id_perawatan, x.id_kendaraan, x.id_jenis_perawatan_hdr,
				x.biro, x.tanggal, x.kilometer, x.lain_lain,
				x.pengemudi, x.pemakai, x.masa_berlaku, 
				x.dateinput, x.dateupdate, x.userinput, x.userupdate,
				k.nama_kendaraan, k.platno,
				j.jenis,
				concat(right(x.tanggal,2), '-', 
				mid(x.tanggal,6,2), '-' ,
				left(x.tanggal,4)) as tanggal_char,
				
				concat(right(x.masa_berlaku,2), '-', 
				mid(x.masa_berlaku,6,2), '-' ,
				left(x.masa_berlaku,4)) as masa_berlaku_char,
				if( x.masa_berlaku < date(now()), 'Exipred', 'Valid' ) as masa_berlaku_status,
				left(x.tanggal,4) as tahun,
				x.id_berkas_pendukung,
				x.id_spk
from			t_perawatan x
left join	ms_kendaraan k on k.id_kendaraan = x.id_kendaraan
left join	ms_jenis j on k.id_jenis = j.id_jenis
;