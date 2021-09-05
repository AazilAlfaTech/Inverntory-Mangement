<?php

include_once "../customer/customer.php";
$customer1 = new customer();
include_once "../Sales_order/sales_order.php";
$sales_order1 =  new sales_order();
include_once "../sales_invoice/sales_invoice.php";
$sales_invoice1 = new sales_invoice();


$all_cus = $customer1->get_all_customer();




// $result_sales_order = $sales_order1->get_sales_order_by_customer();

//    print_r( $all_cus);

// ------------------------------------------------------------------------------------------------------------


if(isset($_POST[""]))
{





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

                                <div class="card-block">

                                    <form action="add_new_purchase_requisition.php" method="POST">




                                        <div class="form-group row">

                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Select Customer</label>
                                                <select class="js-example-basic-single col-sm-12 selectcustomer" name="sinvcustomer" id="sinv_customer">
<option value="-1" disable selected>Select Customer</option>
                                                    <?php
                                                    foreach ($all_cus as $item)

                                                       
                                                            echo "<option value='$item->customer_id'> $item->customer_name</option>";
                                                    ?>


                                                </select>

                                            </div>



                                            <!-- <div class="col-sm-6">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="date" name="purchaserequestdate" id="" value="<?= $purchase1->purchaserequest_date ?>">
                                            </div> -->

                                        </div>
                                        <hr>





                                        <div class="table-responsive">

                                            <table class="table table-striped table-bordered" id="example-2">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Sales Order Ref NO</th>
                                                        <th> Date</th>
                                                        <th></th>

                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">

                                            



                                                

                                                </tbody>
                                            </table>

                                        </div>




                                        <div class="d-flex flex-row-reverse">
                                            <button type="submit" class="btn btn-primary">ADD</button>
                                        </div>
                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>




                </div>

            </div>




            </div>

</div>
</div>


<!-- ------------------------------------------------------------------------------------------------ -->



<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->

                <!-- Page-header end -->




                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Items</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action="add_new_salesinvoice.php" method="POST">




                                        <div class="form-group row">

                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Payment Methord</label>
                                                <select class="js-example-basic-single col-sm-12" name="sinvpaymethod" id="sinv_paymethod">

                                                    <option value=" ">Cash </option>
                                                    <option value=" ">Credit </option>
                           


                                                </select>

                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Payment type</label>
                                                <select class="js-example-basic-single col-sm-12" name="purchaserequestsupplier" id="purchreq_supplier">

                                                    <option value=" ">Cash </option>
                                                    <option value=" "> Card</option>
                                                    <option value=" ">Bank Tranfer </option>
                                                    <option value=" "> Cheque</option>
                           


                                                </select>

                                            </div>



                                        

                                        </div>
                                        <hr>





                                        <div class="table-responsive">

                                            <table class="table table-striped table-bordered" id="example-2">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Ref NO</th>
                                                        <th> Product</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Discount</th>
                                                        <th>Total</th>
                                                        <th></th>

                                                    </tr>
                                                </thead>
                                                <tbody id="tbodybuilder">




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

            </div>




            </div>

</div>
</div>
                <!-- -------------------------------------------------------------------------------------------------------------------- -->
                <?php

                include_once "../../files/foot.php";

                ?>




<!-- <script type="text/javascript" src="../javascript/sales.js "></script> -->

<script>
$("#sinv_customer").change(function() {
    var customer_id = $("#sinv_customer").val();
    console.log(customer_id);
     $.get("../ajax/ajaxsales.php?type=get_sales_order_of_customer", { customerselect: customer_id }, function(data) {
         console.log(data);

         $("#tbody").html("");
         var txt = '';
     
         var i_data = JSON.parse(data);
        $.each(i_data, function(i, x) {

            txt = ' <tr>' +
              
                '<td >' + i_data[i].salesorder_id +'</td>' +
                 '<td >' + i_data[i].salesorder_ref + '</td>' +
                 '<td >' + i_data[i].salesorder_date + '</td>' +
      
                 '<td><button type="button" class="btn btn-success btnadd" onclick="add_to_list(' + i_data[i].salesorder_id +')" ><i class="fas fa-plus-square"></i> </button>&nbsp;&nbsp;<button type="button" class="btn btn-success btndel" onclick="delete_allocation(this)"><i class="far fa-times-circle"></i> </button></td>' +
                '</tr>';
            $("#tbody").append(txt);
            // $(".btndel").hide();

         });





     });
});








function add_to_list(i){

console.log(i);


$.get("../ajax/ajaxsales.php?type=get_sales_order_item", { sales_item: i }, function(data) {
         console.log(data);

        //  $("#tbodybuilder").html("");

        //  var txt1 = '';
     
         var item_data = JSON.parse(data);

         console.log(item_data);
        $.each(item_data, function(o, p) {

            console.log(o);
            console.log(p);

            txt1 = ' <tr>' +
              
                '<td>' + 1 +'</td>' +
                '<td>' + item_data[o].so_itemprice +'</td>' +
                '<td>' + item_data[o].so_itemproductid+'</td>' +
                '<td>' + item_data[o].so_itemqty +'</td>' +
                '<td>' + item_data[o].so_itemprice +'</td>' +
                '<td>' + item_data[o].so_itemdiscount+'</td>' +
                '<td>' + item_data[o].so_itemprice +'</td>' +
            
          
             
      
                 '<td><button type="button" class="btn btn-success btnadd" ><i class="fas fa-plus-square"></i> </button>&nbsp;&nbsp;<button type="button" class="btn btn-success btndel" onclick="delete_allocation(this)"><i class="far fa-times-circle"></i> </button></td>' +
                '</tr>';
            $("#tbodybuilder").append(txt1);
            // $(".btndel").hide();

         });





     });

}
</script>


      