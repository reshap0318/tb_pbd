<div class="form-group row">
    <label class="col-sm-2 col-form-label">Penerima</label>
    <div class="col-sm-8">
        <select class="js-example-basic-single" name="nrp_peminjam">
          <?php
            $sql = "select nrp, nama from users";
            if($hak_akses==2){
              $sql = "select nrp, nama from users where satker_id = '$satker_id'";
            }
            $eksekusi = pg_query($sql);
            while ($jenis = pg_fetch_assoc($eksekusi)) {
              if($jenis['nrp']==$data['nrp_peminjam']){
                echo '<option value="'.$jenis['nrp'].'" selected>'.$jenis['nama'].'</option>';
              }else{
                echo '<option value="'.$jenis['nrp'].'">'.$jenis['nama'].'</option>';
              }
            }
          ?>
        </select>
    </div>
  <button type="button" name="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_adduser"> <i class="fa fa-plus"></i> </button>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">No Serial Barang</label>
    <div class="col-sm-8">
        <select id="no_serial" name="no_serial[]" class="js-example-basic-multiple" multiple="multiple" disabled>
          <?php
            $sql = "select no_serial from barang where status='1'";
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
    <label class="col-sm-2 col-form-label">Keterangan</label>
    <div class="col-sm-10">
        <textarea rows="8" cols="80" class="form-control" id="keterangan" name="keterangan" placeholder="ex : apo rancak?"><?php if(isset($data['nama'])){echo $data['keterangan'];} ?></textarea>
        <span class="messages popover-valid"></span>
    </div>
</div>
<input id="hiden" type="hidden" name="no_serial" value="">
