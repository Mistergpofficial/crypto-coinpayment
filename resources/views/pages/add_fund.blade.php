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
                    <li><a href=""><i class="fa fa-home mr5"></i> Home</a></li>
                    <li><a href="">Add Fund</a></li>
                </ol>

                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">DEPOSIT FORM</h4>
                    </div>

                    <div class="panel-body">

                        <main class="main">
                            <!-- main page starts here -->
                            <div class="breadcrumb">

                                <li class="breadcrumb-item"><span class="uk-badge"> &nbsp; Total Deposit:  &nbsp; </span></li>
                                <li> &nbsp; <button class="newButton breadcrumb-item uk-button uk-button-primary uk-button-small" href="#newDepositForm" uk-scroll @click="newDepositForm = true">Add New Deposit</button></li>
                            </div>

                            <div class="container-fluid">
                                <div class="animated fadeIn">

                                    <!-- new deposit form -->
                                    <div id="newDepositForm" class="col-lg-12 uk-animation-slide-top-medium" v-show="newDepositForm">
                                        <div class="card">
                                            <div class="card-header">
                                                <i class="fa fa-edit"></i>  Fill in the new deposit details
                                                <div class="card-actions">
                                                    <a class="pull-right" style="color:#FC0000;"  @click="newDepositForm = false" uk-close></a>
                                                </div>
                                            </div>
                                            <div class="card-block">

                                              {{--  <form method="POST" action="https://www.coinpayments.net/index.php">
--}}
                                                <form @submit.prevent="invest()" @keydown="clear($event.target.name)">
                                                    <div class="alert alert-info">
                                                        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
                                                        Minimum deposit amount is $5000...</div>
                                                    <input type="hidden" name="id" v-model="investmentDetails.id = authUser.id">
                                                    <div class="form-group">
                                                        <label for="">Currency</label>
                                                        <select class="form-control" name="currency" id="currency"  style="box-shadow:none; -webkit-box-shadow:none; border-radius:0; -moz-box-shadow:none;   border: 1px solid #CFD2D7;" v-model="investmentDetails.currency">
                                                            <option disabled value="">- Choose a currency * -</option>
                                                            <option value="BTC">BTC</option>
                                                        </select>
                                                        <span class="help is-danger" style="color: red;">@{{ getInvestmentError('currency') }}</span>
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Amount USD</span>
                                                        <input type="text" class="form-control" id="amount"   name="amount" v-model="investmentDetails.amount">
                                                    </div>
                                                    <p class="help is-danger" style="color: red;">@{{ getInvestmentError('amount') }}</p>
                                                    <div class="form-group">
                                <span v-if="investmentDetails.amount >= 5000 && investmentDetails.amount <= 100000">
                            <label for="">Investment Package</label>
                            <select name="registras_plan" class="form-control" v-model="investmentDetails.registras_plan" >
                                <option disabled value="">- Choose a package * -</option>
                                <option>Premium Plan</option>
                            </select>
                              <span class="help is-danger" style="color: red;">@{{ getInvestmentError('registras_plan') }}</span>
                        </span>
                                                        <span v-if="investmentDetails.amount >= 100001">
                            <label for="">Investment Package</label>
                            <select name="registras_plan" class="form-control" v-model="investmentDetails.registras_plan" >
                                <option disabled value="">- Choose a package * -</option>
                                <option>Ultimate Plan</option>
                            </select>
                                 <span class="help is-danger" style="color: red;">@{{ getInvestmentError('registras_plan') }}</span>
                           </span>
                                                        <span v-if="investmentDetails.amount > 0 && investmentDetails.amount <= 4999">
                                 <span class="help is-danger" style="color: red;">Plan amount begins from 5000 upwards</span>
                           </span>
                                                    </div>
                                                  {{--  <span style="color: red;" class="validation" v-show="!validation.amount.is_valid">@{{ validation.amount.text }}</span>
                                                  --}}  <br>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Amount BTC</span>
                                                        <input type="text" class="form-control" id="amount_btc"   name="amount_btc" v-model="investmentDetails.amount_btc = result">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Name</span>
                                                        <input type="text" class="form-control" id="buyer_name"   name="buyer_name" v-model="investmentDetails.buyer_name = authUser.full_name" disabled>
                                                    </div>
                                                    <p class="help is-danger" style="color: red;">@{{ getInvestmentError('buyer_name') }}</p>

                                                    <div class="input-group">
                                                        <span class="input-group-addon">Email</span>
                                                        <input type="text" class="form-control" id="buyer_email"   name="buyer_email" v-model="investmentDetails.buyer_email = authUser.email" disabled>
                                                    </div>
                                                    <p class="help is-danger" style="color: red;">@{{ getInvestmentError('buyer_email') }}</p>
                                                    <br/>
                                                    <button type="submit" class="btn btn-primary btn-block">PAY NOW</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- new category form -->




                                    <!-- search input -->
                                    <div class="card-block" v-show="!newDepositForm">
                                        <div id="searchForm" class="col-lg-12 uk-animation-slide-top-medium">
                                            <div class="card">
                                                <div class="card-header">
                                                    <input type="text" class="form-control" placeholder="search deposits....">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- search input -->



                                </div>
                            </div>
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

