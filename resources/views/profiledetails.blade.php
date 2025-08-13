@extends('layout.app')


@section('meta_title', $profile->meta_title ?? 'Profile - Models of Mayfair')
@section('meta_description', $profile->meta_discription ?? 'Learn more Profile Models of Mayfair.')
@section('meta_keywords', $profile->meta_keyword ?? 'models, Profile, fashion')

@section('content')

<style>
    .gallery-single .splide__pagination{
        display: none;
    }
</style>

<div class="gallery-single pt-lg-3 pt-1 pb-5">

    <div class="d-flex flex-wrap">

        <div class="gallery-single-start pe-xl-4 pe-lg-3">

            <div class="h1 d-lg-none mb-4 text-center">{{$profile->name}}</div>

            <div class="gallery-single-slider-wrap position-relative">

                <div class="splide splide-arrow gallery-single-slider position-absolute top-0 start-0 w-100">

                    <span class="favourites d-flex justify-content-center align-items-center top-0 end-0 me-3 mt-3 position-absolute bg-white rounded-circle z-2">                            

                           @php
    $favKey = 'favourites_' . request()->ip();
    $favourites = Cache::get($favKey, []);
@endphp
 <i class="fa-heart-f fs-4 save-favourite {{ in_array($profile->id, $favourites) ? 'active' : '' }}" 
       data-id="{{ $profile->id }}" 
       role="button">
    </i>

                        <span class="favourites-message">

                            <span class="text"></span>

                            <span class="favourites-close"></span>

                        </span>

                    </span>

                    <div class="splide__track">

                        <div class="splide__list">

                               @foreach($profile->gallery_images ?? []  as $img)
                            <div class="splide__slide">

                                <a class="media-holder single-profile d-block" data-fancybox="gallery"  data-caption="" href="{{url('storage/' . $img)}}">

                                    <img src="{{url('storage/' . $img)}}" alt="">

                                </a>

                            </div>
                               @endforeach
                           

                        </div>

                    </div>

                </div>

            </div>

           <div class="gallery-single-about ms-auto ps-lg-3 pe-lg-0 p-3 pt-4 mt-2 cms">
    {{-- Full CKEditor HTML --}}
    <div id="fullDescription">
        {!! $profile->description !!}
    </div>

    {{-- Truncated preview --}}
    <div id="shortDescription"></div>

    {{-- Toggle button --}}
    <button id="toggleDescBtn" class="btn btn-readmore text-underline p-0 text-uppercase text-primary border-0 text-small">
        Read more
    </button>
</div>

        </div>

        <div class="gallery-single-end me-xl-auto ps-lg-4">

            <h1 class="h1 d-lg-block d-none ps-2 mb-3">{{$profile->name}}</h1>

            <div class="px-3 border-bottom border-dark-primary-2 pt-lg-0 py-3 mb-lg-4">

                <div class="d-block text-small text-uppercase text-white lh-1 mb-1 tagline">{{$profile->tags}}</div>

                <div class="text-small text-white-5 lh-1 text-uppercase d-block location">{{$profile->main_location}}</div>

            </div>

           <div class="px-3 pt-2 border-bottom border-dark-primary-2 pb-4">

    <div class="d-flex mb-3">
        <div class="col-xl-7 col-lg-6 col-sm-7 col-6 pe-3">
            <div class="text-small f400 text-primary text-uppercase lh-1">Hair</div>
            <div class="text-white text-md-small 300">{{ $profile->hair }}</div>
        </div>
        <div class="col-xl-5 col-lg-6 col-sm-5 col-6 ps-3">
            <div class="text-small f400 text-primary text-uppercase lh-1">Eyes</div>
            <div class="text-white text-md-small 300">{{ $profile->eyes }}</div>
        </div>
    </div>

    <div class="d-flex mb-3">
        <div class="col-xl-7 col-lg-6 col-sm-7 col-6 pe-3">
            <div class="text-small f400 text-primary text-uppercase lh-1">Nationality</div>
            <div class="text-white text-md-small 300">{{ $profile->nationality }}</div>
        </div>
        <div class="col-xl-5 col-lg-6 col-sm-5 col-6 ps-3">
            <div class="text-small f400 text-primary text-uppercase lh-1">Location</div>
            <div class="text-white text-md-small 300">{{ $profile->main_location }}</div>
        </div>
    </div>

    <div class="d-flex mb-3">
        <div class="col-xl-7 col-lg-6 col-sm-7 col-6 pe-3">
            <div class="text-small f400 text-primary text-uppercase lh-1">Bust</div>
            <div class="text-white text-md-small 300">{{ $profile->bust }}</div>
        </div>
        <div class="col-xl-5 col-lg-6 col-sm-5 col-6 ps-3">
            <div class="text-small f400 text-primary text-uppercase lh-1">Dress</div>
            <div class="text-white text-md-small 300">{{ $profile->dress }}</div>
        </div>
    </div>

    <div class="d-flex mb-3">
        <div class="col-xl-7 col-lg-6 col-sm-7 col-6 pe-3">
            <div class="text-small f400 text-primary text-uppercase lh-1">Orientation</div>
            <div class="text-white text-md-small 300">{{ $profile->orientation }}</div>
        </div>
        <div class="col-xl-5 col-lg-6 col-sm-5 col-6 ps-3">
            <div class="text-small f400 text-primary text-uppercase lh-1">Languages</div>
            @foreach($profile->languages as $lang)
                <div class="text-white text-md-small 300">{{ $lang }}</div>
            @endforeach
        </div>
    </div>

    <div class="d-flex mb-3">
        <div class="col-xl-7 col-lg-6 col-sm-7 col-6 pe-3">
            <div class="text-small f400 text-primary text-uppercase lh-1">Age</div>
            <div class="text-white text-md-small 300">{{ $profile->age }}</div>
        </div>
        <div class="col-xl-5 col-lg-6 col-sm-5 col-6 ps-3">
            <div class="text-small f400 text-primary text-uppercase lh-1">Height</div>
            <div class="text-white text-md-small 300">{{ $profile->height }} CM</div>
        </div>
    </div>

</div>


            <div class="accordion" id="accordionExample">

               

                <div class="accordion-item border-0 border-bottom border-dark-primary-2 bg-transparent">

                    <button class="accordion-button text-small f700 text-primary border-0 bg-transparent shadow-none text-uppercase px-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                        Meeting rates

                    </button>

                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body px-3 mb-4">

                            {{-- Header --}}
                            <div class="d-flex mb-3 pb-1">
                                <div class="col-4 col-xl-6"></div>
                                <div class="col-4 col-xl-3 text-small f400 text-primary text-uppercase">INCALL</div>
                                <div class="col-4 col-xl-3 text-small f400 text-primary text-uppercase">OUTCALL</div>
                            </div>

                            {{-- HALF HOUR --}}
                            <div class="d-flex mb-2">
                                <div class="col-4 col-xl-6 text-small f400 text-primary text-uppercase">HALF HOUR</div>
                                <div class="col-4 col-xl-3 text-small f300 text-white">
                                    {{ $profile->incall_half_hour ?? '-' }}
                                </div>
                                <div class="col-4 col-xl-3 text-small f300 text-white">
                                    {{ $profile->outcall_half_hour ?? '-' }}
                                </div>
                            </div>

                            {{-- 1 HOUR --}}
                            <div class="d-flex mb-2">
                                <div class="col-4 col-xl-6 text-small f400 text-primary text-uppercase">1 HOUR</div>
                                <div class="col-4 col-xl-3 text-small f300 text-white">
                                    {{ $profile->incall_1_hour ?? '-' }}
                                </div>
                                <div class="col-4 col-xl-3 text-small f300 text-white">
                                    {{ $profile->outcall_1_hour ?? '-' }}
                                </div>
                            </div>

                            {{-- 2 HOURS --}}
                            <div class="d-flex mb-2">
                                <div class="col-4 col-xl-6 text-small f400 text-primary text-uppercase">2 HOURS</div>
                                <div class="col-4 col-xl-3 text-small f300 text-white">
                                    {{ $profile->incall_2_hour ?? '-' }}
                                </div>
                                <div class="col-4 col-xl-3 text-small f300 text-white">
                                    {{ $profile->outcall_2_hour ?? '-' }}
                                </div>
                            </div>

                            {{-- 3 HOURS --}}
                            <div class="d-flex mb-2">
                                <div class="col-4 col-xl-6 text-small f400 text-primary text-uppercase">3 HOURS</div>
                                <div class="col-4 col-xl-3 text-small f300 text-white">
                                    {{ $profile->incall_3_hour ?? '-' }}
                                </div>
                                <div class="col-4 col-xl-3 text-small f300 text-white">
                                    {{ $profile->outcall_3_hour ?? '-' }}
                                </div>
                            </div>

                            {{-- DINNER DATE --}}
                            <div class="d-flex mb-2">
                                <div class="col-4 col-xl-6 text-small f400 text-primary text-uppercase">DINNER DATE</div>
                                <div class="col-4 col-xl-3 text-small f300 text-white">
                                    {{ $profile->incall_3_hour_dinner_date ?? '-' }}
                                </div>
                                <div class="col-4 col-xl-3 text-small f300 text-white">
                                    {{ $profile->outcall_3_hour_dinner_date ?? '-' }}
                                </div>
                            </div>

                            {{-- OVERNIGHT (9H) --}}
                            <div class="d-flex mb-2">
                                <div class="col-4 col-xl-6 text-small f400 text-primary text-uppercase">OVERNIGHT (9H)</div>
                                <div class="col-4 col-xl-3 text-small f300 text-white">
                                    {{ $profile->incall_overnight_9h ?? '-' }}
                                </div>
                                <div class="col-4 col-xl-3 text-small f300 text-white">
                                    {{ $profile->outcall_overnight_9h ?? '-' }}
                                </div>
                            </div>

                            {{-- OVERNIGHT (12H) --}}
                            <div class="d-flex mb-2">
                                <div class="col-4 col-xl-6 text-small f400 text-primary text-uppercase">OVERNIGHT (12H)</div>
                                <div class="col-4 col-xl-3 text-small f300 text-white">
                                    {{ $profile->incall_overnight_12h ?? '-' }}
                                </div>
                                <div class="col-4 col-xl-3 text-small f300 text-white">
                                    {{ $profile->outcall_overnight_12h ?? '-' }}
                                </div>
                            </div>

                        </div>
                    </div>


                </div>

                <div class="accordion-item accordion-item border-0 border-bottom border-dark-primary-2 bg-transparent">

                    <button class="accordion-button collapsed text-small f700 text-primary border-0 bg-transparent shadow-none text-uppercase  px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">

                        Categories

                    </button>

                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">

                        <div class="accordion-body  px-3 px-0 mb-4">

                            <ul class="d-flex flex-wrap">
                                  

                                 @foreach($profile->categories as $category)
                                        <li class="me-2 mb-2">
                                            <a class="btn text-small text-primary border-primary rounded-pill bg-hover-primary-dark text-hover-black border-hover-primary-dark py-2 px-3" href="{{ url('category/' . $category->slug) }}">
                                                {{ $category->title }}
                                            </a>
                                        </li>
                                    @endforeach

                               

                            </ul>

                        </div>

                    </div>

                </div>

                <div class="accordion-item accordion-item border-0 border-bottom border-dark-primary-2 bg-transparent">

    <button class="accordion-button collapsed text-small f700 text-primary border-0 bg-transparent shadow-none text-uppercase px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLocations" aria-expanded="false" aria-controls="collapseLocations">
        Locations
    </button>

    <div id="collapseLocations" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body px-3 px-0 mb-4">
            <ul class="d-flex flex-wrap">
                @foreach($profile->locations as $location)
                    <li class="me-2 mb-2">
                        <a class="btn text-small text-primary border-primary rounded-pill bg-hover-primary-dark text-hover-black border-hover-primary-dark py-2 px-3" href="{{ url('location/' . $location->slug) }}">
                            {{ $location->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>


               <div class="accordion-item accordion-item border-0 border-bottom border-dark-primary-2 bg-transparent rounded-0">
    <button class="accordion-button collapsed text-small f700 text-primary border-0 bg-transparent shadow-none text-uppercase px-3"
        type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        My Rota
    </button>

    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body px-3 mb-4">

            <div class="text-primary text-md-small f300 mb-3">
                {{ now()->format('d') }}–{{ now()->addDays(6)->format('d F') }}
            </div>

            <div class="rota">
                @foreach($sevenDayRota as $day)
                    <div class="d-flex py-3 {{ !$loop->last ? 'border-bottom' : '' }} border-dark-primary-2 flex-grow rota-row">
                        <div class="text-center px-3">
                            <span class="d-block text-small text-uppercase f700 lh-1 text-primary rota-day">{{ $day['day'] }}</span>
                            <span class="fs-5 text-primary">{{ $day['date'] }}</span>
                        </div>

                        @if(!$day['available'])
                            <div class="rounded-2 w-100 notavailable rota-tags align-self-center">
                                <div class="border border-3 border-primary-alt border-top-0 border-bottom-0 border-end-0 ps-3">
                                    <span class="d-block lh-base text-light-primary-1 text-md-small">Not available</span>
                                </div>
                            </div>
                        @else
                            <div class="rounded-2 w-100 rota-tags align-self-center">
                                <div class="border border-3 border-success border-top-0 border-bottom-0 border-end-0 ps-3">
                                    <button class="d-block btn btn-collapse p-0 text-light-primary-1 text-hover-light-primary-1 border-0 text-md-small lh-base f300 w-100 pe-4 text-start collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#{{ $day['collapseId'] }}"
                                        aria-expanded="false"
                                        aria-controls="{{ $day['collapseId'] }}">
                                        Available
                                    </button>

                                   
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>


            </div>



            <div class="px-3 d-flex py-3">

                <div class="text-start">

                                <span class="d-block lh-1 text-small text-uppercase text-primary">
                    @if($profile->status == 1 && !empty($sevenDayRota[0]['available']) && $sevenDayRota[0]['available'])
                        Available today
                    @else
                        Not available today
                    @endif
                </span>


                    <span class="text-light-black-3 text-small">

                        <span class="text-primary f700">£{{$profile->starting_rate}}</span> /1 hour

                    </span>

                </div>

                  @php
           $dataseting= App\Models\Seting::first();
           @endphp

                <div class="d-flex ms-auto ps-3  align-items-center">

                    <a target="_black" href="{{$dataseting->telegram ?? ''}}" class="text-white rounded-circle d-flex justify-content-center align-items-center batch-social telegram me-2">

                        <i class="fa-telegram me-1"></i>

                    </a>

                     <a target="_blank" 
                    href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $dataseting->whatsapp ?? '') }}" 
                    class="text-white rounded-circle d-flex justify-content-center align-items-center batch-social whatsapp me-2">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>


                   @php
    use Illuminate\Support\Facades\Crypt;
@endphp

<a class="btn text-md-small f400 text-black bg-primary-dark bg-hover-primary py-2 px-3 rounded-2" 
   href="{{ url('bookings?profile=' . Crypt::encryptString($profile->id)) }}">
   Book now
</a>

                </div>

            </div>



           

        </div>

    </div>

</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const fullDescHTML = document.getElementById("fullDescription").innerHTML;
    const shortDescContainer = document.getElementById("shortDescription");
    const toggleBtn = document.getElementById("toggleDescBtn");

    const maxLength = 300; // characters
    let isExpanded = false;

    // Create short HTML version
    const tempDiv = document.createElement("div");
    tempDiv.innerHTML = fullDescHTML;
    const plainText = tempDiv.innerText || tempDiv.textContent;

    let shortText = plainText.length > maxLength
        ? plainText.substring(0, maxLength).trim() + "..."
        : plainText;

    shortText = `<p>${shortText}</p>`; // keep it HTML wrapped

    // Initial short view
    shortDescContainer.innerHTML = shortText;

    // Toggle behavior
    toggleBtn.addEventListener("click", function () {
        if (!isExpanded) {
            shortDescContainer.innerHTML = fullDescHTML;
            toggleBtn.textContent = "Read less";
        } else {
            shortDescContainer.innerHTML = shortText;
            toggleBtn.textContent = "Read more";
        }
        isExpanded = !isExpanded;
    });
});
</script>

<script>
    const baseUrl = "{{ url('/') }}";

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.save-favourite').forEach(el => {
            el.addEventListener('click', function () {
                const profileId = this.getAttribute('data-id');
                fetch(`${baseUrl}/toggle-favourite`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: profileId }) // Note: expects `id` not `profile_id` as per your original controller
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'added') {
                        this.classList.add('active');
                    } else if (data.status === 'removed') {
                        this.classList.remove('active');
                    }
                });
            });
        });
    });
</script>

@endsection