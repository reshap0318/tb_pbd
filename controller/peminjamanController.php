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
  $nrp_peminjam = null;
  $nrp_pemberi = $_SESSION['nrp'];
  $no_serial = null;
  $keterangan = null;
  $kondisi = 1;

  $aksi = null;
  $status = null;
  $pesan = [];
  $link = '/tb_pbd/view/peminjaman';


  //validasi dan inisiasi
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }else{
    $status = 'eror';
    array_push($_SESSION['pesan'],[$status,'LINK SALAH Periksa LINK']);
  }

  if($aksi=='delete' || $aksi=='update'){
    if(isset($_POST['id'])){
      $id = $_POST['id'];
    }else{
      $status = 'eror';
      array_push($_SESSION['pesan'],[$status,'Pastikan ID Terisi Dengan Benar']);
    }
  }

  if($aksi=='create'||$aksi=='update'){

      if(isset($_POST['no_serial'])){
        // $no_serial = explode(",",$_POST['no_serial']);
        if($aksi=='create'){
          $no_serial = explode(",",$_POST['no_serial']);
        }elseif($aksi=='update'){
          $no_serial = $_POST['no_serial'];
        }
      }else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Pastikan No Serial Terisi Dengan Benar']);
      }

      if(isset($_POST['tanggal'])){
        $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
      }else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Pastikan Tahun Perolehan Terisi Dengan Benar']);
      }

      if(isset($_POST['nrp_peminjam'])){
        $nrp_peminjam = $_POST['nrp_peminjam'];
      }else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Pastikan Jenis Terisi Dengan Benar']);
      }

      if(isset($_POST['keterangan'])){
        $keterangan = $_POST['keterangan'];
      }else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Pastikan keterangan Terisi Dengan Benar']);
      }
  }


  if($aksi=='create' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$status,'Berhasil Menambahkan Peminjaman Barang']);
      for ($i=0; $i < count($no_serial) ; $i++) {
        $sqlkon = "select kondisi from barang where no_serial = '$no_serial[$i]'";
        $eksekusi = pg_query($sqlkon);
        while ($data = pg_fetch_assoc($eksekusi)) {
            $kondisi = $data['kondisi'];
        }

        $sqlupbar = "update barang set status=0 where no_serial='$no_serial[$i]'";
        $eksekusi = pg_query($sqlupbar);

        $sql = "insert INTO public.peminjam(tanggal, kondisi, nrp_peminjam, nrp_pemberi, keterangan, no_serial) VALUES ('$tanggal', $kondisi, '$nrp_peminjam', '$nrp_pemberi', '$keterangan', '$no_serial[$i]')";
      }
  }


  elseif($aksi=='update' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$status,'Berhasil Merubah Peminjaman Barang']);
      if(isset($_POST['no_serial_sebelum'])){
        $no_serial_sebelum = $_POST['no_serial_sebelum'];
        $sqlkon = "select kondisi from barang where no_serial = '$no_serial[0]'";
        $eksekusi = pg_query($sqlkon);
        while ($data = pg_fetch_assoc($eksekusi)) {
            $kondisi = $data['kondisi'];
        }

        if($no_serial!=$no_serial_sebelum){
          $sqlupbar1 = "update barang set status=1 where no_serial='$no_serial_sebelum'";
          $eksekusi1 = pg_query($sqlupbar1);

          $sqlupbar2 = "update barang set status=0 where no_serial='$no_serial[0]'";
          $eksekusi2 = pg_query($sqlupbar2);
        }
      }
      $sql = "update public.peminjam SET tanggal='$tanggal', kondisi=$kondisi, nrp_peminjam='$nrp_peminjam', nrp_pemberi='$nrp_pemberi', keterangan='$keterangan', no_serial='$no_serial[0]' where id=$id";
  }


  elseif($aksi=='delete' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$status,'Berhasil Menghapus Peminjaman Barang']);

      $peminjaman_no_serial = "select no_serial from peminjam where id=$id";
      $eksekusi_no_serial = pg_query($peminjaman_no_serial);
      while ($data = pg_fetch_assoc($eksekusi_no_serial)) {
        $no_serial = $data['no_serial'];
        $sqlupbar = "update barang set status=1 where no_serial='$no_serial'";
        $eksekusi = pg_query($sqlupbar);
      }
      $sql = "delete from peminjam where id = '$id'";
  }

  if($status != 'eror'){
    $eksekusi = pg_query($sql);
  }


  // echo "id = ".$id;
  header('location:'.$link);

  echo "status = ".$status."<br>Pesan = ".$pesan[0]."<br>SQL = ".$sql;
  // return ['status'=>$status,'pesan'=>$pesan];

?>
