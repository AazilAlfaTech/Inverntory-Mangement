<?php


include_once "../purchase_order/purchaseorder.php";
$purchaseorder3 = new purchaseorder();

include_once "../purchase_order/purchaseorderitem.php";
$purchaseorderitem3 = new purchaseorderitem();

if (isset($_POST['save'])) {

    $res_edit = $purchaseorderitem3->edit_POitem();
    if ($res_edit == true) {

        header("location:../purchase_order/manage_purchase_order.php?success_edit=1");
    } elseif ($res_edit == false) {

        header("location:../purchase_order/manage_purchase_order.php?notsuccess=1");
    }
} else {
    $purchaseorder3 = $purchaseorder3->get_purchaseorder_by_id($_GET['edit']);
    $purchaseorderitem3 = $purchaseorderitem3->get_all_POitem($_GET['edit']);
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
                                    <h4>Add New Purchase Order</h4>

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
                                    <h5>Add New Purchase Order</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action='edit_purch_order.php' method='POST'>




                                        <div class="form-group row">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label"> PO No</label>
                                                <input class="form-control" type="text" readonly='true' value=<?= $purchaseorder3->purchaseorder_ref ?>>

                                            </div>



                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Supplier</label>
                                                <input class="form-control" type="text" readonly='true' value="<?= $purchaseorder3->supplier_name1 ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="text" readonly='true' value=<?= $purchaseorder3->purchaseorder_date ?>>
                                            </div>
                                        </div>

                                        <br>
                                        <br>


                                        <!-- Edit With Button card start -->

                                        <div class="table-responsive">

                                            <table class="table  table-bordered " id="mytable">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Discount</th>
                                                        <th>Total</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody class="itembody">
                                                    <?php if (isset($_GET['edit'])) : ?>
                                                        <?php foreach ($purchaseorderitem3 as $item) :  ?>
                                                            <tr>
                                                                <td class='table-edit-view'><span class=''><?= $item->product_name ?></span>
                                                                    <input class='form-control input-sm  ' type='hidden' name='Product[]' value='<?= $item->po_item_productid ?>'>
                                                                    <input class='form-control input-sm  ' type='hidden' name='Orderid[]' value='<?= $item->po_item_id ?>'>
                                                                </td>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?= $item->po_item_qty ?></span>
                                                                    <input class=' input-borderless  input-sm row_data quantity' type='text' readonly name='Quantity[]' value='<?= $item->po_item_qty ?>'>
                                                                    <div style="color: red; display: none" class="msg1">Digits
                                                                        only</div>
                                                                </td>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?= $item->po_item_price ?></span>
                                                                    <input class=' input-borderless input-sm row_data price' type='text' name='Price[]' readonly value='<?= $item->po_item_price ?>'>
                                                                    <div style="color: red; display: none" class="msg2">Digits
                                                                        only</div>
                                                                </td>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?= $item->po_item_discount ?></span>
                                                                    <input class=' input-borderless input-sm row_data discount' type='text' name='Discount[]' readonly value='<?= $item->po_item_discount ?>'>
                                                                    <div style="color: red; display: none" class="msg3">Digits
                                                                        only</div>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?= $item->po_item_finalprice ?></span>
                                                                    <input class=' input-borderless input-sm  total' type='text' readonly value='<?= $item->po_item_finalprice ?>'>

                                                                </td>


                                                                <td>
                                                                    <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>
                                                                    <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>
                                                                    <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Cancel</button></span>
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
                                                    <td><input type="text" id="total_quan" name="totqty" class="form-control form-control-sm"></td>
                                                </tr>
                                                <tr>
                                                    <th> Sub Total :</th>
                                                    <td><input type="text" id="total_price" name="subtot" data-a-sign="Rs. " class=" form-control form-control-sm autonumber"></td>
                                                </tr>
                                                <tr>
                                                    <th> Total Discount :</th>
                                                    <td><input type="text" id="total_discount" name="discount tot" class="form-control form-control-sm  autonumber" data-a-sign="Rs. "></td>
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
                <?php

                include_once "../../files/foot.php";

                ?>

                <script>






                </script>
                <script type="text/javascript" src="../javascript/editabletable.js"></script>