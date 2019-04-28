
<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/controller/koneksi.php'; ?>
<?php
  session_start();

  $satker_id = $_SESSION['satker_id'];
  $nrp = $_SESSION['nrp'];
  $hak_akses = $_SESSION['hak_akses'];
  $nama = null;
  $kepala = null;
  $nrp_kepala = null;
  $tanggal = date('d');

  if( isset($_GET['bulan']) && isset($_GET['tahun']) ){
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
  }else{
    $bulan = date('n');
    $tahun = date('Y');
  }


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
    <title>Cetak Peminjaman Barang Satuan Kerja <?php echo $nama; ?></title>
    <style type="text/css" media="print">
        @page {
            size: landscape;
        }
    </style>
  </head>
  <body>
      <center>
        <h3>
          Daftar Peminjaman Barang
          <br><?php echo $nama; ?>
          <br>Bulan <?php echo $bulan.' '.$tahun; ?>
        </h3>

        <table border="1" style="width:100%">
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
            <?php
                $no=0;
                function cek($id)
                {
                    $sql = "select * from pengembalian where peminjaman_id = '$id'";
                    $eksekusi = pg_query($sql);
                    $total = 0;
                    while ($datas = pg_fetch_assoc($eksekusi)) {
                        $total += 1;
                    }

                    if($total>0){
                      return 'Dikembalikan';
                    }else{
                      return 'Belum Dikembalikan';
                    }
                }

                $sql = "select peminjam.id, users.nama, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal from peminjam join barang on peminjam.no_serial = barang.no_serial join users on peminjam.nrp_peminjam = users.nrp join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id";

                if( isset($_GET['bulan']) && isset($_GET['tahun']) ){
                  $bulan = $_GET['bulan'];
                  $sql .= " where extract(month from tanggal) = $bulan AND extract(year from tanggal) = $tahun";
                }

                if($hak_akses==3){
                  $sql .= " and peminjam.nrp_peminjam = '$nrp'";
                }else{
                  $sql .= " and barang.satker_id='$satker_id'";
                }
                // die($sql);
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
