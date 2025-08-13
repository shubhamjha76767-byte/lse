

@extends('layout.app')

@section('meta_title', $data->html_title ?? 'Blog - Models of Mayfair')
@section('meta_description', $data->meta_description ?? 'Learn more about Models of Mayfair.')
@section('meta_keywords', $data->meta_keywords ?? 'models, Blog, fashion')

@section('content')



<div class="container container-small blog-details pt-lg-5 pb-5">

    <div class="row">

        <div class="col-xl-8 col-lg-7 px-lg-3 px-0">

            <div class="media-holder blogMedia w-100 position-relative">

                <img src="{{url('storage/' . $data->image)}}" width="369" height="267" alt="Blog Image">

            </div>

            <div class="cms cms-blog p-lg-3 px-3 position-relative">

                <div class="d-lg-none pt-5 bg-dark-bg rounded-bottom-0 rounded-5 position-absolute bottom-100 w-100 start-0 mt-2"></div>

                <span class="batch-new py-lg-1 px-2 bg-primary d-inline-block text-black f700 mb-2">NEW</span>

                <span class="d-block f300 text-md-small text-light-primary-1 text-uppercase mb-1">{{ \Carbon\Carbon::parse($data->publish_at)->format('d M / Y') }}</span>

                <h1>{{$data->overview}}</h1>

                {!! $data->body !!}
            </div>

        </div>

        <div class="col-12 px-5 d-lg-none pt-4 pb-5">

            <div class="divider mx-auto border-top border-dark-primary-2"></div>

        </div>

        <div class="col-xl-4 col-lg-5">

            <div class="h2">Related posts</div>

              @foreach($blog as $val)

                <div class="d-flex position-relative align-items-center mb-2 pb-1">

                    <a href="#" class="media-holder blogThumb flex-shrink-0 me-3 position-relative">

                        <img src="{{url('storage/' . $val->image)}}" width="122" height="122" loading="lazy" alt="Blog Image">

                    </a>

                    <div>

                        <span class="d-block f300 text-md-small text-light-primary-1 text-uppercase mb-1">{{ \Carbon\Carbon::parse($val->publish_at)->format('d M / Y') }}</span>

                        <a class="h4 f300 text-primary text-hover-white" href="#">{{$val->title}}</a>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

    

   

   

</div>

@endsection