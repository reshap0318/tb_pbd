<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php startblock('title') ?> Cari Pengembalian <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!"> Cari Pengembalian</a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
 Cari Pengembalian
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tblpengembalian" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr>
                      <th style="width:20px" class="text-center">NO</th>
                      <th>Pengembalian</th>
                      <th>No Serial</th>
                      <th>Jenis</th>
                      <th>Merek</th>
                      <th>Kondisi</th>
                      <th>Peminjaman</th>
                      <th style="width:100px">Nama Peminjam</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=0;

                  $nama = "";
                  $no_serial = "";
                  $merek_id = "all";
                  $jenis_id = "all";
                  $satker_id = "all";
                  $tanggal = "";

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
                  if(isset($_GET['nama'])){
                    $nama = $_GET['nama'];
                  }
                  if(isset($_GET['tanggal'])){
                    $tanggal = $_GET['tanggal'];
                  }
                  if(isset($_GET['no_serial'])){
                    $no_serial = $_GET['no_serial'];
                  }

                  $sql = "select pengembalian.id, users.nama, pengembalian.tanggal as tglkembali, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal as tglpinjam, pengembalian.kondisi from pengembalian join peminjam on pengembalian.peminjaman_id = peminjam.id join barang on peminjam.no_serial = barang.no_serial join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id join users on peminjam.nrp_peminjam = users.nrp where  barang.no_serial <> '0'";

                  if($merek_id != 'all'){
                      $sql .= " and barang.merek_id = '$merek_id'";
                  }

                  if($jenis_id != 'all'){
                      $sql .= " and barang.jenis_id = '$jenis_id'";
                  }

                  if($satker_id != 'all'){
                      $sql .= " and barang.satker_id = '$satker_id'";
                  }

                  if($nama!=""){
                    $sql .= " and users.nama like '%$nama%'";
                  }

                  if($no_serial!=""){
                    $sql .= " and barang.no_serial = '$no_serial'";
                  }

                  if($tanggal!=""){
                    $sql .= " and pengembalian.tanggal = '$tanggal'";
                  }

                  $eksekusi = pg_query($sql);
                  while ($data = pg_fetch_assoc($eksekusi)) {
                ?>
                  <tr>
                      <td style="width:20px" class="text-center"><?php echo ++$no;?></td>
                      <td><?php echo $data['tglkembali'];?></td>
                      <td><?php echo $data['no_serial'];?></td>
                      <td><?php echo $data['jenis'];?></td>
                      <td><?php echo $data['merek'];?></td>
                      <td><?php if($data['kondisi'] == 1 ){echo "Baik";}elseif($data['kondisi'] == 2){echo "Rusak";}elseif($data['kondisi'] == 3){echo "Rusak Parah";}elseif($data['kondisi'] == 4){echo "Dihapuskan";}?></td>
                      <td><?php echo $data['tglpinjam'];?></td>
                      <td style="width:100px"><?php echo $data['nama'];?></td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
      </div>
  </div>
</div>
<div class="text-center">
  <a href="/tb_pbd/view/pengembalian/" class="btn btn-primary waves-effect waves-light">Back</a>
</div>
<?php endblock() ?>
