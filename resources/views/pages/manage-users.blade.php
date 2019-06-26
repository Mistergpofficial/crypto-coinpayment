@extends('layouts.dash')
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
    <div id="index">
       <Headers></Headers>
        <section>
            <Left></Left>

            <div class="mainpanel">

                <div class="contentpanel">

                    <ol class="breadcrumb breadcrumb-quirk">
                        <li><a href="{!! route('user.dashboard') !!}"><i class="fa fa-home mr5"></i> Home</a></li>
                        <li><a href="">Users</a></li>
                    </ol>

                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">USER MANAGEMENT</h4>
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                @if($users->count() > 0)
                                <table class="table nomargin">
                                    <thead>
                                    <tr>
                                        <th class="text-center">
                                            <label class="ckbox ckbox-primary">
                                                <input type="checkbox"><span></span>
                                            </label>
                                        </th>
                                        <th class="text-yellow">FULL NAME</th>
                                        <th class="text-yellow">EMAIL</th>
                                        <th class="text-yellow">USERNAME</th>
                                        <th class="text-yellow">BTC WALLET</th>
                                        <th class="text-yellow">REFERER</th>
                                        <th class="text-yellow">COUNTRY</th>
                                        <th class="text-yellow">STATE</th>
                                        <th class="text-yellow">JOINED DATE</th>
                                        <th class="text-yellow">STATUS</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="text-center">
                                                <label class="ckbox ckbox-primary">
                                                    <input type="checkbox"><span></span>
                                                </label>
                                            </td>
                                            <td>{{ $user->full_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->bitcoin }}</td>
                                            <td>{{ $user->upline }}</td>
                                            <td>{{ $user->country }}</td>
                                            <td>{{ $user->state }}</td>
                                            <td>{{ $user->created_at->toDayDateTimeString() }}</td>
                                            <td><a
                                                        href="{{ url('/purge-user') .'/'.$user->id }}"> <span class="label label-warning">Remove User</span></a></td>
                                            @endforeach
                                        </tr>

                                    </tbody>
                                </table>
                                @else
                                    <div class="alert alert-info">You have no registered user </div>
                                @endif

                                <div class="col-md-12 text-center">
                                    {{ $users->links() }}
                                </div>
                            </div><!-- table-responsive -->
                        </div>
                    </div><!-- panel -->



                </div><!-- contentpanel -->
            </div><!-- mainpanel -->

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

