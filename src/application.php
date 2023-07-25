<?php 
    session_start();
    if (isset($_POST['btnModal'])){
        $_SESSION['kStud'] = $_POST['btnModal'];
        $studId = $_SESSION['kStud'];
        header("location: appConfirm.php");
    }

    if(isset($_POST['btnToAdmin'])){
        if(isset($_SESSION['adminStatus'])){
            header("Location: ./adminBackEnd.php");
        }else{
            header("Location: admin-login.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Just Enroll</title>
        <link rel="stylesheet" href="css/modal.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body style="background-color: #0096ff;">
        <div class="container border bg-white">    
            <header class="bg-transparent">
                <nav class="navbar navbar-expand-lg  ">
                    <div class="container-fluid navbar-light">
                        <a class="navbar-brand fs-4 pt-2 text-dark" href="#">Just Enrollment</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
                            </li>
                        </ul>
                        <form method="post" class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" disabled aria-label="Search">
                            <button class="btn btn-outline-success me-2" disabled type="submit">Search</button>
                            <button type="submit" name="btnToAdmin" class="btn btn-outline-dark ">Admin</button>
                        </form>
                        </div>
                    </div>
                </nav><hr>
            </header>
            <div class="container-fluid main pb-5 ">
                <div class="section">
                    <div class="row pt-5">
                        <div class="col-12">
                            <div class="card bg-transparent border-0  ">
                                <div class="bg-transparent p-0 ">
                                    <div class="col-sm-12 col-md-6 mx-auto">
                                        <h2 class="text-center fw-bold text-dark py-2 form-title">List of Enrolled Student</h2>
                                    </div>
                                </div>
                                <div class="card-body bg-form">
                                    <div class="row justify-content-center">
                                        <div class="btn-group">
                                            <a href="index.php" class="btn btn-primary bg-darkblue fw-bold">Requirements</a>
                                            <a href="registration.php" class="btn btn-primary bg-darkblue fw-bold">Registration</a>
                                            <a href="#" class="btn btn-primary bg-darkblue fw-bold active" >Application Status</a>
                                            <a href="#" class="btn btn-primary bg-darkblue fw-bold">Contact Us</a>
                                        </div>
                                    </div>
                                    <form method="post">
                                        <div class="row container">
                                            <div class="col-12 pt-4 col-sm-4 p-1">
                                                <label class="fw-bold" for="lastname">Enter Last Name</label>
                                                <input class="form-control mt-2" type="text" value="" name="studName" id="" >
                                            </div>
                                            <div class="col-12 pt-4 col-sm-4 p-1">
                                                <label class="fw-bold" for="lastname">Select Campus</label>
                                                <input class="form-control mt-2" type="text" name="" id="lastname" disabled placeholder="Main">
                                            </div>
                                            <div class="col-4 pt-4 p-1">
                                            <label class="fw-bold" for=""></label>
                                                <input type="submit" name="filterStud" class="form-control btn btn-primary mt-2" value="Search" style="font-weight: bold;" >
                                            </div>

                                            <table class="table table-success table-striped mt-5">
                                                <?php 
                                                    include("includes/openCon.php");
                                                    $strSql = "SELECT * FROM tbl_students";
                                                    $recProducts = getRecord($con, $strSql);
                                                    if (isset($_POST['filterStud'])){
                                                        $valueToSearch = $_POST['studName'];
                                                        $sql = "SELECT * FROM tbl_students WHERE lastName='{$valueToSearch}'";
                                                        
                                                        $search_result = mysqli_query($con, $sql);

                                                        if ($_POST['studName'] <= 0) {
                                                            foreach ($recProducts as $key => $student) {
                                                                echo ' 
                                                                    <tr>
                                                                        <td style="width: 10%;"><img src="img/upload/' . $student['picture'] .'" style="width: 35px;" alt=""></td>
                                                                        <td style="width: 35%;" id="name-el"> ' . $student['lastName'] . ', ' . $student['firstName'] . ' ' . $student['middleName'] . '</td>
                                                                        <td style="width: 35%;">' . $student['course'] . '</td>
                                                                        <th style="width: 20%;">
                                                                            <button type="submit" class="btn btn-primary" value="'.$student['id'].'" name="btnModal" style="width: 120px; float:right;">
                                                                                View Status
                                                                            </button>
                                                                        </th>
                                                                    </tr>
                                                                ';
                                                            }   
                                                        }
                                                        foreach ($search_result as $key => $student) {
                                                            echo '
                                                                <tr>
                                                                    <td style="width: 10%;"><img src="img/upload/' . $student['picture'] .'" style="width: 35px;" alt=""></td>
                                                                    <td style="width: 35%;"> ' . $student['lastName'] . ', ' . $student['firstName'] . ' ' . $student['middleName'] . '</td>
                                                                    <td style="width: 35%;">' . $student['course'] . '</td>
                                                                    <th style="width: 20%;">
                                                                        <button type="submit" class="btn btn-primary" value="'.$student['id'].'" name="btnModal" style="width: 120px; float:right;">
                                                                            View Status
                                                                        </button>

                                                                    </th>    
                                                                </tr>
                                                            ';
                                                        }
                                                    }else{
                                                        foreach ($recProducts as $key => $student) {
                                                            echo ' 
                                                                <tr>
                                                                    <td style="width: 10%;"><img src="img/upload/' . $student['picture'] .'" style="width: 35px;" alt=""></td>
                                                                    <td style="width: 35%;"> ' . $student['lastName'] . ', ' . $student['firstName'] . ' ' . $student['middleName'] . '</td>
                                                                    <td style="width: 35%;">' . $student['course'] . '</td>
                                                                    <th style="width: 20%;">
                                                                        <button type="submit" class="btn btn-primary" value="'.$student['id'].'" name="btnModal" style="width: 120px; float:right;">
                                                                            View Status
                                                                        </button>
                                                                        
                                                                    </th>
                                                                </tr>
                                                            ';
                                                        } 
                                           
                                                    }    
                                                ?>   
                                            </table>                                   
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="js/getDetailss.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>   
    </body>
</html>