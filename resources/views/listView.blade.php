
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website</title>
    <!-- bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     
    <!-- Font awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
     integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous"
      referrerpolicy="no-referrer" />

    <!--CSS file link-->
    <link rel="stylesheet" href={{asset("mainCss/listview.css")}}>
</head>
<body class="text-white bg-black pt-3" style="overflow-x: hidden;">
  <!-- navbar -->
  @include('navbar')
<div class="container-fluid" style="margin-top: 80px">
    <div class="bg-transparent -2 text-center aligm-items-center">
      <h3 class="text-center hone-text">Pretty Little</h3>
      <p class="text-center">Wear the treands</p>
      @if (session('error'))
        <p style="color: red; margin-bottom: 10px">{{session('error')}} </p>
      @elseif(session('msg'))
        <p style="color: rgb(56, 238, 56); padding-bottom: 10px">{{session('msg')}} </p>
      @endif
      @if ($searchTerm)
          <p>Result for: {{$searchTerm}}</p>
      @endif
    </div>
 <!--fourth child -->
  <div class="row">
    <div class="col-md-2 p-0">
        <!--Brand to be displayed-->
        <form class="form-filter" method="GET" action="/search">
          <details open> 
            <summary> Sort by:</summary>
            <p>
              <select name="sort_by" id="sort_by">
                  <option value="id" {{ $sort_by == 'id' ? 'selected' : '' }}>Defult</option>
                  <option value="name" {{ $sort_by == 'name' ? 'selected' : '' }}>Name</option>
                  <option value="price" {{ $sort_by == 'price' ? 'selected' : '' }}>Price</option>
                  <!-- Add more options as needed -->
              </select>
              <br>
              <label for="sort_direction">Sort direction:</label><br>
              <select name="sort_direction" id="sort_direction">
                  <option value="asc" {{ $sort_direction == 'asc' ? 'selected' : '' }}>Ascending</option>
                  <option value="desc" {{ $sort_direction == 'desc' ? 'selected' : '' }}>Descending</option>
              </select>
              <br>
              @if($searchTerm)
                <input type="hidden" name="searchTerm" value="{{$searchTerm}}">
              @endif
              <button class="btn" type="submit">Sort</button>
            </p>
          </details>
      </form>
    </div>
    <div class="col-md-10">
      <!-- fetching products -->
            <div id="product_view" class="product-container">
              @if($products->count())
                @foreach ($products as $product)
                  <div class='product-wrapper'>
                    <div class='card bg-transparent' >
                      <img src={{asset('products_images/'.$product->pic1)}} class='card-img-top mt-1' alt='...'>
                      <div class='card-body'>
                          <h5 class='card-title'>{{$product->name}}</h5>
                          <p class='card-text'>Rs. {{$product->price - (int)$product->price*(int)$product->discount/100}}
                             <br>
                             @if ((int)$product->price*(int)$product->discount/100)
                              <strike>Rs. {{(int)$product->price}}</strike>
                              @else
                              <span>No Discount</span>
                             @endif
                          </p>
                          <form action='/addtocart' method='post'>
                            @csrf
                              <input type='hidden' name='product_id' value={{$product->id}}>
                              <input type='hidden' name='qty' value='1'>
                              <input type='submit' name='submit' class='btn btn-warning' value='Add to cart'>
                              <a href='/productview/{{$product->id}}' class='btn btn-secondary'>View more</a>
                          </form>
                      </div>
                    </div>
                  </div>
                @endforeach
              @else
                <div style="width: 100%;color: red;text-align: center;">
                  <h2>Sorrry! No Product found.</h2>
                </div>
              @endif 
            </div>
        </div>
        
    </div>
  </div>
</div>
@include('footer')
</body>
</html>