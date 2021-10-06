<?php
include_once "../../files/config.php";

class sales_invoice{ 

    public $salesinvoice_id;
    public $salesinvoice_so_id;
    public $salesinvoice_customer;
    public $salesinvoice_ref;
    public $salesinvoice_paymethod;
    public $salesinvoice_cashmethod;
    public $salesinvoice_date;
    public $salesinvoice_status;
    
    
 

    private $db;

// --------------------------------------------------------------------------------------------------------------------
function __construct(){
          
    $this->db=new mysqli(host,un,pw,db1);
}

// ----INSERT NEW sales_invoice------------------------------------------------------------------------------------------------------------------


function insert_sales_invoice(){

    $sql="INSERT INTO sales_invoice (salesinvoice_customer,salesinvoice_ref,salesinvoice_paymethod,salesinvoice_cashmethod,salesinvoice_date)
    VALUES('$this->salesinvoice_customer','$this->salesinvoice_ref','$this->salesinvoice_paymethod','$this->salesinvoice_cashmethod','$this->salesinvoice_date')
    ";
       //echo $sql;
       $this->db->query($sql);
    $so_id=$this->db->insert_id;
    return $so_id;

}

// ---------------------------------------------------------------------------------------------------------------------



function edit_sales_invoice($salesinvoice_id){
 

    $sql="UPDATE sales_invoice  SET 
     salesinvoice_paymethod='$this->salesinvoice_paymethod'
     
     WHERE salesinvoice_id ='$salesinvoice_id' ";
    echo $sql;
    $this->db->query($sql);
    return true;

   


}

//-------------------------------------------------------------------------------------------------------------------

function delete_sales_invoice($salesinvoice_id){

    $sql="UPDATE sales_invoice SET salesinvoice_status='INACTIVE' WHERE salesinvoice_id = $salesinvoice_id ";
    //echo $sql;
    $this->db->query($sql);
    return true;


}


// ------------------------------------------------------------------------------------------------------------------------------------


function get_all_sales_invoice(){

    $sql="SELECT sales_invoice.salesinvoice_id,sales_invoice.salesinvoice_customer,sales_invoice.salesinvoice_ref,sales_invoice.salesinvoice_paymethod,sales_invoice.salesinvoice_date,sales_invoice.salesinvoice_status,customer.customer_name FROM sales_invoice JOIN customer ON sales_invoice.salesinvoice_customer=customer.customer_id WHERE sales_invoice.salesinvoice_status='ACTIVE'";
  
    $result=$this->db->query($sql);

    $sales_invoice_array=array(); //array created

    while($row=$result->fetch_array()){

        $sales_invoice_item = new sales_invoice();

        $sales_invoice_item->salesinvoice_id=$row["salesinvoice_id"];
        
        $sales_invoice_item->salesinvoice_customer=$row["salesinvoice_customer"];
        $sales_invoice_item->salesinvoice_ref=$row["salesinvoice_ref"];
        $sales_invoice_item->salesinvoice_paymethod=$row["salesinvoice_paymethod"];
        // $sales_invoice_item->salesinvoice_cashmethod=$row["salesinvoice_cashmethod"];
        $sales_invoice_item->salesinvoice_status=$row["salesinvoice_status"];

        
        
        $sales_invoice_array[]=$sales_invoice_item;
    }

    return $sales_invoice_array;
}





// ----------------------------------------------------------------------------------------------------------------------------


function get_sales_invoice_by_id($salesinvoice_id){

    $sql="SELECT sales_invoice.salesinvoice_id,sales_invoice.salesinvoice_customer,sales_invoice.salesinvoice_ref,sales_invoice.salesinvoice_paymethod,sales_invoice.salesinvoice_date,sales_invoice.salesinvoice_status,customer.customer_name FROM sales_invoice JOIN customer ON sales_invoice.salesinvoice_customer=customer.customer_id WHERE sales_invoice.salesinvoice_status='ACTIVE' AND  sales_invoice.salesinvoice_id = $salesinvoice_id";

    //echo $sql;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $sales_invoice_item = new sales_invoice();

    $sales_invoice_item->salesinvoice_id=$row["salesinvoice_id"];
    $sales_invoice_item->salesinvoice_date=$row["salesinvoice_date"];
    $sales_invoice_item->salesinvoice_customer=$row["salesinvoice_customer"];
    $sales_invoice_item->salesinvoice_customer_name=$row["customer_name"];
    $sales_invoice_item->salesinvoice_ref=$row["salesinvoice_ref"];
    $sales_invoice_item->salesinvoice_paymethod=$row["salesinvoice_paymethod"];
    //$sales_invoice_item->salesinvoice_cashmethod=$row["salesinvoice_cashmethod"];
    // $sales_invoice_item->salesinvoice_status=$row["salesinvoice_status"];
       
    return $sales_invoice_item;
}
//........................................................................................................................................
function si_code($salesinvoice_date){

        
        $sql="SELECT COUNT(*) AS count FROM `sales_invoice` WHERE MONTH(salesinvoice_date)= EXTRACT(MONTH FROM '$salesinvoice_date') ";
        $sql1="SELECT  EXTRACT(MONTH FROM '$salesinvoice_date') AS si_month ";
        $sql2="SELECT  EXTRACT(YEAR FROM '$salesinvoice_date') AS si_year ";

       
        $result = $this->db->query($sql);
        $result1 = $this->db->query($sql1);
        $result2 = $this->db->query($sql2);

        $count= 0;


        while($row=$result->fetch_array()){

            $count = $row["count"];
        }

        
        $month = "";

        while($row=$result1->fetch_array()){

            $month = $row["si_month"];
        }

        $month =sprintf("%02d", $month);

        $year = "";

        while($row=$result2->fetch_array()){

            $year = $row["si_year"];
        }

  
        

        $count = $count + 1 ;
        $count = sprintf("%04d", $count);


        //  $year = date("Y");


        $code = "SI".  substr($year, 2, 2 ) . $month . $count;  


        return $code;


    }

    function get_all_sales_invoice_bycustomer($cusid){

        $sql="SELECT * FROM  sales_invoice WHERE salesinvoice_customer=$cusid AND sales_invoice.salesinvoice_status='ACTIVE'" ;     
        $result=$this->db->query($sql);
    
        $sales_invoice_array=array(); //array created
    
        while($row=$result->fetch_array()){
    
            $sales_invoice_item = new sales_invoice();
    
            $sales_invoice_item->salesinvoice_id=$row["salesinvoice_id"];
            $sales_invoice_item->salesinvoice_customer=$row["salesinvoice_customer"];
            $sales_invoice_item->salesinvoice_date=$row["salesinvoice_date"];
            $sales_invoice_item->salesinvoice_ref=$row["salesinvoice_ref"];
            $sales_invoice_item->salesinvoice_paymethod=$row["salesinvoice_paymethod"];
            //$sales_invoice_item->salesinvoice_cashmethod=$row["salesinvoice_cashmethod"];
            $sales_invoice_item->salesinvoice_status=$row["salesinvoice_status"];
    
            
            
            $sales_invoice_array[]=$sales_invoice_item;
        }
    
        return $sales_invoice_array;
    }

//=====================================================================================================================================

function sales_invoice_status($salesinvoicestatus){
    $sql1="SELECT * FROM sales_invoice_item WHERE si_item_invoiceid=$salesinvoicestatus AND si_item_status='ACTIVE'";
    $result=$this->db->query($sql1);
   // echo $sql1;

if($result->num_rows==0){
    $sql2="UPDATE sales_invoice SET salesinvoice_status='INACTIVE' WHERE salesinvoice_id =$salesinvoicestatus";
    $this->db->query($sql2);
    //echo $sql2;
    return true;
}else{
    return false;
}
}

function sales_invoice_report(){
    //$sql="SELECT sales_invoice.salesinvoice_date,sales_invoice.salesinvoice_ref,product.product_code,product.product_name, customer.customer_name,sales_invoice_item.si_item_qty,sales_invoice_item.si_item_price,sales_invoice_item.si_item_discount FROM customer JOIN sales_invoice ON customer.customer_id=sales_invoice.salesinvoice_customer JOIN sales_invoice_item ON sales_invoice.salesinvoice_id=sales_invoice_item.si_item_invoiceid JOIN product ON sales_invoice_item.si_item_productid=product.product_id WHERE sales_invoice_item.si_item_status='ACTIVE'";
    
    $sql="SELECT sales_invoice.salesinvoice_date,sales_invoice.salesinvoice_ref,product.product_code,product.product_name,product_group.group_name, product_type.ptype_name, customer.customer_name,sales_invoice_item.si_item_qty,sales_invoice_item.si_item_price,sales_invoice_item.si_item_discount FROM customer JOIN sales_invoice ON customer.customer_id=sales_invoice.salesinvoice_customer JOIN sales_invoice_item ON sales_invoice.salesinvoice_id=sales_invoice_item.si_item_invoiceid JOIN product ON sales_invoice_item.si_item_productid=product.product_id JOIN product_group ON product.product_group=product_group.group_id JOIN product_type
     ON product.product_type=product_type.ptype_id WHERE sales_invoice_item.si_item_status='ACTIVE'";

    $result=$this->db->query($sql);
   //  echo $sql;
    $salesinvoice_arr=array();

    while($row=$result->fetch_array()){
        $salesinvoice3=new sales_invoice();

        $salesinvoice3->salesinvoice_date=$row['salesinvoice_date'];
        $salesinvoice3->salesinvoice_ref=$row['salesinvoice_ref'];
        $salesinvoice3->product_code=$row['product_code'];
        $salesinvoice3->product_name=$row['product_name'];
        $salesinvoice3->group_name=$row['group_name'];
        $salesinvoice3->ptype_name=$row['ptype_name'];
        $salesinvoice3->customer_name=$row['customer_name'];
        $salesinvoice3->si_item_qty=$row['si_item_qty'];
        $salesinvoice3->si_item_price=$row['si_item_price'];
        $salesinvoice3->si_item_discount=$row['si_item_discount'];
        $salesinvoice3->si_item_discount_amount=round(($row['si_item_qty']*$row['si_item_price']*$row['si_item_discount']),2);
        $salesinvoice3->si_item_total=round(($row['si_item_price']*$row['si_item_qty'])- $salesinvoice3->si_item_discount_amount,2);
       // $salesinvoice3->si_item_total=$row[''];

       $salesinvoice_arr[]= $salesinvoice3;

    }

    return  $salesinvoice_arr;
}

function sales_invoice_report_filter(){

    $filter_cus=$_POST['filter_cus'];
    $filter_product=$_POST['filter_product'];
    $filter_startdt=$_POST['filter_startdt'];
    $filter_group=$_POST['filter_group'];
    $filter_type=$_POST['filter_type'];
    $filter_enddt=$_POST['filter_enddt'];


    $sql="SELECT sales_invoice.salesinvoice_date,sales_invoice.salesinvoice_ref,product.product_code,product.product_name,product_group.group_name, product_type.ptype_name, customer.customer_name,sales_invoice_item.si_item_qty,sales_invoice_item.si_item_price,sales_invoice_item.si_item_discount FROM customer JOIN sales_invoice ON customer.customer_id=sales_invoice.salesinvoice_customer JOIN sales_invoice_item ON sales_invoice.salesinvoice_id=sales_invoice_item.si_item_invoiceid JOIN product ON sales_invoice_item.si_item_productid=product.product_id JOIN product_group ON product.product_group=product_group.group_id JOIN product_type
     ON product.product_type=product_type.ptype_id WHERE sales_invoice_item.si_item_status='ACTIVE'";

    if($filter_cus!=-1){
        $sql.=" and customer_name='$filter_cus'";
    }
    if($filter_group!=-1){
        $sql.=" and group_name='$filter_group'";
    }
    if($filter_product!=-1){
        $sql.=" and product_name='$filter_product'";
    }
    if($filter_type!=-1){
        $sql.=" and ptype_name='$filter_type'";
    }
    if($filter_startdt!='' && $filter_enddt!=''){
        $sql.="and salesinvoice_date BETWEEN  '".$_POST['filter_startdt']."' AND '".$_POST['filter_enddt']."' "; 
      
    }

    $result=$this->db->query($sql);
   echo $sql;
    $salesinvoice_arr=array();

    while($row=$result->fetch_array()){
        $salesinvoice3=new sales_invoice();

        $salesinvoice3->salesinvoice_date=$row['salesinvoice_date'];
        $salesinvoice3->salesinvoice_ref=$row['salesinvoice_ref'];
        $salesinvoice3->product_code=$row['product_code'];
        $salesinvoice3->product_name=$row['product_name'];
        $salesinvoice3->group_name=$row['group_name'];
        $salesinvoice3->ptype_name=$row['ptype_name'];
        $salesinvoice3->customer_name=$row['customer_name'];
        $salesinvoice3->si_item_qty=$row['si_item_qty'];
        $salesinvoice3->si_item_price=$row['si_item_price'];
        $salesinvoice3->si_item_discount=$row['si_item_discount'];
        $salesinvoice3->si_item_discount_amount=round(($row['si_item_qty']*$row['si_item_price']*$row['si_item_discount']),2);
        $salesinvoice3->si_item_total=round(($row['si_item_price']*$row['si_item_qty'])- ($salesinvoice3->si_item_discount_amount),2);
       // $salesinvoice3->si_item_total=$row[''];

       $salesinvoice_arr[]= $salesinvoice3;

    }

    return  $salesinvoice_arr;




}

function sales_report(){
    $sql="SELECT sales_invoice.salesinvoice_date,sales_invoice.salesinvoice_ref,product.product_code,product.product_name, customer.customer_name,sales_invoice_item.si_item_qty,sales_invoice_item.si_item_price,sales_invoice_item.si_item_discount FROM customer JOIN sales_invoice ON customer.customer_id=sales_invoice.salesinvoice_customer JOIN sales_invoice_item ON sales_invoice.salesinvoice_id=sales_invoice_item.si_item_invoiceid JOIN product ON sales_invoice_item.si_item_productid=product.product_id WHERE sales_invoice_item.si_item_status='ACTIVE'";
    $result=$this->db->query($sql);
    //  echo $sql;
     $salesinvoice_arr=array();
 
     while($row=$result->fetch_array()){
         $salesinvoice3=new sales_invoice();
 
         $salesinvoice3->salesinvoice_date=$row['salesinvoice_date'];
         $salesinvoice3->salesinvoice_ref=$row['salesinvoice_ref'];
         $salesinvoice3->product_code=$row['product_code'];
         $salesinvoice3->product_name=$row['product_name'];
         
         $salesinvoice3->customer_name=$row['customer_name'];
         $salesinvoice3->si_item_qty=$row['si_item_qty'];
         $salesinvoice3->si_item_price=$row['si_item_price'];
         $salesinvoice3->si_item_discount=$row['si_item_discount'];
         $salesinvoice3->si_item_discount_amount=round(($row['si_item_qty']*$row['si_item_price']*$row['si_item_discount']),2);
         $salesinvoice3->si_item_total=round(($row['si_item_price']*$row['si_item_qty'])- $salesinvoice3->si_item_discount_amount,2);
        // $salesinvoice3->si_item_total=$row[''];
 
        $salesinvoice_arr[]= $salesinvoice3;
 
     }
 
     return  $salesinvoice_arr;

}

function sales_report_filter(){
    $filter_cus=$_POST['filter_cus'];
    $filter_product=$_POST['filter_product'];
    $filter_startdt=$_POST['filter_startdt'];
   
    $filter_enddt=$_POST['filter_enddt'];

    $sql="SELECT sales_invoice.salesinvoice_date,sales_invoice.salesinvoice_ref,product.product_code,product.product_name, customer.customer_name,sales_invoice_item.si_item_qty,sales_invoice_item.si_item_price,sales_invoice_item.si_item_discount FROM customer JOIN sales_invoice ON customer.customer_id=sales_invoice.salesinvoice_customer JOIN sales_invoice_item ON sales_invoice.salesinvoice_id=sales_invoice_item.si_item_invoiceid JOIN product ON sales_invoice_item.si_item_productid=product.product_id WHERE sales_invoice_item.si_item_status='ACTIVE'";

    if($filter_cus!=-1){
        $sql.=" and customer_name='$filter_cus'";
    }
   
    if($filter_product!=-1){
        $sql.=" and product_name='$filter_product'";
    }
   
    if($filter_startdt!='' && $filter_enddt!=''){
        $sql.="and salesinvoice_date BETWEEN  '".$_POST['filter_startdt']."' AND '".$_POST['filter_enddt']."' "; 
      
    }
    $result=$this->db->query($sql);
    //  echo $sql;
     $salesinvoice_arr=array();
 
     while($row=$result->fetch_array()){
         $salesinvoice3=new sales_invoice();
 
         $salesinvoice3->salesinvoice_date=$row['salesinvoice_date'];
         $salesinvoice3->salesinvoice_ref=$row['salesinvoice_ref'];
         $salesinvoice3->product_code=$row['product_code'];
         $salesinvoice3->product_name=$row['product_name'];
         
         $salesinvoice3->customer_name=$row['customer_name'];
         $salesinvoice3->si_item_qty=$row['si_item_qty'];
         $salesinvoice3->si_item_price=$row['si_item_price'];
         $salesinvoice3->si_item_discount=$row['si_item_discount'];
         $salesinvoice3->si_item_discount_amount=round(($row['si_item_qty']*$row['si_item_price']*$row['si_item_discount']),2);
         $salesinvoice3->si_item_total=round(($row['si_item_price']*$row['si_item_qty'])- $salesinvoice3->si_item_discount_amount,2);
        // $salesinvoice3->si_item_total=$row[''];
 
        $salesinvoice_arr[]= $salesinvoice3;
 
     }
 
     return  $salesinvoice_arr;
}

// =====================================================================================================================================
}







?>