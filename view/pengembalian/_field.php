<div class="form-group row">
    <label class="col-sm-2 col-form-label">No Serial Barang</label>
    <div class="col-sm-8">
        <select id="no_serial" name="no_serial" class="js-example-basic-multiple" multiple="multiple" disabled>
          <?php
            $sql = "select no_serial from barang where status=0";
            $eksekusi = pg_query($sql);
            while ($barang = pg_fetch_assoc($eksekusi)) {
              echo '<option value="'.$barang['no_serial'].'">'.$barang['no_serial'].'</option>';
            }
          ?>
        </select>
    </div>
    <button type="button" name="button" class="btn btn-success" data-toggle="modal" data-target="#modal_pencarian"> <i class="fa fa-search"></i> </button>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kondisi</label>
    <div class="col-sm-10 form-radio">
      <div class="radio radio-inline">
          <label>
              <input type="radio" name="kondisi" value="1" <?php if(isset($data['kondisi'])){if($data['kondisi']==1){echo "checked";}} ?>>
              <i class="helper"></i>Baik
          </label>
      </div>
      <div class="radio radiofill radio-warning radio-inline">
          <label>
              <input type="radio" name="kondisi" value="2" <?php if(isset($data['kondisi'])){if($data['kondisi']==2){echo "checked";}} ?>>
              <i class="helper"></i>Rusak
          </label>
      </div>
      <div class="radio radiofill radio-danger radio-inline">
          <label>
              <input type="radio" name="kondisi" value="3" <?php if(isset($data['kondisi'])){if($data['kondisi']==3){echo "checked";}} ?>>
              <i class="helper"></i>Rusak Berat
          </label>
      </div>
      <div class="radio radiofill radio-inverse radio-inline">
          <label>
              <input type="radio" name="kondisi" value="4" <?php if(isset($data['kondisi'])){if($data['kondisi']==4){echo "checked";}} ?>>
              <i class="helper"></i>Dihapuskan
          </label>
      </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Keterangan</label>
    <div class="col-sm-10">
        <textarea rows="8" cols="80" class="form-control" id="keterangan" name="keterangan" placeholder="ex : apo rancak?"><?php if(isset($data['nama'])){echo $data['keterangan'];} ?></textarea>
        <span class="messages popover-valid"></span>
    </div>
</div>
<input id="hiden" type="hidden" name="peminjaman_id" value="">
