<?php

    include_once "GRN.php";
    include_once "grn_item.php";
    include_once "../purchase_order/purchaseorder.php";
    include_once "../location/location.php";

    $po1=new purchaseorder();
    $result_po=$po1->get_all_purchaseorder();
    // $result_po2=$po1-> get_purch_byid($_GET["view"]);
    
    $grn1=new grn();
    // $result_grn1=$grn1-> get_purchsup_by_prid($_GET["view"]);
    // $result_grn2=$grn1-> get_all_grn_by_poid($_GET["view"]);
    $grn_item1=new grn_item();

    if(isset($_GET["view"]))
    {
        $result_po2=$po1-> get_purchaseorder_by_id($_GET["view"]);
        $result_grn1=$po1->get_purchaseorder_by_id($_GET["view"]);
        $result_grn2=$grn1-> get_all_grn_by_poid($_GET["view"]);
    }

    $location1=new location();
    $result_location1=$location1->get_all_location();

    // insert grn details
    if(isset($_POST["grnpurchorderid"]))
    {
        $grn1->grn_puch_order_id=$_POST["grnpurchorderid"];
        $grn1->grn_received_loc=$_POST["grnrecievedloc"];
        $grn1->grn_date=$_POST["grndate"];
        $grn1->grn_ref_no=$grn1->grn_code($_POST["grndate"]);

        $result_grn1=$grn1->insert_grn();
        $grn_item1->insert_grnitem($result_grn1);
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
                                    <h4>Add New GRN</h4>

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
                            <!-- .................................. -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Select Purchase Order</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block" style="display: none;">
                                    <div class="dt-responsive table-responsive">
                                        <table id="autofill" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Reference No</th>
                                                    <th>Date </th>
                                                    <th>Supplier</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                    <?php
                                                        foreach ($result_po as $item)
                                                        {
                                                            echo
                                                            "<tr>
                                                           
                                                                <td>$item->purchaseorder_ref</td>
                                                                <td>$item->purchaseorder_date</td>
                                                                <td>$item->supplier_name1</td>

                                                                <td> 
                                                                    <div class='btn-group btn-group-sm' style='float: none;'>
                                                                        <button type='button' class='btn btn-primary btnadd' onclick='po_details($item->purchaseorder_id)'><i class='fa fa-check-square'></i></button>
                                                                    </div>
                                                                </td>
                                                            </tr> ";
                                                        }
                                                    ?>
                                                

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>    
                <!-- ....................................................................................................... -->
                            <div class="card">
                                <div class="card-block">

                                    <form method="POST" action="add_new_GRN.php">
                                       
                                        <div class='form-group row'>
                                            <?php
                                                if(isset($_GET['view'])):?>
                                                
                                                    
                                                    <input type='hidden' class='form-control' value=<?=$_GET['view']?> name='grnpurchorderid' required>
                          

                                                    <div class='col-sm-6'>
                                                        <label class='col-form-label' >PO ref no</label>
                                                        <input class='form-control' id='po' type='text' name='purch_order' disabled='true' value=<?=$result_po2->purchaseorder_ref?>>
                                                    </div>

                                                    <div class='col-sm-6'>
                                                        <label class='col-form-label' >Supplier</label>
                                                        <input class='form-control' id='po_supp' type='text' disabled='true' value=<?=$result_grn1->supplier_name1?>>
                                                    </div>
                                       
                                                <?php endif ;?>
                                                
                                            
                                        </div>         
                                        <div class='form-group row'>

                                            <div class='col-sm-6'>
                                                <label class='col-form-label'> GRN Date</label>
                                                <input class='form-control' type='date' name='grndate' value="<?php echo date('Y-m-d');?>">
                                            </div>
                                            <div class='col-sm-6'>
                                                <label class='col-form-label' name='grnrecievedloc'>Received location</label>
                                                <select class='js-example-basic-single col-sm-12' name='grnrecievedloc'>
                                                   <?php 
                                                    foreach($result_location1 as $item)
                                                    
                                                        echo"<option value='$item->location_id'>$item->location_name</option>";
                                                    
                                                    ?>
                                                </select>

                                            </div>

                                        </div>
                                                </div>    

                                
                                        <br>
                                        <br>


                                        <!-- Edit With Button card start -->

                                        <div class="table-responsive">
                                            <table  class='table  table-bordered'  id='example-2'>
                                                <thead class='table-primary'>
                                                    <tr>
                        
                                                        <th>Product Name</th>
                                                        <th>Quantity </th>
                                                        <th>Price</th>
                                                        <th>Discount</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($_GET['view'])):?>
                                                        <?php   foreach($result_grn2 as $item):?>  
                                                            <tr>                                                                  <tr>
                                                                <!-- <td scope='row'>1</td> -->
                                                                <td class='table-edit-view'><span class=''><?=$item->purchaseorder_itemname?></span>
                                                                    <input class='form-control input-sm' type='hidden' name='grn_itemid[]' value='<?=$item->purchaseorder_itemid?>'>
                                                                    <input class='form-control input-sm' type='text' name='grn_itemid_inventory[]' value='<?=$item->purchaseorder_productinventory?>'>
                                                                </td>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?=$item->purchaseorder_qty?></span>
                                                                    <input class='input-borderless input-sm row_data quantity' type='text' readonly  name='grn_item_qty[]' value='<?=$item->purchaseorder_qty?>'><div style="color: red; display: none" class="msg1">Digits only</div>
                                                                </td>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?=$item->purchaseorder_itemprice?></span>
                                                                    <input class='input-borderless input-sm row_data price' type='text' readonly  name='grn_itemprice[]' value='<?=$item->purchaseorder_itemprice?>'><div style="color: red; display: none" class="msg2">Digits only</div>
                                                                </td>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?=$item->purchaseorder_itemdiscount?></span>
                                                                    <input class='input-borderless input-sm row_data discount' type='text' readonly  name='grn_item_discount[]' value='<?=$item->purchaseorder_itemdiscount?>'><div style="color: red; display: none" class="msg3">Digits only</div>
                                                                </td>
                                                                            
                                                                <td class='table-edit-view'><span class='tabledit-span'><?=$item->purchaseorder_itemfinalprice ?></span>
                                                                    <input class='input-borderless input-sm row_data total'   type='text' readonly value='<?=$item->purchaseorder_itemfinalprice ?>'>
                                                                </td>
                                                                <td>
                                                                    <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>
                                                                    <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>
                                                                    <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Cancel</button></span>
                                                                </td>
                                                            </tr>
                                                    
                                                        <?php endforeach ;?>
                                                    <?php endif ;?>        
                                                </tbody>
                                            </table>
                                                <!-- <div class="card">   -->
                                                    
                                                    
                                                    <table class="table table-responsive invoice-table invoice-total">
                                                        <tbody class="pricelist">
                                                            <tr>
                                                                <th> Total Quantity :</th>
                                                                <td ><input type="text" id="total_quan" name="totqty" class="form-control form-control-sm" ></td>
                                                            </tr>
                                                            <tr>
                                                                <th> Sub Total :</th>
                                                                <td ><input type="text" id="total_price" name="subtot" data-a-sign="Rs. " class=" form-control form-control-sm autonumber"></td>
                                                            </tr>
                                                            <tr>
                                                                <th> Total Discount :</th>
                                                                <td ><input type="text" id="total_discount" name="discount tot" class="form-control form-control-sm  autonumber" data-a-sign="Rs. " ></td>
                                                            </tr>
                                                        
                                                            <tr class="text-info">
                                                                <td>
                                                                    <hr>
                                                                    <h5 class="text-primary">Total :</h5>
                                                                </td>
                                                                <td>
                                                                    <hr>
                                                                    <h5 class="text-primary"><input type="text" id="total_final" name="nettot"  class="form-control"></h5>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>





                                        <div class="d-flex flex-row-reverse">
                                            <button type="submit" name="save" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>

                                </div>

                            </div>
                        </div>
                    </div>





           


                <!-- </div> -->






                <?php

include_once "../../files/foot.php";

?>
<script type="text/javascript" src="../javascript/editabletable.js"></script>


<script>
     function po_details(po)
    {
        window.location.href="add_new_GRN.php?view="+po;
    }
</script>
