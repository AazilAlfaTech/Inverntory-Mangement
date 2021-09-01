    
     //function to be called when the page loads
     $( document ).ready(function() {
        console.log( "hello!" );
           
            $(".btn_cancel").hide();
             $(".btn_save").hide();
            
         
            $(".tabledit-span").hide();
                cal_totquantity();
                    cal_totprice();
                    cal_totdiscount();
                    final_total();
    
                  
        $("table").on("keyup", ".quantity, .price, .discount", function() {
            console.log("hhiii");
            var row = $(this).closest("tr");
           
            var quants = row.find(".quantity").val();
            var prc = row.find(".price").val();
           // var tot = quants * prc;
           var disc= row.find(".discount").val();
                        var subtot= parseFloat(quants * prc * disc/100);
                        var tot = parseFloat(quants * prc - subtot);
                        console.log(tot);
            row.find(".total").attr("value",tot);
        });
    
    });
    
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
        
       
        //type hidden changes to type text to make it editable
        tbl_row.find('.row_data')
        .attr('readonly', false)
        
      

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

            //remove textbox border
        tbl_row.find('input').addClass('input-borderless');
        tbl_row.find('input').removeClass('input-border');


        cal_totquantity();
        cal_totprice();
        cal_totdiscount();
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
    cal_totdiscount();
    final_total();

});
// st
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

   