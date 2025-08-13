@extends('layout.app')
@section('meta_title', $data->meta_title ?? 'Blog - Models of Mayfair')
@section('meta_description', $data->meta_description ?? 'Learn more about Models of Mayfair.')
@section('meta_keywords', $data->meta_keywords ?? 'models, about, fashion')
@section('content')
<div class="container container-small pt-lg-5 pt-3 pb-5">

    {{-- Always show latest blog --}}
    @if(isset($latest))
        <div class="d-lg-flex position-relative align-items-center mb-4 pb-1 mb-lg-5">
            <a href="{{ url('news/' . $latest->slug) }}" class="media-holder blogThumb-big flex-shrink-0 me-xl-4 me-lg-3 position-relative d-block mb-lg-0 mb-3">
                <img src="{{ asset('storage/' . $latest->image) }}" width="369" height="267" alt="{{ $latest->title }}">
            </a>

            <div class="position-relative">
                <span class="batch-new py-lg-1 px-2 bg-primary d-inline-block text-black f700 mb-2 position-lg-down-absolute top-0 end-0">NEW</span>
                <span class="d-block f300 text-md-small text-light-primary-1 text-uppercase mb-1">{{ \Carbon\Carbon::parse($latest->publish_at)->format('d M / Y') }}</span>
                <h1 class="h3 mb-3">
                    <a class="f300 text-primary text-hover-white lh-base" href="{{ url('news/' . $latest->slug) }}">
                        {{ $latest->title }}
                    </a>
                </h1>
                <p class="text-md-small lh-base">{{ Str::limit(strip_tags($latest->body), 150) }}</p>
            </div>
        </div>

        <div class="col-lg-10 py-lg-4 mb-5 px-lg-0 px-5 mx-auto">
            <div class="divider mx-auto border-top border-dark-primary-2"></div>
        </div>
    @endif

    {{-- Blog List --}}
    @if($data->count())
        <div class="row">
            @foreach($data as $post)
                <div class="col-lg-6">
                    <div class="d-flex position-relative align-items-center mb-2 pb-2">
                        <a href="{{ url('news/' . $post->slug) }}" class="media-holder blogThumb blogThumb-md flex-shrink-0 me-3 position-relative">
                            <img src="{{ asset('storage/' . $post->icon) }}" width="122" height="122" loading="lazy" alt="{{ $post->title }}">
                        </a>
                        <div>
                            <span class="d-block f300 text-md-small text-light-primary-1 text-uppercase mb-1">{{ \Carbon\Carbon::parse($post->publish_at)->format('d M / Y') }}</span>
                            <a class="h4 f300 text-primary text-hover-white" href="{{ url('news/' . $post->slug) }}">{{ $post->title }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if ($data->hasPages())
            <ul class="pagination d-flex justify-content-center align-items-center pt-md-5 pt-4 mt-3">

                {{-- Previous Page Link --}}
                <li class="prev {{ $data->onFirstPage() ? 'disabled' : '' }}">
                    <a class="d-flex border border-primary rounded-circle align-items-center justify-content-center" href="{{ $data->previousPageUrl() ?? '#' }}">
                        <span class="arrow arrow-left arrow-left-white"></span>
                    </a>
                </li>

                {{-- Page Numbers --}}
                @for ($i = 1; $i <= $data->lastPage(); $i++)
                    <li class="{{ $i == $data->currentPage() ? 'active' : '' }}">
                        <a class="d-flex border border-primary rounded-circle align-items-center justify-content-center text-small" href="{{ $data->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Next Page Link --}}
                <li class="next {{ !$data->hasMorePages() ? 'disabled' : '' }}">
                    <a class="d-flex border border-primary rounded-circle align-items-center justify-content-center" href="{{ $data->nextPageUrl() ?? '#' }}">
                        <span class="arrow arrow-right arrow-right-white"></span>
                    </a>
                </li>

            </ul>
        @endif

    @else
        <p class="text-center text-white">No blog posts found.</p>
    @endif

</div>
@endsection
