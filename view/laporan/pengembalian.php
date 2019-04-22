<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php startblock('title') ?> Pengembalian <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Pengembalian</a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Pengembalian
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tblpengembalian" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr>
                      <th style="width:20px" class="text-center">NO</th>
                      <th>Pengembalian</th>
                      <th>No Serial</th>
                      <th>Jenis</th>
                      <th>Merek</th>
                      <th>Kondisi</th>
                      <th>Peminjaman</th>
                      <th style="width:100px">Nama Peminjam</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=0;
                  if($hak_akses==2){
                      $sql = "select pengembalian.id, users.nama, pengembalian.tanggal as tglkembali, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal as tglpinjam, pengembalian.kondisi from pengembalian join peminjam on pengembalian.peminjaman_id = peminjam.id join barang on peminjam.no_serial = barang.no_serial join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id join users on peminjam.nrp_peminjam = users.nrp where barang.satker_id = $satker_id";
                  }elseif($hak_akses==3){
                      $sql = "select pengembalian.id, users.nama, pengembalian.tanggal as tglkembali, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal as tglpinjam, pengembalian.kondisi from pengembalian join peminjam on pengembalian.peminjaman_id = peminjam.id join barang on peminjam.no_serial = barang.no_serial join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id join users on peminjam.nrp_peminjam = users.nrp where peminjam.nrp_peminjam = '$nrp'";
                  }elseif($hak_akses==1){
                    $sql = "select pengembalian.id, users.nama, pengembalian.tanggal as tglkembali, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal as tglpinjam, pengembalian.kondisi from pengembalian join peminjam on pengembalian.peminjaman_id = peminjam.id join barang on peminjam.no_serial = barang.no_serial join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id join users on peminjam.nrp_peminjam = users.nrp";
                    if(isset($_GET['satker_id'])){
                      $satker_id = $_GET['satker_id'];
                      $sql = "select pengembalian.id, users.nama, pengembalian.tanggal as tglkembali, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal as tglpinjam, pengembalian.kondisi from pengembalian join peminjam on pengembalian.peminjaman_id = peminjam.id join barang on peminjam.no_serial = barang.no_serial join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id join users on peminjam.nrp_peminjam = users.nrp where barang.satker_id = $satker_id";
                    }
                  }
                  $eksekusi = pg_query($sql);
                  while ($data = pg_fetch_assoc($eksekusi)) {
                ?>
                  <tr>
                      <td style="width:20px" class="text-center"><?php echo ++$no;?></td>
                      <td><?php echo $data['tglkembali'];?></td>
                      <td><?php echo $data['no_serial'];?></td>
                      <td><?php echo $data['jenis'];?></td>
                      <td><?php echo $data['merek'];?></td>
                      <td><?php if($data['kondisi'] == 1 ){echo "Baik";}elseif($data['kondisi'] == 2){echo "Rusak";}elseif($data['kondisi'] == 3){echo "Rusak Parah";}elseif($data['kondisi'] == 4){echo "Dihapuskan";}?></td>
                      <td><?php echo $data['tglpinjam'];?></td>
                      <td style="width:100px"><?php echo $data['nama'];?></td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
      </div>
  </div>
</div>
<div class="text-center">
  <a href="/tb_pbd/view/laporan/" class="btn btn-primary waves-effect waves-light">Back</a>
</div>
<?php endblock() ?>

<?php startblock('table') ?>
  <!-- info lebih lanjut bisa di cek di : -->
  <!--editor/assets/pages/data-table/js/data-table-custom.js"-->
  <script type="text/javascript">
      $('#tblpengembalian').DataTable(
        {
        "info":     false,
        dom: 'Bfrtip',
        buttons: [
        {
            extend: 'collection',
            text: 'Print',
            buttons: [
                {
                    text: 'Januari',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/pengembalian.php?satker_id=<?php echo $satker_id; ?>&bulan=1&tahun=2019");
                    }
                },
                {
                    text: 'Februari',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/pengembalian.php?satker_id=<?php echo $satker_id; ?>&bulan=2&tahun=2019");
                    }
                },
                {
                    text: 'Maret',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/pengembalian.php?satker_id=<?php echo $satker_id; ?>&bulan=3&tahun=2019");
                    }
                },
                {
                    text: 'April',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/pengembalian.php?satker_id=<?php echo $satker_id; ?>&bulan=4&tahun=2019");
                    }
                },
                {
                    text: 'Mei',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/pengembalian.php?satker_id=<?php echo $satker_id; ?>&bulan=5&tahun=2019");
                    }
                },
                {
                    text: 'Juni',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/pengembalian.php?satker_id=<?php echo $satker_id; ?>&bulan=6&tahun=2019");
                    }
                },
                {
                    text: 'Juli',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/pengembalian.php?satker_id=<?php echo $satker_id; ?>&bulan=7&tahun=2019");
                    }
                },
                {
                    text: 'Agustus',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/pengembalian.php?satker_id=<?php echo $satker_id; ?>&bulan=8&tahun=2019");
                    }
                },
                {
                    text: 'September',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/pengembalian.php?satker_id=<?php echo $satker_id; ?>&bulan=9&tahun=2019");
                    }
                },
                {
                    text: 'Oktober',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/pengembalian.php?satker_id=<?php echo $satker_id; ?>&bulan=10&tahun=2019");
                    }
                },
                {
                    text: 'November',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/pengembalian.php?satker_id=<?php echo $satker_id; ?>&bulan=11&tahun=2019");
                    }
                },
                {
                    text: 'Desember',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/pengembalian.php?satker_id=<?php echo $satker_id; ?>&bulan=12&tahun=2019");
                    }
                }
            ]
        },
        {
            extend: 'copy',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7]
            }
        },
        {
            extend: 'excel',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7]
            }
        },
        {
            extend: 'pdf',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7]
            }
        }]
      });
  </script>
<?php endblock() ?>
