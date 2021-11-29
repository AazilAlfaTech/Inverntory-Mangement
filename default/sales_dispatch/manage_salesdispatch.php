<?php
include_once "../sales_dispatch/sales_dispatch.php";
$salesdispatch3=new sales_dispatch();

$result_dispatch=$salesdispatch3->get_all_sales_dispatch();
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
                                    <h4>Manage Sales Dispaatch</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="../sales_dispatch/manage_salesdispatch.php">Manage Disaptch</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->
                <?php
                   if($user4->check("SDA", 13)){

                        echo'<div class="d-flex flex-row-reverse">
                        <a href="add_new_salesdispatch.php">
                            <button class="btn btn-mat btn-primary ">Add New Sales Dispatch </i></button>
                        </a>
                    </div>';
                    }
                ?>
                


                <br>
                <br>

                <!-- ----------------------------------------------------------------------------------------------------------------------------- -->



                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- //ALERT MESSAGES START................... -->
                                <?php
                                if(isset($_GET['success'])) {
                                    echo"<div class='alert alert-success background-success'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <i class='icofont icofont-close-line-circled text-white'></i>
                                    </button>
                                    <strong>New group added successfully</strong> 
                                </div>";
                                }
                                ?>
                                
                                <?php
                                if(isset($_GET['delete_success'])) {
                                    echo"<div class='alert alert-danger background-danger'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <i class='icofont icofont-close-line-circled text-white'></i>
                                    </button>
                                    <strong>Deleted successful</strong> 
                                </div>";
                                }
                                ?>
                                
                                
                                <!-- //ALERT MESSAGES END................... -->
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
                                                    <th>Reference</th>
                                                    <th>Date</th>
                                                    <th>Customer</th>
                                                    <th>Action</th>

                                                </tr>
                                            
                                            </thead>
                                            <tbody>
                                            <?php
                                                    foreach($result_dispatch as $item)
                                                    {echo"
                                                        <tr>
                                                            <td id='gr_id_td'>$item->salesdispatch_id</td>
                                                            <td>$item->salesdispatch_ref</td>
                                                            <td>$item->salesdispatch_date</td>
                                                            <td>$item->salesdispatch_customer_name</td>

                                                            <td style='white-space: nowrap, width: 1%;'>
                                                                <div class='tabledit-toolbar btn-toolbar' style='text-align: left;'>
                                                                 <div class='btn-group btn-group-sm' style='float: none;'>'";
                                                                if($user4->check("SDV", 15)){
                                                                    echo" <a href='viewsalesorder.php?view=$item->salesdispatch_id' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></a>";
                                                                }
                                                               

                                                          echo"      
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