<?php
session_start();

if(!isset($_SESSION["user"])){

  header("location:../Logins/login1.php");
  exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title> Alfa Tech Inventory Mangement System </title>
  
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="..\..\files\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="..\..\files\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- themify-icons line icon -->
    <!-- <link rel="stylesheet" type="text/css" href="..\..\files\assets\icon\themify-icons\themify-icons.css"> -->
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="..\..\files\assets\icon\icofont\css\icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="..\..\files\assets\icon\feather\css\feather.css">  
    <!-- customized css -->
    <link rel="stylesheet" type="text/css" href="..\..\files\bower_components\customized\editabletable.css">
    <!-- C:\xampp\htdocs\shahee\Inventory1\files\bower_components\customized\editabletable.css -->

<!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="..\..\files\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="..\..\files\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="..\..\files\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="..\..\files\assets\pages\data-table\extensions\autofill\css\autoFill.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="..\..\files\assets\pages\data-table\extensions\autofill\css\select.dataTables.min.css">
  
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="..\..\files\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="..\..\files\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="..\..\files\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="..\..\files\assets\pages\data-table\extensions\buttons\css\buttons.dataTables.min.css">





    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="..\..\files\assets\icon\font-awesome\css\font-awesome.min.css">
    
   <!-- Select 2 css -->
   <link rel="stylesheet" href="..\..\files\bower_components\select2\css\select2.min.css">
    <!-- Multi Select css -->
    <link rel="stylesheet" type="text/css" href="..\..\files\bower_components\bootstrap-multiselect\css\bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="..\..\files\bower_components\multiselect\css\multi-select.css">
   
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="..\..\files\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="..\..\files\assets\css\jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="..\..\files\assets\scss\partials\menu\_pcmenu.htm">

        <!-- jquery file upload Frame work -->
        <link href="..\..\files\assets\pages\jquery.filer\css\jquery.filer.css" type="text/css" rel="stylesheet">
    <link href="..\..\files\assets\pages\jquery.filer\css\themes\jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet">
  

</head>

<body>
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
        </div>
    </div>
</div>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">

                <div class="navbar-logo">
                    <a class="mobile-menu" id="mobile-collapse" href="#!">
                        <i class="feather icon-menu"></i>
                    </a>
                    <a href="index-1.htm">
                        <img class="img-fluid" src="..\..\files\assets\images\logo.png" alt="Theme-Logo">
                    </a>
                    <a class="mobile-options">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                </div>

                <div class="navbar-container container-fluid">
                    <ul class="nav-left">
                        <li class="header-search">
                            <div class="main-search morphsearch-search">
                                <div class="input-group">
                                    <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#!" onclick="javascript:toggleFullScreen()">
                                <i class="feather icon-maximize full-screen"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="feather icon-bell"></i>
                                    <span class="badge bg-c-pink">5</span>
                                </div>
                                <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="..\..\files\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">John Doe</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="..\..\files\assets\images\avatar-3.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Joseph William</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="..\..\files\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Sara Soudein</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                    <i class="feather icon-message-square"></i>
                                    <span class="badge bg-c-green">3</span>
                                </div>
                            </div>
                        </li>
                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="..\..\files\assets\images\avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                                    <span>John Doe</span>
                                    <i class="feather icon-chevron-down"></i>
                                </div>
                                <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                        <a href="#!">
                                            <i class="feather icon-settings"></i> Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="user-profile.htm">
                                            <i class="feather icon-user"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="email-inbox.htm">
                                            <i class="feather icon-mail"></i> My Messages
                                        </a>
                                    </li>
                                    <li>
                                        <a href="auth-lock-screen.htm">
                                            <i class="feather icon-lock"></i> Lock Screen
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../Logins/logout.php">
                                            <i class="feather icon-log-out"></i> Logout
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sidebar chat start -->
        <div id="sidebar" class="users p-chat-user showChat">
            <div class="had-container">
                <div class="card card_main p-fixed users-main">
                    <div class="user-box">
                        <div class="chat-inner-header">
                            <div class="back_chatBox">
                                <div class="right-icon-control">
                                    <input type="text" class="form-control  search-text" placeholder="Search Friend" id="search-friends">
                                    <div class="form-icon">
                                        <i class="icofont icofont-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-friend-list">
                            <div class="media userlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius img-radius" src="..\..\files\assets\images\avatar-3.jpg" alt="Generic placeholder image ">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Josephin Doe</div>
                                </div>
                            </div>
                            <div class="media userlist-box" data-id="2" data-status="online" data-username="Lary Doe" data-toggle="tooltip" data-placement="left" title="Lary Doe">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="..\..\files\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Lary Doe</div>
                                </div>
                            </div>
                            <div class="media userlist-box" data-id="3" data-status="online" data-username="Alice" data-toggle="tooltip" data-placement="left" title="Alice">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="..\..\files\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Alice</div>
                                </div>
                            </div>
                            <div class="media userlist-box" data-id="4" data-status="online" data-username="Alia" data-toggle="tooltip" data-placement="left" title="Alia">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="..\..\files\assets\images\avatar-3.jpg" alt="Generic placeholder image">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Alia</div>
                                </div>
                            </div>
                            <div class="media userlist-box" data-id="5" data-status="online" data-username="Suzen" data-toggle="tooltip" data-placement="left" title="Suzen">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="..\..\files\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Suzen</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar inner chat start-->
        <div class="showChat_inner">
            <div class="media chat-inner-header">
                <a class="back_chatBox">
                    <i class="feather icon-chevron-left"></i> Josephin Doe
                </a>
            </div>
            <div class="media chat-messages">
                <a class="media-left photo-table" href="#!">
                    <img class="media-object img-radius img-radius m-t-5" src="..\..\files\assets\images\avatar-3.jpg" alt="Generic placeholder image">
                </a>
                <div class="media-body chat-menu-content">
                    <div class="">
                        <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                        <p class="chat-time">8:20 a.m.</p>
                    </div>
                </div>
            </div>
            <div class="media chat-messages">
                <div class="media-body chat-menu-reply">
                    <div class="">
                        <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                        <p class="chat-time">8:20 a.m.</p>
                    </div>
                </div>
                <div class="media-right photo-table">
                    <a href="#!">
                        <img class="media-object img-radius img-radius m-t-5" src="..\..\files\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                    </a>
                </div>
            </div>
            <div class="chat-reply-box p-b-20">
                <div class="right-icon-control">
                    <input type="text" class="form-control search-text" placeholder="Share Your Thoughts">
                    <div class="form-icon">
                        <i class="feather icon-navigation"></i>
                    </div>
                </div>
            </div>
        </div>


<!-- ----------------------------------------------------------------------------------------------------- -->


        <!-- Sidebar inner chat end-->
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <nav class="pcoded-navbar">
                    <div class="pcoded-inner-navbar main-menu">
                        <div class="pcoded-navigatio-lavel">Navigation</div>
                        <ul class="pcoded-item pcoded-left-item">
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                    <span class="pcoded-mtext">Dashboard</span>
                                </a>
                            
                            </li>
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                                    <span class="pcoded-mtext">Master files</span>
                               
                                </a>
                                <ul class="pcoded-submenu">
                        
                                    <li class=" ">
                                        <a href="../group/manageproductgroup.php" target="">
                                            <span class="pcoded-mtext">  Group</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../producttype/manageproducttype.php" target="">
                                            <span class="pcoded-mtext">Type</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../location/managelocation.php" target="">
                                            <span class="pcoded-mtext">Location</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../uom/manageuom.php"  target="">
                                            <span class="pcoded-mtext">UOM</span>
                                        </a>
                                    </li>

                                    <li class=" ">
                                        <a href="../product/manageproduct.php" target="">
                                            <span class="pcoded-mtext">Products</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                          <!-- ------Purchases---------------------------------------------------------------- -->
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                                    <span class="pcoded-mtext">Purchases</span>
                               
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="../purchase_requisition/manage_purchase_requisition.php" target="">
                                            <span class="pcoded-mtext">Manage Purchase Requisition</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../purchase_order/manage_purchase_order.php" target="" >
                                            <span class="pcoded-mtext">Mange Purchase Order </span>
                                        </a>
                                    </li>
                                    
                                    <li class="">
                                        <a href="../GRN/manage_GRN.php " target=""> 
                                            <span class="pcoded-mtext">Manage GRN</span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
<!-- ------Sales------------------------------------------------------------------------------------------------------------------------------- -->
                             
<li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                                    <span class="pcoded-mtext">Sales</span>
                               
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="../sales_quotation/manage_sales_quotation.php" target="">
                                            <span class="pcoded-mtext">Sales Quotation</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../sales_order/manage_sales_order.php" target="" >
                                            <span class="pcoded-mtext">Sales Order </span>
                                        </a>
                                    </li>

                                    <li class=" ">
                                        <a href="../sales_invoice/manage_sales_invoice.php" target="" >
                                            <span class="pcoded-mtext">Sales Invoice </span>
                                        </a>
                                    </li>

                                    <li class=" ">
                                        <a href="../sales_dispatch/manage_salesdispatch.php" target="" >
                                            <span class="pcoded-mtext">Sales Dispatch </span>
                                        </a>
                                    </li>
                                

                                </ul>
                            </li>

<!-- ----------------------------------------------------------------------------------------------------------------------- -->
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="fa fa-male"></i></span>
                                    <span class="pcoded-mtext">Supplier</span>
                               
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="../supplier_group/manage_supplier_group.php " target="" >
                                            <span class="pcoded-mtext">Manage Supplier Group</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../supplier/manage_supplier.php " target="" >
                                            <span class="pcoded-mtext">Manage Supplier </span>
                                        </a>
                                    </li>
                                  

                                </ul>
                            </li>


                            <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
                             
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="fa fa-user"></i></span>
                                    <span class="pcoded-mtext">Customer</span>
                               
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="../customer_group/manage_customer_group.php " >
                                            <span class="pcoded-mtext">Manage Customer Group</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../customer/manage_customer.php"  >
                                            <span class="pcoded-mtext">Manage Customer </span>
                                        </a>
                                    </li>
                                  

                                </ul>
                            </li>


                            <li class="">
                                <a href="../city/manage_city.php" >
                                    <span class="pcoded-micon"><i class="fa fa-map-marker"></i></span>
                                    <span class="pcoded-mtext">Add City</span>
                               
                                </a>
                             
                            </li>


                            <li class="">
                                <a href="../salesrep/manage_salesrep.php" >
                                    <span class="pcoded-micon"><i class="fa fa-group"></i></span>
                                    <span class="pcoded-mtext">Sales Rep</span>
                               
                                </a>
                             
                            </li>

                            <li class="">
                                <a href="../interlocationtransfer/manage_interlocationtransfer.php" >
                                    <span class="pcoded-micon"><i class="fa fa-arrows-h"></i></span>
                                    <span class="pcoded-mtext">Inter Location Transfer</span>
                               
                                </a>
                             
                            </li>

<!-- --------------------------------------REPORTS---------------------------------------------------------------------------- -->
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="fa fa-file-text-o"></i></span>
                                    <span class="pcoded-mtext">Reports</span>
                               
                                </a>
                                <!-- ------------------------------------ -->
                                <ul class="pcoded-submenu">
                                    <!-- -------------------------- -->
                                <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)">
                                
                                            <span class="pcoded-mtext">Purchase Report</span>
                                    
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="">
                                                <a href="../reports/purchase_order_ report.php " >
                                                    <span class="pcoded-mtext">Purchase Order Report </span>
                                                </a>
                                            </li>
                                            <li class=" ">
                                                <a href="../reports/grn_report.php " >
                                                    <span class="pcoded-mtext">Goods Received Note Report </span>
                                                </a>
                                            </li>

                                         
                                        

                                        </ul>
                                </li>
                          
                                </ul>




                                <ul class="pcoded-submenu">
                                    <!-- -------------------------- -->
                                <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                           
                                    <span class="pcoded-mtext">Sales Report</span>
                               
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="../reports/sales_invoice_report.php " >
                                            <span class="pcoded-mtext">Sales Report </span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../reports/dispatch_report.php " >
                                            <span class="pcoded-mtext">Sales Dispatch Report</span>
                                        </a>
                                    </li>

                                    <!-- <li class=" ">
                                        <a href="../reports/manage_supplier.php " >
                                            <span class="pcoded-mtext">Goods Received Note Report </span>
                                        </a>
                                    </li> -->
                                  

                                </ul>
                            </li>
                          
                                  

                                </ul>
                                <ul class="pcoded-submenu">
                                    <!-- -------------------------- -->
                                <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                           
                                    <span class="pcoded-mtext">Inventory Report</span>
                               
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="../reports/stock_report.php " >
                                            <span class="pcoded-mtext">Stock Report </span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../reports/cost_reportcost_report.php " >
                                            <span class="pcoded-mtext">Cost Report</span>
                                        </a>
                                    </li>

                                 
                                  

                                </ul>
                            </li>
                          
                                  

                                </ul>

                            </li>
                        </ul>



                      
                   
                       
                      
                            
                       
                    
                    </div>
                </nav>
