<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Member | PACAE</title>
  <?php include_once('inc/header.php')?>
</head>
<body class="hold-transition sidebar-mini skin-green-light">
<div class="wrapper">
    <?php include_once('inc/header-menu.php') ?>
    <?php include_once('inc/main-sidebar.php');?>
    <div class="content-wrapper">
      <section class="content-header">
       <h1>
          Compose
          <small>your message</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Member</li>
        </ol>
    </section>
    <section class="content col-md-8">
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body">
                <form id="form-msg" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="contact" class="col-form-label">Contacts:</label>
                        <select id="contact" class="form-control select2" style="width:100%;" name="contact[]" required multiple="multiple"></select>
                    </div>
                    <div class="form-group">
                        <label for="title">Message Title</label>
                        <input type="text" class="form-control input-lg" id="title" name="title" placeholder="Enter title..." required>
                    </div>
                    <div class="form-group">
                        <label for="title">Message Description</label>
                        <textarea class="form-control input-lg" maxlength="100" rows="6" placeholder="Enter your message 100 Max Characters per SMS" spellcheck="false" name="desc" id="desc" required></textarea>
                    </div>
            </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-success btn-lg pull-right">Send</button>
        </div>
        </form>
        </div>
    </section>
    <section class="content col-md-4">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Recently Sent</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                </div>
            </div>
            <div class="box-body">
                <ul class="products-list product-list-in-box"></ul>
            </div>
        <!-- /.box-body -->
        </div>
    </section>
  </div>
  <?php include_once('inc/footer.php'); ?>
  <div class="control-sidebar-bg"></div>
</div>
<?php include_once('inc/script.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="dist/js/jquery-toast-plugin-master/dist/jquery.toast.min.js"></script>
<script src="dist/js/toast.js"></script>
<script src="dist/js/msg.js"></script>
</body>
</html>
