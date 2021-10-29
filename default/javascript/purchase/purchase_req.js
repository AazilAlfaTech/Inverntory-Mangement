// Edit purchase requisition
    function edit_pr(edit_pr) 
    {
        window.location.href = "add_new_purchase_requisition.php?edit_pr=" + edit_pr;  
    }

    // ......................
    $( document ).ready(function() {

        $(".error_fields").hide();
    $(".itemalert").hide();
    $( ".alert" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
    });

    $(document).on('click', '.deletedata', function(event) {
        var tbl_row = $(this).closest('tr');
        console.log ("deletedata");
    
        var deleteitemid= tbl_row.find(".productid").val();
        console.log (deleteitemid);
    
        var confirm_msg=confirm("Are you sure you want delete the item?");
            if(confirm_msg==true){
                //ajax request
                $.ajax({
                    url:'../purchase_requisition/handle_delete_pr.php',
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


// Adding products to the dynamic table
    function add_products()
    {
        var pr_prod=$("#preq_itemproductid option:selected").val();
        var pr_prod_name=$("#preq_itemproductid option:selected").text(); //dropdown
        var p_price=$("#preq_itemprice").val();
        var p_qty=$("#preq_itemqty").val();
        var p_dis=$("#preq_itemdiscount").val();
        var p_tot= $("#preq_itemfinalprice").val();
        preq_subtotal=parseFloat(p_price*p_qty);
        console.log(pr_prod_name);

        if($("#preq_itemproductid").val()=='' || $("#preq_itemprice").val()==''|| $("#preq_itemqty").val()==''){
        //  alert("Fill all the fields in item info");
        console.log("empty");
        $(".error_fields").show().delay( 1000 ).fadeOut( 1000 );
        } 
        else
        {
            $("#tbody").append("<tr>\
                <td class='table-edit-view'>\
                    <input  class='input-borderless input-sm productid' type='hidden'readonly name='pr_item_productid[]' value='"+pr_prod+"'>\
                    <input  class='input-borderless input-sm productid' type='text' readonly name='' value='"+pr_prod_name+"'>\
                </td>\
                <td class='table-edit-view'>\
                    <input class='input-borderless input-sm row_data price'  type='text' readonly name='pr_item_price[]' value='"+p_price+"'>\
                </td>\
                <td class='table-edit-view'>\
                    <input class='input-borderless input-sm row_data quantity' type='text' readonly name='pr_item_qty[]' value='"+p_qty+"'>\
                    <input class='form-control input-sm subtotal'   type='hidden'  value='"+preq_subtotal+"'>\
                </td>\
                <td class='table-edit-view'>\
                    <input class='input-borderless input-sm row_data discount' type='text' readonly name='pr_item_discount[]' value='"+p_dis+"'>\
                </td>\
                <td class='table-edit-view'>\
                    <input  class='input-borderless input-sm row_data total ' type='text' readonly name='pr_item_finalprice[]' value='"+p_tot+"'>\
                </td>\
                <td class='table-edit-view'>\
                    <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>\
                    <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>\
                    <span class='btn_cancel'><button class='btn btn-mini btn-danger' type='button'>Cancel</button></span>\
                    <span class='btn_delete'><button  class='btn btn-mini btn-danger btn_deleterow' type='button'>Delete</button></span>\
                </td>\
                </tr>");
            $(".btn_save").hide();
            $(".btn_cancel").hide();
        }

    }

    // Clear products from the textbox after adding
    function clear_products()
    {
        $("#preq_itemproductid option:selected").text(""); //dropdown
        $("#preq_itemprice").val("");
        $("#preq_itemqty").val("");
        $("#preq_itemdiscount").val("");
        $("#preq_itemfinalprice").val("");
    }