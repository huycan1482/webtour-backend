<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <base href="{{asset('')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="shop/css/header.css">
    <link rel="stylesheet" href="shop/css/main.css">
    <link rel="stylesheet" href="shop/css/scroll-up.css">
    <link rel="stylesheet" href="shop/css/footer.css">

    <link rel="stylesheet" href="shop/css/trangchu.css">
    <link rel="stylesheet" href="shop/css/tour.css">
    
    <link rel="stylesheet" href="shop/css/tour-detail.css">

    <link rel="stylesheet" href="shop/css/tours-list.css">

    <link rel="stylesheet" href="shop/css/order.css">

    <link rel="stylesheet" href="shop/css/contact.css">

    <link rel="stylesheet" href="shop/fontawesome/css/./all.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link rel="stylesheet" href="shop/css/animate.css" />
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}


    <script type="text/javascript">
        var base_url = '{{ url('/') }}';
    </script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <!-- wowjs -->
</head>

<body 
    @if (isset($finish) && $finish == 'true')
        {{-- {{ 'onload' }} --}}
    @endif
>
        @include('shop.layouts.header')

        <div class="scroll-up">
            <i class="fas fa-chevron-up shadow"></i>
        </div>
        
        <div class="contact">
            <i class="fas fa-phone-alt shadow"></i>
            <span class="show-contact-span">Liên hệ: {{ $settings->hotline }} </span>
        </div>

        <section >
            @yield('content')
        </section>
        
        @include('shop.layouts.footer')
 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script> --}}
    <!-- boostrap -->
    <script type="text/javascript" src="shop/js/wow.min.js"></script>
    <!-- wowjs -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- jquerry -->
    <script type="text/javascript" src="shop/js/scroll-up.js"></script>
    <script type="text/javascript" src="shop/js/main.js"></script>

    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @yield('modal')

    <script>
        new WOW().init();
    </script>

    @yield('my_script')
    <!-- <script type="text/javascript" src="../bootstrap/./js/./bootstrap.min.js"></script> -->
</body>
    
</html>