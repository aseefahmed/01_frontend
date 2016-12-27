<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="brand pull-left" href="/">Dashboard</a>
            <ul class="nav navbar-nav" id="mobile-nav">
                <li class="dropdown">
                    <a href="/production"><span class="glyphicon glyphicon-list-alt"></span> HRM</a>
                </li>
                <li class="dropdown">
                    <a href="/production"><span class="glyphicon glyphicon-th"></span> CRM</a>
                </li>
                <li class="dropdown">
                    <a href="/production"><span class="glyphicon glyphicon-wrench"></span> Production</a>
                </li>
                <li class="dropdown">
                    <a href="/production"><span class="glyphicon glyphicon-home"></span> Accounts</a>
                </li>
            </ul>
            <ul class="nav navbar-nav user_menu pull-right">
                <li class="hidden-phone hidden-tablet">
                    <div class="nb_boxes clearfix">
                        <a data-toggle="modal" data-backdrop="static" href="#myMail" data-placement="bottom" data-container="body" class="label bs_ttip" title="New messages" ng-controller="OrderController" ng-cloak>## no_of_requisition_items ## <i class="splashy-mail_light"></i></a>
                        <a data-toggle="modal" data-backdrop="static" href="#myMail" data-placement="bottom" data-container="body" class="label bs_ttip" title="New messages">25 <i class="splashy-mail_light"></i></a>
                        <a data-toggle="modal" data-backdrop="static" href="#myTasks" data-placement="bottom" data-container="body" class="label bs_ttip" title="New tasks">10 <i class="splashy-calendar_week"></i></a>
                    </div>
                </li>
                <li class="divider-vertical hidden-sm hidden-xs"></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav_condensed" data-toggle="dropdown"><i class="flag-gb"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="javascript:void(0)"><i class="flag-de"></i> Deutsch</a></li>
                        <li><a href="javascript:void(0)"><i class="flag-fr"></i> Français</a></li>
                        <li><a href="javascript:void(0)"><i class="flag-es"></i> Español</a></li>
                        <li><a href="javascript:void(0)"><i class="flag-ru"></i> Pусский</a></li>
                    </ul>
                </li>
                <li class="divider-vertical hidden-sm hidden-xs"></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="img/user_avatar.png" alt="" class="user_avatar">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="user_profile.html">My Profile</a></li>
                        <li><a href="javascrip:void(0)">Another action</a></li>
                        <li class="divider"></li>
                        <li><a href="/logout">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade" id="myMail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">New Messages</h3>
            </div>
            <div class="modal-body">
                <table class="table table-condensed table-striped" data-provides="rowlink">
                    <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Size</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Declan Pamphlett</td>
                        <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                        <td>23/05/2015</td>
                        <td>25KB</td>
                    </tr>
                    <tr>
                        <td>Erin Church</td>
                        <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                        <td>24/05/2015</td>
                        <td>15KB</td>
                    </tr>
                    <tr>
                        <td>Koby Auld</td>
                        <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                        <td>25/05/2015</td>
                        <td>28KB</td>
                    </tr>
                    <tr>
                        <td>Anthony Pound</td>
                        <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                        <td>25/05/2015</td>
                        <td>33KB</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default">Go to mailbox</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myTasks">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">New Tasks</h3>
            </div>
            <div class="modal-body">
                <table class="table table-condensed table-striped" data-provides="rowlink">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Summary</th>
                        <th>Updated</th>
                        <th>Priority</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>P-23</td>
                        <td><a href="javascript:void(0)">Admin should not break if URL…</a></td>
                        <td>23/05/2015</td>
                        <td><span class="label label-danger">High</span></td>
                        <td>Open</td>
                    </tr>
                    <tr>
                        <td>P-18</td>
                        <td><a href="javascript:void(0)">Displaying submenus in custom…</a></td>
                        <td>22/05/2015</td>
                        <td><span class="label label-warning">Medium</span></td>
                        <td>Reopen</td>
                    </tr>
                    <tr>
                        <td>P-25</td>
                        <td><a href="javascript:void(0)">Featured image on post types…</a></td>
                        <td>22/05/2015</td>
                        <td><span class="label label-success">Low</span></td>
                        <td>Updated</td>
                    </tr>
                    <tr>
                        <td>P-10</td>
                        <td><a href="javascript:void(0)">Multiple feed fixes and…</a></td>
                        <td>17/05/2015</td>
                        <td><span class="label label-warning">Medium</span></td>
                        <td>Open</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default">Go to task manager</button>
            </div>
        </div>
    </div>
</div>