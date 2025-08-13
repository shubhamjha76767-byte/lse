

@extends('layout.app')

@section('meta_title', $data->seo_title ?? 'About Us - Models of Mayfair')
@section('meta_description', $data->seo_description ?? 'Learn more about Models of Mayfair.')
@section('meta_keywords', $data->seo_keywords ?? 'models, about, fashion')

@section('content')



<div class="container py-lg-5">

    <div class="row">

        <div class="col-lg-5 d-lg-block">

            <img class="w-100 h-auto" src="{{url('storage/' . $data->sub_image_1)}}" width="369" height="267" alt="Blog Image">

            <div class="cms p-5 pb-4">

               {!! $data->sub_content_1 !!}
            </div>

            <img class="w-100 h-auto" src="{{url('storage/' . $data->model_image)}}" width="369" height="267" alt="Blog Image">

        </div>

        <div class="col-lg-7">

            <div class="cms text-lg-start text-center">

                <h1 class="pt-4">{{$data->title}}</h1>

               {!! $data->sub_content_2 !!}
                <div class="row mb-3">

                    <div class="col-12 px-lg-2 px-0 mb-2">

                        <img class="w-100 h-auto" src="{{url('storage/' . $data->sub_image_2)}}" width="369" height="267" alt="Blog Image">

                    </div>

                    <div class="col-6 p-0 pe-1 d-lg-none">

                        <div class="media-holder position-relative">

                            <img class="w-100 h-100" src="./images/about/about1.jpg" width="369" height="267" alt="Blog Image">

                        </div>

                    </div>

                    <div class="col-6 p-0 ps-1 d-lg-none">

                        <div class="media-holder position-relative">

                            <img class="w-100 h-100" src="./images/about/about-2.png" width="369" height="267" alt="Blog Image">

                        </div>

                    </div>

                </div>                

            </div>

            <div class="cms pt-lg-5 pt-4">

                <h2>{{$data->modeltitle}}</h2>

               {!! $data->description !!}
            </div>

        </div>

        

    </div>

</div>

@endsection