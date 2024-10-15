<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('mainCss/about_us.css') }}>
    <title>Document</title>
</head>
<body>
    @include('navbar')
    
    <div class="about_us">
        <h2>About Us</h2>
        <div class="about-container">
            <div class="about-wrapper">
                <img src={{ asset('images/hand-pick-background.avif') }} alt="">
            </div>
            <div class="about-wrapper">
                <p>
                    Welcome to Pretty Little Shop, your go-to destination for stylish and affordable fashion! Located in the heart of Koteshwor, Kathmandu, Nepal, our online store is dedicated to bringing you the latest trends in clothing, ensuring you always look and feel your best without breaking the bank.
                    At Pretty Little Shop, we believe that everyone deserves to enjoy beautiful, high-quality clothing. That's why we curate a stunning collection of apparel that combines elegance with affordability, making fashion accessible to everyone across Nepal. Whether you're looking for a chic outfit for a special occasion or trendy everyday wear, we have something for every taste and style.
                    Our commitment to quality and customer satisfaction drives everything we do. We take pride in offering exceptional service, ensuring your shopping experience is seamless and enjoyable from start to finish. With fast and reliable delivery across Nepal, you can enjoy the convenience of shopping from the comfort of your home, knowing that your new favorite outfit is just a click away.
                    Thank you for choosing Pretty Little Shop, where fashion meets affordability. We can't wait to help you discover your next wardrobe essential!
                </p>
            </div>
    
        </div>
        
    </div>
    @include('footer');
</body>
</html>
