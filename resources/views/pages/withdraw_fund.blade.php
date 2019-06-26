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
                    <li><a href="">Withdraw Fund</a></li>
                </ol>

                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">WITHDRAWAL APPLICATION FORM</h4>
                    </div>

                    <div class="panel-body">

                        <main class="main">
                            <!-- main page starts here -->
                            <div class="breadcrumb">

                                <li class="breadcrumb-item"><span class="uk-badge"> &nbsp; Total Withdrawal: @{{ withdrawal.length }} &nbsp; </span></li>
                                <li> &nbsp; <button class="newButton breadcrumb-item uk-button uk-button-primary uk-button-small" href="#newDepositForm" uk-scroll @click="newDepositForm = true">Add New Withdrawal</button></li>
                            </div>

                            <div class="container-fluid">
                                <div class="animated fadeIn">

                                    <!-- new deposit form -->
                                    <div id="newDepositForm" class="col-lg-12 uk-animation-slide-top-medium" v-show="newDepositForm">
                                        <div class="card">
                                            <div class="card-header">
                                                <i class="fa fa-edit"></i>  Fill in the new withdrawal details
                                                <div class="card-actions">
                                                    <a class="pull-right" style="color:#FC0000;"  @click="newDepositForm = false" uk-close></a>
                                                </div>
                                            </div>
                                            <div class="card-block">
                                                @if(count($balance) > 0)
                                                    @if($balance->sum('returns') > 0)





                                                        {{-- @if(count($referral) > 0)
                                                                 @if($referral->sum('amount') > 0)--}}
                                                        <form  action="" method="post" @submit.prevent="withdraw()" @keydown="clear($event.target.name)" >
                                                            <div class="box-body">
                                                                <div class="alert alert-success" v-if="submitted">
                                                                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
                                                                    Your request has been received
                                                                </div>
                                                               {{-- <div class="alert alert-info">
                                                                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
                                                                    Kindly withdraw all your cash once...</div>--}}
                                                                    <p>Your total balance is ${{ $sum }}</p>
                                                                @if($bal_after_7days > 0)
                                                                <p>Your balance is ${{ $bal_after_7days }} <br/>It would be available on your next withdrawal</p>
                                                                @else
                                                                    <p>You have no balance at this time</p>
                                                                @endif


                                                                    <div class="input-group">
                                                                    <span class="input-group-addon">Amount  $</span>
                                                                    <input type="text" class="form-control" id="amount" v-model="withdrawalDetails.amount" placeholder="Withdrawal Amount"  name="amount">
                                                                    <span class="input-group-addon">.00</span>
                                                                </div>
                                                                <span class="help is-danger" style="color: red;">@{{ getWithdrawalError('amount') }}</span><br/>
                                                                <span style="color: red;" class="validation" v-show="!validations.amount.is_valid">@{{ validations.amount.text }}</span>

                                                                {{--                                  <span v-if="withdrawalDetails.amount > withdraw_amt.sum">
                                                                   <span class="help is-danger" style="color: red;">You have exceeded your total balances</span>
                                                             </span>--}}
                                                                <br>

                                                                <input type="hidden" name="total" v-model="withdrawalDetails.total">
                                                                <div class="box-footer">
                                                                    <input type="submit" name="save"  class="btn btn-primary btn-lg" value="Apply">
                                                                </div>
                                                            </div>
                                                            <!-- /.box-body -->
                                                        </form>

@endif



                                                @else
                                                    @if(count($referral) > 0)
                                                        @if($referral->sum('amount') > 0)



                                                            <form  action="" method="post" @submit.prevent="withdrawReferral()" @keydown="clear($event.target.name)" >
                                                                <div class="box-body">
                                                                    <div class="alert alert-success" v-if="submitted">
                                                                        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
                                                                        Your request has been received
                                                                    </div>
                                                                    <p>Your referral balance is {{ $sum }}</p>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Amount  $</span>
                                                                        <input type="text" class="form-control" id="amount" v-model="withdrawalReferralDetails.amount" placeholder="Withdrawal Amount"  name="amount">
                                                                        <span class="input-group-addon">.00</span>
                                                                    </div>
                                                                    <span class="help is-danger" style="color: red;">@{{ getWithdrawalReferralError('amount') }}</span><br/>
                                                                    <span style="color: red;" class="validation" v-show="!validations.amount.is_valid">@{{ validations.amount.text }}</span>
                                                                    <br>

                                                                    <input type="hidden" name="referral" v-model="withdrawalReferralDetails.referral">
                                                                    <div class="box-footer">
                                                                        <input type="submit" name="save"  class="btn btn-primary btn-lg" value="Apply">
                                                                    </div>
                                                                </div>
                                                                <!-- /.box-body -->
                                                            </form>
                                                        @endif

                                                    @else
                                                        <p>Your account balance is $0</p>
                                                    @endif
                                                @endif


                                                  {{--  @else
                                                        <p>Your account balance is $0</p>
                                                    @endif
                                                @endif--}}



                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- new category form -->




                                    <!-- search input -->
                                    <div class="card-block" v-show="!newDepositForm">
                                        <div id="searchForm" class="col-lg-12 uk-animation-slide-top-medium">
                                            <div class="card">
                                                <div class="card-header">
                                                    <input type="text"  class="form-control" placeholder="search withdrawals....">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- search input -->

                                <div class="col-sm-6 col-md-4 uk-animation-slide-bottom-medium"  v-for="withdraw in withdrawal" v-show="!newWithdrawalForm">
                                    <div class="card uk-card uk-card-default uk-card-hover">
                                        <div class="card-block">
                                            <strong class="categoryName"> Amount:</strong> &nbsp;$@{{ withdraw.amount }}
                                            <hr>
                                            <p> <strong class="categoryDescription">Status:</strong> &nbsp;@{{ withdraw.status }}</p>
                                            <p> <strong class="categoryDescription">Application Date:</strong> &nbsp;@{{ withdraw.created_at | formatDate }}</p>
                                            <p v-if="withdraw.payment_date == null"> <strong class="categoryDescription">Payment Date:</strong>&nbsp;Not Yet Paid</p>
                                            <p v-else> <strong class="categoryDescription">Payment Date:</strong> &nbsp;@{{ withdraw.payment_date | formatDate }}</p>
                                        </div>

                                        <div class="uk-container card-footer">

                                       {{--     <a v-if="withdraw.status == 'NOT PAID' " style="color:#FC0000;" uk-icon="icon: close; ratio: 1.2" uk-toggle   :href="`http://localhost/prime/delete-withdrawal/${withdraw.id}`" ><i class="fa fa-times"></i></a>
--}}
                                        </div>
                                    </div>
                                </div>







                            </div>

                        </main>
                            </div>


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
    <script src="{!! asset('js/index.js') !!}"></script>
@endsection

