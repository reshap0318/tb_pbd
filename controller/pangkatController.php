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
  $link = '/tb_pbd/view/management/pangkat';

  // die(var_dump(isset($_GET['aksi'])));
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }else{
    $status = 'eror';
    array_push($pesan,'LINK SALAH Periksa LINK');
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
  }

  if($aksi=='create' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$status,'Berhasil Menambahkan Pangkat']);

      $sql = "insert into pangkat(id,nama) values ('$id','$nama')";
  }


  elseif($aksi=='update' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$status,'Berhasil Mengubah Pangkat']);
      $sql = "update pangkat set nama='$nama' where id = '$id'";
  }


  elseif($aksi=='delete' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$status,'Berhasil Menghapus Pangkat']);
      $sql = "delete from pangkat where id = '$id'";
  }

  if($status != 'eror'){
    $eksekusi = pg_query($sql);
  }


  // echo "id = ".$id;
  header('location:'.$link);

  echo "status = ".$status."<br>Pesan = ".$pesan[0];
  // return ['status'=>$status,'pesan'=>$pesan];

?>
