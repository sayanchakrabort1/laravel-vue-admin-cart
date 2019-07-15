<?php

// print_r($matrix);
// die();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">

<style>
    html, body {
        margin: 0;
        padding: 0;
        width: 100%;
    }

    body {
        font-family: "Helvetica Neue",sans-serif;
        font-weight: lighter;
    }

    header {
        width: 100%;
        height: 100vh;
        background: url(https://www.dutchnews.nl/wpcms/wp-content/uploads/2014/11/work-computers-560x373.jpg) no-repeat 50% 50%;
        background-size: cover;
    }

    .content {
        width: 94%;
        margin: 4em auto;
        font-size: 20px;
        line-height: 30px;
        text-align: justify;
    }

    .logo {
        line-height: 60px;
        position: fixed;
        float: left;
        margin: 16px 46px;
        color: #fff;
        font-weight: bold;
        font-size: 20px;
        letter-spacing: 2px;
    }

    nav {
        position: fixed;
        width: 100%;
        line-height: 60px;
    }

    nav ul {
        line-height: 60px;
        list-style: none;
        background: rgba(0, 0, 0, 0);
        overflow: hidden;
        color: #fff;
        padding: 0;
        text-align: right;
        margin: 0;
        padding-right: 40px;
        transition: 1s;
    }

    nav.black ul {
        background: #000;
    }

    nav ul li {
        display: inline-block;
        padding: 16px 40px;;
    }

    nav ul li a {
        text-decoration: none;
        color: #fff;
        font-size: 16px;
    }

    .menu-icon {
        line-height: 60px;
        width: 100%;
        background: #000;
        text-align: right;
        box-sizing: border-box;
        padding: 15px 24px;
        cursor: pointer;
        color: #fff;
        display: none;
    }

    @media(max-width: 786px) {

        .logo {
                position: fixed;
                top: 0;
                margin-top: 16px;
        }

        nav ul {
                max-height: 0px;
                background: #000;
        }

        nav.black ul {
                background: #000;
        }

        .showing {
                max-height: 34em;
        }

        nav ul li {
                box-sizing: border-box;
                width: 100%;
                padding: 24px;
                text-align: center;
        }

        .menu-icon {
                display: block;
        }

    }

    .none{
        text-decoration: none;
    }

    .none:hover{
        color:grey;
    }

    .flex-column{
        display:flex;
        flex-direction: column;
        padding:1%;
    }
</style>

</head>
<body>

    <div id="app">
        <adbar email = "{{ $email }}" ></adbar>
        <?php foreach($matrix as $key => $user){
            $array[$key] = $user[0];
        } 
        ?>

        @if(\Session::has('admin'))
        {{ $admin = 1 }}
        @else
        {{ $admin = 0 }}
        @endif


        @if (\Session::has('success'))
            <dashboard email = "{{ $email }}" user="{{ $data["user"] }}" prod="{{ $data["prod"] }}" admin={{ $admin }} msg="Mail has been sent!" v-bind:array="{{  json_encode($array) }}"></dashboard>
            
        @else
            <dashboard email = "{{ $email }}" user="{{ $data["user"] }}" prod="{{ $data["prod"] }}"  admin={{ $admin }} v-bind:array="{{  json_encode($array) }}"></dashboard>
        @endif
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    </div>
        <foot></foot>
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script>

      // Scrolling Effect

      $(window).on("scroll", function() {
            if($(window).scrollTop()) {
                  $('nav').addClass('black');
            }
            else {
                  $('nav').removeClass('black');
            }
      })

    //   $('html, body').animate({
    // scrollTop: $("#details").offset().top
    // }, 1000);

    $('html, body').animate({
    scrollTop: $("#details").offset().top
    }, 1000);

    $(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
    });
    </script>
</body>
</html>