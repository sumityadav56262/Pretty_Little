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
      body{
        background-color: rgb(26, 26, 26) !important;
        color: white !important;
      }
      .cart_image {
        width: 100%;
        height: 80px;
        object-fit: contain;
      }

      table tr td {
        padding: auto;
      }
      #cart_color{
        color: white;
      }
      #order_color{
        color:orange;
      }
    </style>
</head>

<body class="">
  @include("navbar")
  <div class="d-flex">
    <!-- <div class="col-md-3  ">
      <div style='width: fit-content;' class='m-auto'>
          <img class='featurette-image img-fluid mx-auto ' data-src='holder.js/500x500/auto' alt='500x500'
          src='admin/images/IMG_E0634.jpg' data-holder-rendered='true' id='profile_pic'
          style='width: 100%; height: 300px; object-fit: contain; border-radius: 50%;'>
      </div>
      @if(isset($user))
        <div class='d-flex align-items-center m-auto' style='width: fit-content'>
          <div class=''>


              <h2 class='featurette-heading text-center border-bottom border-warning'>{{$user->name}}</h2>
              <p class='lead'>
                  <ul>
                      <li>Email: {{$user->email}}</li>
                      <li>phone: {{$user->phone}}</li>
                  </ul>
              </p>

          </div>
          @if(!empty($user->photo))
            <script>document.getElementById('profile_pic').src = "{{ asset('User_pp/' . $user->photo) }}"</script>
          @endif
        </div>
      @endif
      <div class="w-100 mb-2 text-end">
        <a class="btn btn-dark" href="conform_password.php">Edit</a>
      </div>
    </div> -->
    <div class="cart-wrapper">
          <div class="cart-menu" style="width: fit-content;">
            <a href="/cart" id='cart_color' class="">Cart</a></button>
            <a href="/orders" id='order_color' style="margin-left: 10px" class="">Orders</a>
          </div>
        @if(count($products) && $orders->count())
            <table style='width:90%' class=''>
                {{-- <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Qty.</th>
                    <th>Total Price</th>
                    <th>Delivery Date</th>
                    <th>Satus</th>
                </tr> --}}

                @for($i=count($products)-1; $i>=0; $i--)
                    <form method='post' action=''>
                      @php
                          $total_price = (int)$orders[$i]->price;
                          $orderDate = strtotime($orders[$i]->created_at);
                          $deliveryDate = strtotime("+7 days", $orderDate);
                          $currentDate = strtotime("now");
                          $deliveryDays = ceil(($deliveryDate - $currentDate) / (60 * 60 * 24));
                      @endphp
                      @if ($i != count($products)-1 && $orders[$i+1]->created_at == $orders[$i]->created_at)
                      @elseif ($deliveryDate > $currentDate)
                        <tr>
                          <th  colspan= '2' style="padding: 20px 0 5px 0; font-size:18px; font-weight:200; color: rgb(2, 238, 2);">
                            Will be Delivered within {{$deliveryDays}} days
                          </th>
                        </tr>
                      @else
                      <tr>
                        <th  colspan= '2' style="padding: 20px 0 5px 0; font-size:18px; font-weight:200; color: rgb(2, 238, 2);">
                          Delivery date has passed
                        </th>
                      </tr>
                      @endif
                      <tr>
                        <td scope='row'>{{$products[$i]->name}}</td>
                        <td><a href='product_card.php?value=$id'><img class='cart_image' src="{{asset('products_images/'.$products[$i]->pic1)}}"></a></td>
                        <td class=''>
                          {{$orders[$i]->qty}}
                        </td>
                        <td id='total_price'>Rs.{{$total_price}}</td>
                        <td>
                                <input type='hidden' name='total_price' value = >
                                <input type='hidden' name='price' value = >
                                <input type='hidden' name='product_id' value=>
                                <input type='hidden' name='transaction_code' value=>
                                <p class='m-auto'>{{$orders[$i]->created_at}}</p>
                        </td>
                        <td>
                        {{-- date("Y-m-d", strtotime("+0 days"))
                        $formattedDate = strtotime($date1) --}}
                        @if(1){{-- @if($formattedDate <= strtotime($date) && !$cancelled)  --}}
                            <input type='hidden' name='orderId' value={{$orders[$i]->id}}>
                            <input type='submit' name='cancel' class='btn btn-warning' value='Cancel'>
                        @elseif($formattedDate > strtotime($date) && !$cancelled)
                            <p class='m-auto text-success'>Delivered</p>
                        @elseif($cancelled)
                            <p class='m-auto text-danger'>Cancelled</p>
                        @endif
                        </td>
                      </tr>
                    </form>
                @endfor
            </table>
        @else
            <div class=''> <h4>Not any items Added yet! <a href='listView.blade.php' class='btn' style=""> Shop Now</a></h4> </div>
        @endif
    </div>
  </div>
  @include('footer')
</body>

</html>
