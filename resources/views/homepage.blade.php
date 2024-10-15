<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href={{ asset('mainCss/header.css') }}>
    <script src="https://kit.fontawesome.com/b9c282043e.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="wrapper">
        <div class="navbar">
            <div class="logo">
                <a href="index.php"><H2> Pretty Little</H2></a>
            </div>
            <div class="nav-items" style="">
                <div class=""><a href="index.php" class="">Home</a></div>
                <div class=""><a href="index.php" class="">Contact us</a></div>
                <div class=""><a class="" href="about_us.php">About Us</a></div>
            </div>

            <div class="icon-holder" style="">
                <div class="search">
                    <form action="#" method="post" class="d-flex border rounded border-warning">
                        <input class="form-control mr-sm-2" type="search" name="search_text" placeholder="Search">
                        <button class="" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="cart">
                    <a href="#" class="text-decoration-none ">
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="hero-section">
            <div class="header-text">
                <h2>The Best Collections 2024</h2>
                <h1>Wear <br>The Trend</h1>
                <button>SHOP NOW</button>
            </div>
        </div>
    </div>
    <div class="for">
        <span class="tab-links selected" onclick="clicked()">Men</span>
        <span class="tab-links" onclick="clicked()">Women</span>
        <span class="tab-links" onclick="clicked()">Kids</span>
    </div>
    @if ($products)
        @include('productslide',['products'=>$products])
    @endif
    @include('hand-pick')
    @include('subscribe')
    @include('footer')
</body>
<!-- Your Script -->

<script src="{{asset('script/header.js')}}"></script>
</html>