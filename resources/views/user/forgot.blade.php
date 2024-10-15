<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// //Load Composer's autoloader
// require 'phpMailer/Exception.php';
// require 'phpMailer/PHPMailer.php';
// require 'phpMailer/SMTP.php';

// //Create an instance; passing `true` enables exceptions
// $mail = new PHPMailer(true);
// session_start();

// if (isset($_POST['submit'])) {
//     $username = "singhsushil2495@gmail.com";
//     try {                                                           //Enable verbose debug output
//         $mail->isSMTP();                                            //Send using SMTP
//         $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
//         $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//         $mail->Username   = 'connectmypc2@gmail.com';               //SMTP username
//         $mail->Password   = 'taqv fadw firz akhg';                  //SMTP password
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//         $mail->SMTPSecure = 'tls';                                  // Adjust based on your SMTP server requirements
//         $mail->Port = 587;                                          //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
//         //Recipients
//         $mail->setFrom('from@WineShop.com', 'Mailer');
//         $mail->addAddress($username); //Name is optional
//         $mail->addReplyTo('info@example.com', 'Information');
    
//         //Content
//         $mail->isHTML(false);                                  //Set email format to HTML
//         $mail->Subject = 'Varify Your Email';
//         $mail->Body    = 'Varification code is: Hello';
    
//         $mail->send();
//         $_SESSION['v_code'] = $v_code;
//     } catch (Exception $e) {
//         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body class='bg-dark text-white' style='height:100vh'>

    <form class="mw-50 h-100 d-flex justify-content-center align-items-center m-auto" action="/send" method="post">
        @csrf
        <div class="mw-50 border border-white rounded p-3 d-flex justify-content-center m-auto">
            <div class="w-100">
                <div class="logo  border-bottom border-warning p-2"><h2>Pretty Little</h2></div>
                <div class="mb-2">
                    <h4>Forget password</h4>
                </div>
                @if($errors->has('email'))
                    {{-- <div class="mb-4" id='msg'>
                        <p id='msg' style='display:none; color: red;'>Email or phone doesn't exist!</p>
                    </div> --}}
                    <span class="text-danger">{{$errors->first('email')}}</span>
                @endif
                
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" id='emailLabel'>Email address</label>
                    <input type="email" class="form-control bg-transparent text-white" id="exampleInputEmail1"
                        name="email" aria-describedby="emailHelp" required>
                </div>
                <input type="submit" id="submitbtn" name='submit' value="Next >" class="btn btn-warning m-auto">
            </div>
        </div>
    </form>
</body>

</html>