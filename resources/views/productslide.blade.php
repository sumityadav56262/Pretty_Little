<link rel="stylesheet" href={{asset('mainCss/productslide.css')}}>
<div class="slide-container swiper" id="collection">
    <div class="slide-wrapper">
    
        <div class="card-list swiper-wrapper">
            @for ($i = 0; $i < count($products); $i++)
                @php
                    $price = floor($products[$i]->price - ($products[$i]->price*$products[$i]->discount)/100);
                @endphp
                <div class="card-item swiper-slide">
                    <a href="{{ url('/productview/' . $products[$i]->id) }}">
                        <img src="{{ asset('products_images/' . $products[$i]->pic1) }}" alt="Product-Images" class="product-image">
                        <h5 class="product-name">{{ $products[$i]->name }}</h5>
                        <p class="product-price">Rs. {{ $price }}</p>
                        <strike class="product-price">M.R.P.{{ $price }}</strike>
                        <button class="buy">Buy Now</button>
                    </a>
                    <span class="ribbon">NEW</span>
                </div>
            @endfor
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"><i class="fa-solid fa-angle-left"></i></div>
        <div class="swiper-button-next"><i class="fa-solid fa-angle-right"></i></div>

        <!-- If we need scrollbar -->
        <div class="swiper-scrollbar"></div>
    </div>
</div>
<script src="{{asset('script/swiper.js')}}" type="module" ></script>