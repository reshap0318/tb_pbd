<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php startblock('title') ?> Detail Pengembalian <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd/view/barang/index.php">Pengembalian</a>
<li class="breadcrumb-item"><a href="#!">Detail</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Detail Pengembalian
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
      <div class="dt-responsive table-responsive" cellpadding="10">
        <?php

            function kondisi($kondisi)
            {
                if($kondisi==1){
                  return 'Baik';
                }elseif($kondisi==2){
                  return 'Rusak';
                }elseif($kondisi==3){
                  return 'Rusak Berat';
                }elseif($kondisi==4){
                  return 'Dihapuskan';
                }else{
                  return 'Belum Dikembalikan';
                }
            }

            if($_GET['id']){
              $id = $_GET['id'];
            }else{
              header("location:/tb_pbd/view/pengembalian");
            }

            $sql = "select users.nama as peminjam, pengembalian.keterangan as keterangan, barang.no_serial, peminjam.tanggal as tanggal_pinjam, barang_jenis.nama as jenis, merek.nama as merek, barang.type, penerima.nama as penerima, pengembalian.tanggal as tanggal_kembali, peminjam.kondisi as kondisi_pinjam, pengembalian.kondisi as kondisi_kembali from pengembalian join users as penerima on pengembalian.nrp_penerima = penerima.nrp join peminjam on pengembalian.peminjaman_id = peminjam.id join users on peminjam.nrp_peminjam = users.nrp join barang on peminjam.no_serial = barang.no_serial join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id where pengembalian.id = '$id'";
            if($hak_akses==2){
              $sql = "select users.nama as peminjam, pengembalian.keterangan as keterangan, barang.no_serial, peminjam.tanggal as tanggal_pinjam, barang_jenis.nama as jenis, merek.nama as merek, barang.type, penerima.nama as penerima, pengembalian.tanggal as tanggal_kembali, peminjam.kondisi as kondisi_pinjam, pengembalian.kondisi as kondisi_kembali from pengembalian join users as penerima on pengembalian.nrp_penerima = penerima.nrp join peminjam on pengembalian.peminjaman_id = peminjam.id join users on peminjam.nrp_peminjam = users.nrp join barang on peminjam.no_serial = barang.no_serial join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id where pengembalian.id = '$id' AND barang.satker_id='$satker_id'";
            }elseif($hak_akses==3){
              $sql = "select users.nama as peminjam, pengembalian.keterangan as keterangan, barang.no_serial, peminjam.tanggal as tanggal_pinjam, barang_jenis.nama as jenis, merek.nama as merek, barang.type, penerima.nama as penerima, pengembalian.tanggal as tanggal_kembali, peminjam.kondisi as kondisi_pinjam, pengembalian.kondisi as kondisi_kembali from pengembalian join users as penerima on pengembalian.nrp_penerima = penerima.nrp join peminjam on pengembalian.peminjaman_id = peminjam.id join users on peminjam.nrp_peminjam = users.nrp join barang on peminjam.no_serial = barang.no_serial join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id where pengembalian.id = '$id' AND peminjam.nrp_peminjam = '$nrp'";
            }
            $eksekusi = pg_query($sql);
            while ($data = pg_fetch_assoc($eksekusi)) {
        ?>
          <table class="table nowrap">
            <tr>
              <td style="width:200px">Nama Peminjam</td>
              <td>: <?php echo $data['peminjam']; ?> </td>
              <td style="width:200px"></td>
              <td style="width:200px">No Serial Barang</td>
              <td>: <?php echo $data['no_serial']; ?></td>
            </tr>
            <tr>
              <td style="width:200px">Tanggal Pinjam</td>
              <td>: <?php echo $data['tanggal_pinjam']; ?> </td>
              <td style="width:200px"></td>
              <td style="width:200px">Jenis</td>
              <td>: <?php echo $data['jenis']; ?> </td>
            </tr>
            <tr>
              <td style="width:200px">Penerima Pengembalian</td>
              <td>: <?php echo $data['penerima']; ?> </td>
              <td style="width:200px"></td>
              <td style="width:200px">Merek</td>
              <td>: <?php echo $data['merek']; ?> </td>
            </tr>
            <tr>
              <td style="width:200px">Tanggal Pengembalian</td>
              <td>: <?php echo $data['tanggal_kembali']; ?></td>
              <td style="width:200px"></td>
              <td style="width:200px">Tipe</td>
              <td>: <?php echo $data['type']; ?></td>
            </tr>
            <tr>
              <td style="width:200px">Kondisi Pengembalian</td>
              <td>: <?php echo kondisi($data['kondisi_kembali']); ?></td>
              <td style="width:200px"></td>
              <td style="width:200px">Kondisi Peminjaman</td>
              <td>: <?php echo kondisi($data['kondisi_pinjam']); ?> </td>
            </tr>
            <tr>
              <td class="text-center" colspan="5">Keterangan</td>
            </tr>
            <tr>
              <td class="text-center" colspan="5"><?php echo $data['keterangan']; ?></td>
            </tr>
          </table>
        <?php } ?>
      </div>
    </div>
</div>

<div class="text-center">
  <a href="#" onclick="window.history.back();" class="btn btn-primary waves-effect waves-light">Back</a>
</div>
<?php endblock() ?>
