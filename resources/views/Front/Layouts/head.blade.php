<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Khitan</title>
    <link rel="icon" href="{{asset('assets/img/khitan_logo1.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
            rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/gsap@3.9.0/dist/gsap.min.js"></script>

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" type="text/css">
<style type="text/css">
        .carousel {
            margin: 50px auto;
            padding: 0 70px;
        }
        .carousel .item {
            min-height: 330px;
            text-align: center;
            overflow: hidden;
        }
        .carousel .item .img-box {
            height: 160px;
            width: 100%;
            position: relative;
        }
        .carousel .item img {
            max-width: 100%;
            max-height: 100%;
            display: inline-block;
            position: absolute;
            bottom: 0;
            margin: 0 auto;
            left: 0;
            right: 0;
        }
        .carousel .item h4 {
            font-size: 18px;
            margin: 10px 0;
        }
        .carousel .item .btn {
            color: #333;
            border-radius: 0;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: bold;
            background: none;
            border: 1px solid #ccc;
            padding: 5px 10px;
            margin-top: 5px;
            line-height: 16px;
        }
        .carousel .item .btn:hover, .carousel .item .btn:focus {
            color: #fff;
            background: #000;
            border-color: #000;
            box-shadow: none;
        }
        .carousel .item .btn i {
            font-size: 14px;
            font-weight: bold;
            margin-left: 5px;
        }
        .carousel .thumb-wrapper {
            text-align: center;
        }
        .carousel .thumb-content {
            padding: 15px;
        }
        .carousel .carousel-control {
            height: 100px;
            width: 40px;
            background: none;
            margin: auto 0;
        }
        .carousel .carousel-control i {
            font-size: 30px;
            position: absolute;
            top: 50%;
            display: inline-block;
            margin: -16px 0 0 0;
            z-index: 5;
            left: 0;
            right: 0;
            color: rgba(0, 0, 0, 0.8);
            text-shadow: none;
            font-weight: bold;
        }
        .carousel .item-price {
            font-size: 13px;
            padding: 2px 0;
        }
        .carousel .item-price strike {
            color: #999;
            margin-right: 5px;
        }
        .carousel .item-price span {
            color: #86bd57;
            font-size: 110%;
        }
        .carousel .carousel-control.left i {
            margin-left: -3px;
        }
        .carousel .carousel-control.left i {
            margin-right: -3px;
        }
        .carousel .carousel-indicators {
            bottom: -50px;
        }
        .carousel-indicators li, .carousel-indicators li.active {
            width: 20px;
            height: 0px;
            margin: 4px;
            border-radius: 50%;
            border-color: transparent;
        }
        .carousel-indicators li {
            background: rgba(0, 0, 0, 0.2);
        }
        .carousel-indicators li.active {
            background: rgba(0, 0, 0, 0.6);
        }
        .star-rating li {
            padding: 0;
        }
        .star-rating i {
            font-size: 14px;
            color: #ffc000;
        }
    </style>
    @livewireStyles
</head>
