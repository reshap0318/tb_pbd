<?php
if($hak_akses==1){
?>
  <div class="form-group row">
      <label class="col-sm-2 col-form-label">Satuan Kerja</label>
      <div class="col-sm-10">
          <select class="form-control" name="satker_id" required>
            <?php
              $sql = "select id, nama from satker";
              $eksekusi = pg_query($sql);
              while ($satker = pg_fetch_assoc($eksekusi)) {
                if($satker['id']==$data['satker_id']){
                  echo '<option value="'.$satker['id'].'" selected>'.$satker['nama'].'</option>';
                }else{
                  echo '<option value="'.$satker['id'].'">'.$satker['nama'].'</option>';
                }
              }
            ?>
          </select>
          <span class="messages popover-valid"></span>
      </div>
  </div>
<?php } ?>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Tahun Perolehan</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['tahun_perolehan'])){echo $data['tahun_perolehan'];} ?>"  id="tahun_perolehan" name="tahun_perolehan" placeholder="ex : 2019" required>
        <span class="messages popover-valid"></span>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Jenis</label>
    <div class="col-sm-10">
        <select class="form-control " name="jenis_id" required>
          <?php
            $sql = "select id, nama from barang_jenis";
            $eksekusi = pg_query($sql);
            while ($jenis = pg_fetch_assoc($eksekusi)) {
              if($jenis['id']==$data['jenis_id']){
                echo '<option value="'.$jenis['id'].'" selected>'.$jenis['nama'].'</option>';
              }else{
                echo '<option value="'.$jenis['id'].'">'.$jenis['nama'].'</option>';
              }
            }
          ?>
        </select>
        <span class="messages popover-valid"></span>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Merek</label>
    <div class="col-sm-10">
        <select class="form-control " name="merek_id" required>
          <?php
            $sql = "select id, nama from merek";
            $eksekusi = pg_query($sql);
            while ($merek = pg_fetch_assoc($eksekusi)) {
              if($merek['id']==$data['merek_id']){
                echo '<option value="'.$merek['id'].'" selected>'.$merek['nama'].'</option>';
              }else{
                echo '<option value="'.$merek['id'].'">'.$merek['nama'].'</option>';
              }
            }
          ?>
        </select>
        <span class="messages popover-valid"></span>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Type</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['type'])){echo $data['type'];} ?>"  id="type" name="type" placeholder="ex : X550I" required>
        <span class="messages popover-valid"></span>
    </div>
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
        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="ex : laptopnya ada lecet di bagian samping kanan" required rows="8" cols="80"><?php if(isset($data['keterangan'])){echo $data['keterangan'];} ?></textarea>
        <span class="messages popover-valid"></span>
    </div>
</div>
