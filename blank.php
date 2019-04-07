<?php require_once 'ti.php' ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd/controller/koneksi.php'; ?>
<?php

  session_start();
  if($_SESSION['status']!=1){
    array_push($_SESSION['pesan'],['eror','Anda Belum Login, Silakan Login Terlebih Dahulu']);
    header("location:/tb_pbd/view/auth/login.php");
  }
  $satker_id = $_SESSION['satker_id'];
  $nama = $_SESSION['nama'];
  $nrp = $_SESSION['nrp'];
  $hak_akses = $_SESSION['hak_akses'];

?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from colorlib.com//polygon/managementty/default/dt-ext-basic-buttons.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Nov 2018 03:12:46 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <title>TB Kelompok 8 | <?php startblock('title') ?><?php endblock() ?></title>

    <style type="text/css">
        .sembunyi{
          display: none;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#">
    <meta name="keywords" content="management , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="/tb_pbd/img/icon/favicon.ico" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/assets/icon/icofont/css/icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/assets/icon/feather/css/feather.css">
    <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/assets/pages/advance-elements/css/bootstrap-datetimepicker.css">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/bower_components/bootstrap-daterangepicker/css/daterangepicker.css" />
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/bower_components/datedropper/css/datedropper.min.css" />
    <!-- Color Picker css -->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/bower_components/spectrum/css/spectrum.css" />
    <!-- Mini-color css -->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/bower_components/jquery-minicolors/css/jquery.minicolors.css" />
    <!-- Range slider css -->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/bower_components/seiyria-bootstrap-slider/css/bootstrap-slider.css">
    <!-- Select 2 css -->
    <link rel="stylesheet" href="/tb_pbd/editor/bower_components/select2/css/select2.min.css"/>
    <!-- Multi Select css -->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css"/>
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/bower_components/multiselect/css/multi-select.css"/>
    <!--forms-wizard css-->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/bower_components/jquery.steps/css/jquery.steps.css">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/assets/pages/data-table/extensions/buttons/css/buttons.dataTables.min.css">
    <!-- jpro forms css -->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/assets/pages/j-pro/css/demo.css">
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/assets/pages/j-pro/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/assets/pages/j-pro/css/j-pro-modern.css">
    <!-- animation nifty modal window effects css -->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/assets/css/component.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/tb_pbd/editor/assets/css/jquery.mCustomScrollbar.css">
</head>

<body>
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
        </div>
    </div>
</div>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">
                <div class="navbar-logo">
                    <a class="mobile-menu" id="mobile-collapse" href="#!">
                        <i class="feather icon-menu"></i>
                    </a>
                    <a href="/tb_pbd/view">
                        <img class="img-fluid" src="/tb_pbd/editor/assets/images/logo.png" alt="Theme-Logo" />
                    </a>
                    <a class="mobile-options">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                </div>
                <div class="navbar-container container-fluid">
                    <ul class="nav-left">
                        <li class="header-search">
                            <div class="main-search morphsearch-search">
                                <div class="input-group">
                                    <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#!" onclick="javascript:toggleFullScreen()">
                                <i class="feather icon-maximize full-screen"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="/tb_pbd/editor/assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                                    <span><?php echo $nama; ?></span>
                                    <i class="feather icon-chevron-down"></i>
                                </div>
                                <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                        <a href="/tb_pbd/controller/auth/logout.php">
                                            <i class="feather icon-log-out"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Sidebar inner chat end-->
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <nav class="pcoded-navbar">
                    <div class="pcoded-inner-navbar main-menu">
                      <?php if($hak_akses == 1 || $hak_akses == 2){ ?>
                        <div class="pcoded-navigatio-lavel">Management</div>
                        <ul class="pcoded-item pcoded-left-item">
                            <li class="">
                                <a href="http://localhost/tb_pbd/view/management/user">
                                    <span class="pcoded-micon"><i class="icofont icofont-users"></i></span>
                                    <span class="pcoded-mtext">Users</span>
                                </a>
                            </li>
                            <?php if($hak_akses == 1){ ?>
                            <li class="">
                                <a href="http://localhost/tb_pbd/view/management/satker">
                                    <span class="pcoded-micon"><i class="icofont icofont-ui-office"></i></span>
                                    <span class="pcoded-mtext">Satuan Kerja</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="http://localhost/tb_pbd/view/management/jabatan">
                                    <span class="pcoded-micon"><i class="icofont icofont-robot-face"></i></span>
                                    <span class="pcoded-mtext">Jabatan</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="http://localhost/tb_pbd/view/management/pangkat">
                                    <span class="pcoded-micon"><i class="icofont icofont-throne"></i></span>
                                    <span class="pcoded-mtext">Pangkat</span>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                      <?php } ?>
                        <div class="pcoded-navigatio-lavel">General</div>
                        <ul class="pcoded-item pcoded-left-item">
                          <li class="">
                              <a href="http://localhost/tb_pbd/view/barang">
                                  <span class="pcoded-micon"><i class="icofont icofont-social-dropbox"></i></span>
                                  <span class="pcoded-mtext">Barang</span>
                              </a>
                          </li>
                          <li class="">
                              <a href="http://localhost/tb_pbd/view/peminjaman">
                                  <span class="pcoded-micon"><i class="icofont icofont-social-dropbox"></i></span>
                                  <span class="pcoded-mtext">Peminjaman</span>
                              </a>
                          </li>
                          <li class="">
                              <a href="http://localhost/tb_pbd/view/pengembalian">
                                  <span class="pcoded-micon"><i class="icofont icofont-social-dropbox"></i></span>
                                  <span class="pcoded-mtext">Pengembalian</span>
                              </a>
                          </li>
                        </ul>
                    </div>
                </nav>
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page-header start -->
                                <div class="page-header">
                                    <div class="caption-breadcrumb">
                                          <div class="breadcrumb-header">
                                              <h5><?php startblock('breadcrumb-title') ?><?php endblock() ?></h5>
                                          </div>
                                          <div class="page-header-breadcrumb">
                                              <ul class="breadcrumb-title">
                                                  <li class="breadcrumb-item">
                                                      <a href="#!">
                                                          <i class="icofont icofont-home"></i>
                                                      </a>
                                                  </li>
                                                  <?php startblock('breadcrumb-link') ?><?php endblock() ?>
                                              </ul>
                                          </div>
                                      </div>
                                </div>
                                <!-- Page-header end -->
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Basic Button table start -->
                                                <?php startblock('content') ?><?php endblock() ?>
                                                <!-- Basic Button table end -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-body start -->
                                </div>
                            </div>
                            <!-- Main-body end -->
                            <div id="styleSelector">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="/tb_pbd/editor/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="/tb_pbd/editor/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="/tb_pbd/editor/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="/tb_pbd/editor/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="/tb_pbd/editor/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/bootstrap/js/bootstrap.min.js"></script>

    <!-- j-pro js -->
    <script type="text/javascript" src="/tb_pbd/editor/assets/pages/j-pro/js/jquery.ui.min.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/assets/pages/j-pro/js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/assets/pages/j-pro/js/jquery-cloneya.min.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/assets/pages/j-pro/js/autoNumeric.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/assets/pages/j-pro/js/jquery.stepper.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/modernizr/js/css-scrollbars.js"></script>

    <!-- Bootstrap date-time-picker js -->
    <script type="text/javascript" src="/tb_pbd/editor/assets/pages/advance-elements/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/assets/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>
    <!-- Date-range picker js -->
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/bootstrap-daterangepicker/js/daterangepicker.js"></script>
    <!-- Date-dropper js -->
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/datedropper/js/datedropper.min.js"></script>
    <!-- Color picker js -->
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/spectrum/js/spectrum.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/jscolor/js/jscolor.js"></script>
    <!-- Mini-color js -->
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/jquery-minicolors/js/jquery.minicolors.min.js"></script>

    <!-- Masking js -->
    <script src="/tb_pbd/editor/assets/pages/form-masking/inputmask.js"></script>
    <script src="/tb_pbd/editor/assets/pages/form-masking/jquery.inputmask.js"></script>
    <script src="/tb_pbd/editor/assets/pages/form-masking/autoNumeric.js"></script>
    <script src="/tb_pbd/editor/assets/pages/form-masking/form-mask.js"></script>

    <!-- i18next.min.js -->
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <!-- range slider js -->
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/seiyria-bootstrap-slider/js/bootstrap-slider.js"></script>


    <!-- Select 2 js -->
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/select2/js/select2.full.min.js"></script>
    <!-- Multiselect js -->
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/multiselect/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/assets/js/jquery.quicksearch.js"></script>

    <!-- data-table js -->
    <script src="/tb_pbd/editor/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/tb_pbd/editor/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/tb_pbd/editor/assets/pages/data-table/js/jszip.min.js"></script>
    <script src="/tb_pbd/editor/assets/pages/data-table/js/pdfmake.min.js"></script>
    <script src="/tb_pbd/editor/assets/pages/data-table/js/vfs_fonts.js"></script>
    <script src="/tb_pbd/editor/assets/pages/data-table/extensions/buttons/js/dataTables.buttons.min.js"></script>
    <script src="/tb_pbd/editor/assets/pages/data-table/extensions/buttons/js/buttons.flash.min.js"></script>
    <script src="/tb_pbd/editor/assets/pages/data-table/extensions/buttons/js/jszip.min.js"></script>
    <script src="/tb_pbd/editor/assets/pages/data-table/extensions/buttons/js/pdfmake.min.js"></script>
    <script src="/tb_pbd/editor/assets/pages/data-table/extensions/buttons/js/vfs_fonts.js"></script>
    <script src="/tb_pbd/editor/assets/pages/data-table/extensions/buttons/js/buttons.colVis.min.js"></script>
    <script src="/tb_pbd/editor/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/tb_pbd/editor/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/tb_pbd/editor/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/tb_pbd/editor/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/tb_pbd/editor/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <!-- sweet alert js -->
    <script type="text/javascript" src="/tb_pbd/editor/bower_components/sweetalert/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/assets/js/modal.js"></script>
    <!-- sweet alert modal.js intialize js -->
    <!-- modalEffects js nifty modal window effects -->
    <script type="text/javascript" src="/tb_pbd/editor/assets/js/modalEffects.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/assets/js/classie.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/assets/pages/j-pro/js/custom/currency-form.js"></script>

  	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Custom js -->
    <?php startblock('script') ?><?php endblock() ?>
    <?php startblock('table') ?><?php endblock() ?>
    <!-- Validation js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/assets/pages/form-validation/validate.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/assets/pages/form-validation/form-validation.js"></script>


    <!-- Custom js -->
    <script type="text/javascript" src="/tb_pbd/editor/assets/pages/advance-elements/custom-picker.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/assets/pages/range-slider.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/assets/pages/advance-elements/select2-custom.js"></script>
    <script src="/tb_pbd/editor/assets/js/pcoded.min.js"></script>
    <script src="/tb_pbd/editor/assets/js/vartical-layout.min.js"></script>
    <script src="/tb_pbd/editor/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="/tb_pbd/editor/assets/js/script.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <script type="text/javascript">
      toastr.options.progressBar = true;
      <?php
        if(isset($_SESSION['pesan'])){
          $pesan = $_SESSION['pesan'];
          if(count($pesan)>0){
            for ($i=0; $i < count($pesan); $i++) {
      ?>
              <?php if($pesan[$i][0]=='eror'){ ?>
                toastr.error("<?php echo $pesan[$i][1] ?>", 'Eror', {timeOut: 5000});
              <?php }elseif($pesan[$i][0]=='berhasil'){ ?>
                toastr.success("<?php echo $pesan[$i][1] ?>", 'Berhasil', {timeOut: 5000});
              <?php }elseif($pesan[$i][0]=='warning'){ ?>
                toastr.warning("<?php echo $pesan[$i][1] ?>", 'Hati-Hati', {timeOut: 5000});
              <?php } ?>
      <?php
            }
          }
        }
        if($_SESSION['status']==1){
          $_SESSION['pesan'] = [];
        }
      ?>
  </script>
</body>


<!-- Mirrored from colorlib.com//polygon/managementty/default/dt-ext-basic-buttons.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Nov 2018 03:12:49 GMT -->
</html>
