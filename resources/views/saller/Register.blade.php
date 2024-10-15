<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href={{ asset('saller_css/Register.css') }}>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Register</title>
    <style>
        /* Hide the default number input arrows */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body class="bg-dark text-white">
    <div class="wrapper">
        <div class="logo mb- border-bottom border-warning p-1 d-flex ">
            <a style="text-decoration: none; color: orange" class="" href="index.php">
                <h2 >Pretty Little</h2></a>
        </div>

        <form action="/saller/register" enctype="multipart/form-data" id="myForm" method="post">
            @csrf
            <h1 class="mt-2">Registration</h1>
            <div class="text-center"><p class="text-danger" id='msg'></p></div>
            <div class="input-box">
                <div class="input-field">
                    <label for="">Full Name</label>
                    <input type="text" name="name" placeholder="Ex:- Sumit Yadav" value="{{old('name')}}" required="required">
                    @if($errors->has('name'))
                        <label class="text-danger">{{$errors->first('name')}}</label>
                    @endif
                </div>
                <div class="input-field">
                    <label for="">Address</label>
                    <input type="text" name="address" placeholder="Ex:- City,District" value="{{old('address')}}" required="required">
                    @if($errors->has('address'))
                        <label class="text-danger">{{$errors->first('address')}}</label>
                    @endif
                </div>          
            </div>
            <div class="input-box">
                <div class="input-field">
                    <label for="">Email</label>
                    <input type="text" name="email" placeholder="Ex:- example@mail.com" value="{{old('email')}}" required="required">
                    @if($errors->has('email'))
                        <label class="text-danger">{{$errors->first('email')}}</label>
                    @endif
                </div>
                <div class="input-field">
                    <label for="">Phone number</label>
                    <input type="number" name="phone_number" placeholder="Ex:- 9800000000" value="{{old('phone_number')}}" required="required">
                    @if($errors->has('phone_number'))
                        <label class="text-danger">{{$errors->first('phone_number')}}</label>
                    @endif
                </div>            
            </div>
            
            <div class="input-box">
                <div class="input-field">
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="password" value="{{old('password')}}" required="required">
                    @if($errors->has('password'))
                        <label class="text-danger">{{$errors->first('password')}}</label>
                    @endif
                </div>
                <div class="input-field">
                    <label for="">Conform Password</label>
                    <input type="password" name="password_confirmation" placeholder="Conform Password" value="{{old('password_confirmation')}}" required="required">
                    @if($errors->has('password_confirmation'))
                        <label class="text-danger">{{$errors->first('password_confirmation')}}</label>
                    @endif
                </div>            
            </div>
            <!--Image3-->
            <div class="form-outline w-100 mt-3 mb-2 m-auto">
                <label for="product_image3" class="form-label">Profile Picture</label>
                <input type="file" name="profile_pic" id="product_image3" value="{{old('profile_pic')}}"
                class="form-control bg-transparent text-white">
            </div>
            <div class="w-100 d-flex justify-content-center">
                <input type="submit" class="btn btn-warning w-50 mt-1" name="submit" value="Register">
            </div>
        </form>
        <div class="text-center w-100 mt-1">
            <p>Have already account<a href="/saller/LoginPage" class="text-warning">Login </a></p>
        </div>
    </div>
</body>
</html>