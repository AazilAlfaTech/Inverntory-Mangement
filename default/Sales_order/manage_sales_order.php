<?php
include_once "../sales_order/sales_order.php";
$sales_order2=new sales_order();

$result_salesorder=$sales_order2->get_all_sales_order();

include_once "../../files/head.php";

?>
<!-- --------------------------------------------------------------------------------------------------- -->

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Manage Sales Order</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Widget</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <div class="d-flex flex-row-reverse">
                    <a href="add_new_sales_order.php">
                        <button class="btn btn-mat btn-primary ">Add New Sales Order</i></button>
                    </a>
                </div>


                <br>
                <br>

                <!-- ----------------------------------------------------------------------------------------------------------------------------- -->



                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Autofill table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Sales Order</h5>
                                    <span></span>
                                    <div class="card-header-right" >
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block"  style="display: none;">
                                    <div class="dt-responsive table-responsive">
                                        <table id="autofill" class="table table-striped table-bordered nowrap">
                                            <thead>
                                            <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Reference</th>
                                                    <th>Customer</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            
                                            </thead>
                                            <tbody>

                                            <?php
                                                    foreach($result_salesorder as $item)
                                                    {echo"
                                                        <tr>
                                                            <td id='gr_id_td'>$item->salesorder_id</td>
                                                            <td>$item->salesorder_date</td>
                                                            <td>$item->salesorder_ref</td>
                                                           
                                                            <td>$item->salesorder_customer_name</td>
                                                            <td>$item->salesorder_status</td>
                                                            <td style='white-space: nowrap, width: 1%;'>
                                                                <div class='tabledit-toolbar btn-toolbar' style='text-align: left;'>
                                                                 <div class='btn-group btn-group-sm' style='float: none;'>
                                                                <a href='viewsalesorder.php?view=$item->salesorder_id' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></a>
                                                                <a href='edit_sales_order.php?edit=$item->salesorder_id' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-edit''></span></a>
                                                                <button type='button'  onclick='deleteorder($item->salesorder_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o'></span></button>
                                                                
                                                            </div>
                                                        </td>
                                                        </tr>
                                                        
                                                        ";

                                                    }
                                                ?>

                                            </tbody>
                       </table>
                                    </div>
                                </div>
                            </div>





















                            <!-- ----------------------------------------------------------------------------------------------------------------- -->
                            <?php

include_once "../../files/foot.php";

?>