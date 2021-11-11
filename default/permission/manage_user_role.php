<?php
include_once "../permission/role.php";
$role2=new role();

$resultrole=$role2->getall_roles();

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
                                    <h4>Manage User Roles</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="../permission/manage_user_role.php">ManageRoles</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <div class="d-flex flex-row-reverse">
                <a href="../permission/add_user_role.php">
                    <button class="btn btn-mat btn-primary ">Add New User Role</i></button>
                </a>
                </div>


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
                                    <h5>User Roles</h5>
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
                                                    <th>Role ID</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php
                                                    foreach($resultrole as $item){
                                                        echo"
                                                        <tr>
                                                            <td>$item->roleid</td>
                                                            <td>$item->rolename</td>
                                                            <td>$item->role_status</td>
                                                            <td>
                                                            <div class='btn-group btn-group-sm' style='float: none;'>
     
                                                                        <a type='button' href='../permission/edit_user_role.php?edit=$item->roleid'  class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><i class='fa fa-edit'></i></a>
                                                                        <button type='button'  onclick='del_group($item->roleid)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='fa fa-trash-o delete_group_name'></span></button>
                                               
                                                                    </div>
                                                            
                                                            </td>
                                                        </tr>
                                                        ";
                                                    }

                                                    ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- ----------------------------------------------------------------------------------------------------------------- -->
                            <?php

include_once "../../files/foot.php";

?>
<script>
 
</script>