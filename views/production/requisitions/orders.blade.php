@extends('layouts/dashboard/main')
@section('page_title', 'Orders Requisitions')

@section('content')
    <div class="row col-sm-12">
        <h3 class="heading">@yield('page_title')</h3>
    </div>
    <div class="row" ng-controller="OrderRequisitionsController" ng-cloak>
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
                                    <li><a data-toggle="modal" data-backdrop="static" href="#order-report-modal"><span class="glyphicon glyphicon-plus-sign"></span> Generate</a></li>
                                    <li><a href="#" ng-click="remove_style(0, 'index_page', 'selected')"><span class="glyphicon glyphicon-trash"></span> Delete Seleted</a></li>
                                    <li><a href="#" ng-click="remove_style(0, 'index_page', 'all')"><span class="glyphicon glyphicon-repeat"></span> Delete All</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="w-box-content cnt_a">
                        <div id="main-content">
                            <div class="row">
                                <div class="col-sm-4 text-left">
                                    <input type="text" class="form-control" placeholder="Search" ng-model="search_filter">
                                </div>
                                <div class="col-sm-8 text-right">
                                    Show : <select style="width: 25%;" ng-model="num_of_items" name="num_of_items" ng-options="num.id as num.value for num in num_of_items_arr ">
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-12 text-center">
                                        <dir-pagination-controls
                                                direction-links="true" auto-hide="false"
                                                boundary-links="true" >
                                        </dir-pagination-controls>
                                    </div>
                                    <table class="table table-responsive table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Image</th>
                                            <th class="th-pointer" ng-click="sort('style_name')">Style Name <span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='style_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('created_at')">Contact Person <span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='created_at'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('updated_at')">Email Address <span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='updated_at'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-if="styles.length == 0 || filtered.length == 0">
                                            <td colspan="6">No data found.</td>
                                        </tr>
                                        <tr dir-paginate="style in filtered = (styles| orderBy : sortKey : reverse | filter : search_filter  | itemsPerPage : num_of_items) " ng-cloak>
                                            <td><input class="select_row" type="checkbox"  value="## style.id ##"/></td>
                                            <td ng-cloak><img src="{{ asset('img/uploads/production/styles') }}/## style.image ##" width="80px"/></td>
                                            <td ng-cloak>## style.style_name ##</td>
                                            <td ng-cloak>## style.contact_person ##</td>
                                            <td ng-cloak>## style.email_address ##</td>
                                            <td  ng-cloak align="center">
                                                <a class="btn btn-primary" href="{{ url('production/styles/') }}/## style.id ##"><i class="glyphicon glyphicon-eye-open" class="view_style_btn"></i></a>&nbsp;
                                                <a ng-if="style.user_id == {{ Auth::user()->id }}" class="btn btn-danger" ng-click="remove_style(style.id, style.style_name, 'single_delete')" style_name="## style.name ##" style_id="## style.id ##"><i class="glyphicon glyphicon-trash"></i></a>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <div class="col-sm-12 text-center">
                                        <dir-pagination-controls
                                                direction-links="true" auto-hide="false"
                                                boundary-links="true" >
                                        </dir-pagination-controls>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                @include('production::partials.orders_stats')
            </div>

            <div class="modal fade" id="order-report-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Generate Order Report</h3>
                        </div>
                        <div class="modal-body">
                            <form method="post" enctype="multipart/form-data" name="myForm" novalidate>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <code>Style</code><span style="color:red">*</span>
                                            <div class="row">
                                                &nbsp;&nbsp;
                                            </div>
                                            <input class="form-control" placeholder="Style" name="style_name" type="text" ng-model="style_name" ng-required="true" ng-maxlength="50">
                                            <span class="help-block " ng-show="myForm.style_name.$dirty && myForm.style_name.$invalid">This is a mendatory field (Maximum: 50 Characters).</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a>
                                    <button type="submit" ng-disabled="myForm.$invalid" name="commit" class="btn btn-success" ng-click="add_style()"><span class="glyphicon glyphicon-ok-sign"></span> Generate Report</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
                                <button type="submit" name="commit" class="btn btn-success" ng-click="remove_style_confirmed(style_id, 'index_page', status)" style_id=""><span class="glyphicon glyphicon-ok-sign"></span> Yes </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>,

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
        </div>
    </div>
@endsection