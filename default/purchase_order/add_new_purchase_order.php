<?php



include_once ("../purchase_requisition/purchase_requisition.php");
$purchase_request2=new purchaserequest();

include_once ("../purchase_requisition/purchase_request_item.php");
$purchase_request_item2=new purchase_request_item();

include_once ("../purchase_order/purchaseorder.php");
$purchaseorder2=new purchaseorder();

include_once ("../purchase_order/purchaseorderitem.php");
$purchaseorderitem2=new purchaseorderitem();

include_once "../product/product.php";
$product1 = new product();     
$productlist=$product1->getall_product2();


//view PR details
if(isset($_GET["view"]))
{
    $purchase_request2=$purchase_request2->get_purchaserequest_by_id($_GET["view"]);
    $purchase_request_item2=$purchase_request_item2->get_all_item_by_requestid($_GET["view"]);
   
  
}



if(isset($_POST['purchaseorderdate'])){
    // $purchaseorder2->purchaserorder_requestid=$_POST['purchaseorderdate'];
    $purchaseorder2->purchaserorder_requestid=$_POST['purchaseorderrequest'];
    $purchaseorder2->purchaseorder_date=$_POST['purchaseorderdate'];
    $purchaseorder2->purchaseorder_ref=$purchaseorder2->po_code($_POST['purchaseorderdate']);
    $Purch_reqid=$purchaseorder2->insert_purchaseorder();
    $purchaseorderitem2->insert_POitem1($Purch_reqid);
    $purchase_request2->inactive_purchreq_status($_POST['purchaseorderrequest']);
    // echo '<pre>';
    // print_r($purchase_request2);
    $purchase_request_item2->inactive_purchasereq_item($_POST['purchaseorderrequest']);
    header("location:../purchase_order/manage_purchase_order.php?success=1");


}

$purchase_request_res=$purchase_request2->get_all_purchaserequest();

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
                                    <h4>Add New Purchase Order</h4>

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




                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
    <!-- ...................................................................................................                     -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Select Purchase Request</h5>
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
                                                    <th>Reference NO</th>
                                                    <th>Date</th>
                                                    <th>Supplier</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($purchase_request_res as $item)
                                                    {echo"
                                                        <tr>
                                                            <td id='gr_id_td'>$item->purchaserequest_id</td>
                                                            <td>$item->purchaserequest_ref</td>
                                                            <td>$item->purchaserequest_date</td>
                                                            <td>$item->supplier_name</atd>

                                                            <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                            <button type='button' onclick='edit_purchorder($item->purchaserequest_id)'  class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button>
                                                            
                                                            
                                                        </div></td>
                                                        </tr>
                                                        
                                                        ";

                                                    }
                                                ?>
                        
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>    

   <!-- ...................................................................................................                     -->
        <div class="card">
                <div class="card-header">
                    <h5>Add New Purchase Order</h5>

                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-maximize full-card"></i></li>
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                        </ul>
                    </div>
                </div>

            <div class='card-block'>

                <form action='add_new_purchase_order.php' method='POST'>



                    <?php if(isset($_GET['view'])):?>
                        <div class='form-group row'>
                            <!-- top form start -->
                            <!-- purchase request id -->
                            <input type='hidden'  class='form-control' value=<?=$_GET['view'] ?> name='purchaseorderrequest' required>
                            

                            <div class='col-sm-4'>
                                <label class='col-form-label'> PR Reference No</label>
                                <input class='form-control'  type='text' value=<?=$purchase_request2->purchaserequest_ref ?> <?php if($purchase_request2->purchaserequest_ref){echo "readonly=\"readonly\"";} ?>>
                            </div>
                            <div class='col-sm-4'>
                                <label class='col-form-label'>Supplier</label>
                                <input class='form-control' type='text'value=<?=$purchase_request2->supplier_name?> <?php if($purchase_request2->purchaserequest_supplier){echo "readonly=\"readonly\"";} ?>>
                            </div>
                            <div class='col-sm-4'>
                                <label class='col-form-label'>Date</label>
                                <input class='form-control' type='date' name='purchaseorderdate'  value='<?php echo date('Y-m-d');?>' required>
                            </div>
                            <!-- top form end            -->
                        </div>
                            <br>
                            <br>

                        <!-- add product from -->
                        <div class="form-group row productform">

                            <div class="col-sm-2">
                                <label class=" col-form-label">Select Product</label>
                                <select class="js-example-basic-single col-sm-12 product_level"  id="porder_itemproductid" > 

                                    <option value="-1 ">Select product</option>
                                    <?php
                                    foreach($productlist as $item)

                                    if($item->product_id ==$product1->product_id)   
                                        echo "<option value='$item->product_id' selected='selected'>$item->product_name</option>";
                                    else
                                    echo"<option value='$item->product_id'> $item->product_name</option>";
                                    ?>


                                </select>

                            </div>

                            <div class="col-sm-2">

                                <label class=" col-form-label">Product batch</label>
                                <input type="text" class="form-control product_batch" placeholder="" name="pr_batch" id="preq_prodbatch"  >
                            </div>
                            
                            <div class="col-sm-2">

                                <label class=" col-form-label">Price</label>
                                <input type="text" class="form-control price_add" placeholder="0.00" name="pr_itemprice" id="porder_itemprice" >
                                <div style="color: red; display: none" class="msg3">Digits only</div>
                            </div>

                            <div class="col-sm-2">

                                <label class=" col-form-label">Qty</label>
                                <input type="number" class="form-control qty_add" placeholder="0.00" name="pr_itemqty" id="porder_itemqty" >
                                <div style="color: red; display: none" class="msg1">Digits only</div>
                            </div>

                            <div class="col-sm-2">

                                <label class=" col-form-label">Discount</label>
                                <input type="text" class="form-control disc_add" placeholder="0.00" name="pr_itemdiscount" Id="porder_itemdiscount" value='0.00' >
                                <div style="color: red; display: none" class="msg2">Digits only</div>
                            </div>

                            <div class="col-sm-2">
                            <label class=" col-form-label">Total</label>
                                                <input type="text" class="form-control totaladd" placeholder="0.00" name="pr_itemfinalprice" id="porder_itemfinalprice" disabled>
                                <!-- <label class=" col-form-label">Total</label>
                                <input type="text" class="form-control totaladd" placeholder="0.00" name="pr_itemfinalprice"  id="porder_itemfinalprice" disabled> -->
                            </div>

                        </div>
                                <button type="button" class="btn btn-primary" name="addprbtn" id="add_prbtn">ADD</button>
                                <button type="button" class="btn btn-inverse reset">CLEAR</button>
                        <!-- add product form end -->

                            <br>
                            <br>


                        <!-- Edit With Button card start -->

                        <div class='table-responsive'>

                            <table class='table  table-striped table-bordered'  id='example-2'  >
                                <thead class='table-primary'>
                                    <tr>
                                    
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class='itembody'>

                                        <?php foreach( $purchase_request_item2 as $item):  ?>
                                        <tr>
                                        <td class='table-edit-view'><span class=''><?= $item->product_name?></span>
                                            <input class='form-control input-sm productid '   type='hidden' name='Product[]' value='<?= $item->pr_item_productid ?>'>
                                            </td>
                                        <td class='table-edit-view'><span class='tabledit-span'><?= $item->pr_item_qty ?></span>
                                        <input class='input-borderless input-sm row_data quantity'   type='text' readonly  name='Quantity[]' value='<?=$item->pr_item_qty ?>'><div style="color: red; display: none" class="msg1">Digits only</div>
                                        </td>
                                        <td class='table-edit-view'><span class='tabledit-span'><?= $item->pr_item_price ?></span>
                                            <input class='form-control input-sm subtotal'   type='hidden'  value='<?=$item->pr_item_subtotal?>'> 
                                            <input class='input-borderless input-sm row_data price'   type='text' readonly name='Price[]' value='<?= $item->pr_item_price ?>'> <div style="color: red; display: none" class="msg2">Digits only</div>
                                        </td>
                                        <td class='table-edit-view'><span class='tabledit-span'><?= $item->pr_item_discount ?></span>
                                            <input class='input-borderless input-sm row_data discount'   type='text' readonly name='Discount[]' value='<?= $item->pr_item_discount ?>'> <div style="color: red; display: none" class="msg3">Digits only</div>
                                            
                                        <td class='table-edit-view'><span class='tabledit-span'><?=$item->pr_item_finalprice?></span>
                                            <input class='input-borderless input-sm row_data total'   type='text' readonly value='<?=$item->pr_item_finalprice ?>'>
                                            
                                        </td>
                                        
                                        
                                        <td>
                                        <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>
                                        <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>
                                        <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Cancel</button></span>
                                        <span class='deletedata'><button    class='btn btn-mini btn-danger'type='button'>Delete</button></span>
                                        </td>
                                            
                                    </td>
                                            
                                        
                                                                                                    
                                        </tr>

                                    <?php endforeach ;  ?>

                                </tbody>
                            </table>    
                        </div>
                        <div class="card">

                            <table class="table table-responsive invoice-table invoice-total">
                                <tbody class="pricelist">
                                    <tr>
                                        <th> Total Quantity :</th>
                                        <td ><input type="text" id="total_quan" name="totqty" class="form-control form-control-sm" readonly ></td>
                                    </tr>
                                    <tr>
                                        <th> Sub Total :</th>
                                        <td ><input type="text" id="total_price" name="subtot" data-a-sign="Rs. " class=" form-control form-control-sm autonumber" readonly></td>
                                    </tr>
                                    <!-- <tr>
                                        <th> Total Discount :</th>
                                        <td ><input type="text" id="total_discount" name="discount tot" class="form-control form-control-sm  autonumber" data-a-sign="Rs. " ></td>
                                    </tr> -->
                                   
                                    <tr class="text-info">
                                        <td>
                                            <hr>
                                            <h5 class="text-primary">Total :</h5>
                                        </td>
                                        <td>
                                            <hr>
                                            <h5 class="text-primary"><input type="text" id="total_final" name="nettot"  class="form-control" readonly></h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                            <!-- </div> -->
                        <div class='d-flex flex-row-reverse'>
                            <button type='submit' name='save' class='btn btn-primary'>Submit</button>
                        </div>
                    <?php endif ;   ?>
                </form>


            </div>

        </div>
                        <!-- </div>
                    </div>
                </div> -->

<?php

include_once "../../files/foot.php";

?>

<script type="text/javascript" src="../javascript/purchase.js"></script>
<script type="text/javascript" src="../javascript/purchase/purchase_order.js"></script>
<script type="text/javascript" src="../javascript/editabletable.js"></script>
