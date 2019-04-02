<div class="modal fade" id="modal_pencarian" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
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
                              <th style="width:100px">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sql = "select barang.no_serial, barang.tahun_perolehan, barang_jenis.nama as jenis, merek.nama as merek, satker.nama as satker, barang.kondisi, barang.status from barang join barang_jenis on barang.jenis_id = barang_jenis.id join merek on barang.merek_id = merek.id join satker on barang.satker_id = satker.id where barang.status=1";
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
                              <td style="width:100px">
                                <button type="button" name="button" id="pilih" class="btn btn-success btn-mini waves-effect waves-light">Select</button>
                              </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                            <th style="width:20px" class="text-center">No Serial</th>
                            <th>Tahun Perolehan</th>
                            <th>Jenis</th>
                            <th>Merek</th>
                            <th>Satuan Kerja</th>
                            <th>Kondisi</th>
                            <th style="width:100px">Action</th>
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
