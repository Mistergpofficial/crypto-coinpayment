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
                    <li><a href="{!! url('/') !!}"><i class="fa fa-home mr5"></i> Home</a></li>
                    <li><a href="{!! route('user.fund-users') !!}">Funding</a></li>
                </ol>

                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">FUND USERS</h4>
                    </div>

                    <div class="panel-body">

                        <form method="POST" action="{!! route('post-user.fund-users') !!}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <select name="users" class="form-control">
                                    <option value="0">- Choose a user * -</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id}}">{{ $user->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('users'))
                                <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('users') }}</strong>
                        </span>
                            @endif
                            <div class="input-group">
                                <span class="input-group-addon">Amount USD</span>
                                <input type="text" class="form-control" id="amount"   name="amount">
                            </div><br/>
                            @if ($errors->has('amount'))
                                <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('amount') }}</strong>
                        </span>
                            @endif
                            <div class="input-group">
                                <button class="btn btn-success btn-quirk btn-block">Fund Account</button>
                            </div>
                        </form>

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

