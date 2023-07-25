<?php 
    session_start();
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
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body style="background-color: #0096ff;">
        <div class="container border bg-white" style="height: 100vh;">    
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
                                        <h2 class="text-center fw-bold text-dark py-2 form-title">PLEASE READ</h2>
                                    </div>
                                </div>
                                <div class="card-body bg-form">
                                    <div class="row justify-content-center">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-primary bg-darkblue fw-bold active" aria-current="page">Requirements</a>
                                        <a href="registration.php" class="btn btn-primary bg-darkblue fw-bold">Registration</a>
                                        <a href="application.php" class="btn btn-primary bg-darkblue fw-bold">Application Status</a>
                                        <a href="#" class="btn btn-primary bg-darkblue fw-bold">Contact Us</a>
                                    </div>
                                </div>
                                    <div class="row mt-3 ">
                                        <div class="col-sm-5 col-md-5 bg-darkblue section-title">
                                            <h4 class="fw-bold text-left text-dark ">S.Y. 2023 - 2024, First Semester</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="card w-100">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-4 ">
                                                        <h4 class="fw-bold text-left ">Admission Requirements:</h4>
                                                    </div>
                                                    <div class="col-sm-12 col-md-3 ">
                                                </div>
                                            <div class="col-12 ">
                                                <h5 class="fw-bold text-left" >
                                                    <span style="border-bottom: 3px solid #FCA311;">Deadline of Application: </span>
                                                </h5> 
                                                    <ul>
                                                        <li>Only ONE application can be filed for the whole University System. </li>
                                                        <li>Please ensure that you have a softcopy of the following requirements to be uploaded before proceeding:
                                                            <ol>
                                                                <li>2x2 picture in white background</li>
                                                                <li>Clear copy of grades
                                                                    <ol style="list-style:lower-alpha;">
                                                                        <li>Grade 11 card for graduating Senior High School</li>
                                                                        <li>Grade 12 for graduates of Senior High School </li>
                                                                        <li>Certification of Grades of Transcript of Records for Transferees </li>
                                                                    </ol>
                                                                </li>
                                                            </ol>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="card  w-100 status-card">
                                        <div class="card-body ">
                                            <div class="col-12 ">
                                                <h5 class="text-left"><span class="fw-bold ">Note:</span> Some academic programs may have other officially approved requirements prior to admission</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row ">                            
                                        <a class="btn btn-primary btn-block fw-bold bg-darkblue mt-3 text-uppercase" href="registration.php" role="button">Proceed to Registration</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>   
    </body>
</html>