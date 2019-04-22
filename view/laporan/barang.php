<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php startblock('title') ?> Laporan Barang <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Laporan Barang</a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Laporan Barang
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tblbarang" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr>
                      <th style="width:20px" class="text-center">No Serial</th>
                      <th>Tahun Perolehan</th>
                      <th>Jenis</th>
                      <th>Merek</th>
                      <th>Satuan Kerja</th>
                      <th>Kondisi</th>
                      <th>Status</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                    $sql = "select barang.no_serial, barang.tahun_perolehan, barang_jenis.nama as jenis, merek.nama as merek, satker.nama as satker, barang.kondisi, barang.status from barang join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join satker on barang.satker_id = satker.id where satker_id=$satker_id order by barang.status asc";
                  if($hak_akses==1){
                    $sql = "select barang.no_serial, barang.tahun_perolehan, barang_jenis.nama as jenis, merek.nama as merek, satker.nama as satker, barang.kondisi, barang.status from barang join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join satker on barang.satker_id = satker.id where satker_id=$satker_id order by barang.status asc";
                    if(isset($_GET['satker_id'])){
                      $satker_id = $_GET['satker_id'];
                      $sql = "select barang.no_serial, barang.tahun_perolehan, barang_jenis.nama as jenis, merek.nama as merek, satker.nama as satker, barang.kondisi, barang.status from barang join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join satker on barang.satker_id = satker.id where satker_id=$satker_id order by barang.status asc";
                    }
                  }
                  elseif($hak_akses==3){
                    $sql = "select barang.no_serial, barang.tahun_perolehan, barang_jenis.nama as jenis, merek.nama as merek, satker.nama as satker, barang.kondisi, barang.status from peminjam join barang on peminjam.no_serial = barang.no_serial join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join satker on barang.satker_id = satker.id where peminjam.nrp_peminjam='$nrp' AND barang.status=0 order by barang.status asc";
                  }
                  $eksekusi = pg_query($sql);
                  while ($data = pg_fetch_assoc($eksekusi)) {
                ?>
                  <tr>
                      <td><?php echo $data['no_serial'];?></td>
                      <td><?php echo $data['tahun_perolehan'];?></td>
                      <td><?php echo $data['jenis'];?></td>
                      <td><?php echo $data['merek'];?></td>
                      <td><?php echo $data['satker'];?></td>
                      <td><?php if($data['kondisi'] == 1 ){echo "Baik";}elseif($data['kondisi'] == 2){echo "Rusak";}elseif($data['kondisi'] == 3){echo "Rusak Parah";}elseif($data['kondisi'] == 4){echo "Dihapuskan";}?></td>
                      <td><?php if($data['status'] == 1 ){echo "Tersedia";}elseif($data['status'] == 0){echo "Dipinjam";}?></td>
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
      $('#tblbarang').DataTable(
        {
        "info":     false,
        dom: 'Bfrtip',
        buttons: [
        {
            text: 'Print',
            className: 'btn-inverse',
            action: function(e, dt, node, config)
            {
              window.location.assign("/tb_pbd/view/laporan/cetak_laporan/barang.php?satker_id=<?php echo $satker_id; ?>");
            }
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
