<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website - Cart Details</title>

    <!-- Font awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href={{asset('mainCss/cart.css')}}>
    <style>
      /* */
    </style>
</head>

<body class="">
  @include("navbar")
  <div class="cart-wrapper">
      <div class="cart-menu" style="">
        <a href="/cart" id='cart_color' style="color: var(--text-hover); margin-right:10px;" class="">Cart</a></button>
        <a href="/orders" id='order_color' class="">Orders</a>
      </div>
      @include("user/cart_items",['products'=>$products,'cartItems'=>$cartItems])
  </div>
  @include('footer')
</body>

</html>
    