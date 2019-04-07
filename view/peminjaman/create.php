<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/blank.php'; ?>
<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd/view/");
    }
  }

?>
<?php startblock('title') ?> Create Peminjaman <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd/view/peminjaman/index.php">Peminjaman</a>
<li class="breadcrumb-item"><a href="#!">Create</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Create Peminjaman
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="peminjaman" action="/tb_pbd/controller/peminjamanController.php?aksi=create" method="post">
            <div class="row form-group">
                <div class="col-sm-2 col-form-label">
                    <label class="col-form-label">Tanggal</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" name="tanggal" class="form-control" placeholder="Pilih Tanggal" id="dropper-default">
                </div>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/view/peminjaman/_field.php'; ?>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/view/peminjaman/_pencarian.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/view/peminjaman/_adduser.php'; ?>
<?php endblock() ?>

<?php startblock('script') ?>
  <script type="text/javascript">
      $(document).ready(function() {
      // Setup - add a text input to each footer cell
      $('#tblbarang tfoot th').each(function(){
          var title = $(this).text();
          $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      });

      // DataTable
      var table = $('#tblbarang').DataTable({
          "searching":   false,
          "paging":   false,
          "ordering": false,
          "info":     false,
      });

      // Apply the search
      table.columns().every( function () {
          var that = this;
          $( 'input', this.footer() ).on( 'keyup change', function () {
              if ( that.search() !== this.value ) {
                  that
                      .search( this.value )
                      .draw();
              }
          });
      });

      var pilih = [];
      $('#tblbarang tbody').on( 'click', 'button', function () {

            var data = $(this).closest("tr")[0].children[0].innerHTML;

            $(this).toggleClass('btn-success btn-danger');

            if($(this).hasClass('btn-success')){
              $(this).closest("tr").removeClass('selected');
              $(this).html('Select');

              var index = pilih.indexOf(data);
              if (index > -1) {
                pilih.splice(index, 1);
              }

            }else{
              $(this).html('UnSelect');
              $(this).closest("tr").addClass('selected');
              pilih.push(data);
            }

            console.log(pilih);
            $('#no_serial').val(pilih).trigger('change');
            document.getElementById('hiden').value = $('#no_serial').val();
        });

      });
  </script>
<?php endblock() ?>
