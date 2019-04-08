<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>
<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd/view/");
    }
  }

?>
<?php startblock('title') ?> Create Users <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd/view/management/user/index.php">User</a>
<li class="breadcrumb-item"><a href="#!">Create</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Create Users
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd/controller/userController.php?aksi=create" method="post" novalidate>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIP / NRP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php if(isset($data['nrp'])){echo $data['nrp'];} ?>"  id="nrp" name="nrp" placeholder="ex : 1611522012" required>
                    <span class="messages popover-valid"></span>
                </div>
            </div>

            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/view/management/user/_field.php'; ?>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endblock() ?>
