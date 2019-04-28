<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php startblock('title') ?> Detail Barang <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd/view/barang/index.php">Barang</a>
<li class="breadcrumb-item"><a href="#!">Detail</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Detail Barang
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
      <div class="dt-responsive table-responsive" cellpadding="10">
        <?php
            if($_GET['no_serial']){
              $no_serial = $_GET['no_serial'];
            }else{
              header("location:/tb_pbd/view/barang");
            }

            $sql = "select barang.no_serial, barang.keterangan, barang.tahun_perolehan, case when kondisi=1 then 'Baik' when kondisi=2 then 'Rusak' when kondisi=3 then 'Rusak Berat' when kondisi=4 then 'Dihapuskan' end as kondisi, case when status='1' then 'Ada' when status='0' then 'Dipinjam' end as status, barang.type, barang_jenis.nama as jenis, satker.nama as satker, merek.nama as merek from barang join barang_jenis on barang.jenis_id = barang_jenis.id join satker on barang.satker_id = satker.id join merek on barang.merek_id = merek.id where barang.no_serial='$no_serial'";
            if($hak_akses==2){
              $sql = "select barang.no_serial, barang.keterangan, barang.tahun_perolehan, case when kondisi=1 then 'Baik' when kondisi=2 then 'Rusak' when kondisi=3 then 'Rusak Berat' when kondisi=4 then 'Dihapuskan' end as kondisi, case when status='1' then 'Ada' when status='0' then 'Dipinjam' end as status, barang.type, barang_jenis.nama as jenis, satker.nama as satker, merek.nama as merek from barang join barang_jenis on barang.jenis_id = barang_jenis.id join satker on barang.satker_id = satker.id join merek on barang.merek_id = merek.id where barang.no_serial='$no_serial' AND barang.satker_id='$satker_id'";
            }elseif($hak_akses==3){
              $sql = "select barang.no_serial, barang.keterangan, barang.tahun_perolehan, case when barang.kondisi=1 then 'Baik' when barang.kondisi=2 then 'Rusak' when barang.kondisi=3 then 'Rusak Berat' when barang.kondisi=4 then 'Dihapuskan' end as kondisi, case when status='1' then 'Ada' when status='0' then 'Dipinjam' end as status, barang.type, barang_jenis.nama as jenis, satker.nama as satker, merek.nama as merek from barang join barang_jenis on barang.jenis_id = barang_jenis.id join satker on barang.satker_id = satker.id join merek on barang.merek_id = merek.id join peminjam on barang.no_serial = peminjam.no_serial where barang.no_serial='$no_serial' AND peminjam.nrp_peminjam = '$nrp' AND barang.status = '0'";
            }
            $eksekusi = pg_query($sql);
            while ($data = pg_fetch_assoc($eksekusi)) {
            $no_serial = $data['no_serial'];
        ?>
          <table class="table nowrap">
            <tr>
              <td style="width:200px">No Serial</td>
              <td>: <?php echo $data['no_serial']; ?> </td>
              <td style="width:200px"></td>
              <td style="width:200px">Satuan Kerja</td>
              <td>: <?php echo $data['satker']; ?></td>
            </tr>
            <tr>
              <td style="width:200px">Tahun Perolehan</td>
              <td>: <?php echo $data['tahun_perolehan']; ?></td>
              <td style="width:200px"></td>
              <td style="width:200px">Jenis</td>
              <td>: <?php echo $data['jenis']; ?></td>
            </tr>
            <tr>
              <td style="width:200px">Kondisi</td>
              <td>: <?php echo $data['kondisi']; ?></td>
              <td style="width:200px"></td>
              <td style="width:200px">Merek</td>
              <td>: <?php echo $data['merek']; ?></td>
            </tr>
            <tr>
              <td style="width:200px">Status</td>
              <td>: <?php echo $data['status']; ?></td>
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
          </table>
        <?php } ?>
      </div>
    </div>
</div>

<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tablebarang" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr>
                    <th>NO</th>
                    <th>Peminjam</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Kondisi Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Kondisi Pengembalian</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=0;

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
                        return '<label class="label label-lg label-danger">Belum Dikembalikan</label>';
                      }
                  }

                  $sql = "select users.nama as nama, peminjam.tanggal as tanggal_pinjam, peminjam.kondisi as kondisi_pinjam, pengembalian.tanggal as tanggal_kembali, pengembalian.kondisi as kondisi_kembali from barang join peminjam on barang.no_serial = peminjam.no_serial join users on peminjam.nrp_peminjam = users.nrp left join pengembalian on peminjam.id = pengembalian.peminjaman_id where barang.no_serial='$no_serial'";
                  // if($_SESSION['hak_akses']==2){
                  //     $sql = "select users.nama as nama, peminjam.tanggal as tanggal_pinjam, peminjam.kondisi as kondisi_pinjam, pengembalian.tanggal as tanggal_kembali, pengembalian.kondisi as kondisi_kembali from barang join peminjam on barang.no_serial = peminjam.no_serial join users on peminjam.nrp_peminjam = users.nrp left join pengembalian on peminjam.id = pengembalian.peminjaman_id barang.no_serial='$no_serial' AND barang.satker_id=$satker_id";
                  // }elseif($_SESSION['hak_akses']==3){
                  //     $sql = "select users.nama as nama, peminjam.tanggal as tanggal_pinjam, peminjam.kondisi as kondisi_pinjam, pengembalian.tanggal as tanggal_kembali, pengembalian.kondisi as kondisi_kembali from barang join peminjam on barang.no_serial = peminjam.no_serial join users on peminjam.nrp_peminjam = users.nrp left join pengembalian on peminjam.id = pengembalian.peminjaman_id barang.no_serial='$no_serial' AND barang.satker_id=$satker_id";
                  // }
                  $eksekusi = pg_query($sql);
                  while ($data = pg_fetch_assoc($eksekusi)) {
                ?>
                  <tr>
                      <td style="width:20px" class="text-center"><?php echo ++$no;?></td>
                      <td class=""><?php echo $data['nama'];?></td>
                      <td class=""><?php echo $data['tanggal_pinjam'];?></td>
                      <td class=" text-center"><?php echo kondisi($data['kondisi_pinjam']);?></td>
                      <td class=""><?php echo $data['tanggal_kembali'];?></td>
                      <td class=" text-center"><?php echo kondisi($data['kondisi_kembali']);?></td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
      </div>
  </div>
</div>

<div class="text-center">
  <a href="#" onclick="window.history.back();" class="btn btn-primary waves-effect waves-light">Back</a>
</div>
<?php endblock() ?>
