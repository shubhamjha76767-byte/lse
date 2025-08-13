@extends('layout.app')
@section('meta_title', $data->seo_title ?? 'About Us - Models of Mayfair')
@section('meta_description', $data->seo_description ?? 'Learn more about Models of Mayfair.')
@section('meta_keywords', $data->seo_keywords ?? 'models, about, fashion')
@section('content')

<div class="container-fluid px-md-2 px-1 mb-5">
    <div class="banner banner-home position-relative">
        <picture class="media-holder hero hero-main media-holder-overlay media-holder-overlay position-absolute w-100 h-100 start-0">
            <source media="(min-width: 768px)" srcset="{{ url('/storage/' . $data->banner) }}">
            <img src="{{ url('/storage/' . $data->banner) }}" alt="Banner Image">
        </picture>
        <div class="text-center pt-5 position-relative z-2">
            <div class="container pt-5">
                <div class="row pt-5">
                    <div class="col-lg-8 col-md-10 mx-auto mt-5 pt-lg-4">
                        <h1>{{ $data->title }}</h1>
                        <div class="cms px-xl-4">
                            {!! $data->content !!}
                        </div>
                    </div>
                </div>            
            </div>
        </div> 
    </div>
</div>

<div class="divider mx-auto border-top border-dark-primary-2"></div>

<div class="container pb-4">
    <!-- profile filter -->
   <!-- profile filter -->
<div class="row pt-md-3 pb-md-3 mb-3 border-md-0 border-bottom border-dark-primary-2">
    <div class="col-6 border-md-0 border-end border-dark-primary-2 px-md-3 px-4">
        <div class="dropdown">
            <button class="btn border-0 text-primary text-uppercase text-small px-0 d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                Refine by <i class="fa-equalizer fs-5 ms-3"></i>
            </button>
            <div class="dropdown-menu bg-dark-bg rounded-0 border-dark-primary-2">
                <ul class="dropdown-list">
                    <li><button class="dropdown-item filter-button" data-sort="name_asc">Name A to Z</button></li>
                    <li><button class="dropdown-item filter-button" data-sort="name_desc">Name Z to A</button></li>
                    <li><button class="dropdown-item filter-button" data-sort="price_low_high">Price low to high</button></li>
                    <li><button class="dropdown-item filter-button" data-sort="price_high_low">Price high to low</button></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-6 d-md-flex justify-content-md-end px-md-3 px-4">
        <div class="dropdown">
            <button class="btn border-0 text-primary text-uppercase text-small px-0 d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                Show All <span class="arrow-bottom arrow-bottom-xl arrow-bottom-primary ms-3 mb-2"></span>
            </button>
            <div class="dropdown-menu bg-dark-bg rounded-0 border-dark-primary-2">
                <ul class="dropdown-list">
                    <li><button class="dropdown-item availability-button" data-availability="1">Available</button></li>
                    <li><button class="dropdown-item availability-button" data-availability="0">Not Available</button></li>
                </ul>
            </div>
        </div>
    </div>
</div>


    <!-- profile list -->
    <div class="row">
        @forelse($profiles as $profile)
            <div class="col-md-4 col-lg-3 col-6 mb-4 pb-md-2 px-md-2 px-1 gallery-item">
                <a href="{{ url('profile', $profile->slug ?? $profile->id) }}">
                    <span class="media-holder d-block position-relative">
                        <img src="{{ url('storage/' . $profile->thumbnail) }}" alt="{{ $profile->name }}">
                       @if ($profile->status == 1)
                <span class="position-absolute top-0 start-0 mt-1 batch-abailable">
                    <img src="./images/available.svg" width="72" height="32" loading="lazy" alt="Available">
                </span>
                @else
                <span class="position-absolute top-0 start-0 batch-notAbailable w-100 d-flex justify-content-center">
                            <img src="./images/not-available.svg" width="144" height="14" loading="lazy" alt="Not Available">
                        </span>
                @endif
                    </span>
                </a>
                <span class="d-block text-center mt-3 position-relative px-md-5 px-4">
                    <span class="d-block f300 mb-1"><a class="h3" href="#">{{ $profile->name }}</a></span>
                    <span class="d-block text-small text-uppercase text-white lh-1 mb-1 tagline">{{ $profile->tags }}</span>
                    <span class="text-small text-white-5 lh-1 text-uppercase d-block location">{{ $profile->main_location }}</span>
                    
                   @php
    $favKey = 'favourites_' . request()->ip();
    $favourites = Cache::get($favKey, []);
@endphp

<span class="favourites d-flex justify-content-center align-items-center top-0 end-0 me-md-2 position-absolute">
    <i class="fa-heart-f fs-4 save-favourite {{ in_array($profile->id, $favourites) ? 'active' : '' }}" 
       data-id="{{ $profile->id }}" 
       role="button">
    </i>
</span>


                </span>
            </div>
        @empty
            <div class="col-12 text-center text-white">No profiles found.</div>
        @endforelse
    </div>
</div>

<div class="divider mx-auto border-top border-dark-primary-2 mb-5 d-md-block d-none"></div>

<div class="container pb-md-5 pb-4">
    <div class="row">
        <div class="col-lg-8 col-md-7 pe-lg-4 pe-xl-5">
            <div class="cms">
                {!! $data->description !!}
            </div>
        </div>
        <!-- blog here -->
        <div class="col-lg-4 col-md-5 ps-xl-5 pt-md-0 pt-4">
            <div class="h2 mb-3">latest blog posts</div>
            @foreach ($blogs as $blog)
              
                <div class="d-flex position-relative align-items-center mb-2 pb-1">
                    <a href="{{url('news/' . $blog->slug)}}" class="media-holder blogThumb flex-shrink-0 me-3 position-relative">
                        <img src="{{ url('storage/' . $blog->icon) }}" width="122" height="122" loading="lazy" alt="Blog Image">
                    </a>
                    <div>
                        <span class="d-block f300 text-md-small text-light-primary-1 text-uppercase mb-1">{{ \Carbon\Carbon::parse($blog->publish_at)->format('d M / Y') }}
</span>
                        <a class="h4 f300 text-primary text-hover-white" href="{{url('news/' . $blog->slug)}}">{{ $blog->title }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>




   <!-- footer partner -->

                <div class="footer-banner p-3 d-flex flex-wrap mt-4 bg-dark-bg justify-content-center align-items-center">
                 
                {!! $data->partner !!}

               </div>





<script>
    function encodeParams(params) {
        const queryString = new URLSearchParams(params).toString();
        return btoa(queryString); // base64 encoding for simple obfuscation
    }

    document.addEventListener('DOMContentLoaded', function () {
        let selectedSort = null;
        let selectedAvailability = null;

        document.querySelectorAll('.filter-button').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                selectedSort = this.getAttribute('data-sort');
                redirectWithEncryptedParams();
            });
        });

        document.querySelectorAll('.availability-button').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                selectedAvailability = this.getAttribute('data-availability');
                redirectWithEncryptedParams();
            });
        });

        function redirectWithEncryptedParams() {
            const params = {};
            if (selectedSort) params.sort = selectedSort;
            if (selectedAvailability) params.availability = selectedAvailability;

            const encrypted = encodeParams(params);
            window.location.href = `?q=${encrypted}`;
        }
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
