@php 
  $total_price = 0;
@endphp
@if($products->count() && $cartItems->count())

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @elseif(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <table style='' class=''>
        <tr>
            <th>Title</th>
            <th></th>
            <th>Qty.</th>
            <th>Total Price</th>
            <th></th>
        </tr>
        @for ($i = 0; $i<$cartItems->count(); $i++)
            @php 
                $total_price += (int)$products[$i]->price*(int)$cartItems[$i]->qty;
            @endphp
            <tr>
                <td scope='row'><a class="product-tittle" href="/productview/{{$products[$i]->id}}">{{$products[$i]->name}}</a></td>
                <td>
                    <a href='/productview/{{$products[$i]->id}}'>
                        <img class='cart_image' src="{{ asset('products_images/' . $products[$i]->pic1) }}">
                    </a>
                </td>
                <td>
                    <form method='post' action='/cart/ut'>
                        @csrf
                        <input type="hidden" name="item_id" value={{$cartItems[$i]->id}}>
                        <input type='number' name ='qty' class='w-25 bg-transparent text-white border border-warning h-10'
                        min='1' max='10' value={{$cartItems[$i]->qty}}>
                        <input type='submit' class='btn btn-warning ml-1' name='update_cart' value='Update'>
                    </form>
                </td>
                <td id='total_price'>{{(int)$products[$i]->price*(int)$cartItems[$i]->qty}}</td>
                <td>
                    <form action="cart/dlt" method="post">
                        @csrf
                        <input type='hidden' name='item_id' value={{$cartItems[$i]->id}}>
                        <input type='submit' class='btn btn-warning' name='remove_cart' value='Delete'>
                    </form>
                </td>
            </tr>
        @endfor
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <td class='total_price'>Total: Rs.{{$total_price}}</td>
            <td>
                @php
                    $data = uniqid(mt_rand(), true);
                    $data .= $_SERVER['REQUEST_TIME'];
                    $data .= $_SERVER['HTTP_USER_AGENT'];
                    $data .= $_SERVER['REMOTE_ADDR'];

                    $uuid = md5($data);
                    $total= $total_price + 100;//$pdc;
                    $messege = "total_amount=".$total.",transaction_uuid=".$uuid.",product_code=EPAYTEST";
                    $s = hash_hmac('sha256', $messege, '8gBm/:&EnhH.1/q', true);
                    $sg = base64_encode($s);
                    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

                    // Get the server name
                    $host = $_SERVER['HTTP_HOST'];

                    // Construct the full URL
                    $currentUrl = $protocol . $host;
                    $success_url = $currentUrl."/order";
                    $failure_url = $currentUrl."/cart";
                @endphp
                <form action='https://rc-epay.esewa.com.np/api/epay/main/v2/form' method='POST'>
                    <input type='hidden' id='amount' name='amount' value="{{(int)$total_price}}" required>
                    <input type='hidden' id='tax_amount' name='tax_amount' value ='0' required>
                    <input type='hidden' id='total_amount' name='total_amount' value="{{$total}}" required>
                    <input type='hidden' id='transaction_uuid' name='transaction_uuid' value="{{$uuid}}" required>
                    <input type='hidden' id='product_code' name='product_code' value ='EPAYTEST' required>
                    <input type='hidden' id='product_service_charge' name='product_service_charge' value='0' required>
                    <input type='hidden' id='product_delivery_charge' name='product_delivery_charge' value='100' required>
                    <input type='hidden' id='success_url' name='success_url' value= "{{$success_url}}" required>
                    <input type='hidden' id='failure_url' name='failure_url' value= "{{$failure_url}}" required>
                    <input type='hidden' id='signed_field_names' name='signed_field_names' value='total_amount,transaction_uuid,product_code' required>
                    <input type='hidden' id='signature' name='signature' value="{{$sg }}" required>
                    <input value='Buy Now' class='btn' type='submit'>
                </form>
            </td>
        </tr>
    </table>
@else
    <div class='w-100 text-center mt-5 mb-5'> <h4>No items are Added yet! <a href='/search' class='btn'> Shop Now</a></h4> </div>
@endif