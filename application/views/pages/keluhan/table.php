<div class="table-group-actions pull-right">
	<label>Status</label>
    <select class="input input-sm" name="xstatus_keluhan" id="xstatus_keluhan">
    	<option value="">Semua</option>
        <option value="Open">Open</option>
        <option value="Close">Close</option>
	</select>
    <button class="btn btn-sm yellow filter-submit margin-bottom" title="Cari"><i class="fa fa-search"></i> Cari</button>
    <button class="btn btn-sm red filter-cancel" title="Reset"><i class="fa fa-times"></i> Reset</button>
</div>
<table class="table table-striped table-bordered table-hover" id="datatable">
    <thead>
        <tr role="row" class="heading">
            <th width="50">No</th>
            <th>Tanggal</th>
            <th>No Keluhan</th>
            <th>Pengguna</th>
            <th>pemohon</th>
            <th>Status</th>
            <th width="50">&nbsp;</th>
        </tr>
        <tr role="row" class="filter">
            <td>&nbsp;</td>
            <td><input type="text" class="form-control form-filter input-sm input-circle" name="dateinput_char"></td>
            <td><input type="text" class="form-control form-filter input-sm input-circle" name="no_keluahan"></td>
            <td><input type="text" class="form-control form-filter input-sm input-circle" name="pengguna"></td>
            <td><input type="text" class="form-control form-filter input-sm input-circle" name="pemohon"></td>
            <td><input type="text" class="form-control form-filter input-sm input-circle" name="status_keluhan"></td>
            <td align="center">&nbsp;</td>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>