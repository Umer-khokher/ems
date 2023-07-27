<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $pageName }} | {{ env('APP_NAME') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="{{ url('/') }}"><b>{{ env('APP_NAME') }}</b></a>
    </div>

    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
        @endif
        <p class="login-box-msg">Sign in to start your session</p>
        <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
        @if (isset($user) && $user->status === 'inactive')
        <form method="POST" action="{{ route('set.password', $user) }}">
          @csrf

          @elseif(isset($user) && $user->status === 'active')
          <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>         elseif(active)           >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="email" value="<?php echo $user->email;?>">
            <!-- <input type="password" name="password" placeholder="password"> -->
            <div class="form-group">
              <label for="password">{{ __('Password') }}</label>
              <input id="password" type="password" placeholder="password"
                class="form-control @error('password') is-invalid @enderror" name="password" required>

              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>         elseif(active)           >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
            @else
            <form method="POST" action="{{ route('custom.login') }}">
              @csrf
              <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{ old('email') }}" required autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              @endif
              @if (isset($user) && $user->status === 'inactive')
              <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" placeholder="new password" class="form-control @error('password') is-invalid @enderror"
                  name="password" required>

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" type="password" placeholder="confirm password" class="form-control" name="password_confirmation"
                  required>
              </div>
              @endif

              <button type="submit" class="btn btn-primary">
                {{ __('Next') }}
              </button>
            </form>
          </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
  <!-- The actual snackbar -->
  <div id="snackbar" class="bg-danger"><b>Error!</b><br>
    <p>Some text some message..</p>
  </div>
  <!-- jQuery -->
  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

  <script>
    @if (session() -> get('error'))
      showToast('{{ session()->get("error") }}');
    @endif
    function showToast(msg = null) {
      $('#snackbar p').html(msg);
      $('#snackbar').addClass('show');
      setTimeout(function () {
        $('#snackbar').removeClass('show');
      }, 3000);
      // Get the snackbar DIV
      // var x = document.getElementById("snackbar");
      // Add the "show" class to DIV
      // x.className = "show";
      // After 3 seconds, remove the show class from DIV
      // setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
  </script>
</body>

</html>