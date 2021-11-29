<?php
include_once "interlocationtransfer.php";
$inter_loc_tr1 = new inter_loc_transfer();

include_once "interlocationtransfer_item.php";
$inter_loc_tritem1= new interloctranfer_item();

include_once "../location/location.php";
$loc1 = new location();

// include_once "../product/product.php";
// $prod1 = new product();

// $res_prod = $prod1->getall_product2();

$res_loc = $loc1->get_all_location();

// $res_inter_loc1 = $inter_loc_tr1->get_inter_loc_transfer_by_id($_GET['edit_int']);

// --------------------------------------------------------------------------------------------------------------------

if (isset($_POST['inter_loc_transferdate'])) {

    // $inter_loc_tr1->inter_loc_transfer_code = $_POST['inter_loc_transfercode'];
    $inter_loc_tr1->inter_loc_transfer_date = $_POST['inter_loc_transferdate'];
    $inter_loc_tr1->inter_loc_transfer_from = $_POST['inter_loc_transferfrom'];
    $inter_loc_tr1->inter_loc_transfer_to = $_POST['inter_loctransferto'];
    $inter_loc_tr1->inter_loc_transfer_code = $inter_loc_tr1->int_loc_code1($_POST["inter_loc_transferdate"]);

    $inter_locid=$inter_loc_tr1->insert_inter_loc_transfer();
    $inter_loc_tritem1->insert_interloctranfer_item($inter_locid,$_POST['inter_loc_transferfrom'],$_POST['inter_loctransferto']);
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
                                                <input class="form-control" type="date" name="inter_loc_transferdate" id="" value="<?php echo date('Y-m-d');?>" required>
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
                                                <select class="js-example-basic-single col-sm-12 toloc" name="inter_loctransferto" id="inter_loc_transferto" required>

                                                    <option value=" ">Select Location</option>
                                                    <?php
                                                     
                                                     foreach ($res_loc as $item)
                                                         echo "<option value='$item->location_id'>$item->location_name</option>";
                                                
                                                    ?>


                                                </select>
                                                <br>
                                            <span class='error_fields'><label class="label label-md label-danger" >Invalid To Location</label></span>
                                            </div>
                                            

                                        </div>

                                        <hr>

                                        <div class="form-group row">

<div class="col-sm-4">
    <label class=" col-form-label">Select Product</label>
    <select class="js-example-basic-single col-sm-12 grn_product" name="int_itemp_roductid" id="int_itemproductid">

        <option value="-1 ">Select product</option>
        <?php
        foreach ($res_prod as $item)

                echo "<option value='$item->product_id'> $item->product_name</option>";
        ?>


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

                                        


                                 
                                        <button type="button" class="btn btn-primary" name="addint btn" id="add_intbtn">ADD</button>
                                        <button type="button" class="btn btn-inverse reset">CLEAR</button>


                                        <br>
                                        <br>


                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        
                                                        <th>Product</th>
                                                        <th>Qty</th>
                                                        

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

                    $(document).ready(function()
                    {
                        $(".error_fields").hide();

                    });

                    // From and To locations cannot be same
                    $(".toloc").change(function()
                    {
                        var fromloc=$(".fromloc").val();
                        console.log(fromloc);
                        if($(".toloc").val()==fromloc)
                        {
                            // console.log("Invalid to location");
                            $(".error_fields").show().delay( 1000 ).fadeOut( 1000 );
                           
                        }
                    });

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
                            $("#int_itemproductid").append("<option value='"+d[i].stock_productid+"'> "+d[i].product_name+" </option>");
                        });
                        });
                    });


                    // Filtering the product batch according to the slected products
                    //     $(".grn_product").change(function()
                    // {
                    //     console.log("Hello");
                    //     var product_id=$(".grn_product").val();
                    //     console.log(product_id);
                    //     $.get("../ajax/ajaxpurchase.php?type=get_productbatchby_prodid",{prodid:product_id},function(data)
                    //     {
                    //     console.log(data);
                    //     var d=JSON.parse(data);
                    //     $("#int_itemproductbatch").html("");
                    //     $("#int_itemproductbatch").append("<option value=''>Select Batch No</option>");
                    //     $.each(d,function(i,x)
                    //     {
                    //         console.log(i);
                    //         console.log(x);
                    //         $("#int_itemproductbatch").append("<option value='"+d[i].product_batch+"'> "+d[i].product_batch+" </option>");
                    //     });
                    //     });
                    // });

                    // Filtering the product batch according to the slected products
                    $(".grn_product").change(function()
                    {
                        console.log("Hello");
                        
                        var product_id=$(".grn_product").val();
                        var location_id=$(".fromloc").val();
                       
                        $.get("../ajax/ajaxpurchase.php?type=get_productqty_prodid",{prodid:product_id,location:location_id},function(data)
                        {
                        console.log(data);
                        var d=JSON.parse(data);
                        $("#int_itemqty").val(d.grn_qty);

                        
                        });
                    });





                    // When add button is clicked
                    $("#add_intbtn").click(function() 
                    {

                        add_products();
                        clear_products();

                    });

                    // Adding products to the dynamic table
                    function add_products()
                    {
                        console.log("Hey");
                        var inter_loc_prodid=$("#int_itemproductid option:selected").val();
                        var inter_loc_prodname=$("#int_itemproductid option:selected").text();
                       // var inter_loc_prodbatch=$("#int_itemproductbatch option:selected").val();
                        var inter_loc_prodqty=$("#int_itemqty").val();
                        console.log(inter_loc_prodid);

                        if($('#int_itemproductid').val()==''  || $('#int_itemqty').val()=='')
                        {
                            $(".error_fields").show().delay( 1000 ).fadeOut( 1000 );
                        }
                        else
                        {
                            $("#tbody").append("<tr>\
                            <td class='table-edit-view' >\
                            <input  class='input-borderless input-sm productid' type='hidden'readonly name='intloc_item_productid[]' value='"+inter_loc_prodid+"'>\
                            <input  class='input-borderless input-sm productid' type='text' readonly name='' value='"+inter_loc_prodname+"'>\                            </td>\
                            <td class='table-edit-view'>\
                                <input class='input-borderless input-sm row_data quantity' type='text' readonly name='intloc_item_qty[]' value='" + inter_loc_prodqty + "'> <div style='color: red; display: none' class='msg1'>'Digits only'</div>\
                            </td>\
                            <td>\
                                <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>\
                                <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>\
                                <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Cancel</button></span>\
                            </td>\
                            </tr>");


                        $(".btn_save").hide();
                        $(".btn_cancel").hide();
                        }
                    }

                   

            //         // -------------------------------------------------------------------------------------------------------------------------

                    // $("#add_prbtn").click(function() {

                    //     add_products();
                    //     clear_products();

                    // });

            //         // ---------------------------------------------------------------------------------------------------------------------
                   
                    // ----------------------------------------------------------------------------------------------------------------


                    function clear_products() {

                        $('#int_itemproductid').prop('selected', function() {
                            return this.defaultSelected;
                        });

                        // $("#int_itemproductid option:selected").text(""); //dropdown
                        // $("#int_itemproductbatch").val("");
                        $("#int_itemqty").val("");
                       
                    }



                    // function edit_pr(edit_pr) {


                    //     window.location.href = "add_new_purchase_requisition.php?edit_pr=" + edit_pr;



                    // }



                    // ========================================================================================================================
               </script>
                <script type="text/javascript" src="../javascript/editabletable.js"></script>