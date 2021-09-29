<?php

include_once "../sales_order/sales_order.php";
$sales_order2=new sales_order();
include_once "../sales_order/sales_order_item.php";
$sales_orderitem2=new sales_orderitem();
include_once "../customer/customer.php";
$customer2=new customer();
include_once "../sales_quotation/sales_quatation.php";
$sales_quotation2=new sales_quotation();
include_once "../sales_quotation/sales_quatation_item.php";
$sales_quotationitem2=new sales_quotationitem();

include_once "../product/product.php";
$product1 = new product(); 

//product dropdown
$productlist=$product1->getall_product2();


//customer dropdown
$result_customer=$customer2->get_all_customer();

//insert salesorder
$error_msg="";
if(isset($_POST['sodate'])){

    if(!isset($_POST['Quantity'])){
        $error_msg="Products are not added to the order list";
        echo "Products are not added to the order list";
    }else{
    $sales_order2->salesorder_customer=$_POST['socustomer'];
    $sales_order2->salesorder_date=$_POST['sodate'];
    $sales_order2->salesorder_quotid=$_POST['soquoteid'];
    $sales_order2->salesorder_ref=$sales_order2->so_code($_POST['sodate']);
    $salesorderid=$sales_order2->insert_sales_order();
   
    $sales_orderitem2->insert_sales_orderitem($salesorderid);
    $sales_quotation2->update_salequote_status($_POST['soquoteid']);
    $sales_quotationitem2->update_sqitem($_POST['soquoteid']);
   header("location:../sales_order/manage_sales_order.php");
    }
}

//getall sales quotation
            
  $result_salesquote=$sales_quotation2->get_all_sales_quotation();


  if(isset($_GET['view'])){
    $sales_quotation3=$sales_quotation2->get_salesquotation_by_id($_GET['view']);
    $resultitem=$sales_quotationitem2->get_all_item_bysquotid($_GET['view']);
   
  
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
                                    <h4>Add New Sales Order</h4>

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
                                    <h5>Select Sales Quotation</h5>
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
                                                    foreach($result_salesquote as $item)
                                                    {echo"
                                                        <tr>
                                                            <td id='gr_id_td'>$item->salesquot_id</td>
                                                            <td>$item->salesquot_ref</td>
                                                            <td>$item->salesquot_date</td>
                                                            <td>$item->salesquot_customer_name</td>

                                                            <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                            <button type='button' onclick='edit_purchorder($item->salesquot_id)'  class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button>
                                                            
                                                            
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
                                    <h5>Add New Sales Order</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">
                                    <?php
                                           
                                                echo" <div class='alert alert-success background-success'>
                                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                    <i class='icofont icofont-close-line-circled text-white'></i>
                                                </button>
                                                <strong> <?= $error_msg ?> </strong> 
                                            </div>";
                                           
                                    ?>
                                

                                    <form  action="add_new_sales_order.php"  method="POST">
                                        

                                        <?php if(isset($_GET['view'])):?>
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <label for="" class="col-form-label">Customer</label>
                                                    <input type="text" class="form-control" readonly  value="<?=$sales_quotation3->salesquot_customer_name?>">
                                                   
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="" class="col-form-label">Referenec NO</label>
                                                    <input type="text" class="form-control" readonly value="<?=$sales_quotation3->salesquot_ref ?>">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class=" col-form-label">Date</label>
                                                    <input class="form-control" type="date" value='<?php echo date('Y-m-d');?>' name="sodate" id="so_date">
                                                </div>
                                                <input type="hidden" class="form-control" name='soquoteid' readonly value="<?=$sales_quotation3->salesquot_id ?>">
                                                <input type="hidden" class="form-control" name='socustomer' readonly value="<?=$sales_quotation3->salesquot_customer ?>">
                                            </div>
                                            
                                        <?php else: ?>
                                            <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Select Customer</label>
                                                <select class="js-example-basic-single col-sm-12" name="socustomer" id="so_customer" required>
                                                    <option value="">Select customer</option>
                                                    <?php
                                                    foreach($result_customer as $item){
                                                        echo"<option value='$item->customer_id'>$item->customer_name</option>";
                                                        }   
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="date" value='<?php echo date('Y-m-d');?>' name="sodate" id="txtDate" required>
                                            </div>
                                        </div>

                                        <?php endif ;   ?>

                                        <hr>
                                        <div class="form-group row productform">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Product</label>
                                                <select class="js-example-basic-single col-sm-12 product_level" name="soitemproductid" onchange="get_qty()" id="soitem_productid">
                                                  
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
                                                <select class="form-control pricelevel" name="soitemprice" id="soitem_price">
                                                    <option value=""> Pricelevel</option>
                                                </select>
                                                
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Qty</label>
                                                <input type="text" class="form-control qty_add " placeholder="" name="soitemqty" id="soitem_qty">
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

                                        <button type="button" class="btn btn-primary add">ADD</button>
                                        <button type="button" class="btn btn-inverse reset">CLEAR</button>

                                        <br>
                                        <br>


                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <!-- <th>#</th> -->
                                                        <th>Product</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Discount</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="itembody">
                                                    <?php if(isset($_GET['view'])):?>
                                                        <?php foreach($resultitem as $item):  ?>
                                                            <tr>    
                                                                <td class='table-edit-view'><span class=''><?= $item->product_name?></span>
                                                                    <input class='form-control input-sm productid  '   type='hidden' name='Product[]' value='<?= $item->sq_item_productid ?>'>
                                                                   
                                                                    
                                                                </td>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?= $item->sq_item_qty ?></span>
                                                                    <input class=' input-borderless  input-sm row_data quantity'   type='text' readonly  name='Quantity[]' value='<?=$item->sq_item_qty ?>'><div style="color: red; display: none" class="msg1">Digits only</div>
                                                                </td>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?= $item->sq_item_price ?></span>
                                                                    <!-- <input class=' input-borderless input-sm row_data price'   type='text' name='Price[]' readonly  value='<?= $item->sq_item_price ?>'> <div style="color: red; display: none" class="msg2">Digits only</div> -->
                                                                    <input class='form-control input-sm subtotal'   type='hidden'  value='<?=$item->sq_item_subtotal?>'>
                                                                    <select name="Price[]" id="productprice" class="input-borderless price">
                                                                        <option value="<?=$item->sq_item_price?>"><?=$item->sq_item_price?></option>
                                                                    </select>
                                                                </td>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?= $item->sq_item_discount ?></span>
                                                                    <input class=' input-borderless input-sm row_data discount'   type='text' name='Discount[]' readonly  value='<?= $item->sq_item_discount ?>'> <div style="color: red; display: none" class="msg3">Digits only</div>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?=$item->sq_item_finalprice ?></span>
                                                                    <input class=' input-borderless input-sm  total'   type='text' readonly value='<?=$item->sq_item_finalprice ?>'>
                                                                </td>
                                                                <td>
                                                                <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>
                                                                <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>
                                                                <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Reset</button></span>
                                                                <span class='btn_delete'><button  class='btn btn-mini btn-danger btn_deleterow' type='button'>Delete</button></span>
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
                                                        <td ><input type="text" id="total_quan" name="totqty" class="form-control form-control-sm" ></td>
                                                    </tr>
                                                    <tr>
                                                        <th> Sub Total :</th>
                                                        <td ><input type="text" id="total_price" name="subtot" data-a-sign="Rs. " class=" form-control form-control-sm autonumber"></td>
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
<script type="text/javascript" src="../javascript/sales/sales_order.js"></script>
<script type="text/javascript" src="../javascript/editabletable.js"></script>
