<?php
include_once "inetrlocationtransfer.php";
$inter_loc_tr1 = new inter_loc_transfer();

include_once "../location/location.php";
$loc1 = new location();

include_once "../product/product.php";
$prod1 = new product();

$res_prod = $prod1->getall_product2();

$res_loc = $loc1->get_all_location();

// $res_inter_loc1 = $inter_loc_tr1->get_inter_loc_transfer_by_id($_GET['edit_int']);

// --------------------------------------------------------------------------------------------------------------------

if (isset($_POST['inter_loc_transferdate'])) {


    // $inter_loc_tr1->inter_loc_transfer_code = $_POST['inter_loc_transfercode'];
    $inter_loc_tr1->inter_loc_transfer_date = $_POST['inter_loc_transferdate'];
    $inter_loc_tr1->inter_loc_transfer_from = $_POST['inter_loc_transferfrom'];
    $inter_loc_tr1->inter_loc_transferto = $_POST['inter_loc_transferto'];
    $inter_loc_tr1->inter_loc_transfer_code = $inter_loc_tr1->int_loc_code1($_POST["inter_loc_transferdate"]);

    $inter_loc_tr1->insert_inter_loc_transfer();
}

// ------------------------------------------------------------------------------------------------------------
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
                                    <h4>Interlocation Stock Transfer</h4>

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
                                    <h5>Interlocation Stock Transfer</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action="add_interlocation_tr.php" method="POST">




                                        <div class="form-group row">

                                            <!-- <div class="col-sm-6">
                                                <label class=" col-form-label">Code</label>
                                                <input class="form-control" type="text" name="inter_loc_transfercode" id="" value="" required>
                                                
                                            </div> -->



                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="date" name="inter_loc_transferdate" id="" value="<?= $res_inter_loc1->purchaserequest_date ?>" required>
                                            </div>

                                        </div>
                                        <div class="form-group row">

                                            <div class="col-sm-6">
                                                <label class=" col-form-label">From</label>
                                                <select class="js-example-basic-single col-sm-12 fromloc" name="inter_loc_transferfrom" id="inter_loc_transferfrom" required>

                                                    <option value=" ">Select Location</option>
                                                    <?php
                                                        foreach ($res_loc as $item)
                                                            echo "<option value='$item->location_id'>$item->location_name</option>";
                                                    ?>


                                                </select>

                                            </div>



                                            <div class="col-sm-6">
                                                <label class=" col-form-label">To</label>
                                                <select class="js-example-basic-single col-sm-12" name="inter_loc_transferto" id="inter_loc_transferto" required>

                                                    <option value=" ">Select Location</option>
                                                    <?php
                                                    foreach ($res_loc as $item)

                                                        if ($item->location_id == $res_inter_loc1->purchaserequest_supplier)
                                                            echo "<option value='$item->location_id' selected='selected'>$item->location_name</option>";
                                                        else
                                                            echo "<option value='$item->location_id'>$item->location_name</option>";
                                                    ?>


                                                </select>
                                            </div>

                                        </div>

                                        <hr>

                                        <div class="form-group row">

<div class="col-sm-4">
    <label class=" col-form-label">Select Product</label>
    <select class="js-example-basic-single col-sm-12 grn_product" name="int_itemproductid" id="int_itemproductid">

        <option value="-1 ">Select product</option>
        <?php
        foreach ($res_prod as $item)

                echo "<option value='$item->product_id'> $item->product_name</option>";
        ?>


    </select>

</div>
<div class="col-sm-4">

    <label class=" col-form-label">Select Batch No</label>
    <select class="js-example-basic-single col-sm-12 prodbatch" name="int_itemproductbatch" id="int_itemproductbatch" >
        <option value="-1 ">Select Batch No</option>
    </select>
</div>


<div class="col-sm-4">

    <label class=" col-form-label">Qty</label>
    <input type="text" class="form-control" placeholder="" name="int_item_qty" id="int_itemqty" disabled>
</div>



<!-- <div class="col-sm-2">

    <label class=" col-form-label">Total</label>
    <input type="text" class="form-control" placeholder="" name="pr_itemfinalprice" id="preq_itemfinalprice" disabled>
</div> -->

</div>

                                        


                                 
                                        <button type="button" class="btn btn-primary" name="addprbtn" id="add_prbtn">ADD</button>
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
                                                        <th>Batch No</th>

                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">


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



                <?php

                include_once "../../files/foot.php";

                ?>


                <script>


                    // Filtering the products according to the slected location
                    $(".fromloc").change(function()
                    {
                        // console.log("Hello");
                        var location_id=$(".fromloc").val();
                        console.log(location_id);
                        $.get("../ajax/ajaxpurchase.php?type=get_prod_byloc",{loc_id:location_id},function(data)
                        {
                        console.log(data);
                        var d=JSON.parse(data);
                        $("#int_itemproductid").html("");
                        $("#int_itemproductid").append("<option value=''>Select Product</option>");
                        $.each(d,function(i,x)
                        {
                            console.log(i);
                            console.log(x);
                            $("#int_itemproductid").append("<option value='"+d[i].grn_item_productid+"'> "+d[i].grn_item_prodname+" </option>");
                        });
                        });
                    });


                    // Filtering the product batch according to the slected products
                        $(".grn_product").change(function()
                    {
                        console.log("Hello");
                        var product_id=$(".grn_product").val();
                        console.log(product_id);
                        $.get("../ajax/ajaxpurchase.php?type=get_productbatchby_prodid",{prodid:product_id},function(data)
                        {
                        console.log(data);
                        var d=JSON.parse(data);
                        $("#int_itemproductbatch").html("");
                        $("#int_itemproductbatch").append("<option value=''>Select Batch No</option>");
                        $.each(d,function(i,x)
                        {
                            console.log(i);
                            console.log(x);
                            $("#int_itemproductbatch").append("<option value='"+d[i].product_batch+"'> "+d[i].product_batch+" </option>");
                        });
                        });
                    });

                    // Filtering the product batch according to the slected products
                    $(".prodbatch").change(function()
                    {
                        console.log("Hello");
                        var prodbatch=$(".prodbatch").val();
                        console.log(prodbatch);
                        $.get("../ajax/ajaxpurchase.php?type=get_productqty_prodbatch",{prod_batch:prodbatch},function(data)
                        {
                        console.log(data);
                        var d=JSON.parse(data);
                        $.each(d,function(i,x)
                        {
                            console.log(i);
                            console.log(x);
                            $("#int_itemqty").val(d[i].grn_item_remain_qty);
                        });
                        });
                    });


                    // Adding products to the dynamic table
                    function add_products()
                    {
                        var inter_loc_prodid=$("int_itemproductid option:selected").val();
                        var inter_loc_prodname=$("int_itemproductid option:selected").text();
                        var inter_loc_prodbatch=$("int_itemproductbatch option:selected").val();
                        var inter_loc_prodqty=$("int_itemqty").val();

                        if($('#int_itemproductid').val()=='' || $('#int_itemproductbatch').val()=='' || $('#int_itemqty').val()=='')
                        {
                            $(".error_fields").show().delay( 1000 ).fadeOut( 1000 );
                        }
                        else
                        {
                            
                        }
                    }

                    // function cal_prd_total() {
                    //     var pprice = $("#int_itemprice").val();
                    //     var pqty = $("#int_itemqty").val();
                    //     var pdis = $("#int_batch").val();


                    //     var tot = parseFloat(pprice) * parseFloat(pqty) * parseFloat(pdis) / 100

                    //     ftot = parseFloat(pprice) * parseFloat(pqty) - parseFloat(tot)



                    //     $("#preq_itemfinalprice").val(ftot);



                        // console.log(pprice);
                        // console.log(pqty);
                        // console.log(pdis);

                        // console.log(tot);

                        // console.log(ftot);





            //         }

            //         // -------------------------------------------------------------------------------------------------------------------------

            //         $("#add_prbtn").click(function() {

            //             add_products();
            //             clear_products();

            //         });

            //         // ---------------------------------------------------------------------------------------------------------------------
            //         function add_products() {
            //             var sq_prod = $("#int_itemproductid option:selected").val();
            //             var sq_prod_name = $("#int_itemproductid option:selected").text(); //dropdown
            //             var sq_price = $("#int_itemprice").val();
            //             var sq_qty = $("#int_itemqty").val();
            //             var sq_dis = $("#int_batch").val();
            //             var sq_fprice = $("#int_itemfinalprice").val();
            //             sq_subtotal = parseFloat(sq_price * sq_qty)

            //             $("#tbody").append("<tr>\
            // <td class='table-edit-view' >" + sq_prod_name + "\
            //     <input  class='form-control input-sm productid  ' type='hidden' name='sq_item_productid[]' value='" + sq_prod + "'>\
            // </td>\
            // <td class='table-edit-view'>\
            //     <input class='input-borderless input-sm row_data price'  type='text' readonly name='sq_item_price[]' value='" + sq_price + "'> <div style='color: red; display: none' class='msg2'>'Digits only'</div> \
            //     <input class='form-control input-sm subtotal'   type='hidden'  value='" + sq_subtotal + "'>\
            // </td>\
            // <td class='table-edit-view'>\
            //     <input class='input-borderless input-sm row_data quantity' type='text' readonly name='sq_item_qty[]' value='" + sq_qty + "'> <div style='color: red; display: none' class='msg1'>'Digits only'</div>\
            // </td>\
            // <td class='table-edit-view'>\
            //     <input class='input-borderless input-sm row_data discount' type='text' readonly name='sq_item_discount[]' value='" + sq_dis + "'><div style='color: red; display: none' class='msg3'>'Digits only'</div>\
            // </td>\
            // <td>\
            //     <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>\
            //     <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>\
            //     <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Cancel</button></span>\
            // </td>\
            //  </tr>");


            //             $(".btn_save").hide();
            //             $(".btn_cancel").hide();

            //         }

                    // ----------------------------------------------------------------------------------------------------------------


                    // function clear_products() {



                    //     $("#preq_itemproductid option:selected").text(""); //dropdown
                    //     $("#int_itemprice").val("");
                    //     $("#int_itemqty").val("");
                    //     $("#int_batch").val("");
                    //     $("#preq_itemfinalprice").val("");




                    // }



                    // function edit_pr(edit_pr) {


                    //     window.location.href = "add_new_purchase_requisition.php?edit_pr=" + edit_pr;



                    // }



                    // ========================================================================================================================
               </script>
                <script type="text/javascript" src="../javascript/editabletable.js"></script>