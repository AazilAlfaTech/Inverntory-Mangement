<?php

include_once "../../files/head.php";

include_once "customer.php";

$customer1 = new customer();

if(isset($_GET['edit_cus'])){

$result_customer = $customer1->get_customer_by_id($_GET['edit_cus']);
//print_r($result_customer);

}


?>





<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4> Customer Details</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Widget</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>

                                    </h5>


                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <!-- <h5 class="card-header-text">About Me</h5> -->
                                       
                                    </div>
                                    <div class="card-block">
                                        <div class="view-info">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="general-info">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-xl-6">
                                                                <div class="table-responsive">
                                                                    <table class="table m-0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row">Customer Code</th>
                                                                                <td><?= $result_customer->customer_code ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Customer Group</th>
                                                                                <td> <?= $result_customer->customer_group ?> </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">E-mail</th>
                                                                                <td><?= $result_customer->customer_email ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">City</th>
                                                                                <td><?= $result_customer->customer_city ?></td>
                                                                            </tr>
                                                                       <!--     <tr>
                                                                                <th scope="row">Marital Status</th>
                                                                                <td>Single</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Location</th>
                                                                                <td>New York, USA</td>
                                                                            </tr> -->
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <!-- end of table col-lg-6 -->
                                                            <div class="col-lg-12 col-xl-6">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <tbody>
                                                                       <!--     <tr>
                                                                                <th scope="row">Email</th>
                                                                                <td><a href="#!"><span
                                                                                            class="__cf_email__"
                                                                                            data-cfemail="4206272f2d02273a232f322e276c212d2f">[email&#160;protected]</span></a>
                                                                                </td>
                                                                            </tr> -->
                                                                            <tr>
                                                                                <th scope="row">Customer Name</th>
                                                                                <td><?= $result_customer->customer_name ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Address</th>
                                                                                <td><?= $result_customer->customer_add ?></td>
                                                                            </tr>
                                                                           <tr>
                                                                                <th scope="row">Contact Number</th>
                                                                                <td><?= $result_customer->customer_contactno ?></td>
                                                                            </tr>
                                                                   <!--          <tr>
                                                                                <th scope="row">Website</th>
                                                                                <td><a href="#!">www.demo.com</a></td>
                                                                            </tr> -->
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <!-- end of table col-lg-6 -->
                                                        </div>
                                                        <!-- end of row -->
                                                    </div>
                                                    <!-- end of general info -->
                                                </div>
                                                <!-- end of col-lg-12 -->
                                            </div>
                                            <!-- end of row -->
                                        </div>
                                        <!-- end of view-info -->

                                        <!-- end of row -->
                                    </div>
                                    <!-- end of edit-info -->
                                </div>
                                <!-- end of card-block -->
                            </div>


                        </div>
                    </div>
                </div>


            </div>





            <?php

include_once "../../files/foot.php";

?>