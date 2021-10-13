    
     //function to be called when the page loads
     $( document ).ready(function() {
     
            $(".btn_cancel").hide();
             $(".btn_save").hide();
            
         
            $(".tabledit-span").hide();
                    cal_totquantity();
                    cal_totprice();
                    cal_totdiscount();
                    final_total();
    
 //calculate total in each row.................................................................................................                 
        $("table").on("keyup", ".quantity, .price, .discount", function() {
     
            var row = $(this).closest("tr");
           
            var quants = row.find(".quantity").val();
            var prc = row.find(".price").val();
            
            //console.log(prc);
           // var tot = quants * prc;
           var disc= row.find(".discount").val();
                        var subtot= parseFloat(quants * prc * disc/100);
                        //console.log(subtot);
                        var tot = parseFloat(quants * prc - subtot);
                        //console.log(tot);
            row.find(".total").attr("value",tot);
        });

        $("table").on("change", ".price", function() {
            console.log("onchange");
            var row = $(this).closest("tr");
           
            var quants = row.find(".quantity").val();
            var prc = row.find(".price").val();
            
            console.log(prc);
           // var tot = quants * prc;
           var disc= row.find(".discount").val();
                        var subtot= parseFloat(quants * prc * disc/100);
                        //console.log(subtot);
                        var tot = parseFloat(quants * prc - subtot);
                       // console.log(tot);
            row.find(".total").attr("value",tot);
        });

        //   $("table").on("change", ".price", function() {
        //     console.log("onchange");
        //     var row = $(this).closest("tr");
           
        //     var quants = row.find(".quantity").val();
        //     var prc = row.find(".price").val();
            
        //     console.log(prc);
        //    // var tot = quants * prc;
        //    var disc= row.find(".discount").val();
        //                 var subtot= parseFloat(quants * prc * disc/100);
        //                 console.log(subtot);
        //                 var tot = parseFloat(quants * prc - subtot);
        //                 console.log(tot);
        //     row.find(".total").attr("value",tot);
        // });
        
    
    });
//......................page onload fuctions end.....................................................................................


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

       //display textbox border
       tbl_row.find('input').removeClass('input-borderless');
       tbl_row.find('input').addClass('input-border');
       tbl_row.find('select').removeClass('input-borderless');
       tbl_row.find('select').addClass('input-border');
        
       
        //type hidden changes to type text to make it editable
        tbl_row.find('.row_data')
        .attr('readonly', false)
     

        //get product id
        var id1=tbl_row.find(".productid").val();
        var statusval=tbl_row.find(".status").val();

        tbl_row.find(".productprice").find('option').not(':selected').remove();
        //execute fuction to show the pricelevel dropdownlist
        getpricelevel(id1,statusval);
      //  qty_validate(id1);
       // getstatus(id1);

        

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

        if(tbl_row.find(".quantity").val() == '' || tbl_row.find(".price").val() == '' || tbl_row.find(".discount").val() == '' ){
            alert("Please fill all the fields");

        }else{
                
        tbl_row.find('.btn_save').hide();
        tbl_row.find('.btn_cancel').hide();

        //hide edit button
        tbl_row.find('.btn_edit').show(); 
        tbl_row.find('.row_data')

        //type text changes to type hidden
        .attr('readonly', true)
        
        
         tbl_row.find('.row_data').each(function(index,val) 
        {  
             //changes made het assigned to the value attribute
            $(this).attr('value', $(this).val());

            
        }); 
        //$(this).find('option').not(':selected').remove();

        tbl_row.find(".status").find('option').not(':selected').remove();

            //remove textbox border
        tbl_row.find('input').addClass('input-borderless');
        tbl_row.find('input').removeClass('input-border');
        tbl_row.find('select').addClass('input-borderless');
        tbl_row.find('select').removeClass('input-border');

        //remove options that are not selected
        tbl_row.find('.price').find('option').not(':selected').remove();

        cal_totquantity();
        cal_totprice();
        //cal_totdiscount();
        final_total();
        }


        

        
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
                
    .attr('readonly', true)
   
     //remove textbox border
     tbl_row.find('input').addClass('input-borderless');
     tbl_row.find('input').removeClass('input-border');

    
    tbl_row.find('.row_data').each(function(index, val) 
    {   
        $(this).val( $(this).attr('original_entry') ); 
    });  
});
//--->button > cancel > end
$(document).on('click', '.btn_deleterow', function(event) {
    var tbl_row = $(this).closest('tr');
    console.log ("shiiii");
    tbl_row.remove();
    cal_totquantity();
    cal_totprice();
   // cal_totdiscount();
    final_total();

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





//validations -only numbers.......................................................................................................


$(document).on('click', '.btn_edit', function(event){

var row=$(this).closest('tr');


//validate only numbers for quantity
row.find(".quantity").on("keypress",function(e)
{

    var charCode = (e.which) ? e.which : event.charCode    
    
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
    
    if(e.which != 8 && e.which != 0 
        && (e.which < 48 || e.which > 57) 
        && e.charCode != 46 && e.charCode != 44){  
        row.find(".msg2").css("display", "inline"); 
        return false;  
    }else
    {row.find(".msg2").css("display", "none");}

});
//validate only numbers for discount
row.find(".discount").on("keypress",function(e)
{

    var charCode = (e.which) ? e.which : event.keyCode    
    
    if(e.which != 8 && e.which != 0 
        && (e.which < 48 || e.which > 57) 
        && e.charCode != 46){  
        row.find(".msg3").css("display", "inline"); 
        return false;  
    }else
    {row.find(".msg3").css("display", "none");}
 });

 

 



});

$(document).on('click', '.btn_edit', function(){
    var row1=$(this).closest('tr');
   // console.log("location");
    invoiceloc=$(".dispatchloc").val();
   // console.log("location-"+invoiceloc);
    inv_id=row1.find(".productid").val();
    //console.log(inv_id);
    //qty_sale=row1.find(".qtycheck ").val();
  //  console.log(qty_sale);
    $.get("../ajax/ajaxpurchase.php?type=get_sum_remainingqty",{prodid:inv_id,loc_id:invoiceloc},function(data)
    {
     //console.log(data);
      var d=JSON.parse(data); 

      remaing_qty=d.grn_qty;
      
    // console.log("remaining qty "+remaing_qty);
    // if(remaing_qty == 0){
    //     console.log("Please type a qty");
    
    //     row1.find(".qtymsg").html("Not available")
    // }else if(remaing_qty < qty_sale){
    //     console.log("Required stock not available");
       
    //     row1.find(".qtymsg").html("Not available")
    // }else if(remaing_qty > qty_sale)
    //     {console.log("Stock availanle");
       
    //     row1.find(".qtymsg").html("Available")
    // }
     
    //  return remaing_qty;
    });

    $("table").on("keyup", ".qtycheck",function()
{

     console.log("remaining qty "+remaing_qty);
    
    var row1=$(this).closest('tr');
    //row1.find(".qtymsg").html().remove();
    qty_sale1=row1.find(".qtycheck ").val();
    console.log(qty_sale1);
    if(qty_sale1==""){
        console.log("Stockempty");
        // row1.find(".qtymsg").html("qty is 0")
    }else if(remaing_qty < qty_sale1){
        console.log("Required stock not available");
        row1.find(".qtymsg").html("Not available")
    }else if(remaing_qty > qty_sale1)
        {console.log("Stock availanle");
        row1.find(".qtymsg").html(" available")
    }
    
 });


});



function getpricelevel(e,stat){
  //  console.log("getpricelevel");
  //  console.log(e);
    $.get("../ajax/ajaxsales.php?type=get_pricelevels",{productid:e},function(data)
    {
    //  console.log(data);
      var d=JSON.parse(data); 
      //$(".productprice").html("");
     // $(".productstatus").html("");
      $.each(d,function(i,x)
      {
        // console.log(i);
        // console.log(x);
        $(".productprice").append("<option value='"+d[i].pricelevel_price+"'> "+d[i].pricelevel_price+" </option>");
      
      });
    });
    //$('.productstatus option:not(:first)').remove();
    //append status dropdown
    
    if(stat=='COMPLETE'){
        $(".productstatus").append("<option value='PENDING'>PENDING</option>");
    }else if(stat=='PENDING'){
        $(".productstatus").append("<option value='COMPLETE'>COMPLETE</option>");
    }
    
}


    function  qty_validate(id1){
    invoiceloc=$(".dispatchloc").val();
    console.log("location-"+invoiceloc);
    $.get("../ajax/ajaxpurchase.php?type=get_sum_remainingqty",{prodid:id1,loc_id:invoiceloc},function(data)
    {
      console.log(data);
      var d=JSON.parse(data); 
      remaing_qty=d.grn_qty;
    
      
    });
    
}


function cal_totquantity(){
    console.log("quantity");
    tot_quan=0;

    var quan=$(".quantity");
    $.each(quan,function(i,item){
        tot_quan=tot_quan+ parseInt($(quan[i]).val());
    })
    $("#total_quan").val(tot_quan);
}

function cal_totprice(){
    console.log("subtotal");
    tot_price=0;

    var price=$(".subtotal");
    $.each(price,function(i,item){
        tot_price=tot_price+ parseFloat($( price[i]).val());
    })
    $("#total_price").val(tot_price);
}

function cal_totdiscount(){
    console.log("discount total");
    tot_discount=0;

    var discount=$(".discount");
    $.each(discount,function(i,item){
        tot_discount=tot_discount+ parseFloat($(discount[i]).val());
    })
    $("#total_discount").val(tot_discount);
}

function final_total(){
    console.log("total");
    tot_final=0;

    var finaltotal=$(".total");
    $.each(finaltotal,function(i,item){
        tot_final=tot_final+ parseFloat($(finaltotal[i]).val());
    })
    $("#total_final").val(tot_final);
    }

   