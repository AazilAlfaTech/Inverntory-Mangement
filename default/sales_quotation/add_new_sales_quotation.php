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
        $sales_quot1->salesquot_customer=$_POST["salesquotcustomer"];
        $sales_quot1->salesquot_date=$_POST["salesquotdate"];
        $sales_quot1->salesquot_ref=$sales_quot1->salesquot_code($_POST["salesquotdate"]);

       $pr_id=$sales_quot1->insert_sales_quotation();
        // print_r($a);
        $sales_quot_item1->insert_sales_quotationitem($pr_id);
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
                                                <select class="js-example-basic-single col-sm-12" name="salesquotcustomer" id="sq_customer">
                                                    <option value=" ">Select customer</option>

                                                    <?php
                                                        foreach($res_cust1 as $item)
                                                        
                                                        echo"<option value='$item->customer_id'>$item->customer_name</option>";
                                                    ?>
                                                </select>

                                            </div>



                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="date" name="salesquotdate" id="sq_date">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Product</label>
                                                <select class="js-example-basic-single col-sm-12" name="sqitem_productid" id="sq_itemproductid">
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
                                                <input type="text" class="form-control" placeholder="" name="sqitem_price" id="sq_itemprice" onkeyup="cal_prd_total()">
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Qty</label>
                                                <input type="text" class="form-control" placeholder="" name="sqitem_qty" id="sq_itemqty" onkeyup="cal_prd_total()">
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Discount</label>
                                                <input type="text" class="form-control" placeholder="" name="sqitem_discount" id="sq_itemdiscount" onkeyup="cal_prd_total()">
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Total</label>
                                                <input type="text" class="form-control" placeholder="" name="sqitem_finalprice" id="sq_itemfinalprice" disabled>
                                            </div>

                                        </div>

                                        <button type="button" class="btn btn-primary" name="addprbtn" id="add_prbtn">ADD</button>
                                        <button type="button" class="btn btn-inverse reset">CLEAR</button>

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
                                                   
                                                 
                                                </tbody>
                                            </table>
                                             <!-- final values-->
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
<!-- <script type="text/javascript" src="../javascript/editabletable.js"></script> -->
<script>
    
    function cal_prd_total()
    {

        var pprice = $("#sq_itemprice").val();
        var pqty =$("#sq_itemqty").val();
        var pdis = $("#sq_itemdiscount").val(); 


        var tot = parseFloat(pprice)*parseFloat(pqty)*parseFloat(pdis)/100
        ftot =  parseFloat(pprice)*parseFloat(pqty) - parseFloat(tot)

        $("#sq_itemfinalprice").val(ftot);

    }

    // ..........................Click the add button...............................................................
    $("#add_prbtn").click(function()
    {
        add_products();
        clear_products();
        cal_totquantity();
        cal_totprice();
        cal_totdiscount();
        final_total();
    });

    $(".reset").click(function()
    {
        clear_products();
    });

    // ................................function to append the products..............................
    function add_products()
    {
        var sq_prod=$("#sq_itemproductid option:selected").val();
        var sq_prod_name=$("#sq_itemproductid option:selected").text(); //dropdown
        var sq_price=$("#sq_itemprice").val();
        var sq_qty=$("#sq_itemqty").val();
        var sq_dis=$("#sq_itemdiscount").val();
        var sq_fprice=$("#sq_itemfinalprice").val();
        sq_subtotal=parseFloat(sq_price * sq_qty)
        
         $("#tbody").append("<tr>\
            <td class='table-edit-view' >"+ sq_prod_name +"\
                <input  class='form-control input-sm productid  ' type='hidden' name='sq_item_productid[]' value='"+sq_prod+"'>\
            </td>\
            <td class='table-edit-view'>\
                <input class='input-borderless input-sm row_data price'  type='text' readonly name='sq_item_price[]' value='"+sq_price+"'> <div style='color: red; display: none' class='msg2'>'Digits only'</div> \
                <input class='form-control input-sm subtotal'   type='hidden'  value='"+sq_subtotal+"'>\
            </td>\
            <td class='table-edit-view'>\
                <input class='input-borderless input-sm row_data quantity' type='text' readonly name='sq_item_qty[]' value='"+sq_qty+"'> <div style='color: red; display: none' class='msg1'>'Digits only'</div>\
            </td>\
            <td class='table-edit-view'>\
                <input class='input-borderless input-sm row_data discount' type='text' readonly name='sq_item_discount[]' value='"+sq_dis+"'><div style='color: red; display: none' class='msg3'>'Digits only'</div>\
            </td>\
            <td class='table-edit-view'>\
                <input class='input-borderless input-sm row_data total'   type='text' readonly value='"+sq_fprice+"'>\
            </td>\
            <td>\
                <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>\
                <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>\
                <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Cancel</button></span>\
            </td>\
             </tr>");
         
 
         $(".btn_save").hide();
        $(".btn_cancel").hide();

    }

    // function to clear the products
    
    function clear_products()
    {
        $("#sq_itemproductid option:selected").text(""); //dropdown
        $("#sq_itemprice").val("");
        $("#sq_itemqty").val("");
        $("#sq_itemdiscount").val("");
        $("#sq_itemfinalprice").val("");
    }

</script>
<script type="text/javascript" src="../javascript/editabletable.js"></script>
