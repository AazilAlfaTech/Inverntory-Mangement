<?php



include_once ("../purchase_requisition/purchase_requisition.php");
$purchase_request2=new purchaserequest();

include_once ("../purchase_requisition/purchase_request_item.php");
$purchase_request_item2=new purchase_request_item();

include_once ("../purchase_order/purchaseorder.php");
$purchaseorder2=new purchaseorder();

include_once ("../purchase_order/purchaseorderitem.php");
$purchaseorderitem2=new purchaseorderitem();




//view PR details
if(isset($_GET["view"]))
{
    $purchase_request2=$purchase_request2->get_purchaserequest_by_id($_GET["view"]);
    $purchase_request_item2=$purchase_request_item2->get_all_item_by_requestid($_GET["view"]);
   
  
}



if(isset($_POST['purchaseorderdate'])){
    $purchaseorder2->purchaserorder_requestid=$_POST['purchaseorderdate'];
    $purchaseorder2->purchaserorder_requestid=$_POST['purchaseorderrequest'];
    $purchaseorder2->purchaseorder_date=$_POST['purchaseorderdate'];
    $purchaseorder2->purchaseorder_ref=$purchaseorder2->po_code($_POST['purchaseorderdate']);

    $Purch_reqid=$purchaseorder2->insert_purchaseorder();
    
    
   $purchaseorderitem2->insert_POitem1($Purch_reqid);
   header("location:../purchase_order/manage_purchase_order.php?success=1");


}

$purchase_request_res=$purchase_request2->get_all_purchaserequest();

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
                                    <h4>Add New Purchase Order</h4>

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
    <!-- ...................................................................................................                     -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Select Purchase Request</h5>
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
                                                    <th>Reference NO</th>
                                                    <th>Date</th>
                                                    <th>Supplier</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($purchase_request_res as $item)
                                                    {echo"
                                                        <tr>
                                                            <td id='gr_id_td'>$item->purchaserequest_id</td>
                                                            <td>$item->purchaserequest_ref</td>
                                                            <td>$item->purchaserequest_date</td>
                                                            <td>$item->supplier_name</atd>

                                                            <td><div class='btn-group btn-group-sm' style='float: none;'>
                                                            <button type='button' onclick='edit_purchorder($item->purchaserequest_id)'  class='tabledit-edit-button btn btn-primary waves-effect waves-light edit_group' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button>
                                                            
                                                            
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

   <!-- ...................................................................................................                     -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Add New Purchase Order</h5>

                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <!-- <li><i class="feather icon-trash-2 close-card"></i></li> -->
                                        </ul>
                                    </div>
                                </div>

                                <div class='card-block'>

                                <form action='add_new_purchase_order.php' method='POST'>



<?php if(isset($_GET['view'])):?>
<div class='form-group row'>
    
     <input type='hidden'  class='form-control' value=<?=$_GET['view'] ?> name='purchaseorderrequest' required>
       

     <div class='col-sm-4'>
        <label class='col-form-label'> PR Reference No</label>
        <input class='form-control'  type='text' value=<?=$purchase_request2->purchaserequest_ref ?> <?php if($purchase_request2->purchaserequest_ref){echo "readonly=\"readonly\"";} ?>>
    </div>
    <div class='col-sm-4'>
        <label class='col-form-label'>Supplier</label>
        <input class='form-control' type='text'value=<?=$purchase_request2->purchaserequest_supplier ?> <?php if($purchase_request2->purchaserequest_supplier){echo "readonly=\"readonly\"";} ?>>
    </div>
    <div class='col-sm-4'>
        <label class='col-form-label'>Date</label>
        <input class='form-control' type='date' name='purchaseorderdate'  value='<?php echo date('Y-m-d');?>' required>
    </div>
    
</div>
</div>

<br>
<br>


<!-- Edit With Button card start -->

        <div class='table-responsive'>

            <table class='table  table-bordered'  id='example-2'  >
                <thead class='table-primary'>
                    <tr>
                     
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

    <?php foreach( $purchase_request_item2 as $item):  ?>
    <tr>
    <td class='table-edit-view'><span class=''><?= $item->product_name?></span>
        <input class='form-control input-sm  '   type='hidden' name='Product[]' value='<?= $item->pr_item_productid ?>'>
        </td>
    <td class='table-edit-view'><span class='tabledit-span'><?= $item->pr_item_qty ?></span>
    <input class='input-borderless input-sm row_data quantity'   type='text' readonly  name='Quantity[]' value='<?=$item->pr_item_qty ?>'><div style="color: red; display: none" class="msg1">Digits only</div>
</td>
    <td class='table-edit-view'><span class='tabledit-span'><?= $item->pr_item_price ?></span>
        <input class='input-borderless input-sm row_data price'   type='text' readonly name='Price[]' value='<?= $item->pr_item_price ?>'> <div style="color: red; display: none" class="msg2">Digits only</div>
        </td>
        <td class='table-edit-view'><span class='tabledit-span'><?= $item->pr_item_discount ?></span>
        <input class='input-borderless input-sm row_data discount'   type='text' readonly name='Discount[]' value='<?= $item->pr_item_discount ?>'> <div style="color: red; display: none" class="msg3">Digits only</div>
        
        <td class='table-edit-view'><span class='tabledit-span'><?=$item->item_discount ?></span>
        <input class='input-borderless input-sm row_data total'   type='text' readonly value='<?=$item->item_discount ?>'>
        
        </td>
    
    
    <td>
    <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>
    <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>
    <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Cancel</button></span>
    </td>
        
</td>
        
       
                                                                 
    </tr>

<?php endforeach ;  ?>

</tbody>
<div class="card">
 </table>
 <table class="table table-responsive invoice-table invoice-total">
                                <tbody class="pricelist">
                                    <tr>
                                        <th> Total Quantity :</th>
                                        <td ><input type="text" id="total_quan" name="totqty" class="form-control form-control-sm" ></td>
                                    </tr>
                                    <tr>
                                        <th> Sub Total :</th>
                                        <td ><input type="text" id="total_price" name="subtot" data-a-sign="Rs. " class=" form-control form-control-sm autonumber"></td>
                                    </tr>
                                    <tr>
                                        <th> Total Discount :</th>
                                        <td ><input type="text" id="total_discount" name="discount tot" class="form-control form-control-sm  autonumber" data-a-sign="Rs. " ></td>
                                    </tr>
                                   
                                    <tr class="text-info">
                                        <td>
                                            <hr>
                                            <h5 class="text-primary">Total :</h5>
                                        </td>
                                        <td>
                                            <hr>
                                            <h5 class="text-primary"><input type="text" id="total_final" name="nettot"  class="form-control"></h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
    </div>

        </div>
<div class='d-flex flex-row-reverse'>
    <button type='submit' name='save' class='btn btn-primary'>Submit</button>
</div>
<?php endif ;   ?>
</form>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>

<?php

include_once "../../files/foot.php";

?>

<script type="text/javascript" src="../javascript/editabletable.js"></script>
<script>
    function edit_purchorder(PR_id)
    {
        window.location.href="add_new_purchase_order.php?view="+PR_id;
    }
</script>
<script>

        // //hide buttons
        // $(".btn_save").hide();
        // $(".btn_cancel").hide();

        // //click on the edit button, row becomes editable
        // $(document).on('click', '.btn_edit', function(event) 
        //     {
               
        //         event.preventDefault();
        //         //get the closest row OR the particular row you chosen to edit
        //         var tbl_row = $(this).closest('tr');

        //         //show the save and cancel button

        //         tbl_row.find('.btn_save').show();
        //         tbl_row.find('.btn_cancel').show();

        //         //hide edit button
        //         tbl_row.find('.btn_edit').hide(); 
                
        //         //remove the text of the span
        //         tbl_row.find(".tabledit-span").text("");
                

        //         //type hidden changes to type text to make it editable
        //         tbl_row.find('.row_data')
        //         .attr('type', 'text')
                
              

        //         //--->add the original entry data to attribute original_entry
        //         //--->applicable only to input tag
        //         tbl_row.find('.row_data').each(function(index, val) 
        //         {  
        //             //this will help in case user decided to click on cancel button
        //             $(this).attr('original_entry', $(this).val());
        //         }); 		
              
        //     });

        // // once you edit the required fields ,save the changes  
        // $(document).on('click', '.btn_save', function(event) 
        //     {
               
        //         event.preventDefault();
        //         var tbl_row = $(this).closest('tr');

        //         tbl_row.find('.btn_save').hide();
        //         tbl_row.find('.btn_cancel').hide();

        //         //hide edit button
        //         tbl_row.find('.btn_edit').show(); 
        //         tbl_row.find('.row_data')
        //         //type text changes to type hidden
        //         .attr('type', 'hidden')

                
        //         tbl_row.find('.row_data').each(function(index,val) 
        //         {  
        //              //changes made het assigned to the value attribute
        //             $(this).attr('value', $(this).val());

                    
        //         }); 
        //     });

            
           
        // $(document).on('click', '.btn_cancel', function(event) 
        // {
        

        //     var tbl_row = $(this).closest('tr');

            

        //     //hide save and cacel buttons
        //     tbl_row.find('.btn_save').hide();
        //     tbl_row.find('.btn_cancel').hide();

        //     //show edit button
        //     tbl_row.find('.btn_edit').show();
        //     tbl_row.find('.row_data')
                        
        //     .attr('type', 'hidden')


            
        //     tbl_row.find('.row_data').each(function(index, val) 
        //     {   
        //         $(this).val( $(this).attr('original_entry') ); 
        //     });  
        // });
        // //--->button > cancel > end

   





        // $(document).on('click', '.btn_edit', function(event){
       
        // var row=$(this).closest('tr');
        // //validate only numbers for quantity
        // row.find(".quantity").on("keypress",function(e)
        // {
        
        //     var charCode = (e.which) ? e.which : event.keyCode    
            
        //     if(String.fromCharCode(charCode).match(/[^0-9]/g))
        //     {  
        //         row.find(".msg1").css("display", "inline"); 
        //         return false;  
        //     }else
        //     {row.find(".msg1").css("display", "none");}
        //     });
        // //validate only numbers for price
        // row.find(".price").on("keypress",function(e)
        // {
               
        //     var charCode = (e.which) ? e.which : event.keyCode    
            
        //     if(String.fromCharCode(charCode).match(/[^0-9]/g)){  
        //         row.find(".msg2").css("display", "inline"); 
        //         return false;  
        //     }else
        //     {row.find(".msg2").css("display", "none");}
        
        // });
        // //validate only numbers for discount
        // row.find(".discount").on("keypress",function(e)
        // {
        
        //     var charCode = (e.which) ? e.which : event.keyCode    
            
        //     if(String.fromCharCode(charCode).match(/[^0-9]/g)){  
        //         row.find(".msg3").css("display", "inline"); 
        //         return false;  
        //     }else
        //     {row.find(".msg3").css("display", "none");}
        //  });



        // });


</script>
