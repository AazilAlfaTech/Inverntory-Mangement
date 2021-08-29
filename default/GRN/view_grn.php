<?php
    include_once "GRN.php";
    $grn3=new grn();

    include_once "grn_item.php";
    $grn_item3= new grn_item();

    include_once "../location/location.php";
    $location2=new location();

    $result_grn3=$grn3->get_grn_byid($_GET["view"]);
    $result_grn4=$grn3->get_all_grn_by_grnid($_GET["view"]);
    $result_grnitem3=$grn_item3->get_grnitem_byid($_GET["view"]);

    // $result_location2=$location2->get_all_location();
    include_once "../../files/head.php";

    
    
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
                                            <h6>Supplier: <?=$result_grn4->purchaseorder_supplier ?> </h6>
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
                                        <div class="col-md-4 col-sm-4">
                                            <h6>Date : <?=$result_grn3->grn_date ?> </h6>
                                 
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <h6 class="m-b-20">Reference Number: <span><?=$result_grn3->grn_ref_no?></span></h6>
                                       
                                          
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <h6 class="m-b-20">Received location: <span><?=$result_grn3->grn_received_loc?></span></h6>
                                       
                                          
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table  invoice-detail-table " >
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
                                                foreach ($result_grnitem3 as $item)
                                                    {
                                                        echo
                                                        "
                                                        <tr>
                                                            <td>$item->grn_item_prodname </td>
                                                            <td class='quantity'>$item->grn_item_qty </td>
                                                            <td>$item->grn_item_price</td>
                                                            <td>$item->grn_item_dis</td>
                                                            <td>$item->grn_item_finalprice</td>
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
                                                <tbody class="pricelist">
                                                    <tr>
                                                        <th>Total Quantity :</th>
                                                        <td><input type="text" id="total_quan" name="totqty" class="form-control form-control-sm" ></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Taxes (10%) :</th>
                                                        <td>$57.00</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount (5%) :</th>
                                                        <td>$45.00</td>
                                                    </tr>
                                                    <tr class="text-info">
                                                        <td>
                                                            <hr>
                                                            <h5 class="text-primary">Total :</h5>
                                                        </td>
                                                        <td>
                                                            <hr>
                                                            <h5 class="text-primary">$4827.00</h5>
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
                                    <a href="print_grn.php"
                                        class="btn btn-primary btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20" onclick="printby()">Print</a>
                                    <button type="button"
                                        class="btn btn-danger waves-effect m-b-10 btn-sm waves-light">Cancel</button>
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

        include_once "../../files/foot.php";

        ?>
        <script type="text/javascript" src="../javascript/editabletable.js"></script>
<script>
    function printby()
    {
    var prtContent = document.getElementById("print");
var WinPrint = window.open('', '', '');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
    }
</script>