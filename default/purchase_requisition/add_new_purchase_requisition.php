<?php

    include_once "purchase_requisition.php";
    include_once "../supplier/supplier.php";
    include_once "../product/product.php";
    include_once "purchase_request_item.php";

    $supplier1 = new supplier();

    $sup=$supplier1->get_all_supplier();
    // print_r($sup);

     $product1 = new product();     
     $prod=$product1->getall_product2();

    //  print_r($prod);

     $product_item1 = new purchase_request_item();

 
// --------------------------------------------------------------------------------------------------------------------


    $purchase1 = new purchaserequest(); 

    if(isset($_POST["purchaserequestsupplier"]))
{
    $purchase1->purchaserequest_supplier=$_POST["purchaserequestsupplier"];
    $purchase1->purchaserequest_date=$_POST["purchaserequestdate"];
    $purchase1->purchaserequest_ref= $purchase1->pr_code1($_POST["purchaserequestdate"]);

    $pr_id=$purchase1->insert_purchaserequest();

    $product_item1->insert_purchaserequest_item($pr_id );


}

if(isset($_GET['edit_pr'])){
  $purchase1= $purchase1->get_purchaserequest_by_id($_GET['edit_pr']);


}


// ------------------------------------------------------------------------------------------------------------
        // $pr_coe = $purchase1->pr_code();
        


        // echo $pr_coe;


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
                                    <h4>Add New Purchase Requisition</h4>

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
                                    <h5>Add New Purchase Requisition</h5>

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
                                                <label class=" col-form-label">Select Supplier</label>
                                                <select class="js-example-basic-single col-sm-12" name="purchaserequestsupplier" id="purchreq_supplier">

                                                    <option value=" ">Select supplier</option>
                                                    <?php
                                                        foreach($sup as $item)
                                                      
                                                        if($item->supplier_id ==$purchase1->purchaserequest_supplier )   
			                                        echo "<option value='$item->supplier_id' selected='selected'>$item->supplier_name</option>";
                                                    else
                                                    echo"<option value='$item->supplier_id'>$item->supplier_name</option>";
                                                    ?>


                                                </select>

                                            </div>



                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="date" name="purchaserequestdate" id="" value="<?=$purchase1->purchaserequest_date ?>">
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="form-group row">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Product</label>
                                                <select class="js-example-basic-single col-sm-12" name="pr_itemproductid" id="preq_itemproductid" > 

                                                    <option value="-1 ">Select product</option>
                                                    <?php
                                                 foreach($prod as $item)
      
                                                 if($item->product_id ==$product1->product_id)   
                                                        echo "<option value='$item->product_id' selected='selected'>$item->product_name</option>";
                                                  else
                                                    echo"<option value='$item->product_id'> $item->product_name</option>";
                                                    ?>


                                                </select>

                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Price</label>
                                                <input type="text" class="form-control" placeholder="" 
                                                name="pr_itemprice" id="preq_itemprice" onkeyup="cal_prd_total()" >
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Qty</label>
                                                <input type="text" class="form-control" placeholder=""
                                                name="pr_itemqty" id="preq_itemqty" onkeyup="cal_prd_total()" >
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Discount</label>
                                                <input type="text" class="form-control" placeholder=""
                                                name="pr_itemdiscount" Id="preq_itemdiscount" onkeyup="cal_prd_total()" >
                                            </div>

                                            <div class="col-sm-2">

                                                <label class=" col-form-label">Total</label>
                                                <input type="text" class="form-control" placeholder=""
                                                name="pr_itemfinalprice" id="preq_itemfinalprice" disabled>
                                            </div>

                                        </div>

                                        <button type="button" class="btn btn-primary" name="addprbtn" id="add_prbtn">ADD</button>
                                        <button class="btn btn-inverse">CLEAR</button>

                                        <br>
                                        <br>


                                        <div class="table-responsive">

                                            <table class="table table-striped table-bordered" id="example-2">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Discount</th>
                                                        <th>Total</th>
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



function cal_prd_total(){

   


    var pprice = $("#preq_itemprice").val();
    var pqty =$("#preq_itemqty").val();
    var pdis = $("#preq_itemdiscount").val(); 
   
    
   var tot = parseFloat(pprice)*parseFloat(pqty)*parseFloat(pdis)/100

    ftot =  parseFloat(pprice)*parseFloat(pqty) - parseFloat(tot)



    $("#preq_itemfinalprice").val(ftot);

 

    console.log(pprice);
    console.log(pqty);
    console.log(pdis);

    console.log(tot);

    console.log(ftot);





}

// -------------------------------------------------------------------------------------------------------------------------

$("#add_prbtn").click(function(){

    add_products();
    clear_products();
   
});

// ---------------------------------------------------------------------------------------------------------------------
function add_products()
    {

       
   
        var pr_prod=$("#preq_itemproductid option:selected").val(); //dropdown
        var p_price=$("#preq_itemprice").val();
        var p_qty=$("#preq_itemqty").val();
        var p_dis=$("#preq_itemdiscount").val();
        var p_tot= $("#preq_itemfinalprice").val();
        
        // var tcost=(parseFloat(cost)* parseFloat(wght)* parseFloat(qty)).toFixed(3); //total
       
        // var tprice=parseFloat(sprice)*parseFloat(wght)* parseFloat(qty);
        // tprice.toFixed(3);
        
         $("#tbody").append("<tr><td >"+1+"</td><td><input type='hidden' name='pr_item_productid[]' value='"+pr_prod+"'>"+ pr_prod +"</td><td><input type='hidden' name='pr_item_price[]' value='"+p_price+"'>"+ p_price +"</td><td><input type='hidden' name='pr_item_qty[]' value='"+p_qty+"'>"+ p_qty +"</td><td><input type='hidden' name='pr_item_discount[]' value='"+p_dis+"'>"+ p_dis +"</td> <td><input type='hidden' name='pr_item_finalprice[]' value='"+p_tot+"'>"+ p_tot +"</td> <td> <button type='button' onclick='edit_pr($item->city_id)'    class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button> </td></tr>");
         
 


    }

    // ----------------------------------------------------------------------------------------------------------------


    function clear_products()
    {

       
   
        $("#preq_itemproductid option:selected").text(""); //dropdown
       $("#preq_itemprice").val("");
      $("#preq_itemqty").val("");
        $("#preq_itemdiscount").val("");
        $("#preq_itemfinalprice").val("");
        
      


    }


    
    function edit_pr(edit_pr) {


window.location.href = "add_new_purchase_requisition.php?edit_pr=" + edit_pr;



}



</script>
