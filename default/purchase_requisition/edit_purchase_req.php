<?php

    include_once "purchase_requisition.php";
    include_once "../supplier/supplier.php";
    include_once "../product/product.php";
    include_once "purchase_request_item.php";

    $supplier1 = new supplier();

    $sup=$supplier1->get_all_supplier();
    // print_r($sup);

     $product1 = new product();     
     $prod=$product1->getall_product2();

    //  print_r($prod);

     $product_item1 = new purchase_request_item();

 
// --------------------------------------------------------------------------------------------------------------------

$purchase1 = new purchaserequest(); 

// if(isset($_GET['edit_pr']))
//     {
//         $purchase1= $purchase1->get_purchaserequest_by_id($_GET['edit_pr']);
//         $purchase_req_item = $product_item1->get_all_product_by_pr_id($_GET['edit_pr']);

//     }

    if(isset($_POST['save']))
    {
        // $purchase1->purchaserequest_supplier=$_POST["purchaserequestsupplier"];
        // $product_item1->insert_purchaserequest_item($_POST['req_id'] );
        // $purchase1-> edit_purchaserequest($_POST['req_id']);
        // $product_item1->edit_PR_item(); //edit item
        $product_item1->insert_purchaserequest_item($_POST['req_id'] );

        $res_edit=$product_item1->edit_PR_item(); //edit item
         //code for edit valaidation
        if($res_edit==true)
        {
            "EDITING DONE";
            header("location:../purchase_requisition/manage_purchase_requisition.php?success_edit=1");
        }
        elseif($res_edit==false)
        {
            echo "FALSE";
            header("location:../purchase_requisition/manage_purchase_requisition.php?notsuccess=1");
        }  
    } 
    else
    {
        $purchase1= $purchase1->get_purchaserequest_by_id($_GET['edit_pr']);
        $purchase_req_item = $product_item1->get_all_product_by_pr_id($_GET['edit_pr']);
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
                                    <h4>Edit Purchase Requisition</h4>

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
                                    <h5>Edit Purchase Requisition</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action="edit_purchase_req.php" method="POST">




                                        <div class="form-group row">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Supplier</label>
                                                <select class="js-example-basic-single col-sm-12" name="purchaserequestsupplier" id="purchreq_supplier" readonly>

                                                    <option value=" ">Select supplier</option>
                                                    <?php
                                                        foreach($sup as $item)
                                                      
                                                        if($item->supplier_id ==$purchase1->purchaserequest_supplier )   

			                                        echo "<option value='$item->supplier_id' selected='selected'>$item->supplier_name</option>";
                                                    else
                                                    echo"<option value='$item->supplier_id'>$item->supplier_name</option>";
                                                    ?>


                                                </select>

                                            </div>

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Reference Code</label>
                                                <input class="form-control" type="text" name="purchaserequest_ref" id="" value="<?=$purchase1->purchaserequest_ref ?>" readonly>

                                                <input class="form-control" type="text" name="req_id" id="" value="<?=$purchase1->purchaserequest_id ?>" readonly hidden>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="date" name="purchaserequestdate" id="" value="<?=$purchase1->purchaserequest_date ?>">
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="form-group productform row">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Product</label>
                                                <select class="js-example-basic-single col-sm-12 product_level" name="pr_itemproductid" id="preq_itemproductid" > 

                                                    <option value="-1 ">Select product</option>
                                                    <?php
                                                 foreach($prod as $item)
      
                                                 if($item->product_id ==$product1->product_id)   
                                                        echo "<option value='$item->product_id' selected='selected'>$item->product_name</option>";
                                                  else
                                                    echo"<option value='$item->product_id'> $item->product_name</option>";
                                                    ?>


                                                </select>

                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Price</label>
                                                <input type="text" class="form-control price_add" placeholder="0.00" name="pr_itemprice" id="preq_itemprice"  >
                                                <div style="color: red; display: none" class="msg3">Digits only</div>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Qty</label>
                                                <!-- <input type="number" class="form-control" placeholder="" name="pr_itemqty" id="preq_itemqty" onkeyup="cal_prd_total()" > -->
                                                <input type="text" class="form-control qty_add" placeholder="0.00" name="pr_itemqty" id="preq_itemqty" >
                                                <div style="color: red; display: none" class="msg1">Digits only</div>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Discount</label>
                                                <input type="text" class="form-control disc_add" placeholder="0.00" name="pr_itemdiscount" Id="preq_itemdiscount" value='0.00'>
                                                <div style="color: red; display: none" class="msg2">Digits only</div>

                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Total</label>
                                                <input type="text" class="form-control totaladd" placeholder="0.00" name="pr_itemfinalprice" id="preq_itemfinalprice" disabled>
                                            </div>



                                        </div>

                                        <button type="button" class="btn btn-primary" name="addprbtn" id="add_prbtn">ADD</button>
                                        <button type="button" class="btn btn-inverse reset">CLEAR</button>
                                        <span class='error_fields'><label class="label label-md label-danger" >Please fill all the fields</label></span>

                                        <br>
                                        <br>


                                        <div class="table-responsive">

                                            <table class="table table-striped table-bordered" id="example-2">
                                                <thead class='table-primary'>
                                                    <tr>
                                                
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Discount</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">

                                                <?php if(isset($_GET['edit_pr'])):?>
                                                            <?php foreach($purchase_req_item as $item):  ?>
                                                        <tr>   
                                                            <td class='table-edit-view'><span class=''><?= $item->product_name?></span>
                                                                <input class='form-control input-sm  '   type='hidden' name='Product[]' readonly value='<?= $item->pr_item_productid ?>'>
                                                                <input class='form-control input-sm productid '   type='hidden' name='pr_item_id[]'readonly  value='<?= $item->pr_item_id ?>'>
                                                          
                                                            </td>
                                  
                                                            <td class='table-edit-view'><span class='tabledit-span'><?= $item->pr_item_price ?></span>
                                                                <input class='input-borderless input-sm row_data price'   type='text' name='pr_item_price[]' readonly value='<?= $item->pr_item_price ?>'> <div style="color: red; display: none" class="msg2">Digits only</div>
                                                            </td>
                                                            <td class='table-edit-view'><span class='tabledit-span'><?= $item->pr_item_qty ?></span>
                                                                <input class='input-borderless input-sm row_data quantity'   type='text'  name='pr_item_qty[]'readonly  value='<?=$item->pr_item_qty ?>'><div style="color: red; display: none" class="msg1">Digits only</div>
                                                                <input class='form-control input-sm subtotal'   type='hidden'  value='<?=$item->pr_item_subtotal ?>'>
                                                            </td>

                                                            <td class='table-edit-view'><span class='tabledit-span'><?= $item->pr_item_discount ?></span>
                                                                <input class='input-borderless input-sm row_data discount'   type='text' name='pr_item_discount[]' readonly value='<?= $item->pr_item_discount ?>'> <div style="color: red; display: none" class="msg3">Digits only</div>
                                                            </td>
                                                            <td class='table-edit-view'><span class='tabledit-span'><?=$item->pr_item_finalprice ?></span>
                                                                <input class='input-borderless input-sm row_data total'   type='text' disabled="true" readonly value='<?=$item->pr_item_finalprice ?>'>
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
<script>

// $(document).on('click', '.deletedata', function(event) {
//     var tbl_row = $(this).closest('tr');
//     console.log ("deletedata");

//     var deleteitemid= tbl_row.find(".productid").val();
//     console.log (deleteitemid);

//     var confirm_msg=confirm("Are you sure you want delete the item?");
//         if(confirm_msg==true){
//             //ajax request
//             $.ajax({
//                 url:'../purchase_requisition/handle_delete_pr.php',
//                 type:'POST',
//                 data:{id:deleteitemid},
//                 success:function(response){
//                     if(response==true){
//                         console.log('Item deleted successfully');
//                         tbl_row.css('background','tomato');
//                         tbl_row.fadeOut(800,function(){
//                             tbl_row.remove();
//                             cal_totquantity();
//                             cal_totprice();
//                             cal_totdiscount();
//                             final_total();
//                         });
//                     }else{
//                         console.log('Invalid ID.');
//                     }
//                 }
                 
//             });
//         }
   

// });
</script>

<script type="text/javascript" src="../javascript/purchase.js"></script>
<script type="text/javascript" src="../javascript/purchase/purchase_req.js"></script>
<script type="text/javascript" src="../javascript/editabletable.js"></script>