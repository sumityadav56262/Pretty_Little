<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name    = "viewport" content = "width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel = "stylesheet" href ={{ asset('saller_css/LoginPage.css') }}>
</head>
<body class="">
    <div>
        <div  class  = "wrapper" style="">
            <div class="logo  ">
                <a style="text-decoration: none; color: orange" class="" href="index.php">
                    <h2 >Pretty Little</h2></a>
            </div>

            <form action="/login" method="post">
                @csrf
                <h2>Login</h2>
                <div class="input-box">
                    <label for="email">Email</label>
                    <input type = "email" id="email" autocomplete="email" name = "email" placeholder = "Ex:- example@mail.com" value="{{old('email')}}" required="required">
                    @if($errors->has('email'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
                    @endif
                </div>

                <div class="input-box">
                    <label for="psw">Passsword</label>
                    <input type = "password" id="psw" name = "password" placeholder = "Password" required="required">
                    @if($errors->has('password'))
                        <span class="feedback">{{$errors->first('password')}}</span>
                    @elseif(session('error'))
                       <span class="feedback">{{ session('error')}}</span>
                    @endif
                </div>
                <div class="btn-container">
                    <button class="btn btn-warning w-50" name="submit">Log In</button>
                </div>
                
                <div class="forget-link border-bottom w-75 m-auto mt-2">
                    <p>Don't rember passsword<a href="/forget_account">Forget? </a></p>
                </div>
                <div class="register-link mt-2">
                    <p>Don't have an Account<a href="/register">Register </a></p>
                    @if (session("msg"))
                        <br><span class="" style="color: rgb(0, 175, 0)">{{session("msg")}}</span>
                    @endif
                </div>
                
                </form>
        </div> 
    </div>
</body>
</html>