<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php

  if(isset($hak_akses)){
    if($hak_akses!=1){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd/view/");
    }
  }

?>
<?php startblock('title') ?> Create Jabatan <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd/view/management/jabatan/index.php">Jabatan</a>
<li class="breadcrumb-item"><a href="#!">Create</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Create Jabatan
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd/controller/jabatanController.php?aksi=create" method="post" novalidate>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php if(isset($data['id'])){echo $data['id'];} ?>"  id="id" name="id" placeholder="ex : 1" required>
                    <span class="messages popover-valid"></span>
                </div>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/view/management/jabatan/_field.php'; ?>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endblock() ?>
