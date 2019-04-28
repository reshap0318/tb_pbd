<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php startblock('title') ?> Cari Barang <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Cari Barang</a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Cari Barang
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table class="table table-striped table-bordered nowrap" style="width:100%">
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

                  $merek_id = 0;
                  $jenis_id = 0;

                  if(isset($_GET['merek_id'])){
                      $merek_id = $_GET['merek_id'];
                  }
                  if(isset($_GET['jenis_id'])){
                      $jenis_id = $_GET['jenis_id'];
                  }
                  if(isset($_GET['satker_id'])){
                      if($hak_akses==1){
                        $satker_id = $_GET['satker_id'];
                      }
                  }

                  $sql = "select barang.no_serial, barang.tahun_perolehan, barang_jenis.nama as jenis, merek.nama as merek, satker.nama as satker, barang.kondisi, barang.status from barang join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join satker on barang.satker_id = satker.id where barang.no_serial <> '0' ";

                  if($hak_akses==3){
                    $sql = "select barang.no_serial, barang.tahun_perolehan, barang_jenis.nama as jenis, merek.nama as merek, satker.nama as satker, barang.kondisi, barang.status from barang join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join satker on barang.satker_id = satker.id join peminjam on barang.no_serial = peminjam.no_serial where barang.no_serial <> '0' ";
                    $sql .= "and barang.status = '0' and nrp_peminjam = '$nrp'";
                  }

                  if($merek_id != 'all'){
                      $sql .= " and barang.merek_id = '$merek_id'";
                  }

                  if($jenis_id != 'all'){
                      $sql .= " and barang.jenis_id = '$jenis_id'";
                  }

                  if($satker_id != 'all'){
                      $sql .= " and barang.satker_id = '$satker_id'";
                  }

                  // die($sql);
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
                      <td style="width:100px" class="text-center">
                        <a href="/tb_pbd/view/barang/detail.php?no_serial=<?php echo $data['no_serial']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Detail</a>
                        <?php if($hak_akses!=3){ ?>
                        <a href="/tb_pbd/view/barang/edit.php?no_serial=<?php echo $data['no_serial']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Edit</a>
                        <a href="#" class="btn btn-danger btn-mini waves-effect waves-light" onclick="hapusbarang('<?php echo $data['no_serial']; ?>')">Delete</a>
                        <?php } ?>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
<form class="" id="formdelete" style="display:none" action="/tb_pbd/controller/barangController.php?aksi=delete" method="post">
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

  <script type="text/javascript">
    function hapusbarang(id) {
      if(confirm('yakin ingin menghapus data ini?') == true){
        document.getElementById('delete_id').value = id;
        document.getElementById('formdelete').submit();
      }
    }
  </script>
<?php endblock() ?>
