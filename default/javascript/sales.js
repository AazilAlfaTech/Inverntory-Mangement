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

//function to calculate total in add product form......................................................................
$( document ).ready(function() {
    $(".productform").on("keyup", ".qty_add, .pricelevel, .disc_add", function() {
         
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
        console.log("validation123")
    
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
        console.log("validation456")
    
        var charCode = (e.which) ? e.which : event.keyCode    
        
        if(String.fromCharCode(charCode).match(/[^0-9]/g)){  
            row.find(".msg2").css("display", "inline"); 
           
            return false;  
        }else
        {row.find(".msg2").css("display", "none");}
     });
    
    
    
    });
    
    $(".product_level").change(function(){
        var product_id=$(".product_level").val();
        console.log(product_id);
        $.get("../ajax/ajaxsales.php?type=get_pricelevels",{productid:product_id},function(data)
        {
          console.log(data);
          var d=JSON.parse(data); 
          $(".pricelevel").html("");
          $.each(d,function(i,x)
          {
            console.log(i);
            console.log(x);
            $(".pricelevel").append("<option value='"+d[i].pricelevel_price+"'> "+d[i].pricelevel_price+" </option>");
          });
        });
    
    });
    