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
  $nrp = null;
  $nama = null;
  $satker_id = null;
  $jabatan_id = null;
  $pangkat_id = null;
  $password = null;
  $no_telepon = null;
  $alamat = null;
  $hak_akses = null;

  $aksi = null;
  $status = null;
  $pesan = [];
  $link = '/tb_pbd/view/management/user';


  //validasi dan inisiasi
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }
  else{
    $status = 'eror';
    array_push($pesan,'LINK SALAH Periksa LINK');
  }

  if(isset($_POST['nrp'])){
    $nrp = $_POST['nrp'];
  }
  else{
    $status = 'eror';
    array_push($_SESSION['pesan'],[$pesan,'Pastikan NRP Terisi Dengan Benar']);
  }

//validasi
  if($aksi=='create'||$aksi=='update' ||$aksi=='adduser'){

      if(isset($_POST['nama'])){
        $nama = $_POST['nama'];
      }
      else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$pesan,'Pastikan Nama Terisi Dengan Benar']);
      }

      if(isset($_POST['satker_id'])){
        $satker_id = $_POST['satker_id'];
      }
      else{
        $satker_id = $_SESSION['satker_id'];
      }

      if(isset($_POST['jabatan_id'])){
        $jabatan_id = $_POST['jabatan_id'];
      }
      else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$pesan,'Pastikan Jabatan Terisi Dengan Benar']);
      }

      if(isset($_POST['pangkat_id'])){
        $pangkat_id = $_POST['pangkat_id'];
      }
      else{
        $status = 'eror';
        array_push($_SESSION['pesan'],[$pesan,'Pastikan Pangkat Terisi Dengan Benar']);
      }

      if($aksi=='create'||$aksi=='update'){
          if(isset($_POST['password'])){
            $password = md5($_POST['password']);
          }
          else{
            $status = 'eror';
            array_push($_SESSION['pesan'],[$pesan,'Pastikan Password Terisi Dengan Benar']);
          }

          if(isset($_POST['no_telepon'])){
            $no_telepon = $_POST['no_telepon'];
          }
          else{
            $status = 'eror';
            array_push($_SESSION['pesan'],[$pesan,'Pastikan No Telepon Terisi Dengan Benar']);
          }

          if(isset($_POST['alamat'])){
            $alamat = $_POST['alamat'];
          }
          else{
            $status = 'eror';
            array_push($_SESSION['pesan'],[$pesan,'Pastikan Alamat Terisi Dengan Benar']);
          }

          if(isset($_POST['hak_akses'])){
            $hak_akses = $_POST['hak_akses'];
          }
          else{
            $status = 'eror';
            array_push($_SESSION['pesan'],[$pesan,'Pastikan Hak Akses Terisi Dengan Benar']);
          }
      }
  }

  if($aksi=='create' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$pesan,'Berhasil Menambahkan User']);
      $sql = "INSERT INTO public.users(nrp, nama, satker_id, pangkat_id, jabatan_id, password, alamat, no_telepon, hak_akses) VALUES ('$nrp', '$nama', $satker_id, $pangkat_id, $jabatan_id, '$password', '$alamat', '$no_telepon', $hak_akses)";
  }

  elseif($aksi=='update' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$pesan,'Berhasil Merubah User']);
      $sql = "UPDATE public.users SET nrp='$nrp', nama='$nama', satker_id=$satker_id, pangkat_id=$pangkat_id, jabatan_id=$jabatan_id, password='$password', alamat='$alamat', no_telepon='$no_telepon', hak_akses=$hak_akses WHERE nrp='$nrp';";
  }

  elseif($aksi=='delete' && $status != 'eror'){
      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$pesan,'Berhasil Menghapus User']);
      $sql = "delete FROM public.users where nrp = '$nrp'";
  }

  elseif($aksi=='adduser' && $status != 'eror'){
    $status = 'berhasil';
    array_push($_SESSION['pesan'],[$pesan,'Berhasil Menambahkan peminjam']);
    $password = md5($nrp);
    $sql = "INSERT INTO public.users(nrp, nama, satker_id, pangkat_id, jabatan_id, password, hak_akses) VALUES ('$nrp', '$nama', $satker_id, $pangkat_id, $jabatan_id, '$password', 3)";
    $link = 'tb_pbd/view/peminjaman/create.php';
  }

  if($status != 'eror'){
    $eksekusi = pg_query($sql);
  }

  header('location:'.$link);


  // echo "id = ".$id;

  // return ['status'=>$status,'pesan'=>$pesan];

?>
