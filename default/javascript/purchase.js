   $("#PO_request").change(function(){
            console.log("hi");
            var request_id=$("#PO_request").val();
    
            $.get("../ajax/ajaxpurchase.php?type=getpurchaserequestbyid",{puchase_req_id:request_id},function(data){
                console.log(data);
                var e=JSON.parse(data); 
                console.log(e);
                //suppliername=e.supplier_name;
                //purchaserequesti=e.purchaserequest_id;
                console.log(e.purchaserequest_id);
                $("#porder_sup").val(e.supplier_name);
                $("#porder_reqid").val(e.purchaserequest_id);

                
            });
        });
    
        $("#PO_request").change(function()
      {
        var request_id=$("#PO_request").val();
        console.log(request_id);
        $.get("../ajax/ajaxpurchase.php?type=getpurchaserequestitem&requestid="+request_id+"",function(data)
        {
          console.log(data);
          var d=JSON.parse(data); 
          console.log(d);
    
        //    
         
          $.each(d,function(i,x)
          {
            console.log(i);
            console.log(x);
            $("#itembody").append("<tr><th scope='row'>1</th><td class='tabledit-view-mode'><span class='tabledit-span'>"+d[i].product_name+"</span><input class='tabledit-input form-control input-sm' type='text' name='productid[]' value='"+d[i].pr_item_productid+"'></td><td class='tabledit-view-mode'><span class='tabledit-span'>"+d[i].pr_item_qty+"</span><input class='tabledit-input form-control input-sm' type='text' name='productqty[]' value='"+d[i].pr_item_qty+"'></td><td class='tabledit-view-mode'><span class='tabledit-span'>"+d[i].pr_item_price+"</span><input class='tabledit-input form-control input-sm' type='text' name='productprice[]' value='"+d[i].pr_item_price+"'></td><td class='tabledit-view-mode'><span class='tabledit-span'>"+d[i].pr_item_discount+"</span><input class='tabledit-input form-control input-sm' type='text' name='productdiscount' value='"+d[i].pr_item_discount+"'></td><td class='tabledit-view-mode'><span class='tabledit-span'>"+d[i].product_name+"</span><input class='tabledit-input form-control input-sm' type='text'  value='"+d[i].product_name+"'></td></tr>");
          });
        });
      });


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
  $(".productform").on("keyup", ".price_add,.qty_add, .disc_add", function() {
      
       var row = $(this).closest(".row");
      console.log("hi")
       var quants = row.find(".qty_add").val();
       var prc = row.find(".price_add").val();
       
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
  
   $(".productform").on("change", ".price_add", function() {
              console.log("onchange");
              var row = $(this).closest(".row");
             
              var quants = row.find(".qty_add").val();
              var prc = row.find(".price_add").val();
              
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
    $(".productform").on("keyup", ".qty_add, .disc_add ,.price_add", function(event)
    {
      // console.log("validation123")
  
      row = $(this).closest(".row");

      //validate only numbers for price
      row.find(".price_add").on("keypress",function(e)
      {
        console.log("validation")
    
        var charCode = (e.which) ? e.which : event.keyCode    
        
        if(String.fromCharCode(charCode).match(/[^0-9]/g))
        {  
            row.find(".msg3").css("display", "inline"); 
          
            return false;  
        }else
        {
            row.find(".msg3").css("display", "none");
          
        }
      });
  
  
      //validate only numbers for quantity
      row.find(".qty_add").on("keypress",function(e)
      {
        // console.log("validation")
    
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



