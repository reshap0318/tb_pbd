<?php

  session_start();
  if($_SESSION['status'] == 1){
    if($_SESSION['hak_akses'] != 1){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd/view/");
    }
  }else{
    array_push($_SESSION['pesan'],['eror','Anda Belum Login, Silakan Login Terlebih Dahulu']);
    header("location:/tb_pbd/view/auth/login.php");
  }

  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/controller/koneksi.php';
  $id = null;
  $nama = null;
  $aksi = null;
  $status = null;
  $pesan = [];
  $link = '/tb_pbd/view/management/satker';

  // die(var_dump(isset($_GET['aksi'])));
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }else{
    $status = 'eror';
    array_push($_SESSION['pesan'],[$status,'LINK SALAH Periksa LINK']);
  }

  if(isset($_POST['id'])){
    $id = $_POST['id'];
  }else{
    $status = 'eror';
    array_push($_SESSION['pesan'],[$status,'Pastikan Kode Terisi Dengan Benar']);
  }

  if($aksi=='create' || $aksi=='update'){
      if(isset($_POST['nama'])){
        $nama = $_POST['nama'];
      }else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Pastikan Nama Terisi Dengan Benar']);
      }

      if(isset($_POST['kepala'])){
        $kepala = $_POST['kepala'];
      }else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Pastikan Kepala Terisi Dengan Benar']);
      }

      if(isset($_POST['nrp'])){
        $nrp = $_POST['nrp'];
      }else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Pastikan NRP Kepala Terisi Dengan Benar']);
      }
  }

  if($aksi=='create' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$status,'Berhasil Menambahkan Satuan Kerja']);

      $sql = "insert into satker(id,nama,kepala,nrp) values ('$id','$nama','$kepala','$nrp')";
  }

  elseif($aksi=='update' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$status,'Berhasil Merubah Satuan Kerja']);
      $sql = "update satker set nama='$nama',kepala='$kepala',nrp = '$nrp' where id = '$id'";
  }

  elseif($aksi=='delete' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$status,'Berhasil Menghapus Satuan Kerja']);
      $sql = "delete from satker where id = '$id'";
  }

  if($status != 'eror'){
    try {
      $eksekusi = pg_query($sql);
    } catch (\Exception $e) {
      array_push($_SESSION['pesan'],['eror',$e]);
    }
  }


  // echo "id = ".$id;
  header('location:'.$link);

  // return ['status'=>$status,'pesan'=>$pesan];

?>
