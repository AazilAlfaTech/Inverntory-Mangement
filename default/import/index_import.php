<?php
    $con=mysqli_connect('localhost','root','','inventory_system');
    
    if(isset($_POST["submit"]))
    {
        // gets the temp path of the file
        $file=$_FILES['doc']['tmp_name'];
 
        // Gets the extension of the file selected
        $ext=pathinfo($_FILES['doc']['name'],PATHINFO_EXTENSION);
        if($ext='xlsx')
        {
            // include the class excel libraray
            require ("../import/import_excel/PHPExcel.php");
            require ("../import/import_excel/PHPExcel/IOFactory.php");
            
        

            // create an object     
            $obj=PHPExcel_IOFactory::load($file);
            // this function gets the data one by one and iterates
            foreach($obj->getWorksheetIterator() as $sheet)
            {   
                // echo '<pre>';
                // print_r($sheet); 
                // Get the highest row
                $higest_row=$sheet->getHighestRow();
                for($i=2;$i<=$higest_row;$i++)
                {
                    // Get the column name and the value
                    $name=$sheet->getCellByColumnAndRow(0,$i)->getValue();
                    $email=$sheet->getCellByColumnAndRow(1,$i)->getValue();
                    $age=$sheet->getCellByColumnAndRow(2,$i)->getValue();

                    // echo"$name";
                    if($name!='')
                    {
                        mysqli_query($con,"INSERT INTO test_import (name,email,age) VALUES  name','$email','$age')");
                    }
                }
            }
        }
        else
        {
            echo "Invalid file format";
        }
       
    }
    include_once "../../files/head.php";
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
                                    <h4>Manage products</h4>

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

                <div class="d-flex flex-row-reverse">
                <a href="add_new_GRN.php">
                    <button class="btn btn-mat btn-primary ">Import products</i></button>
                </a>
                </div>


                <br>
                <br>

                <!-- ----------------------------------------------------------------------------------------------------------------------------- -->



                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Autofill table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Import products</h5>
                                    <span></span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-plus minimize-card"></i></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                
                                                <input type="file" name="doc" class="form-control">

                                            </div>
                                            <div class="col-sm-6">
                                            <button type="submit" name="submit" class="btn btn-primary">submit</button>
                                            </div>
                                        </div>
                            
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
     </div>
</div>
<?php
        include_once "../../files/foot.php";
?>