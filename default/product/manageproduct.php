<?php

include_once "product.php";
include_once "../group/group.php";
include_once "../producttype/producttype.php";
include_once "../location/location.php";
// include_once "../uom/uom.php";
include_once "../../files/head.php";

$group1=new group();
$result_group=$group1->get_all_group();

$ptype1=new producttype();
$result_type=$ptype1->getall_type();

$location1=new location();
$result_location=$location1->get_all_location();

$product1=new product();
$result_product=$product1->getall_product();


if(isset($_POST["productname"]))
{
    $product1->product_name=$_POST["productname"];
    $product1->product_type=$_POST["ptypeid"];
    // $product1->product_uom=$_POST["unitid"];
    $product1->product_desc=$_POST["productdesc"];
    $product1->product_inventory_value=$_POST["radio"];
    $product1->product_batch=$_POST["productbatch"];

    $product1->insert_product();
    

}

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

                                <div class="card-block"  style="display: none;">

                                    <form method="POST" action="manageproduct.php">



                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class=" col-form-label"> Select Group</label>
                                                <select name="select" class="form-control" name="groupid" id="gr_id">
                                                    <option value="-1">Select Group</option>
                                                    <?php
                                                        foreach($result_group as $item)
                                                        echo"<option value='$item->group_id'>$item->group_name</option>"
                                                   ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Select Type </label>
                                                <select name="select" class="form-control" name="ptypeid" id="typ_id">
                                                    <option value="-1">Select Type</option>
                                                    <?php
                                                        foreach($result_type as $item)
                                                        echo"<option value='$item->ptype_id'>$item->ptype_name</option>"
                                                   ?>                                       
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class=" col-form-label"> Select UOM </label>
                                                <select name="select" class="form-control" name="unitid" id="unit_id">
                                                    <option value="-1">Select UOM</option>
                                                    <!-- <?php
                                                        foreach($result_uom as $item)
                                                        echo"<option value='$item->uom_id'>$item->uom_name</option>"
                                                   ?> -->
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class=" col-form-label"> Product Name</label>
                                                <input type="text" class="form-control" placeholder="" name="productname" id="prod_name">
                                            </div>

                                            <div class="col-sm-4">
                                                <label class=" col-form-label"> Inventory Valuation</label>

<br>
                                            
                                                                                <input type="radio" name="radio" checked="checked">
                                                                                <i class="helper"></i>FIFO

                                                                                <input type="radio" name="radio">
                                                                                <i class="helper"></i>AVCO
                                                                       


                                            </div>
                                            <div class="col-sm-4">
                                                <label class=" col-form-label"> Product batch</label>
                                                <input type="text" class="form-control" placeholder="" name="productbatch" id="prod_batch">
                                            </div>

                                        </div>


                                        <div class="form-group row">

                                            <div class="col-sm-6">
                                                <label class=" col-form-label"> Product Discription</label>
                                                <textarea rows="5" cols="5" class="form-control"
                                                    placeholder="Default textarea" name="productdesc" id="prod_desc"></textarea>
                                            </div>


                                        </div>

                                        <button class="btn btn-primary" type="submit">ADD</button>
                                        <button class="btn btn-inverse">CLEAR</button>
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
                                    <h5>Location List</h5>
                                    <span></span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="autofill" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Product Code</th>
                                                    <th>Product Name</th>
                                                    <!-- <th>Product Group</th> -->
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
                                                            <td>".$item->product_type->ptype_name."</td>
                                                            <td>
                                                                <button class='btn btn-mat btn-danger' onclick='del_type($item->product_id)'><i class='fa fa-trash'></i>  </button>
                                                                <button class='btn btn-mat btn-info' onclick='edit_type($item->product_id)'><i class='fa fa-edit'></i> </button>
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