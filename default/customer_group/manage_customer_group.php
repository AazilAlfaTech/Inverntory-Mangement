<?php


include_once "customer_group.php";

    $customergroup1 = new customergroup();
    
    //code to insert and update data............................................................... 
    
    if(isset($_POST["submit"]))
{
    $group1->import_customer_group();
    
}
    
    if (isset($_POST["cust_grcode"]))
    {
        $customergroup1->customergroup_code = $_POST["cust_grcode"];
            $customergroup1->customergroup_name = $_POST["cust_grname"];
        //....................................................
        if(isset($_POST["edit_cus_grp"]))
        {
            $res_edit=$customergroup1->edit_customer_group ($_POST["edit_cus_grp"]);
                //code for insert validation
                if($res_edit==true){
                   
                    header("location:../customer_group/manage_customer_group.php?success_edit=1");
                }elseif($res_edit==false){
                    header("location:../customer_group/manage_customer_group.php?notsuccess=1");
                }
        }else
        {
                $res_insert=$customergroup1->insert_customer_group();   
                //code for insert validation
                if($res_insert==true){
                    
                    header("location:../customer_group/manage_customer_group.php?success=1");
                }elseif($res_insert==false){
                    header("location:../customer_group/manage_customer_group.php?notsuccess=1");
                }
        }
    
    
    }

    //code to get data into datatable.........................................................................................
    $result_customer_group = $customergroup1->get_all_customer_group();

    //code to view cu
    if(isset($_GET['edit_cus_grp'])){
        $customergroup1=$customergroup1->get_customer_group_by_id($_GET['edit_cus_grp']);
        
    }



    if(isset($_GET['d_id'])){
        $res_del=$customergroup1->delete_customer_group ($_GET['d_id']);
       
                //code for delete validations
            if($res_del==true){
               
            header("location:../customer_group/manage_customer_group.php?delete_success=1");
            }else{
                $msg_2="Group already exists therefore cannot delete";
            }
    }

    // print_r($result_customer_group);
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
                                    <h4>Manage Customer Group</h4>

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
                                    <h5>Import Customer Group</h5>
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
                                    <h5>Add New Customer Group</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form method="POST" action="manage_customer_group.php">




                                        <div class="form-group row">

                                        <?php
                                   
                                   if(isset($_GET["edit_cus_grp"])){
                                    echo"  <input type='hidden'  class='form-control' value='".$_GET['edit_cus_grp'] ."' name='edit_cus_grp' required readonly>";
                                   }
                                    

                                   ?>

                                            <div class="col-sm-6">

                                                <label class=" col-form-label">Customer Group Code</label>
                                                <input type="text" class="form-control" placeholder="" pattern="^[A-Z0-9]*$"
                                                    value="<?=$customergroup1->customergroup_code ?>" <?php if($customergroup1->customergroup_code ){echo "readonly=\"readonly\"";} ?> name="cust_grcode"
                                                    id="cust_gr_code" onblur="check_customer_groupcode()" required>
                                                    <div class="col-form-label" id="codecheck_msg" style="display:none;">Sorry, that code is taken. Try
                                                            another?
                                                    </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Customer Group Name</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="<?=$customergroup1->customergroup_name ?>" name="cust_grname"
                                                    id="cust_gr_name" onblur="check_customer_groupname()" required >
                                                    <div class="col-form-label" id="namecheck_msg" style="display:none;">Sorry, that name is taken. Try
                                                            another?
                                                    </div>
                                                

                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">ADD</button>
                                        <button type="reset" class="btn btn-inverse">CLEAR</button>
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
                                    <h5>Customer Group List</h5>
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
                                                    <th>Customer Group Code</th>
                                                    <th> Customer Group Name</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($result_customer_group as $item){
                                                                    echo"
                                                                    <tr>
                                                                
                                                                        <td>$item->customergroup_code</td>
                                                                        <td>$item->customergroup_name  </td>
                                                                     

                                                                        <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                                        <button type='button' onclick='edit_cus_grp($item->customergroup_id)' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><i class='fa fa-edit'></i></span></button> </a>
                                                                        <button type='button'  onclick='delete_cus_grp($item->customergroup_id)'   class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><i class='fa fa-trash-o'></i></button>
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

    <!-- ------------------------------------------------------------------------------------------------------ -->


    <script type="text/javascript" src="../javascript/customer.js"></script>
    <script>
        $( ".alert" ).fadeIn( 300 ).delay( 3500 ).fadeOut( 400 );

    function edit_cus_grp(edit_cus_grp) {

        console.log(edit_cus_grp);
        window.location.href = "manage_customer_group.php?edit_cus_grp=" + edit_cus_grp;


    }


    function delete_cus_grp(deleteid) {

        if (confirm("Do you want to delete id" + " " + deleteid)) {
            window.location.href = "manage_customer_group.php?d_id=" + deleteid;
        }

    }
    </script>