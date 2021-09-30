<?php

include_once "../customer/customer.php";
$customer1 = new customer();
include_once "../sales_invoice/sales_invoice.php";
$sales_invoice1 = new sales_invoice();
include_once "../sales_dispatch/sales_dispatch.php";
$sales_dispatch2=new sales_dispatch();
include_once "../sales_dispatch/sales_dispatch_item.php";
$salesdispatchitem=new sales_dispatch_item();
//customer dropdown
$all_cus= $customer1->get_all_customer();


include_once "../product/product.php";
$product1 = new product(); 

if(isset($_POST['sdis_date'])){
    $sales_dispatch2->salesdispatch_date=$_POST['sdis_date'];
    $sales_dispatch2->salesdispatch_ref=$sales_dispatch2->sd_code($_POST['sdis_date']);
    $dispatchid=$sales_dispatch2->insert_sales_dispatch();
    $salesdispatchitem->insert_sales_dispatch_item1($dispatchid);
    
}







// --------------------------------------------------------------------------------------------------------------------




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
                                    <h4>Add New Sales Dispatch</h4>

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
                                    <h5>Select sales invoice</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>
                                <form action="add_new_salesdispatch.php" method="POST">

                                <div class="card-block">
                                        <div class="form-group row">

                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Select Customer</label>
                                                <select class="form-control js-example-basic-single col-sm-12 selectcustomer"  id="sinv_customer">
                                                        <option value="-1" disable selected>Select Customer</option>
                                                    <?php
                                                    foreach ($all_cus as $item)
                                                        echo "<option value='$item->customer_id'> $item->customer_name</option>";
                                                    ?>
                                                </select>

                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="date" id="txtDate" name="sdis_date"  value="<?php echo date('Y-m-d');?>">
                                            </div>

                                        </div>
                                        <hr>


                                        <div class="table-responsive">

                                            <table class="table table-striped table-bordered" id="example-2">
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
                                 <!-- end of card 1 -->
                                <!-- </div> -->
                           
                                <div class="card">
                                    <div  class="card-header">
                                        <h5>Sales dispatch items</h5>
                                    </div>
                                    <!-- <div class="form-group row">

                                        <div class="col-sm-6">
                                            <label class=" col-form-label">Payment Methord</label>
                                            <select class="js-example-basic-single col-sm-12" name="sinvpaymethod" >

                                                <option value="cash">Cash </option>
                                                <option value="credit ">Credit </option>



                                            </select>

                                        </div>
                                        <div class="col-sm-6">
                                            <label class=" col-form-label">Payment type</label>
                                            <select class="js-example-basic-single col-sm-12" name="sinvpaymethodcash" >

                                                <option value="cash">Cash </option>
                                                <option value="card"> Card</option>
                                                <option value="bank ">Bank Tranfer </option>
                                                <option value="cheque "> Cheque</option>



                                            </select>

                                        </div>
                                    </div> -->
                                </div>
                                    
                                <div class="card-block">
                                    
                                    <div class="table-responsive">

                                        <table class="table table-striped table-bordered" >
                                            <thead>
                                                <tr>
                                                    
                                                    <th>OrderID</th>
                                                    <th>Product</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
                                                    <th>Discount</th>
                                                    <th>Total</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody class="itembody">




                                            </tbody>
                                        </table>

                                    </div>

                                </div>
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

<script>
$("#sinv_customer").change(function() {
    var customer_id = $("#sinv_customer").val();
    console.log(customer_id);
     $.get("../ajax/ajaxsales.php?type=get_sales_invoice_of_customer", { invoicecustomer: customer_id }, function(data) {
         console.log(data);

         $("#tbody").html("");
         $(".itembody").html("");
         var txt = '';
     
         var i_data = JSON.parse(data);
        $.each(i_data, function(i, x) {

            txt = ' <tr>' +
              
                '<td >' + i_data[i].salesinvoice_id +'</td>' +
                 '<td >' + i_data[i].salesinvoice_ref + '</td>' +
                 '<td >' + i_data[i].salesinvoice_date + '</td>' +
      
                 '<td><button type="button" class="btn btn-success btn-mini btnadd" onclick="add_to_list(' + i_data[i].salesinvoice_id +',this)" ><i class="icofont icofont-plus"></i></button>\
                 <button type="button" class="btn btn-danger btn-mini btndel" onclick="removelist(' + i_data[i].salesinvoice_id +',this)"><i class="icofont icofont-ui-delete"></i> </button>'+
                  '</td>'+
                '</tr>';
            $("#tbody").append(txt);
             $(".btndel").hide();

        
         });





     });
});






function add_to_list(invoice,btn){

console.log(invoice);


$.get("../ajax/ajaxsales.php?type=get_sales_invoice_item", { invoiceid: invoice }, function(data) {
         console.log(data);

        //  $(".itembody").html("");

      
     
         var item_data = JSON.parse(data);

        // console.log(item_data);
        $.each(item_data, function(o, p) {

            console.log(o);
            console.log(p);


            $(".itembody").append(
                "<tr>\
               <td class='table-edit'><span class='salesorder'>"+ item_data[o].si_item_invoiceid+"</span>\
            <input class='form-control input-sm orderid'   type='hidden' name='Orderid[]' value='"+ item_data[o].si_item_invoiceid+"'>\
            <input class='form-control input-sm orderid'   type='hidden' name='InvoiceItemid[]' value='"+ item_data[o].si_itemid+"'>\
        </td>\
        <td ><span class='tabledit-span'>"+ item_data[o].si_item_productname+"</span>\
            <input class='form-control input-sm productid '   type='hidden' name='Product[]' value='"+ item_data[o].si_item_productid+"'>\
        </td>\
        <td ><span class='tabledit-span'></span>\
            <input class='input-borderless input-sm row_data quantity'   type='text' readonly  name='Quantity[]' value='"+ item_data[o].si_item_qty +"'><div style='color: red; display: none' class='msg1'>Digits only</div>\
        </td>\
        <td ><span class='tabledit-span'></span>\
           <select name='Price[]' id='productprice' class='input-borderless price'>\
            <option value='"+item_data[o].si_item_price +"'>"+item_data[o].si_item_price +"</option>\
        </select>\
            <input class='form-control input-sm subtotal '   type='hidden' name='Orderid[]' value='"+ item_data[o].si_item_subtotal+"'>\
        </td>\
        <td ><span class='tabledit-span'></span>\
            <input class='input-borderless input-sm row_data discount'   type='text' readonly name='Discount[]' value='"+ item_data[o].si_item_discount+"'> <div style='color: red; display: none' class='msg3'>Digits only</div>\
        </td>\
        <td class='table-edit-view'><span class='tabledit-span'></span>\
            <input class='input-borderless input-sm row_data total'   type='text' readonly value='"+item_data[o].si_item_finaltotal+"'>\
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
     
         });
    });
}


function removelist(orderid,btn2){
    console.log("removelist");
    $(".itembody .table-edit .salesorder").each(function() {
        console.log($(this).text());
        if($(this).text()==orderid){
            $(this).parent().parent().remove();
        }
      

    });
        $(btn2).parent().find(".btnadd").show();
        $(btn2).parent().find(".btndel").hide();
}
</script>
<script type="text/javascript" src="../javascript/editabletable.js"></script>

