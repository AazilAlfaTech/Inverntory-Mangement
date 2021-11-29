<?php
include_once "../sales_order/sales_order.php";
$sales_order2=new sales_order();

$result_salesorder=$sales_order2->get_all_sales_order();
if(isset($_GET['d_id']))
{
    $res_delete=$sales_order2->delete_sales_order($_GET['d_id']);
    
    //code for delete validations
    if($res_delete==true){
        header("location:../sales_order/manage_sales_order.php?delete_success=1");
       
    }
    else
    {
       
        $msg_2="Sales order already in use therefore cannot delete";
    } 
}


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
                                        <a href="../dashboard//dashboard.php"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="../sales_order/manage_sales_order.php">Sales Order</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->
                <?php 
                    if($user4->check("SOA", 5)){
                        echo'<div class="d-flex flex-row-reverse">
                        <a href="add_new_sales_order.php">
                            <button class="btn btn-mat btn-primary ">Add New Sales Order</i></button>
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
                                    <strong>Sales Order added successfully</strong> 
                                </div>";
                                }
                                ?>
                                <?php
                                if(isset($_GET['success_edit'])) {
                                    echo"<div class='alert alert-info background-info'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <i class='icofont icofont-close-line-circled text-white'></i>
                                    </button>
                                    <strong>Sales Order updated successfully</strong> 
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
                                <?php
                                if(isset($_GET['delete_g'])) {
                                    echo"<div class='alert alert-danger background-danger'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <i class='icofont icofont-close-line-circled text-white'></i>
                                    </button>
                                    <strong>$msg_2</strong> 
                                </div>";
                                }
                                ?>
                                <?php
                                if(isset($_GET['notsuccess'])) {
                                    echo"<div class='alert alert-danger background-danger'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <i class='icofont icofont-close-line-circled text-white'></i>
                                    </button>
                                    <strong>The code or the name already exists.Please try again</strong> 
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
                                                    <th>Date</th>
                                                    <th>Reference</th>
                                                    <th>Customer</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            
                                            </thead>
                                            <tbody>

                                            <?php
                                             // if(){
                                             foreach($result_salesorder as $item)
                                            {
                                               
                                                        if($item->salesorder_currentstatus=='COMPLETED')
                                                        {
                                                            echo"
                                                            <tr>
                                                            <td id='gr_id_td'>$item->salesorder_id</td>
                                                            <td>$item->salesorder_date</td>
                                                            <td>$item->salesorder_ref</td>
                                                            <td>$item->salesorder_customer_name</td>
                                                            <td><label class='badge st$item->salesorder_currentstatus'>$item->salesorder_currentstatus</label></td>
                                                            <td style='white-space: nowrap, width: 1%;'>
                                                                <div class='tabledit-toolbar btn-toolbar' style='text-align: left;'>
                                                                <div class='btn-group btn-group-sm' style='float: none;'>";
                                                                if($user4->check("SOV", 7)){
                                                                    echo" <a href='viewsalesorder.php?view=$item->salesorder_id' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></a>";
                                                                }
                                                               
                                                                echo"</div>
                                                            </td>
                                                            </tr>
                                                            ";

                                                        }else if($item->salesorder_currentstatus=='PENDING')
                                                        {
                                                            echo"
                                                            <tr>
                                                            <td id='gr_id_td'>$item->salesorder_id</td>
                                                            <td>$item->salesorder_date</td>
                                                            <td>$item->salesorder_ref</td>
                                                            <td>$item->salesorder_customer_name</td>
                                                            <td><label class='badge st$item->salesorder_currentstatus'>$item->salesorder_currentstatus</label></td>
                                                            <td style='white-space: nowrap, width: 1%;'>
                                                                <div class='tabledit-toolbar btn-toolbar' style='text-align: left;'>
                                                                <div class='btn-group btn-group-sm' style='float: none;'>";
                                                                if($user4->check("SOV", 7)){
                                                                    echo" <a href='viewsalesorder.php?view=$item->salesorder_id' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></a>";
                                                                }
                                                                if($user4->check("SOE", 6)){
                                                                    echo"<a href='edit_sales_order.php?edit=$item->salesorder_id' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-edit''></span></a>";
                                                                }
                                                            echo"   </div>
                                                            </td>
                                                            </tr>
                                                            ";
                                                        }
                                                        else
                                                        {
                                                            echo"
                                                            <tr>
                                                            <td id='gr_id_td'>$item->salesorder_id</td>
                                                            <td>$item->salesorder_date</td>
                                                            <td>$item->salesorder_ref</td>
                                                            <td>$item->salesorder_customer_name</td>
                                                            <td><label class='badge st$item->salesorder_currentstatus'>$item->salesorder_currentstatus</label></td>
                                                            <td style='white-space: nowrap, width: 1%;'>
                                                                <div class='tabledit-toolbar btn-toolbar' style='text-align: left;'>
                                                                <div class='btn-group btn-group-sm' style='float: none;'>";
                                                                if($user4->check("SOV", 7)){
                                                                    echo "<a href='viewsalesorder.php?view=$item->salesorder_id' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='fa fa-eye'></i></span></a>";
                                                                }
                                                                if($user4->check("SOE", 6)){
                                                                    echo "<a href='edit_sales_order.php?edit=$item->salesorder_id' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-edit''></span></a>";
                                                                }
                                                                if($user4->check("SOD", 8)){
                                                                    echo "<button type='button'  onclick='deleteorder($item->salesorder_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o'></span></button>";
                                                                }
                                                               
                                                               
                                                                
                                                                
                                                             echo"   </div>
                                                            </td>
                                                            </tr>
                                                            ";
                                                        }   
                                                    
                                            }

                                             // }

                                                   
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


<script>
      function deleteorder(deleteid) 
    {
        if (confirm("Do you want to delete the order" + " " + deleteid)) 
        {
            window.location.href = "manage_sales_order.php?d_id=" + deleteid;
        }

    }

    $( ".alert" ).fadeIn( 300 ).delay( 3500 ).fadeOut( 400 );
</script>