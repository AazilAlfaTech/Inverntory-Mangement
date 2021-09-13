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
    $purchaseorder2->purchaserorder_requestid=$_POST['purchaseorderdate'];
    $purchaseorder2->purchaserorder_requestid=$_POST['purchaseorderrequest'];
    $purchaseorder2->purchaseorder_date=$_POST['purchaseorderdate'];
    $purchaseorder2->purchaseorder_ref=$purchaseorder2->po_code($_POST['purchaseorderdate']);

    $Purch_reqid=$purchaseorder2->insert_purchaseorder();
    
    
   $purchaseorderitem2->insert_POitem1($Purch_reqid);
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
                                <input class='form-control' type='text'value=<?=$purchase_request2->purchaserequest_supplier ?> <?php if($purchase_request2->purchaserequest_supplier){echo "readonly=\"readonly\"";} ?>>
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
                        <div class="form-group row additemform">

                            <div class="col-sm-4">
                                <label class=" col-form-label">Select Product</label>
                                <select class="form-control "  id="porder_itemproductid" > 

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

                                <label class=" col-form-label">Price</label>
                                <input type="text" class="form-control" placeholder="0.00" name="pr_itemprice" id="porder_itemprice" onkeyup="cal_prd_total()" >
                            </div>

                            <div class="col-sm-2">

                                <label class=" col-form-label">Qty</label>
                                <input type="number" class="form-control" placeholder="0.00" name="pr_itemqty" id="porder_itemqty" onkeyup="cal_prd_total()" >
                            </div>

                            <div class="col-sm-2">

                                <label class=" col-form-label">Discount</label>
                                <input type="text" class="form-control" placeholder="0.00" name="pr_itemdiscount" Id="porder_itemdiscount" value='0.00' onkeyup="cal_prd_total()" >
                            </div>

                            <div class="col-sm-2">

                                <label class=" col-form-label">Total</label>
                                <input type="text" class="form-control" placeholder="0.00" name="pr_itemfinalprice"  id="porder_itemfinalprice" disabled>
                            </div>

                        </div>
                                <button type="button" class="btn btn-primary" name="addprbtn" id="add_prbtn">ADD</button>
                                <button class="btn btn-inverse">CLEAR</button>
                        <!-- add product form end -->

                            <br>
                            <br>


                        <!-- Edit With Button card start -->

                        <div class='table-responsive'>

                            <table class='table  table-bordered'  id='example-2'  >
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
                                            <input class='input-borderless input-sm row_data price'   type='text' readonly name='Price[]' value='<?= $item->pr_item_price ?>'> <div style="color: red; display: none" class="msg2">Digits only</div>
                                            </td>
                                            <td class='table-edit-view'><span class='tabledit-span'><?= $item->pr_item_discount ?></span>
                                            <input class='input-borderless input-sm row_data discount'   type='text' readonly name='Discount[]' value='<?= $item->pr_item_discount ?>'> <div style="color: red; display: none" class="msg3">Digits only</div>
                                            
                                            <td class='table-edit-view'><span class='tabledit-span'><?=$item->item_discount ?></span>
                                            <input class='input-borderless input-sm row_data total'   type='text' readonly value='<?=$item->item_discount ?>'>
                                            
                                            </td>
                                        
                                        
                                        <td>
                                        <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>
                                        <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>
                                        <span class='btn_cancel'><btn_deleterowutton class='btn btn-mini btn-danger' type='button'>Cancel</button></span>
                                        <span class=''><button    class='btn btn-mini btn-danger'>Delete</button></span>
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
                                        <td ><input type="text" id="total_quan" name="totqty" class="form-control form-control-sm" ></td>
                                    </tr>
                                    <tr>
                                        <th> Sub Total :</th>
                                        <td ><input type="text" id="total_price" name="subtot" data-a-sign="Rs. " class=" form-control form-control-sm autonumber"></td>
                                    </tr>
                                    <tr>
                                        <th> Total Discount :</th>
                                        <td ><input type="text" id="total_discount" name="discount tot" class="form-control form-control-sm  autonumber" data-a-sign="Rs. " ></td>
                                    </tr>
                                   
                                    <tr class="text-info">
                                        <td>
                                            <hr>
                                            <h5 class="text-primary">Total :</h5>
                                        </td>
                                        <td>
                                            <hr>
                                            <h5 class="text-primary"><input type="text" id="total_final" name="nettot"  class="form-control"></h5>
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


<script>
    function edit_purchorder(PR_id)
    {
        window.location.href="add_new_purchase_order.php?view="+PR_id;
    }
</script>
<script>
    function cal_prd_total(){
        var pprice = $("#porder_itemprice").val();
        var pqty =$("#porder_itemqty").val();
        var pdis = $("#porder_itemdiscount").val(); 


        var tot = parseFloat(pprice)*parseFloat(pqty)*parseFloat(pdis)/100

        ftot =  parseFloat(pprice)*parseFloat(pqty) - parseFloat(tot)
        $("#porder_itemfinalprice").val(ftot);
    }

// -------------------------------------------------------------------------------------------------------------------------

$("#add_prbtn").click(function(){

add_products();
clear_products();
cal_totquantity();
cal_totprice();
cal_totdiscount();
final_total();

});

// ---------------------------------------------------------------------------------------------------------------------
function add_products()
{

   
    
    var pr_prod=$("#porder_itemproductid option:selected").val();
    var pr_prod_name=$("#porder_itemproductid option:selected").text(); //dropdown
    var p_price=$("#porder_itemprice").val();
    var p_qty=$("#porder_itemqty").val();
    var p_dis=$("#porder_itemdiscount").val();
    var p_tot= $("#porder_itemfinalprice").val();
    productsubtotal=parseFloat(p_price*p_qty);
    if($("#porder_itemproductid").val()=='' || $("#porder_itemprice").val()==''|| $("#porder_itemqty").val()==''  || $("#porder_itemdiscount").val()==''){
         alert("Fill all the fields in item info");
     } else{
   
    $(".itembody").append("<tr><td><input  class='form-control input-sm  ' type='hidden' name='Product[]' value='"+pr_prod+"'> <span class='tabledit-span'>"+ pr_prod_name +" </span></td><td><input class='input-borderless input-sm row_data quantity' type='text' readonly name='Quantity[]' value='"+p_qty+"'><div style='color: red; display: none' class='msg1'>Digits only</div><input class='form-control input-sm subtotal'   type='hidden'  value='"+productsubtotal+"'></td><td><input class='input-borderless input-sm row_data price'  type='text' readonly name='Price[]' value='"+p_price+"'><div style='color: red; display: none' class='msg2'>Digits only</div>  </td><td><input class='input-borderless input-sm row_data discount' type='text' readonly name='Discount[]' value='"+p_dis+"'><div style='color: red; display: none' class='msg1'>Digits only</div></td> <td><input  class='input-borderless input-sm row_data total ' type='text' readonly  value='"+p_tot+"'></td><td><span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span><span class='btn_deleterow'><button  class='btn btn-mini btn-danger' type='button'>Delete</button></span><span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span><span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Reset</button></span></td> </tr>");
     

     $(".btn_save").hide();
    $(".btn_cancel").hide();
     }
}

// ----------------------------------------------------------------------------------------------------------------


function clear_products()
{

   

    $("#porder_itemproductid option:selected").text(""); //dropdown
    $("#porder_itemprice").val("");
    $("#porder_itemqty").val("");
    $("#porder_itemdiscount").val("");
    $("#porder_itemfinalprice").val("");
    
  


}

// function delete_row(row){
//         $(row).parent().parent().parent().remove();
//         console.log("rowww");    }




</script>
<script type="text/javascript" src="../javascript/editabletable.js"></script>
