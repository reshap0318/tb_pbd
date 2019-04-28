<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['nama'])){echo $data['nama'];} ?>"  id="nama" name="nama" placeholder="ex : POLRES TANAH DATAR" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kepala</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['kepala'])){echo $data['kepala'];} ?>"  id="kepala" name="kepala" placeholder="ex : Reinaldo Shandev Pratama" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">NRP Kepala</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['nrp'])){echo $data['nrp'];} ?>"  id="nrp" name="nrp" placeholder="ex : 1611522012 required">
        <span class="messages popover-valid"></span>
    </div>
</div>
