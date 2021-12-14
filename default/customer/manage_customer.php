<?php

include_once "customer.php";
include_once "../customer_group/customer_group.php";
include_once "../city/city.php";
include_once "../salesrep/salesrep.php";

//get list of cities for a dropdown.....................................................
    $city1 = new city();
    $result_city=$city1->get_all_city();
//get a list customer group for drown...................................................
    $customer_grp = new customergroup();
    $result_cus_group=$customer_grp->get_all_customer_group();
//get a list sales rep..................................................................... 
    $salesrep2=new salesrep();
    $result_salesrep=$salesrep2->get_all_salesrep();

    //object of customer class
    $customer1 = new customer();

    // import customer
    if(isset($_POST["submit"]))
    {
        $group1->import_customer();
        
    }

//insert/edit a new cutomer..................................................................
if (isset($_POST["custcode"]))
{
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
    //....................................................
    if(isset($_POST["edit_cus"]))
    {
            $res_edit= $customer1->edit_customer($_POST["edit_cus"]);
            //code for insert validation
            if($res_edit==true){
               echo "edited";
                header("location:../customer/manage_customer.php?success_edit=1");
            }
    }else
    {

        // if($user4->check("PCA", 63)){
            $res_insert=$customer1->insert_customer();;  
            //code for insert validation
            if($res_insert==true){
                
                header("location:../customer/manage_customer.php?success=1");
            }elseif($res_insert==false){
                header("location:../customer/manage_customer.php?notsuccess=1");
            }
        // }else{
        //     echo"No permission";

        // }
           
    }


}

 // get customer details into datatable.....................................................   
    $result_customer=$customer1->get_all_customer();

// view customer details for edit......................................................
    if(isset($_GET['edit_cus'])){
        $customer1=$customer1->get_customer_by_id($_GET['edit_cus']);
    }


//delete customer.........................................................................
$msg_2="";//alert message for delete
    if(isset($_GET['d_id'])){
        $res_del=$customer1->delete_customer ($_GET['d_id']);
       
        if($res_del==true){
                
            header("location:../customer/manage_customer.php?delete_success=1");
        }else{
        
            $msg_2="Customer already exists therefore cannot delete";
        }
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
                                    <h5>Import Customer</h5>
                                    <span></span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                
                                                <input type="file" name="doc" class="form-control">

                                            </div>
                                            <div class="col-sm-2">
                                            <button type="submit" name="submit" class="btn btn-primary">submit</button>
                                            </div>
                                        </div>
                            
                                    </form>
                                </div>
                            </div>
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
                                                    pattern="^[A-Z0-9]*$" onkeyup="check_customer_code()"
                                                    onblur="check_customer_code()" id="cust_code"
                                                    value="<?=$customer1->customer_code ?>"
                                                    <?php if($customer1->customer_code){echo "readonly=\"readonly\"";} ?>
                                                    required>
                                                <div class="col-form-label" id="codecheck_msg" style="display:none;">
                                                    Sorry, that name is taken. Try
                                                    another?
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class=" col-form-label">Customer Group</label>
                                                <select class="js-example-basic-single col-sm-12" name="custgroup"
                                                    id="cust_group" required>

                                                    <option value=" ">Select Customer Group</option>
                                                    <?php

                                                        foreach($result_cus_group as $item)
                                                      
                                                        if($item->customergroup_id==$customer1->customer_group)   
			                                        echo "<option value='$item->customergroup_id' selected='selected'>$item->customergroup_name</option>";
                                                    else
                                                    echo"<option value='$item->customergroup_id'>$item->customergroup_name</option>";
                                                    ?>

                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Customer Name</label>
                                                <input type="text" class="form-control" placeholder="" name="custname"
                                                    id="cust_name" value="<?=$customer1->customer_name ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Contact Number</label>
                                                <input type="text" class="form-control" placeholder="" name="custno"
                                                    onblur="check_customer_contact()" onkeyup="check_customer_contact()"
                                                    pattern="[0-9]{10}" id="cust_no"
                                                    value="<?=$customer1->customer_contactno ?>" required>
                                                <div class="col-form-label" id="contactcheck_msg" style="display:none;">
                                                    Sorry, that contact number is taken. Try
                                                    another?
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">E-mail</label>
                                                <input type="email" class="form-control" placeholder=""
                                                    name="cust_email" onkeyup="check_customer_mail()"
                                                    onblur="check_customer_mail()" id="cust_email"
                                                    value="<?=$customer1->customer_email ?>" required>
                                                <div class="col-form-label" id="mailcheck_msg" style="display:none;">
                                                    Sorry, that e-mail is taken. Try
                                                    another?
                                                </div>
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
                                                    id="cust_add" value="<?=$customer1->customer_add ?>" required>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class=" col-form-label">City</label>
                                                <select class="js-example-basic-single col-sm-12 customercity"
                                                    name="custcity" id="cust_city" required>

                                                    <!-- location not done -->
                                                    <option value="-1">Select City</option>
                                                    <?php

                                                        foreach($result_city as $item)
                                                      
                                                        if($item->city_id==$customer1->customer_city)   
			                                        echo "<option value='$item->city_id' selected='selected'>$item->city_name</option>";
                                                    else
                                                    echo"<option value='$item->city_id'>$item->city_name</option>";
                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                        <hr>


                                        <div class="form-group row">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Sales Rep</label>
                                                <select class="js-example-basic-single col-sm-12" name="custsrep"
                                                    id="cust_salesrep" required>
                                                    <option value=" ">Select Sales rep</option>
                                                    <?php
                                                        foreach($result_salesrep as $item)
                                                      
                                                        if($item->salesrep_id==$customer1->customer_salesrep)   
			                                        echo "<option value='$item->salesrep_id' selected='selected'>$item->salesrep_name</option>";
                                                    else
                                                    echo"<option value='$item->salesrep_id'>$item->salesrep_name</option>";
                                                    ?>


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
                                                    id="cust_creditlimit"
                                                    value="<?=$customer1->customer_creditlimit ?>">
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
                            <!-- //ALERT MESSAGES START................... -->
                            <?php
                            if(isset($_GET['success'])) {
                                echo"<div class='alert alert-success background-success'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='icofont icofont-close-line-circled text-white'></i>
                                </button>
                                <strong>New location added successfully</strong> 
                            </div>";
                            }
                            ?>
                            <?php
                            if(isset($_GET['success_edit'])) {
                                echo"<div class='alert alert-info background-info'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='icofont icofont-close-line-circled text-white'></i>
                                </button>
                                <strong>Location details updated successfully</strong> 
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
                                <strong>The code or the e-mail already exists.Please try again</strong> 
                            </div>";
                            }
                            ?>
                            <!-- //ALERT MESSAGES END................... -->
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
                                                    <th>#</th>
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

                                                                        <td>$item->customer_id</td>
                                                                        <td>$item->customer_code</td>
                                                                        <td>$item->customer_name  </td>
                                                                        <td>$item->customer_contactno </td>
                                                                      
                                                                     
                                                                     

                                                                        <td><div class='btn-group btn-group-sm' style='float: none;'>";
                                                                        if($user4->check("PCV",65)){
                                                                            echo"<button type='button' id='editprod' onclick='view_cus($item->customer_id)';'check()' class='tabledit-edit-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;'><i class='fa fa-eye'></i></button>";
                                                                        }
                                                                        if($user4->check("PCE",64)){
                                                                            echo" <button type='button' onclick='edit_cus($item->customer_id)' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><i class='fa fa-edit'></i></button> </a>";
                                                                        }
                                                                        if($user4->check("PCD",66)){
                                                                            echo" <button type='button'  onclick='delete_cus($item->customer_id)'   class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><i class='fa fa-trash-o'></i></button>";
                                                                        }
                                                                        
                                                                                                                                                
                                                                        
                                                                       
                                                                       
                                                                     echo" </td> 
                                               
                                               
                                                                       
                                                                       
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


                            <script type="text/javascript" src="../javascript/customer.js"></script>
                            <script>
                            $(".alert").fadeIn(300).delay(3500).fadeOut(400);

                            function edit_cus(edit_cus) {


                                window.location.href = "manage_customer.php?edit_cus=" + edit_cus;



                            }

                            function view_cus(edit_cus) {


                                window.location.href = "view_customer.php?edit_cus=" + edit_cus;


                            }

                            function delete_cus(deleteid) {

                                if (confirm("Do you want to delete id" + " " + deleteid)) {
                                    window.location.href = "manage_customer.php?d_id=" + deleteid;
                                }

                            }
                            </script>