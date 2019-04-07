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
                  if($_SESSION['hak_akses']==2){
                      $sql = "select distinct barang_jenis.id, barang_jenis.nama, satker.nama as satker, satker.id as satker_id, count(case when barang.kondisi=1 then 1 end) as baik, count(case when barang.kondisi=2 then 1 end) as rusak, count(case when barang.kondisi=3 then 1 end) as rusakberat, count(case when barang.kondisi=4 then 1 end) as dihapuskan from barang left join barang_jenis on barang.jenis_id = barang_jenis.id left join satker on barang.satker_id = satker.id where satker_id=$satker_id group by barang_jenis.id, barang_jenis.nama, satker.nama, satker.id";
                  }elseif($_SESSION['hak_akses']==3){
                      $nrp = $_SESSION['nrp'];
                      $sql = "select distinct barang_jenis.id, barang_jenis.nama, satker.nama as satker, satker.id as satker_id, count(case when barang.kondisi=1 then 1 end) as baik, count(case when barang.kondisi=2 then 1 end) as rusak, count(case when barang.kondisi=3 then 1 end) as rusakberat, count(case when barang.kondisi=4 then 1 end) as dihapuskan from peminjam left join barang on peminjam.no_serial = barang.no_serial left join barang_jenis on barang.jenis_id = barang_jenis.id left join satker on barang.satker_id = satker.id where satker_id=$satker_id AND peminjam.nrp_peminjam = '$nrp' AND barang.status=0 group by barang_jenis.id, barang_jenis.nama, satker.nama, satker.id";
                  }
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
                      <td class="text-center" style="width:100px">
                        <a href="/tb_pbd/view/barang/show.php?kategori=<?php echo $data['id']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">show</a>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
      </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-block">
          <div class="dt-responsive table-responsive">
              <table id="tablejenis" class="table table-striped table-bordered nowrap" style="width:100%">
                  <thead>
                      <tr class="headings">
                          <th class="text-center" style="width:20px">NO</th>
                          <th class="text-center">Nama</th>
                          <th class="text-center">Total</th>
                          <th class="text-center">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $no=0;
                      $sql = "select barang_jenis.id, barang_jenis.nama, count(barang.no_serial) as total from barang_jenis left join barang on barang_jenis.id = barang.jenis_id group by barang_jenis.id";
                      if($hak_akses==2){
                          $sql = "select barang_jenis.id, barang_jenis.nama, count(barang.no_serial) as total from barang_jenis left join barang on barang_jenis.id = barang.jenis_id where barang.satker_id=$satker_id group by barang_jenis.id";
                      }elseif($hak_akses==3){
                          $sql = "select barang_jenis.id, barang_jenis.nama, count(barang.no_serial) as total from barang_jenis left join barang on barang_jenis.id = barang.jenis_id join peminjam on barang.no_serial = peminjam.no_serial where peminjam.nrp_peminjam='$nrp' group by barang_jenis.id";
                      }
                      $eksekusi = pg_query($sql);
                      while ($data = pg_fetch_assoc($eksekusi)) {
                    ?>
                      <tr>
                          <td style="width:20px" class="text-center"><?php echo ++$no;?></td>
                          <td class=""><?php echo $data['nama'];?></td>
                          <td class="text-center"><?php echo $data['total'];?></td>
                          <td class="text-center" style="width:100px">
                            <a href="/tb_pbd/view/barang/show.php?kategori=<?php echo $data['id']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">show</a>
                            <?php if($hak_akses!=3){ ?>
                            <a href="/tb_pbd/view/management/jenis_barang/edit.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Edit</a>
                            <?php } ?>
                            <?php if($hak_akses!=3){ ?>
                            <a href="#" class="btn btn-danger btn-mini waves-effect waves-light" onclick="hapusjenis(<?php echo $data['id']; ?>)">Delete</a>
                            <?php } ?>
                          </td>
                      </tr>
                    <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-block">
          <div class="dt-responsive table-responsive">
              <table id="tablemerek" class="table table-striped table-bordered nowrap" style="width:100%">
                  <thead>
                      <tr class="headings">
                          <th class="text-center" style="width:20px">NO</th>
                          <th class="text-center">Nama</th>
                          <th class="text-center">Total</th>
                          <th class="text-center">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $no=0;
                      $sql = "select merek.id, merek.nama, count(barang.no_serial) as total from merek join barang on merek.id = barang.merek_id group by merek.id";
                      if($hak_akses==2){
                        $sql = "select merek.id, merek.nama, count(barang.no_serial) as total from merek join barang on merek.id = barang.merek_id where barang.satker_id=$satker_id group by merek.id";
                      }elseif($hak_akses==3){
                        $sql = "select merek.id, merek.nama, count(barang.no_serial) as total from merek join barang on merek.id = barang.merek_id join peminjam on barang.no_serial = peminjam.no_serial where peminjam.nrp_peminjam = '$nrp' group by merek.id";
                      }
                      $eksekusi = pg_query($sql);
                      while ($data = pg_fetch_assoc($eksekusi)) {
                    ?>
                      <tr>
                          <td style="width:20px" class="text-center"><?php echo ++$no;?></td>
                          <td class=""><?php echo $data['nama'];?></td>
                          <td class="text-center"><?php echo $data['total'];?></td>
                          <td class="text-center" style="width:100px">
                            <a href="/tb_pbd/view/barang/show.php?merek=<?php echo $data['id']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">show</a>
                            <?php if($hak_akses!=3){ ?>
                            <a href="/tb_pbd/view/management/merek/edit.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Edit</a>
                            <?php } ?>
                            <?php if($hak_akses!=3){ ?>
                            <a href="#" class="btn btn-danger btn-mini waves-effect waves-light" onclick="hapusmerek(<?php echo $data['id']; ?>)">Delete</a>
                            <?php } ?>
                          </td>
                      </tr>
                    <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
    </div>
  </div>
</div>

<form class="" id="formdeletejenis" style="display:none" action="/tb_pbd/controller/jenis_barangController.php?aksi=delete" method="post">
  <input type="text" name="id" value="" id="delete_id_jenis">
</form>
<form class="" id="formdeletemerek" style="display:none" action="/tb_pbd/controller/merekController.php?aksi=delete" method="post">
  <input type="text" name="id" value="" id="delete_id_merek">
</form>
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
        <?php if($hak_akses!=3){ ?>
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
        <?php } ?>
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

      $('#tablejenis').DataTable(
        {
        "info":     false,
      });

      $('#tablemerek').DataTable(
        {
        "info":     false,
      });
  </script>

  <script type="text/javascript">
    function hapusjenis(id) {
      if(confirm('yakin ingin menghapus data ini?') == true){
        document.getElementById('delete_id_jenis').value = id;
        document.getElementById('formdeletejenis').submit();
      }
    }

    function hapusmerek(id) {
      if(confirm('yakin ingin menghapus data ini?') == true){
        document.getElementById('delete_id_merek').value = id;
        document.getElementById('formdeletemerek').submit();
      }
    }
  </script>
<?php endblock() ?>
