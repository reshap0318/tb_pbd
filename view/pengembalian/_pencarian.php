<div class="modal fade" id="modal_pencarian" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
              <div class="dt-responsive table-responsive">
                  <table id="tblpeminjaman" class="table table-striped table-bordered nowrap" style="width:100%">
                      <thead>
                          <tr>
                              <th>id</th>
                              <th>No Serial</th>
                              <th>Nama</th>
                              <th>Jenis</th>
                              <th>Merek</th>
                              <th>Tanggal</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sql = "select peminjam.id, users.nama, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal from peminjam join barang on peminjam.no_serial = barang.no_serial join users on peminjam.nrp_peminjam = users.nrp join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id where barang.status = '0'";
                          if($hak_akses==2){
                              $sql = "select peminjam.id, users.nama, barang.no_serial, barang_jenis.nama as jenis, merek.nama as merek, peminjam.tanggal from peminjam join barang on peminjam.no_serial = barang.no_serial join users on peminjam.nrp_peminjam = users.nrp join merek on barang.merek_id = merek.id join barang_jenis on barang.jenis_id = barang_jenis.id where barang.status = '0' AND barang.satker_id = '$satker_id'";
                          }
                          $eksekusi = pg_query($sql);
                          while ($data = pg_fetch_assoc($eksekusi)) {
                        ?>
                          <tr>
                              <td><?php echo $data['id'];?></td>
                              <td><?php echo $data['no_serial'];?></td>
                              <td><?php echo $data['nama'];?></td>
                              <td><?php echo $data['jenis'];?></td>
                              <td><?php echo $data['merek'];?></td>
                              <td><?php echo $data['tanggal'];?></td>
                              <td>
                                <button type="button" name="button" id="pilih" class="btn btn-success btn-mini waves-effect waves-light">Select</button>
                              </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>id</th>
                          <th>No Serial</th>
                          <th>Nama</th>
                          <th>Jenis</th>
                          <th>Merek</th>
                          <th>Tanggal</th>
                          <th>Aksi</th>
                        </tr>
                      </tfoot>
                  </table>
              </div>
            </div>
            <div class="modal-footer">
                <button id="simpan" name="button" type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
