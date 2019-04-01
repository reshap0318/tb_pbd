<?php

  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/controller/koneksi.php';
  $id = null;
  $nama = null;
  $aksi = null;
  $status = null;
  $pesan = [];
  $link = '/tb_pbd/view/barang';

  // die(var_dump(isset($_GET['aksi'])));
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }else{
    $status = 'eror';
    array_push($pesan,'LINK SALAH Periksa LINK');
  }

  if($aksi=='create' && $status != 'eror'){
      $status = 'success';
      array_push($pesan,'Berhasil Menambahkan Jenis Barang');

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

      $sql = "insert into barang_jenis(id,nama) values ('$id','$nama')";
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
      array_push($pesan,'Berhasil Mengubah Jenis Barang');
      $sql = "update barang_jenis set nama='$nama' where id = '$id'";
  }


  elseif($aksi=='delete' && $status != 'eror'){
      $status = 'success';
      array_push($pesan,'Berhasil Menghapus Jenis Barang');

      if(isset($_POST['id'])){
        $id = $_POST['id'];
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Kode Terisi Dengan Benar');
      }

      $sql = "delete from barang_jenis where id = '$id'";
  }

  if($status != 'eror'){
    $eksekusi = pg_query($sql);
  }


  // echo "id = ".$id;
  header('location:'.$link);

  echo "status = ".$status."<br>Pesan = ".$pesan[0];
  // return ['status'=>$status,'pesan'=>$pesan];

?>
