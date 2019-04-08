<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php startblock('title') ?> Laporan <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Laporan</a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Laporan
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tablesatker" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr>
                      <th style="width:20px" class="text-center">NO</th>
                      <th>Satuan Kerja</th>
                      <th style="width:100px">Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=0;
                  $sql = "select * from satker";
                  if($hak_akses!=1){
                    $sql = "select * from satker where id = $satker_id";
                  }
                  $eksekusi = pg_query($sql);
                  while ($data = pg_fetch_assoc($eksekusi)) {
                ?>
                  <tr>
                      <td style="width:20px" class="text-center"><?php echo ++$no;?></td>
                      <td><?php echo $data['nama'];?></td>
                      <td style="width:100px">
                        <a href="/tb_pbd/view/laporan/barang.php?satker_id=<?php echo $data['id']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Barang</a>
                        <a href="/tb_pbd/view/laporan/peminjaman.php?satker_id=<?php echo $data['id']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Peminjaman</a>
                        <a href="/tb_pbd/view/laporan/pengembalian.php?satker_id=<?php echo $data['id']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Pengembalian</a>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
<form class="" id="formdelete" style="display:none" action="/tb_pbd/controller/satkerController.php?aksi=delete" method="post">
  <input type="text" name="id" value="" id="delete_id">
</form>
      </div>
  </div>
</div>
<?php endblock() ?>

<?php startblock('table') ?>
  <!-- info lebih lanjut bisa di cek di : -->
  <!--editor/assets/pages/data-table/js/data-table-custom.js"-->
  <script type="text/javascript">
      $('#tablesatker').DataTable(
        {
          "paging":   false,
          "ordering": false,
          "info":     false
      });
  </script>
<?php endblock() ?>
