function check_groupcode()
    {
      let code=$("#sup_gr_code").val();
      console.log(code);
      var codelegnth=code.length;
     //$("#codecheck_msg").show();
     if(codelegnth>1)
     {
       $.get("../ajax/ajaxsupplier.php?type=check_suppliergroupcode&supplier_group_code="+code, "" ,function(data){
          var tmp=JSON.parse(data);
          console.log(tmp);
           if(tmp.suppliergroup_id>0){
               
                $("#codecheck_msg").fadeIn().delay(2000).fadeOut()
             
            }
             });
      }
    }

    function check_groupname(){
        let code=$("#sup_gr_name").val();
        console.log(code);
        var codelegnth=code.length
       $("#namecheck_msg").hide();
       if(codelegnth>1){
         $.get("../ajax/ajaxsupplier.php?type=check_suppliergroupname&supplier_group_name="+code+"",function(data){
          
          var tmp=JSON.parse(data);
           
             if(tmp.suppliergroup_id>0){
             $("#namecheck_msg").fadeIn().delay(1000).fadeOut()}
         });
       }
  
       }


//.......................SUPPLIER.............................................
function check_supplier_code(){
    console.log("hi");
    let code=$("#sup_code").val();
    console.log(code);
    var codelegnth=code.length
   $("#codecheck_msg").hide();
   if(codelegnth>1){
     $.get("../ajax/ajaxsupplier.php?type=check_suppliercode&supplier_code="+code+"",function(data){
       console.log(data);
      var tmp=JSON.parse(data);
       
         if(tmp.supplier_id>0){
         
         $("#codecheck_msg").fadeIn().delay(1000).fadeOut();}
     });
   }

}

function check_supplier_mail(){
    let mail=$("#sup_email").val();
    console.log(mail);
    var maillegnth=mail.length;
   $("#mailcheck_msg").hide();
   if(maillegnth>1){
     $.get("../ajax/ajaxsupplier.php?type=check_supplieremail&supplier_mail="+mail+"",function(data){
       console.log(data);
      var tmp=JSON.parse(data);
       
         if(tmp.supplier_id>0){
        
         $("#mailcheck_msg").fadeIn().delay(1000).fadeOut();}
     });
   }

}

function check_supplier_contact(){
    let contact=$("#sup_no").val();
    console.log(contact);
    var contactlegnth=contact.length
   $("#contactcheck_msg").hide();
   if(contactlegnth>1){
     $.get("../ajax/ajaxsupplier.php?type=check_suppliercontact&supplier_contact="+contact+"",function(data){
       console.log(data);
      var tmp=JSON.parse(data);
       
         if(tmp.supplier_id>0){
         
         $("#contactcheck_msg").fadeIn().delay(1000).fadeOut();}
     });
   }

}