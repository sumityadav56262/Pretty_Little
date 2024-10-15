<script src="https://kit.fontawesome.com/b9c282043e.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{asset('mainCss/footer.css')}}">
<div class="footer" id="footer">
    <div class="footer-row">
        <div class="footer-col">
            <h4>Info</h4>
            <ul class="links">
                <li><a href="/">Home</a></li>
                <li><a href="/about_us">About Us</a></li>
                <li><a href="http://192.168.1.76:8000/#collection">Collection</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Contact info</h4>
            <ul class="links">
                <li><a href="#footer"><i class="fa-solid fa-location-dot"></i><span> Koteshwore, Kathmandu, Nepal</span></a></li>
                <li><a href="#footer"><i class="fa-solid fa-envelope"></i><span> Prittylittle@gmail.com</span></a></li>
                <li><a href="#footer"><i class="fa-solid fa-phone"></i><span> 9866113841</span></a></li>
            </ul>
        </div>
        {{-- <div class="footer-col">
            <h4>Legal</h4>
            <ul class="links">
                <li><a href="#">Customer Agreement</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">GDPR</a></li>
                <li><a href="#">Security</a></li>
                <li><a href="#">Testimonials</a></li>
                <li><a href="#">Media Kit</a></li>
            </ul>
        </div> --}}
        <div class="footer-col subscribe-section">
            <h4>Newsletter</h4>
            <p>
                Subscribe to our newsletter and never miss out on our latest collections and exclusive offers.
            </p>
            
            @if (session('footer_success'))
                <div id="footer-msg" class="footer-msg"> 
                    <span class="success" style="color: rgb(3, 199, 3)">{{session('footer_success')}}</span>
                </div>
            @elseif(session('footer_error'))
                <div id="footer-msg" class="footer-msg"> 
                    <span class="error" style="color: rgb(255, 81, 0)">{{session('footer_error')}}</span>
                </div>
            @endif
            
            <form action='/subscribe' method="post">
                @csrf
                <input type="email" placeholder="Your email" name="email" required>
                <button type="submit">SUBSCRIBE</button>
            </form>
            <div class="icons">
                <a href="https://www.facebook.com/profile.php?id=61558522574780" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                <a href="#footer" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://www.instagram.com/_prettylittlewardrobeforu/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="#footer" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
            </div>
        </div>
    </div>

    <div class="dev"><div class="footer-border">Pritty Liitle © 2024. Made <i class="fa-solid fa-heart"></i> with 
        <a href="https://sumityadav56262.github.io/portfolio/">Sumit Yadav</a>
        </div>
    </div>
</div>
<script>
    const msg = document.getElementById('footer-msg');

    if (msg) {
        setTimeout(function () {
            msg.style.opacity = "0";
        }, 2000);
    }

</script>