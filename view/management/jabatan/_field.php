<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kode</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['id'])){echo $data['id'];} ?>"  id="id" name="id" placeholder="ex : 1">
        <span class="messages popover-valid"></span>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['nama'])){echo $data['nama'];} ?>"  id="nama" name="nama" placeholder="ex : KAPOLDA">
        <span class="messages popover-valid"></span>
    </div>
</div>