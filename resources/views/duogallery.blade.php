

@extends('layout.app')
@section('meta_title', $data->seo_title ?? 'Duo - Models of Mayfair')
@section('meta_description', $data->seo_description ?? 'Learn more about Duo Models of Mayfair.')
@section('meta_keywords', $data->seo_keywords ?? 'models, duo, fashion')


@section('content')

<style>
    .save-favourite.active {
    color: #dbc8a8;
}

    </style>

<div class="py-md-5 py-4 my-md-0 mt-2 container">

    <div class="col-lg-7 col-md-8 col-sm-10 text-center cms mx-auto">

        <h1>Duo escorts</h1>

        {{$data->short_description}}
    </div>

</div>



<div class="divider mx-auto border-top border-dark-primary-2"></div>



<div class="container pb-4 pb-md-5 mb-md-3">

    

   
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
@foreach($duoProfiles as $duo)
    @php
        $a = $duo['a'];
        $b = $duo['b'];
    @endphp
   
     @if($duo['a'] && $duo['b'])
    <div class="col-lg-6 gallery-item-duo">
        <div class="row mx-0 position-relative mt-5 mb-4">
            <div class="position-absolute px-0 start-0 bottom-100">
                <div class="px-3 bg-dark-bg position-relative d-inline-block z-2 text-md-small text-uppercase text-primary gallery-duo-title">Exclusive duo</div>
                <div class="w-100 border-top border-light-black-4 position-absolute top-50 start-0 translate-middle-y"></div>
            </div>

            <div class="col-6 px-0">
                <a href="{{ url('profile', $a->slug) }}">
                    <span class="media-holder d-block position-relative">
                        <img src="{{ url('storage/' . $a->thumbnail) }}" alt="{{ $a->name }}">
                       @if ($a->status == 1)
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
                <span class="d-block text-center mt-3 position-relative">
                    <span class="d-block f300 mb-1"><a class="h3" href="#">{{ $a->name }}</a></span>
                    <span class="d-block text-small text-uppercase text-white lh-1 mb-1 tagline">{{ $a->tags }}</span>
                    <span class="text-small text-white-5 lh-1 text-uppercase d-block location">{{ $a->main_location }}</span>
                </span>
            </div>

            <div class="col-6 px-0">
                <a href="{{ url('profile', $b->slug) }}">
                    <span class="media-holder d-block position-relative">
                        <img src="{{ url('storage/' . $b->thumbnail) }}" alt="{{ $b->name }}">
                        @if ($b->status == 1)
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
                <span class="d-block text-center mt-3 position-relative">
                    <span class="d-block f300 mb-1"><a class="h3" href="#">{{ $b->name }}</a></span>
                    <span class="d-block text-small text-uppercase text-white lh-1 mb-1 tagline">{{ $b->tags }}</span>
                    <span class="text-small text-white-5 lh-1 text-uppercase d-block location">{{ $b->main_location }}</span>
                </span>
            </div>

           @php
    $duoKey = $a->id . '-' . $b->id;
    $duoFavKey = 'favourites_duo_' . request()->ip();
    $duoFavourites = Cache::get($duoFavKey, []);
@endphp

<span class="favourites d-flex justify-content-center align-items-center bottom-0 start-50 translate-middle-x mb-4 position-absolute">                            
    <i class="fa-heart-f fs-4 save-duo-favourite {{ in_array($duoKey, $duoFavourites) ? 'active' : '' }}" data-duo-key="{{ $duoKey }}"></i>
    <span class="favourites-message">
        <span class="text"></span>
        <span class="favourites-close"></span>
    </span>
</span>

        </div>
    </div>
    @endif
@endforeach
</div>


</div>




<div class="divider mx-auto border-top border-dark-primary-2 mb-5 d-md-block d-none"></div>



<div class="container pb-md-5 pb-4 pt-md-3">

    <div class="row">

        <div class="col-lg-8 col-md-7 pe-lg-4  pe-xl-5 mx-auto">

            <div class="cms">

               {!! $data->description !!}


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
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.save-duo-favourite').forEach(icon => {
        icon.addEventListener('click', function () {
            const duoKey = this.dataset.duoKey;
            const el = this;

            fetch("{{ url('/toggle-duo-favourite') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": '{{ csrf_token() }}',
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ duo_key: duoKey })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'added') {
                    el.classList.add('active');
                } else {
                    el.classList.remove('active');
                }
            });
        });
    });
});
</script>



@endsection