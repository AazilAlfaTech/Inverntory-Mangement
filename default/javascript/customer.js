
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


  //.CUSTOMER JS..............................................................................................

  function check_customer_code(){
   
    let code=$("#cust_code").val();
    console.log(code);
    var codelegnth=code.length
   $("#codecheck_msg").hide();
   if(codelegnth>1){
     $.get("../ajax/ajaxcustomer.php?type=checkcustomercode&cus_code="+code+"",function(data){
       console.log(data);
      var tmp=JSON.parse(data);
       
         if(tmp.customer_id>0){
         
         $("#codecheck_msg").fadeIn().delay(1000).fadeOut();}
     });
   }

}

function check_customer_mail(){
    let mail=$("#cust_email").val();
    console.log(mail);
    var maillegnth=mail.length;
   $("#mailcheck_msg").hide();
   if(maillegnth>1){
     $.get("../ajax/ajaxcustomer.php?type=checkcustomermail&cus_mail="+mail+"",function(data){
       console.log(data);
      var tmp=JSON.parse(data);
       
         if(tmp.customer_id>0){
        
         $("#mailcheck_msg").fadeIn().delay(1000).fadeOut();}
     });
   }

}

function check_customer_contact(){
    let contact=$("#cust_no").val();
    console.log(contact);
    var contactlegnth=contact.length 
   $("#contactcheck_msg").hide();
   if(contactlegnth>1){
     $.get("../ajax/ajaxcustomer.php?type=checkcustomercontact&cus_contact="+contact+"",function(data){
       console.log(data);
      var tmp=JSON.parse(data);
       
         if(tmp.customer_id>0){
         
         $("#contactcheck_msg").fadeIn().delay(1000).fadeOut();}
     });
   }

}

//filter sales rep according to select city
$(".customercity").change(function(){

  var cityid=$(".customercity").val();
 // console.log(cityid);
  

});
