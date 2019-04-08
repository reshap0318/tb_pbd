<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd/view/");
    }
  }

?>
<?php startblock('title') ?> Edit Pengembalian <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd/view/pengembalian">Pengembalian</a>
<li class="breadcrumb-item"><a href="#!">Edit</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Edit Pengembalian
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd/controller/pengembalianController.php?aksi=update" method="post" novalidate>
            <?php
              $id = $_GET['id'];
              $sql = "select pengembalian.*, peminjam.no_serial from pengembalian join peminjam on pengembalian.peminjaman_id = peminjam.id where pengembalian.id=$id";
              $eksekusi = pg_query($sql);
              while ($data = pg_fetch_assoc($eksekusi)) {
            ?>
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <input type="hidden" name="peminjaman_id_sebelum" value="<?php echo $data['peminjaman_id']; ?>">
            <div class="row form-group">
                <div class="col-sm-2 col-form-label">
                    <label class="col-form-label">Tanggal</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" name="tanggal" class="form-control" value="<?php if(isset($data['tanggal'])){echo $data['tanggal'];} ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Serial Barang</label>
                <div class="col-sm-10">
                    <select onchange="ganti()" id="peminjaman_id" name="peminjaman_id" class="js-example-basic-single">
                      <?php
                        $peminjaman_id = $data['peminjaman_id'];
                        $sql = "select peminjam.id, users.nama, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal from barang join peminjam on peminjam.no_serial = barang.no_serial join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join users on peminjam.nrp_peminjam = users.nrp where barang.status = 0 OR peminjam.id=$peminjaman_id";
                        if($hak_akses==2){
                          $sql = "select peminjam.id, users.nama, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal from barang join peminjam on peminjam.no_serial = barang.no_serial join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join users on peminjam.nrp_peminjam = users.nrp where barang.status = 0 OR peminjam.id=$peminjaman_id AND satker_id = $satker_id";
                        }
                        $eksekusi = pg_query($sql);
                        while ($barang = pg_fetch_assoc($eksekusi)) {
                          if($barang['id']==$data['peminjaman_id']){
                            echo '<option value="'.$barang['id'].'" selected>'.$barang['no_serial'].' - '.$barang['jenis'].' - '.$barang['merek'].' - '.$barang['tanggal'].'</option>';
                          }else{
                            echo '<option value="'.$barang['id'].'">'.$barang['no_serial'].' - '.$barang['jenis'].' - '.$barang['merek'].' - '.$barang['tanggal'].'</option>';
                          }
                        }
                      ?>
                    </select>
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
                    <textarea rows="8" cols="80" class="form-control" id="keterangan" name="keterangan" placeholder="ex : apo rancak?"><?php if(isset($data['keterangan'])){echo $data['keterangan'];} ?></textarea>
                    <span class="messages popover-valid"></span>
                </div>
            </div>
            <?php } ?>
            <div class="row">
                <label class="col-sm-2"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<input id="hiden" type="hidden" name="peminjaman_id" value="">
<?php endblock() ?>

<?php startblock('script') ?>

  <script type="text/javascript">
      document.getElementById('hiden').value = $('#peminjaman_id').val();
      function ganti() {
        document.getElementById('hiden').value = $('#peminjaman_id').val();
      }
  </script>

<?php endblock() ?>
