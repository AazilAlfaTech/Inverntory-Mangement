<?php
    include_once "GRN.php";
    include_once "grn_item.php";
    include_once "../location/location.php";
    include_once "../../files/head.php";

    $grn3=new grn();
    $result_grn3=$grn3->get_grn_byid($_GET["view"]);
    $result_grn4=$grn3->get_all_grn_by_grnid($_GET["view"]);


    $grn_item3= new grn_item();
    $result_grnitem3=$grn_item3->get_grnitem_byid($_GET["view"]);

    $location2=new location();
    $result_location2=$location2->get_all_location();
?>
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
                                    <h4>Edit GRN</h4>

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

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>
                                    Edit GRN
                                    </h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action="manageproductgroup.php" method="POST" id="submitgrn">
                                    <div class='form-group row'>

                                        <div class='col-sm-6'>
                                            <label class='col-form-label' >GRN ref no</label>
                                            <input class='form-control' id='po' type='text' name='purch_order' disabled='true' value="<?=$result_grn3->grn_id?>">
                                        </div>

                                        <div class='col-sm-6'>
                                            <label class='col-form-label' >Supplier</label>
                                            <input class='form-control' id='po_supp' type='text' disabled='true' value="<?=$result_grn4->purchaseorder_supplier?>">
                                        </div>
                                       
                                    
                                        </div>         
                                        <div class='form-group row'>

                                            <div class='col-sm-6'>
                                                <label class='col-form-label'> GRN Date</label>
                                                <input class='form-control' type='date' name='grndate' value="<?=$result_grn3->grn_date?>">
                                            </div>
                                            <div class='col-sm-6'>
                                                <label class='col-form-label' name='grnrecievedloc'>Received gto location</label>
                                                <select class='js-example-basic-single col-sm-12' name='grnrecievedloc'>
                                                   <?php 
                                                    foreach($result_location2 as $item)
                                                    if($item->location_id==$grn3->grn_received_loc)
                                                        echo"<option value='$item->location_id' selected='selected'>$item->location_name</option>";
                                                    else
                                                        echo"<option value='$item->location_id'>$item->location_name</option>";
                                                    
                                                    ?>
                                                </select>

                                            </div>

                                        </div>
                                    

                                
                                        <br>
                                        <br>


                                        <!-- Edit With Button card start -->

                                        <div class="table-responsive">
                                        <table  id="example-1">
                                                    <table class="table table-striped table-bordered" id="mytable">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Product Name</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th>Discount</th>
                                                                <th>Total</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="po_table">
                                                            <?php if(isset($_GET['view'])):?>
                                                                <?php   foreach($result_grnitem3 as $item):?>
    
                                                                    <tr>
                                                                        <td scope='row'><?=$item->grn_item_prodid->product_id?></td>
                                                                        <td class='table-edit-view'><span class=''><?=$item->grn_item_prodid->product_name?></span>
                                                                            <input class='form-control input-sm' type='hidden' name='grn_itemid[]' value='<?=$item->purchaseorder_itemid?>'>
                                                                        </td>
                                                                        <td class='table-edit-view'><span class='tabledit-span'><?=$item->grn_item_price?></span>
                                                                            <input class='form-control input-sm row_data price' type='hidden' name='grn_itemprice[]' value='<?=$item->purchaseorder_itemprice?>'>
                                                                        </td>
                                                                        <td class='table-edit-view'><span class='tabledit-span'><?=$item->grn_item_qty?></span>
                                                                            <input class='form-control input-sm row_data quantity' type='hidden' name='grn_item_qty[]' value='<?=$item->purchaseorder_qty?>'>
                                                                        </td>
                                                                        <td class='table-edit-view'><span class='tabledit-span'><?=$item->grn_item_dis?></span>
                                                                        <input class='form-control input-sm row_data discount' type='hidden' name='grn_item_discount[]' value='<?=$item->purchaseorder_itemdiscount?>'>
                                                                         </td>
                                                                         <td class='table-edit-view'><span class='tabledit-span'><?=$item->grn_item_finalprice?></span>
                                                                            <input class='form-control input-sm row_data finalprice' type='hidden' disabled="true" name='grn_item_finalprice[]' value='<?=$item->purchaseorder_itemfinalprice?>'>
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
                <!-- page body end -->
            </div>     
        </div>
        <!-- main body end -->
    </div>
</div>


<!-- ----------------------------------------------------------------------------------------------------------------- -->
  <?php
    include_once "../../files/foot.php";
  ?>
<script>
     function po_details(po)
    {
        window.location.href="add_new_GRN.php?view="+po;
    }
</script>