<?php
$year = '';
$username = '';
$avatar = '';
$user_id = 0;
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
    $avatar = $_SESSION['user']['avatar'];
    $year = date('Y', strtotime($_SESSION['user']['created_at']));
    $user_id = $_SESSION['user']['id'];
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php
        echo isset($page_title) ? $page_title : "Page title here";
        ?>
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="assets/css/_all-skins.min.css">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <i class="fa fa-bars"></i>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="assets/uploads/<?php echo $avatar ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs">
                                <?php echo $username ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="assets/uploads/<?php echo $avatar ?>" class="img-circle" alt="User Image">
                                <p>
                                    <?php echo $username ?>
                                    - Web Developer
                                    <small>
                                        Thành viên từ năm <?php echo $year ?>
                                    </small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="index.php?controller=admin&action=detail&id=<?php echo $user_id?>" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="index.php?controller=login&action=signout" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                                <div class="">
                                    <a href="index.php?controller=admin&action=update&id=<?php echo $user_id?>" class="btn btn-default btn-flat">Edit</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="assets/uploads/<?php echo $avatar ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>
                        <?php echo $username ?>
                    </p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">LAYOUT ADMIN</li>

                <li>
                    <a href="index.php?controller=admin">
                        <i class="fa fa-th"></i> <span>Quản lý admin</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=order">
                        <i class="fa fa-th"></i> <span>Quản lý đơn hàng</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=news">
                        <i class="fa fa-th"></i> <span>Quản lý tin tức</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=user">
                        <i class="fa fa-th"></i> <span>Quản lý user</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=chefs&action=index">
                        <i class="fa fa-th"></i> <span>Quản lý đầu bếp</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=newsCategory">
                        <i class="fa fa-code"></i> <span>Quản lý hạng mục tin tức</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=chefCategory">
                        <i class="fa fa-code"></i> <span>Quản lý hạng mục đầu bếp</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Breadcrumd Wrapper. Contains breadcrumb -->
    <div class="breadcrumb-wrap content-wrap content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
    </div>

    <!-- Messaeg Wrapper. Contains messaege error and success -->
    <div class="message-wrap content-wrap content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="alert alert-danger">
                <!-- Lỗi validate -->
                <!-- phải kiểm tra khác rỗng trước mới in ra (tk tg nên ko làm) -->
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
            </div>
            <p class="alert alert-success">
                <?php
                if (isset($_SESSION['success'])) {
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                }
                ?>
            </p>
        </section>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <!-- Nội dung hiển thị ở đây -->
            <?php
            if (isset($data)) {
                $this->render($content, ['data' => $data]);
            } else {
                $this->render($content, []);
            }
            ?>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.13-pre
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
        reserved.
    </footer>
    <!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="assets/js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/js/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
<!-- CKeditor -->
<script src="assets/ckeditor/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        CKEDITOR.replace('description');
        CKEDITOR.replace('summary');
        CKEDITOR.replace('content');
    })
</script>
</body>

</html>