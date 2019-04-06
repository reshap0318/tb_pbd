<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php startblock('title') ?> Show Barang <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Show Barang</a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Show Barang
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tblbarang" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr>
                      <th style="width:20px" class="text-center">No Serial</th>
                      <th>Tahun Perolehan</th>
                      <th>Jenis</th>
                      <th>Merek</th>
                      <th>Satuan Kerja</th>
                      <th>Kondisi</th>
                      <th>Status</th>
                      <th style="width:100px">Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                  $satker_id = isset($_GET['satker_id'];
                  $nrp = isset($_GET['nrp'];
                  if(isset($_GET['kategori'])){
                    $id = $_GET['kategori'];
                    $sql = "select barang.no_serial, barang.tahun_perolehan, barang_jenis.nama as jenis, merek.nama as merek, satker.nama as satker, barang.kondisi, barang.status from barang join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join satker on barang.satker_id = satker.id where barang.jenis_id=$id";
                    if($_SESSION['hak_akses']==2){
                      $sql = "select barang.no_serial, barang.tahun_perolehan, barang_jenis.nama as jenis, merek.nama as merek, satker.nama as satker, barang.kondisi, barang.status from barang join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join satker on barang.satker_id = satker.id where barang.jenis_id=$id AND satker_id=$satker_id";
                    }elseif($_SESSION['hak_akses']==3){
                      $sql = "select barang.no_serial, barang.tahun_perolehan, barang_jenis.nama as jenis, merek.nama as merek, satker.nama as satker, barang.kondisi, barang.status from barang join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join satker on barang.satker_id = satker.id where barang.jenis_id=$id AND satker_id=$satker_id AND nrp_peminjam='$nrp'";
                    }

                  }elseif(isset($_GET['merek'])){
                    $id = $_GET['merek'];
                    $sql = "select barang.no_serial, barang.tahun_perolehan, barang_jenis.nama as jenis, merek.nama as merek, satker.nama as satker, barang.kondisi, barang.status from barang join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join satker on barang.satker_id = satker.id where barang.merek_id=$id";
                    if($_SESSION['hak_akses']==2){
                      $sql = "select barang.no_serial, barang.tahun_perolehan, barang_jenis.nama as jenis, merek.nama as merek, satker.nama as satker, barang.kondisi, barang.status from barang join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join satker on barang.satker_id = satker.id where barang.merek_id=$id AND satker_id=$satker_id";
                    }elseif($_SESSION['hak_akses']==3){
                      $sql = "select barang.no_serial, barang.tahun_perolehan, barang_jenis.nama as jenis, merek.nama as merek, satker.nama as satker, barang.kondisi, barang.status from barang join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join satker on barang.satker_id = satker.id where barang.merek_id=$id AND satker_id=$satker_id AND nrp_peminjam='$nrp'";
                    }
                  }
                  
                  $eksekusi = pg_query($sql);
                  while ($data = pg_fetch_assoc($eksekusi)) {
                ?>
                  <tr>
                      <td><?php echo $data['no_serial'];?></td>
                      <td><?php echo $data['tahun_perolehan'];?></td>
                      <td><?php echo $data['jenis'];?></td>
                      <td><?php echo $data['merek'];?></td>
                      <td><?php echo $data['satker'];?></td>
                      <td><?php if($data['kondisi'] == 1 ){echo "Baik";}elseif($data['kondisi'] == 2){echo "Rusak";}elseif($data['kondisi'] == 3){echo "Rusak Parah";}elseif($data['kondisi'] == 4){echo "Dihapuskan";}?></td>
                      <td><?php if($data['status'] == 1 ){echo "Tersedia";}elseif($data['status'] == 0){echo "Dipinjam";}?></td>
                      <td style="width:100px">
                        <a href="/tb_pbd/view/barang/view.php?no_serial=<?php echo $data['no_serial']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Detail</a>
                        <a href="/tb_pbd/view/barang/edit.php?no_serial=<?php echo $data['no_serial']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Edit</a>
                        <a href="#" class="btn btn-danger btn-mini waves-effect waves-light" onclick="hapus(<?php echo $data['id']; ?>)">Delete</a>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
<form class="" id="formdelete" style="display:none" action="/tb_pbd/controller/jenis_barangController.php?aksi=delete" method="post">
  <input type="text" name="no_serial" value="" id="delete_id">
</form>
      </div>
  </div>
</div>
<div class="text-center">
  <a href="/tb_pbd/view/barang/" class="btn btn-primary waves-effect waves-light">Back</a>
</div>
<?php endblock() ?>

<?php startblock('table') ?>
  <!-- info lebih lanjut bisa di cek di : -->
  <!--editor/assets/pages/data-table/js/data-table-custom.js"-->
  <script type="text/javascript">
      $('#tblbarang').DataTable(
        {
        "info":     false,
        dom: 'Bfrtip',
        buttons: [
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
