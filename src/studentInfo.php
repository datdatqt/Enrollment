<?php 
    session_start();
    include("includes/openCon.php");
    if(isset($_SESSION['kStud'])){
        $strSql = "SELECT * FROM tbl_students";
        $recProducts = getRecord($con, $strSql);
        foreach ($recProducts as $key => $value) {
            if ($value['id'] == $_SESSION['kStud']) {
                $k = $value['id'];
                $fname = $value['firstName'];
                $mname = $value['middleName'];
                $lname = $value['lastName'];
                $img = $value['picture'];
                $yearLevel = $value['yearLevel'];
                $course = $value['course'];
                $addR = $value['address'];
                $phoneNum = $value['telNum'];
                $email = $value['email'];
                $birthDate = $value['birthDate'];
                $birthPlace = $value['birthPlace'];
                $sex = $value['sex'];
                $religion = $value['Religion'];
            }
        }
        // echo '<pre>';
        //  print_r($recProducts);
        // echo '</pre>';
        //  $recProducts[3]['firstName'];
    }
    
    $addStatus = array(
        'first' => '1ST YEAR',
        'second' => '2ND YEAR',
        'third' => '3RD YEAR',
        'fourth' => '4TH YEAR'
    );
    
    if (isset($_POST['goBack'])){ 
        session_destroy();
        header("location: application.php");
    }
?>    
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Just Enroll</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body style="background-color: #0096ff;">
        <?php if (isset($_SESSION['kStud'])):?>
        <div class="container bg-white pb-3">
            <div class="row">
                <div class="col-9"></div>
                <div class="col-3 text-end">
                    <form method="post">
                        <button type="submit" name="goBack" class="text-decoration-none text-dark m-2 btn"><i class="fa fa-sign-out m-1 text-dark"></i>Sign Out</button>
                    </form>
                </div>
            </div>
            <h3 class="text-center">
                <center>
                    <img src="img/upload/<?php if(isset($recProducts)){ echo $img;}?>" width="200px" class="card border border-dark mb-2" alt="">
                </center>
            <?php  if(isset($fname)){echo $fname;} ?>'s Information
        </h3><hr>
            <div class="row">
                <div class="col-4 m-2 pt-1">
                    <h5 class="pt-3">First Name:<input type="text" class="form-control my-3" name="" value="<?php if(isset($recProducts)){ echo $fname;}?>" id="fname" disabled></h5>
                    <h5 class="pt-3">Address:<input type="text" class="form-control my-3" name="" value="<?php if(isset($recProducts)){ echo $addR;}?>" id="mname" disabled></h5>
                    <h5 class="pt-3">Birtdate:<input type="date" class="form-control my-3" name="" value="<?php if(isset($recProducts)){ echo $birthDate;}?>" id="lname" disabled></h5>
                    <h5 class="pt-3">Religion:<input type="text" class="form-control my-3" name="" value="<?php if(isset($recProducts)){ echo $religion;}?>" id="addR" disabled></h5>
                </div>
                <div class="col-3 m-2 pt-1">
                    <h5 class="pt-3">Middle Name:<input type="text" class="form-control my-3" name="" value="<?php if(isset($recProducts)){ echo $mname;}?>" id="fname" disabled></h5>
                    <h5 class="pt-3">Email:<input type="text" class="form-control my-3" name="" value="<?php if(isset($recProducts)){ echo $email;}?>" id="mname" disabled></h5>
                    <h5 class="pt-3">Birthplace<input type="text" class="form-control my-3" name="" value="<?php if(isset($recProducts)){ echo $birthPlace;}?>" id="lname" disabled></h5>
                    <h5 class="pt-3">Year:<input type="text" class="form-control my-3" name="" value="<?php if(isset($recProducts)){ echo $yearLevel;}?>" id="addR" disabled></h5>
                </div>
                <div class="col-4 m-2 pt-1">
                    <h5 class="pt-3">Last Name:<input type="text" class="form-control my-3" name="" value="<?php if(isset($recProducts)){ echo $lname;}?>" id="fname" disabled></h5>
                    <h5 class="pt-3">Phone Number:<input type="text" class="form-control my-3" name="" value="<?php if(isset($recProducts)){ echo $phoneNum;}?>" id="mname" disabled></h5>
                    <h5 class="pt-3">Sex:<input type="text" class="form-control my-3" name="" value="<?php if(isset($recProducts)){ echo $sex;}?>" id="lname" disabled></h5>
                    <h5 class="pt-3">Course:<input type="text" class="form-control my-3" name="" value="<?php if(isset($recProducts)){ echo $course;}?>" id="addR" disabled></h5>
                </div>
            </div>
        <?php endif ?>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>   
    </body>
</html>