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
                    <li><a href="">Client Withdrawals</a></li>
                </ol>

                <div class="panel">
                    <div class="panel-heading">
                      {{--  <h4 class="panel-title">WITHDRAWAL APPLICATION FORM</h4>--}}
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            @if($withdrawals->count() > 0)
                            <table class="table nomargin">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        <label class="ckbox ckbox-primary">
                                            <input type="checkbox"><span></span>
                                        </label>
                                    </th>
                                    <th>CLIENT</th>
                                    <th>AMOUNT ($)</th>
                                    <th>STATUS</th>
                                    <th>WITHDRAWAL TYPE</th>
                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($withdrawals as $withdraw)
                                <tr>
                                    <td class="text-center">
                                        <label class="ckbox ckbox-primary">
                                            <input type="checkbox"><span></span>
                                        </label>
                                    </td>
                                    <td>{{ $withdraw->full_name }}</td>
                                    <td>{{ $withdraw->amount }}</td>
                                    <td>{{ $withdraw->status }}</td>
                                    @if($withdraw->type == "total")
                                        <td><span>Total balance</span></td>
                                    @else
                                        @if($withdraw->type == "referral")
                                            <td><span>Referral balance</span></td>
                                        @endif
                                    @endif
                                    @if($withdraw->status == "NOT PAID" && $withdraw->type == "total")
                                        <td> <a href="{{ url('confirm-withdrawal-payment').'/'.$withdraw->id}}" class="btn btn-info">PAY NOW</a></td>
                                    @else

                                        @if($withdraw->status == "NOT PAID" && $withdraw->type == "referral")
                                            <td> <a href="{{ url('confirm-referral-withdrawal-payment').'/'.$withdraw->id}}" class="btn btn-info">PAY REFERRAL NOW</a></td>
                                        @else
                                            <td><button class="btn btn-success">{{ $withdraw->status  }}</button></td>

                                        @endif
                                    @endif

                                    {{-- <td>
                                        <ul class="table-options">
                                            <li><a href=""><i class="fa fa-pencil"></i></a></li>
                                            <li><a href=""><i class="fa fa-trash"></i></a></li>
                                        </ul>
                                    </td>--}}
                                    @endforeach
                                </tr>


                                </tbody>
                            </table>
                            @else
                                <div class="alert alert-info">You have no pending withdrawals</div>
                            @endif

                            <div class="col-md-12 text-center">
                                {{ $withdrawals->links() }}
                            </div>

                        </div><!-- table-responsive -->

                    </div>


                </div>
            </div><!-- panel -->





        </div><!-- contentpanel -->
    </div><!-- mainpanel -->


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

