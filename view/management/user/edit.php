<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>
<?php startblock('title') ?> Edit Users <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd/view/management/user">Users</a>
<li class="breadcrumb-item"><a href="#!">Edit</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Edit Users
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd/controller/userController.php?aksi=update" method="post" novalidate>
            <?php
              $nrp = $_GET['nrp_nip'];
              $sql = "select * from users";
              $eksekusi = pg_query($sql);
              while ($data = pg_fetch_assoc($eksekusi)) {
            ?>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/view/management/user/_field.php'; ?>

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