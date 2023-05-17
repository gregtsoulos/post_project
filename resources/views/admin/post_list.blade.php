<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Post List</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{URL::to('assets/admin/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::to('assets/admin/plugins/datatables/dataTables.bootstrap.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::to('assets/admin/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{URL::to('assets/admin/css/skins/_all-skins.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      @include('admin.header')
      <!-- Left side column. contains the logo and sidebar -->
      @include('admin.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Post List</h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Post List</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Post List</h3>
                </div><!-- /.box-header -->
                

              <div class="box">
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="width:5%;">Sr No</th>
                        <th style="width:10%;">Photo</th>
                        <th style="width:15%;">Name</th>
                        <th style="width:30%;">Description</th>
                        <th style="width:10%;">Publish Date</th>
                        <th style="width:10%;">Status</th>
                        <th style="width:20%;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $x = 1 ?>
                      <?php foreach($all_posts as $post){ ?>
                      <tr>
                        <td><?php echo $x; ?></td>
                        <td>
                          <?php if($post->photo){ ?>
                            <img src="{{URL::to('post_photos')}}/<?php echo $post->photo; ?>" style="width:100px; height:100px;">
                          <?php } else { ?>
                            <img src="{{URL::to('assets/admin/img/user2-160x160.jpg')}}" style="width:100px; height:100px;">
                          <?php } ?>
                        </td>
                        <td><?php echo $post->title; ?></td>
                        <td><?php echo $post->post_text; ?></td>
                        <td><?php echo $post->publish_date; ?></td>
                        <td><?php echo $post->status; ?></td>
                        <td><a href="{{URL::to('admin/edit_post')}}/<?php echo $post->id; ?>" class="btn btn-primary">Edit</a> <a href="{{URL::to('admin/delete_post')}}/<?php echo $post->id; ?>" class="btn btn-primary">Delete</a></td>
                      </tr>
                      <?php $x++; ?>
                      <?php } ?>
                    </tbody>

                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      @include('admin.footer')
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="{{URL::to('assets/admin/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{URL::to('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{URL::to('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::to('assets/admin/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{URL::to('assets/admin/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{URL::to('assets/admin/plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{URL::to('assets/admin/js/app.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{URL::to('assets/admin/js/demo.js')}}"></script>
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
