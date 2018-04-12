<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,  minimum-scale=1.0, maximum-scale=1.0" />
	<title>BMW E30 Australia</title>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="<?php echo asset('css/bootstrap/bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo asset('css/jquery_ui/jquery-ui-1.10.0.custom.css')?>" rel="stylesheet">
    <link href="<?php echo asset('css/style.css')?>" rel="stylesheet">
    <link href="<?php echo asset('css/plugins/animate/animate.css')?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo asset('images/favicon.ico')?>">
    
    <script src="<?php echo asset('js/jquery/jquery-1.11.1.min.js')?>"></script>
    <script src="<?php echo asset('js/bootstrap/bootstrap.min.js')?>"></script>
    <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    })
    </script>
</head>
<body>
<div class="container">
    <a href="{{ URL::route('home')}}"><div class="header"><img class="banner" src="<?php echo asset('images/logo.png')?>"></div></a>
    @include('misc.nav')  
     <a href="http://www.deviantart.com/art/BMW-e30-m3-297250255" target="_blank">
     <div class="top-square"><div class="top-square-img" style="background-image: url(<?php echo asset('images/topsquare.jpg')?>)"></div></div>
     </a>
    <div class="section-wrapper">
        @yield('content')
    </div>
    @include('home.footer')
    @include('misc.sitemap')
    </div>
    <?php if(Auth::check()) Auth::user()->touch(); ?>
</body>
</html>
