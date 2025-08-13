@extends('layout.app')

@section('meta_title', $data->seo_title ?? 'Casting - Models of Mayfair')
@section('meta_description', $data->seo_description ?? 'Learn more about Models of Mayfair.')
@section('meta_keywords', $data->seo_keywords ?? 'models, casting, fashion')

@section('content')

<div class="container pt-4 pb-5">

    <h1 class="text-center mb-4 mb-md-5">Casting</h1>

    <div class="row">

        <div class="col-lg-6 order-lg-2 ps-xl-5">

           <form class="border-md border-dark-primary-2 rounded-5 p-md-4" 
      action="{{ route('application.submit') }}" 
      method="POST" 
      enctype="multipart/form-data">
    @csrf

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <div class="accordion" id="accordionExample">
        <div class="accordion-item border-0 border-bottom border-dark-primary-2 bg-transparent">
            <button class="accordion-button text-small f700 text-primary border-0 bg-transparent shadow-none text-uppercase px-3" 
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" 
                    aria-expanded="true" aria-controls="collapseOne">
                Personal details
            </button>

            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body px-md-3 px-0 mb-4">
                    <div class="form-group mb-3">
                        <input type="text" name="name" placeholder="Your name" required class="form-control bg-transparent border-light-black-4 text-white">
                    </div>

                    <div class="form-group mb-3">
                        <input type="email" name="email" placeholder="Email address" required class="form-control bg-transparent border-light-black-4 text-white">
                    </div>

                    <div class="form-group mb-3">
                        <input type="tel" name="phone" placeholder="Phone number" required class="form-control bg-transparent border-light-black-4 text-white">
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" name="nationality" placeholder="Nationality" class="form-control bg-transparent border-light-black-4 text-white">
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" name="location" placeholder="Location" class="form-control bg-transparent border-light-black-4 text-white">
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" name="languages" placeholder="Languages" class="form-control bg-transparent border-light-black-4 text-white">
                    </div>

                    <div class="form-group mb-3">
                        <textarea name="experience" placeholder="Experience" class="form-control bg-transparent border-light-black-4 text-white"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <textarea name="description" placeholder="Description" class="form-control bg-transparent border-light-black-4 text-white"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item border-0 border-bottom border-dark-primary-2 bg-transparent rounded-0">
            <button class="accordion-button collapsed text-small f700 text-primary border-0 bg-transparent shadow-none text-uppercase" 
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" 
                    aria-expanded="false" aria-controls="collapseTwo">
                Upload photos
            </button>

            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body px-md-3 px-0 mb-4">
            <div class="row">
               
                    <div class="col-xl-6 col-lg-12 col-sm-6 px-2">
                        <div class="form-group mb-3 inputFile">
                            <label class="text-md-small text-300 mb-2 ps-3 text-white">Photo 1</label>
                            <input type="file" name="photo1" required>
                            <label for="file" class="form-control bg-transparent border-light-black-4 text-white">No file chosen</label>
                        </div>
                    </div>

                     <div class="col-xl-6 col-lg-12 col-sm-6 px-2">
                        <div class="form-group mb-3 inputFile">
                            <label class="text-md-small text-300 mb-2 ps-3 text-white">Photo 2</label>
                            <input type="file" name="photo2" >
                            <label for="file" class="form-control bg-transparent border-light-black-4 text-white">No file chosen</label>
                        </div>
                    </div>

                     <div class="col-xl-6 col-lg-12 col-sm-6 px-2">
                        <div class="form-group mb-3 inputFile">
                            <label class="text-md-small text-300 mb-2 ps-3 text-white">Photo 3</label>
                            <input type="file" name="photo3" >
                            <label for="file" class="form-control bg-transparent border-light-black-4 text-white">No file chosen</label>
                        </div>
                    </div>
                <div class="col-xl-6 col-lg-12 col-sm-6 px-2">
                        <div class="form-group mb-3 inputFile">
                            <label class="text-md-small text-300 mb-2 ps-3 text-white">Photo 4</label>
                            <input type="file" name="photo4" >
                            <label for="file" class="form-control bg-transparent border-light-black-4 text-white">No file chosen</label>
                        </div>
                    </div>

            </div>
        </div>
    </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <button class="btn bg-primary-dark text-black f300">Submit Application</button>
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

@endsection