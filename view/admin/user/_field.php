  <div class="form-group row">
      <label class="col-sm-2 col-form-label">NIP / NRP</label>
      <div class="col-sm-10">
          <input type="text" class="form-control" value="<?php if(isset($data['nrp'])){echo $data['nrp'];} ?>"  id="nrp" name="nrp" placeholder="ex : 1611522012">
          <span class="messages popover-valid"></span>
      </div>
  </div>
  <div class="form-group row">
      <label class="col-sm-2 col-form-label">Nama</label>
      <div class="col-sm-10">
          <input type="text" class="form-control" value="<?php if(isset($data['nama'])){echo $data['nama'];} ?>"  id="nama" name="nama" placeholder="ex : Reinaldo Shandev Pratama">
          <span class="messages popover-valid"></span>
      </div>
  </div>

  <div class="form-group row">
      <label class="col-sm-2 col-form-label">Satuan Kerja</label>
      <div class="col-sm-10">
          <select class="form-control js-example-basic-hide-search" name="satker_id">
            <?php
              $sql = "select id, nama from satker";
              $eksekusi = pg_query($sql);
              while ($satker = pg_fetch_assoc($eksekusi)) {
                if($satker['id']==$data['satker_id']){
                  echo '<option value="'.$satker['id'].' selected">'.$satker['nama'].'</option>';
                }else{
                  echo '<option value="'.$satker['id'].'">'.$satker['nama'].'</option>';
                }
              }
            ?>
          </select>
          <span class="messages popover-valid"></span>
      </div>
  </div>

  <div class="form-group row">
      <label class="col-sm-2 col-form-label">Jabatan</label>
      <div class="col-sm-10">
        <select class="form-control js-example-basic-hide-search" name="jabatan_id">
          <?php
            $sql = "select id, nama from jabatan";
            $eksekusi = pg_query($sql);
            while ($jabatan = pg_fetch_assoc($eksekusi)) {
              if($jabatan['id']==$data['jabatan_id']){
                echo '<option value="'.$jabatan['id'].' selected">'.$jabatan['nama'].'</option>';
              }else{
                echo '<option value="'.$jabatan['id'].'">'.$jabatan['nama'].'</option>';
              }
            }
          ?>
        </select>
        <span class="messages popover-valid"></span>
      </div>
  </div>

  <div class="form-group row">
      <label class="col-sm-2 col-form-label">Pangkat</label>
      <div class="col-sm-10">
        <select class="form-control js-example-basic-hide-search" name="pangkat_id">
          <?php
            $sql = "select id, nama from pangkat";
            $eksekusi = pg_query($sql);
            while ($pangkat = pg_fetch_assoc($eksekusi)) {
              if($pangkat['id']==$data['pangkat_id']){
                echo '<option value="'.$pangkat['id'].' selected">'.$pangkat['nama'].'</option>';
              }else{
                echo '<option value="'.$pangkat['id'].'">'.$pangkat['nama'].'</option>';
              }
            }
          ?>
        </select>
        <span class="messages popover-valid"></span>
      </div>
  </div>

  <div class="form-group row">
      <label class="col-sm-2 col-form-label">password</label>
      <div class="col-sm-10">
          <input type="text" class="form-control" value=""  id="password" name="password" placeholder="*******">
          <span class="messages popover-valid"></span>
      </div>
  </div>


  <div class="form-group row">
      <label class="col-sm-2 col-form-label">No Telepon</label>
      <div class="col-sm-10">
          <input type="text" class="form-control" value="<?php if(isset($data['no_telepon'])){echo $data['no_telepon'];} ?>"  id="no_telepon" name="no_telepon" placeholder="ex : 08126719212">
          <span class="messages popover-valid"></span>
      </div>
  </div>

  <div class="form-group row">
      <label class="col-sm-2 col-form-label">Alamat</label>
      <div class="col-sm-10">
          <textarea class="form-control" value="<?php if(isset($data['alamat'])){echo $data['alamat'];} ?>"  id="alamat" name="alamat" placeholder="ex : jalan rambun bulan no 17 padang" rows="8" cols="80"></textarea>
          <span class="messages popover-valid"></span>
      </div>
  </div>

  <div class="form-group row">
      <label class="col-sm-2 col-form-label">Foto</label>
      <div class="col-sm-10">
        <div class="input-group input-group-button">
            <span class="input-group-addon btn btn-primary" id="basic-addon9" onclick="document.getElementById('foto').click()">
                <input id="foto" type="file" name="foto" onchange="document.getElementById('tfoto').value = this.value;" style="display:none">
                <span class="">Upload</span>
            </span>
            <input onclick="document.getElementById('foto').click()" id="tfoto" type="text" class="form-control" placeholder="Upload Foto yang Rancak Disiko">
        </div>
        <span class="messages popover-valid"></span>
      </div>
  </div>
