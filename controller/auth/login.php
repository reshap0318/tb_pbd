<?php

  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/controller/koneksi.php';

  session_start();
  $aksi = 'login';
  $username = null;
  $password = null;
  $status = 0;
  $pesan = [];
  $link = '/tb_pbd/view/';

  if($aksi=='login'){
    if(!isset($_POST['username'])){
      $status = 'eror';
      array_push($pesan,'Username Tidak Boleh Kosong');
    }
    else{
      $username = $_POST['username'];
    }

    if(!isset($_POST['password'])){
      $status = 'eror';
      array_push($pesan,'Password Tidak Boleh Kosong');
    }
    else{
      $password = md5($_POST['password']);
    }


    $sql = "select * from users where nrp='$username' AND password='$password'";
    $eksekusi = pg_query($sql);

    while ($data = pg_fetch_assoc($eksekusi)) {
      $_SESSION['status'] = 1;
      $_SESSION['nrp'] = $data['nrp'];
      $_SESSION['nama'] = $data['nama'];
      $_SESSION['satker_id'] = $data['satker_id'];
      $_SESSION['hak_akses'] = $data['hak_akses'];
      $status = 'berhasil';
      $pesan = ['Berhasil Login'];
    }
  }
  else{
    $link = '/tb_pbd/view/auth/login.php';
    $status = 'Eror';
    array_push($pesan,'Terjadi Eror Saat Mengload Data');
  }

  header('location:'.$link);
  // echo "status = ".$status."<br>Pesan = ".implode(" | ",$pesan);
  // return ['status'=>$status,'pesan'=>$pesan];

?>
