@extends('layouts/dashboard/main')
@section('page_title', 'Sent Requisitions')

@section('content')
    <div class="row col-sm-12">
        <h3 class="heading">@yield('page_title')</h3>
    </div>
    <div class="row" ng-controller="AllRequisitionController" ng-init="initialize('sent')" ng-cloak>
        <div class="col-sm-12 col-md-12">
            <div class="col-sm-9">
                <div class="w-box" id="w_sort01">
                    <div class="w-box-header">
                        <div class="pull-left">
                            <div class="btn-group">
                                <a class="btn dropdown-toggle btn-primary btn-xs" data-toggle="dropdown" href="#">
                                    <i class="glyphicon glyphicon-cog"></i> Action <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" ng-click="remove_requisition(0, 'index_page', 'selected')"><span class="glyphicon glyphicon-trash"></span> Delete Seleted</a></li>
                                    <li><a href="#" ng-click="remove_requisition(0, 'index_page', 'all')"><span class="glyphicon glyphicon-repeat"></span> Delete All</a></li>
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
                                    <select  class="inline-search" style="width: 25%;" ng-model="num_of_items" name="num_of_items" ng-options="num.id as num.value for num in num_of_items_arr ">
                                        <option value="">Show</option>
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
                                            <th class="th-pointer" ng-click="sort('name')">Title<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('requested_amount')">Requested Amount <span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='requested_amount'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('first_name')">Requested By <span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='first_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('created_at')">Requested At<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='created_at'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('flag')">Status <span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='flag'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-if="requisitions.length == 0 || filtered.length == 0">
                                            <td colspan="7">No data found.</td>
                                        </tr>
                                            <tr dir-paginate="requisition in filtered = (requisitions| orderBy : sortKey : reverse | filter : search_filter  | itemsPerPage : num_of_items) " ng-cloak>
                                                <td><input class="select_row" type="checkbox"  value="## requisition.id ##"/></td>
                                                <td ng-cloak>## requisition.name ##</td>
                                                <td ng-cloak>## requisition.requested_amount | currency ##</td>
                                                <td ng-cloak>## requisition.first_name ## ## requisition.last_name ##</td>
                                                <td ng-cloak>## requisition.created_at | filterDate ##</td>
                                                <td ng-if="requisition.flag == 1" ng-cloak class="bg bg-warning">Pending</td>
                                                <td ng-if="requisition.flag == 2" ng-cloak class="bg bg-success">Approved</td>
                                                <td ng-if="requisition.flag == 9" ng-cloak class="bg bg-danger">Rejected</td>
                                                <td  ng-cloak align="center">
                                                    <a class="btn btn-primary" href="{{ url('production/requisitions/id') }}/## requisition.id ##"><i class="glyphicon glyphicon-eye-open" class="view_requisition_btn"></i></a>&nbsp;
                                                    <a ng-if="requisition.created_by == {{ Auth::user()->id }}" class="btn btn-danger" ng-click="remove_requisition(requisition.id, requisition.requisition_name, 'single_delete')" requisition_name="## requisition.name ##" requisition_id="## requisition.id ##"><i class="glyphicon glyphicon-trash"></i></a>
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
            <div class="col-sm-3">
                @include('production::partials.orders_stats')
            </div>

            <div class="modal fade" id="add-requisition-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Add requisition</h3>
                        </div>
                        <div class="modal-body">
                            <form method="post" enctype="multipart/form-data" name="myForm" novalidate>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <code>requisition</code><span style="color:red">*</span>
                                            <div class="row">
                                                &nbsp;&nbsp;
                                            </div>
                                            <input class="form-control" placeholder="requisition" name="requisition_name" type="text" ng-model="requisition_name" ng-required="true" ng-maxlength="50">
                                            <span class="help-block " ng-show="myForm.requisition_name.$dirty && myForm.requisition_name.$invalid">This is a mendatory field (Maximum: 50 Characters).</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <code>Postal Address</code>
                                            <div class="row">
                                                &nbsp;&nbsp;
                                            </div>
                                            <input class="form-control" placeholder="Postal Address" name="postal_address" type="text" ng-model="postal_address" ng-maxlength="70"/>
                                            <span class="help-block " ng-show="myForm.postal_address.$dirty && myForm.postal_address.$invalid">This field not be more than 70 characters long.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <code>Contact Person</code>
                                            <div class="row">
                                                &nbsp;&nbsp;
                                            </div>
                                            <input class="form-control" placeholder="Contact Person" type="text" name="contact_person" ng-model="contact_person" ng-maxlength="55"/>
                                            <span class="help-block " ng-show="myForm.contact_person.$dirty && myForm.contact_person.$invalid">It must not be more than 55 characters long.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <code>Email Address</code>
                                            <div class="row">
                                                &nbsp;&nbsp;
                                            </div>
                                            <input class="form-control" placeholder="Email Address" name="email" type="text" ng-model="email_address" ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/"/>
                                            <span class="help-block " ng-show="myForm.email.$dirty && myForm.email.$invalid">Email address must be valid.</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <code>Contact Number</code>
                                            <div class="row">
                                                &nbsp;&nbsp;
                                            </div>
                                            <input class="form-control" placeholder="Contact Number" type="text" name="contact_number" ng-model="contact_number" ng-maxlength="20"/>
                                            <span class="help-block " ng-show="myForm.contact_number.$dirty && myForm.contact_number.$invalid">It must not be more than 20 characters long.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <code>Website</code>
                                            <div class="row">
                                                &nbsp;&nbsp;
                                            </div>
                                            <input class="form-control" placeholder="Website" type="text" ng-model="website"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <code>Image</code>
                                            <input ng-model="file" type="file" class="file file-upload" data-preview-file-type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a>
                                    <button type="submit" ng-disabled="myForm.$invalid" name="commit" class="btn btn-success" ng-click="add_requisition()"><span class="glyphicon glyphicon-ok-sign"></span> Add requisition </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="remove-requisition-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Remove requisition</h3>
                        </div>
                        <div class="modal-body">
                            ## modal_msg ##
                            <div class="modal-footer">
                                <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a>
                                <button type="submit" name="commit" class="btn btn-success" ng-click="remove_requisition_confirmed(requisition_id, 'index_page', status)" requisition_id=""><span class="glyphicon glyphicon-ok-sign"></span> Yes </button>
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
                            <h3 class="modal-title">Remove requisition</h3>
                        </div>
                        <div class="modal-body">
                            Please Select at least one requisition.
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