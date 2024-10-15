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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/b9c282043e.js" crossorigin="anonymous"></script>
    <!--CSS file link-->
    <link rel="stylesheet" href={{asset('saller_css/ProfileAndViewProduct.css')}}>
</head>

<body class="bg-dark text-white" style="">
    <!--navbar-->
    <div class="container-fluid p-0">
        @include('saller/navbar')
        <div class="wrapper">
            <div class="container mt-3">
                <h1 class="text-center">Insert Products</h1>
                @if(session('success'))
                    <div class="w-100 text-center" style="color: rgb(20, 231, 1)">
                        <i class="fa-solid fa-circle-check"></i>
                        <span class="">{{session('success')}}</span>
                    </div>
                @endif
                <form action="/saller/insertProduct" method="post" id="myform" enctype="multipart/form-data">
                    @csrf
                    <!--Title--> 
                    <div class="form-outline mb-4 inpute-field m-auto">
                        <label for="product_title" class="form-label">Product title</label>
                        <input type="text" name="tittle" id="product_title" value="{{old('tittle')}}"
                        class="form-control bg-transparent text-white" placeholder="Enter product title" 
                        autocomplete="off" required="required">
                        @if($errors->has('tittle'))
                            <label class="text-danger">{{$errors->first('tittle')}}</label>
                        @endif
                    </div>
                    <!--Descriptio-->
                    <div class="form-outline mb-4 inpute-field m-auto">
                        <label for="description" class="form-label">Product description</label>
                        <input type="text" name="description" id="description" value="{{old('description')}}"
                        class="form-control bg-transparent text-white" placeholder="Enter product description" 
                        autocomplete="off" required="required">
                        @if($errors->has('description'))
                            <label class="text-danger">{{$errors->first('description')}}</label>
                        @endif
                    </div>
                    <!--Categories-->
                    <div class="form-outline mb-4 inpute-field m-auto">
                        <label for="Category" class="form-label">Category</label>
                        <input type="text" name="category" id="Category" value="{{old('category')}}"
                        class="form-control bg-transparent text-white" placeholder="Ex:- Mobile,Laptop,Fation" 
                        autocomplete="off" required="required">
                        @if($errors->has('category'))
                            <label class="text-danger">{{$errors->first('category')}}</label>
                        @endif
                    </div>
                    <!--Brand-->
                    <div class="form-outline mb-4 inpute-field m-auto">
                        <label for="Brand" class="form-label">Brand</label>
                        <input type="text" name="brand" id="Brand" value="{{old('brand')}}"
                        class="form-control bg-transparent text-white" placeholder="Enter product brand Name ex: samsung,Nike" 
                        autocomplete="off" required="required">
                        @if($errors->has('brand'))
                        <label class="text-danger">{{$errors->first('brand')}}</label>
                        @endif
                    </div>
                    <!--Price-->
                    <div class="form-outline mb-4 inpute-field m-auto">
                        <label for="price" class="form-label">Product price</label>
                        <input type="number" name="price" id="product_price" value="{{old('price')}}"
                        class="form-control bg-transparent text-white" placeholder="Enter product price" 
                        autocomplete="off" required="required">
                        @if($errors->has('price'))
                            <label class="text-danger">{{$errors->first('price')}}</label>
                        @endif
                    </div>
                    <!--Quantity-->
                    <div class="form-outline mb-4 inpute-field m-auto">
                        <label for="Quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="Quantity" value="{{old('quantity')}}"
                        class="form-control bg-transparent text-white" placeholder="Ex:-1,3,50.." 
                        autocomplete="off" required="required">
                        @if($errors->has('quantity'))
                            <label class="text-danger">{{$errors->first('quantity')}}</label>
                        @endif
                    </div>
                    <!--Discount-->
                    <div class="form-outline mb-4 inpute-field m-auto">
                        <label for="Discount" class="form-label">Discount</label>
                        <input type="number" name="discount" id="Discount" value="{{old('discount')}}"
                        class="form-control bg-transparent text-white" placeholder="Ex:10%" 
                        autocomplete="off" required="required">
                        @if($errors->has('discount'))
                            <label class="text-danger">{{$errors->first('discount')}}</label>
                        @endif
                    </div>
                    <!--Image1-->
                    <div class="form-outline mb-4 inpute-field m-auto">
                        <label for="product_image1" class="form-label">Product Image 1</label>
                        <input type="file" name="product_image1" id="product_image1" value="{{old('product_image1')}}"
                        class="form-control bg-transparent text-white" required="required">
                        @if($errors->has('product_image1'))
                            <label class="text-danger">{{$errors->first('product_image1')}}</label>
                        @endif
                    </div>
                    <!--Image2-->
                    <div class="form-outline mb-4 inpute-field m-auto">
                        <label for="product_image2" class="form-label">Product Image 2</label>
                        <input type="file" name="product_image2" id="product_image2" value="{{old('product_image2')}}"
                        class="form-control bg-transparent text-white" required="required">
                        @if($errors->has('product_image2'))
                            <label class="text-danger">{{$errors->first('product_image2')}}</label>
                        @endif
                    </div>
                    <!--Image3-->
                    <div class="form-outline mb-4 inpute-field m-auto">
                        <label for="product_image3" class="form-label">Product Image 3</label>
                        <input type="file" name="product_image3" id="product_image3" value="{{old('product_image3')}}"
                        class="form-control bg-transparent text-white" required="required">
                        @if($errors->has('product_image3'))
                            <label class="text-danger">{{$errors->first('product_image3')}}</label>
                        @endif
                    </div>
                    <!--Insert product-->
                     <div class="form-outline mb-4 inpute-field  m-auto">
                        <input type="submit" name="insert_product" id="insert_product" 
                        class="btn mb-3 px-3 submitbtn" value="Insert Product" onclick="btnClicked()">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    const form = document.getElementById('myform');

    form.addEventListener('submit', function(event) {
        document.body.style.cursor = 'wait';

        // Disable the form's submit button to prevent multiple submissions
        const submitButton = document.getElementById('insert_product');
        submitButton.disabled = true;
    });

    var slideMenu = document.getElementById("nav-items");
    
    function showMenu(){
        slideMenu.style.right = "0px";
    }
    function hideMenu(){
        slideMenu.style.right = "-150px";
    }
</script>
</html>