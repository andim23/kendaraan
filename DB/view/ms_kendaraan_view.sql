create or replace view ms_kendaraan_view as
select		x.id_kendaraan, x.id_jenis, x.id_merk, x.tahun_pembuatan,
				x.nama_kendaraan, x.platno, x.warna, x.bahan_bakar,
				x.no_mesin, x.no_rangka, x.no_stnk, x.masa_berlaku_stnk,
				x.catatan, x.id_foto_kendaraan, x.dateinput, x.dateupdate,
				x.userinput, x.userupdate,
				j.jenis, m.merk,
				concat(right(x.masa_berlaku_stnk,2), '-', 
				mid(x.masa_berlaku_stnk,6,2), '-' ,
				left(x.masa_berlaku_stnk,4)) as masa_berlaku_stnk_char,
				sd.filename as gambar,
				sd.recid as gambarid,
				if( x.masa_berlaku_stnk < date(now()), 'Expired', 'Valid' ) as status_stnk,
				if( mx.masa_berlaku_max < date(now()), 'Expired', 'Valid' ) as status_perawatan
from			ms_kendaraan x
left join	ms_jenis j on j.id_jenis =  x.id_jenis
left join	ms_merk m on m.id_merk = x.id_merk
left join	sys_attach_dtl sd on sd.attachid = x.id_foto_kendaraan
left join	t_perawatan_berlaku_max_view mx on mx.id_kendaraan = x.id_kendaraan