<?php
include_once("../group/group.php");

$group2=new group();

if(isset($_POST["groupid"])){
    $group2->group_id=$_POST["groupid"];
    $group2->group_code=$_POST["groupcode"];
    $group2->group_name=$_POST["groupname"];
    $group2->edit_group($_POST["groupid"]);
}

?>

<?php

?>
<form action='add_new_purchase_order.php' method='POST'>




<div class='form-group row'>

    <div class='col-sm-4'>
        <label class='col-form-label'> PR Reference No</label>
        <input class='form-control' type='text' value="">
    </div>
    <div class="col-sm-4">
        <label class='col-form-label'>Supplier</label>
        <input class='form-control' type='text' value=''>
    </div>
    <div class="col-sm-4">
        <label class='col-form-label'>Date</label>
        <input class='form-control' type='date' value=''>
    </div>

</div>

<br>
<br>


<!-- Edit With Button card start -->

        <div class='table-responsive'>

            <table class='table table-striped table-bordered' id='example-2'>
                <thead>
                    <tr>
                     
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
               
                </tbody>
            </table>
        </div>
<div class='d-flex flex-row-reverse'>
    <button type='button' class='btn btn-primary'>Submit</button>
</div>
</form>








<?php
 <?php
 if(isset($_GET['view'])){
echo"       <div class='col-sm-4'>
        <label class='col-form-label'> PR Reference No</label>
        <input class='form-control'  type='text' value='$result_purch_req->purchaserequest_ref'>
    </div>
    <div class='col-sm-4'>
        <label class='col-form-label'>Supplier</label>
        <input class='form-control' type='text' name='purchaseorderdate' value='$result_purch_req->supplier_name'>
    </div>
    <div class='col-sm-4'>
        <label class='col-form-label'>Date</label>
        <input class='form-control' type='date' value=''>
    </div>
    <input class='form-control' type='hidden' name='purchaseorderrequest' value='$result_purch_req->purchaserequest_id'>
</div>";}
?>

?>


<?php
if(isset($_GET['view'])){
    foreach($result_purch_req_item as $item){
echo"    <tr >
        <th scope='row'>$item->pr_item_qty</th>
        <td class='tabledit-view-mode'><span class='tabledit-span'>$item->pr_item_qty</span>
            <input class='tabledit-input form-control input-sm' type='text' name='Quantity[]' value='$item->product_name'>
        </td>
        <td class='tabledit-view-mode'><span class='tabledit-span'>$item->pr_item_price</span>
            <input class='tabledit-input form-control input-sm' type='text' name='First' value='$item->pr_item_price'>
        </td>
        <td class='tabledit-view-mode'><span class='tabledit-span'>$item->pr_item_discount</span>
        <input class='tabledit-input form-control input-sm' type='text' name='First' value='$item->pr_item_discount'>
    </td>
    <td class='tabledit-view-mode'><span class='tabledit-span'>$item->pr_item_price</span>
    <input class='tabledit-input form-control input-sm' type='text' name='First' value='$item->pr_item_price'>
</td>
        
       
                                                                 
    </tr>";
    }}
?>


<?php
foreach($result as $item){
echo" <tr>
<th scope='row">1</th>
<td class='tabledit-view-mode'><span class='tabledit-span'></span>
<input class='tabledit-input form-control input-sm' type='text' name='Quantity[]' value=''>
</td>
<td class='tabledit-view-mode'><span class='tabledit-span'>Otto</span>
<input class='tabledit-input form-control input-sm' type='text' name='Price[]' value=''>
</td>
<td class='tabledit-view-mode'><span class='tabledit-span'>Otto</span>
<input class='tabledit-input form-control input-sm' type='text'name='Discount[]' value=''>
</td>
<td class='tabledit-view-mode'><span class='tabledit-span'>Otto</span>
<input class='tabledit-input form-control input-sm' type='text' name='Total[]' value=''>
</td>

</tr>";}
?>

<table class='table table-striped table-bordered' id='example-2'>
<thead>
    <tr>
     
        <th>Product</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Discount</th>
        <th>Total</th>
    </tr>
</thead>
<tbody>
<?php
if(isset($_GET['view'])){
    foreach($result_purch_req_item as $item){
echo"<tr >
<th scope='row'>$item->product_name</th>
<td class='tabledit-view-mode'><span class='tabledit-span'>$item->pr_item_qty</span>
    <input class='tabledit-input form-control input-sm' name='First[]'  type='text' value='$item->pr_item_qty'>
</td>
<td class='tabledit-view-mode'><span class='tabledit-span'>$item->pr_item_price</span>
    <input class='tabledit-input form-control input-sm' type='text' name='Last[]' value='$item->pr_item_price'>
</td>

        
       
                                                                 
    </tr>";
    }}
?>
</tbody>
</table>


if(isset($_GET['edit'])){
    foreach($result_1 as $item){
echo"    <tr >
        <th scope='row'>$item->product_name</th>
        <td class='tabledit-view-mode'><span class='tabledit-span'>$item->pr_item_qty</span>
            <input class='tabledit-input form-control input-sm' type='text' name='Quantity[]' value='$item->pr_item_qty'>
        </td>
        <td class='tabledit-view-mode'><span class='tabledit-span'>$item->pr_item_price</span>
            <input class='tabledit-input form-control input-sm' type='text' name='Price[]' value='$item->pr_item_price'>
        </td>
        <td class='tabledit-view-mode'><span class='tabledit-span'>$item->pr_item_discount</span>
        <input class='tabledit-input form-control input-sm' type='text' name='Discount[]' value='$item->pr_item_discount'>
    </td>
    <td class='tabledit-view-mode'><span class='tabledit-span'>Total</span>
    <input class='tabledit-input form-control input-sm' type='text' name='Total[]' value='Total'>
</td>
        
       
                                                                 
    </tr>";
    }}
?>