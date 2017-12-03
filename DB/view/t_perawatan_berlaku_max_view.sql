create or replace view t_perawatan_berlaku_max_view as
select		x.id_kendaraan, max(x.masa_berlaku) as masa_berlaku_max
from			t_perawatan x
group by		x.id_kendaraan
;