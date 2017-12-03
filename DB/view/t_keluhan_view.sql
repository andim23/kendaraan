create or replace view t_keluhan_view as
select		x.id_keluhan, x.id_kendaraan, x.user_id, x.id_berkas,
				x.no_keluhan, x.pengguna, x.pemohon, x.keluhan, x.userinput,
				x.dateinput, x.userupdate, x.dateupdate,
				concat(right(x.dateinput,2), '-', 
				mid(x.dateinput,6,2), '-' ,
				left(x.dateinput,4)) as dateinput_char,
				y.id_spk, p.id_perawatan,
				if(p.id_perawatan is not null, 'Close', 'Open') as status_keluhan
from			t_keluhan x
left join	t_spk y on y.id_keluhan = x.id_keluhan
left join	t_perawatan p on p.id_spk = y.id_spk
;