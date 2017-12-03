create or replace view t_spk_view as
select		x.id_spk, x.id_keluhan, x.no_spk, x.tanggal,
				x.kepada, x.alamat, x.perawatan,
				x.tembusan, x.m_nama, x.m_jabatan, x.m_nip, x.m_hp,
				x.userinput, x.dateinput,
				x.userupdate, x.dateupdate,
				y.no_keluhan, y.pengguna, y.pemohon, y.id_kendaraan,
				k.platno, k.nama_kendaraan
from			t_spk x
left join	t_keluhan y on y.id_keluhan = x.id_keluhan
left join	ms_kendaraan k on k.id_kendaraan = y.id_kendaraan