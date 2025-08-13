@extends('layout.app')

@section('meta_title', $data->seo_title ?? 'Duo - Models of Mayfair')
@section('meta_description', $data->seo_description ?? 'Learn more about Duo Models of Mayfair.')
@section('meta_keywords', $data->seo_keywords ?? 'models, duo, fashion')
@section('content')
<div class="container">

{!! $data->description !!}

</div>
@endsection