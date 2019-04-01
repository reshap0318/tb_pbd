<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php startblock('title') ?> Barang <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Barang</a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Barang
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tablebarang" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr class="headings">
                      <th rowspan="2" class="text-center" style="width:20px">NO</th>
                      <th rowspan="2" class="text-center">Nama</th>
                      <th rowspan="2" class="text-center">Satker</th>
                      <th colspan="4" class="text-center">Kondisi</th>
                      <th rowspan="2" class="text-center">Total</th>
                      <th rowspan="2" class="text-center">Action</th>
                  </tr>
                  <tr>
                      <th class="text-center">Baik</th>
                      <th class="text-center">Rusak Ringan</th>
                      <th class="text-center">Rusak Berat</th>
                      <th class="text-center">Dihapuskan</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=0;
                  $sql = "select distinct barang_jenis.id, barang_jenis.nama, satker.nama as satker, satker.id as satker_id, count(case when barang.kondisi=1 then 1 end) as baik, count(case when barang.kondisi=2 then 1 end) as rusak, count(case when barang.kondisi=3 then 1 end) as rusakberat, count(case when barang.kondisi=4 then 1 end) as dihapuskan from barang left join barang_jenis on barang.jenis_id = barang_jenis.id left join satker on barang.satker_id = satker.id group by barang_jenis.id, barang_jenis.nama, satker.nama, satker.id";
                  $eksekusi = pg_query($sql);
                  while ($data = pg_fetch_assoc($eksekusi)) {
                ?>
                  <tr>
                      <td style="width:20px" class="text-center"><?php echo ++$no;?></td>
                      <td class=""><?php echo $data['nama'];?></td>
                      <td class=""><?php echo $data['satker'];?></td>
                      <td class=" text-center"><?php echo $data['baik'];?></td>
                      <td class=" text-center"><?php echo $data['rusak'];?></td>
                      <td class=" text-center"><?php echo $data['rusakberat'];?></td>
                      <td class=" text-center"><?php echo $data['dihapuskan'];?></td>
                      <td class=" text-center"><?php echo $data['baik']+$data['rusak']+$data['rusakberat']+$data['dihapuskan'];?></td>
                      <td style="width:100px">
                        <a href="/tb_pbd/view/management/barang/edit.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Edit</a>
                        <a href="#" class="btn btn-danger btn-mini waves-effect waves-light" onclick="hapus(<?php echo $data['id']; ?>)">Delete</a>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
<form class="" id="formdelete" style="display:none" action="/tb_pbd/controller/barangController.php?aksi=delete" method="post">
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
      $('#tablebarang').DataTable(
        {
        "info":     false,
        dom: 'Bfrtip',
        buttons: [
        {
            text: 'Tambah Barang',
            className: 'btn-success',
            action: function(e, dt, node, config)
            {
              window.location.assign("/tb_pbd/view/barang/create.php");
            }
        },
        {
            text: 'Tambah Merek',
            className: 'btn-success',
            action: function(e, dt, node, config)
            {
              window.location.assign("/tb_pbd/view/management/merek/create.php");
            }
        },
        {
            text: 'Tambah Jenis Barang',
            className: 'btn-success',
            action: function(e, dt, node, config)
            {
              window.location.assign("/tb_pbd/view/management/jenis_barang/create.php");
            }
        },
        {
            extend: 'copy',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1]
            }
        },
        {
            extend: 'print',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1]
            }
        },
        {
            extend: 'excel',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1]
            }
        },
        {
            extend: 'pdf',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1]
            }
        }]
      });
  </script>

  <script type="text/javascript">
    function hapus(id) {
      if(confirm('yakin ingin menghapus data ini?') == true){
        document.getElementById('delete_id').value = id;
        document.getElementById('formdelete').submit();
      }
    }
  </script>
<?php endblock() ?>
