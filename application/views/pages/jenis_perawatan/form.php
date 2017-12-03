<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form"  method="post" action="<?= base_url() ?>Ms_jenis_perawatan/simpan_json" id="form">
            <input type="hidden" name="id_jenis_perawatan" id="id_jenis_perawatan" />
            <div class="form-group">
                <label for="kategori" class="col-lg-3 control-label">Jenis Perawatan <span class="required" aria-required="true">*</span></label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" value="" name="perawatan" id="perawatan">
                </div>
            </div>
            <div class="form-group">
                <label for="kategori" class="col-lg-3 control-label">Group <span class="required" aria-required="true">*</span></label>
                <div class="col-lg-9">
                    <select id="id_group" name="id_group" class="form-control">
                    	<?php foreach($group as $row){ ?>
                        	<option value="<?= $row->id_group ?>"><?= $row->group ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>