<!DOCTYPE html>
<html>
<head>
    @section('head')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            @section('title')
                Adminpanel 
            @show

            - Asmoyo Cms
        </title>

        @section('stylesheets')
            {{ HTML::style('packages/antoniputra/asmoyo/admin/css/bootstrap.min.css') }}
            {{ HTML::style('packages/antoniputra/asmoyo/admin/css/font-awesome.min.css') }}
            {{ HTML::style('packages/antoniputra/asmoyo/admin/css/admin-style.css') }}
        @show

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- Favicons -->
		<link rel="shortcut icon" href="/favicon.ico">
    @show
</head>
<body>
    <!-- Start Top -->
    @yield('before_header')

    @section('header')
    	@include($theme_path .'partial.header')
    @show

    @yield('after_header')
    <!-- End Top -->


    <!-- Start Body  -->
    <div class="container-fluid asmoyo-container">
        <div class="row">
            <div class="col-md-12">
                @yield('before_body')

                @section('body')
                	
                @show

                @yield('after_body')
            </div>
        </div>
    </div>
    <!-- End Body -->


    <!-- Start Body  -->
    @section('footer')
    	@include($theme_path .'partial.footer')
    @show
    <!-- End Body -->

    @section('javascripts')
    	{{-- HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js') --}}
    	{{ HTML::script('packages/antoniputra/asmoyo/admin/js/jquery.min.js') }}
    	{{ HTML::script('packages/antoniputra/asmoyo/admin/js/bootstrap.min.js') }}
    @show

</body>
</html>