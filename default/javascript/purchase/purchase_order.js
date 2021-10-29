function edit_purchorder(PR_id)
    {
        window.location.href="add_new_purchase_order.php?view="+PR_id;
    }
    
    // 
    $(document).on('click', '.deletedata', function(event) {
        var tbl_row = $(this).closest('tr');
        console.log ("deletedata");
    
        var deleteitemid= tbl_row.find(".productid").val();
        console.log (deleteitemid);
    
        var confirm_msg=confirm("Are you sure you want delete the item?");
            if(confirm_msg==true){
                //ajax request
                $.ajax({
                    url:'../purchase_order/handle_delete.php',
                    type:'POST',
                    data:{id:deleteitemid},
                    success:function(response){
                        if(response==true){
                            console.log('Item deleted successfully');
                            tbl_row.css('background','tomato');
                            tbl_row.fadeOut(800,function(){
                                tbl_row.remove();
                                cal_totquantity();
                                cal_totprice();
                                cal_totdiscount();
                                final_total();
                            });
                        }else{
                            console.log('Invalid ID.');
                        }
                    }
                     
                });
            }
       
    
    });
// Function that runs when you click the add buttom
    $("#add_prbtn").click(function(){

    add_products();
    clear_products();
    cal_totquantity();
    cal_totprice();
    cal_totdiscount();
    final_total();
    
    });
    
    // Function that runs when you click the clear button
    $(".reset").click(function()
    {
        clear_products();
    });
    
    // ---------------------------------------------------------------------------------------------------------------------
    function add_products()
    {
    
       
        
        var pr_prod=$("#porder_itemproductid option:selected").val();
        var pr_prod_name=$("#porder_itemproductid option:selected").text(); //dropdown
        var p_price=$("#porder_itemprice").val();
        var p_qty=$("#porder_itemqty").val();
        var p_dis=$("#porder_itemdiscount").val();
        var p_tot= $("#porder_itemfinalprice").val();
        productsubtotal=parseFloat(p_price*p_qty);
        if($("#porder_itemproductid").val()=='' || $("#porder_itemprice").val()==''|| $("#porder_itemqty").val()==''){
            //  alert("Fill all the fields in item info");
            console.log("empty");
            $(".error_fields").show().delay( 1000 ).fadeOut( 1000 );
            
         } else{
       
        $(".itembody").append("<tr>\
        <td>\
            <input  class='form-control input-sm  ' type='hidden' name='Product[]' value='"+pr_prod+"'>\
            <span class='tabledit-span'>"+ pr_prod_name +" </span>\
        </td>\
        <td>\
            <input class='input-borderless input-sm row_data quantity' type='text' readonly name='Quantity[]' value='"+p_qty+"'><div style='color: red; display: none' class='msg1'>Digits only</div>\
            <input class='form-control input-sm subtotal'   type='hidden'  value='"+productsubtotal+"'></td>\
        <td>\
            <input class='input-borderless input-sm row_data price'  type='text' readonly name='Price[]' value='"+p_price+"'><div style='color: red; display: none' class='msg2'>Digits only</div>\
        </td>\
        <td>\
            <input class='input-borderless input-sm row_data discount' type='text' readonly name='Discount[]' value='"+p_dis+"'><div style='color: red; display: none' class='msg1'>Digits only</div>\
        </td>\
        <td>\
            <input  class='input-borderless input-sm row_data total ' type='text' readonly  value='"+p_tot+"'>\
        </td>\
        <td>\
            <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>\
            <span class='btn_deleterow'><button  class='btn btn-mini btn-danger' type='button'>Delete</button></span>\
            <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span><span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Reset</button></span>\
        </td>\
        </tr>");
         
    
         $(".btn_save").hide();
        $(".btn_cancel").hide();
         }
    }
    
    // ----------------------------------------------------------------------------------------------------------------
    
    
    function clear_products()
    {
        $("#porder_itemproductid option:selected").text(""); //dropdown
        $("#porder_itemproductid option:selected").val("");
        $("#porder_itemprice").val("");
        $("#porder_itemqty").val("");
        $("#porder_itemdiscount").val("");
        $("#porder_itemfinalprice").val("");
    }