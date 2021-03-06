<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php startblock('title') ?> Laporan Peminjaman <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Laporan Peminjaman</a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Laporan Peminjaman
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tblpeminjaman" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr>
                      <th style="width:20px" class="text-center">NO</th>
                      <th>Nama</th>
                      <th>No Serial</th>
                      <th>Jenis</th>
                      <th>Merek</th>
                      <th>Tanggal</th>
                      <th>Keterangan</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=0;
                  function cek($id)
                  {
                      $sql = "select * from pengembalian where peminjaman_id = '$id'";
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

                  if($hak_akses == 2){
                    $sql = "select peminjam.id, users.nama, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal from peminjam join barang on peminjam.no_serial = barang.no_serial join users on peminjam.nrp_peminjam = users.nrp join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id where barang.satker_id='$satker_id'";
                  }elseif($hak_akses == 3){
                    $sql = "select peminjam.id, users.nama, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal from peminjam join barang on peminjam.no_serial = barang.no_serial join users on peminjam.nrp_peminjam = users.nrp join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id where peminjam.nrp_peminjam = '$nrp'";
                  }elseif($hak_akses== 1){
                    $sql = "select peminjam.id, users.nama, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal from peminjam join barang on peminjam.no_serial = barang.no_serial join users on peminjam.nrp_peminjam = users.nrp join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id";
                    if(isset($_GET['satker_id'])){
                      $satker_id = $_GET['satker_id'];
                      $sql = "select peminjam.id, users.nama, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal from peminjam join barang on peminjam.no_serial = barang.no_serial join users on peminjam.nrp_peminjam = users.nrp join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id where barang.satker_id='$satker_id'";
                    }
                  }
                  $eksekusi = pg_query($sql);
                  while ($data = pg_fetch_assoc($eksekusi)) {
                ?>
                  <tr>
                      <td style="width:20px" class="text-center"><?php echo ++$no;?></td>
                      <td><?php echo $data['nama'];?></td>
                      <td><?php echo $data['no_serial'];?></td>
                      <td><?php echo $data['jenis'];?></td>
                      <td><?php echo $data['merek'];?></td>
                      <td><?php echo $data['tanggal'];?></td>
                      <td class="text-center"><?php echo cek($data['id']);?></td>
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
      $('#tblpeminjaman').DataTable(
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
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/peminjaman.php?satker_id=<?php echo $satker_id; ?>&bulan=1&tahun=2019");
                    }
                },
                {
                    text: 'Februari',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/peminjaman.php?satker_id=<?php echo $satker_id; ?>&bulan=2&tahun=2019");
                    }
                },
                {
                    text: 'Maret',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/peminjaman.php?satker_id=<?php echo $satker_id; ?>&bulan=3&tahun=2019");
                    }
                },
                {
                    text: 'April',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/peminjaman.php?satker_id=<?php echo $satker_id; ?>&bulan=4&tahun=2019");
                    }
                },
                {
                    text: 'Mei',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/peminjaman.php?satker_id=<?php echo $satker_id; ?>&bulan=5&tahun=2019");
                    }
                },
                {
                    text: 'Juni',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/peminjaman.php?satker_id=<?php echo $satker_id; ?>&bulan=6&tahun=2019");
                    }
                },
                {
                    text: 'Juli',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/peminjaman.php?satker_id=<?php echo $satker_id; ?>&bulan=7&tahun=2019");
                    }
                },
                {
                    text: 'Agustus',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/peminjaman.php?satker_id=<?php echo $satker_id; ?>&bulan=8&tahun=2019");
                    }
                },
                {
                    text: 'September',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/peminjaman.php?satker_id=<?php echo $satker_id; ?>&bulan=9&tahun=2019");
                    }
                },
                {
                    text: 'Oktober',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/peminjaman.php?satker_id=<?php echo $satker_id; ?>&bulan=10&tahun=2019");
                    }
                },
                {
                    text: 'November',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/peminjaman.php?satker_id=<?php echo $satker_id; ?>&bulan=11&tahun=2019");
                    }
                },
                {
                    text: 'Desember',
                    action: function ( e, dt, node, config ) {
                      window.location.assign("/tb_pbd/view/laporan/cetak_laporan/peminjaman.php?satker_id=<?php echo $satker_id; ?>&bulan=12&tahun=2019");
                    }
                }
            ]
        },
        {
            extend: 'copy',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        },
        {
            extend: 'excel',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        },
        {
            extend: 'pdf',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        }]
      });
  </script>
<?php endblock() ?>
