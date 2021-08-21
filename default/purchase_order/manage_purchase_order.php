<?php
include_once "../purchase_order/purchaseorder.php";

$purchaseorder2=new purchaseorder();

$result_PO=$purchaseorder2->get_all_purchaseorder();

$msg_2="";//alert message for delete

if(isset($_GET['delete_PO'])){
    $res_del=$group1->delete_group($_GET['delete_PO']);
    //code for delete validations
    if($res_del==true){
        header("location:../purchase_order/manage_purchase_order.php?delete_success=1");
       
    }else{
       
        $msg_2="Purchase order already exists therefore cannot delete";
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
                                    <h4>Manage Purchase Order</h4>

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
<a href="add_new_purchase_Order.php">
                    <button class="btn btn-mat btn-primary ">Add New Purchas Order</i></button>
</a>
                </div>


                <br>
                <br>

                <!-- ----------------------------------------------------------------------------------------------------------------------------- -->



                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
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
            if(isset($_GET['success_edit'])) {
                echo"<div class='alert alert-info background-info'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='icofont icofont-close-line-circled text-white'></i>
                </button>
                <strong>Group details updated successfully</strong> 
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
                            <!-- Autofill table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Purchase Order</h5>
                                    <span></span>
                                    <div class="card-header-right">
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
                                                    <th>Supplier</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($result_PO as $item){
                                                        echo"
                                                        <tr>
                                                        <td>$item->purchaseorder_id</td>
                                                        <td>$item->purchaseorder_ref</td>
                                                        <td>$item->purchaseorder_date</td>
                                                        <td>$item->supplier_name1</td>
                                                        <td style='white-space: nowrap, width: 1%;'>
                                                        <div class='tabledit-toolbar btn-toolbar' style='text-align: left;'>
                                                            <div class='btn-group btn-group-sm' style='float: none;'>
                                                                <a href='edit_purch_order.php?edit=$item->purchaseorder_id' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></a>
                                                                <button type='button'  onclick='delete($item->purchaseorder_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
                                                                
                                                            </div>
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

<script>
    function deleteorder(purchaseorderid){
        console.log(del_id);
        if(confirm("Do you want to delete purchase order"+""+del_id))
      { window.location.href="../purchase_order/manage_purchase_order.php?delete_PO="+del_id;
     }


    }
</script>