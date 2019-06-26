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

    <meta name="csrf-token" content="{{ csrf_token() }}">




    @yield('styles')


    <link rel="icon" type="image/png" href="{!! asset('images/logo-white.png') !!}" width="40px">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- pass php vars to javascript -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'appUrl' => url("/"),
            'siteUser' => auth()->user(),
        ]); ?>
    </script>
    <div id="google_translate_element" align="right"></div><script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');
        }
    </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>
<body>
<!-- loading -->
<div id="loading" style="display: none;">
    <div id="loading-center">
        <img src="{!! asset('images/loading-img.png') !!}" alt="loader">
    </div>
</div>
<!-- loading End -->
<!-- Header -->
<header class="simpal-transparent">
    <div class="topbar">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="topbar-left">
                        <ul class="list-inline">
                          {{--   <li class="list-inline-item"><i class="fa fa-phone text-blue"></i> +0123 456 789</li> --}}
                            <li class="list-inline-item"><i class="fa fa-envelope-o"> </i> support@cryptotraderslab.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="topbar-right text-right">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <ul class="list-inline iq-left">
                                    <li class="list-inline-item"><a href="{!! route('auth.login') !!}" data-toggle="modal" data-target=".iq-login" data-whatever="@mdo"><i class="fa fa-lock"></i>Login</a></li>
                                    <li class="list-inline-item"><a href="{!! route('auth.register') !!}" data-toggle="modal" data-target=".iq-register" data-whatever="@fat"><i class="fa fa-user"></i>Register</a></li>
                                </ul>
                            </li>
{{--                            <li class="list-inline-item"><a href=""><i class="fa fa-comments-o"></i>Free Consulting</a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="iq-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="logo">
                        <a href="{!! url('/') !!}"><img id="logo_img" class="img-fluid" src="{!! asset('images/logo-white.png') !!}" alt="logo"></a>
                    </div>
                    <nav> <a id="resp-menu" class="responsive-menu" href=""><i class="fa fa-reorder"></i> Menu</a>
                        <ul class="menu text-right" style="">
                            <li><a class="active" href="{!! url('/') !!}">HOME</a></li>
                            <li><a class="" href="#about">ABOUT</a></li>
                            <li><a class="" href="{!! url('faq') !!}">FAQ</a></li>
                            <li><a href="{!! url('contact') !!}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

    @yield('content')
   @include('pages.footer')
    @yield('scripts')

</body>
</html>