<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php startblock('title') ?> Cari Peminjaman <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Cari Peminjaman</a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Cari Peminjaman
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tblpeminjaman" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr>
                      <th style="width:20px" class="text-center">NO</th>
                      <th>Nama</th>
                      <th>No Serial</th>
                      <th>Jenis</th>
                      <th>Merek</th>
                      <th>Tanggal</th>
                      <th>Keterangan</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=0;
                  function cek($id)
                  {
                      $sql = "select * from pengembalian where peminjaman_id = $id";
                      $eksekusi = pg_query($sql);
                      $total = 0;
                      while ($datas = pg_fetch_assoc($eksekusi)) {
                          $total += 1;
                      }

                      if($total>0){
                        return '<label class="label label-lg label-info">Dikembalikan</label>';
                      }else{
                        return '<label class="label label-lg label-danger">Belum Dikembalikan</label>';
                      }
                  }


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

                  $sql = "select peminjam.id, users.nama, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal from peminjam join barang on peminjam.no_serial = barang.no_serial join users on peminjam.nrp_peminjam = users.nrp join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id where barang.no_serial <> '0'";

                  if($merek_id != 'all'){
                      $sql .= " and barang.merek_id = $merek_id";
                  }

                  if($jenis_id != 'all'){
                      $sql .= " and barang.jenis_id = $jenis_id";
                  }

                  if($satker_id != 'all'){
                      $sql .= " and barang.satker_id = $satker_id";
                  }

                  if($nama!=""){
                    $sql .= " and users.nama like '%$nama%'";
                  }

                  if($no_serial!=""){
                    $sql .= " and barang.no_serial = '$no_serial'";
                  }

                  if($tanggal!=""){
                    $sql .= " and peminjam.tanggal = '$tanggal'";
                  }



                  if($hak_akses==3){
                    $sql .= " and nrp = $nrp";
                  }

                  $eksekusi = pg_query($sql);
                  while ($data = pg_fetch_assoc($eksekusi)) {
                ?>
                  <tr>
                      <td style="width:20px" class="text-center"><?php echo ++$no;?></td>
                      <td><?php echo $data['nama'];?></td>
                      <td><?php echo $data['no_serial'];?></td>
                      <td><?php echo $data['jenis'];?></td>
                      <td><?php echo $data['merek'];?></td>
                      <td><?php echo $data['tanggal'];?></td>
                      <td class="text-center"><?php echo cek($data['id']);?></td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
      </div>
  </div>
</div>
<div class="text-center">
  <a href="/tb_pbd/view/peminjaman/" class="btn btn-primary waves-effect waves-light">Back</a>
</div>
<?php endblock() ?>
