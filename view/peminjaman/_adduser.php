<div class="modal fade" id="modal_adduser" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <form id="second" action="/tb_pbd/controller/userController.php?aksi=adduser" method="post" novalidate>
              <div class="modal-body">

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NIP / NRP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php if(isset($data['nrp'])){echo $data['nrp'];} ?>"  id="nrp" name="nrp" placeholder="ex : 1611522012">
                            <span class="messages popover-valid"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php if(isset($data['nama'])){echo $data['nama'];} ?>"  id="nama" name="nama" placeholder="ex : Reinaldo Shandev Pratama">
                            <span class="messages popover-valid"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Satuan Kerja</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="satker_id">
                              <?php
                                $sql = "select id, nama from satker";
                                $eksekusi = pg_query($sql);
                                while ($satker = pg_fetch_assoc($eksekusi)) {
                                  if($satker['id']==$data['satker_id']){
                                    echo '<option value="'.$satker['id'].'" selected>'.$satker['nama'].'</option>';
                                  }else{
                                    echo '<option value="'.$satker['id'].'">'.$satker['nama'].'</option>';
                                  }
                                }
                              ?>
                            </select>
                            <span class="messages popover-valid"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="jabatan_id">
                            <?php
                              $sql = "select id, nama from jabatan";
                              $eksekusi = pg_query($sql);
                              while ($jabatan = pg_fetch_assoc($eksekusi)) {
                                if($jabatan['id']==$data['jabatan_id']){
                                  echo '<option value="'.$jabatan['id'].'" selected>'.$jabatan['nama'].'</option>';
                                }else{
                                  echo '<option value="'.$jabatan['id'].'">'.$jabatan['nama'].'</option>';
                                }
                              }
                            ?>
                          </select>
                          <span class="messages popover-valid"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pangkat</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="pangkat_id">
                            <?php
                              $sql = "select id, nama from pangkat";
                              $eksekusi = pg_query($sql);
                              while ($pangkat = pg_fetch_assoc($eksekusi)) {
                                if($pangkat['id']==$data['pangkat_id']){
                                  echo '<option value="'.$pangkat['id'].'" selected>'.$pangkat['nama'].'</option>';
                                }else{
                                  echo '<option value="'.$pangkat['id'].'">'.$pangkat['nama'].'</option>';
                                }
                              }
                            ?>
                          </select>
                          <span class="messages popover-valid"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hak Akses</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="hak_akses">
                            <option value="2" <?php if(isset($data['hak_akses'])){if($data['hak_akses']==2){echo "selected";}} ?>>Pemilik</option>
                            <option value="3" <?php if(isset($data['hak_akses'])){if($data['hak_akses']==3){echo "selected";}} ?>>Peminjam</option>
                          </select>
                          <span class="messages popover-valid"></span>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary m-b-0">Submit</button>
              </div>
            </form>
        </div>
    </div>
</div>
