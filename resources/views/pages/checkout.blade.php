@extends('layouts.fund_layout')
@section('styles')
    <!-- Bootstrap -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/font-awesome.css') !!}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/weather-icons.css') !!}">
    <!-- owl-carousel CSS -->
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/toggles-full.css') !!}">
    <!-- Animate CSS -->
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/quirk.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/hover.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/ionicons.css') !!}">

    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/morris.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/uikit.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/custom.css') !!}">
    <!-- Custom CSS -->
    <!-- Style customizer (Remove these two lines please) -->




@endsection

@section('content')

    <Left></Left>
    <div id="index">
        <div class="mainpanel">

            <div class="contentpanel">

                <ol class="breadcrumb breadcrumb-quirk">
                    <li><a href="{!! route('user.dashboard') !!}"><i class="fa fa-home mr5"></i> Home</a></li>
                    <li><a href="">CHECKOUT</a></li>
                </ol>

                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">CHECKOUT</h4>
                    </div>

                    <div class="panel-body">

                        <main class="main">
                            <!-- main page starts here -->

                            <div class="col-sm-5 col-md-12 col-lg-6">
                                <div class="panel panel-danger panel-weather">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Checkout</h4>
                                    </div>
                                    <div class="panel-body inverse">
                                        @foreach($transaction as $trans)
                                        <div class="row mb10">
                                            <div class="col-xs-6">
                                                <h2 class="today-day"><strong><a href="{{  $trans->status_url }}">Proceed to CoinPayment</a></strong>
                                                </h2>
                                            </div>
                                            <div class="col-xs-6">
                                            </div>
                                        </div>
                                        <p class="nomargin"></p>
                                        <div class="row mt10">
                                            <div class="col-xs-7">
                                            </div>
                                            <div class="col-xs-5">
                                            </div>
                                        </div>
                                            @endforeach
                                    </div>
                                </div>
                            </div><!-- col-md-12 -->





                        </main>

                    </div>
                </div><!-- panel -->





            </div><!-- contentpanel -->
        </div><!-- mainpanel -->
    </div>

@endsection


@section('scripts')
    <script src="{!! asset('js/admin/jquery.js') !!}"></script>
    <script src="{!! asset('js/admin/bootstrap.js') !!}"></script>
    <script src="{!! asset('js/admin/modernizr.js') !!}"></script>
    <script src="{!! asset('js/admin/jquery-ui.js') !!}"></script>
    <script src="{!! asset('js/admin/toggles.js') !!}"></script>
    <script src="{!! asset('js/admin/quirk.js') !!}"></script>
    <script src="{!! asset('js/admin/uikit.min.js') !!}"></script>
    <script src="{!! asset('js/admin/custom.js') !!}"></script>
    <script src="{!! asset('js/index.js') !!}"></script>
@endsection

