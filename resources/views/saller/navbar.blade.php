<div class="navbar">
    <div class="logo">
        <a href="/" style="text-decoration: none; color: rgb(255, 94, 0); "><H1 style="">Pretty Little</H1></a>
    </div>
    <div class="nav">
        <div class="nav-items" id="nav-items">
            <a href="/saller" class="nav-link text-light bg-transparent my-1">Profile</a>
            <a href="/saller/insertPage" class="nav-link text-light bg-transparent my-1">Insert
                Products</a></button>

            <a href="/saller/viewProduct" class="nav-link text-light bg-transparent my-1">View Products</a>
            <a href="/saller/orders" class="nav-link text-light bg-transparent my-1">All Orders</a>
            <a href="/saller/LogOut" class="nav-link text-light bg-transparent my-1">Log out</a>
            <i class="fas fa-times" onclick="hideMenu()"></i>
        </div>
        <i class="fas fa-bars" onclick="showMenu()"></i>
    </div>
</div>
<script>
    var slideMenu = document.getElementById("nav-items");
    
    function showMenu(){
        slideMenu.style.right = "0px";
    }
    function hideMenu(){
        slideMenu.style.right = "-150px";
    }
</script>