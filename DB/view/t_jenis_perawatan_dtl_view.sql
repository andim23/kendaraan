create or replace view t_jenis_perawatan_dtl_view as
select		x.recid, x.id_jenis_perawatan_hdr, x.id_jenis_perawatan,
				x.`status`, x.catatan, x.harga, x.jumlah, y.perawatan
from			t_jenis_perawatan_dtl x
left join	ms_jenis_perawatan y on y.id_jenis_perawatan =  x.id_jenis_perawatan
;