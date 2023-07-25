<?php 
    session_start();
    if(isset($_SESSION['adminStatus'])){
        $_SESSION['adminStatus'] = $_SESSION['adminStatus'];
    }
    include "includes/openCon.php";
    $strSql = "SELECT * FROM tbl_admin";
    $recProducts = getRecord($con, $strSql);
    if(isset($_POST['btn-login'])){

        $username = htmlspecialchars($_POST['txtuserName']);    //anti xss
        $password = htmlspecialchars($_POST['txtuserPass']);                      

        $username = stripslashes($username);    //removal of single qoutes
        $password = stripslashes($password);

        $userName = mysqli_real_escape_string($con, $username); //escaping any attemps for sql injection
        $password = mysqli_real_escape_string($con, $password);

        $userPassw = md5($password); 

        if(isset($_SESSION['adminStatus']) && $_SESSION['adminStatus'] = true){
            header("Location: /Enrollment/src/adminBackEnd.php");
        } 

        if($userName == $recProducts['username'] && $userPassw == $recProducts['password']){
            $_SESSION['adminStatus'] = true;
            header("location: adminBackEnd.php");
        }else{
            echo '
                <center class="width: 100%;">
                    <div class="position-relative row">
                        <div class="alert col-8 col-xs-4 col-sm-7 col-md-5 col-lg-4 alert-danger mb-0 alert-dismissible alert-absolute fade show position-absolute start-50 mt-5 translate-middle" id="alertExample" role="alert" data-mdb-color="secondary">
                            <i class="fas fa-check me-2"></i>Invalid Username / Password
                            <button type="button" class="btn-close ms-2" data-mdb-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </center>
            ';
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Just Enrollment Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="css/login-style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" /> 
        <!-- Google Fonts --> 
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" /> 
        <!-- MDB --> 
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    </head>
    <body style="background-color: #0096ff;">
        <section class="vh-100">
            <form method="post" class="d-flex float-end px-4 pt-3">
                <a href="../src" class="btn-md text-dark"><h3><i class="fas fa-circle-xmark"></i></h3></a>
            </form>
             
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid" alt="Sample image">
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <form method="post">
                            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                                <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                                <button type="button" class="btn btn-primary btn-floating mx-1" disabled>
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-floating mx-1" disabled>
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-floating mx-1" disabled>
                                    <i class="fab fa-instagram"></i>
                                </button>
                            </div>
                            <div class="divider d-flex align-items-center my-4">
                                <p class="text-center fw-bold mx-3 mb-0">Or</p>
                            </div>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="emailAddEnrollme" name="txtuserName" class="form-control form-control-lg" placeholder="Enter a valid email address" autofocus required/>
                                <label class="form-label" for="emailAddEnrollme">Username</label>
                            </div>
                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <input type="password" id="passEnrollmentz" name="txtuserPass" class="form-control form-control-lg" placeholder="Enter password" required/>
                                <label class="form-label" for="passEnrollmentz">Password</label>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Checkbox -->
                                <div class="form-check mb-0">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="icheckMo-G" />
                                    <label class="form-check-label" for="icheckMo-G">
                                        Remember me
                                    </label>
                                </div>
                                <a href="#" class="text-body" disabled>Forgot password?</a>
                            </div>
                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" name="btn-login" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#" class="link-danger" disabled>Register</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
                
                <div class="text-white mb-3 mb-md-0">
                    Copyright © 2023. All rights reserved.
                </div>
                <div>
                    <a href="#!" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#!" class="text-white">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div> -->
        </section>
        
        <!-- MDB -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>