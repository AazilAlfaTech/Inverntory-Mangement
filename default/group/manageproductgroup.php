<?php



include_once "group.php";
$group1=new group();//create a new object 

if(isset($_POST["groupcode"])){
    $group1->group_code=$_POST["groupcode"];
    $group1->group_name=$_POST["groupname"];

    if(isset($_POST['groupid'])){
        $group1->edit_group($_POST['groupid']);
        echo"<div class='alert alert-success background-success'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <i class='icofont icofont-close-line-circled text-white'></i>
        </button>
        <strong>Success!</strong> Add Class <code> background-success</code>
    </div>";
        //header("location:../group/manageproductgroup.php");
    }else
    $group1->insert_group();
   // header("location:../group/manageproductgroup.php");
}

if(isset($_GET['view'])){
    $group1=$group1->get_group_by_id($_GET['view']);
}

if(isset($_GET['delete'])){
    $group1->delete_group($_GET['delete']);
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

                                                <input type="text" name="groupcode" class="form-control" id="gr_code" onblur="check_groupcode()" onkeyup="check_groupcode()" value="<?=$group1->group_code ?>" placeholder="" required>
                                                <div class="col-form-label" id="codecheck_msg" style="display:none;">Sorry, that code is taken. Try
                                                            another?
                                                </div>
                                                <?php
                                   
                                    if(isset($_GET["view"])){
                                     echo"  <input type='hidden'  class='form-control' value='".$_GET['view'] ."' name='groupid' required>";
                                    }
                                     

                                    ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class=" col-form-label">Group Name</label>
                                                <input type="text" name="groupname" class="form-control" id="gr_name" value="<?=$group1->group_name ?>" onblur="check_groupname()" onkeyup="check_groupname()" placeholder="" required>
                                                <div class="col-form-label" id="codecheck_msg" style="display:none;">Sorry, that name is taken. Try
                                                            another?
                                                </div>
                                                
                                            </div>
                                            
                                        </div>

                                        <button type="submit"  class="btn btn-primary">ADD</button>
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
                                            <td id='gr_id_td'>$item->group_id</td>
                                            <td>$item->group_code</td>
                                            <td>$item->group_name</td>
                                            <td><div class='btn-group btn-group-sm' style='float: none;'>
                                            <button type='button' id='$item->group_id' data-toggle='modal' data-target='#category-edit' class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button>
                                               <button type='button'  id='$item->group_id' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete delete_group'></span></button>
                                               
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
<script type="text/javascript" src="..\..\default\javascript\masterfile.js"></script>
<script>
     function check_groupcode(){
       let code=$("#gr_code").val();
       console.log(code);
       var codelegnth=code.length
      //$("#codecheck_msg").show();
      if(codelegnth>1){
        $.get("../ajax/ajaxmaster.php?type=checkgroupcode&productgroup_code="+code,"",function(data){
          var tmp=JSON.parse(data);
          console.log(tmp);
            if(tmp.group_id>0)
            {
            $("#codecheck_msg").show();
          }else{
            console.log("error")
          }
        });
      }
     }
</script>
