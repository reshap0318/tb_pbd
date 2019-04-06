<?php

  if(isset($_SESSION['hak_akses'])){
    if($_SESSION['hak_akses']==1 || $_SESSION['hak_akses']==2){
      header("location:/tb_pbd/view/");
    }
  }

?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>
<?php startblock('title') ?> Create Barang <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd/view/barang/index.php">Barang</a>
<li class="breadcrumb-item"><a href="#!">Create</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Create Barang
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd/controller/barangController.php?aksi=create" method="post" novalidate>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/view/barang/_field.php'; ?>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endblock() ?>
