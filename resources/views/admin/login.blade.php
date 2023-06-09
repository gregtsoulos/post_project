<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Post Project - Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{URL::to('assets/admin/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::to('assets/admin/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{URL::to('assets/admin/plugins/iCheck/square/blue.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <!--
      <div class="login-logo">
        <a href="{{URL::to('/')}}"><img src="{{URL::to('assets/images/mainlogo.jpeg')}}" width="150px;"></a>
      </div>
    -->
      <!-- /.login-logo -->
      <div class="login-box-body">
        <h3 class="login-box-msg">Sign in to start your session</h3>
        <form method="post" action="{{ url('/admin/login_submit') }}">
        {{ csrf_field() }}

        @if(session()->has('error_password'))
        <div style="color:red; text-align:center;">{{ session()->get('error_password') }}</div>
        @endif

        @if($errors->has('username'))
        <div style="color:red; text-align:center;">Username is Required</div>
        @endif

        @if($errors->has('pass_word'))
        <div style="color:red;text-align:center;">Password is Required</div>
        @endif

          <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="pass_word" class="form-control" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

       

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{URL::to('assets/admin/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{URL::to('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{URL::to('assets/admin/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
