<?php


  session_start();
  if($_SESSION['status'] == 1){
    if($_SESSION['hak_akses'] == 3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd/view/");
    }
  }else{
    array_push($_SESSION['pesan'],['eror','Anda Belum Login, Silakan Login Terlebih Dahulu']);
    header("location:/tb_pbd/view/auth/login.php");
  }

  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/controller/koneksi.php';
  $id = null;
  $tanggal = null;
  $nrp_penerima = $_SESSION['nrp'];
  $peminjaman_id = null;
  $keterangan = null;
  $kondisi = null;

  $aksi = null;
  $status = null;
  $pesan = [];
  $link = '/tb_pbd/view/pengembalian';


  //validasi dan inisiasi
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }else{
    $status = 'eror';
    array_push($_SESSION['pesan'],[$status,'Pastikan Link Benar']);
  }

  if($aksi=='delete' || $aksi=='update'){
    if(isset($_POST['id'])){
      $id = $_POST['id'];
    }else{
      $status = 'eror';
      array_push($_SESSION['pesan'],[$status,'ID Tidak ditemukan']);
    }
  }

  if($aksi=='create'||$aksi=='update'){

      if(isset($_POST['tanggal'])){
        $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
      }else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Pastikan Tanggal Terisi Dengan Benar']);
      }

      if(isset($_POST['peminjaman_id'])){
        $peminjaman_id = $_POST['peminjaman_id'];
      }else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Pastikan Kode Barang Terisi Dengan Benar']);
      }

      if(isset($_POST['kondisi'])){
        $kondisi = $_POST['kondisi'];
      }else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Pastikan Kondisi Terisi Dengan Benar']);
      }

      if(isset($_POST['keterangan'])){
        $keterangan = $_POST['keterangan'];
      }else{
        $keterangan = '';
      }
  }


  if($aksi=='create' && $status != 'eror'){
        $status = 'berhasil';
        array_push($_SESSION['pesan'],[$status,'Berhasil Pengembalikan Barang']);
        $sqlcarikode = "select barang.no_serial from peminjam join barang on peminjam.no_serial = barang.no_serial where peminjam.id='$peminjaman_id'";
        $eksekusi = pg_query($sqlcarikode);
        while ($data = pg_fetch_assoc($eksekusi)) {
            $kode = $data['no_serial'];
        }

        $sqlupbar = "update barang set status='1', kondisi=$kondisi where no_serial='$kode'";
        $eksekusi = pg_query($sqlupbar);

        $sql = "INSERT INTO public.pengembalian(tanggal, nrp_penerima, kondisi, keterangan, peminjaman_id) VALUES ('$tanggal', '$nrp_penerima', '$kondisi', '$keterangan','$peminjaman_id');";
  }


  elseif($aksi=='update' && $status != 'eror'){
        $status = 'berhasil';
        array_push($_SESSION['pesan'],[$status,'Berhasil Merubah Barang']);

        $kondisi_sekarang = null;
        $no_serial_sekarang = null;
        $sql_data_peminjaman = "select kondisi, no_serial from peminjam where id='$peminjaman_id'";
        $eksekusi_data_peminjam = pg_query($sql_data_peminjaman);
        while ($data = pg_fetch_assoc($eksekusi_data_peminjam)) {
            $no_serial_sekarang = $data['no_serial'];
        }
        $sqlupbar2 = "update barang set status='1', kondisi=$kondisi where no_serial='$no_serial_sekarang'";
        $eksekusi2 = pg_query($sqlupbar2);

        if(isset($_POST['peminjaman_id_sebelum'])){
          $peminjaman_id_sebelum = $_POST['peminjaman_id_sebelum'];
          if($peminjaman_id!=$peminjaman_id_sebelum){

            $kondisi_sebelum = null;
            $no_serial_sebelum = null;
            $sql_data_peminjaman = "select kondisi, no_serial from peminjam where id='$peminjaman_id_sebelum'";
            $eksekusi_data_peminjam = pg_query($sql_data_peminjaman);
            while ($data = pg_fetch_assoc($eksekusi_data_peminjam)) {
                $kondisi_sebelum = $data['kondisi'];
                $no_serial_sebelum = $data['no_serial'];
            }

            $sqlupbar1 = "update barang set status='0', kondisi=$kondisi_sebelum where no_serial='$no_serial_sebelum'";
            $eksekusi1 = pg_query($sqlupbar1);
          }
        }
        $sql = "update public.pengembalian SET tanggal='$tanggal', nrp_penerima='$nrp_penerima', kondisi='$kondisi', keterangan='$keterangan', peminjaman_id='$peminjaman_id' WHERE id='$id'";
        // die($sql);
  }


  elseif($aksi=='delete' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$status,'Berhasil Menghapus Pengembalian']);
      $data_peminjam = "select peminjam.kondisi, peminjam.no_serial from pengembalian join peminjam on pengembalian.peminjaman_id = peminjam.id where pengembalian.id='$id'";
      $eksekusi_data_peminjam = pg_query($data_peminjam);
      $kondisi = null;
      $no_serial =null;
      while ($data = pg_fetch_assoc($eksekusi_data_peminjam)) {
          $kondisi = $data['kondisi'];
          $no_serial = $data['no_serial'];
      }
      // die(var_dump([$kondisi,$no_serial]));
      $sql_rubah_barang = "update barang set kondisi = $kondisi, status = '0' where no_serial = '$no_serial'";
      $eksekusi_sql_rubah_barang = pg_query($sql_rubah_barang);
      $sql = "delete from pengembalian where id = '$id'";
  }

  if($status != 'eror'){
    $eksekusi = pg_query($sql);
  }


  // echo "id = ".$id;
  header('location:'.$link);

  echo "status = ".$status."<br>Pesan = ".$pesan[0]."<br>SQL = ".$sql;
  // return ['status'=>$status,'pesan'=>$pesan];

?>
