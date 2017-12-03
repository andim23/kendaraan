create or replace view t_alokasi_anggaran_sum_view as
select		x.id_kendaraan, x.tahun_anggaran, x.jumlah,
				ifnull(y.total,0) as total,
				x.jumlah - ifnull(y.total,0) as selisih,
				round(((ifnull(y.total,0) / x.jumlah) * 100)) as persentase
from			t_alokasi_anggaran x
left join	t_jenis_perawatan_dtl_sum_view  y on y.id_kendaraan = x.id_kendaraan
				and y.tahun = x.tahun_anggaran
;
