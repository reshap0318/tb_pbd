<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd/view/");
    }
  }

?>
<?php startblock('title') ?> Edit Barang <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd/view/barang">Barang</a>
<li class="breadcrumb-item"><a href="#!">Edit</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Edit Barang
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd/controller/barangController.php?aksi=update" method="post" novalidate>
            <?php
              $no_serial = $_GET['no_serial'];
              $sql = "select * from barang where no_serial='$no_serial'";
              if($hak_akses==2){
                $sql = "select * from barang where no_serial='$no_serial' AND satker_id=$satker_id";
              }
              $eksekusi = pg_query($sql);
              while ($data = pg_fetch_assoc($eksekusi)) {
            ?>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Serial</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php if(isset($data['no_serial'])){echo $data['no_serial'];} ?>"  id="no_serial" name="no_serial" placeholder="ex : PTD.1.1.001" required readonly>
                    <span class="messages popover-valid"></span>
                </div>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/view/barang/_field.php'; ?>

            <<?php } ?>
            <div class="row">
                <label class="col-sm-2"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endblock() ?>
