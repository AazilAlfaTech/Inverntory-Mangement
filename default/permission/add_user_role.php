<?php

include_once "../permission/role.php";
$role2=new role();
include_once "../permission/user_role.php";
$userperm_2=new user_role();



if (isset($_POST["save"])) {
    $role2->rolename=$_POST['role'];
    $role_id=$role2->insert_role();
    $userperm_2-> add_userrolepermission($role_id);

}

include_once "../../files/head.php";

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
                                    <h4>Add User Role</h4>

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

                <!-- <div class="d-flex flex-row-reverse">
                <a href="add_new_GRN.php">
                    <button class="btn btn-mat btn-primary ">Add New GRN</i></button>
                </a>
                </div> -->


                <br>
                <br>

                <!-- ----------------------------------------------------------------------------------------------------------------------------- -->



                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Autofill table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Add User Role</h5>
                                    <span></span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>
                        <div class="card-block">


                            <form method="POST" action="add_user_role.php">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="login-form">
                                            <div class="form-group">
                                                <label> User Role</label>
                                                <input type="text" class="form-control" placeholder="" name="role">
                                            </div>

                                        </div>

                                </div>




                                </div>


                                <hr>
                                <div class="userform">
                                
                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> User</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox checkselect" type="checkbox"  value="2">
                                            <label class="border-checkbox-label" for="checkbox1">Select All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">

                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox checkboxval" type="checkbox" name="permid[]"  value="5">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox checkboxval" type="checkbox" name="permid[]"  value="6" >
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary"  >
                                            <input class="border-checkbox checkboxval" type="checkbox" name="permid[]" value="7" >
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox checkboxval" type="checkbox" name="permid[]" value="8">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>



                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> User Role</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox checkselect" type="checkbox"  value="3">
                                            <label class="border-checkbox-label" for="checkbox1">Select All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox checkboxval" type="checkbox" name="permid[]" value="7">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox checkboxval" type="checkbox" name="permid[]" value="7">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary" >
                                            <input class="border-checkbox checkboxval" type="checkbox" name="permid[]" value="7">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox checkboxval2" type="checkbox" name="permid[]" value="7">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>


                                <hr>
                                </div>
                                <!-- <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Supplier Group</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>



                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Supplier</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox"name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>



                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Customer</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>



                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Customer Group</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>



                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Product </h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>




                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Product Group</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>


                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Product type</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>



                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Location</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>


                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> UOM</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>



                                <hr>

                                
                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Purchase Request</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>
                                         <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Request Approval</label>
                                        </div>

                                    </div>

                                </div>


                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Purchase Oredr</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>





                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> GRN</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>





                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Sales Quotation</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>




                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Sales Order</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>





                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Sales Invoice</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>





                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Sales Dispatch</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>



                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> City</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>





                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Sales Rep</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>





                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Interlocation Transfer</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>





                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Sales Report</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>


                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Purchase Report</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div>



                                <hr>

                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="d-inline">
                                            <h4> Inventory Report</h4>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" id="checkbox1">
                                            <label class="border-checkbox-label" for="checkbox1">Selecet All</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">View</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Add</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Edit</label>
                                        </div>
                                        <div class="border-checkbox-group border-checkbox-group-primary">
                                            <input class="border-checkbox" type="checkbox" name="permid[]">
                                            <label class="border-checkbox-label" for="checkbox1">Delete</label>
                                        </div>

                                    </div>

                                </div> -->






                                <button class="btn btn-primary" type="submit" name="save">Submit</button>
                                                            
                            </form>

                        </div>







                            <?php

                            include_once "../../files/foot.php";

                            ?>


<script>
    $( document ).ready(function() {
        $("form").on('change', '.checkselect', function(){
    
  
    //get the closest row OR the particular row you chosen to edit
    var tbl_row = $(this).closest('.row');
    console.log($(this).val());
    var inputs=tbl_row.find('.checkboxval');
    // console.log(inputs);
    for (var i = 0; i < inputs.length; i++) {   
        console.log(i);
        inputs[i].checked = $(this).prop('checked');   
      
    }  

    
});

    });


</script>
                          