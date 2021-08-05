
//..............CUSTOMER GROUP JS.....................................................................................................

function check_customer_groupcode(){
    let code=$("#cust_gr_code").val();
    console.log(code);
    var codelegnth=code.length
   $("#codecheck_msg").hide();
   if(codelegnth>1){
     $.get("../ajax/ajaxcustomer.php?type=checkcustomergroupcode&cus_groupcode="+code+"",function(data){
       console.log(data);
      var tmp=JSON.parse(data);
       
         if(tmp.customergroup_id>0){
         
         $("#codecheck_msg").fadeIn().delay(1000).fadeOut();}
     });
   }
  }

  function check_customer_groupname(){
    let name=$("#cust_gr_name").val();
    console.log(name);
    var namelegnth=name.length
   $("#namecheck_msg").hide();
   if(namelegnth>1){
     $.get("../ajax/ajaxcustomer.php?type=checkcustomergroupname&cus_groupcode="+name+"",function(data){
       console.log(data);
      var tmp=JSON.parse(data);
       
         if(tmp.customergroup_id>0){
         $("#namecheck_msg").fadeIn().delay(1000).fadeOut()}
     });
   }

   }