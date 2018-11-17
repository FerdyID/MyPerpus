@extends('layouts.layout')
@section('content')
    <div class="page-content fade-in-up">
        
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home font-18"></i> Dashboard</li>
        </ol>
        
        <div class="col-lg-12">
            @if (Session::has('message'))
                <div class="alert alert-{{ Session::get('message_type') }}"
                     style="margin-top:10px;">{{ Session::get('message') }}</div>
            @endif
        </div>
        
        {{--<div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$users->count()}}</h2>
                        <div class="m-b-5">Total User</div>
                        <i class="ti-user widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i>
                            <small>25% higher</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-info color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">1250</h2>
                        <div class="m-b-5">UNIQUE VIEWS</div>
                        <i class="ti-bar-chart widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i>
                            <small>17% higher</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">$1570</h2>
                        <div class="m-b-5">TOTAL INCOME</div>
                        <i class="fa fa-money widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i>
                            <small>22% higher</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">108</h2>
                        <div class="m-b-5">NEW USERS</div>
                        <i class="ti-user widget-stat-icon"></i>
                        <div><i class="fa fa-level-down m-r-5"></i>
                            <small>-12% Lower</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
    </div>
@endsection