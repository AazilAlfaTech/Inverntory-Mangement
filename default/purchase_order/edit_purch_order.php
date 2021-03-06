<?php


include_once "../purchase_order/purchaseorder.php";
$purchaseorder3=new purchaseorder();

include_once "../purchase_order/purchaseorderitem.php";
$purchaseorderitem3=new purchaseorderitem();

include_once "../product/product.php";
$product1 = new product();     
$productlist=$product1->getall_product2();

if(isset($_POST['save']))
    {
        $purchaseorderitem3->insert_POitem1($_POST['puchorderid']);
        $res_edit=$purchaseorderitem3->edit_POitem();
        if($res_edit==true)
        {
            echo "EDITING DONE";
            header("location:../purchase_order/manage_purchase_order.php?success_edit=1");
        }
        elseif($res_edit==false)
        {
            echo "FALSE";
            header("location:../purchase_order/manage_purchase_order.php?notsuccess=1");
        }

    }
    else
    {
        $purchaseorder3=$purchaseorder3->get_purchaseorder_by_id($_GET['edit']);
        $purchaseorderitem3=$purchaseorderitem3->get_all_POitem($_GET['edit']);       
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
                                    <h4>Edit Purchase Order</h4>

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

                                <div class="card-block">

                                    <form action='edit_purch_order.php' method='POST'>
                                        <!-- top part -->

                                        <div class="form-group row">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label"> PO No</label>
                                                <input class="form-control" type="text" readonly='true' value=<?=$purchaseorder3->purchaseorder_ref ?>>

                                            </div>

                                            <input class="form-control" type="hidden" readonly='true' name="puchorderid" value=<?=$purchaseorder3->purchaseorder_id ?>>

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Supplier</label>
                                                <input class="form-control" type="text" readonly='true' value="<?=$purchaseorder3->supplier_name1 ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="text" readonly='true' value=<?=$purchaseorder3->purchaseorder_date ?>>
                                            </div>
                                        </div>

                                        <br>
                                        <br>
                                        <!-- add product from -->
                                        <div class="form-group row productform">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Product</label>
                                                <select class="js-example-basic-single col-sm-12 product_level "  id="porder_itemproductid" > 

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
                                                <input type="text" class="form-control price_add" placeholder="0.00" name="pr_itemprice" id="porder_itemprice" >
                                                <div style="color: red; display: none" class="msg3">Digits only</div>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Qty</label>
                                                <input type="text" class="form-control qty_add" placeholder="0.00" name="pr_itemqty" id="porder_itemqty" >
                                                <div style="color: red; display: none" class="msg1">Digits only</div>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Discount</label>
                                                <input type="text" class="form-control disc_add" placeholder="0.00" name="pr_itemdiscount" Id="porder_itemdiscount" value="" >
                                                <div style="color: red; display: none" class="msg2">Digits only</div>

                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Total</label>
                                                <input type="text" class="form-control totaladd" placeholder="0.00" name="pr_itemfinalprice" id="porder_itemfinalprice" disabled>
                                            </div>

                                        </div>
                                                <button type="button" class="btn btn-primary" name="addprbtn" id="add_prbtn">ADD</button>
                                                <button type="button" class="btn btn-inverse reset">CLEAR</button>
                                                <span class='error_fields'><label class="label label-md label-danger" >Please fill all the fields</label></span>

                                                <br>
                                                <br>


                                        <!-- Edit With Button card start -->

                                            <div class="table-responsive">

                                                <table class="table table-striped table-bordered " id="mytable" >
                                                    <thead class="table-primary">
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Qty</th>
                                                            <th>Price</th>
                                                            <th>Discount</th>
                                                            <th>Total</th>
                                                            <th>Action</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody class="itembody">
                                                    <?php if(isset($_GET['edit'])):?>
                                                        <?php foreach($purchaseorderitem3 as $item):  ?>
                                                        <tr>    
                                                            <td class='table-edit-view'><span class=''><?= $item->product_name?></span>
                                                                <input class='form-control input-sm  '   type='hidden' name='Product[]' value='<?= $item->po_item_productid ?>'>
                                                                <input class='form-control input-sm productid '   type='hidden' name='Orderid[]' value='<?= $item->po_item_id ?>'>
                                                            </td>
                                                            <td class='table-edit-view'><span class='tabledit-span'><?= $item->po_item_qty ?></span>
                                                                <input class=' input-borderless  input-sm row_data quantity'   type='text' readonly  name='Quantity_edit[]' value='<?=$item->po_item_qty ?>'><div style="color: red; display: none" class="msg1">Digits only</div>
                                                                <input class='form-control input-sm subtotal'   type='hidden'  value='<?=$item->po_item_subtotal ?>'>
                                                            </td>
                                                            <td class='table-edit-view'><span class='tabledit-span'><?= $item->po_item_price ?></span>
                                                                <input class=' input-borderless input-sm row_data price'   type='text' name='Price_edit[]' readonly  value='<?= $item->po_item_price ?>'> <div style="color: red; display: none" class="msg2">Digits only</div>
                                                                 
                                                            </td>
                                                            <td class='table-edit-view'><span class='tabledit-span'><?= $item->po_item_discount ?></span>
                                                                <input class=' input-borderless input-sm row_data discount'   type='text' name='Discount_edit[]' readonly  value='<?= $item->po_item_discount ?>'> <div style="color: red; display: none" class="msg3">Digits only</div>
                                                            <td class='table-edit-view'><span class='tabledit-span'><?=$item->po_item_finalprice ?></span>
                                                                <input class=' input-borderless input-sm  total'   type='text' readonly value='<?=$item->po_item_finalprice ?>'>
                                                            </td>
                                                            <td>
                                                            <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>
                                                            <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>
                                                            <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Cancel</button></span>
                                                            <span class='deletedata'><button  class='btn btn-mini btn-danger ' type='button'>Delete</button></span>
                                                            </td>
    
                                                        </tr>

                                                            <?php endforeach ;  ?>
                                                        <?php endif ;   ?>
                                                        </tbody>
                                                    </table>

                                                    

                                            </div>


                                         <!-- final values-->
                                            <table class="table table-responsive invoice-table invoice-total">
                                                <tbody class="pricelist">
                                                    <tr>
                                                        <th> Total Quantity :</th>
                                                        <td ><input type="text" id="total_quan"  class="form-control form-control-sm" ></td>
                                                    </tr>
                                                    <tr>
                                                        <th> Sub Total :</th>
                                                        <td ><input type="text" id="total_price" data-a-sign="Rs. " class=" form-control form-control-sm autonumber"></td>
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


                                        <div class="d-flex flex-row-reverse">
                                            <button type="submit" name="save" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>





           


                </div>
<?php

include_once "../../files/foot.php";

?>
<!-- <script>
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
    
    // var tcost=(parseFloat(cost)* parseFloat(wght)* parseFloat(qty)).toFixed(3); //total
   
    // var tprice=parseFloat(sprice)*parseFloat(wght)* parseFloat(qty);
    // tprice.toFixed(3);
    
    $(".itembody").append("<tr><td><input  class='form-control input-sm  ' type='hidden' name='Product[]' value='"+pr_prod+"'> <span class='tabledit-span'>"+ pr_prod_name +" </span></td><td><input class='input-borderless input-sm row_data quantity' type='text' readonly name='Quantity[]' value='"+p_qty+"'><div style='color: red; display: none' class='msg1'>Digits only</div><input class='form-control input-sm subtotal'   type='text'  value='"+productsubtotal+"'></td><td><input class='input-borderless input-sm row_data price'  type='text' readonly name='Price[]' value='"+p_price+"'><div style='color: red; display: none' class='msg2'>Digits only</div>  </td><td><input class='input-borderless input-sm row_data discount' type='text' readonly name='Discount[]' value='"+p_dis+"'><div style='color: red; display: none' class='msg1'>Digits only</div></td> <td><input  class='input-borderless input-sm row_data total ' type='text' readonly  value='"+p_tot+"'></td>      <td><span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span><span class='btn_deleterow'><button type='button'  class='badge badge-danger' style='float: none;margin: 5px;'>Delete</button></span><span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span><span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Reset</button></span></td> </tr>");
     

     $(".btn_save").hide();
    $(".btn_cancel").hide();

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






</script> -->
<script type="text/javascript" src="../javascript/purchase.js"></script>
<script type="text/javascript" src="../javascript/purchase/purchase_order.js"></script>
<script type="text/javascript" src="../javascript/editabletable.js"></script>