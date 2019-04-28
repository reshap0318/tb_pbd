
<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/controller/koneksi.php'; ?>
<?php
  session_start();

  $satker_id = $_SESSION['satker_id'];
  $nrp = $_SESSION['nrp'];
  $hak_akses = $_SESSION['hak_akses'];
  $nama = null;
  $kepala = null;
  $nrp_kepala = null;
  $bulan = date('n');
  $tahun = date('Y');
  $tanggal = date('d');

  if(isset($_GET['satker_id'])){
    $satker = $_GET['satker_id'];
  }else{
    array_push($_SESSION['pesan'],['eror','Variable Satuan Kerja Tidak Ditemukan']);
    header("location:/tb_pbd/view/laporan/");
  }

  $sql = "Select * from satker where id = '$satker' ";
  if(!$hak_akses==1){
    $sql = "Select * from satker where id = '$satker_id' ";
  }

  $sql .= " Limit 1";
  // die($sql);
  $eksekusi = pg_query($sql);
  while ($data = pg_fetch_assoc($eksekusi)) {
    $nama = $data['nama'];
    $kepala = $data['kepala'];
    $nrp_kepala = $data['nrp'];
    $satker_id = $data['id'];
  }

  if($bulan==1){
    $bulan = "Januari";
  }elseif($bulan==2){
    $bulan = "Februari";
  }elseif($bulan==3){
    $bulan = "Maret";
  }elseif($bulan==4){
    $bulan = "April";
  }elseif($bulan==5){
    $bulan = "Mei";
  }elseif($bulan==6){
    $bulan = "Juni";
  }elseif($bulan==7){
    $bulan = "Juli";
  }elseif($bulan==8){
    $bulan = "Agustus";
  }elseif($bulan==9){
    $bulan = "September";
  }elseif($bulan==10){
    $bulan = "Oktober";
  }elseif($bulan==11){
    $bulan = "November";
  }elseif($bulan==12){
    $bulan = "Desember";
  }

  if($nama==null){
    array_push($_SESSION['pesan'],['eror','Data Tidak Ditemukan']);
    header("location:/tb_pbd/view/laporan/");
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cetak Barang Satuan Kerja <?php echo $nama; ?></title>
    <style type="text/css" media="print">
        @page {
            size: landscape;
        }
    </style>
  </head>
  <body>
      <center>
        <h3>
          Daftar Inventaris
          <br><?php echo $nama; ?>
          <br>Bulan <?php echo $bulan.' '.$tahun; ?>
        </h3>

        <table border="1" style="width:100%">
          <thead>
            <tr>
              <th>No Serial</th>
              <th>Jenis Barang</th>
              <th>Tahun</th>
              <th>Merek</th>
              <th>Kondisi</th>
              <th>Type</th>
              <th>Jumlah Barang</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php

                $sql = "select barang.no_serial, barang_jenis.nama as jenis, barang.tahun_perolehan, merek.nama as merek, barang.kondisi, barang.type, barang.status from satker join barang on satker.id = barang.satker_id join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id where satker_id = '$satker_id' ";
                if($hak_akses==3){
                  $sql = "select barang.no_serial, barang_jenis.nama as jenis, barang.tahun_perolehan, merek.nama as merek, barang.kondisi, barang.type, barang.status from satker join barang on satker.id = barang.satker_id join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join peminjam on barang.no_serial = peminjam.no_serial where satker_id = '$satker_id' AND nrp_peminjam = '$nrp' AND barang.status = '0'";
                }
                $eksekusi = pg_query($sql);
                while ($data = pg_fetch_assoc($eksekusi)) {
            ?>
            <tr>
              <td><?php echo $data['no_serial']; ?></td>
              <td><?php echo $data['jenis']; ?></td>
              <td><?php echo $data['tahun_perolehan']; ?></td>
              <td><?php echo $data['merek']; ?></td>
              <td><?php if($data['kondisi']==1){echo "Baik";}elseif($data['kondisi']==2){echo "Rusak";}elseif($data['kondisi']==3){echo "Rusak Berat";}elseif($data['kondisi']==4){echo "Dihapuskan";}else{echo "Kondisi Tidak Diketahui";} ?></td>
              <td><?php echo $data['type']; ?></td>
              <td>1bh</td>
              <td><?php if($data['status']==1){echo "Ditempat";}elseif($data['status']==0){echo "Dipinjam";}else{echo "Status Tidak Diketahui";} ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </center>
      <br><br>
      <div align="right">
        <table border="1">
          <tr>
            <td style="padding-left:10px;padding-right:10px;">
              <center>
               <?php echo $nama; ?>, <?php echo $tanggal.' '.$bulan.' '.$tahun; ?>
                <br>
                Mengetahui,
                <br>
                <b>Kepala Satuan Kerja</b>
                <br>
                <br><br><br>
                <b> <u><?php echo $kepala; ?></u> </b>
                <br>
                <b>NRP. <?php echo $nrp_kepala; ?></b>
              </center>
            </td>
          </tr>
        </table>
      </div>
  </body>
</html>

<script>
		window.print();
</script>
