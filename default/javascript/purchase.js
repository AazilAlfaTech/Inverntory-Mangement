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



