<?php



include_once "group.php";
$group1=new group();//create a new object 

if(isset($_POST["groupcode"])){
    $group1->group_code=$_POST["groupcode"];
    $group1->group_name=$_POST["groupname"];
    $group1->insert_group();
}

if(isset($_GET['view'])){
    $group1=$group1->get_group_by_id($_GET['view']);
}

$result_group=$group1->get_all_group();
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
                                    <h4>Manage Product Group</h4>

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
                                    <h5>Add New Product Group</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form action="manageproductgroup.php" method="POST" id="submitgroup">



                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Group Code</label>

                                                <input type="text" name="groupcode" class="form-control" id="gr_code" value="<?=$group1->group_code ?>" placeholder="">
                                                <input type="text" name="groupid" class="form-control" id="gr_id" value="<?=$group1->group_id ?>" placeholder="">

                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Group Name</label>
                                                <input type="text" name="groupname" class="form-control" id="gr_name" value="<?=$group1->group_name ?>" placeholder="">

                                                <input type="text" class="form-control" placeholder="" name="groupcode" id="gr_code">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Group Name</label>
                                                <input type="text" class="form-control" placeholder="" name="groupname" id="gr_name">

                                            </div>
                                        </div>

                                        <button type="submit"  class="btn btn-primary">ADD</button>
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
                    <h5>Product List</h5>
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
                                    <th>#</th>
                                    <th>Group Code</th>
                                    <th>Group Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($result_group as $item)
                                    {echo"
                                        <tr>
                                            <td>$item->group_id</td>
                                            <td>$item->group_code</td>
                                            <td>$item->group_name</td>
                                            <td><div class='btn-group btn-group-sm' style='float: none;'>
                                            <button type='button' onclick='editgroup($item->group_id)' data-toggle='modal' data-target='#category-edit' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button>
                                               <button type='button'  onclick='deletegroup($item->group_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
                                               
                                           </div></td>
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

<script>

//function to view details when user clicks edit button

    function editgroup(id){
        window.location.href="manageproductgroup.php?view="+id;

        // console.log(id);
        // console.log(groupcode1);
        // console.log(groupname1);
        // $("#gr_id").val(id);
        // $("#gr_code").val(groupcode1);
        // $("#gr_name").val(groupname1);
    }

//function to edit group detais
$("#submitgroup").on("submit",function(e){
    e.preventDefault();
    var group_form=$("#submitgroup");
    //console.log(group_form);
    name=$("#gr_name").val();
    $.post("../group/editgroup_handle.php",group_form.serialize(),function(res) {
        alert(res)

});


    
  });

  function deletegroup(deleteid){
    if(confirm("Do you want to delete id"+""+deleteid))
			{
				window.location.href="manageproductgroup.php?delete="+d;
			}
  }
</script>