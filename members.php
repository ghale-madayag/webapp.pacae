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
          Members
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
            <form id="form-member-all" class="form-horizontal" enctype="multipart/form-data" method="post">
                <table id="member-all" class="table table-striped member-all" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5"><div style="display: none;"><input type="checkbox" id="select-all"><label for="select-all"></label></div></th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Region</th>
                            <th>Position</th>
                            <th>School Name</th>
                            <th>School Address</th>
                            <th>Date Created</th>
                            <th>Status</th>
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

    <div class="modal fade" id="addEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Member</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form-member" enctype="multipart/form-data" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="fname" class="col-sm-4 control-label">First name:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="fname" name="fname" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lname" class="col-sm-4 control-label">Last name:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="lname" name="lname" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="col-sm-4 control-label">Mobile Number:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mobile" name="mobile" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-4 control-label">Email.:</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="region" class="col-sm-4 control-label">Region:</label>
                                <div class="col-sm-8">
                                <select class="form-control" required name="region">
                                    <option selected disabled>Select Region</option>
                                    <option value=" Region I">Region I </option>
                                    <option value=" Region II">Region II </option>
                                    <option value=" Region III">Region III </option>
                                    <option value=" Region IV-A">Region IV-A </option>
                                    <option value=" Region IV-B">Region IV-B </option>
                                    <option value=" Region V">Region V </option>
                                    <option value=" Region VI">Region VI </option>
                                    <option value=" Region VII">Region VII </option>
                                    <option value=" Region VIII">Region VIII </option>
                                    <option value=" Region IX">Region IX </option>
                                    <option value=" Region X">Region X </option>
                                    <option value=" Region XI">Region XI </option>
                                    <option value=" Region XII">Region XII </option>
                                    <option value=" Region XIII">Region XIII </option>
                                    <option value=" NCR">NCR </option>
                                    <option value=" ARMM">ARMM </option>
                                    <option value="CAR">CAR </option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="position" class="col-sm-4 control-label">Position:</label>
                                <div class="col-sm-8">
                                <select class="form-control" required name="position">
                                    <option selected disabled>Select Position </option>
                                    <option value="PRESCHOOL TEACHER">PRESCHOOL TEACHER</option>
                                    <option value="ELEM TEACHER 1">ELEM TEACHER 1</option>
                                    <option value="ELEM TEACHER 2">ELEM TEACHER 2</option>
                                    <option value="ELEM TEACHER 3">ELEM TEACHER 3</option>
                                    <option value="ELEM PRINCIPAL 1">ELEM PRINCIPAL 1</option>
                                    <option value="ELEM PRINCIPAL 2">ELEM PRINCIPAL 2</option>
                                    <option value="ELEM PRINCIPAL 3">ELEM PRINCIPAL 3</option>
                                    <option value="HS TEACHER 1">HS TEACHER 1</option>
                                    <option value="HS TEACHER 2">HS TEACHER 2</option>
                                    <option value="HS TEACHER 3">HS TEACHER 3</option>
                                    <option value="HS PRINCIPAL 1">HS PRINCIPAL 1</option>
                                    <option value="HS PRINCIPAL 2">HS PRINCIPAL 2</option>
                                    <option value="HS PRINCIPAL 3">HS PRINCIPAL 3</option>
                                    <option value="MASTER TEACHER 1">MASTER TEACHER 1</option>
                                    <option value="MASTER TEACHER 2">MASTER TEACHER 2</option>
                                    <option value="MASTER TEACHER 3">MASTER TEACHER 3</option>
                                    <option value="HEAD TEACHER 1">HEAD TEACHER 1</option>
                                    <option value="HEAD TEACHER 2">HEAD TEACHER 2</option>
                                    <option value="HEAD TEACHER 3">HEAD TEACHER 3</option>
                                    <option value="DISTRICT SUPERVISOR">DISTRICT SUPERVISOR</option>
                                    <option value="EDUCATION PROGRAM SUPERVISOR">EDUCATION PROGRAM SUPERVISOR </option>
                                    <option value="SCHOOLS DIVISION SUPERINTENDENT">SCHOOLS DIVISION SUPERINTENDENT</option>
                                    <option value="PRIVATE SCHOOL ADMINISTRATOR">PRIVATE SCHOOL ADMINISTRATOR</option>
                                    <option value="COLLEGE INSTRUCTOR/PROFESSOR">COLLEGE INSTRUCTOR/PROFESSOR</option>
                                    <option value="COLLEGE STUDENT">COLLEGE STUDENT</option>
                                    <option value="TEACHER APPLICANT">TEACHER APPLICANT</option>
                                    <option value="OTHERS">OTHERS</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="school" class="col-sm-4 control-label">School Name:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="school" name="school" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="schooladd" class="col-sm-4 control-label">School Address:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="schooladd" name="schooladd" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
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
<script src="dist/js/member.js"></script>
</body>
</html>
