<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('meta_title', 'Models of mayfair')</title>
    <meta name="description" content="@yield('meta_description', 'Models of mayfair')">
    <meta name="keywords" content="@yield('meta_keywords', 'model, fashion, blog')">
    <meta name="google-site-verification" content="jaTEsaKS_IKfofKRJIAWFXUg4YNuwCUjgCcoysAOQK0" />

    <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PCBHFKKX');</script>
    <!-- End Google Tag Manager -->

    <!-- Dynamic favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="@yield('meta_apple_icon', url('apple-touch-icon.png'))">
    <link rel="icon" type="image/png" sizes="32x32" href="@yield('meta_favicon_32', url('favicon-32x32.png'))">
    <link rel="icon" type="image/png" sizes="16x16" href="@yield('meta_favicon_16', url('favicon-16x16.png'))">

    <!-- Other standard tags -->
    <link rel="manifest" href="{{url('site.webmanifest')}}">
    <meta name="theme-color" content="#000000">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ url('node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/main.css') }}">
</head>






    <body class="bg-dark-bg">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PCBHFKKX"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


    {{-- HEADER --}}

    @include('layout.header')



    {{-- MAIN PAGE CONTENT --}}

    <main>

        @yield('content')

    </main>



    {{-- FOOTER --}}

    @include('layout.footer')



    <!-- Add JS scripts -->

    <script src="{{ asset('js/app.js') }}"></script>


    
  
        

        

       <!-- Bootstrap Bundle (includes Popper) -->

<script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>



<!-- Splide.js -->

<script defer src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>



<!-- Fancybox -->

<script defer src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0.29/dist/fancybox/fancybox.umd.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0.29/dist/fancybox/fancybox.css">



<!-- Flatpickr -->

<script defer src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">



<!-- Dropzone -->

<script src="https://cdn.jsdelivr.net/npm/dropzone@6.0.0-beta.2/dist/dropzone-min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@6.0.0-beta.2/dist/dropzone.css">





<!-- Splide CSS -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">



<!-- Splide JS -->

<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>



<!-- Your custom JS -->

<script defer src="{{url('js/app.js')}}"></script>





        <link rel="stylesheet" href="{{url('css/fonts.css')}}">

   

</body>

</html>

