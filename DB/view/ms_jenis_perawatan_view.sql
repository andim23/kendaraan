create or replace  view ms_jenis_perawatan_view as
select		x.id_jenis_perawatan, x.id_group, x.perawatan,
				y.`group`
from			ms_jenis_perawatan x
left join	ms_jenis_perawatan_group y on y.id_group = x.id_group