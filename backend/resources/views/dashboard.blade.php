@extends('layouts/dashboard/main')
@section('page_title', 'Dashboard')

@section('content')
    <div id="jCrumbs" class="breadCrumb module">
        <ul>
            <li>
                <a href="#"><i class="glyphicon glyphicon-home"></i></a>
            </li>
            <li>
                <a href="#">Sports & Toys</a>
            </li>
            <li>
                <a href="#">Toys & Hobbies</a>
            </li>
            <li>
                <a href="#">Learning & Educational</a>
            </li>
            <li>
                <a href="#">Astronomy & Telescopes</a>
            </li>
            <li>
                Telescope 3735SX
            </li>
        </ul>
    </div>	<div class="row">
        <div class="col-sm-12 tac">
            <ul class="ov_boxes">
                <li>
                    <div class="p_bar_up p_canvas"><span>2,4,9,7,12,8,16</span></div>
                    <div class="ov_text">
                        <strong>$3 458,00</strong>
                        Weekly Sale
                    </div>
                </li>
                <li>
                    <div class="p_bar_down p_canvas"><span>20,15,18,14,10,13,9,7</span></div>
                    <div class="ov_text">
                        <strong>$43 567,43</strong>
                        Monthly Sale
                    </div>
                </li>
                <li>
                    <div class="p_line_up p_canvas"><span>3,5,9,7,12,8,16</span></div>
                    <div class="ov_text">
                        <strong>2304</strong>
                        Unique visitors (last 24h)
                    </div>
                </li>
                <li>
                    <div class="p_line_down p_canvas"><span>20,16,14,18,15,14,14,13,12,10,10,8</span></div>
                    <div class="ov_text">
                        <strong>30240</strong>
                        Unique visitors (last week)
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <ul class="dshb_icoNav clearfix">
                <li><a href="javascript:void(0)" style="background-image: url(img/gCons/multi-agents.png)"><span class="label label-info">+10</span> Users</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(img/gCons/world.png)">Map</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(img/gCons/configuration.png)">Settings</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(img/gCons/lab.png)">Lab</a>
                </li><li><a href="javascript:void(0)" style="background-image: url(img/gCons/van.png)"><span class="label label-success">$2851</span> Delivery</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(img/gCons/pie-chart.png)">Charts</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(img/gCons/edit.png)">Add New Article</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(img/gCons/add-item.png)"> Add New Page</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(img/gCons/chat-.png)"><span class="label label-danger">26</span> Comments</a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-5">
            <h3 class="heading">Visitors by Country <small>last week</small></h3>
            <div id="fl_2" style="height:200px;width:80%;margin:50px auto 0"></div>
        </div>
        <div class="col-sm-7">
            <div class="heading clearfix">
                <h3 class="pull-left">Another Chart</h3>
                <span class="pull-right label label-info bs_ttip" data-placement="left" data-container="body" title="Here is a sample info tooltip">Info</span>
            </div>
            <div id="fl_1" style="height:270px;width:100%;margin:15px auto 0"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-lg-6">
            <div class="heading clearfix">
                <h3 class="pull-left">Latest Orders</h3>
                <span class="pull-right label label-danger">5 Orders</span>
            </div>
            <table class="table table-striped table-bordered mediaTable">
                <thead>
                <tr>
                    <th class="optional">id</th>
                    <th class="essential persist">Customer</th>
                    <th class="optional">Status</th>
                    <th class="optional">Date Added</th>
                    <th class="essential">Total</th>
                    <th class="essential">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>134</td>
                    <td>Summer Throssell</td>
                    <td>Pending</td>
                    <td>24/04/2015</td>
                    <td>$120.23</td>
                    <td>
                        <a href="#" title="Edit"><i class="splashy-document_letter_edit"></i></a>
                        <a href="#" title="Accept"><i class="splashy-document_letter_okay"></i></a>
                        <a href="#" title="Remove"><i class="splashy-document_letter_remove"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>133</td>
                    <td>Declan Pamphlett</td>
                    <td>Pending</td>
                    <td>23/04/2015</td>
                    <td>$320.00</td>
                    <td>
                        <a href="#" title="Edit"><i class="splashy-document_letter_edit"></i></a>
                        <a href="#" title="Accept"><i class="splashy-document_letter_okay"></i></a>
                        <a href="#" title="Remove"><i class="splashy-document_letter_remove"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>132</td>
                    <td>Erin Church</td>
                    <td>Pending</td>
                    <td>23/04/2015</td>
                    <td>$44.00</td>
                    <td>
                        <a href="#" title="Edit"><i class="splashy-document_letter_edit"></i></a>
                        <a href="#" title="Accept"><i class="splashy-document_letter_okay"></i></a>
                        <a href="#" title="Remove"><i class="splashy-document_letter_remove"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>131</td>
                    <td>Koby Auld</td>
                    <td>Pending</td>
                    <td>22/04/2015</td>
                    <td>$180.20</td>
                    <td>
                        <a href="#" title="Edit"><i class="splashy-document_letter_edit"></i></a>
                        <a href="#" title="Accept"><i class="splashy-document_letter_okay"></i></a>
                        <a href="#" title="Remove"><i class="splashy-document_letter_remove"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>130</td>
                    <td>Anthony Pound</td>
                    <td>Pending</td>
                    <td>20/04/2015</td>
                    <td>$610.42</td>
                    <td>
                        <a href="#" title="Edit"><i class="splashy-document_letter_edit"></i></a>
                        <a href="#" title="Accept"><i class="splashy-document_letter_okay"></i></a>
                        <a href="#" title="Remove"><i class="splashy-document_letter_remove"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6 col-lg-6">
            <div class="heading clearfix">
                <h3 class="pull-left">Latest Images <small>(gallery grid)</small></h3>
                <span class="pull-right label label-success">12</span>
            </div>
            <div id="small_grid" class="wmk_grid">
                <ul>
                    <li class="thumbnail">
                        <a href="gallery/Image04.jpg" title="Image_4 Lorem ipsum dolor sit amet...">
                            <img src="gallery/Image04_tn.jpg" alt="">
                        </a>
                        <p>
                            <span>312KB<br>23/06/2015</span>
                        </p>
                    </li>
                    <li class="thumbnail">
                        <a href="gallery/Image05.jpg" title="Image_5 Lorem ipsum dolor sit amet...">
                            <img src="gallery/Image05_tn.jpg" alt="">
                        </a>
                        <p>
                            <span>393KB<br>17/06/2015</span>
                        </p>
                    </li>
                    <li class="thumbnail">
                        <a href="gallery/Image06.jpg" title="Image_6 Lorem ipsum dolor sit amet...">
                            <img src="gallery/Image06_tn.jpg" alt="">
                        </a>
                        <p>
                            <span>278KB<br>11/06/2015</span>
                        </p>
                    </li>
                    <li class="thumbnail">
                        <a href="gallery/Image07.jpg" title="Image_7 Lorem ipsum dolor sit amet...">
                            <img src="gallery/Image07_tn.jpg" alt="">
                        </a>
                        <p>
                            <span>399KB<br>15/05/2015</span>
                        </p>
                    </li>
                    <li class="thumbnail">
                        <a href="gallery/Image08.jpg" title="Image_8 Lorem ipsum dolor sit amet...">
                            <img src="gallery/Image08_tn.jpg" alt="">
                        </a>
                        <p>
                            <span>126KB<br>22/06/2015</span>
                        </p>
                    </li>
                    <li class="thumbnail">
                        <a href="gallery/Image09.jpg" title="Image_9 Lorem ipsum dolor sit amet...">
                            <img src="gallery/Image09_tn.jpg" alt="">
                        </a>
                        <p>
                            <span>311KB<br>13/05/2015</span>
                        </p>
                    </li>
                    <li class="thumbnail">
                        <a href="gallery/Image10.jpg" title="Image_10 Lorem ipsum dolor sit amet...">
                            <img src="gallery/Image10_tn.jpg" alt="">
                        </a>
                        <p>
                            <span>343KB<br>11/05/2015</span>
                        </p>
                    </li>
                    <li class="thumbnail">
                        <a href="gallery/Image11.jpg" title="Image_11 Lorem ipsum dolor sit amet...">
                            <img src="gallery/Image11_tn.jpg" alt="">
                        </a>
                        <p>
                            <span>240KB<br>27/06/2015</span>
                        </p>
                    </li>
                    <li class="thumbnail">
                        <a href="gallery/Image12.jpg" title="Image_12 Lorem ipsum dolor sit amet...">
                            <img src="gallery/Image12_tn.jpg" alt="">
                        </a>
                        <p>
                            <span>374KB<br>28/05/2015</span>
                        </p>
                    </li>
                    <li class="thumbnail">
                        <a href="gallery/Image13.jpg" title="Image_13 Lorem ipsum dolor sit amet...">
                            <img src="gallery/Image13_tn.jpg" alt="">
                        </a>
                        <p>
                            <span>110KB<br>24/06/2015</span>
                        </p>
                    </li>
                    <li class="thumbnail">
                        <a href="gallery/Image14.jpg" title="Image_14 Lorem ipsum dolor sit amet...">
                            <img src="gallery/Image14_tn.jpg" alt="">
                        </a>
                        <p>
                            <span>153KB<br>18/06/2015</span>
                        </p>
                    </li>
                    <li class="thumbnail">
                        <a href="gallery/Image15.jpg" title="Image_15 Lorem ipsum dolor sit amet...">
                            <img src="gallery/Image15_tn.jpg" alt="">
                        </a>
                        <p>
                            <span>106KB<br>18/05/2015</span>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8 col-lg-8">
            <h3 class="heading">Calendar</h3>
            <div id="calendar"></div>
        </div>
        <div class="col-sm-4 col-lg-4" id="user-list">
            <h3 class="heading">Users <small>last 24 hours</small></h3>
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group input-group-sm sepH_b">
						<span class="input-group-addon">
							<i class="glyphicon glyphicon-user"></i>
						</span>
                        <input class="user-list-search search form-control input-sm" placeholder="Search user" type="text">
                    </div>
                    <ul class="nav nav-pills line_sep">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sort by <b class="caret"></b></a>
                            <ul class="dropdown-menu sort-by">
                                <li><a href="javascript:void(0)" class="sort" data-sort="sl_name">by name</a></li>
                                <li><a href="javascript:void(0)" class="sort" data-sort="sl_status">by status</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Show <b class="caret"></b></a>
                            <ul class="dropdown-menu filter">
                                <li class="active"><a href="javascript:void(0)" id="filter-none">All</a></li>
                                <li><a href="javascript:void(0)" id="filter-online">Online</a></li>
                                <li><a href="javascript:void(0)" id="filter-offline">Offline</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="list user_list">

                <li>
                    <span class="label label-success pull-right sl_status">online</span>
                    <a href="#" class="sl_name">John Doe</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="d0babfb8beb490b5a8b1bda0bcb5e1feb3bfbd">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
                <li>
                    <span class="label label-success pull-right sl_status">online</span>
                    <a href="#" class="sl_name">Kate Miller</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="94fff9fdf8f8f1e6d4f1ecf5f9e4f8f1a5baf7fbf9">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
                <li>
                    <span class="label label-danger pull-right sl_status">offline</span>
                    <a href="#" class="sl_name">James Vandenberg</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="4f252e222a3c390f2a372e223f232a7d612c2022">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
                <li>
                    <span class="label label-danger pull-right sl_status">offline</span>
                    <a href="#" class="sl_name">Donna Doerr</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="0c686362626d684c69746d617c60693f226f6361">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
                <li>
                    <span class="label label-danger pull-right sl_status">offline</span>
                    <a href="#" class="sl_name">Perry Weitzel</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="9feffaedede6e8dffae7fef2eff3faadb1fcf0f2">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
                <li>
                    <span class="label label-success pull-right sl_status">online</span>
                    <a href="#" class="sl_name">Charles Bledsoe</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="395a51584b555c4a5b795c41585449555c0a175a5654">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
                <li>
                    <span class="label label-danger pull-right sl_status">offline</span>
                    <a href="#" class="sl_name">Wendy Proto</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="1e69707b7a676e5e7b667f736e727b2f307d7173">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
                <li>
                    <span class="label label-success pull-right sl_status">online</span>
                    <a href="#" class="sl_name">Nancy Ibrahim</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="7a141b141903133a1f021b170a161f4854191517">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
                <li>
                    <span class="label label-danger pull-right sl_status">offline</span>
                    <a href="#" class="sl_name">Eric Cantrell</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="2540574c464665405d4448554940110b464a48">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
                <li>
                    <span class="label label-success pull-right sl_status">online</span>
                    <a href="#" class="sl_name">Andre Hill</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="bbdad5dfc9ded3fbdec3dad6cbd7de8995d8d4d6">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
                <li>
                    <span class="label label-success pull-right sl_status">online</span>
                    <a href="#" class="sl_name">Laura Taggart</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="4925283c3b283d092c31282439252c7a672a2624">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
                <li>
                    <span class="label label-danger pull-right sl_status">offline</span>
                    <a href="#" class="sl_name">Doug Singer</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="98fcf7edffebd8fde0f9f5e8f4fdaab6fbf7f5">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
                <li>
                    <span class="label label-success pull-right sl_status">online</span>
                    <a href="#" class="sl_name">Douglas Arnott</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="26424953414a47554766435e474b564a43170845494b">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
                <li>
                    <span class="label label-danger pull-right sl_status">offline</span>
                    <a href="#" class="sl_name">Lauren Henley</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="5935382c2b3c3731193c21383429353c6a773a3634">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
                <li>
                    <span class="label label-danger pull-right sl_status">offline</span>
                    <a href="#" class="sl_name">William Jardine</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="790e10151510181413391c01181409151c4d571a1614">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
                <li>
                    <span class="label label-success pull-right sl_status">online</span>
                    <a href="#" class="sl_name">Yves Ouellet</a><br>
                    <small class="s_color sl_email"><a class="__cf_email__" href="cdn-cgi/l/email-protection.html" data-cfemail="542d2231273b14312c3539243831667a373b39">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></small>
                </li>
            </ul>
            <ul class="pagination paging bottomPaging"></ul>
        </div>
    </div>
@endsection