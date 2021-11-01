<?php
include_once "../sales_order/sales_order.php";
$sales_order2=new sales_order();
include_once "../sales_order/sales_order_item.php";
$sales_orderitem2=new sales_orderitem();
include_once "../../files/print_head.php";


$sales_order2=$sales_order2->get_salesorder_by_id($_GET['view']);
$sales_orderitem_res=$sales_orderitem2->get_all_sales_orderitem($_GET['view']);


// print_r($result_pr_products)


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
                                <div class="card-block">
                                    <div class="card-header"><h3>SALES ORDER INVOICE</h3></div>
                                </div>
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
                                            <h6>Customer: <?=$sales_order2->salesorder_customer_name ?> </h6>
                                            <table
                                                class="table table-responsive invoice-table invoice-order table-borderless">
                                                <tbody>
                                                  
                                                    <tr>
                                                        <th>Status :</th>
                                                        <td>
                                                            <span class="label label-warning"><?=$sales_order2->salesorder_currentstatus?></span>
                                                        </td>
                                                    </tr>
                                                
                                                </tbody>
                                            </table>
                                          
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <h6>Date : <?=$sales_order2->salesorder_date  ?> </h6>
                                 
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <h6 class="m-b-20">Refference Number: <span><?=$sales_order2->salesorder_ref?></span></h6>
                                       
                                          
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table  ">
                                                    <thead>
                                                        <tr class="">
                                                            <th>Product </th>
                                                            <th>Quantity</th>
                                                            <th>Price </th>
                                                            <th>Discount </th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php
                                                foreach ($sales_orderitem_res as $item)
                                                    {
                                                        echo
                                                        "
                                                        <tr>
                                                            <td>$item->so_itemproduct_name </td>
                                                            <td><input class='input-borderless quantity' readonly type='text' value='$item->so_itemqty'> </td>
                                                            <td><input class='input-borderless price' readonly type='text' value='$item->so_itemprice'></td>
                                                            <td><input class='input-borderless discount ' readonly type='text' value='$item->so_itemdiscount'></td>
                                                            <input class='input-borderless subtotal' readonly type='hidden' value='$item->so_subtotal'>
                                                            <td><input class='input-borderless total' readonly type='text' value='$item->so_finaltotal'></td>

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
                                                        <td><input class='input-borderless autonumber' id="total_quan" readonly type='text' ></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sub Total :</th>
                                                        <td><input class='input-borderless autonumber' id="total_price" readonly type='text' value='' ></td>
                                                    </tr>
                                                   
                                                    <tr class="text-info">
                                                        <td>
                                                            <hr>
                                                            <h5 class="text-primary">Total :</h5>
                                                        </td>
                                                        <td>
                                                            <hr>
                                                            <h5 class="text-primary"><input class='input-borderless' id="total_final" readonly type='text' value=''></h5>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                            <!-- Invoice card end -->
                            <div class="row text-center" id = "print-btn">
                                <div class="col-sm-12 invoice-btn-group text-center">
                                    <button type="button"
                                        class="btn btn-primary btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20"onclick="window.print()">Print</button>
                                    <a href = "manage_sales_order.php"
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