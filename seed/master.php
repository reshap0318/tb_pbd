<?php
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/controller/koneksi.php';
  //pass 1611522012
  $sql = "insert into jabatan(id, nama) values (1, 'Kepala Polisi');";
  $sql += "insert into pangkat(id, nama) values (1, 'Jendral Polisi');";
  $sql += "insert into satker(id, nama) values (1, 'Polda Sumatera Barat');";
  $sql += "insert INTO public.users(nrp, nama, satker_id, pangkat_id, jabatan_id, password, hak_akses)VALUES ('1611522012', 'Reinaldo Shandev Pratama', 1, 1, 1, '7deab5e2bbd609ec8f8e37f50483f612', 1);";
  pg_query($sql);
?>
