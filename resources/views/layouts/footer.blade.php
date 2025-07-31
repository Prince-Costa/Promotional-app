@php
    use App\Models\Service;

    $settings = \App\Models\Setting::find(1);
    $services = Service::all();
    $menuItems = \App\Models\MenuItem::whereNull('parent_id')->get();
@endphp


{{-- <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row mx-0 gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="{{route('home')}}" class="logo d-flex align-items-center">
            <span class="sitename">{{$settings->site_name}}</span>
          </a>
          <div class="footer-contact pt-3">
            @if ($settings->phone_number)
              <p>{{$settings->phone_number}}</p>
            @endif
            @if ($settings->phone_number)
              <p class="mt-3"><strong>Phone:</strong> <span>{{$settings->phone_number}}</span></p>
            @endif
            @if ($settings->site_email)
              <p><strong>Email:</strong> <span>{{$settings->site_email}}</span></p>
            @endif
          </div>
          <div class="social-links d-flex mt-4">
            @if ($settings->is_active_twitter == 1)
            <a href="{{$settings->twitter_link}}""><i class="bi bi-twitter-x"></i></a>
            @endif

            @if ($settings->is_active_fb == 1)
            <a href="{{$settings->fb_link}}""><i class="bi bi-facebook"></i></a>
            @endif


            @if ($settings->is_active_instagram == 1)
            <a href="{{$settings->linkedin_link}}""><i class="bi bi-instagram"></i></a>
            @endif


            @if ($settings->is_active_linkedin == 1)
            <a href="{{$settings->instagram_link}}"><i class="bi bi-linkedin"></i></a>
            @endif






          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="{{route('home')}}" class="active">Home</a></li>
            <li><a href="{{route('home')}}#about">About</a></li>
            <li><a href="{{route('home')}}#services">Services</a></li>
            <li><a href="{{route('home')}}#packages">Packages</a></li>
            <li><a href="{{route('home')}}#portfolio">Portfolio</a></li>
            <li><a href="{{route('home')}}#team">Team</a></li>
            <li><a href="{{route('home')}}#contact">Contact</a></li>

            @foreach ($menuItems as $menuItem)
                @if ($menuItem->children->isNotEmpty())
                    <!-- If the menu item has children, make it a dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{{ $menuItem->id }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $menuItem->name }}
                        </a>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown{{ $menuItem->id }}">
                            @foreach ($menuItem->children as $child)
                                <li>
                                    <a class="dropdown-item" href="{{ $child->page_url }}" class="{{ request()->url() == $child->page_url ? 'active' : '' }}">
                                        {{ $child->name }}
                                    </a>
                                    @if ($child->children->isNotEmpty())
                                        <ul class="dropdown-menu">
                                            @foreach ($child->children as $subChild)
                                                <li><a class="dropdown-item" href="{{ $subChild->page_url }}" class="{{ request()->url() == $subChild->page_url ? 'active' : '' }}">{{ $subChild->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <!-- If no children, just a normal link -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->url() == $menuItem->page_url ? 'active' : '' }}" href="{{ $menuItem->page_url }}">
                            {{ $menuItem->name }}
                        </a>
                    </li>
                @endif
            @endforeach

            </li>

          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            @foreach ($services as $service)
            <li><i class="bi bi-chevron-right"></i> <a href="{{route('service.show',$service->id)}}">{{$service->title}}</a></li>
            @endforeach

          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Join Our Forum</h4>
          <p>Join Our Forum and receive the latest news about our products and services!</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">{{$settings->site_name}}</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed with ❤ by {{$settings->site_name}}
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow mx-0-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('public/assets/js/jquery-3.6.0.min.js')}}"></script>
  <script src="{{asset('public/assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('public/assets/front/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('public/assets/front/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('public/assets/front/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('public/assets/front/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('public/assets/front/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('public/assets/front/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{asset('public/assets/front/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
 <script src="{{asset('public/assets/js/owl.carousel.min.js')}}"></script>


  <!-- Main JS File -->
  <script src="{{asset('public/assets/front/js/main.js')}}"></script>

  @stack('js')

</body>

</html> --}}


<!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">
        <div class="row mx-0 g-5">
            <div class="col-xl-8">
                <div class="mb-5">
                    <div class="row mx-0 g-4">
                        <div class="col-md-6">
                            <div class="footer-item">
                                <a href="index.html" class="p-0">
                                    <img class="img-fluid" style="width: 150px;"
                                        src="{{ asset('public/storage/' . $settings->logo_path) }}" alt="Logo">
                                </a>
                                <p class="text-white mb-4">{{ $settings->front_cover_text }}</p>
                                <div class="footer-btn d-flex">

                                    @if ($settings->is_active_fb == 1)
                                        <a class="btn btn-md-square rounded-circle me-3"
                                            href="{{ $settings->fb_link }}"><i class="fab fa-facebook-f"></i></a>
                                    @endif

                                    @if ($settings->is_active_twitter == 1)
                                        <a class="btn btn-md-square rounded-circle me-3"
                                            href="{{ $settings->twitter_link }}"><i class="fab fa-twitter"></i></a>
                                    @endif

                                    @if ($settings->is_active_instagram == 1)
                                        <a class="btn btn-md-square rounded-circle me-3"
                                            href="{{ $settings->linkedin_link }}"><i class="fab fa-instagram"></i></a>
                                    @endif

                                    @if ($settings->is_active_linkedin == 1)
                                        <a class="btn btn-md-square rounded-circle me-0"
                                            href="{{ $settings->linkedin_link }}"><i class="fab fa-linkedin-in"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="footer-item">
                                <h4 class="text-white mb-4">Useful Links</h4>
                                <a href="{{route('home')}}/#AboutUs"><i class="fas fa-angle-right me-2"></i> About Us</a>
                                {{-- <a href="#"><i class="fas fa-angle-right me-2"></i> Features</a> --}}
                                <a href="{{route('service.index')}}"><i class="fas fa-angle-right me-2"></i> Services</a>
                                <a href="{{route('home')}}/#FAQ"><i class="fas fa-angle-right me-2"></i> FAQ's</a>
                                {{-- <a href="#"><i class="fas fa-angle-right me-2"></i> Blogs</a> --}}
                                <a href="{{route('home')}}/#contact"><i class="fas fa-angle-right me-2"></i> Contact</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="footer-item">
                    <h4 class="text-white mb-4">Newsletter</h4>
                    <p class="text-white mb-3">Subscribe to our newsletter and stay updated with the latest news and
                        offers!</p>
                    <div class="position-relative rounded-pill mb-4">
                        <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Enter your email">
                        <button type="button"
                            class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">SignUp</button>
                    </div>
                    {{-- <div class="d-flex flex-shrink-0">
                        <div class="footer-btn">
                            <a href="#" class="btn btn-lg-square rounded-circle position-relative wow tada"
                                data-wow-delay=".9s">
                                <i class="fa fa-phone-alt fa-2x"></i>
                                <div class="position-absolute" style="top: 2px; right: 12px;">
                                    <span><i class="fa fa-comment-dots text-secondary"></i></span>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-column ms-3 flex-shrink-0">
                            <span>Call to Our Experts</span>
                            <a href="tel:{{ $settings->phone_number }}"><span
                                    class="text-white">{{ $settings->phone_number }}</span></a>
                        </div>
                    </div> --}}
                </div>
            </div>

            <!--<div class="pt-5 mt-0" style="border-top: 1px solid rgba(255, 255, 255, 0.08);">-->
            <!--    <div class="row mx-0 g-0">-->
            <!--        <div class="col-12">-->
            <!--            <div class="row mx-0 g-4">-->
            <!--                @if(isset($settings->address))-->
            <!--                <div class="col-lg-4 col-md-6">-->
            <!--                    <div class="d-flex">-->
            <!--                        <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">-->
            <!--                            <i class="fas fa-map-marker-alt fa-2x"></i>-->
            <!--                        </div>-->
            <!--                        <div>-->
            <!--                            <h4 class="text-white">Address</h4>-->
            <!--                            <p class="mb-0">{{ $settings->address }}</p>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                @endif-->
            <!--                @if(isset($settings->site_email))-->
            <!--                <div class="col-lg-4 col-md-6">-->
            <!--                    <div class="d-flex">-->
            <!--                        <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">-->
            <!--                            <i class="fas fa-envelope fa-2x"></i>-->
            <!--                        </div>-->
            <!--                        <div>-->
            <!--                            <h4 class="text-white">Mail Us</h4>-->
            <!--                            <p class="mb-0">{{ $settings->site_email }}</p>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                @endif-->
                            
            <!--                @if(isset($settings->phone_number))-->
            <!--                <div class="col-lg-4 col-md-6">-->
            <!--                    <div class="d-flex">-->
            <!--                        <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">-->
            <!--                            <i class="fa fa-phone-alt fa-2x"></i>-->
            <!--                        </div>-->
            <!--                        <div>-->
            <!--                            <h4 class="text-white">Telephone</h4>-->
            <!--                            <p class="mb-0">{{ $settings->phone_number }}</p>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                @endif-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row mx-0 g-4 align-items-center">
            <div class="col-md-6 text-center text-md-end mb-md-0">
                <span class="text-body"><a href="#" class="border-bottom text-white"><i
                            class="fas fa-copyright text-light me-2"></i>{{$settings->site_name}}</a>, All right reserved.</span>
            </div>
            <div class="col-md-6 text-center text-md-start text-body">
                <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                Designed By {{$settings->site_name}}
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa-solid fa-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('public/assets/front/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('public/assets/front/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('public/assets/front/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('public/assets/front/lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('public/assets/front/lib/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('public/assets/front/lib/owlcarousel/owl.carousel.min.js') }}"></script>


<!-- Template Javascript -->
<script src="{{ asset('public/assets/front/js/main.js') }}"></script>
<script src="{{ asset('public/assets/front/js/typed.js') }}"></script>
<script src="{{ asset('public/assets/front/js/typedconfig.js') }}"></script>

@stack('js')
</body>

</html>
