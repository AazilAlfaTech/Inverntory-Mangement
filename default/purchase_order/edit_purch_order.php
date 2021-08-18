<?php


include_once "../purchase_order/purchaseorder.php";
$purchaseorder3=new purchaseorder();

include_once "../purchase_order/purchaseorderitem.php";
$purchaseorderitem3=new purchaseorderitem();

if(isset($_POST['save'])){

    $purchaseorderitem3->edit_POitem();

}else{
    $purchaseorder3=$purchaseorder3->get_purchaseorder_by_id($_GET['edit']);
    $purchaseorderitem3=$purchaseorderitem3->get_all_POitem($_GET['edit']);
    
    
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

                                <div class="card-block">

                                    <form action='edit_purch_order.php' method='POST'>




                                        <div class="form-group row">

                                            <div class="col-sm-4">
                                                <label class=" col-form-label"> PO No</label>
                                                <input class="form-control" type="text" readonly='true' value=<?=$purchaseorder3->purchaseorder_ref ?>>

                                            </div>



                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Supplier</label>
                                                <input class="form-control" type="text" readonly='true' value="<?=$purchaseorder3->supplier_name1 ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class=" col-form-label">Date</label>
                                                <input class="form-control" type="text" readonly='true' value=<?=$purchaseorder3->purchaseorder_date ?>>
                                            </div>
                                        </div>

                                        <br>
                                        <br>


                                        <!-- Edit With Button card start -->

                                        <div class="table-responsive">

                                                    <table class="table table-striped table-bordered " id="mytable" >
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Qty</th>
                                                                <th>Price</th>
                                                                <th>Discount</th>
                                                                <th>Total</th>
                                                                <th>Action</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody class="itembody">
                                                        <?php if(isset($_GET['edit'])):?>
                                                            <?php foreach($purchaseorderitem3 as $item):  ?>
                                                        <tr>    <td class='table-edit-view'><span class=''><?= $item->product_name?></span>
                                                                    <input class='form-control input-sm  '   type='hidden' name='Product[]' value='<?= $item->po_item_productid ?>'>
                                                                    <input class='form-control input-sm  '   type='hidden' name='Orderid[]' value='<?= $item->po_item_id ?>'>
                                                                    </td>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?= $item->po_item_qty ?></span>
                                                                <input class='form-control input-sm row_data quantity'   type='hidden'  name='Quantity[]' value='<?=$item->po_item_qty ?>'><div style="color: red; display: none" class="msg1">Digits only</div>
                                                            </td>
                                                                <td class='table-edit-view'><span class='tabledit-span'><?= $item->po_item_price ?></span>
                                                                    <input class='form-control input-sm row_data price'   type='hidden' name='Price[]' value='<?= $item->po_item_price ?>'> <div style="color: red; display: none" class="msg2">Digits only</div>
                                                                    </td>
                                                                    <td class='table-edit-view'><span class='tabledit-span'><?= $item->po_item_discount ?></span>
                                                                    <input class='form-control input-sm row_data discount'   type='hidden' name='Discount[]' value='<?= $item->po_item_discount ?>'> <div style="color: red; display: none" class="msg3">Digits only</div>
                                                                    <td class='table-edit-view'><span class='tabledit-span'><?=$item->po_item_finalprice ?></span>
                                                                    <input class='form-control input-sm row_data'   type='hidden' disabled="true" value='<?=$item->po_item_finalprice ?>'>
                                                                    
                                                                    </td>
                                                                
                                                                
                                                                <td>
                                                                <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>
                                                                <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>
                                                                <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Cancel</button></span>
                                                                </td>
        
       
                                                                 
                                                        </tr>

                                                            <?php endforeach ;  ?>
                                                        <?php endif ;   ?>
                                                        </tbody>
                                                    </table>
                                                </div>





                                        <div class="d-flex flex-row-reverse">
                                            <button type="submit" name="save" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>





           


                </div>
<?php

include_once "../../files/foot.php";

?>

<script>

        //hide buttons
        $(".btn_save").hide();
        $(".btn_cancel").hide();

        //click on the edit button, row becomes editable
        $(document).on('click', '.btn_edit', function(event) 
            {
               
                event.preventDefault();
                //get the closest row OR the particular row you chosen to edit
                var tbl_row = $(this).closest('tr');

                //show the save and cancel button

                tbl_row.find('.btn_save').show();
                tbl_row.find('.btn_cancel').show();

                //hide edit button
                tbl_row.find('.btn_edit').hide(); 
                
                //remove the text of the span
                //tbl_row.find(".tabledit-span").text("");
                

                //type hidden changes to type text to make it editable
                tbl_row.find('.row_data')
                .attr('type', 'text')
                
              

                //--->add the original entry data to attribute original_entry
                //--->applicable only to input tag
                tbl_row.find('.row_data').each(function(index, val) 
                {  
                    //this will help in case user decided to click on cancel button
                    $(this).attr('original_entry', $(this).val());
                }); 		
              
            });

        // once you edit the required fields ,save the changes  
        $(document).on('click', '.btn_save', function(event) 
            {
               
                event.preventDefault();
                var tbl_row = $(this).closest('tr');

                tbl_row.find('.btn_save').hide();
                tbl_row.find('.btn_cancel').hide();

                //hide edit button
                tbl_row.find('.btn_edit').show(); 
                tbl_row.find('.row_data')
                //type text changes to type hidden
                .attr('type', 'hidden')
                
                

                
                tbl_row.find('.row_data').each(function(index,val) 
                {  
                     //changes made het assigned to the value attribute
                    $(this).attr('value', $(this).val());

                    
                }); 

                // tbl_row.each(function() {
                //     // Get input element.
                //     var input = $(this).find('.row_data');
                //     var data=input.val(); //its retrieving only the value of the first element that is y its replacing all the cells with same data
                //     console.log(data);
                //     // Set span text with input/select new value.
                //     if (input.is('select')) {
                //         $(this).find('.tabledit-span').text(input.find('option:selected').text());
                //     } else {
                //         $(this).find('.tabledit-span').text(input.val());
                //     }
                   
                // }); 

    var arr = {}; 
	tbl_row.find('.row_data').each(function(index, val) 
	{   
		var col_name = tbl_row.find('.tabledit-span').html();  
		var col_val  =  $(this).val();
		arr[col_val] = col_name;
        console.log(arr);
	});

                
            });

            
           
        $(document).on('click', '.btn_cancel', function(event) 
        {
        

            var tbl_row = $(this).closest('tr');

            

            //hide save and cacel buttons
            tbl_row.find('.btn_save').hide();
            tbl_row.find('.btn_cancel').hide();

            //show edit button
            tbl_row.find('.btn_edit').show();
            tbl_row.find('.row_data')
                        
            .attr('type', 'hidden')
           


            
            tbl_row.find('.row_data').each(function(index, val) 
            {   
                $(this).val( $(this).attr('original_entry') ); 
            });  
        });
        //--->button > cancel > end

   





        $(document).on('click', '.btn_edit', function(event){
       
        var row=$(this).closest('tr');
        //validate only numbers for quantity
        row.find(".quantity").on("keypress",function(e)
        {
        
            var charCode = (e.which) ? e.which : event.keyCode    
            
            if(String.fromCharCode(charCode).match(/[^0-9]/g))
            {  
                row.find(".msg1").css("display", "inline"); 
                return false;  
            }else
            {row.find(".msg1").css("display", "none");}
            });
        //validate only numbers for price
        row.find(".price").on("keypress",function(e)
        {
               
            var charCode = (e.which) ? e.which : event.keyCode    
            
            if(String.fromCharCode(charCode).match(/[^0-9]/g)){  
                row.find(".msg2").css("display", "inline"); 
                return false;  
            }else
            {row.find(".msg2").css("display", "none");}
        
        });
        //validate only numbers for discount
        row.find(".discount").on("keypress",function(e)
        {
        
            var charCode = (e.which) ? e.which : event.keyCode    
            
            if(String.fromCharCode(charCode).match(/[^0-9]/g)){  
                row.find(".msg3").css("display", "inline"); 
                return false;  
            }else
            {row.find(".msg3").css("display", "none");}
         });



        });


</script>