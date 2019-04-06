<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd/view/");
    }
  }

?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>
<?php startblock('title') ?> Edit Jenis Barang <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd/view/barang">Jenis Barang</a>
<li class="breadcrumb-item"><a href="#!">Edit</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Edit Jenis Barang
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd/controller/jenis_barangController.php?aksi=update" method="post" novalidate>
            <?php
              $id = $_GET['id'];
              $sql = "select * from barang_jenis where id=$id";
              $eksekusi = pg_query($sql);
              while ($data = pg_fetch_assoc($eksekusi)) {
            ?>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php if(isset($data['id'])){echo $data['id'];} ?>"  id="id" name="id" placeholder="ex : 1" readonly>
                    <span class="messages popover-valid"></span>
                </div>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/view/management/jenis_barang/_field.php'; ?>

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
