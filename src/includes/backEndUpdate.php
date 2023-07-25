<?php
    session_start();
    include "../includes/openCon.php";
    
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


    $strSql = "SELECT * FROM tbl_students";
    $recProducts = getRecord($con, $strSql);
    $kkStudId = "";
    $kkStudId = $_GET['studentKeyId'];
    $arrStud = [];
    if(isset($_GET['studentKeyId'])){
        // Get student Info
        foreach ($recProducts as $key => $value) {
            if ($value['id'] == $kkStudId) {
                $arrStud += $value;
            }
        }

        
        if(isset($_POST['btnStudUpdate'])){
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
            $citizenShip = sanitizeInput($con, $_POST['citizenShip']);   
            $civilStatus = sanitizeInput($con, $_POST['civilStatus']);   
            $image = $_FILES['picture'];

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

                $uploadDIR = '../img/upload/';

                if (in_array($fileExt, $arrAllowedFiles) == false) {
                    $arrErrors[] = "Extention File is not Allowed, You can only upload image";
                }
                if (empty($arrErrors)) {
                    move_uploaded_file($fileTemp, $uploadDIR . $fileName);
                    if (empty($arrErrors)) {
                        move_uploaded_file($fileTemp, $uploadDIR . $fileName);                         
                    }
                }else{
                    $fileName = $arrStud['picture'];
                }
            }
            $strSql = " UPDATE tbl_students SET 
                course = '$course', 
                yearLevel = '$yearLevel', 
                lastName = '$lastName', 
                firstName = '$firstName', 
                middleName = '$middleName', 
                address = '$address', 
                telNum = '$telNum', 
                email = '$email', 
                birthPlace = '$birthPlace', 
                birthDate = '$birthDate' , 
                sex = '$sex', 
                Religion = '$Religion', 
                picture = '$fileName',
                citizenShip = '$citizenShip', 
                civilStatus = '$civilStatus' 
                WHERE id = " . $kkStudId;
                    
            if (mysqli_query($con, $strSql)){
                header("Location: ../includes/backEndUpdate.php?studentKeyId=$kkStudId");
            }else{
                echo 'Error!';
            }
        }   
    }

    if(isset($_POST['btn-LogOut'])){
        session_destroy();
        header("Location: ../");
    }

    if (isset($_POST['modal-delete-btn'])){
            $strSqlDel = " DELETE FROM tbl_students 
                            WHERE id=".$kkStudId;
    
            if(mysqli_query($con, $strSqlDel)){
                header("Location: ../adminBackEnd.php");
            }else {
                echo "Failed to Delete!";
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" /> 
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" /> 
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    </head>
    <body>
        <?php if(isset($_GET['studentKeyId']) && isset($recProducts)):?>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <a class="navbar-brand mt-2 mt-lg-0" href="../includes/clearSes.php">
                        <img src="../img/logo.png" width="60" height="40" alt="Just Logo" loading="lazy"/>
                    </a>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Team</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Projects</a>
                        </li>
                    </ul>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="dropdown" disabled> 
                            <a class="link-secondary me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button"  aria-expanded="false" > <!--data-mdb-toggle="dropdown" -->
                            <i class="fas fa-bell"></i>
                            <span class="badge rounded-pill badge-notification bg-danger"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" href="#">Some news</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">Another news</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false" >
                                <img src="../img/jett.jpg" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy"/>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                            <li>
                                <a class="dropdown-item" href="#">My profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Settings</a>
                            </li>
                            <li>
                                <form method="post"><button type="submit" class="dropdown-item" name="btn-LogOut">Logout</button></form>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav> 
            <div class="container">
                <form method="post" enctype="multipart/form-data" class="row bg-white p-2  bg-opacity-25 pt-5 pb-5">
                    <div class="col-12 mt-3">
                        <h3>Admission Information</h3>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="fw-bold mb-2" for="program">Program</label>
                        <select class="form-control col-12" required name="course" id="program">
                            <?php foreach($arrProgram as $key => $value): ?>
                            <?php 
                                if($value == $arrStud['course']){
                                    echo '<option value="'. $value.'" selected>'.$value.'</option>';
                                }else{
                                    echo '<option value="'. $value.'" >'.$value.'</option>';
                                }
                            ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="pb-3 col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="fw-bold mb-2">Admission Status</label><br>
                        <select class="form-control " required name="yearLevel" id="program">
                        <?php foreach ($addStatus as $key => $value):?>
                            <?php 
                                if($value == $arrStud['yearLevel']){
                                    echo '<option value="'. $value.'" selected>'.$value.'</option>';
                                }else{
                                    echo '<option value="'. $value.'" >'.$value.'</option>';
                                }
                            ?>
                        <?php endforeach ?>
                        </select>
                    </div><hr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this Record?</h5>
                                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                This will delete this Record permanently. You cannot undo this action.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-dark" data-mdb-dismiss="modal">Close</button>
                                <button type="submit" name="modal-delete-btn" class="btn btn-danger" id="deleteRecordStud">Delete</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <h3>Personal Information</h3>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="fw-bold px-2">2x2 Photo</label>
                        <img src="../img/upload/<?php echo $arrStud['picture']; ?>" width="130px" class="card mt-1 mx-1" alt="">
                        <p class="px-1">Note: Upload image lower than 4mb.</p>
                        <input class="form-control" type="file" name="picture">
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-4">
                        <label class="fw-bold">Student Name</label>
                        <label class="text-right  fw-bold">Last Name: </label>
                        <input class="form-control" type="text" name="lastName" value="<?php echo $arrStud['lastName'];?>" required autofocus placeholder="Last name">
                        <label class="text-right fw-bold ">First Name: </label>
                        <input class="form-control" type="text" name="firstName" value="<?php echo $arrStud['firstName'];?>" required placeholder="First name">
                        <label class="text-right fw-bold">Middle Name: </label>
                        <input class="form-control" type="text" name="middleName" value="<?php echo $arrStud['middleName'];?>" placeholder="Middle name">
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label class="fw-bold">Complete Address</label>
                        <input type="text" class="form-control mt-1" name="address" value="<?php echo $arrStud['address'];?>" id="" required placeholder="Address">
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label class="fw-bold" for="phoneNum">Phone # </label>
                        <input class="form-control mt-1" type="text" name="telNum" value="<?php echo $arrStud['telNum'];?>" maxlength="11" required id="phoneNum">
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label class="fw-bold" for="telNum">Telephone # </label>
                        <input class="form-control mt-1" type="text" name="phoneNum" required id="telNum" disabled>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label class="fw-bold mx-1" for="email">Email </label>
                        <input class="form-control mt-1" type="email" name="email" value="<?php echo $arrStud['email'];?>" required id="email">
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label class="fw-bold px-2" for="">Date of Birth</label>
                        <input class="form-control mt-1" type="date" name="birthDate" value="<?php echo $arrStud['birthDate'];?>" required id="">
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label class="fw-bold " for="">Birthplace</label>
                        <input class="form-control mt-1" type="text" name="birthPlace" value="<?php echo $arrStud['birthPlace'];?>" required id="">
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="fw-bold " for="">Sex</label>
                        <select name="sex" class="form-control" id="">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="fw-bold " for="">Citizenship</label>
                        <input class="form-control mt-1" type="text" name="citizenShip" value="<?php echo $arrStud['citizenShip'];?>" required id="">
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-3">
                        <label class="fw-bold " for="">Civil Status</label>
                        <input class="form-control mt-1" type="text" name="civilStatus" value="<?php echo $arrStud['civilStatus'];?>"  required id="">
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-3">
                        <label class="fw-bold " for="">Religion</label>
                        <input class="form-control mt-1" type="text" name="Religion" value="<?php echo $arrStud['Religion'];?>" required id=""> 
                    </div>
                    <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-lg-2">
                        <a href="../adminBackEnd.php" class="form-control mt-5 btn btn-dark">Go Back</a>
                    </div>
                    <div class="col-3 col-xs-3 col-sm-3 col-md-3 col-lg-2">
                        <button type="submit" class="form-control mt-5 btn btn-success" name="btnStudUpdate" >Update</button>
                    </div>
                    <div class="col-1 col-xs-3 col-sm-2 col-md-2 col-lg-5"></div>
                    <div class="col-5 col-xs-3 col-sm-4 col-md-4 col-lg-3">
                        <button type="button" class="form-control mt-5 btn btn-danger text-white" data-mdb-toggle="modal" data-mdb-target="#exampleModal"><i class="fas fa-trash-can"></i> Delete Record</button>
                    </div>
                </form>
            </div>
        <?php endif; ?>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>