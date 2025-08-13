@extends('layout.app')

@section('meta_title', $data->seo_title ?? 'Booking - Models of Mayfair')
@section('meta_description', $data->seo_description ?? 'Learn more about Booking Models of Mayfair.')
@section('meta_keywords', $data->seo_keywords ?? 'models, Booking, fashion')

@section('content')



<div class="container pt-4 pb-5">

    <h1 class="text-center mb-4 mb-md-5">Make a booking</h1>

    <div class="row">

        <div class="col-lg-6 order-lg-2 ps-xl-5">
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

            <form class="border-md border-dark-primary-2 rounded-5 p-md-4" method="POST" action="{{ route('booking.submit') }}">
    @csrf

    <div class="accordion" id="accordionExample">

        {{-- Escort Selection --}}
        <div class="accordion-item border-0 border-bottom border-dark-primary-2 bg-transparent">
            <button class="accordion-button text-small f700 text-primary border-0 bg-transparent shadow-none text-uppercase px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Choose your escort
            </button>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body px-md-3 px-0 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="media-holder bookingThumbnail rounded-circle border border-dark-primary-2 me-3">
                            <img id="bookImg" class="w-100 h-100 position-relative rounded-circle" src="{{ url('images/about/about-2.png') }}" width="369" height="267" alt="Profile Image">

                        </div>
                        <div class="form-group flex-grow-1">
                           <select id="bookSlict" class="form-control bg-transparent border-light-black-4 text-white select-img" name="profile_id" required>
                            <option value="">Select an escort</option>
                            @foreach($profiles as $profile)
                               @php
    $thumbnail = $profile->thumbnail ? url('storage/' . $profile->thumbnail) : asset('images/default.jpg');
@endphp
<option 
    data-value="{{ $thumbnail }}" 
    value="{{ $profile->id }}" 
    {{ isset($selectedProfileId) && $selectedProfileId == $profile->id ? 'selected' : '' }}
>
    {{ $profile->name }}
</option>

                            @endforeach
                        </select>

                        </div>
                    </div>  
                </div>
            </div>
        </div>

        {{-- Booking Details --}}
        <div class="accordion-item accordion-item border-0 border-bottom border-dark-primary-2 bg-transparent">
            <button class="accordion-button collapsed text-small f700 text-primary border-0 bg-transparent shadow-none text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Booking details
            </button>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body px-md-3 px-0 mb-4">
                    <div class="form-group mb-3">
                        <input type="text" name="booking_date" placeholder="Booking date" class="form-control date form-control-date bg-transparent border-light-black-4 text-white" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="booking_time" placeholder="Booking Time" class="form-control time form-control-time bg-transparent border-light-black-4 text-white" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="duration" placeholder="Duration" class="form-control bg-transparent border-light-black-4 text-white" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="address" placeholder="Address" class="form-control bg-transparent border-light-black-4 text-white" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="text-white f300 text-md-small ps-3 mb-2">*All services and extras are on lady’s sole discretion</label>
                        <textarea name="notes" class="form-control bg-transparent border-light-black-4 text-white"></textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Contact Details --}}
        <div class="accordion-item accordion-item border-0 border-bottom border-dark-primary-2 bg-transparent rounded-0">
            <button class="accordion-button collapsed text-small f700 text-primary border-0 bg-transparent shadow-none text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Contact details
            </button>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body px-md-3 px-0 mb-4">
                    <div class="form-group mb-3">
                        <input type="text" name="full_name" placeholder="Full name" class="form-control bg-transparent border-light-black-4 text-white" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="tel" name="contact_number" placeholder="Contact number" class="form-control bg-transparent border-light-black-4 text-white" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" name="contact_email" placeholder="Contact email" class="form-control bg-transparent border-light-black-4 text-white" required>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Submit --}}
    <div class="text-center mt-4">
        <button class="btn bg-primary-dark text-black f300">Submit Request</button>
    </div>

</form>




        </div>

        <div class="col-lg-6 order-lg-1 pt-lg-0 pt-5 pe-xl-5">

            <div class="cms ">

               {!! $data->description !!}
            </div>

        </div>        

    </div>    

</div>


{{-- Escort Image Update Script --}}


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('bookSlict');
        const img = document.getElementById('bookImg');

        // Function to set image
        function updateImage() {
            const selected = select.options[select.selectedIndex];
            const imageUrl = selected.getAttribute('data-value');
            if (imageUrl) {
                img.setAttribute('src', imageUrl);
            }
        }

        // Update on change
        select.addEventListener('change', updateImage);

        // Trigger on page load if a profile is pre-selected
        updateImage();
    });
</script>

@endsection