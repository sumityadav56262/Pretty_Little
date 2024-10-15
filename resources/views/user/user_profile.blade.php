<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('mainCss/user_profile.css')}}">
    <title>User Profile</title>
</head>
<body>
    @include('navbar')
    <div class="profile-container">
        <div class="profile-wrapper">
            <div class="picture-container"><img src="" alt="" id="profile_pic"></div>
            <div class='profile-content-container'>
                <h2 class=''>{{$user->name}}</h2>
                <ul>
                    <li>Email: {{$user->email}}</li>
                    <li>phone: {{$user->phone}}</li>
                </ul>
            </div>
            @if(!empty($user->photo))
                <script>document.getElementById('profile_pic').src = "{{ asset('User_pp/' . $user->photo) }}"</script>
            @else
                <script>document.getElementById('profile_pic').src = "https://bup.edu.bd/public/upload/user-dummy.jpeg"</script>
            @endif
            <div class="">
                <a class="btn btn-dark" href="/egprofile">Change password</a>
            </div>
        </div>
    </div>
    <style>
        
    </style>
    @include('footer')
</body>
</html>
{{-- <div class="col-md-3  ">
      {{--<div style='width: fit-content;' class='m-auto'>
          <img class='featurette-image img-fluid mx-auto ' data-src='holder.js/500x500/auto' alt='500x500'
          src='admin/images/IMG_E0634.jpg' data-holder-rendered='true' id='profile_pic'
          style='width: 100%; height: 300px; object-fit: contain; border-radius: 50%;'>
      </div>
       @if(isset($user))
        <div class='d-flex align-items-center m-auto' style='width: fit-content'>
          
          
        </div>
      @endif 
      
    </div> --}}