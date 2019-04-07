<?php

  session_start();
  if($_SESSION['status']==1){
    if($_SESSION['hak_akses']==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd/view/");
    }
  }else{
    array_push($_SESSION['pesan'],['eror','Anda Belum Login, Silakan Login Terlebih Dahulu']);
    header("location:/tb_pbd/view/auth/login.php");
  }

  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/controller/koneksi.php';
  $no_serial = null;
  $tahun_perolehan = null;
  $jenis_id = null;
  $merek_id = null;
  $type = null;
  $kondisi = null;
  $keterangan = null;

  $aksi = null;
  $status = null;
  $pesan = [];
  $link = '/tb_pbd/view/barang';


  //validasi dan inisiasi
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }else{
    $status = 'eror';
    array_push($_SESSION['pesan'],[$status,'LINK SALAH Periksa LINK']);
  }

  if(isset($_POST['satker_id'])){
    $satker_id = $_POST['satker_id'];
  }else{
    $satker_id = $_SESSION['satker_id'];
  }

  if(isset($_POST['no_serial'])){
    $no_serial = $_POST['no_serial'];
  }else{
    $status = 'eror';
    array_push($_SESSION['pesan'],[$status,'Pastikan No Serial Terisi Dengan Benar']);
  }

  if($aksi=='create'||$aksi=='update'){

      if(isset($_POST['tahun_perolehan'])){
        $tahun_perolehan = $_POST['tahun_perolehan'];
      }else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Pastikan Tahun Perolehan Terisi Dengan Benar']);
      }

      if(isset($_POST['jenis_id'])){
        $jenis_id = $_POST['jenis_id'];
      }else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Pastikan Jenis Terisi Dengan Benar']);
      }

      if(isset($_POST['merek_id'])){
        $merek_id = $_POST['merek_id'];
      }else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Pastikan Merek Terisi Dengan Benar']);
      }

      if(isset($_POST['type'])){
        $type = $_POST['type'];
      }else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Pastikan Tipe Terisi Dengan Benar']);
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
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Pastikan Keterangan Terisi Dengan Benar']);
      }
  }


  if($aksi=='create' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$status,'Berhasil Menambahkan Barang']);
      $sql = "insert INTO public.barang(no_serial, tahun_perolehan, jenis_id, merek_id, satker_id, type, kondisi, status, keterangan) VALUES ('$no_serial', '$tahun_perolehan', $jenis_id, $merek_id, $satker_id, '$type', $kondisi, 1, '$keterangan');";
  }


  elseif($aksi=='update' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$status,'Berhasil Mengubah Barang']);
      $sql = "update public.barang SET tahun_perolehan='$tahun_perolehan', jenis_id=$jenis_id, merek_id=$merek_id, type='$type', kondisi=$kondisi, keterangan='$keterangan' WHERE no_serial='$no_serial';";
  }


  elseif($aksi=='delete' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$status,'Berhasil Menghapus Barang']);
      $sql = "delete from barang where no_serial = '$no_serial'";
  }

  if($status != 'eror'){
    $eksekusi = pg_query($sql);
  }


  // echo "id = ".$id;
  header('location:'.$link);

  echo "status = ".$status."<br>Pesan = ".$pesan[0]."<br>SQL = ".$sql;
  // return ['status'=>$status,'pesan'=>$pesan];

?>
