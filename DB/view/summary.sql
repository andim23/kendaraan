select		'expired' as status_stnk, count(*) as total
from			ms_kendaraan x
where			x.masa_berlaku_stnk < date(now())
union all
select		'valid' as status_stnk, count(*) as total
from			ms_kendaraan x
where			x.masa_berlaku_stnk >= date(now())
;


select		'expired' as status_perawatan, count(*) as total
from			ms_kendaraan x
left join	t_perawatan_berlaku_max_view y on y.id_kendaraan = x.id_kendaraan
where			y.masa_berlaku_max < date(now())
union all
select		'valid' as status_perawatan, count(*) as total
from			ms_kendaraan x
left join	t_perawatan_berlaku_max_view y on y.id_kendaraan = x.id_kendaraan
where			y.masa_berlaku_max >= date(now())
;

select		y.id_jenis, y.jenis,
				count(x.id_kendaraan) as total
from			ms_jenis y
left join	ms_kendaraan x on x.id_jenis = y.id_jenis
group by		x.id_jenis,  y.jenis
;