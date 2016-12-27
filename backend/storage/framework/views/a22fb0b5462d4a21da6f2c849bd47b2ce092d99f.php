<div class="sidebar_inner_scroll">
    <div class="sidebar_inner">
        <form action="http://gebo-admin-3.tzdthemes.com/search_page.html" class="input-group input-group-sm" method="post">
            <input autocomplete="off" name="query" class="search_query form-control input-sm" size="16" placeholder="Search..." type="text">
            <span class="input-group-btn"><button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button></span>
        </form>
        <div id="side_accordion" class="panel-group">
            <?php if(strpos(url()->current(), 'production') > 0): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#collapseOrder" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                            <i class="glyphicon glyphicon-folder-close"></i> Orders
                        </a>
                    </div>
                    <?php if(
                            Route::currentRouteName() == "production.orders.index" ||
                            Route::currentRouteName() == "production.orders.show"
                        ): ?>
                        <?php /**/$order_collapse = 'in'/**/ ?>
                    <?php endif; ?>
                    <div class="accordion-body collapse <?php echo (isset($order_collapse) && $order_collapse == 'in')?$order_collapse:'' ?>" id="collapseOrder">
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="<?php echo e((Route::currentRouteName() == "production.orders.index" || Route::currentRouteName() == "production.orders.show")? "bg bg-success":""); ?>"><a href="/production/orders">View Orders</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#collapseSupplier" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                            <i class="glyphicon glyphicon-th"></i> Suppliers
                        </a>
                    </div>
                    <?php if(
                            Route::currentRouteName() == "production.suppliers.index" ||
                            Route::currentRouteName() == "production.suppliers.show" ||
                            Route::currentRouteName() == "production.supplier-types.index" ||
                            Route::currentRouteName() == "production.supplier-types.show"
                        ): ?>
                        <?php /**/$supplier_type_collapse = 'in'/**/ ?>
                    <?php endif; ?>
                    <div class="accordion-body collapse <?php echo (isset($supplier_type_collapse) && $supplier_type_collapse == 'in')?$supplier_type_collapse:'' ?>" id="collapseSupplier">
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="<?php echo e((Route::currentRouteName() == "production.suppliers.index" || Route::currentRouteName() == "production.suppliers.show")? "bg bg-success":""); ?>"><a href="/production/suppliers">View Suppliers</a></li>
                                <li class="<?php echo e((Route::currentRouteName() == "production.supplier-types.index" || Route::currentRouteName() == "production.supplier-types.show")? "bg bg-success":""); ?>"><a href="/production/supplier-types">Supplier Types</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#collapseBuyer" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                            <i class="glyphicon glyphicon-user"></i> Buyers
                        </a>
                    </div>
                    <?php if(
                            Route::currentRouteName() == "production.buyers.index" ||
                            Route::currentRouteName() == "production.buyers.show"
                        ): ?>
                        <?php /**/$buyers_collapse = 'in'/**/ ?>
                    <?php endif; ?>
                    <div class="accordion-body collapse <?php echo (isset($buyers_collapse) && $buyers_collapse == 'in')?$buyers_collapse:'' ?>" id="collapseBuyer">
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="<?php echo e((Route::currentRouteName() == "production.buyers.index" || Route::currentRouteName() == "production.buyers.show")? "bg bg-success":""); ?>"><a href="/production/buyers">View Buyers</a></li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#collapseFour" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                            <i class="glyphicon glyphicon-cog"></i> Brands
                        </a>
                    </div>
                    <div class="accordion-body collapse" id="collapseFour">
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="/production/brands">View Brands</a></li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#collapseStyle" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                            <i class="glyphicon glyphicon-leaf"></i> Styles
                        </a>
                    </div>
                    <?php if(
                            Route::currentRouteName() == "production.styles.index" ||
                            Route::currentRouteName() == "production.styles.show"
                        ): ?>
                        <?php /**/$styles_collapse = 'in'/**/ ?>
                    <?php endif; ?>
                    <div class="accordion-body collapse <?php echo (isset($styles_collapse) && $styles_collapse == 'in')?$styles_collapse:'' ?>" id="collapseStyle">
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="<?php echo e((Route::currentRouteName() == "production.styles.index" || Route::currentRouteName() == "production.styles.show")? "bg bg-success":""); ?>"><a href="/production/styles">View Styles</a></li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#collapseReport" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                            <i class="glyphicon glyphicon-book"></i> Reports
                        </a>
                    </div>
                    <?php if(
                            Route::currentRouteName() == "Generate Orders Report"
                        ): ?>
                        <?php /**/$report_collapse = 'in'/**/ ?>
                    <?php endif; ?>
                    <div class="accordion-body collapse <?php echo (isset($report_collapse) && $report_collapse == 'in')?$report_collapse:'' ?>" id="collapseReport">
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="<?php echo e((Route::currentRouteName() == "Generate Orders Report" )? "bg bg-success":""); ?>"><a href="/production/reports/orders">Orders</a></li>
                                <li class="<?php echo e((Route::currentRouteName() == "production.reports.index" || Route::currentRouteName() == "production.reports.show")? "bg bg-success":""); ?>"><a href="/production/reports">Saved Reports</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#collapseRequisitions" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                            <i class="glyphicon glyphicon-check"></i> Requisitions
                        </a>
                    </div>
                    <?php if(
                            Route::currentRouteName() == "Generate Requisitions" ||
                            Route::currentRouteName() == "Sent Requisitions" ||
                            Route::currentRouteName() == "Requisition Details"
                        ): ?>
                        <?php /**/$requisitions_collapse = 'in'/**/ ?>
                    <?php endif; ?>
                    <div class="accordion-body collapse <?php echo (isset($requisitions_collapse) && $requisitions_collapse == 'in')?$requisitions_collapse:'' ?>" id="collapseRequisitions">
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="<?php echo e((Route::currentRouteName() == "Generate Requisitions")? "bg bg-success":""); ?>"><a href="/production/requisitions/generate">Generate Requisition</a></li>
                                <li class="<?php echo e((strpos(url()->current(),'sent') > 0)? "bg bg-success":""); ?>"><a href="/production/requisitions/sent">Sent Requisition</a></li>
                                <li class="<?php echo e((strpos(url()->current(),'recieved') > 0)? "bg bg-success":""); ?>"><a href="/production/requisitions/recieved">Recieved Requisition</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>

        <div class="push"></div>
    </div>

    <div class="sidebar_info">
        <ul class="list-unstyled">
            <li>
                <span class="act act-warning">65</span>
                <strong>New comments</strong>
            </li>
            <li>
                <span class="act act-success">10</span>
                <strong>New articles</strong>
            </li>
            <li>
                <span class="act act-danger">85</span>
                <strong>New registrations</strong>
            </li>
        </ul>
    </div>
</div>