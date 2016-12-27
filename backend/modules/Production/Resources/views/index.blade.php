@extends('layouts/dashboard/main')
@section('page_title', 'Buyers')

@section('content')
    <div class="row col-sm-12">
        <h3 class="heading">@yield('page_title')</h3>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="row">
                <div class="col-sm-4">
                    <button class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add Buyer</button>
                </div>
            </div>
            <div id="buyers_list"></div>
        </div>
    </div>
@endsection