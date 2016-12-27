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
                <th class="table_checkSqlite (Xerial) - hrm.dbbox"><input name="select_rows" class="select_rows" data-tableid="dt_gal" type="checkbox"/></th>
                <th>Image</th>
                <th class="th-pointer" ng-click="sort('buyer_name')">Buyer Name <span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='buyer_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                <th class="th-pointer" ng-click="sort('created_at')">Created At <span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='created_at'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                <th class="th-pointer" ng-click="sort('updated_at')">Updated At <span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='updated_at'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-if="buyers.length == 0">
                <td colspan="6">No data found.</td>
            </tr>
            <tr dir-paginate="buyer in filtered = (buyers| orderBy : sortKey : reverse | filter : search_filter  | itemsPerPage : num_of_items) " ng-cloak>
                <td><input name="row_sel" class="select_row" type="checkbox"/></td>
                <td ng-cloak><img src="{{ asset('img/uploads/production/buyers') }}/<% buyer.image %>" width="80px"/></td>
                <td ng-cloak><% buyer.buyer_name %></td>
                <td ng-cloak><% buyer.created_at | filterDate %></td>
                <td ng-cloak><% buyer.updated_at | filterDate %></td>
                <td  ng-cloak align="center">
                    <a class="btn btn-primary" href="{{ url('production/buyer/show') }}/<% buyer.id %>"><i class="glyphicon glyphicon-eye-open" class="view_buyer_btn"></i></a>&nbsp;
                    <a class="btn btn-warning" href="{{ url('production/buyer/edit') }}/<% buyer.id %>""><i class="glyphicon glyphicon-edit" id="edit_buyer_btn"></i></a>&nbsp;
                    <a class="btn btn-danger remove-buyer-modal" buyer_name="<% buyer.name %>" buyer_id="<% buyer.id %>"><i class="glyphicon glyphicon-trash" id="remove_buyer_btn"></i></a>
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