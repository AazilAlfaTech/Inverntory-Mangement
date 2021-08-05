<?php

include_once "product.php";
include_once "../group/group.php";
include_once "../producttype/producttype.php";
include_once "../uom/uom.php";

$group1=new group();
$result_group=$group1->get_all_group();

$ptype1=new producttype();
$result_type=$ptype1->getall_type();

$uom1=new uom();
$result_uom=$uom1->get_all_uom();

$product1=new product();

if(isset($_POST["productname"]))
{
    $product1->product_name=$_POST["productname"];
    $product1->product_type=$_POST["prodtypeid"];
    $product1->product_uom=$_POST["unitid"];
    $product1->product_desc=$_POST["productdesc"];
    $product1->product_inventory_val=$_POST["productval"];
    $product1->product_batch=$_POST["productbatch"];

    if(isset($_POST['product_id']))
    {
        $product1->edit_product($_POST['product_id']);
        // header("location:manageproduct.php");
    }else

    $product1->insert_product();
    header("location:manageproduct.php");
}

if(isset($_GET["view_product"]))
{
    $product1=$product1->get_product_by_id($_GET["view_product"]);
}

if(isset($_GET["d_id"]))
{
    $product1->delete_product($_GET["d_id"]);
}
$result_product=$product1->getall_product2();
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
                                    <h4>Manage Product </h4>

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
                                    <h5>Add New Product </h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block" >

                                    <form method="POST" action="manageproduct.php" enctype="multipart/form-data">
                                            <?php
                                                if(isset($_GET["view_product"]))
                                                {
                                                    echo"<input type='text' class='form-control' value='".$_GET['view_product']."' name='product_id' required>";
                                                }
                                            ?>


                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class=" col-form-label"> Select Group</label>
                                                <select class="form-control productgroup" name="" id="gr_id" onchange="autocode()">
                                                    <option value="-1">Select Group</option>
                                                    <?php
                                                        foreach($result_group as $item)
                                                        // if($item->ptype_id==$product1->product_type->ptype_group_id)
                                                        // echo"<option value='$item->ptype_group_id' selected='selected'>".$item->ptype_id->ptype_group_id->group_name."</option>";
                                                        // else
                                                        echo"<option value='$item->group_id'>$item->group_name</option>";
                                                   ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Type </label>
                                                <select class="form-control productitem" name="prodtypeid" id="type_id" onchange="autocode()">
                                                    <option value="-1">Select Type</option>
                                                    <?php
                                                        foreach($result_type as $item)
                                                        if($item->ptype_id==$product1->product_type->ptype_id)
                                                        echo"<option value='$item->ptype_id' selected='selected'>$item->ptype_name</option>";
                                                        else
                                                        echo"<option value='$item->ptype_id'>$item->ptype_name</option>";

                                                   ?>                                       
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class=" col-form-label"> Select UOM </label>
                                                <select class="form-control" name="unitid" id="unit_id">
                                                    <option value="-1">Select UOM</option>
                                                    <?php
                                                        foreach($result_uom as $item)
                                                        if($item->uom_id==$product1->product_uom->uom_id)
                                                        echo"<option value='$item->uom_id' selected='selected'>$item->uom_name</option>";
                                                        else
                                                        echo"<option value='$item->uom_id'>$item->uom_name</option>";
                                                   ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class=" col-form-label"> Product Name</label>
                                                <input type="text" class="form-control" placeholder="" name="productname" id="prod_name" value="<?=$product1->product_name?>">
                                            </div>

                                            <div class="col-sm-4">
                                                <label class=" col-form-label"> Inventory Valuation</label>
                                                <br>
                                            
                                                <input type="radio" name="productval" id="prod_valf" value="FIFO" <?php if($product1->product_inventory_val=="FIFO"){ ?> checked="checked"<?php } ?>>
                                                <i class="helper"></i>FIFO
                                                <input type="radio" name="productval" id="prod_vala" value="AVCO"<?php if($product1->product_inventory_val=="AVCO"){ ?> checked="checked"<?php } ?>>
                                                 <i class="helper"></i>AVCO
                                                                       


                                            </div>
                                            <div class="col-sm-4" id="pbatch">
                                                <label class=" col-form-label"> Product batch</label>
                                                <input type="text" class="form-control" placeholder="" name="productbatch" id="prod_batch" value="<?=$product1->product_batch?>">
                                            </div>

                                        </div>


                                        <div class="form-group row">

                                            <div class="col-sm-6">
                                                <label class=" col-form-label"> Product Discription</label>
                                                <textarea rows="5" cols="5" class="form-control"
                                                    placeholder="Default textarea" name="productdesc" id="prod_desc"> <?php if(isset($_GET['view_product'])) { echo "$product1->product_desc";} ?></textarea>
                                            </div>

                                            <!-- <div class="col-sm-4">
                                                <label class=" col-form-label"> Product code</label>
                                                <input type="text" class="form-control" placeholder="" name="productcode" id="prod_code"   value="<?=$product1->product_code?>">
                                            </div> -->

                                            <!-- <div class="col-sm-6 row"> -->
                                            <div class="col-sm-3">
                                                <label class=" col-form-label"> Product image</label>
                                                <input type="file" class="form-control" placeholder="" name="productimage" id="prod_image"   value="">
                                            </div>
                                                <div class="col-sm-3">
                                            <img src="/IMS/inventory/default/product/productimage/<?=$product1->product_id?>.jpg" style="height: 100px; width: 150px;">  
                                            </div>
                                            <!-- </div> -->
                                            
                                        </div>

                                        <button class="btn btn-primary" type="submit">ADD</button>
                                        <button class="btn btn-inverse" type="reset">CLEAR</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

                <!-- ----------------------------------------------------------------------------------------------------------------------------- -->



                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Autofill table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Product List</h5>
                                    <span></span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block"  style="display: none;">
                                    <div class="dt-responsive table-responsive">
                                        <table id="autofill" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Product Code</th>
                                                    <th>Product Name</th>
                                                    <th>Product Group</th>
                                                    <th>Product Type</th>
                                                    <!-- <th>Product UOM</th> -->


                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                foreach ($result_product as $item)
                                                    {
                                                        echo
                                                        "<tr>
                                                            <td>$item->product_code</td>
                                                            <td>$item->product_name</td>
                                                            <td>".$item->groupname->group_name."</td>
                                                            <td>".$item->product_type->ptype_name."</td>
                                                            <td>
                                                                <div class='btn-group btn-group-sm' style='float: none;'>
                                                                    <button type='button' id='editprod' onclick='edit_product($item->product_id)';'check()' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button>
                                                                    <button type='button'  onclick='delete_product($item->product_id)'   class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
                                                                </div>
                                                            </td>
                                                        </tr>";
                                                    }
                                            ?>
                                            </tbody>    
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- ----------------------------------------------------------------------------------------------------------------- -->
                            <?php

include_once "../../files/foot.php";

?>
<script type="text/javascript" src="../javascript/masterfile.js"></script>

<script>
    // Hiding the product batch textbox
    $("#pbatch").hide();

    // Deleting the product
    function delete_product(deleteid) {

    if (confirm("Are you sure you want to delete product ?" + "" + deleteid)) {
        window.location.href = "manageproduct.php?d_id=" + deleteid;
    }


    }

    // Editing the product
    function edit_product(e)
    {
        window.location.href="manageproduct.php?view_product="+e;
    }
</script>