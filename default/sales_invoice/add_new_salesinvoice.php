<?php

   
 
// --------------------------------------------------------------------------------------------------------------------




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
                                    <h4>Add New Sales Invoice</h4>

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
                                    <h5>Add New Sales Invoice</h5>

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
                                                <label class=" col-form-label">Select Customer</label>
                                                <select class="js-example-basic-single col-sm-12" name="purchaserequestsupplier" id="purchreq_supplier">

                                                    <option value=" ">Select Customer</option>
                                                    <?php
                                                        foreach($sup as $item)
                                                      
                                                        if($item->supplier_id ==$purchase1->purchaserequest_supplier )   
			                                        echo "<option value='$item->supplier_id' selected='selected'>$item->supplier_name</option>";
                                                    else
                                                    echo"<option value='$item->supplier_id'>$item->supplier_name</option>";
                                                    ?>


                                                </select>

                                            </div>



                                            <!-- <div class="col-sm-6">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="date" name="purchaserequestdate" id="" value="<?=$purchase1->purchaserequest_date ?>">
                                            </div> -->

                                        </div>
                                        <hr>
                                      

                                      


                                        <div class="table-responsive">

                                            <table class="table table-striped table-bordered" id="example-2">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Sales Order Ref NO</th>
                                                        <th> Date</th>
                                                        <th></th>
                                                    
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






</script>
