<?php
  session_start();
  if(isset($_SESSION['pesan'])){
    $pesan = $_SESSION['pesan'];
    if(count($pesan)>0){
      for ($i=0; $i < count($pesan); $i++) {

?>
          <?php if($pesan[$i]){ ?>
            <?php echo $pesan[$i][1] ?>
          <?php } ?>
<?php
        
      }
    }
    $_SESSION['pesan'] = [];
  }
?>
