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
        @include('navbar')
        <div class="hero-section">
            <div class="header-text">
                <h2>The Best Collections 2024</h2>
                <h1>Wear <br>The Trend</h1>
                <a class="btn" href="/search">SHOP NOW</a>
            </div>
        </div>
    </div>
    <div class="for">
        <span class="tab-links selected">Best online based fashion Products for womens</span>
    </div>
    @if ($products)
        @include('productslide',['products'=>$products])
    @endif
    @include('hand-pick')
    @include('footer')
</body>
<!-- Your Script -->

<script src="{{asset('script/header.js')}}"></script>
</html>