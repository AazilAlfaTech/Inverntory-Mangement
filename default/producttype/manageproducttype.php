<?php

include_once ("producttype.php");
include_once "../group/group.php";

$producttype1=new producttype ();
$group=new group();
//code to group names in the drop down list...................................................
$result_group=$group->get_all_group();

//code to insert and update data............................................................... 

if (isset($_POST["typename"]))
{
    $producttype1->ptype_name=$_POST["typename"];
    $producttype1->ptype_group_id=$_POST["typegroup"];
    $producttype1->ptype_code=$_POST["typecode"];

    if(isset($_POST['ptypeid']))
    {
        $res_edit=$producttype1->edit_type($_POST['ptypeid']);
    }else
        {$res_insert=$producttype1->add_type();}

        //code for alert validations
            if($res_insert==true){
                header("location:../producttype/manageproducttype.php?success=1");
            }elseif($res_edit==true){
            header("location:../producttype/manageproducttype.php?success_edit=1");
            }else{
            echo"False";
            }
    }
//code to view group................................................................
$result_ptype=$producttype1->getall_type();

if(isset($_GET["view"]))
{
    $producttype1=$producttype1->get_type_by_id($_GET["view"]);
}
//code to delete group..................................................................................
$msg_2="";//alert message for delete

if(isset($_GET["d_id"]))
{
    $res_del=$producttype1->delete_type($_GET["d_id"]);
     //code for delete validations
     if($res_del==true){
        
        $msg_2="Deleted Successfully";
    }else{
       
        $msg_2="Type already exists therefore cannot delete";
    }
}
//code to get group details  into datatable........................................................................
$result_ptype=$producttype1->getall_type();
 
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
                                    <h4>Manage Product Type</h4>

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
                                    <h5>Add New Product Type</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-block">

                                    <form method="POST" action="manageproducttype.php">
                                    <?php
                                                if(isset($_GET["view"]))
                                                {
                                                    echo"<input type='hidden' class='form-control' value='".$_GET['view']."' name='ptypeid' required>";
                                                }
                                            ?>


                                        <div class="form-group row">
                                            <div class="col-sm-4">



                                                <label class=" col-form-label">Type Code</label>
                                                <input type="text" class="form-control" pattern="^[A-Z0-9]*$" placeholder="" name="typecode" id="typ_code" onkeyup="check_typecode()" onblur="check_typecode()" value="<?=$producttype1->ptype_code?>"<?php if($producttype1->ptype_code){echo "readonly=\"readonly\"";} ?> required>
                                                <div class="col-form-label" id="codecheck_msg" style="display:none;">Sorry, that code is taken. Try
                                                            another?
                                                </div>

                                              
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Type Name</label>
                                                <input type="text" class="form-control" placeholder="" name="typename" id="typ_name"  onblur="check_typename()" value="<?=$producttype1->ptype_name?>" required>
                                                <div class="col-form-label" id="namecheck_msg" style="display:none;">Sorry, that name is taken. Try
                                                            another?
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Group</label>
                                                <select name="typegroup" class="form-control" id="typ_group" required>
                                                    <option value="-1">Select Group</option>
                                                   <?php
                                                        foreach($result_group as $item)
                                                        // echo"<option value='$item->group_id'>$item->group_name</option>"
                                                        if($item->group_id==$producttype1->ptype_group_id->group_id)   
			                                        echo "<option value='$item->group_id' selected='selected'>$item->group_name</option>";
                                                    else
                                                    echo"<option value='$item->group_id'>$item->group_name</option>"
                                                    ?>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit">ADD</button>
                                        <button class="btn btn-inverse" type="reset">CLEAR</button>
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
            if(isset($_GET['d_id'])) {
                echo"<div class='alert alert-danger background-danger'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='icofont icofont-close-line-circled text-white'></i>
                </button>
                <strong>$msg_2</strong> 
            </div>";
            }
            ?>
              <!-- //ALERT MESSAGES END................... -->
                
                <!-- Autofill table start -->
                <div class="card">
                    <div class="card-header">
                        <h5>Product List</h5>
                        <span></span>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="feather icon-maximize full-card"></i></li>
                                <li><i class="feather icon-plus minimize-card"></i></li>
                            
                            </ul>
                        </div>
                    </div>
                    <div class="card-block"  style="display: none;">
                        <div class="dt-responsive table-responsive">
                            <table id="autofill" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type Code</th>
                                        <th>Type Name</th>
                                        <th>Type Group</th>
                                        <th> </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($result_ptype as $item)
                                        {
                                            echo
                                            "<tr>
                                                <td>$item->ptype_id</td>
                                                <td>$item->ptype_code</td>
                                                <td>$item->ptype_name
                                                </td>
                                                <td>".$item->ptype_group_id->group_name."</td>
                                                <td>


                                                <div class='btn-group btn-group-sm' style='float: none;'>
                                                <button type='button'  onclick='edit_type($item->ptype_id)'class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button>
                                                <button type='button'  onclick='delete_type($item->ptype_id)'   class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
                                                </div>
                                                

                                                </td>
                                            </tr>";
                                        }
                                    ?>
                                </tbody>
                                        
                        
            
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>     


<!-- ----------------------------------------------------------------------------------------------------------------- -->
  <?php

include_once "../../files/foot.php";

?>

<script type="text/javascript" src="../javascript/masterfile.js"></script>
<script>

    function delete_type(deleteid) {

    if (confirm("Are you sure you want to delete product type?" + "" + deleteid)) {
        window.location.href = "manageproducttype.php?d_id=" + deleteid;
    }


    }

    function edit_type(e)
    {
        window.location.href="manageproducttype.php?view="+e;
    }
</script>
