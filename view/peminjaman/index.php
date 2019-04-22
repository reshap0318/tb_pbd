<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>

<?php startblock('title') ?> Peminjaman <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Peminjaman</a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Peminjaman
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
  <div class="card-block">
    <form class="col-md-12" action="/tb_pbd/view/peminjaman/caripeminjaman.php" method="get">
      <div class="row">
        <div class="form-group row col-sm-4 text-right">
          <label class="col-sm-4 col-form-label">Nama</label>
          <div class="col-sm-8">
              <input type="text" class="form-control" value="" name="nama" placeholder="nama ">
              <span class="messages popover-valid"></span>
          </div>
        </div>
        <div class="form-group row col-sm-4 text-right">
          <label class="col-sm-4 col-form-label">No Serial</label>
          <div class="col-sm-8">
              <input type="text" class="form-control" value="" name="no_serial" placeholder="No Serial">
              <span class="messages popover-valid"></span>
          </div>
        </div>
        <div class="form-group row col-sm-4 text-right">
          <label class="col-sm-4 col-form-label">Satker</label>
          <div class="col-sm-8">
              <select class="form-control " name="satker_id">
                <option value="all">All</option>
                <?php
                  $sql = "select id, nama from satker";
                  $eksekusi = pg_query($sql);
                  while ($jenis = pg_fetch_assoc($eksekusi)) {
                    if($jenis['id']==$data['satker_id']){
                      echo '<option value="'.$jenis['id'].'" selected>'.$jenis['nama'].'</option>';
                    }else{
                      echo '<option value="'.$jenis['id'].'">'.$jenis['nama'].'</option>';
                    }
                  }
                ?>
              </select>
              <span class="messages popover-valid"></span>
          </div>
        </div>
        <div class="form-group row col-sm-4 text-right">
          <label class="col-sm-4 col-form-label">Merek</label>
          <div class="col-sm-8">
              <select class="form-control " name="merek_id">
                <option value="all">All</option>
                <?php
                  $sql = "select id, nama from merek";
                  $eksekusi = pg_query($sql);
                  while ($jenis = pg_fetch_assoc($eksekusi)) {
                    if($jenis['id']==$data['merek_id']){
                      echo '<option value="'.$jenis['id'].'" selected>'.$jenis['nama'].'</option>';
                    }else{
                      echo '<option value="'.$jenis['id'].'">'.$jenis['nama'].'</option>';
                    }
                  }
                ?>
              </select>
              <span class="messages popover-valid"></span>
          </div>
        </div>
        <div class="form-group row col-sm-4 text-right">
          <label class="col-sm-4 col-form-label">Jenis</label>
          <div class="col-sm-8">
              <select class="form-control " name="jenis_id">
                <option value="all">All</option>
                <?php
                  $sql = "select id, nama from barang_jenis";
                  $eksekusi = pg_query($sql);
                  while ($jenis = pg_fetch_assoc($eksekusi)) {
                    if($jenis['id']==$data['jenis_id']){
                      echo '<option value="'.$jenis['id'].'" selected>'.$jenis['nama'].'</option>';
                    }else{
                      echo '<option value="'.$jenis['id'].'">'.$jenis['nama'].'</option>';
                    }
                  }
                ?>
              </select>
              <span class="messages popover-valid"></span>
          </div>
        </div>
        <div class="form-group row col-sm-4 text-right">
          <label class="col-sm-4 col-form-label">Tanggal</label>
          <div class="col-sm-8">
              <input type="date" class="form-control" value="" name="tanggal">
              <span class="messages popover-valid"></span>
          </div>
        </div>
        <div class="form-group row col-sm-12 text-center">
          <button type="submit" class="btn btn-success col-sm-12">Cari</button>
        </div>
      </div>
    </form>
  </div>
</div>

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
                      <th style="width:100px">Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=0;
                  $sql = "select peminjam.id, users.nama, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal from peminjam join barang on peminjam.no_serial = barang.no_serial join users on peminjam.nrp_peminjam = users.nrp join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id";
                  if($hak_akses == 2){
                    $sql = "select peminjam.id, users.nama, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal from peminjam join barang on peminjam.no_serial = barang.no_serial join users on peminjam.nrp_peminjam = users.nrp join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id where barang.satker_id=$satker_id";
                  }elseif($hak_akses == 3){
                    $sql = "select peminjam.id, users.nama, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal from peminjam join barang on peminjam.no_serial = barang.no_serial join users on peminjam.nrp_peminjam = users.nrp join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id where peminjam.nrp_peminjam = '$nrp'";
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
                      <td style="width:100px" class="text-center">
                        <a href="/tb_pbd/view/peminjaman/detail.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Detail</a>
                        <?php if($hak_akses!=3){ ?>
                        <a href="/tb_pbd/view/peminjaman/edit.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Edit</a>
                        <a href="#" class="btn btn-danger btn-mini waves-effect waves-light" onclick="hapus(<?php echo $data['id']; ?>)">Delete</a>
                        <?php } ?>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
<form class="" id="formdelete" style="display:none" action="/tb_pbd/controller/peminjamanController.php?aksi=delete" method="post">
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
      $('#tblpeminjaman').DataTable(
        {
        "info":     false,
        dom: 'Bfrtip',
        buttons: [
      <?php if($hak_akses!=3){ ?>
        {
            text: 'Tambah Peminjaman',
            className: 'btn-success',
            action: function(e, dt, node, config)
            {
              window.location.assign("/tb_pbd/view/peminjaman/create.php");
            }
        },
      <?php } ?>
        {
            extend: 'copy',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
        },
        {
            extend: 'print',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
        },
        {
            extend: 'excel',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
            }
        },
        {
            extend: 'pdf',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5]
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
