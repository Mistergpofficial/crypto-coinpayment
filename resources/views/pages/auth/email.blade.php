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

    <div class="panel signin">
        <div class="panel-heading">
            <h1><a href="{!! url('/') !!}">Crypto Traders Lab</a></h1>
            <h4 class="panel-title">Reset Password</h4>
        </div>
        <div class="panel-body">
            <!--    <button class="btn btn-primary btn-quirk btn-fb btn-block">Connect with Facebook</button>
                <div class="or">or</div>-->
            <form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                @if (session('status'))
                    <div class="alert alert-success">
                        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-group mb10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-quirk btn-block">Send Password Reset Link</button>
                </div>
            </form>
            <hr class="invisible">
        </div>
    </div><!-- panel -->
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
