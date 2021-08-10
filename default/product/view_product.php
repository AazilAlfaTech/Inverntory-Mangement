<?php

include_once "product.php";
include_once "../group/group.php";
include_once "../producttype/producttype.php";
include_once "../uom/uom.php";



$product1=new product();

   $prd = $product1->get_product_by_id($_GET["view_product"]);


//    print_r($prd);





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
                                    <h4>   Product Details</h4>

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
                                     
                                    </h5>

                                  
                                </div>

                                <div class="card-block" >



                                <div class="card product-detail-page">
                                                    <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-lg-5 col-xs-12">
                                                                <div class="port_details_all_img row">
                                                                    <div class="col-lg-12 m-b-15">
                                                                        <div id="big_banner">
                                                                            <div class="port_big_img">
                                                                                <img class="img img-fluid" src="..\files\assets\images\product-detail\pro-d-l-1.jpg" alt="Big_ Details">
                                                                            </div>
                                                                        
                                                                        </div>
                                                                    </div>
                                                             
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-7 col-xs-12 product-detail" id="product-detail">
                                                                <div class="row">
                                                                    <div>
                                                                        <div class="col-lg-12">
                                                                            <span class="txt-muted d-inline-block">Product Code: <a href="#!"> <?= $prd->product_code  ?> </a> </span>
                                                                      
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <h4 class="pro-desc"><?= $prd->product_name  ?></h4>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <span class="txt-muted"> Group : <?= $prd->product_group  ?> </span> <br>
                                                                            <span class="txt-muted"> Type  : <?= $prd->product_name  ?> </span><br>
                                                                            <span class="txt-muted"> UOM  : <?= $prd->product_name  ?> </span><br>
                                                                            <span class="txt-muted"> Inventory Valuation : <?= $prd->product_inventory_val  ?> </span><br>
                                                                        </div>
                                                                    
                                                                      
                                                                        <div class="col-xl-3 col-sm-12">
                                                                            <div class="p-l-0 m-b-25">
                                                                                <div class="input-group">
                                                                                 
                                     
                                                                                  
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                   
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Product detail page end -->

                                 
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

















<!-- ----------------------------------------------------------------------------------------------------------------- -->
                            <?php

include_once "../../files/foot.php";

?>

