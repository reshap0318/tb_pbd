<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd/view/");
    }
  }

?>
<?php startblock('title') ?> Users Management <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Users Management</a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Users Management
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tableuser" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr>
                      <th style="width:20px" class="text-center">NO</th>
                      <th>NRP / NIP</th>
                      <th>Nama</th>
                      <th>Satuan Kerja</th>
                      <th>Pangkat</th>
                      <th>Status</th>
                      <th style="width:100px">Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=0;
                  $sql = "select users.nrp, users.nama as nama, satker.nama as satker, pangkat.nama as pangkat, users.no_telepon, users.hak_akses from users join satker on users.satker_id = satker.id join pangkat on users.pangkat_id = pangkat.id";
                  if($hak_akses==2){
                    $sql = "select users.nrp, users.nama as nama, satker.nama as satker, pangkat.nama as pangkat, users.no_telepon, users.hak_akses from users join satker on users.satker_id = satker.id join pangkat on users.pangkat_id = pangkat.id where users.satker_id = '$satker_id' AND users.nrp!='admin'";
                  }
                  $eksekusi = pg_query($sql);
                  while ($data = pg_fetch_assoc($eksekusi)) {
                ?>
                  <tr>
                      <td style="width:20px" class="text-center"><?php echo ++$no;?></td>
                      <td><?php echo $data['nrp'];?></td>
                      <td><?php echo $data['nama']?></td>
                      <td><?php echo $data['satker']?></td>
                      <td><?php echo $data['pangkat']?></td>
                      <td><?php if($data['hak_akses'] == 1 ){echo "Admin";}elseif($data['hak_akses'] == 2){echo "Pemilik";}elseif($data['hak_akses'] == 3){echo "Peminjam";}?></td>
                      <td style="width:100px">
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="/tb_pbd/view/management/user/detail.php?nrp_nip=<?php echo $data['nrp']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Detail</a>
                        <?php } ?>
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="/tb_pbd/view/management/user/edit.php?nrp_nip=<?php echo $data['nrp']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Edit</a>
                        <?php } ?>
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="#" class="btn btn-danger btn-mini waves-effect waves-light" onclick="hapus(<?php echo $data['nrp']; ?>)">Delete</a>
                        <?php } ?>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
<form class="" id="formdelete" style="display:none" action="/tb_pbd/controller/userController.php?aksi=delete" method="post">
  <input type="text" name="nrp" value="" id="delete_id">
</form>
      </div>
  </div>
</div>
<?php endblock() ?>

<?php startblock('table') ?>
  <!-- info lebih lanjut bisa di cek di : -->
  <!--editor/assets/pages/data-table/js/data-table-custom.js"-->
  <script type="text/javascript">
      $('#tableuser').DataTable(
        {
        "info":     false,
        dom: 'Bfrtip',
        buttons: [
        {
            text: 'Tambah User',
            className: 'btn-success',
            action: function(e, dt, node, config)
            {
              window.location.assign("/tb_pbd/view/management/user/create.php");
            }
        },
        {
            extend: 'copy',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        },
        {
            extend: 'print',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        },
        {
            extend: 'excel',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        },
        {
            extend: 'pdf',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        }]
      });
  </script>

  <script type="text/javascript">
    function hapus(id) {
      if(confirm('yakin ingin menghapus data ini?') == true){
        document.getElementById('delete_id').value = id;
        document.getElementById('formdelete').submit();
      }
    }
  </script>
<?php endblock() ?>
