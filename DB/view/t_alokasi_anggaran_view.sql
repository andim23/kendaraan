create or replace view t_alokasi_anggaran_view as
select		x.id_alokasi, x.id_kendaraan, x.tahun_anggaran, x.jumlah,
				y.id_merk, y.nama_kendaraan, y.platno, m.merk
from			t_alokasi_anggaran x
left join	ms_kendaraan y on y.id_kendaraan = x.id_kendaraan
left join	ms_merk m  on m.id_merk = y.id_merk