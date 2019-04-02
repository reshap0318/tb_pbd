<?php

  session_start();
  if($_SESSION['status'] == 1){
    if($_SESSION['hak_akses'] != 1){
      header("location:javascript://history.go(-1)");
    }
  }else{
    header("location:/tb_pbd/view/auth/login.php");
  }

  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/controller/koneksi.php';
  $id = null;
  $nama = null;
  $aksi = null;
  $status = null;
  $pesan = [];
  $link = '/tb_pbd/view/management/jabatan';

  // die(var_dump(isset($_GET['aksi'])));
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }else{
    $status = 'eror';
    array_push($pesan,'LINK SALAH Periksa LINK');
  }

  if($aksi=='create' && $status != 'eror'){
      $status = 'success';
      array_push($pesan,'Berhasil Menambahkan Jabatan');

      if(isset($_POST['id'])){
        $id = $_POST['id'];
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Kode Terisi Dengan Benar');
      }

      if(isset($_POST['nama'])){
        $nama = $_POST['nama'];
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Nama Terisi Dengan Benar');
      }

      $sql = "insert into jabatan(id,nama) values ('$id','$nama')";
  }


  elseif($aksi=='update' && $status != 'eror'){

      if(isset($_POST['id'])){
        $id = $_POST['id'];
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Kode Terisi Dengan Benar');
      }

      if(isset($_POST['nama'])){
        $nama = $_POST['nama'];
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Nama Terisi Dengan Benar');
      }

      $status = 'success';
      array_push($pesan,'Berhasil Mengubah Jabatan');
      $sql = "update jabatan set nama='$nama' where id = '$id'";
  }


  elseif($aksi=='delete' && $status != 'eror'){
      $status = 'success';
      array_push($pesan,'Berhasil Menghapus Jabatan');

      if(isset($_POST['id'])){
        $id = $_POST['id'];
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Kode Terisi Dengan Benar');
      }

      $sql = "delete from jabatan where id = '$id'";
  }

  if($status != 'eror'){
    $eksekusi = pg_query($sql);
  }


  // echo "id = ".$id;
  header('location:'.$link);

  echo "status = ".$status."<br>Pesan = ".$pesan[0];
  // return ['status'=>$status,'pesan'=>$pesan];

?>
