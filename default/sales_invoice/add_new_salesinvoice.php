<?php

include_once "../customer/customer.php";
$customer1 = new customer();
include_once "../Sales_order/sales_order.php";
$sales_order1 = new sales_order();
include_once "../sales_invoice/sales_invoice.php";
$sales_invoice1 = new sales_invoice();
include_once "../sales_invoice/sales_invoice_item.php";
$sales_invoice_item1 = new sales_invoice_item();
$all_cus = $customer1->get_all_customer();
include_once "../location/location.php";
$loc = new location();
$res_loc = $loc->get_all_location();
include_once "../payment/payment.php";
$pay=new payment();


include_once "../product/product.php";
$product1 = new product();

//product dropdown
$productlist = $product1->getall_product2();


$error_msg="";
if (isset($_POST["sinvcustomer"])) {

    if(!isset($_POST["Orderid"]))
    {
        $error_msg=" <div class='alert alert-success background-success'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='icofont icofont-close-line-circled text-white'></i>
        </button>
        <strong>No items are selected  </strong> 
        </div>";
    }else{
    //variables for class sales invoice
    $sales_invoice1->salesinvoice_customer = $_POST["sinvcustomer"];
    $sales_invoice1->salesinvoice_paymethod = $_POST["sinvpaymethod"];
    $sales_invoice1->salesinvoice_date = $_POST["sinvdate"];
    $sales_invoice1->salesinvoice_total=$_POST["sinvtotal1"];
    $sales_invoice1->salesinvoice_loc=$_POST["sinvloc"];
    $sales_invoice1->salesinvoice_ref = $sales_invoice1->si_code($_POST["sinvdate"]);
    //variables for class payment
    $pay->pay_method=$_POST["paymethod"];
    $pay->pay_dt=$_POST["sinvdate"];
    $pay->pay_amount=$_POST["payamount"];
    // $pay->creditcard_cardnum=$_POST['creditcardno'];
    // $pay->cheque_num=$_POST['chequeno'];
    //echo $_POST['creditcardno'];

   
    $si_id = $sales_invoice1->insert_sales_invoice();//insert sales invoice data
    $sales_invoice_item1->insert_sales_invoice_item1($si_id);//insert sales invoice item data
    $paymentid=$pay->insert_payment($si_id,$_POST['creditcardno'],$_POST['chequeno'],$_POST['creditcardno']);//insert payment details to payment table
    $sales_invoice1->update_paidamount($_POST["payamount"], $si_id);//update paid amount in sales invoice table

    header("location:../sales_invoice/manage_sales_invoice.php?success=1");
  
    }
  

}

// ------------------------------------------------------------------------------------------------------------------------------------

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
                                    <h4>Add New Sales Invoice</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="../sales_invoice/manage_sales_invoice.php">SalesInvoic</a> </li>
                                    <li class="breadcrumb-item"><a href="../sales_invoice/add_new_salesinvoice.php">Add</a> </li>
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
                                        <h5>Add New Sales Invoice</h5>

                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                <li><i class="feather icon-minus minimize-card"></i></li>

                                            </ul>
                                        </div>
                                    </div>
                                <form action="add_new_salesinvoice.php" method="POST">
                                    <div class="card-block">
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Location</label>
                                                    <select class="js-example-basic-single col-sm-12 dispatchloc " name="sinvloc" >
                                                    <option value="">Select Location</option>
                                                        <?php
                                                            foreach($res_loc as $item)
                                                        
                                                            echo"<option value='$item->location_id '>$item->location_name</option>";
                                                        ?>
                                                    </select>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Customer</label>
                                                    <select class="js-example-basic-single col-sm-12 selectcustomer" name="sinvcustomer" id="sinv_customer" required>
                                                        <option value="" disable selected>Select Customer</option>
                                                        <?php
                                                        foreach ($all_cus as $item) {
                                                            echo "<option value='$item->customer_id'> $item->customer_name</option>";
                                                        }

                                                        ?>
                                                    </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" id="txtDate" type="date" name="sinvdate" value="<?php echo date('Y-m-d'); ?>" required>
                                            </div>

                                        </div>
                                        <hr class="new4">
                                       
                                                <div class="card-header">
                                                    <h5>Add New Sales Invoice</h5>

                                                    <div class="card-header-right">
                                                        <ul class="list-unstyled card-option">
                                                            <li><i class="feather icon-maximize full-card"></i></li>
                                                            <li><i class="feather icon-minus minimize-card"></i></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                               
                                                <div class="dt-responsive table-responsive">

                                                    <table id="autofill" class="table table-striped table-bordered" >
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Order Ref NO</th>
                                                                <th>Date</th>
                                                                <th>Action</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody">
                                                        </tbody>
                                                    </table>

                                                </div>
                                                    



                                        
                                    </div>

                                <hr>
                                    <?php
                                           
                                         echo   $error_msg;
                                           
                                    ?>
                                    <div class="card-header"><h5>Sales Invoice Item</h5></div>
                                    <div class="card-block">

                                        <div class="dt-responsive table-responsive">

                                            <table id="autofill" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                        <th>OrderID</th>
                                                        <th>Product</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Discount</th>
                                                      
                                                        <th>Total</th>
                                                        <th>Status</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody class="itembody">

                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="">

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
                                                        <h5 class="text-primary"><input type="text" id="total_final" name="sinvtotal1"  class="form-control"></h5>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    </div>
                                    

                                    <hr>
                                    
                                    <div class="card-block paymentblock">
                                        <div class="card-header"><h5>Add Payment</h5></div>
                                            <div class="card-block">
                                                <div class="form-group row ">
                                                    <div class="col-sm-4">
                                                        <label class=" col-form-label">Payment Type</label>
                                                        <select class="form-control" name="sinvpaymethod" required>
                                                        <option value="">Select Payment type</option>
                                                        <option value="cash">Cash </option>
                                                        <option value="credit ">Credit </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class=" col-form-label">Amount</label>
                                                        <input type="text" class="form-control" name="payamount" id="pay_amount" onkeyup="getBalance()">
                                                        <span class="paidamount"></span>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class=" col-form-label">Payment Method</label>
                                                        <select class="form-control paymethod" name="paymethod">
                                                        <option value="">Select Payment method</option>
                                                        <option value="cash">Cash </option>
                                                        <option value="credit">Credit </option>
                                                        <option value="cheque">Cheque</option>
                                                    </select>
                                                    </div>

                                                </div>
                                                

                                            </div>
                                            <div class="card-block creditcard border-primary">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class=" col-form-label">Card Numbner</label>
                                                        <input type="text" class="form-control form-control-sm" name="creditcardno">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class=" col-form-label">Card Holders Name</label>
                                                        <input type="text" class="form-control form-control-sm">
                                                    </div>

                                                </div>
                                                <div class="form-group  row">
                                                    <div class="col-sm-3">
                                                        <label class=" col-form-label">Card Type</label>
                                                        <select name="" id="" class="form-control form-control-sm"></select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class=" col-form-label">Month</label>
                                                        <input type="text" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class=" col-form-label">Year</label>
                                                        <input type="text" class="form-control form-control-sm">

                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class=" col-form-label">Security Code</label>
                                                        <input type="text" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            

                                            </div>
                                            <div class="card-block cheque  border-primary">
                                                <div class="col-sm-6">
                                                <label class=" col-form-label">Cheque No.</label>
                                                <input type="text" class="form-control form-control-sm" name="chequeno">
                                                </div>
                                                <div class="col-sm-6">
                                                <label class=" col-form-label">Bank</label>
                                                    <input type="text" class="form-control form-control-sm" name="">
                                                </div>
                                                <div class="col-sm-6">
                                                <label class=" col-form-label">Branch</label>
                                                <input type="text" class="form-control form-control-sm" name="">

                                                </div>

                                                
                                            </div>

                                            <hr>
                                            <div class="d-flex flex-row-reverse">
                                                <div style="float:right;" >
                                                    <strong>Balance:</strong>&nbsp;
                                                    <span>Rs.</span>&nbsp;
                                                    <span id="bal_amount">0.00</span>
                                                </div>
                                            </div>

                                        </div>

                                       
                                        
                                        

                                    <hr>
                                        
                                        <div class="card-block">
                                            <div class="d-flex flex-row-reverse">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>


                                </form>


                            </div> 

                        </div>
                    </div>








                </div>


                <!-- -------------------------------------------------------------------------------------------------------------------- -->
                <?php

                include_once "../../files/foot.php";

                ?>




                <script type="text/javascript" src="../javascript/sales.js "></script>
                <script type="text/javascript" src="../javascript/sales/payment.js "></script>

                <script>

                    $(".paymentblock").hide();
                  
                //function to view orders when you select a customer
                    $("#sinv_customer").change(function() {

                        if($(".dispatchloc").val()=="")
                        {
                            $("#sinv_customer").val("");
                            alert ("Please select location");

                        }else{
                           
                        var customer_id = $("#sinv_customer").val();
                        //  console.log(customer_id);
                        $.get("../ajax/ajaxsales.php?type=get_sales_order_of_customer", {
                            customerselect: customer_id
                        }, function(data) {
                            // console.log(data);
                            $(".paymentblock").show();
                            $("#tbody").html("");
                            $(".itembody").html("");
                            var txt = '';

                            var i_data = JSON.parse(data);
                            $.each(i_data, function(i, x) {

                                txt = ' <tr>' +

                                    '<td >' + i_data[i].salesorder_id + '</td>' +
                                    '<td >' + i_data[i].salesorder_ref + '</td>' +
                                    '<td >' + i_data[i].salesorder_date + '</td>' +

                                    '<td><button type="button" class="btn btn-success btn-mini btnadd" onclick="add_to_list(' + i_data[i].salesorder_id + ',this)" ><i class="fa fa-plus"></i></button>\
                                    <button type="button" class="btn btn-danger btn-mini btndel" onclick="removelist(' + i_data[i].salesorder_id + ',this)"><i class="fa fa-trash"></i> </button>' +
                                        '<div class="border-checkbox-group border-checkbox-group-primary statuscheckbox">'+
                                        '<input class="border-checkbox stat" type="checkbox" value="PENDING" onchange="statuschange('+i_data[i].salesorder_id +',this)" >'+
                                        '<label class="border-checkbox-label" for="checkbox1">Pending</label></div></div>'+
                                    '</td>' +
                                    '</tr>';
                                $("#tbody").append(txt);
                                $(".btndel").hide();
                                $(".statuscheckbox").hide();

                             });

                        });
                    }
                    });

                    //function to display items of a selected order
                    function add_to_list(orderid, btn) {

                        invoiceloc=$(".dispatchloc").val();

                        $.get("../ajax/ajaxsales.php?type=get_sales_order_item", {
                            sales_item: orderid
                        }, function(data) {
                            
                            var item_data = JSON.parse(data);

                            // console.log(item_data);
                            $.each(item_data, function(o, p) {
                                $.get("../ajax/ajaxsales.php?type=get_sum_remainingqty",{prodid:item_data[o].so_itemproductid,loc_id:invoiceloc},function(data)
    {
     console.log(data);
      var d=JSON.parse(data); 

      remaing_qty=d.grn_qty;
  
     console.log("remaining qty "+remaing_qty);
    if(remaing_qty == 0 || remaing_qty==null ){
        remaing_qty=0;
        //$(".qtymsg").append("<label class='badge badge-danger'><i class='icofont-delete' ></label>");

        availableqty="<label class='badge badge-danger'><i class='fa fa-times'></i></label>";
    
        
    }else if(remaing_qty <  item_data[o].so_itemqty){
        console.log("Required stock not available");
        //$(".qtymsg").append("<label class='badge badge-danger'><i class='icofont-delete' ></label>");
        availableqty= "<label class='badge badge-danger'><i class='fa fa-times'></i></label>";
        
        
    }else if(remaing_qty >item_data[o].so_itemqty)
        {console.log("Stock availanle");
            //$(".qtymsg").append("<label class='badge badge-success'><i class='icofont-delete' ></label>");
        availableqty="<label class='badge badge-success'><i class='fa fa-check'></i></label>";
      
    }

                                // console.log(o);
                                // console.log(p);


                                $(".itembody").append(
                                        "<tr>\
                                        <td class='table-edit'><span class='salesorder'>" + item_data[o].so_salesorderid + "<span>\
                                        <input class='form-control input-sm orderid'   type='hidden' name='Orderid[]' value='" + item_data[o].so_salesorderid + "'>\
                                        <input class='form-control input-sm orderid'   type='hidden'  name='OrderItemid[]' value='" + item_data[o].so_itemid + "'>\
                                        </td>\
                                        <td class='table-edit-view'><span class='tabledit-span'>" + item_data[o].so_itemproduct_name + "</span><label class='badge  bg-primary itemqty'>("+remaing_qty+")</label>\
                                            <input class='form-control input-sm productid '   type='hidden' name='Product[]' value='" + item_data[o].so_itemproductid + "'>\
                                        </td>\
                                        <td class='table-edit-view'><span class='tabledit-span'></span>\
                                        <div style='color: red; display: none' class='msg1'>Digits only</div><input class='input-borderless input-sm row_data quantity qtycheck'   type='text' readonly  name='Quantity[]' value='" + item_data[o].so_itemqty + "'><span class='qtymsg'>"+availableqty+"</span>\
                                        </td>\
                                        <td class='table-edit-view'><span class='tabledit-span'></span>\
                                            <select name='Price[]'  class='input-borderless price productprice'>\
                                            <option value='" + item_data[o].so_itemprice + "'>" + item_data[o].so_itemprice + "</option>\
                                            </select>\
                                            <input class='form-control input-sm subtotal '   type='hidden'  value='" + item_data[o].so_subtotal + "'>\
                                        </td>\
                                        <td class='table-edit-view'><span class='tabledit-span'></span>\
                                            <input class='input-borderless input-sm row_data discount'   type='text' readonly name='Discount[]' value='" + item_data[o].so_itemdiscount + "'> <div style='color: red; display: none' class='msg3'>Digits only</div>\
                                        </td>\
                                        <td class='table-edit-view'><span class='tabledit-span'></span>\
                                            <input class='input-borderless input-sm row_data total'   type='text' readonly value='" + item_data[o].so_finaltotal + "'>\
                                        </td>\
                                        <td class='table-edit-view'><span class='tabledit-span'></span>\
                                            <select name='Status[]'  class='input-borderless status productstatus'>\
                                            <option value='COMPLETE' selected='selected'>COMPLETE</option>\
                                            </select>\
                                        </td>\
                                        <td>\
                                            <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>\
                                            <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>\
                                            <span class='btn_cancel'><bbtn_deleterowutton class='btn btn-mini btn-danger' type='button'>Reset</button></span>\
                                            <span class='btn_delete'><button  class='btn btn-mini btn-danger btn_deleterow' type='button'>Delete</button></span>\
                                        </td>\
                                        </tr>");

                                $(".btn_save").hide();
                                $(".btn_cancel").hide();

                                $(btn).parent().find(".btnadd").hide();
                                $(btn).parent().find(".btndel").show();
                                $(btn).parent().find(".statuscheckbox").show();

                                cal_totquantity();
                                cal_totprice();
                                cal_totdiscount();
                                final_total();
                            });
                        });

                    });
                    }

                    //function to remove items from the item table when you delete an order
                    function removelist(orderid, btn2) {
                        //console.log("removelist");
                        


                        $(".itembody .table-edit .salesorder").each(function() {
                            // console.log($(this).text());
                            if ($(this).text() == orderid) {
                                $(this).parent().parent().remove();
                            }


                        });
                        cal_totquantity();
                        cal_totprice();
                        cal_totdiscount();
                        final_total();
                        
                        $(btn2).parent().find(".btnadd").show();
                        $(btn2).parent().find(".btndel").hide();
                        $(btn2).parent().find(".statuscheckbox").hide();
                        $(btn2).parent().find(".statuscheckbox").val();
                      
                    }
function statuschange(id,checkbox1){
    
    if(checkbox1.checked)
    {
       
        $(".itembody .table-edit .salesorder").each(function()
        {
            console.log($(this).text());
            if($(this).text()==id)
            {
            
           
                
            var option = $('<option></option>').attr("value", "PENDING").text("PENDING");
            $(this).parent().parent().children().children('.productstatus').empty().append(option);
            
            }
        });
    }else
    {
      
        $(".itembody .table-edit .salesorder").each(function()
        {
            console.log($(this).text());
            if($(this).text()==id)
            {
                
                var option = $('<option></option>').attr("value", "COMPLETE").text("COMPLETE");
                $(this).parent().parent().children().children('.productstatus').empty().append(option);
            
            }
       });
    }
}



function getBalance(){
  
    checkamount();
   paid_amount =$("#pay_amount").val();
    
    
    total_amount=$("#total_final").val();
    //console.log( paid_amount);
    //console.log( total_amount);
    balance=total_amount-paid_amount;
    //console.log(balance);
    $("#bal_amount").text("");                                              
    $("#bal_amount").text(balance);

}




function checkamount(){
   
        totalamount=$("#total_final").val();
        amountpaid= $("#pay_amount").val();

        console.log(totalamount);
        console.log(amountpaid);

        if(parseInt(amountpaid)> parseInt(totalamount)){
            console.log("payment is high")
            $(".paidamount").text("Amount is high");

        }else {
            $(".paidamount").text("");
        }

   
}

$(".dispatchloc").change(function(){
    loc=$(".dispatchloc").val();
    $("#tbody").html("");
    $(".itembody").html("");


});


                </script>
                <script type="text/javascript" src="../javascript/editabletable.js"></script>