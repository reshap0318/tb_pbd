<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>
<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd/view/");
    }
  }

?>
<?php startblock('title') ?> Edit Peminjaman <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd/view/peminjaman">Peminjaman</a>
<li class="breadcrumb-item"><a href="#!">Edit</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Edit Peminjaman
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd/controller/peminjamanController.php?aksi=update" method="post" novalidate>
            <?php
              $id = $_GET['id'];
              $sql = "select * from peminjam where id=$id";
              if($hak_akses==2){
                $sql = "select peminjam.* from peminjam join barang on peminjam.no_serial = barang.no_serial where id=$id AND satker_id=$satker_id";
              }
              $eksekusi = pg_query($sql);
              while ($data = pg_fetch_assoc($eksekusi)) {
            ?>
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <input type="hidden" name="no_serial_sebelum" value="<?php echo $data['no_serial']; ?>">
            <div class="row form-group">
                <div class="col-sm-2 col-form-label">
                    <label class="col-form-label">Tanggal</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" name="tanggal" class="form-control" value="<?php if(isset($data['tanggal'])){echo $data['tanggal'];} ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Penerima</label>
                <div class="col-sm-8">
                    <select class="js-example-basic-single" name="nrp_peminjam">
                      <?php
                        $sql = "select nrp, nama from users";
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
                <div class="col-sm-10">
                    <select onchange="ganti()" id="no_serial" name="no_serial[]" class="js-example-basic-multiple" multiple="multiple">
                      <?php
                        $no_serial = $data['no_serial'];
                        $sql = "select no_serial from barang where status=1 OR no_serial='$no_serial'";
                        $eksekusi = pg_query($sql);
                        while ($barang = pg_fetch_assoc($eksekusi)) {
                          if($barang['no_serial']==$data['no_serial']){
                            echo '<option value="'.$barang['no_serial'].'" selected>'.$barang['no_serial'].'</option>';
                          }else{
                            echo '<option value="'.$barang['no_serial'].'">'.$barang['no_serial'].'</option>';
                          }
                        }
                      ?>
                    </select>
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
<input id="hiden" type="hidden" name="no_serial" value="">
<?php endblock() ?>

<?php startblock('script') ?>

  <script type="text/javascript">
      document.getElementById('hiden').value = $('#no_serial').val();
      function ganti() {
        document.getElementById('hiden').value = $('#no_serial').val();
      }
  </script>

<?php endblock() ?>
