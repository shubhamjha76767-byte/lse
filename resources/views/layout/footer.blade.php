
           @php
           $data= App\Models\Seting::first();
           @endphp
        <footer class="footer pt-5">

            <div class="container mb-md-5 mb-4 position-relative">

                <div class="row me-xl-0 position-relative footerRow">

                    <!-- <div class="col-lg-4 pe-xl-5 pe-lg-4 mb-lg-0 pb-lg-0 mb-4 pb-3">

                        <div class="h4 mb-2">JOIN THE VIP LIST</div>

                        <div class="form-group">

                            <input type="email" class="form-control border-0 rounded-0 border-bottom bg-transparent border-light-black-3 text-white shadow-none fs-6" placeholder="Enter your email">

                        </div>

                        <div class="text-small text-white p-1 pb-3">You can unsubscribe from our emails at any time. By proceeding you agree to our email terms and conditions and privacy policy. </div>

                        <button class="btn bg-primary-dark bg-hover-primary rounded-3 w-100 text-center f400 text-black">Subcribe to newsletter</button>

                    </div> -->

                    <div class="follow mb-lg-0 pb-lg-0 mb-4 pb-3">

                        <div class="h4">follow us</div>

                        <div class="d-flex">

                            <a target="_black" href="{{$data->facebook}}" class="text-light-black-3 rounded-circle d-flex align-items-center batch-social fs-4 me-2">

                                <i class="fa-facebook"></i>

                            </a>

                            <a target="_black" href="{{$data->tweeter}}" class="text-light-black-3 rounded-circle d-flex align-items-center batch-social fs-4 me-2">

                                <i class="fa-twitter"></i>

                            </a>

                            <a target="_black" href="{{$data->insta}}" class="text-light-black-3 rounded-circle d-flex align-items-center batch-social fs-4">

                                <i class="fa-instagram"></i>

                            </a>

                        </div>

                    </div>

                    <div class="col-lg-4  ps-xl-5 ps-lg-4 pe-lg-4 position-relative accordion-custome">

                        <input class="d-lg-none position-absolute w-100 h-100 accordion-custome-target opacity-0 start-0 top-0" type="checkbox" name="Explore">

                        <div class="h4 pb-3 mb-3 border-bottom border-dark-primary-2 accordion-custome-button">Explore</div>

                        <ul class="accordion-custome-body">

      
                        @foreach($data->explore as $val)
                            <li class="mb-1">
                               
                                <a class="text-primary text-uppercase text-md-small text-hover-white f400" href="{{$val['link']}}">{{$val['name']}}</a>

                            </li>
                           @endforeach
                           
                           

                        </ul>

                    </div>

                    <div class="col-lg-4 ps-lg-4 position-relative accordion-custome">

                        <input class="d-lg-none position-absolute w-100 h-100 accordion-custome-target opacity-0 start-0 top-0" type="checkbox" name="Contact">

                        <div class="h4 pb-3 mb-3 border-bottom border-lg-down-0 border-dark-primary-2 accordion-custome-button">Contact info</div>

                        <div class="accordion-custome-body">

                            <div class="text-white text-md-small mb-2">{{$data->time}}</div>

                            <a class="text-primary text-hover-white text-md-small d-block mb-2" href="mailto:{{$data->email}}">{{$data->email}}</a>

                            <a class="text-primary text-hover-white text-md-small d-block" href="tel:{{$data->contact}}">{{$data->contact}}</a>

                            <div class="d-flex pt-3">
                                  @php
                                    $telegramLink = 'https://t.me/' . ltrim($data->telegram, '@');
                                @endphp
                                <a target="_black" href="{{ $telegramLink }}" class="text-white rounded-circle d-flex justify-content-center align-items-center batch-social telegram me-3">

                                    <i class="fa-telegram me-1"></i>

                                </a>
                                @php
                                    $cleanNumber = str_replace(' ', '', $data->whatsapp);
                                @endphp
                                <a target="_black" href="https://wa.me/{{ $cleanNumber }}" class="text-white rounded-circle d-flex justify-content-center align-items-center batch-social whatsapp me-3">

                                    <i class="fa-whatsapp"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="row mt-lg-4 pt-3 mt-2 pb-lg-4">

                    <div class="col-12 text-center">

                        <a class="brand mx-auto mb-4" href="./">

                            <img src="{{url('storage/' . $data->logo)}}" alt="Site Logo" width="150" height="56">

                        </a>

                        <div class="">

                            <span class="d-block text-light-black-4">&copy; Models of Mayfair <?=date('Y');?>. </span>

                            <span class="d-block text-light-black-4">Design and Development by <a target="_blank" class="text-light-black-4 text-hover-primary" style="color:#dbc8a8 !important;" href="https://www.wave69.co.uk/">wave69</a></span>

                        </div>

                    </div>

                </div>

                <ol class="breadcrumb mb-0 mb-md-4 me-lg-3 pt-lg-0 pt-3 justify-content-center">

                    <li class="breadcrumb-item"><a class="text-primary text-hover-white text-small f400" href="{{url('terms-conditions')}}">Terms & Conditions</a></li>

                    <li class="breadcrumb-item"><a class="text-primary text-hover-white text-small f400" href="{{url('privacy')}}">Privacy Policy</a></li>

                </ol>

            </div>

           

        </footer>



       




