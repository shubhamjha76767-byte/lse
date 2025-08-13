

@extends('layout.app')


@section('meta_title', $category->html_title ?? 'Category - Models of Mayfair')
@section('meta_description', $category->meta_description ?? 'Learn more category Models of Mayfair.')
@section('meta_keywords', $category->meta_keywords ?? 'models, category, fashion')

@section('content')



<div class="py-md-5 py-4 my-md-0 mt-2 container">

    <div class="col-lg-7 col-md-8 col-sm-10 text-center cms mx-auto">

        <h1>{{ $category->title }}</h1>

       {!! $category->body !!}
    </div>

</div>



<div class="divider mx-auto border-top border-dark-primary-2"></div>



<div class="container pb-4">

   
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
        

<div class="row">

   <div class="row">
        @forelse($data as $profile)
            <div class="col-md-4 col-lg-3 col-6 mb-4 pb-md-2 px-md-2 px-1 gallery-item">
                <a href="{{ url('profile', $profile->slug ?? $profile->id) }}">
                    <span class="media-holder d-block position-relative">
                        <img src="{{ url('storage/' . $profile->thumbnail) }}" alt="{{ $profile->name }}">
                       @if ($profile->status == 1)
                <span class="position-absolute top-0 start-0 mt-1 batch-abailable">
                    <img src="{{url('images/available.svg')}}" width="72" height="32" loading="lazy" alt="Available">
                </span>
                @else
                <span class="position-absolute top-0 start-0 batch-notAbailable w-100 d-flex justify-content-center">
                            <img src="{{url('images/not-available.svg')}}" width="144" height="14" loading="lazy" alt="Not Available">
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

        <div class="col-lg-8 col-md-7 pe-lg-4  pe-xl-5 mx-auto">

            <div class="cms">

                {!! $category->body_2 !!}


            </div>

        </div>

    </div>

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