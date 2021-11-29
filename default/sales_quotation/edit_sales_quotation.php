<?php
    include_once "../customer/customer.php";
    $cust1=new customer();
    $res_cust1=$cust1->get_all_customer();
    // print_r($res);

    include_once "../product/product.php";
    $product1=new product();
    $prod=$product1->getall_product2();

    include_once "sales_quatation.php";
    $sales_quot1=new sales_quotation();

    include_once "sales_quatation_item.php";
    $sales_quot_item1=new sales_quotationitem();

    
    if(isset($_GET["edit_sq"]))
    {
        $sales_quot1=$sales_quot1->get_salesquotation_by_id($_GET["edit_sq"]);
        $sales_quot_item1=$sales_quot_item1->get_all_item_bysquotid($_GET["edit_sq"]);

    }
    elseif(isset($_POST["save"]))
    {
        $sales_quot1->salesquot_date=$_POST["salesquotdate"];
        $sales_quot1->edit_sales_quotation($_POST["sq_id"]);
        $sales_quot_item1->insert_sales_quotationitem($_POST["sq_id"]);
        $sales_quot_item1->edit_sq_item();
        header("location:../sales_quotation/manage_sales_quotation.php?success_edit=1"); 
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
                                    <h4>Edit Sales Quotation</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="../dashboard//dashboard.php"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="../sales_quotation/manage_sales_quotation.php">SalesQuotation</a> </li>
                                    <li class="breadcrumb-item"><a href="../sales_order/edit_sales_quotation.php">Edit</a> </li>
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
                                    <h5>Edit Sales Quotation</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action="edit_sales_quotation.php" method="POST"  onsubmit="submit1()">

                                        <div class="form-group row">

                                            
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Customer</label>
                                                <input class="form-control" type="text" readonly='true' value="<?=$sales_quot1->salesquot_customer_name?>">
                                            </div>

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Reference Code</label>
                                                <input class="form-control" type="text" name="salesquot_ref" id="" value="<?=$sales_quot1->salesquot_ref?>" readonly>

                                                <input class="form-control" type="hidden" name="sq_id" id="" value="<?=$sales_quot1->salesquot_id ?>" readonly hidden>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="date" name="salesquotdate" id="txtDate" value="<?=$sales_quot1->salesquot_date?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group productform row">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Product</label>
                                                <select class="js-example-basic-single col-sm-12 product_level" name="sqitem_productid" id="sq_itemproductid">
                                                <option value="-1 ">Select product</option>
                                                    <?php
                                                        foreach($prod as $item)
            
                                                        if($item->product_id ==$product1->product_id)   
                                                                echo "<option value='$item->product_id' >$item->product_name</option>";
                                                        else
                                                        echo"<option value='$item->product_id'> $item->product_name</option>";
                                                     ?>
                                                    

                                                </select>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Price</label>
                                                
                                                <select class="form-control pricelevel" id="sq_itemprice" >
                                                    <option value=""> Pricelevel</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Qty</label>
                                                <input type="text" class="form-control qty_add " placeholder="0"  id="sq_itemqty" >
                                                <div style="color: red; display: none" class="msg1">Digits only</div>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Discount</label>
                                                <input type="text" class="form-control disc_add" placeholder="0.00"  id="sq_itemdiscount"  >
                                                <div style="color: red; display: none" class="msg2">Digits only</div>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Total</label>
                                                <input type="text" class="form-control totaladd" placeholder="0.00"  id="sq_itemfinalprice" disabled>
                                            </div>

                                        </div>

                                        <button type="button" class="btn btn-primary " id="add_prbtn"  >ADD</button>
                                        <button class="btn btn-inverse reset" type="button" >CLEAR</button>
                                        <span class='error_fields'><label class="label label-md label-danger" >Please fill all the fields</label></span>
                                        <br>
                                        <br>


                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="mytable">
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
                                                <tbody id="tbody">
                                                    <?php if(isset($_GET['edit_sq'])):?>
                                                            <?php foreach($sales_quot_item1 as $item):  ?>
                                                        <tr>   
                                                        

                
                                                        <td class='table-edit-view'><span class=''><?= $item->product_name?></span>
                                                                    <input class='form-control input-sm  '   type='hidden' name='' value='<?= $item->sq_item_productid ?>'>
                                                                    <input class='form-control input-sm  productid'   type='hidden' name='sq_item_id_edit[]' value='<?= $item->sq_item_id ?>'>
                                                          
                                                                    </td>
                                  
                                                                
                                                                    <td class='table-edit-view'><span class='tabledit-span'><?= $item->sq_item_qty?></span>
                                                                        <input class='input-borderless input-sm row_data quantity'   type='text'  name='sq_item_qty_edit[]' readonly value='<?=$item->sq_item_qty ?>'><div style="color: red; display: none" class="msg1">Digits only</div>
                                                                    </td>
                                                                    <td class='table-edit-view'><span class='tabledit-span'><?=  $item->sq_item_price ?></span>
                                                                        
                                                                        <select name='sq_item_price_edit[]' class="input-borderless price productprice">
                                                                        <option value="<?=$item->sq_item_price?>"><?=$item->sq_item_price?></option>
                                                                        </select>
                                                                        
                                                                        <input class='form-control input-sm subtotal'   type='hidden'  value='<?=$item->sq_item_subtotal?>'>


                                                                    </td>
                                                                    <td class='table-edit-view'><span class='tabledit-span'><?= $item->sq_item_discount ?></span>
                                                                        <input class='input-borderless input-sm row_data discount'   type='text' name='sq_item_discount_edit[]' readonly value='<?= $item->sq_item_discount ?>'> <div style="color: red; display: none" class="msg3">Digits only</div>

                                                                    <td class='table-edit-view'><span class='tabledit-span'><?=$item->sq_item_finalprice?></span>
                                                                        <input class='input-borderless input-sm row_data total'   type='text' disabled="true" readonly value='<?=$item->sq_item_finalprice ?>'>
                                                                    
                                                                    </td>


                                                                
                                                                
                                                                <td>
                                                                <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>
                                                                <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>
                                                                <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Cancel</button></span>
                                                                <span class='deletedata1'><button  class='btn btn-mini btn-danger ' type='button'>Delete</button></span>
                                                            </td>
        
       
                                                                 
                                                        </tr>

                                                            <?php endforeach ;  ?>
                                                        <?php endif ;   ?>
                                             
                                                 
                                                </tbody>
                                            </table>
                                             <!-- final values-->
                                             <table class="table table-responsive invoice-table invoice-total">
                                                        <tbody class="pricelist">
                                                            <tr>
                                                                <th> Total Quantity :</th>
                                                                <td ><input type="text" id="total_quan" class="form-control form-control-sm" readonly ></td>
                                                            </tr>
                                                            <tr>
                                                                <th> Sub Total :</th>
                                                                <td ><input type="text" id="total_price" data-a-sign="Rs. " class=" form-control form-control-sm autonumber" readonly></td>
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

<script type="text/javascript" src="../javascript/sales.js"></script>
<script type="text/javascript" src="../javascript/sales/sales_quote.js"></script>





 <script>

    $(document).on('click', '.deletedata1', function(event) {
    var tbl_row = $(this).closest('tr');
    console.log ("deletedata");

    var deleteitemid= tbl_row.find(".productid").val();
    console.log (deleteitemid);

    var confirm_msg=confirm("Are you sure you want delete the item?");
        if(confirm_msg==true){
            //ajax request
            $.ajax({
                url:'../sales_quotation/handle_sqdelete.php',
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
