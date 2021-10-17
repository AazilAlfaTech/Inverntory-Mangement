<?php


include_once "../sales_order/sales_order.php";
$sales_order2=new sales_order();
include_once "../sales_order/sales_order_item.php";
$sales_orderitem2=new sales_orderitem();
include_once "../product/product.php";
$product1 = new product();     
$productlist=$product1->getall_product2();

if(isset($_POST['save'])){
    $sales_order2->salesorder_date=$_POST['so_date'];
    $sales_order2->edit_sales_order($_POST['salesorderid']);
    $sales_orderitem2->insert_sales_orderitem($_POST['salesorderid']);
    $sales_orderitem2->edit_sales_orderitem();
    header("location:../sales_order/manage_sales_order.php");
    // if($res_edit==true){
 
    //     header("location:../purchase_order/manage_purchase_order.php?success_edit=1");
    // }elseif($res_edit==false){
        
    //     header("location:../purchase_order/manage_purchase_order.php?notsuccess=1");
    // }

   

}else{
    $sales_order2=$sales_order2->get_salesorder_by_id($_GET['edit']);
    $sales_orderitem_res=$sales_orderitem2->get_all_sales_orderitem($_GET['edit']);
    //print_r($sales_orderitem_res);
    
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
                                    <h4>Edit Sales Order</h4>

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
                                    <!-- <h5>Edit Sales order</h5> -->

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action='edit_sales_order.php' method='POST'>
                                        <!-- top part -->

                                        <div class="form-group row">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label"> SO Reference No</label>
                                                <input class="form-control" type="text" readonly='true' value=<?=$sales_order2->salesorder_ref ?>>

                                            </div>

                                            <input class="form-control" type="hidden" readonly='true' name="salesorderid" value=<?=$sales_order2->salesorder_id ?>>

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Customer</label>
                                                <input class="form-control" type="text" readonly='true' value="<?=$sales_order2->salesorder_customer_name ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="date"  value="<?=$sales_order2->salesorder_date ?>"  name="so_date" id="txtDate">
                                            </div>
                                        </div>

                                        <br>
                                        <br>
                                        <!-- add product from -->
                                        <div class="form-group row productform">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Product</label>
                                                <select class="js-example-basic-single col-sm-12 product_level" name="soitemproductid" id="soitem_productid">
                                                  
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
                                                
                                                <select class="form-control pricelevel" name="soitemprice" id="sq_itemprice" >
                                                    <option value=""> Pricelevel</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Qty</label>
                                                <input type="text" class="form-control qty_add" placeholder="0" name="soitemqty" id="soitem_qty">
                                                <div style="color: red; display: none" class="msg1">Digits only</div>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Discount</label>
                                                <input type="text" class="form-control disc_add" placeholder="0.00" name="soitemdiscount" id="soitem_discount">
                                                <div style="color: red; display: none" class="msg2">Digits only</div>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Total</label>
                                                <input type="text" class="form-control totaladd" placeholder="0.00" name="sofinalprice" id="sofinal_price" disabled>
                                            </div>

                                        </div>

                                        <button type="button" class="btn btn-primary add" name="addprbtn" id="add_prbtn">ADD</button>
                                        <button class="btn btn-inverse reset" type="button">CLEAR</button>
                                        <br>
                                        <br>


                                        <!-- Edit With Button card start -->

                                            <div class="">

                                                <table class="table  table-bordered " id="mytable" >
                                                    <thead class="table-primary">
                                                        <tr>
                                                            <th>Product</th>
                                                            <th style='width:82px;height:47px'>Qty</th>
                                                            <th>Price</th>
                                                            <th>Discount</th>
                                                            <th>Total</th>
                                                            <th>Action</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody class="itembody">
                                                    <?php if(isset($_GET['edit'])):?>
                                                        <?php foreach($sales_orderitem_res as $item):  ?>
                                                        <tr>    
                                                            <td class='table-edit-view'><span class=''><?= $item->so_itemproduct_name?></span>
                                                                <input class='form-control input-sm  '   type='hidden' name='' value='<?= $item->so_itemproductid ?>'>
                                                                <input class='form-control input-sm productid '   type='hidden' name='Orderid[]' value='<?= $item->so_salesorderid ?>'>
                                                            </td>
                                                            <td class='table-edit-view'><span class='tabledit-span'><?= $item->so_itemqty ?></span>
                                                                <input class=' input-borderless  input-sm row_data quantity'   type='text' readonly  name='Quantity_edit[]' value='<?=$item->so_itemqty ?>'><div style="color: red; display: none" class="msg1">Digits only</div>
                                                            </td>
                                                            <td class='table-edit-view'><span class='tabledit-span'><?= $item->so_itemprice ?></span>
                                                                

                                                                <select name='Price_edit[]'  class="input-borderless price productprice">
                                                                        <option value="<?=$item->so_itemprice?>"><?=$item->so_itemprice?></option>
                                                                        </select>
                                                                <input class='form-control input-sm subtotal'   type='hidden'  value='<?=$item->so_subtotal?>'>
                                                            </td>
                                                            <td class='table-edit-view'><span class='tabledit-span'><?= $item->so_itemdiscount ?></span>
                                                                <input class=' input-borderless input-sm row_data discount'   type='text' name='Discount_edit[]' readonly  value='<?= $item->so_itemdiscount ?>'> <div style="color: red; display: none" class="msg3">Digits only</div>
                                                            <td class='table-edit-view'><span class='tabledit-span'><?=$item->so_finaltotal ?></span>
                                                                <input class=' input-borderless input-sm  total'   type='text' readonly value='<?=$item->so_finaltotal ?>'>
                                                            </td>
                                                            <td>
                                                            <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>
                                                            <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>
                                                            <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Cancel</button></span>
                                                            <span class='deletedatarow'><button  class='btn btn-mini btn-danger ' type='button'>Delete</button></span>
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
                                                            <h5 class="text-primary"><input type="text" id="total_final" name="nettot"  class="form-control"></h5>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>


                                        <div class="d-flex flex-row-reverse">
                                            <button type="submit" name="save" name="save" class="btn btn-primary">Submit</button>
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
<script>
     function preventBack() {
    window.history.forward();
  }
  setTimeout("preventBack()", 0);
  window.onunload = function() {
    null
  };
</script>

<script type="text/javascript" src="../javascript/sales.js"></script>
<script type="text/javascript" src="../javascript/sales/sales_order.js"></script>

<script>


$(document).on('click', '.deletedatarow', function(event) {
    var tbl_row = $(this).closest('tr');
    console.log ("deletedata");

    var deleteitemid= tbl_row.find(".productid").val();
    console.log(deleteitemid);

    var confirm_msg=confirm("Are you sure you want delete the item?");
        if(confirm_msg==true){
            //ajax request
            $.ajax({
                url:'../sales_order/handle_delete.php',
                type:'POST',
                data:{id:deleteitemid},
                success:function(response){
                    if(response==true){
                        console.log('Item deleted successfully');
                        tbl_row.css('background','tomato');
                        tbl_row.fadeOut(800,function(){
                            tbl_row.remove();
                            cal_totquantity();
                            cal_totprice();
                            cal_totdiscount();
                            final_total();
                        });
                    }else{
                        console.log('Invalid ID.');
                    }
                }
                 
            });
        }
   

});

</script>
<script type="text/javascript" src="../javascript/editabletable.js"></script>