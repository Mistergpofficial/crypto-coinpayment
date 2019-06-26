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
    <!-- Custom CSS -->
    <!-- Style customizer (Remove these two lines please) -->




@endsection

@section('content')
    <Left></Left>
    <div id="index">
        <section>
            <div class="mainpanel">

                <div class="contentpanel">

                    <ol class="breadcrumb breadcrumb-quirk">
                        <li><a :href="`https://cryptotraderslab.com`"><i class="fa fa-home mr5"></i> Home</a></li>
                        <li><a href="">Transactions</a></li>
                    </ol>

                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">CLIENT TRANSACTIONS</h4>
                            <p>Total Transactions:  &nbsp; </p>
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                @if($transactions->count() > 0)
                                <table class="table nomargin">
                                    <thead>
                                    <tr>
                                        <th class="text-center">
                                            <label class="ckbox ckbox-primary">
                                                <input type="checkbox"><span></span>
                                            </label>
                                        </th>
                                        <th>Amount($)</th>
                                        <th>Rate(%)</th>
                                        <th>Transaction ID</th>
                                        <th>Full Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">BTC Address</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        <td class="text-center">
                                            <label class="ckbox ckbox-primary">
                                                <input type="checkbox"><span></span>
                                            </label>
                                        </td>
                                        <td>{{ $transaction->amount_btc }}</td>
                                        <td>{{ $transaction->rate }}</td>
                                        <td>{{ $transaction->txn_id }}</td>
                                        <td>{{ $transaction->buyer_name }}</td>
                                        <td class="text-center">{{ $transaction->buyer_email }}</td>
                                        <td class="text-center">{{ $transaction->address }}</td>
                                        @if($transaction->status == "PENDING")
                                            <td> <a href="{{ url('confirm-payment').'/'.$transaction->id}}" class="btn btn-info"><span class="label label-success">ACTIVATE</span></a></td>
                                        @else
                                            <td><button class="btn btn-success"><span class="label label-success">{{ $transaction->status  }}</span></button></td>
                                        @endif

                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                                @else
                                    <div class="alert alert-info">You have no pending transaction</div>
                                @endif
                                <div class="col-md-12 text-center">
                                    {{ $transactions->links() }}
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </section>
    </div>
@endsection


@section('scripts')
    <script src="{!! asset('js/admin/jquery.js') !!}"></script>
    <script src="{!! asset('js/admin/bootstrap.js') !!}"></script>
    <script src="{!! asset('js/admin/modernizr.js') !!}"></script>
    <script src="{!! asset('js/admin/jquery-ui.js') !!}"></script>
    <script src="{!! asset('js/admin/toggles.js') !!}"></script>
    <script src="{!! asset('js/admin/quirk.js') !!}"></script>
    <script src="{!! asset('js/index.js') !!}"></script>
@endsection

