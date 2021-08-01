<?php

include_once ("producttype.php");
include_once "../group/group.php";

$producttype1=new producttype ();
$group=new group();
$result_group=$group->get_all_group();

if (isset($_POST["typename"]))
{
    $producttype1->ptype_name=$_POST["typename"];
    $producttype1->ptype_group_id=$_POST["typegroup"];
    $producttype1->ptype_code=$_POST["typecode"];

    if(isset($_POST['ptypeid']))
    {
        $producttype1->edit_type($_POST['ptypeid']);
    }else

    $producttype1->add_type();

}
if(isset($_GET["did"]))
{
    $producttype1->delete_type($_GET["did"]);
}
if(isset($_GET["view"]))
{
    $producttype1=$producttype1->get_type_by_id($_GET["view"]);
}
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
                                                    echo"<input type='text' class='form-control' value='".$_GET['view']."' name='ptypeid' required>";
                                                }
                                            ?>


                                        <div class="form-group row">
                                            <div class="col-sm-4">



                                                <label class=" col-form-label">Type Code</label>
                                                <input type="text" class="form-control" pattern="^[A-Z0-9]*$" placeholder="" name="typecode" id="typ_code" onkeyup="check_typecode()" onblur="check_typecode()" value="<?=$producttype1->ptype_code?>" <?php if($producttype1->ptype_code){echo "disabled=\"disabled\" ";} ?>" required>
                                                <div class="col-form-label" id="codecheck_msg" style="display:none;">Sorry, that code is taken. Try
                                                            another?
                                                </div>

                                              
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Type Name</label>
                                                <input type="text" class="form-control" placeholder="" name="typename" id="typ_name" onkeyup="check_typename()" onblur="check_typename()" value="<?=$producttype1->ptype_name?>" required>
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
                                                    <div class="card-block"  style="display: none;">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="autofill" class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
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
                                                                                <td>$item->ptype_code</td>
                                                                                <td>$item->ptype_name</td>
                                                                                <td>".$item->ptype_group_id->group_name."</td>
                                                                                <td>

                                                                                <div class='btn-group btn-group-sm' style='float: none;'>
                                                                                <button type='button' onclick='edit_type1($item->ptype_id)'    class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button>
                                                                                   <button type='button' onclick='del_type1($item->ptype_id)'  class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete delete_group'></span></button>
                                                                                   
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
<!-- <script type="text/javascript" src="../javascript/masterfile.js"></script> -->
<script>
    function del_type1(d)
    {
        console.log(d);
        // if(confirm("Are you sure you want to delete category?"+d))
        // {
        //     window.location.href="manageproducttype.php?did="+d;
        // }
    }

    function edit_type1(e)
    {
        console.log(e);
        //window.location.href="manageproducttype.php?view="+e;
    }
</script>