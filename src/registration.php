<?php 
    include("includes/openCon.php");

    session_start();
    if(isset($_POST['btnToAdmin'])){
        if(isset($_SESSION['adminStatus'])){
            header("Location: ./adminBackEnd.php");
        }else{
            header("Location: admin-login.php");
        }
    }

    $addStatus = array(
        'First Year' => '1ST YEAR',
        'Second Year' => '2ND YEAR',
        'Third Year' => '3RD YEAR',
        'Fourth Year' => '4TH YEAR',
        'Fifth Year' => '5TH YEAR'
    );

    $arrProgram = array(
        'Bachelor of Science in Information Technology',
        'Bachelor of Science in Business Administration',
        'Bachelor of Science in Hospitality Management',
        'Bachelor of Secondary Education'
    );

    if (isset($_POST['yearLevel']) && ($_POST['course'])) {
        $course = sanitizeInput($con, $_POST['course']);
        $yearLevel = sanitizeInput($con, $_POST['yearLevel']);
        $lastName = sanitizeInput($con, $_POST['lastName']);
        $firstName = sanitizeInput($con, $_POST['firstName']);
        $middleName = sanitizeInput($con, $_POST['middleName']);
        $address = sanitizeInput($con, $_POST['address']);
        $telNum = sanitizeInput($con, $_POST['telNum']);   
        $email = sanitizeInput($con, $_POST['email']);   
        $birthDate = sanitizeInput($con, $_POST['birthDate']);   
        $birthPlace = sanitizeInput($con, $_POST['birthPlace']);   
        $sex = sanitizeInput($con, $_POST['sex']);   
        $Religion = sanitizeInput($con, $_POST['Religion']);   
        $image = $_FILES['picture'];
        $citizenShip = sanitizeInput($con, $_POST['citizenShip']);
        $civilStatus = sanitizeInput($con, $_POST['civilStatus']);
        if (isset($image)) {
            $arrErrors = array();
            $fileName = $image['name'];
            $fileSize = $image['size'];
            $fileTemp = $image['tmp_name'];
            $fileType = $image['type'];
            
            $fileExtTemp = explode('.', $fileName);
            
             $fileExt = strtolower(end($fileExtTemp));
            //echo $fileExt;
             $arrAllowedFiles = array('jpeg','jpg','png');

             $uploadDIR = 'img/upload/';
             if (in_array($fileExt, $arrAllowedFiles) == false) {
                $arrErrors[] = "Extention File is not Allowed, You can only upload image";
                
             }
             if (empty($arrErrors)) {
                move_uploaded_file($fileTemp, $uploadDIR . $fileName);
                    if (empty($arrErrors)) {
                        move_uploaded_file($fileTemp, $uploadDIR . $fileName);

                        if (empty($arrErrors)) {
                            
                            $strSql = "
                                INSERT INTO tbl_students (course, yearLevel, lastName, firstName, middleName, address, telNum, email, birthDate, birthPlace, sex, Religion, picture, citizenShip, civilStatus)
                                VALUES ('$course', '$yearLevel', '$lastName', '$firstName', '$middleName', '$address', '$telNum', '$email', '$birthDate', '$birthPlace', '$sex', '$Religion', '$fileName', '$citizenShip', '$civilStatus')
                            ";
                            if (mysqli_query($con, $strSql)) {
                                header("location: index.php");
                            }else{
                                echo "Failed to Enroll";
                            }
                        }echo "ad";
                        
                    }else {
                        echo '<b>File Upload Error(s)</b><br>';
                        foreach ($arrErrors as $key => $value) {
                            echo $value . '<br>';
                        }
                    }
                }
            }else {
                echo '<b>File Upload Error(s)</b><br>';
                foreach ($arrErrors as $key => $value) {
                    echo $value . '<br>';
                }
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
        <div class="container bg-white" style="height: 100%;">    
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
                                        <h2 class="text-center fw-bold text-dark py-2 form-title">Registration</h2>
                                    </div>
                                </div>
                                <div class="card-body bg-form">
                                    <div class="row justify-content-center">
                                        <div class="btn-group col-12">
                                            <a href="index.php" class="btn btn-primary bg-darkblue fw-bold col-3" aria-current="page">Requirements</a>
                                            <a href="#" class="btn btn-primary bg-darkblue fw-bold active col-3">Registration</a>
                                            <a href="application.php" class="btn btn-primary bg-darkblue fw-bold col-3">Application Status</a>
                                            <a href="#" class="btn btn-primary bg-darkblue fw-bold col-3">Contact Us</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="w-100">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 text-center">
                                                        <h4 class="fw-bold text-left "></h4>
                                                    </div>
                                                    <div class="col-12 ">
                                                        <h5 class="fw-bold text-left" >
                                                            <span style="border-bottom: 3px solid #000000"></span>
                                                        </h5>
                                                    </div>
                                                    <div class="container-fluid main bg-white pt-5 pb-5 border-top">
                                                        <div class="section">
                                                            <form method="post" enctype="multipart/form-data" class="row bg-white p-2  bg-opacity-25 pt-5 pb-5">
                                                                <div class="col-12 mt-3">
                                                                    <h3>Admission Information</h3>
                                                                </div>
                                                                <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                                    <label class="fw-bold mb-2" for="program">Program</label>
                                                                    <select class="form-control col-12" required name="course" id="program">
                                                                        <?php foreach($arrProgram as $key => $value): ?>
                                                                        <option value="<?php echo $value ?>"> <?php echo $value; ?></option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </div>
                                                                <div class="pb-3 col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                                    <label class="fw-bold mb-2">Admission Status</label><br>
                                                                    <select class="form-control " required name="yearLevel" id="program">
                                                                    <?php foreach ($addStatus as $key => $value):?>
                                                                        <option name="yearLevel" value="<?php echo $value ?>" id=""><?php echo $key; ?></option>
                                                                    <?php endforeach ?>
                                                                    </select>
                                                                </div><hr>
                                                                <div class="col-12">
                                                                    <h3>Personal Information</h3>
                                                                </div>
                                                                <div class="col-6 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                                    <label class="fw-bold px-2">2x2 Photo</label>
                                                                    <img src="img/avatar.png" width="130px" class="card mt-1 mx-1" alt="">
                                                                    <p class="px-1">Note: Upload image lower than 4mb.</p>
                                                                    <input class="form-control" type="file" required name="picture">
                                                                </div>
                                                                <div class="col-6 col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-4">
                                                                    <label class="fw-bold">Student Name</label>
                                                                    <label class="text-right  fw-bold">Last Name: </label>
                                                                    <input class="form-control" type="text" name="lastName" required autofocus placeholder="Last name">
                                                                    <label class="text-right fw-bold ">First Name: </label>
                                                                    <input class="form-control" type="text" name="firstName" required placeholder="First name">
                                                                    <label class="text-right fw-bold">Middle Name: </label>
                                                                    <input class="form-control" type="text" name="middleName" placeholder="Middle name">
                                                                </div>
                                                                <div class="col-4 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                                                    <label class="fw-bold">Complete Address</label>
                                                                    <input type="text" class="form-control mt-1" name="address" id="" required placeholder="Address">
                                                                </div>
                                                                <div class="col-4 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                                                    <label class="fw-bold" for="phoneNum">Phone # </label>
                                                                    <input class="form-control mt-1" type="text" name="telNum" maxlength="11" required id="phoneNum">
                                                                </div>
                                                                <div class="col-4 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                                                    <label class="fw-bold" for="telNum">Telephone # </label>
                                                                    <input class="form-control mt-1" type="text" name="phoneNum" required id="telNum" disabled>
                                                                </div>
                                                                <div class="col-4 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                                                    <label class="fw-bold mx-1" for="email">Email </label>
                                                                    <input class="form-control mt-1" type="email" name="email" required id="email">
                                                                </div>
                                                                <div class="col-4 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                                                    <label class="fw-bold px-2" for="">Date of Birth</label>
                                                                    <input class="form-control mt-1" type="date" name="birthDate" required id="">
                                                                </div>
                                                                <div class="col-4 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                                                    <label class="fw-bold " for="">Birthplace</label>
                                                                    <input class="form-control mt-1" type="text" name="birthPlace" required id="">
                                                                </div>
                                                                <div class="col-6 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                                    <label class="fw-bold " for="">Sex</label>
                                                                    <select name="sex" class="form-control" id="">
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-6 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                                    <label class="fw-bold " for="">Citizenship</label>
                                                                    <input class="form-control mt-1" type="text" name="citizenShip" required id="">
                                                                </div>
                                                                <div class="col-6 col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-3">
                                                                    <label class="fw-bold " for="">Civil Status</label>
                                                                    <input class="form-control mt-1" type="text" name="civilStatus" required id="">
                                                                </div>
                                                                <div class="col-6 col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-3">
                                                                    <label class="fw-bold " for="">Religion</label>
                                                                    <input class="form-control mt-1" type="text" name="Religion" required id=""> 
                                                                </div>
                                                                <div class="col-4 col-xs-4 col-sm-4 col-md-3 col-lg-2">
                                                                    <a href="index.php" class="form-control mt-5 btn btn-danger">Go Back</a>
                                                                </div>
                                                                <div class="col-4 col-xs-4 col-sm-4 col-md-6 col-lg-8">
                                                                </div>
                                                                <div class="col-4 col-xs-4 col-sm-4 col-md-3 col-lg-2">
                                                                    <input class="form-control mt-5 btn btn-success" type="submit" value="Submit">
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
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>   
    </body>
</html>