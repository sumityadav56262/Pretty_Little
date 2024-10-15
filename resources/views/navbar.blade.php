<link rel="stylesheet" href={{asset('mainCss/navbar.css')}}>
<script src="https://kit.fontawesome.com/b9c282043e.js" crossorigin="anonymous"></script>
<div class="navbar">
    <div class="logo">
        <a href="/">Pretty Little</a>
    </div>
    <div class="nav-container" id="nav-container">
        <div class="nav-items" style="">
            <div class=""><a href="/" class="">Home</a></div>
            <div class=""><a href="#footer" class="">Contact us</a></div>
            <div class=""><a class="" href="/about_us">About Us</a></div>
        </div>

        <div class="icon-holder" style="">
            <div class="search">
                <form action="/search" method="get" class="d-flex border-warning">
                    @csrf
                    <input class="search-text" type="search" name="search_text" placeholder="Search">
                    <button class="" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="cart">
                <a href="/cart" class="text-decoration-none ">
                    <i class="fa fa-shopping-cart"></i>
                </a>
                @if (session('cartItemCount'))
                    <div class="cartItemCount">{{session('cartItemCount')}}</div>
                @endif
                <div></div>
            </div>
            <div class="user">
                @if (session('useremail'))
                    <a href="profile" class="user-icon">
                        <i class="fa-solid fa-circle-user"></i>
                    </a>
                    <a href="/logout">Logout</a>
                @else
                    <a href="/login">
                        Login
                    </a>
                @endif
            </div>
        </div>
        <i onclick="hideMenu()" class="fa-solid fa-xmark"></i>
    </div>
    <i onclick="showMenu()" class="fa-solid fa-bars"></i>
</div>
<script>
    const slideMenu = document.getElementById('nav-container');
    function showMenu(){
        slideMenu.style.transform = "translateX(0%)";
    }
    function hideMenu(){
        slideMenu.style.transform = "translateX(100%)";
    }
    let lastScrollTop = 0;
    
    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', () => {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (scrollTop > lastScrollTop) {
            // Downscroll
            navbar.classList.add('hidden');
        } else {
            // Upscroll
            navbar.classList.remove('hidden');
        }
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling
    });
</script>