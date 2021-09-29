// Edit purchase requisition
    function edit_pr(edit_pr) 
    {
        window.location.href = "add_new_purchase_requisition.php?edit_pr=" + edit_pr;  
    }

// Function that runs when you click the add buttom
    $("#add_prbtn").click(function(){

        add_products();
        clear_products();
       
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

        if($("#preq_itemproductid").val()=='' || $("#preq_itemprice").val()==''|| $("#preq_itemqty").val()==''  || $("#preq_itemdiscount").val()==''){
         alert("Fill all the fields in item info");
        } 
        else
        {
            $("#tbody").append("<tr>\
                <td class='table-edit-view'>"+1+"</td>\
                <td class='table-edit-view'>\
                    <input  class='form-control input-sm productid' type='hidden' name='pr_item_productid[]' value='"+pr_prod+"'>\
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
                </tr class='table-edit-view'>");
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