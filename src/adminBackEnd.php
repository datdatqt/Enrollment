<?php 
    session_start();
    include "includes/openCon.php";
    $strSql = "SELECT * FROM tbl_students";
    $recProducts = getRecord($con, $strSql);

    if(isset($_POST['hdnStudendId'])){
        echo  $studdKey = $_POST['hdnStudendId'];
        header("location: includes/backEndUpdate.php?studentKeyId=$studdKey");
    }

    if(isset($_POST['btn-LogOut'])){
        session_destroy();
        header("Location: ../src");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Server</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" /> 
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" /> 
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    </head>
    <body>
        <?php if($_SESSION['adminStatus'] == true):?>
            <form method="post">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <a class="navbar-brand mt-2 mt-lg-0" href="./includes/clearSes.php">
                            <img src="img/logo.png" width="60" height="40" alt="Just Logo" loading="lazy"/>
                        </a>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            <a class="nav-link active" href="#">Student List</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#">Request</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#"></a>
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
                                    <img src="img/jett.jpg" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy"/>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                                    <li>
                                        <a class="dropdown-item" href="#">My profile</a>
                                    </li>
                                <li>
                                    <a class="dropdown-item" href="#">Settings</a>
                                </li>
                                    <li>
                                    <button type="submit" class="dropdown-item" name="btn-LogOut">Logout</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>     
                <br>
                <div class="position-absolute start-50 mt-5 pt-5 translate-middle" >                
                    <h2>Student's List</h2>
                </div>
                <div class="container pt-5">
                    <table class="container-fluid table mt-5 align-middle ">
                        <thead class="table-dark">
                            <tr>
                                <th>Student</th>
                                <th>Grade</th>
                                <th>Course</th>
                                <th>Birthdate</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recProducts as $key => $value):?>
                                <tr>
                                    <th>
                                        <div class="d-flex align-items-center">
                                            <img src="img/upload/<?php echo $value['picture']; ?> " alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1"><?php echo $value['firstName']." ". $value['middleName']." ".$value['lastName'] ?></p>
                                                <p class="text-muted mb-0"><?php echo $value['email'];?></p>
                                            </div>
                                        </div>
                                    </th>
                                    <th><?php echo $value['yearLevel'];?></th>
                                    <th><?php echo $value['course']; ?></th>
                                    <th>
                                        <?php echo $value['birthDate']; ?>
                                    </th>
                                    <td class="text-end">
                                        <button type="submit" class="btn btn-link btn-sm btn-rounded" name="hdnStudendId" value="<?php echo $value['id'];?>">
                                            <h3 class="text-dark"><i class="fas fa-square-pen"></i></h3>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
        <?php else: ?>
                <?php 
                    $_SESSION['adminStatus'] == false;
                    header("location: ./admin-login.php");
                ?>
            </form>
        <?php endif; ?>
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>