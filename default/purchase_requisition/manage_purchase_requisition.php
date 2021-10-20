<?php


include_once "purchase_requisition.php";

    $purchasereq1 = new purchaserequest();
    $result_pr=$purchasereq1->get_all_purchaserequest();

    // print_r($result_pr);
    if(isset($_GET['d_id']))
{
    $res_delete=$purchasereq1->delete_purchaserequest($_GET['d_id']);
    
    //code for delete validations
    if($res_delete==true)
    {
        header("location:../purchase_requisition/manage_purchase_requisition.php?delete_success=1");
        }
        else
        {
            $msg_2="Purchase requisition already in use therefore cannot delete";
        } 
    }

    if(isset($_GET['edit_pr']))
    {
        $purchasereq1=$purchasereq1->get_purchaserequest_by_id($_GET['edit_pr']);

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
                                    <h4>Manage Purchase Requisition</h4>

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
<a href="add_new_purchase_requisition.php">
                    <button class="btn btn-mat btn-primary ">Add New Purchase Requisition</i></button>
</a>
                </div>


                <br>
                <br>

                <!-- ----------------------------------------------------------------------------------------------------------------------------- -->



                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- ALERT MESSAGE START -->
                            <?php
                                if(isset($_GET['success'])) {
                                    echo"<div class='alert alert-success background-success'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <i class='icofont icofont-close-line-circled text-white'></i>
                                    </button>
                                    <strong>New Purchase Requisition added successfully</strong> 
                                </div>";
                                }
                                ?>
                                 <?php
                                if(isset($_GET['success_edit'])) {
                                    echo"<div class='alert alert-info background-info'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <i class='icofont icofont-close-line-circled text-white'></i>
                                    </button>
                                    <strong>Purchase requisition details updated successfully</strong> 
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
                                if(isset($_GET['delete_PO'])) {
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
                            <!-- ALERT MESSAGE END -->
                            <!-- Autofill table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Purchase Requisition</h5>
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
                                                    <th>Reference No</th>
                                                    <th>Date </th>
                                                    <th>Supplier</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                                 foreach($result_pr as $item)
                                                 {
                                                    if($item->purchaserequest_currentstatus=='NEW')
                                                    { 
                                                        echo"
                                                                    <tr>
                                                                    <td>$item->purchaserequest_id   </td>
                                                                        <td>$item->purchaserequest_ref   </td>
                                                                        <td>$item->purchaserequest_date</td>
                                                                        <td>$item->supplier_name  </td>
                                                                        <td>$item->purchaserequest_currentstatus</td>

                                                                      
                                                                     
                                                                     

                                                                        <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                                        <button type='button' id='edit_pr' onclick='view_pr($item->purchaserequest_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span  class='fa fa-eye'></span></button>
                                                                        <button type='button' onclick='edit_pr($item->purchaserequest_id)' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-edit'></span></button> </a>
                                                                        <button type='button'  onclick='delete_pr($item->purchaserequest_id)'   class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o'></span></button>
                                                                        </td> 
                                               
                                               
                                                                       
                                                                       
                                                                    </tr>
                                                                    ";
                                                    }
                                                    elseif($item->purchaserequest_currentstatus=='COMPLETE')
                                                    {
                                                        echo"
                                                        <tr>
                                                        <td>$item->purchaserequest_id   </td>
                                                            <td>$item->purchaserequest_ref   </td>
                                                            <td>$item->purchaserequest_date</td>
                                                            <td>$item->supplier_name  </td>
                                                            <td>$item->purchaserequest_currentstatus</td>

                                                            <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                            <button type='button' id='edit_pr' onclick='view_pr($item->purchaserequest_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span  class='fa fa-eye'></span></button>
                                                            </td> 
                                                        </tr>";
                                                    }
                                                }
                                                ?>

                                                </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>





















                            <!-- ----------------------------------------------------------------------------------------------------------------- -->
                            <?php

include_once "../../files/foot.php";

?>



<script type="text/javascript" src="../javascript/customer.js"></script>
                            <script>
                            $(".alert").fadeIn(300).delay(3500).fadeOut(400);

                            function edit_pr(edit_pr) {


                                window.location.href = "edit_purchase_req.php?edit_pr=" + edit_pr;



                            }

                            function view_pr(view_pr) {


                                window.location.href = "print_purchaserequistion.php?view_pr=" + view_pr;


                            }

                            function delete_pr(deleteid) {

                                if (confirm("Do you want to delete id" + " " + deleteid)) {
                                    window.location.href = "manage_purchase_requisition.php?d_id=" + deleteid;
                                }

                            }
                            </script>