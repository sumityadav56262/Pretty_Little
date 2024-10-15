<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }
        </style>

</head>

<body class='bg-dark text-white' style='height:100vh'>

    <form class="mw-50 h-100 d-flex justify-content-center align-items-center m-auto" action="/verify" method="post">
        @csrf
        <div class="mw-50 border border-white rounded p-3 d-flex justify-content-center m-auto">
            <div class="w-100">
                <div class="logo  border-bottom border-warning p-2"><h2>Pretty Little</h2></div>
                <div class="mb-2">
                    <h4>Forget password</h4>
                </div>
                @if($errors->has('otp'))
                    {{-- <div class="mb-4" id='msg'>
                        <p id='msg' style='display:none; color: red;'>Email or phone doesn't exist!</p>
                    </div> --}}
                    <span class="text-danger">{{$errors->first('otp')}}</span>
                @elseif(session("msg"))
                @endif
                <span class="text-danger">{{session("msg")}}</span>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" id='emailLabel'>otp: </label>
                    <input type="number" class="form-control bg-transparent text-white no-spinner" id="exampleInputEmail1"
                        name="otp" aria-describedby="emailHelp" required>
                </div>
                <input type="submit" id="submitbtn" name='submit' value="Next >" class="btn btn-warning m-auto">
            </div>
        </div>
    </form>
</body>

</html>