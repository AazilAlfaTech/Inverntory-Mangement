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
//------------------------------------------------------------------------------
include_once "../sales_quotation/sales_quotation2.php";
$sales_quotation3=new sales_quotation2();
$sales_quotation5=new sales_quotation2();


//------------------------------------------------------------------------------

include_once "../product/product.php";
$product1 = new product(); 

//product dropdown
$productlist=$product1->getall_product2();


//customer dropdown
$result_customer=$customer2->get_all_customer();

//insert salesorder
if(isset($_POST['sodate'])){
    $sales_order2->salesorder_customer=$_POST['socustomer'];
    $sales_order2->salesorder_date=$_POST['sodate'];
    $sales_order2->salesorder_quotid=$_POST['soquoteid'];
    $sales_order2->salesorder_ref=$sales_order2->so_code($_POST['sodate']);
    $salesorderid=$sales_order2->insert_sales_order();
    $sales_orderitem2->insert_sales_orderitem($salesorderid);
    echo $_POST['socustomer'];

}

//getall sales quotation
                    //$result_salesquote=$sales_quotation2->get_all_sales_quotation();
  $result_salesquote=$sales_quotation3->get_all_sales_quotation();


  if(isset($_GET['view'])){
    $sales_quotation3=$sales_quotation3->get_salesquotation_by_id($_GET['view']);
    $resultitem=$sales_quotation5->get_all_sales_quotationitem($_GET['view']);
    //print_r( $resultitem);

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
                                    <h5>Add New Salaes Order</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

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
                                                <select class="js-example-basic-single col-sm-12" name="socustomer" id="so_customer">
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
                                                <input class="form-control" type="date" value='<?php echo date('Y-m-d');?>' name="sodate" id="so_date">
                                            </div>
                                        </div>

                                        <?php endif ;   ?>

                                        <hr>
                                        <div class="form-group row productform">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Product</label>
                                                <select class="js-example-basic-single col-sm-12" name="soitemproductid" id="soitem_productid">
                                                  
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
                                                <input type="text" class="form-control pricetext " placeholder="" name="soitemprice" id="soitem_price">
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Qty</label>
                                                <input type="text" class="form-control quantitytext" placeholder="" name="soitemqty" id="soitem_qty">
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Discount</label>
                                                <input type="text" class="form-control discounttext" placeholder="" name="soitemdiscount" id="soitem_discount">
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Total</label>
                                                <input type="text" class="form-control totaltext" placeholder="" name="sofinalprice" id="sofinal_price" disabled>
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
                                                                <td class='table-edit-view'><span class=''><?= $item->sq_item_productname?></span>
                                                                    <input class='form-control input-sm  '   type='hidden' name='Product[]' value='<?= $item->sq_item_productid ?>'>
                                                                    
                                                                </td>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?= $item->sq_item_qty ?></span>
                                                                    <input class=' input-borderless  input-sm row_data quantity'   type='text' readonly  name='Quantity[]' value='<?=$item->sq_item_qty ?>'><div style="color: red; display: none" class="msg1">Digits only</div>
                                                                </td>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?= $item->sq_item_price ?></span>
                                                                    <input class=' input-borderless input-sm row_data price'   type='text' name='Price[]' readonly  value='<?= $item->sq_item_price ?>'> <div style="color: red; display: none" class="msg2">Digits only</div>
                                                                    <input class='form-control input-sm subtotal'   type='text'  value='<?=$item->sq_item_subtotal?>'>
                                                                </td>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?= $item->sq_item_discount ?></span>
                                                                    <input class=' input-borderless input-sm row_data discount'   type='text' name='Discount[]' readonly  value='<?= $item->sq_item_discount ?>'> <div style="color: red; display: none" class="msg3">Digits only</div>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?=$item->sq_item_finaltotal ?></span>
                                                                    <input class=' input-borderless input-sm  total'   type='text' readonly value='<?=$item->sq_item_finaltotal ?>'>
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

function edit_purchorder(SQ_id)
    {
        window.location.href="add_new_sales_order.php?view="+SQ_id;
    }

$(".productform").on("keyup", ".quantitytext, .pricetext, .discounttext", function() {
            console.log("hhiii");
            var row = $(this).closest(" ");
           
            var quants = row.find(".quantity").val();
            var prc = row.find(".pricetext").val();
           // var tot = quants * prc;
           var disc= row.find(".discounttext").val();
                        var subtot= parseFloat(quants * prc * disc/100);
                        var tot = parseFloat(quants * prc - subtot);
                        console.log(tot);
            row.find(".totaltext").attr("value",tot);
        });

$(".add").click(function(){
    console.log("addrows");
    addrows();
    clearrows();
    cal_totquantity();
    cal_totprice();
    cal_totdiscount();
    final_total();
});

$(".reset").click(function(){
    clearrows();
});

function addrows(){

    //getvalues
    productid=$("#soitem_productid option:selected").val();
    productname=$("#soitem_productid option:selected").text();
    productprice=$("#soitem_price").val();
    productquantity=$("#soitem_qty").val();
    productdiscount=$("#soitem_discount").val();
    producttotal=$("#sofinal_price").val();
    productsubtotal=parseFloat(productprice*productquantity);
    console.log(productid);


    $(".itembody").append("<tr>\
        <td class='table-edit-view'>"+productname+"\
            <input class='form-control input-sm productid ' name='Product[]'   type='hidden' name='' value='"+productid+"'>\
        </td>\
        <td class='table-edit-view'>\
            <input class='input-borderless input-sm row_data quantity'   type='text' readonly  name='Quantity[]' value='"+productquantity+"'><div style='color: red; display: none' class='msg1'>Digits only</div>\
        </td>\
        <td class='table-edit-view'>\
            <input class='input-borderless input-sm row_data price'   type='text' readonly name='Price[]' value='"+productprice+"'> <div style='color:red; display: none' class='msg2'>Digits only</div>\
            <input class='form-control input-sm subtotal'   type='text'  value='"+productsubtotal+"'>\
            </td>\
        <td class='table-edit-view'>\
            <input class='input-borderless input-sm row_data discount'   type='text' readonly name='Discount[]' value='"+productdiscount+"'> <div style='color: red; display: none' class='msg3'>Digits only</div>\
        </td>\
        <td class='table-edit-view'>\
            <input class='input-borderless input-sm row_data total'   type='text' readonly value='"+producttotal+"'>\
        </td>\
        <td>\
            <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>\
            <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>\
            <span class='btn_cancel'><button class='btn btn-mini btn-danger ' type='button'>Cancel</button></span>\
            <span class='btn_delete'><button  class='btn btn-mini btn-danger btn_deleterow' type='button'>Delete</button></span>\
        </td>\
</tr>\
    ");

    $(".btn_cancel").hide();
    $(".btn_save").hide();
}
function clearrows(){
    $("#soitem_productid option:selected").text("");
    $("#soitem_price").val("");
    $("#soitem_qty").val("");
    $("#soitem_discount").val("");
    $("#sofinal_price").val("");
}

</script>
<script type="text/javascript" src="../javascript/editabletable.js"></script>