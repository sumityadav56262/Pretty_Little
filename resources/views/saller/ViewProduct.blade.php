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

    <!--CSS file link-->
    <link rel="stylesheet" href={{asset("saller_css/listview.css")}}>
</head>

<body class="bg-dark text-white w-100 " style="">
    <!--navbar-->
    <div class="container-fluid p-0">
        @include('saller/navbar')
        <div class="wrapper">
            <div class="container">
                <form action="/saller" method="get">
                    @if (session('success'))
                        <h5 style="color: rgb(3, 196, 3)">{{session('success')}}</h5>
                    @elseif(session('error'))
                        <h5 style="color: red">{{session('error')}}</h5>
                    @endif
                    <h5></h5>
                    <table class="table table-bordered table-dark">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Price</th>
                            <th scope="col">Description</th>
                            <th scope="col">Picture 1</th>
                            <th scope="col">Picture 2</th>
                            <th scope="col">Picture 3</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Toatal sale</th>
                            <th scope="col">Btn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($products as $product) 
                                <tr>
                                    <th scope='row'>{{$i}}</th>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category}}</td>
                                    <td>{{$product->brand}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->discription}}</td>
                                    <td><a href={{asset('products_images/'.$product->pic1)}} target='blank'><img style="width: 50px; height: auto;" src={{asset('products_images/'.$product->pic1)}}></a></td>
                                    <td><a href={{asset('products_images/'.$product->pic2)}} target='blank'><img style="width: 50px; height: auto;" src={{asset('products_images/'.$product->pic2)}}></a></td>
                                    <td><a href={{asset('products_images/'.$product->pic3)}} target='blank'><img style="width: 50px; height: auto;" src={{asset('products_images/'.$product->pic3)}}></a></td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->sold_count}}</td>
                                    <td>
                                        <form action="/saller/delete" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="submit" class="btn" value="Delete" >
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $i+=1;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>