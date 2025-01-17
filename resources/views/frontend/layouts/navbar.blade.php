 <!--==========================
        TOPBAR PART START
    ===========================-->
    <section id="wsus__topbar">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-7 d-none d-md-block">
                    <ul class="wsus__topbar_left">
                        <li><a href="mailto:krutikthakar2539@gmail.com"><i class="fal fa-envelope"></i>
                                krutikthakar2539@gmail.com</a></li>
                        <li><a href="callto:+91 9328068456"><i class="fal fa-phone-alt"></i>+91 9328068456</a></li>
                    </ul>
                </div>
                <div class="col-xl-6 col-md-5 ">
                    <ul class="wsus__topbar_right">
                        @guest
                            <!-- Show Login button if the user is not authenticated -->
                            <li></li>
                        @else
                            <!-- Optionally, you can show the user's name or other content when logged in -->
                            <li>
                                <h4><code style="color: aliceblue">Welcome, {{ Auth::user()->name }}</code> </h4>
                            </li>
                            <!-- You can also add a logout button here -->

                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--==========================
           TOPBAR PART END
       ===========================-->


    <!--==========================
           MENU PART START
       ===========================-->
    <nav class="navbar navbar-expand-lg main_menu">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="/default/sublogo1.png" alt="DB.Card">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="far fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">about</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('arts') }}">Arts</a>
                    </li>
                    {{-- <li class="nav-item">
                           <a class="nav-link" href="pricing.html">pricing</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="#">pages <i class="far fa-chevron-down"></i></a>
                           <ul class="menu_droapdown">
                               <li><a href="list_category.html">list category</a></li>
                               <li><a href="blog_details.html">blog details</a></li>
                               <li><a href="listing_details.html">Arts details</a></li>
                               <li><a href="dsahboard.html">dashboard</a></li>
                               <li><a href="agent_public_profile.html">agent profile</a></li>
                               <li><a href="payment_page.html">Payment Page</a></li>
                               <li><a href="privacy_policy.html">Privacy Policy</a></li>
                               <li><a href="terms_conditions.html">Terms Conditions</a></li>
                           </ul>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="blog.html">blog</a>
                       </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">contact us</a>
                    </li>
                    @auth

                    @endauth
                        <li><a href="{{ route('account.dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                    @guest
                        <!-- Show Login button if the user is not authenticated -->
                        <li><a href="{{ route('account.login') }}"><i class="fas fa-user"></i> Login</a></li>
                    @else
                        <!-- You can also add a logout button here -->
                        <li> <a href="{{ route('account.logout') }}">Logout</a>
                        </li>
                    @endguest


                </ul>

            </div>
        </div>
    </nav>
    <!--==========================
           MENU PART END
       ===========================-->
