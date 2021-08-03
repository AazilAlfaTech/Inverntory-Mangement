<?php

include_once "customer.php";
include_once "../customer_group/customer_group.php";

    $customer_grp = new customergroup();

    $result_cus_group=$customer_grp->get_all_customer_group();

    $customer1 = new customer();


    if(isset($_POST["custcode"])){


        $customer1->customer_code = $_POST["custcode"];
        $customer1->customer_name  = $_POST["custname"];
        $customer1->customer_add = $_POST["custadd"];
        $customer1->customer_contactno = $_POST["custno"];
        $customer1->customer_email = $_POST["cust_email"];
        $customer1->customer_city = $_POST["custcity"];
        $customer1->customer_group = $_POST["custgroup"];
        $customer1->customer_salesrep = $_POST["custsrep"];
        $customer1->customer_creditdays = $_POST["custcdays"];
        $customer1->customer_creditlimit = $_POST["custclimit"];
        
       

        
        if(isset($_POST["edit_cus_grp"])){
            
            $customer1->edit_customer ($_POST["edit_cus_grp"]);
            header("location:../customer/manage_customer.php ");
        }
else{
        $customer1->insert_customer();
        header("location:../customer/manage_customer.php ");
    }
    }

    
    $result_customer=$customer1->get_all_customer();

    if(isset($_GET['edit_cus'])){
        $customer1=$customer1->get_customer_by_id($_GET['edit_cus']);
    }



    if(isset($_GET['d_id'])){
        $customer1->delete_customer ($_GET['d_id']);
        header("location:../customer/manage_customer.php ");
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
                                    <h4>Manage Customer </h4>

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
                                    <h5>Add New Customer </h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action="manage_customer.php" method="POST">



                                        <div class="form-group row">

                                            <?php
                                   
                                   if(isset($_GET["edit_cus"])){
                                    echo"  <input type='text'  class='form-control' value='".$_GET['edit_cus'] ."' name='edit_cus' required readonly>";
                                   }
                                    

                                   ?>
                                            <div class="col-sm-3">
                                                <label class=" col-form-label">Customer Code</label>
                                                <input type="text" class="form-control" placeholder="" name="custcode"
                                                    id="cust_code" value="<?=$customer1->customer_code ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class=" col-form-label">Customer Group</label>
                                                <select class="js-example-basic-single col-sm-12" name="custgroup"
                                                    id="cust_group">

                                                    <option value="-1">Select Customer Group</option>
                                                   <?php
                                                        foreach($result_cus_group as $item)
                                                      
                                                        if($item->customergroup_id==$customer1->customer_group->customergroup_id)   
			                                        echo "<option value='$item->customergroup_id' selected='selected'>$item->customergroup_name</option>";
                                                    else
                                                    echo"<option value='$item->customergroup_id'>$item->customergroup_name</option>";
                                                    ?>

                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Customer Name</label>
                                                <input type="text" class="form-control" placeholder="" name="custname"
                                                    id="cust_name" value="<?=$customer1->customer_name ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Contact Number</label>
                                                <input type="text" class="form-control" placeholder="" name="custno"
                                                    id="cust_no" value="<?=$customer1->customer_contactno ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">E-mail</label>
                                                <input type="text" class="form-control" placeholder="" name="cust_email"
                                                    id="cust_email" value="<?=$customer1->customer_email ?>">
                                            </div>


                                        </div>


                                        <hr>

                                        <div class="">
                                            <span>Customer Address</span>
                                        </div>

                                        <div class="form-group row">


                                            <div class="col-sm-9">
                                                <label class=" col-form-label">Street</label>
                                                <input type="text" class="form-control" placeholder="" name="custadd"
                                                    id="cust_add" value="<?=$customer1->customer_add ?>">
                                            </div>

                                            <div class="col-sm-3">
                                                <label class=" col-form-label">City</label>
                                                <select class="js-example-basic-single col-sm-12" name="custcity"
                                                    id="cust_city">

                                                    <!-- location not done -->
                                                    <option value="-1">Select Customer Group</option>
                                                   <?php
                                                        foreach($result_cus_group as $item)
                                                      
                                                        if($item->customergroup_id==$customer1->customer_group->customergroup_id)   
			                                        echo "<option value='$item->customergroup_id' selected='selected'>$item->customergroup_name</option>";
                                                    else
                                                    echo"<option value='$item->customergroup_id'>$item->customergroup_name</option>";
                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                        <hr>


                                        <div class="form-group row">

                                        <div class="col-sm-4">
                                                <label class=" col-form-label">Sales Rep</label>
                                                <select class="js-example-basic-single col-sm-12" name="custsrep"
                                                    id="cust_salesrep" value="<?=$customer1->customer_salesrep ?>">

                                                    <option value="1">Alabama</option>
                                                    <option value="2">Wyoming</option>
                                                    <option value="2">Peter</option>
                                                    <option value="3">Hanry Die</option>
                                                    <option value="4">John Doe</option>

                                                </select>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Credit Days</label>
                                                <input type="text" class="form-control" placeholder="" name="custcdays"
                                                    id="cust_creditdays" value="<?=$customer1->customer_creditdays ?>">
                                            </div>

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Credit Limit</label>
                                                <input type="text" class="form-control" placeholder="" name="custclimit"
                                                    id="cust_creditlimit" value="<?=$customer1->customer_creditlimit ?>">
                                            </div>

                                         
                                        </div>

                                        <button type="submit" class="btn btn-primary">ADD</button>
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
                                    <h5>Customer List</h5>
                                    <span></span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block" style="display: none;">
                                    <div class="dt-responsive table-responsive">
                                        <table id="autofill" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Customer Code</th>
                                                    <th> Customer Name</th>
                                                    <th>Contact Number </th>
                                               

                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
  foreach($result_customer as $item){
                                                                    echo"
                                                                    <tr>
                                                                
                                                                        <td>$item->customer_code</td>
                                                                        <td>$item->customer_name  </td>
                                                                        <td>$item->customer_contactno </td>
                                                                     
                                                                     

                                                                        <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                                        <button type='button' onclick='edit_cus($item->customer_id)' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button> </a>
                                                                        <button type='button'  onclick='delete_cus($item->customer_id)'   class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
                                               </td> 
                                               
                                               
                                                                       
                                                                       
                                                                    </tr>
                                                                    ";
  }

?>

                                                </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>





















                            <!-- ----------------------------------------------------------------------------------------------------------------- -->
                            <?php

include_once "../../files/foot.php";

?>
                            <!-- ------------------------------------------------------------------------------------------------- -->


                            <script type="text/javascript" src="../javascript/masterfile.js"></script>
                            <script>
                            function edit_cus(edit_cus) {


                                window.location.href = "manage_customer.php?edit_cus=" + edit_cus;


                            }


                            function delete_cus(deleteid) {

                                if (confirm("Do you want to delete id" + " " + deleteid)) {
                                    window.location.href = "manage_customer.php?d_id=" + deleteid;
                                }

                            }
                            </script>