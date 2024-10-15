<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product Card</title>

    <link rel="stylesheet" href="{{asset('mainCss/product_cart.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha256.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/enc-base64.min.js"></script>

</head>

<body class="">
    @include('navbar')
    @if($product)
        <div class='product-container'>
            <div class='wrapper'>
                    <div class='all-images'>
                        <div class='small-image'>
                            <img src="{{ asset('products_images/' . $product->pic1) }}"  onclick='clickedimg(this)' alt=''>
                            <img src="{{ asset('products_images/' . $product->pic2) }}" onclick='clickedimg(this)' alt=''>
                            <img src="{{ asset('products_images/' . $product->pic3) }}" onclick='clickedimg(this)' alt=''>
                        </div>
                        <div class='main-image'>
                            <img id='mainImg' src="{{ asset('products_images/' . $product->pic1) }}" alt=''>
                        </div>
                    </div>
                <div class='text'>
                    <div class='content'>
                        <p class='brand'>{{$product->brand}}</p>
                        <h2 class='model'>{{$product->name}}</h2>
                        <div class='price-box'>
                            <input type="hidden" id="price" value = "{{$product->price}}"/>
                            <p class='price'>Rs. {{floor($product->price- ($product->price*$product->discount)/100)}}</p>
                            <strike>Rs. {{$product->price}}</strike>
                        </div>
                        <form action='/addtocart' method='post' enctype="multipart/form-data">
                            @csrf
                            <p class=''>Quantity: <input type='number' name='qty' id="qty" class='' value='1' min=1></p>
                            <input type='hidden' name='product_id' value={{$product->id}}>
                            @if (session('error'))
                            <span style="color: red; margin-bottom: 10px">{{session('error')}} </span>
                            @elseif(session('msg'))
                                <span style="color: rgb(56, 238, 56); padding-bottom: 10px">{{session('msg')}} </span>
                            @endif
                            <input type='submit' name='submit' class='btn' value='Add to cart'>
                        </form> 
                        @if (session('useremail'))
                            
                        
                         @php
                            $data = uniqid(mt_rand(), true);
                            $data .= $_SERVER['REQUEST_TIME'];
                            $data .= $_SERVER['HTTP_USER_AGENT'];
                            $data .= $_SERVER['REMOTE_ADDR'];

                            $uuid = md5($data);
                            
                            $messege = "total_amount=".((int)$product->price+100).",transaction_uuid=".$uuid.",product_code=EPAYTEST";
                            $s = hash_hmac('sha256', $messege, '8gBm/:&EnhH.1/q', true);
                            $sg = base64_encode($s);
                            $pd = base64_encode((int)$product->id);
                            $pq = base64_encode(1);
                        @endphp
                        <form action='https://rc-epay.esewa.com.np/api/epay/main/v2/form' method='POST'>
                            <input type='hidden' id='amount' name='amount' value="{{(int)$product->price}}" required>
                            <input type='hidden' id='tax_amount' name='tax_amount' value ='0' required>
                            <input type='hidden' id='total_amount' name='total_amount' value="{{(int)$product->price+100}}" required>
                            <input type='hidden' id='transaction_uuid' name='transaction_uuid' value="{{$uuid}}" required>
                            <input type='hidden' id='product_code' name='product_code' value ='EPAYTEST' required>
                            <input type='hidden' id='product_service_charge' name='product_service_charge' value='0' required>
                            <input type='hidden' id='product_delivery_charge' name='product_delivery_charge' value='100' required>
                            <input type='hidden' id='success_url' name='success_url' value='http://127.0.0.1:8000/order?xhzp={{$pd}}&lpdb={{$pq}}&' required>
                            <input type='hidden' id='failure_url' name='failure_url' value='http://127.0.0.1:8000/cart' required>
                            <input type='hidden' id='signed_field_names' name='signed_field_names' value='total_amount,transaction_uuid,product_code' required>
                            <input type='hidden' id='signature' name='signature' value="{{$sg }}" required>
                            <input value='Buy Now' class='btn' type='submit'>
                        </form>
                        @else
                        <form action="/login" method="get">
                            @csrf
                            <input value='Buy Now' class='btn' type='submit'>
                        </form>
                        @endif
                        <p class='mt-5'>Description:{{ $product->discription}}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @include('footer')
    <script src={{asset('script/gen.js')}}></script>
</body>
<script>
    function clickedimg(smallImg) {
        var mainImg = document.getElementById('mainImg');
        mainImg.src = smallImg.src
    }
</script>
</html>