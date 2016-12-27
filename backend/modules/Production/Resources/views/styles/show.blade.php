@extends('layouts/dashboard/main')
@section('page_title', 'Styles')

@section('content')
    <div class="row col-sm-12">
        <h3 class="heading">@yield('page_title')</h3>
    </div>
    <div class="row" ng-controller="StyleController" ng-init="init({{$style_id}})" ng-cloak>
        <div class="col-sm-12 col-md-12">
            <div class="col-sm-8">
                <div class="w-box" id="w_sort01">
                    <div class="w-box-header">
                        <div class="pull-left">
                            <div class="btn-group">
                                <a class="btn dropdown-toggle btn-primary btn-xs" data-toggle="dropdown" href="#">
                                    <i class="glyphicon glyphicon-cog"></i> Action <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="/production/styles" target="_top"><span class="glyphicon glyphicon-arrow-left"></span> Cancel</a></li>
                                    <li><a ng-if="style[0].user_id == {{ Auth::user()->id }}" class="th-pointer" ng-click="remove_style({{ $style_id  }}, style[0].style_name, 'single_delete')"><span class="glyphicon glyphicon-trash"></span> Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="w-box-content cnt_a">
                        <div id="main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-responsive table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width='25%'>Style Name: </th>
                                            <td><span class="col-sm-10">## style[0].style_name ##</span><a ng-click="edit_style({{ $style_id  }}, 'Style', 'style_name', 'text', true, '', 50, '', 'This is a mendatory field (Maximum: 50 Characters).')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                            <td rowspan="2" width="25%"><img src="{{ asset('img/uploads/production/styles') }}/## style[0].image ##" width="100%" height="100%"></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Created By: </th>
                                            <td colspan="2"><span class="col-sm-10">## style[0].user.first_name | uppercase ## ## style[0].user.last_name | uppercase ## </span></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Created At: </th>
                                            <td colspan="2"><span class="col-sm-10">## style[0].created_at | filterDate ## </span></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Updated At: </th>
                                            <td colspan="2"><span class="col-sm-10">## style[0].updated_at | filterDate ## </span></td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                @include('production::partials.orders_stats')
            </div>

            <div class="modal fade" id="remove-style-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Remove Style</h3>
                        </div>
                        <div class="modal-body">
                            ## modal_msg ##
                            <div class="modal-footer">
                                <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a>
                                <button type="submit" name="commit" class="btn btn-success" ng-click="remove_style_confirmed(style_id, 'show_page', status)" style_id=""><span class="glyphicon glyphicon-ok-sign"></span> Yes </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="removal-warning-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Remove Style</h3>
                        </div>
                        <div class="modal-body">
                            Please Select at least one style.
                            <div class="modal-footer">
                                <a class="btn btn-success" data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span> OK</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="edit-style-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Edit Style</h3>
                        </div>
                        <div class="modal-body">
                            <form name="myForm" method="post" enctype="multipart/form-data" novalidate>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <code> ## editable_item ## </code> <span style="color:red">*</span>
                                            <div class="row">
                                                &nbsp;&nbsp;
                                            </div>
                                            <input class="form-control" placeholder="## editable_item ##" name="this_field" type="## field_type ##" ng-required="## is_required ##" ng-minlength="## min_length ##" ng-maxlength="## max_length ##" ng-pattern="## pattern ##" ng-model="type"/>
                                            <span class="help-block " ng-show="myForm.this_field.$dirty && myForm.this_field.$invalid">## error_text ##</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a>
                                    <button type="submit" name="commit" class="btn btn-success" ng-disabled="myForm.$invalid" ng-click="edit_style_confirmed({{ $style_id }})"><span class="glyphicon glyphicon-ok-sign"></span> Edit  </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection