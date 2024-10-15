@php
    if(!session('email'))
        return redirect('/');    
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saler Dashboard</title>

    <!--Bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Font awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href={{asset('saller_css/ProfileAndViewProduct.css')}}>
</head>

<body class="bg-dark text-white w-100 " style="">
    <!--navbar-->
    <div class="container-fluid p-0">
        @include('saller/navbar')
        <!--fourth child-->
        <div class='d-flex mt-5'>
            @if (isset($saller))
                <div class="container">
                    <div style='width: fit-content;' class='m-auto'>
                        <img class='featurette-image img-fluid mx-auto ' data-src='holder.js/500x500/auto' alt='500x500'
                        onerror="this.onerror=null; this.src='https://as1.ftcdn.net/v2/jpg/03/46/83/96/1000_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg';"
                        src='images/IMG_E0634.jpg' data-holder-rendered='true' id='profile_pic'
                        style='width: 100%; height: 300px; object-fit: contain; border-radius: 50%;'>
                    </div>
                    <div class='d-flex align-items-center m-auto' style='width: fit-content'>
                        <div class=''>
                        
                            
                            <h2 class='featurette-heading text-center border-bottom border-warning'>{{$saller->name}}</h2>
                            <p class='lead'>
                                <ul>
                                    <li>Email: {{$saller->email}}</li>
                                    <li>phone: {{$saller->phone}}</li>
                                </ul>
                            </p>
                
                        </div>
                    </div>
                    <script>
                        document.getElementById('profile_pic').src = "{{ asset('saller_pp/'.$saller->photo) }}";
                    </script> 
                </div>
            @endif
        </div>
    </div>
</body>
<script>
    var slideMenu = document.getElementById("nav-items");
    
    function showMenu(){
        slideMenu.style.right = "0px";
    }
    function hideMenu(){
        slideMenu.style.right = "-150px";
    }
</script>
</html>