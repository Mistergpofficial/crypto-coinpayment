<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="a bitcoin trading lab">
    <meta name="author" description="Crypto Traders Lab">
    <meta property="og:url"           content="{{ url('/') }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Crypto Traders Lab" />
    <meta property="og:description"   content="a bitcoin trading lab" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Welcome to Crypto Traders Lab</title>

    <link rel="stylesheet" href="{!! asset('css/font-awesome.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/select2.css') !!}">

    <link rel="stylesheet" href="{!! asset('css/quirk.css') !!}">

    <link rel="icon" type="image/png" href="{!! asset('images/logo-white.png') !!}" width="140px">
    <script src="{!! asset('js/modernizr.js') !!}"></script>
    <!-- pass php vars to javascript -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'appUrl' => url("/"),
            'siteUser' => auth()->user(),
        ]); ?>
    </script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="../lib/html5shiv/html5shiv.js"></script>
    <script src="../lib/respond/respond.src.js"></script>
    <![endif]-->
</head>

<body class="signwrapper">
    <div id="app">
    <div class="sign-overlay"></div>
    <div class="signpanel"></div>

    <div class="signup">
        <div class="row">
            <div class="col-sm-5">
                <div class="panel">
                    <div class="panel-heading">
                        <h1><a href="{!! url('/') !!}">Crypto Traders Lab</a></h1>
                        <h4 class="panel-title">Create an Account!</h4>
                    </div>
                    <div class="panel-body">
                        <!--  <button class="btn btn-primary btn-quirk btn-fb btn-block">Sign Up Using Facebook</button>
                          <div class="or">or</div>-->
                        @if (session('success'))
                            <div class="alert alert-success">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="post" action="{{ url('account/post-register') }}" @keydown="clear($event.target.name)">
                            {{ csrf_field()}}
                            <div class="form-group mb15">
                                <input type="text" name="full_name"  class="form-control" value="{{ old('full_name') }}" placeholder="Enter Your Full Name">
                                @if ($errors->has('full_name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('full_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb15">
                                <input type="text" name="username"  class="form-control" value="{{ old('username') }}" placeholder="Enter Your Username">
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb15">
                                <input type="email" name="email"  class="form-control" value="{{ old('email') }}" placeholder="Enter Your Email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb15">
                                <input type="password" name="password"  class="form-control" placeholder="Enter Your Password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb15">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Your Password Again">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb15">
                                <input type="text" name="bitcoin"  class="form-control" value="{{ old('bitcoin') }}" placeholder="Enter Your Bitcoin Wallet">
                                @if ($errors->has('bitcoin'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('bitcoin') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb15">
                                <input type="text" name="upline" class="form-control" value="{{ $user }}" placeholder="Enter Your Sponsor Username">
                                @if ($errors->has('upline'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('upline') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mb15">
                                <input type="text" name="phone"  class="form-control" value="{{ old('phone') }}" placeholder="Enter Your Phone Number">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group mb20">
                                <label class="ckbox">
                                    <input type="checkbox" name="checkbox" checked>
                                    <span>Accept terms and conditions</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success btn-quirk btn-block">Create Account</button>
                            </div>
                        </form>
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-sm-5 -->
            <div class="col-sm-7">
                <div class="sign-sidebar">
                    <img src="{!! asset('images/4.jpg') !!}" />
                    <hr class="invisible">

                    <div class="form-group">
                        <a href="{!! route('auth.login') !!}" class="btn btn-default btn-quirk btn-stroke btn-stroke-thin btn-block btn-sign">Already a member? Sign In Now!</a>
                    </div>
                </div><!-- sign-sidebar -->
            </div>
        </div>
    </div><!-- signup -->

</div>
<script src="{!! asset('js/jquery.min.js') !!}"></script>
<script src="{!! asset('js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('js/select2.js') !!}"></script>
<script src="{!! asset('js/app.js') !!}"></script>
<script>
    $(function() {

        // Select2 Box
        $("select.form-control").select2({ minimumResultsForSearch: Infinity });

    });
</script>



</body></html>
