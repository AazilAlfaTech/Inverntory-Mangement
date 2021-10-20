<?php

//include_once "../../files/head.php";
include_once "sales_quatation.php";
include_once "sales_quatation_item.php";

$sales_quot3=new sales_quotation();

$sales_quot_item3=new sales_quotationitem();

$sales_quot3=$sales_quot3->get_salesquotation_by_id($_GET["view_sq"]);
$sales_quot_item3=$sales_quot_item3->get_all_item_bysquotid($_GET["view_sq"]);

include_once "../../files/print_head.php";


?>



<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">

                <!-- Page body start -->
                <div class="page-body">
                    <!-- Container-fluid starts -->
                    <div class="container">
                        <!-- Main content starts -->
                        <div>
                            <!-- Invoice card start -->
                            <div class="card">
                                <div class="row invoice-contact">
                                    <div class="col-md-8">
                                        <div class="invoice-box row">
                                            <div class="col-sm-12">
                                             
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="row invoive-info">
                                        <div class="col-md-4 col-xs-12 invoice-client-info">
                                            <h6>Customer: <?=$sales_quot3->salesquot_customer_name ?> </h6>
                                            <table
                                                class="table table-responsive invoice-table invoice-order table-borderless">
                                                <tbody>
                                                  
                                                    <tr>
                                                        <th>Status :</th>
                                                        <td>
                                                            <span class="label label-warning">Pending</span>
                                                        </td>
                                                    </tr>
                                                
                                                </tbody>
                                            </table>
                                          
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <h6>Date : <?=$sales_quot3->salesquot_date ?> </h6>
                                 
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <h6 class="m-b-20">Refference Number: <span><?=$sales_quot3->salesquot_ref ?></span></h6>
                                       
                                          
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table  invoice-detail-table">
                                                    <thead>
                                                        <tr class="thead-default">
                                                            <th>Product </th>
                                                            <th>Quantity</th>
                                                            <th>Price </th>
                                                            <th>Discount </th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php
                                                foreach ($sales_quot_item3 as $item)
                                                {
                                                    echo
                                                    "
                                                    <tr>
                                                        <td>$item->product_name </td>
                                                        <td><input class='input-borderless quantity' readonly type='text' value='$item->sq_item_qty'> </td>
                                                        <td><input class='input-borderless price' readonly type='text' value='$item->sq_item_price'></td>
                                                        <td><input class='input-borderless discount ' readonly type='text' value='$item->sq_item_discount'></td>
                                                        <input class='input-borderless subtotal' readonly type='hidden' value='$item->sq_item_subtotal'>
                                                        <td><input class='input-borderless total' readonly type='text' value='$item->sq_item_finalprice'></td>

                                                    </tr>
                                             
                                              ";
                                                }
                                                  ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <table class="table table-responsive invoice-table invoice-total">
                                                <tbody>
                                                    <tr>
                                                        <th>Total quantity :</th>
                                                        <td><span></span><input class='input-borderless autonumber' id="total_quan" readonly type='text' value=''></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sub Total :</th>
                                                        <td><span>Rs.</span><input class='input-borderless autonumber' id="total_price" readonly type='text' value='' data-a-sign="Rs. "></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount :</th>
                                                        <td><span></span><input class='input-borderless autonumber' id="total_discount" readonly type='text' value=''></td>
                                                    </tr>
                                                    <tr class="text-info">
                                                        <td>
                                                            <hr>
                                                            <h5 class="text-primary">Total :</h5>
                                                        </td>
                                                        <td>
                                                            <hr>
                                                            <h5 class="text-primary"><span>Rs.</span><input class='input-borderless' id="total_final" readonly type='text' value='$item->so_itemqty'></h5>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                            <!-- Invoice card end -->
                            <div class="row text-center">
                                <div class="col-sm-12 invoice-btn-group text-center">
                                    <button type="button"
                                        class="btn btn-primary btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20 " onclick="window.print()">Print</button>
                                    <a href = "manage_sales_quotation.php"
                                        class="btn btn-danger waves-effect m-b-10 btn-sm waves-light">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Container ends -->
                </div>
                <!-- Page body end -->
            </div>
        </div>
        <!-- Warning Section Starts -->

        
    </div>
</div>

<?php

        include_once "../../files/print_foot.php";

        ?>
     
     <script type="text/javascript" src="../javascript/editabletable.js"></script>