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

if (isset($_POST["productname"]))
{
    $product1->product_name=$_POST["productname"];
    $product1->product_type=$_POST["prodtypeid"];
    $product1->product_group=$_POST["productgroup"];
    $product1->product_uom=$_POST["unitid"];
    $product1->product_desc=$_POST["productdesc"];
    $product1->product_inventory_val=$_POST["productval"];
    $product1->product_batch=$_POST["productbatch"];

    $product1->product_code = $product1->get_count($_POST["prodtypeid"],$_POST["productgroup"]);

    // $product1->product_code= $codenumber;
  



    //....................................................
    if(isset($_POST["product_id"]))
    {
        $res_edit= $product1->edit_product($_POST['product_id']); 
            //code for insert validation
            if($res_edit==true){
               
                header("location:../product/manageproduct.php?success_edit=1");
            }elseif($res_edit==false){
                header("location:../product/manageproduct.php?notsuccess=1");
            }
    }else
    {
            $res_insert=$product1->insert_product();   
            //code for insert validation
            if($res_insert==true){
                
                header("location:../product/manageproduct.php?success=1");
            }elseif($res_insert==false){
                header("location:../product/manageproduct.php?notsuccess=1");
            }
    }


}

if(isset($_GET["view_product"]))
{
    $product1=$product1->get_product_by_id2($_GET["view_product"]);
}

if(isset($_GET["d_id"]))
{
    $res_del=$product1->delete_product($_GET["d_id"]);
    if($res_del==true){
        header("location:../product/manageproduct.php?delete_success=1");
       
    }else{
       
        $msg_2="Group already exists therefore cannot delete";
    }
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
                                    <h5>
                                    <?php
                                                if(isset($_GET["view_product"]))
                                                {
                                                    echo"Edit Product";
                                                }
                                                else
                                                echo "Add New Product";
                                            ?>
                                    </h5>

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
                                                <select class="js-example-basic-single col-sm-12 productgroup" name="productgroup" id="gr_id" onchange="autocode()" required>
                                                    <option value="-1">Select Group</option>
                                                    <?php
                                                        foreach($result_group as $item)
                                                        if($item->group_id==$product1->product_typegroupID)
                                                        echo"<option value='$item->group_id' selected='selected'>$item->group_name</option>";
                                                        else
                                                        echo"<option value='$item->group_id'>$item->group_name</option>";
                                                   ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Type </label>
                                                <select class="js-example-basic-single col-sm-12 productitem" name="prodtypeid" id="type_id" onchange="autocode()" required>
                                                    <option value="-1">Select Type</option>
                                                    <?php
                                                        foreach($result_type as $item)
                                                        if($item->ptype_id==$product1->product_type)
                                                        echo"<option value='$item->ptype_id' selected='selected'>$item->ptype_name</option>";
                                                        else
                                                        echo"<option value='$item->ptype_id'>$item->ptype_name</option>";

                                                   ?>                                       
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class=" col-form-label"> Select UOM </label>
                                                <select class="js-example-basic-single col-sm-12" name="unitid" id="unit_id" required>
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
                                                <input type="text" class="form-control" placeholder="" name="productname" id="prod_name" value="<?=$product1->product_name?>" required>
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
                                                <input type="file" class="form-control" placeholder="" name="productimage" id="filer_input1"   value="">
                                            </div>
                                                <!-- <div class="col-sm-3">
                                            <img src="/IMS/inventory/default/product/productimage/<?=$product1->product_id?>.jpg" style="height: 100px; width: 150px;">  
                                            </div> -->
                                            <!-- </div> -->

                                            <!-- <div class="card-block">
                                                <div class="sub-title">Example 1</div>
                                                <input type="file" name="productimage" id="filer_input1" >
                                            </div> -->
                                            
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
                            <!-- //ALERT MESSAGES START................... -->
                            <?php
                            if(isset($_GET['success'])) {
                                echo"<div class='alert alert-success background-success'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='icofont icofont-close-line-circled text-white'></i>
                                </button>
                                <strong>New group added successfully</strong> 
                            </div>";
                            }
                            ?>
                            <?php
                            if(isset($_GET['success_edit'])) {
                                echo"<div class='alert alert-info background-info'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='icofont icofont-close-line-circled text-white'></i>
                                </button>
                                <strong>Group details updated successfully</strong> 
                            </div>";
                            }
                            ?>
                            <?php
                            if(isset($_GET['delete_success'])) {
                                echo"<div class='alert alert-danger background-danger'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='icofont icofont-close-line-circled text-white'></i>
                                </button>
                                <strong>Deleted successful</strong> 
                            </div>";
                            }
                            ?>
                            <?php
                            if(isset($_GET['d_id'])) {
                                echo"<div class='alert alert-danger background-danger'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='icofont icofont-close-line-circled text-white'></i>
                                </button>
                                <strong>$msg_2</strong> 
                            </div>";
                            }
                            ?>
                            <?php
                            if(isset($_GET['notsuccess'])) {
                                echo"<div class='alert alert-danger background-danger'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='icofont icofont-close-line-circled text-white'></i>
                                </button>
                                <strong>The code or the name already exists.Please try again</strong> 
                            </div>";
                            }
                            ?>
                            <!-- //ALERT MESSAGES END................... -->
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
                                                    <th>#</th>
                                                    <th>Product Code</th>
                                                    <th>Product Name</th>
                                                    <th>Product Group</th>
                                                    <th>Product Type</th>
                                                   <th>Action</th> 


                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                foreach ($result_product as $item)
                                                    {
                                                        echo
                                                        "<tr>
                                                            <td>$item->product_id</td>
                                                            <td>$item->product_code</td>
                                                            <td>$item->product_name</td>
                                                            <td>$item->product_typegroupname</td>
                                                            <td>$item->product_typename</td>
                                                            <td>
                                                                <div class='btn-group btn-group-sm' style='float: none;'>
                                                                <button type='button' id='editprod' onclick='view_product($item->product_id)';'check()' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><span <i class='icofont icofont-eye-alt'></i></span></button>
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

    //View the product

      // Editing the product
      function view_product(v)
    {
        window.location.href="view_product.php?view_product="+v;
    }


    $( ".alert" ).fadeIn( 300 ).delay( 3500 ).fadeOut( 400 );



</script>