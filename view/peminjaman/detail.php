<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php startblock('title') ?> Detail Peminjaman <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd/view/barang/index.php">Peminjaman</a>
<li class="breadcrumb-item"><a href="#!">Detail</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Detail Peminjaman
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

            function cek($id)
            {
                $sql = "select * from pengembalian where peminjaman_id = $id";
                $eksekusi = pg_query($sql);
                $total = 0;
                while ($datas = pg_fetch_assoc($eksekusi)) {
                    $total += 1;
                }

                if($total>0){
                  return '<label class="label label-lg label-info">Dikembalikan</label>';
                }else{
                  return '<label class="label label-lg label-danger">Belum Dikembalikan</label>';
                }
            }

            if($_GET['id']){
              $id = $_GET['id'];
            }else{
              header("location:/tb_pbd/view/peminjaman");
            }

            $sql = "select peminjam.id, barang.status, peminjam.tanggal, peminjam.kondisi, pinjam.nama as peminjaman, users.nama as pemberi, peminjam.keterangan, peminjam.no_serial, barang.type, barang_jenis.nama as jenis, merek.nama as merek FROM public.peminjam join users as pinjam on peminjam.nrp_peminjam = pinjam.nrp join users on peminjam.nrp_pemberi = users.nrp join barang on peminjam.no_serial = barang.no_serial join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id where peminjam.id = $id";
            if($hak_akses==2){
              $sql = "select peminjam.id, barang.status, peminjam.tanggal, peminjam.kondisi, pinjam.nama as peminjaman, users.nama as pemberi, peminjam.keterangan, peminjam.no_serial, barang.type, barang_jenis.nama as jenis, merek.nama as merek FROM public.peminjam join users as pinjam on peminjam.nrp_peminjam = pinjam.nrp join users on peminjam.nrp_pemberi = users.nrp join barang on peminjam.no_serial = barang.no_serial join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id where peminjam.id = $id AND barang.satker_id=$satker_id";
            }elseif($hak_akses==3){
              $sql = "select peminjam.id, barang.status, peminjam.tanggal, peminjam.kondisi, pinjam.nama as peminjaman, users.nama as pemberi, peminjam.keterangan, peminjam.no_serial, barang.type, barang_jenis.nama as jenis, merek.nama as merek FROM public.peminjam join users as pinjam on peminjam.nrp_peminjam = pinjam.nrp join users on peminjam.nrp_pemberi = users.nrp join barang on peminjam.no_serial = barang.no_serial join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id where peminjam.id = $id AND peminjam.nrp_peminjam = '$nrp'";
            }
            $eksekusi = pg_query($sql);
            while ($data = pg_fetch_assoc($eksekusi)) {
        ?>
          <table class="table nowrap">
            <tr>
              <td style="width:200px">Nama Peminjam</td>
              <td>: <?php echo $data['peminjaman']; ?> </td>
              <td style="width:200px"></td>
              <td style="width:200px">NO Serial Barang</td>
              <td>: <?php echo $data['no_serial']; ?></td>
            </tr>
            <tr>
              <td style="width:200px">Tanggal</td>
              <td>: <?php echo $data['tanggal']; ?></td>
              <td style="width:200px"></td>
              <td style="width:200px">Jenis</td>
              <td>: <?php echo $data['jenis']; ?></td>
            </tr>
            <tr>
              <td style="width:200px">Kondisi Peminjaman</td>
              <td>: <?php echo kondisi($data['kondisi']);?></td>
              <td style="width:200px"></td>
              <td style="width:200px">Merek</td>
              <td>: <?php echo $data['merek']; ?></td>
            </tr>
            <tr>
              <td style="width:200px">Pemberi</td>
              <td>: <?php echo $data['pemberi']; ?></td>
              <td style="width:200px"></td>
              <td style="width:200px">Tipe</td>
              <td>: <?php echo $data['type']; ?></td>
            </tr>
            <tr>
              <td class="text-center" colspan="5">Keterangan</td>
            </tr>
            <tr>
              <td class="text-center" colspan="5"><?php echo $data['keterangan']; ?></td>
            </tr>
            <tr>
              <td class="text-center" colspan="5"> <?php echo cek($data['id']); ?> </td>
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
