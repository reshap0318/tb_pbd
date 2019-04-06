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
  $nrp_peminjam = null;
  $nrp_pemberi = 'admin';
  $no_serial = null;
  $keterangan = null;
  $kondisi = 1;

  $aksi = null;
  $status = null;
  $pesan = [];
  $link = '/tb_pbd/view/peminjaman';


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

      if(isset($_POST['no_serial'])){
        $no_serial = explode(",",$_POST['no_serial']);
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan No Serial Terisi Dengan Benar');
      }

      if(isset($_POST['tanggal'])){
        $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Tahun Perolehan Terisi Dengan Benar');
      }

      if(isset($_POST['nrp_peminjam'])){
        $nrp_peminjam = $_POST['nrp_peminjam'];
      }else{
        $status = 'eror';
        array_push($pesan,'Pastikan Jenis Terisi Dengan Benar');
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
      array_push($pesan,'Berhasil Menambahkan Peminjaman');
      for ($i=0; $i < count($no_serial) ; $i++) {
        $sqlkon = "select kondisi from barang where no_serial = '$no_serial[$i]'";
        $eksekusi = pg_query($sqlkon);
        while ($data = pg_fetch_assoc($eksekusi)) {
            $kondisi = $data['kondisi'];
        }

        $sqlupbar = "update barang set status=0 where no_serial='$no_serial[$i]'";
        $eksekusi = pg_query($sqlupbar);

        $sql = "insert INTO public.peminjam(tanggal, kondisi, nrp_peminjam, nrp_pemberi, keterangan, no_serial) VALUES ('$tanggal', $kondisi, '$nrp_peminjam', '$nrp_pemberi', '$keterangan', '$no_serial[$i]')";
      }
  }


  elseif($aksi=='update' && $status != 'eror'){
      $status = 'success';
      array_push($pesan,'Berhasil Mengubah Barang');
      $sql = "update public.barang SET tahun_perolehan='$tahun_perolehan', jenis_id=$jenis_id, merek_id=$merek_id, type='$type', kondisi=$kondisi, keterangan='$keterangan' WHERE no_serial='$no_serial';";
  }


  elseif($aksi=='delete' && $status != 'eror'){
      $status = 'success';
      array_push($pesan,'Berhasil Menghapus Peminjaman');

      $peminjaman_no_serial = "select no_serial from peminjam where id=$id";
      $eksekusi_no_serial = pg_query($peminjaman_no_serial);
      while ($data = pg_fetch_assoc($eksekusi_no_serial)) {
        $no_serial = $data['no_serial'];
        $sqlupbar = "update barang set status=1 where no_serial='$no_serial'";
        $eksekusi = pg_query($sqlupbar);
      }
      $sql = "delete from peminjam where id = '$id'";
  }

  if($status != 'eror'){
    $eksekusi = pg_query($sql);
  }


  // echo "id = ".$id;
  header('location:'.$link);

  echo "status = ".$status."<br>Pesan = ".$pesan[0]."<br>SQL = ".$sql;
  // return ['status'=>$status,'pesan'=>$pesan];

?>
