<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | PACAE</title>
  <?php include_once('inc/header.php')?>
</head>
<body class="hold-transition sidebar-mini skin-green-light">
<div class="wrapper">
    <?php include_once('inc/header-menu.php') ?>
    <?php include_once('inc/main-sidebar.php');?>
    <div class="content-wrapper">
      <section class="content-header">
       <h1>
          Dashboard
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-gray-2">
              <div class="inner">
                <h3 id="patient-info" class="countPat"></h3>
                <p>Registered Member</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="members.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- end 1st-->
          <!-- 2nd -->
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-teal-lighter">
              <div class="inner">
                <h3 id="countUltrasound" class="countUltrasound">0</h3>
                <p>Total Events</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar"></i>
              </div>
              <a href="events.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- end 2nd-->
          <!-- 3rd -->
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-black-2">
              <div class="inner">
                <h3 id="countEmb" class="countEmb">0</h3>
                <p>Total Messages</p>
              </div>
              <div class="icon">
                <i class="fa fa-envelope"></i>
              </div>
              <a href="msg-sent.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- end 3rd-->
          <!-- 4th -->
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-teal-dark">
              <div class="inner">
                <h3 id="user-info" class="countUser"></h3>
                <p>SMS API status</p>
              </div>
              <div class="icon">
                <i class="fa fa-mobile"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
    </section>
  </div>
  <?php include_once('inc/footer.php'); ?>
  <div class="control-sidebar-bg"></div>
</div>
<?php include_once('inc/script.php'); ?>
<script src="dist/js/toast.js"></script>
<script>
  infoboxPat();
  countUltrasound();
  countMsg();
  countAPI();
</script>
</body>
</html>
