create or replace view t_jenis_perawatan_dtl_sum_view as
select		y.id_kendaraan, year(y.tanggal) as tahun,
				sum(x.harga) as total
from			t_jenis_perawatan_dtl x
left join	t_perawatan y on y.id_jenis_perawatan_hdr = x.id_jenis_perawatan_hdr
group by		y.id_kendaraan, year(y.tanggal)
;