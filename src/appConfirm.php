<?php 
    session_start();
    if(isset($_GET['k'])){
        if (isset($_GET['k'])){
            
        }
        $_SESSION['kStud'] = $_GET['k'];
        
    }   
    if (isset($_POST['btnVerify'])){                                          
        if ($_POST['btnBirthPass'] == $_POST['txtBirthDate']) {
            header("Location: studentInfo.php");
        }else{
            echo '
            <center class="mt-2">
                <div class="alert alert-danger fw-bold" style="width: 500px; float-top: -200px;" role="alert">
                <i class="fa-solid fa-triangle-exclamation fa-fade"></i> Invalid Birthday!
                </div>
            </center>
                ';
        }
    }
    else{
        if(isset($autoFocusDate)){
            $autoFocusDate = "autofocus"; 
        }
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                                        <h2 class="text-center fw-bold text-dark py-2 form-title">Verification</h2>
                                    </div>
                                </div>
                                <div class="card-body bg-form">
                                    <div class="row justify-content-center">
                                        <div class="btn-group">
                                            <a href="registration.php" class="btn btn-primary bg-darkblue fw-bold">Registration</a>
                                            <a href="#" class="btn btn-primary bg-darkblue fw-bold active">Application Status</a>
                                            <a href="#" class="btn btn-primary bg-darkblue fw-bold">Contact Us</a>
                                        </div>
                                    </div>
                                    <form method="post">
                                        <div class="row container">
                                            <div class="container p-5 text-center">
                                                <div class="">
                                                <?php 
                                                    include("includes/openCon.php");
                                                    $strSql = "SELECT * FROM tbl_students";
                                                    $recProducts = getRecord($con, $strSql);
                                                    if (isset($_SESSION['kStud']) || $_SESSION['dLock']) {
                                                        $validUser = false;
                                                        foreach ($recProducts as $key => $value) {
                                                            if ($value['id'] == $_SESSION['kStud']) {
                                                                $validUser = true;
                                                                if ($validUser == true){
                                                                    echo '
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <h2 class="fw-bold text-start
                                                                                pb-3">Verification</h2>
                                                                            </div>
                                                                            <div class="col-3 text-start">
                                                                                <label for="" class="fw-bold text-start">Students Name:</label>
                                                                            </div>
                                                                            <div class="col-9">
                                                                                <label class="form-control text-start">'.$value['firstName'] .' ' .$value['middleName'] . ' ' .$value['lastName'].'</label>
                                                                            </div>
                                                                            <div class="col-3 text-start mt-3">
                                                                                <label for="" class="fw-bold">Birtday:</label>
                                                                            </div>
                                                                            <div class="col-9 mt-3">
                                                                                <input type="date" name="txtBirthDate" class="form-control text-start"'.$autoFocusDate = "autofocus".'>
                                                                                <input type="date" name="btnBirthPass" value="'.$value['birthDate'].'" hidden>
                                                                            </div>
                                                                            <div class="col-12 mt-3">
                                                                                <input type="submit" name="btnVerify" value="VERIFY" class="form-control btn btn-primary fw-bold">
                                                                            </div>
                                                                        </div>';
                                                                }else{
                                                                    $autoFocusDate += "autofocus"; 
                                                                }
                                                            }
                                                        }
                                                    }
                                                ?>
                                                </div>
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
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>   
    </body>
</html>