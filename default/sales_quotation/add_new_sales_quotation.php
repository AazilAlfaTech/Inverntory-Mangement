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

 
    if(isset($_POST["salesquotcustomer"]))
    
    {
        if(!isset($_POST['sq_item_productid'])){
            echo "No items";
            echo"<script>invalidMessage()</script>";

        }else{

        
        $sales_quot1->salesquot_customer=$_POST["salesquotcustomer"];
        $sales_quot1->salesquot_date=$_POST["salesquotdate"];
        $sales_quot1->salesquot_ref=$sales_quot1->salesquot_code($_POST["salesquotdate"]);

       $pr_id=$sales_quot1->insert_sales_quotation();
       $sales_quot_item1->insert_sales_quotationitem($pr_id);
      // echo "<script type='text/javascript'>alert('Successful - Record Updated!'); window.location.href = '../sales_quotation/manage_sales_quotation.php';</script>";

       header("location:../sales_quotation/manage_sales_quotation.php");
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
                                    <h4>Add New Sales Quotation</h4>

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
                                    <h5>Add New Sales Quotation</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action="add_new_sales_quotation.php" method="POST">




                                        <div class="form-group row">

                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Select Customer</label>
                                                <select class="js-example-basic-single col-sm-12" name="salesquotcustomer"  id="sq_customer" required>
                                                <option value="">-Select Customer-</option>

                                                    <?php
                                                        foreach($res_cust1 as $item)
                                                        
                                                        echo"<option value='$item->customer_id'>$item->customer_name</option>";
                                                    ?>
                                                </select>

                                            </div>



                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="date" value="<?php echo date('Y-m-d');?>" name="salesquotdate" id="txtDate"  required>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group  productform row">
                                    
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Product</label>
                                                <select class="js-example-basic-single col-sm-12 product_level" name="sqitem_productid" id="sq_itemproductid">
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
                                                
                                                <select class="form-control pricelevel" name="soitemprice" id="sq_itemprice" >
                                                    <option value=""> Pricelevel</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Qty</label>
                                                <input type="text" class="form-control qty_add" placeholder="0" name="sqitem_qty" id="sq_itemqty">
                                                <div style="color: red; display: none" class="msg1">Digits only</div>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Discount</label>
                                                <input type="text" class="form-control disc_add" placeholder="0.00" name="sqitem_discount" id="sq_itemdiscount" >
                                                <div style="color: red; display: none" class="msg2">Digits only</div>
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Total</label>
                                                <input type="text" class="form-control totaladd" placeholder="0.00" name="sqitem_finalprice" id="sq_itemfinalprice" disabled>
                                        
                                            </div>
                                        </div>
                                            
                                        <button type="button" class="btn btn-primary" name="addprbtn" id="add_prbtn">ADD</button>
                                        <button type="button" class="btn btn-inverse reset">CLEAR</button>
                                        <span class='error_fields'><div class="alert alert-success background-success p-1" style="width:180px;height:30px">Please fill all the fields</div></span>

                                        <br>
                                        <br>

                                        <div class="itemalert">
                                            <div class="alert alert-success background-success">
                                                No items are selected!
                                            </div>
                                        </div>


                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="example-2">
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
                                                   
                                                 
                                                </tbody>
                                            </table>
                                             <!-- final values-->
                                             <table class="table table-responsive invoice-table invoice-total">
                                                        <tbody class="pricelist">
                                                            <tr>
                                                                <th> Total Quantity :</th>
                                                                <td ><input type="text" id="total_quan" name="totqty" class="form-control form-control-sm" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <th> Sub Total :</th>
                                                                <td ><input type="text" id="total_price" name="subtot" data-a-sign="Rs. " class=" form-control form-control-sm autonumber" readonly></td>
                                                            </tr>
                                                            <!-- <tr>
                                                                <th> Total Discount :</th>
                                                                <td ><input type="text" id="total_discount" name="discount tot" class="form-control form-control-sm  autonumber" data-a-sign="Rs. " readonly></td>
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
                                        <div class="d-flex flex-row-reverse">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
<script type="text/javascript" src="../javascript/editabletable.js"></script>
