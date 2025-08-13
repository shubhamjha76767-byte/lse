

@extends('layout.app')


@section('content')



<div class="py-md-5 py-4 my-md-0 mt-2 container">

    <div class="col-lg-7 col-md-8 col-sm-10 text-center cms mx-auto">

        <h1>Your favourite models of mayfair</h1>

    </div>

    

</div>



<div class="divider mx-auto border-top border-dark-primary-2"></div>



<div class="container pb-4 pb-md-5 mb-md-3">

   

<!-- Filter Section -->
@php
    $hasSingle = isset($singleProfiles) && count($singleProfiles);
    $hasDuo = isset($duoProfiles) && count($duoProfiles);
@endphp

@if ($hasSingle || $hasDuo)
<!-- Filter Section -->
<div class="row border-md-0 border-bottom border-dark-primary-2 pt-3 pb-md-0 pb-3 mb-md-4 mb-3">
    <div class="d-flex flex-wrap justify-content-between align-items-start">
        <ul class="d-flex favourites-filter">
            @if ($hasSingle && $hasDuo)
                <li data-val="" class="text-md-small f300 all active me-3 trigger-staff">All</li>
            @endif

            @if ($hasSingle)
                <li data-val="gallery-item" class="text-md-small f300 me-3 trigger-staff {{ $hasSingle && !$hasDuo ? 'active' : '' }}">Single</li>
            @endif

            @if ($hasDuo)
                <li data-val="gallery-item-duo" class="text-md-small f300 trigger-staff {{ $hasDuo && !$hasSingle ? 'active' : '' }}">Duo</li>
            @endif
        </ul>

        <button id="clearFavourites" class="btn text-md-small text-primary f700 d-flex align-items-center p-0 bg-transparent text-uppercase border-0 favourites-clear">
            Clear list <span class="btn-close p-0 d-block ms-1"></span>
        </button>
    </div>
</div>
@endif


<!-- Profiles Gallery -->
<div class="row favourites-gallery">
    <!-- Dynamic content rendered by backend (example shown below in Blade syntax) -->

    <!-- Single Profile Example -->
    @foreach ($singleProfiles as $profile)
    <div class="col-md-4 col-lg-3 col-6 mb-4 pb-md-2 px-md-2 px-1 gallery-item">
        <a href="{{ url('profile/' . $profile->slug) }}">
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
            <span class="d-block f300 mb-1"><a class="h3" href="{{ url('profile/' . $profile->slug) }}">{{ $profile->name }}</a></span>
            <span class="d-block text-small text-uppercase text-white lh-1 mb-1 tagline">{{ $profile->tags }}</span>
            <span class="text-small text-white-5 lh-1 text-uppercase d-block location">{{ $profile->main_location }}</span>
            <span class="favourites d-flex justify-content-center align-items-center top-0 end-0 me-md-2 position-absolute">
                <i class="fa-heart-f fs-4 save-favourite active" data-id="{{ $profile->id }}"></i>
                <span class="favourites-message">
                    <span class="text"></span>
                    <span class="favourites-close"></span>
                </span>
            </span>
        </span>
    </div>
    @endforeach

    <!-- Duo Profile Example -->
    @foreach ($duoProfiles as $duo)
   
    @php [$p1, $p2] = $duo; @endphp
    <div class="col-lg-6 gallery-item-duo">
        <div class="row mx-0 position-relative mt-5 mb-4">
            <div class="position-absolute px-0 start-0 bottom-100">
                <div class="px-3 bg-dark-bg position-relative d-inline-block z-2 text-md-small text-uppercase text-primary gallery-duo-title">Exclusive duo</div>
                <div class="w-100 border-top border-light-black-4 position-absolute top-50 start-0 translate-middle-y"></div>
            </div>

            <!-- Profile 1 -->
            <div class="col-6 px-0">
                <a href="{{ url('profile/' . $p1->slug) }}">
                    <span class="media-holder d-block position-relative">
                        <img src="{{ url('storage/' . $p1->thumbnail) }}" alt="{{ $p1->name }}">
                       @if ($p1->status == 1)
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
                    <span class="d-block f300 mb-1"><a class="h3" href="{{ $p1->link }}">{{ $p1->name }}</a></span>
                    <span class="d-block text-small text-uppercase text-white lh-1 mb-1 tagline">{{ $p1->tags }}</span>
                    <span class="text-small text-white-5 lh-1 text-uppercase d-block location">{{ $p1->main_location }}</span>
                </span>
            </div>

            <!-- Profile 2 -->
            <div class="col-6 px-0">
                <a href="{{ url('profile/' . $p2->slug) }}">
                    <span class="media-holder d-block position-relative">
                        <img src="{{ url('storage/' . $p2->thumbnail) }}" alt="{{ $p2->name }}">
                       @if ($p2->status == 1)
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
                    <span class="d-block f300 mb-1"><a class="h3" href="{{ $p2->link }}">{{ $p2->name }}</a></span>
                    <span class="d-block text-small text-uppercase text-white lh-1 mb-1 tagline">{{ $p2->tags }}</span>
                    <span class="text-small text-white-5 lh-1 text-uppercase d-block location">{{ $p2->main_location }}</span>
                </span>
            </div>

            <span class="favourites d-flex justify-content-center align-items-center bottom-0 start-50 translate-middle-x mb-4 position-absolute">
                <i class="fa-heart-f fs-4 save-favourite active" data-id="{{ $p1->id }}-{{ $p2->id }}"></i>
                <span class="favourites-message">
                    <span class="text"></span>
                    <span class="favourites-close"></span>
                </span>
            </span>
        </div>
    </div>
    @endforeach
</div>

</div>



<div class="divider mx-auto border-top border-dark-primary-2 mb-5 d-md-block d-none"></div>



<div class="container pb-md-5 pb-4 pt-md-3">

    <div class="row">

        <div class="col-lg-8 col-md-7 pe-lg-4  pe-xl-5 mx-auto">

            <div class="cms ">

               {!! $data->description !!}
            </div>

        </div>

    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterButtons = document.querySelectorAll('.favourites-filter li');
        const galleryItems = document.querySelectorAll('.favourites-gallery > div');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                const val = button.getAttribute('data-val');

                galleryItems.forEach(item => {
                    if (!val || item.classList.contains(val)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

       
    });
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const clearBtn = document.getElementById('clearFavourites');

    clearBtn.addEventListener('click', function () {
        

        fetch("{{ route('favourites.clear') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Remove all favorite items from DOM
                document.querySelectorAll('.gallery-item, .gallery-item-duo').forEach(el => el.remove());

                // Optionally reset the filter
                document.querySelectorAll('.favourites-filter li').forEach(el => el.classList.remove('active'));
                document.querySelector('.favourites-filter li.all')?.classList.add('active');
            }
        })
        .catch(err => {
            console.error("Clear favourites failed:", err);
        });
    });
});
</script>

@endsection