<?php
// include"../include/connect.php";

//         if(isset($_POST['submit'])){
//             $username = trim($_POST['uname']);
//             $password = trim($_POST['password']);
//             if(!empty($username) && !empty($password)){
//                 $pageUrl = "";
//             if(isset($_POST['directedPage']))
//                 $pageUrl = $_POST['directedPage'];
//             $username = mysqli_real_escape_string($con, $username);
//             $password = mysqli_real_escape_string($con, $password);
//             //$phone = mysqli_real_escape_string($con, $phone);
            
//             $query = "SELECT * FROM `admin_table` WHERE (email = '$username' OR phone = '$username') AND password = '$password'";
//             $result_select = mysqli_query($con,$query);
//             $number = mysqli_num_rows($result_select);
            
//             // Close the statement
            
//             if($number>0){
//                 session_start();
//                 $data = mysqli_fetch_assoc($result_select);
//                 $_SESSION["sellermail"] = $data['email']; // Set session variable
//                 echo $_SESSION["sellermail"];
//                 $_SESSION["fname"] = $data['fname'];
//                 if(!empty($pageUrl)){
//                     echo "<script>window.open('$pageUrl','_self')</script>";
//                 }
//                 else {
//                     echo "<script>window.open('index.php','_self')</script>";
//                 }
//             }
//             else{
//                 $msg = "Username or password is incorrect!";
//                 echo "<script>window.open('LoginPage.php?msg=$msg','_self')</script>";
//             }
//         }
//     }
//         // else
//         //     echo"<script>alert('please fill the information');</script>";
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name    = "viewport" content = "width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel = "stylesheet" href ={{ asset('saller_css/LoginPage.css') }}>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="bg-dark text-white">
    <div>
        <div  class  = "wrapper" style="">

            <div class="logo">
                <a style="text-decoration: none; color: orange" class="" href="index.php">
                    <h2 >Pretty Little</h2></a>
            </div>

            <form action="/saller/login" method="post">
                @csrf
                @if(session('success'))
                    <div class="w-100 text-center" style="color: rgb(20, 231, 1)">
                        <i class="fa-solid fa-circle-check"></i>
                        <span class="">{{session('success')}}</span>
                    </div>
                @endif
                <h2>Login as Seller</h2>
                <div class="input-box">
                    <label for="">Email</label>
                    <input type = "email" name = "email" placeholder = "Ex:- example@mail.com" value="{{old('email')}}" required="required">
                    @if($errors->has('email'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
                    @endif

                </div>

                <div class="input-box">
                    <label for="">Passsword</label>
                    <input type = "password" name = "password" placeholder = "Password" required="required">
                    @if($errors->has('password'))
                        <span class="text-danger">{{$errors->first('password')}}</span>
                    @elseif(session('error'))
                       <span class="text-danger text-center">{{ session('error')}}</span>
                    @endif
                </div>
                <div class="w-100 d-flex justify-content-center">
                    <button class="btn btn-warning w-50" name="submit">Log In</button>
                </div>
                
                <div class="register-link border-bottom w-75 m-auto mt-2">
                    <p>Don't rember passsword<a href="forget.php">Forget? </a></p>
                </div>
                <div class="register-link mt-2">
                    <p>Don't have an Account<a href="/saller/RegisterPage">Register </a></p>
                </div>
                
                </form>
        </div> 
    </div>
    <script src="https://kit.fontawesome.com/b9c282043e.js" crossorigin="anonymous"></script>
</body>
</html>