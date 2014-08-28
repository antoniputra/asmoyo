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
    @show
</head>
<body>

	<div class="container-fluid">

	    <!-- Start Top -->
	    @yield('before_header')

	    @section('header')

	    @show

	    @yield('after_header')
	    <!-- End Top -->


	    <!-- Start Body  -->
	    @yield('before_body')

	    @section('body')
	    	{{$body}}
	    @show

	    @yield('after_body')
	    <!-- End Body -->


	    <!-- Start Body  -->
	    @section('footer')

	    @show
	    <!-- End Body -->

    </div>

    @section('javascripts')
    	{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js') }}
    	{{ HTML::script('packages/antoniputra/asmoyo/admin/js/bootstrap.min.js') }}
    @show

</body>
</html>