//function to validate to avoid forward date
$(function(){
    
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
   
    $('#txtDate').attr('max', maxDate);
});
//function to validate quantity

function get_qty(){
    itemid=$(".product_level").val();
    console.log(itemid);
    $.get("../ajax/ajaxpurchase.php?type=get_sum_remainingqty",{prodid:itemid},function(data)
    {
      console.log(data);
      var d=JSON.parse(data); 
      remaing_qty=d.grn_qty;
    
     
    //  return remaing_qty;
    });
   
}

$(".qty_add").blur(function(){
    qty_stock=remaing_qty;
    qty_sale=$(".qty_add").val();
 
    console.log(qty_stock);
    console.log(qty_sale);

    if(qty_stock == 0){
        console.log("Please type a qty");
    }else if(qty_stock < qty_sale){
        console.log("Required stock not available");
    }else 
        {console.log("Stock availanle");
    }
});

 

//function to calculate total in add product form......................................................................
$( document ).ready(function() {
    $(".productform").on("keyup", ".qty_add, .pricelevel, .disc_add", function() {
         
         var row = $(this).closest(".row");
        
         var quants = row.find(".qty_add").val();
         var prc = row.find(".pricelevel").val();
         
        
        var disc= row.find(".disc_add").val();
                     var subtot= parseFloat(quants * prc * disc/100);
                   
                     
                     var tot = parseFloat(quants * prc - subtot);
                     
                     $(".totaladd").val(tot);
         
                     
     });
    
     $(".productform").on("change", ".pricelevel", function() {
                console.log("onchange");
                var row = $(this).closest(".row");
               
                var quants = row.find(".qty_add").val();
                var prc = row.find(".pricelevel").val();
                
                console.log(prc);
               // var tot = quants * prc;
               var disc= row.find(".disc_add").val();
                            var subtot= parseFloat(quants * prc * disc/100);
                            console.log(subtot);
                            var tot = parseFloat(quants * prc - subtot);
                            console.log(tot);
                            $(".totaladd").val(tot);
                //row.find(".totaladd").attr("value",tot);
            });
        });
    //validate only numbers....................................................................................
    $(".productform").on("keyup", ".qty_add, .disc_add", function(event){
       
        
    
        row = $(this).closest(".row");
    
    
    //validate only numbers for quantity
    row.find(".qty_add").on("keypress",function(e)
    {
        console.log("validation")
    
        var charCode = (e.which) ? e.which : event.keyCode    
        
        if(String.fromCharCode(charCode).match(/[^0-9]/g))
        {  
            row.find(".msg1").css("display", "inline"); 
           
            return false;  
        }else
        {
            row.find(".msg1").css("display", "none");
           
        }
        });
    
    //validate only numbers for discount
    row.find(".disc_add").on("keypress",function(e)
    {
      
        var charCode = (e.which) ? e.which : event.keyCode    
      
    if(e.which != 8 && e.which != 0 
        && (e.which < 48 || e.which > 57) 
        && e.charCode != 46){  
        row.find(".msg2").css("display", "inline"); 
        return false;  
    }else
    {row.find(".msg2").css("display", "none");}
 });

    
    });
    
    $(".product_level").change(function(){
        var product_id=$(".product_level").val();
        //console.log(product_id);
        $.get("../ajax/ajaxsales.php?type=get_pricelevels",{productid:product_id},function(data)
        {
         // console.log(data);
          var d=JSON.parse(data); 
          $(".pricelevel").html("");
          $.each(d,function(i,x)
          {
           // console.log(i);
           // console.log(x);
            $(".pricelevel").append("<option value='"+d[i].pricelevel_price+"'> "+d[i].pricelevel_price+" </option>");
          });
        });
    
    });
    