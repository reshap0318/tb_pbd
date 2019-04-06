<?php


  session_start();
  if($_SESSION['status'] == 1){
    if($_SESSION['hak_akses'] != 1 || $_SESSION['hak_akses'] != 2){
      header("location:javascript://history.go(-1)");
    }
  }else{
    header("location:/tb_pbd/view/auth/login.php");
  }

  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/controller/koneksi.php';
  $id = null;
  $tanggal = null;
  $nrp_penerima = 'admin';
  $peminjaman_id = null;
  $keterangan = null;
  $kondisi = null;

  $aksi = null;
  $status = null;
  $pesan = [];
  $link = '/tb_pbd/view/pengembalian';


  //validasi dan inisiasi
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }else{
    $status = 'eror';
    array_push($pesan,'LINK SALAH Periksa LINK');
  }

  if($aksi=='delete'){
    if(isset($_POST['id'])){
      $id = $_POST['id'];
    }else{
      $status = 'eror';
      array_push($pesan,'ID Tidak ditemukan');
    }
  }

  if($aksi=='create'||$aksi=='update'){

      if(isset($_POST['tanggal'])){
        $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Tanggal Terisi Dengan Benar');
      }

      if(isset($_POST['peminjaman_id'])){
        $peminjaman_id = $_POST['peminjaman_id'];
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Kode Barang Terisi Dengan Benar');
      }

      if(isset($_POST['kondisi'])){
        $kondisi = $_POST['kondisi'];
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan NRP PENERIMA Terisi Dengan Benar');
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
      array_push($pesan,'Berhasil Menambahkan Pengembalian');
        $sqlcarikode = "select barang.no_serial from peminjam join barang on peminjam.no_serial = barang.no_serial where peminjam.id=$peminjaman_id";
        $eksekusi = pg_query($sqlcarikode);
        while ($data = pg_fetch_assoc($eksekusi)) {
            $kode = $data['no_serial'];
        }

        $sqlupbar = "update barang set status=1 where no_serial='$kode'";
        $eksekusi = pg_query($sqlupbar);

        $sql = "INSERT INTO public.pengembalian(tanggal, nrp_penerima, kondisi, keterangan, peminjaman_id) VALUES ('$tanggal', '$nrp_penerima', $kondisi, '$keterangan', $peminjaman_id);";
  }


  elseif($aksi=='update' && $status != 'eror'){
      $status = 'success';
      array_push($pesan,'Berhasil Mengubah Barang');
      $sql = "update public.barang SET tahun_perolehan='$tahun_perolehan', jenis_id=$jenis_id, merek_id=$merek_id, type='$type', kondisi=$kondisi, keterangan='$keterangan' WHERE no_serial='$no_serial';";
  }


  elseif($aksi=='delete' && $status != 'eror'){
      $status = 'success';
      array_push($pesan,'Berhasil Menghapus Barang');

      $sql = "delete from pengembalian where id = '$id'";
  }

  if($status != 'eror'){
    $eksekusi = pg_query($sql);
  }


  // echo "id = ".$id;
  header('location:'.$link);

  echo "status = ".$status."<br>Pesan = ".$pesan[0]."<br>SQL = ".$sql;
  // return ['status'=>$status,'pesan'=>$pesan];

?>