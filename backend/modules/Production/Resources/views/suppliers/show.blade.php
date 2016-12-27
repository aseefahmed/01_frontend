@extends('layouts/dashboard/main')
@section('page_title', 'Suppliers')

@section('content')
    <div class="row col-sm-12">
        <h3 class="heading">{{ Route::currentRouteName() }}</h3>
    </div>
    <div class="row" ng-controller="SupplierController" ng-init="init({{$supplier_id}})" ng-cloak>
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
                                    <li><a href="/production/suppliers" target="_top"><span class="glyphicon glyphicon-arrow-left"></span> Cancel</a></li>
                                    <li><a ng-if="supplier[0].user_id == {{ Auth::user()->id }}" class="th-pointer" ng-click="remove_supplier({{ $supplier_id  }}, supplier[0].supplier_name, 'single_delete')"><span class="glyphicon glyphicon-trash"></span> Delete</a></li>
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
                                            <th width='25%'>Supplier Name: </th>
                                            <td><span class="col-sm-10">## supplier[0].supplier_name ##</span><a ng-click="edit_supplier({{ $supplier_id  }}, 'Supplier', 'supplier_name', 'text', true, '', 50, '', 'This is a mendatory field (Maximum: 50 Characters).')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                            <td rowspan="2" width="25%"><img src="{{ asset('img/uploads/production/suppliers') }}/## supplier[0].image ##" width="100%" height="100%"></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Postal Address: </th>
                                            <td><span class="col-sm-10 wordwrap">## supplier[0].postal_address| uppercase ## </span><a ng-click="edit_supplier({{ $supplier_id  }}, 'Postal Address', 'postal_address', 'text', false, '', 70, '', 'This field not be more than 70 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Supplier Type: </th>
                                            <td colspan="2"><span class="col-sm-10">## supplier[0].supplier_type.supplier_type | uppercase ## </span><a ng-click="edit_supplier({{ $supplier_id  }}, 'Supplier Type', 'supplier_type_id', 'text', false, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Contact Person: </th>
                                            <td colspan="2"><span class="col-sm-10">## supplier[0].contact_person | uppercase ## </span><a ng-click="edit_supplier({{ $supplier_id  }}, 'Contact Person', 'contact_person', 'text', false, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Email Address: </th>
                                            <td colspan="2"><span class="col-sm-10"><a href="mailto:## supplier[0].email_address ##">## supplier[0].email_address| uppercase ## </a></span><a ng-click="edit_supplier({{ $supplier_id  }}, 'Email Address', 'email_address', 'text', false, '', '', '', 'Email address must be valid.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Contact Number: </th>
                                            <td colspan="2"><span class="col-sm-10">## supplier[0].contact_number | uppercase ## </span><a ng-click="edit_supplier({{ $supplier_id  }}, 'Contact Number', 'contact_number', 'text', false, '', 20, '', 'This field not be more than 20 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Website: </th>
                                            <td colspan="2"><span class="col-sm-10"><a href="//## supplier[0].website ##" target="_blank">## supplier[0].website| uppercase ## </a></span><a ng-click="edit_supplier({{ $supplier_id  }}, 'Website', 'website')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Created By: </th>
                                            <td colspan="2"><span class="col-sm-10">## supplier[0].user.first_name | uppercase ## ## supplier[0].user.last_name | uppercase ## </span></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Created At: </th>
                                            <td colspan="2"><span class="col-sm-10">## supplier[0].created_at | filterDate ## </span></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Updated At: </th>
                                            <td colspan="2"><span class="col-sm-10">## supplier[0].updated_at | filterDate ## </span></td>
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

            <div class="modal fade" id="remove-supplier-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Remove Supplier</h3>
                        </div>
                        <div class="modal-body">
                            ## modal_msg ##
                            <div class="modal-footer">
                                <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a>
                                <button type="submit" name="commit" class="btn btn-success" ng-click="remove_supplier_confirmed(supplier_id, 'show_page', status)" supplier_id=""><span class="glyphicon glyphicon-ok-sign"></span> Yes </button>
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
                            <h3 class="modal-title">Remove Supplier</h3>
                        </div>
                        <div class="modal-body">
                            Please Select at least one supplier.
                            <div class="modal-footer">
                                <a class="btn btn-success" data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span> OK</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="edit-supplier-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Edit Supplier</h3>
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
                                    <button type="submit" name="commit" class="btn btn-success" ng-disabled="myForm.$invalid" ng-click="edit_supplier_confirmed({{ $supplier_id }})"><span class="glyphicon glyphicon-ok-sign"></span> Edit  </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection