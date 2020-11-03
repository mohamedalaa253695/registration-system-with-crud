<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - ICO Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?=base_url()?>/assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/metisMenu.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <!-- others css -->
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/typography.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/default-css.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/styles.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="<?=base_url()?>/assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img src="<?=base_url()?>/assets/images/icon/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li><a href="<?= base_url('/') ;?>"><i class="ti-map-alt"></i> <span>Dashboard</span></a></li>
                            <li><a href="<?= base_url('users') ;?>"><i class="ti-user"></i> <span>Users</span></a></li>
                            <li><a href="<?= base_url('roles') ;?>"><i class="ti-unlock"></i> <span>Roles</span></a></li>
                            <li><a href="<?= base_url('account') ;?>"><i class="ti-settings"></i> <span>My profile</span></a></li>

                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            <li class="dropdown">
                                <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                                    <span>2</span>
                                </i>
                                <div class="dropdown-menu bell-notify-box notify-box">
                                    <span class="notify-title">You have 3 new notifications <a href="<?=base_url()?>/#">view all</a></span>
                                    <div class="nofity-list">
                                        
                                        <a href="<?=base_url()?>/#" class="notify-item">
                                            <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                            <div class="notify-text">
                                                <p>You have Changed Your Password</p>
                                                <span>Just Now</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <a href="<?=base_url('account')?>">
                            <li class="settings-btn">
                               <i class="ti-settings">    </i>
                            </li>
                             </a>
                          
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left"><?php echo $title;?></h4>
                          
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="<?=base_url()?>/assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">  <?=  $userData['name']; ?><i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"  href="<?= base_url('account');?>">Account</a>
                                <a class="dropdown-item" href="<?= base_url('logout') ?>">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->renderSection('content') ?>           
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>Made with &#10084; by   <a href="http://mohameddemos.com" target="_blank">Mohamed Alaa</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
  
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="<?=base_url()?>/assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="<?=base_url()?>/assets/js/popper.min.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>/assets/js/owl.carousel.min.js"></script>
    <script src="<?=base_url()?>/assets/js/metisMenu.min.js"></script>
    <script src="<?=base_url()?>/assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?=base_url()?>/assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="<?=base_url()?>/assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="<?=base_url()?>/assets/js/pie-chart.js"></script>

      <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <!-- others plugins -->
    <script src="<?=base_url()?>/assets/js/plugins.js"></script>
    <script src="<?=base_url()?>/assets/js/scripts.js"></script>

    
</body>

</html>
