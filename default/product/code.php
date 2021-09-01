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


<tr>\
        <td class='table-edit-view'><span class='tabledit-span'></span>\
            <input class='form-control input-sm productid '   type='hidden' name='' value=''>\
        </td>\
        <td class='table-edit-view'><span class='tabledit-span'></span>\
            <input class='input-borderless input-sm row_data quantity'   type='text' readonly  name='Quantity[]' value=''><div style='color: red; display: none' class='msg1'>Digits only</div>\
        </td>\
        <td class='table-edit-view'><span class='tabledit-span'></span>\
            <input class='input-borderless input-sm row_data price'   type='text' readonly name='Price[]' value=''> <div style='color:red; display: none' class='msg2'>Digits only</div>\
        </td>\
        <td class='table-edit-view'><span class='tabledit-span'></span>\
            <input class='input-borderless input-sm row_data discount'   type='text' readonly name='Discount[]' value=''> <div style='color: red; display: none' class='msg3'>Digits only</div>\
        </td>\
        <td class='table-edit-view'><span class='tabledit-span'></span>\
            <input class='input-borderless input-sm row_data total'   type='text' readonly value=''>\
        </td>\
        <td>\
            <span class='btn_edit'><button class='btn btn-mini btn-primary' type='button'>Edit</button></span>\
            <span class='btn_save'><button class='btn btn-mini btn-success' type='button'>Save</button></span>\
            <span class='btn_cancel'><bbtn_deleterowutton class='btn btn-mini btn-danger' type='button'>Cancel</button></span>\
            <span class=''><button    class='btn btn-mini btn-danger'>Delete</button></span>\
        </td>\
</tr>\