<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Events | PACAE</title>
  <?php include_once('inc/header.php')?>
  <link href="dist/css/lightbox.css" rel="stylesheet" />
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
          <li class="active">Events</li>
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
                                <th>Attendees</th>
                                <th>Confirmed</th>
                                <th width="200">Events Title</th>
                                <th width="400">Events Description</th>
                                <th>Event Date</th>
                                <th>Location</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                    </table>
                </form>
            </div>
        <!-- /.box-body -->
        </div>
    </section>
    <div class="modal fade" id="addEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Event</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form-events" enctype="multipart/form-data" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-4 control-label">Title:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="desc" class="col-sm-4 control-label">Description:</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="6" placeholder="Enter your message..." spellcheck="false" name="desc" id="desc" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="eveDate" class="col-sm-4 control-label">Date:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="eveDate" name="eveDate" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="location" class="col-sm-4 control-label">Location:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="location" name="location" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="img" class="col-sm-4 control-label">Featured Image:</label>
                                <div class="col-sm-8">
                                  <input type="file" id="img" name="img" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Event</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form-events-edit" enctype="multipart/form-data" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="titleEdit" class="col-sm-4 control-label">Title:</label>
                                <div class="col-sm-8">
                                    <input type="hidden" class="form-control" id="eventId" name="eventId" required>
                                    <input type="text" class="form-control" id="titleEdit" name="titleEdit" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="descEdit" class="col-sm-4 control-label">Description:</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="6" placeholder="Enter your message..." spellcheck="false" name="descEdit" id="descEdit" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="eveDateEdit" class="col-sm-4 control-label">Date:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="eveDateEdit" name="eveDateEdit" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="locationEdit" class="col-sm-4 control-label">Location:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="locationEdit" name="locationEdit" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="imgEdit" class="col-sm-4 control-label">Featured Image:</label>
                                <div class="col-sm-8">
                                  <input type="file" id="imgEdit" name="imgEdit">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="getAttendees" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titAtt">Attendees</h4>
                </div>
                <div class="modal-body">
                <form id="form-events-all" class="form-horizontal" enctype="multipart/form-data" method="post">
                    <table id="events-all" class="table table-striped events-all" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="5"><div style="display: none;"><input type="checkbox" id="select-all"><label for="select-all"></label></div></th>
                                <th>Deposit Slip</th>
                                <th>Name</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                    </table>
                </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="getConfirmed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titConf">Confirmed</h4>
                </div>
                <div class="modal-body">
                <form id="form-eventsCon-all" class="form-horizontal" enctype="multipart/form-data" method="post">
                    <table id="eventsCon-all" class="table table-striped eventsCon-all" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Deposit Slip</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Designation</th>
                                <th>School</th>
                                <th>School Address</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                    </table>
                </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </div>
  <?php include_once('inc/footer.php'); ?>
  <div class="control-sidebar-bg"></div>
</div>
<?php include_once('inc/script.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="dist/js/jquery-toast-plugin-master/dist/jquery.toast.min.js"></script>
<script src="dist/js/lightbox.js"></script>
<script src="dist/js/toast.js"></script>
<script src="dist/js/events.js"></script>
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
