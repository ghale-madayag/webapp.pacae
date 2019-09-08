<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sent Message | PACAE</title>
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
          <li><a href="#"><i class="fa fa fa-envelope"></i> Message</a></li>
          <li class="active">Sent</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body">
                <form id="form-member-all" class="form-horizontal" enctype="multipart/form-data" method="post">
                    <table id="member-all" class="table table-striped member-all" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="5"><div style="display: none;"><input type="checkbox" id="select-all"><label for="select-all"></label></div></th>
                                <th>Contact Name</th>
                                <th>Message Title</th>
                                <th>Message Description</th>
                                <th>Status</th>
                                <th>Date Sent</th>
                            </tr>
                        </thead>
                    </table>
                </form>
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
<script src="dist/js/msg-sent.js"></script>
<script>
    $(function () {
    
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
   
    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".member-all input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".member-all input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

  });
</script>
</body>
</html>
