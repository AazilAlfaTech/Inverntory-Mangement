<?php

if (isset($_POST["custcode"]))
{
        $customer1->customer_code = $_POST["custcode"];
        $customer1->customer_name  = $_POST["custname"];
        $customer1->customer_add = $_POST["custadd"];
        $customer1->customer_contactno = $_POST["custno"];
        $customer1->customer_email = $_POST["cust_email"];
        $customer1->customer_city = $_POST["custcity"];
        $customer1->customer_group = $_POST["custgroup"];
        $customer1->customer_salesrep = $_POST["custsrep"];
        $customer1->customer_creditdays = $_POST["custcdays"];
        $customer1->customer_creditlimit = $_POST["custclimit"];
    //....................................................
    if(isset($_POST["edit_cus_grp"]))
    {
            $res_edit= $customer1->edit_customer($_POST["edit_cus_grp"]);
            //code for insert validation
            if($res_edit==true){
               
                header("location:../customer/manage_customer.php?success_edit=1");
            }elseif($res_edit==false){
                header("location:../customer/manage_customer.php?notsuccess=1");
            }
    }else
    {
            $res_insert=$customer1->insert_customer();;  
            //code for insert validation
            if($res_insert==true){
                
                header("location:../customer/manage_customer.php?success=1");
            }elseif($res_insert==false){
                header("location:../customer/manage_customer.php?notsuccess=1");
            }
    }


}

?>