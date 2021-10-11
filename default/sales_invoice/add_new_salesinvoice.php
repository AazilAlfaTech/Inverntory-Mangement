<?php

include_once "../customer/customer.php";
$customer1 = new customer();
include_once "../Sales_order/sales_order.php";
$sales_order1 =  new sales_order();
include_once "../sales_invoice/sales_invoice.php";
$sales_invoice1 = new sales_invoice();
include_once "../sales_invoice/sales_invoice_item.php";
$sales_invoice_item1 = new sales_invoice_item();


$all_cus= $customer1->get_all_customer();


include_once "../product/product.php";
$product1 = new product(); 

//product dropdown
$productlist=$product1->getall_product2();


if(isset($_POST["sinvcustomer"]))
{


    $sales_invoice1->salesinvoice_customer=$_POST["sinvcustomer"];
    $sales_invoice1->salesinvoice_paymethod =$_POST["sinvpaymethod"];
    
    $sales_invoice1->salesinvoice_cashmethod= $_POST["sinvpaymethodcash"];
    $sales_invoice1->salesinvoice_date=$_POST["sinvdate"];
    $sales_invoice1->salesinvoice_ref=$sales_invoice1->si_code($_POST["sinvdate"]);
    $si_id= $sales_invoice1->insert_sales_invoice();
    //echo $so_id;
    $sales_invoice_item1->insert_sales_invoice_item1($si_id);

    //$sales_orderitem2->insert_sales_orderitem($so_id);
    //header("location:../sales_quotation/manage_sales_invoice.php");


       





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

                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Select Customer</label>
                                                <select class="js-example-basic-single col-sm-12 selectcustomer" name="sinvcustomer" id="sinv_customer" required>
                                                        <option value="" disable selected>Select Customer</option>
                                                    <?php
                                                    foreach ($all_cus as $item)
                                                        echo "<option value='$item->customer_id'> $item->customer_name</option>";
                                                    ?>
                                                </select>

                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" id="txtDate" type="date" name="sinvdate"  value="<?php echo date('Y-m-d');?>" required>
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

                                      <!-- Modal static-->
                                      <button type="button" class="btn btn-default waves-effect" data-toggle="modal" data-target="#default-Modal">Static</button>
                                                                <div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Modal title</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h5>Static Modal</h5>
                                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing lorem impus dolorsit.onsectetur adipiscing</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                                                                                <button type="button" class="btn btn-primary waves-effect waves-light ">Save changes</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <!-- Modal large-->
                                 <!-- end of card 1 -->
                                <!-- </div> -->
                           
                                <!-- <div class="card-block">
                                    <div class="form-group row">

                                        <div class="col-sm-6">
                                            <label class=" col-form-label">Payment Methord</label>
                                            <select class="js-example-basic-single col-sm-12 paymethod" name="sinvpaymethod" required >
                                                <option value="">Select Payment method</option>
                                                <option value="cash">Cash </option>
                                                <option value="credit ">Credit </option>
                                            </select>

                                        </div>
                                        <div class="col-sm-6 paytype">
                                            <label class=" col-form-label">Payment type</label>
                                            <select class="js-example-basic-single col-sm-12" name="sinvpaymethodcash"  >
                                                <option value="">Select Payment type</option>
                                                <option value="cash">Cash </option>
                                                <option value="card"> Card</option>
                                                <option value="bank ">Bank Tranfer </option>
                                                <option value="cheque "> Cheque</option>
                                            </select>

                                        </div>
                                    </div>
                                </div> -->
                                    
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
                                                    <th>Status</th>
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

$( document ).ready(function() {

    $(".paytype").hide();
    $(".payment").hide();
    $(".paymethod").change(function() {
        var paymethod= $(".paymethod").val();
    //    console.log(paymethod);
        if( paymethod=="cash"){
            $(".paytype").show();
            $(".payment").show();
        }
    });

});

$("#sinv_customer").change(function() {
    var customer_id = $("#sinv_customer").val();
  //  console.log(customer_id);
     $.get("../ajax/ajaxsales.php?type=get_sales_order_of_customer", { customerselect: customer_id }, function(data) {
        // console.log(data);

         $("#tbody").html("");
         $(".itembody").html("");
         var txt = '';
     
         var i_data = JSON.parse(data);
        $.each(i_data, function(i, x) {

            txt = ' <tr>' +
              
                '<td >' + i_data[i].salesorder_id +'</td>' +
                 '<td >' + i_data[i].salesorder_ref + '</td>' +
                 '<td >' + i_data[i].salesorder_date + '</td>' +
      
                 '<td><button type="button" class="btn btn-success btn-mini btnadd" onclick="add_to_list(' + i_data[i].salesorder_id +',this)" ><i class="fa fa-plus"></i></button>\
                 <button type="button" class="btn btn-danger btn-mini btndel" onclick="removelist(' + i_data[i].salesorder_id +',this)"><i class="fa fa-trash"></i> </button>'+
                  '</td>'+
                '</tr>';
            $("#tbody").append(txt);
            $(".btndel").hide();
            $(".statuscheckbox").hide();


        


         });





     });
});







function add_to_list(i,btn){

console.log(i);


$.get("../ajax/ajaxsales.php?type=get_sales_order_item", { sales_item: i }, function(data) {
         //console.log(data);

        //  $(".itembody").html("");

      
     
         var item_data = JSON.parse(data);

        // console.log(item_data);
        $.each(item_data, function(o, p) {

            // console.log(o);
            // console.log(p);


            $(".itembody").append(
                "<tr>\
               <td class='table-edit'><span class='salesorder'>"+ item_data[o].so_salesorderid+"<span>\
            <input class='form-control input-sm orderid'   type='hidden' name='Orderid[]' value='"+ item_data[o].so_salesorderid+"'>\
            <input class='form-control input-sm orderid'   type='text'  name='OrderItemid[]' value='"+ item_data[o].so_itemid+"'>\
        </td>\
        <td class='table-edit-view'><span class='tabledit-span'>"+ item_data[o].so_itemproduct_name+"</span>\
            <input class='form-control input-sm productid '   type='hidden' name='Product[]' value='"+ item_data[o].so_itemproductid+"'>\
        </td>\
        <td class='table-edit-view'><span class='tabledit-span'></span>\
            <input class='input-borderless input-sm row_data quantity'   type='text' readonly  name='Quantity[]' value='"+ item_data[o].so_itemqty +"'><div style='color: red; display: none' class='msg1'>Digits only</div>\
        </td>\
        <td class='table-edit-view'><span class='tabledit-span'></span>\
            <select name='Price[]'  class='input-borderless price productprice'>\
            <option value='"+item_data[o].so_itemprice+"'>"+item_data[o].so_itemprice+"</option>\
            </select>\
            <input class='form-control input-sm subtotal '   type='hidden' name='Orderid[]' value='"+ item_data[o].so_subtotal+"'>\
        </td>\
        <td class='table-edit-view'><span class='tabledit-span'></span>\
            <input class='input-borderless input-sm row_data discount'   type='text' readonly name='Discount[]' value='"+ item_data[o].so_itemdiscount+"'> <div style='color: red; display: none' class='msg3'>Digits only</div>\
        </td>\
        <td class='table-edit-view'><span class='tabledit-span'></span>\
            <select name='Status[]'  class='input-borderless status productstatus'>\
            <option value='"+item_data[o].so_itemstatus+"' selected='selected'>"+item_data[o].so_itemstatus+"</option>\
            </select>\
        </td>\
        <td class='table-edit-view'><span class='tabledit-span'></span>\
            <input class='input-borderless input-sm row_data total'   type='text' readonly value='"+item_data[o].so_finaltotal+"'>\
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
       
     
         });
    });
}


function removelist(orderid,btn2){
    console.log("removelist");
    // $('.itembody tbody tr').each(function(){
         
      
    //     //   $(this).children('td').children('input').each(function(indexColumna){
    //     //     val1=indexColumna.val();
    //     //     console.log(val1);
    //     //     if(indexColumna.val()==orderid){
    //     //         $(this).remove();
    //     //     };
    //     //   });
          
    //     });//fin de '#myTable tbody tr'
      
     
        $(".itembody .table-edit .salesorder").each(function() {
       // console.log($(this).text());
        if($(this).text()==orderid){
            $(this).parent().parent().remove();
        }
      

    });
            $(btn2).parent().find(".btnadd").show();
        $(btn2).parent().find(".btndel").hide();
        $(btn2).parent().find(".statuscheckbox").hide();
       $(btn2).parent().find(".statuscheckbox").val();
        $(btn2).parent().find(".stat").change(function(){
            statuss=$(".stat").val()
             console.log("statuss")
            if (this.checked) {
    console.log("Checkbox is checked..");
    statuss=$(".stat").val();
    console.log(statuss)
  } else {
    console.log("Checkbox is not checked..");
  }
        });
       
    }
</script>
<script type="text/javascript" src="../javascript/editabletable.js"></script>




      