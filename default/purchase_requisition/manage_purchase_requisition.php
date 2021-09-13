<?php


include_once "purchase_requisition.php";

    $purchasereq1 = new purchaserequest();

    $result_pr=$purchasereq1->get_all_purchaserequest();

    // print_r($result_pr);



    if(isset($_GET['edit_pr'])){
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
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                                 foreach($result_pr as $item){
                                                                    echo"
                                                                    <tr>
                                                                    <td>$item->purchaserequest_id   </td>
                                                                        <td>$item->purchaserequest_ref   </td>
                                                                        <td>$item->purchaserequest_date</td>
                                                                        <td>$item->supplier_name  </td>
                                                                     
                                                                      
                                                                     
                                                                     

                                                                        <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                                        <button type='button' id='edit_pr' onclick='view_pr($item->purchaserequest_id)' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='icofont icofont-eye-alt'></i></span></button>
                                                                        <button type='button' onclick='edit_pr($item->purchaserequest_id)' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button> </a>
                                                                        <button type='button'  onclick='delete_pr($item->purchaserequest_id)'   class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
                                                                        </td> 
                                               
                                               
                                                                       
                                                                       
                                                                    </tr>
                                                                    ";
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


                                window.location.href = "view_puchase_requisition.php?view_pr=" + view_pr;


                            }

                            function delete_pr(deleteid) {

                                if (confirm("Do you want to delete id" + " " + deleteid)) {
                                    window.location.href = "manage_purchase_requisition.php?d_id=" + deleteid;
                                }

                            }
                            </script>