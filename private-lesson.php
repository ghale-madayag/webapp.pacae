<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Private Lesson | CIA</title>
  <?php include_once('inc/header.php')?>
</head>
<body class="hold-transition sidebar-mini skin-blue-light">
<div class="wrapper">
    <?php include_once('inc/header-menu.php') ?>
    <?php include_once('inc/main-sidebar.php');?>
    <div class="content-wrapper">
      <section class="content-header">
       <h1>
          Private Lesson
          <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Blank page</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <form id="form-pl-all" class="form-horizontal" enctype="multipart/form-data" method="post">
                <table id="pl-all" class="table table-striped pl-all" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5"><div style="display: none;"><input type="checkbox" id="select-all"><label for="select-all"></label></div></th>
                            <th>School Name</th>
                            <th>Title</th>
                            <th>Time</th>
                            <th>Price</th>
                            <th>Order List</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                </table>
            </form>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
           
          </div>
          <!-- /.box-footer-->
        </div>
    </section>

    <div class="modal fade" id="addEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Event</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form-pl" enctype="multipart/form-data" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="school" class="col-sm-4 control-label">School Name</label>
                                <div class="col-sm-8">
                                <select class="form-control" required name="school">
                                    <option selected disabled>Select School</option>
                                    <option value="1">4 Beeston St, Teneriffe</option>
                                    <option value="2">Brisbane Grammar</option>
                                    <option value="3">Clayfield College</option>
                                    <option value="4">St Aidan's</option>
                                    <option value="5">Brisbane Powerhouse Stores Rehearsal Room</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-4 control-label">Event Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="time" class="col-sm-4 control-label">Event Time</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="time" placeholder="Time" name="time" required>
                            </div>
                            </div>
                            <div class="form-group">
                            <label for="list" class="col-sm-4 control-label">Order List</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="list" name="list" placeholder="Order List" required>
                            </div>
                            </div>
                        </div>
                            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </div>
  <?php include_once('inc/footer.php'); ?>
  <div class="control-sidebar-bg"></div>
</div>
<?php include_once('inc/script.php'); ?>
<script src="dist/js/pl.js"></script>
<script>
    getAllPL();
</script>
</body>
</html>
