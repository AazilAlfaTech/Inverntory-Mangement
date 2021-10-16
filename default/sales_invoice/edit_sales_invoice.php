<?php

include_once "sales_invoice.php";
$sales_invoice1 = new sales_invoice();

include_once "sales_invoice_item.php";
$sales_invoice_item1 = new sales_invoice_item();




include_once "../product/product.php";
$product1 = new product();
$productlist = $product1->getall_product2();

if (isset($_POST['save'])) {


 
    $sales_invoice1->salesinvoice_paymethod=$_POST["sinvpaymethod"];
    $sales_invoice1->edit_sales_invoice($_POST['salesinvoice_id']);
    $sales_invoice_item1->edit_sales_invoice_item();

    // if($res_edit==true){

    //     header("location:../purchase_order/manage_purchase_order.php?success_edit=1");
    // }elseif($res_edit==false){

    //     header("location:../purchase_order/manage_purchase_order.php?notsuccess=1");
    // }



} else {


    $result_sales_in = $sales_invoice1->get_sales_invoice_by_id($_GET['edit_si']);
    $result_item = $sales_invoice_item1->get_all_sales_invoice_invoiceid($_GET['edit_si']);

    //    print_r($result_item);


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
                                    <h4>Edit Sales Invoice</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="../sales_invoice/manage_sales_invoice.php">SalesInvoice</a> </li>
                                    <li class="breadcrumb-item"><a href="../sales_invoice/edit_sales_invoice.php">Edit</a> </li>
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
                                    <h5>Edit Sales Invoice</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action='edit_sales_invoice.php' method='POST'>
                                        <!-- top part -->

                                        <div class="form-group row">

                                            <div class="col-sm-3">
                                                <label class=" col-form-label"> Sales Invoice</label>
                                                <input class="form-control" type="text" readonly='true' value=<?= $result_sales_in->salesinvoice_ref ?>>

                                            </div>

                                            <input class="form-control" type="hidden" readonly='true' name="salesinvoiceid" value=<?= $result_sales_in->salesinvoice_id ?>>

                                            <div class="col-sm-3">
                                                <label class=" col-form-label">Customer</label>
                                                <input class="form-control" type="text" readonly='true' value="<?= $result_sales_in->salesinvoice_customer_name ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="date" name="salesinvoice_id" readonly='true' value=<?= $result_sales_in->salesinvoice_date ?>>
                                                
                                            </div>
                                            <div class="col-sm-3">
                                                <label class=" col-form-label">Payment Method</label>
                                                <input class="form-control" type="text" name="salesinvoice_id" readonly='true' value=<?= $result_sales_in->salesinvoice_paymethod ?>>
                                            </div>

                                        </div>

                                        

               

                                </div>

                                <br>
                                <br>
                                <!-- add product from -->




                                <!-- Edit With Button card start -->
                                <div class="card-block">

                                

                                <div class="table-responsive">

                                    <table class="table table-bordered " id="mytable">
                                        <thead class="table-primary">
                                            <tr>
                                                <th style="width:10%">Product</th>
                                                <th style="width:10%">Qty</th>
                                                <th style="width:10%">Price</th>
                                                <th style="width:10%">Discount</th>
                                                <th style="width:10%">Total</th>
                                                <th style="width:10%">Status</th>
                                                <th style="width:10%">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody class="itembody">
                                            <?php if (isset($_GET['edit_si'])) : ?>
                                                <?php foreach ($result_item as $item) :  ?>
                                                    <tr>

                                                        <td class='table-edit-view'><span class=''><?= $item->si_item_productname ?></span>
                                                            <input class='form-control input-sm  ' type='hidden' name='Product[]' value='<?= $item->si_item_productid ?>'>
                                                            <input class='form-control input-sm productid ' type='hidden' name='Orderid[]' value='<?= $item->si_itemid ?>'>
                                                        </td>
                                                        <td class='table-edit-view'><span class='tabledit-span'><?= $item->si_item_qty ?></span>
                                                            <input class=' input-borderless  input-sm row_data quantity' type='text' readonly name='Quantity_edit[]' value='<?= $item->si_item_qty ?>'>
                                                            <div style="color: red; display: none" class="msg1">Digits only</div>
                                                        </td>
                                                        
                                                        <td class='table-edit-view'><span class='tabledit-span'></span>
                                                            <select name='Price_edit[]'  class='input-borderless price productprice'>
                                                            <option value='<?= $item->si_item_price ?>'><?= $item->si_item_price ?></option>
                                                            </select>
                                                            <input class='form-control input-sm subtotal '   type='hidden'  value='<?= $item->si_item_subtotal ?>'>
                                                        </td>
                                                        <td class='table-edit-view'><span class='tabledit-span'><?= $item->si_item_discount ?></span>
                                                            <input class=' input-borderless input-sm row_data discount' type='text' name='Discount_edit[]' readonly value='<?= $item->si_item_discount ?>'>
                                                            <div style="color: red; display: none" class="msg3">Digits only</div>
                                                        </td>
                                                        <td class='table-edit-view'><span class='tabledit-span'><?= $item->si_item_finaltotal ?></span>
                                                            <input class=' input-borderless   total' type='text' readonly value=<?= $item->si_item_finaltotal ?>>
                                                        </td>
                                                        <td class='table-edit-view'><span class='tabledit-span'></span>
                                                            <select name='Status[]'  class='input-borderless status productstatus'>
                                                            <option value='<?= $item->si_item_currentstatus ?>' selected='selected'><?= $item->si_item_currentstatus ?></option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>
                                                            <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>
                                                            <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Reset</button></span>
                                                            <span class='deletedata'><button class='btn btn-mini btn-danger ' type='button'>Delete</button></span>
                                                        </td>

                                                    </tr>

                                                <?php endforeach;  ?>
                                            <?php endif;   ?>
                                        </tbody>
                                    </table>



                                </div>

                                
                                <!-- final values-->
                                <table class="table table-responsive invoice-table invoice-total">
                                    <tbody class="pricelist">
                                        <tr>
                                            <th> Total Quantity :</th>
                                            <td><input type="text" id="total_quan" class="form-control form-control-sm"></td>
                                        </tr>
                                        <tr>
                                            <th> Sub Total :</th>
                                            <td><input type="text" id="total_price" data-a-sign="Rs. " class=" form-control form-control-sm autonumber"></td>
                                        </tr>
                                        <tr>
                                            <th> Total Discount :</th>
                                            <td><input type="text" id="total_discount" class="form-control form-control-sm  autonumber" data-a-sign="Rs. "></td>
                                        </tr>

                                        <tr class="text-info">
                                            <td>
                                                <hr>
                                                <h5 class="text-primary">Total :</h5>
                                            </td>
                                            <td>
                                            <hr>
                                            <h5 class="text-primary"><input type="text" id="total_final" name="nettot" class="form-control"></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                                <div class="d-flex flex-row-reverse">
                                    <button type="submit" name="save" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>








            </div>
            <?php

            include_once "../../files/foot.php";

            ?>
            <script>
                function cal_prd_total() {
                    var pprice = $("#porder_itemprice").val();
                    var pqty = $("#porder_itemqty").val();
                    var pdis = $("#porder_itemdiscount").val();


                    var tot = parseFloat(pprice) * parseFloat(pqty) * parseFloat(pdis) / 100

                    ftot = parseFloat(pprice) * parseFloat(pqty) - parseFloat(tot)
                    $("#porder_itemfinalprice").val(ftot);
                }

                // -------------------------------------------------------------------------------------------------------------------------

                $("#add_prbtn").click(function() {

                    add_products();
                    clear_products();
                    cal_totquantity();
                    cal_totprice();
                    cal_totdiscount();
                    final_total();

                });

                // ---------------------------------------------------------------------------------------------------------------------
                function add_products() {



                    var pr_prod = $("#porder_itemproductid option:selected").val();
                    var pr_prod_name = $("#porder_itemproductid option:selected").text(); //dropdown
                    var p_price = $("#porder_itemprice").val();
                    var p_qty = $("#porder_itemqty").val();
                    var p_dis = $("#porder_itemdiscount").val();
                    var p_tot = $("#porder_itemfinalprice").val();
                    productsubtotal = parseFloat(p_price * p_qty);

                    // var tcost=(parseFloat(cost)* parseFloat(wght)* parseFloat(qty)).toFixed(3); //total

                    // var tprice=parseFloat(sprice)*parseFloat(wght)* parseFloat(qty);
                    // tprice.toFixed(3);

                    $(".itembody").append("<tr><td><input  class='form-control input-sm  ' type='hidden' name='Product[]' value='" + pr_prod + "'> <span class='tabledit-span'>" + pr_prod_name + " </span></td><td><input class='input-borderless input-sm row_data quantity' type='text' readonly name='Quantity[]' value='" + p_qty + "'><div style='color: red; display: none' class='msg1'>Digits only</div><input class='form-control input-sm subtotal'   type='text'  value='" + productsubtotal + "'></td><td><input class='input-borderless input-sm row_data price'  type='text' readonly name='Price[]' value='" + p_price + "'><div style='color: red; display: none' class='msg2'>Digits only</div>  </td><td><input class='input-borderless input-sm row_data discount' type='text' readonly name='Discount[]' value='" + p_dis + "'><div style='color: red; display: none' class='msg1'>Digits only</div></td> <td><input  class='input-borderless input-sm row_data total ' type='text' readonly  value='" + p_tot + "'></td>      <td><span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span><span class='btn_deleterow'><button type='button'  class='badge badge-danger' style='float: none;margin: 5px;'>Delete</button></span><span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span><span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Reset</button></span></td> </tr>");


                    $(".btn_save").hide();
                    $(".btn_cancel").hide();

                }

                // ----------------------------------------------------------------------------------------------------------------


                function clear_products() {



                    $("#porder_itemproductid option:selected").text(""); //dropdown
                    $("#porder_itemprice").val("");
                    $("#porder_itemqty").val("");
                    $("#porder_itemdiscount").val("");
                    $("#porder_itemfinalprice").val("");




                }
            </script>
            <script type="text/javascript" src="../javascript/editabletable.js"></script>