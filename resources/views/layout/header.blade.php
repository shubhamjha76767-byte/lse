
           
           @php
           $data= App\Models\Seting::first();
           @endphp
        <header id="siteHeader" class="header header-min bg-dark-bg">
           
            <div class="nav nav-min-mobile d-lg-none align-items-center position-relative border-dark-primary-3 border-bottom pt-4">

                <button class="header-min-navToggle btn p-0 d-block lh-1 ms-3 py-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">

                    <span class="header-min-navToggle-bar"></span>

                    <span class="header-min-navToggle-bar"></span>

                    <span class="header-min-navToggle-bar"></span>

                </button>

                <a class="brand d-block position-absolute top-0 start-50 translate-middle-x mt-3 pt-1" href="/">

                    <img src="{{url('storage/' . $data->logo)}}" alt="Site Logos" width="150" height="56">

                </a>

                <a href="tel{{$data->contact}}" class="w-100 btn text-center rounded-0 bg-primary-dark bg-hover-primary text-white py-2 f400 mt-3">{{$data->contact}}</a>

            </div>  



            <nav class="nav nav-min offcanvas-lg offcanvas-start d-lg-flex flex-lg-wrap" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

                <div class="nav-min-bottom w-100 position-relative border-dark-primary-3 border-bottom d-none d-lg-block">

                    <div class="container-fluid d-flex align-items-center py-3">

                        <div class="py-1">

                            <span class="d-block text-md-small">{{$data->time}}</span>

                            <a class="text-primary text-hover-white text-md-small" href="mailto:{{$data->email}}">{{$data->email}}</a>

                        </div>

                        <a class="brand d-block position-absolute top-50 start-50 translate-middle" href="/">

                            <img src="{{url('storage/' . $data->logo)}}" alt="Site Logo" width="150" height="56">

                        </a>

                        <ul class="d-flex flex-wrap ms-auto nav-social align-items-center">

                            <li class="me-2">

                                @php
                                    $telegramLink = 'https://t.me/' . ltrim($data->telegram, '@');
                                @endphp

                                <a class="bg-info text-white rounded-circle icon d-flex align-items-center justify-content-center fs-5"
                                   href="{{ $telegramLink }}"
                                   target="_blank"
                                   rel="noopener">
                                   <i class="fa fa-telegram"></i>
                                </a>


                            </li>

                            <li class="me-2">
                                @php
                                    $cleanNumber = str_replace(' ', '', $data->whatsapp);
                                @endphp

                                <a class="bg-success text-white rounded-circle icon d-flex align-items-center justify-content-center fs-5"
                                   href="https://wa.me/{{ $cleanNumber }}"
                                   target="_blank"
                                   rel="noopener">
                                   <i class="fa fa-whatsapp"></i>
                                </a>

                             </li>

                            <li>

                                <a  class="text-white text-hover-primary" href="tel:{{$data->contact}}">{{$data->contact}}</a>

                            </li>

                        </ul>

                    </div>

                </div>

                <div class="nav-min-top w-100 border-dark-primary-3 border-bottom">

                    <div class="container-fluid px-lg-3 px-0">

                        <div class="d-lg-flex w-100 align-items-lg-center justify-content-lg-center position-relative">

                            <div class="d-flex justify-content-between align-items-center d-lg-none position-relative p-3 py-4   nav-min-header  top-0 start-0 w-100 bg-dark-bg">

                                <div class="nav-min-close btn-close text-small" type="button" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasNavbar" aria-label="Close"></div>

                                <a class="brand d-block position-absolute top-50 start-50 translate-middle d-lg-none order-lg-2" href="{{url('')}}">

                                    <img src="{{url('images/logo.svg')}}" alt="Site Logo" width="150" height="56">

                                </a>

                            </div>

                            

                            <ul class="nav-min-menu d-lg-flex justify-content-lg-center z-2 ">

                                <li>

                                    <a href="{{url('')}}">All models</a>

                                </li>

                              

                               

                               

                                <li class="haveChild dropdown">
                                    <a type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" href="#">Locations</a>
                                    <div class="dropdown-menu bg-dark-bg">
                                        <div class="nav-min-menu-children-closer d-flex align-items-center f700 text-small text-primary d-lg-none">
                                            <span class="arrow arrow-left arrow-left-primary me-3"></span>
                                            MAIN MENU
                                        </div>
                                        <ul class="colm-lg-6">

                                        
                                        @php
                                            use App\Models\Location;
                                            $locations = Location::get();
                                         
                                        @endphp
                                        @foreach($locations as $location)
                                            <li>
                                                <a href="{{url('location/' . $location->slug)}}">{{$location->title}}</a>
                                            </li>
                                           
                                           @endforeach
                                           
                                           
                                        </ul>
                                    </div>
                                </li>

                                <li class="haveChild dropdown">

                                    <a type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" href="#">categories</a>

                                    <div class="dropdown-menu bg-dark-bg">

                                        <div class="nav-min-menu-children-closer d-flex align-items-center f700 text-small text-primary d-lg-none">

                                            <span class="arrow arrow-left arrow-left-primary me-3"></span>

                                            MAIN MENU

                                        </div>

                                        <ul class="colm-lg-6">
                                             @php
                                            use App\Models\Category;
                                            $category = Category::get();
                                         
                                        @endphp
                                        @foreach($category as $cat)

                                            <li>

                                                <a href="{{url('category/' . $cat->slug)}}">{{$cat->title}}</a>

                                            </li>

                                           

                                            @endforeach

                                        </ul>

                                    </div>

                                </li>

                             

                        

                                <li>

                                    <a href="{{url('duo-gallery')}}">Duo escorts</a>

                                </li>

                        

                                <li>

                                    <a href="{{url('about-us')}}">About us</a>

                                </li>



                                <li>

                                    <a href="{{url('joinus')}}">Casting</a>

                                </li>



                                <li>

                                    <a href="{{url('bookings')}}">Booking</a>

                                </li>

                        

                                <li>

                                    <a href="{{url('news')}}">Blog</a>

                                </li>



                                <li>

                                    <a href="{{url('rota')}}">Rota</a>

                                </li>

                            </ul>



                            <div class="d-lg-none mt-5  px-4 mb-3">

                                <span class="d-block text-md-small text-light-primary-2 mb-2">Mon-Fri 10am-10pm, Sat-Sun 12pm-12am</span>

                                <a class="text-primary text-hover-white text-md-small d-block mb-2" href="mailto:info@modelsofmayfair.co.uk">info@modelsofmayfair.co.uk</a>

                                <a  class="text-primary text-hover-white text-md-small" href="tel:+441234567890">+44 1234 567890</a>

                            </div>

                            <ul class="d-flex flex-wrap ms-auto nav-social align-items-center d-lg-none px-4 mb-3">

                                <li class="me-2">

                                    <a class="bg-info text-white rounded-circle icon d-flex align-items-center justify-content-center fs-5" href="#"><i class="fa-telegram"></i></a>

                                </li>

                                <li class="me-2">

                                    <a class="bg-success text-white rounded-circle icon d-flex align-items-center justify-content-center fs-5" href="#"><i class="fa-whatsapp"></i></a>

                                </li>                                

                            </ul>



                            <a class="text-uppercase text-primary text-hover-white text-md-small nav-min-fbrt" href="{{url('favourite-gallery')}}">

                                <i class="fa-heart me-2"></i> My favourites

                            </a>

                        </div>

                    </div>                    

                </div>                

            </nav>

            

        </header>

    

    

    

    

    