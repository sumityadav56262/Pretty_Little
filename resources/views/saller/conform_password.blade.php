<?php
    // include'../include/connect.php';
    // if(!isset($_SESSION['sellermail']))
    // {
    //     session_start();
    //     if(!isset($_SESSION['sellermail']))
    //         echo"<script>window.open('LoginPage.php','_self')</script>";

    // }

    // if(isset($_POST['conform'])){
    //     $password = $_POST['password'];
    //     $username = $_SESSION['sellermail'];
    //     $query  = "select *from admin_table where email = '$username' and password = '$password'";
    //     $result = mysqli_query($con,$query);
    //     $num_of_row = mysqli_num_rows($result);
    //     if($num_of_row == 1){
    //         echo"<script>window.open('edit_information.php?set','_self')</script>";
    //     }
    //     else{
    //         echo"username or password is wrong";
    //     }
    // }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confoform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body class="bg-dark text-white" style="height: 100vh;">
    <form action="" method="post" class="w-100 h-100 d-flex justify-content-center align-items-center">

        <div class="container w-25 border">

            <div class="logo mt-2 pb-2 border-bottom border-warning">
                <a href="index.php"> <img src="images/logo.png" alt=""></a>
            </div>
            <h4 class="text-center">Conform</h4>
            <div class="form-outline mb-4 w-100 m-auto">
                <label for="product_title" class="form-label">conform it is you:</label>
                <input type="password" name="password"
                    class="form-control bg-transparent text-white" placeholder="Enter password" autocomplete="off"
                    required="required">
            </div>
            <div class="bg-info m-auto mb-2 bg-transparent" style="width: fit-content;">
                <input type="submit" class="btn btn-warning" name="conform" value="conform">
                <a href="javascript:history.go(-1)" class="btn btn-warning">cancel</a>
            </div>
        </div>
    </form>
</body>

</html>