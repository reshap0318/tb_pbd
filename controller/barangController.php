<?php

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


  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }else{
    $status = 'eror';
    array_push($pesan,'LINK SALAH Periksa LINK');
  }

  if(isset($_POST['no_serial'])){
    $no_serial = $_POST['no_serial'];
  }else{
    $status = 'eror';
    array_push($pesan,'Pastikan No Serial Terisi Dengan Benar');
  }


  if($aksi=='create'||$akse=='update'){

      if(isset($_POST['tahun_perolehan'])){
        $tahun_perolehan = $_POST['tahun_perolehan'];
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Tahun Perolehan Terisi Dengan Benar');
      }

      if(isset($_POST['jenis_id'])){
        $jenis_id = $_POST['jenis_id'];
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Jenis Terisi Dengan Benar');
      }

      if(isset($_POST['merek_id'])){
        $merek_id = $_POST['merek_id'];
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Merek Terisi Dengan Benar');
      }

      if(isset($_POST['type'])){
        $type = $_POST['type'];
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Type Terisi Dengan Benar');
      }

      if(isset($_POST['kondisi'])){
        $kondisi = $_POST['kondisi'];
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Kondisi Terisi Dengan Benar');
      }

      if(isset($_POST['keterangan'])){
        $keterangan = $_POST['keterangan'];
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Keterangan Terisi Dengan Benar');
      }
  }


  if($aksi=='create' && $status != 'eror'){
      $status = 'success';
      array_push($pesan,'Berhasil Menambahkan Barang');
      $sql = "insert INTO public.barang(no_serial, tahun_perolehan, jenis_id, merek_id, satker_id, type, kondisi, status, keterangan) VALUES ('$no_serial', '$tahun_perolehan', $jenis_id, $merek_id, 1, '$type', $kondisi, 1, '$keterangan');";
  }


  elseif($aksi=='update' && $status != 'eror'){
      $status = 'success';
      array_push($pesan,'Berhasil Mengubah Barang');
      $sql = "update public.barang SET tahun_perolehan='$tahun_perolehan', jenis_id=$jenis_id, merek_id=$merek_id, type=$type, kondisi=$kondisi, keterangan=$keterangan WHERE no_serial=$no_serial;";
  }


  elseif($aksi=='delete' && $status != 'eror'){
      $status = 'success';
      array_push($pesan,'Berhasil Menghapus Barang');
      $sql = "delete from barang where no_serial = '$no_serial'";
  }

  if($status != 'eror'){
    $eksekusi = pg_query($sql);
  }


  // echo "id = ".$id;
  header('location:'.$link);

  echo "status = ".$status."<br>Pesan = ".$pesan[0];
  // return ['status'=>$status,'pesan'=>$pesan];

?>
