<?php

  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/controller/koneksi.php';
  $aksi = isset($_GET['aksi']);
  $username = null;
  $password = null;
  $status = 0;
  $pesan = [];


  if(!isset($_POST['username'])){
    $status = 'eror';
    array_push($pesan,'Username Tidak Boleh Kosong');
  }else{
    // die(var_dump(isset($_POST['username'])));
    $username = $_POST['username'];
  }

  if(!isset($_POST['password'])){
    $status = 'eror';
    array_push($pesan,'Password Tidak Boleh Kosong');
  }else{
    $password = md5($_POST['password']);
  }

  // die(var_dump([$username, $password]));

  // die(var_dump(isset($_GET['aksi'])));
  if(isset($_GET['aksi'])){
    $status = 'eror';
    array_push($pesan,'Tidak Ditemukan Variable Aksi');
  }

  if($aksi=='login'){
    $sql = "select * from users where nrp='$username' AND password='$password'";
    $query = pg_query($sql);

    if(pg_fetch_array($query)){
        $status = 'berhasil';
        $pesan = ['Berhasil Login'];
    }
  }elseif($aksi=='logout'){
    $status = 'berhasil';
    $pesan = ['Berhasil Log-Out'];
  }else{
    $status = 'Eror';
    array_push($pesan,'Terjadi Eror Saat Mengload Data');
  }

  // echo "status = ".$status."<br>Pesan = ".$pesan[0];
  return ['status'=>$status,'pesan'=>$pesan];

?>
